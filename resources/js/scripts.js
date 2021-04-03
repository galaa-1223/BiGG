import Toastify from "toastify-js";

(function (cash) {
    "use strict";

    let events = [];
    let Did = 0;
    let Numb = 0;
    let Udr = 0;
    let delNum = 0;
    let delUdur = 0;
    let huvaari = [];
    let del_huvaari = [];

    cash("#remove-image").on("click", function () {
        cash("#preview-image").attr("src", '/dist/images/Blank-avatar.png');
        cash("#remove-image").hide();
        cash("#image").val(null);
    });

    cash("#image").on("change", function () {
        var file = cash(this).get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                cash("#preview-image").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }

        cash("#remove-image").show();
    });

    cash("body").on("click", '.delete_button', function () {
        Did = cash(this).data("id");
        let del = cash(this).data("target");
        cash(del).modal("show");
    });

    cash("body").on("click", '.modal_delete_button', function () {
        cash('.modal_delete_button').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
        cash(".t_id").val(Did);
        return true;
    });

    cash("body").on("click", '.modal_form', function () {

        if(cash(this).find('.huvaari_view').length == 0){
            cash(".huvaari-udur").val(cash(this).data('col'));
            cash(".huvaari-tsag").val(cash(this).data('row'));

            // alert(typeof cash('#huvaari-hicheel').val());

            if(cash('#huvaari-hicheel').val() == '1'){
                document.querySelector('#huvaari-hicheel').options[0].selected = true;
                document.querySelector('#huvaari-deeguur').options[0].selected = true;
                document.querySelector('#huvaari-dooguur').options[0].selected = true;
                // alert('neg');
            }

            document.querySelector('#huvaari-angi-deeguur-kabinet').value = '';
            document.querySelector('#huvaari-angi-dooguur-kabinet').value = '';

            Numb = cash(this).data('number');
            Udr = cash(this).data('udur');

            cash(".huvaari-dooguur-container").hide();

            cash("#huvaari-modal-preview").modal("show");
        }
    });

    

    // cash('.huvaari-event').on("dragstart", function (event) {
    //     var dt = event.originalEvent.dataTransfer;
    //     dt.setData('Text', cash(this).attr('id'));
    // });

    // cash('.huvaari-table td').on("dragenter dragover drop", function (event) {	
    //     event.preventDefault();
    //     if (event.type === 'drop') {
    //         var data = event.originalEvent.dataTransfer.getData('Text',cash(this).attr('id'));
    //         de=cash('#'+data).detach();
    //         de.appendTo(cash(this));	
    //     };
    // });

    cash("body").on("mouseover", ".huvaari_view", function() {
        cash(this).find(".hicheel_closed").show();
    });

    cash("body").on("mouseout", ".huvaari_view", function() {
        cash(this).find(".hicheel_closed").hide();
    });

    cash("body").on("click", ".hicheel_closed", function() {
        delNum = cash(this).parents('.modal_form').data("number");
        delUdur = cash(this).parents('.modal_form').data("udur");

        cash("#delete-confirmation-modal").modal("show");
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

        if(cash('#huvaari-deeguur').val() == '' && cash('#huvaari-dooguur').val() == 0 && cash('#huvaari-hicheel').val() == 1 || cash('#huvaari-deeguur').val() == '' && cash('#huvaari-dooguur').val() == 0 && cash('#huvaari-hicheel').val() == 2){
            Toastify({
                node: cash("#failed-notification-content2")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom",
                position: "right",
                stopOnFocus: true,
            }).showToast();
        }else{
            let angiSelDe = document.getElementById('huvaari-deeguur');
            let angiSelDo = document.getElementById('huvaari-dooguur');

            let angiNameDe = angiSelDe.selectedOptions[0].dataset.angi;
            let hicheelNameDe = angiSelDe.selectedOptions[0].dataset.hicheel;
            let idDe = angiSelDe.selectedOptions[0].dataset.id;
            
            let angiNameDo = angiSelDo.selectedOptions[0].dataset.angi;
            let hicheelNameDo = angiSelDo.selectedOptions[0].dataset.hicheel;
            let idDo = angiSelDo.selectedOptions[0].dataset.id;

            let angiDe = cash("#huvaari-angi-deeguur-kabinet").val();
            let angiDo = cash("#huvaari-angi-dooguur-kabinet").val();
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

            cash("#huvaari-modal-preview").modal("hide");
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
        // hide("#delete-confirmation-modal");
        cash("#delete-confirmation-modal").modal("hide");
    });

    cash("body").on("click", '.huvaari_save', function () {
        cash('#huvaaries').val(JSON.stringify(huvaari)); 
        cash('#delete_huvaaries').val(JSON.stringify(del_huvaari)); 
        return true;
    });


})(cash);

