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
use App\Models\ExamSubmission;
use App\Models\Answer;
use App\Models\UserCourse;
use App\Models\User;
use App\Models\Result;
use App\Models\Lesson;
use App\Models\Certificate;
use App\Models\Content;
use Illuminate\Support\Facades\DB;
use App\Mail\SheikhVerifyEmail;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function self_registration(){
        return view('auth.self_registration');
    }

    public function post_self_registration(Request $request){
        $this->validate($request,[
            'firstname'=>'required|string|',
            'lastname'=>'required|string|',
            'email'=>'required|string|email|unique:users|unique:admins',
            'phone'=>'required|string|unique:users|unique:admins',
            'gender'=>'required|string|',
            'dob'=>'required|string|',
            'province'=>'required|string|',
            'district'=>'required|string|',
            'username'=>'required|string|min:8|unique:users|unique:admins',
            'password'=>'required|string|between:8,32|confirmed',
            'password_confirmation' => 'required'
        ],[
            'password_confirmation.required' => 're_enter password field is required',
            'password.confirmed' => 'password entered does not much ',
        ]);

        $fname=$request->firstname;
        $lname=$request->lastname;
        $email=$request->email;
        $phone=$request->phone;
        $gender=$request->gender;
        $provice=$request->province;
        $district=$request->district;
        $dob=$request->dob;
        $username=$request->username;
        $password=bcrypt($request->password);

        DB::table('users')->insert([
            'firstname'=> $fname,
            'lastname'=> $lname,
            'email'=> $email,
            'phone'=> $phone,
            'gender'=> $gender,
            'dob'=> $dob,
            'province'=> $provice,
            'district'=> $district,
            'username'=> $username,
            'password'=> $password,
            'image' => 'user.png'
        ]);

        return redirect()->back()->with("register_well","Registered Successfully ! , You can login now");
    }

    public function logout(){
        Auth::guard('user')->logout();
        return redirect()->route('login.form');
    }

    public function dashboard()
    {
        $userId=auth()->guard('user')->user()->id;
        
        $Exam_numbers=collect(Exam::all())->count();
        $Course_numbers=collect(Course::all())->count();
        $User_take_Course=collect(DB::table('user_course')->where('user_id',$userId))->count();
        $Certificate_numbers=collect(Certificate::all()->where('UserId','=',$userId))->count();
        $Done_exams=collect(ExamSubmission::all()->where('user_id',$userId))->count();

        return view('users.student.home',compact('Exam_numbers','Course_numbers','Certificate_numbers','User_take_Course','Done_exams'));
    
    }

    public function get_pswd_form(){
        return view('users.student.pswd_uname');
    }

    public function my_info(){
        return view('users.student.MyInformation');
    }

    public function my_profile(){
        return view('users.student.profile');
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

    public function post_profile(Request $request){
        $this->validate($request,[
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $admin_id=Auth::guard('user')->user()->id;
        $current_imgage=Auth::guard('user')->user()->image;

        $data=User::find($admin_id);

        foreach ($data as $key => $value) {
            if($request->hasFile('image')){
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    try {
                        $file->move(public_path('style/images/user'), $filename);
                        DB::table('users')->where('id', $admin_id)->update(['image' => $filename]);
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

    public function get_content(){
        $exam_count=collect(Exam::all())->count();
        $content_count=collect(Content::all())->count();
        return view('users.student.content',compact('exam_count','content_count'));
    }

    public function get_exam_content(){
        // $course_content=Exam::paginate(8);
        $course_content= DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->select('courses.*', 'exams.id','courses.course_name', 'exams.exam_name','exams.total_marks')
            ->paginate(8);
            // dd($course_content);
        $user_id=auth()->guard('user')->user()->id;

        // $exam_done=ExamSubmission::distinct('user_id')->where('user_id',$user_id)->count('user_id');
        $exams=ExamSubmission::distinct('exam_id')->select('exam_id')->where('user_id',$user_id)->get('exam_id');
        foreach ($exams as $key => $value) {
            $Done_exam_id=$value->exam_id;
        }

        return view('users.student.exam_content',compact('course_content','Done_exam_id'));
    }

    public function get_learn_content(){
        return view('users.student.learn_content');
    }

    public function get_lecture_video(){
        return view('users.student.lecture_video');
    }

    public function take_exam($id){
        $exam_id=$id;
        // $exam_content= DB::table('exams')
        // ->join('questions', 'exams.id', '=', 'questions.exam_id')
        // ->join('options', 'questions.id', '=', 'options.question_id')  
        // ->select('exams.*', 'exams.id')
        // ->where(['questions.exam_id' => $exam_id])
        // ->get();
        $exam_content = Exam::with(['questions.options'])
        ->where('id', $exam_id)
        ->get();

        return view('users.student.take_exam',compact('exam_content','exam_id'));
    }

    public function submitExam(Request $request,$id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'selected_option_*' => 'required|array',
            'selected_option_*.*' => 'exists:options,id',
        ]);

        $userId = auth()->guard('user')->user()->id; // Assuming the user is logged in
        // $examId = $request->input('exam_id'); // Assuming exam_id is passed in the form
        $examId = $id;


        // Loop through each question's selected option
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'selected_option_') !== false) {
                // Extract question id from the key
                $questionId = str_replace('selected_option_', '', $key);

                // Create an answer record
                Answer::create([
                    'exam_id' => $examId,
                    'user_id' => $userId,
                    'question_id' => $questionId,
                    'selected_option_id' => $value,
                    'answer_text' => null, // Assuming no text answers in this form submission
                ]);
            }
        }

        ExamSubmission::create([
            'exam_id' => $examId,
            'user_id' => $userId
        ]);

        return redirect()->route('confirm_submit',$examId);

    }

    public function confirmSubmit($id){
        $exam_id=$id;
        return view('users.student.confirm_submit',compact('exam_id'));
    }

    public function post_confirm_submission(Request $request,$id){
        
    }



}
