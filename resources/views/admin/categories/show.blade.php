@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <h4 class="mb-20 pt-20">{{ ucfirst($category->title) }} <span><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">Edit</a></span> </h4>
                            <img src="{{ asset('storage/images/categories/' . $category->image) }}" alt="">
                            <p>{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection @push('js') @endpush
