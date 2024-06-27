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
                    <span style="font-size:20px;font-style:san-serif" class="text-primary">Result slip:</span>
                </div>
                
                <div class="card-body" style="border:2px solid black;margin:10px;">
                    <div class="row mt-3">
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <ul style="list-style-type:square;font-weight:bold;">
                                <li>REPUBLIC OF RWANDA</li>
                                <li>MINISTRY OF EDUCATION</li>
                                <li>RWANDA INCLUSIVE SYSTEM</li>
                            </ul>
                        </div>
                        <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                            <ul style="list-style-type:square;font-weight:bold;" class="float-right">
                                <li>YEAR : {{ $current_year }}</li>
                                <li>CLASS : ONLINE EXAM</li>
                                <li class="text-uppercase">Name : {{ $student_fnane }} {{ $student_lnane }}</li>
                            </ul>
                        </div>
                    </div>

                    <p><b>www.rwandainclusivesystem.com</b></p>
                    <p><b>F.A </b>: formative assessment</p>
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        
                        <table border='1' style="width:100%;">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Course</th>
                                    <th colspan="2" class="text-center">Marks</th>
                                </tr>
                                <tr>
                                    <th class="py-2">Course code</th>
                                    <th>Course name</th>
                                    <th>MAX</th>
                                    <th>F.A (%)</th>
                                </tr>
                                <tr class="bg-secondary">
                                    <td colspan="4" class="text-center py-2">Complementary modules</td>
                                </tr>
                                
                                @foreach($modules_marks as $data)
                                    <tr>
                                        <td class="py-2">{{ substr($data->course_name,0,3) }}</td>
                                        <td>{{ $data->exam_name}}</td>
                                        <td>{{ $data->total_marks}}</td>
                                            @if($data->total_marks/2 > $data->total_score)
                                                <td class='text-danger'> {{ $data->total_score }}</td>
                                            @else
                                                <td>{{ $total_score=$data->total_score }}</td>
                                            @endif
                                    
                                    </tr>
                                    
                                @endforeach

                                <tr>
                                    <th class="py-2 text-center" colspan="2">TOTAL</th>
                                    <th>{{ $sum_total_marks }}</th>
                                    <th>{{ $sum_total_scores }}</th>
                                </tr>
                                <tr>
                                    <th class="py-2 text-center" colspan="2">AVERAGE MARKS</th>
                                    <th></th>
                                    <th>{{ round($marks_got,2) }}%</th>
                                </tr>
                                
                            </thead>
                        </table>
                    </div>
            
            </div>
        </div>
        <div class="col-1 col-xl-1 mb-4 mb-xl-0"></div>
    </div>
</div>

@endsection