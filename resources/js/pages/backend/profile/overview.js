"use strict";
var ProfileOverview = function(){

    var validation;
    var _createFamilyForm;
    var handleCreateFamilyGroup = function () {
        validation = FormValidation.formValidation(
            _createFamilyForm,
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
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#createFamilyButton').on('click', function(e) {
            e.preventDefault();
            let submitButton = $(this);
            let formEntries = new FormData(_createFamilyForm);
            let formData = {};

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

                            window.swal.fire({
                                icon: 'error',
                                title: `${error.response.statusText} (${error.response.status })`,
                                text: error.response.data.message,
                            });
                            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Create');
                        });
                }
                else{
                    //Validation Failed
                    submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Create');
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
    }

    var handleSearchMember = function () {
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
        var validateIdNumber = function(idNumber) {
            var checkIDNumber = function(idNumber) {
                var number = idNumber.substring(0, idNumber.length - 1);
                return generateLuhnDigit(number) === +idNumber[idNumber.length - 1];
            };
            var result = {};
            result.valid = checkIDNumber(idNumber);
            return result;
        };
        let btnSendInvite = $('.inviteMember');
        btnSendInvite.on('click', function(ev){
            ev.preventDefault();
            let selected_family = $(this);
            window.swal.fire({
                title: 'Look up Member by ID Number',
                text: 'The Member must already be registered, and have their account verified!',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Look up',
                showLoaderOnConfirm: true,
                preConfirm: (id_number) => {
                    let is_valid = validateIdNumber(id_number);
                    if(!is_valid.valid){
                        swal.fire({
                            icon:  'error',
                            title: 'Invalid RSA ID Number',
                            confirmButtonText: 'Close',
                        })
                        return;
                    }

                    return axios.get(`/profiles/search/${id_number}`)
                        .then(response => {
                            if (response.status !== 200) {
                                throw new Error(response.statusText)
                            }
                            return response.data.profile;
                        })
                        .catch(error => {
                            let message = error.response.status === 501?error.response.data.message:error;
                            swal.showValidationMessage(
                                `${message}`
                            )
                        })
                },
                allowOutsideClick: () => !swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    let message = result.value.user.email_verified_at
                        ? `<b>Active user since:</b>  ${moment(result.value.user.email_verified_at).format('ddd, MMM Do YYYY')}`
                        :'Cannot Invite Unverified user!';
                    let member = result.value;
                    swal.fire({
                        title: `Found ${member.fullname}`,
                        html: `${ message }`,
                        imageUrl: result.value.avatar_url,
                        showCancelButton: true,
                        showConfirmButton: !!result.value.user.email_verified_at,
                        confirmButtonText: 'Send Invite',
                        preConfirm: () => {
                            axios.post(`/families/${selected_family.data('family-id')}/invite`, {
                                member: member.id_number
                            })
                                .then(response => {
                                    if (response.status !== 201) {
                                        throw new Error(response.statusText)
                                    }

                                    swal.fire({
                                        icon:  'success',
                                        title: 'Invite Sent',
                                        html:`${member.fullname} was invited to join: ${ selected_family.data('family-name') }`,
                                        confirmButtonText: 'Close',
                                    })

                                    return response.data.profile;
                                })
                                .catch(error => {
                                    swal.showValidationMessage(
                                        `${error}`
                                    )
                                })
                        },
                    })
                }
            })
        })
    }


    return {
        // public functions
        init: function () {
            _createFamilyForm = KTUtil.getById('createFamilyForm');
            handleSearchMember();
            handleCreateFamilyGroup();
        }
    };
}();

jQuery(document).ready(function(){
    ProfileOverview.init()
})
