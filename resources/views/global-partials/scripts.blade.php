<x-model.delete-model-confirmation/>
<script src="{{asset("admin/plugins/global/plugins.bundle.js")}}"></script>
<script src="{{asset("admin/js/scripts.bundle.js")}}"></script>
@auth()
    <script src="{{asset("admin/plugins/custom/datatables/datatables.bundle.js")}}"></script>
@endauth
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
@include('global-partials.flashes')
<script>
    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        "Accept": "application/json",
        "Content-Type": "application/json",
    };
</script>
<script>
    function showSpinner(el) {
        el.find('#overlay').addClass("overlay overlay-block");
        el.find('#data').html('<div class="overlay-layer bg-dark-o-10"><div class="spinner-border"></div></div>');
        el.find('button[type="submit"]').attr('data-kt-indicator', 'on');
    }

    function hideSpinner(el) {
        el.find('#overlay').removeClass("overlay overlay-block");
        el.find('#data').html('');
        el.find('button[type="submit"]').attr('data-kt-indicator', 'off');
    }

    let table;

    $(function () {

        @auth()
        $('.logoutBtn').on('click', function () {
            let url = $(this).data('url');
            axios.post(url).then(response => {
                if (response.status === 204) {
                    toastr.success("{{__("You logout Successfully")}}");
                    window.location.reload();
                }
            }).catch(error => {
                console.log(error)
            });
        });
        $('form').on('submit', function (e) {
            let submitButton = $(this).find('button');
            $(this).find('#overlay').addClass("overlay overlay-block");
            $(this).find('#data').html('<div class="overlay-layer bg-dark-o-10"><div class="spinner-border"></div></div>');
            submitButton.attr('data-kt-indicator', 'on');
            submitButton.disabled = true;
        });


        $(function () {

            table = $('#datatables').DataTable({
                ordering: true,
                processing: true,
                serverSide: true,
                responsive: true,
                searchDelay: 1000,
                @if(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() == "ar")
                language: {
                    url: "{{asset("admin/js/datatables-ar.json")}}"
                }
                @endif
            });

            $('#datatable_search_input').keyup(function () {
                table.search($(this).val()).draw();
            });

            const DeleteModel = document.getElementById('delete')

            DeleteModel.addEventListener('show.bs.modal', function (e) {
                $("#delete").find('.delete_form').attr('action', $(e.relatedTarget).data('href'));
            });

            $('#delete .delete_form').submit(function (e) {
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
                        $('#delete').modal('hide');
                        $("#datatables").DataTable().ajax.reload();
                        if (result.success) {
                            toastr.success(result.message);
                        } else {
                            toastr.error(result.message);
                        }
                        if (result.data.hasOwnProperty("redirect_to") && result.data.redirect_to != "") {
                            window.location.href = result.data.redirect_to;
                        }
                    },
                    error: function error(response) {
                        $('#delete').modal('hide');
                        toastr.error(response.responseJSON.message);
                        hideSpinner(form);
                    }
                });
            });

            $('form').on('submit', function () {
                let element = $(this).find('button[type="submit"]');
                let button = $(this).find('button[type="button"]');
                showSpinner(element);
            });

            $('.show_upper_accordion').each(function () {
                $(this).parent().parent().parent().addClass("show");
            });

            $('.show_down_accordion').each(function () {
                $(this).parent().find('.menu-sub-accordion').addClass("show");
            });

            $(document).on("change", '.switcher', function (e) {
                e.preventDefault();
                let element = $('#kt_app_content_container .card');
                let that = $(this);
                let action = "{{route("admin.status.update")}}";
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: {
                        model: that.data('model'),
                        model_id: parseInt(that.data('modelid')),
                        column_name: that.data('columnname'),
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: function () {
                        element.find('#overlay').addClass("overlay overlay-block");
                        element.find('#data').html('<div class="overlay-layer bg-dark-o-10"><div class="spinner-border"></div></div>');
                    },
                    success: function success(result) {
                        setTimeout(() => {
                            hideSpinner(element);
                        }, 200)
                        if (result.success) {
                            toastr.success(result.message);
                            return;
                        }
                        toastr.error(result.message);
                        that.prop("checked", true);
                    },
                    error: function error(response) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            toastr.error(value);
                        });
                        setTimeout(() => {
                            hideSpinner(element);
                        }, 200)
                    }
                });
            });



            $('#notification').load("{{route("admin.notification.index")}}");

            $(document).on("click", ".notification_record", function () {
                let that = $(this);
                $.post({
                    url: that.data("action"),
                    method: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        _method: "PUT"
                    },
                    success: function (response) {
                        that.removeClass("fw-bolder");
                        that.removeClass("notification_record");
                        $('#notification_count').html(response.data.remaining_notification);
                        if (response.data.remaining_notification === 0) {
                            $('#notification_dots').remove();
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            });

        });

        @endauth
    })
</script>

@auth()
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js"></script>
    <script type="text/javascript">
        @include('firebase.init_firebase')
    </script>
    <script type="text/javascript">
        const messaging = firebase.messaging();
        toastr.options.escapeHtml = false;
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("{{route('admin.settings.init.firebase')}}").then((registration) => {
                messaging.useServiceWorker(registration);
                messaging.requestPermission()
                    .then(function () {
                        getRegToken();
                    })
                    .catch(function (err) {
                        console.log('Unable to get permission to notify.', err);
                    });
                messaging.onMessage(function (payload) {
                    toastr.info(payload.data.title + '<br />' + payload.data.body);
                    let sound = new Audio('{{asset('audio/audio-notification.mpeg')}}')
                    sound.play();
                    $('#notification').load("{{route("admin.notification.index")}}");
                    let notificationTitle = payload.data.title;
                    let notificationOptions = {
                        body: payload.data.body,
                        icon: payload.data.icon,
                        image: payload.data.image
                    };
                    new Notification(notificationTitle, notificationOptions);
                });
            });
        }

        function getRegToken(argument) {
            messaging.getToken().then(function (currentToken) {
                if (currentToken) {
                    saveToken(currentToken);
                } else {
                    console.log('No Instance ID token available. Request permission to generate one.');
                }
            }).catch(function (err) {
                console.log('An error occurred while retrieving token. ', err);
            });
        }

        function saveToken(currentToken) {
            $.ajax({
                type: "POST",
                data: {
                    'device_token': currentToken,
                    '_method': "PUT",
                    "_token": "{{csrf_token()}}"
                },
                url: '{{route("admin.update-device-token")}}',
                success: function (data) {
                    //
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>
@endauth
