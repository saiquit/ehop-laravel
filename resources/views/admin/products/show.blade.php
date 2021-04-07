@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <h4 class="mb-20 pt-20">{{ ucfirst($product->title) }}</h4>
                            <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="">
                            <p>{{ $product->description }}</p>
                            <div class="price">
                                Price <ins>${{ $product->price }}</ins>
                            </div>
                            <div class="price">
                                Stock <ins>${{ $product->stock }}</ins>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Categories</h4>
                            <p class="mb-30">Select Category</p>
                        </div>
                    </div>

                    <ul class="list-group">
                        @foreach ($product->category as $category)
                            <li class="list-group-item">
                                <span class="badge">{{ $category->products->count() }}</span>
                                {{ ucfirst($category->title) }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
    @endsection @push('js') @endpush
