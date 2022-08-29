@extends('shop.layouts.app')

@section("breadcrumb")
    <x-bread-crumb
        :routes="[
            route('shop.marketing.discount.index') => __('Shop Discounts'),
            route('shop.marketing.discount.edit', $discount->id) => __('Edit Discount') . ' '  . $discount->code
        ]"
    />
@endsection

@section("content")
    <form action="{{route("shop.marketing.discount.update", $discount->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Discount")}} - {{$discount->code}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('shop.marketing.discount.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    required
                    name="code"
                    :model="$discount"
                    :title="__('Code')"
                />
                <x-input-field
                    required
                    :model="$discount"
                    name="start_date"
                    :title="__('Start At')"
                />
                <x-input-field
                    required
                    :model="$discount"
                    class="mt-5"
                    name="end_date"
                    :title="__('End At')"
                />
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="type">{{__("Discount Type")}} <sup>*</sup></label>
                        <select name="type" data-control="select2" class="form-control form-control-lg form-control-solid" required id="type">
                            <option value="" selected disabled>{{__('Choose An Option')}}</option>
                            <option {{old("type") == \App\Enums\DiscountEnum::PERCENTAGE  || $discount->type == \App\Enums\DiscountEnum::PERCENTAGE ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::PERCENTAGE}}">{{__("Percentage")}}</option>
                            <option {{old("type") == \App\Enums\DiscountEnum::AMOUNT  || $discount->type == \App\Enums\DiscountEnum::AMOUNT ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::AMOUNT}}">{{__("Amount")}}</option>
                        </select>
                    </div>
                </div>
                <x-input-field
                    :model="$discount"
                    class="mt-5"
                    name="amount"
                    :title="__('Amount')"
                />
                <x-input-field
                    class="mt-5"
                    :model="$discount"
                    name="percentage"
                    :title="__('Percentage')"
                />
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="quantity">{{__("Quantity")}} <sup>*</sup></label>
                        <select name="quantity" data-control="select2" class="form-control form-control-lg form-control-solid" required id="quantity">
                            <option value="" selected disabled>{{__('Choose An Option')}}</option>
                            <option {{old("quantity") == \App\Enums\DiscountEnum::LIMITED || $discount->quantity == \App\Enums\DiscountEnum::LIMITED ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::LIMITED}}">{{__("Limited")}}</option>
                            <option {{old("quantity") == \App\Enums\DiscountEnum::UNLIMITED || $discount->quantity == \App\Enums\DiscountEnum::UNLIMITED ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::UNLIMITED}}">{{__("Unlimited")}}</option>
                        </select>
                    </div>
                </div>
                <x-input-field
                    class="mt-5"
                    :model="$discount"
                    name="quantity_number"
                    :title="__('Quantity Number')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection

@section("styles")
    <style>
        #amount_parent, #percentage_parent,#quantity_number_parent {
            display: none;
        }
    </style>
@endsection

@section("scripts")
    <script>
        function showAndHideFieldType() {
            if ($(this).val() === "amount") {
                $('#amount').parent().show();
                $('#percentage').parent().hide();
            }
            if ($(this).val() === "percentage") {
                $('#amount').parent().hide();
                $('#percentage').parent().show();
            }
        }
        function showAndHideFieldQuantity() {
            if ($(this).val() === "limited") {
                $('#quantity_number').parent().show();
            } else {
                $('#quantity_number').parent().hide();
            }
        }
        $(function () {
            showAndHideFieldType.call($("#type"));
            $('#type').on('change', function () {showAndHideFieldType.call(this)});
            showAndHideFieldQuantity.call($("#quantity"));
            $('#quantity').on('change', function () {showAndHideFieldQuantity.call(this)});
        });
    </script>
@endsection
