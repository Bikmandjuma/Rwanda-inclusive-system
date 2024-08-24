@extends('auth.cover')
@section('content')
  <div class="row w-100 mx-0">
      <div class="col-lg-4 mx-auto">

        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center text-center">
                <!-- <img src="{{ URL::to('/') }}/style/images/logo.png" alt="logo"> -->
                <img class="img-fluid p-1" src="{{ URL::to('/') }}/homePage/img/logo.jpeg" alt="" width="200" height="40"> 

              </div>
              <h6 class="font-weight-light text-center">Forgot password .</h6>
              <form class="pt-3" method="POST" action="{{ route('submit.forgot.password') }}">
                @csrf
                @if ($errors->any())
                    <!-- <div > -->
                        <ul class="alert alert-danger text-center" id="disable_message">
                            @foreach ($errors->all() as $error)
                                <li style='list-style-type: none;'>{{ $error }}</li>
                            @endforeach
                        </ul>
                    <!-- </div> -->
                @endif

                @if(session('message_sent'))
                    <ul class="alert alert-info text-center" id="disable_message">
                        <li style='list-style-type: none;'>{{ session('message_sent') }}</li>
                    </ul>
                @endif

                <div class="form-group">
                  <input type="email" class="form-control form-control" id="exampleInputEmail1" placeholder="Enter Email" name="email" aufocus>
                </div>

                <div class="mt-3 text-center">
                  <button type="submit" class="btn btn-primary btn-md font-weight-medium">Get email</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  <a href="{{ route('login.form')}}" class="text-primary">Back to login ?</a>
                </div>
              </form>
            </div>  
      </div>
  </div>

@endsection