@extends("admin.layouts.app")

@section("content")
    <div class="card mb-5">
        <div class="card-body flex-column p-4">
            <div class="card-rounded bg-light d-flex flex-stack flex-wrap p-2">
                <ul class="nav flex-wrap border-transparent fw-bold">
                    <li class="nav-item my-1">
                        <a class="order_status btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase active"
                           data-status="all"
                           href="javascript:;">
                            {{__("All Orders")}}
                        </a>
                    </li>
                    @foreach(\App\Enums\OrderEnum::statues() as $key => $status)
                        <li class="nav-item my-1">
                            <a class="order_status btn btn-color-gray-600 btn-active-secondary btn-active-color-primary fw-bolder fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase"
                               href="javascript:;"
                               data-status="{{$key}}"
                            >
                                {{$status}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

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
    <input type="hidden" id="order_status" value="all">
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.order.index')"
        :columns="$columns"
    />
    <script>
        $(function () {
            $('.order_status').on('click', function() {
                $(this).parent().parent().find(".order_status").removeClass("active");
                $(this).addClass("active");
                $('#order_status').val($(this).data('status'))
                table.draw();
            });
        })
    </script>
@endsection
