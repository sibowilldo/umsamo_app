{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
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
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="wizard-body px-18 py-8 py-lg-6">
                            <!--begin: Wizard Form-->
                            <div class="row">
                                <div class="col-xxl-12">
                                    <form class="form" id="registerPatientForm">
                                        <!--begin: Wizard Step 1-->
                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                            <!--begin::Section-->
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class id="kt_datepicker_6"></div>
                                                </div>
                                            </div>
                                            <div class="row d-none">
                                                @foreach($events as $event)
                                                    <div class="col-sm">
                                                        <p class="font-weight-bold text-dark-75 text-uppercase mb-5 border-2 border-bottom border-bottom-{{ $event->status->color }} pb-5">
                                                            {{$event->title }}</p>
                                                        <!--begin::Input-->
                                                        <div class="form-group">
                                                            <div class="radio-list">
                                                                @foreach($event->event_dates as $event_date)
                                                                    <label class="radio radio-rounded ">
                                                                        <input type="radio" name="event_date" value="{{ $event_date->id }}"/> {{ $event_date->date_time->format('M d, Y') }}
                                                                        <span></span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Enter the Patient's Details</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
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
                                                <div class="col-lg-6">
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
                                                        <div class="col-xxl-8 col-xl-8 col-lg-8">
                                                            <!--begin::Input-->
                                                            <div class="form-group">
                                                                {{ Form::select('province', $provinces, null, ['class' => 'form-control text-dark form-control-solid kt-selectpicker']) }}
                                                            </div>
                                                            <!--end::Input-->
                                                        </div>
                                                        <div class="col-xxl-4 col-xl-4 col-lg-4">
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
                                        <!--end: Wizard Step 1-->
                                        <!--begin: Wizard Step 2-->
                                        <!--end: Wizard Step 2-->
                                        <!--begin: Wizard Step 3-->
                                        <div class="pb-5" data-wizard-type="step-content">
                                            <h4 class="mb-10 font-weight-bold text-dark">Setup the Patient's Family Account</h4>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="create_later"/> The Patient will create the Family Account
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label>Family Name</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="name" placeholder="Enter the Family Name" value="" />
                                                        <span class="form-text text-success">Other members of the family can only be added by the creator of the Family Account.</span>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end: Wizard Step 3-->
                                        <!--begin: Wizard Actions-->
                                        <div class="d-flex justify-content-between pb-10">
                                            <div class="mr-2">
                                                <button class="btn btn-light-primary font-weight-bold text-uppercase" data-wizard-type="action-prev">Previous</button>
                                            </div>
                                            <div>
                                                <button class="btn btn-success font-weight-bold text-uppercase" data-wizard-type="action-submit">Submit</button>
                                                <button class="btn btn-primary font-weight-bold text-uppercase" data-wizard-type="action-next">Next Step</button>
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
    {{-- Dashboard 1 --}}
    <div class="row">
        @include('pages.widgets._dashboard-events')
    </div>
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
{{--    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>--}}
{{--    <script src="{{ asset('js/pages/backend/dashboard/dashboard-client.js') }}" type="text/javascript"></script>--}}

<script>
    "use strict";

    // Class definition
    var KTWizard2 = function () {
        // Base elements
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
                        event_date:{
                            validators :{
                                notEmpty: {
                                    message: 'Please select a date!'
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

        var initBootstrapCalendar = function(){
            var arrows;
            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }
            // inline picker
            $('#kt_datepicker_6').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                templates: arrows
            });
        }

        return {
            // public functions
            init: function () {
                _wizardEl = KTUtil.getById('kt_wizard_v2');
                _formEl = KTUtil.getById('registerPatientForm');

                initWizard();
                initValidation();
                handleAuthRegisterFormSubmit();
                initBootstrapSelect();
                initBootstrapCalendar();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTWizard2.init();
        $('input[name=cell_number]').inputmask('(999) 999-9999');
    });

</script>
@endsection
