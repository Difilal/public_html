$(function()
{
    if($("#wa_sync").length>0)
    { 
        setTimeout(()=>{ Worker_Wa_Sync(); }, 2000);
        /* setTimeout(()=>{ Worker_Wa_Sync_File(); }, 1000); */
    }
});




function Worker_Wa_Sync(i=0)
{
    if($("#idwa_worker").val()!=="")
    { 
        var idwa_worker=$("#idwa_worker").val();
        
        $("#progress_sync").html( '<img src="img-loading48.gif" style="margin-right:5px;">' );
        $.post( "link-whatsapp-cronjob-all.html", { idwa_worker:idwa_worker },
        function(data)
        {
            $("#progress_sync").html( '<img src="img-check.png" style="margin-right:5px;">' );
            setTimeout(()=>{ Worker_Wa_Sync(); }, 4000);
            data=undefined;
        }
        )
        .fail(function()
        {
            $("#progress_sync").html( '<img src="img-check.png" style="margin-right:5px;">' );
            setTimeout(()=>{ Worker_Wa_Sync(); }, 4000);
        });
    }
    else setTimeout(()=>{ Worker_Wa_Sync(); }, 4000);
}




function Worker_Wa_Sync_File(i=0)
{
    if($("#idwa_worker").val()!=="")
    { 
        $("#progress_sync_file").html( '<img src="img-loading48.gif" style="margin-right:5px;">' );
        $.post( "link-whatsapp-wa-notif-sync-file.html", { /* idwa_worker:idwa_worker */ },
        function(data)
        {
            $("#progress_sync_file").html( '<img src="img-check.png" style="margin-right:5px;">' );
            setTimeout(()=>{ Worker_Wa_Sync_File(); }, 4000);
            data=undefined;
        }
        )
        .fail(function()
        {
            $("#progress_sync_file").html( '<img src="img-check.png" style="margin-right:5px;">' );
            setTimeout(()=>{ Worker_Wa_Sync_File(); }, 4000);
        });
    }
    else setTimeout(()=>{ Worker_Wa_Sync_File(); }, 4000);
}