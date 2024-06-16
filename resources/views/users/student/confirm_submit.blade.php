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
            <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                    <div class="card" id="card_id">
                        <!-- <div class="card-title"></div> -->
                        <div class="card-header bg-info text-white"><string><h3>Well done , u submitted ur exam</h3></string></div>
                        <div class="card-body">
                            <button onclick="window.location.href='{{ route('post_confirm_submission',$exam_id)}}'" class="btn btn-info">Confirm submission</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        
        <br>
        
    </ul>
            

@endsection