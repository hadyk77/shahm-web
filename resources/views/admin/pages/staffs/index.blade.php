@extends('admin.layouts.app')

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input/>
            </x-card-title>
            <x-card-toolbar>
                <x-add-btn :title="__('Add Staff')" :route="route('admin.staff.create')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Profile Image")}}</td>
                <td>{{__("Name")}}</td>
                <td>{{__("Status")}}</td>
                <td>{{__("Created At")}}</td>
                <td>{{__("Updated At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable.script
        :columns="$columns"
        :route="route('admin.staff.index')"
    />
@endsection
