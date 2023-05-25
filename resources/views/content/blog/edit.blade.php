@extends('layout.index')
@section('title', 'Edit Blog')
@section('content')
    <form id="editBlogForm">
        @csrf

        <input type="hidden" name="id" value="{{encrypt($blog_details->id)}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" value="{{$blog_details->title}}" placeholder="e.g. How to create wealth..">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-3" class="control-label">Blog Image</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <input type="file" name="blogImage" id="blogImage" class="dropify" data-height="300"  data-max-file-size="1M" data-show-errors="true" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{asset($blog_details->image)}}"/>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-2" class="control-label">Content</label>
                    <div>
                        <textarea id="blogContent" name="blogContent" placeholder="Enter Your Content Here...">{!! $blog_details->content !!}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{route('admin.view.blog')}}" class="btn btn-secondary waves-effect">Close</a>
            <button type="submit" class="btn btn-info waves-effect waves-light" id="blogSubmitBtn">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('textarea#blogContent').tinymce({ 
            height: 400, 
            toolbar: 'undo redo | blocks | ' +
                'bold italic  | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat', 
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }' 
        });


        $('#editBlogForm').on('submit', function(e){
            e.preventDefault();

            $('#blogSubmitBtn').attr('disabled', true)
            $('#blogSubmitBtn').text('Please wait...')

            const form_data = new FormData(this);

            const blog_content = $('textarea#blogContent').val();

            form_data.append('blogContent',blog_content );



            $.ajax({
                url: "{{route('admin.edit.blog')}}",
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

                        $('#blogSubmitBtn').attr('disabled', false)
                        $('#blogSubmitBtn').text('Submit')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message
                        });

                        $('#blogSubmitBtn').attr('disabled', false)
                        $('#blogSubmitBtn').text('Submit')
                    }
                },
                error: function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });

                    $('#blogSubmitBtn').attr('disabled', false)
                    $('#blogSubmitBtn').text('Submit')
                }

            });
        });
    </script>
@endsection