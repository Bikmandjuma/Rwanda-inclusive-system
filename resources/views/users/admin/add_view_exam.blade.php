@extends('users.admin.cover')
@section('content')
<?php
    use App\Models\Question;
?>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                    </div>
                </div>

                <br>
                

            <div class="row" id="marks_div_id">
                <div class="col-md-1"></div>   
                <div class="col-md-10 grid-margin stretch-card">    
                    
                    <div class="card" id="card_id">
                        <div class="card-title text-center">Examination list <b class="text-primary"></b></div>
                            <div class="card-body"  style="overflow:auto;">
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
                                                    <?php
                                                        $question=Question::all()->where('exam_id',$data->id);
                                                        $count_question=collect($question)->count();
                                                    ?>
                                                    <a class="btn btn-info" href="{{ url('admin/get_question')}}/{{Crypt::encrypt($data->exam_id)}}/{{Crypt::encrypt($data->course_name)}}" >View questions &nbsp;&nbsp;&nbsp;<span class="badge badge-light">{{$count_question}}</span> </a>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div> 
                </div>

            </div>
        </div>
@endsection