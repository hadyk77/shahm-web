@extends("admin.layouts.app")

@section("content")
    <form action="{{route("admin.service.update", $service->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-card-content>
            <x-card-header>
                <x-card-title>
                    {{__("Edit Service")}} - {{$service->title}}
                </x-card-title>
                <x-card-toolbar>
                    <x-back-btn :route="route('admin.service.index')"/>
                </x-card-toolbar>
            </x-card-header>
            <x-card-body>
                <x-input-field
                    name="title"
                    required
                    col="12"
                    :model="$service"
                    translated-input
                    :title="__('Title')"
                />
                <x-summernote-field
                    name="description"
                    required
                    col="12"
                    :model="$service"
                    translated-input
                    :title="__('Description')"
                />
                <x-file-field
                    class="mt-5"
                    col="12"
                    name="icon"
                    :model="$service"
                    :collection="\App\Enums\ServiceEnum::ICON"
                    :title="__('Upload Service Icon')"
                />

                <h2 class="my-10">{{__("How to use service")}}</h2>

                <div id="service_usage_data">
                    @foreach($service->serviceUsages as $usage)
                        <div class="row">
                            <input type="hidden" name="service_usage[{{$loop->index}}][id]" value="{{$usage->id}}">
                            <div class="col-md-6">
                                <x-input-field
                                    col="12"
                                    type="text"
                                    :value="$usage->getTranslation('title', 'ar')"
                                    name="service_usage[{{$loop->index}}][title][ar]"
                                    required
                                    :title="__('Title')"
                                />
                            </div>
                            <div class="col-md-6">
                                <x-input-field
                                    col="12"
                                    type="text"
                                    name="service_usage[{{$loop->index}}][description][ar]"
                                    required
                                    :value="$usage->getTranslation('description', 'ar')"
                                    :title="__('Description')"
                                />
                            </div>
                            <div class="col-md-6">
                                <x-file-field
                                    class="mt-5"
                                    name="service_usage[{{$loop->index}}][icon]"
                                    col="12"
                                />
                            </div>
                            <div class="col-md-6 mt-14">
                                <div class="d-flex justify-content-between align-content-center align-items-center">
                                    <div class="icon">
                                        <img src="{{$usage->icon}}" style="width: 30px;height: 30px;" alt="">
                                    </div>
                                    <a href="javascript:;" class="btn btn-danger removeUsage">
                                        <i class="bi bi-trash fs-4 mt-1" style="padding:0;margin: 0;"></i>
                                    </a>
                                </div>
                            </div>
                            @if(! $loop->last)
                                <hr class='my-5'/>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="col-md-12 mt-5">
                    <a href="javascript:;" id="add_new_usage" class="btn btn-success">{{__("Add New Usage")}}</a>
                </div>

            </x-card-body>
            <x-card-footer>
                <x-update-btn/>
            </x-card-footer>
        </x-card-content>
    </form>
@endsection

@section("scripts")
    <script>
        $(function () {

            let i = parseInt("{{$service->serviceUsages()->count()}}")

            function template(i) {
                return `
                    <hr class='my-5' />
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div style="" class="col-md-12 form-group" id="service_usage[title][]_parent">
                                <label class="d-flex align-items-center fs-6  mb-2" for="service_usage_title_${i}">Title <sup>*</sup></label>
                                <input type="text" name="service_usage[${i}][title][ar]" id="service_usage_title_${i}" value="" class="form-control  form-control-lg form-control-solid " placeholder="{{__("Title")}}" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="" class="col-md-12 form-group">
                                <label class="d-flex align-items-center fs-6  mb-2" for="service_usage_description_${i}">Description <sup>*</sup></label>
                                <input type="text" name="service_usage[${i}][description][ar]" id="service_usage_description_${i}" class="form-control  form-control-lg form-control-solid " placeholder="{{__("Description")}}" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 mt-5 form-group" style="">
                                <label class="d-flex align-items-center fs-5 mb-2" for="image_${i}">
                                    <span>{{__("Upload New Image")}} <sup>*</sup></span>
                                 </label>
                                <div class="custom-file">
                                    <input type="file" name="service_usage[${i}][icon]" required class="form-control form-control-lg form-control-solid custom-file-input" id="image_${i}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-14">
                            <div class="d-flex justify-content-between align-content-center align-items-center">
                                <div class="icon">

                                </div>
                                <a href="javascript:;" class="btn btn-danger removeUsage">
                                    <i class="bi bi-trash fs-4 mt-1" style="padding:0;margin: 0;"></i>
                                </a>
                            </div>
                        </div>
                    </div>`;
            };

            $('#add_new_usage').on('click', function () {
                $('#service_usage_data').append(template(i));
                i++;
            });

            $(document).on('click', '.removeUsage', function () {
                $(this).parent().parent().parent().remove();
            });


        });
    </script>
@endsection
