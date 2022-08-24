@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.intro-image.update", $introImage->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Intro Image")}} - {{$introImage->title}}
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
                    :model="$introImage"
                    translated-input
                    :title="__('Title')"
                />
                <x-summernote-field
                    name="description"
                    required
                    col="12"
                    :model="$introImage"
                    translated-input
                    :title="__('Description')"
                />
                <x-file-field
                    name="image"
                    :model="$introImage"
                    :collection="\App\Enums\IntroImagesEnum::IMAGE"
                    :title="__('Upload Image')"
                    col="12"
                    class="mt-5"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
