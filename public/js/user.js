$(document).ready(function(){
    $("#dob").datetimepicker({
        format: 'DD-MM-YYYY',
        widgetPositioning:{
            vertical:'bottom'
        },
        keepOpen:false,
        useCurrent: false,
        maxDate: new Date()
    });
});