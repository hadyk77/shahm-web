<div {{$attributes->merge(['style' => '', 'class' => 'col-md-' . ($col ?? '6') .' form-group'])}}>
    <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="{{$name}}">{{__($title)}} {!! $required ? '<sup>*</sup>' : '' !!}</label>
    <select name="{{$name}}" data-control="select2" class="form-control form-control-lg form-control-solid" {{$required ? 'required' : ''}} id="{{$name}}">
        <option value="" selected disabled>{{__('Choose An Option')}}</option>
        @foreach($selectBoxData as $singleData)
            <option
                @if(old($name))
                    {{old($name) == $singleData->$value ? 'selected' : ''}}
                @elseif($model != null)
                    @if($secondName != null)
                        {{$model->$secondName == $singleData->$value ? 'selected' : ''}}
                    @else
                        {{$model->$name == $singleData->$value ? 'selected' : ''}}
                    @endif
                @endif
                value="{{$singleData->$value}}">{{$singleData->$valueData}}</option>
        @endforeach
    </select>
</div>
