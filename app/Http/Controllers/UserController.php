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
// use App\Models\DateTime;
use App\Models\VideoLecture;
use Illuminate\Support\Facades\DB;
use App\Mail\SheikhVerifyEmail;
use Illuminate\Support\Facades\Crypt;
use DateTime;

use PDF;

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

        $user=new User;
        $user->firstname = $fname;
        $user->lastname = $lname;
        $user->email = $email;
        $user->phone = $phone;
        $user->gender = $gender;
        $user->dob = $dob;
        $user->province = $provice;
        $user->district = $district;
        $user->username = $username;
        $user->password = $password;
        $user->image ='user.png';
        $user->save();

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
        $User_take_Course=0;
        $Certificate_numbers=collect(Certificate::all()->where('UserId','=',$userId))->count();
        $Done_exams=collect(Result::all()->where('user_id',$userId))->count();

        return view('users.student.home',compact('Exam_numbers','Course_numbers','Certificate_numbers','User_take_Course','Done_exams'));
    
    }

    public function get_pswd_form(){
        return view('users.student.pswd_uname');
    }

    public function my_info(){
        $TimestampFrom_db=Auth::guard('user')->user()->created_at;
        $dateTime=new DateTime($TimestampFrom_db);
        $now=new DateTime();
        $diff=$now->diff($dateTime);
        
        if ($diff -> y >0) {
            $timeAgo=$diff->y." year".($diff->y >1 ? "s" : ""). " ago";
        }elseif($diff -> m >0) {
            $timeAgo=$diff->m." month".($diff->m >1 ? "s" : ""). " ago";
        }elseif($diff -> d >0) {
            $timeAgo=$diff->d." day".($diff->d >1 ? "s" : ""). " ago";
        }elseif($diff -> h >0) {
            $timeAgo=$diff->h." hour".($diff->h >1 ? "s" : ""). " ago";
        }elseif($diff -> i >0) {
            $timeAgo=$diff->i." minute".($diff->i >1 ? "s" : ""). " ago";
        }else{
            $timeAgo="Just now";
        }

        return view('users.student.MyInformation',compact('timeAgo'));
    }

    public function singleVideo($id){
        $video_id=Crypt::decrypt($id);
        $video_content_single=VideoLecture::findOrFail($video_id);

        $all_video_files=VideoLecture::all()->where('id','!=',$video_id);
        
        $single_video_file=$video_content_single->video_file;
        $single_video_title=$video_content_single->title;
        $single_video_content=$video_content_single->content;
        $single_video_views=$video_content_single->views;
        $count_videos=collect($all_video_files)->count();

        $views=$single_video_views + 1;

        $TimestampFrom_db=$video_content_single->created_at;
        $dateTime=new DateTime($TimestampFrom_db);
        $now=new DateTime();
        $diff=$now->diff($dateTime);
        
        if ($diff -> y >0) {
            $timeAgo=$diff->y." year".($diff->y >1 ? "s" : ""). " ago";
        }elseif($diff -> m >0) {
            $timeAgo=$diff->m." month".($diff->m >1 ? "s" : ""). " ago";
        }elseif($diff -> d >0) {
            $timeAgo=$diff->d." day".($diff->d >1 ? "s" : ""). " ago";
        }elseif($diff -> h >0) {
            $timeAgo=$diff->h." hour".($diff->h >1 ? "s" : ""). " ago";
        }elseif($diff -> i >0) {
            $timeAgo=$diff->i." minute".($diff->i >1 ? "s" : ""). " ago";
        }else{
            $timeAgo="Just now";
        }


        DB::table('video_lectures')->where('id',$video_id)->update(['views' =>$views]);

        return view('users.student.single_video',compact('single_video_file','single_video_title','single_video_content','all_video_files','video_id','count_videos','views','timeAgo'));
    }

    public function my_profile(){
        return view('users.student.profile');
    }

    public function post_pswd_form(Request $request){
        $this->validate($request,[
            'current_password' => 'required|string|exists:users,password',
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
        $video_lecture_count=collect(VideoLecture::all())->count();

        return view('users.student.content',compact('exam_count','content_count','video_lecture_count'));

    }

    public function get_exam_content(){
        // $course_content=Exam::paginate(8);
        $course_content= DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->select('courses.*', 'exams.id','courses.course_name', 'exams.exam_name','exams.total_marks')
            ->paginate(8);
            // dd($course_content);
        $user_id=auth()->guard('user')->user()->id;

        $count_course_content = collect($course_content)->count();

        return view('users.student.exam_content',compact('course_content','user_id','count_course_content'));
    }

    public function get_learn_content(){

        $content_data=Content::paginate(10);
        $content_all_data=Content::all();
        $content_data_count=collect($content_all_data)->count();
        return view('users.student.learn_content',compact('content_data','content_data_count'));
    }

    public function get_lecture_video(){
        $view_lecture_content=VideoLecture::paginate(12);
        $lecture_content=VideoLecture::all();
        $count_lecture_data=collect($lecture_content)->count();
        
        return view('users.student.lecture_video',compact('view_lecture_content','count_lecture_data'));
    }

    public function take_exam($id){
        $exam_id=$id;
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
        $exam_id=$id;
        $user_id=auth()->guard('user')->user()->id;

        $totalMarks = DB::table('exams')
            ->join('questions', 'exams.id', '=', 'questions.exam_id')
            ->join('options', 'questions.id', '=', 'options.question_id')
            ->join('answers', 'questions.id', '=', 'answers.question_id')
            ->where([
                ['answers.user_id', '=', $user_id],
                ['answers.exam_id', '=', $exam_id],
                ['options.is_correct', '=', 'True'], // Assuming `is_correct` is a boolean field
                ['answers.selected_option_id', '=', DB::raw('options.id')] // Ensures selected option is the correct one
            ])
            ->sum('questions.marks');

        $result=new Result;
        $result->exam_id = $exam_id;
        $result->user_id = $user_id;
        $result->total_score = $totalMarks;
        $result->save();

        return redirect()->route('get_exam_content');

    }

    public function generateCertificate($id){

        $exam_id=$id;
        $user_id=auth()->guard('user')->user()->id;

        $user_fname=auth()->guard('user')->user()->firstname;
        $user_lname=auth()->guard('user')->user()->lastname;

        $exam = Exam::findOrFail($exam_id);
        $examResult = Result::where('user_id', $user_id)->where('exam_id', $exam_id)->firstOrFail();
        
        $totalMarks = $examResult->total_score;

        $data = [
            'firstname' => $user_fname,
            'lastname' => $user_lname,
            'examTitle' => $exam->exam_name,
            'marks_got' => $totalMarks,
            'total_marks' => $exam->total_marks,
            'message' => "Congratulations {$user->firstname} {$user->lastname}! You have successfully completed the exam '{$exam->exam_name}' with a score of {$totalMarks}/{$exam->total_marks}."
        ];

        $pdf = PDF::loadView('users.student.certificate', $data);
        return $pdf->download('certificate.pdf'); 
    }

    public function studentDeleteAccount(){
        $student_id=auth()->guard('user')->user()->id;
        User::find($student_id)->delete();
        return redirect()->route('logout');
    }

    public function get_result(){
        $current_year=date('Y');
        $user_id = auth()->guard('user')->user()->id;

        $modules_marks = DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->join('results', 'exams.id', '=', 'results.exam_id')
            ->select('results.*','course_name','exam_name','total_marks','total_score')
            ->where([
                ['results.user_id', '=', $user_id],
            ])->get();

        $sum_total_scores = DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->join('results', 'exams.id', '=', 'results.exam_id')
            ->select('results.*','course_name','exam_name','total_marks','total_score')
            ->where([
                ['results.user_id', '=', $user_id],
            ])->sum('total_score');

        $sum_total_marks = DB::table('courses')
            ->join('exams', 'courses.id', '=', 'exams.course_id')
            ->join('results', 'exams.id', '=', 'results.exam_id')
            ->select('results.*','course_name','exam_name','total_marks','total_score')
            ->where([
                ['results.user_id', '=', $user_id],
            ])->sum('total_marks');

            $count_result_courses=collect($modules_marks)->count();

            $marks_got=($sum_total_scores/$count_result_courses);
        
        return view('users.student.get_result',compact('current_year','modules_marks','marks_got','sum_total_marks','sum_total_scores'));
    }

}
