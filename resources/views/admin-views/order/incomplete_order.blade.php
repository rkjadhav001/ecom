@extends('layouts.back-end.app')

@section('title', ('Incomplete order'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-1">
            <div class="flex-between align-items-center">
                <div>
                    <h1 class="page-header-title">{{('Incomplete order')}} <span
                            class="badge badge-soft-dark mx-2">{{$orders->total()}}</span></h1>
                </div>
                <div>
                    <i class="tio-shopping-cart" style="font-size: 30px"></i>
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
                        <a class="nav-link active" href="#">{{('Incomplete order')}}</a>
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
                <div class="flex-between justify-content-between align-items-center flex-grow-1">
                    <div>
                        <form action="{{ url()->current() }}" method="GET">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                       placeholder="{{('Search orders')}}" aria-label="Search orders" value="{{ $search }}"
                                       required>
                                <button type="submit" class="btn btn-primary">{{('search')}}</button>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                            {{('SL')}}#
                        </th>
                        <th class=" ">{{('Order')}}</th>
                        <th>{{('Date')}}</th>
                        <th>{{('seller name')}}</th>
                        <th>{{('Shop name')}}</th>
                        <th>{{('customer_name')}}</th>
                        
                        <th>{{('Product Name')}}</th>
                        <th>{{('Price')}}</th>
                        <th>{{('tex')}}</th>
                        <th>{{('discount')}}</th>
                        <th>{{('Product Image')}}</th>
                        <!-- <th>{{('Action')}}</th> -->
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $key=>$order)

                        <tr class="status-{{$order['order_status']}} class-all">
                            <td class="">
                                {{$orders->firstItem()+$key}}
                            </td>
                            <td class="table-column-pl-0">
                               {{$order['id']}}
                            </td>
                            <td>{{date('d M Y h:i A',strtotime($order['created_at']))}}</td>

                            <td> {{$order->seller['f_name']}}</td>
                            <td> {{$order->shop_info}}</td>
                            <td>
                                @if($order->customer)
      
                                    <a class="text-capitalize"
                                       href="{{route('admin.customer.view',[$order['customer_id']])}}"">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
                                @else
                                    <label class="badge badge-danger">{{('invalid_customer_data')}}</label>
                                @endif
                            </td>
                            

                            <td> {{$order->name}}</td>
                            <td> {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->price))}}</td>

                            <td> {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->tax))}}</td>

                            <td> {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->discount))}}</td>


                            <td>
                                <img width="80"
                                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                        src="{{asset('storage/app/public/product/thumbnail/')}}/{{$order['thumbnail']}}">
                            </td>

                            
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            {!! $orders->links() !!}
                        </div>
                    </div>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
    <script>
        function filter_order() {
            $.get({
                url: '{{route('admin.orders.inhouse-order-filter')}}',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success('{{('order_filter_success')}}');
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        };
    </script>
@endpush
