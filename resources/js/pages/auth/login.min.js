"use strict";

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
        $('#loginSubmitButton').on('click', function(e) {
            e.preventDefault();
            let loginSubmitButton = $(this);
            let loginForm = loginSubmitButton.closest('form');
            loginSubmitButton.prop('disabled', true);
            loginSubmitButton.text('Signing you in...').addClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').removeClass('px-8 btn-primary');

            validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.post(loginForm.data('action'), {
                        email: $('input[name=email]').val(),
                        password: $('input[name=password]').val(),
                    })
                        .then(function (response) {
                            let destination = response.data.url;
                            loginSubmitButton.prop('disabled', false);
                            loginSubmitButton.text('Redirecting...').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
                            window.swal.showLoading();
                            window.swal.fire({
                                title: 'Login Success',
                                text: 'Redirecting...',
                                icon: 'success',
                                timer: 2000,
                                onOpen: function (){
                                    window.swal.showLoading();
                                }
                            })
                                .then(function(){
                                    window.location.replace(destination);
                                });
                        })
                        .catch(function (error) {
                            loginSubmitButton.prop('disabled', false);
                            loginSubmitButton.text('Sign In').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');

                            if(error.response.status >= 500) {
                                window.swal.fire({icon: 'error', title: error.response.statusText,text: "Please try again!"})
                                    .then(function(){
                                        window.location.reload();
                                    });
                            }else if(error.response.status > 401){
                                window.swal.fire({icon: 'error', title: error.response.statusText,text: error.response.data.errors.email[0]})
                                    .then(function(){
                                        window.location.reload();
                                    });
                            } else{
                                window.swal.fire({
                                    icon: 'error',
                                    title: error.response.data.title,
                                    text: error.response.data.text,
                                });
                            }

                        });
                }
                else{
                    loginSubmitButton.prop('disabled', false);
                    loginSubmitButton.text('Sign In').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
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
