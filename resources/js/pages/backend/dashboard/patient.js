"use strict";
// Class definition
var DashboardClient = function () {
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
    let _family_member;
    let _formEl;
    let _step_1_validation;
    let _step_3_validation;
    let _with_family;
    let _wizardEl;
    let _wizard;
    let _validations = [];

    let _chart;
    let _chartValue = 0;
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

            if(!_with_family.prop('checked')){
                _step_3_validation.disableValidator('family_member', 'notEmpty');
                $('input[name=family]').length?_step_3_validation.disableValidator('family', 'notEmpty'):'';
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
                        if(pair[0]  === "appointment_type"){
                            output +=`<tr><th scope="row">${pair[0].toUpperCase().replace(/_/g, ' ')}</th><td>${$('select[name=appointment_type]').find(':selected').data('value')}</td></tr>`
                        }else
                        if(pair[1]!=="" && pair[0] !== "_token"){
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
                $('input[name=family]').length?_step_3_validation.enableValidator('family', 'notEmpty'):'';
                _step_3_validation.enableValidator('family_member', 'notEmpty');
                $('.family_container').removeClass('d-none');
                family_member.prop('disabled', false);
                _family_member.selectpicker('show');
                _family_member.selectpicker('refresh');
            }else{
                $('input[name=family]').length?_step_3_validation.disableValidator('family', 'notEmpty'):'';
                _step_3_validation.disableValidator('family_member', 'notEmpty');
                $('.family_container').addClass('d-none');
                family_member.prop('disabled', true);
                _family_member.selectpicker('hide');
                _family_member.selectpicker('refresh');
            }
        });
    }

    var initEventDates = function(){
        let consultation_option = $('#consulting_option');
        let available_spaces = 0;
        axios.get('ajax/event-dates')
            .then(response=>{
                _event_dates =  response.data.data;
                _appointment_datepicker.on('dp.show', function(e){
                    let limit_label = $('#limit_value');
                    limit_label.text('');
                    _event_dates.some(function(item){
                        available_spaces =  item.limit - (item.confirmed_appointments_count < 0?0:item.confirmed_appointments_count);
                        let selected_date = moment(item.date_time);
                        $('input[name=event_date]').attr('data-id', item.id);
                        limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                        <strong>${available_spaces}</strong> ${available_spaces === 1?'spot':'spots'}
                                        available for consultation.`);
                        _event_date.val(selected_date.format('YYYY-MM-DD'));
                        _chartValue = Math.ceil(100-((available_spaces/item.limit)*100));
                        _chart.updateSeries([_chartValue])
                        $('#date_chart_label').html(`<b class="text-info d-block">${selected_date.format('MMM DD, YYYY')}</b> is ${_chartValue}% full for Consultation Appointments`)

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
                console.log(error)
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
    }

    //
    var initChart = function() {

        const _chartElement = document.getElementById("consultation_chart");
        let _chartOptions =  {
            series: [0],
            chart: {
                height: 270,
                type: 'radialBar',
                offsetY: -20,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 1000,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 1200
                    }
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    hollow: {
                        margin: 0,
                        size: '70%',
                        background: '#fff',
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 0,
                            left: 0,
                            blur: 10,
                            opacity: 0.1
                        }
                    },
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                            color: undefined,
                            fontWeight: 500,
                            offsetY: 70
                        },
                        value: {
                            offsetY:0,
                            fontSize: '30px',
                            fontWeight: 900,
                            color: undefined,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#F64E60'],
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                },
            },
            colors: ['#1BC5BD'],
            stroke: {
                lineCap: 'round',
                dashArray: 0,
            },
            labels: ["Full"]
        };
        if (!_chartElement) {
            return;
        }

        _chart = new ApexCharts(_chartElement, _chartOptions);
        _chart.render();
    }

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
                    _chartValue = Math.ceil(100-((available_spaces/item.limit)*100));
                    _chart.updateSeries([_chartValue])
                    if(available_spaces < 1){
                        _consultation_full_message_alert.removeClass('d-none flipOutX').addClass('flipInX');
                        _consultation_full_message_alert.find('.alert-text')
                            .html(`<b>${selected_date.format('MMM DD, YYYY')}</b> ${_consultation_full_message}`);
                        _appointment_type_select.selectpicker('val','');
                        _consultation_option.attr('disabled', 'disabled').attr('data-subtext', 'DISABLED: No Spots Available');
                        _appointment_type_select.selectpicker('refresh');
                        return selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD');
                    }
                    _event_date.val(e.date.format('YYYY-MM-DD'));
                    $('#date_chart_label').html(`<b class="text-info d-block">${e.date.format('MMM DD, YYYY')}</b>  is ${_chartValue}% full for Consultation Appointments`)
                }else{
                    _consultation_full_message_alert.addClass('flipOutX');
                    _appointment_type_select.selectpicker('val','');
                    _consultation_option.removeAttr('disabled').attr('data-subtext', '');
                    _appointment_type_select.selectpicker('refresh');
                }
            })
        });
    }

    var handleAuthRegisterFormSubmit = function(){
        let submitButton = $('#make_appointment');
        submitButton.on('click',(e) => {
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
                            if(response.data.url){
                                window.location.replace(response.data.url);
                            }
                        });
                })
                .catch(function (error) {
                    submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
                    let error_title='Oops! Unexpected Error Occurred.';
                    let error_messages='Please report this to administrators.';
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
            _family_member =$('#family_member');
            _formEl = KTUtil.getById('makeAppointment');
            _with_family = $('input[name=with_family]');
            _wizardEl = KTUtil.getById('kt_wizard_v2');

            initEventDates();
            initChart();
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
