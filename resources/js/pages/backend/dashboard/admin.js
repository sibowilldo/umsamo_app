"use strict";
// Class definition
var DashboardAdmin = function () {
    // Base elements
    let _appointment_datepicker;
    let _appointment_type_select;
    let _consultation_full_message_alert = $('#consultation-full-message');
    let _consultation_option;
    let _datepicker_card = new KTCard('datepicker-card');
    let _datepicker_options = {
        viewMode: 'days',
        format: 'YYYY-MM-DD',
        inline: true,
        defaultDate: false,
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
    let _event_date = $('input[name=event_date]');
    let _event_dates = {};
    let _formEl;
    let _step_1_validation;
    let _step_3_validation;
    let _wizard;
    let _wizardEl;
    let _validations = [];

    const _consultation_full_message = 'has no available spots for consultation appointments. Please choose a different date to make a Consultation Appointment.';

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
            return moment(prefix + year + "/" + month + "/" + day, "YYYY-MM-DD");
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
                        title: 'The given data was invalid.',
                        text: "Sorry, looks like you missed something, please check the form for further details and try again.",
                        icon: "warning",
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
                        if(pair[0]  === "appointment_type"){
                            output +=`<tr><th scope="row">${pair[0].toUpperCase().replace(/_/g, ' ')}</th><td>${$('select[name=appointment_type]').find(':selected').data('value')}</td></tr>`
                        }else
                        if(pair[1]!=="" && pair[0] !== "_token"){
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
        _step_1_validation = FormValidation.formValidation(
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
                                message: 'Choose Appointment type; if none is available, Please select a different date.'
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
        _validations.push(_step_1_validation);
        _appointment_type_select.on('changed.bs.select', (e, index, isSelected, previousValue)=>{
            _validations[0].revalidateField('appointment_type');
        })
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
        let _consultation_option = $('#consulting_option');
        let available_spaces = 0;
            axios.get('ajax/event-dates')
            .then(response=>{
                _event_dates =  response.data.data;
                _appointment_datepicker.on('dp.show', function(e){
                    let limit_label = $('#limit_value');
                    limit_label.text('');
                    _event_dates.some(function(item){
                        let selected_date = moment(item.date_time);
                        available_spaces =  item.limit - (item.confirmed_appointments_count < 0?0:item.confirmed_appointments_count);
                        $('input[name=event_date]').attr('data-id', item.id);
                        limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                        <strong>${available_spaces}</strong> ${available_spaces === 1?'spot':'spots'}
                                        available for consultation.`);
                        _event_date.val(selected_date.format('YYYY-MM-DD'));
                        if(available_spaces < 1){
                            _consultation_full_message_alert.removeClass('d-none flipOutX');
                            _consultation_full_message_alert.find('.alert-text')
                                .html(`<b>${selected_date.format('MMM DD, YYYY')}</b> ${_consultation_full_message}`);
                            return true;
                        }
                    })
                });
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
                if(available_spaces < 1){
                    _appointment_type_select.find('option[value=2]').prop('disabled', true).attr('data-subtext', 'DISABLED: No Spots Available');
                        _appointment_type_select.selectpicker('refresh');
                }
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
                        _validations[1].validate();
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
        }
        else{
            _datepicker_options.enabledDates = [moment().day(-1)];
            $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary');
        }

        _appointment_datepicker.datetimepicker(_datepicker_options);
        KTApp.unblock(_datepicker_card.getSelf());

        _appointment_datepicker.on('dp.change', function(e){
            let limit_label = $('#limit_value');
            limit_label.text('');

            _event_dates.some(function(item){
                let selected_date = moment(item.date_time);
                const available_spaces =  item.limit - (item.confirmed_appointments_count < 0?0:item.confirmed_appointments_count);
                if(selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD')){
                    $('input[name=event_date]').attr('data-id', item.id);

                    limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                            <strong>${available_spaces}</strong> ${available_spaces === 1?'spot':'spots'}
                                            available for consultation.`);
                    if(available_spaces < 1){
                        _consultation_full_message_alert.removeClass('d-none flipOutX').addClass('flipInX');
                        _consultation_full_message_alert.find('.alert-text')
                            .html(`<b>${selected_date.format('MMM DD, YYYY')}</b> ${_consultation_full_message}`);
                        _appointment_type_select.selectpicker('val','');
                        _consultation_option.attr('disabled', 'disabled').attr('data-subtext', 'DISABLED: No Spots Available');
                        _appointment_type_select.selectpicker('refresh');
                        return selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD');
                    }
                }else{
                    _consultation_full_message_alert.addClass('flipOutX');
                    _appointment_type_select.selectpicker('val','');
                    _consultation_option.removeAttr('disabled').attr('data-subtext', '');
                    _appointment_type_select.selectpicker('refresh');
                }
            })
            _event_date.val(e.date.format('YYYY-MM-DD'));
        });
    }

    var handleAuthRegisterFormSubmit = function(){
        let submitButton = $('#make_appointment');
        submitButton.on('click',(e) => {
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
                        showCancelButton: false,
                        confirmButtonText: 'Ok, Got it.',
                        onOpen: function (){
                            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                        }
                    })
                        .then(function(){
                            window.location.replace(response.data.url);
                        });
                })
                .catch(function (error) {
                    submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                    let error_title='Oops! Unexpected Error Occurred.';
                    let error_messages='Please report this to developers.';
                    if(error.hasOwnProperty('response')){
                        error_title = `${error.response.status} ${error.response.statusText}`;
                        if(error.response.hasOwnProperty('data')){
                            error_messages = `${error.response.data.message}`;
                            if(error.response.data.hasOwnProperty('error')){
                                let errorBag = error.response.data.errors
                                Object.entries(errorBag).forEach(function(item, index){
                                    error_messages += `<div>${item[1][0]}</div>`;
                                });
                            }
                        }
                    }
                    swal.fire({
                        icon: 'error',
                        title: error_title,
                        html: error_messages,
                    });
                })
        });
    };

    return {
        // public functions
        init: function () {
            _appointment_datepicker = $('.datepicker');
            _appointment_type_select = $('#appointment_type').selectpicker({style:'form-control-solid text-dark-75'});
            _consultation_option = _appointment_type_select.find('option[value=2]');
            _formEl = KTUtil.getById('registerPatientForm');
            _wizardEl = KTUtil.getById('kt_wizard_v2');

            initEventDates();
            initReactiveFormFields();

            initWizard();
            initValidation();
            handleAuthRegisterFormSubmit();
        }
    };
}();
jQuery(document).ready(function () {
    DashboardAdmin.init();
    $('input[name=cell_number]').inputmask('(999) 999-9999');
});
