<button type="submit" {{$attributes->merge(['class'=> 'btn btn-success py-3'])}}>
    <span class="indicator-label">{{__('Update')}}</span>
    <span class="indicator-progress">{{__("Please wait...")}}
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </span>
</button>
