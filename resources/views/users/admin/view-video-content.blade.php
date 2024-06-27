@extends('users.admin.cover')
@section('content')

    <style>
        #videoPlayer {
            width: 100%;
            max-width: 600px;
        }
        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 600px;
            background: #333;
            color: #fff;
            padding: 10px;
        }
        .controls button, .controls input[type="range"] {
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        .controls input[type="range"] {
            flex: 1;
            margin: 0 10px;
        }
    </style>

    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
        </div>
    </div>

    <br>
    <div class="row">
        @foreach($view_lecture_content as $data)
            
            <div class="col-3 col-xl-3 mb-4 mb-xl-0">   
                <div class="card mt-2" id="card_id">
                
                    <video id="videoPlayer"  style="height:200px;" controls>
                        <source src="{{URL::to('/')}}/style/images/videos/{{ $data->video_file }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    
                    <div class="card-body" title="{{ $data->content }}">
                        <?php
                            $descr=strlen($data->content);
                            if($descr > 20){
                                $content=substr($data->content,0,20)." ... ";
                            }else{
                                $content=$data->content;
                            }
                                                        
                            $TimestampFrom_db=$data->created_at;
                            $dateTime=new DateTime($TimestampFrom_db);
                            $now=new DateTime();
                            $diff=$now->diff($dateTime);
                            
                            if ($diff -> y >0) {
                                $timeAgo=$diff->y." year".($diff->y >1 ? "s" : ""). " ago";
                            }elseif($diff -> m >0) {
                                $timeAgo=$diff->m." month".($diff->m >1 ? "s" : ""). " ago";
                            }elseif($diff -> d >0) {
                                $timeAgo=$diff->d." day".($diff->d >1 ? "s" : ""). " ago";
                            }elseif($diff -> h >0) {
                                $timeAgo=$diff->h." hour".($diff->h >1 ? "s" : ""). " ago";
                            }elseif($diff -> i >0) {
                                $timeAgo=$diff->i." minute".($diff->i >1 ? "s" : ""). " ago";
                            }else{
                                $timeAgo="Just now";
                            }
                                                        
                        ?>

                        <h3 style="font-family:san-serif;"><span class="card-title text-orange"><b>{{ $data->title }}</b></span></h3>
                        <h4 style="font-family:san-serif;">{{ $content }}</h4>
                        <p class="mt-2" style="font-family:san-serif;"><span class="text-info">Views :</span> <b>{{ $data->views }}</b>&nbsp;&nbsp;&nbsp;&nbsp;<span class="float-right"><span class="text-info">Posted:</span><b>{{ $timeAgo }}</b></span></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        const video = document.getElementById('videoPlayer');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const nextBtn = document.getElementById('nextBtn');
        const muteBtn = document.getElementById('muteBtn');
        const volumeSlider = document.getElementById('volumeSlider');
        const fullScreenBtn = document.getElementById('fullScreenBtn');

        playPauseBtn.addEventListener('click', () => {
            if (video.paused) {
                video.play();
                playPauseBtn.textContent = 'Pause';
            } else {
                video.pause();
                playPauseBtn.textContent = 'Play';
            }
        });

        nextBtn.addEventListener('click', () => {
            // Implement functionality to load the next video
        });

        muteBtn.addEventListener('click', () => {
            video.muted = !video.muted;
            muteBtn.textContent = video.muted ? 'Unmute' : 'Mute';
        });

        volumeSlider.addEventListener('input', () => {
            video.volume = volumeSlider.value;
        });

        fullScreenBtn.addEventListener('click', () => {
            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.mozRequestFullScreen) { // Firefox
                video.mozRequestFullScreen();
            } else if (video.webkitRequestFullscreen) { // Chrome, Safari and Opera
                video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) { // IE/Edge
                video.msRequestFullscreen();
            }
        });
    </script>

@endsection