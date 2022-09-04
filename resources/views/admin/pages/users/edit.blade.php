@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.user.update", $user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit User")}} - {{$user->name}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.user.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="name"
                    required
                    :model="$user"
                    col="6"
                    :title="__('Name')"
                />
                <x-input-field
                    name="phone"
                    type="tel"
                    :model="$user"
                    required
                    col="6"
                    :title="__('Phone')"
                />
                <x-input-field
                    name="email"
                    :model="$user"
                    type="email"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Email')"
                />
                <x-input-field
                    :model="$user"
                    name="date_of_birth"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Date Of Birth')"
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
                    :model="$user"
                    :collection="\App\Enums\ProfileImageEnum::PROFILE_IMAGE"
                    name="profile_image"
                    :title="__('Profile Image')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() == "ar")
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/l10n/ar.min.js"></script>
    @endif
    <script>
        $(function () {
            $('#date_of_birth').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() == "ar")
                locale: "ar"
                @endif
            })
        });
    </script>
@endsection
