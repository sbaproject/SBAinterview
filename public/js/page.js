$(document).ready(function(){
    $(function () {
        $('#in_time').datetimepicker({
            format: 'HH:mm',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
            }

        });
    });
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });

})

$(function() {
    $.datepicker.regional["ja"] = {
        // closeText: "閉じる",
        //  prevText: "<",
        // nextText: ">",
        // currentText: "今日",
        // monthNames: ["Jan", "Feb", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        // monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
        // dayNames: ["日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日"],
        // dayNamesShort: ["日", "月", "火", "水", "木", "金", "土"],
        // dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
        // weekHeader: "週",
        dateFormat: "yy/mm/dd",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2030, 11, 31),
        yearRange: "2000:2030",

        // yearSuffix: "年"
    };
    $.datepicker.setDefaults($.datepicker.regional["ja"]);
});

$(function() {
    $('.datetimepicker-input').datepicker();
});