/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ 20:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("CPRG");


/***/ }),

/***/ "CPRG":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var DashboardAdmin = function () {
  // Base elements
  var _appointment_datepicker;

  var _appointment_type_select;

  var _consultation_full_message_alert = $('#consultation-full-message');

  var _consultation_option;

  var _datepicker_card = new KTCard('datepicker-card');

  var _datepicker_options = {
    viewMode: 'days',
    format: 'YYYY-MM-DD',
    inline: true,
    defaultDate: false,
    minDate: moment(),
    sideBySide: true,
    enabledDates: [],
    icons: {
      next: 'flaticon2-right-arrow',
      previous: 'flaticon2-left-arrow',
      up: 'flaticon2-up',
      down: 'flaticon2-down'
    }
  };

  var _event_date = $('input[name=event_date]');

  var _event_dates = {};

  var _formEl;

  var _step_1_validation;

  var _step_3_validation;

  var _wizard;

  var _wizardEl;

  var _validations = [];
  var _consultation_full_message = 'has no available spots for consultation appointments. Please choose a different date to make a Consultation Appointment.';

  var generateLuhnDigit = function generateLuhnDigit(inputString) {
    var total = 0;
    var count = 0;

    for (var i = 0; i < inputString.length; i++) {
      var multiple = count % 2 + 1;
      count++;
      var temp = multiple * +inputString[i];
      temp = Math.floor(temp / 10) + temp % 10;
      total += temp;
    }

    total = total * 9 % 10;
    return total;
  };

  var extractFromID = function extractFromID(idNumber) {
    var checkIDNumber = function checkIDNumber(idNumber) {
      var number = idNumber.substring(0, idNumber.length - 1);
      return generateLuhnDigit(number) === +idNumber[idNumber.length - 1];
    };

    var getBirthdate = function getBirthdate(idNumber) {
      var year = idNumber.substring(0, 2);
      var currentYear = new Date().getFullYear() % 100;
      var prefix = "19";
      if (+year < currentYear) prefix = "20";
      var month = idNumber.substring(2, 4);
      var day = idNumber.substring(4, 6);
      return moment(prefix + year + "/" + month + "/" + day, "YYYY-MM-DD");
    };

    var getGender = function getGender(idNumber) {
      return +idNumber.substring(6, 7) < 5 ? "F" : "M";
    };

    var getCitizenship = function getCitizenship(idNumber) {
      return +idNumber.substring(10, 11) === 0 ? "citizen" : "resident";
    };

    var result = {};
    result.valid = checkIDNumber(idNumber);
    result.birthdate = getBirthdate(idNumber);
    result.gender = getGender(idNumber);
    result.citizen = getCitizenship(idNumber);
    return result;
  }; // Private functions


  var initWizard = function initWizard() {
    // Initialize form wizard
    _wizard = new KTWizard(_wizardEl, {
      startStep: 1,
      // initial active step number
      clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element

    }); // Validation before going to next page

    _wizard.on('beforeNext', function (wizard) {
      _validations[wizard.getStep() - 1].validate().then(function (status) {
        if (status === 'Valid') {
          _wizard.goNext();

          KTUtil.scrollTop();
        } else {
          swal.fire({
            title: 'The given data was invalid.',
            text: "Sorry, looks like you missed something, please check the form for further details and try again.",
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
      });

      if (!$('input[name=with_family]').prop('checked')) {
        _step_3_validation.disableValidator('family_name', 'notEmpty');
      }

      _appointment_datepicker.on('dp.change', function () {
        _validations[wizard.getStep() - 1].revalidateField('event_date');
      });

      $('input[name=cell_number]').on('input', function () {
        _validations[wizard.getStep() - 1].revalidateField('cell_number');
      });

      switch (_wizard.getStep()) {
        case 3:
          var form_data = new FormData(_formEl);
          var output = '',
              outputContainer = $('#review_info');

          var _iterator = _createForOfIteratorHelper(form_data.entries()),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var pair = _step.value;

              if (pair[0] === "appointment_type") {
                output += "<tr><th scope=\"row\">".concat(pair[0].toUpperCase().replace(/_/g, ' '), "</th><td>").concat($('select[name=appointment_type]').find(':selected').data('value'), "</td></tr>");
              } else if (pair[1] !== "" && pair[0] !== "_token") {
                output += "<tr><th scope=\"row\">".concat(pair[0].toUpperCase().replace(/_/g, ' '), "</th><td>").concat(pair[1], "</td></tr>");
              }
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }

          outputContainer.html(output);
          break;
      }

      _wizard.stop(); // Don't go to the next step

    }); // Change event


    _wizard.on('change', function (wizard) {
      KTUtil.scrollTop();
    });
  };

  var initValidation = function initValidation() {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    // Step 1
    _step_1_validation = FormValidation.formValidation(_formEl, {
      fields: {
        event_date: {
          validators: {
            notEmpty: {
              message: 'Please select date from calendar'
            }
          }
        },
        appointment_type: {
          validators: {
            notEmpty: {
              message: 'Choose Appointment type; if none is available, Please select a different date.'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });

    _validations.push(_step_1_validation);

    _appointment_type_select.on('changed.bs.select', function (e, index, isSelected, previousValue) {
      _validations[0].revalidateField('appointment_type');
    }); // Step 2


    _validations.push(FormValidation.formValidation(_formEl, {
      fields: {
        id_number: {
          validators: {
            notEmpty: {
              message: 'RSA ID Number is required'
            },
            stringLength: {
              max: 13,
              message: 'Invalid RSA ID Number'
            },
            callback: {
              message: 'Invalid RSA ID Number',
              callback: function callback(input) {
                var idNumber = $(input);

                if (idNumber[0].value.length === 13) {
                  var is_valid = extractFromID(idNumber[0].value);

                  if (is_valid.valid) {
                    $('input[name=date_of_birth]').val(is_valid.birthdate.format('YYYY-MM-DD'));
                    $('input[name=gender]').val([is_valid.gender]);
                  }

                  return is_valid.valid;
                } else {
                  return false;
                }
              }
            }
          }
        },
        first_name: {
          validators: {
            notEmpty: {
              message: 'First name is required'
            }
          }
        },
        last_name: {
          validators: {
            notEmpty: {
              message: 'Last Name is required'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'Email required for login, notifications and, to activate account.'
            },
            emailAddress: {
              message: 'Value not a valid email address'
            }
          }
        },
        cell_number: {
          validators: {
            notEmpty: {
              message: 'Cell number is required for further communication and, to activate account.'
            },
            regexp: {
              regexp: /^[(]([0-9]{3})[)] ([0-9]{3})[-]([0-9]{4})/,
              message: 'The cell number is missing one or more digits.'
            }
          }
        },
        address: {
          validators: {
            notEmpty: {
              message: 'Street Address is required'
            }
          }
        },
        city: {
          validators: {
            notEmpty: {
              message: 'City is required'
            }
          }
        },
        province: {
          validators: {
            notEmpty: {
              message: 'Please select a province'
            }
          }
        },
        postal_code: {
          validators: {
            notEmpty: {
              message: 'Postal Code is required'
            },
            digits: {
              message: 'Value is not valid'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    })); // Step 3


    _step_3_validation = FormValidation.formValidation(_formEl, {
      fields: {
        family_name: {
          validators: {
            notEmpty: {
              message: 'Family name is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });

    _validations.push(_step_3_validation);

    var with_family = $('input[name=with_family]');
    var family_name = $('input[name=family_name]');
    with_family.on('change', function () {
      if (with_family.prop('checked')) {
        family_name.prop('disabled', false).parent().show();

        _step_3_validation.enableValidator('family_name', 'notEmpty');
      } else {
        _step_3_validation.disableValidator('family_name', 'notEmpty');

        family_name.prop('disabled', true).parent().hide();
      }
    });
  };

  var initEventDates = function initEventDates() {
    var _consultation_option = $('#consulting_option');

    var available_spaces = 0;
    axios.get('ajax/event-dates').then(function (response) {
      _event_dates = response.data.data;

      _appointment_datepicker.on('dp.show', function (e) {
        var limit_label = $('#limit_value');
        limit_label.text('');

        _event_dates.some(function (item) {
          var selected_date = moment(item.date_time);
          available_spaces = item.limit - (item.confirmed_appointments_count < 0 ? 0 : item.confirmed_appointments_count);
          $('input[name=event_date]').attr('data-id', item.id);
          limit_label.html("<strong>".concat(selected_date.format('MMM DD, YYYY'), "</strong> has\n                                        <strong>").concat(available_spaces, "</strong> ").concat(available_spaces === 1 ? 'spot' : 'spots', "\n                                        available for consultation."));

          _event_date.val(selected_date.format('YYYY-MM-DD'));

          if (available_spaces < 1) {
            _consultation_full_message_alert.removeClass('d-none flipOutX');

            _consultation_full_message_alert.find('.alert-text').html("<b>".concat(selected_date.format('MMM DD, YYYY'), "</b> ").concat(_consultation_full_message));

            return true;
          }
        });
      });
    })["catch"](function (error) {
      swal.fire({
        title: "Status Code ".concat(error.response.status, " <br> Error fetching available Appointment Dates."),
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
    })["finally"](function () {
      initBootstrapCalendar();

      if (available_spaces < 1) {
        _appointment_type_select.find('option[value=2]').prop('disabled', true).attr('data-subtext', 'DISABLED: No Spots Available');

        _appointment_type_select.selectpicker('refresh');
      }
    });
  };

  var initReactiveFormFields = function initReactiveFormFields() {
    // minimum setup
    $('.kt-selectpicker').selectpicker({
      container: 'body',
      style: 'form-control-lg form-control-solid',
      styleBase: 'form-control',
      noneSelectedText: 'Please select a Province'
    });
    $('input[name=id_number]').on('input', function (e) {
      var input = $(this);

      if (input.val().length === 13 && extractFromID(input.val())) {
        axios.get("/profiles/".concat(input.val())).then(function (response) {
          window.swal.fire({
            icon: 'info',
            title: 'Patient exists',
            text: 'For security purposes, please ask them confirm their details, as shown on the screen.'
          });
          var user = response.data.profile;
          $('input[name=email]').val(user.user.email);
          $('input[name=cell_number]').val(user.cell_number);
          $('input[name=first_name]').val(user.first_name);
          $('input[name=last_name]').val(user.last_name);
          $('input[name=address]').val(user.address);
          $('input[name=city]').val(user.city);
          $('input[name=province]').val(user.province);
          $('input[name=postal_code]').val(user.postal_code);

          _validations[1].validate();
        })["catch"](function (error) {});
      }
    });
  };

  var initBootstrapCalendar = function initBootstrapCalendar() {
    KTApp.block(_datepicker_card.getSelf(), {
      overlayColor: '#000000',
      type: 'loader',
      state: 'primary',
      message: 'Loading Dates...',
      shadow: true,
      size: 'lg'
    });

    if (Object.keys(_event_dates).length > 0) {
      var event_dates = _event_dates.map(function (data) {
        return moment(data.date_time);
      });

      if (event_dates.length > 0) {
        _datepicker_options.enabledDates = event_dates;
      }
    } else {
      _datepicker_options.enabledDates = [moment().day(-1)];
      $('#next_step').attr('disabled', 'disabled').addClass('btn-light').removeClass('btn-primary');
    }

    _appointment_datepicker.datetimepicker(_datepicker_options);

    KTApp.unblock(_datepicker_card.getSelf());

    _appointment_datepicker.on('dp.change', function (e) {
      var limit_label = $('#limit_value');
      limit_label.text('');

      _event_dates.some(function (item) {
        var selected_date = moment(item.date_time);
        var available_spaces = item.limit - (item.confirmed_appointments_count < 0 ? 0 : item.confirmed_appointments_count);

        if (selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD')) {
          $('input[name=event_date]').attr('data-id', item.id);
          limit_label.html("<strong>".concat(selected_date.format('MMM DD, YYYY'), "</strong> has\n                                            <strong>").concat(available_spaces, "</strong> ").concat(available_spaces === 1 ? 'spot' : 'spots', "\n                                            available for consultation."));

          if (available_spaces < 1) {
            _consultation_full_message_alert.removeClass('d-none flipOutX').addClass('flipInX');

            _consultation_full_message_alert.find('.alert-text').html("<b>".concat(selected_date.format('MMM DD, YYYY'), "</b> ").concat(_consultation_full_message));

            _appointment_type_select.selectpicker('val', '');

            _consultation_option.attr('disabled', 'disabled').attr('data-subtext', 'DISABLED: No Spots Available');

            _appointment_type_select.selectpicker('refresh');

            return selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD');
          }
        } else {
          _consultation_full_message_alert.addClass('flipOutX');

          _appointment_type_select.selectpicker('val', '');

          _consultation_option.removeAttr('disabled').attr('data-subtext', '');

          _appointment_type_select.selectpicker('refresh');
        }
      });

      _event_date.val(e.date.format('YYYY-MM-DD'));
    });
  };

  var handleAuthRegisterFormSubmit = function handleAuthRegisterFormSubmit() {
    var submitButton = $('#make_appointment');
    submitButton.on('click', function (e) {
      e.preventDefault();
      var formEntries = new FormData(_formEl);
      var formData = {};

      var _iterator2 = _createForOfIteratorHelper(formEntries.entries()),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var pair = _step2.value;
          formData[pair[0]] = pair[1];
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      formData['event_date'] = $('input[name=event_date]').data('id');
      submitButton.attr('disabled', 'disabled');
      submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');
      axios.post($(_formEl).attr('action'), formData).then(function (response) {
        swal.fire({
          title: response.data.title,
          text: response.data.message,
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'Ok, Got it.',
          onOpen: function onOpen() {
            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
          }
        }).then(function () {
          window.location.replace(response.data.url);
        });
      })["catch"](function (error) {
        submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
        var error_title = 'Oops! Unexpected Error Occurred.';
        var error_messages = 'Please report this to developers.';

        if (error.hasOwnProperty('response')) {
          error_title = "".concat(error.response.status, " ").concat(error.response.statusText);

          if (error.response.hasOwnProperty('data')) {
            error_messages = "".concat(error.response.data.message);

            if (error.response.data.hasOwnProperty('errors')) {
              error_title = error.response.data.message;
              error_messages = '';
              var errorBag = error.response.data.errors;
              Object.entries(errorBag).forEach(function (item, index) {
                error_messages += "<div>".concat(item[1][0], "</div>");
              });
            }
          }
        }

        swal.fire({
          icon: 'error',
          title: error_title,
          html: error_messages
        });
      });
    });
  };

  return {
    // public functions
    init: function init() {
      _appointment_datepicker = $('.datepicker');
      _appointment_type_select = $('#appointment_type').selectpicker({
        style: 'form-control-solid text-dark-75'
      });
      _consultation_option = _appointment_type_select.find('option[value=2]');
      _formEl = KTUtil.getById('registerPatientForm');
      _wizardEl = KTUtil.getById('kt_wizard_v2');
      initEventDates();
      initReactiveFormFields();
      initWizard();
      initValidation();
      handleAuthRegisterFormSubmit();
    }
  };
}();

jQuery(document).ready(function () {
  DashboardAdmin.init();
  $('input[name=cell_number]').inputmask('(999) 999-9999');
});

/***/ })

/******/ });