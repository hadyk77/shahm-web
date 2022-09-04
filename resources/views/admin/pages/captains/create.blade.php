@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.captain.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New captain")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.captain.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-fields.select-field
                    name="user_id"
                    :select-box-data="$users"
                    value-data="name"
                    value="id"
                    :title="__('User')"
                />
                <x-fields.select-field
                    name="vehicle_type_id"
                    :select-box-data="$vehicleTypeServices"
                    value-data="title"
                    value="id"
                    :title="__('Vehicle Type')"
                />
                <x-input-field
                    name="vehicle_manufacturing_date"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle Manufacturing Date')"
                />
                <x-input-field
                    name="vehicle_number"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle Number')"
                />
                <x-input-field
                    name="vehicle_identification_number"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle identification number')"
                />
                <x-input-field
                    name="vehicle_license_plate_number"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle license plate number')"
                />
                <x-file-field
                    class="mt-5"
                    name="license_from_front"
                    required
                    :title="__('Picture of the license from the front')"
                />
                <x-file-field
                    class="mt-5"
                    name="license_from_back"
                    required
                    :title="__('Picture of the license from the back')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
