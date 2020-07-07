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
/******/ 	return __webpack_require__(__webpack_require__.s = 173);
/******/ })
/************************************************************************/
/******/ ({

/***/ 173:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(174);


/***/ }),

/***/ 174:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var DashboardClient = function () {
  // Base elements
  var _appointment_datepicker;

  var _datepicker_card = new KTCard('datepicker-card');

  var _event_date = $('input[name=event_date]');

  var _event_dates = {};

  var _with_family;

  var _family_member;

  var _formEl;

  var _wizardEl;

  var _wizard;

  var _validations = [];

  var _step_3_validation;

  var _datepicker_options = {
    viewMode: 'days',
    format: 'YYYY-MM-DD',
    inline: true,
    defaultDate: false,
    daysOfWeekDisabled: [0, 6],
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
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
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

      if (!_with_family.prop('checked')) {
        _step_3_validation.disableValidator('family_member', 'notEmpty');

        $('input[name=family]').length ? _step_3_validation.disableValidator('family', 'notEmpty') : '';
      }

      _appointment_datepicker.on('dp.change', function () {
        _validations[wizard.getStep() - 1].revalidateField('event_date');
      });

      switch (_wizard.getStep()) {
        // Set up Review information for the last step
        case 2:
          var form_data = new FormData(_formEl);
          var output = '',
              outputContainer = $('#review_info');
          var family_members_output = {};

          var _iterator = _createForOfIteratorHelper(form_data.entries()),
              _step;

          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var pair = _step.value;

              if (pair[0] === "family_member") {
                family_members_output = $('#family_member option:selected').map(function (item, v) {
                  return "<tr><th scope=\"row\">MEMBER</th><td>".concat($(v).text(), "</td></tr>");
                });
              } else if (pair[0] === "family") {
                output += "<tr><th scope=\"row\">".concat(pair[0].toUpperCase().replace(/_/g, ' '), "</th><td>").concat($('input[name=family]:checked').data('family-name'), "</td></tr>");
              } else if (pair[1] !== "") {
                output += "<tr><th scope=\"row\">".concat(pair[0].toUpperCase().replace(/_/g, ' '), "</th><td>").concat(pair[1], "</td></tr>");
              }
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }

          outputContainer.html(output);

          if (!$.isEmptyObject(family_members_output)) {
            family_members_output.map(function (index, item) {
              outputContainer.append(item);
            });
          }

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
    _validations.push(FormValidation.formValidation(_formEl, {
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
              message: 'Please choose Appointment type'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    })); // Step 2


    _step_3_validation = FormValidation.formValidation(_formEl, {
      fields: {
        family_member: {
          validators: {
            notEmpty: {
              message: 'Please select at least one family member'
            }
          }
        },
        family: {
          validators: {
            notEmpty: {
              message: 'Family is required'
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

    var with_family = _with_family;
    var family_member = $('#family_member');
    with_family.on('change', function () {
      if (with_family.prop('checked')) {
        $('input[name=family]').length ? _step_3_validation.enableValidator('family', 'notEmpty') : '';

        _step_3_validation.enableValidator('family_member', 'notEmpty');

        $('.family_container').removeClass('d-none');
        family_member.prop('disabled', false);

        _family_member.selectpicker('show');

        _family_member.selectpicker('refresh');
      } else {
        $('input[name=family]').length ? _step_3_validation.disableValidator('family', 'notEmpty') : '';

        _step_3_validation.disableValidator('family_member', 'notEmpty');

        $('.family_container').addClass('d-none');
        family_member.prop('disabled', true);

        _family_member.selectpicker('hide');

        _family_member.selectpicker('refresh');
      }
    });
  };

  var initEventDates = function initEventDates() {
    axios.get('ajax/event-dates').then(function (response) {
      _event_dates = response.data.data;

      _appointment_datepicker.on('dp.show', function (e) {
        var limit_label = $('#limit_value');
        var consultation_option = $('#consultation_option');
        limit_label.text('');

        _event_dates.some(function (item) {
          var selected_date = moment(item.date_time);
          var is_weekend = false;

          switch (selected_date.weekday()) {
            case 0:
            case 6:
              is_weekend = true;
              break;
          }

          if (is_weekend) {
            return false;
          } else {
            $('input[name=event_date]').attr('data-id', item.id);
            limit_label.html("<strong>".concat(selected_date.format('MMM DD, YYYY'), "</strong> has\n                                            <strong>").concat(item.limit, "</strong> ").concat(item.limit === 1 ? 'spot' : 'spots', "\n                                            available for consultation."));

            _event_date.val(selected_date.format('YYYY-MM-DD'));

            if (item.limit < 1) {
              consultation_option.attr('disabled', 'disabled').parent().addClass('radio-disabled');
              return true;
            }

            return true;
          }
        });
      });
    })["catch"](function (error) {
      console.log(error);
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
    });
  };

  var initReactiveFormFields = function initReactiveFormFields() {
    // minimum setup
    _family_member.selectpicker({
      container: 'body',
      style: 'form-control-lg form-control-solid',
      styleBase: 'form-control'
    });

    _family_member.selectpicker('hide');
  };

  var initBootstrapCalendar = function initBootstrapCalendar() {
    KTApp.block(_datepicker_card.getSelf(), {
      overlayColor: '#000000',
      type: 'loader',
      state: 'primary',
      message: 'Loading Available Dates...',
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
      var consultation_option = $('#consultation_option');
      limit_label.text('');

      _event_dates.some(function (item) {
        var selected_date = moment(item.date_time);

        if (selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD')) {
          $('input[name=event_date]').attr('data-id', item.id);
          limit_label.html("<strong>".concat(selected_date.format('MMM DD, YYYY'), "</strong> has\n                                            <strong>").concat(item.limit, "</strong> ").concat(item.limit === 1 ? 'spot' : 'spots', "\n                                            available for consultation."));

          if (item.limit < 1) {
            consultation_option.attr('disabled', 'disabled').parent().addClass('radio-disabled');
            return selected_date.format('YYYY-MM-DD') === e.date.format('YYYY-MM-DD');
          }

          _event_date.val(e.date.format('YYYY-MM-DD'));
        } else {
          consultation_option.removeAttr('disabled').prop('checked', false).parent().removeClass('radio-disabled');
        }
      });
    });
  };

  var handleAuthRegisterFormSubmit = function handleAuthRegisterFormSubmit() {
    var submitButton = $('#make_appointment');
    submitButton.click(function (e) {
      e.preventDefault();
      var formEntries = new FormData(_formEl);
      var formData = {};
      var family_members = [];

      var _iterator2 = _createForOfIteratorHelper(formEntries.entries()),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var pair = _step2.value;

          if (pair[0] === 'family_member') {
            family_members.push(pair[1]);
          } else {
            formData[pair[0]] = pair[1];
          }
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      if (family_members.length > 0) {
        formData['family_members'] = family_members;
      }

      formData['event_date'] = $('input[name=event_date]').data('id');
      submitButton.attr('disabled', 'disabled');
      submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');
      axios.post($(_formEl).attr('action'), formData).then(function (response) {
        swal.fire({
          title: response.data.title,
          text: response.data.message,
          icon: 'success',
          timer: 2000,
          onOpen: function onOpen() {
            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
            swal.showLoading();
          }
        }).then(function () {
          if (response.data.url) {
            window.location.replace(response.data.url);
          }
        });
      })["catch"](function (error) {
        submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Submit');
        var error_title = 'Oops! Unexpected Error Occurred.';
        var error_messages = 'Please report this to administrators.';

        if (error.hasOwnProperty('response')) {
          error_title = "".concat(error.response.status, " ").concat(error.response.statusText);

          if (error.response.hasOwnProperty('data')) {
            error_messages = "".concat(error.response.data.message);

            if (error.response.data.hasOwnProperty('error')) {
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
      _wizardEl = KTUtil.getById('kt_wizard_v2');
      _formEl = KTUtil.getById('makeAppointment');
      _family_member = $('#family_member');
      _with_family = $('input[name=with_family]');
      _appointment_datepicker = $('.datepicker');
      initEventDates();
      initReactiveFormFields();
      initWizard();
      initValidation();
      handleAuthRegisterFormSubmit();
    }
  };
}();

jQuery(document).ready(function () {
  DashboardClient.init();
  $('input[name=cell_number]').inputmask('(999) 999-9999');
});

/***/ })

/******/ });