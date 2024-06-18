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
        @foreach($course_content as $content)
            <div class="col-3 col-xl-3 mb-4 mb-xl-0">
                <div class="card mt-4" id="card_id">
                    <!-- <div class="card-title"></div> -->
                    <div class="card-header bg-info text-white text-center"><string><h3>{{ $content->course_name }} </h3></string></div>
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

                            if ($count_result == 0) {}
                            else{
                                foreach ($result as $key => $value) {
                                    $marks_got=$value->total_score;
                                }

                                if($marks_got < $half_marks){
                                    $marks_got_x =$marks_got;
                                }else{
                                    $marks_got_x = $marks_got;
                                }
                            }

                            

                           
                        ?>

                        @if($count_result == 0)
                            <button class="btn btn-primary" onclick="confirmRedirect('{{ $content->id }}')" id="done_exam_id">
                                Take exam <b>/{{ $content->total_marks }}</b>
                            </button>
                        @else
                            <button class="btn btn-light text-info" id="done_exam_id">
                                Done exam <b>{{ $marks_got_x }} / {{ $content->total_marks }}</b>
                            </button>
                        @endif


                        
                        

                    </div>
                </div>
            </div>
        @endforeach

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
    </script>    

@endsection