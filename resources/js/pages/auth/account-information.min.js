"use strict";
// Class definition
var initAccountInformation = function () {

    var cell_validation;
    var email_validation;
    var _changeCellNumberForm;
    var _changeEmailForm;
    let axiosSuccess =  function(response, btn){
        let destination = response.data.redirect_url;
        window.swal.showLoading();
        window.swal.fire({
            title: response.data.title,
            text: response.data.message,
            icon: 'success',
            timer: 2000,
            onOpen: function (){
                btn.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
                window.swal.showLoading();
            }
        })
            .then(function(){
                window.location.replace(destination);
            });
    }
    let axiosError = function(error){
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
    }

    let validationErrorMessage = function(btn){
        window.swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        }).then(function () {
            KTUtil.scrollTop();
            btn.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
        });
    }
    let handleChangeCellNumber = function(){
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        cell_validation = FormValidation.formValidation(
            _changeCellNumberForm,
            {
                fields: {
                    cell_number: {
                        validators: {
                            notEmpty: {
                                message: 'We need your cell number to communicate further with you and, to activate your account.'
                            },
                            regexp: {
                                regexp: /^[(]([0-9]{3})[)] ([0-9]{3})[-]([0-9]{4})/,
                                message: 'The cell number is missing one or more digits.'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#changeCellNumberSubmit').on('click', function(e) {
            e.preventDefault();
            let submitButton = $(this);
            let formEntries = new FormData(_changeCellNumberForm);
            let formData = {};

            for (let pair of formEntries.entries()) {
                formData[pair[0]] = pair[1];
            }

            submitButton.attr('disabled', 'disabled');
            submitButton.addClass('spinner-white spinner spinner-left').removeClass('px-9');

            cell_validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.patch($(_changeCellNumberForm).attr('action'), formData)
                        .then(function (response) {
                            axiosSuccess(response, submitButton);
                        })
                        .catch(function (error) {
                            axiosError(error);
                        })
                        .finally(function(){
                            submitButton.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
                        });
                }
                else{
                    validationErrorMessage(submitButton)
                }
            });

        });
    };

    let handleChangeEmail = function(){
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        email_validation = FormValidation.formValidation(
            _changeEmailForm,
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'We need your email to log you in, send you notifications and, to activate your account.'
                            },
                            emailAddress:{
                                message: 'Value not a valid email address'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#changeEmailSubmit').on('click', function(e) {
            e.preventDefault();
            let submitButton = $(this);
            let formEntries = new FormData(_changeEmailForm);
            let formData = {};

            for (let pair of formEntries.entries()) {
                formData[pair[0]] = pair[1];
            }

            submitButton.attr('disabled', 'disabled');
            submitButton.addClass('spinner-white spinner spinner-left').removeClass('px-9');

            email_validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.patch($(_changeEmailForm).attr('action'), formData)
                        .then(function (response) {
                            axiosSuccess(response, submitButton);
                        })
                        .catch(function (error) {
                            axiosError(error);
                        })
                        .finally(function(){
                            submitButton.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
                        });
                }
                else{
                    validationErrorMessage()
                }
            });

        });
    };
    return {
        // public functions
        init: function() {
            _changeCellNumberForm = KTUtil.getById('changeCellNumberForm');
            _changeEmailForm = KTUtil.getById('changeEmailForm');
            handleChangeCellNumber();
            handleChangeEmail();
            $('input[name=cell_number]').inputmask('(999) 999-9999');
        }
    };
}();

jQuery(document).ready(function() {
    initAccountInformation.init();
});
