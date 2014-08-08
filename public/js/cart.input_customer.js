var _additionTypeBtn = "input[name='addition_type']";
$(function(){
    additionOff();
    if($("#addition_type_on:checked").size()){
        additionOn();
    }
    $(_additionTypeBtn).click(checkAddition());
});
function additionOn(){
    if($("#additionTable")){
        $("#additionTable").fadeIn();
    }
}
function additionOff(){
    if($("#additionTable")){
        $("#additionTable").fadeOut();
    }
}
function checkAddition(){
    $(_additionTypeBtn).click(function(){
        if($(this).val() == 1){
            additionOn();
            return;
        }
        additionOff();
    });
}
