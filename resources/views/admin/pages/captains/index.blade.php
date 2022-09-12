@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
            <x-card-toolbar>
                <button type="button" class="btn btn-primary btn-sm  me-3" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-start">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="currentColor"/>
                        </svg>
                    </span>
                    {{__("Filter")}}
                </button>
                <form class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                      id="kt-toolbar-filter">
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bolder">{{__("Filter Options")}}</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5">
                        <div class="mb-2">
                            <label for="status" class="form-label fs-5 fw-bold mb-3">{{__("Client Status")}}:</label>
                            <select id="status" name="status" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="{{__("Select option")}}" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                <option></option>
                                <option value="all">{{__("All")}}</option>
                                <option value="active">{{__("Active")}}</option>
                                <option value="inactive">{{__("Inactive")}}</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                    data-kt-customer-table-filter="filter">{{__("Apply")}}</button>
                        </div>
                    </div>
                </form>
                <x-add-btn :route="route('admin.captain.create')"  :title="__('Add New Captain')"/>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Image")}}</td>
                <td>{{__("Name")}}</td>
                <td>{{__("Phone")}}</td>
                <td>{{__("Email")}}</td>
                <td>{{__("Wallet")}}</td>
                <td>{{__("Status")}}</td>
                <td>{{__("Created At")}}</td>
                <td>{{__("Updated At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
    <div class="modal fade" tabindex="-1" id="send_message" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded">
                <form action="" class="send_message_form" method="post">
                    @csrf
                    <div class="modal-header py-3">
                        <h3 class="modal-title" id="send_message_title">
                            {{__('Send Message Box')}}
                        </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"></rect>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <div class="modal-body text-center" id="overlay">
                        <div class="row">
                            <x-input-field
                                name="title"
                                :title="__('Title')"
                                required
                                col="12"
                            />
                            <x-summernote-field
                                name="body"
                                :title="__('Body')"
                                required
                                col="12"
                            />
                        </div>
                        <div id="data"></div>
                    </div>
                    <div class="modal-footer py-3">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <span class="indicator-label">{{__('Send Message')}}</span>
                            <span class="indicator-progress"> {{__("Please wait...")}}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="add_money_to_captain" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded">
                <form action="" class="add_money_to_captain_form" method="post">
                    @csrf
                    <div class="modal-header py-3">
                        <h3 class="modal-title" id="send_message_title">
                            {{__('Add Money to captain wallet')}}
                        </h3>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="currentColor"></rect>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <div class="modal-body text-center" id="overlay">
                        <div class="row">
                            <input type="hidden" name="accountType" value="captain" required>
                            <x-input-field
                                name="amount"
                                type="number"
                                required
                                :title="__('Amount')"
                                col="12"
                            />
                            <x-input-field
                                name="notes"
                                class="mt-5"
                                :title="__('Notes')"
                                col="12"
                            />
                        </div>
                        <div id="data"></div>
                    </div>
                    <div class="modal-footer py-3">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-success font-weight-bold">
                            <span class="indicator-label">{{__('Save')}}</span>
                            <span class="indicator-progress"> {{__("Please wait...")}}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.captain.index', ['status' => request()->status])"
        :columns="$columns"
    />
    <script>
        $('#kt-toolbar-filter').on("submit", function (event) {
            event.preventDefault();
            table.draw();
            hideSpinner($('.form-content'))
        });
    </script>
    <script>
        const sendMessageModal = document.getElementById('send_message')

        sendMessageModal.addEventListener('show.bs.modal', function (e) {
            $("#send_message").find('.send_message_form').attr('action', $(e.relatedTarget).data('url'));
        });

        $('#send_message .send_message_form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let action = form.attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: form.serialize(),
                beforeSend: function () {
                    showSpinner(form)
                },
                success: function success(result) {
                    hideSpinner(form);
                    $('#send_message').modal('hide');
                    $("#datatables").DataTable().ajax.reload();
                    $('#send_message #title').val("");
                    $('#send_message #body').val("");
                    if (result.success) {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function error(response) {
                    $('#send_message').modal('hide');
                    toastr.error(response.responseJSON.message);
                    hideSpinner(form);
                }
            });
        });
    </script>
    <script>
        const add_money_to_captain = document.getElementById('add_money_to_captain')

        add_money_to_captain.addEventListener('show.bs.modal', function (e) {
            $("#add_money_to_captain").find('.add_money_to_captain_form').attr('action', $(e.relatedTarget).data('url'));
        });

        $('#add_money_to_captain .add_money_to_captain_form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let action = form.attr('action');
            $.ajax({
                url: action,
                type: 'POST',
                data: form.serialize(),
                beforeSend: function () {
                    showSpinner(form)
                },
                success: function success(result) {
                    hideSpinner(form);
                    $('#add_money_to_captain').modal('hide');
                    $("#datatables").DataTable().ajax.reload();
                    $('#add_money_to_captain #amount').val("");
                    $('#add_money_to_captain #notes').val("");
                    if (result.success) {
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function error(response) {
                    $('#add_money_to_captain').modal('hide');
                    toastr.error(response.responseJSON.message);
                    hideSpinner(form);
                }
            });
        });
    </script>
@endsection
