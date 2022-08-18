@extends('admin.layouts.auth')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="login_form" action="#">
        <div class="text-center mb-15">
            <h1 class="text-dark fw-bolder mb-3">{{__("Login to your account")}}</h1>
        </div>
        <x-input-field
            name="username"
            col="12"
            required
            :title="__('Username')"
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
            <button type="submit" id="login_btn" class="btn btn-primary">
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
                        'username': {
                            validators: {
                                notEmpty: {
                                    message: '{{__("Username is required")}}'
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
                                username: form.querySelector('[name="username"]').value,
                                password: form.querySelector('[name="password"]').value,
                                remember: form.querySelector('[name="remember"]:checked')?.value === "1",
                            }).then((response) => {
                                if (response.status === 204) {
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
                                            form.querySelector('[name="username"]').value = "";
                                            form.querySelector('[name="password"]').value = "";
                                            location.href = "{{route("admin.dashboard.index")}}";
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
                    form = document.querySelector('#login_form');
                    submitButton = document.querySelector('#login_btn');

                    handleForm();
                }
            };
        }();
        KTUtil.onDOMContentLoaded(function () {
            loginFormClass.init();
        });
    </script>
@endsection
