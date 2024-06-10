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
                                    

                                    <h4 class="card-title text-center">All course data</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>
                                                N<sup>o</sup>
                                            </th>
                                            <th>
                                                Course_name
                                            </th>
                                            <th>
                                                Module_name
                                            </th>
                                            
                                            <th>
                                                Lesson_name
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
                                            @foreach($data as $data)
                                            <tr>
                                                <td class="py-1">
                                                    {{ $count++ }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->course_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->module_name }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $data->lesson_name }}
                                                </td>
                                                <td class="py-1">
                                                <a href="" class="btn btn-info">View data</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="col-md-1 grid-margin stretch-card"></div> -->

                        </div>


            </div>
        </div>

@endsection