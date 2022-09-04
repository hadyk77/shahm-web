@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.user.store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Add New User")}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.user.index')" />
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="name"
                    required
                    col="6"
                    :title="__('Name')"
                />
                <x-input-field
                    name="phone"
                    type="tel"
                    required
                    col="6"
                    :title="__('Phone')"
                />
                <x-input-field
                    name="email"
                    type="email"
                    required
                    class="mt-5"
                    col="6"
                    :title="__('Email')"
                />
                <x-input-field
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
                            <option {{old("gender") == "male" ? "selected" : ""}} value="male">{{__("Male")}}</option>
                            <option {{old("gender") == "female" ? "selected" : ""}} value="female">{{__("Female")}}</option>
                        </select>
                    </div>
                </div>
            </x-card-body>
            <x-card-footer>
                <x-save-btn />
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
