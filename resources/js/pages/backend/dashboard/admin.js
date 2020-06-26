"use strict";
// Class definition
var KTWizard2 = function () {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizard;
    var _validations = [];
    var _appointment_datepicker;
    var _datepicker_card = new KTCard('datepicker-card');
    var _event_date = $('input[name=event_date]');
    var _event_dates = {};
    var _step_3_validation;
    var _datepicker_options = {
        viewMode: 'days',
        format: 'YYYY-MM-DD',
        inline: true,
        defaultDate: false,
        daysOfWeekDisabled:[0,6],
        minDate: moment(),
        sideBySide:true,
        enabledDates: [],
        icons: {
            next: 'flaticon2-right-arrow',
            previous: 'flaticon2-left-arrow',
            up: 'flaticon2-up',
            down: 'flaticon2-down',
        }
    }

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
                if (status === 'Valid') {
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

            if(!$('input[name=with_family]').prop('checked')){
                _step_3_validation.disableValidator('family_name', 'notEmpty');
            }

            _appointment_datepicker.on('dp.change', function () {
                _validations[wizard.getStep() - 1].revalidateField('event_date');
            });

            $('input[name=cell_number]').on('input', function() {
                _validations[wizard.getStep() - 1].revalidateField('cell_number');
            });

            switch (_wizard.getStep()) {
                case 3:
                    let form_data = new FormData(_formEl);

                    let output = '', outputContainer = $('#review_info');
                    for (var pair of form_data.entries()) {
                        if(pair[1]!==""){
                            output +=`<tr><th scope="row">${pair[0].toUpperCase().replace(/_/g, ' ')}</th><td>${pair[1]}</td></tr>`
                        }
                    }
                    outputContainer.html(output);
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
                    event_date:{
                        validators :{
                            notEmpty: {
                                message: 'Please select date from calendar'
                            }
                        }
                    },
                    appointment_type:{
                        validators :{
                            notEmpty: {
                                message: 'Please choose Appointment type'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        ));
        // Step 2
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
                                    if(idNumber[0].value.length === 13){
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

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email required for login, notifications and, to activate account.'
                            },
                            emailAddress: {
                                message: 'Value not a valid email address'
                            }
                        }
                    },
                    cell_number: {
                        validators: {
                            notEmpty: {
                                message: 'Cell number is required for further communication and, to activate account.'
                            },
                            regexp: {
                                regexp: /^[(]([0-9]{3})[)] ([0-9]{3})[-]([0-9]{4})/,
                                message: 'The cell number is missing one or more digits.'
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
        // Step 3
        _step_3_validation = FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    family_name: {
                        validators: {
                            notEmpty: {
                                message: 'Family name is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                }
            }
        );
        _validations.push(_step_3_validation);

        let with_family = $('input[name=with_family]');
        let family_name = $('input[name=family_name]');
        with_family.on('change', function(){
            if(with_family.prop('checked')){
                family_name.prop('disabled', false).parent().show();
                _step_3_validation.enableValidator('family_name', 'notEmpty');
            }else{
                _step_3_validation.disableValidator('family_name', 'notEmpty');
                family_name.prop('disabled', true).parent().hide();
            }
        });
    }

    var initEventDates = function(){
        axios.get('ajax/event-dates')
            .then(response=>{
                _event_dates =  response.data.data;
            })
            .catch((error)=>{
                swal.fire({
                    title: `Status Code ${error.response.status} <br> Error fetching available Appointment Dates.`,
                    text: "Please report this error, and quote Status Code",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                })
                    .then(function () {
                        $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary').text('Next Step [Disabled]');
                        _datepicker_options.enabledDates = [moment().day(-1)];
                        _appointment_datepicker.datetimepicker(_datepicker_options);
                        KTApp.unblock(_datepicker_card.getSelf());
                    });


            })
            .finally(()=>{
                initBootstrapCalendar();
            });
    };

    var initReactiveFormFields = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker({
            container: 'body',
            style:'form-control-lg form-control-solid',
            styleBase: 'form-control',
            noneSelectedText: 'Please select a Province'
        });

        $('input[name=id_number]').on('input', function (e) {
            let input = $(this);
            if(input.val().length === 13 && extractFromID(input.val())){
                axios.get(`/profiles/${input.val()}`)
                    .then(response=>{
                        window.swal.fire({
                            icon: 'info',
                            title: 'Patient exists',
                            text: 'For security purposes, please ask them confirm their details, as shown on the screen.'
                        });
                        let user = response.data.profile;
                        $('input[name=email]').val(user.user.email);
                        $('input[name=cell_number]').val(user.cell_number);
                        $('input[name=first_name]').val(user.first_name);
                        $('input[name=last_name]').val(user.last_name);
                        $('input[name=address]').val(user.address);
                        $('input[name=city]').val(user.city);
                        $('input[name=province]').val(user.province);
                        $('input[name=postal_code]').val(user.postal_code);
                    })
                    .catch(error=>{ })
            }
        });
    }

    var initBootstrapCalendar = function(){
        KTApp.block(_datepicker_card.getSelf(), {
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Loading Dates...',
            shadow: true,
            size: 'lg'
        });
        if(Object.keys(_event_dates).length >0){
            let event_dates =  _event_dates.map(function(data){
                return moment(data.date_time);
            });
            if(event_dates.length > 0){
                _datepicker_options.enabledDates = event_dates;
            }
        }else{
            _datepicker_options.enabledDates = [moment().day(-1)];
            $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary');
        }

        _appointment_datepicker.datetimepicker(_datepicker_options);
        KTApp.unblock(_datepicker_card.getSelf());

        _appointment_datepicker.on('dp.change', function(e){
            let limit_label = $('#limit_value');
            let consultation_option = $('#consultation_option')
            limit_label.text('');

            _event_dates.some(function(item){
                let selected_date = moment(item.date_time)
                if(selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD')){
                    $('input[name=event_date]').attr('data-id', item.id);

                    limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                            <strong>${item.limit}</strong> ${item.limit === 1?'spot':'spots'}
                                            available for consultation.`);
                    if(item.limit < 1){
                        consultation_option.attr('disabled', 'disabled').parent().addClass('radio-disabled');
                        return selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD');
                    }
                }else{
                    consultation_option.removeAttr('disabled').prop('checked', false).parent().removeClass('radio-disabled')
                }
            })
            _event_date.val(e.date.format('YYYY-MM-DD'));
        });
    }

    var handleAuthRegisterFormSubmit = function(){
        let submitButton = $('#make_appointment');
        submitButton.click(function(e) {
            e.preventDefault();
            let formEntries = new FormData(_formEl);
            let formData = {};
            for (let pair of formEntries.entries()) {
                formData[pair[0]] = pair[1];
            }

            formData['event_date'] = $('input[name=event_date]').data('id')

            submitButton.attr('disabled', 'disabled');
            submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');

            axios.post($(_formEl).attr('action'), formData)
                .then(function (response) {
                    swal.fire({
                        title: response.data.title,
                        text: response.data.message,
                        icon: 'success',
                        timer: 2000,
                        onOpen: function (){
                            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                            swal.showLoading();
                        }
                    })
                        .then(function(){
                            window.location.replace(response.data.url);
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

    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard_v2');
            _formEl = KTUtil.getById('registerPatientForm');
            _appointment_datepicker = $('.datepicker');

            initEventDates();
            initReactiveFormFields();

            initWizard();
            initValidation();
            handleAuthRegisterFormSubmit();
        }
    };
}();
jQuery(document).ready(function () {
    KTWizard2.init();
    $('input[name=cell_number]').inputmask('(999) 999-9999');
});
