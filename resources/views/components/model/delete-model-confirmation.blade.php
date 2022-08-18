<div class="modal fade" tabindex="-1" id="delete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <form action="" class="delete_form" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header py-3">
                    <h3 class="modal-title" id="exampleModalLabel">
                        {{__('Delete Confirmation')}}
                    </h3>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body text-center" id="overlay">
                    <h4 class="text-danger mb-4">
                        {{__('You are about to delete this record. Everything under this record will be deleted.')}}
                    </h4>
                    <h4 class="text-danger">
                        {{__('Do you want to continue?')}}
                    </h4>
                    <div id="data"></div>
                </div>
                <div class="modal-footer py-3">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger font-weight-bold">
                        <span class="indicator-label">{{__('Delete')}}</span>
                        <span class="indicator-progress"> {{__("Please wait...")}}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
