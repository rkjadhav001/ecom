@extends('layouts.front-end.app')

@section('title', 'Fashoin Clickz')

@section('page-style')
    <style>
      .color-radio li input:checked::before {
          background-color: inherit;
      }
    </style>
@endsection

@section('content')
    <!-- ========== Start breadcrump Section ========== -->
    <nav class="breadcrumb section-md-t-space section-md-b-space">
        <div class="custom-container">
            <img src="{{ asset('assets/front-end/assets/images/breadcrumb-img.png') }}" class="img-fluid breadcrumb-img"
                alt="breadcrumb-img" />
            <div class="breadcrumb-box">
                <a class="breadcrumb-item" href="index.html">home</a>
                <a class="breadcrumb-item" href="shop-left-sidebar.html">Woman</a>
                <span class="breadcrumb-item active" aria-current="page">Woman Full Sleeve T-shirt</span>
            </div>
        </div>
    </nav>
    <!-- ========== End breadcrump Section ========== -->
    <!-- product-section-start -->
    <section class="product-section section-t-space">
        <div class="custom-container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="product-slider-box">
                        <div class="row g-2">
                            <div class="col-xxl-2 col-xl-3 col-12 order-2 order-xl-1">
                                <div class="custom-product-height scroll-bar scroll-bar-hide">
                                    <div class="swiper product-slide-small">
                                        <div class="swiper-wrapper">
                                          <div class="swiper-slide thamb-img">
                                            <img 
                                              onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                              src="{{ asset('storage/product/thumbnail/'.$product->thumbnail) }}"
                                                  class="img-fluid w-100" alt="" />
                                          </div>
                                          @if ($product->images!=null) 
                                            @foreach (json_decode($product->images) as $key => $photo)    
                                              <div class="swiper-slide thamb-img">
                                                  <img 
                                                  onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                  src="{{asset("storage/product/$photo")}}"
                                                      class="img-fluid w-100" alt="" />
                                              </div>
                                            @endforeach
                                          @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-10 col-xl-9 col-12 order-1 order-xl-2">
                                <div class="swiper product-slide-big">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <figure class="zoom" onmousemove="zoom(event)"
                                                style="
                                                  background-image: url('{{ asset('storage/product/thumbnail/'.$product->thumbnail) }}');
                                                ">
                                                <img 
                                                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                src="{{ asset('storage/product/thumbnail/'.$product->thumbnail) }}"
                                                    class="w-100" alt="" />
                                            </figure>
                                        </div>
                                        @if ($product->images!=null)    
                                          @foreach (json_decode($product->images) as $key => $photo)    
                                            <div class="swiper-slide">
                                                <figure class="zoom" onmousemove="zoom(event)"
                                                    style="
                                                      background-image: url('{{asset("storage/product/$photo")}}');
                                                    ">
                                                    <img 
                                                    onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                    src="{{asset("storage/product/$photo")}}"
                                                        class="w-100" alt="" />
                                                </figure>
                                            </div>
                                          @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-right-detail">
                        <h2>{{ $product->name }}</h2>
                        <div class="product-price-box border-line">
                            <h5>
                              {{\App\CPU\Helpers::currency_converter(
                                  $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                              )}}
                              @if ($product->discount > 0)  
                                <del>{{\App\CPU\Helpers::currency_converter($product->unit_price)}}</del> 
                              @endif
                              <span>
                                @if ($product->discount_type == 'percent')
                                    {{ round($product->discount, 2) }}%
                                @elseif($product->discount_type == 'flat')
                                    {{\App\CPU\Helpers::currency_converter($product->discount)}}
                                @endif
                                {{\App\CPU\translate('off')}}
                              </span>
                            </h5>
                            @php
                                $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
                                $rating = \App\CPU\ProductManager::get_rating($product->reviews);
                            @endphp
                            <div class="product-reting">
                                <ul>
                                  @for($inc=0;$inc<5;$inc++)
                                      @if($inc<$overallRating[0])
                                          <li><i class="ri-star-fill"></i></li>
                                      @else
                                          <li><i class="ri-star-line"></i></li>
                                      @endif
                                  @endfor
                                </ul>
                                <h6>{{ count($product->reviews) }} Review</h6>
                            </div>
                        </div>
                        <div class="product-content border-line">
                            <p>
                                A stylish mini skirt featuring a trendy fold-over waist
                                design, offering a flattering and modern silhouette. Perfect
                                for casual or chic outfits, it combines comfort and fashion
                                effortlessly.
                            </p>
                            <ul class="product-list">
                                <li>vendor: donatello</li>
                                <li>sKU: W303C81</li>
                                <li>availability: in stock</li>
                            </ul>
                        </div>
                        <input type="hidden" name="id" value="{{ $product->id }}">


                        <p class="product-view border-line">
                            <i class="ri-eye-line"></i> 15 people are viewing this right now
                        </p>

                        <div class="product-Variant-box">
                            <div class="product-size">
                              @foreach (json_decode($product->choice_options) as $key => $choice)    
                                <h5 class="product-sub-title">{{ $choice->title }} : </h5>
                                <ul class="size">
                                  @foreach ($choice->options as $key => $option)    
                                    <li class="@if($key == 0) active @endif" >
                                      <a href="#!">
                                        {{ $option }} 
                                        <input type="radio"
                                          id="{{ $choice->name }}-{{ $option }}"
                                          name="{{ $choice->name }}" value="{{ $option }}"
                                          @if($key == 0) checked @endif hidden>
                                      </a>
                                    </li>
                                    {{-- <li class="disable"><a href="#!">M</a></li>
                                    <li><a href="#!">L</a></li>
                                    <li><a href="#!">XL</a></li> --}}
                                  @endforeach
                                </ul>
                              @endforeach
                            </div>

                            <div class="product-color-box">
                              @if (count(json_decode($product->colors)) > 0)    
                                <h5 class="product-sub-title">Color</h5>
                                <ul class="color-radio">
                                  @foreach (json_decode($product->colors) as $key => $color)
                                        <div>
                                            <li>
                                                <input type="radio" class="radio-1"
                                                  id="{{ $product->id }}-color-{{ $key }}"
                                                  name="color" value="{{ $color }}"
                                                  @if($key == 0) checked @endif >
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                              @endif
                            </div>
                        </div>
                        <div class="counter-btn">
                            <div class="counter">
                                <span class="down" onClick="decreaseCount(event, this)"><i
                                        class="ri-subtract-line"></i></span>
                                <input type="text" value="1" />
                                <span class="up" onClick="increaseCount(event, this)"><i
                                        class="ri-add-line"></i></span>
                            </div>
                            <div class="product-btn">
                                <a href="cart.html" class="btn outline-btn">
                                    <i class="ri-shopping-cart-2-line"></i>
                                    Add to Cart</a>
                                <a href="check-out.html" class="btn solid-btn">
                                    <div class="button-text">
                                        <span>Buy now</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="add-box">
                            <a href="wishlist.html" class="like-btn animate inactive p-0">
                                <i class="ri-heart-3-fill fill-icon"></i>
                                <i class="ri-heart-3-line outline-icon"></i>
                                Add To Wishlist
                            </a>
                            {{-- <a href="#!" class="compare-btn"><i class="ri-loop-right-fill"></i>Add To Compare</a> --}}
                        </div>

                        <div class="progress-bar-line">
                            <h6>Please hurry! Only 5 left in stock</h6>
                            <div class="progress" role="progressbar" aria-label="Animated striped example"
                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    style="width: 55%; height: 10px">
                                </div>
                            </div>
                        </div>

                        <div class="delivery-box border-line">
                            <a href="#!" class="size-btn" data-bs-toggle="modal" data-bs-target="#deliVery">
                                <i class="ri-truck-line"></i> Delivery and Return
                            </a>
                            <a href="#!" class="size-btn" data-bs-toggle="modal" data-bs-target="#size">
                                <i class="ri-ruler-line"></i> Find your size
                            </a>
                            <a href="#!" class="size-btn" data-bs-toggle="modal" data-bs-target="#question">
                                <i class="ri-questionnaire-line"></i> Ask a question
                            </a>
                        </div>

                        <div class="payment-box border-line">
                            <h5 class="product-sub-title">Guaranteed safe checkout</h5>
                            <img src="{{ asset('assets/front-end/assets/images/payment/payments.png') }}"
                                class="img-fluid" alt="" />
                        </div>

                        <div class="share-info">
                            <h5>Share it:</h5>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.google.com/"><i class="ri-google-fill"></i></a>
                                </li>
                                <li>
                                    <a href="https://x.com/login?mx=2"><i class="ri-twitter-fill"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/"><i class="ri-instagram-line"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-section-end -->

    <section class="tab-product-box section-t-space">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <div class="nav nav-tabs product-tab" id="nav-tabOne" role="tablist">
                            <button class="nav-link active border-0 border-bottom-0" id="nav-home-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                aria-controls="nav-home" aria-selected="true">
                                DETAILS
                            </button>
                            <button class="nav-link border-0 border-bottom-0" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                Specification
                            </button>
                            <button class="nav-link border-0 border-bottom-0" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">
                                Care Instructions
                            </button>
                            <button class="nav-link border-0 border-bottom-0" id="nav-disabled-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-disabled" type="button" role="tab"
                                aria-controls="nav-disabled" aria-selected="false">
                                Write Review
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content product-content-box" id="nav-tabContentOne">
                        <div class="tab-pane details-tab fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="details-show">
                                @php
                                    echo $product->details
                                @endphp
                            </div>
                            <button class="toggle-button" onclick="toggleContent()">
                                Show more
                            </button>
                        </div>

                        <div class="tab-pane specification-tab fade" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab" tabindex="0">
                            @php
                                echo $product->specification
                            @endphp
                        </div>
                        <div class="tab-pane care-tab fade" id="nav-contact" role="tabpanel"
                            aria-labelledby="nav-contact-tab" tabindex="0">
                            <ul>
                                <li>Turn the denim shorts inside out before washing.</li>
                                <li>Use a gentle cycle to preserve the fabric and color.</li>
                                <li>
                                    Wash in cold water to prevent shrinkage and color fading.
                                </li>
                                <li>Use a mild detergent to protect the denim fabric.</li>
                                <li>
                                    Do not use bleach, as it can weaken the fabric and affect
                                    the color.
                                </li>
                                <li>
                                    Wash denim shorts separately from other garments to prevent
                                    color transfer.
                                </li>
                                <li>
                                    Air-dry the shorts to maintain shape and prevent excessive
                                    wear.
                                </li>
                                <li>
                                    If using a dryer, use a low heat setting to minimize
                                    shrinkage.
                                </li>
                                <li>
                                    If needed, iron inside out on a low heat setting to avoid
                                    damaging the fabric
                                </li>
                                <li>
                                    Store denim shorts in a cool, dry place to prevent mold and
                                    mildew.
                                </li>
                                <li>
                                    Avoid hanging them to prevent stretching; instead, fold them
                                    neatly.
                                </li>
                                <li>
                                    Wash denim shorts only when necessary to preserve the fabric
                                    and color.
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane review-tab fade" id="nav-disabled" role="tabpanel"
                            aria-labelledby="nav-disabled-tab" tabindex="0">
                            <div class="row g-4">
                                <div class="col-xl-4 col-lg-5 col-12">
                                    <div class="all-rating-tab border-line">
                                        <h5 class="all-review-title">all reviews :</h5>
                                        <ul>
                                            <li class="progress-reting-tab">
                                                <h5>5 star</h5>
                                                <div class="progress" style="height: 8px" role="progressbar"
                                                    aria-label="example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 55%; height: 8px"></div>
                                                </div>
                                                <h6>55<span>%</span></h6>
                                            </li>
                                            <li class="progress-reting-tab">
                                                <h5>4 star</h5>
                                                <div class="progress" style="height: 8px" role="progressbar"
                                                    aria-label="example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 45%; height: 8px"></div>
                                                </div>
                                                <h6>45<span>%</span></h6>
                                            </li>
                                            <li class="progress-reting-tab">
                                                <h5>3 star</h5>
                                                <div class="progress" style="height: 8px" role="progressbar"
                                                    aria-label="example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 10%; height: 8px"></div>
                                                </div>
                                                <h6>10<span>%</span></h6>
                                            </li>
                                            <li class="progress-reting-tab">
                                                <h5>2 star</h5>
                                                <div class="progress" style="height: 8px" role="progressbar"
                                                    aria-label="example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 35%; height: 8px"></div>
                                                </div>
                                                <h6>35<span>%</span></h6>
                                            </li>
                                            <li class="progress-reting-tab">
                                                <h5>1 star</h5>
                                                <div class="progress" style="height: 8px" role="progressbar"
                                                    aria-label="example" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 40%; height: 8px"></div>
                                                </div>
                                                <h6>40<span>%</span></h6>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="write-review">
                                        <h5 class="review-title">Review this product</h5>
                                        <p>Let other customers know what you think</p>
                                        <a href="#!" class="btn solid-btn w-100" data-bs-toggle="modal"
                                            data-bs-target="#review">
                                            <div class="button-text">
                                                <span>Write a review</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-12">
                                    <div class="review-box">
                                        <div class="title-flex pb-3">
                                            <h4 class="clients-review-title">reviews</h4>
                                            <div class="filter-tab">
                                                <button class="active btn filter-btn-style" id="all">
                                                    All
                                                </button>
                                                <button class="btn filter-btn-style" id="a">
                                                    5 Star
                                                </button>
                                                <button class="btn filter-btn-style" id="b">
                                                    4 Star
                                                </button>
                                                <button class="btn filter-btn-style" id="c">
                                                    3 Star
                                                </button>
                                                <button class="btn filter-btn-style" id="d">
                                                    2 Star
                                                </button>
                                                <button class="btn filter-btn-style" id="e">
                                                    1 Star
                                                </button>
                                            </div>
                                        </div>
                                        <div class="tab-content row scroll-bar" id="parent">
                                            <div class="col-12 a box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure.
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Michel Poe Mar 29, 2022 Khaki cotton blend
                                                            military jacket flattering fit mock horn buttons
                                                            and patch pockets showerproof black lightgrey.
                                                            Printed lining patch pockets jersey blazer built
                                                            in pocket square wool casual quilted jacket
                                                            without hood azure.
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 a box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 e box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 e box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 a box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 c box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 b box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 b box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 b box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-line"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 a box">
                                                <div class="customer-review">
                                                    <div class="avtar-img">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/front-end/assets/images/compress/vector-1.jpg') }}"
                                                                alt="" />
                                                        </a>
                                                    </div>
                                                    <div class="customer-review-detail">
                                                        <div class="vactor-name-box">
                                                            <div class="vactor-name">
                                                                <h5>thomus zed</h5>
                                                                <ul class="d-flex">
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                    <li><i class="ri-star-s-fill"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-like like-dislike-container">
                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Like" class="likes-btn">
                                                                    <i class="ri-thumb-up-line like-line"></i>
                                                                    <i class="ri-thumb-up-fill like-fill"></i>
                                                                    <span class="like-count">0</span></a>

                                                                <a href="#!" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Dislike" class="dislike-btn">
                                                                    <i class="ri-thumb-down-line dislike-line"></i>
                                                                    <i class="ri-thumb-down-fill dislike-fill"></i><span
                                                                        class="dislike-count">0</span></a>
                                                            </div>
                                                        </div>
                                                        <p class="review-comment">
                                                            Khaki cotton blend military jacket flattering
                                                            fit mock horn buttons and patch pockets
                                                            showerproof black lightgrey. Printed lining
                                                            patch pockets jersey blazer built in pocket
                                                            square wool casual quilted jacket without hood
                                                            azure
                                                        </p>

                                                        <div class="review-img-box">
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                            <a href="#!" class="img-box-review">
                                                                <img src="{{ asset('assets/front-end/assets/images/product/front/21_1.jpg') }}"
                                                                    alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="review-date">
                                                            <h5>09/03/2024</h5>
                                                            <h5>05:54</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- size Modal start -->
    <div class="modal fade" id="size" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="product-sub-title">Size Chart</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/front-end/assets/images/compress/size-chart-compressor.jpg') }}"
                        class="img-fluid w-100" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- size modal end -->

    <!-- delivery Modal start -->
    <div class="modal lg-modal fade" id="deliVery" tabindex="-1">
        <div class="modal-dialog delivery-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delivery and Return</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body lg-body">
                    <h5>Shipping</h5>
                    <ul>
                        <li>
                            Free ground shipping, your order will arrive in 1 to 7 business
                            days.
                        </li>
                        <li>
                            Opt for in-store pickup and have your items ready within 1 to 7
                            business days.
                        </li>
                        <li>
                            For swift delivery, choose our Next-day and Express options.
                        </li>
                        <li>
                            Your purchases will be presented in an elegant orange box
                            secured with a chic Bolduc ribbon, excluding specific items.
                        </li>
                        <li>
                            Explore our delivery FAQs for comprehensive information on
                            shipping methods, expenses, and delivery timelines.
                        </li>
                    </ul>
                    <h5 class="return">Returns And Exchanges</h5>
                    <ul>
                        <li>
                            Effortless and free returns accepted within a generous 14-day
                            window.
                        </li>
                        <li>
                            Refer to our return FAQs for details on conditions and
                            procedures.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- delivery modal end -->

    <!-- Terms and condition Modal start -->
    <div class="modal lg-modal fade" id="term" tabindex="-1">
        <div class="modal-dialog delivery-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="product-sub-title">Terms and Conditions of edgy</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body lg-body">
                    <h5>1. Acceptance of Terms</h5>
                    <ul>
                        <li>
                            By accessing or using the services provided by edgy, you agree
                            to be bound by these terms and conditions. If you do not agree
                            to all the terms and conditions, you may not access the
                            services.
                        </li>
                    </ul>
                    <h5 class="terms">2. Orders and Payments</h5>
                    <ul>
                        <li>
                            All orders placed through our website are subject to
                            availability and acceptance.
                        </li>
                        <li>
                            Prices are as displayed on the website and are subject to change
                            without notice.
                        </li>
                        <li>
                            Payment must be made in full at the time of placing an order.
                        </li>
                    </ul>
                    <h5 class="terms">3. Privacy Policy</h5>
                    <ul>
                        <li>
                            We respect your privacy and handle your personal information in
                            accordance with our Privacy Policy.
                        </li>
                    </ul>
                    <h5 class="terms">4. Changes to Terms</h5>
                    <ul>
                        <li>
                            edgyreserves the right to modify these terms and conditions at
                            any time without prior notice. The updated terms will be
                            effective upon posting on the website.
                        </li>
                    </ul>
                    <p class="bold-line">
                        By using our services, you agree to review these terms regularly
                        and be aware of any changes.
                    </p>
                    <p>
                        <span>note : </span> If you have any questions or concerns about
                        these terms and conditions, please contact us at
                        <a href="mailto:orders@edgystore.com">orders@edgystore.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Terms and condition modal end -->

    <!-- question Modal start -->
    <div class="modal fade" id="question" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Ask a question</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body que-modal">
                    <div class="que-product-box">
                        <a href="shop-left-sidebar.html" class="que-img">
                            <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}"
                                class="img-fluid" alt="" />
                        </a>
                        <div class="que-product-details">
                            <a href="shop-left-sidebar.html">
                                <h5>blue danim shorty</h5>
                            </a>
                            <h6>$50.00 <del>$70.00</del></h6>
                        </div>
                    </div>

                    <form>
                        <div class="row">
                            <h6 class="que-title">Your Question*</h6>
                            <div class="col-6">
                                <div class="form-floating que-form mb-3">
                                    <input type="text" class="form-control" id="floatingInputone"
                                        placeholder="Your name" />
                                    <label for="floatingInputone">Your Name</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating que-form mb-3">
                                    <input type="email" class="form-control" id="floatingInput"
                                        placeholder="Your Email" />
                                    <label for="floatingInput">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating que-form mb-3">
                                    <textarea class="form-control" placeholder="Leave a massage here" id="floatingTextareaOne" style="height: 100px"></textarea>
                                    <label for="floatingTextareaOne">Your Message....</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="w-100 btn solid-btn" type="submit">
                                    <div class="button-text">
                                        <span>Send Message</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- question modal end -->

    <!-- review Modal start -->
    <div class="modal review-modal fade" id="review" tabindex="-1">
        <div class="modal-dialog delivery-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="product-sub-title">Write a review</h5>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rating-img-box">
                        <a href="shop-left-sidebar.html" class="rating-img">
                            <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}"
                                class="img-fluid" alt="" />
                        </a>
                        <div class="rating-details">
                            <a href="shop-left-sidebar.html">
                                <h5>blue danim shorty</h5>
                            </a>
                            <div class="rating-review">
                                <h6>rating</h6>
                                <ul>
                                    <li><i class="ri-star-fill"></i></li>
                                    <li><i class="ri-star-fill"></i></li>
                                    <li><i class="ri-star-fill"></i></li>
                                    <li><i class="ri-star-line"></i></li>
                                    <li><i class="ri-star-line"></i></li>
                                </ul>
                                <span>( 3.50 )</span>
                            </div>
                        </div>
                    </div>
                    <div class="rating-star">
                        <h6>rating :</h6>
                        <ul>
                            <li>
                                <i class="ri-star-line line-star"></i>
                                <i class="ri-star-fill fill-star"></i>
                            </li>
                            <li>
                                <i class="ri-star-line line-star"></i>
                                <i class="ri-star-fill fill-star"></i>
                            </li>
                            <li>
                                <i class="ri-star-line line-star"></i>
                                <i class="ri-star-fill fill-star"></i>
                            </li>
                            <li>
                                <i class="ri-star-line line-star"></i>
                                <i class="ri-star-fill fill-star"></i>
                            </li>
                            <li>
                                <i class="ri-star-line line-star"></i>
                                <i class="ri-star-fill fill-star"></i>
                            </li>
                        </ul>
                    </div>

                    <form>
                        <div class="review-content-box">
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <h6>add images :</h6>
                                    <label class="upload__btn">
                                        <span>Upload images</span>

                                        <input type="file" multiple="" data-max_length="20"
                                            class="upload__inputfile" />
                                    </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>

                            <h6>Review Content :</h6>
                            <div class="form-floating review-form mb-3">
                                <textarea class="form-control" placeholder="Leave a massage here" id="floatingTextarea" style="height: 100px"></textarea>
                                <label for="floatingTextarea">Write your comments here</label>
                            </div>

                            <button type="button" class="modal-btn" data-bs-dismiss="modal" aria-label="Close">
                                close
                            </button>
                            <button type="submit" class="modal-btn">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- review modal end -->

    <section class="related-section section-t-space section-b-space">
        <div class="custom-container">
            <div class="related-title section-sm-b-space">
                <h2 class="theme-title">RELATED PRODUCTS</h2>
                <div class="swiper-nav swiper-nav-box">
                    <div class="swiper-button-prev related-button">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next related-button">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>

            <div class="swiper product-slider-related ratio_product">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $relatedProduct)    
                      <div class="swiper-slide">
                          <div class="product-box">
                              <div class="product-img-box">
                                  <div class="label-box">
                                      <div class="product-option">
                                          <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                              <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                              <i class="ri-heart-3-line outline-icon like-two"></i>
                                          </a>
                                          <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                              data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                          {{-- <a href="#!"><i class="ri-loop-right-fill"></i></a> --}}
                                      </div>
                                  </div>
                                  <div class="front">
                                      <a href="{{ route('frontend.productDetail',$relatedProduct->slug) }}">
                                          <img src="{{ asset('storage/product/thumbnail/'.$relatedProduct->thumbnail) }}"
                                              class="bg-img w-100" alt="" />
                                      </a>
                                  </div>
                                  <div class="back">
                                      <a href="{{ route('frontend.productDetail',$relatedProduct->slug) }}">
                                          <img src="{{ asset('storage/product/thumbnail/'.$relatedProduct->thumbnail_back) }}"
                                              class="bg-img w-100" alt="" />
                                      </a>
                                  </div>
                                  <div class="product-btn">
                                      <a href="#!" class="btn solid-btn addtocart-btn">
                                          <div class="button-text">
                                              <span>Add to cart</span>
                                          </div>
                                      </a>
                                  </div>
                              </div>
                              <div class="product-detail">
                                  <div class="product-name-box">
                                      <a href="{{ route('frontend.productDetail',$relatedProduct->slug) }}" class="product-name">{{ $relatedProduct->name }}</a>
                                      <ul class="rating-product">
                                          <li><i class="ri-star-fill"></i></li>
                                          <li><i class="ri-star-fill"></i></li>
                                          <li><i class="ri-star-fill"></i></li>
                                          <li><i class="ri-star-fill"></i></li>
                                          <li><i class="ri-star-line"></i></li>
                                      </ul>
                                  </div>
                                  <h6 class="product-price">
                                    {{\App\CPU\Helpers::currency_converter(
                                        $relatedProduct->unit_price-(\App\CPU\Helpers::get_product_discount($relatedProduct,$relatedProduct->unit_price))
                                    )}}
                                    @if ($relatedProduct->discount > 0)     
                                        <del>
                                            {{\App\CPU\Helpers::currency_converter($relatedProduct->unit_price)}}
                                        </del>
                                    @endif
                                </h6>
                              </div>
                          </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ========== Start view modal Section ========== -->
    <div class="modal lg-modal product-detail-modal fade" id="view" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-fill"></i>
                </button>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="modal-leftside center-slider">
                                <div class="swiper view2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/11.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/12.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/13.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/14.jpg') }}" />
                                        </div>
                                    </div>
                                    <div class="swiper-nav swiper-nav-box">
                                        <div class="swiper-button-prev swiper-view-prev">
                                            <i class="ri-arrow-left-s-line"></i>
                                        </div>
                                        <div class="swiper-button-next swiper-view-next">
                                            <i class="ri-arrow-right-s-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div thumbsSlider="" class="swiper view">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/11.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/12.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/13.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img
                                                src="{{ asset('assets/front-end/assets/images/product/front/14.jpg') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="modal-rightside">
                                <h5 class="product-name">Woman black top</h5>
                                <span class="product-price">$9.00 <del>$15.00</del><label>10% off</label></span>
                                <div class="review-box">
                                    <ul>
                                        <li><i class="ri-star-fill"></i></li>
                                        <li><i class="ri-star-fill"></i></li>
                                        <li><i class="ri-star-fill"></i></li>
                                        <li><i class="ri-star-line"></i></li>
                                        <li><i class="ri-star-line"></i></li>
                                    </ul>
                                    <h6>5 review</h6>
                                </div>
                                <div class="product-detail">
                                    <h4>product details:</h4>
                                    <p>
                                        A woman wearing a black top exudes elegance and
                                        simplicity, making it a versatile choice for both casual
                                        and formal occasions.
                                    </p>
                                </div>
                                <ul class="pickup-list">
                                    <li>sku: <span>G25A429</span></li>
                                    <li>stock status: <span>in stock</span></li>
                                    <li>Quantity: <span>59 items left</span></li>
                                </ul>
                                <div class="product-size">
                                    <h5 class="product-sub-title">Size : <span>S</span></h5>
                                    <ul class="size">
                                        <li class="active"><a href="#!">S</a></li>
                                        <li class="disable"><a href="#!">M</a></li>
                                        <li><a href="#!">L</a></li>
                                        <li><a href="#!">XL</a></li>
                                    </ul>
                                </div>
                                <div class="modal-button">
                                    <div class="counter">
                                        <span class="down" onClick="decreaseCount(event, this)"><i
                                                class="ri-subtract-line"></i></span>
                                        <input type="text" value="1" />
                                        <span class="up" onClick="increaseCount(event, this)"><i
                                                class="ri-add-line"></i></span>
                                    </div>
                                    <button class="btn solid-btn">
                                        <div class="button-text">
                                            <span>Add to cart</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== End view modal Section ========== -->
@endsection

@section('page-script')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          var firstColor = $('input[name="color"]:first').val();
          $('input[name="color"]:first').prop('checked', true);
          $('.radio-1:checked').each(function() {
              $(this).closest('li').css('background-color', $(this).val());
          });
          $('input[name="color"]').on('change', function() {
              var selectedColor = $(this).val();
              $(this).closest('li').css('background-color', selectedColor);
          });
      });             

    </script>
@endsection