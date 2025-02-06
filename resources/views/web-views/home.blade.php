@extends('layouts.front-end.app')

@section('title','Fashoin Clickz')

@section('content')
    <!-- ========== Start home-banner Section ========== -->
    <section class="home-section home-style-2 dot-style-1">
        <div class="swiper banner">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)      
                    <div class="swiper-slide">
                        <div class="home-slider">
                            <img
                             onerror="this.src='{{ asset('assets/front-end/assets/images/home-banner/2-3.jpg') }}'"
                             src="{{asset('storage/banner')}}/{{$banner['photo']}}" class="img-fluid w-100" alt="" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="dot-swiper-pagination right-dots"></div>
        </div>
    </section>
    <!-- ========== End home-banner Section ========== -->

    <!-- ========== Start  Section ========== -->
    <section class="feature-slider">
        <div>
            <div class="features">
                <p>shop new collection</p>
                <p>New Arrivals</p>
                <p>Men collection</p>
                <p>Women collection</p>
                <p>Winter collection</p>
                <p>Sale</p>
                <p>shop new collection</p>
                <p>New Arrivals</p>
                <p>Men collection</p>
            </div>
            <div class="features">
                <p>shop new collection</p>
                <p>New Arrivals</p>
                <p>Men collection</p>
                <p>Women collection</p>
                <p>Winter collection</p>
                <p>Sale</p>
                <p>shop new collection</p>
                <p>New Arrivals</p>
                <p>Men collection</p>
            </div>
        </div>
    </section>
    <!-- ========== End  Section ========== -->

    <!-- ========== Start Categories Section ========== -->
    <section class="categories-section categories-style-2 section-t-space section-b-space">
        <div class="custom-container">
            <div class="title-flex section-sm-b-space">
                <h2 class="title">Shop by Categories</h2>
                <div class="swiper-nav swiper-nav-box">
                    <div class="swiper-button-prev swiper-seller-prev">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next swiper-seller-next">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>

            <div class="swiper categories-swiper-six">
                <div class="swiper-wrapper ratio_product">
                    @foreach ($categories as $category)    
                        <div class="swiper-slide">
                            <div class="categories-items">
                                <a href="shop-left-sidebar.html">
                                    <img src="{{asset('storage/category')}}/{{$category['icon']}}" class="w-100" alt="" />
                                </a>
                                <a href="shop-left-sidebar.html">
                                    <h5>{{ $category->name }}</h5>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/2.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>denim short</h5>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/3.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>Heels</h5>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/4.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>Shirt</h5>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/5.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>bag</h5>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/6.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>Hoodie</h5>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="categories-items">
                            <a href="shop-left-sidebar.html">
                                <img src="{{ asset('assets/front-end/assets/images/categories/7.png') }}" class="w-100" alt="" />
                            </a>
                            <a href="shop-left-sidebar.html">
                                <h5>swimwear</h5>
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Categories Section ========== -->

    <!-- ========== Start banner Section ========== -->
    <section class="bannre-section">
        <div class="custom-container">
            <div class="row g-sm-3 g-2">
                <div class="col-md-6 col-12 ratio_90">
                    <div class="banner-video">
                        <a href="shop-left-sidebar.html">
                            <img src="{{ asset('assets/front-end/assets/images/banner/6.jpg') }}" class="bg-img" alt="" />
                        </a>
                        <span>
                            <a href="#!" class="mt-0" data-bs-toggle="modal" data-bs-target="#video">
                                <i class="ri-play-mini-fill"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="row g-md-3 g-2">
                        <div class="col-12">
                            <div class="banner-box">
                                <img src="{{ asset('assets/front-end/assets/images/banner/1.jpg') }}" class="img-fluid" alt="" />
                                <div class="banner-content p-left-top">
                                    <div>
                                        <span>Save up to 20%OFF</span>
                                        <h3>Unisex Jacket</h3>
                                        <a href="shop-left-sidebar.html" class="btn solid-btn">
                                            <div class="button-text">
                                                <span>shop now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="banner-box">
                                <img src="{{ asset('assets/front-end/assets/images/banner/2.jpg') }}" class="img-fluid" alt="" />
                                <div class="banner-content p-left-top">
                                    <div>
                                        <span>Save up to 20%OFF</span>
                                        <h3>Nike Sneakers</h3>
                                        <a href="shop-left-sidebar.html" class="btn solid-btn">
                                            <div class="button-text">
                                                <span>shop now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End  banner Section ========== -->

    <!-- ========== Start product-tab Section ========== -->
    <section class="product-tab-section section-t-space section-b-space">
        <div class="custom-container">
            <div class="title-flex section-sm-b-space">
                <h2 class="title">Shop with edgy</h2>
                <nav class="tab-nav nav-style-1">
                    <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all"
                            type="button" role="tab" aria-controls="nav-all" aria-selected="true">
                            All
                        </button>
                        @foreach ($fourCategories as $fourCategory)
                            <button class="nav-link" id="{{ $fourCategory->slug }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $fourCategory->slug }}"
                                type="button" role="tab" aria-controls="{{ $fourCategory->slug }}" aria-selected="false">
                                {{ $fourCategory->name }}
                            </button>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                    <div class="row g-sm-4 g-3 ratio_product">
                        {{-- <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="off-label">20% off</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal" data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-carousel">
                                        <!-- Carousel for multiple product images -->
                                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <a href="shop-left-sidebar.html">
                                                        <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}" class="d-block w-100" alt="Product Image 1" />
                                                    </a>
                                                </div>
                                                <div class="carousel-item">
                                                    <a href="shop-left-sidebar.html">
                                                        <img src="{{ asset('assets/front-end/assets/images/product/back/1.jpg') }}" class="d-block w-100" alt="Product Image 2" />
                                                    </a>
                                                </div>
                                                <div class="carousel-item">
                                                    <a href="shop-left-sidebar.html">
                                                        <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}" class="d-block w-100" alt="Product Image 3" />
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Carousel controls -->
                                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Blend suit waistcoat</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/6.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/6.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Embroidered Logo Tee</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($fourCategories as $fourCategory)    
                    @php
                        $categoryProducts = App\Model\Product::whereJsonContains('category_ids', ["id" => (string)$fourCategory->id])->inRandomOrder()->take(4)->get();
                    @endphp
                    <div class="tab-pane fade" id="{{ $fourCategory->slug }}" role="tabpanel" aria-labelledby="{{ $fourCategory->slug }}-tab">
                        <div class="row g-sm-4 g-3 ratio_product">
                            @foreach ($categoryProducts as $categoryProduct)    
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="product-box">
                                        <div class="product-img-box">
                                            <div class="label-box">
                                                <label class="new-label">
                                                    @if ($categoryProduct->discount_type == 'percent')
                                                        {{ round($categoryProduct->discount, 2) }}%
                                                    @elseif($categoryProduct->discount_type == 'flat')
                                                        {{\App\CPU\Helpers::currency_converter($categoryProduct->discount)}}
                                                    @endif
                                                    {{\App\CPU\translate('off')}}
                                                </label>
                                                <div class="product-option">
                                                    <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                        <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                        <i class="ri-heart-3-line outline-icon like-two"></i>
                                                    </a>
                                                    <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                        data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                                    <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                                </div>
                                            </div>
                                            <div class="front">
                                                <a href="{{ route('frontend.productDetail',$categoryProduct->slug) }}">
                                                    <img src="{{ asset('storage/product/thumbnail/'.$categoryProduct->thumbnail) }}" class="bg-img w-100"
                                                        alt="" />
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="{{ route('frontend.productDetail',$categoryProduct->slug) }}">
                                                    <img src="{{ asset('storage/product/thumbnail/'.$categoryProduct->thumbnail_back) }}" class="bg-img w-100"
                                                        alt="" />
                                                </a>
                                            </div>
                                            <div class="product-btn">
                                                <a href="#!" class="btn solid-btn addtocart-btn">
                                                    <div class="button-text">
                                                        <span>add to cart</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <div class="product-name-box">
                                                <a href="{{ route('frontend.productDetail',$categoryProduct->slug) }}" class="product-name">{{ $categoryProduct->name }}</a>
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
                                                    $categoryProduct->unit_price-(\App\CPU\Helpers::get_product_discount($categoryProduct,$categoryProduct->unit_price))
                                                )}}
                                                @if ($categoryProduct->discount > 0)     
                                                    <del>
                                                        {{\App\CPU\Helpers::currency_converter($categoryProduct->unit_price)}}
                                                    </del>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                {{-- <div class="tab-pane fade" id="nav-Men" role="tabpanel" aria-labelledby="nav-Men-tab">
                    <div class="row g-sm-4 g-3 ratio_product">
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/5.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/5.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Round Nack White Tee</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
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
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/6.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/6.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Embroidered Logo Tee</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="off-label">20% off</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/7.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/7.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Charcoal Grey Printed
                                            Tee</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="off-label">20% off</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/8.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/8.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Oversized Crew-Neck
                                            T-Shirt</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Accessories" role="tabpanel" aria-labelledby="nav-Accessories-tab">
                    <div class="row g-sm-4 g-3 ratio_product">
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="off-label">20% off</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/10.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/10.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Cargo Bermuda shorts</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
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
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/12.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/12.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Linen Wide-Leg Pants</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
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
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/11.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/11.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Capri black trousers</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/13.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/13.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Animal print midi skirt</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Shoes" role="tabpanel" aria-labelledby="nav-Shoes-tab">
                    <div class="row g-sm-4 g-3 ratio_product">
                        <div class="col-lg-3 col-md-4 col-6">
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
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/14.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/14.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Halter Neck Mini Dress</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/15.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/15.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name"> Halter Neck Solid Maxi</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
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
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/20.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/20.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Black Beach Dress
                                        </a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-6">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="off-label">20% off</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/17.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/17.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Tie Dye Tied Backless
                                            Dress</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ========== End product-tab Section ========== -->

    <!-- ========== Start full-banner Section ========== -->
    <section class="full-banner-box">
        <img src="{{ asset('assets/front-end/assets/images/home-banner/5.jpg') }}" class="bg-img" alt="" />
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4 col-md-8 p-0 col-11 m-auto text-center">
                    <span>#NEWVARSITY JACKET</span>
                    <h3>Attire the Ideal Fit for Every Body</h3>
                    <a href="shop-left-sidebar.html" class="btn solid-btn">
                        <div class="button-text">
                            <span>shop now</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End full-banner Section ========== -->

    <!-- ========== Start seller Section ========== -->
    <section class="seller-section section-t-space section-b-space">
        <div class="custom-container">
            <div class="title-flex section-sm-b-space">
                <h2 class="title">Feature Products</h2>
                <div class="swiper-nav swiper-nav-box">
                    <div class="swiper-button-prev swiper-seller-prev">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next swiper-seller-next">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>
            <div class="seller-slider-box">
                <div class="swiper categories-swiper">
                    <div class="swiper-wrapper ratio_product">
                        @foreach ($featureProducts as $featureProduct)    
                            <div class="swiper-slide">
                                <div class="product-box">
                                    <div class="product-img-box">
                                        <div class="label-box">
                                            <label class="new-label">
                                                @if ($featureProduct->discount_type == 'percent')
                                                    {{ round($featureProduct->discount, 2) }}%
                                                @elseif($featureProduct->discount_type == 'flat')
                                                    {{\App\CPU\Helpers::currency_converter($featureProduct->discount)}}
                                                @endif
                                                {{\App\CPU\translate('off')}}
                                            </label>
                                            <div class="product-option">
                                                <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                    <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                    <i class="ri-heart-3-line outline-icon like-two"></i>
                                                </a>
                                                <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                    data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                                <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                            </div>
                                        </div>
                                        <div class="front">
                                            <a href="{{ route('frontend.productDetail',$featureProduct->slug) }}">
                                                <img src="{{ asset('storage/product/thumbnail/'.$featureProduct->thumbnail) }}" class="bg-img w-100"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="{{ route('frontend.productDetail',$featureProduct->slug) }}">
                                                <img src="{{ asset('storage/product/thumbnail/'.$featureProduct->thumbnail_back) }}" class="bg-img w-100"
                                                    alt="" />
                                            </a>
                                        </div>
                                        <div class="product-btn">
                                            <a href="#!" class="btn solid-btn addtocart-btn">
                                                <div class="button-text">
                                                    <span>add to cart</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-detail">
                                        <div class="product-name-box">
                                            <a href="{{ route('frontend.productDetail',$featureProduct->slug) }}" class="product-name">{{ $featureProduct->name }}</a>
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
                                                    $featureProduct->unit_price-(\App\CPU\Helpers::get_product_discount($featureProduct,$featureProduct->unit_price))
                                                )}}
                                            @if ($featureProduct->discount > 0)     
                                                <del>
                                                    {{\App\CPU\Helpers::currency_converter($featureProduct->unit_price)}}
                                                </del>
                                            @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="swiper-slide">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/9.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/9.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Crochet Striped Resort
                                            Shirt</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/17.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/17.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Tie Dye Tied Backless
                                            Dress</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/13.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/13.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Animal print midi
                                            skirt</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-box">
                                <div class="product-img-box">
                                    <div class="label-box">
                                        <label class="new-label">new</label>
                                        <div class="product-option">
                                            <a href="#!" class="like-btn wishlist-btn p-0 animate inactive">
                                                <i class="ri-heart-3-fill fill-icon fill-two"></i>
                                                <i class="ri-heart-3-line outline-icon like-two"></i>
                                            </a>
                                            <a href="#!" class="sub-link mt-0" data-bs-toggle="modal"
                                                data-bs-target="#view"><i class="ri-eye-line"></i></a>
                                            <a href="#!"><i class="ri-loop-right-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="front">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/7.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="back">
                                        <a href="shop-left-sidebar.html">
                                            <img src="{{ asset('assets/front-end/assets/images/product/back/7.jpg') }}" class="bg-img w-100"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-btn">
                                        <a href="#!" class="btn solid-btn addtocart-btn">
                                            <div class="button-text">
                                                <span>add to cart</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <div class="product-name-box">
                                        <a href="shop-left-sidebar.html" class="product-name">Charcoal Grey Printed
                                            Tee</a>
                                        <ul class="rating-product">
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-fill"></i></li>
                                            <li><i class="ri-star-line"></i></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-price">$36.00 <del>$95.00</del></h6>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End seller Section ========== -->

    <!-- ========== Start Testimonial Section ========== -->
    <section>
        <div class="custom-container">
            <div class="title-flex section-sm-b-space">
                <h2 class="title">testimonial</h2>
                <div class="swiper-nav swiper-nav-box">
                    <div class="swiper-button-prev swiper-testimonial-prev">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next swiper-testimonial-next">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>

            <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper ratio_product">
                    <div class="swiper-slide">
                        <div class="testimonial-box">
                            <i class="ri-double-quotes-l"></i>
                            <p>
                                Their dedication to quality and sustainability is evident in
                                every piece they offer. in every piece they offer.Their
                                dedication to quality and sustainability is evident in every
                                piece they offer. in every piece they offer.
                            </p>
                            <div class="testimonial-name-box">
                                <a href="#!" class="testimonial-img">
                                    <img src="{{ asset('assets/front-end/assets/images/testimonial/1.jpg') }}" alt="" />
                                </a>
                                <div class="testimonial-name">
                                    <h5>Emily Rodriguez</h5>
                                    <span>April 05, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box">
                            <i class="ri-double-quotes-l"></i>
                            <p>
                                In an era where consumers are more conscious of their
                                purchasing decisions, the demand for quality and
                                sustainability has never been higher. Companies that
                                prioritize these values are earning the trust and loyalty of
                                customers worldwide.
                            </p>
                            <div class="testimonial-name-box">
                                <a href="#!" class="testimonial-img">
                                    <img src="{{ asset('assets/front-end/assets/images/testimonial/2.jpg') }}" alt="" />
                                </a>
                                <div class="testimonial-name">
                                    <h5>Ava Ramirez</h5>
                                    <span>April 05, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box">
                            <i class="ri-double-quotes-l"></i>
                            <p>
                                Consumers recognize the difference between mass-produced goods
                                and those that are thoughtfully designed. When a company’s
                                commitment to quality is consistent, it fosters customer
                                loyalty.
                            </p>
                            <div class="testimonial-name-box">
                                <a href="#!" class="testimonial-img">
                                    <img src="{{ asset('assets/front-end/assets/images/testimonial/3.jpg') }}" alt="" />
                                </a>
                                <div class="testimonial-name">
                                    <h5>Olivia Hernandez</h5>
                                    <span>April 10, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box">
                            <i class="ri-double-quotes-l"></i>
                            <p>
                                As environmental concerns grow, companies are taking
                                responsibility for their ecological footprint. From using
                                eco-friendly materials to minimizing waste in production,
                                sustainable practices have become a competitive advantage.
                            </p>
                            <div class="testimonial-name-box">
                                <a href="#!" class="testimonial-img">
                                    <img src="{{ asset('assets/front-end/assets/images/testimonial/4.jpg') }}" alt="" />
                                </a>
                                <div class="testimonial-name">
                                    <h5>Sophia Martinez</h5>
                                    <span>April 06, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-box">
                            <i class="ri-double-quotes-l"></i>
                            <p>
                                Beyond product quality and sustainability, ethical sourcing
                                and fair labor practices are essential components of a
                                responsible brand. Companies that prioritize human welfare and
                                ethical treatment of workers gain support from socially
                                conscious consumers.
                            </p>
                            <div class="testimonial-name-box">
                                <a href="#!" class="testimonial-img">
                                    <img src="{{ asset('assets/front-end/assets/images/testimonial/1.jpg') }}" alt="" />
                                </a>
                                <div class="testimonial-name">
                                    <h5>Isabella Gomez</h5>
                                    <span>April 07, 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End Testimonial Section ========== -->

    <!-- ========== Start instagram Section ========== -->
    <section class="section-t-space">
        <div class="container-fluid p-0">
            <div class="swiper instagram-two">
                <div class="swiper-wrapper ratio_square">
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/1.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/2.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/3.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/4.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/5.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/6.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <a href="https://www.instagram.com/">
                                <div class="instagram-box">
                                    <img src="{{ asset('assets/front-end/assets/images/instagram/7.jpg') }}" class="bg-img w-100" alt="" />
                                    <div class="overlay-img">
                                        <i class="ri-instagram-line"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========== End instagram Section ========== -->

    <!-- ========== Start video modal Section ========== -->
    <div class="modal video-modal fade" id="video" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <video controls autoplay>
                        <source src="{{ asset('assets/front-end/assets/images/product-video/1.mp4') }}" type="video/mp4" />
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== End video modal Section ========== -->

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
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/2.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/3.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/4.jpg') }}" />
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
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/1.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/2.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/3.jpg') }}" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('assets/front-end/assets/images/product/front/4.jpg') }}" />
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
                                            <span>add to cart</span>
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
