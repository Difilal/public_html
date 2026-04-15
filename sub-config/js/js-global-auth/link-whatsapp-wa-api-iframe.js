$(function()
{
    if($("#wa_wp_sync_iframe").length>0)
    {
        setTimeout(() => { whatsapp_wp_sync_iframe_progress(); }, 1000);
    }
});


function whatsapp_wp_sync_iframe_progress(i=0)
{
    $("#wa_wp_sync_iframe").html('<img src="ajax-loading48.gif">');
    $.post("link-whatsapp-wa-notif-sync.html", {},
    function(data)
    {
        $("#wa_wp_sync_iframe").html('<img src="img-check.png">');
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        if(data.datetime != undefined) $("#datetime_wp").html(data.datetime);

        setTimeout(() => { whatsapp_wp_sync_iframe_progress(++i); }, 3000);
        data=undefined;
    });
}