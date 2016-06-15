$(document).ready(function() {
    var timestamp = 0;
    
    function ordTimestamp (a, b) {
        return a.timestamp - b.timestamp;
    }

    function updateTable () {
        $.ajax('response.php?t=' + timestamp)
        .done(function(data) {
            var insertList = $.each(data.insertList, function (k,v) { v.type = 'insert'; });
            var deleteList = $.each(data.deleteList, function (k,v) { v.type = 'delete'; });
            if (insertList !== undefined && deleteList !== undefined) {
                var list = insertList.concat(deleteList).sort(ordTimestamp);
                $.each(list,function(key,obj) {
                    timestamp = data.timestamp; // only update timestamp when there's actually something (in case it misses something for some reason!
                    if (obj.type == 'insert') {
                        var el = $("<div class = 'list_row book_row' id = 'book_"+obj.mid+"_"+obj.start+"'>"+
                                "<span class = 'list_cell'>"+obj.machineName+"</span>"+
                                "<span class = 'list_cell'>"+obj.start+"</span>"+
                                "<span class = 'list_cell'>"+obj.end+"</span>"+
                                "<span class = 'list_cell'>"+obj.duration+"</span>"+
                                "</div>");
                        var done = false;
                        $('.book_row').each(function() {
                            var m = this.id.match(/^book_\d+_(\d{2}:\d{2})$/);
                            if (!done && obj.start < m[1]) {
                                // found the first one greater than this one!
                                $(this).before(el);
                                done = true;
                            }
                        });
                        if (done == false) {
                            if ($('.book_row').length > 0) {
                                $('.book_row').last().after(el);
                            }
                            else {
                                $('.head_row').last().after(el);
                            }
                        }
                    }
                    else if (obj.type == 'delete') {
                        // delete
                        // jQuery doesn't handle colons well
                        $(document.getElementById('book_'+obj.mid+'_'+obj.start)).remove();
                    }
                });
            }

        });

    }

    updateTable();
    setInterval(updateTable,5000);
});
