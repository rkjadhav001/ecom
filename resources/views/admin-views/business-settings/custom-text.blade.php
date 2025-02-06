@extends('layouts.back-end.app')

@section('title', ('Custom Text'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{('Custom Text')}}</li>
            </ol>
        </nav>

        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="page-header-title">{{('Custom Text')}}</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.business-settings.update-text')}}" method="post"
                              style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                              enctype="multipart/form-data">
                            @csrf
                            @php($key=\App\Model\custom_text::where('custom_text_id','1')->first()->value)
                            <div class="form-group">
                                <label for="name">{{('Custom Text')}}</label>
                                <input type="text" name="custom_text_label" class="form-control" id="custom_text_label"
                                        placeholder="{{('Custom Text')}}" value="@if(!empty($custom_text)){{$custom_text->custom_text_label}}@endif" required>
                            </div>

                            <div class="form-group">
                                <label for="name">{{('Custom Text 2')}}</label>
                                <input type="text" name="custom_text_label2" class="form-control" id="custom_text_label2"
                                        placeholder="{{('Custom Text 2')}}" value="@if(!empty($custom_text)){{$custom_text->custom_text_label2}}@endif" required>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
@endpush
