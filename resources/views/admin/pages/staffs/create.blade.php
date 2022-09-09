@extends('admin.layouts.app')

@section("content")
    <form action="{{route("admin.staff.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Staff")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.staff.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    required
                    :title="__('Name')"
                    name="name"
                />
                <x-input-field
                    required
                    :title="__('Username')"
                    name="username"
                />
                <x-input-field
                    required
                    class="mt-5"
                    type="email"
                    :title="__('Email')"
                    name="email"
                />
                <x-fields.select-field
                    :title="__('Permission')"
                    required
                    name="role"
                    class="mt-5"
                    :selectBoxData="$roles"
                    value="name"
                    valueData="title"
                />
                <x-input-field
                    required
                    class="mt-5"
                    type="password"
                    :title="__('Password')"
                    name="password"
                />
                <x-input-field
                    required
                    class="mt-5"
                    type="password"
                    :title="__('Password Confirmation')"
                    name="password_confirmation"
                />
                <x-file-field
                    name="user_profile_image"
                    class="mt-5"
                    :title="__('Profile Image')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
