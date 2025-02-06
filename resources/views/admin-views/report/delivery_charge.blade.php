@extends('layouts.back-end.app')



@section('title', ('Delivery Charge'))



@push('css_or_js')

    <meta name="csrf-token" content="{{ csrf_token() }}">

@endpush



@section('content')

    <div class="content container-fluid">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a>

                </li>

                <li class="breadcrumb-item"

                    aria-current="page">{{('Delivery Charge')}}</li>

            </ol>

        </nav>



        <!-- Page Heading -->

        <div class="d-sm-flex align-items-center justify-content-between mb-2">

            <h4 class="mb-0 text-black-50">{{('Delivery')}} {{('Charge')}} </h4>

        </div>



        <div class="row" style="padding-bottom: 20px">

         

            <div class="col-md-12">

                <div class="card-header">

                    <h5>{{('Delivery Charge')}}</h5>

                </div>

                <div class="card">

                    <div class="card-body" style="padding: 20px">

                      @php

                         $data=DB::table('delivery_charge')->first();

                      @endphp

                        <form action="{{url('admin/stock/update_charge')}}"

                              method="post">

                            @csrf

                            <label>{{('Delivery Charge Within Pincode')}}</label>

                            <input type="number" class="form-control" name="delivery_charge"

                                   value="{{$data->delivery_charge}}"

                                  >

                            <hr>

                            

                            <label>{{('Delivery Charge Without Pincode')}}</label>

                            <input type="number" class="form-control" name="delivery_charge_2"

                                   value="{{$data->delivery_charge_2}}"

                                  >

                            <hr>

                            <button type="submit"

                                    class="btn btn-primary {{Session::get('direction') === "rtl" ? 'float-left mr-3' : 'float-right ml-3'}}">{{('Save')}}</button>

                        </form>

                    </div>

                </div>

            </div>



            

        </div>



        <!--modal-->



    </div>

@endsection



@push('script')

    <script src="{{asset('assets/back-end')}}/js/tags-input.min.js"></script>

    <script src="{{ asset('public/assets/select2/js/select2.min.js')}}"></script>

    

 

@endpush

