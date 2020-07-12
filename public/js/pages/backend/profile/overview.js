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


function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var ProfileOverview = function () {
  var validation;

  var _createFamilyForm;

  var handleCreateFamilyGroup = function handleCreateFamilyGroup() {
    validation = FormValidation.formValidation(_createFamilyForm, {
      fields: {
        family_name: {
          validators: {
            notEmpty: {
              message: 'Family name is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#createFamilyButton').on('click', function (e) {
      e.preventDefault();
      var submitButton = $(this);
      var formEntries = new FormData(_createFamilyForm);
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
      submitButton.text('Processing...').addClass('spinner-white spinner spinner-left').removeClass('px-9');
      validation.validate().then(function (status) {
        if (status === 'Valid') {
          window.axios.post($(_createFamilyForm).attr('action'), formData).then(function (response) {
            var destination = response.data.redirect_url;
            window.swal.showLoading();
            window.swal.fire({
              title: response.data.title,
              text: response.data.message,
              icon: 'success',
              timer: 2000,
              onOpen: function onOpen() {
                submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Save Changes');
                window.swal.showLoading();
              }
            }).then(function () {
              window.location.replace(destination);
            });
          })["catch"](function (error) {
            window.swal.fire({
              icon: 'error',
              title: "".concat(error.response.statusText, " (").concat(error.response.status, ")"),
              text: error.response.data.message
            });
            submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Create');
          });
        } else {
          //Validation Failed
          submitButton.removeClass('spinner-white spinner spinner-left').addClass('px-9').removeAttr('disabled').text('Create');
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
          });
        }
      });
    });
  };

  var handleSearchMember = function handleSearchMember() {
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

    var validateIdNumber = function validateIdNumber(idNumber) {
      var checkIDNumber = function checkIDNumber(idNumber) {
        var number = idNumber.substring(0, idNumber.length - 1);
        return generateLuhnDigit(number) === +idNumber[idNumber.length - 1];
      };

      var result = {};
      result.valid = checkIDNumber(idNumber);
      return result;
    };

    var btnSendInvite = $('.inviteMember');
    btnSendInvite.on('click', function (ev) {
      ev.preventDefault();
      var selected_family = $(this);
      window.swal.fire({
        title: 'Look up Member by ID Number',
        text: 'The Member must already be registered, and have their account verified!',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: function preConfirm(id_number) {
          var is_valid = validateIdNumber(id_number);

          if (!is_valid.valid) {
            swal.fire({
              icon: 'error',
              title: 'Invalid RSA ID Number',
              confirmButtonText: 'Close'
            });
            return;
          }

          return axios.get("/profiles/search/".concat(id_number)).then(function (response) {
            if (response.status !== 200) {
              throw new Error(response.statusText);
            }

            return response.data.profile;
          })["catch"](function (error) {
            var message = error.response.status === 501 ? error.response.data.message : error;
            swal.showValidationMessage("".concat(message));
          });
        },
        allowOutsideClick: function allowOutsideClick() {
          return !swal.isLoading();
        }
      }).then(function (result) {
        if (result.value) {
          var message = result.value.user.email_verified_at ? "<b>Active user since:</b>  ".concat(moment(result.value.user.email_verified_at).format('ddd, MMM Do YYYY')) : 'Cannot Invite Unverified user!';
          var member = result.value;
          swal.fire({
            title: "Found ".concat(member.fullname),
            html: "".concat(message),
            imageUrl: result.value.avatar_url,
            showCancelButton: true,
            showConfirmButton: !!result.value.user.email_verified_at,
            confirmButtonText: 'Send Invite',
            preConfirm: function preConfirm() {
              axios.post("/families/".concat(selected_family.data('family-id'), "/invite"), {
                member: member.id_number
              }).then(function (response) {
                if (response.status !== 201) {
                  throw new Error(response.statusText);
                }

                swal.fire({
                  icon: 'success',
                  title: 'Invite Sent',
                  html: "".concat(member.fullname, " was invited to join: ").concat(selected_family.data('family-name')),
                  confirmButtonText: 'Close'
                });
                return response.data.profile;
              })["catch"](function (error) {
                swal.showValidationMessage("".concat(error));
              });
            }
          });
        }
      });
    });
  };

  return {
    // public functions
    init: function init() {
      _createFamilyForm = KTUtil.getById('createFamilyForm');
      handleSearchMember();
      handleCreateFamilyGroup();
    }
  };
}();

jQuery(document).ready(function () {
  ProfileOverview.init();
});

/***/ })

/******/ });