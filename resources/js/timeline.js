$(document).ready(function () {
    var array = $('#my-timeline').data('duration');
    $('#my-timeline').roadmap(array);
});
$(document).ready(function () {
    var current_phase = $('#current_phase').val();
    var days_left = $('#days_left').val();
    if (current_phase == '') {
        $('#my-timeline').css('color', 'red');
    } else {
        current_phase = parseInt(current_phase) + 1;
        $('.roadmap__events__event:nth-child(' + current_phase + ')').css('color', 'red');
    }
});
$(document).ready(function () {
    $('.roadmap__events__event').click(function () {
        var index_phase = $(this).index();
        var trainee_id = $('#trainee_id').val();
        var token = $('input[name=_token]').val();
        $.ajax({
            url : '/get_single_result',
            data : {
                'index_phase' : index_phase,
                'trainee_id' : trainee_id,
                '_token': token,
            },
            type : 'POST',
            dataType : 'json',
        }).done(function (data) {
            var result_of_phase = $.map(data, function(value, index) {
                return [value];
            });
            if (result_of_phase.length < 1) {
                $('.popup-detail h4').text('-');
            } else {
                $('.popup-detail h4').text(result_of_phase);
            }
        });
    });
});
