@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.contact-type.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Contact Type")}}
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
                    :title="__('Title')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
