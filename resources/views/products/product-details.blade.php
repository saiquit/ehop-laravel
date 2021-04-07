@extends('layouts.frontend.app')
@section('content')
<div class="ps-product--detail pt-60">
        <div class="ps-container">
          <div class="row">
            <div class="col-lg-10 col-md-12 col-lg-offset-1">
              <div class="ps-product__thumbnail">
                <div class="ps-product__preview">
                  <div class="ps-product__variants">
                    <div class="item"><img src="{{ asset('storage/images/products/'.$product->image) }}" alt=""></div>
                    @foreach ($product->images as $image)
                        <div class="item"><img src="{{ asset('storage/images/products/'.$image->product_image) }}" alt=""></div>
                    @endforeach
                    {{-- <div class="item"><img src="images/shoe-detail/2.jpg" alt=""></div> --}}
                  </div>
                  {{-- <a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img src="images/shoe-detail/1.jpg" alt=""><i class="fa fa-play"></i></a> --}}
                </div>
                <div class="ps-product__image">
                  <div class="item"><img class="zoom" src="{{ asset('storage/images/products/'.$product->image) }}" alt="" data-zoom-image="{{ asset('storage/images/products/'.$product->image) }}"></div>
                    @foreach ($product->images as $image)
                        <div class="item"><img class="zoom" src="{{ asset('storage/images/products/'.$image->product_image) }}" alt="" data-zoom-image="{{ asset('storage/images/products/'.$image->product_image) }}"></div>
                    @endforeach

                </div>
              </div>
              <div class="ps-product__thumbnail--mobile">
                <div class="ps-product__main-img"><img src="{{ asset('storage/images/products/'.$product->image) }}" alt=""></div>
                <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="{{ asset('storage/images/products/'.$product->image) }}" alt=""></div>
              </div>
            <form action="{{ route('order.addtocart', $product->id) }}" method="post">
            @csrf
              <div class="ps-product__info">
                <div class="ps-product__rating">
                  <select class="ps-rating">
                  @foreach (range(1, 5) as $number)
                    <option @if ($number == intval($product->rating))
                        selected
                    @endif value="{{$number}}">{{$number}}</option>
                  @endforeach
                  </select>
                  <a href="#">

                  (Read all 8 reviews)</a>
                </div>
                <h1>{{$product->title}}</h1>
                <p class="ps-product__category"> @foreach ($product->category as $category) <a href="#">{{$category->title}}</a> @endforeach,</p>
                <h3 class="ps-product__price">£ {{$product->price}} </h3>
                <div class="ps-product__block ps-product__quickview">
                  <h4>QUICK REVIEW</h4>
                  <p>{!! Str::limit($product->description, 50)!!}</p>
                </div>
                <div class="ps-product__block ps-product__size">
                  <h4>CHOOSE COLOR</h4>
                  <select name="color" class="ps-select selectpicker">
                    <option value="1">Select Color</option>
                    @foreach ($product->attributes as $attr)
                        @if ($attr->code == 'color')
                            <option value="{{$attr->value}}">{{$attr->value}}</option>
                        @endif
                    @endforeach

                  </select>
                </div>

                <div class="ps-product__block ps-product__size">
                  <h4>CHOOSE SIZE<a href="#">Size chart</a></h4>
                  <select name="size" class="ps-select selectpicker">
                    <option value="1">Select Size</option>
                    @foreach ($product->attributes as $attr)
                        @if ($attr->code == 'size')
                            <option value="{{$attr->value}}">{{$attr->value}}</option>
                        @endif
                    @endforeach

                  </select>
                  <div class="form-group">
                    <input name="quantity" class="form-control" type="number" value="1">
                  </div>
                </div>
                <div class="ps-product__shopping"><button class="ps-btn mb-10" type="submit">Add to cart<i class="ps-icon-next"></i></button>
                  <div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i class="ps-icon-heart"></i></a></div>
                </div>
              </div>
            </form>
              <div class="clearfix"></div>
              <div class="ps-product__content mt-50">
                <ul class="tab-list" role="tablist">
                  <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
                  <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
                  <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>
                  <li><a href="#tab_04" aria-controls="tab_04" role="tab" data-toggle="tab">ADDITIONAL</a></li>
                </ul>
              </div>
              <div class="tab-content mb-60">
                <div class="tab-pane active" role="tabpanel" id="tab_01">
                    <p>{!!$product->description !!}</p>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_02">
                  <p class="mb-20">1 review for <strong>Shoes Air Jordan</strong></p>
                  <div class="ps-review">
                    <div class="ps-review__thumbnail"><img src="images/user/1.jpg" alt=""></div>
                    <div class="ps-review__content">
                      <header>
                        <select class="ps-rating">
                          <option value="1">1</option>
                          <option value="1">2</option>
                          <option value="1">3</option>
                          <option value="1">4</option>
                          <option value="5">5</option>
                        </select>
                        <p>By<a href=""> Alena Studio</a> - November 25, 2017</p>
                      </header>
                      <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder. Chocolate bar pudding macaroon candy canes chocolate apple pie chocolate cake. Sweet caramels sesame snaps halvah bear claw wafer. Sweet roll soufflé muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar gummies dragée lemon drops brownie.</p>
                    </div>
                  </div>
                  <form class="ps-product__review" action="_action" method="post">
                    <h4>ADD YOUR REVIEW</h4>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                              <label>Name:<span>*</span></label>
                              <input class="form-control" type="text" placeholder="">
                            </div>
                            <div class="form-group">
                              <label>Email:<span>*</span></label>
                              <input class="form-control" type="email" placeholder="">
                            </div>
                            <div class="form-group">
                              <label>Your rating<span></span></label>
                              <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="5">5</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                              <label>Your Review:</label>
                              <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                            </div>
                          </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_03">
                  <p>Add your tag <span> *</span></p>
                  <form class="ps-product__tags" action="_action" method="post">
                    <div class="form-group">
                      <input class="form-control" type="text" placeholder="">
                      <button class="ps-btn ps-btn--sm">Add Tags</button>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_04">
                  <div class="form-group">
                    <textarea class="form-control" rows="6" placeholder="Enter your addition here..."></textarea>
                  </div>
                  <div class="form-group">
                    <button class="ps-btn" type="button">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
