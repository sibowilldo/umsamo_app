"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    const passwordMeter = $('#passwordMeter');
    const randomNumber = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };

    var _wizardEl;
    var _formEl;
    var _wizard;
    var _validations = [];

    var generateLuhnDigit = function(inputString) {
        var total = 0;
        var count = 0;
        for (var i = 0; i < inputString.length; i++) {
            var multiple = count % 2 + 1;
            count++;
            var temp = multiple * +inputString[i];
            temp = Math.floor(temp / 10) + (temp % 10);
            total += temp;
        }

        total = (total * 9) % 10;

        return total;
    };
    var extractFromID = function(idNumber) {
        var checkIDNumber = function(idNumber) {
            var number = idNumber.substring(0, idNumber.length - 1);
            return generateLuhnDigit(number) === +idNumber[idNumber.length - 1];
        };

        var getBirthdate = function(idNumber) {
            var year = idNumber.substring(0, 2);
            var currentYear = new Date().getFullYear() % 100;

            var prefix = "19";
            if (+year < currentYear)
                prefix = "20";

            var month = idNumber.substring(2, 4);
            var day = idNumber.substring(4, 6);
            return moment(prefix + year + "/" + month + "/" + day);
        };

        var getGender = function(idNumber) {
            return +idNumber.substring(6, 7) < 5 ? "F" : "M";
        };

        var getCitizenship = function(idNumber) {
            return +idNumber.substring(10, 11) === 0 ? "citizen" : "resident";
        };

        var result = {};
        result.valid = checkIDNumber(idNumber);
        result.birthdate = getBirthdate(idNumber);
        result.gender = getGender(idNumber);
        result.citizen = getCitizenship(idNumber);
        return result;
    };

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        _wizard = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
        });

        // Validation before going to next page
        _wizard.on('beforeNext', function (wizard) {
            _validations[wizard.getStep() - 1].validate().then(function (status) {
                if (status == 'Valid') {
                    _wizard.goNext();
                    KTUtil.scrollTop();
                } else {
                    swal.fire({
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

            $('[name=cell_number]').on('change', function() {
                _validations[wizard.getStep() - 1].revalidateField('cell_number');
            });

            switch(_wizard.getStep()){
                case 1:
                    $('#UI_id_number').text($('input[name=id_number]').val());
                    $('#UI_first_name').text($('input[name=first_name]').val());
                    $('#UI_last_name').text($('input[name=last_name]').val());
                    $('#UI_address').text($('input[name=address]').val());
                    $('#UI_gender').text($('input[name=gender]:checked').val());
                    $('#UI_date_of_birth').text($('input[name=date_of_birth]').val());
                    $('#UI_city').text($('input[name=city]').val());
                    $('#UI_province').text($('select[name=province]').children("option:selected").val());
                    $('#UI_postal_code').text($('input[name=postal_code]').val());
                    break;
                case 2:
                    $('#UI_email').text($('input[name=email]').val());
                    $('#UI_cell_number').text($('input[name=cell_number]').val());
                    $('#UI_agree').text(`You have${$('input[name=agree]:checked')? ' ': ' NOT '}accepted the terms and conditions.`);
                    break;
            }
            _wizard.stop();  // Don't go to the next step
        });


        // Change event
        _wizard.on('change', function (wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    id_number: {
                        validators: {
                            notEmpty: {
                                message: 'RSA ID Number is required'
                            },
                            stringLength:{
                                max: 13,
                                message: 'Invalid RSA ID Number'
                            },
                            callback: {
                                message: 'Invalid RSA ID Number',
                                callback: function(input){
                                    let idNumber = $(input);
                                    if(idNumber[0].value.length == 13){
                                        let is_valid = extractFromID(idNumber[0].value);
                                        if(is_valid.valid){
                                            $('input[name=date_of_birth]').val(is_valid.birthdate.format('YYYY-MM-DD'));
                                            $('input[name=gender]').val([is_valid.gender]);

                                        }
                                        return is_valid.valid;
                                    }else{
                                        return false;
                                    }
                                }

                            }
                        }
                    },
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
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
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
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            identical: {
                                compare: function() {
                                    return $('[name="password"]').val();
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    agree:{
                        validators:{
                            notEmpty: {
                                message: 'Please agree to our terms and conditions.'
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
        ));
    }

    var handleAuthRegisterFormSubmit = function(){
        let submitButton = $('#registerSubmitButton');
        submitButton.click(function(e) {
            e.preventDefault();

            let registerForm = $(_formEl);
            let formData = {
                email: $('input[name=email]').val(),
                password: $('input[name=password]').val(),
                password_confirmation: $('input[name=password_confirmation]').val(),

                avatar: $('input[name=avatar]').val(),
                id_number: $('input[name=id_number]').val(),
                first_name: $('input[name=first_name]').val(),
                last_name: $('input[name=last_name]').val(),
                gender: $('input[name=gender]:checked').val(),
                date_of_birth: $('input[name=date_of_birth]').val(),
                cell_number: $('input[name=cell_number]').val(),
                address: $('input[name=address]').val(),
                city: $('input[name=city]').val(),
                province: $('select[name=province]').children("option:selected").val(),
                postal_code: $('input[name=postal_code]').val(),
            };

            submitButton.attr('disabled', 'disabled');
            submitButton.text('Loading...').addClass('spinner-white spinner spinner-left').removeClass('px-9');

            axios.post(registerForm.data('action'), formData)
                .then(function (response) {
                    let destination = response.data.url;
                    swal.fire({
                        title: 'Register Success',
                        text: 'Redirecting...',
                        icon: 'success',
                        timer: 2000,
                        onOpen: function (){
                            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                            swal.showLoading();
                        }
                    })
                        .then(function(){
                            window.location.replace(destination);
                        });
                })
                .catch(function (error) {
                    submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                    let errorBag = error.response.data.errors
                    let error_messages='';
                    Object.entries(errorBag).forEach(function(item, index){
                        error_messages += `<div>${item[1][0]}</div>`;
                    });

                    swal.fire({
                        icon: 'error',
                        title: error.response.data.message,
                        html: error_messages,
                    });
                })
        });
    };

    var initBootstrapSelect = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker({
            container: 'body',
            style:'form-control-lg form-control-solid',
            styleBase: 'form-control',
            noneSelectedText: 'Please select a Province'
        });
    }
    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard_v2');
            _formEl = KTUtil.getById('registerForm');

            initWizard();
            initValidation();
            handleAuthRegisterFormSubmit();
            initBootstrapSelect();
        }
    };
}();

jQuery(document).ready(function () {
    KTWizard2.init();
    $('input[name=cell_number]').inputmask('(999) 999-9999');
});
