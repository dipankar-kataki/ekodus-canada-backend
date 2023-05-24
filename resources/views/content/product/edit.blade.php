@extends('layout.index')
@section('title', 'Edit Product')
@section('content')
    <form id="editProductForm">
        @csrf

        <input type="hidden" name="id" value="{{encrypt($product_details->id)}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="e.g. Web Development" value="{{$product_details->title}}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-3" class="control-label">Product Image</label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <input type="file" name="productImage" id="productImage" class="dropify" data-height="300"  data-max-file-size="1M" data-show-errors="true" data-allowed-file-extensions="png jpg jpeg" data-default-file="{{asset($product_details->image)}}"/>
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
                        <textarea id="shortDescription" name="shortDescription" placeholder="Enter Your short description Here..." maxlength="200">{!! $product_details->short_description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-2" class="control-label">Full Description</label>
                    <div>
                        <textarea id="longDescription" name="longDescription" placeholder="Enter Your long description Here...">{!! $product_details->full_description !!}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Product Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="{{$product_details->status}}" selected>
                            @if ($product_details->status === 1)
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
            <button type="submit" class="btn btn-info waves-effect waves-light" id="productSubmitBtn">Submit</button>
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


        $('#editProductForm').on('submit', function(e){
            e.preventDefault();

            $('#productSubmitBtn').attr('disabled', true)
            $('#productSubmitBtn').text('Please wait...')

            let form_data = new FormData(this);

            const short_content = $('textarea#shortDescription').val();
            const long_content = $('textarea#longDescription').val();

            // console.log(form_data)

            form_data.append('shortDescription',short_content );
            form_data.append('longDescription',long_content );


            $.ajax({
                url: "{{route('admin.save.edit.product')}}",
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
                        $('#productSubmitBtn').attr('disabled', false)
                        $('#productSubmitBtn').text('Submit')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message
                        });

                        $('#productSubmitBtn').attr('disabled', false)
                        $('#productSubmitBtn').text('Submit')
                    }
                },
                error: function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });

                    $('#productSubmitBtn').attr('disabled', false)
                    $('#productSubmitBtn').text('Submit')
                }

            });
        });
    </script>
@endsection