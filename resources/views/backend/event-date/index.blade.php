@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Appointments</h3>
            </div>
            @if(false)
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md">
                    {{ Metronic::getSvg('media/svg/icons/Design/PenAndRuller.svg') }}
                </span>Export
                        </button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                    Choose an option:
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="flaticon2-print"></i>
                                </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="far fa-file-pdf"></i>
                                </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                </div>
            @endif
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           id="kt_datatable_search_query"/>
                                    <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label for="kt_datatable_search_status"
                                           class="mr-3 mb-0 d-none d-md-block">Start Date:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        @foreach($all_dates as $date)
                                            <option value="{{ $date->date_time }}">{{ $date->date_time }}</option>
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
                    <th data-field="reference">REFERENCE</th>
                    <th data-field="scheduledBy">SCHEDULED BY</th>
                    <th data-field="date_type">DATE & TYPE</th>
                    <th>CONTACT</th>
                    <th class="text-right" data-field="action">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($event_dates as $event_date)
                    <tr>
                        <td colspan="6">
                            <div class="bg-primary">
                                {{ $event_date->date_time }}
                            </div>
                        </td>

                    </tr>
                    @forelse($event_date->appointments as $appointment)
                        <tr>
                            @if(class_basename($appointment->appointmentable_type) == 'User')
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="font-weight-bolder">{{ $appointment->reference }} <span
                                                class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                            <img class="" src="{{ $appointment->appointmentable->profile->avatar_url }}" alt="{{$appointment->appointmentable->profile->fullname}}"></div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">
                                                {{ $appointment->appointmentable->profile->fullname }}
                                            </div>
                                            <span class="text-muted font-weight-bold">
                                            {{ $appointment->appointmentable->profile->id_number }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('d M, Y') }}</span>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                    <span class="font-weight-bolder d-block">
                                        {{ $appointment->appointmentable->profile->cell_number }}
                                    </span>
                                        <span class="text-muted font-size-sm">
                                        {{ $appointment->appointmentable->email }}
                                    </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-end"
                                         aria-label="Available Actions">
                                        <a href="{{ route('appointments.show', $appointment->uuid) }}"
                                           class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip"
                                           title="View Details">
                                            {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                            View
                                        </a>
                                    </div>
                                </td>
                            @elseif(class_basename($appointment->appointmentable_type) == 'Family')
                                @foreach( $appointment->familyAppointments as $family_appointment )
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="font-weight-bolder">{{ $appointment->reference }} <span
                                                    class="font-size-xs text-muted text-uppercase d-block">Family: {{ $appointment->appointmentable->name}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                                <img class="" src="{{ $family_appointment->user->profile->avatar_url }}" alt="{{ $family_appointment->user->profile->fullname }}"></div>
                                            <div class="ml-4">
                                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">
                                                    {{ $family_appointment->user->profile->fullname }}
                                                </div>
                                                <span class="text-muted font-weight-bold">
                                            {{ $family_appointment->user->profile->id_number }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                        <span
                                            class="text-dark-75 d-block font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('d M, Y') }}</span>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                        <span
                                            class="text-dark-75 d-block font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                            {{ $family_appointment->user->profile->cell_number }}
                                        </span>
                                                <span class="text-muted font-size-sm">
                                            {{ $family_appointment->user->email }}
                                        </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end"
                                             aria-label="Available Actions">
                                            <a href="{{ route('appointments.show', $appointment->uuid) }}"
                                               class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip"
                                               title="View Details">
                                                {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }}
                                                View
                                            </a>
                                        </div>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                    @empty
                    @endforelse
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

        var AppointmentIndexScript = function () {
            // Private functions

            // Module
            var initAppointmentIndex = function () {
                var datatable = $('#kt_datatable').KTDatatable({
                    data: {
                        saveState: {cookie: false},
                    },
                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'generalSearch'
                    },
                    layout: {
                        scroll: true,
                        height: 500,
                        spinner: {
                            type: 'loader',
                        }
                    },
                    columns: [
                        {
                            field: 'reference',
                            title: 'REFERENCE',
                            type: 'number',
                            autoHide: false,
                            width: 150
                        },
                        {
                            field: 'scheduledBy',
                            title: 'SCHEDULED BY',
                            width: 220
                        },
                        {
                            field: 'date_type',
                            title: 'DATE & TYPE',
                            width: 150
                        },
                        {
                            field: 'type',
                            title: 'TYPE',
                            width: 120
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

                $('#kt_datatable_search_status').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });

                $('#kt_datatable_search_group').on('change', function () {
                    datatable.search($(this).val().toLowerCase(), 'reference');
                });

                $('#kt_datatable_search_status, #kt_datatable_search_group').selectpicker();

                datatable.on('datatable-on-init, datatable-on-layout-updated', function () {
                    $('[data-toggle="tooltip"]').tooltip()
                });

            };

            return {
                // Public functions
                init: function () {
                    initAppointmentIndex();
                },
            };
        }();

        jQuery(document).ready(function () {
            AppointmentIndexScript.init();
        });

    </script>
    {{--    <script src="{{ asset('js/pages/backend/appointment/index.js') }}" type="text/javascript" defer></script>--}}
@endsection

@section('styles')
@endsection

