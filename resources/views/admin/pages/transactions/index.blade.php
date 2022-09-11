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
                <td>{{__("Transaction Code")}}</td>
                <td>{{__("Transaction type")}}</td>
                <td>{{__("Amount")}}</td>
                <td>{{__("Notes")}}</td>
                <td>{{__("Done By")}}</td>
                <td>{{__("Created At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.transactions.index')"
        :columns="$columns"
    />
@endsection
