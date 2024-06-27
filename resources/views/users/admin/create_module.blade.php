@extends('users.admin.cover')
@section('content')

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                    </div>
                </div>

                <br>

                        <div class="row">
                            <div class="col-md-4 grid-margin stretch-card">
                            <div class="card" id="card_id">
                                <div class="card-body">
                                <h4 class="card-title text-center">Add module details</h4>
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
                                
                                <form class="forms-sample" action="{{ route('post_module',$course_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Course name</label>
                                    <input type="text" class="form-control" name="course_id" value="{{ $course_og_name }}" placeholder="Enter course name" disabled>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Module name</label>
                                    <input type="text" class="form-control" name="module_name" value="{{ old('module_name') }}" placeholder="Enter module name">
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Module content</label>
                                    <textarea type="text" class="form-control" rowspan="10" name="module_content" placeholder="Enter module content . . . "  value="{{old('module_content')}}"></textarea>
                                    </div>
                                   
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary mr-2">Submit module</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->
                            <div class="col-md-8 grid-margin stretch-card">
                                
                            <div class="card" id="card_id">
                                    <div class="card-body">
                                    

                                    <h4 class="card-title text-center">All module data</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Module_name
                                            </th>
                                            <th>
                                                Module_content
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
                                            @foreach($module_data as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1">
                                                {{ $data->module_name }}
                                                </td>
                                                <td class="py-1" title="{{ $data->content }}">
                                                @php
                                                    $descr=strlen($data->content);
                                                    if($descr > 30){
                                                        echo substr($data->content,0,30)." ... ";
                                                    }else{
                                                        echo $data->content;
                                                    }
                                                    
                                                @endphp
                                                </td>
                                                <td class="py-1">
                                                <a href="{{ route('create-lesson',Crypt::encrypt($data->id)) }}" class="btn btn-info">Add & view lesson</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @if($module_data_count == 0)
                                                <tr>
                                                <td colspan="6" class="text-center">No data of module found in database</td>
                                                </tr> 
                                            @endif
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="text-center float-right">{{ $module_data->links() }}</div>
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