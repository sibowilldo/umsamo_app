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

            validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.post(loginForm.data('action'), {
                        email: $('input[name=email]').val(),
                        password: $('input[name=password]').val(),
                    })
                        .then(function (response) {
                            let destination = response.data.url;
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
                            if(error.response.data.message === "CSRF token mismatch"){
                                window.swal.fire({icon: 'error', title: error.response.data.message,text: "Please try again!"})
                                    .then(function(){
                                        window.location.reload();
                                    });
                            }
                            window.swal.fire({
                                icon: 'error',
                                title: error.response.data.title,
                                text: error.response.data.text,
                            });
                        });
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
