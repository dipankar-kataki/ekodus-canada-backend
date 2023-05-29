@extends('layout.index')
@section('title', 'All Openings')
@section('content')
    <div class="d-flex flew-row justify-content-end mb-4">
        <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#createOpening">Create Opening</button>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title mb-4"><b>Active Openings</b></h4>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Location</th>
                            <th>Experience</th>
                            <th>Job Shift</th>
                            <th>Posted On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($active_openings as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->job_title}}</td>
                                <td>{!! Str::limit($item->job_description, 20) !!}</td>
                                <td>{{$item->job_location}}</td>
                                <td>{{$item->job_experience}}</td>
                                <td>{{$item->job_shift}}</td>
                                <td>{{Carbon\Carbon::parse($item->created_at)->format('M d, Y')}}</td>
                                <td>
                                    <strong class="text-success">Active</strong>
                                </td>
                                <td>
                                    <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                      <i class="mdi mdi-menu"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{route('admin.view.opening', ['id' => encrypt($item->id) ])}}">Edit</a>
                                      <a class="dropdown-item" href="#" id="changeStatus" data-id="{{ encrypt($item->id) }}" data-status="0">Change Status</a>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No Active Opening.</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive" style="background-color:#eeeeee;">
                <h4 class="header-title mb-4"><b>De-Active Openings</b></h4>
                <table id="deActiveOpeningsTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Location</th>
                            <th>Experience</th>
                            <th>Job Shift</th>
                            <th>Posted On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deactive_openings as $key=> $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->job_title}}</td>
                                <td>{!! Str::limit($item->job_description, 20) !!}</td>
                                <td>{{$item->job_location}}</td>
                                <td>{{$item->job_experience}}</td>
                                <td>{{$item->job_shift}}</td>
                                <td>{{Carbon\Carbon::parse($item->created_at)->format('M d, Y')}}</td>
                                <td>
                                    <strong class="text-danger">De-Active</strong>
                                </td>
                                <td>
                                    <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                      <i class="mdi mdi-menu"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{route('admin.view.opening', ['id' => encrypt($item->id) ])}}">Edit</a>
                                      <a class="dropdown-item" href="#" id="changeStatus" data-id="{{ encrypt($item->id) }}" data-status="1">Change Status</a>
                                    </div>
                                  </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No De Active Opening.</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="createOpening" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">Create Opening</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createOpeningForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Job Title</label>
                                    <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="e.g. Frontend Developer">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Job Location</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="e.g. Canada">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Job Experience In Years</label>
                                    <input type="number" class="form-control" id="experience" name="experience" placeholder="e.g. 4">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Job Shift</label>
                                    <select name="shift" class="form-control" id="shift">
                                        <option value="">- Select Shift -</option>
                                        <option value="Full-time">Full Time</option>
                                        <option value="Part-time">Part Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Job Description</label>
                                    <div>
                                        <textarea id="jobDescription" name="jobDescription" placeholder="Enter Your Content Here..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light" id="openingSubmitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
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

        $('#deActiveOpeningsTable').DataTable();


        
    </script>


    <script>

        $('#createOpeningForm').on('submit', function(e){

            e.preventDefault();

            $('#openingSubmitBtn').attr('disabled', true)
            $('#openingSubmitBtn').text('Please wait...')

            const form_data = new FormData(this);

            const job_description = $('textarea#jobDescription').val();

            form_data.append('jobDescription', job_description );



            $.ajax({
                url: "{{route('admin.create.openings')}}",
                type: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: function(data){

                    if(data.status === 1){
                        $('#openingSubmitBtn').attr('disabled', false)
                        $('#openingSubmitBtn').text('Submit')
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

                        $('#openingSubmitBtn').attr('disabled', false)
                        $('#openingSubmitBtn').text('Submit')
                    }
                },
                error: function(e){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message
                    });

                    $('#openingSubmitBtn').attr('disabled', false)
                    $('#openingSubmitBtn').text('Submit')
                }

            });
        });

        $('#changeStatus').on('click', function(){
          
            const id = $(this).data('id');
            const status = $(this).data('status')


            $.ajax({
                url:"{{route('admin.change.status')}}",
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