@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.upgrade-options.update", $option->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Option")}} - {{$option->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.upgrade-options.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    :model="$option"
                    translated-input
                    :title="__('Title')"
                />
                <x-input-field
                    name="completed_orders_count"
                    type="number"
                    required
                    :model="$option"
                    :title="__('Completed Order Count')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
