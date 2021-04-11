@extends('layouts.frontend.app')

@section('content')
<div class="ps-content pt-80 pb-80">
    <div class="ps-container">
        <div class="ps-cart-listing">
            <table class="table ps-cart__table">
                <thead>
                    <tr>
                        <th>All Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (session('cart'))
                    @foreach (session('cart') as $key => $cartItem)
                    <tr>
                        <td><a class="ps-product__preview" href="{{ route('product.details', $cartItem['slug']) }}"><img
                                    height="64" width="64" class="mr-15"
                                    src="{{ asset('/storage/images/products/' .$cartItem['image']) }}" alt="">
                                {{$cartItem['title']}}</a></td>
                        <td>${{$cartItem['price']}}</td>
                        <td>
                            <div class="form-group--number">
                                <form id="form-update-{{$key}}" action="{{ route('order.updateCart', $key) }}"
                                    method="post">
                                    @csrf
                                    <input onkeyup="valueChange({{$key}}, {{$cartItem['quantity']}})"
                                        onchange="valueChange({{$key}}, {{$cartItem['quantity']}})" name="quantity"
                                        class="form-control quantity" type="number" value="{{$cartItem['quantity']}}">
                                    <button disabled class="btn btn-primary" type="submit">Update</button>
                                </form>
                            </div>
                        </td>
                        <td>${{$cartItem['price'] * $cartItem['quantity']}}</td>
                        <td>
                            <div onclick="document.getElementById('remove-item-{{$key}}').submit();" class="ps-remove">
                            </div>
                            <form id="remove-item-{{$key}}" hidden action="{{ route('order.removeFromCart', $key) }}"
                                method="post">
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <h1 class="ps-post__header">
                                Nothing in Cart
                            </h1>
                    </tr>
                    </td>
                    @endif
                </tbody>
            </table>
            <div class="ps-cart__actions">
                <div class="ps-cart__promotion">
                    <div class="form-group">
                        <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                            <input class="form-control" type="text" placeholder="Promo Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                    </div>
                </div>
                <div class="ps-cart__total">
                    <h3>Total Price: <span> @if (session('total')) {{session('total')['price']}} @else 0 @endif
                            $</span>
                    </h3>
                    <button class="ps-btn ps-btn--rounded-30 mb-20" style="display: none" id="update-cart"
                        href="{{ route('checkout') }}">Update Cart<i class="ps-icon-next"></i>
                    </button>
                    <a class="ps-btn" href="{{ route('checkout') }}">Process to
                        checkout<i class="ps-icon-next"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function valueChange(key,inival) {
        var formEle = $('#form-update-'+key);
        var inputele = formEle.find('.quantity');
        var btnEle = formEle.find('button');
        if (inputele.val() > inival) {
            btnEle.prop('disabled', false)
        }else if(inputele.val() < inival){
            btnEle.prop('disabled', false)
        }else{
            btnEle.prop('disabled', true)
        }
    }
</script>
@endpush
