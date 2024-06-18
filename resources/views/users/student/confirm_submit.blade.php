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

    <br>

    <div class="row">
        <div class="col-3 col-xl-3 mb-4 mb-xl-0"></div>
        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
            <div class="card text-center" id="card_id">
                <div class="card-header bg-info text-white"><string><h3>Well done , you submitted your examination !</h3></string></div>
                <div class="card-body">
                    <form method="post" action="{{ route('post_confirm_submission',$exam_id)}}" >
                        @csrf
                        <button class="btn btn-primary">Confirm submition</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3 col-xl-3 mb-4 mb-xl-0"></div>
    </div>

@endsection