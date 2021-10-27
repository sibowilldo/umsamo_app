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
        <table class="table table-separate table-checkable table-striped" id="appointments-table"> </table>
{{--        Reschedule Modal--}}
        <div class="modal fade" id="rescheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reschedule Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="newDate">Please select a new date below and click Confirm New Date button</label>
                        <select id="newDate" class="form-control select2"  style="width: 75%"> </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary font-weight-bold">Confirm new date</button>
                    </div>
                </div>
            </div>
        </div>

{{--        <table class="table table-head-bg table-borderless table-head-custom" id="kt_datatable">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th data-field="scheduledFor">SCHEDULED FOR</th>--}}
{{--                <th data-field="reference">REFERENCE</th>--}}
{{--                <th data-field="status">STATUS</th>--}}
{{--                <th>TYPE</th>--}}
{{--                <th>RESERVED</th>--}}
{{--                <th class="text-right" data-field="action">ACTION</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($appointments as $appointment)--}}
{{--                <tr>--}}
{{--                    <td class="pl-3 py-8">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>--}}
{{--                            <div>--}}
{{--                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('D M d, Y') }}</a>--}}
{{--                                <span class="text-muted d-block">{{ $appointment->event_date->date_time->diffForHumans() }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="font-weight-bolder">{{ $appointment->reference }} <span class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span></div>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                    <span>--}}
{{--                        <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">--}}
{{--                    {{ $appointment->status->title }}</span>--}}
{{--                    </span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title'] }}</span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="d-flex align-items-center justify-content-end" aria-label="Available Actions">--}}
{{--                            <a href="{{ route('appointments.show', $appointment->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">--}}
{{--                                {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View--}}
{{--                            </a>--}}
{{--                            @if(!$appointment->status->cancelled)--}}
{{--                                <button type="button" class="btn btn-light btn-hover-danger btn-sm cancelBtn ml-3" data-url="{{route('appointments.cancel', $appointment->uuid)}}" data-record="{{ $appointment->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">--}}
{{--                                    <span class="ml-1">{{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}Cancel</span>--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            @foreach($user->families as $family)--}}
{{--                @foreach($family->appointments as $appointment)--}}
{{--                <tr>--}}
{{--                    <td class="pl-3 py-8">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <span class="bullet bullet-bar bg-{{ $appointment->status->color }} align-self-stretch pb-10 mr-4"></span>--}}
{{--                            <div>--}}
{{--                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $appointment->event_date->date_time->format('D M d, Y') }}</a>--}}
{{--                                <span class="text-muted d-block">{{ $appointment->event_date->date_time->diffForHumans() }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="font-weight-bolder">{{ $appointment->reference }} <span class="font-size-xs text-muted text-uppercase d-block">{{ class_basename($appointment->appointmentable)}} Appointment</span></div>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                    <span>--}}
{{--                        <span class="label label-inline label-lg font-weight-bolder label-light-{{ $appointment->status->color }}">--}}
{{--                        {{ $appointment->status->title }}</span>--}}
{{--                    </span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <span class="text-muted font-weight-bold">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <span class="text-muted font-weight-bold">{{ $appointment->created_at->diffForHumans() }}</span>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <div class="d-flex align-items-center justify-content-end" aria-label="Available Actions">--}}
{{--                            <a href="{{ route('appointments.show', $appointment->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">--}}
{{--                                {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View--}}
{{--                            </a>--}}
{{--                            @if(!$appointment->status->cancelled || $appointment->has_passed)--}}
{{--                                <button type="button" class="btn btn-light btn-hover-danger btn-sm cancelBtn ml-3" data-url="{{route('appointments.cancel', $appointment->uuid)}}" data-record="{{ $appointment->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">--}}
{{--                                    <span class="ml-1">{{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}Cancel</span>--}}
{{--                                </button>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                @endforeach--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
        <!--end: Datatable-->
    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        "use strict";
        let _select2dates;
        let _select2Data = [];
        // Class definition
        var UserIndexScript = function () {
            // Private functions

            // Module
            var initUserIndex = function () {
                var $ = jQuery.noConflict();
                var columns = [
                    {data: 'event_date_id', name: 'event_date_id'},
                    {data: 'reference', name: 'reference'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action'},
                ]
                var table = $('#appointments-table').DataTable({
                    dom: 'lrtip',
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ajax: {
                        url:'/ajax/appointments',
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
                            targets: 0,
                            title: 'SCHEDULED FOR',
                            render: function (data, type, appointment, meta) {
                                return `
                                    <div class="d-flex align-items-center text-uppercase">
                                        <span class="bullet bullet-bar bg-${appointment.status.color } align-self-stretch pb-10 mx-4"></span>
                                        <div>
                                            <span class="text-dark-75 font-weight-bold mb-1"> ${ moment(appointment.event_date.date_time).format('ddd DD MMM, YY') }</span>
                                            <span class="font-size-xs text-muted d-block font-weight-boldest"> ${moment(appointment.event_date.date_time ).fromNow()}</span>
                                        </div>
                                    </div>
                                    `;
                            }
                        },
                        {
                            targets: 1,
                            title: 'REFERENCE',
                            render: function (data, type, appointment, meta) {
                                return `
                                        ${ appointment.reference }
                                        <span class="font-size-xs font-weight-boldest text-muted text-uppercase d-block">
                                            ${ appointment.appointmentable_type === 'App\\Family'? appointment.appointmentable.name + ' Family' :'User' } Appointment
                                        </span>
                                    `;
                            }
                        },
                        {
                            targets: 2,
                            title: 'TYPE & STATUS',
                            render: function (data, type, appointment, meta) {
                                const types = ['Cleansing', 'Consulting']
                                return `
                                    <div class="">
                                        <div class="text-uppercase">
                                            ${ types[ parseInt(appointment.type) -1] }
                                        </div>
                                        <div class="font-size-xs font-weight-boldest text-uppercase text-${ data.color }">
                                            <span class="label label-dot label-${ data.color }"></span> ${ data.title }
                                        </div>
                                    </div>
                                    `;
                            }
                        },
                        {
                            targets: 3,
                            title: 'RESERVED SINCE',
                            render: function (data, type, appointment, meta) {
                                return `
                                     <div class="d-flex align-items-center">
                                        <div>
                                            <span class="text-dark-75 text-hover-primary mb-1 "> ${ data }</span>
                                            <span class="text-muted d-block font-size-xs font-weight-boldest text-uppercase"> ${moment(data).fromNow()}</span>
                                        </div>
                                    </div>
                                    `;
                            }
                        },
                        {
                            targets: 4,
                            sortable: false,
                            title: 'ACTION',
                            render: function (data, type, appointment, meta) {
                                let deleteBtn='', scheduleBtn;
                                if(appointment.has_passed){
                                    deleteBtn = `
                                        <button type="button" class="btn btn-hover-bg-danger text-hover-light btn-icon btn-outline-secondary  btn-sm cancelBtn" data-url="appointments/${appointment.uuid}/cancel" data-record="${ appointment.uuid }" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">
                                            <span class="ml-1"> <i class="la la-times"></i></span>
                                        </button>`
                                }

                                return `
                                    <div class="btn-toolbar" role="toolbar">
                                       <div  class="btn-group btn-group-sm" role="group" aria-label="Available Actions">
                                            <a href="appointments/${ appointment.uuid }/edit" class="btn btn-icon" data-toggle="tooltip" title="View Details">
                                                <i class="text-primary la la-pen"></i>
                                            </a>
                                            <button type="button" class="btn rescheduleBtn btn-icon"  ${ appointment.status.title === 'Rescheduled' || appointment.status.title == 'Cancelled' ? 'disabled':'' } data-event-date="${appointment.event_date.date_time}" data-event-date-id="${appointment.event_date.id}" data-placement="top"  data-toggle="tooltip" data-original-title="Reschedule Appointment">
                                                <span class="ml-1"> <i class="ki text-${ appointment.status.title == 'Rescheduled' || appointment.status.title == 'Cancelled'  ? 'muted':'warning' }  ki-round"></i></span>
                                            </button>
                                            <a href="appointments/${ appointment.uuid }" class="btn btn-icon" data-toggle="tooltip" title="View Details">
                                                <i class="ki text-primary ki-eye"></i>
                                            </a>
                                            <button type="button" ${ appointment.status.title == 'Cancelled' ? 'disabled':'' } class="btn cancelBtn btn-icon" data-url="appointments/${appointment.uuid}/cancel" data-record="${ appointment.uuid }" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Appointment">
                                                <span class="ml-1"> <i class="ki text-${ appointment.status.title == 'Cancelled' ? 'muted':'danger' }  ki-bold-close"></i></span>
                                            </button>
                                        </div>
                                    </div>

                                    `;
                            }
                        },
                    ],
                    initComplete: function () {
                    },
                });

                table.on('click', '.cancelBtn', function(){
                    let cancelBtn = $(this);
                    var url = cancelBtn.data("url");
                    swal.fire({
                        icon: 'info',
                        title: 'Are you sure?',
                        text: "Confirm that you would like to Cancel this Appointment.",
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Cancel!',
                        cancelButtonText: 'No, Leave it!',
                        showLoaderOnConfirm: true,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary'
                        },
                        buttonsStyling: false,
                        preConfirm:  function () {
                            return new Promise(function (resolve) {
                                axios.patch(url)
                                    .then(function (response) {
                                        Toast.fire({
                                            'icon': 'info',
                                            title: 'Success:',
                                            text: response.data.message});
                                        table.draw();
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

                table.on('click', '.rescheduleBtn', function(){
                    let rescheduleBtn = $(this);
                    if(_select2Data.find(date => date.id === rescheduleBtn.data('event-date-id'))){
                        _select2dates.val(rescheduleBtn.data('event-date-id')).trigger('change');
                    }
                    $('#rescheduleModal').modal('show');
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
                },
            };
        }();

        jQuery(document).ready(function () {
            UserIndexScript.init();
            window.axios
                .get('ajax/event-dates?filter=auth')
                .then(response => {
                    response.data.data.map(data=>{
                        _select2Data.push({id:data.id, text: data.date_time})
                    })
                })
                .catch(error => {

                })
                .finally(()=>{
                    _select2dates = $('#newDate')
                    _select2dates.select2({
                        dropdownParent: $('#rescheduleModal'),
                        data: _select2Data
                    });
                })

        });

    </script>

{{--    <script src="{{ asset('js/pages/backend/appointment/index.js') }}" type="text/javascript" defer></script>--}}
@endsection

@section('styles')

    <link rel="stylesheet" href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}">
    <style>
        .datepicker {
            width: 320px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}">
@endsection

