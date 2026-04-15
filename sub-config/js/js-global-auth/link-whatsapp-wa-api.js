$(function()
{
    if($("#datetime_wp").length>0)
    {
        setTimeout(() => { whatsapp_wp_monitoring_progress(); }, 500);
        /* setTimeout(() => { whatsapp_wp_sync_progress(); }, 1000); */
    }
});


function whatsapp_wp_monitoring_progress(i=0)
{
    /* $("#whatsapp_ab_sync_progress").html('<img src="ajax-loading.gif">'); */
    $("body").attr("progress","monitoring");
    $.post("link-whatsapp-wa-notif-monitoring-outbox.html", {},
    function(data)
    {
        $("body").attr("progress","free");
        var data=isJSON(data)?JSON.parse(data):{"respon":data};
        
        if(data.datetime             != undefined && $("#datetime_wp").length>0)            $("#datetime_wp").html(data.datetime);

        if(data.count_outbox         != undefined && $("#count_outbox").length>0){          $("#count_outbox").html(data.count_outbox);                 setBgColor_MonitoringWaApi("#count_outbox_wrapper",data.count_outbox);                      }else $("#count_outbox").html("x");
        if(data.count_outbox_hosting != undefined && $("#count_outbox_hosting").length>0){  $("#count_outbox_hosting").html(data.count_outbox_hosting); setBgColor_MonitoringWaApi("#count_outbox_hosting_wrapper",data.count_outbox_hosting);      }else $("#count_outbox_hosting").html("x");
        if(data.count_queue_hosting  != undefined && $("#count_queue_hosting").length>0){   $("#count_queue_hosting").html(data.count_queue_hosting);   setBgColor_MonitoringWaApi("#count_queue_hosting_wrapper",data.count_queue_hosting);        }else $("#count_queue_hosting").html("x");
        if(data.count_instance       != undefined && $("#count_instance").length>0){        $("#count_instance").html(data.count_instance); }else $("#count_instance").html("x");
        
        if(data.count_sent != undefined           && $("#count_sent").length>0){            $("#count_sent").html(data.count_sent);                        }else $("#count_sent").html("x");
        if(data.count_failed != undefined         && $("#count_failed").length>0){          $("#count_failed").html(data.count_failed);                    }else $("#count_failed").html("x");
        if(data.count_invalid_number != undefined && $("#count_invalid_number").length>0){  $("#count_invalid_number").html(data.count_invalid_number);    }else $("#count_invalid_number").html("x");
        if(data.count_pending != undefined        && $("#count_pending").length>0){         $("#count_pending").html(data.count_pending);                  }else $("#count_pending").html("x");
        if(data.count_cancel != undefined         && $("#count_cancel").length>0){          $("#count_cancel").html(data.count_cancel);                    }else $("#count_cancel").html("x");
        if(data.count_expire != undefined         && $("#count_expire").length>0){          $("#count_expire").html(data.count_expire);                    }else $("#count_expire").html("x");
        if(data.count_received != undefined       && $("#count_received").length>0){        $("#count_received").html(data.count_received);                }else $("#count_received").html("x");

        if(data.count_sent_all != undefined           && $("#count_sent_all").length>0){            $("#count_sent_all").html(NumberFormat(data.count_sent_all));                        }else $("#count_sent_all").html("x");
        if(data.count_failed_all != undefined         && $("#count_failed_all").length>0){          $("#count_failed_all").html(NumberFormat(data.count_failed_all));                    }else $("#count_failed_all").html("x");
        if(data.count_invalid_number_all != undefined && $("#count_invalid_number_all").length>0){  $("#count_invalid_number_all").html(NumberFormat(data.count_invalid_number_all));    }else $("#count_invalid_number_all").html("x");
        if(data.count_pending_all != undefined        && $("#count_pending_all").length>0){         $("#count_pending_all").html(NumberFormat(data.count_pending_all));                  }else $("#count_pending_all").html("x");
        if(data.count_cancel_all != undefined         && $("#count_cancel_all").length>0){          $("#count_cancel_all").html(NumberFormat(data.count_cancel_all));                    }else $("#count_cancel_all").html("x");
        if(data.count_expire_all != undefined         && $("#count_expire_all").length>0){          $("#count_expire_all").html(NumberFormat(data.count_expire_all));                    }else $("#count_expire_all").html("x");
        if(data.count_received_all != undefined       && $("#count_received_all").length>0){        $("#count_received_all").html(NumberFormat(data.count_received_all));                }else $("#count_received_all").html("x");

        if(data.data != undefined)
        {
            var listData = data.data; listData.forEach(myFunction1);
            function myFunction1(item, index) { $("#wa"+item.name).html(item.count).attr("wa",item.count); setBgColor_MonitoringWaApi("#wa"+item.name,item.count); setBgColor_NoHP_MonitoringWaApi(item.name); }
        }

        if(data.data_logwa != undefined){

            var listData = data.data_logwa; listData.forEach(myFunction2);
            function myFunction2(item, index) { $("#qh"+item.name).html(item.count).attr("qh",item.count); setBgColor_MonitoringWaApi("#qh"+item.name,item.count); setBgColor_NoHP_MonitoringWaApi(item.name); }
        }

        if(data.data_outbox_hosting != undefined)
        {
            var listData = data.data_outbox_hosting; listData.forEach(myFunction3);
            function myFunction3(item, index) { $("#ah"+item.name).html(item.count).attr("ah",item.count); setBgColor_MonitoringWaApi("#ah"+item.name,item.count); setBgColor_NoHP_MonitoringWaApi(item.name); }
        }

        if(i==100){ $("body").attr("progress","stop"); goToUrl("./"); }
        else setTimeout(() => { whatsapp_wp_monitoring_progress(++i); }, 3000);

        data=undefined;
        listData=undefined;
    });
}


function whatsapp_wp_sync_progress(i=0)
{
    /* $("#whatsapp_ab_sync_progress").html('<img src="ajax-loading.gif">'); */
    if($("body").attr("progress")=="stop"){}
    else if($("body").attr("progress")=="free")
    {
        $.post("link-whatsapp-wa-notif-sync.html", {},
        function(data)
        {
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
    
            if(data.datetime != undefined) $("#datetime_wp").html(data.datetime);
    
            setTimeout(() => { whatsapp_wp_sync_progress(++i); }, 4000);
            data=undefined;
        });
    }else setTimeout(() => { whatsapp_wp_sync_progress(i); }, 4000);
}

function setBgColor_MonitoringWaApi(elm="#abc",x=0)
{
    if(elm.length>0)
    {
        var z = parseInt(x);
        if(z>0) $(elm).css("background-color", "yellow");
        else    $(elm).css("background-color", "");
    }
}

function setBgColor_NoHP_MonitoringWaApi(name="")
{
    if(name!="")
    {
        var wa = parseInt($("#wa"+name).attr("wa"));
        var qh = parseInt($("#qh"+name).attr("qh"));
        var ah = parseInt($("#ah"+name).attr("ah"));

        if(wa>0 || qh>0 || ah>0) $("#hp"+name).css("background-color", "yellow");
        else                     $("#hp"+name).css("background-color", "");

        wa=undefined;
        qh=undefined;
        ah=undefined;
    }
}