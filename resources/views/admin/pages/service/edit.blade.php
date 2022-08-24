@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.page.update", $page->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Service")}} - {{$page->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.page.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    :model="$page"
                    translated-input
                    :title="__('Title')"
                />
                <x-summernote-field
                    name="description"
                    required
                    col="12"
                    :model="$page"
                    translated-input
                    :title="__('Description')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
