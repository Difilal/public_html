$(function() {
    $('.download-btn').on('click', function(e) {
        e.preventDefault();
        var downloadUrl = $(this).attr('href');
        window.open(downloadUrl, '_blank');
    });
});
