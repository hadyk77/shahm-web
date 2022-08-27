@extends('admin.layouts.app')

@section('content')
    <form action="{{route("admin.settings.payment-options.store")}}" method="post">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Payment Details")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <div class="col-md-4">
                    <p>
                        {{__("Enable Credit Card")}}
                    </p>
                    <label class="form-check cursor-pointer form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cursor-pointer w-50px" type="checkbox" value="1" name="is_credit_card_enabled" {!! $gs->is_credit_card_enabled ? 'checked="checked"' : "" !!}>
                    </label>
                </div>
                <div class="col-md-4">
                    <p>
                        {{__("Enable Wallet")}}
                    </p>
                    <label class="form-check cursor-pointer form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cursor-pointer w-50px" type="checkbox" value="1" name="is_wallet_enabled" {!! $gs->is_wallet_enabled ? 'checked="checked"' : "" !!}>
                    </label>
                </div>
                <div class="col-md-4">
                    <p>
                        {{__("Enable Cash")}}
                    </p>
                    <label class="form-check cursor-pointer form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cursor-pointer w-50px" type="checkbox" value="1" name="is_cash_enabled" {!! $gs->is_cash_enabled ? 'checked="checked"' : "" !!}>
                    </label>
                </div>
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
