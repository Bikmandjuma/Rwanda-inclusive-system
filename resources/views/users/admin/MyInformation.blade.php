@extends('users.admin.cover')
@section('content')
        <style>
            	Profile Page Start
==============================================================*/
.profile-photo{
	width: 160px;
	height: 160px;
	margin: 0 auto 15px;
	position: relative;
}
.profile-photo .edit-avatar{
	position: absolute;
	right: -15px;
	top: 0;
	width: 30px;
	height: 30px;
	line-height: 30px;
	font-size: 14px;
	text-align: center;
	-webkit-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
	-moz-box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
	box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
	-webkit-border-radius: 100%;
	-moz-border-radius: 100%;
	border-radius: 100%;
}
.profile-photo .avatar-photo{
	-webkit-border-radius: 100%;
	-moz-border-radius: 100%;
	border-radius: 100%;
}
.profile-info{
	border-top: 2px dashed #ecf0f4;
	padding: 15px;
}
.profile-info ul li{
	margin-bottom: 15px;
	font-size: 14px;
	font-weight: 500;
	word-wrap: break-word;
}
.profile-info ul li span{
	display: block;
	font-size: 14px;
	color: #1b00ff;
	font-weight: 500;
	padding-bottom: 5px;
}
.profile-info ul li:last-child{
	margin-bottom: 0;
}
.profile-social{
	border-top: 2px dashed #ecf0f4;
	padding: 15px;
}
.profile-social ul li{
	float: left;
	margin: 5px;
}
.profile-social ul li .btn{
	padding: 0;
	width: 36px;
	height: 36px;
	text-align: center;
	line-height: 36px;
}
        </style>
            <div class="row">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-30"></div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">
						
						@if(session('success'))
							<li class="alert alert-info text-center" id="error_msg">
								{{ session('success') }}
							</li>
						@endif

                        <div class="card" id="card_id">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo text-center">
								<img src="{{ URL::to('/') }}/style/images/admin/{{ auth()->guard('admin')->user()->image }}" onclick="window.location.href='{{route('get_profile')}}'" alt="" class="avatar-photo mt-2" width="150" height="150" style="border:1px solid skyblue;">
							</div>
							<h3 class="text-center mb-0">{{ auth()->guard('admin')->user()->firstname }} {{ auth()->guard('admin')->user()->lastname }}</h3>
							<p class="text-center text-muted font-14 mt-2">Role : <span class="text-primary">Admin</span></p>
							<div class="profile-info">
								<!-- <h5 class="mb-20 h5 text-blue">Contact Information</h5> -->
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                        <ul style="list-style-type:none;">
                                            <li>
                                                <span>Email Address:</span>
                                                {{ auth()->guard('admin')->user()->email }}
                                            </li>
                                            <li>
                                                <span>Phone Number:</span>
                                                {{ auth()->guard('admin')->user()->phone }}	
                                            </li>
                                            <li>
                                                <span>Gender</span>
                                                {{ auth()->guard('admin')->user()->gender }}	
                                            </li>
                                            
                                        </ul>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-30">

                                        <ul style="list-style-type:none;">
											

                                            <li>
                                                <span>Birth date:</span>
                                                {{ auth()->guard('admin')->user()->dob }}
                                            </li>
                                            <li>
                                                <span>Username:</span>
                                                {{ auth()->guard('admin')->user()->username }}	
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
							</div>

							<div class="profile-social text-center">
                                <button class="btn btn-primary float-center" style=""  data-toggle="modal" data-target="#ModalEditInfo">Edit my Info</button>
							</div>

							
						</div>
                        </div>
					</div>
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-30"></div>
        </div>
    
    <!--start of modal -->
    <div class="modal" id="ModalDeleteAccount" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-md text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><!--span aria-hidden="true">×</span--></button>
                  <h4>Delete account&nbsp;<i class="mdi mdi-trash" id="logout_sys_icon"></i></h4>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                  <p>Are you sure , you want to delete your account ? <br /></p>
                  <p>All your data will be removed once you delete your account ! <br /></p>
                  <div class="actionsBtns">
                      <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                      <a href="{{ route('studentDeleteAccount') }}" class="btn btn-danger" id="log_btn_a"><i class="fas fa-check" id="logout_icon_btn"></i> Yes</a>&nbsp;&nbsp;&nbsp;
                      <button class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Not now</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!--end of modal-->

	 <!--start of modal edit info -->
	 <div class="modal" id="ModalEditInfo" tabindex="-1" role="dialog" aria-hidden="true"  style="margin-top:45px;">
            <div class="modal-dialog modal-md text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><!--span aria-hidden="true">×</span--></button>
                  <h4>Edit info&nbsp;<i class="mdi mdi-trash" id="logout_sys_icon"></i></h4>
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                  <div class="actionsBtns">
					<form class="forms-sample" action="{{ route('EditAdminInfo') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" value="{{ auth()->guard('admin')->user()->firstname }}" required placeholder="Enter firstname" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" value="{{ auth()->guard('admin')->user()->lastname }}" required placeholder="Enter lastname" required>
							</div>
						</div>

						<div class="row mt-2">
							<div class="col-md-6">
								
								<select class="form-control" name="gender" required>
									@if(auth()->guard('admin')->user()->gender == "Male")
										<option value="Male" selected>Male</option>
										<option value="Female">Female</option>
									@else
										<option value="Male">Male</option>
										<option value="Female" selected>Female</option>
									@endif
								</select>
								
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="email" value="{{ auth()->guard('admin')->user()->email }}" placeholder="Enter email" required>
							</div>
						</div>

						<div class="row mt-2">
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone" value="{{ auth()->guard('admin')->user()->phone }}" placeholder="Enter phone" required>
							</div>
							<div class="col-md-6">
								<input type="date" class="form-control" name="dob" value="{{ auth()->guard('admin')->user()->dob }}" required>
							</div>
						</div>
						
						<div class="text-center mt-3">
							<button type="submit" class="btn btn-primary mr-2">Save changes</button>
							<button class="btn btn-danger float-right" data-dismiss="modal"><i class="fa fa-times"></i> Not now</button>
						</div>
					</form>

                      
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!--end of modal edit info-->

	<script>
		setTimeout(() => {
			document.getElementById('error_msg').style.display="none";	
		}, 5000);
	</script>
@endsection