<div class="col-md-6">
    <div class="form-group">
        <label for="{{\Str::snake($name)}}_{{$index}}">{{$title}} @if(isset($required) && $required == true) <sup>*</sup> @endif</label>
        <input
            id="{{\Str::snake($name)}}_{{$index}}"
            type="text"
            value="{{old($name . '.' . $locale, isset($model) ? $model->getTranslation($name, $locale) : null)}}"
            name="{{$name}}[{{$locale}}]"
            class="form-control"
            placeholder="{{$title}}"
            @if(isset($required) && $required == true) required @endif
        />
    </div>
</div>
