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
/******/ 	return __webpack_require__(__webpack_require__.s = 195);
/******/ })
/************************************************************************/
/******/ ({

/***/ 195:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(196);


/***/ }),

/***/ 196:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var AppointmentIndexScript = function () {
  // Private functions
  // Module
  var initAppointmentIndex = function initAppointmentIndex() {
    var datatable = $('#kt_datatable').KTDatatable({
      data: {
        saveState: {
          cookie: false
        }
      },
      search: {
        input: $('#kt_datatable_search_query'),
        key: 'generalSearch'
      },
      layout: {
        scroll: true,
        height: 500,
        spinner: {
          type: 'loader'
        }
      },
      rows: {
        autoHide: false
      },
      columns: [{
        field: 'reference',
        title: 'REFERENCE',
        type: 'number',
        autoHide: false,
        textAlign: 'center'
      }, {
        field: 'scheduledFor',
        title: 'SCHEDULED FOR',
        autoHide: false,
        textAlign: 'center'
      }, {
        field: 'status',
        title: 'STATUS',
        autoHide: false,
        width: 150
      }, {
        field: 'type',
        title: 'TYPE',
        autoHide: false,
        width: 150
      }, {
        field: 'reserved',
        title: 'RESERVED',
        autoHide: true,
        width: 100
      }, {
        field: 'action',
        title: 'ACTION',
        textAlign: 'right',
        sortable: false,
        autoHide: false
      }]
    });
    $('#kt_datatable_search_status').on('change', function () {
      datatable.search($(this).val().toLowerCase(), 'STATUS');
    });
    $('#kt_datatable_search_type').on('change', function () {
      datatable.search($(this).val().toLowerCase(), 'TYPE');
    });
    $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    datatable.on('datatable-on-init, datatable-on-layout-updated', function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
    datatable.on('click', '.cancelBtn', function () {
      var cancelBtn = $(this);
      var record = cancelBtn.data("record");
      var url = cancelBtn.data("url");
      swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: "Confirm that you would like to cancel this Appointment",
        showCancelButton: true,
        confirmButtonText: 'Yes, Cancel Appointment!',
        cancelButtonText: 'No, Leave it!',
        showLoaderOnConfirm: true,
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        preConfirm: function preConfirm() {
          return new Promise(function (resolve) {
            axios.patch(url, {
              id: record
            }).then(function (response) {
              swal.fire({
                'icon': 'info',
                title: 'Appointment Cancelled Successfully!',
                text: response.data.message,
                preConfirm: function preConfirm() {
                  window.location.replace(response.data.url);
                }
              });
            })["catch"](function (error) {
              if (error.response.data.code === 409) {
                swal.fire({
                  icon: 'error',
                  title: error.response.data.title,
                  text: error.response.data.message
                });
                return;
              }

              swal.fire({
                icon: 'error',
                title: error.response.statusText,
                text: error.response.data.message
              });
            });
          });
        },
        allowOutsideClick: false
      });
    });
  };

  return {
    // Public functions
    init: function init() {
      initAppointmentIndex();
    }
  };
}();

jQuery(document).ready(function () {
  AppointmentIndexScript.init();
});

/***/ })

/******/ });