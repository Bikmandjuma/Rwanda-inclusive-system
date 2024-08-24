@extends('users.admin.cover')
@section('content')
<?php
    use App\Models\Option;
?>

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                    </div>
                </div>

                <br>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            @if(session('error_higher_amount'))
                                <li class="alert alert-danger" id="error_msg">{{ session('error_higher_amount') }}</li>
                            @endif
                        </div>
                        <div class="col-md-4"></div>
                    </div>

            <div class="row" id="marks_div_id">
                <!-- <div class="col-md-2"></div>    -->
                <div class="col-md-12 grid-margin stretch-card">    
                    
                    <div class="card" id="card_id">
                        <div class="card-title text-center">
                            Examination question of <b class="text-primary">{{ $course_name }}</b>
                            <button class="btn btn-info float-right" data-toggle="modal" data-target="#Modalquesdtion" id="add_btn_id">Add new question</button>
                        </div>
                            <div class="card-body" style="overflow:auto;">
                                <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                N<sup>o</sup>
                                            </th>
                                            <th>
                                                QUESTION TEXT
                                            </th>
                                            <th>
                                                QUESTION TYPE
                                            </th>
                                            <th>
                                                MARKS
                                            </th>
                                            <th>
                                                OPTION
                                            </th>
                                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count=1
                                            @endphp
                                            @foreach($question_data as $data)
                                            <tr>
                                                <td class="py-3">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1" title="{{ $data->question_text }} ">
                                                    @if(strlen($data->question_text) <= 40)
                                                        {{ $data->question_text }} 
                                                    @else
                                                        <?php
                                                            echo substr($data->question_text,0,40)."....";
                                                        ?>
                                                    @endif
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->question_type }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->marks }}
                                                </td>
                                                <td class="py-1">
                                                    <?php
                                                        $option=Option::all()->where('question_id',$data->id);
                                                        $count_option=collect($option)->count();
                                                    ?>
                                                    @if($count_option == 0)
                                                        <a class="btn btn-danger" href="{{url('admin/get_option')}}/{{ $data->id }}/{{ $exam_id }}">Not added yet &nbsp;&nbsp;&nbsp;<span class="badge badge-light">{{ $count_option }}</span> </a>
                                                    @else
                                                        <a class="btn btn-info" href="{{url('admin/get_singleOption_byQuestion')}}/{{ Crypt::encrypt($data->id) }}/{{ Crypt::encrypt($exam_id) }}/{{ Crypt::encrypt($course_name) }}" onclick="optionFunction('{{ $data->id }},{{ $data->question_text }}')">View options &nbsp;&nbsp;&nbsp;<span class="badge badge-light">{{ $count_option }}</span> </a>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                            
                                            @endforeach
                                            <tr id="ttl_marks_id">
                                                <td colspan="3" class="text-center"><b>Total marks</b></td>
                                                <td><b><span class="text-primary">{{ $marks_counts}}</span> / {{ $total_marks }}</b></td>
                                                <td class="text-center">. . .</td>
                                            </tr>

                                            @if($count_question_data == 0)
                                                <tr>
                                                    <td colspan="5" class="text-center">No question of <b class="text-info">{{ $course_name }}</b> found in database </td>
                                                </tr>
                                                <style>
                                                    #ttl_marks_id{
                                                        display:none;
                                                    }
                                                </style>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-2"></div>  -->
                </div>

            </div>
        </div>

        @if($marks_counts == $total_marks)
            <Style>
                #add_btn_id{
                    display:none;
                }
            </style>
        @endif

    <!--start modal of exam marks-->
    <div class="modal" id="Modalquesdtion" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-sm text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><!--span aria-hidden="true">×</span--></button>
                  <h4>Add question on <b class="text-info">{{$course_name }}'s</b> course</h4>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                  <div class="actionsBtns">
                  <form class="forms-sample" action="{{ route('post_questions',$exam_id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <textarea type="text" class="form-control" name="question_text" required placeholder="Enter question text"></textarea>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="question_type" required>
                            <option value="">Question type </option>
                            <option value="multiple-choice">Multiple-choice</option>
                            <option value="true-false">true-false</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control" name="marks" required placeholder="Enter marks">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary mr-2">Submit question</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!--end modal of exam marks-->
    <script>
        setTimeout(() => {
            var msg=document.getElementById('error_msg');
            msg.style.display="none";
        }, 5000);
    </script>

@endsection