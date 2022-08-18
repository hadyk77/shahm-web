@extends("admin.layouts.app")

@section("breadcrumb")
    <x-bread-crumb
        :routes="[
            route('admin.profile.index')  => __('Profile')
        ]"
    />
@endsection

@section("content")
    <form action="{{route("admin.profile.update")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Update Profile")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <div class="col-md-7 mx-auto text-center">
                    <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: url('{{asset("admin/media/svg/avatars/blank.svg")}}')">
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{Auth::guard(\App\Enums\GuardEnum::ADMIN)->user()->profile_image}}')"></div>
                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="{{__("Change avatar")}}">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                        </label>
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="{{__("Cancel avatar")}}">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="{{__("Remove avatar")}}">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                    </div>
                </div>
                <x-input-field
                    name="name"
                    required
                    class="mt-5"
                    :title="__('Name')"
                    :model="Auth::guard(\App\Enums\GuardEnum::ADMIN)->user()"
                />
                <x-input-field
                    name="email"
                    type="email"
                    required
                    class="mt-5"
                    :title="__('Email')"
                    :model="Auth::guard(\App\Enums\GuardEnum::ADMIN)->user()"
                />
                <x-input-field
                    name="username"
                    required
                    :title="__('Username')"
                    :model="Auth::guard(\App\Enums\GuardEnum::ADMIN)->user()"
                    class="mt-5"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
    <form action="{{route("admin.profile.update.password")}}" method="post" class="mt-5">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Update Password")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="current_password"
                    type="password"
                    required
                    :title="__('Current Password')"
                />
                <x-input-field
                    name="password"
                    type="password"
                    required
                    :title="__('New Password')"
                />
                <x-input-field
                    name="password_confirmation"
                    type="password"
                    required
                    class="mt-5"
                    :title="__('New Password Confirmation')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
