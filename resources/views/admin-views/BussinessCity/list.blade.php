@extends('layouts.back-end.app')

@section('title', ('City List'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-black-50">{{('City List')}} <span style="color: rgb(252, 59, 10);">({{ $BussinessCity->count() }})</span></h1>
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
                                    placeholder="{{ ('Search')}} {{ ('City')}}" aria-label="Search orders" value="{{ $search }}" required>
                                <button type="submit" class="btn btn-primary">{{ ('Search')}}</button>
                            </div>
                        </form>
                        <!-- End Search -->
                        <div class="row">
                            <div class="col-md-12" id="banner-btn">
                                <a id="main-banner-add" class="btn btn-primary" href="{{route('admin.bussinesscity.add-new')}}"><i
                                        class="tio-add-circle" ></i> {{ ('Add  City')}}</a>
                              
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-borderless table-thead-bordered  card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ ('#')}}</th> 
                                    <th scope="col" >
                                        {{ ('City')}} {{ ('Name')}}
                                    </th>
                                    <th scope="col" >
                                        {{ ('City State')}}
                                    </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($BussinessCity as $key=>$b)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$b['city_name']}}</td>
                                        <td>{{$b['city_state']}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- {{$BussinessCity->links()}} --}}
                    </div>
                    @if(count($BussinessCity)==0)
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
                title: '{{ ('Are you sure delete this pincode')}}?',
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
                        url: "{{route('admin.city.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{ ('City deleted successfully')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
