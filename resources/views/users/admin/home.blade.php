@extends('users.admin.cover')
@section('content')

        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-format-list-bulleted-type mt-4"></i> &nbsp;Other stuff
                    </button>
                    
                    <div class="dropdown-menu dropdown-menu-right icons" aria-labelledby="dropdownMenuDate2">
                      <table>
                        <tr>
                          <td>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-bullseye text-primary"></i>&nbsp;All views</a>
                          </td>
                          <td style="padding-right:10px;">
                            <span class="badge badge-info">0</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-eye text-primary"></i>&nbsp;Daily views</a>
                          </td>
                          <td style="padding-right:10px;">
                            <span class="badge badge-info">0</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-thumb-up text-primary"></i>&nbsp;Darsa's likes</a>
                          </td>
                          <td style="padding-right:10px;">
                            <span class="badge badge-info">3k</span>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-comment text-primary"></i>&nbsp;All Comments</a>
                          </td>
                          <td style="padding-right:10px;">
                            <span class="badge badge-info">2m</span>
                          </td>
                        </tr>
                    
                      </table>
                    </div>
                  </div>
                 </div>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" id="card_id">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">View analytics</p>
                 </div>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
            
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:green;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All users</p>
                      <p class="fs-30 mb-2">{{ $users_numbers }}</p>
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:darkblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All contents</p>
                      <p class="fs-30 mb-2">{{ $Content_numbers }}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:black;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All exams</p>
                      <p class="fs-30 mb-2">{{ $Exam_numbers }}</p>
                      <!-- <p>2.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card" style="background-color:orange;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All certificate</p>
                      <p class="fs-30 mb-2">{{ $Certificate_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:skyblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All courses</p>
                      <p class="fs-30 mb-2">{{ $Course_numbers }}</p>
                      <!-- <p>2.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card" style="background-color:teal;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All resuslt</p>
                      <p class="fs-30 mb-2">{{ $Result_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
@endsection