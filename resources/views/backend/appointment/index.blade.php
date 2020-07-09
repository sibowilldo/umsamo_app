@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Appointments</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="kt_datatable_search_status" class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->title }}">{{ $status->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="kt_datatable_search_event" class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                    <select class="form-control" id="kt_datatable_search_type">
                                        <option value="">All</option>
                                        @foreach($appointment_types as $appointment_type)
                                            <option value="{{ $appointment_type['id'] }}">{{ $appointment_type['title'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--begin: Datatable-->
            <table class="table table-head-bg table-borderless table-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th data-field="scheduledFor">SCHEDULED FOR</th>
                    <th data-field="reference">REFERENCE</th>
                    <th data-field="status">STATUS</th>
                    <th>TYPE</th>
                    <th>RESERVED</th>
                    <th class="text-right" data-field="action">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="pl-3 py-8">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                <div>
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('D M d, Y') }}</a>
                                    <span class="text-muted d-block">{{ $appointment->event_date->date_time->diffForHumans() }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bolder">{{ $appointment->reference }} <span class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span></div>
                        </td>
                        <td>
                        <span>
                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">
                        {{ $appointment->status->title }}</span>
                        </span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title'] }}</span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end" aria-label="Available Actions">
                                <a href="{{ route('appointments.show', $appointment->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">
                                    {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View
                                </a>
                                @if(!$appointment->status->cancelled)
                                    <button type="button" class="btn btn-light btn-hover-danger btn-sm cancelBtn ml-3" data-url="{{route('appointments.cancel', $appointment->uuid)}}" data-record="{{ $appointment->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">
                                        <span class="ml-1">{{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}Cancel</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                @foreach($user->families as $family)
                    @foreach($family->appointments as $appointment)
                    <tr>
                        <td class="pl-3 py-8">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>
                                <div>
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('D M d, Y') }}</a>
                                    <span class="text-muted d-block">{{ $appointment->event_date->date_time->diffForHumans() }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bolder">{{ $appointment->reference }} <span class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span></div>
                        </td>
                        <td>
                        <span>
                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">
                            {{ $appointment->status->title }}</span>
                        </span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</span>
                        </td>
                        <td>
                            <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end" aria-label="Available Actions">
                                <a href="{{ route('appointments.show', $appointment->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">
                                    {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View
                                </a>
                                @if(!$appointment->status->cancelled || $appointment->has_passed)
                                    <button type="button" class="btn btn-light btn-hover-danger btn-sm cancelBtn ml-3" data-url="{{route('appointments.cancel', $appointment->uuid)}}" data-record="{{ $appointment->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">
                                        <span class="ml-1">{{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}Cancel</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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

    </script>
{{--    <script src="{{ asset('js/pages/backend/appointment/index.js') }}" type="text/javascript" defer></script>--}}
@endsection

@section('styles')
@endsection

