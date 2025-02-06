<header class="header-wrapper {{ Route::currentRouteName() == 'frontend.home' ? 'header-two' : '' }}">
    <div class="main-header">
        <div class="custom-container">
            <div class="main-sub-head">
                <div class="left-header">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryMenu"
                        aria-controls="primaryMenu">
                        <span><i class="ri-align-left text-dark"></i></span>
                    </button>
                    <a href="{{ route('frontend.home') }}" class="main-logo">
                        <img src="{{ asset('storage/company/fashion-clickz-logo.png') }}" class="light-logo"
                            alt="" />
                        <img src="{{ asset('assets/front-end/assets/images/logo/logo-white-2.svg') }}" class="dark-logo"
                            alt="" />
                    </a>
                </div>

                <!-- Navigation Start -->
                <nav class="navigation">
                    <div class="nav-section">
                        <div class="header-section">
                            <div class="navbar navbar-expand-xl navbar-light navbar-sticky p-0">
                                <div class="offcanvas sidebar-menu offcanvas-collapse order-lg-2" id="primaryMenu">
                                    <div class="offcanvas-header sidebar-offcanvas">
                                        <h5 class="mt-1 mb-0">Menu</h5>
                                        <button class="close-offcanvas lead" type="button" data-bs-dismiss="offcanvas"
                                            aria-label="Close">
                                            <i class="ri-close-fill"></i>
                                        </button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <!-- Menu-->
                                        <ul class="navbar-nav">
                                            <!-- Home -->
                                            <li class="nav-item dropdown dropdown-mega">
                                                <a class="nav-link dropdown-toggle text-dark" href="#">Home</a>
                                            </li>

                                            <!-- Shop -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-dark" href="#"
                                                    data-bs-toggle="dropdown">Shop</a>
                                                <div class="dropdown-menu custom-drop-menu">
                                                    <div class="dropdown-column">
                                                        <a class="dropdown-item" href="shop-left-sidebar.html">Shop Left
                                                            Sidebar</a>
                                                        <a class="dropdown-item" href="shop-right-sidebar.html">Shop
                                                            Right Sidebar</a>
                                                        <a class="dropdown-item" href="shop-no-sidebar.html">Shop No
                                                            Sidebar</a>
                                                        <a class="dropdown-item" href="shop-hide.html">Shop hide</a>
                                                        <a class="dropdown-item" href="shop-sub-categories.html">Shop
                                                            Categories</a>
                                                        <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                                        <a class="dropdown-item" href="shop-canvas.html">Shop
                                                            Canvas</a>
                                                        <a class="dropdown-item" href="shop-top-filter.html">Shop Top
                                                            Filter</a>
                                                        <a class="dropdown-item" href="shop-pagination.html">Shop
                                                            pagination</a>
                                                        <a class="dropdown-item" href="shop-3-grid.html">Shop 3
                                                            Grid</a>
                                                        <a class="dropdown-item" href="shop-top-banner.html">Shop top
                                                            banner</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- Product -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-dark" href="#"
                                                    data-bs-toggle="dropdown">Product</a>
                                                <div class="dropdown-menu custom-drop-menu">
                                                    <div class="dropdown-column">
                                                        <a class="dropdown-item" href="product-4-image.html">Product 4
                                                            Images</a>
                                                        <a class="dropdown-item"
                                                            href="product-left-thumbnail.html">product left thumbnail
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="product-right-thumbnail.html">Product right
                                                            thumbnail</a>
                                                        <a class="dropdown-item"
                                                            href="product-no-thumbnail.html">Product no thumbnail</a>
                                                        <a class="dropdown-item"
                                                            href="product-bottom-thumbnail.html">Product bottom
                                                            thumbnail</a>
                                                        <a class="dropdown-item" href="product-accordion.html">Product
                                                            accordion</a>
                                                        <a class="dropdown-item" href="product-bundle.html">product
                                                            bundle</a>
                                                        <a class="dropdown-item" href="product-image-popup.html">product
                                                            image popup</a>
                                                        <a class="dropdown-item" href="product-pre-order.html">product
                                                            pre order</a>
                                                        <a class="dropdown-item" href="product-zoom.html">product
                                                            zoom</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- edgy Plus -->
                                            <li class="nav-item dropdown dropdown-mega">
                                                <a class="nav-link dropdown-toggle text-dark" href="#"
                                                    data-bs-toggle="dropdown">edgy Plus</a>
                                                <div class="dropdown-menu mega-element-menu">
                                                    <div class="row g-4">
                                                        <div class="col-xl-4 pe-xl-0">
                                                            <div class="link-box">
                                                                <h5>Portfolio Pages</h5>
                                                                <div class="dropdown-column">
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-2-grid-filter.html">Portfolio 2
                                                                        Grid Filter</a>
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-3-columns.html">Portfolio 3
                                                                        columns</a>
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-3-grid-filter.html">Portfolio 3
                                                                        Grid Filter</a>
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-4-columns.html">Portfolio 4
                                                                        columns</a>
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-detail.html">Portfolio
                                                                        details</a>
                                                                    <a class="dropdown-item"
                                                                        href="portfolio-filter.html">Portfolio
                                                                        filter</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-4 p-xl-0">
                                                            <div class="link-box">
                                                                <h5>Email Template</h5>
                                                                <div class="dropdown-column">
                                                                    <a class="dropdown-item"
                                                                        href="email-template/welcome-email.html">welcome
                                                                        Email</a>
                                                                    <a class="dropdown-item"
                                                                        href="email-template/black-friday.html">Black
                                                                        Friday Email</a>
                                                                    <a class="dropdown-item"
                                                                        href="email-template/summer-sale.html">summer
                                                                        Sale Email</a>
                                                                    <a class="dropdown-item"
                                                                        href="email-template/order-success.html">Order
                                                                        Success Email</a>
                                                                    <a class="dropdown-item"
                                                                        href="email-template/reset-password.html">reset
                                                                        password Email</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-4 p-xl-0">
                                                            <div class="link-box">
                                                                <h5>Invoice Pages</h5>
                                                                <div class="dropdown-column">
                                                                    <a class="dropdown-item"
                                                                        href="invoice/invoice-1.html">Invoice One</a>
                                                                    <a class="dropdown-item"
                                                                        href="invoice/invoice-2.html">Invoice Two</a>
                                                                    <a class="dropdown-item"
                                                                        href="invoice/invoice-3.html">Invoice Three</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <div class="link-box">
                                                                <div class="mega-header-img">
                                                                    <div class="swiper header-slider">
                                                                        <div class="swiper-wrapper">
                                                                            <div class="swiper-slide">
                                                                                <a href="#"><img
                                                                                        class="img-fluid"
                                                                                        src="{{ asset('assets/front-end/assets/images/header-img/1.jpg') }}"
                                                                                        alt="" /></a>
                                                                            </div>
                                                                            <div class="swiper-slide">
                                                                                <a href="#"><img
                                                                                        class="img-fluid"
                                                                                        src="{{ asset('assets/front-end/assets/images/header-img/2.jpg') }}"
                                                                                        alt="" /></a>
                                                                            </div>
                                                                            <div class="swiper-slide">
                                                                                <a href="#"><img
                                                                                        class="img-fluid"
                                                                                        src="{{ asset('assets/front-end/assets/images/header-img/3.jpg') }}"
                                                                                        alt="" /></a>
                                                                            </div>
                                                                            <div class="swiper-slide">
                                                                                <a href="#"><img
                                                                                        class="img-fluid"
                                                                                        src="{{ asset('assets/front-end/assets/images/header-img/4.jpg') }}"
                                                                                        alt="" /></a>
                                                                            </div>
                                                                            <div class="swiper-slide">
                                                                                <a href="#"><img
                                                                                        class="img-fluid"
                                                                                        src="{{ asset('assets/front-end/assets/images/header-img/5.jpg') }}"
                                                                                        alt="" /></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- Pages -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-dark" href="#"
                                                    data-bs-toggle="dropdown">Pages</a>
                                                <div class="dropdown-menu custom-drop-menu">
                                                    <div class="dropdown-column">
                                                        <a class="dropdown-item" href="404.html">404</a>
                                                        <a class="dropdown-item" href="about-us.html">About Us
                                                        </a>
                                                        <a class="dropdown-item" href="cart.html">Cart</a>
                                                        <a class="dropdown-item" href="check-out.html">Checkout</a>
                                                        <a class="dropdown-item" href="coming-soon.html">Coming
                                                            Soon</a>
                                                        <a class="dropdown-item" href="compare.html">Compare</a>
                                                        <a class="dropdown-item" href="contact-us.html">Contact Us</a>
                                                        <a class="dropdown-item" href="faqs.html">Faqs</a>
                                                        <a class="dropdown-item" href="order-success.html">Order
                                                            Success</a>
                                                        <a class="dropdown-item"
                                                            href="order-tracking.html">Order-tracking</a>
                                                        <a class="dropdown-item" href="search.html">Search</a>
                                                        <a class="dropdown-item" href="user-dashboard.html">User
                                                            Dashboard</a>
                                                        <a class="dropdown-item" href="wishlist.html">Wishlist</a>
                                                    </div>
                                                </div>
                                            </li>

                                            <!-- Blog -->
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-dark" href="#"
                                                    data-bs-toggle="dropdown">Blog</a>
                                                <div class="dropdown-menu custom-drop-menu">
                                                    <div class="dropdown-column">
                                                        <a class="dropdown-item" href="blog-detail.html">Blog
                                                            Details</a>
                                                        <a class="dropdown-item" href="blog-grid.html">Blog Grid
                                                        </a>
                                                        <a class="dropdown-item" href="blog-list.html">Blog List</a>
                                                        <a class="dropdown-item" href="blog-left-sidebar.html">blog
                                                            left sidebar</a>
                                                        <a class="dropdown-item" href="blog-no-sidebar.html">
                                                            blog no Sidebar</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navigation End -->

                <ul class="user-section main-user-menu">
                    <li class="home-icon">
                        <a href="index.html" class="active text-dark"><i class="ri-home-4-line"></i></a>
                    </li>
                    <li class="search-menu">
                        <a href="#!" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight"><i class="ri-search-line text-dark"></i>
                        </a>
                    </li>
                    <li>
                        <a href="wishlist.html"><i class="ri-heart-line text-dark"></i></a>
                    </li>
                    <li class="menu-link">
                        <a href="#!" onclick="openNav()"><i class="ri-shopping-bag-2-line text-dark"></i>
                            <span class="cart-box text-white"> 2 </span>
                        </a>
                        <div class="sub-menu cart-items" id="mySidenav">
                            <div class="cart-header">
                                <h5>Your cart</h5>
                                <button onclick="closeNav()" class="close-btn">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <h5>My Cart</h5>
                            <div class="product-contain">
                                <div class="cart-menu">
                                    <a href="product-left-thumbnail.html" class="cart-img-box">
                                        <img src="{{ asset('assets/front-end/assets/images/product/front/22.jpg') }}"
                                            class="cart-img img-fluid" alt="" />
                                    </a>
                                    <div class="drop-cart">
                                        <div>
                                            <a href="#!">
                                                <h6>Concrete Jungle Pack</h6>
                                            </a>
                                            <p>
                                                $80.58
                                                <del>$20.00</del>
                                            </p>
                                        </div>
                                        <button class="close-btn">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="cart-menu">
                                    <a href="product-left-thumbnail.html" class="cart-img-box">
                                        <img src="{{ asset('assets/front-end/assets/images/product/front/21.jpg') }}"
                                            class="cart-img img-fluid" alt="" />
                                    </a>
                                    <div class="drop-cart">
                                        <div>
                                            <a href="#!">
                                                <h6>Stylish Jacket</h6>
                                            </a>
                                            <p>
                                                $80.58
                                                <del>$18.20</del>
                                            </p>
                                        </div>
                                        <button class="close-btn">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="cart-menu pb-0 border-0">
                                    <a href="product-left-thumbnail.html" class="cart-img-box">
                                        <img src="{{ asset('assets/front-end/assets/images/product/front/20.jpg') }}"
                                            class="cart-img img-fluid" alt="" />
                                    </a>
                                    <div class="drop-cart">
                                        <div>
                                            <a href="#!">
                                                <h6>Cardigan Sweater</h6>
                                            </a>
                                            <p>
                                                $80.58
                                                <del>$14.00</del>
                                            </p>
                                        </div>
                                        <button class="close-btn">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-price">
                                <h6>Total:</h6>
                                <h5>$100.00</h5>
                            </div>
                            <div class="btn-group-cart">
                                <a href="cart.html" class="btn solid-btn w-100">
                                    <div class="button-text">
                                        <span>view cart</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="menu-link">
                        <a href="user-dashboard.html" class="user-box">
                            <i class="ri-user-3-line text-dark"></i>
                            <div class="user-detail">
                                <h6 class="text-dark">Hello,</h6>
                                <h5 class="text-dark">My Account</h5>
                            </div>
                        </a>
                        <ul class="sub-menu login-menu">
                            <li><a href="login.html" class="sub-link mt-0">log in</a></li>
                            <li>
                                <a href="register.html" class="sub-link mt-0">Register</a>
                            </li>
                            <li>
                                <a href="forgot-password.html" class="sub-link mt-0">Forgot password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
