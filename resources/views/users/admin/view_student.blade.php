@extends('users.admin.cover')
@section('content')

        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
        </div>  
        
        <br>
        
        <div class="row">
         
            <div class="col-md-12 grid-margin stretch-card">

                <!-- </div> -->
              <div class="card" id="card_id">
                <div class="card-body" >
                  

                  <h4 class="card-title text-center">All students data &nbsp; <span class="badge badge-info float-right" style="margin-top:-10px;">{{ $student_list_count }}</span> </h4>
                  <div class="table-responsive">
                    <table class="table table-striped text-center">
                      <thead>
                        <tr>
                          <th>
                            Image
                          </th>
                          <th>
                            Firstname
                          </th>
                          <th>
                            Lastname
                          </th>
                          <th>
                            Gender
                          </th>
                          <th>
                            Phone
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Province
                          </th>
                          <th>
                            District
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($student_list as $data)
                          <tr>
                            <td class="py-1">
                              <img src="{{ URL::to('/') }}/style/images/user/{{ $data->image }}" alt="content's image" style="border:1px solid grey;" />
                            </td>
                            <td class="py-1">
                              {{ $data->firstname }}
                            </td>
                            <td class="py-1">
                              {{ $data->lastname }}
                            </td>
                            <td class="py-1">
                              {{ $data->gender }}
                            </td>
                            <td class="py-1">
                              {{ $data->phone }}
                            </td>
                            <td class="py-1">
                              {{ $data->email }}
                            </td>
                            <td class="py-1">
                              {{ $data->province }}
                            </td>
                            <td class="py-1">
                              {{ $data->district }}
                            </td>
                            <td class="py-1">
                              <a href="#id={{ $data->id }}" download class="btn btn-info">Result</a>
                            </td>
                          </tr>
                        @endforeach

                          @if($student_list_count == 0)
                            <tr>
                              <td colspan="9" class="text-center">No data found in database</td>
                            </tr> 
                          @endif
                      </tbody>
                    </table>
                  </div>

                  

                </div>
                
                <div class="text-center float-center" style="flex-column:center;justify-content-center;">{{ $student_list->links() }}</div>
             
            </div>

              

            </div>
        </div>
@endsection