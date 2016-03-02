/**
 * Created by ricardo on 26/12/15.
 */
$(document).ready(function() {

    $('.data-table').dataTable({
        "language": {
            "lengthMenu": "_MENU_"
        }
    });

    initialConfigurationDataTable();

});

function initialConfigurationDataTable(){
    $('.dataTables_filter input').attr('placeholder','Search...');


    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right m-n");
}

function updateDataTable(){
    //$('.data-table').dataTable().row().data();
}

function pNotifyView(textMsj, type) {
    PNotify.removeAll();
    switch (type){
        case "success":
            displayNotify("Success", textMsj, type, "ti ti-check");
            break;
        case "info":
            displayNotify("Info", textMsj, type, "ti ti-info");
            break;
        case "error":
            displayNotify("Error", textMsj, type, "ti ti-close");
            break;
        case "warning":
            displayNotify("Warning", textMsj, type, "ti ti-close");
            break;
    }
}

function displayNotify(title, text, type, icon){
    new PNotify({
        title: title,
        text: text,
        type: type,
        icon: icon,
        delay: 3000
    });
}
function numbersOnlyWithDecimals(oToCheckField, oKeyEvent) {
    var s = String.fromCharCode(oKeyEvent.charCode);
    var containsDecimalPoint = /\./.test(oToCheckField.value);
    return oKeyEvent.charCode === 0 || /\d/.test(s) ||
        /\./.test(s) && !containsDecimalPoint;
}

function numbersOnly(oToCheckField, oKeyEvent) {
    return oKeyEvent.charCode === 0 ||
        /\d/.test(String.fromCharCode(oKeyEvent.charCode));
}

function startLoading(msjLoading){
    HoldOn.open({
        theme:'sk-bounce',
        message:"<h4>"+msjLoading+"</h4>"
    });
}

function stopLoading(){
    HoldOn.close();
}

function cleanForm(className){
    $('.'+className).val('');
}

function validateContractHotelForm(){
    var nombre = $("#nombreContrato");
    var startDate = $("#startDateContract");
    var endDate = $("#endDateContract");
    var plan = $("#selectPlanContract");
    var edadMenor = $("#minorityContract");
    var ish = $("#ishContract");
    var markup = $("#markupContract");
    var iva = $("#ivaContract");
    var fee = $("#feeContract");

    if($.trim(nombre.val()).length == 0){
        pNotifyView("El nombre del contrato es necesario", "info");
        nombre.trigger("focus");
        return false;
    }else if($.trim(startDate.val()).length == 0){
        pNotifyView("La fecha inicio del contrato es necesario", "info");
        startDate.trigger("focus");
        return false;
    }else if($.trim(endDate.val()).length == 0){
        pNotifyView("La fecha final del contrato es necesario", "info");
        endDate.trigger("focus");
        return false;
    }else if(plan.val() == 0){
        pNotifyView("El plan es necesario", "info");
        plan.trigger("focus");
        return false;
    }else if(edadMenor.val() <= 0){
        pNotifyView("Captura la edad minima del menor", "info");
        edadMenor.trigger("focus");
        return false;
    }else if(ish.val() < 0 || ish.val() == ""){
        pNotifyView("Captura impueso sobre hotel", "info");
        ish.trigger("focus");
        return false;
    }else if(markup.val() < 0 || markup.val() == ""){
        pNotifyView("El markup es necesario", "info");
        markup.trigger("focus");
        return false;
    }else if(iva.val() < 0 || iva.val() == ""){
        pNotifyView("Captura el iva", "info");
        iva.trigger("focus");
        return false;
    }else if(fee.val() < 0 || fee.val() == ""){
        pNotifyView("El Resort fee necesario", "info");
        fee.trigger("focus");
        return false;
    }else{
        return true;
    }
}