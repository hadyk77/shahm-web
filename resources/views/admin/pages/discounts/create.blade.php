@extends("admin.layouts.app")

@section("content")
    <form action="{{route('admin.discount.store')}}" method="post">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Discounts")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.discount.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <div class="row">
                    <x-input-field
                        required
                        name="code"
                        :title="__('Code')"
                    />
                    <x-input-field
                        required
                        name="start_date"
                        :title="__('Start At')"
                    />
                    <x-input-field
                        required
                        class="mt-5"
                        name="end_date"
                        :title="__('End At')"
                    />
                    <div class="col-md-6">
                        <div class="form-group mt-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="type">{{__("Discount Type")}}<sup>*</sup></label>
                            <select name="type" data-control="select2" class="form-control form-control-lg form-control-solid" required id="type">
                                <option value="" selected disabled>{{__('Choose An Option')}}</option>
                                <option {{old("type") == \App\Enums\DiscountEnum::PERCENTAGE ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::PERCENTAGE}}">{{__("Percentage")}}</option>
                                <option {{old("type") == \App\Enums\DiscountEnum::AMOUNT ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::AMOUNT}}">{{__("Amount")}}</option>
                            </select>
                        </div>
                    </div>
                    <x-input-field
                        class="mt-5"
                        name="amount"
                        :title="__('Amount')"
                    />
                    <x-input-field
                        class="mt-5"
                        name="percentage"
                        :title="__('Percentage')"
                    />
                    <div class="col-md-6">
                        <div class="form-group mt-5">
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="quantity">{{__("Quantity")}}<sup>*</sup></label>
                            <select name="quantity" data-control="select2" class="form-control form-control-lg form-control-solid" required id="quantity">
                                <option value="" selected disabled>{{__('Choose An Option')}}</option>
                                <option {{old("quantity") == \App\Enums\DiscountEnum::LIMITED ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::LIMITED}}">{{__("Limited")}}</option>
                                <option {{old("quantity") == \App\Enums\DiscountEnum::UNLIMITED ? "selected" : ""}} value="{{\App\Enums\DiscountEnum::UNLIMITED}}">{{__("Unlimited")}}</option>
                            </select>
                        </div>
                    </div>
                    <x-input-field
                        class="mt-5"
                        name="quantity_number"
                        :title="__('Quantity Number')"
                    />
                </div>
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection

@section("styles")
    <style>
        #amount_parent, #percentage_parent, #quantity_number_parent {
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
            $('#type').on('change', function () {
                showAndHideFieldType.call(this)
            });
            showAndHideFieldQuantity.call($("#quantity"));
            $('#quantity').on('change', function () {
                showAndHideFieldQuantity.call(this)
            });
        });
    </script>
@endsection
