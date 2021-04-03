import Toastify from "toastify-js";

(function (cash) {
    "use strict";

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

    cash("#hariult-songolt").on("change", function () {
        if(cash(this).val() == "neg")
        {   
            cash(".neg").show();
            cash(".olon").hide();
            cash(".nuhuh").hide();
        }
        else if(cash(this).val() == "olon")
        {
            cash(".neg").hide();
            cash(".olon").show();
            cash(".nuhuh").hide();
        }
        else if(cash(this).val() == "nuhuh")
        {
            cash(".neg").hide();
            cash(".olon").hide();
            cash(".nuhuh").show();
        }
        else
        {
            console.log('songolt bhgui')
        }
    });

    let n = 2;
    let m = 2;

    cash("body").on("click", '#neg-add', function () {
        if(n <= 8){
            cash("#neg_container").append('<div class="box px-4 py-4 mb-3 flex items-center zoom-in"><div class="w-10">'+n+'.</div><div class="w-10"><input type="radio" name="zuv[]" class="input border mr-2 mt-1" value="'+n+'"></div><div class="input-form ml-4 w-7/12"><input type="input" name="hariult['+n+']" tabindex="'+n+'" class="input w-full border" placeholder="Хариулт" required data-pristine-required-message="Хариулт хоосон байж болохгүй"></div><div class="flex justify-center items-center w-20"><a class="flex items-center text-theme-6 hariult-delete" href="#"> Устгах</a></div></div>');
            Toastify({
                    text: "Нэг сонголттой хариулт нэмэгдлээ!",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#91C714",
                    stopOnFocus: true,
                }).showToast();
        }else{
            Toastify({
                text: "8 хариулалтаас илүү боломжгүй!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#D32929",
                stopOnFocus: true,
            }).showToast();
        }

        n++;
    });

    // cash("body").on("click", '#neg-add', function () {
    //     if(n <= 8){
    //         var xhttp;
    //         var viewer = cash(this).data("viewer");
    //         var ajax = "/bigg/shalgalt/ajax_hariult_add?id=" + n;
    
    //         xhttp = new XMLHttpRequest();
    //         xhttp.onreadystatechange = function() {
    //             if (xhttp.readyState == 4 && xhttp.status == 200) {
    //                 document.getElementById(viewer).innerHTML += xhttp.responseText;
    //             }
    //         }
    //         xhttp.open("GET", ajax, true);
    //         xhttp.send();

    //         Toastify({
    //                 text: "Нэг сонголттой хариулт нэмэгдлээ!",
    //                 duration: 3000,
    //                 newWindow: true,
    //                 close: true,
    //                 gravity: "bottom",
    //                 position: "right",
    //                 backgroundColor: "#91C714",
    //                 stopOnFocus: true,
    //             }).showToast();
    //     }else{
    //         Toastify({
    //             text: "8 хариулалтаас илүү боломжгүй!",
    //             duration: 3000,
    //             newWindow: true,
    //             close: true,
    //             gravity: "bottom",
    //             position: "right",
    //             backgroundColor: "#D32929",
    //             stopOnFocus: true,
    //         }).showToast();
    //     }

    //     n++;
    // });


    cash("body").on("click", '#olon-add', function () {
        if(m <= 8){
            cash("#olon_container").append('<div class="box px-4 py-4 mb-3 flex items-center zoom-in"><div class="w-10">'+m+'.</div><div class="w-10"><input type="checkbox" name="zuv2[]" class="input border mr-2 mt-1" value="'+m+'"> </div><div class="input-form ml-4 w-7/12"><input type="input" name="hariult2['+m+']" tabindex="'+m+'" class="input w-full border" placeholder="Хариулт" required data-pristine-required-message="Хариулт хоосон байж болохгүй"></div><div class="flex justify-center items-center w-20"><a title="Устгах" class="tooltip flex items-center text-theme-6 hariult-delete2" href="#"> Устгах</a></div></div>');
            Toastify({
                    text: "Олон сонголттой хариулт нэмэгдлээ!",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#91C714",
                    stopOnFocus: true,
                }).showToast();
        }else{
            Toastify({
                text: "8 хариулалтаас илүү боломжгүй!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#D32929",
                stopOnFocus: true,
            }).showToast();
        }

        m++;
    });

    cash("body").on("click", '.hariult-delete', function () {
        cash(this).parent().parent().remove();
        n--;
        Toastify({
            text: "Таны сонгосон хариултыг устгалаа!",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#FBC500",
            stopOnFocus: true,
        }).showToast();
    });

    cash("body").on("click", '.hariult-delete2', function () {
        cash(this).parent().parent().remove();
        m--;
        Toastify({
            text: "Таны сонгосон хариултыг устгалаа!",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#FBC500",
            stopOnFocus: true,
        }).showToast();
    });


    cash("body").on("click", '.ajax_shalgalt', function (e) {
        e.preventDefault();
        var xhttp;
        var viewer = cash(this).data("viewer");
        var ajax = cash(this).data("ajax");

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById(viewer).innerHTML = xhttp.responseText;
            }
        }
        xhttp.open("GET", ajax, true);
        xhttp.send();
    });

})(cash);

