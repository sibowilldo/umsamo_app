"use strict";
// Class definition
var DashboardClient = function () {
    // Base elements
    var _appointment_datepicker;
    var _datepicker_card = new KTCard('datepicker-card');
    var _event_date = $('input[name=event_date]');
    var _event_dates = {};
    var _with_family;
    var _family_member;
    var _formEl;
    var _wizardEl;
    var _wizard;
    var _validations = [];
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

            if(!_with_family.prop('checked')){
                _step_3_validation.disableValidator('family_member', 'notEmpty');
                _step_3_validation.disableValidator('family', 'notEmpty');
            }
            _appointment_datepicker.on('dp.change', function () {
                _validations[wizard.getStep() - 1].revalidateField('event_date');
            });

            switch (_wizard.getStep()) {
                // Set up Review information for the last step
                case 2:
                    let form_data = new FormData(_formEl);
                    let output = '', outputContainer = $('#review_info');
                    let family_members_output = {};

                    for (var pair of form_data.entries()) {
                        if(pair[0]  === "family_member"){
                            family_members_output = $('#family_member option:selected').map(function(item, v){
                                return `<tr><th scope="row">MEMBER</th><td>${$(v).text()}</td></tr>`
                            });
                        }else
                        if(pair[0]  === "family"){
                            output +=`<tr><th scope="row">${pair[0].toUpperCase().replace(/_/g, ' ')}</th><td>${$('input[name=family]:checked').data('family-name')}</td></tr>`
                        }else
                        if(pair[1]!==""){
                            output +=`<tr><th scope="row">${pair[0].toUpperCase().replace(/_/g, ' ')}</th><td>${pair[1]}</td></tr>`
                        }
                    }

                    outputContainer.html(output);

                    if(!$.isEmptyObject(family_members_output)){
                        family_members_output.map(function(index,item){
                            outputContainer.append(item);
                        })
                    }

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
        _step_3_validation = FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    family_member: {
                        validators: {
                            notEmpty: {
                                message: 'Please select at least one family member'
                            }
                        }
                    },
                    family: {
                        validators: {
                            notEmpty: {
                                message: 'Family is required'
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

        let with_family = _with_family;
        let family_member = $('#family_member');

        with_family.on('change', function(){
            if(with_family.prop('checked')){
                _step_3_validation.enableValidator('family', 'notEmpty');
                _step_3_validation.enableValidator('family_member', 'notEmpty');
                $('.family_container').removeClass('d-none');
                family_member.prop('disabled', false);
                _family_member.selectpicker('show');
                _family_member.selectpicker('refresh');
            }else{
                _step_3_validation.disableValidator('family', 'notEmpty');
                _step_3_validation.disableValidator('family_member', 'notEmpty');
                $('.family_container').addClass('d-none');
                family_member.prop('disabled', true);
                _family_member.selectpicker('hide');
                _family_member.selectpicker('refresh');
            }
        });
    }

    var initEventDates = function(){
        axios.get('ajax/event-dates')
            .then(response=>{
                _event_dates =  response.data.data;
                _appointment_datepicker.on('dp.show', function(e){
                    let limit_label = $('#limit_value');
                    let consultation_option = $('#consultation_option')
                    limit_label.text('');

                    _event_dates.some(function(item){
                        let selected_date = moment(item.date_time);
                        let is_weekend = false;

                        switch(selected_date.weekday() ){
                            case 0:
                            case 6:
                                is_weekend = true;
                                break;
                        }

                        if(is_weekend){
                            return false;
                        }else{
                            $('input[name=event_date]').attr('data-id', item.id);

                            limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                            <strong>${item.limit}</strong> ${item.limit === 1?'spot':'spots'}
                                            available for consultation.`);

                            _event_date.val(selected_date.format('YYYY-MM-DD'));

                            if(item.limit < 1){
                                consultation_option.attr('disabled', 'disabled').parent().addClass('radio-disabled');
                                return true;
                            }
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
            });
    };

    var initReactiveFormFields = function () {
        // minimum setup
        _family_member.selectpicker({
            container: 'body',
            style:'form-control-lg form-control-solid',
            styleBase: 'form-control',
        });
        _family_member.selectpicker('hide');
    }

    var initBootstrapCalendar = function(){
        KTApp.block(_datepicker_card.getSelf(), {
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Loading Available Dates...',
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
            let family_members =[];
            for (let pair of formEntries.entries()) {
                if(pair[0] === 'family_member'){
                    family_members.push(pair[1]);
                }else{
                    formData[pair[0]] = pair[1];
                }
            }

            if(family_members.length > 0){
                formData['family_members'] = family_members;
            }

            formData['event_date'] = $('input[name=event_date]').data('id');

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
            _formEl = KTUtil.getById('makeAppointment');
            _family_member =$('#family_member');
            _with_family = $('input[name=with_family]');
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
    DashboardClient.init();
    $('input[name=cell_number]').inputmask('(999) 999-9999');
});
