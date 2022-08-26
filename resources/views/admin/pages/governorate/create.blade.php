@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.governorate.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Governorate")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.governorate.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    translated-input
                    :title="__('Name')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
