@extends('layouts.back-end.app')

@section('title', ('Withdraw Request'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Withdraw')}}  </li>
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ ('Withdraw Request Table')}}</h5>
                        <select name="withdraw_status_filter" onchange="status_filter(this.value)" class="custom-select float-right" style="width: 200px">
                            <option value="all" {{session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all'?'selected':''}}>{{('All')}}</option>
                            <option value="approved" {{session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved'?'selected':''}}>{{('Approved')}}</option>
                            <option value="denied" {{session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied'?'selected':''}}>{{('Denied')}}</option>
                            <option value="pending" {{session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending'?'selected':''}}>{{('Pending')}}</option>

                        </select>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{('SL#')}}</th>
                                    <th>{{('amount')}}</th>
                                    {{-- <th>{{('note')}}</th> --}}
                                    <th>{{ ('Name') }}</th>
                                    <th>{{('request_time')}}</th>
                                    <th>{{('status')}}</th>
                                    <th style="width: 5px">{{('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraw_req as $k=>$wr)
                                    <tr>
                                        <td scope="row">{{$withdraw_req->firstItem()+$k}}</td>
                                        <td>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wr['amount']))}}</td>
                                        {{-- <td>{{$wr->transaction_note}}</td> --}}
                                        <td>
                                            <a href="{{route('admin.sellers.view',$wr->seller_id)}}">{{ $wr->seller->f_name . ' ' . $wr->seller->l_name }}</a>
                                        </td>
                                        <td>{{$wr->created_at}}</td>
                                        <td>
                                            @if($wr->approved==0)
                                                <label class="badge badge-primary">{{('Pending')}}</label>
                                            @elseif($wr->approved==1)
                                                <label class="badge badge-success">{{('Approved')}}</label>
                                            @else
                                                <label class="badge badge-danger">{{('Denied')}}</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.sellers.withdraw_view',[$wr['id'],$wr->seller['id']])}}"
                                               class="btn btn-primary btn-sm">
                                                {{('View')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if(count($withdraw_req)==0)
                                <div class="text-center p-4">
                                    <img class="mb-3"
                                         src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                                         alt="Image Description" style="width: 7rem;">
                                    <p class="mb-0">{{('No_data_to_show')}}</p>
                                </div>
                        @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$withdraw_req->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('script_2')
  <script>
      function status_filter(type) {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.post({
              url: '{{route('admin.withdraw.status-filter')}}',
              data: {
                  withdraw_status_filter: type
              },
              beforeSend: function () {
                  $('#loading').show()
              },
              success: function (data) {
                 location.reload();
              },
              complete: function () {
                  $('#loading').hide()
              }
          });
      }
  </script>
@endpush
