@extends('users.admin.cover')
@section('content')

        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
        </div>  
        
        <br>
        
        <div class="row">
              
            <div class="col-md-3 grid-margin stretch-card">
                <a href="{{ route('create-content')}}"><button class="btn btn-info">Create content</button></a>
            </div>
            <div class="col-md-6 grid-margin stretch-card">

                <!-- </div> -->
              <div class="card">
                <div class="card-body">
                  

                  <h4 class="card-title text-center">All content data</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Image
                          </th>
                          <th>
                            Title
                          </th>
                          <th>
                            Description
                          </th>
                        
                          <!-- <th>
                            Action
                          </th> -->
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($content_data as $data)
                          <tr>
                            <td class="py-1">
                              <img src="{{ URL::to('/') }}/style/images/content/{{ $data->image }}" alt="content's image"/>
                            </td>
                            <td class="py-1">
                              {{ $data->title }}
                            </td>
                            <td class="py-1">
                              {{ $data->discription }}
                            </td>
                            <!-- <td class="py-1">
                              <a href="#id={{ $data->id }}"><i class="mdi mdi-eye"></i></a>
                            </td> -->
                          </tr>
                        @endforeach

                          @if($content_data_count == 0)
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
            <div class="col-md-3 grid-margin stretch-card"></div>
        </div>
@endsection