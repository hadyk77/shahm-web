<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('print.css')}}"/>
    <title>{{$order->order_code}}</title>
    <style>
        body{
            font-family: 'DejaVuSerif', sans-serif !important;
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
        @production
            <img src="{{$gs->logo}}" alt="LOGO">
        @else
            <img src="https://shahm.co/storage/f6d3256e36479585dbb217b56d145e8f/logo.png" alt="LOGO">
        @endproduction
    </div>
    <div class="right">
        <h2 style=" font-family: 'XBRiyaz', sans-serif; font-size:25px;">{{__("Invoice")}}</h2>
        <h2  style="font-family: 'Dosis', sans-serif">Invoice</h2>
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
            <th class="service" style="background: #839C81; font-size: 20px;">{{__('Service Title')}}</th>
            <th class="service" style="background: #839C81; font-size: 20px;">{{__('Service Date')}}</th>
            <th class="service" style="background: #839C81; font-size: 20px;">{{__('people')}}</th>
            <th class="service" style="background: #839C81; font-size: 20px;">{{__('Service Price')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <h4>{{$order->service->title}}</h4>
            </td>
            <td class="text-center">
                <h4>{{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</h4>
            </td>
            <td>
                <h4>{{$order->people_number}}</h4>
            </td>
            <td>
                <h4>{{\App\Helper\Helper::price($order->total_price)}}</h4>
            </td>
        </tr>
        </tbody>
    </table>
</main>
<div class="left" style="text-align: right">
    <h2>{{__('Grand Total')}}</h2>
    <h2 style="color: #839C81">{{\App\Helper\Helper::price($order->total_price)}}</h2>
</div>
<div class="right"></div>
</body>
</html>
