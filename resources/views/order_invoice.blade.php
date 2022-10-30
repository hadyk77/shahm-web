<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('print.css')}}"/>
    <title>{{$order->order_code}}</title>
    <style>
        body{
            font-family: 'Droid', sans-serif !important;
        }
        .container {
            width: 1200px;
        }
        .left {
            float: left;
            width: 50%;
            text-align: left !important;
        }
        .left img {
            position: relative;
            left: 20px;
        }
        .right {
            float: left;
            width: 50%;
            text-align: right !important;
        }
    </style>
</head>
<body class="container">
<header class="clearfix">
    <div class="left">
        <img src="{{$gs->logo}}" alt="LOGO">
    </div>
    <div class="right">
        <h2 style="font-size:25px;">{{__("Invoice")}}</h2>
        <h2>{{$order->order_code}}</h2>
    </div>
</header>

<div class="left" style="position: relative; top: -40px;">
    <div>
        <span style="font-size: 18px;">{{__('Client Name')}}</span>
        <br />
        <strong>
            {{$order->client->name}}
        </strong>
    </div>
</div>
<div class="right" style="text-align: left;">
    <div>
        <span style="font-size: 18px;">{{__('Client Address')}}: </span>
        <strong>{{$order->client->address}}</strong>
    </div>
    <div>
        <span style="font-size: 18px;">{{__('Client Email')}} : </span>
        <strong>{{$order->client->email}}</strong>
    </div>
    <div>
        <span style="font-size: 18px;">{{__('Order Date')}} : </span>
        <strong>{{$order->created_at->format('Y-m-d')}}</strong>
    </div>
</div>
<main style="margin-top: 30px;">
    <table>
        <thead>
        <tr>
            <th class="service" style="background: #839C81; font-size: 18px;">{{__('Service Title')}}</th>
            <th class="service" style="background: #839C81; font-size: 18px;">{{__('Order Items')}}</th>
            <th class="service" style="background: #839C81; font-size: 18px;">{{__('Delivery Cost')}}</th>
            <th class="service" style="background: #839C81; font-size: 18px;">{{__('Tax')}}</th>
            <th class="service" style="background: #839C81; font-size: 18px;">{{__('Discount')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <h4>{{$order->service->title}}</h4>
            </td>
            <td class="text-center">
                <h4>{{\App\Helper\Helper::price($order->items_price)}}</h4>
            </td>
            <td>
                <h4>{{\App\Helper\Helper::price($order->delivery_cost_without_user_commission)}}</h4>
            </td>
            <td>
                <h4>{{\App\Helper\Helper::price($order->tax)}}</h4>
            </td>
            <td>
                <h4>{{\App\Helper\Helper::price($order->discount_amount)}}</h4>
            </td>
        </tr>
        </tbody>
    </table>
</main>
<div class="left" style="text-align: right">
    <h2>{{__('Grand Total')}}</h2>
    <h2 style="color: #839C81">{{\App\Helper\Helper::price($order->grand_total + $order->items_price - $order->discount_amount)}}</h2>
</div>
<div class="right"></div>
</body>
</html>
