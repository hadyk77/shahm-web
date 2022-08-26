@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.governorate.update", $governorate->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Governorate")}} - {{$governorate->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.governorate.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    :model="$governorate"
                    translated-input
                    :title="__('Name')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
