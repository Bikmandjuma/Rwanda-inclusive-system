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

class UserController extends Controller
{
    public function self_registration(){
        return view('auth.self_registration');
    }

    public function post_self_registration(Request $request){
        $this->validate($request,[
            'firstname'=>'required|string|',
            'lastname'=>'required|string|',
            'email'=>'required|string|email|unique:users',
            'phone'=>'required|string|unique:users',
            'gender'=>'required|string|',
            'dob'=>'required|string|',
            'province'=>'required|string|',
            'district'=>'required|string|',
            'username'=>'required|string|',
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
        $users_numbers=collect(User::all())->count();
        $Exam_numbers=collect(Exam::all())->count();
        $Content_numbers=collect(Content::all())->count();
        $Course_numbers=collect(Course::all())->count();
        $Certificate_numbers=collect(Certificate::all())->count();
        $Result_numbers=collect(Result::all())->count();

        return view('users.student.home',compact('users_numbers','Exam_numbers','Content_numbers','Course_numbers','Certificate_numbers','Result_numbers'));
    }
}
