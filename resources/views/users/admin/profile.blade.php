@extends('users.admin.cover')
@section('content')
<style>
img:hover{
        cursor: pointer;
      }

      .card_profile{
        justify-content: center;
        display: flex;
        align-items: center;
      }

      .card_title{
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
  /*        width: 70%; */
          text-align: center;
          background-color: white;
          border-radius:10px;
          font-family: sans-serif;
          font-weight: bold;
      }

      .card_title h3{
          font-family: serif;
      }

      .card:hover {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }

      .containers {
          padding: 2px 16px;
          text-align: center;
          font-family: serif;
      }

</style>

                  <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                        @if($errors->any())
                          @foreach($errors->all() as $error)
                              <li class="alert alert-danger">{{ $error }}</li>
                          @endforeach
                        @endif
                        @if(session('image_added'))
                          <li class="alert alert-success">{{ session('image_added')}}</li>
                        @endif
                      </div>
                      <div class="col-md-4"></div>
                  </div>

                  <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">

                      <div class="card_profile">
                       
                        <div class="card card-primary card-outline" style="width: 80%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                          <div class="card-header text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);"><h4 style="font-family:initial;">Profile picture</h4></div>
                          <img src="{{ URL::to('/') }}/style/images/admin/{{ auth()->guard('admin')->user()->image }}">
                          <div class="containers">
                            <h4><b>{{ auth()->guard('admin')->user()->firstname }} {{ auth()->guard('admin')->user()->lastname }}</b></h4> 
                            <button class="btn btn-info" data-toggle="modal" data-target="#ProfileModal"><i class="mdi mdi-file-image"></i>&nbsp;Edit</button>
                          </div>
                        </div>
                      </div>


                      </div>
                      <div class="col-md-4"></div>
                  </div>

                    <!--start of Profile modal -->
                    <div class="modal" id="ProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm text-center">
                          <div class="modal-content">
                            <div class="modal-body">
                              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4><i class="fa fa-image"></i>&nbsp;Profile picture</h4>
                            </div>
                            <div class="modal-body">
                              <div class="actionsBtns">
                                <form enctype="multipart/form-data" method="POST" action="{{ route('post_profile')}}">
                                  @csrf
                                  <!-- <div class="row">
                                    <div class="col-md-6"> -->
                                      <img id="blah" style="width:130px;height:150px;" src="{{ URL::to('/') }}/style/images/admin/{{ auth()->guard('admin')->user()->image }}" /><br>
                                    <!-- </div>
                                    <div class="col-md-6">
             -->                          
                                      <br>
                                      <input name="image" type="file" accept="image/*" id="imgInp" class="form-control" required><br>
                                      <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save change</button>
                                   <!--  </div>
                                  </div> -->
                                  
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--end of profile modal-->

            <script type="text/javascript">
                imgInp.onchange = evt => {
                  const [file] = imgInp.files
                  if (file) {
                    blah.src = URL.createObjectURL(file)
                  }
                }
            </script>

@endsection