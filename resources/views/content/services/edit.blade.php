@extends('layout.index')
@section('title', 'Edit Service')
@section('content')
    <form id="editServiceForm">
        @csrf

        <input type="hidden" name="id" value="{{encrypt($service_details->id)}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="e.g. Web Development" value="{{$service_details->title}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-3" class="control-label">Service Image</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <input type="file" name="serviceImage" id="serviceImage" class="dropify" data-height="300"  data-max-file-size="1M" data-show-errors="true" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{asset($service_details->image)}}"/>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-2" class="control-label">Short Description</label>
                    <div>
                        <textarea id="shortDescription" name="shortDescription" placeholder="Enter Your short description Here..." maxlength="200">{!! $service_details->short_description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-2" class="control-label">Full Description</label>
                    <div>
                        <textarea id="longDescription" name="longDescription" placeholder="Enter Your long description Here...">{!! $service_details->full_description !!}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Service Staus</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>
                            @if ($service_details->status === 1)
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
            <a href="{{route('admin.get.all.services')}}" class="btn btn-secondary waves-effect">Close</a>
            <button type="submit" class="btn btn-info waves-effect waves-light" id="serviceSubmitBtn">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('textarea#shortDescription').tinymce({ 
            height: 400, 
            toolbar: 'undo redo | blocks | ' +
                'bold italic  | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat', 
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }' 
        });

        $('textarea#longDescription').tinymce({ 
            height: 400, 
            toolbar: 'undo redo | blocks | ' +
                'bold italic  | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat', 
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }' 
        });


        $('#editServiceForm').on('submit', function(e){
            e.preventDefault();

            $('#serviceSubmitBtn').attr('disabled', true)
            $('#serviceSubmitBtn').text('Please wait...')

            let form_data = new FormData(this);

            const short_content = $('textarea#shortDescription').val();
            const long_content = $('textarea#longDescription').val();

            // console.log(form_data)

            form_data.append('shortDescription',short_content );
            form_data.append('longDescription',long_content );


            $.ajax({
                url: "{{route('admin.save.edit.service')}}",
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
                        $('#serviceSubmitBtn').attr('disabled', false)
                        $('#serviceSubmitBtn').text('Submit')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message
                        });

                        $('#serviceSubmitBtn').attr('disabled', false)
                        $('#serviceSubmitBtn').text('Submit')
                    }
                },
                error: function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });

                    $('#serviceSubmitBtn').attr('disabled', false)
                    $('#serviceSubmitBtn').text('Submit')
                }

            });
        });
    </script>
@endsection