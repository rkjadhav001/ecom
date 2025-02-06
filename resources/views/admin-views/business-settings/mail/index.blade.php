@extends('layouts.back-end.app')
@section('title', ('Mail Config'))
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('mail_config')}}</li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px; text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 20px">

                        @php($config=\App\Model\BusinessSetting::where(['type'=>'mail_config'])->first())
                        @php($data=json_decode($config['value'],true))
                        <form action="{{route('admin.business-settings.mail.update')}}"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2 text-center">
                                    <label class="control-label">{{('smtp_mail_config')}}</label>
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('mailer_name')}}</label><br>
                                    <input type="text" placeholder="ex : Alex" class="form-control" name="name"
                                           value="{{env('APP_MODE')=='demo'?'':$data['name']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('Host')}}</label><br>
                                    <input type="text" class="form-control" name="host"
                                           value="{{env('APP_MODE')=='demo'?'':$data['host']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('Driver')}}</label><br>
                                    <input type="text" class="form-control" name="driver"
                                           value="{{env('APP_MODE')=='demo'?'':$data['driver']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('port')}}</label><br>
                                    <input type="text" class="form-control" name="port"
                                           value="{{env('APP_MODE')=='demo'?'':$data['port']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('Username')}}</label><br>
                                    <input type="text" placeholder="ex : ex@yahoo.com" class="form-control"
                                           name="username" value="{{env('APP_MODE')=='demo'?'':$data['username']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('email_id')}}</label><br>
                                    <input type="text" placeholder="ex : ex@yahoo.com" class="form-control" name="email"
                                           value="{{env('APP_MODE')=='demo'?'':$data['email_id']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('Encryption')}}</label><br>
                                    <input type="text" placeholder="ex : tls" class="form-control" name="encryption"
                                           value="{{env('APP_MODE')=='demo'?'':$data['encryption']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('password')}}</label><br>
                                    <input type="text" class="form-control" name="password"
                                           value="{{env('APP_MODE')=='demo'?'':$data['password']}}">
                                </div>
                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('Configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
