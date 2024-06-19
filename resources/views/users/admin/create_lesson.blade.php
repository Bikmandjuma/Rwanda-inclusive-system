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
                                <h4 class="card-title text-center">Add lesson details</h4>
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
                                
                                <form class="forms-sample" action="{{ route('post_lesson',$module_id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Module name</label>
                                        <input type="text" class="form-control" name="module_id" value="{{ $module_og_name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lesson name</label>
                                        <input type="text" class="form-control" name="lesson_name" value="{{ old('lesson_name') }}" placeholder="Enter lesson name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Lesson content</label>
                                        <textarea type="text" class="form-control" rowspan="10" name="lesson_content" placeholder="Enter lesson content . . . "  value="{{old('lesson_content')}}"></textarea>
                                    </div>
                                   
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mr-2">Submit lesson</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->
                            <div class="col-md-8 grid-margin stretch-card">
                                
                            <div class="card" id="card_id">
                                    <div class="card-body">
                                    

                                    <h4 class="card-title text-center">All lesson data</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Lesson_name
                                            </th>
                                            <th>
                                                Lesson_content
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
                                            @foreach($lesson_data as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1">
                                                {{ $data->lesson_name }}
                                                </td>
                                                <td class="py-1">
                                                @php
                                                    $descr=strlen($data->content);
                                                    if($descr > 50){
                                                        echo substr($data->content,0,50)." ... ";
                                                    }else{
                                                        echo $data->content;
                                                    }
                                                    
                                                @endphp
                                                </td>
                                                <td class="py-1">
                                                <a href="{{ route('get_all_courses',Crypt::encrypt($data->id)) }}" class="btn btn-info">View data</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @if($lesson_data_count == 0)
                                                <tr>
                                                <td colspan="6" class="text-center">No data of lesson found in database</td>
                                                </tr> 
                                            @endif
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <div class="text-center float-right">{{ $lesson_data->links() }}</div>
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