@extends('layouts.frontend.app')

@section('content')
<div class="ps-checkout pt-80 pb-80">
    <div class="ps-container">
        <form class="ps-checkout__form" action="{{ route('order.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__billing">
                        <h3>Billing Detail</h3>
                        <div class="form-group form-group--inline">
                            <label>First Name<span>*</span>
                            </label>
                            <input name="first_name"
                                class="form-control mb-20 @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" type="text">
                            @error('first_name')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Last Name<span>*</span>
                            </label>
                            <input class="form-control mb-20 @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}" name="last_name" type="text">
                            @error('last_name')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Company Name<span>*</span>
                            </label>
                            <input class="form-control mb-20 @error('company_name') is-invalid @enderror"
                                value="{{ old('company_name') }}" type="text" name="company_name">
                            @error('company_name')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Email Address<span>*</span>
                            </label>
                            <input class="form-control mb-20 @error('email') is-invalid @enderror" type="email"
                                name="email"
                                value="@if (auth()->check()) {{auth()->user()->email}} @else {{ old('email') }} @endif">
                            @error('email')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Phone<span>*</span>
                            </label>
                            <input name="phone_number"
                                class="form-control mb-20 @error('phone_number') is-invalid @enderror"
                                value="{{ old('phone_number') }}" type="text">
                            @error('phone_number')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group form-group--inline">
                            <label>Address<span>*</span>
                            </label>
                            <input name="address" class="form-control mb-20 @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" type="text">
                            @error('address')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <h3 class="mt-40"> Addition information</h3>
                        <div class="form-group form-group--inline textarea">
                            <label>Order Notes</label>
                            <textarea name="order_note"
                                class="form-control mb-20 @error('order_note') is-invalid @enderror"
                                value="{{ old('order_note') }}" rows="5"
                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            @error('order_note')
                            <span class="alert alert-danger" style="background: white; border: none" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="ps-checkout__order">
                        <header>
                            <h3>Your Order</h3>
                        </header>
                        <div class="content">
                            <table class="table ps-checkout__products">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase">Product</th>
                                        <th class="text-uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (session('cart'))
                                    @foreach (session('cart') as $key => $item)
                                    <tr>
                                        <td>{{ucfirst($item['title'])}}</td>
                                        <td>{{$item['quantity']}} X ${{$item['price']}}</td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                            <td>Card Subtitle</td>
                                            <td>$300.00</td>
                                        </tr> --}}
                                    <tr>
                                        <td>Order Total</td>
                                        <td>$ {{session('total')['price']}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <footer>
                            <h3>Payment Method</h3>
                            <div class="form-group cheque">
                                <div class="ps-radio">
                                    <input class="form-control" type="radio" id="rdo01" name="payment" checked>
                                    <label for="rdo01">Cheque Payment</label>
                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State
                                        /
                                        County, Store Postcode.</p>
                                </div>
                            </div>
                            <div class="form-group paypal">
                                <div class="ps-radio ps-radio--inline">
                                    <input class="form-control" type="radio" name="payment" id="rdo02">
                                    <label for="rdo02">Paypal</label>
                                </div>
                                <ul class="ps-payment-method">
                                    <li><a href="#"><img src="assets/frontend/images/payment/1.png" alt=""></a></li>
                                    <li><a href="#"><img src="assets/frontend/images/payment/2.png" alt=""></a></li>
                                    <li><a href="#"><img src="assets/frontend/images/payment/3.png" alt=""></a></li>
                                </ul>
                                <button class="ps-btn ps-btn--fullwidth">Place Order<i
                                        class="ps-icon-next"></i></button>
                            </div>
                        </footer>
                    </div>
                    <div class="ps-shipping">
                        <h3>FREE SHIPPING</h3>
                        <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on
                            every order, every time.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
