import Pristine from "pristinejs";
import Toastify from "toastify-js";

(function (cash) {
    "use strict";


    cash(".validate-form").each(function () {
        let pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-theme-6 mt-2",
        });

        pristine.addValidator(
            cash(this).find('input[name="tursun"]')[0],
            function (value) {
                let expression = /^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/;
                
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            },
            "Төрсөн огноо формат таарахгүй байна!",
            2,
            false
        );

        pristine.addValidator(
            cash(this).find('input[name="register"]')[0],
            function (value) {
                let expression = /^([\u0410-\u042F]|Ү|Ө){2}\d{8}$/;
                
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            },
            "Регистрийн формат таарахгүй байна!",
            2,
            false
        );

        cash(this).on("submit", function (e) {
            if(!pristine.validate()){
                e.preventDefault();

                Toastify({
                    text: "Формыг бүрэн бөглөнө үү!",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#D32929",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    });
})(cash);
