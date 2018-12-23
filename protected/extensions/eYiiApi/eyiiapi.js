$(function() {
    $('#myiiapi-bar-toggle').click(function() {
        $('.myiiapi-content').toggle();
    });    
    searchSuccess = function(data) {
        $('.myiiapi-content').empty();
        $('.myiiapi-content').html($(data).find('.myiiapi-item'));
        $('.myiiapi-content').show();
    }
});
