@extends('layouts.back-end.app')
@section('title', ('Feature Deal'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{('Dashboard')}}</a></li>
                <li class="breadcrumb-item" aria-current="page"> {{ ('feature deal')}}</li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ ('deal form')}}
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.deal.flash')}}" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};" method="post">
                            @csrf
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])
                          

                            <div class="form-group">
                                <div class="row">
                                    <input type="text" name="deal_type" value="feature_deal"  class="d-none">
                                    @foreach(json_decode($language) as $lang)
                                        <div class="col-md-12 {{$lang != $default_lang ? 'd-none':''}} lang_form" id="{{$lang}}-form">
                                            <label for="name">{{ ('Title')}} ({{strtoupper($lang)}})</label>
                                            <input type="text" name="title[]" class="form-control" id="title"
                                                   placeholder="{{('Ex')}} : {{('LUX')}}">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{$lang}}" id="lang">
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">{{ ('start date')}}</label>
                                        <input type="date" name="start_date" required class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">{{ ('end date')}}</label>
                                        <input type="date" name="end_date" required class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary ">{{ ('save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--modal-->

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="flex-between row justify-content-between align-items-center flex-grow-1 mx-1">
                            <div class="flex-between">
                                <div><h5>{{\App\CPU\translate('feature_deal')}} {{ ('Table')}}</h5></div>
                                <div class="mx-1"><h5 style="color: red;">({{ $flash_deals->total() }})</h5></div>
                            </div>
                            <div style="width: 40vw">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="{{('Search by Title')}}" aria-label="Search orders" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{ ('SL')}}#</th>
                                    <th style="width: 50px">{{ ('action')}}</th>
                                    <th>{{ ('status')}}</th>
                                    <th></th>
                                    <th>{{ ('Title')}}</th>
                                    <th>{{ ('Start')}}</th>
                                    <th>{{ ('end')}}</th>
                                    
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($flash_deals as $k=>$deal)
                                    <tr>
                                        <th scope="row">{{$k+1}}</th>
                                        <td>
                                            <a href="{{route('admin.deal.edit',[$deal['id']])}}"
                                               class="btn btn-primary btn-sm">
                                                {{ trans ('Edit')}}
                                            </a>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                       id="{{$deal['id']}}" {{$deal->status == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.deal.add-product',[$deal['id']])}}"
                                               class="btn btn-primary btn-sm">
                                                {{('Add Product')}}
                                            </a>
                                        </td>
                                        <td>{{$deal['title']}}</td>
                                        <!--<td>{{$deal['start_date']}}</td>-->
                                        <!--<td>{{$deal['end_date']}}</td>-->
                                        <td>{{date('d-M-Y',strtotime($deal['start_date']))}}</td>
                                        <td>{{date('d-M-Y',strtotime($deal['end_date']))}}</td>
                                        
                                        
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$flash_deals->links()}}
                    </div>
                    @if(count($flash_deals)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{('No data to show')}}</p>
                        </div>
                    @endif
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

    <script>
        $(document).on('change', '.featured', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var featured = 1;
            } else if ($(this).prop("checked") == false) {
                var featured = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.deal.featured-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    featured: featured
                },
                success: function () {
                    toastr.success('{{('Status updated successfully')}}');
                    // location.reload();
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
                url: "{{route('admin.deal.feature-status')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('{{('Status updated successfully')}}');
                    location.reload();
                }
            });
        });

    </script>

    <!-- Page level custom scripts -->

    <script>
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>
@endpush
