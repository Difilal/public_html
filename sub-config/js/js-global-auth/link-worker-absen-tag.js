$(function()
{ /* alert("halow earth"); */

    var idmesin_worker=$("#idmesin_worker").html();
    var url_mesin_worker=$("#url_mesin_worker").html();
    var data_mesin_absen=$("#data_mesin_absen").html();
 
    if(data_mesin_absen!=="")
    {
        if(isJSON(idmesin_worker))   var idmesin_worker   = JSON.parse(idmesin_worker);   else var idmesin_worker   = {"data":idmesin_worker};
        if(isJSON(url_mesin_worker)) var url_mesin_worker = JSON.parse(url_mesin_worker); else var url_mesin_worker = {"data":url_mesin_worker};
        if(isJSON(data_mesin_absen)) var data_mesin_absen = JSON.parse(data_mesin_absen); else var data_mesin_absen = {"data":data_mesin_absen};

        /* alert(idmesin_worker.length); */
        // for(i=0;i<idmesin_worker.length;i++)
        // {
        //     Worker_Absen_Adms(idmesin_worker[i],url_mesin_worker[i]);
        // }

        $("#rowJumlahData_MesinAbsen").css("background-color","cyan");
        setTimeout(function(){ Worker_Absen_Adms_all(data_mesin_absen); }, 3000);
    }

});




function Worker_Absen_Adms_all(data_mesin_absen)
{
    if($("#progresApiSyncMesinAbsen").html()=='<img src="img-check.png">')
    {
        $("#progresApiSyncMesinAbsen").html('<img src="ajax-loading48.gif">');
        $("#rowJumlahData_MesinAbsen").css("background-color","yellow");
        $.post( "api-sync-tag.html", { data_mesin_absen:data_mesin_absen },
        function(data)
        {
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            // if(data.dataMesinWorking!==undefined) $("#data_mesin_absen").html(data.dataMesinWorking);
            $("#progresApiSyncMesinAbsen").html('<img src="img-check.png">');
            $("#rowJumlahData_MesinAbsen").css("background-color","cyan");
            setTimeout(function(){ Worker_Absen_Adms_all(data_mesin_absen); }, 3000);
            data=undefined;
        });
    }
}




function Worker_Absen_Adms(idmesin,url_adms)
{
    // var status_layanan=$("#idmesin"+idmesin).attr("status_layanan");
    // if(status_layanan=="aktif")
    // {
    //     $("#worker_absen"+idmesin+"_adms").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
    //     $.post( url_adms, { idmesin:idmesin },
    //     function(data)
    //     { //alert(data.idlogwa);
    //         //var data=JSON.parse(data);
    //         $("#worker_absen"+idmesin+"_adms").html( 'idle' );
    //         setTimeout(function(){ Worker_Absen_Adms(idmesin,url_adms); }, 3000);
    //     }
    //     )
    //     .fail(function()
    //     {
    //         $("#worker_absen"+idmesin+"_adms").html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
    //         setTimeout(function(){ Worker_Absen(idmesin); }, 10000);
    //         //alert('WA Worker '+idmesin+' : Error'); 
    //     });
    // }
}	

    
function AnimateRotate(angle,repeat)
{
    var duration= 1000;
    setTimeout(function() 
    {
        if(repeat && repeat == "infinite") { AnimateRotate(angle,repeat); }
        else if ( repeat && repeat > 1) { AnimateRotate(angle, repeat-1); }
    },duration);
    var $elem = $('.icon-repeat');
    $({deg: 0}).animate({deg: angle}, { duration: duration, step: function(now){ $elem.css({ 'transform': 'rotate('+ now +'deg)' }); }});
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