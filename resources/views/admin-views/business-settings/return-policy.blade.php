@extends('layouts.back-end.app')
@section('title', ('Return Policy'))
@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Return Policy')}}</li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between pl-4 pr-4">
                        <div>
                            <h5><b>{{('Return Policy')}}</b></h5>
                        </div>
                    </div>
                </div>

                <form action="{{route('admin.business-settings.return-policy-update')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="return_policy" id="editor" cols="30" rows="20" class="form-control">{{$return_policy->value}}</textarea>
                            </div>
                        </div>
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
