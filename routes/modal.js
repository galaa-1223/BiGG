import Toastify from "toastify-js";

(function (cash) {
    // Show or hide global event listener
    let events = [];
    let Did = 0;
    let Numb = 0;
    let Udr = 0;
    let delNum = 0;
    let delUdur = 0;
    let huvaari = [];
    let del_huvaari = [];

    // Get highest z-index
    function getHighestZindex() {
        let zIndex = 52;
        cash(".modal").each(function () {
            if (
                cash(this).css("z-index") !== "auto" &&
                cash(this).css("z-index") > zIndex
            ) {
                zIndex = parseInt(cash(this).css("z-index"));
            }
        });

        return zIndex;
    }

    function galaa(){
        alert('Galaa');
    }

    // Get scrollbar width
    function getScrollbarWidth(el) {
        return window.innerWidth - cash(el)[0].clientWidth;
    }

    // Show modal with z-index
    function show(el) {
        // Move modal element to body
        cash(
            '<div data-modal-replacer="' + cash(el).attr("id") + '"></div>'
        ).insertAfter(el);
        cash(el).css({
            "margin-top": 0,
            "margin-left": 0,
        });
        cash(el).appendTo("body");

        // Show modal by highest z-index
        setTimeout(() => {
            cash(el)
                .addClass("show")
                .css("z-index", getHighestZindex() + 1);
        }, 200);

        // Setting up modal scroll
        cash("body")
            .css(
                "padding-right",
                parseInt(cash("body").css("padding-right")) +
                    getScrollbarWidth("html") +
                    "px"
            )
            .addClass("overflow-y-hidden");
        cash(".modal")
            .removeClass("overflow-y-auto")
            .css("padding-left", "0px");
        cash(el)
            .addClass("overflow-y-auto")
            .css("padding-left", getScrollbarWidth(el) + "px")
            .addClass(cash(".modal.show").length ? "modal__overlap" : "");

        // Trigger callback function
        events.forEach(function (val, key) {
            if (
                cash(el).attr("id") == cash(val.el).attr("id") &&
                val.event == "on.show"
            ) {
                events[key].triggerCallback = true;
            }
        });
    }

    // Hide modal & remove modal scroll
    function hide(el) {
        if (cash(el).hasClass("modal") && cash(el).hasClass("show")) {
            cash(el).removeClass("show");

            setTimeout(() => {
                cash(el)
                    .removeAttr("style")
                    .removeClass("modal__overlap")
                    .removeClass("overflow-y-auto");

                // Add scroll to highest z-index modal if exist
                cash(".modal").each(function () {
                    if (
                        parseInt(cash(this).css("z-index")) ===
                        getHighestZindex()
                    ) {
                        cash(this)
                            .addClass("overflow-y-auto")
                            .css(
                                "padding-left",
                                getScrollbarWidth(this) + "px"
                            );
                    }
                });

                // Return back scroll to body if no more modal showed up
                if (getHighestZindex() == 52) {
                    cash("body")
                        .removeClass("overflow-y-hidden")
                        .css("padding-right", "");
                }

                // Return back modal element to it's first place
                cash(
                    '[data-modal-replacer="' + cash(el).attr("id") + '"]'
                ).replaceWith(el);
            }, 200);

            // Trigger callback function
            events.forEach(function (val, key) {
                if (
                    cash(el).attr("id") == cash(val.el).attr("id") &&
                    val.event == "on.hide"
                ) {
                    events[key].triggerCallback = true;
                }
            });

            // Toastify({
            //     text: "Үйлдлийг цуцаллаа!",
            //     duration: 3000,
            //     newWindow: true,
            //     close: true,
            //     gravity: "bottom",
            //     position: "right",
            //     backgroundColor: "#D32929",
            //     stopOnFocus: true,
            // }).showToast();
        }
    }

    // Toggle modal
    function toggle(el) {
        if (cash(el).hasClass("modal") && cash(el).hasClass("show")) {
            hide(el);
        } else {
            show(el);
        }
    }

    // On show
    function onShow(el, callback) {
        events[events.length] = {
            el: el,
            event: "on.show",
            triggerCallback: false,
            callback: callback,
        };
    }

    // On hide
    function onHide(el, callback) {
        events[events.length] = {
            el: el,
            event: "on.hide",
            triggerCallback: false,
            callback: callback,
        };
    }

    // Show modal
    cash("body").on("click", 'a[data-toggle="modal"]', function () {
        show(cash(this).attr("data-target"));
    });

    // Hide modal
    cash("body").on("click", function (event) {
        hide(event.target);
    });

    // Dismiss modal by link
    cash("body").on("click", '[data-dismiss="modal"]', function () {
        let modal = cash(this).closest(".modal")[0];
        hide(modal);
    });

    cash("body").on("click", '.delete_button', function () {
        Did = cash(this).data("id");
        show(cash(this).data("target"));
    });

    cash("body").on("click", '.modal_delete_button', function () {
        // cash('.modal_delete_button').attr('disabled','disabled');
        cash('.modal_delete_button').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
        cash(".t_id").val(Did);
        return true;
    });

    cash("body").on("click", '.modal_form', function () {

        // document.getElementById('huvaari-hicheel').value = '1';
        // document.getElementById('huvaari-deeguur').value = '0';
        // document.getElementById('huvaari-dooguur').value = '0';

        cash('#huvaari-angi-deeguur').val('');
        cash('#huvaari-angi-dooguur').val('');

        if(!cash(this).find('.hicheel_closed').length)
        {
            cash(".huvaari-udur").val(cash(this).data('col'));
            cash(".huvaari-tsag").val(cash(this).data('row'));

            Numb = cash(this).data('number');
            Udr = cash(this).data('udur');

            cash(".huvaari-dooguur-container").hide();

            show("#huvaari-modal-preview");
        }
    });

    cash("body").on("mouseover", ".huvaari_view", function() {
        cash(this).find(".hicheel_closed").show();
    });

    cash("body").on("mouseout", ".huvaari_view", function() {
        cash(this).find(".hicheel_closed").hide();
    });

    cash("body").on("click", ".hicheel_closed", function() {
        delNum = cash(this).parents('.modal_form').data("number");
        delUdur = cash(this).parents('.modal_form').data("udur");

        show("#delete-confirmation-modal");
    });

    cash('#huvaari-hicheel').on('change', function() {
        if(cash('#huvaari-hicheel').val() == 2){
            cash(".huvaari-dooguur-container").show();
            cash(".huvaari-garchig1").html('Дээгүүр 7 хоног:');
        }else{
            cash(".huvaari-dooguur-container").hide();
            cash(".huvaari-garchig1").html('Орох хичээл:');
        }
    });

    function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

        for (var i = 0; i < arraytosearch.length; i++) {
    
            if (arraytosearch[i][key] == valuetosearch) {
                return i;
            }
        }
            return null;
    }

    cash("body").on("click", '#huvaari-insert', function () {

        if(cash('#huvaari-deeguur').val() != 0 || cash('#huvaari-dooguur').val() != 0){

            let angiSelDe = document.getElementById('huvaari-deeguur');
            let angiSelDo = document.getElementById('huvaari-dooguur');

            let angiNameDe = angiSelDe.selectedOptions[0].dataset.angi;
            let hicheelNameDe = angiSelDe.selectedOptions[0].dataset.hicheel;
            let idDe = angiSelDe.selectedOptions[0].dataset.id;
            
            let angiNameDo = angiSelDo.selectedOptions[0].dataset.angi;
            let hicheelNameDo = angiSelDo.selectedOptions[0].dataset.hicheel;
            let idDo = angiSelDo.selectedOptions[0].dataset.id;

            let angiDe = cash("#huvaari-angi-deeguur").val();
            let angiDo = cash("#huvaari-angi-dooguur").val();
            let clAngiDe = 0;
            let clAngiDo = 0;

            if(angiDe == ''){
                angiDe = '';
            }else{
                clAngiDe = angiDe;
                angiDe = '/' + angiDe;
            }

            if(angiDo == ''){
                angiDo = '';
            }else{
                clAngiDo = angiDo;
                angiDo = '/' + angiDo;
            }

            if(angiNameDe == undefined){
                angiNameDe = '';
                hicheelNameDe = 'Хичээлгүй';
                angiDe = '';
            }

            if(hicheelNameDo == undefined){
                angiNameDo = '';
                hicheelNameDo = 'Хичээлгүй';
                angiDo = '';
            }

            if(idDe == undefined){
                idDe = 0;
            }

            if(idDo == undefined){
                idDo = 0;
            }

            if(cash('#huvaari-hicheel').val() == 2){
                cash(".table-" + Udr + "-" + Numb).html('<div class="box-border p-1 bg-theme-12 zoom-in huvaari_view"><div class="font-medium text-base">'+hicheelNameDe+''+angiDe+'</div><div class="text-gray-600">'+angiNameDe+'</div><div class="box-border p-1 bg-theme-9 zoom-in"><div class="font-medium text-base">'+hicheelNameDo+''+angiDo+'</div><div class="text-gray-600">'+angiNameDo+'</div></div><div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div></div>');
            }else{
                cash(".table-" + Udr + "-" + Numb).html('<div class="box-border p-1 bg-theme-12 zoom-in huvaari_view"><div class="font-medium text-base">'+hicheelNameDe+''+angiDe+'</div><div class="text-gray-600">'+angiNameDe+'</div><div class="hidden hicheel_closed w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">x</div></div>');
            }

            huvaari.push(["table-" + Udr + "-" + Numb, Udr, Numb, idDe, idDo, clAngiDe, clAngiDo, cash('#huvaari-hicheel').val()]); //tsag, udur, fond ID deeguur, fond ID dooguur, angi deeguur, angi dooguur;
            
            // console.log(huvaari);

            hide("#huvaari-modal-preview");
        }else{
            Toastify({
                text: "Хичээлээ сонгоно уу!",
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


    cash("body").on("click", '.modal_delete_button2', function () {

        var index = functiontofindIndexByKeyValue(huvaari, [0], "table-" + delUdur + "-" + delNum);

        // if(index != huvaari.length - 1){

        if(index == null){
            del_huvaari.push([delUdur, delNum]);
        }else{
            huvaari.splice(index, 1);
        }

        // console.log(del_huvaari);
        // console.log(huvaari);
        
        cash(".table-" + delUdur + "-" + delNum).find(".huvaari_view").remove();
        hide("#delete-confirmation-modal");
    });

    cash("body").on("click", '.huvaari_save', function () {
        cash('#huvaaries').val(JSON.stringify(huvaari)); 
        cash('#delete_huvaaries').val(JSON.stringify(del_huvaari)); 
        return true;
    });



    // Detect show or hide event
    setInterval(function () {
        events.forEach(function (val, key) {
            if (val.event == "on.show" && val.triggerCallback) {
                val.callback();
                events[key].triggerCallback = false;
            } else if (val.event == "on.hide" && val.triggerCallback) {
                val.callback();
                events[key].triggerCallback = false;
            }
        });
    }, 300);

    cash.fn.modal = function (event, callback) {
        if (event == "show") {
            show(this);
        } else if (event == "hide") {
            hide(this);
        } else if (event == "toggle") {
            toggle(this);
        } else if (event == "on.show") {
            onShow(this, callback);
        } else if (event == "on.hide") {
            onHide(this, callback);
        }
    };
})(cash);