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
                        <h4 class="mb-20 pt-20">Customer Name: {{ ucfirst($order['first_name']) }}
                            {{$order['last_name']}}</h4>
                        <p>Address: {{ $order->address }}</p>
                        <div class="price">
                            Phome: <ins>{{ $order['phone_number'] }}</ins>
                        </div>
                        <div class="price">
                            Status: <ins>{{ ucfirst($order['status'])}}</ins>
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
                        <h4 class="text-blue h4">Products</h4>
                        <p class="mb-30">Orderd Products</p>
                    </div>
                </div>

                <ul class="list-group">
                    @foreach ($order->products as $product)
                    <li class="list-group-item">
                        <span class="badge badge-pill badge-primary">{{ $product->pivot->quantity }}</span>
                        {{ ucfirst($product->title) }}
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection @push('js') @endpush
