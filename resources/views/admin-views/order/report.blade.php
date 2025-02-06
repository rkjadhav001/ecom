@extends('layouts.back-end.app')



@section('title', ('Order Report'))



@push('css_or_js')

    <link href="{{asset('assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>

@endpush



@section('content')

    <div class="content container-fluid">

        <!-- Page Header -->

        <div class="page-header">

            <div class="row align-items-center">

                <div class="col-sm mb-2 mb-sm-0">

                    <h1 class="page-header-title"><i

                            class="tio-add-circle-outlined"></i> {{('Order')}} {{('Report')}}

                    </h1>

                </div>

            </div>

        </div>

        <!-- End Page Header -->



        <!-- Content Row -->

        <div class="row gx-2 gx-lg-3">

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">

                <div class="card">

                    {{-- <div class="card-header">

                        {{('coupon_form')}}

                    </div> --}}

                    <div class="card-body">

                        <form action="{{url('admin/report_ganrate')}}" method="post">

                            @csrf



                            <div class="row">

                                <div class="col-3">

                                    <div class="form-group">

                                        <label for="name">{{('Start Date')}}</label>

                                        <input type="date" name="start_date" class="form-control" id="title"

                                               placeholder="{{('Title')}}" required>

                                    </div>

                                </div>

                                <div class="col-3">

                                    <div class="form-group">

                                        <label for="name">{{('End Date')}}</label>

                                        <input type="date" name="end_date" class="form-control" id="title"

                                               placeholder="{{('Title')}}" required>

                                    </div>

                                </div>

                                

                                <div class="col-3">

                                    <div class="form-group">

                                        <label for="name">{{('Pinocode')}}</label>

                                        <input type="test" name="pincode" class="form-control" id="pincode"

                                               placeholder="{{('Enter pincode')}}" >

                                    </div>

                                </div>



                                @php

                                  $data=DB::table('shops')->get();

                                @endphp



                                {{-- <div class="col-3">

                                    <div class="form-group">

                                        <label for="name">{{('Shop Name')}}</label>

                                        <select class="form-control" name="seller_id" style="width: 100%">

                                            <option value="all"> {{('All')}}</option>

                                             @foreach($data as $val)

                                                  <option value="{{($val->seller_id)}}">{{($val->name)}}</option>

                                            @endforeach

                                        </select>

                                    </div>

                                </div> --}}



                                <div class="col-3">

                                    <div class="form-group">

                                        <label for="name">{{('Order Status')}}</label>

                                        <select class="form-control" name="order_status" style="width: 100%">

                                            <option value="all"> {{('All')}}</option>

                                            <option value="pending"> {{('Pending')}}</option>

                                            <option value="confirmed"> {{('Confirmed')}}</option>

                                            <option value="processing">{{('Processing')}} </option>

                                            <option value="out_for_delivery">{{('out for delivery')}} </option>

                                            <option value="delivered" >{{('Delivered')}} </option>

                                            <option value="returned" > {{('Returned')}}</option>

                                            <option value="failed" >{{('Failed')}} </option>

                                            <option value="canceled" >{{('Canceled')}} </option>

                                        </select>

                                    </div>

                                </div>

                                

                            </div>



                            

                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">{{('Submit')}}</button>

                            </div>

                        </form>

                       

                    </div>

                </div>

            </div>

        </div>



        <div class="row" style="margin-top: 20px">

            <div class="col-md-12">

                <div class="card">

                    

                    <div class="card-body" style="padding: 0">

                        <div class="table-responsive">

                            <table id="datatable"

                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"

                                   style="width: 100%">

                                   <thead class="thead-light">

                                        <tr>

                                            <th class="">

                                                {{('SL')}}#

                                            </th>

                                            <th class=" ">{{('Order')}}</th>

                                            <th>{{('Date')}}</th>

                                            <th>{{('customer_name')}}</th>

                                            <th>{{('Pincode')}}</th>

                                            <th>{{('Status')}}</th>

                                            <th>{{('Total')}}</th>

                                            <th>{{('Order')}} {{('Status')}} </th>

                                            <th>{{('Action')}}</th>

                                        </tr>

                                    </thead>

                                    @if(!empty($data1))

                                        <tbody>

                                            @php

                                                $i=1;

                                            @endphp

                                            @foreach($data1 as $order)



                                                <tr class="status-{{$order['order_status']}} class-all">

                                                    <td class="">

                                                        {{$i++}}

                                                    </td>

                                                    <td class="table-column-pl-0">

                                                        <a href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>

                                                    </td>

                                                    <td>{{date('d M Y h:i A',strtotime($order['created_at']))}}</td>

                                                    <td>

                                                        

                                                            <a class="text-body text-capitalize"

                                                            href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['name']}}</a>

                                                    

                                                    </td>



                                                    <td>



                                                           {{$order['zip']}}

                                                    

                                                    </td>



                                                    <td>

                                                        @if($order['payment_status']=='paid')

                                                            <span class="badge badge-soft-success">

                                                            <span class="legend-indicator bg-success"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{('paid')}}

                                                            </span>

                                                        @else

                                                            <span class="badge badge-soft-danger">

                                                            <span class="legend-indicator bg-danger"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{('unpaid')}}

                                                            </span>

                                                        @endif

                                                    </td>

                                                    <td> {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount']))}}</td>

                                                    <td class="text-capitalize">

                                                        @if($order['order_status']=='pending')

                                                            <span class="badge badge-soft-info ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-info"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>



                                                        @elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery')

                                                            <span class="badge badge-soft-warning ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-warning"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>

                                                        @elseif($order['order_status']=='confirmed')

                                                            <span class="badge badge-soft-success ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-success"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>

                                                        @elseif($order['order_status']=='failed')

                                                            <span class="badge badge-danger ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-warning"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>

                                                        @elseif($order['order_status']=='delivered')

                                                            <span class="badge badge-soft-success ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-success"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>

                                                        @else

                                                            <span class="badge badge-soft-danger ml-2 ml-sm-3">

                                                                <span class="legend-indicator bg-danger"

                                                                    style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>{{\App\CPU\translate($order['order_status'])}}

                                                            </span>

                                                        @endif

                                                    </td>

                                                    <td>

                                                        <div class="dropdown">

                                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"

                                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"

                                                                    aria-expanded="false">

                                                                <i class="tio-settings"></i>

                                                            </button>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                                <a class="dropdown-item"

                                                                href="{{route('admin.orders.details',['id'=>$order['id']])}}"><i

                                                                        class="tio-visible"></i> {{('view')}}</a>

                                                                <a class="dropdown-item" target="_blank"

                                                                href="{{route('admin.orders.generate-invoice',[$order['id']])}}"><i

                                                                        class="tio-download"></i> {{('invoice')}}</a>

                                                            </div>

                                                        </div>

                                                    </td>

                                                </tr>

                                            @endforeach

                                        </tbody>

                                    @endif

                            </table>

                        </div>

                    </div>

                    

                    @if(empty($data1))

                        <div class="text-center p-4">

                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"

                                 alt="Image Description" style="width: 7rem;">

                            <p class="mb-0">{{('No data to show')}}</p>

                        </div>

                    @endif



                    <div class="row gx-2 gx-lg-3">

                        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">

                            <div class="card">

                              

                                <div class="card-body">

                                    

                                    <form action="{{route('admin.orders.report_ganrate_pdf')}}" method="post">

                                        @csrf



                                    

                                                    <input type="hidden" name="start_date" class="form-control"

                                                        value="@if(!empty($start_date)){{$start_date}}@endif" required>

                                            

                                                    <input type="hidden" name="end_date" class="form-control"

                                                        value="@if(!empty($end_date)){{$end_date}}@endif" required>

                                            

                                                    <input type="hidden" name="order_status" class="form-control"

                                                        value="@if(!empty($order_status)){{$order_status}}@endif" required>



                                                    <input type="hidden" name="seller_id" class="form-control"

                                                    value="@if(!empty($seller_id)){{$seller_id}}@endif" required>

                                                    

                                                    <input type="hidden" name="pincode" class="form-control"

                                                    value="@if(!empty($pincode)){{$pincode}}@endif" required>

                                            



                                        

                                        <div class="card-footer">



                                        @if(!empty($order_status))

                                            <button type="submit" class="btn btn-primary">{{('Report Download ')}}</button>

                                        @else

                                             <button type="submit" class="btn btn-primary" disabled>{{('Report Download')}}</button>

                                        @endif

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>



                </div>

            </div>

        </div>



        

    </div>

@endsection



@push('script')

    {{-- <script>

         $(document).ready(function() {

            $('#dataTable').DataTable();

        });

        function checkDiscountType(val) {

            if (val == 'amount') {

                $('#max-discount').hide()

            } else if (val == 'percentage') {

                $('#max-discount').show()

            }

        }

        $(document).on('change', '.status', function () {

            var id = $(this).attr("id");

            if ($(this).prop("checked") == true) {

                var status = 1;

            } else if ($(this).prop("checked") == false) {

                var status = 0;

            }



            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                }

            });

            $.ajax({

                url: "#",

                method: 'POST',

                data: {

                    id: id,

                    status: status

                },

                success: function (data) {

                    if (data == 1) {

                        toastr.success('Coupon published successfully');

                    } else {

                        toastr.success('Coupon unpublished successfully');

                    }

                }

            });

        });



    </script> --}}

    <script src="{{asset('assets/back-end')}}/js/select2.min.js"></script>

    <script>

        $(".js-example-theme-single").select2({

            theme: "classic"

        });



        $(".js-example-responsive").select2({

            width: 'resolve'

        });

        

        

        function readURL(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();



                reader.onload = function (e) {

                    $('#viewer').attr('src', e.target.result);

                }



                reader.readAsDataURL(input.files[0]);

            }

        }



        $("#coupon_image").change(function () {

            readURL(this);

        });





    </script>



    <!-- Page level plugins -->

    <script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>

    <script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>



    <!-- Page level custom scripts -->

    <script src="{{asset('assets/back-end')}}/js/demo/datatables-demo.js"></script>

@endpush

