@extends('layouts.back-end.app')
@section('title', ('Testimonials'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>

        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #377dff;
        }

        input:focus + .slider {
            background-color: #377dff;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .for-addFaq {
            float: right;
        }

        @media (max-width: 500px) {
            .for-addFaq {
                float: none !important;
            }
        }

    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item"
                    aria-current="page">{{('Dashboard')}}{{('Testimonials')}}</li>
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{('Testimonial')}} {{('Table')}} </h5>
                        <button class="btn btn-primary btn-icon-split for-addFaq" data-toggle="modal"
                                data-target="#addModal">
                            <i class="tio-add-circle"></i>
                            <span class="text">{{('Add')}} {{('Testimonial')}}  </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <thead>
                                <tr>
                                    <th scope="col">{{('SL')}}#</th>
                                    <th scope="col">{{('Customer Name')}}</th>
                                    <th scope="col">{{('Description')}}</th>
                                    <th scope="col">{{('Ranking')}}</th>
                                    <th scope="col">{{('Rate')}}</th>
                                    <th scope="col">{{('Status')}} </th>
                                    <th scope="col">{{('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($helps as $k=>$help)
                                    <tr>
                                        <td scope="row">{{$k+1}}</td>
                                        <td><img style="width: 60px;height: 60px"
                                                 src="{{asset('storage/banner')}}/{{$help->t_cust_image}}"><br>{{$help->t_cust_name}}</td>
                                        <td>{{$help->t_description}}</td>
                                        <td>{{$help->t_review}}</td>
                                        <td>{{$help->t_rate}}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status status_id"
                                                       data-id="{{ $help->t_id }}" {{$help->t_status == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{-- @if($help->status== 1)
                                            <a class=" status_id  btn btn-success btn-sm" data-id="{{ $help->id }}">
                                                <i class="fa fa-sync"></i>
                                            </a>
                                            @else
                                            <a class=" status_id btn btn-danger btn-sm" data-id="{{ $help->id }}">
                                                <i class="fa fa-sync"></i>
                                            </a>
                                            @endif --}}

                                            {{--<a href="{{ route('admin.helpTopic.delete',$help->id) }}" class="btn btn-danger btn-sm " onclick="alert('Are You sure to Delete')"  >
                                                    <i class="fa fa-trash"></i>--}}
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item edit-testimonial" style="cursor: pointer;"
                                                       data-toggle="modal" data-target="#editModal"
                                                       data-id="{{ $help->t_id }}">
                                                        {{ ('Edit')}}
                                                    </a>
                                                    <a class="dropdown-item delete" style="cursor: pointer;"
                                                       id="{{$help->t_id}}"> {{ ('Delete')}}</a>
                                                </div>
                                            </div>
                                            </a>
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

        {{-- add modal --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{('Add Testimonial')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/helpTopic/add-new-testimonial') }}" method="post" id="addForm" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

                            <div class="form-group">
                                <label>{{('Customer Name')}}</label>
                                <input type="text" class="form-control" name="t_cust_name" placeholder="{{('Enter Customer Name')}}">
                            </div>

                            <div class="form-group">
                                <label>{{('Description')}}</label>
                                <textarea class="form-control" name="t_description" cols="5"
                                          rows="5" placeholder="{{('Enter Description')}}"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="name">{{('Customer Image')}}</label>
                                <input type="file" name="image"
                                        class="form-control" id="t_cust_image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                        required>
                            </div>
                                
                            <div class="form-group">
                                <center>
                                    <img style="border-radius: 10px; max-height:200px;" id="viewer"
                                        src="{{asset('public/assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                </center>
                            </div>

                            <div class="form-group">
                                <label>{{('Review')}}</label>
                                <input type="text" class="form-control" name="t_review" placeholder="{{('Enter Review')}}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="control-label">{{('Status')}}</div>
                                        <label class="custom-switch" style="margin-left: -2.25rem;margin-top: 10px;">
                                            <input type="checkbox" name="status" id="status" value="1"
                                                   class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{('Active')}}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="t_rate">{{('Ranking')}}</label>
                                    <input type="number" name="t_rate" class="form-control" autofoucs>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{('Close')}}</button>
                            <button class="btn btn-primary">{{('Save')}}</button>
                    </form>
                    </div>
            </div>
        </div>
    </div>

    {{-- edit modal --}}

<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{('Edit Modal Testimonial')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="editForm" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                @csrf
                {{-- @method('put') --}}
                <div class="modal-body">

                    <div class="form-group">
                        <label>{{('Customer Name')}}</label>
                        <input type="text" class="form-control" name="t_cust_name" id="t_cust_name" placeholder="{{('Enter Customer Name')}}">
                    </div>

                    

                    <div class="form-group">
                        <label>{{('Description')}}</label>
                        <textarea class="form-control" name="t_description" cols="5"
                            rows="5" id="t_description" placeholder="{{('Enter Description')}}">
                        </textarea>
                    </div>


                    <div class="form-group">
                        <label>{{('Review')}}</label>
                        <input type="text" class="form-control" name="t_review" id="t_review" placeholder="{{('Enter Review')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-4">

                        </div>

                        <div class="col-md-4">
                            <label for="t_rate">{{('Ranking')}}</label>
                            <input type="number" name="t_rate" class="form-control" id="t_rate" required autofoucs>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{('Close')}}</button>
                    <button class="btn btn-primary">{{('update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

    

@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/back-end')}}/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
        $(document).on('click', ".status_id", function () {
            let id = $(this).attr('data-id');

            $.ajax({
                url: "status/" + id,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    toastr.success(res.success);
                    window.location.reload();
                }

            });

        });
        $(document).on('click', '.edit-testimonial', function () {
            let id = $(this).attr("data-id");
            // alert(id);
            console.log(id);
            $.ajax({
                url: "edit-testimonial/" + id,
                type: "get",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $("#t_cust_name").val(data.t_cust_name);
                    $("#t_description").val(data.t_description);
                    $("#t_review").val(data.t_review);
                    $("#t_rate").val(data.t_rate);

                    $("#editForm").attr("action", "update-testimonial/" + data.t_id);

                }
            });
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            // alert(id)
            Swal.fire({
                title: '{{('Are you sure delete this Testomonial')}}?',
                text: "{{('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{('Yes, delete it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.helpTopic.delete-testimonial')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{('Testimonial deleted successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#t_cust_image").change(function () {
            readURL(this);
        });


    </script>
@endpush
