@extends('admin.layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
        <div class="text-center mb-15">
            <h1 class="text-dark fw-bolder mb-3">{{__("Login to your account")}}</h1>
        </div>
        <x-input-field
            name="email"
            type="email"
            col="12"
            required
            :title="__('Email')"
        />
        <x-input-field
            name="password"
            type="password"
            col="12"
            required
            class="mt-4"
            :title="__('Password')"
        />
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mt-3 mb-3">
            <label class="form-check form-check-custom form-check-solid my-4">
                <input class="form-check-input h-20px w-20px cursor-pointer" type="checkbox" name="remember" value="1">
                <span class="form-check-label fw-semibold cursor-pointer">{{__("Remember Me")}}</span>
            </label>
            <a href="{{route('admin.password.request')}}" class="link-primary">{{__("Forgot Password ?")}}</a>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">{{__("Sign In")}}</span>
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
                        },
                        'password': {
                            validators: {
                                notEmpty: {
                                    message: '{{__('The password is required')}}'
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
                            axios.post("{{route("admin.login")}}", {
                                email: form.querySelector('[name="email"]').value,
                                password: form.querySelector('[name="password"]').value,
                                remember: form.querySelector('[name="remember"]:checked')?.value === "1",
                            }).then((response) => {
                                if (response.status === 201) {
                                    Swal.fire({
                                        text: "{{__("You have successfully logged in!")}}",
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
                                            var redirectUrl = response.data.data.redirect_url;
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
                                        }
                                    });
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                }

                            }).catch(e => {
                                Swal.fire({
                                    text: e.response.data.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{__("Ok, got it!")}}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
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
