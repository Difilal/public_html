$(function()
{
    if($("#idwa_worker").length>0 && $("#idsmtp_worker").length>0)
    { 
        setTimeout(()=>{ Worker_Watch_Reload(); }, 1000);
        /* Worker_Mesin_Startup(); */
        /* Worker_Watch_Reload_Wa();
        Worker_WA_Startup(); */
        /* Worker_System_Startup(); //fungsi per cabang */
        /* Worker_Email_Startup(); */
        /* Worker_Function_Runtime("rekap_harian_seluruh_karyawan"); */
        /* Worker_Function_Runtime("rekap_harian_marketing_agent_function"); */
        /* Worker_Function_Runtime("rekap_harian_pekerja_harian"); */
        /* Worker_Function_Runtime("rekap_mingguan_pekerja_harian"); */
        /* Worker_Function_Runtime("cut_off_data_prospek_konsumen"); */
        /* Worker_Function_Runtime("aturan_5plus5_expire_kavling"); */
        /* Worker_Function_Runtime("aturan_5plus5_expire_booking"); */
        /* Worker_Function_Runtime("aturan_2plus1_expire_bi_checking"); */
        /* Worker_Function_Runtime("aturan_2plus1_expire_booking_fee"); */
        /* Worker_Function_Runtime("expire_antrian_waiting_list_booking"); */
        /* Worker_Function_Runtime("expire_pemberkasan"); */
        /* Worker_Function_Runtime("notif_reminder_kelengkapan_pemberkasan"); */
    }
});




function Worker_Function_Runtime(fnc="")
{
    if(fnc!=="")
    {   
        var function_worker1=$("#function_worker").val();
        var function_worker2=function_worker1.split(",");
        if(function_worker1!="" && function_worker2.includes(fnc))
        { 
            Worker_Function(fnc); 
        }
        else{}
    }

    setTimeout(()=>{ Worker_Function_Runtime(fnc); }, 5000);
}

function Worker_Function(fnc)
{
    if($("#"+fnc+"_progress img").length==0)
    {
        $("#"+fnc+"_wrapper").css("background-color","#fffd7d");
        $("#"+fnc+"_progress").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "link-cronjob-function.html", { fnc:fnc },
        function(data)
        {
            setTimeout(() => { $("#"+fnc+"_wrapper").css("background-color","#EEEEEE"); }, 500);
            $("#"+fnc+"_progress").html( 'idle' );
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            
            data=undefined;
        }
        )
        .fail(function()
        { 
            setTimeout(() => { $("#"+fnc+"_wrapper").css("background-color","#EEEEEE"); }, 500);
            $("#"+fnc+"_progress").html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            //setTimeout(function(){ Worker_Mesin(idmesin); }, 10000);
        });
    }
}




function Worker_Mesin_Startup()
{
    if($("#idmesin_list").val()!=="")
    {
        var idmesin_list  =$("#idmesin_list").val().split(",");
        var jmlhMesinAktif =parseInt($("#jmlhMesinAktif").val());

        for(var i=0;i<idmesin_list.length;i++)
        {   
            var n=(i%jmlhMesinAktif)+1;
            var timeout=(n*500);
            Worker_Mesin_Runtime(idmesin_list[i],timeout);
        }
    }
}

function Worker_Mesin_Runtime(idmesin,timeout)
{
    if($("#idmesin_worker").val()!=="")
    {   
        var idmesin_worker=$("#idmesin_worker").val().split(",");
        if(idmesin_worker.includes(idmesin))
        {
            Worker_Mesin(idmesin);
        }
        else {}
    }
    else{}

    setTimeout(()=>{ Worker_Mesin_Runtime(idmesin,timeout); }, timeout);
}

function Worker_Mesin(idmesin)
{
    if($("#worker_mesin"+idmesin+" img").length==0)
    {
        $("#idmesin"+idmesin+" td").css("background-color","#fffd7d");
        $("#worker_mesin"+idmesin).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "link-absen-cronjob.html", { idmesin:idmesin },
        function(data)
        {
            setTimeout(() => { $("#idmesin"+idmesin+" td").css("background-color",""); }, 500);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};

            var dataAbsenAll=parseInt(data.dataAbsenAll);
            var dataAbsenToday=parseInt(data.dataAbsenToday);
            var mesin_cronjobOperation=parseInt(data.mesin_cronjobOperation);

            $("#sn_mesin"+idmesin).html(data.sn_mesin);
            $("#cabang_mesin"+idmesin).html(data.cabang_mesin);
            $("#worker_mesin"+idmesin).html('idle');

            $("#dataAbsenAll"+idmesin).html(NumberFormat(dataAbsenAll));
            if(dataAbsenToday==0) var cssDisplay="none"; else var cssDisplay="";
            $("#dataAbsenToday"+idmesin).css("display",cssDisplay).html("+"+NumberFormat(dataAbsenToday));

            $("#mesin_cronjobLastOperation"+idmesin).html(data.mesin_cronjobLastOperation);
            $("#mesin_cronjobOperation"+idmesin).html("+"+NumberFormat(mesin_cronjobOperation));
            
            data=undefined;
        }
        )
        .fail(function()
        { 
            setTimeout(() => { $("#idmesin"+idmesin+" td").css("background-color",""); }, 500);
            $("#worker_mesin"+idmesin).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            //setTimeout(function(){ Worker_Mesin(idmesin); }, 10000);
        });
    }
}



function Worker_Email(idsmtp)
{
    var status_layanan=$("#idsmtp"+idsmtp).attr("smtp_status");
    if(status_layanan=="connected" &&  $("#worker_email"+idsmtp+" img").length==0)
    {
        $("#idsmtp"+idsmtp+" td").css("background-color","#fffd7d");
        $("#worker_email"+idsmtp).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "link-email-cronjob.html", { idsmtp:idsmtp },
        function(data)
        {
            setTimeout(() => { $("#idsmtp"+idsmtp+" td").css("background-color",""); }, 500);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};

            var dataQueueEmail=parseInt(data.dataQueueEmail);
            var dataSentEmailAll=parseInt(data.dataSentEmailAll);
            var dataSentEmailToday=parseInt(data.dataSentEmailToday);
            var email_cronjobOperation=parseInt(data.email_cronjobOperation);

            $("#worker_email"+idsmtp).html('idle');            
            $("#smtp_name"+idsmtp).html(data.smtp_name);
            $("#smtp_user"+idsmtp).html(data.smtp_user);
            $("#dataQueueEmail"+idsmtp).html(NumberFormat(dataQueueEmail));

            $("#dataSentEmailAll"+idsmtp).html(NumberFormat(dataSentEmailAll));
            if(dataSentEmailToday==0) var cssDisplay="none"; else var cssDisplay="";
            $("#dataSentEmailToday"+idsmtp).css("display",cssDisplay).html("+"+NumberFormat(dataSentEmailToday));

            $("#email_cronjobLastOperation"+idsmtp).html(data.email_cronjobLastOperation);
            $("#email_cronjobOperation"+idsmtp).html("+"+NumberFormat(email_cronjobOperation));

            if(data.StatusLayananEmail=="connected")
            {
                $("#worker_email"+idsmtp).html('idle'); 
                $("#idsmtp"+idsmtp).removeClass("c-table__row--danger");  
                var statusEmail='<i class="fa fa-check u-color-success u-mr-xsmall"></i>Connected';
            }
            if(data.StatusLayananEmail=="disconnected")
            {
                $("#worker_email"+idsmtp).html('<i class="fas fa-times u-color-danger"></i>'); 
                $("#idsmtp"+idsmtp).addClass("c-table__row--danger");  
                var statusEmail='<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Disconnected';
            } 
            $("#StatusLayananEmail"+idsmtp).html(statusEmail);
            $("#idsmtp"+idsmtp).attr("smtp_status",data.StatusLayananEmail);


            //setTimeout(function(){ Worker_Email(idsmtp); }, 3000);
            data=undefined;
        }
        )
        .fail(function()
        { 
            setTimeout(() => { $("#idsmtp"+idsmtp+" td").css("background-color",""); }, 500);
            $("#worker_email"+idsmtp).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            //setTimeout(function(){ Worker_Email(idsmtp); }, 10000);
        });
    }
}

function Worker_Email_Runtime(idsmtp,timeout)
{
    if($("#idsmtp_worker").val()!=="")
    {   
        var idsmtp_worker=$("#idsmtp_worker").val().split(",");
        if(idsmtp_worker.includes(idsmtp)){ Worker_Email(idsmtp); }
    }

    setTimeout(()=>{ Worker_Email_Runtime(idsmtp,timeout); }, timeout);
}

function Worker_Email_Startup()
{
    if($("#idsmtp_list").val()!=="")
    {
        var idsmtp_list  =$("#idsmtp_list").val().split(",");
        var jmlhEmailAktif =parseInt($("#jmlhEmailAktif").val());

        for(var i=0;i<idsmtp_list.length;i++)
        {   
            var n=(i%jmlhEmailAktif)+1;
            var timeout=(n*500);
            Worker_Email_Runtime(idsmtp_list[i],timeout);
        }
    }
}



function Worker_Watch_Reload_Wa(i=0)
{

    $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color","#fffd7d");
    $.post("link-worker-watch-reload-wa.html", {},
    function(data)
    {
        setTimeout(() => { $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color",""); }, 500);
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        
        $("#idwa_worker").val(data.idwa_worker);

        setTimeout(() => { Worker_Watch_Reload_Wa(++i); }, 2000);
        data=undefined;
    });
}



function Worker_Watch_Reload(i=0)
{
    var jmlhWaAktif     =$("#jmlhWaAktif").val();
    var jmlhEmailAktif  =$("#jmlhEmailAktif").val();

    $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color","#fffd7d");
    $.post("link-worker-watch-reload.html", { jmlhWaAktif:jmlhWaAktif,jmlhEmailAktif:jmlhEmailAktif },
    function(data)
    {
        setTimeout(() => { $("#JumlahDataWA th, #JumlahDataEmailSender th").css("background-color",""); }, 500);
        var data=isJSON(data)?JSON.parse(data):{"respon":data};

        
        $("#totalDataAbsenAll").html(NumberFormat(data.totalDataAbsenAll));
        $("#totalDataAbsenToday").html("+"+NumberFormat(data.totalDataAbsenToday));

        $("#totalDataDefaultSender").html(NumberFormat(data.totalDataDefaultSender));
        $("#totalDataQueue").html(NumberFormat(data.totalDataQueue));
        $("#totalDataSentAll").html(NumberFormat(data.totalDataSentAll));
        if(parseInt(data.totalDataSentToday)==0) var cssDisplay="none"; else var cssDisplay="";
        $("#totalDataSentToday").css("display",cssDisplay).html("+"+NumberFormat(data.totalDataSentToday));
        $("#totalDataReceivedAll").html(NumberFormat(data.totalDataReceivedAll));
        if(parseInt(data.totalDataReceivedToday)==0) var cssDisplay="none"; else var cssDisplay="";
        $("#totalDataReceivedToday").css("display",cssDisplay).html("+"+NumberFormat(data.totalDataReceivedToday));

        $("#totalDataQueueEmail").html(NumberFormat(data.totalDataQueueEmail));
        $("#totalDataSentEmailAll").html(NumberFormat(data.totalDataSentEmailAll));
        if(parseInt(data.totalDataSentEmailToday)==0) var cssDisplay="none"; else var cssDisplay="";
        $("#totalDataSentEmailToday").css("display",cssDisplay).html("+"+NumberFormat(data.totalDataSentEmailToday));
        
        $("#function_worker").val(data.function_worker);
        $("#idmesin_worker").val(data.idmesin_worker);
        /* $("#idwa_worker").val(data.idwa_worker); */
        $("#idsmtp_worker").val(data.idsmtp_worker);
        
        if(data.respon=="reload") goToUrl("./link-worker.html");
        setTimeout(() => { Worker_Watch_Reload(++i); }, 5000);
        data=undefined;
    });
}



var check_connectivity = {
    
    is_internet_connected: function() {
        return $.get({
            url: "/",
            dataType: 'text',
            cache: false
        });
    },
    
};

//function NumberFormat(a){ return a; }


function Worker_System_Startup()
{
    var idcabangWorker  =$("#idcabangWorker").val().split(",");
    var jmlhCabangAktif =$("#jmlhCabangAktif").val();

    for(var i=0;i<idcabangWorker.length;i++)
    {
        var timeout=((i%jmlhCabangAktif)*1000);
        Worker_System_Runtime(idcabangWorker[i],"WaSenderBalancer",timeout);
        Worker_System_Runtime(idcabangWorker[i],"KirimPesanAntarWaSender",timeout);
    }
}


function Worker_System_Runtime(idcabang,job,timeout)
{
    setTimeout(()=>{
        Worker_System(idcabang,job);
    }, timeout);
}


function Worker_System(idcabang,job)
{
    var status_layanan=$("#idcabang"+idcabang).attr("status_layanan");
    if(status_layanan=="aktif")
    {
        if(     job=="KirimPesanAntarWaSender"){  job="WaSenderBalancer"; }
        else if(job=="WaSenderBalancer"){         job="KirimPesanAntarWaSender"; }
        else{                                     job="WaSenderBalancer"; }
    
        var linkurl="",timeout=0;
        if(     job=="WaSenderBalancer"){         timeout=300*1000;  linkurl="link-wa-sender-balancer";         }
        else if(job=="KirimPesanAntarWaSender"){  timeout=900*1000;  linkurl="link-kirim-pesan-antar-wa-sender";}
        else{ timeout=900*1000; linkurl="link-broken"; }
    
        $("#idcabang"+idcabang).css("background-color","lightgreen");
        $("#"+job+idcabang).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( linkurl+".html", { idcabang:idcabang },
        function(data)
        { 
            setTimeout(()=>{ $("#idcabang"+idcabang).css("background-color","#EEEEEE"); }, 500);                        
            $("#"+job+idcabang).html( 'idle' );
            setTimeout(function(){ Worker_System(idcabang,job); }, timeout);
        }
        )
        .fail(function()
        { 
            setTimeout(()=>{ $("#idcabang"+idcabang).css("background-color","red"); }, 500);
            $("#"+job+idcabang).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            setTimeout(function(){ Worker_System(idcabang,job); }, timeout);
        });
    }
}


function Worker_WA_Startup()
{
    if($("#idwa_worker").val()!=="")
    { 
        var idwa_list=$("#idwa_list").val();
        var idwa_worker=$("#idwa_worker").val();
        
        // $("#idwa"+idwa+" td").css("background-color","#fffd7d");
        // $("#worker_wa"+idwa).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "link-whatsapp-cronjob-all.html", { idwa_list:idwa_list,idwa_worker:idwa_worker },
        function(data)
        {
            setTimeout(()=>{ Worker_WA_Startup(); }, 1000);
        }
        )
        .fail(function()
        {
            // setTimeout(() => { $("#idwa"+idwa+" td").css("background-color",""); }, 500);
            // $("#worker_wa"+idwa).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            // setTimeout(function(){ Worker_WA(idwa); }, 10000);

            setTimeout(()=>{ Worker_WA_Startup(); }, 1000);
        });
    }
    else setTimeout(()=>{ Worker_WA_Startup(); }, 1000);
}


/* function Worker_WA_Startup()
{
    if($("#idwa_list").val()!=="")
    { 
        var idwa_list  =$("#idwa_list").val().split(",");
        var jmlhWaAktif  =parseInt($("#jmlhWaAktif").val());
    
        for(var i=0;i<idwa_list.length;i++)
        {
            var n=(i%jmlhWaAktif)+1;
            var timeout=(n*500);
            Worker_WA_Runtime(idwa_list[i],timeout);
        }
    }
} */


function Worker_WA_Runtime(idwa,timeout)
{
    if($("#idwa_worker").val()!=="")
    {   
        var idwa_worker=$("#idwa_worker").val().split(",");
        if(idwa_worker.includes(idwa)){ Worker_WA(idwa); }
    }

    setTimeout(()=>{ Worker_WA_Runtime(idwa,timeout); }, timeout);
}	


function Worker_WA(idwa)
{
    var status_layanan=$("#idwa"+idwa).attr("status_layanan");
    if(status_layanan=="aktif" && $("#worker_wa"+idwa+" img").length==0)
    { 
        $("#idwa"+idwa+" td").css("background-color","#fffd7d");
        $("#worker_wa"+idwa).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "link-whatsapp-cronjob.html", { idwa:idwa },
        function(data)
        {
            setTimeout(() => { $("#idwa"+idwa+" td").css("background-color",""); }, 500);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};


            $("#worker_wa"+idwa).html('idle');
            
            $("#NoHpWa"+idwa).html(data.NoHpWa);
            $("#NamaCabang"+idwa).html(data.NamaCabang);
            $("#dataQueue"+idwa).html(NumberFormat(data.dataQueue));

            $("#dataSentAll"+idwa).html(NumberFormat(data.dataSentAll));
            if(parseInt(data.dataSentToday)==0) var cssDisplay="none"; else var cssDisplay="";
            $("#dataSentToday"+idwa).css("display",cssDisplay).html("+"+NumberFormat(data.dataSentToday));
            
            $("#dataReceivedAll"+idwa).html(NumberFormat(data.dataReceivedAll));
            if(parseInt(data.dataReceivedToday)==0) var cssDisplay="none"; else var cssDisplay="";
            $("#dataReceivedToday"+idwa).css("display",cssDisplay).html("+"+NumberFormat(data.dataReceivedToday));

            $("#cronjobLastOperation"+idwa).html(data.cronjobLastOperation);
            $("#cronjobOperation"+idwa).html("+"+NumberFormat(data.cronjobOperation));

            if(data.StatusLayananWa=="aktif")
            {      
                $("#worker_wa"+idwa).html("idle"); 
                $("#idwa"+idwa).removeClass("c-table__row--danger"); 
                var statusWA='<i class="fa fa-check u-color-success u-mr-xsmall"></i>Aktif'; 
            }
            else if(data.StatusLayananWa=="nonaktif")
            {   
                $("#worker_wa"+idwa).html('<i class="fas fa-times u-color-danger"></i>'); 
                $("#idwa"+idwa).addClass("c-table__row--danger");    
                var statusWA='<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Nonaktif'; 
            }
            $("#StatusLayananWa"+idwa).html(statusWA);
            $("#idwa"+idwa).attr("status_layanan",data.StatusLayananWa);
            
            


            //setTimeout(function(){ Worker_WA(idwa); }, 3000);
            data=undefined;
            statusWA=undefined;
            status_layanan=undefined;
        }
        )
        .fail(function()
        {
            setTimeout(() => { $("#idwa"+idwa+" td").css("background-color",""); }, 500);
            $("#worker_wa"+idwa).html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
            //setTimeout(function(){ Worker_WA(idwa); }, 10000);
        });
    }
}

function AnimateRotate(angle,repeat) {
    var duration= 1000;
    setTimeout(function() {
        if(repeat && repeat == "infinite") { AnimateRotate(angle,repeat); }
        else if ( repeat && repeat > 1) { AnimateRotate(angle, repeat-1); }
    },duration);
    var $elem = $('.icon-repeat');
    $({deg: 0}).animate({deg: angle}, { duration: duration, step: function(now){ $elem.css({ 'transform': 'rotate('+ now +'deg)' }); }});
}
AnimateRotate(360,"infinite");

function isJSON(something) 
{
    if (typeof something != 'string')
        something = JSON.stringify(something);

    try {
        JSON.parse(something);
        return true;
    } catch (e) {
        return false;
    }
}
