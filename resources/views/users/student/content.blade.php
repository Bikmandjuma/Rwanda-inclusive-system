@extends('users.student.cover')
@section('content')

    <style>
      #card_id:hover{
        cursor:pointer;
        color:violet;
      }
    </style>
    
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            <div class="card">
                <h2 class="font-weight-bold text-center"> <span style="font-size:30px;font-style:san-serif" class="text-primary">Where you can choose how you want to learn:</span></h2>
            </div>
        </div>
    </div>
    <br>
    <ul style="list-style-type:numeric;">
        <li>
            <div class="row" onclick='window.location.href=""'>
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                    <div class="card" id="card_id">
                        <!-- <div class="card-title"></div> -->
                        <div class="card-header bg-info text-white"><string><h3>Take an Exam</h3></string></div>
                        <div class="card-body">
                            <ul>
                                
                                <li>Prepare for your assessments with our comprehensive exam resources.</li>
                                <li>Practice with text-based and written exams to test your knowledge and track your progress.</li>
                                <li>Exams are designed to reinforce your learning and ensure you grasp key concepts.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <br>
        <li>
        <div class="row" onclick='window.location.href=""'>
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                    <div class="card" id="card_id">
                        <!-- <div class="card-title"></div> -->
                        <div class="card-header bg-info text-white"><string><h3>Learn New Content</h3></string></div>
                        <div class="card-body">
                            <ul>
                                <li>Dive into new subjects and expand your knowledge with our extensive written materials.</li>
                                <li>Access articles, e-books, and lecture notes to explore new topics in depth.</li>
                                <li>Our content is curated by experts to ensure you receive accurate and valuable information.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <br>
        <li>
        <div class="row" onclick='window.location.href=""'>
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                    <div class="card" id="card_id">
                        <div class="card-header bg-info text-white"><string><h3>Watch Lecture Videos</h3></string></div>
                        <div class="card-body">
                            <ul>
                                <li>Visual learners can benefit from our library of lecture videos, which cover a wide range of subjects.</li>
                                <li>Watch and learn at your own pace, rewatching videos as needed to fully understand the material.</li>
                                <li>Videos are designed to be engaging and informative, making complex topics easier to grasp.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
            

@endsection