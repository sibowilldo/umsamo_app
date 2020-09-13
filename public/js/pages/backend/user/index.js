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
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("EuGe");


/***/ }),

/***/ "EuGe":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var UserIndexScript = function () {
  // Private functions
  // Module
  var initUserIndex = function initUserIndex() {
    var $ = jQuery.noConflict();
    var columns = [{
      data: 'profile.fullname',
      name: 'profile.first_name'
    }, {
      data: 'profile.fullname',
      name: 'profile.last_name'
    }, {
      data: 'email',
      name: 'email'
    }, {
      data: 'profile.cell_number',
      name: 'profile.cell_number'
    }, {
      data: 'profile.province',
      name: 'profile.province'
    }, {
      data: 'created_at',
      name: 'created_at'
    }, {
      data: 'is_locked',
      name: 'is_locked',
      responsivePriority: -1
    }, {
      data: 'action',
      orderable: false,
      searchable: false
    }];
    var table = $('#users-table').DataTable({
      dom: 'lrtip',
      processing: true,
      responsive: true,
      serverSide: true,
      ajax: {
        url: '/ajax/users',
        data: function data(d) {
          var range = [];
          var start = $('input[name=start]').val();
          var end = $('input[name=end]').val();
          start ? range.push(moment(start).format('YYYY-MM-DD HH:mm:ss')) : '';
          end ? range.push(moment(end + ' 23:59:59').format('YYYY-MM-DD HH:mm:ss')) : '';
          d.joined_between = range;
        }
      },
      columns: columns,
      columnDefs: [{
        targets: [0, 3],
        searchable: true,
        visible: false
      }, {
        targets: 1,
        title: 'Patient',
        render: function render(data, type, user, meta) {
          return "\n                                    <div class=\"d-flex align-items-center\">\n                                        <div class=\"symbol symbol-50 flex-shrink-0\">\n                                            <img src=\"".concat(user.profile.avatar, "\" alt=\"").concat(user.profile.fullname, "\">\n                                        </div>\n                                        <div class=\"ml-3\">\n                                            <span class=\"text-dark-75 font-weight-bold line-height-sm d-block pb-2\">").concat(user.profile.fullname, "</span>\n                                            <div class=\"text-muted text-hover-primary\">").concat(user.profile.id_number, "</div>\n                                        </div>\n                                    </div>");
        }
      }, {
        targets: 2,
        title: 'Contact',
        render: function render(data, type, user, meta) {
          return "\n                                    <div>\n                                        <span class=\"text-dark-75 font-weight-bold line-height-sm d-block pb-2\">".concat(user.profile.cell_number, "</span>\n                                        <a class=\"text-primary font-size-sm text-hover-dark\" href=\"mailto:").concat(user.email, "\">").concat(user.email, "</a>\n                                    </div>");
        }
      }, {
        targets: 4,
        title: 'Address',
        render: function render(data, type, user, meta) {
          return "\n                                    <div>\n                                        <span class=\"text-dark-75 font-weight-bold line-height-sm d-block pb-2\">".concat(user.profile.province, "</span>\n                                        <span class=\"text-muted font-size-sm text-hover-primary\">").concat(user.profile.address, "</span>\n                                    </div>");
        }
      }, {
        targets: 5,
        title: 'Joined',
        searchable: false,
        visible: true,
        render: function render(data, type, user, meta) {
          return "\n                                    <div>\n                                        <span class=\"text-dark-75 font-weight-bold line-height-sm d-block pb-2\"> ".concat(moment(data).fromNow(), "</span>\n                                        <span class=\"text-muted font-size-sm text-hover-primary\">").concat(user.created_at, "</span>\n                                    </div>");
        }
      }, {
        targets: 6,
        title: 'Lock',
        render: function render(data, type, user, meta) {
          return "\n                                    <span class=\"switch switch-sm switch-icon\">\n                                        <label>\n                                            <input type=\"checkbox\" ".concat(data ? 'checked' : '', " data-user=\"").concat(user.uuid, "\" name=\"lock-user\" class=\"toggle-lock\">\n                                            <span></span>\n                                        </label>\n                                    </span>");
        }
      }],
      initComplete: function initComplete() {}
    });
    table.on('click', '.deleteBtn', function () {
      var deleteBtn = $(this);
      var url = deleteBtn.data("url");
      swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: "Confirm that you would like to Delete this user.",
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        cancelButtonText: 'No, Leave it!',
        showLoaderOnConfirm: true,
        customClass: {
          confirmButton: 'btn btn-danger',
          cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false,
        preConfirm: function preConfirm() {
          return new Promise(function (resolve) {
            axios["delete"](url).then(function (response) {
              Toast.fire({
                'icon': 'info',
                title: 'User Deleted Successfully!',
                text: response.data.message
              });
              table.draw();
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
    table.on('change', '.toggle-lock', function () {
      var user = $(this).data('user');
      axios.patch("ajax/users/toggle-lock/".concat(user)).then(function (response) {
        Toast.fire({
          icon: 'success',
          title: response.data.title,
          text: response.data.message
        });
      })["catch"](function (error) {
        Toast.fire({
          icon: 'error',
          title: error.response.statusText,
          text: error.response.data.message
        });
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
        $(this).val('');
        table.column($(this).data('col-index')).search('', false, false);
      });
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
    }
  };
}();

jQuery(document).ready(function () {
  UserIndexScript.init();
});

/***/ })

/******/ });