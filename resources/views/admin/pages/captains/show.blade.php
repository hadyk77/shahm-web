@extends("admin.layouts.app")

@section("content")
    <div class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{$user->profile_image}}" alt="image">
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$user->name}}</a>
                                <a href="javascript:;">
                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor"></path>
                                            <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z" fill="currentColor"></path>
                                            <path d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z" fill="currentColor"></path>
                                            <rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    {{__("Captain")}}
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    {{$user->address}}
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor"></path>
                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    {{$user->email}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="{{$user->captain_wallet}}" data-kt-initialized="1">{{number_format($user->captain_wallet)}}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{__("Earnings")}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="0" data-kt-initialized="1">{{$user->captain->orders()->count()}}</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{__("Orders")}}</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="0" data-kt-countup-prefix="%" data-kt-initialized="1">%0</div>
                                    </div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{__("Rates")}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{request()->routeIs("admin.captain.show") && request()->type == "overview" ? "active" : ""}}" href="{{route('admin.captain.show', [$user->id, 'type' => 'overview'])}}">{{__("Overview")}}</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{request()->routeIs("admin.captain.show") && request()->type == "orders" ? "active" : ""}} " href="{{route('admin.captain.show', [$user->id, 'type' => 'orders'])}}">{{__('Orders')}}</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{request()->routeIs("admin.captain.show") && request()->type == "account_upgrade" ? "active" : ""}} " href="{{route('admin.captain.show', [$user->id, 'type' => 'account_upgrade'])}}">{{__("Account Upgrades")}}</a>
                </li>
            </ul>
        </div>
    </div>
    @if(request()->type == 'overview')
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{__("Profile Details")}}</h3>
                </div>
                <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-primary align-self-center">{{__("Edit Profile")}}</a>
            </div>
            <div class="card-body p-9">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Full Name")}}</label>
                    <div class="col-lg-8">
                        <span class="fw-bold fs-6 text-gray-800">{{$user->name}}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Gender")}}</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->gender}}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Phone")}}</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->phone}}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Email")}}</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->email}}</span>
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Date Of Birth")}}</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->date_of_birth}}</span>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-4 fw-bold text-bold">{{__("Address")}}</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold text-gray-800 fs-6">{{$user->address}}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(request()->type == 'account_upgrade')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    <x-datatable-search-input />
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-datatable-html>
                    <td>{{__("Captain Name")}}</td>
                    <td>{{__("Option")}}</td>
                    <td>{{__("Status")}}</td>
                    <td>{{__("Created At")}}</td>
                    <td>{{__("Updated At")}}</td>
                </x-datatable-html>
            </x-card-body>
        </x-card-content>
    @endif
    @if(request()->type == "orders")
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    <x-datatable-search-input />
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-datatable-html>
                    <td>{{__("Order Code")}}</td>
                    <td>{{__("Captain")}}</td>
                    <td>{{__("Client")}}</td>
                    <td>{{__("Service")}}</td>
                    <td>{{__("Delivery Cost")}}</td>
                    <td>{{__("Total Cost")}}</td>
                    <td>{{__("Payment Method")}}</td>
                    <td>{{__("Order Status")}}</td>
                    <td>{{__("Created At")}}</td>
                </x-datatable-html>
            </x-card-body>
        </x-card-content>
    @endif
@endsection

@section("scripts")
    @if(request()->type == "orders")
        <x-datatable-script
            :route="route('admin.order.index', ['captain_id' => $user->captain->id])"
            :columns="$columns"
        />
    @endif
    @if(request()->type == "account_upgrade")
        <x-datatable-script
            :route="route('admin.verification-files.index', ['captain_id' => $user->captain->id])"
            :columns="$verificationFilesColumns"
        />
    @endif
@endsection
