@extends('layouts.back-end.app')
@section('title', ('Pincode Add'))

@push('css_or_js')
    <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{('Pincode')}}</li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ ('Add')}} {{ ('new')}} {{ ('Pincode')}}
                </div>
                <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    <form action="{{route('admin.pincode.add-new')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                        @php($language = $language->value ?? null)
                        @php($default_lang = 'en')

                        @php($default_lang = json_decode($language)[0])
                        <!-- <ul class="nav nav-tabs mb-4">
                            @foreach(json_decode($language) as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}"
                                        href="#"
                                        id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                </li>
                            @endforeach
                        </ul> -->
                        <div class="row">
                            <div class="col-md-12">
                                @foreach(json_decode($language) as $lang)
                                    <div class="form-group {{$lang != $default_lang ? 'd-none':''}} lang_form"
                                            id="{{$lang}}-form">
                                        <label for="name">{{ ('pincode')}} </label>
                                        <input type="number" name="pincode[]" class="form-control"  id="pincode" value="{{old('name')}}" placeholder="Enter Pincode" maxlength="6" {{$lang == $default_lang? 'required':''}} >
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                @endforeach
                                
                            </div>

                            <div class="col-md-12">
                                @foreach(json_decode($language) as $lang)
                                    <div class="form-group {{$lang != $default_lang ? 'd-none':''}} lang_form"
                                            id="{{$lang}}-form">
                                        <input type="hidden" name="charge[]" class="form-control" id="charge" value="50" placeholder="Enter Charge" {{$lang == $default_lang? 'required':''}}>
                                    </div>
                                @endforeach
                                
                            </div>
                          
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ ('save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{$default_lang}}') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
            }
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });


        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{('are_you_sure?')}}',
                text: "{{('You_will_not_be_able_to_revert_this!')}}",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{('Yes')}} {{('delete_it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.brand.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{('Brand_deleted_successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
