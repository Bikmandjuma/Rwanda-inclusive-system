@extends('auth.cover')
@section('content')

        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo align-items-center text-center">
                <img src="{{ URL::to('/') }}/style/images/logo.png" alt="logo">
              </div>
              <h6 class="font-weight-light text-center">Forgot password .</h6>
              <form class="pt-3">
                
                <div class="form-group">
                  <input type="email" class="form-control form-control" id="exampleInputEmail1" placeholder="Enter Email" aufocus>
                </div>

                <div class="mt-3 text-center">
                  <button type="submit" class="btn btn-primary btn-md font-weight-medium">Get email</button>
                </div>
                
                <div class="text-center mt-4 font-weight-light">
                  <a href="{{ route('login.form')}}" class="text-primary">Back to login ?</a>
                </div>
              </form>
            </div>

@endsection