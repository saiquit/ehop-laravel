<header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                    <p>460 West 34th Street, 15th floor, New York - Hotline: 804-377-3580 - 804-399-3580</p>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                    <div class="header__actions"><a href="#">Login & Regiser</a>
                        <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">USD<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><img src="assets/frontend/images/flag/usa.svg" alt=""> USD</a></li>
                                <li><a href="#"><img src="assets/frontend/images/flag/singapore.svg" alt=""> SGD</a>
                                </li>
                                <li><a href="#"><img src="assets/frontend/images/flag/japan.svg" alt=""> JPN</a></li>
                            </ul>
                        </div>
                        <div class="btn-group ps-dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Language<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Japanese</a></li>
                                <li><a href="#">Chinese</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navigation">
        <div class="container-fluid">
            <div class="navigation__column left">
                <div class="header__logo"><a class="ps-logo" href="index.html"><img
                            src="assets/frontend/images/logo.png" alt=""></a></div>
            </div>
            <div class="navigation__column center">
                <ul class="main-menu menu">
                    <li class="menu-item"><a class="{{Request::is('/') ? 'active': ''}}"
                            href="{{ route('home') }}">Home</a></li>
                    <li class="menu-item"><a class="{{Request::is('products') ? 'active': ''}}"
                            href="{{ route('product.index') }}">Products</a></li>
                    @guest
                    <li class="menu-item"><a href="{{ route('login') }}">Login</a></li>
                    <li class="menu-item"><a href="{{ route('register') }}">Register</a></li>
                    @else
                    <li class="menu-item"><a
                            href="@if (auth()->user()->role_id ==1) {{route('admin.dashboard')}} @else {{route('customer.dashboard')}} @endif">Dashboard</a>
                    </li>
                    @endguest
                </ul>
            </div>
            <div class="navigation__column right">
                <form class="ps-search--header" action="{{ route('product.index') }}" method="get">
                    {{-- @csrf --}}
                    <input class="form-control" type="text" name="search" placeholder="Search Product…">
                    <button type="submit"><i class="ps-icon-search"></i></button>
                </form>
                <div class="ps-cart"><a class="ps-cart__toggle"
                        href="#"><span><i>{{session('total') ? session('total')['quantity']:0}}</i></span><i
                            class="ps-icon-shopping-cart"></i></a>
                    <div class="ps-cart__listing">
                        <div class="ps-cart__content">
                            @if (session()->get('cart'))
                            @foreach (session()->get('cart') as $id => $details)
                            {{-- {{dd($id)}} --}}
                            <div class="ps-cart-item"><a class="ps-cart-item__close"
                                    onclick="document.getElementById('delete-cart-{{$id}}').submit()"
                                    href="javascript:;"></a>
                                <div class="ps-cart-item__thumbnail">
                                    <a href="{{ route('product.details', $details['slug']) }}"></a>
                                    <img src="{{ asset('storage/images/products/'.$details['image']) }}" alt="">
                                    <form id="delete-cart-{{$id}}" hidden
                                        action="{{ route('order.removeFromCart', $id) }}" method="post">
                                        @csrf
                                    </form>
                                </div>
                                <div class="ps-cart-item__content"><a class="ps-cart-item__title"
                                        href="{{ route('product.details', $details['slug']) }}">{{$details['title']}}</a>
                                    <p>
                                        <span>Quantity:<i>{{$details['quantity']}}</i></span><span>Total:<i>£{{$details['price']}}</i></span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            <div class="ps-cart__total">
                                <p>Number of items:<span>{{session('total')['quantity']}}</span></p>
                                <p>Item Total:<span>£{{session('total')['price']}}</span></p>
                            </div>
                            <div class="ps-cart__footer"><a class="ps-btn" href="{{ route('cart') }}">Check out<i
                                        class="ps-icon-arrow-left"></i></a></div>
                            @else
                            <div class="ps-cart__total">
                                <p>No Item is added Yet</p>
                                <p>Number of items:0</span></p>
                                <p>Item Total:<span>£0</span></p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="menu-toggle"><span></span></div>
                </div>
            </div>
    </nav>
</header>
<div class="header-services">
    <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0"
        data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
        data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery
            on
            every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery
            on
            every order with Sky Store</p>
        <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Free delivery</strong>: Get free standard delivery
            on
            every order with Sky Store</p>
    </div>
</div>
