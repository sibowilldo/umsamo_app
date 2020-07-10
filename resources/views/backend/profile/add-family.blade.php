@extends('layout.default')

@section('mobile-toggle')
    <button class="mr-4 d-inline-block d-lg-none btn btn-light-success" id="kt_subheader_mobile_toggle">
        <span></span>
        {{ Metronic::getSVG('media/svg/icons/Navigation/Arrow-from-left.svg') }}
    </button>
@endsection

@section('content')

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
                    @include('backend.profile.common._side-bar')
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    @include('backend.family._create')
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@stop

@section('scripts')
    <script src="{{ asset('js/pages/backend/profile/offcanvas.js') }}"></script>
    <script>
        "use strict";
        // Class definition
        var initCreateFamily = function () {

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
                return result;
            };

            var validation;

            var _createFamilyForm;
            let handleFormSubmit = function(){
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validation = FormValidation.formValidation(_createFamilyForm,
                    {
                        fields: {
                            'name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Family name is required'
                                    }
                                }
                            },
                            'search_for': {
                                validators: {
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
                                                return is_valid.valid;
                                            }else{
                                                return false;
                                            }
                                        }
                                    }
                                }
                            },
                            'members[]':{
                                validators: {
                                    choice: {
                                        max: 8,
                                        message: 'For now you can only select up to 8 other members'
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

                $('#createFamilySubmitButton').on('click', function(e) {
                    e.preventDefault();
                    let submitButton = $(this);
                    let formEntries = new FormData(_createFamilyForm);
                    let formData = {};
                    return;
                    for (let pair of formEntries.entries()) {
                        formData[pair[0]] = pair[1];
                    }

                    submitButton.attr('disabled', 'disabled');
                    submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');

                    validation.validate().then(function(status) {
                        if(status === 'Valid'){
                            window.axios.post($(_createFamilyForm).attr('action'), formData)
                                .then(function (response) {
                                    let destination = response.data.redirect_url;
                                    window.swal.showLoading();
                                    window.swal.fire({
                                        title: response.data.title,
                                        text: response.data.message,
                                        icon: 'success',
                                        timer: 2000,
                                        onOpen: function (){
                                            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Save Changes');
                                            window.swal.showLoading();
                                        }
                                    })
                                        .then(function(){
                                            window.location.replace(destination);
                                        });
                                })
                                .catch(function (error) {
                                    if(error.response.data.message === "CSRF token mismatch"){
                                        submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Save Changes');
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
            let handleReactiveInputs = function(){
                $('input[name=search_for]').on('input', function(){
                    let _input = $(this);
                    let _inputValue = _input.val();
                    let _selectedMember = {};
                    if( _inputValue.length === 13){
                       let is_validId = extractFromID(_inputValue);
                       if(is_validId){
                           let _member=[];
                           axios
                               .get(`/profiles/search/${_inputValue}`)
                               .then(function(response){
                                   let profile = response.data.profile;
                                    _member[profile.id] = profile.fullname;
                                })
                               .catch(function (error) {
                                   console.log(error.response)
                               });//catch axios
                       } //end if
                    }
                });
            };
            return {
                // public functions
                init: function() {
                    _createFamilyForm = KTUtil.getById('createFamilyForm');
                    handleFormSubmit();
                    handleReactiveInputs();
                }
            };
        }();

        jQuery(document).ready(function() {
            initCreateFamily.init();
        });

    </script>
@stop
