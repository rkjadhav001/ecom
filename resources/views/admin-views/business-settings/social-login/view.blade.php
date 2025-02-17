@extends('layouts.back-end.app')

@section('title', ('Social Login'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('social_login')}}</li>
            </ol>
        </nav>

        <?php
        $data = App\Model\BusinessSetting::where(['type' => 'social_login'])->first();
        $socialLoginServices = json_decode($data['value'], true);
        ?>
        <div class="row" style="padding-bottom: 20px">
            @if (isset($socialLoginServices))
            @foreach ($socialLoginServices as $socialLoginService)
                    <div class="col-md-6 mt-4">
                        <div class="card">
                            <div class="card-body text-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}" style="padding: 20px">
                                <div class="flex-between">
                                    <h4 class="text-center">{{(''.$socialLoginService['login_medium'])}}</h4>
                                    <div class="btn btn-dark p-2" data-toggle="modal" data-target="#{{$socialLoginService['login_medium']}}-modal" style="cursor: pointer">
                                        <i class="tio-info-outined"></i> {{('Credentials SetUp')}}
                                    </div>
                                </div>
                                <form
                                    action="{{route('admin.social-login.update',[$socialLoginService['login_medium']])}}"
                                    method="post">
                                    @csrf
                                    <div class="form-group mb-2 mt-5">
                                        <input type="radio" name="status"
                                               value="1" {{$socialLoginService['status']==1?'checked':''}}>
                                        <label style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Active')}}</label>
                                        <br>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="radio" name="status"
                                               value="0" {{$socialLoginService['status']==0?'checked':''}}>
                                        <label style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Inactive')}}</label>
                                        <br>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Callback_URI')}}</label>
                                        <span class="btn btn-secondary btn-sm m-2" onclick="copyToClipboard('#id_{{$socialLoginService['login_medium']}}')"><i class="tio-copy"></i> {{('Copy URI')}}</span>
                                        <br>
                                        <span class="form-control" id="id_{{$socialLoginService['login_medium']}}" style="height: unset">{{ url('/') }}/customer/auth/login/{{$socialLoginService['login_medium']}}/callback</span>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label
                                            style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Store')}} {{('client_id')}} </label><br>
                                        <input type="text" class="form-control" name="client_id"
                                               value="{{ $socialLoginService['client_id'] }}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label
                                            style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10px">{{('Store')}} {{('client_secret')}}</label><br>
                                        <input type="text" class="form-control" name="client_secret"
                                               value="{{ $socialLoginService['client_secret'] }}">
                                    </div>
                                    <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                            class="btn btn-primary mb-2">{{('save')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
            @endforeach
            @endif
        </div>
        {{-- Modal Starts--}}
        <!-- Google -->
        <div class="modal fade" id="google-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{('Google API Set up Instructions')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ol>
                            <li>{{('Go to the Credentials page')}} ({{('Click')}} <a href="https://console.cloud.google.com/apis/credentials" target="_blank">{{('here')}}</a>)</li>
                            <li>{{('Click')}} <b>Create credentials</b> > <b>OAuth client ID</b>.</li>
                            <li>{{('Select the')}} <b>Web application</b> {{('type')}}.</li>
                            <li>{{('Name your OAuth 2.0 client')}}</li>
                            <li>{{('Click')}} <b>ADD URI</b> {{('from')}} <b>Authorized redirect URIs</b> , {{('provide the')}} <code>Callback URI</code> {{('from below and click')}} <b>Create</b></li>
                            <li>{{('Copy')}} <b>Client ID</b> {{('and')}} <b>Client Secret</b>, {{('paste in the input filed below and')}} <b>Save</b>.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{('Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facebook -->
        <div class="modal fade" id="facebook-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{('Facebook API Set up Instructions')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><b></b>
                        <ol>
                            <li>{{('Go to the facebook developer page')}} (<a href="https://developers.facebook.com/apps/" target="_blank">{{('Click Here')}}</a>)</li>
                            <li>{{('Go to')}} <b>Get Started</b> {{('from Navbar')}}</li>
                            <li>{{('From Register tab press')}} <b>Continue</b> <small>({{('If needed')}})</small></li>
                            <li>{{('Provide Primary Email and press')}} <b>Confirm Email</b> <small>({{('If needed')}})</small></li>
                            <li>{{('In about section select')}} <b>Other</b> {{('and press')}} <b>Complete Registration</b></li>

                            <li><b>Create App</b> > {{('Select an app type and press')}} <b>Next</b></li>
                            <li>{{('Complete the add details form and press')}} <b>Create App</b></li><br/>

                            <li>{{('From')}} <b>Facebook Login</b> {{('press')}} <b>Set Up</b></li>
                            <li>{{('Select')}} <b>Web</b></li>
                            <li>{{('Provide')}} <b>Site URL</b> <small>(Base URL of the site ex: https://example.com)</small> > <b>Save</b></li><br/>
                            <li>{{('Now go to')}} <b>Setting</b> {{('from')}} <b>Facebook Login</b> ({{('left sidebar')}})</li>
                            <li>{{('Make sure to check')}} <b>Client OAuth Login</b> <small>({{('must on')}})</small></li>
                            <li>{{('Provide')}} <code>Valid OAuth Redirect URIs</code> {{('from below and click')}} <b>Save Changes</b></li>

                            <li>{{('Now go to')}} <b>Setting</b> ({{('from left sidebar')}}) > <b>Basic</b></li>
                            <li>{{('Fill the form and press')}} <b>Save Changes</b></li>
                            <li>{{('Now, copy')}} <b>Client ID</b> & <b>Client Secret</b>, {{('paste in the input filed below and')}} <b>Save</b>.</li>
                        </ol>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{('Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Twitter -->
        <div class="modal fade" id="twitter-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{('Twitter API Set up Instructions')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"><b></b>
                        {{('Instruction will be available very soon')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{('Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Ends--}}
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
