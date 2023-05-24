@extends('layout.index')
@section('title', 'Product Details')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="">
                <a href="{{route('admin.get.all.products')}}" class="font-18 btn btn-sm btn-secondary"><i class="mdi mdi-arrow-left"></i></a>
                <a href="{{route('admin.edit.product',['id' => encrypt($product_details->id)])}}" class="font-18 btn btn-sm btn-info">Edit Product</a>
            </div>
            <div class="p-4">
                <div class="card blog-post bg-transparent">
                    <div class="post-image">
                        <img src="{{asset($product_details->image)}}" alt="" class="img-fluid mx-auto d-block rounded-top" style="height:300px;object-fit:cover;">
                    </div>

                    <div class="card-body" style="border-top:1px solid #ececec;">
                        <div class="text-muted"><span>Posted on: {{Carbon\Carbon::parse($product_details->created_at)->format('M d, Y')}}</span></div>
                        <div class="post-title">
                            <h5><a href="javascript:void(0);">{{$product_details->title}}</a></h5>
                        </div>
                        <div>
                            {!! $product_details->short_description !!}
                        </div>
                        <div>
                            {!! $product_details->full_description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection