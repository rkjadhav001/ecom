@extends('layouts.back-end.app')
@section('title', ('Contact Us'))
@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Contact Us')}}</li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between pl-4 pr-4">
                        <div>
                            <h5><b>{{('Contact Us')}}</b></h5>
                        </div>
                    </div>
                </div>

                <form action="{{route('admin.business-settings.contact-update')}}" method="post">
                    @csrf
                    <div class="card-body">
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Contact Address')}}</label>
                        <input type="text" value="{{$contact_address->value}}"
                                name="contact_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Contact Whatsapp no')}}</label>
                        <input type="text" value="{{$contact_wa_no->value}}"
                                name="contact_wa_no" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Contact Mobile No')}}</label>
                        <input type="text" value="{{$contact_mobile->value}}"
                                name="contact_mobile" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Contact Email')}}</label>
                        <input type="text" value="{{$contact_email->value}}"
                                name="contact_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Youtube Link')}}</label>
                        <input type="text" value="{{$youtube_link->value}}"
                                name="youtube_link" class="form-control">
                    </div>
                    {{--<div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Facebook Link')}}</label>
                        <input type="text" value="{{$fb_link->value}}"
                                name="fb_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Instagram Link')}}</label>
                        <input type="text" value="{{$insta_link->value}}"
                                name="insta_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Twitter Link')}}</label>
                        <input type="text" value="{{$twitter_link->value}}"
                                name="twitter_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('LinkedIn Link')}}</label>
                        <input type="text" value="{{$linkedin_link->value}}"
                                name="linkedin_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Google Link')}}</label>
                        <input type="text" value="{{$google_link->value}}"
                                name="google_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label" for="exampleFormControlInput1">{{('Pinterest Link')}}</label>
                        <input type="text" value="{{$pinterest_link->value}}"
                                name="pinterest_link" class="form-control">
                    </div>--}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-block" type="submit" name="btn" value="submit">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    {{--ck editor--}}
    <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="{{asset('/')}}vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('#editor').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    {{--ck editor--}}
@endpush
