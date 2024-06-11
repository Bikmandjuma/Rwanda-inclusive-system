@extends('users.admin.cover')
@section('content')

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                    </div>
                </div>

                <br>

            <div class="row" id="marks_div_id">
                <div class="col-md-2"></div>   
                <div class="col-md-8 grid-margin stretch-card">    
                    
                    <div class="card">
                        <div class="card-title text-center">Examination list <b class="text-primary"></b></div>
                            <div class="card-body">
                                <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                N<sup>o</sup>
                                            </th>
                                            <th>
                                                Course_name
                                            </th>
                                            <th>
                                                Exam_name
                                            </th>
                                            
                                            <th>
                                                Total_marks
                                            </th>

                                            <th>
                                                Action
                                            </th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1
                                            @endphp
                                            @foreach($marks_data as $data)
                                            <tr>
                                                <td class="py-3">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->course_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->exam_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->total_marks }}
                                                </td>

                                                <td class="py-1">
                                                    <a class="btn btn-info" href="{{ url('admin/get_question')}}/{{$data->exam_id}}/{{$data->course_name}}" >View question</a>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div> 
                </div>

            </div>
        </div>
@endsection