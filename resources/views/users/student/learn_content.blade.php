@extends('users.student.cover')
@section('content')

    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('user')->user()->firstname}} {{ Auth::guard('user')->user()->lastname}}</span></h3>
        </div>
    </div>  
        
        <br>
        
        <div class="row">
              
            <div class="col-md-2 grid-margin stretch-card">
            </div>
            <div class="col-md-8 grid-margin stretch-card">

                <!-- </div> -->
              <div class="card" id="card_id">
                <div class="card-body" >
                  

                  <h4 class="card-title text-center">All content data <span class="badge badge-info float-right">{{ $content_data_count }}</span> </h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          
                          <th>
                            N<sup>o</sup>
                          </th><th>
                            Title
                          </th>
                          <th>
                            Description
                          </th>
                        
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $count=1;
                        @endphp
                        @foreach($content_data as $data)
                          <tr>
                        
                            <td class="py-3">
                              {{ $count++ }}
                            </td>
                            <td class="py-3">
                              {{ $data->title }}
                            </td>
                            <td class="py-1">
                              {{ $data->discription }}
                            </td>
                            <td class="py-1">
                              <a href="{{ URL::to('/') }}/style/images/content/{{ $data->image }}" target="parent">view & Download</a>
                            </td>
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
                 {{ $content_data->links() }}
              </div>

            </div>
            <div class="col-md-2 grid-margin stretch-card"></div>
        </div>
@endsection