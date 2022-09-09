@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.verification-options.update", $option->id)}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Option")}} - {{$option->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.verification-options.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    :model="$option"
                    translated-input
                    :title="__('Title')"
                />
                <x-summernote-field
                    name="description"
                    required
                    col="12"
                    :model="$option"
                    translated-input
                    :title="__('Description')"
                />
                <div class="mt-5 col-md-6">
                    <label class="d-flex align-items-center fs-5 fw-bold mb-2"
                           for="related_orders">{{__("Related Orders")}} <sup>*</sup></label>
                    <select name="related_orders" data-control="select2"
                            class="form-control form-control-lg form-control-solid" required id="related_orders">
                        <option value="" selected disabled>{{__('Choose An Option')}}</option>
                        @foreach(\App\Enums\VerificationOptionEnum::relatedOrders() as $orderTypeKey => $orderTypeValue)
                            <option
                                {{$option->related_orders == $orderTypeKey ? "selected" : ""}} value="{{$orderTypeKey}}">{{$orderTypeValue}}</option>
                        @endforeach
                    </select>
                </div>
                <x-file-field
                    name="icon"
                    :model="$option"
                    :collection="\App\Enums\VerificationOptionEnum::ICON"
                    col="6"
                    class="mt-5"
                />
                <x-file-field
                    name="active_icon"
                    required
                    :model="$option"
                    :collection="\App\Enums\VerificationOptionEnum::ICON_ACTIVE"
                    :title="__('Active Icon')"
                    col="6"
                    class="mt-5"
                />
                <x-input-field
                    name="purchase_link"
                    col="6"
                    type="url"
                    :model="$option"
                    class="mt-5"
                    :title="__('Purchase Link')"
                />
                <x-input-field
                    name="sale_link"
                    class="mt-5"
                    col="6"
                    type="url"
                    :model="$option"
                    :title="__('Sale Link')"
                />
            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection
