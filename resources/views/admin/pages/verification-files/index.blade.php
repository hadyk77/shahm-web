@extends("admin.layouts.app")

@section("content")
    <x-card-content>
        <x-card-header>
            <x-card-title>
                <x-datatable-search-input />
            </x-card-title>
            <x-card-toolbar>
                <button type="button" class="btn btn-primary btn-sm  me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"/>
                        </svg>
                    </span>
                    {{__("Filter")}}
                </button>
                <form class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bolder">{{__("Filter Options")}}</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5">
                        <div class="mb-2">
                            <label for="captain_id" class="form-label fs-5 fw-bold mb-3">{{__("Captains")}}:</label>
                            <select id="captain_id" name="captain_id" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="{{__("Select option")}}" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                <option></option>
                                <option value="all">{{__("All")}}</option>
                                @foreach($captains as $captain)
                                    <option value="{{$captain->id}}">{{$captain->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="status" class="form-label fs-5 fw-bold mb-3">{{__("Status")}}:</label>
                            <select id="status" name="status" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="{{__("Select option")}}" data-allow-clear="true"  data-dropdown-parent="#kt-toolbar-filter">
                                <option></option>
                                <option value="all">{{__("All")}}</option>
                                <option value="accepted">{{__("Accepted")}}</option>
                                <option value="rejected">{{__("Rejected")}}</option>
                                <option value="not_read">{{__("Not Read File")}}</option>
                                <option value="is_read">{{__("Read File")}}</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">{{__("Apply")}}</button>
                        </div>
                    </div>
                    <div class="separator border-gray-200"></div>
                </form>
            </x-card-toolbar>
        </x-card-header>
        <x-card-body>
            <x-datatable-html>
                <td>{{__("Captain Name")}}</td>
                <td>{{__("Option")}}</td>
                <td>{{__("Status")}}</td>
                <td>{{__("Created At")}}</td>
                <td>{{__("Updated At")}}</td>
            </x-datatable-html>
        </x-card-body>
    </x-card-content>
@endsection

@section("scripts")
    <x-datatable-script
        :route="route('admin.verification-files.index', ['status' => request()->status])"
        :columns="$columns"
    />
    <script>
        $('#kt-toolbar-filter').on("submit", function (event) {
            event.preventDefault();
            table.draw();
            hideSpinner($('.form-content'))
        });
    </script>
@endsection
