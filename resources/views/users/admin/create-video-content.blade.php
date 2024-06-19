@extends('users.admin.cover')
@section('content')
        
        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
        </div>  
        <br>
        <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
                <a href="{{ route('create-content') }}"><button class="btn btn-primary">Add learning contents</button></a>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" id="card_id">
                <div class="card-body">
                  <h4 class="card-title text-center text-primary ">Add lecture  video content</h4>
                  @if($errors->any())
                    <ul class="alert alert-danger" id="msg_error">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif

                  @if(session('content_added'))
                    <li class="alert alert-info text-center" id="msg_error">{{ session('content_added') }}</li>
                  @endif
                  
                  <form class="forms-sample" action="{{ route('post-video-lecture-content') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea type="text" class="form-control" rowspan="10" name="description" placeholder="Enter content . . . "></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Vide-file</label>
                      <input type="file" class="form-control" name="video" accept="video/*">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit lecture video</button>
                    </div>

                  </form>
                  <!-- <br> -->
                </div>
              </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary float-right" onclick="window.location.href='{{ route('view-video-lecture-content') }}'">View lecture video's content <span class="badge badge-light">{{ $Content_numbers }}</span> </button>
            </div>
        </div>

        <script>
          setTimeout(() => {

            var error=document.getElementById('msg_error');
            error.style.display="none";

          },5000);
        </script>

@endsection