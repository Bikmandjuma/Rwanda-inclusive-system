@extends('users.admin.cover')
@section('content')
        
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
              <!-- <div> -->
                
              <!-- </div> -->
              <div class="card">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li class="alert alert-danger text-center" id="disable_msg">{{ $error }}</li>
                            @endforeach
                        @endif

                        @if(session('done_status_msg'))
                          <li class="alert alert-danger text-center" id="disable_msg">{{ session('done_status_msg') }}</li>
                        @endif

                        @if(session('null_status_msg'))
                          <li class="alert alert-danger text-center" id="disable_msg">{{ session('null_status_msg') }}</li>
                        @endif

                        @if(session('mail_sent'))
                          <li class="alert alert-info text-center" id="disable_msg">{{ session('mail_sent') }}</li>
                        @endif

                    </div>
                    <div class="col-lg-4"></div>
                  </div>

                  <h4 class="card-title">All Sheikh info</h4>
                  <button class="btn btn-primary float-right" style="margin-top:-50px;" data-toggle="modal" data-target="#ModalAddSheikh" id="send_email_to_sheikh_id"><i class="ti-user"></i> Add new by email</button>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Image
                          </th>
                          <th>
                            FirstName
                          </th>
                          <th>
                            LastName
                          </th>
                          <th>
                            Gender
                          </th>
                          <th>
                            Faculty
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($sheikh_data as $data)
                          <tr>
                            <td class="py-1">
                              <img src="{{ URL::to('/') }}/style/images/sheikh/{{ $data->image }}" alt="sheikh's image"/>
                            </td>
                            <td class="py-1">
                              {{ $data->firstname }}
                            </td>
                            <td class="py-1">
                              {{ $data->lastname }}
                            </td>
                            <td class="py-1">
                              {{ $data->gender }}
                            </td>
                            <td class="py-1">
                              {{ $data->faculty }}
                            </td>
                            <td class="py-1">
                              <a href="#id={{ $data->id }}"><i class="mdi mdi-eye"></i></a>
                            </td>
                          </tr>
                        @endforeach

                          @if($sheikh_data_count == 0)
                            <tr>
                              <td colspan="6" class="text-center">No data found in database</td>
                            </tr> 
                          @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

        <!--start of Logout modal -->
        <div class="modal" id="ModalAddSheikh" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-md text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close" style="font-size:-20px;"><span aria-hidden="true">×</span></button>
                  <h4>Enter Sheikh's email&nbsp;<i class="mdi mdi-email" id="logout_sys_icon"></i></h4>
                </div>
                <div class="modal-body" style="margin-top:-50px;">
                  <div class="actionsBtns">
                    <form action="{{ route('send_email_to_sheikh') }}" method="POST">
                      @csrf
                       <input type="email" name="email" class="form-control" placeholder="Enter email . . . " Required/>
                       <button type="submit" class="btn btn-primary mt-2">Send&nbsp;<i class="ti-send" style="margin-top:10px;"></i></button>
                    </form>
                      <!-- <button class="btn btn-danger float-right" data-dismiss="modal"><i class="fa fa-times"></i> Not now</button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--end of logout modal-->
        
        <script>
          setTimeout(()  => {
              var error=document.getElementById('disable_msg');
              error.style.display="none";
              // open_btn();
          },5000);
        </script>

@endsection