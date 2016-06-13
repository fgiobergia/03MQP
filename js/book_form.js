$(document).ready(function() {
    $('#start_time').change(timeHandler);
    $('#duration').change(durationHandler);

    $('#send').click(function() {
        var start = $('#start_time').val();
        var duration = $('#duration').val();
        if (start.length > 0 && validTime(start) && duration.length > 0 && validDuration(duration)) {
                alert("good");
            $('#book_form').submit();
        }
    });
});
