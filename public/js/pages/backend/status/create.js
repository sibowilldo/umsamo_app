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
/******/ 	return __webpack_require__(__webpack_require__.s = 197);
/******/ })
/************************************************************************/
/******/ ({

/***/ 197:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(198);


/***/ }),

/***/ 198:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var StatusCreateScript = function () {
  var initStatusCreate = function initStatusCreate() {
    FormValidation.formValidation(document.getElementById('statusCreateForm'), {
      fields: {
        title: {
          validators: {
            notEmpty: {
              message: 'Title is required'
            }
          }
        },
        model_type: {
          validators: {
            notEmpty: {
              message: 'Please select 1 option'
            }
          }
        },
        color: {
          validators: {
            notEmpty: {
              message: 'Please select 1 option'
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
      btn.addClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', true);

      var showErrorMsg = function showErrorMsg(form, type, msg) {
        var alert = $("\n                            <div class=\"alert alert-".concat(type, " alert-dismissible alert-custom alert-primary fade show\" role=\"alert\">\n                                <div class=\"alert-icon\"><i class=\"flaticon-warning\"></i></div>\n                                <div class=\"alert-text\"> ").concat(msg, "</div>\n                                <div class=\"alert-close\">\n                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n                                        <span aria-hidden=\"true\"><i class=\"ki ki-close\"></i></span>\n                                    </button>\n                                </div>\n                            </div>"));
        form.find('.alert').remove();
        alert.prependTo(form);
      };

      axios.post(form.data('action'), {
        title: $('input[name=title]').val(),
        description: $('textarea[name=description]').val(),
        model_type: $('select[name=model_type]').val(),
        color: $('select[name=color]').val(),
        is_active: $('input[name=is_active]').is(':checked')
      }).then(function (response) {
        setTimeout(function () {
          swal.fire({
            icon: 'success',
            title: 'Saved Successfully',
            text: response.data.message,
            preConfirm: function preConfirm() {
              window.location.replace(response.data.url);
            }
          });
          btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false); //
        }, 1000);
      })["catch"](function (error) {
        if (error.response.data.code === 409) {
          swal.fire({
            icon: 'error',
            title: error.response.data.title,
            text: error.response.data.message
          });
          btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
          return;
        }

        var errorBag = error.response.data.errors;
        var error_messages = '';
        Object.entries(errorBag).forEach(function (item, index) {
          error_messages += '<div>' + item[1][0] + '</div>';
        });
        showErrorMsg(form, 'danger', error_messages);
        setTimeout(function () {
          btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
        }, 1000);
      });
    });
  };

  return {
    init: function init() {
      initStatusCreate();
    }
  };
}();

jQuery(document).ready(function () {
  StatusCreateScript.init();
});

/***/ })

/******/ });