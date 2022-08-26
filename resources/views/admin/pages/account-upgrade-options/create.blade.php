@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.upgrade-options.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Option")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.upgrade-options.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    translated-input
                    :title="__('Title')"
                />
                <x-input-field
                    name="completed_orders_count"
                    type="number"
                    required
                    :title="__('Completed Order Count')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
