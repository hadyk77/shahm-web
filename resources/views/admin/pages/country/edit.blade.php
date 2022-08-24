@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.country.update", $country->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Country")}} - {{$country->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.country.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    translated-input
                    :model="$country"
                    :title="__('Country Name')"
                />
                <x-input-field
                    name="country_code"
                    type="string"
                    required
                    :model="$country"
                    :title="__('Country Phone Code')"
                />
                <x-file-field
                    name="flag"
                    :title="__('Upload Country Flag')"
                    col="12"
                    :model="$country"
                    :collection="\App\Enums\CountryEnum::FLAG"
                    class="mt-5"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
