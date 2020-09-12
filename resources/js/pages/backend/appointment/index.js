"use strict";
// Class definition

var AppointmentIndexScript = function() {
    // Private functions

    // Module
    var initAppointmentIndex = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            layout :{
                scroll:true,
                height: 500,
                spinner: {
                    type: 'loader',
                }
            },
            columns: [
                {
                    field: 'scheduledFor',
                    title: 'SCHEDULED FOR',
                    width: 150
                },
                {
                    field: 'reference',
                    title: 'REFERENCE',
                    type: 'number',
                    autoHide: false,
                    width: 150
                },
                {
                    field: 'status',
                    title: 'STATUS',
                    autoHide: false,
                },
                {
                    field: 'type',
                    title: 'TYPE',
                },
                {
                    field: 'reserved',
                    title: 'RESERVED',
                },
                {
                    field: 'action',
                    title: 'ACTION',
                    textAlign: 'right',
                    sortable: false,
                }
            ],
        });

        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'STATUS');
        });

        $('#kt_datatable_search_type').on('change', function() {
            let selected = $(this).find("option:selected").text().toLowerCase() === 'all' ? null: $(this).find("option:selected").text().toLowerCase();
            datatable.search(selected, 'TYPE');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

        datatable.on('datatable-on-init, datatable-on-layout-updated', function(){
            $('[data-toggle="tooltip"]').tooltip()
        });

        datatable.on('click', '.cancelBtn', function(){
            let cancelBtn = $(this);
            var record = cancelBtn.data("record");
            var url = cancelBtn.data("url");

            swal.fire({
                icon: 'info',
                title: 'Are you sure?',
                text: "Confirm that you would like to cancel this Appointment",
                showCancelButton: true,
                confirmButtonText: 'Yes, Cancel Appointment!',
                cancelButtonText: 'No, Leave it!',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false,
                preConfirm:  function () {
                    return new Promise(function (resolve) {
                        axios.patch(url, {
                            id: record
                        })
                            .then(function (response) {
                                swal.fire({
                                    'icon': 'info',
                                    title: 'Appointment Cancelled Successfully!',
                                    text: response.data.message,
                                    preConfirm: function(){
                                        window.location.replace(response.data.url);
                                    }});
                            })
                            .catch(function (error) {
                                if(error.response.data.code === 409){
                                    swal.fire({icon: 'error', title: error.response.data.title,text: error.response.data.message});
                                    return;
                                }
                                swal.fire({icon: 'error', title: error.response.statusText,text: error.response.data.message});
                            });
                    });
                },
                allowOutsideClick: false
            });
        });
    };

    return {
        // Public functions
        init: function() {
            initAppointmentIndex();
        },
    };
}();

jQuery(document).ready(function() {
    AppointmentIndexScript.init();
});
