@extends('users.student.cover')
@section('content')

    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            <div class="card">
                <h2 class="font-weight-bold text-center"> <span style="font-size:30px;font-style:san-serif" class="text-primary">Where you can choose your prefer exam:</span></h2>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row">
        @foreach($course_content as $content)
            <div class="col-3 col-xl-3 mb-4 mb-xl-0">
                <div class="card" id="card_id">
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
                        <button class="btn btn-primary" onclick="confirmRedirect('{{ $content->id }}')">
                            Take exam /<b>{{ $content->total_marks }}</b>
                        </button>
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