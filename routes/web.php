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
    // return view('welcome');
    return view('auth.login');

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
    Route::get('get_option/{id}',[AdminController::class,'get_options'])->name('get_options');
    Route::post('post_option/{id}',[AdminController::class,'post_options'])->name('post_option');
    Route::get('view_student',[AdminController::class,'view_student_list'])->name('view_student');
    Route::get('video-lecture',[AdminController::class,'get_video_lecture_content'])->name('add-video-lecture-content');
    Route::get('view/video-lecture',[AdminController::class,'view_video_lecture_content'])->name('view-video-lecture-content');
    Route::post('post/video-lecture',[AdminController::class,'post_video_lecture_content'])->name('post-video-lecture-content');
    Route::get('view/singleVideo/{id}',[AdminController::class,'singleVideo'])->name('singleVideo');
});

//routes codes of user/students
Route::group(['prefix'=>'user','middleware'=>'user'],function(){
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::get('home',[UserController::class,'dashboard'])->name('user_dashboard');
    Route::get('password',[UserController::class,'get_pswd_form'])->name('get_password');
    Route::get('information',[UserController::class,'my_info'])->name('get_info');
    Route::get('profile',[UserController::class,'my_profile'])->name('get_profile');
    Route::post('submit_password_management',[UserController::class,'post_pswd_form'])->name('post_password');
    Route::post('post_profile',[UserController::class,'post_profile'])->name('post_profile');
    Route::get('content',[UserController::class,'get_content'])->name('get_content');
    Route::get('exam_content',[UserController::class,'get_exam_content'])->name('get_exam_content');
    Route::get('learn_content',[UserController::class,'get_learn_content'])->name('get_learn_content');
    Route::get('lecture_video',[UserController::class,'get_lecture_video'])->name('get_lecture_video');
    Route::get('take_exam/{id}',[UserController::class,'take_exam'])->name('take_exam');
    Route::post('post_take_exam/{id}',[UserController::class,'submitExam'])->name('post_take_exam');
    Route::get('Confirm_submit/{id}',[UserController::class,'confirmSubmit'])->name('confirm_submit');
    Route::post('post_confirm_submission/{id}',[UserController::class,'post_confirm_submission'])->name('post_confirm_submission');
    Route::get('check_certificate/{id}', [UserController::class, 'generateCertificate'])->name('got_certificate');

});