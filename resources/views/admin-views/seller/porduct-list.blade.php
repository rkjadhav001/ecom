@extends('layouts.back-end.app')
@section('title', ('Product List'))
@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Products')}}</li>
        </ol>
    </nav>

    <div class="d-md-flex_ align-items-center justify-content-between mb-0">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="h3 mt-2 text-black-50">{{('product list')}}</h3>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{('product_table')}}</h5>
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
                                <th>{{('Product Name')}}</th>
                                <th>{{('purchase price')}}</th>
                                <th>{{('selling price')}}</th>
                                <th>{{('featured')}}</th>
                                <th>{{('status')}}</th>
                                <th style="width: 5px">{{('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $k=>$p)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>
                                        <a href="{{route('admin.product.view',[$p['id']])}}">
                                            {{substr($p['name'],0,20)}}{{strlen($p['name'])>20?'...':''}}
                                        </a>
                                    </td>
                                    <td>
                                        {{ \App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']).\App\CPU\BackEndHelper::currency_symbol()}}
                                    </td>
                                    <td>
                                        {{ \App\CPU\BackEndHelper::usd_to_currency($p['unit_price']).\App\CPU\BackEndHelper::currency_symbol()}}
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onclick="featured_status('{{$p['id']}}')" {{$p->featured == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="{{$p['id']}}" {{$p->status == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.product.edit',[$p['id']])}}">{{('Edit')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                onclick="form_alert('product-{{$p['id']}}','Want to delete this item ?')">{{('Delete')}}</a>
                                                <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                      method="post" id="product-{{$p['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$product->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

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
                url: "{{route('admin.product.status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if (data.success == true) {
                        toastr.success('{{('Status updated successfully')}}');
                    } else {
                        toastr.error('{{('Status updated failed. Product must be approved')}}');
                        location.reload();
                    }
                }
            });
        });

        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.featured-status')}}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('{{('Featured status updated successfully')}}');
                }
            });
        }
    </script>
@endpush
