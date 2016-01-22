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