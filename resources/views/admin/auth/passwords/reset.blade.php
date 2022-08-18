@extends('admin.layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{route('admin.dashboard.index')}}" action="#">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">{{__("Reset Password")}}</h1>
        </div>
        <div class="fv-row mb-5">
            <input type="text" placeholder="{{__("Email")}}" name="email" autocomplete="off"
                   value="{{old("email", $email)}}" class="form-control"/>
        </div>
        <div class="fv-row mb-5">
            <input type="password" placeholder="{{__("Password")}}" name="password" autocomplete="off"
                   class="form-control"/>
        </div>
        <div class="fv-row mb-5">
            <input type="password" placeholder="{{__("Password Confirmation")}}" name="password_confirmation"
                   autocomplete="off" class="form-control"/>
        </div>
        <div class="d-grid mb-10">
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
                            rowSelector: '.fv-row'
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
                                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                            if (redirectUrl) {
                                                location.href = redirectUrl;
                                            }
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
