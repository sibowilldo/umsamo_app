@extends('layout.default')

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Events</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Metronic::getSvg('media/svg/icons/Design/PenAndRuller.svg', 'svg-icon svg-icon-md') }}>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
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
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
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
                                    <select class="form-control kt-selectpicker" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        @foreach($statuses as $status)
                                        <option value="{{ $status->title }}">{{ $status->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="table table-head-bg table-borderless" id="kt_datatable">
                <thead>
                <tr>
                    <th data-field="index"></th>
                    <th>EVENT DETAILS</th>
                    <th>STATUS</th>
                    <th>CREATED</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td class="py-8">
                            <div class="d-flex align-items-center">
                                <span class="bullet bullet-bar bg-{{ $event->status->color }} align-self-stretch pb-10"></span>
                            </div>
                        </td>
                        <td class="py-8">
                            <div class="d-flex align-items-center">
                                <div>
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $event->title}}</a>
                                    <span class="text-muted font-weight-bolder d-block">Has {{ count($event->event_dates) }} {{count($event->event_dates) == 1? 'Event Date': 'Event Dates' }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                        <span>
                            <span class="label label-inline label-lg font-weight-bolder label-light-{{ $event->status->color }}">
                        {{ $event->status->title }}</span>
                        </span>
                        </td>
                        <td><div>
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $event->created_at->format('M d, Y') }}</a>
                                <span class="text-muted font-weight-bolder d-block">{{ $event->created_at->diffForHumans() }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-end p-2" aria-label="Available Actions">
                                <a href="{{ route('events.show', $event->uuid) }}" class="btn btn-light btn-hover-primary btn-sm" data-toggle="tooltip" title="View Details">
                                    {{ Metronic::getSVG('media/svg/icons/General/Settings-1.svg', 'svg-icon svg-icon-md svg-icon-primary') }} View
                                </a>
                                @if(!$event->status->cancelled)
                                <button type="button" class="btn btn-light btn-hover-danger btn-sm deleteBtn ml-3" data-url="{{route('events.destroy', $event->uuid)}}" data-record="{{ $event->uuid }}" data-placement="top"  data-toggle="tooltip" data-original-title="Cancel Event">
                                   {{ Metronic::getSVG('media/svg/icons/Code/Stop.svg', 'svg-icon svg-icon-md svg-icon-danger') }}<span class="ml-1">Delete</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
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

        var EventIndexScript = function() {
            // Private functions

            // demo initializer
            var initEventIndex = function() {
                var datatable = $('#kt_datatable').KTDatatable({
                    data: {
                        saveState: {cookie: true},
                    },
                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'generalSearch'
                    },
                    layout :{
                        theme: 'default',
                        class: 'datatable-brand',
                        spinner: {
                            type: 'loader',
                            opacity: 0,
                            state: 'brand'
                        },
                        icons: {
                            rowDetail: {
                                expand: 'fa fa-caret-down',
                                collapse: 'fa fa-caret-right'
                            }
                        }
                    },
                    rows: {
                        autoHide: false
                    },
                    columns: [
                        {
                            field: 'index',
                            title: '',
                            width: 15,
                            textAlign: "right",
                            sortable: false,
                            autoHide: true,
                        },
                        {
                            field: 'event_details',
                            title: 'EVENT DETAILS',
                            autoHide: false,
                        },
                        {
                            field: 'STATUS',
                            title: 'STATUS',
                            autoHide: false,
                            width: 380
                        },
                        {
                            field: 'created',
                            title: 'CREATED',
                            autoHide: true,
                            type: 'date',
                            format: 'YYYY-MM-DD',
                        },
                        {
                            field: 'ACTION',
                            title: 'ACTION',
                            width: 220,
                            textAlign: 'center',
                            sortable: false,
                        }
                    ],
                });

                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'STATUS');
                });
                datatable.on('datatable-on-init, datatable-on-layout-updated', function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });

                datatable.on('click', '.deleteBtn', function(){
                    let deleteBtn = $(this);
                    var record = deleteBtn.data("record");
                    var url = deleteBtn.data("url");

                    swal.fire({
                        title: 'Are you sure?',
                        text: "Confirm that you would like to delete this entry",
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Delete!',
                        showLoaderOnConfirm: true,
                        preConfirm:  function () {
                            return new Promise(function (resolve) {
                                axios.delete(url, {
                                    id: record
                                })
                                    .then(function (response) {
                                        swal.fire({
                                            'icon': 'info',
                                            title: 'Deleted!',
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
                    initEventIndex();
                    $('.kt-selectpicker').selectpicker({});
                },
            };
        }();

        jQuery(document).ready(function() {
            EventIndexScript.init();
        });

    </script>

{{--    <script src="{{ mix('js/pages/backend/event/index.js') }}" type="text/javascript" defer></script>--}}
@endsection

@section('styles')
@endsection

