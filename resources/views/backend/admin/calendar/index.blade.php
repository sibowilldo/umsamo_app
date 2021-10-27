@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    Basic Calendar
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="#" class="btn btn-light-primary font-weight-bold">
                    <i class="ki ki-plus "></i> Add Event
                </a>
            </div>
        </div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js" integrity="sha256-mMw9aRRFx9TK/L0dn25GKxH/WH7rtFTp+P9Uma+2+zc=" crossorigin="anonymous"></script>
    <script>

        var KTCalendarBasic = function() {

            return {
                //main function to initiate the module
                init: function() {
                    let todayDate = moment().startOf('day');
                    let YM = todayDate.format('YYYY-MM');
                    let YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                    let TODAY = todayDate.format('YYYY-MM-DD');
                    let TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
                    let events = [];
                    let calendarEl = document.getElementById('calendar');
                    let calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        timeZone: 'UTC',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        editable: true,
                        dayMaxEvents: true, // when too many events in a day, show the popover
                        eventDidMount: function(info) {
                            var element = $(info.el);
                            if (info.event.extendedProps && info.event.extendedProps.description) {
                                if (element.hasClass('fc-daygrid-event')) {
                                    console.log(`${info.event.title} ${info.event.extendedProps.appointment_type}`);
                                    element.data('content', info.event.extendedProps.description);
                                    element.data('placement', 'top');
                                    KTApp.initPopover(element);
                                } else if (element.hasClass('fc-time-grid-event')) {
                                    element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                } else if (element.find('.fc-list-item-title').length !== 0) {
                                    element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                }
                            }
                        },
                        eventDrop: function(info) {
                            if (!confirm("Are you sure about this reschedule?")) {
                                info.revert();
                            }
                        }
                    });

                    axios.get('ajax/appointments')
                        .then((response) => {
                            calendar.addEventSource(response.data.data)
                        })
                        .catch((error) => {
                            calendar.addEventSource([])
                        }).finally(()=>{
                        calendar.render();
                    })

                }
            };
        }();

        jQuery(document).ready(function() {
            KTCalendarBasic.init();
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}">
@endsection

