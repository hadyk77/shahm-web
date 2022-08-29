<form action="{{route('admin.translation.update')}}" method="post">
    @csrf
    <input type="hidden" name="model" value="{{get_class($model)}}">
    <input type="hidden" name="model_id" value="{{$model->id}}">
    <div class="row">
        @foreach($columns as $key => $value)
            @if($value["type"] == "text")
                @foreach(["ar", "en"] as $locale)
                    <div class="col-md-6 {{!$loop->parent->first ? "mt-5" : ""}}">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="{{$key}}_{{$locale}}">{{__("Title")}} @if($locale == "ar") {{__("In Arabic")}} @else {{__("In English")}} @endif {!! $value["rules"] == "required" ? "<sup>*</sup>" : "" !!}</label>
                        <input type="text" name="{{$key}}[{{$locale}}]" value="{{old($key . '.' . $locale, $model ? $model->getTranslation($key, $locale) : '')}}" {!! $value["rules"] == "required" ? "required" : "" !!} class="form-control form-control-lg form-control-solid" placeholder="{{__("Title")}}" id="{{$key}}[{{$locale}}]"/>
                    </div>
                @endforeach
            @endif
            @if($value["type"] == "textarea")
                @foreach(['ar', "en"] as $locale)
                    <div class="col-md-6 mt-5">
                        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="{{$key}}_{{$locale}}">{{__("Description")}} @if($locale == "ar") {{__("In Arabic")}} @else {{__("In English")}} @endif {!! $value["rules"] == "required" ? "<sup>*</sup>" : "" !!}</label>
                        <textarea name="{{$key}}[{{$locale}}]" rows="5" class="form-control form-control-lg form-control-solid" placeholder="{{__("Description")}}" {!! $value["rules"] == "required" ? "required" : "" !!} id="{{$key}}_{{$locale}}">{{old($key . '.' . $locale, $model ? $model->getTranslation($key, $locale) : '')}}</textarea>
                    </div>
                @endforeach
            @endif
        @endforeach
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success mt-5">
                {{__("Update Translation")}}
            </button>
        </div>
    </div>
</form>
