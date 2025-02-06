@extends('layouts.back-end.app')

@section('title', ('Payment Method'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{('payment_method')}}</li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('system_default')}} {{('payment_method')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery'))
                        <form action="{{route('admin.business-settings.payment-method.update',['cash_on_delivery'])}}"
                              style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('cash_on_delivery')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Inactive')}}</label>
                                    <br>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('digital_payment')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('digital_payment'))
                        <form action="{{route('admin.business-settings.payment-method.update',['digital_payment'])}}"
                              style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('digital_payment')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Inactive')}}</label>
                                    <br>
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

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('SSLCOMMERZ')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('ssl_commerz_payment'))
                        <form
                            action="{{route('admin.business-settings.payment-method.update',['ssl_commerz_payment'])}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('ssl_commerz_payment')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Store')}} {{('ID')}} </label><br>
                                    <input type="text" class="form-control" name="store_id"
                                           value="{{env('APP_MODE')=='demo'?'':$config['store_id']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Store')}} {{('password')}}</label><br>
                                    <input type="text" class="form-control" name="store_password"
                                           value="{{env('APP_MODE')=='demo'?'':$config['store_password']}}">
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
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('Paypal')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('paypal'))
                        <form action="{{route('admin.business-settings.payment-method.update',['paypal'])}}"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label
                                        class="control-label">{{('Paypal')}} {{('Payment')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Paypal')}} {{('Client')}}{{('ID')}}  </label><br>
                                    <input type="text" class="form-control" name="paypal_client_id"
                                           value="{{env('APP_MODE')=='demo'?'':$config['paypal_client_id']}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Paypal')}} {{('Secret')}} </label><br>
                                    <input type="text" class="form-control" name="paypal_secret"
                                           value="{{env('APP_MODE')=='demo'?'':$config['paypal_secret']}}">
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

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('Stripe')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('stripe'))
                        <form action="{{route('admin.business-settings.payment-method.update',['stripe'])}}"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('stripe')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Published')}}{{('Key')}}  </label><br>
                                    <input type="text" class="form-control" name="published_key"
                                           value="{{env('APP_MODE')=='demo'?'':$config['published_key']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('api_key')}}</label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="{{env('APP_MODE')=='demo'?'':$config['api_key']}}">
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

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('razor_pay')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('razor_pay'))
                        <form action="{{route('admin.business-settings.payment-method.update',['razor_pay'])}}"
                              method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('razor_pay')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('Key')}}  </label><br>
                                    <input type="text" class="form-control" name="razor_key"
                                           value="{{env('APP_MODE')=='demo'?'':$config['razor_key']}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('secret')}}</label><br>
                                    <input type="text" class="form-control" name="razor_secret"
                                           value="{{env('APP_MODE')=='demo'?'':$config['razor_secret']}}">
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

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('senang_pay')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('senang_pay'))
                        <form
                            action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['senang_pay']):'javascript:'}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('senang_pay')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Callback_URI')}}</label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_senang_pay')"><i class="tio-copy"></i> {{('Copy URI')}}</span>
                                    <br>
                                    <p class="form-control" id="id_senang_pay">{{ url('/') }}/return-senang-pay</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('secret')}} {{('key')}}</label><br>
                                    <input type="text" class="form-control" name="secret_key"
                                           value="{{env('APP_MODE')!='demo'?$config['secret_key']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('Merchant')}} {{('ID')}}</label><br>
                                    <input type="text" class="form-control" name="merchant_id"
                                           value="{{env('APP_MODE')!='demo'?$config['merchant_id']:''}}">
                                </div>
                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6" style="margin-top: 26px!important;">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('paystack')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('paystack'))
                        <form
                            action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paystack']):'javascript:'}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('paystack')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Callback_URI')}}</label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_paystack')"><i
                                            class="tio-copy"></i> {{('Copy URI')}}</span>
                                    <br>
                                    <p class="form-control" id="id_paystack">{{ url('/') }}/paystack-callback</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('publicKey')}}</label><br>
                                    <input type="text" class="form-control" name="publicKey"
                                           value="{{env('APP_MODE')!='demo'?$config['publicKey']:''}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('secretKey')}} </label><br>
                                    <input type="text" class="form-control" name="secretKey"
                                           value="{{env('APP_MODE')!='demo'?$config['secretKey']:''}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('paymentUrl')}} </label><br>
                                    <input type="text" class="form-control" name="paymentUrl"
                                           value="{{env('APP_MODE')!='demo'?$config['paymentUrl']:''}}">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('merchantEmail')}} </label><br>
                                    <input type="text" class="form-control" name="merchantEmail"
                                           value="{{env('APP_MODE')!='demo'?$config['merchantEmail']:''}}">
                                </div>
                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: none">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('paymob_accept')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('paymob_accept'))
                        <form
                            action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paymob_accept']):'javascript:'}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('paymob_accept')}}</label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Callback_URI')}}</label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_paymob_accept')"><i class="tio-copy"></i> {{('Copy URI')}}</span>
                                    <br>
                                    <p class="form-control" id="id_paymob_accept">{{ url('/') }}/paymob-callback</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('api_key')}}</label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="{{env('APP_MODE')!='demo'?$config['api_key']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('iframe_id')}}</label><br>
                                    <input type="text" class="form-control" name="iframe_id"
                                           value="{{env('APP_MODE')!='demo'?$config['iframe_id']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('integration_id')}}</label><br>
                                    <input type="text" class="form-control" name="integration_id"
                                           value="{{env('APP_MODE')!='demo'?$config['integration_id']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('HMAC')}}</label><br>
                                    <input type="text" class="form-control" name="hmac"
                                           value="{{env('APP_MODE')!='demo'?$config['hmac']:''}}">
                                </div>


                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: block">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('bkash')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('bkash'))
                        <form
                            action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['bkash']):'javascript:'}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('bkash')}}</label>
                                </div>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('api_key')}}</label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="{{env('APP_MODE')!='demo'?$config['api_key']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('api_secret')}}</label><br>
                                    <input type="text" class="form-control" name="api_secret"
                                           value="{{env('APP_MODE')!='demo'?$config['api_secret']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('username')}}</label><br>
                                    <input type="text" class="form-control" name="username"
                                           value="{{env('APP_MODE')!='demo'?$config['username']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('password')}}</label><br>
                                    <input type="text" class="form-control" name="password"
                                           value="{{env('APP_MODE')!='demo'?$config['password']:''}}">
                                </div>


                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: none">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center">{{('paytabs')}}</h5>
                        @php($config=\App\CPU\Helpers::get_business_settings('paytabs'))
                        <form
                            action="{{env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paytabs']):'javascript:'}}"
                            method="post">
                            @csrf
                            @if(isset($config))
                                <div class="form-group mb-2">
                                    <label class="control-label">{{('paytabs')}}</label>
                                </div>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" {{$config['status']==1?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Active')}}</label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" {{$config['status']==0?'checked':''}}>
                                    <label style="padding-left: 10px">{{('Inactive')}} </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('profile_id')}}</label><br>
                                    <input type="text" class="form-control" name="profile_id"
                                           value="{{env('APP_MODE')!='demo'?$config['profile_id']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px">{{('server_key')}}</label><br>
                                    <input type="text" class="form-control" name="server_key"
                                           value="{{env('APP_MODE')!='demo'?$config['server_key']:''}}">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px">{{('base_url_by_region')}}</label><br>
                                    <input type="text" class="form-control" name="base_url"
                                           value="{{env('APP_MODE')!='demo'?$config['base_url']:''}}">
                                </div>


                                <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                        onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                        class="btn btn-primary mb-2">{{('save')}}</button>
                            @else
                                <button type="submit"
                                        class="btn btn-primary mb-2">{{('configure')}}</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            toastr.success("{{('Copied to the clipboard')}}");
        }
    </script>
@endpush
