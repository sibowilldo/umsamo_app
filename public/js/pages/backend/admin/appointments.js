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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("PQsw");


/***/ }),

/***/ "PQsw":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var AdminAppointmentIndexScript = function () {
  // Private functions
  // Module
  var statuses = [];

  var initUserIndex = function initUserIndex() {
    var $ = jQuery.noConflict();
    var columns = [{
      data: 'reference',
      name: 'reference'
    }, {
      data: 'event_date.date_time',
      name: 'event_date.date_time'
    }, {
      data: 'type',
      name: 'type'
    }, {
      data: 'appointmentable.profile.fullname'
    }, {
      data: 'status_id',
      name: 'status_id'
    }, {
      data: 'appointmentable.profile.id_number',
      name: 'id_number'
    }, {
      data: 'appointmentable.email',
      name: 'appointmentable.email'
    }, {
      data: 'appointmentable.profile.cell_number',
      name: 'cell_number'
    }, {
      data: 'action',
      name: 'action'
    }];
    var table = $('#appointments-table').DataTable({
      dom: 'Brtip',
      processing: true,
      responsive: true,
      serverSide: true,
      ajax: {},
      columns: columns,
      columnDefs: [{
        targets: [5, 6, 7],
        visible: false
      }, {
        targets: 0,
        title: 'Reference',
        render: function render(data, type, appointment, meta) {
          return "\n                                <div class=\"d-flex align-items-center\">\n                                    <span class=\"bullet bullet-bar bg-".concat(appointment.status.color, " align-self-stretch pb-10 mr-4\"></span>\n                                    <div class=\"font-weight-bolder\"> ").concat(appointment.reference, "\n                                        <span class=\"font-size-xs text-muted text-uppercase d-block\">\n                                            User Appointment\n                                        </span>\n                                    </div>\n                                </div> ");
        }
      }, {
        targets: 1,
        title: 'Date & Type',
        sortable: false,
        render: function render(data, type, appointment, meta) {
          return "\n                                    <div class=\"d-flex align-items-center\">\n                                        <div>\n                                            <span\n                                            class=\"text-dark-75 d-block text-hover-primary mb-1 font-size-lg\">\n                                                ".concat(appointment.event_date.date_time, "</span>\n                                            <span class=\"text-muted font-weight-bold  d-block\">\n                                                ").concat(appointment.type, "\n                                            </span>\n                                        </div>\n                                    </div>\n                                    ");
        }
      }, {
        targets: 2,
        sortable: false,
        title: 'Scheduled By',
        render: function render(data, type, appointment, meta) {
          return "\n                                <div class=\"d-flex align-items-center\">\n                                    <div class=\"symbol symbol-40 symbol-sm flex-shrink-0\">\n                                        <img class=\"\" src=\"".concat(appointment.appointmentable.profile.avatar_url, "\" alt=\"").concat(appointment.appointmentable.profile.fullname, "\">\n                                    </div>\n                                    <div class=\"ml-4\">\n                                        <div class=\"text-dark-75 font-size-lg mb-0\">\n                                             ").concat(appointment.appointmentable.profile.fullname, "\n                                        </div>\n                                        <span class=\"text-muted d-block\">\n                                            ").concat(appointment.appointmentable.profile.id_number, "\n                                        </span>\n                                    </div>\n                                </div> ");
        }
      }, {
        targets: 3,
        title: 'Contact',
        sortable: false,
        render: function render(data, type, appointment, meta) {
          return "\n                                    <div class=\"d-flex align-items-center\">\n                                        <div>\n                                            <span class=\"text-dark-75 d-blocktext-hover-primary mb-1 font-size-lg\">\n                                                ".concat(appointment.appointmentable.profile.cell_number, "\n                                            </span>\n                                            <span class=\"text-muted font-size-sm d-block\">\n                                                ").concat(appointment.appointmentable.email, "\n                                            </span>\n                                        </div>\n                                    </div>");
        }
      }, {
        targets: 4,
        sortable: true,
        title: 'Status',
        render: function render(data, type, appointment, meta) {
          var options = '';
          data.statuses.map(function (item) {
            options += "<option value=\"".concat(item.id, "\" ").concat(item.id === appointment.status.id ? 'selected' : '', ">").concat(item.title, "</option>");
          });
          return "<select class=\"form-control datatable-input select-picker border-2 border-".concat(appointment.status.color, " text-").concat(appointment.status.color, "\" name=\"status_id\" id=\"").concat(appointment.uuid, "\">").concat(options, "</select>");
        }
      }, {
        targets: 8,
        title: 'Action',
        sortable: false,
        render: function render(data, type, appointment, meta) {
          return "\n                                    <div class=\"d-flex align-items-center justify-content-start\">\n                                        <a href=\"/appointments/".concat(appointment.uuid, "\" class=\"btn btn-icon-btn-clean text-hover-primary\"><i class=\"la la-eye\"> </i></a>\n                                    </div>");
        }
      }],
      initComplete: function initComplete() {}
    });
    table.on('change', '.select-picker', function (e) {
      var status_id = $(e.currentTarget).val();
      var appointment = $(e.currentTarget).attr('id');
      window.axios.patch("/administrator/appointments/".concat(appointment, "/status"), {
        status_id: status_id
      }).then(function (response) {
        Toast.fire({
          icon: 'success',
          title: response.data.title,
          text: response.data.message
        });
        table.table().draw();
      })["catch"](function (error) {
        Toast.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Something has went wrong trying to update the status. Details have been logged!'
        });
        console.log(error);
      });
    });
    $('#kt_search').on('click', function (e) {
      e.preventDefault();
      var params = {};
      $('.datatable-input').each(function () {
        var i = $(this).data('col-index');

        if (params[i]) {
          params[i] += '|' + $(this).val();
        } else {
          params[i] = $(this).val();
        }
      });
      $.each(params, function (i, val) {
        // apply search params to datatable
        table.column(i).search(val ? val : '', false, false);
      });
      table.table().draw();
    });
    $('#kt_reset').on('click', function (e) {
      e.preventDefault();
      $('.datatable-input').each(function () {
        $(this).val(null);
        table.column($(this).data('col-index')).search('', false, false);
      });
      $('#filter-status').trigger('change');
      table.table().draw();
    });
    $('#kt_datepicker').datepicker({
      todayHighlight: true,
      autoclose: true,
      orientation: "bottom left",
      format: 'yyyy-mm-dd',
      templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
      }
    });
  };

  return {
    // Public functions
    init: function init() {
      initUserIndex();
      $('.filter-select').select2();
    }
  };
}();

jQuery(document).ready(function () {
  AdminAppointmentIndexScript.init();
});

/***/ })

/******/ });