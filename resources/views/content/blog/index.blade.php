@extends('layout.index')
@section('title', 'Blogs')
@section('content')

    <div class="d-flex flex-row justify-content-end">
        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#createBlog">Create Blog</button>
    </div>
    <div class="port mb-3">
        <div class="portfolioContainer row">
            <div class="col-md-4 col-xl-4">
                <div class="gallery-box">
                    <a href="#" class="image-popup">
                        <img src="{{asset('assets/images/small/img-1.jpg')}}" class="thumb-img img-fluid" alt="work-thumbnail">
                    </a>
                    <div class="gal-detail p-3">
                        <div class="d-flex flex-row justify-content-between">
                            <h4 class="font-16 mt-0">Nature Image</h4>
                            
                            <div>
                                <input type="checkbox" id="switch1" checked data-switch="none" />
                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                            </div>
                        </div>
                        <p class="text-muted mb-0">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates, illo, iste itaque voluptas corrupti ratione reprehenderit magni similique.
                        </p>

                        <button class="btn btn-sm btn-secondary waves-effect width-md waves-light mt-2 mb-3 float-right">Read More</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="createBlog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Create Your Awesome Blog</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="e.g. How to create wealth..">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Blog Image</label>
                                <input type="file" class="form-control" id="blogImage" name="blogImage">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Content</label>
                                <div>
                                    <textarea id="blogContent" placeholder="Enter Your Content Here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info waves-effect waves-light" id="blogSubmitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

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

        $('#blogSubmitBtn').on('click', function(e){
            e.preventDefault();

            let blog_content = $('textarea#blogContent').val();
            console.log('blog_content -->', blog_content)
        });
            
    </script>
@endsection