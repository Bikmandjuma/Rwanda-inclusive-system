@extends('users.student.cover')
@section('content')

    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>

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

    <br>
    <div class="row">
    @foreach($view_lecture_content as $data)
            
            <div class="col-3 col-xl-3 mb-4 mb-xl-0">   
                <div class="card mt-2" id="card_id" onclick="window.location.href='{{ route('singleVideo',Crypt::encrypt($data->id))}}'">
                
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

                            if ($data->views >= 1000000) {
                                $views=round($data->views / 1000000, 1). 'm';
                            }elseif ($data->views >= 1000) {
                                $views=round($data->views / 1000, 1). 'k';
                            }else{
                                $views=$data->views;
                            }    
                        
                        ?>

                        <h3 style="font-family:san-serif;"><span class="card-title text-orange"><b>{{ $data->title }}</b></span></h3>
                        <h4 style="font-family:san-serif;">{{ $content }}</h4>
                        <p class="mt-2" style="font-family:san-serif;"><span class="text-info">Views :</span> <b>{{ $views }}</b><span class="float-right"><span class="text-info">Posted : </span><b>{{ $timeAgo }}</b></span></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        @if($count_lecture_data == 0)
            <div class="row mt-3">
                <div class="col-3 col-xl-3 text-center"></div>
                <div class="col-6 col-xl-6 text-center">
                    
                    <div class="card">
                        <div class="card-body">
                            No video added yet , wait lecturer to add them !
                        </div>
                    </div>
                    
                </div>
                <div class="col-3 col-xl-3 text-center"></div>
            </div>
        @endif

        
    <div class="row mt-3">
        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            {{ $view_lecture_content->links() }}
        </div>
    </div>
    
@endsection