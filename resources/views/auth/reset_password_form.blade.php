@extends('auth.cover')

@section('content')
    <div class="container mt-5" id="FormId">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card" style="box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2);">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid p-1" src="{{ URL::to('/') }}/homePage/img/logo.jpeg" alt="" width="150" height="40">
                        </div>
                        <h5 class="card-title text-center mt-3">Reset password here !</h5>
                        @if(session('valid_code'))
                            <script type="text/javascript">
                                setTimeout(function(){
                                    window.location.href = "{{ url('reset/password/') }}/{{ Crypt::encrypt($email) }}/{{ Crypt::encrypt($code) }}";
                                    document.getElementById('spin_id').style.display = "block";
                                }, 5000);
                            </script>
                        @endif
                        <!-- No Labels Form -->
                        <form class="row g-3" action="{{ url('submit/reset/password/') }}/{{$email}}/{{$code}}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label>New password</label>    
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter new-password">
                                @error('password')
                                    <p style="color:Red;">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <label class="mt-3">Repeat new-password</label>    
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter repeat new-password">
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary mt-3">Confirm&nbsp;<i class="fa fa-check"></i></button>
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
            <div class="col-lg-4 col-md-4 col-sm-4"></div>
        </div>
    </div>
@endsection
