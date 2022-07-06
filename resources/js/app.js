require('./bootstrap');

$('.toggle-class').each(function(e) {
    if($(this).val() == 1) {
        $(this).attr("checked", "checked");
    }
});
