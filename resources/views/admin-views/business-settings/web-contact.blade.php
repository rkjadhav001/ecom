@extends('layouts.back-end.app')
@section('title', ('Web Contact'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{('Web Contact')}}</li>
            </ol>
        </nav>     

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ ('Web Contact table')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <thead>
                                <tr>
                                    <th scope="col">{{ ('sl')}}</th>
                                    <th scope="col">{{ ('name')}}</th>
                                    <th scope="col">{{ ('email')}}</th>
                                    <th scope="col">{{ ('mobile number')}}</th>
                                    <th scope="col">{{ ('subject')}}</th>
                                    <th scope="col">{{ ('message')}}</th>
                                    <th scope="col">{{ ('created')}}</th>
                                    <th scope="col" style="width: 120px">{{ ('action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contact as $k=>$b)
                                    <tr>
                                        <td class="text-center">{{$k+1}}</td>
                                        <td>{{$b->name}}</td>
                                        <td>{{$b->email}}</td>
                                        <td>{{$b->mobile_number}}</td>
                                        <td>{{$b->subject}}</td>
                                        <td>{{$b->message}}</td>
                                        <td>{{date('d M Y h:i:s a',strtotime($b->created_at))}}</td>
                                        <td>
                                        <a class="btn btn-white btn-sm" href="javascript:"
                                            onclick="status_change_alert('{{route('admin.business-settings.web-contact-delete',[$b->id])}}','{{('Want to delete this contact ?')}}',event)">
                                            <i class="tio-delete-outlined text-danger"></i>
                                        </a>
                                            {{--<a class="btn btn-danger btn-sm delete"
                                            id="{{$b->id}}">
                                                <i class="tio-add-to-trash"></i> {{ ('Delete')}}
                                            </a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href=url;
                }
            })
        }
    </script>
@endpush
