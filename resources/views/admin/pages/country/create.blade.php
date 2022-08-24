@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.country.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New Country")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.country.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    translated-input
                    :title="__('Country Name')"
                />
                <x-input-field
                    name="country_code"
                    type="number"
                    required
                    :title="__('Country Phone Code')"
                />
                <x-file-field
                    name="flag"
                    required
                    :title="__('Upload Country Flag')"
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
