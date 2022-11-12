@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                {{__("Order With Code")}} {{$order->order_code}} - {{\App\Enums\OrderEnum::statues()[$order->order_status]}}
            </x-card-title>
            <x-card-toolbar>
                <x-back-btn :route="route('admin.order.index')" />
            </x-card-toolbar>
        </x-card-header>
    </x-card-content>
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#order_summary" aria-selected="true" role="tab">{{__("Order Summary")}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#order_histories" aria-selected="false" role="tab" tabindex="-1">{{__("Order History")}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#order_chat" aria-selected="false" role="tab" tabindex="-1">{{__("Order Chat")}}</a>
                </li>
            </ul>
        </div>
        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
            <div class="card card-flush py-4 flex-row-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{__("Order Details")}} ({{$order->order_code}})</h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor"></path>
                                                <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{__("Date Added")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">{{$order->created_at->format("Y/m/d")}}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"></path>
                                                <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{__("Payment Method")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">
                                    {{\App\Enums\OrderEnum::paymentMethods()[$order->payment_method]}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{__("Order Type")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">{{\App\Enums\VerificationOptionEnum::relatedOrders()[$order->order_type]}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-flush py-4 flex-row-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{__("Customer Details")}}</h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                                <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                                <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        {{__("Customer")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                            <a href="{{route('admin.user.show', $order->user_id)}}">
                                                <div class="symbol-label">
                                                    <img src="{{$order->client->profile_image}}" alt="{{$order->client->name}}" class="w-100">
                                                </div>
                                            </a>
                                        </div>
                                        <a href="{{route('admin.user.show', $order->user_id)}}" class="text-gray-600 text-hover-primary">{{$order->client->name}}</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{__("Email")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">
                                    <a href="{{route('admin.user.show', $order->user_id)}}" class="text-gray-600 text-hover-primary">{{$order->client->email}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-2 me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        {{__("Phone")}}
                                    </div>
                                </td>
                                <td class="fw-bold text-end">{{$order->client->phone}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card card-flush py-4 flex-row-fluid">
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{__("Captain Details")}}</h2>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if($order->captain_id)
                        <div class="table-responsive">
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                                    <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                                    <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                                </svg>
                                            </span>
                                            {{__("Captain")}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                <a href="{{route('admin.captain.show', $order->captain_id)}}">
                                                    <div class="symbol-label">
                                                        <img src="{{$order->captain->profile_image}}" alt="{{$order->captain->name}}" class="w-100">
                                                    </div>
                                                </a>
                                            </div>
                                            <a href="{{route('admin.captain.show', $order->captain_id)}}" class="text-gray-600 text-hover-primary">{{$order->captain->name}}</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                                                    <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            {{__("Email")}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        <a href="{{route('admin.captain.show', $order->captain_id)}}" class="text-gray-600 text-hover-primary">{{$order->captain->email}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor"></path>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            {{__("Phone")}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$order->captain->phone}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-center">{{__("Customer Doesn't select captain yet")}}</h3>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="order_summary" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                <img src="{{asset('admin/media/icons/duotune/ecommerce/ecm001.svg')}}" class="w-175px">
                            </div>
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__("Pick Up Location")}}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                {{$order->pickup_location}}
                                <br> {{__("Latitude")}} : {{$order->pickup_location_lat}}
                                <br>{{__("Longitude")}} : {{$order->pickup_location_long}}
                                @if($order->pickup_description)
                                    <br> {{__("Pickup Description")}} : {{$order->pickup_description}}
                                @endif
                            </div>
                        </div>
                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                <img alt="image" src="{{asset("admin/media/icons/duotune/ecommerce/ecm006.svg")}}" class="w-175px">
                            </div>
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{__("Drop off Location")}}</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                {{$order->drop_off_location}}
                                <br> {{__("Latitude")}} : {{$order->drop_off_location_lat}}
                                <br>{{__("Longitude")}} : {{$order->drop_off_location_long}}
                                @if($order->drop_off_description)
                                    <br> {{__("Location Description")}} : {{$order->drop_off_description}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__("Order Code")}} {{$order->order_code}}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-3 mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="text-start">{{__("Items Price")}}</td>
                                        <td class="text-start">{{\App\Helper\Helper::price($order->items_price)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">{{__("Delivery Cost")}}</td>
                                        <td class="text-start">{{\App\Helper\Helper::price($order->delivery_cost_with_user_commission)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">{{__("VAT")}} ({{$order->tax_percentage ?? 0}}%)</td>
                                        <td class="text-start">{{\App\Helper\Helper::price($order->tax)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">{{__("Discount")}}</td>
                                        <td class="text-start">{{\App\Helper\Helper::price($order->discount_amount)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fs-3 text-dark text-start">{{__("Grand Total")}}</td>
                                        <td class="text-dark fs-3 fw-bolder text-start">{{\App\Helper\Helper::price($order->grand_total - $order->discount_amount + $order->items_price)}}</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="order_histories" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4 flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__("Order History")}}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle text-center table-row-dashed fs-6 gy-5 mb-0">
                                    <thead>
                                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">{{__("Date Added")}}</th>
                                        <th class="min-w-175px">{{__("Comment")}}</th>
                                        <th class="min-w-70px">{{__("Order Status")}}</th>
                                        <th class="min-w-100px">{{__("Client Notified")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-center text-gray-600">
                                    @foreach($order->histories()->latest("order_histories.created_at")->get() as $history)
                                        <tr>
                                            <td>{{$history->created_at->format("Y/m/d")}}</td>
                                            <td>{{$history->comment}}</td>
                                            <td>
                                                @if($history->type == "change_order_status")
                                                    @if($history->order_status == \App\Enums\OrderEnum::DELIVERED)
                                                        <div class="badge badge-light-success">{{__("Delivered")}}</div>
                                                    @endif
                                                    @if($history->order_status == \App\Enums\OrderEnum::WAITING_OFFERS)
                                                        <div class="badge badge-light-info">{{__("Waiting Offers")}}</div>
                                                    @endif
                                                    @if($history->order_status == \App\Enums\OrderEnum::CANCELED)
                                                        <div class="badge badge-light-danger">{{__("Canceled")}}</div>
                                                    @endif
                                                    @if($history->order_status == \App\Enums\OrderEnum::IN_PROGRESS)
                                                        <div class="badge badge-light-primary">{{__("In Progress")}}</div>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{$history->is_client_notified == 1 ? __("Yes") : __("No")}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="order_chat" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4 flex-row-fluid">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{__("Chats")}}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0" id="kt_chat_messenger_body">
                            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px" style="">

                                @foreach($order->chat->messages()->orderBy("chat_messages.created_at", "asc")->get() as $message)

                                    @if($message->sender_id != $order->captain_id)
                                        <div class="d-flex justify-content-start mb-10">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="{{$message->sender->profile_image}}">
                                                    </div>
                                                    <div class="ms-3">
                                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{$message->sender->name}}</a>
                                                        <span class="text-muted fs-7 mb-1">{{$message->created_at->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                                <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">
                                                    @if($message->type == "text" && $message->style_type == null)
                                                        {{$message->message_text}}
                                                    @endif
                                                    @if($message->type == "text" && $message->style_type == "DISTANCE_DURATION_COST_STYLE")
                                                        <h4>{{__("Delivery Cost")}} : {{\App\Helper\Helper::price($message->delivery_cost)}}</h4>
                                                        <h4>{{__("Delivery Distance")}} : {{$message->delivery_distance}} {{__("KM")}}</h4>
                                                        <h4>{{__("Delivery Duration")}} : {{$message->delivery_duration}} {{__("MIN")}}</h4>
                                                    @endif
                                                    @if($message->type == "text" && $message->style_type == "ADMIN_WARNING_MESSAGE_STYLE")
                                                        <p class="mb-0" style="border: 2px solid red; padding: 10px; border-radius: 10px;">
                                                            {{$message->message_text}}
                                                        </p>
                                                    @endif
                                                    @if($message->type == "location" && $message->style_type == "ORDER_PICK_LOCATION_STYLE")
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$message->lat}},{{$message->long}}?&zoom=13&size=300x200&&channel=webpwa&markers=anchor:bottomcenter|{{$message->lat}},{{$message->long}}&key={{config("services.google_map.api")}}" alt="">
                                                        <p class="my-3">{{$order->pickup_location}}</p>
                                                    @endif
                                                    @if($message->type == "location" && $message->style_type == "ORDER_DROP_OFF_LOCATION_STYLE")
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$message->lat}},{{$message->long}}?&zoom=13&size=300x200&&channel=webpwa&markers=anchor:bottomcenter|{{$message->lat}},{{$message->long}}&key={{config("services.google_map.api")}}" alt="">
                                                        <p class="my-3">{{$order->drop_off_location}}</p>
                                                    @endif
                                                    @if($message->type == "images")
                                                        @foreach($message->getMedia("chat_images") as $image)
                                                            <img src="{{$image->getUrl()}}" class="img-fluid" alt="">
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-end mb-10">
                                            <div class="d-flex flex-column align-items-end">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="me-3">
                                                        <span class="text-muted fs-7 mb-1">{{$message->sender->created_at->diffForHumans()}}</span>
                                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">{{$message->sender->name}}</a>
                                                    </div>
                                                    <div class="symbol symbol-35px symbol-circle">
                                                        <img alt="Pic" src="{{$message->sender->profile_image}}">
                                                    </div>
                                                </div>
                                                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">
                                                    @if($message->type == "text" && $message->style_type == null)
                                                        {{$message->message_text}}
                                                    @endif
                                                    @if($message->type == "text" && $message->style_type == "DISTANCE_DURATION_COST_STYLE")
                                                        <h4>{{__("Delivery Cost")}} : {{\App\Helper\Helper::price($message->delivery_cost)}}</h4>
                                                        <h4>{{__("Delivery Distance")}} : {{$message->delivery_distance}} {{__("KM")}}</h4>
                                                        <h4>{{__("Delivery Duration")}} : {{$message->delivery_duration}} {{__("MIN")}}</h4>
                                                    @endif
                                                    @if($message->type == "text" && $message->style_type == "ADMIN_WARNING_MESSAGE_STYLE")
                                                        <p class="mb-0" style="border: 2px solid red; padding: 10px; border-radius: 10px;">
                                                            {{$message->message_text}}
                                                        </p>
                                                    @endif
                                                    @if($message->type == "location" && $message->style_type == "ORDER_PICK_LOCATION_STYLE")
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$message->lat}},{{$message->long}}?&zoom=13&size=300x200&&channel=webpwa&markers=anchor:bottomcenter|{{$message->lat}},{{$message->long}}&key={{config("services.google_map.api")}}" alt="">
                                                        <p class="my-3">{{$order->pickup_location}}</p>
                                                    @endif
                                                    @if($message->type == "location" && $message->style_type == "ORDER_DROP_OFF_LOCATION_STYLE")
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$message->lat}},{{$message->long}}?&zoom=13&size=300x200&&channel=webpwa&markers=anchor:bottomcenter|{{$message->lat}},{{$message->long}}&key={{config("services.google_map.api")}}" alt="">
                                                        <p class="my-3">{{$order->drop_off_location}}</p>
                                                    @endif
                                                    @if($message->type == "images")
                                                        @foreach($message->getMedia("chat_images") as $image)
                                                                <img src="{{$image->getUrl()}}" class="img-fluid" alt="">
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
