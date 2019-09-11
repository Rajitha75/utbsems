var secSaltKey = function() {
    var tmp = null;
    var eurl = "site/getseckey";
    $.ajax({
        'async': false,
        'type': "GET",
        'url': eurl,
        'success': function(data) {
            tmp = data;
        }
    });
    return tmp;
}();