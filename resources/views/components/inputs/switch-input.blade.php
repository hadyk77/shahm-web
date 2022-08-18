<div class="card-body card m-4" style="padding: 1rem 2.25rem;">
    <div class="row">
        <label class="col-6 col-form-label">{{$title ?? __('Status')}}</label>
        <div class="col-6">
        <span class="switch switch-lg switch-icon">
            <label>
                <input type="checkbox"
                       id="{{$name}}"
                       name="{{$name ?? 'status'}}" {{old($name ?? 'status') == true ? 'checked' : ''}} {{isset($value) && $value == true ? 'checked' : ''}}/>
                <span></span>
            </label>
        </span>
        </div>
    </div>
</div>
