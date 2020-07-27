"use strict";
// Class definition
var UserIndexScript = function () {
    // Private functions

    // Module
    var initUserIndex = function () {
        var $ = jQuery.noConflict();
        var columns = [
            {data: 'profile.id_number', name: 'profile.id_number'},
            {data: 'profile.fullname', name: 'profile.last_name'},
            {data: 'email', name: 'email'},
            {data: 'profile.cell_number', name: 'profile.cell_number'},
            {data: 'profile.province', name: 'profile.province'},
            {data: 'created_at', name: 'created_at'},
            {data: 'is_locked', name: 'is_locked', responsivePriority: -1},
            {data: 'action', orderable:false, searchable:false},
        ]
        var table = $('#users-table').DataTable({
            dom: 'lrtip',
            processing: true,
            responsive: true,
            serverSide: true,
            ajax: {
                url:'/ajax/users',
                data: function(d){
                    let range = [];
                    let start = $('input[name=start]').val();
                    let end = $('input[name=end]').val();
                    start?range.push(moment(start).format('YYYY-MM-DD HH:mm:ss')):'';
                    end?range.push(moment(end + ' 23:59:59').format('YYYY-MM-DD HH:mm:ss')):'';
                    d.joined_between = range;
                }
            },
            columns: columns,
            columnDefs: [
                {
                    targets:[0,3],
                    searchable: true,
                    visible: false
                },
                {
                    targets: 1,
                    title: 'Patient',
                    render: function (data, type, user, meta) {
                        return `
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 flex-shrink-0">
                                            <img src="${user.profile.avatar}" alt="${user.profile.fullname}">
                                        </div>
                                        <div class="ml-3">
                                            <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">${user.profile.fullname}</span>
                                            <div class="text-muted text-hover-primary">${user.profile.id_number}</div>
                                        </div>
                                    </div>`;
                    }
                },
                {
                    targets: 2,
                    title: 'Contact',
                    render: function (data, type, user, meta) {
                        return `
                                    <div>
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">${user.profile.cell_number}</span>
                                        <a class="text-primary font-size-sm text-hover-dark" href="mailto:${user.email}">${user.email}</a>
                                    </div>`
                    }
                },
                {
                    targets: 4,
                    title: 'Address',
                    render: function (data, type, user, meta) {
                        return `
                                    <div>
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">${user.profile.province}</span>
                                        <span class="text-muted font-size-sm text-hover-primary">${user.profile.address}</span>
                                    </div>`
                    }
                },
                {
                    targets: 5,
                    title: 'Joined',
                    searchable: false,
                    visible:true,
                    render: function (data, type, user, meta) {
                        return `
                                    <div>
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2"> ${moment(data).fromNow()}</span>
                                        <span class="text-muted font-size-sm text-hover-primary">${user.created_at}</span>
                                    </div>`
                    }
                },
                {
                    targets: 6,
                    title: 'Lock',
                    render: function (data, type, user, meta) {
                        return `
                                    <span class="switch switch-sm switch-icon">
                                        <label>
                                            <input type="checkbox" ${data ? 'checked' : ''} data-user="${user.uuid}" name="lock-user" class="toggle-lock">
                                            <span></span>
                                        </label>
                                    </span>`
                    }
                }
            ],
            initComplete: function () {
                // this.api().columns().every(function() {
                //     var column = this;
                //     switch ($(column.header()).text()) {
                //         case 'Address':
                //             column.data().unique().sort().each(function(d, j) {
                //                 $('.datatable-input[data-col-index="4"]').append(`<option value='${d}'>${d}</option>`);
                //             });
                //             break;
                //     }
                // });
            },
        });

        table.on('click', '.deleteBtn', function(){
            let deleteBtn = $(this);
            var url = deleteBtn.data("url");
            swal.fire({
                icon: 'info',
                title: 'Are you sure?',
                text: "Confirm that you would like to Delete this user.",
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'No, Leave it!',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false,
                preConfirm:  function () {
                    return new Promise(function (resolve) {
                        axios.delete(url)
                            .then(function (response) {
                                swal.fire({
                                    'icon': 'info',
                                    title: 'User Deleted Successfully!',
                                    text: response.data.message,
                                    preConfirm: function(){
                                        table.draw();
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

        table.on('change', '.toggle-lock', function(){
            let user = $(this).data('user');
            axios.patch(`ajax/users/toggle-lock/${user}`)
                .then(function(response){
                    Toast.fire({
                        icon: 'success',
                        title: response.data.title,
                        text: response.data.message
                    });
                })
                .catch(function(error){
                    Toast.fire({
                        icon: 'error',
                        title: error.response.statusText,
                        text: error.response.data.message
                    });
                });
        })

        $('#kt_search').on('click', function(e) {
            e.preventDefault();
            var params = {};
            $('.datatable-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();
        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.table().draw();
        });

        $('#kt_datepicker').datepicker({
            todayHighlight: true,
            autoclose:true,
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
        },
    };
}();

jQuery(document).ready(function () {
    UserIndexScript.init();
});
