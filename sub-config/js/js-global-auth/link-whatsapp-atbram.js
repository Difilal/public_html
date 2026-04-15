$(function()
{
    if($("#datetime").length>0)
    { 
        whatsapp_ab_sync_progress();
        whatsapp_ab_monitoring_progress();
    }
});


function whatsapp_ab_monitoring_progress(i=0)
{
    /* $("#whatsapp_ab_sync_progress").html('<img src="ajax-loading.gif">'); */
    $.post("link-whatsapp-atbram-monitoring-outbox.html", {},
    function(data)
    {
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        if(data.count_instance       != undefined)   $("#count_instance").html(data.count_instance);                 else $("#count_instance").html("x");
        if(data.count_outbox         != undefined){  setBgColor_MonitoringAtbram("#count_outbox_wrapper",data.count_outbox); $("#count_outbox").html(data.count_outbox);                     }else $("#count_outbox").html("x");
        if(data.count_queue_hosting  != undefined){  setBgColor_MonitoringAtbram("#count_queue_hosting_wrapper",data.count_queue_hosting); $("#count_queue_hosting").html(data.count_queue_hosting);       }else $("#count_queue_hosting").html("x");
        if(data.count_outbox_hosting != undefined){  setBgColor_MonitoringAtbram("#count_outbox_hosting_wrapper",data.count_outbox_hosting); $("#count_outbox_hosting").html(data.count_outbox_hosting);     }else $("#count_outbox_hosting").html("x");

        if(data.count_sent != undefined){            $("#count_sent").html(data.count_sent);                        }else $("#count_sent").html("x");
        if(data.count_pending != undefined){         $("#count_pending").html(data.count_pending);                  }else $("#count_pending").html("x");
        if(data.count_failed != undefined){          $("#count_failed").html(data.count_failed);                    }else $("#count_failed").html("x");
        if(data.count_invalid_number != undefined){  $("#count_invalid_number").html(data.count_invalid_number);    }else $("#count_invalid_number").html("x");
        if(data.count_cancel != undefined){          $("#count_cancel").html(data.count_cancel);                    }else $("#count_cancel").html("x");
        if(data.count_expire != undefined){          $("#count_expire").html(data.count_expire);                    }else $("#count_expire").html("x");

        if(data.count_sent_all != undefined){            $("#count_sent_all").html(NumberFormat(data.count_sent_all));                        }else $("#count_sent_all").html("x");
        if(data.count_pending_all != undefined){         $("#count_pending_all").html(NumberFormat(data.count_pending_all));                  }else $("#count_pending_all").html("x");
        if(data.count_failed_all != undefined){          $("#count_failed_all").html(NumberFormat(data.count_failed_all));                    }else $("#count_failed_all").html("x");
        if(data.count_invalid_number_all != undefined){  $("#count_invalid_number_all").html(NumberFormat(data.count_invalid_number_all));    }else $("#count_invalid_number_all").html("x");
        if(data.count_cancel_all != undefined){          $("#count_cancel_all").html(NumberFormat(data.count_cancel_all));                    }else $("#count_cancel_all").html("x");
        if(data.count_expire_all != undefined){          $("#count_expire_all").html(NumberFormat(data.count_expire_all));                    }else $("#count_expire_all").html("x");

        var listData = data.data; listData.forEach(myFunction1);
        function myFunction1(item, index) { $("#wa"+item.name).html(item.count).attr("wa",item.count); setBgColor_MonitoringAtbram("#wa"+item.name,item.count); setBgColor_NoHP_MonitoringAtbram(item.name); }

        var listData = data.data_logwa; listData.forEach(myFunction2);
        function myFunction2(item, index) { $("#qh"+item.name).html(item.count).attr("qh",item.count); setBgColor_MonitoringAtbram("#qh"+item.name,item.count); setBgColor_NoHP_MonitoringAtbram(item.name); }

        var listData = data.data_outbox_hosting; listData.forEach(myFunction3);
        function myFunction3(item, index) { $("#ah"+item.name).html(item.count).attr("ah",item.count); setBgColor_MonitoringAtbram("#ah"+item.name,item.count); setBgColor_NoHP_MonitoringAtbram(item.name); }

        /* if(i==59) goToUrl("./"); */
        setTimeout(() => { whatsapp_ab_monitoring_progress(++i); }, 1000);
    });
}


function whatsapp_ab_sync_progress(i=0)
{
    $.post("link-whatsapp-atbram-sync.html", {},
    function(data)
    {
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        if(data.datetime != undefined) $("#datetime").html(data.datetime); else $("#datetime").html("datetime");        

        if(i==59) goToUrl("./");
        setTimeout(() => { whatsapp_ab_sync_progress(++i); }, 1000);
    });
}

function setBgColor_MonitoringAtbram(elm="#abc",x=0)
{
    if(elm.length>0)
    {
        var z = parseInt(x);
        if(z>0) $(elm).css("background-color", "yellow");
        else    $(elm).css("background-color", "");
    }
}

function setBgColor_NoHP_MonitoringAtbram(name="")
{
    if(name!="")
    {
        var wa = parseInt($("#wa"+name).attr("wa"));
        var qh = parseInt($("#qh"+name).attr("qh"));
        var ah = parseInt($("#ah"+name).attr("ah"));

        if(wa>0 || qh>0 || ah>0) $("#hp"+name).css("background-color", "yellow");
        else                     $("#hp"+name).css("background-color", "");
    }
}