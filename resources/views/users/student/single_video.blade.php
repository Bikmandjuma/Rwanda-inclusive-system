@extends('users.student.cover')
@section('content')
    
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>

    <!-- {{ $video_id }} -->
    <?php
        $descr=strlen($single_video_content);
        if($descr > 20){
            $contents=substr($single_video_content,0,20)." ... ";
        }else{
            $contents=$single_video_content;
        }

        $title=strlen($single_video_title);
        if($title > 8){
            $titles=substr($single_video_title,0,8)." ... ";
        }else{
            $titles=$single_video_title;
        }
    ?>

    <div class="row mt-3">
        <div class="col-8 col-xl-8 mb-4 mb-xl-0">
            <div class="card" id="card_id">
                
                <div class="card-body">
                    <video style="display:absolute;height:400px;max-width:100%;float:center;" controls>
                        <source src="{{URL::to('/')}}/style/images/videos/{{ $single_video_file }}" type="video/mp4" style="max-width:100%">
                        Your browser does not support the video tag.
                    </video>
                    <div style="margin-left:5%;">
                        <h3 style="font-family:san-serif;"><span class="card-title text-orange"><b>{{ $titles }}</b></span></h3>
                        <h4 style="font-family:san-serif;">{{ $contents }}</h4>
                        <p class="mt-2" style="font-family:san-serif;"><span class="text-info">Views :</span> <b>{{ $views }}</b>&nbsp;&nbsp;&nbsp;&nbsp;,&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info">Posted : </span><b>{{ $timeAgo }}</b></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 col-xl-4 mb-4 mb-xl-0">
            <div class="card" id="card_id" style="overflow:auto;max-height:700px;" >
                <div class="card-header text-center text-info" style="font-family:san-serif;"><strong>List of videos </strong><span class="badge badge-info float-right">{{$count_videos}}</span> </div>
                <!-- <div class="card-title text-center">All video</div> -->
                <br>

                    @foreach($all_video_files as $video)
                        <div class="card-body" onclick="window.location.href='{{ route('singleVideo',Crypt::encrypt($video->id))}}'" title="{{ $video->content }}">
                            <?php
                                $descr=strlen($video->content);
                                if($descr > 20){
                                    $content=substr($video->content,0,20)." ... ";
                                }else{
                                    $content=$video->content;
                                }

                                $title=strlen($video->title);
                                if($title > 8){
                                    $titles=substr($video->title,0,8)." ... ";
                                }else{
                                    $titles=$video->title;
                                }
                            ?>

                            <div class="card" id="card_id" style="height:100px;font-family:san-serif;margin-top:-30px;">
                                <video style="height:100px;max-width:50px;" controls>
                                    <source src="{{URL::to('/')}}/style/images/videos/{{ $video->video_file }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <span style="position:absolute;margin-top:20px;margin-left:100px;overflow:auto;">
                                    <p class="text-info card-title">{{ $titles }}</p>
                                    {{ $content }}
                                <span>
                            </div>

                        </div>
                    @endforeach
                
            </div>
        </div>
    
    </div>
@endsection





