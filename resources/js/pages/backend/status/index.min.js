"use strict";
// Class definition

var StatusIndexScript = function() {
    // Private functions

    // demo initializer
    var initStatusIndex = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            data: {
                saveState: {cookie: true},
            },
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            layout :{
                scroll: true,
                height: 500,
                spinner: {
                    type: 'loader',
                }
            },
            rows: {
                autoHide: false
            },
            columns: [
                {
                    field: '#',
                    title: '#',
                    type: 'number',
                    autoHide: false,
                    width: 30,
                    textAlign: 'center'
                },
                {
                    field: 'STATUS',
                    title: 'Status',
                    autoHide: false,
                    width: 150
                },
                {
                    field: 'ENABLED',
                    title: 'Enabled',
                    autoHide: true,
                    width: 100
                },
                {
                    field: 'DESCRIPTION',
                    title: 'description',
                    autoHide: true,
                    width: 320
                },
                {
                    field: 'ACTION',
                    title: 'Action',
                    width: 200,
                    textAlign: 'right',
                    sortable: false,
                    autoHide: false,
                }
            ],
        });

        datatable.on('datatable-on-init, datatable-on-layout-updated', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        datatable.on('click', '.deleteBtn', function(){
            let deleteBtn = $(this);
            var record = deleteBtn.data("record");
            var url = deleteBtn.data("url");

            swal.fire({
                title: 'Are you sure?',
                text: "Confirm that you would like to delete this entry",
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                showLoaderOnConfirm: true,
                preConfirm:  function () {
                    return new Promise(function (resolve) {
                        axios.delete(url, {
                            id: record
                            })
                            .then(function (response) {
                                swal.fire({
                                    'icon': 'info',
                                    title: 'Deleted!',
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
            initStatusIndex();
        },
    };
}();

jQuery(document).ready(function() {
    StatusIndexScript.init();
});
