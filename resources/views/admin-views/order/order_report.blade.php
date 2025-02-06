<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{('Order report')}}</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
    <style media="all">
        * {
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: sans-serif;
            color: #333542;
        }


        /* IE 6 */
        * html .footer {
            position: absolute;
            top: expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
        }

        body {
            font-size: .875rem;
        }

        .gry-color *,
        .gry-color {
            color: #333542;
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .5rem .7rem;
        }

        table.padding td {
            padding: .7rem;
        }

        table.sm-padding td {
            padding: .2rem .7rem;
        }

        .border-bottom td,
        .border-bottom th {
            border-bottom: 0px solid{{$web_config['primary_color']}};;
        }

        .col-12 {
            width: 100%;
        }

        [class*='col-'] {
            float: left;
            /*border: 1px solid #F3F3F3;*/
        }

        .row:after {
            content: ' ';
            clear: both;
            display: block;
        }

        .wrapper {
            width: 100%;
            height: auto;
            margin: 0 auto;
        }

        .header-height {
            height: 15px;
            border: 1px{{$web_config['primary_color']}};
            background: {{$web_config['primary_color']}};
        }

        .content-height {
            display: flex;
        }

        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table.customers {
            background-color: #FFFFFF;
        }

        table.customers > tr {
            background-color: #FFFFFF;
        }

        table.customers tr > td {
            border-top: 5px solid #FFF;
            border-bottom: 5px solid #FFF;
            text-align: center;
        }

        .header {
            border: 1px solid #ecebeb;
        }

        .customers th {
            /*border: 1px solid #A1CEFF;*/
            padding: 8px;
        }

        .customers td {
            /*border: 1px solid #F3F3F3;*/
            padding: 14px;
        }

        .customers th {
            color: white;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
        }

        .bg-primary {
            /*font-weight: bold !important;*/
            font-size: 0.95rem !important;
            text-align: left;
            color: white;
            {{--background-color:  {{$web_config['primary_color']}};--}}
              background-color: {{$web_config['primary_color']}};
        }

        .bg-secondary {
            /*font-weight: bold !important;*/
            font-size: 0.95rem !important;
            text-align: left;
            color: #333542 !important;
            background-color: #E6E6E6;
        }

        .big-footer-height {
            height: 250px;
            display: block;
        }

        .table-total {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table-total th, td {
            text-align: left;
            padding: 10px;
        }

        .footer-height {
            height: 75px;
        }

        .for-th {
            color: white;
        {{--border: 1px solid  {{$web_config['primary_color']}};--}}


        }

        .for-th-font-bold {
            /*font-weight: bold !important;*/
            font-size: 0.95rem !important;
            text-align: left !important;
            color: #333542 !important;
            background-color: #E6E6E6;
        }

        .for-tb {
            margin: 10px;
        }

        .for-tb td {
            /*margin: 10px;*/
            border-style: hidden;
        }


        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: .85rem;
        }

        .currency {

        }

        .strong {
            font-size: 0.95rem;
        }

        .bold {
            font-weight: bold;
        }

        .for-footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(214, 214, 214);
            height: auto;
            margin: auto;
            text-align: center;
        }

        .flex-start {
            display: flex;
            justify-content: flex-start;
        }

        .flex-end {
            display: flex;
            justify-content: flex-end;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
        }

        .inline {
            display: inline;
        }

        .content-position {
            padding: 15px 40px;
        }

        .content-position-y {
            padding: 0px 40px;
        }

        .triangle {
            width: 0;
            height: 0;

            border: 22px solid{{$web_config['primary_color']}};;

            border-top-color: transparent;
            border-bottom-color: transparent;
            border-right-color: transparent;
        }

        .triangle2 {
            width: 0;
            height: 0;
            border: 22px solid white;
            border-top-color: white;
            border-bottom-color: white;
            border-right-color: white;
            border-left-color: transparent;
        }

        .h1 {
            font-size: 2em;
            margin-block-start: 0.67em;
            margin-block-end: 0.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h2 {
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h4 {
            margin-block-start: 1.33em;
            margin-block-end: 1.33em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .montserrat-normal-600 {
            font-family: Montserrat;
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 6px;
            /* or 150% */


            color: #363B45;
        }

        .montserrat-bold-700 {
            font-family: Montserrat;
            font-style: normal;
            font-weight: 700;
            font-size: 18px;
            line-height: 6px;
            /* or 150% */


            color: #363B45;
        }

        .text-white {
            color: white !important;
        }

        .bs-0 {
            border-spacing: 0;
        }


    </style>
</head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>


<div class="first" style="display: block; height:auto !important;background-color: #E6E6E6">
    <table class="content-position">
        <tr>
            <th style="text-align: left">
                
            </th>
            <th style="text-align: right">
                <h1 style="color: #030303; margin-bottom: 0px; font-size: 30px;text-transform: capitalize">{{('Order Report')}}</h1>
                
            </th>
        </tr>
    </table>




</div>


<div class="row" style="margin: 20px 0; display:block; height:auto !important ;">
    <div class=" content-height content-position-y" style="">
        <table class="customers bs-0">
            <thead>
            <tr class="for-th">
                <th class="for-th bg-primary" style="text-align:center;">{{('SL')}}#</th>
                <th class="for-th bg-primary" style="text-align:center;">{{('Order')}}</th>
                <th class="for-th bg-primary" style="text-align:center;" >
                    {{('Date')}}
                </th>
                <th class="for-th bg-primary" style="text-align:center;" >
                {{('customer_name')}}
                </th>
                <th class="for-th bg-primary" style="text-align:center;" >
                {{('Status')}}
                </th>
                <th class="for-th bg-primary" style="text-align:center;" >
                {{('Total')}}
                </th>
                <th class="for-th bg-primary" style="text-align:center;" >
                {{('Order')}} {{('Status')}}
                </th>
            </tr>
            </thead>
           
            <tbody>
            @php
                $i=1;
            @endphp
            @foreach($data1 as $order)
                <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">
                    <td class="for-tb for-th-font-bold" style="text-align:center;">{{$i++}}</td>
                    <td class="for-tb for-th-font-bold" style="text-align:center;">{{$order['id']}}</td>
                    <td class="for-tb">{{date('d M Y h:i A',strtotime($order['created_at']))}}</td>

                    <td class="for-tb for-th-font-bold" style="text-align:center;">{{$order['name']}}</td>
                    @if($order['payment_status']=='paid')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{('paid')}}</td>
                    @else
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{('unpaid')}}</td>
                    @endif

                    <td class="for-tb">{{$order['order_amount']}}</td>

                    @if($order['order_status']=='pending')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{($order['order_status'])}}</td>
                    @elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{\App\CPU\translate($order['order_status'])}}</td>
                    @elseif($order['order_status']=='confirmed')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{\App\CPU\translate($order['order_status'])}}</td>
                    @elseif($order['order_status']=='failed')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{\App\CPU\translate($order['order_status'])}}</td>
                    @elseif($order['order_status']=='delivered')
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{\App\CPU\translate($order['order_status'])}}</td>
                    @else
                        <td class="for-tb for-th-font-bold" style="text-align:center;">{{\App\CPU\translate($order['order_status'])}}</td>
                    @endif

                    
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>


</body>
</html>
