@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ $page_title }} list</h3>
            </div>
        </div>
        <div class="alert alert-custom alert-warning fade show rounded-0" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Under Development!</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <form class="kt-form kt-form--fit mb-15">
                <div class="row mb-6">
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Reference:</label>
                        <input type="text" class="form-control datatable-input" placeholder="E.g: SLF-000-AB12"
                               data-col-index="0"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Email Address:</label>
                        <input type="email" class="form-control datatable-input" placeholder="E.g: karabo88@example.com"
                               data-col-index="5"/>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Type:</label>
                        <select class="form-control datatable-input filter-select" data-col-index="3" data-placeholder="Select">
                            <option value="">Select</option>
                            <option value="{{ \App\Appointment::TYPE_CONSULTING }}">Consulting</option>
                            <option value="{{ \App\Appointment::TYPE_CLEANSING }}">Cleansing</option>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <label>Status:</label>
                        <select id="filter-status" class="form-control datatable-input filter-select" data-col-index="6"  data-placeholder="Select">
                            <option value="">Select</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{ $status->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-lg-6 mb-lg-0 mb-6">
                        <label>Scheduled Between:</label>
                        <div class="input-daterange input-group" id="kt_datepicker">
                            <input type="text" class="form-control datatable-input" name="start" placeholder="From"
                                   data-col-index="1"/>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-ellipsis-h"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control datatable-input" name="end" placeholder="To"
                                   data-col-index="1"/>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-lg-0 mb-6">
                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                <span>
                                    <i class="la la-search"></i>
                                    <span>Search</span>
                                </span>
                                </button>&#160;&#160;
                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                <span>
                                    <i class="la la-close"></i>
                                    <span>Reset</span>
                                </span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!--begin: Datatable-->
            {!! $dataTable->table() !!}
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>

    <script>
        "use strict";
        // Class definition
        let UserIndexScript = function () {
            // Private functions
            // Module
            let statuses = [];
            let initUserIndex = function () {
                var $ = jQuery.noConflict();
                var columns = [
                    {data: 'appointment.reference', name: 'appointment.reference'}, //0
                    {data: 'appointment'}, //1
                    {data: 'family'}, //2
                    {data: 'appointment.type'}, //3
                    {data: 'user'},//4
                    {data: 'user.email'},//5
                    {data: 'status_id', name: 'status_id'},//6
                    {data: 'appointment.type'},//7
                    {data: 'action'}//8
                ]
                var table = $('#familyappointmentsdatatable-table').DataTable({
                    dom: 'Brtip',
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ajax:{},
                    columns: columns,
                    columnDefs: [
                        {
                            targets: [2,5,6,7],
                            visible: false
                        },
                        {
                            title: 'Reference',
                            targets: [0],
                            render: (data, type, row, meta) => {
                                return `
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column text-left">
                                            <span class="text-dark-75 font-weight-bolder">${data}</span>
                                            <div class="text-muted font-weight-bold">${row.family.name}</div>
                                        </div>
                                    </div>
                                    `
                            }
                        },
                        {
                            title: 'Date & Type',
                            targets: [1],
                            render: (data, type, appointment, meta) => {
                                return `
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span
                                            class="text-dark-75 d-block text-hover-primary mb-1 font-size-lg">
                                                ${appointment.appointment.event_date.date_time }</span>
                                            <span class="text-muted font-weight-bold  d-block">
                                                ${appointment.type }
                                            </span>
                                        </div>
                                    </div>
                                `
                            }
                        },
                        {
                            title: 'Family Member',
                            targets: [4],
                            render: (data, type, row, meta) => {
                                return `
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-success mr-2">
                                            <img alt="${data.profile.fullname}" src="${data.profile.avatar_url}"/>
                                        </div>
                                        <div class="d-flex flex-column text-left">
                                            <span class="text-dark-75 font-weight-bold">${data.profile.fullname}</span>
                                            <span class="text-muted font-weight-bold">${data.profile.id_number}</span>
                                        </div>
                                    </div>
                                `
                            }
                        },
                        {
                            title: 'Contact Details',
                            targets: [3],
                            render: function (data, type, row, meta) {
                            return `
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="text-dark-75 d-blocktext-hover-primary mb-1 font-size-lg">
                                            ${row.user.profile.cell_number }
                                        </span>
                                        <span class="text-muted font-size-sm d-block">
                                            ${row.user.email }
                                        </span>
                                    </div>
                                </div>`;
                            }
                        },
                        {
                            targets: 8,
                            title: 'Action',
                            sortable: false,
                            render: function (data, type, appointment, meta) {
                                return `
                                    <div class="d-flex align-items-center justify-content-start">
                                        <a href="/appointments/${appointment.appointment.uuid}" class="btn btn-icon-btn-clean text-hover-primary"><i class="la la-eye"> </i></a>
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
                    // $('.filter-select').select2();
                },
            };
        }();

        jQuery(document).ready(function () {
            UserIndexScript.init();
        });

    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}">
    <style>
        .datepicker {
            width: 320px;
        }
    </style>
@endsection

