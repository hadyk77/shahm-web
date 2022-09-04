@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Captain Name")}}</td>
                <td>{{__("Option")}}</td>
                <td>{{__("Status")}}</td>
                <td>{{__("Created At")}}</td>
                <td>{{__("Updated At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.verification-files.index', ['status' => request()->status])"
        :columns="$columns"
    />
@endsection
