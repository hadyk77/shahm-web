@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
            <x-card-toolbar>
                <x-add-btn :route="route('admin.governorate.create')"  :title="__('Add New Governorate')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Title")}}</td>
                <td>{{__("Status")}}</td>
                <td>{{__("Created At")}}</td>
                <td>{{__("Updated At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.governorate.index', ['status' => request()->status])"
        :columns="$columns"
    />
@endsection
