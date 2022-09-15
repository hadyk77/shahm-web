@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                {{__("Transaction Search Box")}}
            </x-card-title>
        </x-card-header>
        <x-card-body>
            <x-fields.select-field
                name="captain_id"
                col="4"
                :select-box-data="$captains"
                value="id"
                value-data="name"
                required
                :title="__('Captains')"
            />
            <x-fields.select-field
                name="client_id"
                col="4"
                :select-box-data="$clients"
                value="id"
                value-data="name"
                required
                :title="__('Clients')"
            />
            <x-input-field
                col="4"
                name="transcation_code"
                :title="__('Transaction Code')"
            />
            <div class="col-md-4 mt-5">
                <label for="date_range" class="form-label fs-5 fw-bold mb-3">{{__("Date")}}:</label>
                <input class="form-control form-control-lg form-control-solid" placeholder="{{__("Pick date range")}}"  name="date_range" id="date_range"/>
            </div>
        </x-card-body>
        <x-card-footer>
            <button type="submit" class="btn btn-primary py-3" id="searchBtn">
                <span class="indicator-label">{{__('Search')}}</span>
                <span class="indicator-progress">{{__("Please wait...")}}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </x-card-footer>
    </x-card-content>
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Transaction Code")}}</td>
                <td>{{__("Transaction type")}}</td>
                <td>{{__("Amount")}}</td>
                <td>{{__("Notes")}}</td>
                <td>{{__("Done By")}}</td>
                <td>{{__("Created At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
    <div class="modal fade" tabindex="-1" id="transactionModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header py-3">
                    <h3 class="modal-title" id="send_message_title">
                        {{__('Transaction Details')}}
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
                <div class="modal-body"></div>
                <div class="modal-footer py-3">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.transactions.index')"
        :columns="$columns"
    />
    <script>
        $("#date_range").daterangepicker({
            autoUpdateInput: false,
            rtl: true,
            locale: {
                format: 'DD-MM-YYYY',
                cancelLabel: 'Clear'
            },
        }, function (start, end) {
            $("#date_range").attr("value",start.format("DD-MM-YYYY") + " / " + end.format("DD-MM-YYYY"));
        });
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        $('#searchBtn').on('click', function () {
            table.draw();
        });
    </script>
    <script>
        $(function () {

            $(document).on('click', '.transactionModal', function() {
                let url = $(this).data('url');
                $.get(url).then(response => {
                    $('#transactionModal').find('.modal-body').html(response.data.html);
                    let transactionModal = new bootstrap.Modal(document.getElementById('transactionModal'), {keyboard: false});
                    transactionModal.show();
                })
            });
        })
    </script>
@endsection
