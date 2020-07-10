"use strict";
var ValidateIDNumber = function(idNumber){
    var the = this;
    var rsaID = idNumber;
    var generateLuhnDigit = function(inputString) {
        var total = 0;
        var count = 0;
        for (var i = 0; i < inputString.length; i++) {
            var multiple = count % 2 + 1;
            count++;
            var temp = multiple * +inputString[i];
            temp = Math.floor(temp / 10) + (temp % 10);
            total += temp;
        }

        total = (total * 9) % 10;

        return total;
    };

    the.isValid = function() {
        var number = rsaID.substring(0, rsaID.length - 1);
        return generateLuhnDigit(number) === +rsaID[rsaID.length - 1];
    };

    the.getBirthdate = function() {
        var year = rsaID.substring(0, 2);
        var currentYear = new Date().getFullYear() % 100;

        var prefix = "19";
        if (+year < currentYear)
            prefix = "20";

        var month = rsaID.substring(2, 4);
        var day = rsaID.substring(4, 6);
        return moment(prefix + year + "/" + month + "/" + day, "YYYY-MM-DD");
    };

    the.getGender = function() {
        return +rsaID.substring(6, 7) < 5 ? "F" : "M";
    };

    the.getCitizenship = function() {
        return +rsaID.substring(10, 11) === 0 ? "citizen" : "resident";
    };
}


// webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = ValidateIDNumber;
}
