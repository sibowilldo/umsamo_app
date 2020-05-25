@extends('layout.auth')


@section('content')
    <!--begin::Signup-->
    <div class="login-form">
        <!--begin: Wizard-->
        <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="false">
            <!--begin: Wizard Nav-->
            <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                <div class="wizard-steps">
                    <!--begin::Wizard Step 1 Nav-->
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <span class="svg-icon svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Address-card.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Personal Details</h3>
                                <div class="wizard-desc">Let us know who you are</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 1 Nav-->
                    <!--begin::Wizard Step 2 Nav-->
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <span class="svg-icon svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white"><use xlink:href="#path-1"/></mask>
                                        <g/>
                                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Account Settings</h3>
                                <div class="wizard-desc">Setup Your Account Details</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 2 Nav-->
                    <!--begin::Wizard Step 3 Nav-->
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                                <span class="svg-icon svg-icon-2x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Like.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Completed!</h3>
                                <div class="wizard-desc">Review, Accept T&Cs and Submit</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 3 Nav-->
                </div>
            </div>
            <!--end: Wizard Nav-->
            <!--begin: Wizard Body-->
            <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                <!--begin: Wizard Form-->
                <div class="row">
                    <div class="offset-xxl-2 col-xxl-8">
                        <form class="form" id="registerForm" data-action="{{ route('register') }}" method="post">
                            <!--begin: Wizard Step 1-->
                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                <h4 class="mb-10 font-weight-bold text-dark">Personal Details</h4>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset('media/users/blank.png')}})">
                                            <div class="image-input-wrapper"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
															<i class="ki ki-bold-close icon-xs text-muted"></i>
														</span>
                                        </div>
                                        <span class="form-text text-muted">We don't really need this.</span>
                                    </div>
                                </div>
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
                                            {{ Form::select('province', \App\Region::$provinces, null, ['class' => 'form-control form-control-solid form-control-lg', 'placeholder' => 'Select a province']) }}
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
                            <!--end: Wizard Step 1-->
                            <!--begin: Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <h4 class="mb-10 font-weight-bold text-dark">Enter your Account Details</h4>
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <input class="form-control form-control-solid form-control-lg" type="email" placeholder="Email" name="email" autocomplete="off" />
                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <input class="form-control form-control-solid form-control-lg" type="tel" placeholder="Cell Phone Number" name="cell_number" autocomplete="on" value="(081) 589-2345"/>
                                    <span class="form-text text-muted">We'll never share your cell phone number with anyone else.</span>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <input class="form-control form-control-solid form-control-lg" type="password" placeholder="Password" name="password" autocomplete="off" />
                                    <div class="progress mx-3" style="height: 2px; margin-top: -3px">
                                        <div id="passwordMeter" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                                    </div>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group mt-15">
                                    <input class="form-control form-control-solid form-control-lg" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" />
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="checkbox mb-0">
                                        <input type="checkbox" name="agree" />I Agree the
                                        <a href="#">terms and conditions</a>.
                                        <span></span></label>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end: Wizard Step 2-->
                            <!--begin: Wizard Step 6-->
                            <div class="pb-5" data-wizard-type="step-content">
                                <!--begin::Section-->
                                <h4 class="mb-10 font-weight-bold text-dark">Review your Details and Submit</h4>
                                <h6 class="font-weight-bolder mb-3">Personal Details:</h6>
                                <div class="text-dark-50 line-height-lg">
                                    <div><span id="UI_first_name"></span></div>
                                    <div><span id="UI_last_name"></span></div>
                                    <div><span id="UI_address"></span></div>
                                    <div><span id="UI_city"></span></div>
                                    <div><span id="UI_province"></span></div>
                                    <div><span id="UI_postal_code"></span></div>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <!--end::Section-->
                                <!--begin::Section-->
                                <h6 class="font-weight-bolder mb-3">Account Settings:</h6>
                                <div class="text-dark-50 line-height-lg">
                                    <div><span id="UI_email"></span></div>
                                    <div><span id="UI_cell_number"></span></div>
                                    <div><span id="UI_agree"></span></div>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end: Wizard Step 6-->
                            <!--begin: Wizard Actions-->
                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                <div class="mr-2">
                                    <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                </div>
                                <div>
                                    <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" id="registerSubmitButton" data-wizard-type="action-submit">Submit</button>
                                    <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Next Step</button>
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
        <!--end: Wizard-->
    </div>
    <!--end::Signup-->
@endsection

@section('styles')
    <style>
        @import '{{ asset('css/pages/wizard/wizard-2.css') }}';
        @media (min-width: 992px){
            .login.login-1 .login-content {
                width: 100%;
                max-width: 100%;
            }
            .login.login-1 .login-content .login-form {
                width: 100%;
                max-width: 95%;
            }
        }

    </style>
@endsection

@section('scripts')

    <!-- Include zxcvbn library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="{{ asset('plugins/custom/formvalidation/plugins/PasswordStrength.js') }}"></script>

    <script>
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
                            $('#UI_first_name').text($('input[name=first_name]').val());
                            $('#UI_last_name').text($('input[name=last_name]').val());
                            $('#UI_address').text($('input[name=address]').val());
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

            let handleAuthRegisterFormSubmit = function(){
                $('#registerSubmitButton').click(function(e) {
                    e.preventDefault();

                    let registerForm = $(_formEl);
                    let formData = {
                        email: $('input[name=email]').val(),
                        password: $('input[name=password]').val(),
                        password_confirmation: $('input[name=password_confirmation]').val(),
                        cell_number: $('input[name=cell_number]').val(),
                        avatar: $('input[name=avatar]').val(),
                        first_name: $('input[name=first_name]').val(),
                        last_name: $('input[name=last_name]').val(),
                        address: $('input[name=address]').val(),
                        city: $('input[name=city]').val(),
                        province: $('select[name=province]').children("option:selected").val(),
                        postal_code: $('input[name=postal_code]').val(),
                    };

                    axios.post(registerForm.data('action'), formData)
                        .then(function (response) {
                            let destination = response.data.url;
                            swal.showLoading();
                            swal.fire({
                                title: 'Register Success',
                                text: 'Redirecting...',
                                icon: 'success',
                                timer: 2000,
                                onOpen: function (){
                                    swal.showLoading();
                                }
                            })
                                .then(function(){
                                    window.location.replace(destination);
                                });
                        })
                        .catch(function (error) {
                            let errorBag = error.response.data.errors
                            let error_messages='';
                            console.log('error', errorBag);
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
                    _formEl = KTUtil.getById('registerForm');

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
@endsection

