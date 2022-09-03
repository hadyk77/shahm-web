@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.banner.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Banner")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.banner.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    translated-input
                    :title="__('Banner Title')"
                />
                <x-input-field
                    name="order"
                    type="number"
                    required
                    :title="__('Banner Order')"
                />
                <x-file-field
                    name="image"
                    required
                    col="12"
                    class="mt-5"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
