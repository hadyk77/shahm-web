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
                    required
                    :title="__('User')"
                />
                <x-fields.select-field
                    name="nationality_id"
                    :select-box-data="$nationalities"
                    value-data="title"
                    value="id"
                    required
                    :title="__('Nationality')"
                />
                <x-fields.select-field
                    name="vehicle_type_id"
                    :select-box-data="$vehicleTypeServices"
                    value-data="title"
                    value="id"
                    class="mt-5"
                    :title="__('Vehicle Type')"
                />
                <x-input-field
                    name="identification_number"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Identification Number')"
                />
                <x-input-field
                    name="wallet_number"
                    required
                    col="6"
                    class="mt-5"
                    :title="__('Wallet Number')"
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
                <x-file-field
                    class="mt-5"
                    name="car_picture_from_front"
                    required
                    :title="__('Picture of the car from the front')"
                />
                <x-file-field
                    class="mt-5"
                    name="car_picture_from_back"
                    required
                    :title="__('Picture of the car from the back')"
                />


                <x-file-field
                    class="mt-5"
                    name="identification_from_front"
                    required
                    :title="__('Identification from front')"
                />
                <x-file-field
                    class="mt-5"
                    name="identification_from_back"
                    required
                    :title="__('Identification from back')"
                />


                <x-file-field
                    class="mt-5"
                    name="coronavirus_certificate"
                    required
                    :title="__('Coronavirus Certificate')"
                />
                <x-file-field
                    class="mt-5"
                    name="no_criminal_record_certificate"
                    required
                    :title="__('No Criminal Record Certificate')"
                />

            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
