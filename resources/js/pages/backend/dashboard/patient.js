var DashboardPatientScripts = function () {
    // Private functions
    var initDashboardMakeAppointment = ()=> {
        let btnSubmit = $('.btn-make-appointment');
        btnSubmit.on('click', function(e){
            let btn = $(this);
            e.preventDefault();

            let form = btn.closest('form');
            let event_date = $(`#event_date_${btn.data('id')}`).selectpicker('val');
            let appointment_type = $(`#appointment_type_${btn.data('id')}`).selectpicker('val');

            if(!event_date){
                swal.fire({icon: 'warning', title: 'Request failed',text: 'Please make sure that you have selected a date for your appointment.'});
                return
            }

            KTApp.block(form, {
                overlayColor: '#ffffff',
                state: 'info',
                message: 'Please wait...',
                opacity: 0.7
            });

            axios.post(form.attr('action'), {
                user: $("input[name=_self]").val(),
                event_date: event_date,
                appointment_type: appointment_type
            })
                .then(function (response) {
                    console.log(response.data)
                    setTimeout(function() {
                        swal.fire({
                            icon: 'success',
                            title: response.data.title,
                            text: response.data.message,
                            preConfirm: function(){
                                window.location.replace(response.data.url)
                            }});
                        btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
                        KTApp.unblock(form);
                        //
                    }, 1000);

                })
                .catch(function (error) {
                    console.error(error.response);
                    if(error.response.data.code === 409){
                        swal.fire({icon: 'error', title: error.response.data.title,text: error.response.data.message});
                        return;
                    }

                    swal.fire({icon: 'error', title: error.response.statusText,text: error.response.data.message});
                    setTimeout(function() {
                        KTApp.unblock(form);
                    }, 1000);

                });
        });

        $('select[name=event_date]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            let event_date = $(this);
            let id = event_date.data('id');
            let appointment_types = $(`#appointment_type_${id}`);

            if(event_date.find(':selected').data('limit') < 1){
                appointment_types.find('[value=Consulting]').remove();
                appointment_types.selectpicker('refresh');
            }
            else{
                let optionExist = false;
                appointment_types.find('option').each(function(){
                    if($(this).val() === 'Consulting'){
                        optionExist = true;
                    }
                });
                if(!optionExist){
                    appointment_types.append(`<option value='Consulting'>Consulting</option>`);
                    appointment_types.selectpicker('refresh');
                }
            }
        });

    }


    var initBootstrapSelect = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker({
            container: 'body'
        });
    }

    return {
        // public functions
        init: function() {
            initBootstrapSelect();
            initDashboardMakeAppointment();
        }
    };
}();

jQuery(document).ready(function() {
    DashboardPatientScripts.init();
});
