@extends('auth.cover')
@section('content')
    <div class="container mt-5" id="FormId">
		
		<div class="row">
			
			<div class="col-lg-2 col-md-2 col-sm-2 "></div>
			<div class="col-lg-8 col-md-8 col-sm-8 ">
				<div class="card">
	            <div class="card-body">
                    <div class="d-flex justify-content-center">
				        <img class="img-fluid p-1" src="{{ URL::to('/') }}/homePage/img/logo.jpeg" alt="" width="150" height="40">
				    </div>
	              <h5 class="card-title text-center mt-3">Reset code here !</h5>
	              @if(session('valid_code'))
	              	<p class="alert alert-success">
	              		{{ session('valid_code') }}
	              	</p>
	              	<script type="text/javascript">
	              		setTimeout(function(){
	              			window.location.href="{{ url('reset/password/') }}/{{ Crypt::encrypt($email) }}/{{ Crypt::encrypt($code) }}";
	              			document.getElementById('spin_id').style.display="block"
	              		},5000);
	              	</script>
	              @endif

	              @if(session('expired_code'))
	              	<p class="alert alert-danger">
	              		{{ session('expired_code') }}
	              	</p>
	              @endif

	             
	              <!-- No Labels Form -->
	              <form class="row g-3" action="{{ url('codeCheck')}}/{{$email}}/{{$code}}" method="POST">
	              	@csrf
	          
	                <div class="col-md-6">
	                  <label>Email</label>	
	                  <input type="text" name="email" value="{{ $email }}" class="form-control" placeholder="Enter firstname" disabled>
	                  	@error('email')
						    <p style="color:Red;">
						        {{ $message }}
						    </p>
						@enderror
	                </div>
	                <div class="col-md-6">
	                  <label>Code</label>
	                  <input type="number" name="code" class="form-control" placeholder="Enter code">
	                    @error('code')
						    <p style="color:Red;">
						        {{ $message }}
						    </p>
						@enderror
	                </div>
	                
	                <div class="col-md-12 text-center">
	                	<button type="submit" class="btn btn-primary mt-3">check code&nbsp;<i class="fa fa-spinner fa-spin" style="display: none;" id="spin_id"></i>
</button>
	                </div>
	                
	              </form><!-- End No Labels Form -->

	            </div>
	          </div>

	         	<div class="row mt-5">
			        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
				        <div>
				          &copy; Copyright <strong><span>2024</span></strong>. All Rights Reserved
				        </div>
				        <div class="credits">
				          <!-- All the links in the footer should remain intact. -->
				          <!-- You can delete the links only if you purchased the pro version. -->
				          <!-- Licensing information: https://bootstrapmade.com/license/ -->
				          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
				          Designed by <a href="#">{{ config('app.name','laravel') }}</a>
				        </div>
			      	</div>
			    </div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2"></div>
		</div>
	</div>

@endsection