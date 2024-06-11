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

                        <div class="row">
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->
                            <div class="col-md-12 grid-margin stretch-card">
                                
                            <div class="card">
                                    <div class="card-body">
                                    
                                    @php
                                        $count=1;
                                        if($count_exam_marks ==0){
                                    @endphp
                                    
                                            <style>
                                                
                                                #marks_div_id{
                                                    display:none;
                                                }
                                            </style>
                                    @php
                                        }else{
                                            @endphp
                                                <style>
                                                    #btn_id{
                                                        display:none;
                                                    }
                                                </style>
                                            @php
                                        }
                                    @endphp
                                    @foreach($data as $data)

                                    <h4 class="card-title text-center"><span class="text-info">{{ $data->course_name }}</span> course</h4>
                                    <div class="table-responsive">
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
                                                Module_name
                                            </th>
                                            
                                            <th>
                                                Lesson_name
                                            </th>
                                            <th id="btn_id">
                                                Action
                                            </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td class="py-1">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-4">
                                                    {{ $data->course_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->module_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->lesson_name }}
                                                </td>
                                                <td  id="btn_id">
                                                <a class="btn btn-info" data-toggle="modal" data-target="#ModalExamMarks">Set course's marks</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                                    

                                

                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->

                        </div>

            <div class="row" id="marks_div_id">
                <div class="col-md-3"></div>   
                <div class="col-md-6 grid-margin stretch-card">    
                    
                    <div class="card">
                        <div class="card-title text-center">Marks data of <b class="text-primary">{{ $course_name }}</b></div>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div> 
                </div>

            </div>
        </div>

    <!--start modal of exam marks-->
        <div class="modal" id="ModalExamMarks" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-sm text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><!--span aria-hidden="true">×</span--></button>
                  <h4>Add marks on <b>{{$course_name }}</b> course</h4>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                  <div class="actionsBtns">
                  <form class="forms-sample" action="{{ route('post_exam_marks',$course_id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" value="{{ $course_name }}" class="form-control" name="course_name" disabled>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="exam_name" required placeholder="Enter exam name ex:final exam of math">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="total_marks" required placeholder="Enter total marks">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary mr-2">Submit marks</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!--end modal of exam marks-->

@endsection