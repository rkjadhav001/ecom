@extends('layouts.back-end.app')

@section('title', ('Coupon Add'))

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
                            class="tio-add-circle-outlined"></i> {{('Add')}} {{('New')}} {{('Coupon')}}
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
                        <form action="{{route('admin.coupon.add-new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">{{('Type')}}</label>
                                        <select class="form-control" name="coupon_type"
                                                style="width: 100%" required>
                                           
                                            <option value="discount_on_purchase">{{('Discount on Purchase')}}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                @php
                                  $data=DB::table('shops')->get();
                                @endphp

                                <input type="hidden" name="seller_id" value="0">
                                {{--<div class="col-3">
                                    <div class="form-group">
                                        <label for="name">{{('Select Seller')}}</label>
                                        <select class="form-control" name="seller_id"
                                                style="width: 100%" required>
                                           
                                            <option value="0">{{('Admin')}}</option>
                                            @foreach($data as $val)
                                                  <option value="{{($val->seller_id)}}">{{($val->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>--}}

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">{{('Title')}}</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="{{('Title')}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">{{('Code')}}</label>
                                        <input type="text" name="code" value="{{\Illuminate\Support\Str::random(10)}}"
                                               class="form-control" id="code"
                                               placeholder="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('start date')}}</label>
                                        <input type="date" name="start_date" class="form-control" id="start date"
                                               placeholder="{{('start date')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('expire date')}}</label>
                                        <input type="date" name="expire_date" class="form-control" id="expire date"
                                               placeholder="{{('expire date')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlInput1">{{('limit')}} {{('for')}} {{('same')}} {{('user')}}</label>
                                        <input type="number" name="limit" id="coupon_limit" class="form-control"
                                               placeholder="{{('EX')}}: {{('10')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('discount type')}}</label>
                                        <select class="form-control" name="discount_type"
                                                onchange="checkDiscountType(this.value)"
                                                style="width: 100%">
                                            <option value="amount">{{('Amount')}}</option>
                                            <option value="percentage">{{('percentage')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('Discount')}}</label>
                                        <input type="number" min="1" max="1000000" name="discount" class="form-control"
                                               id="discount"
                                               placeholder="{{('discount')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label for="name">{{('minimum purchase')}}</label>
                                    <input type="number" min="1" max="1000000" name="min_purchase" class="form-control"
                                           id="minimum purchase"
                                           placeholder="{{('minimum purchase')}}" required>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('maximum discount')}}</label>
                                        <input type="number" min="1" max="1000000" name="max_discount"
                                               class="form-control" id="maximum discount"
                                               placeholder="{{('maximum discount')}}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name">{{('Coupon Image')}}</label>
                                        <input type="file" name="image"
                                               class="form-control" id="coupon_image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <center>
                                        <img style="border-radius: 10px; max-height:200px;" id="viewer"
                                            src="{{asset('public/assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
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
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-3 mb-3 mb-lg-0">
                                <h5>{{('coupons table')}} <span style="color: red;">({{ $cou->total() }})</span>
                                </h5>
                            </div>
                            <div class="col-lg-6">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{('Search by Title or Code or Discount Type')}}"
                                               value="{{ $search }}" aria-label="Search orders" required>
                                        <button type="submit" class="btn btn-primary">{{('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{('SL')}}#</th>
                                    <th>{{('Action')}}</th>
                                    <th>{{('Status')}}</th>
                                    <th>{{('coupon type')}}</th>
                                    <th>{{('Seller Name')}}</th>
                                    <th>{{('Title')}}</th>
                                    <th>{{('Code')}}</th>
                                    <th>{{ ('user') }} {{ ('limit') }}</th>
                                    <th>{{('minimum purchase')}}</th>
                                    <th>{{('maximum discount')}}</th>
                                    <th>{{('Discount')}}</th>
                                    <th>{{('discount type')}}</th>
                                    <th>{{('start date')}}</th>
                                    <th>{{('expire date')}}</th>
                                    <th>{{('Image')}}</th>
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cou as $k=>$c)
                                    <tr>
                                        <th scope="row">{{$cou->firstItem() + $k}}</th>
                                        <td>
                                            <a href="{{route('admin.coupon.update',[$c['id']])}}"
                                               class="btn btn-primary btn-sm">
                                                {{('Update')}}
                                            </a>
                                        </td>
                                        <td>
                                            <label class="toggle-switch toggle-switch-sm">
                                                <input type="checkbox" class="toggle-switch-input"
                                                       onclick="location.href='{{route('admin.coupon.status',[$c['id'],$c->status?0:1])}}'"
                                                       class="toggle-switch-input" {{$c->status?'checked':''}}>
                                                <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                            </span>
                                            </label>
                                        </td>
                                        <td style="text-transform: capitalize">{{str_replace('_',' ',$c['coupon_type'])}}</td>

                                        @php
                                            $seller_data=DB::table('shops')->where('seller_id',$c['seller_id'])->first();
                                        @endphp

                                        @if($c['seller_id']==0)
                                           <td>{{'Admin'}}</td>  
                                        @else
                                           <td>{{$seller_data->name}}</td>
                                        @endif

                                        <td class="text-capitalize">
                                            {{substr($c['title'],0,20)}}
                                        </td>
                                        <td>{{$c['code']}}</td>
                                        <td>{{ $c['limit'] }}</td>
                                        <td>{{\App\CPU\BackEndHelper::set_symbol($c['min_purchase'])}}</td>
                                        <td>{{\App\CPU\BackEndHelper::set_symbol($c['max_discount'])}}</td>
                                        <td>{{$c['discount_type']=='amount'?\App\CPU\BackEndHelper::set_symbol($c['discount']):$c['discount']}}</td>
                                        <td>{{$c['discount_type']}}</td>
                                        <td>{{date('d-M-y',strtotime($c['start_date']))}}</td>
                                        <td>{{date('d-M-y',strtotime($c['expire_date']))}}</td>
                                        <td>
                                            <img width="80"
                                                 onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{asset('storage/notification')}}/{{$c['image']}}">
                                        </td>
                                        
                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$cou->links()}}
                    </div>
                    @if(count($cou)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                                 alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{('No data to show')}}</p>
                        </div>
                    @endif
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
