@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.expected-price-range.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Expected Price Range")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.expected-price-range.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="kilometer_from"
                    required
                    type="number"
                    col="6"
                    :title="__('From Kilometer')"
                />
                <x-input-field
                    name="kilometer_to"
                    required
                    type="number"
                    col="6"
                    :title="__('To Kilometer')"
                />
                <x-input-field
                    class="mt-5"
                    name="price_from"
                    required
                    type="number"
                    col="6"
                    :title="__('Price From')"
                />
                <x-input-field
                    class="mt-5"
                    name="price_to"
                    required
                    type="number"
                    col="6"
                    :title="__('Price To')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
