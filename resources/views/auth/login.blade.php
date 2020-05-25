@extends('layout.auth')

@section('content')

<!--begin::Signin-->
<div class="login-form login-signin">
    <!--begin::Form-->
    <form class="form" novalidate="novalidate" id="loginForm" method="POST" data-action="{{ route('login') }}">
        <!--begin::Title-->
        <div class="pt-lg-40 mt-lg-10 pb-15">
            <h3 class="font-weight-bolder text-dark display5">Welcome to {{ config('app.name') }}</h3>
            <span class="text-muted font-weight-bold font-size-h4">New Here?
                                <a href="{{ route('register') }}" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
        </div>
        <!--begin::Title-->
        <!--begin::Form group-->
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="email" name="email" autocomplete="off" value="sibongiseni.msomi@outlook.com" />
        </div>
        <!--end::Form group-->
        <!--begin::Form group-->
        <div class="form-group">
            <div class="d-flex justify-content-between mt-n5">
                <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                <a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">Forgot Password ?</a>
            </div>
            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" value="admin123"/>
        </div>
        <!--end::Form group-->
        <!--begin::Action-->
        <div class="pb-lg-0 pb-10">
            <button type="button" id="loginSubmitButton" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
            <button type="button" class="btn btn-light-primary font-weight-bolder px-8 py-4 my-3 font-size-lg">
                <span class="svg-icon svg-icon-md">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.9895 10.1871C19.9895 9.36767 19.9214 8.76973 19.7742 8.14966H10.1992V11.848H15.8195C15.7062 12.7671 15.0943 14.1512 13.7346 15.0813L13.7155 15.2051L16.7429 17.4969L16.9527 17.5174C18.879 15.7789 19.9895 13.221 19.9895 10.1871Z" fill="#4285F4" />
                        <path d="M10.1993 19.9313C12.9527 19.9313 15.2643 19.0454 16.9527 17.5174L13.7346 15.0813C12.8734 15.6682 11.7176 16.0779 10.1993 16.0779C7.50243 16.0779 5.21352 14.3395 4.39759 11.9366L4.27799 11.9466L1.13003 14.3273L1.08887 14.4391C2.76588 17.6945 6.21061 19.9313 10.1993 19.9313Z" fill="#34A853" />
                        <path d="M4.39748 11.9366C4.18219 11.3166 4.05759 10.6521 4.05759 9.96565C4.05759 9.27909 4.18219 8.61473 4.38615 7.99466L4.38045 7.8626L1.19304 5.44366L1.08875 5.49214C0.397576 6.84305 0.000976562 8.36008 0.000976562 9.96565C0.000976562 11.5712 0.397576 13.0882 1.08875 14.4391L4.39748 11.9366Z" fill="#FBBC05" />
                        <path d="M10.1993 3.85336C12.1142 3.85336 13.406 4.66168 14.1425 5.33717L17.0207 2.59107C15.253 0.985496 12.9527 0 10.1993 0C6.2106 0 2.76588 2.23672 1.08887 5.49214L4.38626 7.99466C5.21352 5.59183 7.50242 3.85336 10.1993 3.85336Z" fill="#EB4335" />
                    </svg>
                </span>
                Sign in with Google
            </button>
        </div>
        <!--end::Action-->
    </form>
    <!--end::Form-->
</div>
<!--end::Signin-->

@endsection

@section('scripts')

<script>
    let initAuthLogin = function(){
        var validation;
        let handleAuthLoginFormSubmit = function(){
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validation = FormValidation.formValidation(
                KTUtil.getById('loginForm'),
                {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                },
                                emailAddress:{
                                    message: 'Value not a valid email address'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            );
                $('#loginSubmitButton').click(function(e) {
                    e.preventDefault();
                    let loginSubmitButton = $(this);
                    let loginForm = loginSubmitButton.closest('form');

                    validation.validate().then(function(status) {
                        if(status === 'Valid'){
                            axios.post(loginForm.data('action'), {
                                email: $('input[name=email]').val(),
                                password: $('input[name=password]').val(),
                            })
                            .then(function (response) {
                                let destination = response.data.url;
                                swal.showLoading();
                                swal.fire({
                                        title: 'Login Success',
                                        text: 'Redirecting...',
                                        icon: 'success',
                                        timer: 2000,
                                        onOpen: function (){
                                            swal.showLoading();
                                        }
                                    })
                                    .then(function(){
                                        window.location.replace(destination);
                                    });
                            })
                            .catch(function (error) {
                                console.log('error', error.response.data);
                                swal.fire({
                                    icon: 'error',
                                    title: error.response.data.title,
                                    text: error.response.data.text,
                                });
                            })
                        }
                        else{

                        }
                    });

                });
        };
        return {
            init: function(){
                handleAuthLoginFormSubmit();
            }
        }
    }();

    jQuery(document).ready(function(){
        initAuthLogin.init();
    });
</script>

@endsection
