@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.contact-type.update", $contactType->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Contact Type")}} - {{$contactType->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.contact-type.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    translated-input
                    col="12"
                    :model="$contactType"
                    :title="__('Title')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
