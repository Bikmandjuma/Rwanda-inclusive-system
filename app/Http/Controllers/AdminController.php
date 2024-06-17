<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\SheikhPartialRegistration;
use paginate;
use App\Models\Course;
use App\Models\Module;
use App\Models\Admin;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use App\Models\Result;
use App\Models\Lesson;
use App\Models\Certificate;
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
            'username'=>'required|string',
            'password'=>'required|string',
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }elseif (Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('user_dashboard');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }

    }

    public function dashboard()
    {
        $users_numbers=collect(User::all())->count();
        $Exam_numbers=collect(Exam::all())->count();
        $Content_numbers=collect(Content::all())->count();
        $Course_numbers=collect(Course::all())->count();
        $Certificate_numbers=collect(Certificate::all())->count();
        $Result_numbers=collect(Result::all())->count();

        return view('users.admin.home',compact('users_numbers','Exam_numbers','Content_numbers','Course_numbers','Certificate_numbers','Result_numbers'));
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

        foreach ($data as $key => $value) {
            if($request->hasFile('image')){
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    try {
                        $file->move(public_path('style/images/admin'), $filename);
                        DB::table('admins')->where('id', $admin_id)->update(['image' => $filename]);
                        echo "File uploaded successfully.";
                    } catch (\Exception $e) {
                        echo "Failed to upload file: " . $e->getMessage();
                    }
                } else {
                    echo "The file is not valid.";
                }
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
            ->select('courses.*', 'courses.id','courses.course_name', 'modules.module_name','lessons.lesson_name')
            ->where(['lessons.id'=>$lesson_id])
            ->get();

        foreach ($data as $key => $value) {
            $course_id=$value->id;
            $course_name=$value->course_name;
        }

        $exam_marks=Exam::all()->where('course_id',$course_id);
        
        $count_exam_marks=collect($exam_marks)->count();

        $marks_data= DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->select('courses.*', 'courses.id','courses.course_name', 'exams.exam_name','exams.total_marks')
            ->where(['courses.id'=>$course_id])
            ->get();

        return view('users.admin.course_data',compact('data','count_exam_marks','course_name','course_id','marks_data'));
    }

    public function post_exam_marks(Request $request,$id){
        $this->validate($request,[
            'exam_name' => 'required',
            'total_marks' => 'required',
        ]);

        $course_id=$id;

        $marks=new Exam;
        $marks->course_id = $course_id;
        $marks->exam_name = $request->exam_name;
        $marks->total_marks = $request->total_marks;
        $marks->save();

        return redirect()->back();

    }

    public function add_view_exam(){
        $marks_data= DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->select('exams.*', 'exams.id as exam_id','courses.id as course_id','courses.course_name', 'exams.exam_name','exams.total_marks')
            // ->where(['courses.id'=>$course_id])
            ->get('id');
            

        $count_exam_marks=collect('marks_data')->count();
        
        return view('users.admin.add_view_exam',compact('count_exam_marks','marks_data'));
        
    }

    public function get_question($id,$name){
        $course_name=$name;
        $exam_id=$id;

        $question_data=Question::all()->where('exam_id',$exam_id);

        $count_question_data = collect($question_data)->count();

        $marks_counts= DB::table('exams')
            ->join('questions', 'exams.id', '=', 'questions.exam_id')
            ->select('exams.*', 'questions.marks')
            ->where(['questions.exam_id'=>$exam_id])
            ->sum('marks');

        return view('users.admin.get_question',compact('question_data','exam_id','course_name','count_question_data','marks_counts'));
    }
    

    public function post_questions(Request $request, $id) {
        $exam_id = $id;
    
        $current_marks_counts = DB::table('exams')
            ->join('questions', 'exams.id', '=', 'questions.exam_id')
            ->where('questions.exam_id', $exam_id)
            ->sum('questions.marks');
    
        $total_marks_counts = DB::table('exams')
            ->where('id', $exam_id)
            ->value('total_marks'); // Use value instead of get to get a single value
    
        $text = $request->question_text;
        $type = $request->question_type;
        $marks = $request->marks;
    
        $new_marks = $current_marks_counts + $marks;
        $marks_remain = $total_marks_counts - $current_marks_counts; // Correct calculation
    
        if ($new_marks > $total_marks_counts) {
            return redirect()->back()->with('error_higher_amount', 'Only ' . $marks_remain . ' marks remain to reach the total of ' . $total_marks_counts . '!');
        } else {
            $question = new Question;
            $question->exam_id = $exam_id;
            $question->question_text = $text;
            $question->question_type = $type;
            $question->marks = $marks;
            $question->save();
    
            return redirect()->back()->with(['data_added' => 'Question added successfully!', 'total_marks' => $current_marks_counts,'marks_total_counts' => $total_marks_counts]);
        }
    }

    public function get_options($id){
        $option_data=Option::all();
        $count_option_data=collect('option_data')->count();

        $question_id=$id;
        
        $question_name=Question::all()->where("id",$id);
        foreach ($question_name as $key => $value) {
            $quest_name=$value->question_text;
        }

        $count_option_id=collect(Option::all()->where("question_id",$id))->count();

        return view('users.admin.get_options',compact('option_data','count_option_data','quest_name','question_id','count_option_id'));
    }

    public function post_options(Request $request,$id){
        $option_Data = $request->validate([
            'option_text' => 'required|min:1',
            'option_text.*' => 'required|string|max:255',
            'choice' => 'required|min:1',
            'choice.*' => 'required|string|max:255',
        ],[
            'option_text.*.required' => 'Option text field is required !',
            'choice.*.required' => 'Choice field is required !',
        ]);

        
        $question_id=$id;

        foreach ($option_Data['option_text'] as $key => $value) {
            
            $data=new Option;
            $data->question_id = $question_id;
            $data->option_text = $value;
            $data->is_correct = $option_Data['choice'][$key];
            $data->save();
        }

        return redirect()->back()->with('success', 'Options submitted successfully!');
    
    }

}
