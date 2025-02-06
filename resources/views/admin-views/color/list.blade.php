@extends('layouts.back-end.app')

@section('title', ('Color List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-black-50">{{('Color List')}} <span style="color: rgb(252, 59, 10);">({{ $br->total() }})</span></h1>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Search -->
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                placeholder="{{ ('Search')}} {{ ('Color')}}" aria-label="Search orders" value="{{ $search }}" required>
                                <button type="submit" class="btn btn-primary">{{ ('Search')}}</button>
                            </div>
                        </form>
                        <div>
                            <a href="{{route('admin.color.add-new')}}" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{('Add Color')}}</span>
                            </a>
                        </div>
                        <!-- End Search -->
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 100px">
                                        {{ ('Color')}} {{ ('ID')}}
                                    </th>
                                    <th scope="col" style="width: 100px" class="text-center">
                                        {{ ('action')}}
                                    </th>
                                    <th scope="col">{{ ('Name')}}</th>
                                    <th scope="col">{{ ('Code')}}</th>
                                    
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($br as $k=>$b)
                                    <tr>
                                        <td class="text-center">{{$br->firstItem()+$k}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route('admin.color.update',[$b['id']])}}">
                                                <i class="tio-edit"></i> {{ ('Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm delete"
                                               id="{{$b['id']}}">
                                                <i class="tio-add-to-trash"></i> {{ ('Delete')}}
                                            </a>
                                        </td>
                                        <td>{{$b['name']}}</td>
                                        <td>{{$b['code']}}</td>
                                       
                                        
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer">
                        {{$br->links()}}
                    </div>
                    @if(count($br)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{ ('No data to show')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{ ('Are you sure delete this color?')}}?',
                text: "{{ ('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ('Yes')}}, {{ ('delete_it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.color.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{ ('Color deleted successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
