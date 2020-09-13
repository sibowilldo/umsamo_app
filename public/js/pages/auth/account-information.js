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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("Ew54");


/***/ }),

/***/ "Ew54":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var initAccountInformation = function () {
  var cell_validation;
  var email_validation;

  var _changeCellNumberForm;

  var _changeEmailForm;

  var axiosSuccess = function axiosSuccess(response, btn) {
    var destination = response.data.redirect_url;
    window.swal.showLoading();
    window.swal.fire({
      title: response.data.title,
      text: response.data.message,
      icon: 'success',
      timer: 2000,
      onOpen: function onOpen() {
        btn.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
        window.swal.showLoading();
      }
    }).then(function () {
      window.location.replace(destination);
    });
  };

  var axiosError = function axiosError(error) {
    if (error.response.status === 422) {
      var errorBag = error.response.data.errors;
      var error_messages = '';
      Object.entries(errorBag).forEach(function (item, index) {
        error_messages += "<div>".concat(item[1][0], "</div>");
      });
      window.swal.fire({
        icon: 'error',
        title: error.response.data.message,
        html: error_messages
      });
    } else {
      window.swal.fire({
        icon: 'error',
        title: error.response.statusText,
        text: "Please try again!"
      });
    }
  };

  var validationErrorMessage = function validationErrorMessage(btn) {
    window.swal.fire({
      text: "Sorry, looks like there are some errors detected, please try again.",
      icon: "error",
      buttonsStyling: false,
      confirmButtonText: "Ok, got it!",
      customClass: {
        confirmButton: "btn font-weight-bold btn-light"
      }
    }).then(function () {
      KTUtil.scrollTop();
      btn.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
    });
  };

  var handleChangeCellNumber = function handleChangeCellNumber() {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    cell_validation = FormValidation.formValidation(_changeCellNumberForm, {
      fields: {
        cell_number: {
          validators: {
            notEmpty: {
              message: 'We need your cell number to communicate further with you and, to activate your account.'
            },
            regexp: {
              regexp: /^[(]([0-9]{3})[)] ([0-9]{3})[-]([0-9]{4})/,
              message: 'The cell number is missing one or more digits.'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#changeCellNumberSubmit').on('click', function (e) {
      e.preventDefault();
      var submitButton = $(this);
      var formEntries = new FormData(_changeCellNumberForm);
      var formData = {};

      var _iterator = _createForOfIteratorHelper(formEntries.entries()),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var pair = _step.value;
          formData[pair[0]] = pair[1];
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      submitButton.attr('disabled', 'disabled');
      submitButton.addClass('spinner-white spinner spinner-left').removeClass('px-9');
      cell_validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.patch($(_changeCellNumberForm).attr('action'), formData).then(function (response) {
            axiosSuccess(response, submitButton);
          })["catch"](function (error) {
            axiosError(error);
          })["finally"](function () {
            submitButton.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
          });
        } else {
          validationErrorMessage(submitButton);
        }
      });
    });
  };

  var handleChangeEmail = function handleChangeEmail() {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    email_validation = FormValidation.formValidation(_changeEmailForm, {
      fields: {
        email: {
          validators: {
            notEmpty: {
              message: 'We need your email to log you in, send you notifications and, to activate your account.'
            },
            emailAddress: {
              message: 'Value not a valid email address'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#changeEmailSubmit').on('click', function (e) {
      e.preventDefault();
      var submitButton = $(this);
      var formEntries = new FormData(_changeEmailForm);
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

      submitButton.attr('disabled', 'disabled');
      submitButton.addClass('spinner-white spinner spinner-left').removeClass('px-9');
      email_validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.patch($(_changeEmailForm).attr('action'), formData).then(function (response) {
            axiosSuccess(response, submitButton);
          })["catch"](function (error) {
            axiosError(error);
          })["finally"](function () {
            submitButton.removeClass('spinner-white spinner spinner-left').removeAttr('disabled');
          });
        } else {
          validationErrorMessage();
        }
      });
    });
  };

  return {
    // public functions
    init: function init() {
      _changeCellNumberForm = KTUtil.getById('changeCellNumberForm');
      _changeEmailForm = KTUtil.getById('changeEmailForm');
      handleChangeCellNumber();
      handleChangeEmail();
      $('input[name=cell_number]').inputmask('(999) 999-9999');
    }
  };
}();

jQuery(document).ready(function () {
  initAccountInformation.init();
});

/***/ })

/******/ });