$(function()
{
    if($("#absensi_photo_iframe").length>0)
    {
        setTimeout(() => { worker_absensi_photo_iframe_progress(); }, 1000);
    }
});


function worker_absensi_photo_iframe_progress(i=0)
{
    $("#absensi_photo_iframe").html('<img src="ajax-loading48.gif">');
    $.post("link-absensi-photo-sync.html", {},
    function(data)
    {
        $("#absensi_photo_iframe").html('<img src="img-check.png">');
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        if(data.datetime != undefined) $("#datetime_wp").html(data.datetime);

        setTimeout(() => { worker_absensi_photo_iframe_progress(++i); }, 1000);
        data=undefined;
    });
}