@extends('users.admin.cover')
@section('content')
    
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row m-2">
        <div class="col-1 col-xl-1 mb-4 mb-xl-0"></div>
        <div class="col-10 col-xl-10 mb-4 mb-xl-0">
            <div class="card" id="card_id">
                <div class="card-header text-center">
                    <span style="font-size:20px;font-style:san-serif" class="text-primary">An option by question:</span>
                </div>
                
                <div class="card-body" style="margin:10px;">
                    <div class="row mt-3">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <ul style="list-style-type:square;font-weight:bold;font-size:20px;">
                                <li >Course_name : {{ $course_name }}</li>
                                <li>Exam_name : {{ $exam_name }}</li>
                                <li>Options count : {{ $options_count }}</li>
                            </ul>
                        </div>
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <ul style="list-style-type:square;font-weight:bold;font-size:20px;" class="float-right">
                                <li>Point : {{ $question_marks }}</li>
                                <li>Type : {{ $question_type }}</li>
                            </ul>
                        </div>
                    </div>

                    <p style="font-size:20px;" class="mt-3"><b>Question :  </b>{{ $question_text }}</p>
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0" style="margin-top:20px;">
                        @foreach($option_data as $data)

                                <ul style="list-style-type:none;">
                                    <b style="font-size:20px;"><span class="text-info">Option {{$count_option++}}</span> : {{$data->option_text}}</b>
                                    @if ($data->is_correct == "True") 
                                        <li style="margin-left:20px;font-size:15px;"><b>Real-answer: <span class="text-info" >{{$data->is_correct }}</span></b></li>
                                    @else
                                        <li style="margin-left:20px;">Real-answer: <span class="text-danger">{{ $data->is_correct }}</span></li>
                                    @endif
                                </ul>
                            
                            <hr>
                        @endforeach
                        
                    </div>
            
            </div>
        </div>
        <div class="col-1 col-xl-1 mb-4 mb-xl-0"></div>
    </div>
</div>

@endsection