"use strict";
// Class definition

var RegionIndexScript = function() {
    // Private functions

    // demo initializer
    var initRegionIndex = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            data: {
                saveState: {cookie: true},
            },
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            layout :{
                theme: 'default',
                class: 'datatable-brand',
                spinner: {
                    type: 'loader',
                    opacity: 0,
                    state: 'brand'
                }
            },
            rows: {
                autoHide: false
            },
            columns: [
                {
                    field: 'REGION',
                    title: 'Region',
                    autoHide: false,
                },
                {
                    field: 'LOCATION DETAILS',
                    title: 'Location Details',
                    autoHide: false,
                    width: 380
                },
                {
                    field: 'CREATED',
                    title: 'Created',
                    autoHide: true,
                    type: 'date',
                    format: 'YYYY-MM-DD',
                },
                {
                    field: 'ACTION',
                    title: 'Action',
                    width: 200,
                    textAlign: 'center',
                    sortable: false,
                    autoHide: false,
                    locked: {right: 'lg'}
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
            initRegionIndex();
        },
    };
}();

jQuery(document).ready(function() {
    RegionIndexScript.init();

    // $('[data-toggle="tooltip"]').tooltip();
});
