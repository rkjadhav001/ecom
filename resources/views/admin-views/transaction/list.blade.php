@extends('layouts.back-end.app')

@section('content')
    <div class="content container-fluid ">
        <div class="col-md-4" style="margin-bottom: 20px;">
            <h3 class="text-capitalize">{{ ('transaction table')}}
                <span class="badge badge-soft-dark mx-2">{{$transactions->total()}}</span>

            </h3>
        </div>
        {{-- <div class="row" style="margin-top: 20px"> --}}
        {{-- <div class="col-md-12"> --}}
        <div class="card">
            <div class="card-header">
                <div class="flex-between justify-content-between align-items-center flex-grow-1">
                    <div class="col-md-5 ">
                        <form action="{{ url()->current() }}" method="GET">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                       placeholder="Search by orders id or transaction id" aria-label="Search orders"
                                       value="{{ $search }}"
                                       required>
                                <button type="submit" class="btn btn-primary">{{ ('search')}}</button>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="row">

                            <div class="col-md-8">

                                <select class="form-control" name="status">

                                    <option class="text-center" value="0" selected disabled>
                                        ---{{('select status')}}---
                                    </option>
                                    <option class="text-left text-capitalize"
                                            value="disburse" {{ $status == 'disburse'? 'selected' : '' }} >{{('disburse')}} </option>
                                    <option class="text-left text-capitalize"
                                            value="hold" {{ $status == 'hold'? 'selected' : '' }}>{{('hold')}}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">{{('filter')}}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body" style="padding: 0">
                <div class="table-responsive">
                    <table id="datatable"
                           style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                           class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th>{{('SL#')}}</th>
                            {{-- <th>{{('seller')}}</th> --}}
                            <th>{{('seller name')}}</th>
                            <th>{{('customer name')}}</th>
                            <th>{{('order id')}}</th>
                            <th>{{('transaction id')}}</th>
                            <th>{{('order amount')}}</th>
                            <th>{{ ('seller amount') }}</th>
                            <th>{{('admin commission')}}</th>
                            <th>{{('received by')}}</th>
                            <th>{{('delivered by')}}</th>
                            <th>{{('delivery charge')}}</th>
                            <th>{{('payment method')}}</th>
                            <th>{{('tax')}}</th>
                            <th>{{('status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $key=>$transaction)
                            <tr>
                                <td>{{$transactions->firstItem()+$key}}</td>
                                {{-- <td>{{$transaction['seller_id']}}</td> --}}
                                <td>
                                    @if($transaction['seller_is'] == 'admin')
                                        {{ \App\CPU\Helpers::get_business_settings('company_name') }}
                                    @else
                                        {{ $transaction->seller->f_name }} {{ $transaction->seller->l_name }}
                                    @endif

                                </td>
                                <td>
                                    {{ $transaction->customer->f_name}} {{ $transaction->customer->l_name }}
                                </td>
                                <td>{{$transaction['order_id']}}</td>
                                <td>{{$transaction['transaction_id']}}</td>
                                <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['order_amount']))}}</td>
                                <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['seller_amount']))}}</td>
                                <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['admin_commission']))}}</td>
                                <td>{{$transaction['received_by']}}</td>
                                <td>{{$transaction['delivered_by']}}</td>
                                <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['delivery_charge']))}}</td>
                                <td>{{str_replace('_',' ',$transaction['payment_method'])}}</td>
                                <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['tax']))}}</td>
                                <td>
                                    @if($transaction['status'] == 'disburse')
                                        <span class="badge badge-soft-success  ">

                                                    {{$transaction['status']}}
                                            </span>
                                    @else
                                        <span class="badge badge-soft-warning ">
                                                {{$transaction['status']}}
                                            </span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @if(count($transactions)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                                 alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{ ('No_data_to_show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                {{$transactions->links()}}
            </div>

        </div>
        {{-- </div> --}}

        {{-- </div> --}}
    </div>
@endsection
