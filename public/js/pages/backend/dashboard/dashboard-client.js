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
/******/ 	return __webpack_require__(__webpack_require__.s = 167);
/******/ })
/************************************************************************/
/******/ ({

/***/ 167:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(168);


/***/ }),

/***/ 168:
/***/ (function(module, exports) {

var DashboardPatientScripts = function () {
  // Private functions
  var initDashboardMakeAppointment = function initDashboardMakeAppointment() {
    var btnSubmit = $('.btn-make-appointment');
    btnSubmit.on('click', function (e) {
      var btn = $(this);
      e.preventDefault();
      var form = btn.closest('form');
      var event_date = $("#event_date_".concat(btn.data('id'))).selectpicker('val');
      var appointment_type = $("#appointment_type_".concat(btn.data('id'))).selectpicker('val');

      if (!event_date) {
        swal.fire({
          icon: 'warning',
          title: 'Request failed',
          text: 'Please make sure that you have selected a date for your appointment.'
        });
        return;
      }

      KTApp.block(form, {
        overlayColor: '#ffffff',
        state: 'info',
        message: 'Please wait...',
        opacity: 0.7
      });
      axios.post(form.attr('action'), {
        user: $("input[name=_self]").val(),
        event_date: event_date,
        appointment_type: appointment_type
      }).then(function (response) {
        setTimeout(function () {
          swal.fire({
            icon: 'success',
            title: 'Your request was successful!',
            text: response.data.message,
            preConfirm: function preConfirm() {
              window.location.replace(response.data.url);
            }
          });
          btn.removeClass('spinner spinner-sm spinner-white spinner-right').attr('disabled', false);
          KTApp.unblock(form); //
        }, 1000);
      })["catch"](function (error) {
        console.error(error.response);

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
        setTimeout(function () {
          KTApp.unblock(form);
        }, 1000);
      });
    });
    $('select[name=event_date]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      var event_date = $(this);
      var id = event_date.data('id');
      var appointment_types = $("#appointment_type_".concat(id));

      if (event_date.find(':selected').data('limit') < 1) {
        appointment_types.find('[value=Consulting]').remove();
        appointment_types.selectpicker('refresh');
      } else {
        var optionExist = false;
        appointment_types.find('option').each(function () {
          if ($(this).val() === 'Consulting') {
            optionExist = true;
          }
        });

        if (!optionExist) {
          appointment_types.append("<option value='Consulting'>Consulting</option>");
          appointment_types.selectpicker('refresh');
        }
      }
    });
  };

  var initBootstrapSelect = function initBootstrapSelect() {
    // minimum setup
    $('.kt-selectpicker').selectpicker({
      container: 'body'
    });
  };

  return {
    // public functions
    init: function init() {
      initBootstrapSelect();
      initDashboardMakeAppointment();
    }
  };
}();

jQuery(document).ready(function () {
  DashboardPatientScripts.init();
});

/***/ })

/******/ });