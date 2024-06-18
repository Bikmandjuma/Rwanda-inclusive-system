@extends('users.student.cover')
@section('content')
    
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-4 col-xl-4 mb-4 mb-xl-0"></div>
        <div class="col-4 col-xl-4 mb-4 mb-xl-0">
            @if($errors->any())
                <ul>
                    @foreach(#rrors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-4 col-xl-4 mb-4 mb-xl-0"></div>
    </div>
    <br>
    <div class="card" id="card_id">
        
            <div class="card-body">
                <form action="{{ route('post_take_exam',$exam_id) }}" method="POST">
                    @csrf
                    @foreach ($exam_content as $exam)
                        <div class="card-header bg-info text-white text-center">
                            <h3><b>{{ $exam->exam_name }}</b> <span class="float-right">Total_points : {{ $exam->total_marks }}</span> </h3>
                        </div>
                        <br>
                        @php $count = 1 @endphp
                        @foreach ($exam->questions as $question)
                            <div class="card-header">
                                {{$count++}} : {{ $question->question_text }} 
                                <span class="float-right text-info"><b>Points : {{ $question->marks }}</b></span>
                                <br>
                            </div>
                            <br>
                            @foreach ($question->options as $option)
                                <input type="radio" name="selected_option_{{ $question->id }}" value="{{ $option->id }}" required>&nbsp;{{ $option->option_text }}<br>
                            @endforeach
                            <br>
                        @endforeach
                    @endforeach
                    <button class="btn btn-info text-center" type="submit">Submit exam</button>
                </form>
            </div>

    </div>
    
@endsection