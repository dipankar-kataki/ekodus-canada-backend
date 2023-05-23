@extends('layout.index')
@section('title', 'Job Details')
@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editOpeningForm">
                @csrf
                <input type="hidden" name="id" value="{{ encrypt($career_details->id)}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Job Title</label>
                            <input type="text" class="form-control" id="title" name="title" maxlength="100" value="{{$career_details->job_title}}" placeholder="e.g. Frontend Developer">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Job Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{$career_details->job_location}}" placeholder="e.g. India">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Job Experience In Years</label>
                            <input type="number" class="form-control" id="experience" name="experience" value="{{$career_details->job_experience}}" placeholder="e.g. 4">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Job Shift</label>
                            <select name="shift" class="form-control" id="shift">
                                <option value="{{$career_details->job_shift}}" selected disabled>{{$career_details->job_shift}}</option>
                                <option value="Full-time">Full Time</option>
                                <option value="Part-time">Part Time</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-2" class="control-label">Job Description</label>
                            <div>
                                <textarea id="jobDescription" name="jobDescription" placeholder="Enter Your Content Here...">{!! $career_details->job_description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Job Staus</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled>
                                    @if ($career_details->status === 1)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">De-Active</span>
                                    @endif
                                </option>
                                <option value="1" class="text-success">Active</option>
                                <option value="0" class="text-danger">De-Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('admin.view.all.openings')}}" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-info waves-effect waves-light" id="editSubmitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('textarea#jobDescription').tinymce({ 
            height: 400, 
            toolbar: 'undo redo | blocks | ' +
                'bold italic  | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat', 
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }' 
        });


        $('#editOpeningForm').on('submit', function(e){

            e.preventDefault();

            $('#editSubmitBtn').attr('disabled', true)
            $('#editSubmitBtn').text('Please wait...')

            const form_data = new FormData(this);

            const job_description = $('textarea#jobDescription').val();

            form_data.append('jobDescription', job_description );



            $.ajax({
                url: "{{route('admin.edit.opening')}}",
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data){

                    if(data.status === 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Great!',
                            text: data.message,
                            confirmButtonText: 'Close',
                        })

                        location.reload('true')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message
                        });

                        $('#editSubmitBtn').attr('disabled', false)
                        $('#editSubmitBtn').text('Submit')
                    }
                },
                error: function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });

                    $('#editSubmitBtn').attr('disabled', false)
                    $('#editSubmitBtn').text('Submit')
                }

            });
        });
    </script>
@endsection