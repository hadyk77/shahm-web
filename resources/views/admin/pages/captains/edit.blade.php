@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.captain.update", $captain->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit captain")}} - {{$captain->user->name}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.captain.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-fields.select-field
                    name="nationality_id"
                    :select-box-data="$nationalities"
                    value-data="title"
                    value="id"
                    required
                    :model="$captain"
                    :title="__('Nationality')"
                />
                <x-fields.select-field
                    name="vehicle_type_id"
                    :select-box-data="$vehicleTypeServices"
                    value-data="title"
                    value="id"
                    :model="$captain"
                    :title="__('Vehicle Type')"
                />
                <x-input-field
                    name="identification_number"
                    required
                    col="6"
                    class="mt-5"
                    :model="$captain"
                    :title="__('Identification Number')"
                />
                <x-input-field
                    name="wallet_number"
                    required
                    col="6"
                    :model="$captain"
                    class="mt-5"
                    :title="__('Wallet Number')"
                />
                <x-input-field
                    name="vehicle_manufacturing_date"
                    required
                    class="mt-5"
                    col="6"
                    :model="$captain"
                    :title="__('Vehicle Manufacturing Date')"
                />
                <x-input-field
                    name="vehicle_number"
                    required
                    :model="$captain"
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle Number')"
                />
                <x-input-field
                    name="vehicle_identification_number"
                    required
                    :model="$captain"
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle identification number')"
                />
                <x-input-field
                    name="vehicle_license_plate_number"
                    required
                    :model="$captain"
                    col="6"
                    class="mt-5"
                    :title="__('Vehicle license plate number')"
                />
                <x-file-field
                    class="mt-5"
                    name="license_from_front"
                    :model="$captain"
                    :collection="\App\Enums\CaptainEnum::LICENSE_PICTURE_FROM_FRONT"
                    :title="__('Picture of the license from the front')"
                />
                <x-file-field
                    class="mt-5"
                    name="license_from_back"
                    :model="$captain"
                    :collection="\App\Enums\CaptainEnum::LICENSE_PICTURE_FROM_BACK"
                    :title="__('Picture of the license from the back')"
                />
                <x-file-field
                    class="mt-5"
                    name="car_picture_from_front"
                    :model="$captain"
                    :collection="\App\Enums\CaptainEnum::CAR_PICTURE_FROM_FRONT"
                    :title="__('Picture of the car from the front')"
                />
                <x-file-field
                    class="mt-5"
                    name="car_picture_from_back"
                    :model="$captain"
                    :collection="\App\Enums\CaptainEnum::CAR_PICTURE_FROM_BACK"
                    :title="__('Picture of the car from the back')"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
