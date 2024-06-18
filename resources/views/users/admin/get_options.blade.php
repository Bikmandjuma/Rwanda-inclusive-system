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
                <div class="col-md-4"></div>
                    <div class="col-md-4">
                        @if(session('error_higher_amount'))
                            <li class="alert alert-danger" id="error_msg">{{ session('error_higher_amount') }}</li>
                        @endif

                        @if(session('success'))
                            <li class="alert alert-success" id="error_msg">{{ session('success') }}</li>
                        @endif

                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row" id="marks_div_id">
                <div class="col-md-2"></div>   
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-title text-center">
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('post_option',$question_id)}}" method="POST" id="form_id">
                                @csrf
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" value="{{ $quest_name }}" class="form-control" name="course_name" disabled>
                                </div>

                                <div id="option-fields">
                                    <div class="row control field">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Option_text</label>
                                                <input type="text" class="form-control" name="option_text[]" placeholder="Enter option text">
                                            </div>
                                        </div>   
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Choice</label>
                                                <select class="form-control" name="choice[]">
                                                    <option>Select choice</option>
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-danger remove-option-btn mt-4">X</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" id="add-option" class="btn btn-secondary mt-2">Add Option</button>


                                <br>

                                <div class="text-center">
                                <button type="submit" class="btn btn-primary mr-2">Submit option</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

            </div>
        </div>

        @if($count_option_id != 0)
            <style>
                #form_id{
                    display:none;
                }
            </style>
        @endif
        

        <script>
            setTimeout(() => {
                var msg=document.getElementById('error_msg');
                msg.style.display="none";
            }, 5000);

            document.addEventListener('DOMContentLoaded', function() {
                const addOptionButton = document.getElementById('add-option');
                const optionFields = document.getElementById('option-fields');

                // Function to add remove button functionality
                function addRemoveButtonListener(removeButton) {
                    removeButton.addEventListener('click', function() {
                        removeButton.closest('.control.field').remove();
                    });
                }

                addOptionButton.addEventListener('click', function() {
                    const marksDiv = optionFields.querySelector('.control.field');
                    const newField = marksDiv.cloneNode(true);

                    // Reset the values of the cloned input fields
                    const inputs = newField.getElementsByTagName('input');
                    for (let input of inputs) {
                        input.value = '';
                    }

                    // Append the new field to the optionFields div
                    optionFields.appendChild(newField);

                    // Add remove button functionality to the new field
                    const removeButton = newField.querySelector('.remove-option-btn');
                    addRemoveButtonListener(removeButton);
                });

                // Add remove button functionality to the initial field
                const initialRemoveButton = optionFields.querySelector('.remove-option-btn');
                addRemoveButtonListener(initialRemoveButton);
            });



        </script>

@endsection