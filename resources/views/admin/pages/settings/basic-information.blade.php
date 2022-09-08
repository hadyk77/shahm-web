@extends('admin.layouts.app')

@section('content')
    <form action="{{route("admin.settings.basic-information.store")}}" method="post">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Basic Information")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    :title="__('Title')"
                    translated-input
                    required
                    :model="$gs"
                    col="12"
                />
                <x-summernote-field
                    name="description"
                    :title="__('Description')"
                    translated-input
                    required
                    :model="$gs"
                    col="12"
                />
                <x-input-field
                    name="first_email"
                    :title="__('First Email')"
                    type="email"
                    required
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="second_email"
                    :title="__('Second Email')"
                    type="email"
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="first_phone"
                    :title="__('First Phone')"
                    type="tel"
                    required
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="second_phone"
                    :title="__('Second Phone')"
                    type="tel"
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="tax"
                    :title="__('Tax')"
                    type="number"
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="maximum_indebtedness_for_captain"
                    :title="__('Maximum Indebtedness For Captain')"
                    type="number"
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="service_price_per_kilometer"
                    :title="__('Service Price Per Kilometer')"
                    type="number"
                    class="mt-5"
                    :model="$gs"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
