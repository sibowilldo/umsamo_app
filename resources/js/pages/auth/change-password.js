"use strict";

let initAuthChangePassword = function(){
    // Base elements
    const passwordMeter = $('#passwordMeter');
    const randomNumber = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    var validation;

    let handleAuthChangePasswordFormSubmit = function(){
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('changePasswordForm'),
            {
                fields: {
                    current_password: {
                        validators: {
                            notEmpty: {
                                message: 'Current password is required.'
                            },
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Please provide a new password.'
                            },
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'Password Confirmation is required.'
                            },
                            identical: {
                                compare: function() {
                                    return $('[name="password"]').val();
                                },
                                message: 'The password and its confirm needs to be the same.'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    passwordStrength: new FormValidation.plugins.PasswordStrength({
                        field: 'password',
                        message: 'The password is weak',
                        minimalScore: 3,
                        onValidated: function(valid, message, score) {
                            switch (score) {
                                case 0:
                                    passwordMeter.css('width', randomNumber(1, 20) + '%');
                                    passwordMeter.addClass('bg-danger').removeClass('bg-brand bg-success bg-warning');
                                case 1:
                                    passwordMeter.css('width', randomNumber(20, 40) + '%');
                                    passwordMeter.addClass('bg-danger').removeClass('bg-brand bg-success bg-warning');
                                    break;
                                case 2:
                                    passwordMeter.css('width', randomNumber(40, 60) + '%');
                                    passwordMeter.addClass('bg-warning').removeClass('bg-danger bg-brand bg-success');
                                    break;
                                case 3:
                                    passwordMeter.css('width', randomNumber(60, 80) + '%');
                                    passwordMeter.addClass('bg-success').removeClass('bg-danger bg-brand bg-warning');
                                    break;
                                case 4:
                                    passwordMeter.css('width', '100%');
                                    passwordMeter.addClass('bg-brand').removeClass('bg-danger bg-success bg-warning');
                                    break;
                                default:
                                    break;
                            }
                        },
                    }),
                }
            }
        );

        $('#changePasswordSubmitButton').on('click', function(e) {
            e.preventDefault();

            let changePasswordSubmitButton = $(this);
            let changePasswordForm = $('#changePasswordForm');

            changePasswordSubmitButton.prop('disabled', true);
            changePasswordSubmitButton.text('Requesting Change...').addClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').removeClass('btn-primary');

            validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.post(changePasswordForm.attr('action'), {
                        current_password: $('input[name=current_password]').val(),
                        password: $('input[name=password]').val(),
                        password_confirmation: $('input[name=password_confirmation]').val(),
                    })
                        .then(function (response) {
                            let destination = response.data.redirect_url;
                            window.swal.showLoading();
                            window.swal.fire({
                                title: 'Change Password Success',
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
                            if(error.response.status === 422) {
                                let errorBag = error.response.data.errors
                                let error_messages='';
                                Object.entries(errorBag).forEach(function(item, index){
                                    error_messages += `<div>${item[1][0]}</div>`;
                                });
                                window.swal.fire({
                                    icon: 'error',
                                    title: error.response.data.message,
                                    html: error_messages,
                                });
                            }else {
                                window.swal.fire({icon: 'error', title: error.response.statusText,text: "Please try again!"})
                            }
                        })
                        .finally(()=>{
                            changePasswordSubmitButton.prop('disabled', false);
                            changePasswordSubmitButton.text('Update Changes').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('btn-primary');
                        });
                }
                else{
                    changePasswordSubmitButton.prop('disabled', false);
                    changePasswordSubmitButton.text('Update Changes').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('btn-primary');
                }
            });
        });
    };
    return {
        init: function(){
            handleAuthChangePasswordFormSubmit();
        }
    }
}();

jQuery(document).ready(function(){
    initAuthChangePassword.init();
});
