<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[AdminController::class,'login_form'])->name('login.form');
Route::get('forgot-password',[AdminController::class,'forgot_password'])->name('ForgotPasswordForm');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login-functionality');
Route::get('/student/registration',[UserController::class,'self_registration'])->name('self_registration');
Route::post('PostRegistration',[UserController::class,'post_self_registration'])->name('post_self_registration');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
    Route::get('home',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('Create/Content',[AdminController::class,'CreateContent'])->name('create-content');
    Route::post('PostContent',[AdminController::class,'PostContent'])->name('post-content');
    Route::get('View/Content',[AdminController::class,'ViewContent'])->name('view-content');
    Route::get('password_management',[AdminController::class,'get_pswd_form'])->name('get_password');
    Route::post('submit_password_management',[AdminController::class,'post_pswd_form'])->name('post_password');
    Route::get('information',[AdminController::class,'my_info'])->name('get_info');
    Route::get('profile',[AdminController::class,'my_profile'])->name('get_profile');
    Route::post('post_profile',[AdminController::class,'post_profile'])->name('post_profile');
    Route::get('create/course',[AdminController::class,'create_course'])->name('create-course');
    Route::post('post_course',[AdminController::class,'post_course'])->name('post_course');
    Route::get('create/module/{id}',[AdminController::class,'create_module'])->name('create-module');
    Route::post('post_module/{id}',[AdminController::class,'post_module'])->name('post_module');
    Route::get('create_lesson/{id}',[AdminController::class,'create_lesson'])->name('create-lesson');
    Route::post('post_lesson/{id}',[AdminController::class,'post_lesson'])->name('post_lesson');
    Route::get('get_all_courses/{id}',[AdminController::class,'get_all_courses'])->name('get_all_courses');
    Route::post('post_exam_marks/{id}',[AdminController::class,'post_exam_marks'])->name('post_exam_marks');
    Route::get('add_view_exam',[AdminController::class,'add_view_exam'])->name('add_view_exam');
    Route::get('get_question/{id}/{name}',[AdminController::class,'get_question'])->name('get_question');
    Route::post('post_question/{id}',[AdminController::class,'post_questions'])->name('post_questions');
});