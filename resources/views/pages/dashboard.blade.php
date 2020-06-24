{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    @hasanyrole('administrator|kingpin')
        <div class="row mb-10">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body py-0">
                    <div class="wizard wizard-3" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="false">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>1.</span>Appointment Date</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>2.</span>Patient Details</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>3.</span>Family Details</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>4.</span>Review Details and Submit</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="wizard-body px-18 py-8 py-lg-6">
                            <!--begin: Wizard Form-->
                            <div class="row">
                                <div class="col-xxl-12">
                                    <form class="form" id="registerPatientForm" method="post" action="{{ route('appointments.store') }}">
                                        {{--@csrf--}}
                                        <!--begin: Wizard Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <!--begin::Section-->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="card card-stretch min-h-300px" id="datepicker-card">
                                                            <div class="card-body p-5">
                                                                <div class="datepicker"></div>
                                                                <span class="form-text text-muted pt-3">If all dates are not selectable, please load dates in the events section, or report the issue</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="appointment_type" class="font-weight-bolder">Select Appointment Date from Calendar:</label>
                                                        <input type="text" name="event_date" data-id="" class="form-control form-control-solid mb-5" value="" placeholder="" readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="radio-list">
                                                            <label for="appointment_type" class="font-weight-bolder">Select Appointment Type:</label>
                                                            <label class="radio">
                                                                <input type="radio" name="appointment_type" value="Cleansing"/>  Cleansing
                                                                <span></span>
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio" id="consultation_option" name="appointment_type" value="Consulting"/> Consultation
                                                                <span></span>
                                                            </label>
                                                            <span class="form-text text-info" id="limit_value"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end: Wizard Step 1-->
                                        <!--begin: Wizard Step 2-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Enter the Patient's Details</h4>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <!--begin::Input-->
                                                    <div class="form-group ">
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="id_number" placeholder="RSA ID Number" value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-solid form-control-lg" readonly name="date_of_birth" placeholder="Date of Birth" value="" />
                                                    </div>
                                                    <!--end::Input-->

                                                    <div class="row">
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                            <!--begin::Input-->
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-solid form-control-lg" name="first_name" placeholder="First Name" value="" />
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                            <!--begin::Input-->
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-solid form-control-lg" name="last_name" placeholder="Last Name" value="" />
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>

                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <div class="radio-inline">
                                                            <label class="radio">
                                                                <input type="radio" name="gender" value="M"/> Male
                                                                <span></span>
                                                            </label>
                                                            <label class="radio">
                                                                <input type="radio" name="gender" value="F"/> Female
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-lg-3">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <input class="form-control form-control-solid form-control-lg" type="email" placeholder="Email" name="email" autocomplete="off" />
                                                    </div>
                                                    <!--end::Form group-->
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <input class="form-control form-control-solid form-control-lg" type="tel" placeholder="Cell Phone Number" name="cell_number" autocomplete="on" value=""/>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                                <div class="col-lg-4">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="address" placeholder="Street Address" value="" />
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" value="" />
                                                    </div>
                                                    <!--end::Input-->
                                                    <div class="row">
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                            <!--begin::Input-->
                                                            <div class="form-group">
                                                                {{ Form::select('province', $provinces, null, ['class' => 'form-control text-dark form-control-solid kt-selectpicker']) }}
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                            <!--begin::Input-->
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-solid form-control-lg" name="postal_code" placeholder="Postal Code" value="" />
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 2-->
                                        <!--begin: Wizard Step 3-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Setup the Patient's Family Account</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="with_family" value="Yes"/> The Appointment is for a Family
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Input-->
                                                    <div class="form-group animated" style="display: none">
                                                        <label>Family Name</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="family_name" placeholder="Enter the Family Name" value="" disabled="disabled"/>
                                                        <span class="help-block text-success">Other members of the family can only be added by the creator of the Family Account.</span>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 3-->
                                        <!--begin: Wizard Step 4-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Review Patient Details and Submit</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Field</th>
                                                            <th scope="col">Value</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="review_info">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 4-->
                                        <!--begin: Wizard Actions-->
                                        <div class="d-flex justify-content-between pb-10">
                                            <div class="mr-2">
                                                <button class="btn btn-light-primary font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-prev">Previous</button>
                                            </div>
                                            <div>
                                                <button id="make_appointment" class="btn btn-success font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-submit">Submit</button>
                                                <button id="next_step" class="btn btn-primary font-weight-bold text-uppercase font-weight-bolder" data-wizard-type="action-next">Next Step</button>
                                            </div>
                                        </div>
                                        <!--end: Wizard Actions-->
                                    </form>
                                </div>
                                <!--end: Wizard-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->

                    </div>
                </div>
            </div>

        </div>
    </div>
    @else
        <div class="row">
            @include('pages.widgets._dashboard-events')
        </div>
    @endhasanyrole
    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-8 col-xxl-8">
            @include('pages.widgets._user-upcoming', ['class' => 'card-stretch gutter-b'])
        </div>
        <div class="col-lg-4 col-xxl-4">
            @include('pages.widgets._comments', ['class' => 'card-stretch gutter-b'])
        </div>
    </div>
@endsection

{{-- Styles Section--}}
@section('styles')

    <link type="text/css" rel="stylesheet" href="{{ asset('css/pages/wizard/wizard-3.css') }}"/>
@endsection
{{-- Scripts Section --}}
@section('scripts')

@hasanyrole('administrator|kingpin')
<script>
    "use strict";

    // Class definition
    var KTWizard2 = function () {
        // Base elements
        var _wizardEl;
        var _formEl;
        var _wizard;
        var _validations = [];
        var appointment_datepicker = $('.datepicker');
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
                            appointment_datepicker.datetimepicker(_datepicker_options);
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

            appointment_datepicker.datetimepicker(_datepicker_options);
            KTApp.unblock(_datepicker_card.getSelf());

            appointment_datepicker.on('dp.change', function(e){
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
                                // window.location.replace(response.data.url);
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

</script>
@else
        <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/pages/backend/dashboard/patient.js') }}" type="text/javascript"></script>
@endhasanyrole
@endsection
