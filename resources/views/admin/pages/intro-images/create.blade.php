@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.intro-image.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Intro Image")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.intro-image.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    translated-input
                    :title="__('Title')"
                />
                <x-summernote-field
                    name="description"
                    required
                    col="12"
                    translated-input
                    :title="__('Description')"
                />
                <x-file-field
                    name="image"
                    required
                    :title="__('Upload Image')"
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
