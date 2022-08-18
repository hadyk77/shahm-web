<div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') . ' form-group '])}}>
    <label for="{{$name}}" class="d-flex align-items-center fs-5 fw-bold mb-2">
        {{$title}} @if($required == true) <sup>*</sup> @endif
    </label>
    <div class="input-group">
        @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() == "ltr")
            <input type="text"
                   id="{{$name}}"
                   name="{{$name}}"
                   value="{{old($name, $model ? $model->$name : '')}}"
                   class="form-control  form-control-solid @error($name) is-invalid @enderror"
                   @if($required == true)
                       required
                   @endif
                   style="direction: ltr !important;border-top-right-radius: 0;border-bottom-right-radius: 0;"
                   placeholder="{{$title}}"
            >
            <div class="input-group-prepend">
                <span class="input-group-text" style="background: #d63c64; border-color: #d63c64; color: #fff;direction: ltr !important;border-top-left-radius: 0;border-bottom-left-radius: 0;" id="{{$name}}">{{$url}}</span>
            </div>
        @else
            <div class="input-group-prepend">
                <span class="input-group-text" style="background: #d63c64; border-color: #d63c64; color: #fff;direction: ltr !important;border-top-left-radius: 0;border-bottom-left-radius: 0;" id="{{$name}}">{{$url}}</span>
            </div>
            <input type="text"
                   id="{{$name}}"
                   name="{{$name}}"
                   style="direction: rtl !important;border-top-right-radius: 0;border-bottom-right-radius: 0;"
                   value="{{old($name, $model ? $model->$name : '')}}"
                   class="form-control  form-control-solid @error($name) is-invalid @enderror"
                   @if($required == true)
                       required
                   @endif
                   placeholder="{{$title}}"
            >
        @endif
    </div>
</div>
