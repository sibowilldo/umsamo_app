@extends('layout.default')

@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">
                        Enter Event Details
                    </h3>
                    <div class="card-toolbar">
                        <div class="justify-content-center">
                            <a href="{{ route('events.index') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <rect fill="#000000" x="2" y="4" width="19" height="4" rx="1"/>
                                        <path d="M3,10 L6,10 C6.55228475,10 7,10.4477153 7,11 L7,19 C7,19.5522847 6.55228475,20 6,20 L3,20 C2.44771525,20 2,19.5522847 2,19 L2,11 C2,10.4477153 2.44771525,10 3,10 Z M10,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,19 C14,19.5522847 13.5522847,20 13,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M17,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,19 C21,19.5522847 20.5522847,20 20,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,11 C16,10.4477153 16.4477153,10 17,10 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>All Events</a>
                        </div>
                    </div>
                </div>
                <form method="post" class="form" id="eventCreateForm" action="{{route('events.store')}}">
                    <div class="card-body">
                        @include('backend.event._form')
                    </div>
                    <div class="card-footer bg-gray-100 border-top-0 text-right rounded-bottom">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <button id="submitForm" type="submit" class="btn btn-primary font-weight-bold mr-2">Save Event</button>
                                <button type="reset" class="btn btn-light-primary font-weight-bold">Reset Form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{{--    <script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-switch.js') }}" type="text/javascript" defer></script>--}}
{{--    <script src="{{ asset('js/pages/backend/event/create.js') }}" type="text/javascript" defer></script>--}}
<script src="{{ asset('js/plugins/jquery.form-repeater.js') }}"></script>

<script>
    'use strict'
    // Class definition
    var EventCreateFunction = function() {
        var holidays = [];
        $('.selectpicker').selectpicker();

        var datepickerOptions = {
            viewMode: 'months',
            format: 'YYYY-MM-DD',
            minDate: moment(),
            sideBySide:true,
            disabledDates: za_holidays,
            icons: {
                next: 'flaticon2-right-arrow',
                previous: 'flaticon2-left-arrow',
                up: 'flaticon2-up',
                down: 'flaticon2-down',
            }
        }

        // Private functions
        var initDateTimeRepeater = function() {
            $('#event_dates_repeater').repeater({
                btnAddClass: 'r-btnAdd',
                btnRemoveClass: 'r-btnRemove',
                groupClass: 'event-date-group',
                minItems: 1,
                maxItems: 4,
                startingIndex: 0,
                showMinItemsOnLoad: false,
                reindexOnDelete: true,
                repeatMode: 'insertAfterLast',
                animation: 'fade',
                animationSpeed: 400,
                animationEasing: 'swing',
                clearValues: true,
                afterAdd: function(){
                    $('.datetimepicker').datetimepicker(datepickerOptions);
                }
            });
            $('.datetimepicker').datetimepicker(datepickerOptions);
        }
        var initFormSmartControl = function () {
            $('input[name=auto_select_dates]').on('change', function(){
                if(this.checked){
                    $('.r-btnAdd').hide();
                }else{

                    $('.r-btnAdd').show();
                }
            })
        }

        var initEventCreateFormValidation = function(){
            FormValidation.formValidation(
                document.getElementById('eventCreateForm'),
                {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'Title is required'
                                }
                            }
                        },
                        description: {
                            validators: {
                                notEmpty: {
                                    message: 'Description is required'
                                }
                            }
                        },
                        'event_date[0][date_time]': {
                            validators: {
                                notEmpty: {
                                    message: 'Date required'
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'Value is not a valid date',
                                }
                            }
                        },
                        'event_date[0][limit]': {
                            validators: {
                                notEmpty: {
                                    message: 'Limit is required'
                                },
                                numeric: {
                                    message: 'Value is not a number'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton()
                    }
                }
            ).on('core.form.valid', function(){
                let btn = $('#submitForm');
                let form = btn.closest('form');

                form.submit();
            });
        };

        return {
            // public functions
            init: function() {
                initDateTimeRepeater();
                initFormSmartControl();
                initEventCreateFormValidation();
            }
        };
    }();

    jQuery(document).ready(function() {
        EventCreateFunction.init();
    });
</script>
@endsection

