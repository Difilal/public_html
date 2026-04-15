$(function()
{
    if($("#wa_worker").length>0)
    { 
        setTimeout(()=>{ Worker_Wa_Monitoring(); }, 1000);
    }
});




function Worker_Wa_Monitoring(i=0)
{
    $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color","#fffd7d");
    $.post("ajax-worker-wa-monitoring.html", { wa_worker:1 },
    function(data)
    {
        setTimeout(() => { $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color",""); }, 500);
        var data=isJSON(data)?JSON.parse(data):{"respon":data};


        for(t=0;t<data.idwa.length;t++)
        {
            if(data["dataQueue"+data.idwa[t]]!==undefined)
            {
                var dataLama= NumberFormat(parseInt(FilterNumber($("#dataQueue"+data.idwa[t]).html()))),
                    dataBaru= NumberFormat(parseInt(FilterNumber(data["dataQueue"+data.idwa[t]])));
                if(dataLama!==dataBaru) $("#dataQueue"+data.idwa[t]+"-wrapper").css("background-color","#fffd7d");
                else                    $("#dataQueue"+data.idwa[t]+"-wrapper").css("background-color","");
                $("#dataQueue"+data.idwa[t]).html(dataBaru);
            }

            if(data["dataSentAll"+data.idwa[t]]!==undefined)
            {
                var dataLama= NumberFormat(parseInt(FilterNumber($("#dataSentAll"+data.idwa[t]).html()))),
                    dataBaru= NumberFormat(parseInt(FilterNumber(data["dataSentAll"+data.idwa[t]])));
                if(dataLama!==dataBaru) $("#dataSentAll"+data.idwa[t]+"-wrapper").css("background-color","#fffd7d");
                else                    $("#dataSentAll"+data.idwa[t]+"-wrapper").css("background-color","");
                $("#dataSentAll"+data.idwa[t]).html(dataBaru);
            }

            if(data["dataSentToday"+data.idwa[t]]!==undefined)
            {
                var dataLama= parseInt(FilterNumber($("#dataSentToday"+data.idwa[t]).html())),
                    dataBaru= parseInt(FilterNumber(data["dataSentToday"+data.idwa[t]]));
                if(dataBaru>0)  $("#dataSentToday"+data.idwa[t]).css("display","");
                else            $("#dataSentToday"+data.idwa[t]).css("display","none");
                $("#dataSentToday"+data.idwa[t]).html(dataBaru);
            }

            if(data["dataReceivedAll"+data.idwa[t]]!==undefined)
            {
                var dataLama= NumberFormat(parseInt(FilterNumber($("#dataReceivedAll"+data.idwa[t]).html()))),
                    dataBaru= NumberFormat(parseInt(FilterNumber(data["dataReceivedAll"+data.idwa[t]])));
                if(dataLama!==dataBaru) $("#dataReceivedAll"+data.idwa[t]+"-wrapper").css("background-color","#fffd7d");
                else                    $("#dataReceivedAll"+data.idwa[t]+"-wrapper").css("background-color","");
                $("#dataReceivedAll"+data.idwa[t]).html(dataBaru);
            }

            if(data["dataReceivedToday"+data.idwa[t]]!==undefined)
            {
                var dataLama= NumberFormat(parseInt(FilterNumber($("#dataReceivedToday"+data.idwa[t]).html()))),
                    dataBaru= NumberFormat(parseInt(FilterNumber(data["dataReceivedToday"+data.idwa[t]])));
                    if(dataBaru>0)  $("#dataReceivedToday"+data.idwa[t]).css("display","");
                    else            $("#dataReceivedToday"+data.idwa[t]).css("display","none");
                $("#dataReceivedToday"+data.idwa[t]).html(dataBaru);
            }
        }


        

        $("#totalDataDefaultSender").html(NumberFormat(data.totalDataDefaultSender));
        $("#totalDataQueue").html(NumberFormat(data.totalDataQueue));
        $("#totalDataSentAll").html(NumberFormat(data.totalDataSentAll));
        if(parseInt(data.totalDataSentToday)==0) var cssDisplay="none"; else var cssDisplay="";
        $("#totalDataSentToday").css("display",cssDisplay).html("+"+NumberFormat(data.totalDataSentToday));
        $("#totalDataReceivedAll").html(NumberFormat(data.totalDataReceivedAll));
        if(parseInt(data.totalDataReceivedToday)==0) var cssDisplay="none"; else var cssDisplay="";
        $("#totalDataReceivedToday").css("display",cssDisplay).html("+"+NumberFormat(data.totalDataReceivedToday));



        setTimeout(() => { Worker_Wa_Monitoring(++i); }, 2000);
        data=undefined;
    });
}