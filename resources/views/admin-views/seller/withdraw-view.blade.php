@extends('layouts.back-end.app')
@section('title', ('Withdraw information View'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('assets/back-end/css/croppie.css')}}" rel="stylesheet">

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item"
                    aria-current="page">{{('Withdraw')}}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header p-3">
                        <h3 class="text-center text-capitalize">
                            {{('seller')}} {{('Withdraw')}} {{('information')}}
                        </h3>

                        <i class="tio-wallet-outlined" style="font-size: 30px"></i>
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <div class="row">
                            <div class="col-4">
                                <div class="flex-start">
                                    <div><h5 class="text-capitalize">{{('amount')}} : </h5></div>
                                    <div class="mx-1"><h5>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\Convert::default($seller->amount))}}</h5></div>
                                </div>
                                <div class="flex-start">
                                    <div><h5>{{('request_time')}} : </h5></div>
                                    <div class="mx-1">{{$seller->created_at}}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="flex-start">
                                    <div>{{('Note')}} :</div>
                                    <div class="mx-1">{{$seller->transaction_note}}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                @if ($seller->approved== 0)
                                    <button type="button" class="btn btn-success float-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" data-toggle="modal"
                                            data-target="#exampleModal">{{('proceed')}}
                                        <i class="tio-arrow-forward"></i>
                                    </button>
                                @else
                                    <div class="text-center float-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}">
                                        @if($seller->approved==1)
                                            <label class="badge badge-success p-2 rounded-bottom">
                                                {{('Approved')}}
                                            </label>
                                        @else
                                            <label class="badge badge-danger p-2 rounded-bottom">
                                                {{('Denied')}}
                                            </label>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card" style="min-height: 260px;">
                    <div class="card-header">
                        <h3 class="h3 mb-0">{{('my_bank_info')}} </h3>
                        <i class="tio tio-dollar-outlined"></i>
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <div class="col-md-8 mt-2">
                            <div class="flex-start">
                                <div><h4>{{('bank_name')}} : </h4></div>
                                <div class="mx-1"><h4>{{$seller->seller->bank_name ? $seller->seller->bank_name : 'No Data found'}}</h4></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{('Branch')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->seller->branch ? $seller->seller->branch : 'No Data found'}}</h6></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{('holder_name')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->seller->holder_name ? $seller->seller->holder_name : 'No Data found'}}</h6></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{('account_no')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->seller->account_no ? $seller->seller->account_no : 'No Data found'}}</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($seller->seller->shop)
                <div class="col-md-4">
                    <div class="card" style="min-height: 260px;">
                        <div class="card-header">
                            <h3 class="h3 mb-0">{{('Shop')}} {{('info')}}</h3>
                            <i class="tio tio-shop-outlined"></i>
                        </div>
                        <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="flex-start">
                                <div><h5>{{('seller_b')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->seller->shop->name}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{('Phone')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->seller->shop->contact}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{('address')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->seller->shop->address}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5 class="text-capitalize badge badge-success">{{('balance')}} : </h5></div>
                                <div class="mx-1"><h5>{{\App\CPU\Convert::default($seller->seller->wallet->balance)}} {{\App\CPU\currency_symbol()}}</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-4">
                <div class="card" style="min-height: 260px;">
                    <div class="card-header">
                        <h3 class="h3 mb-0 "> {{('Seller')}} {{('info')}}</h3>
                        <i class="tio tio-user-big-outlined"></i>
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <div class="flex-start">
                            <div><h5>{{('name')}} : </h5></div>
                            <div class="mx-1"><h5>{{$seller->seller->f_name}} {{$seller->seller->l_name}}</h5></div>
                        </div>
                        <div class="flex-start">
                            <div><h5>{{('Email')}} : </h5></div>
                            <div class="mx-1"><h5>{{$seller->seller->email}}</h5></div>
                        </div>
                        <div class="flex-start">
                            <div><h5>{{('Phone')}} : </h5></div>
                            <div class="mx-1"><h5>{{$seller->seller->phone}}</h5></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{('Withdraw request process')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('admin.sellers.withdraw_status',[$seller['id']])}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">{{('Request')}}:</label>
                                    <select name="approved" class="custom-select" id="inputGroupSelect02">
                                        <option value="1">{{('Approve')}}</option>
                                        <option value="2">{{('Deny')}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">{{('Note about transaction or request')}}:</label>
                                    <textarea class="form-control" name="note" id="message-text"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{('Close')}}</button>
                                <button type="submit" class="btn btn-primary">{{('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')

@endpush
