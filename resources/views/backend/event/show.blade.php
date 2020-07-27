@extends('layout.default')

@section('content')
    <!--begin::Row-->
    <div class="row">

        <div class="col-lg-4">
            <!--begin::Mixed Widget 14-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title font-weight-bolder">Event Stats</h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ki ki-bold-more-hor"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover py-5">
                                    <li class="navi-item">
                                        <a href="{{ route('events.edit', $event->id) }}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-pen"></i>
                                            </span>
                                            <span class="navi-text">Edit details</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="{{ route('events.index') }}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="flaticon2-list-3"></i>
                                            </span>
                                            <span class="navi-text">View All Events</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex flex-column align-content-start">
                    <div class="flex-grow-1">
                        <div id="kt_mixed_widget_14_chart" style="height: 250px"></div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mr-0">
                        <div class="mr-6">
                            <div class="font-weight-bold mb-2">Created Date</div>
                            <span class="btn btn-sm btn-text btn-light-primary text-uppercase font-weight-bold">{{ $event->created_at }}</span>
                        </div>
                        <div class="">
                            <div class="font-weight-bold mb-2">Last Updated</div>
                            <span class="btn btn-sm btn-text btn-light-danger text-uppercase font-weight-bold">{{ $event->updated_at->diffForhumans() }}</span>
                        </div>
                    </div>
                    <div class="pt-5">
                        <p class="text-center font-weight-normal font-size-lg pb-7">{{ $event->description }}</p>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 14-->
        </div>
        <div class="col-lg-8">
            <!--begin::Card-->
            <!--end::Card-->
            <!--begin::Advance Table Widget 3-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Event Dates in this Event</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ count($event->event_dates) }} event dates</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-3">
                    <input type="hidden" id="event" value="{{ $event->uuid }}">
                    @forelse($event->event_dates as $event_date)
                        <div class="d-flex align-items-center mb-9 bg-light-{{ $event_date->status->color }} rounded p-5">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-{{ $event_date->status->color }} mr-5">
                            {{ Metronic::getSVG('media/svg/icons/Layout/Layout-4-blocks.svg', 'svg-icon svg-icon-lg') }}
                        </span>
                        <!--end::Icon-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="{{ route('event-dates.show', $event_date->id) }}" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{ $event_date->date_time->format('M d, Y') }}</a>
                            <span class="text-muted font-weight-bold">Due {{ $event_date->date_time->shortRelativeToNowDiffForHumans() }}</span>
                        </div>
                        <!--end::Title-->
                        <!--begin::Label-->
                        <span class="font-weight-bolder text-{{ $event_date->status->color }}  py-1 font-size-lg">{{ $event_date->appointments_count?round((($event_date->appointments_count / ($event_date->appointments_count + $event_date->limit)))*100):0}}%</span>
                        <!--end::Label-->
                    </div>
                    @empty
                    @endforelse
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 3-->
        </div>
    </div>
    <!--end::Row-->
@endsection

@section('styles')
@endsection

@section('scripts')
    <script>
        "use strict";
        // Class definition

        var EventShowScript = function () {


            // Private functions
            // Module
            var initEventShow = function () {
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
                            field: 'date',
                            title: 'DATE',
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
                            field: 'status',
                            title: 'STATUS',
                            autoHide: false,
                            width: 120,
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
            };

            var _initMixedWidget14 = function() {
                var element = document.getElementById("kt_mixed_widget_14_chart");
                var height = parseInt(KTUtil.css(element, 'height'));

                if (!element) {
                    return;
                }

                var _options = {
                    series: [74],
                    chart: {
                        height: height,
                        type: 'radialBar',
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: "65%"
                            },
                            dataLabels: {
                                showOn: "always",
                                name: {
                                    show: false,
                                    fontWeight: '700'
                                },
                                value: {
                                    color: KTApp.getSettings()['colors']['gray']['gray-700'],
                                    fontSize: "30px",
                                    fontWeight: '700',
                                    offsetY: 12,
                                    show: true
                                }
                            },
                            track: {
                                background: KTApp.getSettings()['colors']['theme']['light']['success'],
                                strokeWidth: '100%'
                            }
                        }
                    },
                    colors: [KTApp.getSettings()['colors']['theme']['base']['danger']],
                    stroke: {
                        lineCap: "round",
                    },
                    labels: ["Progress"]
                };

                let event = $('input#event').val();

                axios.get(`/events/${event}`).then(function(response) {
                    _options.series = [response.data[0].percentage]
                    var chart = new ApexCharts(element, _options);
                    chart.render();
                })

            }
            return {
                // Public functions
                init: function () {
                    initEventShow();
                    _initMixedWidget14();
                },
            };
        }();


        jQuery(document).ready(function () {
            EventShowScript.init();
        });
    </script>
@endsection

