@extends('layouts.front-end.app')

@section('title', 'Not Found')

@section('content')
    <!-- ========== Start breadcrumb Section ========== -->
    <nav class="breadcrumb section-md-t-space section-md-b-space">
        <div class="custom-container">
            <img src="{{ asset('assets/front-end/assets/images/breadcrumb-img.png') }}" class="img-fluid breadcrumb-img"
                alt="breadcrumb-img" />
            <div class="breadcrumb-box">
                <a class="breadcrumb-item" href="index.html">home</a>
                <span class="breadcrumb-item active" aria-current="page">404</span>
            </div>
        </div>
    </nav>
    <!-- ========== End breadcrumb Section ========== -->
    <!-- ========== Start 404  Section ========== -->
    <section class="error-section section-t-space section-b-space">
        <div class="custom-container">
            <a href="#!" class="error-img">
                <img src="{{ asset('assets/front-end/assets/images/404-error.png') }}" class="img-fluid" alt="" />
            </a>
            <div class="error-detail section-sm-t-space">
                <h3>page not found</h3>
                <p>
                    sorry, we can't find the page you are looking for click
                    <span>here</span>
                    to go back to the home page
                </p>
                <a href="index.html" class="btn solid-btn">
                    <div class="button-text">
                        <span>Go to home</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
