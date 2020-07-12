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
/******/ 	return __webpack_require__(__webpack_require__.s = 171);
/******/ })
/************************************************************************/
/******/ ({

/***/ 171:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(172);


/***/ }),

/***/ 172:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var initAuthChangePassword = function () {
  // Base elements
  var passwordMeter = $('#passwordMeter');

  var randomNumber = function randomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  };

  var validation;
  var formEl;

  var handleAuthChangePasswordFormSubmit = function handleAuthChangePasswordFormSubmit() {
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    validation = FormValidation.formValidation(formEl, {
      fields: {
        email: {
          validators: {
            notEmpty: {
              message: 'Email address required.'
            },
            emailAddress: {
              message: 'Invalid email address provided.'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Please provide a new password.'
            }
          }
        },
        password_confirmation: {
          validators: {
            notEmpty: {
              message: 'Password Confirmation is required.'
            },
            identical: {
              compare: function compare() {
                return $('[name="password"]').val();
              },
              message: 'The password and its confirm needs to be the same.'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap(),
        passwordStrength: new FormValidation.plugins.PasswordStrength({
          field: 'password',
          message: 'The password is weak',
          minimalScore: 3,
          onValidated: function onValidated(valid, message, score) {
            switch (score) {
              case 0:
                passwordMeter.css('width', randomNumber(1, 20) + '%');
                passwordMeter.addClass('bg-danger').removeClass('bg-brand bg-success bg-warning');

              case 1:
                passwordMeter.css('width', randomNumber(20, 40) + '%');
                passwordMeter.addClass('bg-danger').removeClass('bg-brand bg-success bg-warning');
                break;

              case 2:
                passwordMeter.css('width', randomNumber(40, 60) + '%');
                passwordMeter.addClass('bg-warning').removeClass('bg-danger bg-brand bg-success');
                break;

              case 3:
                passwordMeter.css('width', randomNumber(60, 80) + '%');
                passwordMeter.addClass('bg-success').removeClass('bg-danger bg-brand bg-warning');
                break;

              case 4:
                passwordMeter.css('width', '100%');
                passwordMeter.addClass('bg-brand').removeClass('bg-danger bg-success bg-warning');
                break;

              default:
                break;
            }
          }
        })
      }
    });
    $('#changePasswordSubmitButton').on('click', function (e) {
      e.preventDefault();
      var changePasswordSubmitButton = $(this);
      var changePasswordForm = $(formEl);
      changePasswordSubmitButton.prop('disabled', true);
      changePasswordSubmitButton.text('Requesting Change...').addClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').removeClass('btn-primary');
      validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.post(changePasswordForm.attr('action'), {
            token: $('input[name=token]').val(),
            email: $('input[name=email]').val(),
            password: $('input[name=password]').val(),
            password_confirmation: $('input[name=password_confirmation]').val()
          }).then(function (response) {
            var destination = response.data.redirect_url;
            window.swal.showLoading();
            window.swal.fire({
              title: 'Change Password Success',
              text: 'Redirecting...',
              icon: 'success',
              timer: 2000,
              onOpen: function onOpen() {
                window.swal.showLoading();
              }
            }).then(function () {
              window.location.replace(destination !== null && destination !== void 0 ? destination : '/');
            });
          })["catch"](function (error) {
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
          })["finally"](function () {
            changePasswordSubmitButton.prop('disabled', false);
            changePasswordSubmitButton.text('Update Changes').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('btn-primary');
          });
        } else {
          changePasswordSubmitButton.prop('disabled', false);
          changePasswordSubmitButton.text('Update Changes').removeClass('spinner-dark spinner spinner-left px-15 btn-light btn-pill btn-hover-light').addClass('btn-primary');
        }
      });
    });
  };

  return {
    init: function init() {
      formEl = KTUtil.getById('changePasswordForm');
      handleAuthChangePasswordFormSubmit();
    }
  };
}();

jQuery(document).ready(function () {
  initAuthChangePassword.init();
});

/***/ })

/******/ });