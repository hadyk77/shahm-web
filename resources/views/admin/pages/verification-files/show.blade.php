@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
            <x-card-toolbar>
                <x-add-btn :route="route('admin.user.create')"  :title="__('Add New User')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>

        </x-card-body>
    </x-card-content>
@endsection

