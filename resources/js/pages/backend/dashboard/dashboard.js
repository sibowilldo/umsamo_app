"use strict";

var DashboardScripts = function () {
    // Private functions
    var initDashboardMakeAppointment = ()=> {
        let btnSubmit = $('.btn-make-appointment');
        btnSubmit.on('click', (e)=>{
            e.preventDefault();

            let form = btnSubmit.closest('form');
            console.log($(this) + 'something else');
        })
    }


    var initBootstrapSelect = function () {
        // minimum setup
        $('.kt-selectpicker').selectpicker({
            container: 'body'
        });
    }

    return {
        // public functions
        init: function() {
            initBootstrapSelect();
            initDashboardMakeAppointment();
        }
    };
}();

jQuery(document).ready(function() {
    DashboardScripts.init();
});
