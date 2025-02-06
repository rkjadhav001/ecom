<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{\App\CPU\translate('invoice')}}</title>

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

              background-color: {{$web_config['primary_color']}};;

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

            border: 22px solid{{$web_config['primary_color']}};

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



        .btn 

        {

            box-sizing: border-box;

            appearance: none;

            background-color: transparent;

            border-radius: 0.6em;

            cursor: pointer;

            line-height: 1;

            margin: 10px;

            padding: 1.2em 2.8em;

            text-decoration: none;

            text-align: center;

            text-transform: uppercase;

            font-family: 'Montserrat', sans-serif;

            font-weight: 700;

        }



        @media only screen and (max-width: 600px) {

        .mb {

            margin: 35px 20px !important;

        }

        /* .bill_add {

            width: 50% !important;

        }

        .ship_add {

            width: 50% !important;

        } */

}

            

    </style>

</head>



<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<body onload="printDiv('printableArea');">

@php

    use App\Model\BusinessSetting;

    $company_phone =BusinessSetting::where('type', 'company_phone')->first()->value;
    $company_email =BusinessSetting::where('type', 'company_email')->first()->value;
    $company_name =BusinessSetting::where('type', 'company_name')->first()->value;
    $company_web_logo =BusinessSetting::where('type', 'company_web_logo')->first()->value;
    $company_mobile_logo =BusinessSetting::where('type', 'company_mobile_logo')->first()->value;

    $contact_mobile =BusinessSetting::where('type', 'contact_mobile')->first()->value;
    $contact_email =BusinessSetting::where('type', 'contact_email')->first()->value;
    $contact_address =BusinessSetting::where('type', 'contact_address')->first()->value;

@endphp

<div style="border: 1px solid #ddd;margin: 35px 110px;border: 1px solid #EBE7E7;border-radius: 6px;background: white;box-shadow: 0 3px 10px rgb(69 14 33 / 15%);" class="mb" id="printableArea">

    <div class="first" style="display: block; height:auto !important;background-color: #fff">

        <table class="content-position">

            <tr>

                <th style="text-align: left">

                    <img height="100" width="100" src="{{ asset('storage/company/logo.png') }}" style="margin-left: 40%;"

                        alt="">

                </th>

                <!--<th style="text-align: right">-->

                <!--    <h1 style="color: #030303; margin-bottom: 0px; font-size: 30px;text-transform: capitalize">{{\App\CPU\translate('invoice')}}</h1>-->

                <!--    @if($order['seller_is']!='admin' && $order['seller']->gst != null)-->

                <!--        <h5 style="color: #030303; margin-bottom: 0px;text-transform: capitalize">{{\App\CPU\translate('GST')}}-->

                <!--            : {{ $order['seller']->gst }}</h5>-->

                <!--    @endif-->

                <!--</th>-->

            </tr>

        </table>



    </div>



    <table style="width: 100%; margin-bottom: 0px;">

        <tbody>

        <tr>

        <td style="padding: 15px 20px 15px 0px;font-size:20px;width: 33%;font-weight: 600;text-align: center;font-family: sans-serif;">Invoice ID #{{ $order->id }}</td>

        <td style="padding: 15px 20px 15px 0px;font-size:20px;width: 33%;font-weight: 600;text-align: center;font-family: sans-serif;">INVOICE</td>

        <td style="padding: 15px 20px 15px 0px;font-size:20px;width: 33%;font-weight: 600;text-align: center;font-family: sans-serif;">{{date('d-m-Y h:i:s A',strtotime($order['created_at']))}}</td>

        </tr>



        </tbody>

    </table>

    <br>

    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">



    <div class="row" style="margin: 0px 0; display:block; height:auto !important ;">

        <div class=" content-height content-position-y" style="">

        <table style="width: 100%; margin-bottom: 40px;">

                <tbody>

                <tr>

                <td style="padding: 15px 20px 15px 0px;color: #e35f14;font-size: 20px; font-weight: 600;font-family: sans-serif;" >Billing Address</td>

                <td style="padding: 15px 20px 15px 0px;color: #e35f14;font-size: 20px;font-weight: 600;font-family: sans-serif;" >Shipping Address</td>

                </tr>

                <tr>

                <td style="font-family: sans-serif;padding: 15px 20px;border-left: 1px solid #ccc;border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;line-height: 25px;font-size: 17px;">{{$order->customer['f_name'].' '.$order->customer['l_name']}}<br>{{$order->shippingAddress ? $order->shippingAddress['address'] : ""}}<br>{{$order->shippingAddress ? $order->shippingAddress['city'] : ""}} {{$order->shippingAddress ? $order->shippingAddress['zip'] : ""}}<br>{{$order->shippingAddress ? $order->shippingAddress['country'] : ""}}<br>{{$order->customer['phone']}}<br><b style="color: #00bcd4;">{{$order->customer['email']}}</b></td>

                <td style="font-family: sans-serif;padding: 15px 20px;border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;line-height: 25px; vertical-align: top;font-size: 17px;">{{$order->customer['f_name'].' '.$order->customer['l_name']}}, <br>{{$order->shippingAddress ? $order->shippingAddress['address'] : ""}},<br>{{$order->shippingAddress ? $order->shippingAddress['city'] : ""}} {{$order->shippingAddress ? $order->shippingAddress['zip'] : ""}}<br>{{$order->shippingAddress ? $order->shippingAddress['country'] : ""}}</td>

                </tr>

                </tbody>

        </table>  

        </div>

    </div>

    <div class="row" style="margin: 0px 0; display:block; height:auto !important ;">

        <div class=" content-height content-position-y" style="">

        <table class="customers bs-0">

                <thead>

                <tr class="for-th">

                    <th class="for-th bg-primary">{{\App\CPU\translate('no.')}}</th>

                    <th class="for-th bg-primary">{{\App\CPU\translate('item_description')}}</th>

                    <th class="for-th bg-primary" >

                        {{\App\CPU\translate('unit_price')}}

                    </th>

                    <th class="for-th bg-primary" >

                        {{\App\CPU\translate('qty')}}

                    </th>

                    <th class="for-th bg-primary" >

                        {{\App\CPU\translate('total')}}

                    </th>

                </tr>

                </thead>

                @php

                    $subtotal=0;

                    $total=0;

                    $sub_total=0;

                    $total_tax=0;

                    $total_shipping_cost=0;

                    $total_discount_on_product=0;

                @endphp

                <tbody>

                @foreach($order->details as $key=>$details)

                    @php $subtotal=($details['price'])*$details->qty @endphp

                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold">{{$key+1}}</td>

                        <td class="for-tb">

                            {{$details['product']?$details['product']->name:''}}

                            <br>

                            {{\App\CPU\translate('variation')}} : {{$details['variant']}}

                        </td>

                        <td class="for-tb for-th-font-bold">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($details['price']))}}</td>

                        <td class="for-tb">{{$details->qty}}</td>

                        <td class="for-tb for-th-font-bold">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($subtotal))}}</td>

                    </tr>



                    @php

                        $sub_total+=$details['price']*$details['qty'];

                        $total_tax+=$details['tax'];

                        $total_shipping_cost+=$details->shipping ? $details->shipping->cost :0;

                        $total_discount_on_product+=$details['discount'];

                        $total+=$subtotal;

                    @endphp

                @endforeach

                <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('sub_total')}}</td>

                        

                        <td class="for-tb " colspan="1" style="text-align:right;">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($sub_total))}}</td>

                        

                    </tr>



                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('tax')}}</td>

                        

                        <td class="for-tb" colspan="1" style="text-align:right;">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total_tax))}}</td>

                        

                    </tr>

                    

                    



                    

                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('shipping')}}</td>

                        

                        <td class="for-tb" colspan="1" style="text-align:right;">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->shipping_cost))}}</td>

                        

                    </tr>

                    

                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('coupon discount')}}</td>

                        

                        <td class="for-tb" colspan="1" style="text-align:right;">- {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->discount_amount))}}</td>

                        

                    </tr>

                    

                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('discount on product')}}</td>

                        

                        <td class="for-tb" colspan="1" style="text-align:right;">- {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total_discount_on_product))}}</td>

                        

                    </tr>

                    

                    <tr class="for-tb" style=" border: 1px solid #D8D8D8;margin-top: 5px">

                        <td class="for-tb for-th-font-bold" colspan="4">{{\App\CPU\translate('total')}}</td>

                        

                        <td class="for-tb" colspan="1" style="text-align:right;">{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount))}}</td>

                        

                    </tr>

                </tbody>



            </table>  

        </div>

    </div>

    @php($shipping=$order['shipping_cost'])

    <br>

    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">

		<div align="left" style="padding-right: 22px;padding-left: 22px;justify-content: center;">

		<div style="font-size:1px;line-height:22px">&nbsp;

			<table style="width: 100%;">

				<tbody>

				<tr>

					<td style="padding: 20px; width: 30%;"></td>

					

					<td style="padding: 20px; width: 20%; text-align: right; vertical-align: top;"></td>

				     <td style="font-family: sans-serif;padding: 20px;width: 50%;text-align: right;line-height: 28px;font-size: 17px;vertical-align: top;">

						<p>Address - {{ $contact_address }}<br>

							Email-{{ $contact_email }}<br>

						Contact : {{ $contact_mobile }}</p>

					</td>

				</tr>

				</tbody>

			</table>



		</div>

    </div>

    <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">

		<div align="left" style="padding-right: 22px;padding-left: 22px;justify-content: center;">

		<div style="font-size:1px;line-height:22px">&nbsp;

			<table style="width: 100%;">

				<tbody>

				<tr>

					<td style="padding: 20px; width: 30%;"><img class="oMU93c" jsname="SRZeM" src="{{ asset('storage/company/logo.png') }}" height="100" width="100"></td>

					<td style="padding: 20px; width: 30%; text-align: left; line-height: 28px; font-size: 20px; vertical-align: top;">

						

					</td>

					<td style="padding: 20px; width: 40%; text-align: right; vertical-align: top;"><p>GST : 24AWFPJ6987N2ZQ</p></td>

				</tr>

				</tbody>

			</table>



		</div>

    </div>



    <div style="min-width: 940px; max-width: 940px; display: table-cell; vertical-align: top; width: 940px;">

	<div style="width:100% !important; text-align: center; padding: 20px;font-family: sans-serif;">

  	<p>As per Section 31 of CGST act read with rules, invoice is issued at the point of delivering the goods.</p>

  	</div>

  </div>



    {{--<div class="col-12 col-md-3" style="text-align:center;margin-top:10px;">

        <button type="button" id="btn" onclick="printDiv('printableArea')" class="btn">{{('Print')}}</button> 

    </div>--}}

</div>



</body>



</html>





<script>

    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;

        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;



    }

    

</script>