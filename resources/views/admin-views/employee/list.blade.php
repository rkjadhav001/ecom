@extends('layouts.back-end.app')
@section('title', ('Employee List'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Employee')}}</li>
            <li class="breadcrumb-item" aria-current="page">{{('List')}}</li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{\App\CPU\translate('employee_table')}}</h5>
                    <a href="{{route('admin.employee.add-new')}}" class="btn btn-primary  float-right">
                        <i class="tio-add-circle"></i>
                        <span class="text">{{('Add')}} {{('New')}}</span>
                    </a>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{('SL')}}#</th>
                                <th style="width: 50px">{{('action')}}</th>
                                <th>{{('Name')}}</th>
                                <th>{{('Email')}}</th>
                                <th>{{('Phone')}}</th>
                                <th>{{('Role')}}</th>
                                <th>{{('City')}}</th>
                                <th>{{('Status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($em as $k=>$e)
                            @if($e->role)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                     <td>
                                        <a href="{{route('admin.employee.update',[$e['id']])}}"
                                           class="btn btn-primary btn-sm">
                                           {{('Edit')}}
                                        </a>
                                        <!-- <a class="btn btn-primary btn-sm delete" style="cursor: pointer;"
                                            id="{{$e['id']}}"> {{ ('Delete')}}</a> -->
                                       
                                    </td>
                                    <td class="text-capitalize">{{$e['name']}}</td>
                                    <td >
                                      {{$e['email']}}
                                    </td>
                                    <td>{{$e['phone']}}</td>
                                    <td>{{$e->role['name']}}</td>
                                    <td>
                                        @if ($e['admin_role_id']=='4')
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                    id="{{$e['id']}}" {{$e->is_city == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        @elseif($e['admin_role_id']=='5')
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                    id="{{$e['id']}}" {{$e->is_city == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                onclick="location.href='{{route('admin.employee.update-status',$e['id'] )}}'">
                                            <span class="legend-indicator bg-success" style="{{Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'}}"></span>
                                            @if ($e['status']=='1')
                                            {{\App\CPU\translate('active')}}
                                            @else
                                            {{\App\CPU\translate('inactive')}}
                                            @endif
                                                
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$em->links()}}
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
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{('Are_you_sure_delete_this?')}}?',
                text: "{{('You_will_not_be_able_to_revert_this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{('Yes')}}, {{('delete_it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.employee.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{('Employee_deleted_successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>

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
            url: "{{route('admin.employee.city_status')}}",
            method: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function () {
                toastr.success('{{('City Status updated successfully')}}');
            } 
        });
    });
</script>
@endpush
