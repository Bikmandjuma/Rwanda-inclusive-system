@extends('users.admin.cover')
@section('content')

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                    </div>
                </div>

                <br>

                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                            <div class="card" id="card_id">
                                <div class="card-body">
                                <h4 class="card-title text-center">Add course details</h4>
                                @if($errors->any())
                                    <ul class="alert alert-danger" id="msg_error">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                @endif

                                @if(session('data_added'))
                                    <li class="alert alert-info text-center" id="msg_error">
                                        {{ session('data_added') }}
                                    </li>
                                @endif
                                
                                <form class="forms-sample" action="{{ route('post_course') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Course name</label>
                                    <input type="text" class="form-control" name="course_name" value="{{old('course_name')}}" placeholder="Enter course name">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea type="text" class="form-control" rowspan="10" name="description" placeholder="Enter course . . . "  value="{{old('description')}}"></textarea>
                                    </div>
                                   
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary mr-2">Submit course</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->
                            <div class="col-md-8 grid-margin stretch-card">
                                
                            <div class="card" id="card_id">
                                    <div class="card-body">
                                    

                                    <h4 class="card-title text-center">All courses data</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Course_name
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
                                            @foreach($course_data as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1">
                                                {{ $data->course_name }}
                                                </td>
                                                <td class="py-1" title="{{$data->description}}">
                                                @php
                                                    $descr=strlen($data->description);
                                                    if($descr > 50){
                                                        echo substr($data->description,0,50)." ... ";
                                                    }else{
                                                        echo $data->description;
                                                    }
                                                    
                                                @endphp
                                                </td>
                                                <td class="py-1">
                                                <a href="{{ route('create-module',Crypt::encrypt($data->id)) }}" class="btn btn-info">Add module</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @if($course_data_count == 0)
                                                <tr>
                                                <td colspan="6" class="text-center">No data found in database</td>
                                                </tr> 
                                            @endif
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="text-center float-right">{{ $course_data->links() }}</div>
                                </div>

                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->

                        </div>


            </div>
        </div>

        <script>
            
            setTimeout(() => {
                var error=document.getElementById('msg_error');
                error.style.display="none";
            },5000);
        </script>
@endsection