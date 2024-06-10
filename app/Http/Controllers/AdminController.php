<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\SheikhPartialRegistration;
use App\Models\Sheikh;
use paginate;
use App\Models\Course;
use App\Models\Module;
use App\Models\Admin;
use App\Models\Lesson;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use App\Mail\SheikhVerifyEmail;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //todo: admin login form
    public function login_form()
    {
        return view('auth.login');
    }

    //todo: admin login functionality
    public function login_functionality(Request $request){
        $request->validate([
            'username'=>'required|email',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }elseif (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back()->with('test','Sheikh login well');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }

    }

    public function dashboard()
    {
        return view('users.admin.home');
    }

    public function forgot_password(){
        return view('auth.forgot_password');
    }

    //managing sheikh
    public function CreateContent(){
        return view('users.admin.create-content');
    }

    //post content data
    public function PostContent(Request $request){
        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string|',
            'fileToUpload' => 'required|mimes:jpg,png,pdf,jpeg',
        ],[
           'fileToUpload.required' => 'file field is required.' 
        ]);

        $title=$request->title;
        $descr=$request->description;

        $content = new Content;
        $content -> title = $title;
        $content -> discription = $descr;

        if($request->hasFile('fileToUpload')){
            $file= $request->file('fileToUpload');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('style/images/content'), $filename);
            $content['image'] = $filename;
        }

        $content->save();

        return redirect()->back()->with('content_added','Content added well !');

    }

    public function ViewContent(){
        $content_data=Content::all();
        $content_data_count=collect($content_data)->count();
        return view('users.admin.view-content',compact('content_data','content_data_count'));
    }


    //todo: admin logout functionality
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }

    public function send_email_to_sheikh_to_register(Request $request){
        $request->validate([
            'email' =>'required|string|email'
        ]);
        $email=$request->email;

        $done_email=SheikhPartialRegistration::all()->where('email',$email)->where('status','Done');
        $count_done_email=collect($done_email)->count();

        $not_done_email=SheikhPartialRegistration::all()->where('email',$email)->where('status','');
        $count_not_done_email=collect($not_done_email)->count();

        if ($count_done_email == 1) {
            return redirect()->back()->with("done_status_msg","This email is already registered by sheikh !");
        }elseif ($count_not_done_email == 1) {
            return redirect()->back()->with("null_status_msg","This email is not registered yet by sheikh !");
        }else{
            
            $auth_name=Auth::guard('admin')->user()->firstname." ".Auth::guard('admin')->user()->lastname;
            $encryptEmail=Crypt::encrypt($email);

            Mail::to($email)->send(new SheikhVerifyEmail($auth_name,$encryptEmail));

            DB::table('sheikh_partial_registrations')->insert([
                'email' => $email,
                'status' => ''
            ]);

            return redirect()->back()->with("mail_sent","Email sent successfully !");

        }
        
    
    }


    public function get_pswd_form(){
        return view('users.admin.pswd_uname');
    }

    public function post_pswd_form(Request $request){
        $this->validate($request,[
            'current_password' => 'required|string|exists:admins,password',
            'new_password' => 'required|string|between:8,32|confirmed',
            'password_confirmation' => 'required',
        ],[
            'new_password.confirmed' => 'new password do not much'
        ]);

        $current_pswd=$request->current_password;
        $new_pswd=$request->new_password;
        $new_pswd_confirm=$request->password_confirmation;
    }

    public function my_info(){
        return view('users.admin.MyInformation');
    }

    public function my_profile(){
        return view('users.admin.profile');
    }

    public function post_profile(Request $request){
        $this->validate($request,[
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $admin_id=Auth::guard('admin')->user()->id;
        $current_imgage=Auth::guard('admin')->user()->image;

        $data=Admin::find($admin_id);

        // dd($data);
        foreach ($data as $key => $value) {
            if($request->hasFile('image')){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('style/images/admin'), $filename);
                DB::table('admins')->where('id',$admin_id)->update(['image' => $current_imgage,'image' => $filename]);
            }
        }

        return redirect()->back()->with('image_added','Profile added well !');
    }

    //create course
    public function create_course(){
        $course_data=Course::paginate(5);
        $course_data_count=collect(Course::all())->count();
        return view('users.admin.create_course',compact('course_data','course_data_count'));
    }

    public function post_course(Request $request){
        $this->validate($request,[
            'course_name' => 'required|string|unique:courses',
            'description' => 'required|string',
        ]);

        $course=new Course;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->save();

        return redirect()->back()->with('data_added','Course added well');
    }

    public function create_module($id){
        $course_id=Crypt::decrypt($id);
        $course_name=Course::all()->where('id',$course_id)->select('course_name');

        foreach ($course_name as $key => $value) {
            $course_og_name=$value['course_name'];
        }

        $module_data=Module::paginate(5);
        $module_data_count=collect(Module::all())->count();
        return view('users.admin.create_module',compact('course_og_name','module_data','module_data_count','course_id'));

    }

    public function post_module(Request $request,$id){
        $this->validate($request,[
            'module_name' => 'required|string',
            'module_content' => 'required|string',
        ]);

        $course_id=$id;
        
        $module = new Module;
        $module -> course_id = $course_id;
        $module -> module_name = $request->module_name;
        $module -> content = $request->module_content;
        $module->save();

        return redirect()->back()->with('data_added','Module added well');
    }

    public function create_lesson($id){
        $module_id=Crypt::decrypt($id);
        $module_name=Module::all()->where('id',$module_id)->select('module_name');

        foreach ($module_name as $key => $value) {
            $module_og_name=$value['module_name'];
        }

        $lesson_data=Lesson::paginate(5);
        $lesson_data_count=collect(Lesson::all())->count();

        return view('users.admin.create_lesson',compact('module_og_name','lesson_data','lesson_data_count','module_id'));
    }

    public function post_lesson(Request $request,$id){
        $this->validate($request,[
            'lesson_name' => 'required|string',
            'lesson_content' => 'required|string',
        ]);

        $module_id=$id;
        
        $lesson = new Lesson;
        $lesson -> module_id = $module_id;
        $lesson -> lesson_name = $request->lesson_name;
        $lesson -> content = $request->lesson_content;
        $lesson->save();

        return redirect()->back()->with('data_added','Lesson added well');
    }

    public function get_all_courses($id){
        $lesson_id=Crypt::decrypt($id);
        $data= DB::table('courses')
            ->join('modules', 'courses.id', '=', 'modules.course_id')
            ->join('lessons', 'modules.id', '=', 'lessons.module_id')
            ->select('courses.*', 'courses.course_name', 'modules.module_name','lessons.lesson_name')
            ->where(['lessons.id'=>$lesson_id])
            ->get();

        return view('users.admin.course_data',compact('data'));
    }

}
