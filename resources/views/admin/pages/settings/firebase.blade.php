@extends('admin.layouts.app')


@section("content")
    <form action="{{route("admin.settings.firebase.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Firebase Settings")}}
                </x-card-title>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    required
                    :col="6"
                    :model="$gs"
                    :title="__('FCM Key')"
                    name="fcm_key"
                />
                <x-input-field
                    required
                    :col="6"
                    :model="$gs"
                    :title="__('API Key')"
                    name="firebase_api_key"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('Auth Domain')"
                    name="firebase_auth_domain"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('Database Url')"
                    name="firebase_database_url"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('Project Id')"
                    name="firebase_project_id"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('Storage Bucket')"
                    name="firebase_storage_bucket"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('Messaging Sender Id')"
                    name="firebase_messaging_sender_id"
                />
                <x-input-field
                    required
                    :col="6"
                    class="mt-5"
                    :model="$gs"
                    :title="__('App Id')"
                    name="firebase_app_id"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
