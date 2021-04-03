import xlsx from "xlsx";
import feather from "feather-icons";
import Tabulator from "tabulator-tables";

(function (cash) {
    "use strict";

    let Did = 0;

    // Tabulator
    if (cash("#teacher_tabulator").length) {
        // Setup Tabulator

        let table = new Tabulator("#teacher_tabulator", {
            ajaxURL: "http://" + bigg_URL + "/api/v1/teachers",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Мэдээлэл алга байна!",
            locale:true,
            langs:{
                "mn-mn":{
                    "columns":{
                        "name":"Нэр",
                    },
                    "ajax":{
                        "loading":"Уншиж байна...", 
                        "error":"Алдаатай байна.", 
                    },
                    "groups":{ 
                        "item":"item",
                        "items":"items",
                    },
                    "pagination":{
                        "page_size":"Харагдац",
                        "first":'<',
                        "first_title":"Эхэнд", 
                        "last":">>",
                        "last_title":"Төгсгөлд",
                        "prev":"<",
                        "prev_title":"Өмнөх",
                        "next":">",
                        "next_title":"Дараагийн",
                    },
                    "headerFilters":{
                        "default":"Багана шүүх...",
                        "columns":{
                            "name":"Багана шүүх...",
                        }
                    }
                }
            },
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "БАГШ НЭР",
                    minWidth: 200,
                    responsive: 0,
                    field: "ner",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let ovog = cell.getData().ovog;
                        return `<div>
                            <div class="font-medium whitespace-nowrap">
                            ${ovog.slice(0,1)}. ${cell.getData().ner}
                            </div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">${
                                cell.getData().mergejil
                            }</div>
                        </div>`;
                    },
                },
                {
                    title: "ТЭНХИМ",
                    minWidth: 50,
                    field: "tenhim",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center items-center">
                            <a class="flex items-center mr-3 tooltip" title="`+ cell.getData().tenhim +`" href="javascript:;">
                                ` + cell.getData().tovch + `
                            </a>
                        </div>`;
                    },
                },
                {
                    title: "ЗУРАГ",
                    minWidth: 200,
                    field: "image",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        let image = (cell.getData().image == null) ? "/dist/images/Blank-avatar.png" : "/uploads/teachers/thumbs/" + cell.getData().image;
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="BiGG system" class="rounded-full" src="${image}">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "БАГШ КОД",
                    minWidth: 200,
                    field: "code",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false
                },
                {
                    title: "ТӨЛӨВ",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center ${
                            cell.getData().status
                                ? "text-theme-9"
                                : "text-theme-6"
                        }">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${
                                cell.getData().status ? "Active" : "Inactive"
                            }
                        </div>`;
                    },
                },
                {
                    title: "ҮЙЛДЭЛ",
                    minWidth: 200,
                    field: "actions",
                    hozAlign: "center",
                    vertAlign: "middle",
                    responsive: 1,
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        var a = cash("<div class=\"flex lg:justify-center items-center\">\n                            <a class=\"edit flex items-center mr-3\" href='/bigg/teachers/edit/" + cell.getData().id + "'>\n                                <i data-feather=\"check-square\" class=\"w-4 h-4 mr-1\"></i> Засах\n                            </a>\n                            <a class=\"delete flex items-center text-theme-6\" href=\"javascript:;\">\n                                <i data-feather=\"trash-2\" class=\"w-4 h-4 mr-1\"></i> Устгах\n                            </a>\n                        </div>");
                        cash(a).find(".delete").on("click", function () {
                            Did = cell.getData().id;
                            cash("#delete-confirmation-modal").modal("show");
                        });
                        return a[0];
                    },
                },

                // For print format
                {
                    title: "PRODUCT NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CATEGORY",
                    field: "category",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "REMAINING STOCK",
                    field: "remaining_stock",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "STATUS",
                    field: "status",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue() ? "Active" : "Inactive";
                    },
                },
                {
                    title: "IMAGE 1",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[0];
                    },
                },
                {
                    title: "IMAGE 2",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[1];
                    },
                },
                {
                    title: "IMAGE 3",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[2];
                    },
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        table.setLocale("mn-mn");

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = "like";
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("ner");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });

        cash("body").on("click", '.modal_delete_button_tabulator', function () {
            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
            cash(".t_id").val(Did);
            return true;
        });
    }



    if (cash("#student_tabulator").length) {
        // Setup Tabulator

        let table = new Tabulator("#student_tabulator", {
            ajaxURL: "http://" + bigg_URL + "/api/v1/students",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Мэдээлэл алга байна!",
            locale:true,
            langs:{
                "mn-mn":{
                    "columns":{
                        "name":"Нэр",
                    },
                    "ajax":{
                        "loading":"Уншиж байна...", 
                        "error":"Алдаатай байна.", 
                    },
                    "groups":{ 
                        "item":"item",
                        "items":"items",
                    },
                    "pagination":{
                        "page_size":"Харагдац",
                        "first":'<',
                        "first_title":"Эхэнд", 
                        "last":">>",
                        "last_title":"Төгсгөлд",
                        "prev":"<",
                        "prev_title":"Өмнөх",
                        "next":">",
                        "next_title":"Дараагийн",
                    },
                    "headerFilters":{
                        "default":"Багана шүүх...",
                        "columns":{
                            "name":"Багана шүүх...",
                        }
                    }
                }
            },
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "ОЮУТАН НЭР",
                    minWidth: 200,
                    responsive: 0,
                    field: "ner",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let ovog = cell.getData().ovog;
                        return `<div>
                            <div class="font-medium whitespace-nowrap">
                            ${ovog.slice(0,1)}. ${cell.getData().ner}
                            </div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">
                            ${cell.getData().angi} ${cell.getData().course}${cell.getData().buleg}
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "ЗУРАГ",
                    minWidth: 200,
                    field: "image",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        let image = (cell.getData().image == null) ? "/dist/images/Blank-avatar.png" : "/uploads/teachers/thumbs/" + cell.getData().image;
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="BiGG system" class="rounded-full" src="${image}">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "ОЮУТНЫ КОД",
                    minWidth: 200,
                    field: "code",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false
                },
                {
                    title: "ТӨЛӨВ",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        let text = '';
                        let clss = '';

                        if(cell.getData().status == "1"){
                            text = "Суралцаж байгаа";
                            clss = "text-theme-9";
                        }else if(cell.getData().status == "2"){
                            text = "Шилжсэн";
                            clss = "text-theme-11";
                        }else if(cell.getData().status == "3"){
                            text = "Чөлөө авсан";
                            clss = "text-theme-10";
                        }else if(cell.getData().status == "4"){
                            text = "Хасагдсан";
                            clss = "text-theme-6";
                        }
                        
                        return `<div class="flex items-center lg:justify-center ${clss}">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${text}
                        </div>`;
                    },
                },
                {
                    title: "ҮЙЛДЭЛ",
                    minWidth: 200,
                    field: "actions",
                    hozAlign: "center",
                    vertAlign: "middle",
                    responsive: 1,
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        var a = cash("<div class=\"flex lg:justify-center items-center\">\n                            <a class=\"edit flex items-center mr-3\" href='/bigg/teachers/edit/" + cell.getData().id + "'>\n                                <i data-feather=\"check-square\" class=\"w-4 h-4 mr-1\"></i> Засах\n                            </a>\n                            <a class=\"delete flex items-center text-theme-6\" href=\"javascript:;\">\n                                <i data-feather=\"trash-2\" class=\"w-4 h-4 mr-1\"></i> Устгах\n                            </a>\n                        </div>");
                        cash(a).find(".delete").on("click", function () {
                            Did = cell.getData().id;
                            cash("#delete-confirmation-modal").modal("show");
                        });
                        return a[0];
                    },
                },

                // For print format
                {
                    title: "PRODUCT NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CATEGORY",
                    field: "category",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "REMAINING STOCK",
                    field: "remaining_stock",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "STATUS",
                    field: "status",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue() ? "Active" : "Inactive";
                    },
                },
                {
                    title: "IMAGE 1",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[0];
                    },
                },
                {
                    title: "IMAGE 2",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[1];
                    },
                },
                {
                    title: "IMAGE 3",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[2];
                    },
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        table.setLocale("mn-mn");

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = "like";
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("ner");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });

        cash("body").on("click", '.modal_delete_button_tabulator', function () {
            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
            cash(".t_id").val(Did);
            return true;
        });
    }
    


    if (cash("#teacher_huvaari_tabulator").length) {
        // Setup Tabulator

        let table = new Tabulator("#teacher_huvaari_tabulator", {
            ajaxURL: "http://" + bigg_URL + "/api/v1/huvaari/teachers",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Мэдээлэл алга байна!",
            locale:true,
            langs:{
                "mn-mn":{
                    "columns":{
                        "name":"Нэр",
                    },
                    "ajax":{
                        "loading":"Уншиж байна...", 
                        "error":"Алдаатай байна.", 
                    },
                    "groups":{ 
                        "item":"item",
                        "items":"items",
                    },
                    "pagination":{
                        "page_size":"Харагдац",
                        "first":'<',
                        "first_title":"Эхэнд", 
                        "last":">>",
                        "last_title":"Төгсгөлд",
                        "prev":"<",
                        "prev_title":"Өмнөх",
                        "next":">",
                        "next_title":"Дараагийн",
                    },
                    "headerFilters":{
                        "default":"Багана шүүх...",
                        "columns":{
                            "name":"Багана шүүх...",
                        }
                    }
                }
            },
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "БАГШ НЭР",
                    minWidth: 200,
                    responsive: 0,
                    field: "ner",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let ovog = cell.getData().ovog;
                        return `<div>
                            <div class="font-medium whitespace-nowrap">
                            ${ovog.slice(0,1)}. ${cell.getData().ner}
                            </div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">${
                                cell.getData().mergejil
                            }</div>
                        </div>`;
                    },
                },
                {
                    title: "ТЭНХИМ",
                    minWidth: 50,
                    field: "tenhim",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center items-center">
                            <a class="flex items-center mr-3 tooltip" title="`+ cell.getData().tenhim +`" href="javascript:;">
                                ` + cell.getData().tovch + `
                            </a>
                        </div>`;
                    },
                },
                {
                    title: "ЗУРАГ",
                    minWidth: 200,
                    field: "image",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        let image = (cell.getData().image == null) ? "/dist/images/Blank-avatar.png" : "/uploads/teachers/thumbs/" + cell.getData().image;
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="BiGG system" class="rounded-full" src="${image}">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "БАГШ КОД",
                    minWidth: 200,
                    field: "code",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false
                },
                {
                    title: "ҮЙЛДЭЛ",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center text-theme-9">
                                    <a class="flex items-center mr-3" href="/bigg/huvaari/bagsh/${cell.getData().id}">
                                        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Хичээлийн хуваарь
                                    </a>
                                </div>`;
                    },
                },

                // For print format
                {
                    title: "PRODUCT NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CATEGORY",
                    field: "category",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "REMAINING STOCK",
                    field: "remaining_stock",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "STATUS",
                    field: "status",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue() ? "Active" : "Inactive";
                    },
                },
                {
                    title: "IMAGE 1",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[0];
                    },
                },
                {
                    title: "IMAGE 2",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[1];
                    },
                },
                {
                    title: "IMAGE 3",
                    field: "images",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue()[2];
                    },
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        table.setLocale("mn-mn");

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = "like";
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("ner");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });

        cash("body").on("click", '.modal_delete_button_tabulator', function () {
            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
            cash(".t_id").val(Did);
            return true;
        });
    }


    if (cash("#angi_huvaari_tabulator").length) {
        // Setup Tabulator

        let table = new Tabulator("#angi_huvaari_tabulator", {
            ajaxURL: "http://" + bigg_URL + "/api/v1/huvaari/angiud",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Мэдээлэл алга байна!",
            locale:true,
            langs:{
                "mn-mn":{
                    "columns":{
                        "name":"Нэр",
                    },
                    "ajax":{
                        "loading":"Уншиж байна...", 
                        "error":"Алдаатай байна.", 
                    },
                    "groups":{ 
                        "item":"item",
                        "items":"items",
                    },
                    "pagination":{
                        "page_size":"Харагдац",
                        "first":'<',
                        "first_title":"Эхэнд", 
                        "last":">>",
                        "last_title":"Төгсгөлд",
                        "prev":"<",
                        "prev_title":"Өмнөх",
                        "next":">",
                        "next_title":"Дараагийн",
                    },
                    "headerFilters":{
                        "default":"Багана шүүх...",
                        "columns":{
                            "name":"Багана шүүх...",
                        }
                    }
                }
            },
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "АНГИЙН НЭР",
                    minWidth: 200,
                    responsive: 0,
                    field: "ner",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let ovog = cell.getData().bagsh_ovog;
                        return `<div>
                            <div class="font-medium whitespace-nowrap">
                            ${cell.getData().ner} ${cell.getData().course}${cell.getData().buleg}
                            </div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">
                            ${ovog.slice(0,1)}. ${cell.getData().bagsh_ner}
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "ОЮУТНЫ ТОО",
                    minWidth: 50,
                    field: "tenhim",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center items-center">
                            <a class="flex items-center mr-3" href="javascript:;">
                                0
                            </a>
                        </div>`;
                    },
                },
                {
                    title: "ҮЙЛДЭЛ",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center text-theme-9">
                                    <a class="flex items-center mr-3" href="javascript:;">
                                        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Хичээлийн хуваарь
                                    </a>
                                </div>`;
                    },
                }

            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        table.setLocale("mn-mn");

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = "like";
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("ner");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        cash("body").on("click", '.modal_delete_button_tabulator', function () {
            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
            cash(".t_id").val(Did);
            return true;
        });
    }

    if (cash("#teacher_fond_tabulator").length) {
        // Setup Tabulator

        let table = new Tabulator("#teacher_fond_tabulator", {
            ajaxURL: "http://" + bigg_URL + "/api/v1/teachers/fond",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "Мэдээлэл алга байна!",
            locale:true,
            langs:{
                "mn-mn":{
                    "columns":{
                        "name":"Нэр",
                    },
                    "ajax":{
                        "loading":"Уншиж байна...", 
                        "error":"Алдаатай байна.", 
                    },
                    "groups":{ 
                        "item":"item",
                        "items":"items",
                    },
                    "pagination":{
                        "page_size":"Харагдац",
                        "first":'<',
                        "first_title":"Эхэнд", 
                        "last":">>",
                        "last_title":"Төгсгөлд",
                        "prev":"<",
                        "prev_title":"Өмнөх",
                        "next":">",
                        "next_title":"Дараагийн",
                    },
                    "headerFilters":{
                        "default":"Багана шүүх...",
                        "columns":{
                            "name":"Багана шүүх...",
                        }
                    }
                }
            },
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "БАГШ НЭР",
                    minWidth: 200,
                    responsive: 0,
                    field: "ner",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let ovog = cell.getData().ovog;
                        return `<div>
                            <div class="font-medium whitespace-nowrap">
                            ${ovog.slice(0,1)}. ${cell.getData().ner}
                            </div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">${
                                cell.getData().mergejil
                            }</div>
                        </div>`;
                    },
                },
                {
                    title: "ТЭНХИМ",
                    minWidth: 50,
                    field: "tenhim",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center items-center">
                            <a class="flex items-center mr-3 tooltip" title="`+ cell.getData().tenhim +`" href="javascript:;">
                                ` + cell.getData().tovch + `
                            </a>
                        </div>`;
                    },
                },
                {
                    title: "ЗУРАГ",
                    minWidth: 200,
                    field: "image",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        let image = (cell.getData().image == null) ? "/dist/images/Blank-avatar.png" : "/uploads/teachers/thumbs/" + cell.getData().image;
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="BiGG system" class="rounded-full" src="${image}">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "БАГШ КОД",
                    minWidth: 200,
                    field: "code",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false
                },
                {
                    title: "ҮЙЛДЭЛ",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center text-theme-9">
                                    <a class="flex items-center mr-3" href="/bigg/teachers/fond_list/${cell.getData().id}">
                                        <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Цагийн фонд
                                    </a>
                                </div>`;
                    },
                },

                
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        table.setLocale("mn-mn");

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = "like";
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("ner");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        

        cash("body").on("click", '.modal_delete_button_tabulator', function () {
            cash(this).html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader();
            cash(".t_id").val(Did);
            return true;
        });
    }

})(cash);
