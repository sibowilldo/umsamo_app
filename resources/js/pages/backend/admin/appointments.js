"use strict";
// Class definition
let AdminAppointmentIndexScript = function () {
    // Private functions
    // Module
    let statuses = [];
    let initUserIndex = function () {
        var $ = jQuery.noConflict();
        var columns = [
            {data: 'reference', name: 'reference'},
            {data: 'event_date.date_time', name: 'event_date.date_time'},
            {data: 'type', name: 'type'},
            {data: 'appointmentable.profile.fullname'},
            {data: 'status_id', name: 'status_id'},
            {data: 'appointmentable.profile.id_number', name: 'appointmentable.profile.id_number'},
            {data: 'appointmentable.email', name: 'appointmentable.email'},
            {data: 'appointmentable.profile.cell_number'},
            {data: 'action', name: 'action'},
        ]
        var table = $('#appointments-table').DataTable({
            dom: 'Brtip',
            processing: true,
            responsive: true,
            serverSide: true,
            ajax:{},
            columns: columns,
            columnDefs: [
                {
                    targets: [5,6,7],
                    visible: false
                },
                {
                    targets: 0,
                    title: 'Reference',
                    render: function (data, type, appointment, meta) {
                        return `
                                <div class="d-flex align-items-center">
                                    <span class="bullet bullet-bar bg-${ appointment.status.color } align-self-stretch pb-10 mr-4"></span>
                                    <div class="font-weight-bolder"> ${appointment.reference }
                                        <span class="font-size-xs text-muted text-uppercase d-block">
                                            User Appointment
                                        </span>
                                    </div>
                                </div> `;
                    }
                },
                {
                    targets: 1,
                    title: 'Date & Type',
                    sortable: false,
                    render: function (data, type, appointment, meta) {
                        return `
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span
                                            class="text-dark-75 d-block text-hover-primary mb-1 font-size-lg">
                                                ${appointment.event_date.date_time }</span>
                                            <span class="text-muted font-weight-bold  d-block">
                                                ${appointment.type}
                                            </span>
                                        </div>
                                    </div>
                                    `;
                    }
                },
                {
                    targets: 2,
                    sortable: false,
                    title: 'Scheduled By',
                    render: function (data, type, appointment, meta) {
                        return `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="${appointment.appointmentable.profile.avatar_url }" alt="${appointment.appointmentable.profile.fullname}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-dark-75 font-size-lg mb-0">
                                             ${appointment.appointmentable.profile.fullname }
                                        </div>
                                        <span class="text-muted d-block">
                                            ${appointment.appointmentable.profile.id_number }
                                        </span>
                                    </div>
                                </div> `
                    }
                },
                {
                    targets: 3,
                    title: 'Contact',
                    sortable: false,
                    render: function (data, type, appointment, meta) {
                        return `
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="text-dark-75 d-blocktext-hover-primary mb-1 font-size-lg">
                                                ${appointment.appointmentable.profile.cell_number }
                                            </span>
                                            <span class="text-muted font-size-sm d-block">
                                                ${appointment.appointmentable.email }
                                            </span>
                                        </div>
                                    </div>`;
                    }
                },
                {
                    targets: 4,
                    sortable: true,
                    title: 'Status',
                    render: function (data, type, appointment, meta) {

                        let options='';
                        data.statuses.map((item)=>{
                            options+=`<option value="${item.id }" ${item.id===appointment.status.id?'selected':''}>${item.title }</option>`;
                        });
                        return `<select class="form-control datatable-input select-picker border-2 border-${appointment.status.color} text-${appointment.status.color}" name="status_id" id="${appointment.uuid}">${options}</select>`;
                    }
                },
                {
                    targets: 8,
                    title: 'Action',
                    sortable: false,
                    render: function (data, type, appointment, meta) {
                        return `
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a href="/appointments/${appointment.uuid}" class="btn btn-icon-btn-clean text-hover-primary"><i class="la la-eye"> </i></a>
                                    </div>`;
                    }
                },
            ],
            initComplete: function () {},
        });
        table.on('change', '.select-picker', (e) =>{
            const status_id = $(e.currentTarget).val();
            const appointment = $(e.currentTarget).attr('id');
            window.axios.patch(`/administrator/appointments/${appointment}/status`, {status_id : status_id})
                .then((response) =>{
                    Toast.fire({
                        icon: 'success',
                        title: response.data.title,
                        text: response.data.message
                    });
                    table.table().draw();
                })
                .catch((error)=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something has went wrong trying to update the status. Details have been logged!'
                    });
                    console.log(error)
                });
        })
        $('#kt_search').on('click', function (e) {
            e.preventDefault();
            var params = {};
            $('.datatable-input').each(function () {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                } else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function (i, val) {
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });
        $('#kt_reset').on('click', function (e) {
            e.preventDefault();
            $('.datatable-input').each(function () {
                $(this).val(null);
                table.column($(this).data('col-index')).search('', false, false);
            });
            $('#filter-status').trigger('change');
            table.table().draw();
        });
        $('#kt_datepicker').datepicker({
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom left",
            format: 'yyyy-mm-dd',
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>',
            },
        });
    };
    return {
        // Public functions
        init: function () {
            initUserIndex();
            $('.filter-select').select2();
        },
    };
}();

jQuery(document).ready(function () {
    AdminAppointmentIndexScript.init();
});
