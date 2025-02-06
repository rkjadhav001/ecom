@extends('layouts.back-end.app')



@section('title', ('Order Details'))



@push('css_or_js')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        .sellerName {

            height: fit-content;

            margin-top: 10px;

            margin-left: 10px;

            font-size: 16px;

            border-radius: 25px;

            text-align: center;

            padding-top: 10px;

        }

        .avatar-xl {

            width: 4.92188rem;

            height: 1.0rem; 

        }



    </style>

@endpush



@section('content')

    <div class="content container-fluid">

        <!-- Page Header -->

        <div class="page-header d-print-none p-3" style="background: white">

            <div class="row align-items-center">

                <div class="col-sm mb-2 mb-sm-0">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb breadcrumb-no-gutter">

                            <li class="breadcrumb-item"><a class="breadcrumb-link"

                                                           href="{{route('admin.orders.list',['status'=>'all'])}}">{{('Orders')}}</a>

                            </li>

                            <li class="breadcrumb-item active"

                                aria-current="page">{{('Order')}} {{('details')}} </li>

                        </ol>

                    </nav>



                    <div class="d-sm-flex align-items-sm-center">

                        <h1 class="page-header-title">{{('Order')}} #{{$order['id']}}</h1>



                        @if($order['payment_status']=='paid')

                            <span class="badge badge-soft-success ml-sm-3">

                                <span class="legend-indicator bg-success"></span>{{('Paid')}}

                            </span>

                        @else

                            <span class="badge badge-soft-danger ml-sm-3">

                                <span class="legend-indicator bg-danger"></span>{{('Unpaid')}}

                            </span>

                        @endif



                        @if($order['order_status']=='pending')

                            <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">

                              <span class="legend-indicator bg-info text"></span>{{str_replace('_',' ',$order['order_status'])}}

                            </span>

                        @elseif($order['order_status']=='failed')

                            <span class="badge badge-danger ml-2 ml-sm-3 text-capitalize">

                              <span class="legend-indicator bg-info"></span>{{str_replace('_',' ',$order['order_status'])}}

                            </span>

                        @elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery')

                            <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">

                              <span class="legend-indicator bg-warning"></span>{{str_replace('_',' ',$order['order_status'])}}

                            </span>

                        @elseif($order['order_status']=='delivered' || $order['order_status']=='confirmed')

                            <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">

                              <span class="legend-indicator bg-success"></span>{{str_replace('_',' ',$order['order_status'])}}

                            </span>

                        @else

                            <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">

                              <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}

                            </span>

                        @endif

                        <span class="ml-2 ml-sm-3">

                        <i class="tio-date-range"></i> {{date('d M Y H:i:s',strtotime($order['created_at']))}}

                        </span>



                        @if(\App\CPU\Helpers::get_business_settings('order_verification'))

                            <span class="ml-2 ml-sm-3">

                                <b>

                                    {{('order verification code')}} : {{$order['verification_code']}}

                                </b>

                            </span>

                        @endif

                    </div>

                    <div class="col-md-6 mt-2">

                    

                        <a class="text-body mr-3" target="_blank"

                           href={{route('admin.orders.generate-invoice',[$order['id']])}}>

                            <i class="tio-print mr-1"></i> {{('Print')}} {{('invoice')}}

                        </a>

                    </div>



                    <div class="row">

                        <div class="col-6 mt-4">

                            <label class="badge badge-info">{{('linked orders')}}

                                : {{$linked_orders->count()}}</label><br>

                            @foreach($linked_orders as $linked)

                                <a href="{{route('admin.orders.details',[$linked['id']])}}" class="btn btn-secondary">{{('ID')}}

                                    :{{$linked['id']}}</a>

                            @endforeach

                        </div>



                        <div class="col-6">

                            <div class="hs-unfold float-right">

                                <div class="dropdown">

                                    <select id="change_status" name="order_status" onchange="order_status(this.value)"

                                            class="status form-control"

                                            data-id="{{$order['id']}}">

                                        <option

                                            value="" selected disabled> {{('Select')}}</option>



                                        {{-- <option

                                            value="pending" {{$order->order_status == 'pending'?'selected':''}} > {{('Pending')}}</option> --}}

                                            <option

                                            value="confirmed" {{$order->order_status == 'confirmed'?'selected':''}} > {{('Confirmed')}}</option>

                                        {{-- <option

                                            value="processing" {{$order->order_status == 'processing'?'selected':''}} >{{('Processing')}} </option> --}}

                                        <option class="text-capitalize"

                                                value="out_for_delivery" {{$order->order_status == 'out_for_delivery'?'selected':''}} >{{('out for delivery')}} </option>

                                        <option

                                            value="delivered" {{$order->order_status == 'delivered'?'selected':''}} >{{('Delivered')}} </option>

                                        {{--<option

                                            value="returned" {{$order->order_status == 'returned'?'selected':''}} > {{('Returned')}}</option>

                                        <option

                                            value="failed" {{$order->order_status == 'failed'?'selected':''}} >{{('Failed')}} </option>--}}

                                        <option

                                            value="canceled" {{$order->order_status == 'canceled'?'selected':''}} >{{('Cancelled')}} </option>

                                    </select>

                                </div>

                            </div>

                            {{-- <div class="hs-unfold float-right pr-2">

                                <div class="dropdown">

                                    <select name="payment_status" class="payment_status form-control"

                                            data-id="{{$order['id']}}">



                                        <option

                                            onclick="route_alert('{{route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'paid'])}}','Change status to paid ?')"

                                            href="javascript:"

                                            value="paid" {{$order->payment_status == 'paid'?'selected':''}} >

                                            {{('Paid')}}

                                        </option>

                                        <option value="unpaid" {{$order->payment_status == 'unpaid'?'selected':''}} >

                                            {{('Unpaid')}}

                                        </option>



                                    </select>

                                </div>

                            </div> --}}

                        </div>

                    </div>

                    <!-- End Unfold -->

                </div>

            </div>

        </div>



        <!-- End Page Header -->



        <div class="row" id="printableArea">

            <div class="col-lg-8 mb-3 mb-lg-0">

                <!-- Card -->

                <div class="card mb-3 mb-lg-5">

                    <!-- Header -->

                    <div class="card-header" style="display: block!important;">

                        <div class="row">

                            <div class="col-12 pb-2 border-bottom">

                                <h4 class="card-header-title">

                                    {{('Order')}} {{('details')}}

                                    <span

                                        class="badge badge-soft-dark rounded-circle ml-1">{{$order->details->count()}}</span>

                                </h4>

                            </div>

                            <div class="col-6 pt-2">



                            @foreach($order->details as $key=>$detail)



                            @if($detail->product)

                            @if ($key==0)

                                    @if($detail->product->added_by=='admin')

                                        <div class="row">

                                            <img

                                                class="avatar-img" style="width: 55px;height: 55px; border-radius: 50%;"

                                                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"

                                                src="{{asset('storage/company/'.\App\Model\BusinessSetting::where(['type' => 'company_web_logo'])->first()->value)}}"

                                                alt="Image">

                                            <p class="sellerName">

                                                <a style="color: black;"

                                                   href="javascript:">

                                                    {{ \App\Model\BusinessSetting::where(['type' => 'company_name'])->first()->value }}

                                                </a>

                                            </p>

                                        </div>

                                    @else

                                        <div class="row">

                                            <img

                                                class="avatar-img" style="width: 55px;height: 55px; border-radius: 50%;"

                                                onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"

                                                src="{{asset('storage/shop/'.\App\Model\Shop::where('seller_id','=',$detail->seller_id)->first()->image)}}"

                                                alt="Image">

                                            <p class="sellerName">

                                                <a style="color: black;"

                                                   href="{{route('admin.sellers.view',$detail->seller_id)}}">{{ \App\Model\Shop::where('seller_id','=',$detail->seller_id)->first()->name}}</a>

                                                <i class="tio tio-info-outined ml-4" data-toggle="collapse"

                                                   style="font-size: 20px; cursor: pointer"

                                                   data-target="#sellerInfoCollapse-{{ $detail->id }}"

                                                   aria-expanded="false"></i>

                                            </p>

                                        </div>



                                        @php($seller = App\Model\Seller::with('shop')->find($detail->seller_id))

                                        <div class="collapse" id="sellerInfoCollapse-{{ $detail->id }}">

                                            <div class="row card-body mb-3">

                                                <div class="col-6">

                                                    <h4>

                                                        {{('Status')}}

                                                        : {!! $seller->status=='approved'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">In-Active</label>' !!}

                                                    </h4>

                                                    <h5>{{('Email')}} : <a

                                                            class="text-dark"

                                                            href="mailto:{{ $seller->email }}">{{ $seller->email }}</a>

                                                    </h5>

                                                </div>

                                                <div class="col-6">

                                                    <h5>{{('name')}} : <a

                                                            class="text-dark"

                                                            href="{{ route('admin.sellers.view', [$seller['id']]) }}">{{ $seller['shop']->name }}</a>

                                                    </h5>

                                                    <h5>{{('Phone')}} : <a

                                                            class="text-dark"

                                                            href="tel:{{ $seller->phone }}">{{ $seller->phone }}</a>

                                                    </h5>

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                @endif

                                @endif

                                @endforeach



                            </div>

                            <div class="col-6 pt-2">

                                <div class="text-right">

                                    <h6 class="" style="color: #8a8a8a;">

                                        {{('Payment')}} {{('Method')}}

                                        : {{str_replace('_',' ',$order['payment_method'])}}

                                    </h6>

                                    <h6 class="" style="color: #8a8a8a;">

                                        {{('Payment')}} {{('reference')}}

                                        : {{str_replace('_',' ',$order['transaction_ref'])}}

                                    </h6>

                                    <!--<h6 class="" style="color: #8a8a8a;">-->

                                    <!--    {{('shipping')}} {{('method')}}-->

                                    <!--    : {{$order->shipping ? $order->shipping->title :'No shipping method selected'}}-->

                                    <!--</h6>-->

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- End Header -->



                    <!-- Body -->

                    <div class="card-body">

                        <div class="media">

                            <div class="avatar avatar-xl mr-3">

                                <p>{{('image')}}</p>

                            </div>



                            <div class="media-body">

                                <div class="row">

                                    <div class="col-md-4 product-name">

                                        <p> {{('Name')}}</p>

                                    </div>



                                    <div class="col col-md-2 align-self-center p-0 ">

                                        <p> {{('price')}}</p>

                                    </div>



                                    <div class="col col-md-1 align-self-center">

                                        <p>Q</p>

                                    </div>

                                    <div class="col col-md-1 align-self-center  p-0 product-name">

                                        <p> {{('TAX')}}</p>

                                    </div>

                                    <div class="col col-md-2 align-self-center  p-0 product-name">

                                        <p> {{('Discount')}}</p>

                                    </div>



                                    <div class="col col-md-2 align-self-center text-right  ">

                                        <p> {{('Subtotal')}}</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @php($subtotal=0)

                        @php($total=0)

                        @php($shipping=0)

                        @php($discount=0)

                        @php($tax=0)

                        @foreach($order->details as $key=>$detail)

                            

                            @if($detail->product)

                               

                            <!-- Media -->

                                <div class="media">

                                    <div class="avatar avatar-xl mr-3">

                                        <img class="img-fluid"

                                             onerror="this.src='{{asset('assets/back-end/img/160x160/img2.jpg')}}'"

                                             src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$detail->product['thumbnail']}}" style="width: 60% !important"

                                             alt="Image Description">

                                    </div>



                                    <div class="media-body">

                                        <div class="row">

                                            <div class="col-md-4 mb-3 mb-md-0 product-name">

                                                <p>

                                                    {{substr($detail->product['name'],0,30)}}{{strlen($detail->product['name'])>10?'...':''}}</p>

                                                @if ($detail['variant'])
                                                <strong><u>{{('Variation')}} : </u></strong>
                                                @endif



                                                <div class="font-size-sm text-body">



                                                    <span class="font-weight-bold">{{$detail['variant']}}</span>

                                                </div>



                                                



                                                

                                            </div>



                                            <div class="col col-md-2 align-self-center p-0 ">

                                                <h6>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($detail['price']))}}</h6>

                                            </div>



                                            <div class="col col-md-1 align-self-center">



                                                <h5>{{$detail->qty}}</h5>

                                            </div>

                                            <div class="col col-md-1 align-self-center  p-0 product-name">



                                                <h5>{{$detail['tax']}}</h5>

                                            </div>

                                            <div class="col col-md-2 align-self-center  p-0 product-name">



                                                <h5>

                                                    {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($detail['discount']))}}</h5>

                                            </div>



                                            <div class="col col-md-2 align-self-center text-right  ">

                                                <!-- @php($subtotal=$detail['price']*$detail->qty+$detail['tax']-$detail['discount']) -->

                                                @php($subtotal=$detail['price']*$detail->qty+$detail['tax']-$detail['discount'])



                                                <h5 style="font-size: 12px">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($subtotal))}}</h5>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- seller info old --}}



                                @php($discount+=$detail['discount'])

                                @php($tax+=$detail['tax'])

                                @php($total+=$subtotal)

                            <!-- End Media -->

                                <hr>

                                <div class="font-size-sm text-body">



                            {{-- <span class="font-weight-bold">Instruction: {{$order->instruction}}</span><br> --}}

                            @if($order['order_status'] == 'out_for_delivery')

                            <span class="font-weight-bold">AWB ID: {{$order->awb_id}}</span>

                            @endif

                            </div>

                            @endif

                            @php($sellerId=$detail->seller_id)

                        @endforeach

                        @php($shipping=$order['shipping_cost'])

                        @php($coupon_discount=$order['discount_amount'])

                  



                        <div class="row justify-content-md-end mb-3">

                            <div class="col-md-9 col-lg-8">

                                <dl class="row text-sm-right">

                                    <dt class="col-sm-6">{{('Shipping')}}</dt>

                                    <dd class="col-sm-6 border-bottom">

                                        <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($shipping))}}</strong>

                                    </dd>



                                    <dt class="col-sm-6">{{('TAX')}}</dt>

                                    <dd class="col-sm-6 border-bottom">

                                        <strong>+ {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['tax']))}}</strong>

                                    </dd>



                                    <dt class="col-sm-6">{{('coupon discount')}}</dt>

                                    <dd class="col-sm-6 border-bottom">

                                        <strong>- {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($coupon_discount))}}</strong>

                                    </dd>



                                    <dt class="col-sm-6">{{('Total')}}</dt>

                                    <dd class="col-sm-6">

                                        <!-- <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$coupon_discount))}}</strong> -->

                                        <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$coupon_discount))}}</strong>

                                    </dd>

                                </dl>

                                <!-- End Row -->

                            </div>

                        </div>

                        <!-- End Row -->

                    </div>

                    <!-- End Body -->

                </div>

                <!-- End Card -->

            </div>



            <div class="col-lg-4">

                <!-- Card -->

                <div class="card">

                    <!-- Header -->

                    <div class="card-header">

                        <h4 class="card-header-title">{{('Customer')}}</h4>

                    </div>

                    <!-- End Header -->



                    <!-- Body -->

                    @if($order->customer)

                        <div class="card-body">

                            <div class="media align-items-center" href="javascript:">

                                <div class="avatar avatar-circle mr-3">

                                    <img

                                        class="avatar-img" style="width: 75px;height: 42px"

                                        onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"

                                        src="{{asset('storage/profile/'.$order->customer->image)}}"

                                        alt="Image">

                                </div>

                                <div class="media-body">

                                <span

                                    class="text-body text-hover-primary">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</span>

                                </div>

                                <div class="media-body text-right">

                                    {{--<i class="tio-chevron-right text-body"></i>--}}

                                </div>

                            </div>



                            <hr>



                            <div class="media align-items-center" href="javascript:">

                                <div class="icon icon-soft-info icon-circle mr-3">

                                    <i class="tio-shopping-basket-outlined"></i>

                                </div>

                                <div class="media-body">

                                    <span class="text-body text-hover-primary"> {{\App\Model\Order::where('customer_id',$order['customer_id'])->count()}} {{('orders')}}</span>

                                </div>

                                <div class="media-body text-right">

                                    {{--<i class="tio-chevron-right text-body"></i>--}}

                                </div>

                            </div>



                            <hr>



                            <div class="d-flex justify-content-between align-items-center">

                                <h5>{{('Contact')}} {{('info')}} </h5>

                            </div>



                            <ul class="list-unstyled list-unstyled-py-2">

                                <li>

                                    <i class="tio-online mr-2"></i>

                                    {{$order->customer['email']}}

                                </li>

                                <li>

                                    <i class="tio-android-phone-vs mr-2"></i>

                                    {{$order->customer['phone']}}

                                </li>

                            </ul>



                            <hr>

                            



                            <div class="d-flex justify-content-between align-items-center">

                                <h5>{{('shipping address')}}</h5>



                            </div>



                            @if($order->shippingAddress)

                                @php($shipping=$order->shippingAddress)

                            @else

                                @php($shipping=json_decode($order['shipping_address_data']))

                            @endif



                            <span class="d-block">

                                {{('City')}}:

                                <strong>{{$shipping ? $shipping->city : ('empty')}}</strong><br>

                                {{('zip code')}} :

                                <strong>{{$shipping ? $shipping->zip  : ('empty')}}</strong><br>

                                {{('address')}} :

                                <strong>{{$shipping ? $shipping->address  : ('empty')}}</strong><br>

                                

                            </span>

                        </div>

                @endif

                <!-- End Body -->

                </div>

                <div id="tmodal" class="modal fade tmodal" tabindex="-1" role="dialog"

                                aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true" style="opacity: 1;">

                            <div class="modal-dialog modal-dialog-centered" role="document">

                                <div class="modal-content">

                                    <!-- Header -->

                                    <div class="modal-top-cover btn-secondary text-center">

                                        <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">

                                            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">

                                                <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>

                                            </svg>

                                        </figure>



                                        <div class="modal-close">

                                            <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal" aria-label="Close">

                                                <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">

                                                    <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>

                                                </svg>

                                            </button>

                                        </div>

                                    </div>

                                    <!-- End Header -->



                                    <div class="modal-top-cover-icon">

                                        <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">

                                            

                                            <i class="tio-add-circle"></i>

                                        </span>

                                    </div>



                                    <form action="{{route('admin.orders.upd-awb')}}" method="post">

                                        @csrf

                                        <div class="modal-body">

                                            

                                            <div class="row mb-4">

                                                <label for="requiredLabel" class="col-md-4 col-form-label input-label text-md-center">

                                                    {{('AWB Id')}}

                                                </label>

                                                <div class="col-md-8 js-form-message">

                                                    <input type="text" class="form-control" name="awb_id" value="" required>

                                                </div>

                                            </div>

                                            <input type="hidden" class="form-control" name="order_id" id="order_id" value="{{$order['id']}}">

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-white" data-dismiss="modal">{{('close')}}</button>

                                            <button type="submit" class="btn btn-primary">{{('Add')}}</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                </div>

                <!-- End Card -->

            </div>

            

        <!-- End Row -->

    </div>

@endsection



@push('script_2')

    <script>

        $(document).on('change', '.payment_status', function () {

            var id = $(this).attr("data-id");

            var value = $(this).val();

            

            Swal.fire({

                title: '{{('Are you sure Change this')}}?',

                text: "{{('You will not be able to revert this')}}!",

                showCancelButton: true,

                confirmButtonColor: '#377dff',

                cancelButtonColor: 'secondary',

                confirmButtonText: '{{('Yes, Change it')}}!'

            }).then((result) => {

                if (result.value) {

                    $.ajaxSetup({

                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                        }

                    });

                    $.ajax({

                        url: "{{route('admin.orders.payment-status')}}",

                        method: 'POST',

                        data: {

                            "id": id,

                            "payment_status": value

                        },

                        success: function (data) {

                            toastr.success('{{('Status Change successfully')}}');

                            location.reload();

                        }

                    });

                } else {
                    location.reload();
                }

            })

        });



        function order_status(status) {

            // var status = $(this).val();

            // alert(status);

            if(status=='delivered')

            {

                Swal.fire({

                    title: '{{('Order is already delivered, and transaction amount has been disbursed, changing status can be the reason of miscalculation')}}!',

                    text: "{{('Think before you proceed')}}.",

                    showCancelButton: true,

                    confirmButtonColor: '#377dff',

                    cancelButtonColor: 'secondary',

                    confirmButtonText: '{{('Yes, Change it')}}!'

                }).then((result) => {

                    if (result.value) {

                        $.ajaxSetup({

                            headers: {

                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                            }

                        });

                        $.ajax({

                            url: "{{route('admin.orders.status')}}",

                            method: 'POST',

                            data: {

                                "id": '{{$order['id']}}',

                                "order_status": status

                            },

                            success: function (data) {

                                if (data.success == 0) {

                                    toastr.success('{{('Order is already delivered, You can not change it')}} !!');

                                    location.reload();

                                } else {

                                    toastr.success('{{('Status Change successfully')}}!');

                                    location.reload();

                                }



                            }

                        });

                    } else {
                        location.reload(); 
                    }

                })

            }

            else if(status == 'out_for_delivery')

            {

                //$('.tmodal').modal('show');

                    Swal.fire({
                    title: '{{('Are you sure Out for Delivered')}}?',
                    text: "{{('You will not be able to revert this')}}!",
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: 'secondary',
                    confirmButtonText: '{{('Yes, Change it')}}!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{route('admin.orders.status')}}",
                            method: 'POST',
                            data: {
                                "id": '{{$order['id']}}',
                                "order_status": status
                            },
                            success: function (data) {
                                if (data.success == 0) {
                                    toastr.success('{{('Order is already out for delivered, You can not change it')}} !!');
                                    location.reload();
                                } else {
                                    toastr.success('{{('Status Change successfully')}}!');
                                    location.reload();
                                }
                            }
                        });
                    } else {
                        location.reload(); 
                    }
                    })
            }

            else

            {

                Swal.fire({

                    title: '{{('Are you sure Change this')}}?',

                    text: "{{('You will not be able to revert this')}}!",

                    showCancelButton: true,

                    confirmButtonColor: '#377dff',

                    cancelButtonColor: 'secondary',

                    confirmButtonText: '{{('Yes, Change it')}}!'

                }).then((result) => {

                    if (result.value) {

                        $.ajaxSetup({

                            headers: {

                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                            }

                        });

                        $.ajax({

                            url: "{{route('admin.orders.status')}}",

                            method: 'POST',

                            data: {

                                "id": '{{$order['id']}}',

                                "order_status": status

                            },

                            success: function (data) {

                                if (data.success == 0) {

                                    toastr.success('{{('Order is already delivered, You can not change it')}} !!');

                                    location.reload();

                                } else {

                                    toastr.success('{{('Status Change successfully')}}!');

                                    location.reload();

                                }



                            }

                        });

                    } else {
                        location.reload(); 
                    }

                })

            }

        }

    </script>

@endpush

