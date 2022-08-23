<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    {!! \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() == "rtl" ? "style='direction:rtl;' dir='rtl'" : ""!!}
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->title }}</title>
    <meta name="description" content="{{ $setting->description }}"/>
    <meta name="keywords" content="{{ $setting->description }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:title" content="{{ $setting->title }}"/>
    <link rel="icon" href="{{ $setting->logo }}" sizes="16x16 32x32 48x48 64x64"/>
    <meta property="og:image" content="{{ $setting->logo }}"/>
    <meta property="og:image:secure_url" content="{{ $setting->logo }}"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:height" content="300"/>
    <meta property="og:image:alt" content="A shiny red apple with a bite taken out"/>
    @include("global-partials.styles")
    @yield("styles")
</head>
<body id="kt_body" class="app-blank app-blank">
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-5 order-2 order-lg-1">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <a href="{{route("admin.login")}}" class="mb-5">
                    <img alt="Logo" src="{{$setting->logo}}" class="h-85px"/>
                </a>
                <div class="w-lg-700px p-5">
                    @yield("content")
                </div>
            </div>
        </div>
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
             style="background-image: url('{{asset("admin/media/auth/bg7.jpg")}}')">
            <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                <img class="mx-auto w-275px w-md-50 w-xl-800px mb-10 mb-lg-20"
                     src="{{asset("admin/media/misc/auth-screens.png")}}" alt=""/>
                <h1 class="text-white fs-2qx fw-bolder text-center mb-7">{{__("Fast, Efficient and Productive")}}</h1>
            </div>
        </div>
    </div>
</div>
@include("global-partials.scripts")
@yield("scripts")
</body>
</html>
