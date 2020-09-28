@extends('layout.default')

@section('content')
{{--    <div class="card card-custom">--}}
{{--        <div class="card-header">--}}
{{--            <div class="card-title">--}}
{{--                <h3 class="card-label">--}}
{{--                    Basic Calendar--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--            <div class="card-toolbar">--}}
{{--                <a href="#" class="btn btn-light-primary font-weight-bold">--}}
{{--                    <i class="ki ki-plus "></i> Add Event--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <div id="kt_calendar"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

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

    <script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

{{--    <script>--}}
{{--        var KTCalendarBasic = function() {--}}

{{--            return {--}}
{{--                //main function to initiate the module--}}
{{--                init: function() {--}}
{{--                    let todayDate = moment().startOf('day');--}}
{{--                    let YM = todayDate.format('YYYY-MM');--}}
{{--                    let YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');--}}
{{--                    let TODAY = todayDate.format('YYYY-MM-DD');--}}
{{--                    let TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');--}}
{{--                    let events = [];--}}
{{--                    let calendarEl = document.getElementById('kt_calendar');--}}
{{--                    let calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],--}}
{{--                        themeSystem: 'bootstrap',--}}

{{--                        isRTL: KTUtil.isRTL(),--}}

{{--                        header: {--}}
{{--                            left: 'prev,next today',--}}
{{--                            center: 'title',--}}
{{--                            right: 'dayGridMonth,timeGridWeek,timeGridDay'--}}
{{--                        },--}}

{{--                        height: 800,--}}
{{--                        contentHeight: 780,--}}
{{--                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio--}}

{{--                        nowIndicator: true,--}}
{{--                        now: TODAY + 'T09:25:00', // just for demo--}}

{{--                        views: {--}}
{{--                            dayGridMonth: { buttonText: 'month' },--}}
{{--                            timeGridWeek: { buttonText: 'week' },--}}
{{--                            timeGridDay: { buttonText: 'day' }--}}
{{--                        },--}}
{{--                        defaultView: 'dayGridMonth',--}}
{{--                        defaultDate: TODAY,--}}

{{--                        editable: true,--}}
{{--                        eventLimit: true, // allow "more" link when too many events--}}
{{--                        navLinks: true,--}}
{{--                        events: events,--}}
{{--                        eventRender: function(info) {--}}
{{--                            var element = $(info.el);--}}

{{--                            if (info.event.extendedProps && info.event.extendedProps.description) {--}}
{{--                                if (element.hasClass('fc-day-grid-event')) {--}}
{{--                                    element.data('content', info.event.extendedProps.description);--}}
{{--                                    element.data('placement', 'top');--}}
{{--                                    KTApp.initPopover(element);--}}
{{--                                } else if (element.hasClass('fc-time-grid-event')) {--}}
{{--                                    element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');--}}
{{--                                } else if (element.find('.fc-list-item-title').lenght !== 0) {--}}
{{--                                    element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}

{{--                    axios.get('ajax/appointments')--}}
{{--                        .then((response) => {--}}
{{--                            events = response.data.data--}}
{{--                            console.log(response.data)--}}
{{--                        })--}}
{{--                        .catch((error) => {--}}

{{--                        }).finally(()=>{--}}
{{--                        console.log('Rendering')--}}
{{--                        calendar.render();--}}
{{--                    })--}}

{{--                }--}}
{{--            };--}}
{{--        }();--}}

{{--        jQuery(document).ready(function() {--}}
{{--            KTCalendarBasic.init();--}}
{{--        });--}}
{{--    </script>--}}

    <script src="{{ asset('js/pages/backend/appointment/index.js') }}" type="text/javascript" defer></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}">
@endsection

