import Inputmask from "inputmask";

(function (cash) {
    "use strict";

    Inputmask("datetime", {
        inputFormat: "yyyy/mm/dd",
        placeholder: "_",
        // leapday: "-02-29",
        // alias: "yy.mm.jjjj"
    }).mask("#tursun");

    Inputmask("AA99999999", {
        placeholder: "_",
    }).mask("#register");

    Inputmask("99999999", {
        placeholder: "_",
    }).mask("#code");

})(cash);
