$(document).ready(function() {
    $("#select_language").on('change', function(){
        var url = $(this).data('url');
        if ($(this).val() == 0) {
            location.href = window.location.pathname;
            return false;
        }
        if (url.length > 0) {
            location.href = window.location.pathname + "?" + url + "&language=" + $(this).val();
        } else {
            location.href = window.location.pathname + "?language=" + $(this).val();
        }
    });
});
