@extends('admin.layouts.app')

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input/>
            </x-card-title>
            <x-card-toolbar>
                <x-add-btn :title="__('Add Discount')" :route="route('admin.discount.create')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Code")}}</td>
                <td>{{__("Type")}}</td>
                <td>{{__("Start Date")}}</td>
                <td>{{__("End Date")}}</td>
                <td>{{__("Status")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable.script
        :columns="$columns"
        :route="route('admin.discount.index', ['status' => request()->status])"
    />
@endsection
