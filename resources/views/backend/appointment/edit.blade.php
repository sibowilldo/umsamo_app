@extends('layout.default')

@section('content')
    <div class="d-flex flex-row">
        <div class="flex-sm-row-fluid flex-lg-row-auto flex-xl-row-auto flex-xxl-row-auto w-300px w-xl-300px" id="kt_chat_aside">
            <div class="card card-custom"  id="datepicker-card">
                <div class="card-header">
                    <h3 class="card-title">
                        Appointment Details
                    </h3>
                    <div class="card-toolbar">
                    </div>
                </div>
                {{ Form::model($appointment, ['route' =>['appointments.update', $appointment->id],
                                        'id' => 'appoitnmentEditForm',
                                        'class' => 'form',
                                        'data-action' => route('appointments.update', $appointment->id),
                                        'method' => 'patch']) }}

                <div class="card-body">
                    <!--begin:Details-->
                    <div class="mt-3 scroll scroll-pull" data-scroll="true">
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="d-flex align-items-center flex-column">
                                <div id="rescheduleDate"></div>
                                <input type="hidden" class="form-control mt-5" name="event_date" data-id="{{ $appointment->event_date->id }}">
                            </div>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-success mr-5">
                                    <span class="symbol-label">
                                        {{ Metronic::getSVG('media/svg/icons/Files/User-folder.svg', "svg-icon svg-icon-lg svg-icon-success") }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Group</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ class_basename($appointment->appointmentable)}} Appointment</span>
                                </div>
                            </div>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-info mr-5">
                                    <span class="symbol-label">
                                        {{ Metronic::getSVG('media/svg/icons/Files/Group-folders.svg', 'svg-icon svg-icon-lg svg-icon-info') }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Type</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ $appointment_types->where('id', $appointment->type )->first()['title']}}</span>
                                </div>
                            </div>
                        </div>
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-15">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-{{$appointment->status->color}} mr-5">
                                    <span class="symbol-label">
                                        {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', "svg-icon svg-icon-lg svg-icon-".$appointment->status->color) }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Status</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ $appointment->status->title }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:Details-->
                </div>
                <div class="card-footer bg-gray-100 border-top-0 text-right rounded-bottom">
                    <div class="row">
                        <div class="col-lg-9 ml-lg-auto">
                            <button id="submitForm" type="submit" class="btn btn-primary btn-circle mr-2 btn-icon"><i class="la la-check"></i> </button>
                            <button type="button" class="btn btn-hover-light-danger btn-icon"><i class="la la-close"></i></button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>

        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8 offcanvas-mobile w-350px" id="kt_chat_content">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5">Comments</div>
                        <div>
                            <span class="font-weight-bold text-muted font-size-sm">Between You and Administrators</span>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="scroll scroll-pull" data-mobile-height="450">
                        <!--begin::Messages-->
                        <div class="messages">
                        @forelse($comments as $comment)
                            <!--begin::Message In-->
                                <div class="d-flex flex-column mb-10 align-items-{{$comment->user_id===Auth::id()?'end':'start'}}">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40 mr-3">
                                            <img alt="Pic" data-src="{{$comment->user_id===Auth::id()?Auth::user()->profile->avatarurl:$comment->user->profile->avatarurl}}" class="min-h-40px"/>
                                        </div>
                                        <div>
                                            <a href="#"
                                               class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$comment->user_id===Auth::id()?'You':$comment->user->profile->fullname}}</a>
                                            <br><span class="text-muted font-size-sm">{{$comment->created_at->diffForHumans(['options' =>02])}}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-2 rounded p-5 bg-light-{{$comment->status->color}} text-dark-75 font-weight-bold font-size-md text-left max-w-400px">
                                        {{$comment->body}}
                                    </div>
                                </div>
                                <!--end::Message In-->
                            @empty
                                No Comments
                            @endforelse
                        </div>
                        <!--end::Messages-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center">
                    <!--begin::Compose-->
                    <textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message" readonly></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        {{--                        <div class="mr-3">--}}
                        {{--                            <a href="#" class="btn btn-clean btn-icon btn-md mr-1">--}}
                        {{--                                <i class="flaticon2-photograph icon-lg"></i>--}}
                        {{--                            </a>--}}
                        {{--                            <a href="#" class="btn btn-clean btn-icon btn-md">--}}
                        {{--                                <i class="flaticon2-clip-symbol icon-lg"></i>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                        <div>
                            <button type="button"
                                    class="btn btn-secondary btn-md text-uppercase font-weight-bold chat-send py-2 px-6" disabled>
                                Send <span class="font-size-xs">(Coming Soon!)</span>
                            </button>
                        </div>
                    </div>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-switch.js') }}" type="text/javascript" defer></script>
    <script>
        // Class definition

        var KTBootstrapDatepicker = function () {

            var arrows;
            var _chatAsideEl;
            var _chatAsideOffcanvasObj;
            var _chatContentEl;

            let _appointment_datepicker;
            let _datepicker_card = new KTCard('datepicker-card');
            let _datepicker_options = {
                viewMode: 'days',
                format: 'YYYY-MM-DD',
                inline: true,
                defaultDate: false,
                minDate: moment(),
                sideBySide:false,
                enabledDates: [],
                icons: {
                    next: 'flaticon2-right-arrow',
                    previous: 'flaticon2-left-arrow',
                    up: 'flaticon2-up',
                    down: 'flaticon2-down',
                }
            }
            let _event_date = $('input[name=event_date]');
            let _event_dates = {};

            // Private functions
            var _initAside = function () {
                // Mobile offcanvas for mobile mode
                _chatAsideOffcanvasObj = new KTOffcanvas(_chatContentEl, {
                    overlay: true,
                    baseClass: 'offcanvas-mobile',
                    //closeBy: 'kt_chat_aside_close',
                    toggleBy: 'kt_app_chat_toggle'
                });
            }

            var _initLazyLoadAvatar = function () {
                const config = {
                    rootMargin: '0px 0px 50px 0px',
                    threshold: 0
                };

                let observer = new IntersectionObserver(function(entries, self) {
                    entries.forEach(entry => {
                        if(entry.isIntersecting) {
                            const lazyImage = entry.target
                            lazyImage.src = lazyImage.dataset.src
                        }
                    });
                }, config);

                const imgs = document.querySelectorAll('[data-src]');
                imgs.forEach(img => {
                    observer.observe(img);
                });
            }

            if (KTUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            }
            else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }


            var initEventDates = function(){
                let available_spaces = 0;
                axios.get('/ajax/event-dates')
                    .then(response=>{
                        _event_dates =  response.data.data;
                        _appointment_datepicker.on('dp.show', function(e){
                            let limit_label = $('#limit_value');
                            limit_label.text('');
                            _event_dates.some(function(item){
                                available_spaces =  item.limit - (item.confirmed_appointments_count < 0?0:item.confirmed_appointments_count);
                                let selected_date = moment(item.date_time);
                                $('input[name=event_date]').attr('data-id', item.id);
                                limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                        <strong>${available_spaces}</strong> ${available_spaces === 1?'spot':'spots'}
                                        available for consultation.`);
                                _event_date.val(selected_date.format('YYYY-MM-DD'));
                                if(available_spaces < 1){
                                    return true;
                                }
                            })
                        });
                    })
                    .catch((error)=>{
                        console.log(error)
                        swal.fire({
                            title: `Status Code ${error.response.status} <br> Error fetching available Appointment Dates.`,
                            text: "Please report this error, and quote Status Code",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-primary"
                            }
                        }).then(function () {
                                $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary').text('Next Step [Disabled]');
                                _datepicker_options.enabledDates = [moment().day(-1)];
                                _appointment_datepicker.datetimepicker(_datepicker_options);
                                KTApp.unblock(_datepicker_card.getSelf());
                            });
                    })
                    .finally(()=>{
                        initBootstrapCalendar();
                    });
            }

            var initBootstrapCalendar = function(){
                KTApp.block(_datepicker_card.getSelf(), {
                    overlayColor: '#000000',
                    type: 'loader',
                    state: 'primary',
                    message: 'Loading Available Dates...',
                    shadow: true,
                    size: 'lg'
                });
                if(Object.keys(_event_dates).length >0){
                    let event_dates =  _event_dates.map(function(data){
                        return moment(data.date_time);
                    });
                    if(event_dates.length > 0){
                        _datepicker_options.enabledDates = event_dates;
                    }
                }
                else{
                    _datepicker_options.enabledDates = [moment().day(-1)];
                    $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary');
                }

                _appointment_datepicker.datetimepicker(_datepicker_options);
                KTApp.unblock(_datepicker_card.getSelf());

                _appointment_datepicker.on('dp.change', function(e){
                    let limit_label = $('#limit_value');
                    limit_label.text('');

                    _event_dates.some(function(item){
                        let selected_date = moment(item.date_time);
                        const available_spaces =  item.limit - (item.confirmed_appointments_count < 0?0:item.confirmed_appointments_count);
                        if(selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD')){
                            $('input[name=event_date]').attr('data-id', item.id);

                            limit_label.html(`<strong>${selected_date.format('MMM DD, YYYY')}</strong> has
                                            <strong>${available_spaces}</strong> ${available_spaces === 1?'spot':'spots'}
                                            available for consultation.`);
                            _event_date.val(e.date.format('YYYY-MM-DD'));
                        }
                    })
                });
            }

            return {
                // public functions
                init: function() {
                    // Elements
                    _chatAsideEl = KTUtil.getById('kt_chat_aside');
                    _chatContentEl = KTUtil.getById('kt_chat_content');
                    _appointment_datepicker = $('#rescheduleDate')
                    // Init aside and user list
                    initEventDates();
                    _initAside();
                    _initLazyLoadAvatar();

                    // Init inline chat example
                    KTLayoutChat.setup(KTUtil.getById('kt_chat_content'));
                }
            };
        }();

        jQuery(document).ready(function() {
            KTBootstrapDatepicker.init();
        });
    </script>
@endsection

