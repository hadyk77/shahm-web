@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.banner.update", $banner->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Banner")}} - {{$banner->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.banner.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    :model="$banner"
                    translated-input
                    :title="__('Banner Title')"
                />
                <x-input-field
                    name="order"
                    type="number"
                    required
                    :model="$banner"
                    :title="__('Banner Order')"
                />
                <x-file-field
                    name="image"
                    :model="$banner"
                    :collection="\App\Enums\BannerEnum::BannerImage"
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
