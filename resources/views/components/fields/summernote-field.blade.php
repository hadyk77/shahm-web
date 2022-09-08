@if($translatedInput)
    @foreach(['ar'] as $key)
        <div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') . ' form-group mt-5'])}}>
            <label class="d-flex align-items-center fs-6 mb-2" for="{{$name}}[{{$key}}]">{{$title}}  {!! $required ? '<sup>*</sup>' : '' !!}</label>
            <textarea name="{{$name}}[{{$key}}]" rows="5" class="form-control form-control-lg form-control-solid @error($name) is-invalid @enderror" placeholder="{{$title}}"  {{$required && $key == "ar" ? 'required' : ''}} id="{{$name}}[{{$key}}]">{{old($name . '.' . $key, $model ? $model->getTranslation(Str::remove("[]", $name), "ar") : '')}}</textarea>
            @error($name . '.' . $key)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach
    @else
    <div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') . ' form-group mt-5', 'id' => $name . '_parent'])}}>
        <label class="d-flex align-items-center fs-6 mb-2" for="{{$name}}">{{$title}} {!!  $required ? '<sup>*</sup>' : '' !!}</label>
        <textarea name="{{$name}}" rows="5" class="form-control form-control-lg form-control-solid @error($name) is-invalid @enderror" placeholder="{{$title}}" {{$required ? 'required' : ''}} id="{{$name}}">{{old($name, $model ? $model->$name : '')}}</textarea>
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        @if(isset($hint))
            <div class="text-muted fs-7 mt-1">{{$hint}}</div>
        @endif
    </div>
@endif
