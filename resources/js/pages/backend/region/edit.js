
"use strict";
var RegionEditScript = function(){

    var initRegionEdit = function(){
        FormValidation.formValidation(
            document.getElementById('regionEditForm'),
            {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    description: {
                        validators: {
                            notEmpty: {
                                message: 'Description is required'
                            }
                        }
                    },
                    contact_number: {
                        validators: {
                            notEmpty: {
                                message: 'Contact number is required'
                            },
                            phone: {
                                country: 'ZA',
                                message: 'The value is not a valid phone number'
                            }
                        }
                    },
                    province: {
                        validators: {
                            notEmpty: {
                                message: 'Please select an option'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                }
            }
        ).on('core.form.valid', function(){
            let btn = $('#submitForm');
            let form = btn.closest('form');

            btn.addClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', true);

            var showErrorMsg = function(form, type, msg) {
                var alert = $(`
                            <div class="alert alert-${type} alert-dismissible alert-custom alert-primary fade show" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text"> ${msg}</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>`);

                form.find('.alert').remove();
                alert.prependTo(form);
            }

            axios.patch(form.data('action'), {
                name: $('input[name=name]').val(),
                description: $('textarea[name=description]').val(),
                contact_number: $('input[name=contact_number]').val(),
                province: $('select[name=province]').val(),
                address: $('input[name=address]').val(),
                longitude: $('input[name=longitude]').val(),
                latitude: $('input[name=latitude]').val(),
            })
                .then(function (response) {
                    setTimeout(function() {
                        swal.fire({
                            icon: 'success',
                            title: 'Updated Successfully',
                            text: response.data.message,
                            preConfirm: function(){
                                window.location.replace(response.data.url);
                            }});
                        btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
                        //
                    }, 1000);

                })
                .catch(function (error) {
                    let errorBag = error.response.data.errors
                    var error_messages='';
                    Object.entries(errorBag).forEach(function(item, index){
                        error_messages += '<div>' + item[1][0] + '</div>';
                    });
                    showErrorMsg(form, 'danger', error_messages);
                    setTimeout(function() {
                        btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
                    }, 1000);

                })
        });
    }

    return {
        init: function(){
            $('.selectpicker').selectpicker();
            initRegionEdit();
        }
    };
}();


jQuery(document).ready(function() {
    RegionEditScript.init();
    $('input[name=contact_number]').inputmask('(999) 999-9999');
});
