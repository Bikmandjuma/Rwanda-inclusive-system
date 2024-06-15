@extends('users.student.cover')
@section('content')

        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
                </div>
                

              </div>
            </div>
          </div>
          
              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:green;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All users</p>
                      <p class="fs-30 mb-2">{{ $users_numbers }}</p>
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:darkblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All contents</p>
                      <p class="fs-30 mb-2">{{ $Content_numbers }}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:black;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All exams</p>
                      <p class="fs-30 mb-2">{{ $Exam_numbers }}</p>
                    </div>
                  </div>
                </div>

              </div>
              <br>
              <div class="row">
                
                <div class="col-md-4 stretch-card transparent">
                  <div class="card" style="background-color:orange;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All certificate</p>
                      <p class="fs-30 mb-2">{{ $Certificate_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              
                <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:skyblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All courses</p>
                      <p class="fs-30 mb-2">{{ $Course_numbers }}</p>
                      <!-- <p>2.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4 stretch-card transparent">
                  <div class="card" style="background-color:teal;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All resuslt</p>
                      <p class="fs-30 mb-2">{{ $Result_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>

              </div>
         
          
          
@endsection