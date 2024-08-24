@extends('auth.cover')
@section('content')
        <style>
          #eye_pswd_off:hover{
            cursor:pointer;
          }
          #eye_pswd:hover{
            cursor:pointer;
          }
        </style>
    <div class="row w-100 mx-0">
      <div class="col-lg-4 mx-auto">

        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center text-center">
                <!-- <img src="{{ URL::to('/') }}/style/images/logo.png" alt="logo"> -->
                <img class="img-fluid p-1" src="{{ URL::to('/') }}/homePage/img/logo.jpeg" alt="" width="200" height="40"> 
              </div>
              <h6 class="font-weight-light text-center">Sign in to continue.</h6>
      
               @if ($errors->any())
                    <!-- <div > -->
                        <ul class="alert alert-danger" id="disable_message">
                            @foreach ($errors->all() as $error)
                                <li style='list-style-type:numeric;'>{{ $error }}</li>
                            @endforeach
                        </ul>
                    <!-- </div> -->
                @endif

                @if (session('error-message'))
                    <!-- <div> -->
                        <ul class="alert alert-danger" id="disable_message">
                            <li>{{ session('error-message') }}</li>
                        </ul>
                    <!-- </div> -->
                @endif

                @if (session('password_reseted'))
                    <div>
                        <ul class="alert alert-success" id="disable_message">
                            <li>{{ session('password_reseted') }}</li>
                        </ul>
                    </div>
                @endif
       
                <form class="pt-3" action="{{route('login-functionality')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Enter email" name="username" value="{{old('username')}}" aufocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="pswd_id" name="password" placeholder="Enter password">
                  <i class="mdi mdi-eye float-right" style="margin-top:-35px;font-size:25px;display:none;padding-right:10px;" id="eye_pswd"></i>
                  <i class="mdi mdi-eye-off float-right" style="margin-top:-35px;font-size:25px;padding-right:10px;" id="eye_pswd_off"></i>
                </div>
                <div class="mt-3 text-center">
                  <button type="submit" class="btn btn-primary btn-md font-weight-medium">SIGN IN</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  <a href="{{ route('ForgotPasswordForm') }}" class="text-primary">Forgot password ?</a>
                </div>

                <div class="text-center mt-4 font-weight-light">
                    Don't have an account<a href="{{ route('self_registration') }}" class="text-primary"> Create one !</a>
                </div>

              </form>
        </div>

    </div>
</div>

        <script>
          setTimeout(() => {
            const message=document.getElementById('disable_message');
            message.style.display="none";
          },5000);

          var password=document.getElementById('pswd_id');
          var pswd_eye=document.getElementById('eye_pswd');
          var pswd_eye_off=document.getElementById('eye_pswd_off');
          
          pswd_eye_off.addEventListener('click',function(){
            if (password.type === "password") {
                password.type = "text";

                pswd_eye.style.display="block";
                pswd_eye_off.style.display="none";

            }
          });

          pswd_eye.addEventListener('click',function(){
            if (password.type === "text") {
                password.type = "password";

                pswd_eye.style.display="none";
                pswd_eye_off.style.display="block";

            }
          });

        </script>

@endsection