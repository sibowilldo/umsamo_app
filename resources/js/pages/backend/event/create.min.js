
'use strict'
// Class definition
var EventCreateFunction = function() {
    var za_holidays = [];
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
    };

    var initHolidays = function(){
        axios.get('/cronos/public-holidays')
            .then((response)=>{
                response.data.map((item)=>{
                    za_holidays.push(moment(item).format('YYYY-MM-DD'));
                });
                $('.datetimepicker').datetimepicker(datepickerOptions);
            })
            .catch((error) => {
                console.log(error);
            })
    };

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
            initHolidays();
            initDateTimeRepeater();
            initFormSmartControl();
            initEventCreateFormValidation();
        }
    };
}();

jQuery(document).ready(function() {
    EventCreateFunction.init();
});
