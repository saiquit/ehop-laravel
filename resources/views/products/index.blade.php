@extends('layouts.frontend.app')
@section('content')
    <div class="ps-products-wrap inverse pt-80 pb-80">
        <div class="ps-products" data-mh="product-listing">
          <div class="ps-product-action">
            <div class="ps-product__filter">
              <select class="ps-select selectpicker">
                <option value="1">Shortby</option>
                <option value="2">Name</option>
                <option value="3">Price (Low to High)</option>
                <option value="3">Price (High to Low)</option>
              </select>
            </div>
            {{ $products->links('pagination::bootstrap-4') }}
          </div>
          <div class="ps-product__columns">
          @foreach ($products as $product)
            <div class="ps-product__column">
              <div class="ps-shoe mb-30">
                      <div class="ps-shoe__thumbnail">
                        {{-- <div class="ps-badge"><span>New</span></div> --}}
                        {{-- <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div> --}}
                        <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                        <img src="{{ asset('storage/images/products/'.$product->image) }}" alt=""><a class="ps-shoe__overlay" href="{{ route('product.details', ['slug'=> $product['slug']]) }}"></a>
                      </div>
                      <div class="ps-shoe__content">
                        <div class="ps-shoe__variants">
                          <div class="ps-shoe__variant normal">
                          @foreach ($product->images as $image)
                            <img src="{{ asset('storage/images/products/'.$image->product_image) }}" alt="">
                          @endforeach
                          </div>
                          <select class="ps-rating ps-shoe__rating">
                            @foreach (range(1, 5) as $number)
                                <option @if ($number == intval($product->rating))
                                    selected
                                @endif value="{{$number}}">{{$number}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{ucfirst($product->title)}}</a>
                          <p class="ps-shoe__categories"> @foreach ($product->category as $category)<a href="#">{{$category->title}}</a>,@endforeach
                            <del>£220</del> £ {{$product->price}}</span>
                        </div>
                      </div>
                    </div>
            </div>
          @endforeach
          </div>
          <div class="ps-product-action">
            <div class="ps-product__filter">
              <select class="ps-select selectpicker">
                <option value="1">Shortby</option>
                <option value="2">Name</option>
                <option value="3">Price (Low to High)</option>
                <option value="3">Price (High to Low)</option>
              </select>
            </div>
            {{ $products->links('pagination::bootstrap-4') }}
          </div>
        </div>
        <div class="ps-sidebar" data-mh="product-listing">
          <aside class="ps-widget--sidebar ps-widget--category">
            <div class="ps-widget__header">
              <h3>Category</h3>
            </div>
            <div class="ps-widget__content">
              <ul class="ps-list--checked">
                @foreach ($categories as $category)
                    <li><a href="product-listing.html">{{$category->title}}({{$category->products->count()}})</a></li>
                @endforeach
              </ul>
            </div>
          </aside>
          <aside class="ps-widget--sidebar ps-widget--filter">
            <div class="ps-widget__header">
              <h3>Category</h3>
            </div>
            <div class="ps-widget__content">
              <div class="ac-slider" data-default-min="300" data-default-max="2000" data-max="3450" data-step="50" data-unit="$"></div>
              <p class="ac-slider__meta">Price:<span class="ac-slider__value ac-slider__min"></span>-<span class="ac-slider__value ac-slider__max"></span></p><a class="ac-slider__filter ps-btn" href="#">Filter</a>
            </div>
          </aside>
          <div class="ps-sticky desktop">
            <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Size</h3>
              </div>
              <div class="ps-widget__content">
                <table class="table ps-table--size">
                  <tbody>
                  @foreach ($sizes->chunk(5) as $chunkedSize)
                    <tr>
                    @foreach ($chunkedSize as $size)
                      <td>{{$size->value}}</td>
                    @endforeach
                  @endforeach
                  </tbody>
                </table>
              </div>
            </aside>
            <aside class="ps-widget--sidebar">
              <div class="ps-widget__header">
                <h3>Color</h3>
              </div>
              <div class="ps-widget__content">
                <ul class="ps-list--color">
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                </ul>
              </div>
            </aside>
          </div>
          <!--aside.ps-widget--sidebar-->
          <!--    .ps-widget__header: h3 Ads Banner-->
          <!--    .ps-widget__content-->
          <!--        a(href='product-listing'): img(src="images/offer/sidebar.jpg" alt="")-->
          <!---->
          <!--aside.ps-widget--sidebar-->
          <!--    .ps-widget__header: h3 Best Seller-->
          <!--    .ps-widget__content-->
          <!--        - for (var i = 0; i < 3; i ++)-->
          <!--            .ps-shoe--sidebar-->
          <!--                .ps-shoe__thumbnail-->
          <!--                    a(href='#')-->
          <!--                    img(src="images/shoe/sidebar/"+(i+1)+".jpg" alt="")-->
          <!--                .ps-shoe__content-->
          <!--                    if i == 1-->
          <!--                        a(href='#').ps-shoe__title Nike Flight Bonafide-->
          <!--                    else if i == 2-->
          <!--                        a(href='#').ps-shoe__title Nike Sock Dart QS-->
          <!--                    else-->
          <!--                        a(href='#').ps-shoe__title Men's Sky-->
          <!--                    p <del> £253.00</del> £152.00-->
          <!--                    a(href='#').ps-btn PURCHASE-->
        </div>
      </div>
@endsection
