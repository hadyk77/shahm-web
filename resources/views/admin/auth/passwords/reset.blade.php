@extends('admin.layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{route('admin.dashboard.index')}}" action="#">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">{{__("Reset Password")}}</h1>
        </div>
        <x-input-field
            name="email"
            type="email"
            col="12"
            required
            :value="$email"
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
        <x-input-field
            name="password_confirmation"
            type="password"
            col="12"
            required
            class="mt-4"
            :title="__('Password Confirmation')"
        />
        <div class="d-grid mb-10 mt-5">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">{{__("Reset Password")}}</span>
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
                        },
                        'password_confirmation': {
                            validators: {
                                notEmpty: {
                                    message: '{{__('The password is required')}}'
                                },
                                identical: {
                                    compare: function () {
                                        return form.querySelector('[name="password"]').value;
                                    },
                                    message: '{{__("The password and its confirm are not the same")}}',
                                },
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.form-group'
                        })
                    }
                });
                submitButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    validator.validate().then(function (status) {
                        if (status === 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;
                            axios.post("{{route('admin.password.update')}}", {
                                email: form.querySelector('[name="email"]').value,
                                password: form.querySelector('[name="password"]').value,
                                password_confirmation: form.querySelector('[name="password_confirmation"]').value,
                                token: form.querySelector('[name="token"]').value,
                            }).then(response => {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                if (response.status === 200) {
                                    Swal.fire({
                                        text: "{{__("You have reset your password, login now")}}",
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
                                            form.querySelector('[name="password_confirmation"]').value = "";
                                            location.href = "{{route("admin.dashboard.index")}}"
                                        }
                                    });
                                }
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
