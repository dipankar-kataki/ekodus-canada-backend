@extends('layout.index')
@section('title', 'All Candidates')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="candidateTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Resume</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($list_of_candidates as $key=> $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->phone}}</td>
                                <td><a href="{{asset($item->resume)}}" target="_blank">Download</a></td>
                                <td>{{Carbon\Carbon::parse($item->created_at)->format('M d, Y')}}</td>
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="mdi mdi-menu"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" id="changeStatus" data-id="{{ encrypt($item->id) }}" data-status="1">Change Status</a>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td>No Candidates Found :(</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#candidateTable').DataTable();
    </script>
@endsection