<div {{$attributes->merge(['class' => 'col-md-' . ($col ?? '6') . ' form-group ', 'style' => ''])}}>
    <label class="d-flex align-items-center fs-5 fw-bold mb-2" for="image">
        <span>{{$title ?? __('Upload New Image')}} @if($required == true) <sup>*</sup> @endif</span>
        @if(isset($model) && $model->hasMedia($collection))
            <sup>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#show_model_{{$collection}}">
                <span class="svg-icon svg-icon-primary svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor" opacity="0.3"/>
                        </g>
                    </svg>
                </span>
                </a>
            </sup>
        @endif
    </label>
    <div class="custom-file">
        <input type="file"
               @if($multi == true)
               name="{{$name . '[]' ?? 'image[]'}}"
               @else
               name="{{$name ?? 'image'}}"
               @endif
               class="form-control form-control-lg form-control-solid custom-file-input" id="{{$name ?? 'image'}}" @if($multi == true) multiple
               @endif @if($required == true) required @endif>
    </div>
</div>

@if(isset($model) && $model->hasMedia($collection))
    <div class="modal fade" id="show_model_{{$collection}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Show Files')}}</h5>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if($model->hasMedia($collection))
                            @foreach($model->getMedia($collection) as $file)
                                @if(in_array($file->mime_type, \App\Models\Media::$IMAGES_MIMES_TYPES))
                                    <div class="col-md-4 text-center">
                                        <img src="{{$file->getUrl()}}" alt="{{$collection}}" class="img-fluid d-block mb-4">
                                    </div>
                                @endif
                                @if(in_array($file->mime_type, \App\Models\Media::$VIDEO_MIME_TYPES))
                                    <div class="col-md-4">
                                        <video width="100%" controls>
                                            <source src="{{$file->getUrl()}}" type="{{$file->mime_type}}">
                                        </video>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer py-3">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endif
