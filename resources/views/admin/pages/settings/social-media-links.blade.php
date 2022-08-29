@extends('admin.layouts.app')

@section('content')
    <form action="{{route("admin.settings.social-media.store")}}" method="post">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Social Media Links")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    type="url"
                    name="facebook_link"
                    :title="__('Facebook Url')"
                    :model="$gs"
                />
                <x-input-field
                    type="url"
                    name="twitter_link"
                    :title="__('Twitter Url')"
                    :model="$gs"
                />
                <x-input-field
                    class="mt-5"
                    type="url"
                    name="instagram_link"
                    :title="__('Instagram Url')"
                    :model="$gs"
                />
                <x-input-field
                    class="mt-5"
                    type="url"
                    name="linkedin_link"
                    :title="__('Linkedin Url')"
                    :model="$gs"
                />
                <x-input-field
                    class="mt-5"
                    type="url"
                    name="snapchat_link"
                    :title="__('Snapchat Url')"
                    :model="$gs"
                />
                <x-input-field
                    class="mt-5"
                    type="url"
                    name="tiktok_link"
                    :title="__('Tiktok Url')"
                    :model="$gs"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
