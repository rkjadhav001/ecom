@extends('layouts.back-end.app')
@section('title', ('Social Media'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{('Social Media')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row" id="contact_form" style="display: none;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ ('social_media_form')}}
                    </div>
                    <div class="card-body">
                        <form style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="name" class="{{Session::get('direction') === "rtl" ? 'mr-1' : ''}}">{{('name')}}</label>
                                        <select class="form-control" name="name" id="name" style="width: 100%">
                                            <option>---{{('select')}}---</option>
                                            <option value="instagram">{{('Instagram')}}</option>
                                            <option value="facebook">{{('Facebook')}}</option>
                                            <option value="twitter">{{('Twitter')}}</option>
                                            <option value="linkedin">{{('LinkedIn')}}</option>
                                            <option value="pinterest">{{('Pinterest')}}</option>
                                            <option value="google-plus">{{('Google plus')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <input type="hidden" id="id">
                                        <label for="link" class="{{Session::get('direction') === "rtl" ? 'mr-1' : ''}}">{{ ('social_media_link')}}</label>
                                        <input type="text" name="link" class="form-control" id="link"
                                               placeholder="{{('Enter Social Media Link')}}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" id="id">
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <a id="add" class="btn btn-primary" style="color: white">{{ ('save')}}</a>
                                <a id="update" class="btn btn-primary"
                                   style="display: none; color: #fff;">{{ ('update')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ ('social_media_table')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <thead>
                                <tr>
                                    <th scope="col">{{ ('sl')}}</th>
                                    <th scope="col">{{ ('name')}}</th>
                                    <th scope="col">{{ ('link')}}</th>
                                    <th scope="col">{{ ('status')}}</th>
                                    {{-- <th scope="col">{{ ('icon')}}</th> --}}
                                    <th scope="col" style="width: 120px">{{ ('action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

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
        fetch_social_media();

        function fetch_social_media() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.fetch')}}",
                method: 'GET',
                success: function (data) {

                    if (data.length != 0) {
                        var html = '';
                        for (var count = 0; count < data.length; count++) {
                            html += '<tr>';
                            html += '<td class="column_name" data-column_name="sl" data-id="' + data[count].id + '">' + (count + 1) + '</td>';
                            html += '<td class="column_name" data-column_name="name" data-id="' + data[count].id + '">' + data[count].name + '</td>';
                            html += '<td class="column_name" data-column_name="slug" data-id="' + data[count].id + '">' + data[count].link + '</td>';
                            html += `<td class="column_name" data-column_name="status" data-id="${data[count].id}">
                                <label class="switch">
                                    <input type="checkbox" class="status" id="${data[count].id}" ${data[count].active_status == 1 ? "checked" : ""} >
                                    <span class="slider round"></span>
                                </label>
                            </td>`;
                            // html += '<td><a type="button" class="btn btn-primary btn-xs edit" id="' + data[count].id + '"><i class="fa fa-edit text-white"></i></a> <a type="button" class="btn btn-danger btn-xs delete" id="' + data[count].id + '"><i class="fa fa-trash text-white"></i></a></td></tr>';
                            html += '<td><a type="button" class="btn btn-primary btn-xs edit" id="' + data[count].id + '">Edit</a> </td></tr>';
                        }
                        $('tbody').html(html);
                    }
                }
            });
        }

        $('#add').on('click', function () {
            $('#add').attr("disabled", true);
            var name = $('#name').val();
            var link = $('#link').val();
            if (name == "") {
                toastr.error('{{('Social Name Is Requeired')}}.');
                return false;
            }
            if (link == "") {
                toastr.error('{{('Social Link Is Requeired')}}.');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.social-media-store')}}",
                method: 'POST',
                data: {
                    name: name,
                    link: link
                },
                success: function (response) {
                    if (response.error == 1) {
                        toastr.error('{{('Social Media Already taken')}}');
                    } else {
                        toastr.success('{{('Social Media inserted Successfully')}}.');
                    }
                    $('#name').val('');
                    $('#link').val('');
                    fetch_social_media();
                }
            });
        });
        $('#update').on('click', function () {
            $('#update').attr("disabled", true);
            var id = $('#id').val();
            var name = $('#name').val();
            var link = $('#link').val();
            var icon = $('#icon').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.social-media-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    name: name,
                    link: link,
                    icon: icon,
                },
                success: function (data) {
                    $('#name').val('');
                    $('#link').val('');
                    $('#icon').val('');

                    toastr.success('{{('Social info updated Successfully')}}.');
                    $('#update').hide();
                    $('#contact_form').hide();
                    $('#add').show();
                    fetch_social_media();

                }
            });
            $('#save').hide();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("{{('Are you sure delete this social media')}}?")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('admin.business-settings.social-media-delete')}}",
                    method: 'POST',
                    data: {id: id},
                    success: function (data) {
                        fetch_social_media();
                        toastr.success('{{('Social media deleted Successfully')}}.');
                    }
                });
            }
        });
        $(document).on('click', '.edit', function () {
            $('#update').show();
            $('#contact_form').show();
            $('#add').hide();
            var id = $(this).attr("id");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.social-media-edit')}}",
                method: 'POST',
                data: {id: id},
                success: function (data) {
                    $(window).scrollTop(0);
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#link').val(data.link);
                    $('#icon').val(data.icon);
                    fetch_social_media()
                }
            });
        });
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
                url: "{{route('admin.business-settings.social-media-status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('{{('Status updated successfully')}}');
                }
            });
        });
    </script>
@endpush
