@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.nationality.update", $nationality->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Nationality")}} - {{$nationality->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.nationality.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    :model="$nationality"
                    translated-input
                    :title="__('Title')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
