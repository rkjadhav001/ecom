@extends('layouts.back-end.app')

@section('title', ('Product Discount'))

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
                    aria-current="page">{{('Product Discount')}}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h4 class="mb-0 text-black-50">{{('Product')}} {{('Discount')}} </h4>
        </div>

        <div class="row" style="padding-bottom: 20px">
        <div class="col-md-12 row">
            <div class="col-md-6">
                
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                      @php
                         $data=DB::table('product_discount')->where('id',1)->first();
                         $data1=DB::table('product_discount')->where('id',2)->first();
                      @endphp
                      
                        <form action="{{route('admin.product.update_charge')}}"
                              method="post">
                            @csrf

                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="mb-0 text-black-50">{{('Percentage')}} {{('Discount')}} </h4>
                            </div>
                            <hr>
                            <label>{{('Percentage Discount 1')}}</label>
                            <input type="number" class="form-control" name="range_1"
                                   value="{{$data->range_1}}"
                                  required>
                            
                            <br>
                            <label>{{('Percentage Discount Amount  1')}}</label>
                            <input type="number" class="form-control" name="range_amount_1"
                                   value="{{$data->range_amount_1}}"
                                  required>
                            
                                  <br>
                            <label>{{('Percentage Discount 2')}}</label>
                            <input type="number" class="form-control" name="range_2"
                                   value="{{$data->range_2}}"
                                  required>
                                  <br>
                            <label>{{('Percentage Discount Amount  2')}}</label>
                            <input type="number" class="form-control" name="range_amount_2"
                                   value="{{$data->range_amount_2}}"
                                  required>
                            
                                  <br>
                            <label>{{('Percentage Discount 3')}}</label>
                            <input type="number" class="form-control" name="range_3"
                                   value="{{$data->range_3}}"
                                  required>
                                  <br>
                            <label>{{('Percentage Discount Amount  3')}}</label>
                            <input type="number" class="form-control" name="range_amount_3"
                                   value="{{$data->range_amount_3}}"
                                  required>
                                  
                                  <br>
                            <!-- <hr>

                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="mb-0 text-black-50">{{('Flat')}} {{('Discount')}} </h4>
                            </div>

                            <hr>



                            <label>{{('Flat Discount 1')}}</label>
                            <input type="number" class="form-control" name="range_4"
                                   value="{{$data1->range_1}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount Amount  1')}}</label>
                            <input type="number" class="form-control" name="range_amount_4"
                                   value="{{$data1->range_amount_1}}"
                                  required>
                            
                           
                                  <br>
                            <label>{{('Flat Discount 2')}}</label>
                            <input type="number" class="form-control" name="range_5"
                                   value="{{$data1->range_2}}"
                                  required>
                            
                                  <br>
                            <label>{{('Flat Discount Amount  2')}}</label>
                            <input type="number" class="form-control" name="range_amount_5"
                                   value="{{$data1->range_amount_2}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount 3')}}</label>
                            <input type="number" class="form-control" name="range_6"
                                   value="{{$data1->range_3}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount Amount  3')}}</label>
                            <input type="number" class="form-control" name="range_amount_6"
                                   value="{{$data1->range_amount_3}}"
                                  required> -->
                            

                            
                            <button type="submit"
                                    class="btn btn-primary {{Session::get('direction') === "rtl" ? 'float-left mr-3' : 'float-right ml-3'}}">{{('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                      @php
                         $data=DB::table('product_discount')->where('id',1)->first();
                         $data1=DB::table('product_discount')->where('id',2)->first();
                      @endphp
                      
                        <form action="{{route('admin.product.update_charge1')}}"
                              method="post">
                            @csrf

                            <!-- <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="mb-0 text-black-50">{{('Percentage')}} {{('Discount')}} </h4>
                            </div>
                            <hr>
                            <label>{{('Percentage Discount 1')}}</label>
                            <input type="number" class="form-control" name="range_1"
                                   value="{{$data->range_1}}"
                                  required>
                            
                            <br>
                            <label>{{('Percentage Discount Amount  1')}}</label>
                            <input type="number" class="form-control" name="range_amount_1"
                                   value="{{$data->range_amount_1}}"
                                  required>
                            
                                  <br>
                            <label>{{('Percentage Discount 2')}}</label>
                            <input type="number" class="form-control" name="range_2"
                                   value="{{$data->range_2}}"
                                  required>
                                  <br>
                            <label>{{('Percentage Discount Amount  2')}}</label>
                            <input type="number" class="form-control" name="range_amount_2"
                                   value="{{$data->range_amount_2}}"
                                  required>
                            
                                  <br>
                            <label>{{('Percentage Discount 3')}}</label>
                            <input type="number" class="form-control" name="range_3"
                                   value="{{$data->range_3}}"
                                  required>
                                  <br>
                            <label>{{('Percentage Discount Amount  3')}}</label>
                            <input type="number" class="form-control" name="range_amount_3" -->
                                   <!-- value="{{$data->range_amount_3}}"
                                  required>
                                  <br>
                                  <br> -->
                            <!-- <hr> -->

                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                <h4 class="mb-0 text-black-50">{{('Flat')}} {{('Discount')}} </h4>
                            </div>

                            <hr>



                            <label>{{('Flat Discount 1')}}</label>
                            <input type="number" class="form-control" name="range_4"
                                   value="{{$data1->range_1}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount Amount  1')}}</label>
                            <input type="number" class="form-control" name="range_amount_4"
                                   value="{{$data1->range_amount_1}}"
                                  required>
                            
                           
                                  <br>
                            <label>{{('Flat Discount 2')}}</label>
                            <input type="number" class="form-control" name="range_5"
                                   value="{{$data1->range_2}}"
                                  required>
                            
                                  <br>
                            <label>{{('Flat Discount Amount  2')}}</label>
                            <input type="number" class="form-control" name="range_amount_5"
                                   value="{{$data1->range_amount_2}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount 3')}}</label>
                            <input type="number" class="form-control" name="range_6"
                                   value="{{$data1->range_3}}"
                                  required>
                                  <br>
                            <label>{{('Flat Discount Amount  3')}}</label>
                            <input type="number" class="form-control" name="range_amount_6"
                                   value="{{$data1->range_amount_3}}"
                                  required>
                            

                                  <br>
                            <button type="submit"
                                    class="btn btn-primary {{Session::get('direction') === "rtl" ? 'float-left mr-3' : 'float-right ml-3'}}">{{('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        <div>

            
        </div>

        <!--modal-->

    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/select2/js/select2.min.js')}}"></script>
    
 
@endpush
