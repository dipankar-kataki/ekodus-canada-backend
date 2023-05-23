@extends('layout.index')
@section('title', 'Blog Details')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="">
                <a href="{{route('admin.view.blog')}}" class="font-18 btn btn-sm btn-secondary"><i class="mdi mdi-arrow-left"></i></a>
                <a href="{{route('admin.view.blog',['id' => encrypt($blog_details->id)])}}" class="font-18 btn btn-sm btn-info">Edit Blog</a>
            </div>
            <div class="p-4">
                <div class="card blog-post bg-transparent">
                    <div class="post-image">
                        <img src="{{asset($blog_details->image)}}" alt="" class="img-fluid mx-auto d-block rounded-top" style="height:300px;object-fit:cover;">
                    </div>

                    <div class="card-body" style="border-top:1px solid #ececec;">
                        <div class="text-muted"><span>Posted on: {{Carbon\Carbon::parse($blog_details->created_at)->format('M d, Y')}}</span></div>
                        <div class="post-title">
                            <h5><a href="javascript:void(0);">{{$blog_details->title}}</a></h5>
                        </div>
                        <div>
                            {!! $blog_details->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection