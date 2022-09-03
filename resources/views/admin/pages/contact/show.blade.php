@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                {{__("Show Contact Message From")}} {{$contact->user->name}}
            </x-card-title>
            <x-card-toolbar>
                <x-back-btn :route="route('admin.contact.index')" />
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <table class="table table-striped table-bordered text-center">
                <tr>
                    <td>{{__("Name")}}</td>
                    <td>{{$contact->user->name}}</td>
                </tr>
                <tr>
                    <td>{{__("Email")}}</td>
                    <td>{{$contact->user->email}}</td>
                </tr>
                <tr>
                    <td>{{__("Phone")}}</td>
                    <td>{{$contact->user->phone}}</td>
                </tr>
                <tr>
                    <td>{{__("Role")}}</td>
                    <td>{{$contact->user->is_captain ? __("Captain") : __("Client")}}</td>
                </tr>
                <tr>
                    <td>{{__("Contact Type")}}</td>
                    <td>{{$contact->contactType->title}}</td>
                </tr>
                <tr>
                    <td>{{__("Message")}}</td>
                    <td>{{$contact->message}}</td>
                </tr>
            </table>
        </x-card-body>
    </x-card-content>
@endsection
