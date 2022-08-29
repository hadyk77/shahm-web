@extends('admin.layouts.app')

@section('content')
    <form action="{{route("admin.settings.default-images.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Default Images")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-file-field
                    name="profile_image"
                    :model="$gs"
                    :title="__('Default Profile Image')"
                    :collection="\App\Enums\GeneralSettingEnum::DEFAULT_PROFILE_IMAGE"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
