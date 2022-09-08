@extends('admin.layouts.app')

@section("content")
    <form action="{{route("admin.role.update", $role->id)}}" method="post">
        @csrf
        @method("PUT")
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Role")}} - {{$role->name}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.role.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-translation-input-field
                    required
                    :model="$role"
                    :title="__('Role')"
                    name="title"
                />
                <div class="col-md-12 mt-5">
                    <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="permissions">{{__("Permissions")}} <sup>*</sup></label>
                    <select name="permissions[]" multiple data-control="select2" class="form-control form-control-lg form-control-solid" required id="permissions">
                        @foreach($permissions as $permission)
                            <option
                                {{in_array($permission->name, $role->permissions->pluck('name')->toArray()) ? "selected" : ""}}
                                value="{{$permission->name}}">{{$permission->title}}</option>
                        @endforeach
                    </select>
                </div>
            </x-card-body>
            <x-card-footer>
                <x-save-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
