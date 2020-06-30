"use strict";
// Class definition
var initPersonalInformation = function () {

    var validation;
    var _personalInformationForm;
    let handlePersonalInformationFormSubmit = function(){
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            _personalInformationForm,
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: 'First name is required'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required'
                            }
                        }
                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'Street Address is required'
                            }
                        }
                    },
                    city: {
                        validators: {
                            notEmpty: {
                                message: 'City is required'
                            },
                        }
                    },
                    province: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a province'
                            },
                        }
                    },
                    postal_code: {
                        validators: {
                            notEmpty: {
                                message: 'Postal Code is required'
                            },
                            digits: {
                                message: 'Value is not valid'
                            },
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );
        $('#submitButton').on('click', function(e) {
            e.preventDefault();
            let submitButton = $(this);
            let formEntries = new FormData(_personalInformationForm);
            let formData = {};

            for (let pair of formEntries.entries()) {
                formData[pair[0]] = pair[1];
            }

            submitButton.attr('disabled', 'disabled');
            submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');

            validation.validate().then(function(status) {
                if(status === 'Valid'){
                    window.axios.patch($(_personalInformationForm).attr('action'), formData)
                        .then(function (response) {
                            let destination = response.data.redirect_url;
                            window.swal.showLoading();
                            window.swal.fire({
                                title: response.data.title,
                                text: response.data.message,
                                icon: 'success',
                                timer: 2000,
                                onOpen: function (){
                                    submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                                    window.swal.showLoading();
                                }
                            })
                                .then(function(){
                                    window.location.replace(destination);
                                });
                        })
                        .catch(function (error) {
                            if(error.response.data.message === "CSRF token mismatch"){
                                submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
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
                    });
                }
            });

        });
    };

    return {
        // public functions
        init: function() {
            _personalInformationForm = KTUtil.getById('personalInformationForm');
            handlePersonalInformationFormSubmit();

            $('.kt-selectpicker').selectpicker({
                container: 'body',
                style: 'form-control-lg form-control-solid',
                styleBase: 'form-control',
                noneSelectedText: 'Please select a Province'
            })
        }
    };
}();

jQuery(document).ready(function() {
    initPersonalInformation.init();
});
