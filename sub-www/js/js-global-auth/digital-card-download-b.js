function generateImage() {
    html2canvas($('#businessCard')[0], {
        scale: 2,
        backgroundColor: '#FFFFFF',
        useCORS: true,
        allowTaint: true
    }).then(function(canvas) {
        var link = $('<a>')[0];
        link.download = 'business-card.png';
        link.href = canvas.toDataURL('image/png');
        link.click();

        $('#loadingText').text('Download complete! You can close this page.');
    }).catch(function(err) {
        $('#loadingText').text('Error: ' + err.message);
    });
}

function fitPositionJabatan() {
    var $el = $('.position');
    if (!$el.length) return;

    var maxFont = 20;
    var minFont = 16;
    
    // Card 700px - padding 50px each side = 600px
    var maxWidth = 200;

    $el.css('font-size', maxFont + 'px');

    if ($el[0].scrollWidth <= maxWidth) return;

    var fontSize = maxFont;
    while ($el[0].scrollWidth > maxWidth && fontSize > minFont) {
        fontSize--;
        $el.css('font-size', fontSize + 'px');
    }
}

function fitPositionName() {
    var $el = $('.name');
    if (!$el.length) return;

    var maxFont = 40;
    var minFont = 30;
    
    var maxWidth = 200;

    $el.css('font-size', maxFont + 'px');

    if ($el[0].scrollWidth <= maxWidth) return;

    var fontSize = maxFont;
    while ($el[0].scrollWidth > maxWidth && fontSize > minFont) {
        fontSize--;
        $el.css('font-size', fontSize + 'px');
    }
}

$(document).ready(function() {
    fitPositionJabatan();
    fitPositionName();

    var $img = $('.card-bg');

    function checkLoad() {
        if ($img.length && $img[0].complete) {
            generateImage();
        } else {
            setTimeout(checkLoad, 100);
        }
    }

    setTimeout(checkLoad, 300);
});
