@extends('layouts.backend.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endpush
@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
<div class="card-box mb-30">
<div class="pd-20">
    <h4 class="text-blue h4">All Categories ({{$categories->count()}})</h4>
</div>
<div class="pb-20">
    <table class="table hover multiple-select-row data-table-export nowrap">
        <thead>
            <tr>
                <th class="table-plus datatable-nosort">Name</th>
                <th>Product Count</th>
                <th>Start Date</th>
                <th>Update Date</th>
                <th class="datatable-nosort">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td class="table-plus">{{$category['title']}}</td>
                <td>{{$category->products->count()}}</td>
                <td>{{$category['created_at']}}</td>
                <td>{{$category['updated_at']}}</td>
                <td>
                    <div class="dropdown">
                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <i class="dw dw-more"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <a class="dropdown-item" href="{{ route('admin.category.show',  $category->id) }}"><i class="dw dw-eye"></i> View</a>
                            <a class="dropdown-item" href="{{ route('admin.category.edit',  $category->id) }}"><i class="dw dw-edit2"></i> Edit</a>
                            <a class="dropdown-item" onclick="document.getElementById('delete-form-{{$category->id}}').submit()" href="javascript:;"><i class="dw dw-delete-3"></i> Delete</a>
                            <form hidden action="{{ route('admin.category.destroy', $category->id) }}" id="delete-form-{{$category->id}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
@push('js')
    <script src="{{ asset('assets/backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

	<!-- buttons for Export datatable -->
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
	<!-- Datatable Setting js -->
	<script src="{{ asset('assets/backend/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
