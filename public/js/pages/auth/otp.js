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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "00rH":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var CellVerificationModule = function () {
  var verifyModule = function verifyModule() {
    var validation;
    validation = FormValidation.formValidation(KTUtil.getById('verifyForm'), {
      fields: {
        onetime: {
          validators: {
            notEmpty: {
              message: 'OTP Required'
            },
            stringLength: {
              max: 5,
              min: 5,
              message: 'Invalid OTP!'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#verifyButton').on('click', function (e) {
      e.preventDefault();
      var btnSubmit = $(this);
      var form = $('#verifyForm');
      validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.post(form.attr('action'), {
            'onetime': $('input[name=onetime]').val()
          }).then(function (response) {
            swal.fire({
              icon: 'success',
              title: response.data.title,
              text: response.data.message
            }).then(function () {
              var _response$data$redire;

              window.location.replace((_response$data$redire = response.data.redirect_url) !== null && _response$data$redire !== void 0 ? _response$data$redire : '/');
            });
          })["catch"](function (error) {
            console.log(error);
            swal.fire({
              icon: 'error',
              title: error.response.data.title,
              text: error.response.data.message
            });
          })["finally"](function () {
            $('input[name=onetime]').val('');
          });
        }
      });
    });
  };

  var requestAnotherModule = function requestAnotherModule() {
    $('#requestAnotherButton').on('click', function (e) {
      e.preventDefault();
      var btnSubmit = $(this);
      var form = $('#requestAnotherForm');
      window.axios.post(form.attr('action')).then(function (response) {
        swal.fire({
          icon: 'success',
          title: response.data.title,
          text: response.data.message
        }).then(function () {
          btnSubmit.prop('disabled', true).text('OTP Sent!');
        });
      })["catch"](function (error) {
        swal.fire({
          icon: 'error',
          title: error.response.data.title,
          text: error.response.data.message
        });
      })["finally"](function () {
        $('input[name=onetime]').val('');
      });
    });
  };

  return {
    init: function init() {
      verifyModule();
      requestAnotherModule();
    }
  };
}();

jQuery(document).ready(function () {
  CellVerificationModule.init();
});

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("00rH");


/***/ })

/******/ });