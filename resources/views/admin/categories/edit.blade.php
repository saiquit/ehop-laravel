@extends('layouts.backend.app')

@push('css')

@endpush


@section('content')

<form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Edit Category <span><a href="{{ route('admin.category.show', $category->id) }}" class="btn btn-primary">View</a></span></h4>
                            <p class="mb-30">All bootstrap element classies</p>
                        </div>
                    </div>

                    <div class="form-group row @if ($errors->has('title')) has-danger @endif">
                        <label class="col-sm-12 col-md-2 col-form-label"
                            >Category Name</label
                        >
                        <div class="col-sm-12 col-md-10">
                            <input
                                class="form-control @if ($errors->has('title')) form-control-danger @endif"
                                type="text"
                                placeholder="Category Name"
                                name="title"
                                value="{{$category->title}}"
                            />
                            @if($errors->has('title'))
                            <div class="form-control-feedback">{{ $errors->first('title') }}</div>
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
                            <img width="300" width="300" id="blah" src="{{ asset('storage/images/categories/'.$category->image) }}" />
                                @if($errors->has('image'))
                                <div class="form-control-feedback">{{ $errors->first('image') }}</div>
                                @endif
                        </div>
                    </div>
                <div class="form-group @if ($errors->has('description')) has-danger @endif">
                    <div class="html-editor pd-20 card-box mb-30">
                        <h4 class="h4 text-blue">Category Description</h4>
                        <textarea name="description" class="textarea_editor form-control border-radius-0 @if ($errors->has('description')) form-control-danger @endif" placeholder="Enter text ...">{{$category['description']}}</textarea>
                        @if($errors->has('description'))
                            <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
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
