<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function home(){
        return view('homePage.home');
    }

    public function about(){
        return view('homePage.about');
    }

    public function courses(){
        return view('homePage.courses');
    }

    public function contact(){
        return view('homePage.contact');
    }
}
