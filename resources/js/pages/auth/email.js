"use strict"
var RequestPasswordReset = function(){
    var initFormSubmit = function(){
        let submitButton = $('button[type=submit]');
        let form = submitButton.closest('form');
        submitButton.on('click', function(ev){
            ev.preventDefault();

            submitButton.prop('disabled', true);
            submitButton.text('Sending Reset Link...').addClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').removeClass('px-8 btn-primary');

            window.axios.post(form.attr('action'), {
                email: $('input[name=email]').val()
            })
                .then(response =>{
                    $('#message').html(response.data.message).removeClass('d-none');
                    $('input[name=email]').val('')
                    submitButton.prop('disabled', false);
                    submitButton.text('Send Password Reset Link').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
                })
                .catch(err =>{
                    let error = err.response
                    window.swal.fire({
                        icon: 'error',
                        title: error.data.message,
                        text: error.data.errors.email[0],
                    }).then(()=>{
                        submitButton.prop('disabled', false);
                        submitButton.text('Send Password Reset Link').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
                    })
                })

        })
    }

    return {
        init: function() {
            initFormSubmit();
        }
    };
}()
jQuery(document).ready(function(){
    RequestPasswordReset.init();
});
