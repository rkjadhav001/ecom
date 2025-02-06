@extends('layouts.back-end.app')

@section('title', ('Bussiness List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            box-shadow: 0 0 1px #377dff;
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

        #banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }
       /* start read more css*/
        .description {
            position: relative;
        }

        .full-description {
            display: none;
        }

        .read-more, .read-less {
            cursor: pointer;
            color: blue;
        }

        .read-more:hover, .read-less:hover {
            text-decoration: underline;
        }
        /* end read more css*/

        @media (max-width: 768px) {
            #banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }

        }

        @media (max-width: 375px) {
            #banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

        }

        @media (max-width: 500px) {
            #banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }

        }

    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center mb-3">
                <div class="col-sm">
                    <h1 class="page-header-title">{{('Bussiness')}}
                        <span class="badge badge-soft-dark ml-2">{{\App\Model\Bussiness::count()}}</span>
                    </h1>
                </div>
            </div>
            <!-- End Row -->

            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-left"></i>
              </a>
            </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-right"></i>
              </a>
            </span>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{('Bussiness')}} {{('List')}} </a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="flex-between row justify-content-between align-items-center flex-grow-1 mx-1">
                            <div>
                                <div class="flex-start">
                                    <div><h5>{{ ('Bussiness')}} {{ ('Table')}}</h5></div>
                                    <div class="mx-1"><h5 style="color: red;">({{ $bussiness->total() }})</h5></div>
                                </div>
                            </div>
                            
                            <div style="width: 60vw">
                                <!-- Search -->
                               
                                <form  method="GET" style="display: flex;">
                                    <div class="d-flex align-items-center">
                                        <span class="mx-2">From</span>
                                        <div class="input-group p-2">
                                            <input type="date" class="form-control border-0 bg-light rounded" name="from_date" value="{{ $old_from_date }}" placeholder="From Date">
                                        </div>
                                        <span class="mx-2">to</span>
                                        <div class="input-group p-2">
                                            <input type="date" class="form-control border-0 bg-light rounded" name="to_date" value="{{ $old_to_date }}" placeholder="To Date">
                                        </div>
                                    </div>
                                    
                                        
                                    
                                    <div class="input-group input-group-merge input-group-flush p-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{('Search ')}}" aria-label="Search " value="{{ $search }}" >
                                        <button type="submit" class="btn btn-primary">{{('search')}}</button>
                                    </div>
                                </form>
                                
                                <!-- End Search -->
                            </div>
                        </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class=" datatable-custom">
                <table
                       style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                       class="table table-hover table-responsive table-borderless table-thead-bordered card-table"
                       style="width: 100%"
                       data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                           #
                        </th>
                           <!-- <th>{{('Action')}}</th> -->
                           <th class="table-column-pl-0">{{('Employee Name')}}</th>
                           <th> Shop </th>
                           <th> Selfie </th>
                           <th class="table-column-pl-0">{{('Bussiness Name')}}</th>
                           <th style="word-wrap: break-word;">{{('Bussiness Description')}}</th>
                           <th>{{('Phone')}}</th>
                           <th>{{('WhatsApp Number')}}</th>
                           <th>{{('Address')}}</th> 
                           <th class="table-column-pl-0">{{('Sales Employee Name')}}</th>
                           <th>{{('Intrest')}}</th> 
                           <th>{{('Feedback')}}</th> 
                           <th>{{('Active')}} / {{('InActive')}}</th>
                         
                        
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($bussiness as $key=>$bsn)
                        <tr class="">
                            <td class="">
                                {{ $key +1 }}
                            </td>
                            <!-- <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        
                                        {{--<a class="dropdown-item" target="" href="">
                                            <i class="tio-download"></i> Suspend
                                        </a>--}}
                                    </div>
                                </div>
                            </td> -->
                            
                            <td>{{ App\Model\Admin::where('id',$bsn['employee_id'])->pluck('name')[0] }}</td>
                            <td>
                                @if (!$bsn['shop_image'])
                                <a href="{{asset('assets/front-end/img/image-place-holder.png')}}">
                                    <img src="{{asset('assets/front-end/img/image-place-holder.png')}}" style="height: 60px; width:60px;object-fit: contain;" /></a>
                                @else
                                <a href="{{asset('bussiness/'.$bsn['shop_image'])}}">
                                    <img src="{{asset('bussiness/'.$bsn['shop_image'])}}" style="height: 60px; width:60px;object-fit: contain;" /></a>
                                    <a href="{{route('admin.bussiness.view-bussiness-image',['id'=> $bsn['id']])}}" target="_blank" style="cursor: pointer;" class="badge badge-soft-dark ml-2">View all</a>
                                @endif
                                
                            </td>
                            <td>
                                @if (!$bsn['selfie_image'])
                                <a href="{{asset('assets/front-end/img/image-place-holder.png')}}">
                                    <img src="{{asset('assets/front-end/img/image-place-holder.png')}}" style="height: 60px; width:60px;object-fit: contain;" /></a>
                                @else
                                <a href="{{asset('bussiness/'.$bsn['selfie_image'])}}">
                                <img src="{{asset('bussiness/'.$bsn['selfie_image'])}}" style="height: 60px; width:60px;object-fit: contain;" /></a>
                                @php
                                    $mapLinkselfie = "https://www.google.com/maps/search/?api=1&query={$bsn['selfiee_latitude']},{$bsn['selfiee_longitude']}";
                                @endphp
                                <a href="{{ $mapLinkselfie }}" target="_blank" style="cursor: pointer;" class="badge badge-soft-dark ml-2">View Location</a>
                                </td>
                                @endif
                            <td class="table-column-pl-0">  {{$bsn['name']}} </td>
                            
                            
                            <td>
                                <div class="description">
                                    {{ substr($bsn['bussiness_description'], 0, 200) }}
                                    @if(strlen($bsn['bussiness_description']) > 200)
                                        <span class="read-more">Read more</span>
                                        <span class="full-description">{{ $bsn['bussiness_description'] }}</span>
                                        <span class="read-less" style="display: none;">Show less</span>
                                    @endif
                                </div>
                            </td>
                            
                            <td>
                               {{$bsn['mobile']}}
                            </td>
                            <td>
                               {{$bsn['whatsapp_number']}}
                            </td>
                            <td>
                                @php
                                     $mapLink = "https://www.google.com/maps/search/?api=1&query={$bsn['latitude']},{$bsn['longitude']}";
                                @endphp
                               
                               <a href='{{$mapLink}}' target="_blank" style="cursor: pointer;">{{$bsn['address']}},{{$bsn['city']}}, {{$bsn['state']}}, {{$bsn['country']}}, {{$bsn['pincode']}}</a>
                            </td> 
                            @if ($bsn['sales_employee_id'])
                            <td> {{ $bsn['sales_employee_id'] ? App\Model\Admin::where('id',$bsn['sales_employee_id'])->pluck('name')[0] : '' }} </td>
                            <td>{{$bsn['interest']}}</td>
                            <td>{{$bsn['feedback']}}</td>
                            @else
                            <td colspan="3" style="text-align: center; background-color: #f8fafd;">FeedBack Remaining to Collect</td>
                            @endif
                           
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="status"
                                           id="{{$bsn['id']}}" {{$bsn->status == 1?'checked':''}}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
               {!! $bussiness->links() !!}
            </div>
            @if(count($bussiness)==0)
                <div class="text-center p-4">
                    <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                    <p class="mb-0">{{('No data to show')}}</p>
                </div>
            @endif
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                // language: {
                //     zeroRecords: '<div class="text-center p-4">' +
                //         '<img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                //         '<p class="mb-0">No data to show</p>' +
                //         '</div>'
                // }
            });

           // Using jQuery
            $('.read-more').on('click', function() {
                $(this).hide();
                $(this).next('.full-description').show();
                $(this).next('.full-description').next('.read-less').show();
            });

            $('.read-less').on('click', function() {
                $(this).hide();
                $(this).prev('.full-description').hide();
                $(this).prev('.full-description').prev('.read-more').show();
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });
        });
    </script>

    <script>
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
                url: "{{route('admin.bussiness.status-update')}}",
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
