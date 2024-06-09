@extends('users.admin.cover')
@section('content')

<div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <a href="{{ route('view-content')}}"><button class="btn btn-info">View content</button></a>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Add content</h4>
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
                  
                  <form class="forms-sample" action="{{ route('post-content') }}" method="POST" enctype="multipart/form-data">
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
                      <label for="exampleInputConfirmPassword1">file</label>
                      <input type="file" class="form-control" name="fileToUpload">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card"></div>
        </div>

        <script>
          setTimeout(() => {

            var error=document.getElementById('msg_error');
            error.style.display="none";

          },5000);
        </script>

@endsection