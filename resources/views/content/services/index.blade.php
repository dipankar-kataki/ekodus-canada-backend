@extends('layout.index')
@section('title', 'All Services')
@section('content')
    <div class="d-flex flex-row justify-content-end">
        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#createService">Create Service</button>
    </div>

    <div class="row">
        @forelse ($services as $item)
            <div class="col-md-4 col-xl-4">

                <div class="card blog-post">
                    <div class="card-header">
                        <img src="{{asset($item->image)}}" alt="" class="img-fluid mx-auto d-block" style="height:300px;object-fit:cover;">
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <span>Posted on: <span>{{Carbon\Carbon::parse($item->created_at)->format('M d, Y')}}</span>
                            </div>
                            <div>
                                @if ($item->status === 1)
                                <p class="text-success">Active</p>
                                @else
                                    <p class="text-danger">De-Active</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-title">
                            <h5><a href="javascript:void(0);">{!! Str::limit($item->title, 35)  !!}</a></h5>
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                            <a href="{{route('admin.edit.service', ['id' => encrypt($item->id) ])}}" class="btn btn-md btn-purple card-link  pa-2">Edit</a>
                            <a href="{{route('admin.service.details', ['id' => encrypt($item->id)] )}}" class="btn btn-md btn-success card-link pa-2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <h6>No Service To Show :(</h6>
            </div>
        @endforelse
    </div>

    <div id="createService" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Create A Service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createServiceForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="e.g. Web Development">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Service Image</label>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div>
                                                <input type="file" name="serviceImage" id="serviceImage" class="dropify" data-height="300"  data-max-file-size="1M" data-show-errors="true" data-allowed-file-extensions="png jpg jpeg"/>
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
                                        <textarea id="shortDescription" name="shortDescription" placeholder="Enter Your short description Here..." maxlength="200"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Full Description</label>
                                    <div>
                                        <textarea id="longDescription" name="longDescription" placeholder="Enter Your long description Here..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light" id="serviceSubmitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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


        $('#createServiceForm').on('submit', function(e){
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
                url: "{{route('admin.create.service')}}",
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data){

                    if(data.status === 1){
                        $('#serviceSubmitBtn').attr('disabled', false)
                        $('#serviceSubmitBtn').text('Submit')
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

        })
    </script>

    <script>
         $('.changeStatus').on('click', function(){
          
          const id = $(this).data('id');
          const status = $(this).data('status')


          $.ajax({
              url:"{{route('admin.service.change.status')}}",
              type:"POST",
              data:{
                  id: id,
                  status: status,
                  '_token': "{{csrf_token()}}"
              },
              success:function(data){

                  if(data.status === 1){
                      Swal.fire({
                          icon: 'success',
                          title: 'Great!',
                          text: data.message,
                      })

                      location.reload(true)
                  }else{
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops!',
                          text: data.message,
                      })
                  }
                  
              }, error:function(error){
                  console.log(error)
              }
          })
      })
    </script>
@endsection