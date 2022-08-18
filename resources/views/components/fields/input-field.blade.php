@if($translatedInput)
    @foreach(["ar"] as $key)
        <div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') . ' form-group '])}}>
            <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="{{$name}}[{{$key}}]">{{$title}} {!!  $required ? '<sup>*</sup>' : '' !!}</label>
            <input type="{{(isset($type) && $type == "color") ? 'text' : $type}}" name="{{$name}}[{{$key}}]" value="{{old($name . '.' . $key, $model ? $model->getTranslation(Str::remove("[]", $name), "ar") : '')}}" class="form-control form-control-lg @if($type == "color")  colors @endif form-control-solid @error($name) is-invalid @enderror" placeholder="{{$title}}" {{$required ? "required" : ""}} id="{{$name}}[{{$key}}]"/>
            @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if(isset($hint))
                <div class="text-muted fs-7 mt-1">{{$hint}}</div>
            @endif
        </div>
    @endforeach
@else
    <div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') . ' form-group ', 'id' => $name . '_parent'])}}>
        <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="{{$name}}">{{$title}} {!!  $required ? '<sup>*</sup>' : '' !!}</label>
        <input type="{{(isset($type) && $type == "color") ? 'text' : $type}}" name="{{$name}}" id="{{$name}}"
               @if(isset($type) && $type == "number")
                    step="any"
                    min="0"
               @endif
               @if(isset($type) && $type == "color")
                   readonly
               @endif
               @if(isset($value))
                   value="{{$value}}"
                   @if($type == "color")
                       data-defaultValue="{{$value}}"
                   @endif
               @else
                   value="{{old($name, $model ? $model->$name : '')}}"
                   @if($type == "color")
                       data-defaultValue="{{old($name, $model ? $model->$name : '')}}"
                   @endif
               @endif
               class="form-control @if($type == "color")  colors @endif @if(isset($type) && $type == "color") minicolors-input @endif form-control-lg form-control-solid @error($name) is-invalid @enderror" placeholder="{{$title}}" {{$required ? 'required' : ''}} />
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
