<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
@if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() == "ltr")
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <link href="{{asset("admin/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/plugins/custom/datatables/datatables.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
@else
    <link href="{{asset("admin/plugins/global/plugins.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/css/style.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
@endif
<link href="{{asset("admin/css/app.css")}}" rel="stylesheet" type="text/css" />
