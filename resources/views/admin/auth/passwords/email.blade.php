@extends('admin.layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="#" action="#">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">{{__("Reset Password")}}</h1>
        </div>
        <x-input-field
            name="email"
            type="email"
            col="12"
            required
            :title="__('Email')"
        />
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-3">
            <div></div>
            <a href="{{route('admin.login')}}" class="link-primary">{{__("Return Login")}}</a>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">{{__("Send Password Reset Link")}}</span>
                <span class="indicator-progress">
                    {{__("Please wait")}}...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </form>
@endsection

@section("scripts")
    <script>
        let loginFormClass = function () {
            let form;
            let submitButton;
            let validator;
            let handleForm = function (e) {
                validator = FormValidation.formValidation(form, {
                    fields: {
                        'email': {
                            validators: {
                                regexp: {
                                    regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                    message: '{{__("The value is not a valid email address")}}',
                                },
                                notEmpty: {
                                    message: '{{__("Email address is required")}}'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.form-group',
                        })
                    }
                });
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;
                            axios.post("{{route('admin.password.email')}}", {
                                email: form.querySelector('[name="email"]').value
                            }).then(response => {
                                console.log(response);
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                Swal.fire({
                                    text: "{{__("Reset link send successfully to your email")}}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{__("Ok, got it!")}}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        form.querySelector('[name="email"]').value = "";
                                        form.querySelector('[name="password"]').value = "";

                                        //form.submit(); // submit form
                                        var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                        if (redirectUrl) {
                                            location.href = redirectUrl;
                                        }
                                    }
                                });
                            }).catch(error => {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                Swal.fire({
                                    text: error.response.data.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{__("Ok, got it!")}}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });

                            })
                        } else {
                            Swal.fire({
                                text: "{{__("Sorry, looks like there are some errors detected, please try again.")}}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{__("Ok, got it!")}}",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });
            }
            return {
                // Initialization
                init: function () {
                    form = document.querySelector('#kt_sign_in_form');
                    submitButton = document.querySelector('#kt_sign_in_submit');

                    handleForm();
                }
            };
        }();
        KTUtil.onDOMContentLoaded(function () {
            loginFormClass.init();
        });
    </script>
@endsection
