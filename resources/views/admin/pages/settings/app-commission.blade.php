@extends('admin.layouts.app')

@section('content')
    <form action="{{route("admin.settings.app-commission.store")}}" method="post">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("App Commission")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="client_commission"
                    :title="__('Client Commission')"
                    type="number"
                    class="mt-5"
                    :model="$gs"
                />
                <x-input-field
                    name="captain_commission"
                    :title="__('Captain Commission')"
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
