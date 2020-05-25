"use strict";
var StatusCreateScript = function(){

    var initStatusCreate = function(){
        FormValidation.formValidation(
            document.getElementById('statusCreateForm'),
            {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    model_type: {
                        validators: {
                            notEmpty: {
                                message: 'Please select 1 option'
                            },
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

            axios.post(form.data('action'), {
                title: $('input[name=title]').val(),
                description: $('textarea[name=description]').val(),
                model_type: $('select[name=model_type]').val(),
                is_active: $('input[name=is_active]').is(':checked')
            })
                .then(function (response) {
                    setTimeout(function() {
                        swal.fire({
                            icon: 'success',
                            title: 'Saved Successfully',
                            text: response.data.message,
                            preConfirm: function(){
                                window.location.replace(response.data.url)
                            }});
                        btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
                        //
                    }, 1000);

                })
                .catch(function (error) {
                    if(error.response.data.code === 409){
                        swal.fire({icon: 'error', title: error.response.data.title,text: error.response.data.message});
                        btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
                        return;
                    }

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
            initStatusCreate();
        }
    };
}();


jQuery(document).ready(function() {
    StatusCreateScript.init();
});
