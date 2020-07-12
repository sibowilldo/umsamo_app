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
/******/ 	return __webpack_require__(__webpack_require__.s = 181);
/******/ })
/************************************************************************/
/******/ ({

/***/ 181:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(182);


/***/ }),

/***/ 182:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var EventCreateFunction = function () {
  var za_holidays = [];
  $('.selectpicker').selectpicker();
  var datepickerOptions = {
    viewMode: 'months',
    format: 'YYYY-MM-DD',
    minDate: moment(),
    sideBySide: true,
    disabledDates: za_holidays,
    icons: {
      next: 'flaticon2-right-arrow',
      previous: 'flaticon2-left-arrow',
      up: 'flaticon2-up',
      down: 'flaticon2-down'
    }
  }; // Private functions

  var initDateTimeRepeater = function initDateTimeRepeater() {
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
      afterAdd: function afterAdd() {
        $('.datetimepicker').datetimepicker(datepickerOptions);
      }
    });
  };

  var initHolidays = function initHolidays() {
    axios.get('/cronos/public-holidays').then(function (response) {
      response.data.map(function (item) {
        za_holidays.push(moment(item).format('YYYY-MM-DD'));
      });
      $('.datetimepicker').datetimepicker(datepickerOptions);
    })["catch"](function (error) {
      console.log(error);
    });
  };

  var initFormSmartControl = function initFormSmartControl() {
    $('input[name=auto_select_dates]').on('change', function () {
      if (this.checked) {
        $('.r-btnAdd').hide();
      } else {
        $('.r-btnAdd').show();
      }
    });
  };

  var initEventCreateFormValidation = function initEventCreateFormValidation() {
    FormValidation.formValidation(document.getElementById('eventCreateForm'), {
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
              message: 'Value is not a valid date'
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
    }).on('core.form.valid', function () {
      var btn = $('#submitForm');
      var form = btn.closest('form');
      form.submit();
    });
  };

  return {
    // public functions
    init: function init() {
      initHolidays();
      initDateTimeRepeater();
      initFormSmartControl();
      initEventCreateFormValidation();
    }
  };
}();

jQuery(document).ready(function () {
  EventCreateFunction.init();
});

/***/ })

/******/ });