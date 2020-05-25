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

        datatable.on('click', '.deleteBtn', function(){
            let deleteBtn = $(this);
            var record = deleteBtn.data("record");
            var url = deleteBtn.data("url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal.fire({
                title: 'Are you sure?',
                text: "Confirm that you would like to delete this entry",
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                showLoaderOnConfirm: true,
                preConfirm:  function () {
                    return new Promise(function (resolve) {
                        $.ajax({
                            url: url,
                            type: 'delete',
                            data: {
                                "id": record,
                                "_token": token
                            }
                        })
                            .done(function (response) {
                                swal.fire({
                                    'icon': 'info',
                                    title: 'Deleted!',
                                    text: response.message,
                                    onClose: function () {
                                        window.location.href = response.url;
                                    }
                                });
                            })
                            .fail(function () {
                                swal('Oops...', 'Something went wrong with ajax !', 'error');
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
