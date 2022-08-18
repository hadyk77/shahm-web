<div class="form-group">
    <label for="{{\Str::snake($title)}}">{{$title}} @if($required == true) <sup>*</sup> @endif</label>
    <input
        id="{{\Str::snake($title)}}"
        type="number"
        value="{{old(\Str::snake($title), isset($model) ? $model[\Str::snake($title)] : null)}}"
        name="{{\Str::snake($title)}}"
        class="form-control"
        placeholder="{{$title}}"
        @if($required == true) required @endif
    />
</div>
