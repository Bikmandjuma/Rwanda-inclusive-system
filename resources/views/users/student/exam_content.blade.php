@extends('users.student.cover')
@section('content')
<?php
    use App\Models\Result;
?>

<style>
    #done_exam_id{
        box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
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
                <h2 class="font-weight-bold text-center"> <span style="font-size:30px;font-style:san-serif" class="text-primary">Where you can choose your prefer examination:</span></h2>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row">
        @if($count_course_content == 0)
            <div class="col-3 col-xl-3 mb-4 mb-xl-0"></div>
            <div class="col-6 col-xl-6 mb-4 mb-xl-0">
                <div class="card">
                    <h2 class="font-weight-bold text-center"> <span style="font-size:30px;font-style:san-serif" class="text-danger">No exam added yet !</span></h2>
                </div>
            </div>
            <div class="col-3 col-xl-3 mb-4 mb-xl-0"></div>
        
        @else
        
                @foreach($course_content as $content)
                    <div class="col-12 col-xl-3 mb-4 mb-xl-0">
                        <div class="card mt-4" id="card_id">
                            <!-- <div class="card-title"></div> -->
                            <div class="card-header bg-secondary text-white text-center"><string><h3>{{ $content->course_name }} </h3></string></div>
                            <div class="card-body">
                                <ul>
                                    <li>
                                        {{ $content->exam_name }}
                                    </li>
                                    <br>
                                </ul>
                            </div>
                            <div class="card-body text-center">
                                <?php
                                    $result=Result::all()->where('exam_id',$content->id)->where('user_id',$user_id);
                                    $count_result=collect($result)->count();
                                    
                                    //calculate half
                                    $half_marks=$content->total_marks/2;
                                
                                    foreach ($result as $key => $value) {
                                        $marks_got=$value->total_score;
                                        $result_id=$value->id;
                                    }
                                ?>

                                @if($count_result == 0)
                                    <button class="btn btn-primary" onclick="confirmRedirect('{{ $content->id }}')" id="done_exam_id">
                                        Take exam <b>/{{ $content->total_marks }}</b>
                                    </button>
                                @else
                                <!-- onclick="confirmRedirectResult('{{ $result_id }}')" -->
                                    <button class="btn btn-light text-info" id="done_exam_id">

                                        @if($marks_got < $half_marks)
                                            Done <b><span class="text-danger">{{ $marks_got }}</span>/{{ $content->total_marks }}</b>
                                        @else
                                            Done <b>{{ $marks_got }}/{{ $content->total_marks }}</b>
                                        @endif
                                    </button>
                                @endif


                                
                                

                            </div>
                        </div>
                    </div>
                @endforeach
        @endif

        <br>

        <div class="col-12 col-xl-12 mb-4 mb-xl-0 mt-3 text-center">
            {{ $course_content->links() }}
        </div>
    </div>

    <script>
        function confirmRedirect(contentId) {
            const userConfirmed = confirm("Are you sure you want to take this exam?");
            if (userConfirmed) {
                window.location.href = '{{ url("user/take_exam")}}/'+contentId;
            }
        }

        function confirmRedirectResult(resultId){
            const userConfirmed = confirm("Do you want ,to see your certificate ?");
            if (userConfirmed) {
                window.location.href = '{{ url("user/check_certificate")}}/'+resultId;
            }
        }
    </script>    

@endsection