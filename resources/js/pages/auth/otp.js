"use strict";
var CellVerificationModule = function(){

    var verifyModule =  function () {
        var validation;
        validation = FormValidation.formValidation(
            KTUtil.getById('verifyForm'),
            {
                fields: {
                    onetime: {
                        validators: {
                            notEmpty: {
                                message: 'OTP Required'
                            },
                            stringLength: {
                                max: 5,
                                min: 5,
                                message: 'Invalid OTP!'
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

        $('#verifyButton').on('click', function(e){
            e.preventDefault();
            let btnSubmit = $(this);
            let form =  $('#verifyForm');
            validation.validate().then(function(status) {
                if(status === 'Valid') {
                    window.axios.post(form.attr('action'), {
                        'onetime': $('input[name=onetime]').val()
                    })
                        .then(function (response) {
                            swal.fire({
                                icon: 'success',
                                title: response.data.title,
                                text: response.data.message
                            }).then(function () {
                                window.location.replace(response.data.redirect_url ?? '/');
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                            swal.fire({
                                icon: 'error',
                                title: error.response.data.title,
                                text: error.response.data.message
                            });
                        })
                        .finally(function () {
                            $('input[name=onetime]').val('')
                        });
                }
            });

        });
    }

    var requestAnotherModule =  function () {
        $('#requestAnotherButton').on('click', function(e){
            e.preventDefault();
            let btnSubmit = $(this);
            let form =  $('#requestAnotherForm');
            window.axios.post(form.attr('action'))
                .then(function(response){
                    swal.fire({
                        icon: 'success',
                        title: response.data.title,
                        text: response.data.message
                    }).then(function(){
                        btnSubmit.prop('disabled', true).text('OTP Sent!')
                    });
                }).catch(function(error){
                swal.fire({
                    icon: 'error',
                    title: error.response.data.title,
                    text: error.response.data.message
                });
            }).finally(function(){
                $('input[name=onetime]').val('')
            });
        });

    }

    return {
        init: function(){
            verifyModule();
            requestAnotherModule();
        }
    }
}();

jQuery(document).ready(function(){
    CellVerificationModule.init()
});
