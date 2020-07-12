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
/******/ 	return __webpack_require__(__webpack_require__.s = 165);
/******/ })
/************************************************************************/
/******/ ({

/***/ 165:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(166);


/***/ }),

/***/ 166:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var initAuthLogin = function () {
  var validation;

  var handleAuthLoginFormSubmit = function handleAuthLoginFormSubmit() {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    validation = FormValidation.formValidation(KTUtil.getById('loginForm'), {
      fields: {
        email: {
          validators: {
            notEmpty: {
              message: 'Email is required'
            },
            emailAddress: {
              message: 'Value not a valid email address'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Password is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#loginSubmitButton').on('click', function (e) {
      e.preventDefault();
      var loginSubmitButton = $(this);
      var loginForm = loginSubmitButton.closest('form');
      loginSubmitButton.prop('disabled', true);
      loginSubmitButton.text('Signing you in...').addClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').removeClass('px-8 btn-primary');
      validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.post(loginForm.data('action'), {
            email: $('input[name=email]').val(),
            password: $('input[name=password]').val()
          }).then(function (response) {
            var destination = response.data.url;
            loginSubmitButton.prop('disabled', false);
            loginSubmitButton.text('Redirecting...').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
            window.swal.showLoading();
            window.swal.fire({
              title: 'Login Success',
              text: 'Redirecting...',
              icon: 'success',
              timer: 2000,
              onOpen: function onOpen() {
                window.swal.showLoading();
              }
            }).then(function () {
              window.location.replace(destination);
            });
          })["catch"](function (error) {
            loginSubmitButton.prop('disabled', false);
            loginSubmitButton.text('Sign In').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');

            if (error.response.status >= 500) {
              window.swal.fire({
                icon: 'error',
                title: error.response.statusText,
                text: "Please try again!"
              }).then(function () {
                window.location.reload();
              });
            } else if (error.response.status > 401) {
              window.swal.fire({
                icon: 'error',
                title: error.response.statusText,
                text: error.response.data.errors.email[0]
              }).then(function () {
                window.location.reload();
              });
            } else {
              window.swal.fire({
                icon: 'error',
                title: error.response.data.title,
                text: error.response.data.text
              });
            }
          });
        } else {
          loginSubmitButton.prop('disabled', false);
          loginSubmitButton.text('Sign In').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('px-8 btn-primary');
        }
      });
    });
  };

  return {
    init: function init() {
      handleAuthLoginFormSubmit();
    }
  };
}();

jQuery(document).ready(function () {
  initAuthLogin.init();
});

/***/ })

/******/ });