@extends('layouts.back-end.app')

@section('title', ('Seller List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Sellers')}}</li>
            </ol>
        </nav>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row row justify-content-between align-items-center flex-grow-1 mx-1">
                            <div class="flex-between">
                                <div><h5>{{('seller table')}}</h5></div>
                                <div class="mx-1"><h5 style="color: red;">({{ $sellers->total() }})</h5></div>
                            </div>
                            <div style="width: 40vw">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{('Search by Name or Phone or Email')}}" aria-label="Search orders" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table
                                style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{('SL#')}}</th>
                                    <th scope="col" style="width: 50px">{{('action')}}</th>
                                    <th scope="col">{{('name')}}</th>
                                    <th scope="col">{{('Phone')}}</th>
                                    <th scope="col">{{('Email')}}</th>
                                    <th scope="col">{{('KYC Proof')}}</th>
                                    <th scope="col">{{('status')}}</th>
                                    <th scope="col">{{('orders')}}</th>
                                    <th scope="col">{{('Products')}}</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sellers as $key=>$seller)
                                    <tr>
                                        <td scope="col">{{$sellers->firstItem()+$key}}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                               href="{{route('admin.sellers.view',$seller->id)}}">
                                                {{('View')}}
                                            </a>
                                        </td>
                                        <td scope="col">{{$seller->f_name}} {{$seller->l_name}}</td>
                                        <td scope="col">{{$seller->phone}}</td>
                                        <td scope="col">{{$seller->email}}</td>
                                        <td>
                                            <a href="{{asset('storage/app/public/seller/')}}/{{$seller->kycimage}}" target="blank"><img style="width: 60px;height: 60px"
                                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{asset('storage/app/public/seller/')}}/{{$seller->kycimage}}"></a>
                                        </td>

                                        <td scope="col">
                                            {!! $seller->status=='approved'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">In-Active</label>' !!}
                                        </td>
                                        <td scope="col">
                                            <a href="{{route('admin.sellers.order-list',[$seller['id']])}}"
                                               class="btn btn-outline-primary btn-block">
                                                <i class="tio-shopping-cart-outlined"></i>( {{$seller->orders->count()}}
                                                )
                                            </a>
                                        </td>
                                        <td scope="col">
                                            <a href="{{route('admin.sellers.product-list',[$seller['id']])}}"
                                               class="btn btn-outline-primary btn-block">
                                                <i class="tio-premium-outlined mr-1"></i>( {{$seller->product->count()}}
                                                )
                                            </a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $sellers->links() !!}
                    </div>
                    @if(count($sellers)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{('No data to show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
