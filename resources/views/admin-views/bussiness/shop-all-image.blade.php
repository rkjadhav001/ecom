@extends('layouts.back-end.app')

@section('title', 'All Shop Images')

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center mb-3">
            <div class="col-sm">
                <h1 class="page-header-title">{{('Bussiness Shop Image')}}
                    <span class="badge badge-soft-dark ml-2">{{$BussinessImages->count()}}</span>
                </h1>
            </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
        <span class="hs-nav-scroller-arrow-prev" style="display: none;">
          <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="tio-chevron-left"></i>
          </a>
        </span>

            <span class="hs-nav-scroller-arrow-next" style="display: none;">
          <a class="hs-nav-scroller-arrow-link" href="javascript:;">
            <i class="tio-chevron-right"></i>
          </a>
        </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">{{('Bussiness Shop Image')}} {{('List')}} </a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->

    <!-- Card -->
    <div class="card">
        <!-- Header -->
        <div class="card-header">
            <div class="flex-between row justify-content-between align-items-center flex-grow-1 mx-1">
                        <div>
                            <div class="flex-start">
                                <div><h5>{{ ('Bussiness')}} {{ ('Shop Image')}}</h5></div>
                                <div class="mx-1"><h5 style="color: red;"></h5></div>
                            </div>
                        </div>
                        
                      
                    </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->
        <div class="container-fluid"> 
            <div class="row"> <!-- Add the row class here -->
                @foreach($BussinessImages as $shop)
                <div class="col-md-4 col-lg-3 mb-4 p-5">
                    <div class="card" style="    text-align: center;">
                        <a href="{{ asset('bussiness/'.$shop->image) }}">
                        <img class=""
                            src="{{ asset('bussiness/'.$shop->image) }}" 
                            alt="{{ $shop->name }} image" 
                            onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                            style="height: 200px; object-fit: cover;">
                            {{-- <div class="card-body text-center">
                                <h5 class="card-title">{{ \App\Model\Business::where('id', $shop->bussiness_id)->first()->name }}</h5>
                            </div> --}}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        
        

        <!-- Footer -->
        
       
        <!-- End Footer -->
    </div>
    <!-- End Card -->
</div>



@endsection
