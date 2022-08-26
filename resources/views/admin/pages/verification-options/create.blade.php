@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.verification-options.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Option")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.verification-options.index')" />
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
                    name="icon"
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
