@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.user.update", $user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit user")}} - {{$user->name}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.user.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="name"
                    required
                    col="6"
                    :title="__('Name')"
                    :model="$user"
                />
                <x-input-field
                    name="phone"
                    type="tel"
                    required
                    col="6"
                    :title="__('Phone')"
                    :model="$user"
                />
                <x-input-field
                    name="email"
                    type="email"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Email')"
                    :model="$user"
                />
                <x-input-field
                    name="address"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Address')"
                    :model="$user"
                />
                <x-input-field
                    name="date_of_birth"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Date Of Birth')"
                    :model="$user"
                />
                <div class="col-md-6">
                    <div class="form-group mt-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="gender">{{__("Gender")}}<sup>*</sup></label>
                        <select name="gender" data-control="select2" class="form-control form-control-lg form-control-solid" required id="gender">
                            <option value="" selected disabled>{{__('Choose An Option')}}</option>
                            <option {{old("gender") == "male" || $user->gender == "male" ? "selected" : ""}} value="male">{{__("Male")}}</option>
                            <option {{old("gender") == "female" || $user->gender == "female" ? "selected" : ""}} value="female">{{__("Female")}}</option>
                        </select>
                    </div>
                </div>
                <x-file-field
                    class="mt-5"
                    name="profile_image"
                    :title="__('Profile Image')"
                    :model="$user"
                    :collection="\App\Enums\ProfileImageEnum::PROFILE_IMAGE"
                />
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
