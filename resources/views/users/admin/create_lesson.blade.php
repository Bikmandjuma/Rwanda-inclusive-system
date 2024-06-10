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

                        
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->
                            <div class="col-md-12 grid-margin stretch-card">
                                
                            <div class="card">
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
                                                Course
                                            </th>
                                            <th>
                                                Module
                                            </th>
                                            
                                            <th>
                                                Lesson
                                            </th>

                                            <th>
                                                View
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
                                                    ....                            
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