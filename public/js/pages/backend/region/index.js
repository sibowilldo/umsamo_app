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
/******/ 	return __webpack_require__(__webpack_require__.s = 187);
/******/ })
/************************************************************************/
/******/ ({

/***/ 187:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(188);


/***/ }),

/***/ 188:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var RegionIndexScript = function () {
  // Private functions
  // demo initializer
  var initRegionIndex = function initRegionIndex() {
    var datatable = $('#kt_datatable').KTDatatable({
      data: {
        saveState: {
          cookie: true
        }
      },
      search: {
        input: $('#kt_datatable_search_query'),
        key: 'generalSearch'
      },
      layout: {
        theme: 'default',
        "class": 'datatable-brand',
        spinner: {
          type: 'loader',
          opacity: 0,
          state: 'brand'
        }
      },
      rows: {
        autoHide: false
      },
      columns: [{
        field: 'REGION',
        title: 'Region',
        autoHide: false
      }, {
        field: 'LOCATION DETAILS',
        title: 'Location Details',
        autoHide: false,
        width: 380
      }, {
        field: 'CREATED',
        title: 'Created',
        autoHide: true,
        type: 'date',
        format: 'YYYY-MM-DD'
      }, {
        field: 'ACTION',
        title: 'Action',
        width: 200,
        textAlign: 'center',
        sortable: false,
        autoHide: false,
        locked: {
          right: 'lg'
        }
      }]
    });
    datatable.on('datatable-on-init, datatable-on-layout-updated', function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
    datatable.on('click', '.deleteBtn', function () {
      var deleteBtn = $(this);
      var record = deleteBtn.data("record");
      var url = deleteBtn.data("url");
      swal.fire({
        title: 'Are you sure?',
        text: "Confirm that you would like to delete this entry",
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        showLoaderOnConfirm: true,
        preConfirm: function preConfirm() {
          return new Promise(function (resolve) {
            axios["delete"](url, {
              id: record
            }).then(function (response) {
              swal.fire({
                'icon': 'info',
                title: 'Deleted!',
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
      initRegionIndex();
    }
  };
}();

jQuery(document).ready(function () {
  RegionIndexScript.init(); // $('[data-toggle="tooltip"]').tooltip();
});

/***/ })

/******/ });