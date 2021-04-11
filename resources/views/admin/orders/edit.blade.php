@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endpush


@section('content')

<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Add Product</h4>
                            <p class="mb-30">All bootstrap element classies</p>
                        </div>
                    </div>

                    <div class="form-group row @if ($errors->has('title')) has-danger @endif">
                        <label class="col-sm-12 col-md-2 col-form-label"
                            >Product Name</label
                        >
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control @if ($errors->has('title')) form-control-danger @endif"
                                type="text"
                                placeholder="Product Name"
                                name="title"
                                value="{{$product['title']}}"
                            />
                            @if($errors->has('title'))
                            <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row @if ($errors->has('price')) has-danger @endif">
                        <label class="col-sm-12 col-md-2 col-form-label"
                            >Price</label
                        >
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control @if ($errors->has('price')) form-control-danger @endif"
                                type="text"
                                placeholder="Product Price"
                                name="price"
                                value="{{$product['price']}}"
                            />
                        @if($errors->has('price'))
                            <div class="form-control-feedback">{{ $errors->first('price') }}</div>
                        @endif
                        </div>
                    </div>

                    <div class="form-group row @if ($errors->has('stock')) has-danger @endif">
                        <label class="col-sm-12 col-md-2 col-form-label"
                            >Product Initial Stock</label
                        >
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control @if ($errors->has('stock')) form-control-danger @endif"
                                type="text"
                                placeholder="Initial Stock"
                                name="stock"
                                value="{{$product['stock']}}"
                            />
                            @if($errors->has('stock'))
                            <div class="form-control-feedback">{{ $errors->first('stock') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix mb-20">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Main Image</h4>
                            </div>
                        </div>
                        <div class="fallback @if ($errors->has('image')) form-control-danger @endif">
                            <input type="file" name="image" id="imgInp" />
                            <img width="300" width="300" id="blah" src="{{ asset('storage/images/products/'.$product->image) }}" />
                                @if($errors->has('image'))
                                <div class="form-control-feedback">{{ $errors->first('image') }}</div>
                                @endif
                        </div>
                    </div>
                <div class="form-group @if ($errors->has('description')) has-danger @endif">
                    <div class="html-editor pd-20 card-box mb-30">
                        <h4 class="h4 text-blue">Product Description</h4>
                        <textarea name="description" class="textarea_editor form-control border-radius-0 @if ($errors->has('description')) form-control-danger @endif" placeholder="Enter text ...">{{$product['description']}}</textarea>
                        @if($errors->has('description'))
                            <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                <div class="pd-20 card-box mb-30">
                        <div class="clearfix mb-20">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Colors</h4>
                            </div>
                        </div>
                       <div class="mb-30 form-group">
						    <input value="@foreach($product->attributes as $attr)@if($attr->code=='color'){{$attr->value.','}}@endif @endforeach" class="form-control" name="colors" type="text" data-role="tagsinput" placeholder="Type Color Name">
						</div>
                    </div>

                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix mb-20">
                            <div class="pull-left">
                                <h4 class="text-blue h4">Sizes</h4>
                            </div>
                        </div>
                       <div class="mb-30 form-group">
						    <input class="form-control" value="@foreach($product->attributes as $attr)@if($attr->code=='size'){{$attr->value.','}}@endif @endforeach" name="sizes" type="text" data-role="tagsinput" placeholder="Type Size Name">
						</div>
                    </div>
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Categories</h4>
                            <p class="mb-30">Select Category</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select class="custom-select2 form-control" multiple="multiple" name="categories[]" style="width: 100%;">
                            @foreach ($categories as $category)
                                <option
                                 @foreach ($product->category as $cat)
                                     {{$cat->id == $category->id ? 'selected': ''}}
                                 @endforeach
                                value={{$category->id}}>{{$category['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection @push('js')
<script src="{{ asset('assets/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#blah").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });
</script>
@endpush
