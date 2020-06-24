@extends('layout.default')

@section('content')
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <div class="flex-sm-row-fluid flex-lg-row-auto flex-xl-row-auto flex-xxl-row-auto w-400px w-xl-400px" id="kt_chat_aside">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-0">
                        <!--begin::Aside Mobile Toggle-->
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
                                <span class="svg-icon svg-icon-lg">
                                    {{ Metronic::getSVG('media/svg/icons/Communication/Chat5.svg') }}
                                </span>
                        </button>
                        <!--end::Aside Mobile Toggle-->
                    </div>
                    <div class="text-center flex-grow-1">
                        <div class="text-dark-75 font-weight-bold font-size-h5">Appointment Details</div>
                        <div class="text-muted font-size-sm">
                            <span class="font-weight-bolder text-dark-50">Last Updated</span> {{ $appointment->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin:Details-->
                    <div class="mt-7 scroll scroll-pull" data-scroll="true">
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-15">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-primary mr-5">
                                    <span class="symbol-label">
                                        {{ Metronic::getSVG('media/svg/icons/Layout/Layout-top-panel-6.svg', 'svg-icon svg-icon-lg svg-icon-primary') }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Appointment Date</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ $appointment->event_date->date_time->format('M d Y, H:i A') }}</span>
                                </div>
                            </div>
                        </div>
                        <!--end:Item-->
                        <!--end:Item-->
                        <!--begin:Item-->
                        <div class="d-flex align-items-center justify-content-between mb-15">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40 symbol-light-info mr-5">
                                    <span class="symbol-label">
                                        {{ Metronic::getSVG('media/svg/icons/Files/Group-folders.svg', 'svg-icon svg-icon-lg svg-icon-info') }}
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark-75 text-hover-primary font-weight-bold font-size-lg">Type</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{ Str::ucfirst($appointment->type)  }}</span>
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
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Aside-->
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
                            <div class="d-flex flex-column mb-5 align-items-{{$comment->user_id===Auth::id()?'end':'start'}}">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-40 mr-3">
                                        <img alt="Pic" data-src="{{$comment->user_id===Auth::id()?Auth::user()->profile->avatarurl:$comment->user->profile->avatarurl}}" class="min-h-40px"/>
                                    </div>
                                    <div>
                                        <a href="#"
                                           class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{$comment->user_id===Auth::id()?'You':$comment->user->profile->fullname}}</a>
                                        <br><span class="text-muted font-size-sm">{{$comment->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                                <div
                                    class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
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
                    <textarea class="form-control border-0 p-0" rows="2" placeholder="Type a message"></textarea>
                    <div class="d-flex align-items-center justify-content-between mt-5">
{{--                        <div class="mr-3 hidden">--}}
{{--                            <a href="#" class="btn btn-clean btn-icon btn-md mr-1">--}}
{{--                                <i class="flaticon2-photograph icon-lg"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-clean btn-icon btn-md">--}}
{{--                                <i class="flaticon2-photo-camera icon-lg"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div>
                            <button type="button"
                                    class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">
                                Send
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
    <script>
        "use strict";

        // Class definition
        var KTAppChat = function () {
            var _chatAsideEl;
            var _chatAsideOffcanvasObj;
            var _chatContentEl;

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


            return {
                // Public functions
                init: function() {
                    // Elements
                    _chatAsideEl = KTUtil.getById('kt_chat_aside');
                    _chatContentEl = KTUtil.getById('kt_chat_content');

                    // Init aside and user list
                    _initAside();
                    _initLazyLoadAvatar();

                    // Init inline chat example
                    KTLayoutChat.setup(KTUtil.getById('kt_chat_content'));
                }
            };
        }();

        jQuery(document).ready(function() {
            KTAppChat.init();
        });

    </script>
@endsection

