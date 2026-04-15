

$(function(){ /* alert("halow earth"); */

    var idmesin_worker=$("#idmesin_worker").html();
    var url_mesin_worker=$("#url_mesin_worker").html();
 
    if(idmesin_worker!=="")
    {
        if(isJSON(idmesin_worker))   var idmesin_worker  =JSON.parse(idmesin_worker);   else var idmesin_worker  ={"data":idmesin_worker};
        if(isJSON(url_mesin_worker)) var url_mesin_worker=JSON.parse(url_mesin_worker); else var url_mesin_worker={"data":url_mesin_worker};

        /* alert(idmesin_worker.length); */
        for(i=0;i<idmesin_worker.length;i++)
        {
            Worker_Absen_Adms(idmesin_worker[i],url_mesin_worker[i]);
        }
    }


    /* <?php 
            
        
        if(isset($idmesin_worker)){
            for($i=0;$i<count($idmesin_worker);$i++)
            { 
                echo 'Worker_Absen_Adms('.$idmesin_worker[$i].',"'.$url_mesin_worker[$i].'");'; 
            }
        } 
            
    ?> */
    });


    var check_connectivity = {
                
        is_internet_connected: function() {
            return $.get({
                url: "/",
                dataType: 'text',
                cache: false
            });
        },
        
    };




    function Worker_Absen_Adms(idmesin,url_adms)
    {
        var status_layanan=$("#idmesin"+idmesin).attr("status_layanan");
        if(status_layanan=="aktif")
        {
            $("#worker_absen"+idmesin+"_adms").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
            $.post( url_adms, { idmesin:idmesin },
            function(data)
            {
                $("#worker_absen"+idmesin+"_adms").html( 'idle' );
                setTimeout(function(){ Worker_Absen_Adms(idmesin,url_adms); }, 3000);
            }
            )
            .fail(function()
            {
                $("#worker_absen"+idmesin+"_adms").html( '<i class="fas fa-exclamation-circle u-color-danger"></i>' );
                setTimeout(function(){ Worker_Absen(idmesin); }, 10000);
                //alert('WA Worker '+idmesin+' : Error'); 
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