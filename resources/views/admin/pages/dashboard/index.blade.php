@extends("admin.layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-3">
            <a href="#" class="card bg-white hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($orderCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-black">{{__("Orders")}}</div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{route('admin.user.index')}}" class="card bg-white hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($clientCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-black">{{__("Clients")}}</div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{route('admin.captain.index')}}" class="card bg-white hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($captainCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-black">{{__("Captains")}}</div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{route('admin.verification-files.index')}}" class="card bg-white hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-black fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($captainVerifications)}}
                    </div>
                    <div class="fw-bolder fs-2 text-black">{{__("Captains Verifications")}}</div>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="{{route('admin.contact.index')}}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($contactCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-white">{{__("Contact Messages")}}</div>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="{{route('admin.banner.index')}}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($bannerCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-white">{{__("Banners")}}</div>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="{{route('admin.discount.index')}}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($couponsCount)}}
                    </div>
                    <div class="fw-bolder fs-2 text-white">{{__("Coupons")}}</div>
                </div>
            </a>
        </div>


        <div class="col-md-3">
            <a href="{{route('admin.verification-options.index')}}" class="card bg-info hoverable card-xl-stretch mb-xl-8">
                <div class="card-body text-center">
                    <span class="svg-icon svg-icon-black svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"></path>
                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">
                        {{number_format($verificationOptions)}}
                    </div>
                    <div class="fw-bolder fs-2 text-white">{{__("Verification Options")}}</div>
                </div>
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card card-xl-stretch">
                <div class="card-header pt-5 justify-content-center">
                    <h3 class="card-title align-items-start">
                        <span class="card-label fw-bolder fs-3 mb-1">{{__("Latest Orders")}}</span>
                    </h3>
                </div>
                <div class="card-body p-1">
                    <div id="order_chart" style="height: 350px"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 mt-5">
            <div class="card card-xl-stretch">
                <div class="card-header pt-5 justify-content-center">
                    <h3 class="card-title align-items-start">
                        <span class="card-label fw-bolder fs-3 mb-1">{{__("Captain Registration")}}</span>
                    </h3>
                </div>
                <div class="card-body p-1">
                    <div id="captain_chart" style="height: 350px"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function Charts(data, months, element) {
            const a = document.getElementById("kt_charts_widget_1_chart"),
                o = 350,
                s = KTUtil.getCssVariableValue("--bs-gray-500"),
                r = KTUtil.getCssVariableValue("--bs-gray-200"),
                i = KTUtil.getCssVariableValue("--bs-primary"),
                l = KTUtil.getCssVariableValue("--bs-gray-300");
            var options = {
                series: [{name: "{{__("Counts")}}", data: data}],
                chart: {fontFamily: "inherit", type: "bar", height: o, toolbar: {show: !1}},
                plotOptions: {bar: {horizontal: !1, columnWidth: ["30%"], borderRadius: 4}},
                legend: {show: !1},
                dataLabels: {enabled: !1},
                stroke: {show: !0, width: 2, colors: ["transparent"]},
                xaxis: {
                    categories: months,
                    axisBorder: {show: !1},
                    axisTicks: {show: !1},
                    labels: {style: {colors: s, fontSize: "12px"}}
                },
                yaxis: {labels: {style: {colors: s, fontSize: "12px"}}},
                fill: {opacity: 1},
                states: {
                    normal: {filter: {type: "none", value: 0}},
                    hover: {filter: {type: "none", value: 0}},
                    active: {allowMultipleDataPointsSelection: !1, filter: {type: "none", value: 0}}
                },
                tooltip: {
                    enabled: true,
                },
                colors: [i, l],
                grid: {borderColor: r, strokeDashArray: 4, yaxis: {lines: {show: !0}}},
            };
            var chart = new ApexCharts(document.querySelector("#" + element), options);
            chart.render();
        }
    </script>
    <script>
        $(function () {
            $.ajax({
                url: "{{route("admin.order.chart")}}",
                method: "GET",
                beforeSend: function () {

                },
                success: function (response) {
                    Charts(response.data.counts, response.data.months, "order_chart")
                }
            });
            $.ajax({
                url: "{{route("admin.captain.chart")}}",
                method: "GET",
                beforeSend: function () {

                },
                success: function (response) {
                    Charts(response.data.counts, response.data.months, "captain_chart")
                }
            });
        });
    </script>
@endsection
