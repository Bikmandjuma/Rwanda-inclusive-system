<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
