<button type="submit" {{$attributes->merge(['class' => 'btn btn-primary py-3'])}} id="saveBtn">
    <span class="indicator-label">{{__('Save Record')}}</span>
    <span class="indicator-progress">{{__("Please wait...")}}
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
