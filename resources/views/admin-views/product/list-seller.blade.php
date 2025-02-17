@extends('layouts.back-end.app')

@section('title', ('Product List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">  <!-- Page Heading -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
                @if($pro['data'] != null && $pro->first()->request_status == 0)
                    <li class="breadcrumb-item"
                        aria-current="page">{{('New')}} {{('Products')}}</li>
                @elseif($pro['data'] != null && $pro->first()->request_status == 1)
                    <li class="breadcrumb-item"
                        aria-current="page">{{('Approved')}} {{('Products')}}</li>
                @elseif($pro['data'] != null && $pro->first()->request_status == 2)
                    <li class="breadcrumb-item"
                        aria-current="page">{{('Denied')}} {{('Products')}}</li>
                @else
                    <li class="breadcrumb-item" aria-current="page">{{('Products')}}</li>
                @endif
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    @if($pro->first() != null && $pro->first()->added_by == 'in_house')
                        <div class="card-header">
                            <h5>{{('product_table')}}</h5>
                            <a href="{{route('admin.product.add-new')}}" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{('Add new product')}}</span>
                            </a>
                        </div>
                    @endif
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{('SL#')}}</th>
                                    <th style="width: 5px" class="text-center">{{('Action')}}</th>
                                    @if($pro->first() != null && $pro->first()->request_status != 2)
                                        <th>{{('Active')}} {{('status')}}</th>
                                        <th>{{('featured')}}</th>
                                    @endif
                                    <th>{{('Product Name')}}</th>
                                    <th>{{('purchase_price')}}</th>
                                    <th>{{('selling_price')}}</th>
                                    <th>{{('verify_status')}}</th>
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pro as $k=>$p)
                                    <tr>
                                        <th scope="row">{{$k+1}}</th>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('admin.product.edit',[$p['id']])}}">
                                                <i class="tio-edit"></i>{{('Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="javascript:"
                                               onclick="form_alert('product-{{$p['id']}}','Want to delete this item ?')">
                                                <i class="tio-add-to-trash"></i> {{('Delete')}}
                                            </a>
                                            <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                  method="post" id="product-{{$p['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                        @if($p->request_status != 2)
                                             <td>
                                                <label class="switch switch-status">
                                                    <input type="checkbox" class="status"
                                                           id="{{$p['id']}}" {{$p->status == 1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox"
                                                           onclick="featured_status('{{$p['id']}}')" {{$p->featured == 1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            
                                        @endif
                                        
                                        <td>
                                            <a href="{{route('admin.product.view',[$p['id']])}}">
                                                {{substr($p['name'],0,20)}}{{strlen($p['name'])>20?'...':''}}
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}
                                        </td>
                                        <td>
                                            {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}
                                        </td>
                                        <td>
                                            @if($p->request_status == 0)
                                                <label class="badge badge-warning">{{('New Request')}}</label>
                                            @elseif($p->request_status == 1)
                                                <label class="badge badge-success">{{('Approved')}}</label>
                                            @elseif($p->request_status == 2)
                                                <label class="badge badge-danger">{{('Denied')}}</label>
                                            @endif
                                        </td>
                                        

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$pro->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>

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
                    console.log(data)
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
