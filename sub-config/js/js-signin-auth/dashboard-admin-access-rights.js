$(document).ready(function(){ 

	$("#search_filename").on('keypress',function(e){ if(e.key==="Enter"){  Filter_AccessRights(); }});
    $(document).on("click","#Filter_AccessRights", function(){          Filter_AccessRights(); });

    $(document).on("click",".default-access-rights", function(){ var idaccess=$(this).attr("idaccess"); accessRights_SetDefaultAccessForm(idaccess); });
    $(document).on("click",".label-jabatan", function(){ var idjabatan=$(this).attr("idjabatan"); $("#jabatan"+idjabatan).click(); });
    $(document).on("click",".check-all-jabatan", function(){ $('.list-jabatan input:checkbox').prop('checked',true); });
    $(document).on("click",".uncheck-all-jabatan", function(){ $('.list-jabatan input:checkbox').prop('checked',false); });
    $(document).on("click",".invert-check-jabatan", function()
    { 
        $('.list-jabatan input:checkbox').each( function() {
            $(this).prop('checked', !$(this).prop('checked'));
        });
    });
    $(document).on("click","#accessRights_SetDefaultAccess", function(){ accessRights_SetDefaultAccess(); });

    $(document).on("click",".allow-access-rights", function(){ var idaccess=$(this).attr("idaccess"); accessRights_addAllowedAccessForm(idaccess); });
    $(document).on("click","#accessRights_addAllowedAccess", function(){ var accessRights_idkaryawan=$("#accessRights_idkaryawan").val(); accessRights_addAllowedAccess(accessRights_idkaryawan); });
    $(document).on("click",".access-rights-del-allowed-access", function(){ var accessRights_idkaryawan=$(this).attr("idkaryawan"); accessRights_delAllowedAccess(accessRights_idkaryawan); });

    $(document).on("click",".block-access-rights", function(){ var idaccess=$(this).attr("idaccess"); accessRights_addBlockAccessForm(idaccess); });
    $(document).on("click","#accessRights_addBlockAccess", function(){ var accessRights_idkaryawan=$("#accessRights_idkaryawan").val(); accessRights_addBlockAccess(accessRights_idkaryawan); });
    $(document).on("click",".access-rights-del-block-access", function(){ var accessRights_idkaryawan=$(this).attr("idkaryawan"); accessRights_delBlockAccess(accessRights_idkaryawan); });

    $(document).off("click",".row-acces-rights")
                .on("click",".row-acces-rights",function()
                {
                    var idelm    = $(this).attr("id");
                    var idaccess = $(this).attr("idaccess");
                    if(doubleClick_ById(idelm))
                    {
                        // alert(idaccess);
                        modalInfo('Loading please wait... <span id="progress_load_subpage"></span>',"hide-btn","medium","Edit File");
                        setTimeout(function()
                        {
                            if($("#progress_load_subpage img").length===0)
                            {
                                $("#progress_load_subpage").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
                                $.post( "dashboard-admin-access-rights-edit-file-form-popup.html", {idaccess:idaccess},
                                function(data)
                                {
                                    $("#progress_load_subpage img").remove();
                                    modalInfo(data,"hide-btn","medium","Edit File");

                                    setTimeout(() => {

                                        var autotext_modulAccessRights=$("#autotext_modulAccessRights").val();
                                        var a = isJSON(autotext_modulAccessRights)?JSON.parse(autotext_modulAccessRights):[];
                                        $( "#modulAccessRights" ).autocomplete({ source: a }); 
                                        $(".ui-autocomplete").css("z-index",2147483647);

                                        var autotext_submodulAccessRights=$("#autotext_submodulAccessRights").val();
                                        var a = isJSON(autotext_submodulAccessRights)?JSON.parse(autotext_submodulAccessRights):[];
                                        $( "#submodulAccessRights" ).autocomplete({ source: a }); 
                                        $(".ui-autocomplete").css("z-index",2147483647);
                                        
                                    }, 1000);

                                }).fail(function(){ $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
                            }
                        }, 200);
                    }
                });

    $(document).off("click",".hapus-file-access-rights")
                .on("click",".hapus-file-access-rights",function()
                {
                    if(confirm("Konfirmasi hapus?"))
                    {
                        var idaccess=$(this).attr("idaccess");
                        // alert("Hapus "+idaccess);

                        var btnTxt = $("#hapusFileAccessRights"+idaccess).html();
                        $("#hapusFileAccessRights"+idaccess).html( '<img src="ajax-loading.gif" style="margin-right:5px;">' ).prop("disabled",true);
                        $.post( "ajax-dashboard-admin-access-rights-edit-file-hapus.html", {idaccess:idaccess},
                        function(data)
                        {
                            $("#hapusFileAccessRights"+idaccess).html(btnTxt).prop("disabled",false);
                            if(data=="success")
                            { 
                                // alert("Berhasil hapus file");
                                $("#idaccess"+idaccess).hide('slow', function(){ $("#idaccess"+idaccess).remove(); });
                                // loadSubPage("dashboard-admin-access-rights");
                                modalHide();
                            }
                            else alert("Gagal hapus file");
                        }).fail(function(){ alert('Connection Failed'); });
                    }
                });

    $(document).off("click","#editFileAccessRights, #nonmodulFileAccessRights")
                .on("click","#editFileAccessRights, #nonmodulFileAccessRights",function()
                {
                   var  idaccess             = $(this).attr("idaccess");
                   var  modulAccessRights    = $(this).attr("id")=="nonmodulFileAccessRights"?"nonmodul":$("#modulAccessRights").val();
                   var  submodulAccessRights = $("#submodulAccessRights").val();

                   if(modulAccessRights=="x_y__Z" || submodulAccessRights=="x_y__Z") alert("Nama modul harus diisi");
                   else
                   {
                        btnText  = $("#editFileAccessRights").html();
                        inputElm = $("#editFileAccessRights, #modulAccessRights, #submodulAccessRights, #nonmodulFileAccessRights");

                        inputElm.prop("disabled",true);
                        $("#editFileAccessRights").html( '<img src="ajax-loading.gif">' );
                        $.post( "ajax-dashboard-admin-access-rights-edit-file-simpan.html", 
                        { 
                            idaccess:idaccess,
                            modulAccessRights:modulAccessRights, 
                            submodulAccessRights:submodulAccessRights 
                        },
                        function(data)
                        {
                                inputElm.prop("disabled",false);
                                $("#editFileAccessRights").html(btnText);
                                var data=isJSON(data)?JSON.parse(data):{"respon":data};
                                if(data.respon=="success")
                                { 
                                    // alert("Berhasil hapus file");
                                    // loadSubPage("dashboard-admin-access-rights");
                                    if(modulAccessRights==="nonmodul")
                                    {
                                        $("#labelModul"+idaccess).html("");
                                        $("#idaccess"+idaccess+" td").removeClass("u-color-info").addClass("u-color-success");
                                    }
                                    else if(modulAccessRights==="")
                                    {
                                        $("#labelModul"+idaccess).html("");
                                        $("#idaccess"+idaccess+" td").addClass("u-color-info");
                                    } 
                                    else
                                    {
                                        $("#labelModul"+idaccess).html(modulAccessRights+" / "+submodulAccessRights);
                                        $("#idaccess"+idaccess+" td").removeClass("u-color-info");
                                    }

                                    
                                    modalHide();
                                }
                                else if(data.respon !== undefined) alert(data.respon);
                                else alert(data);
                        }).fail(function(){ alert('Connection Failed'); });
                   }
                });
     
});


//

function accessRights_delBlockAccess(accessRights_idkaryawan)
{
    if($("#accessRights_delBlockAccess"+accessRights_idkaryawan+" img").length===0)
    {
        var accessRights_idaccess = $("#accessRights_idaccess").val();
        $("#accessRights_delBlockAccess"+accessRights_idkaryawan+"").html( '<img src="ajax-loading.gif" style="">' );
        $.post( "ajax-dashboard-admin-access-rights-set-block-access-del.html", { accessRights_idaccess:accessRights_idaccess, accessRights_idkaryawan:accessRights_idkaryawan },
        function(data)
        {   //alert(data);
            $("#accessRights_delBlockAccess"+accessRights_idkaryawan+" img").html('<i class="fas fa-minus-circle"></i>'); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { 
                //$("#modalAlert").modal("hide"); 
                //loadSubPage("dashboard-admin-access-rights"); 
                $("#block_access_"+accessRights_idaccess).html(data.count_block_access);
                accessRights_addBlockAccessForm(accessRights_idaccess); 
            }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#accessRights_delBlockAccess"+accessRights_idkaryawan+" img").html('<i class="fas fa-minus-circle"></i>'); alert('Connection Failed'); });
	}
}

function accessRights_addBlockAccess(accessRights_idkaryawan)
{
    if($("#accessRights_addBlockAccess img").length===0)
    {
        var elm = "#accessRights_addBlockAccess, #accessRights_idkaryawan";
        var accessRights_idaccess = $("#accessRights_idaccess").val();
        $(elm).prop("disabled",true);
        $("#accessRights_addBlockAccess").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-access-rights-set-block-access-add.html", { accessRights_idaccess:accessRights_idaccess, accessRights_idkaryawan:accessRights_idkaryawan },
        function(data)
        {   //alert(data);
            $(elm).prop("disabled",false);
            $("#accessRights_addBlockAccess img").remove(); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { 
                //$("#modalAlert").modal("hide"); 
                //loadSubPage("dashboard-admin-access-rights"); 
                $("#block_access_"+accessRights_idaccess).html(data.count_block_access);
                accessRights_addBlockAccessForm(accessRights_idaccess); 
            }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#accessRights_addBlockAccess img").remove(); $(elm).prop("disabled",false); alert('Connection Failed'); });
	}
}

function accessRights_addBlockAccessForm(accessRights_idaccess)
{ // 
	setTimeout(function(){
		modalInfo('Loading please wait... <span id="progress_load_subpage"></span>',"hide-btn","medium","Exception : Block Access");
		setTimeout(function(){
			if($("#progress_load_subpage img").length===0)
			{
				$("#progress_load_subpage").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
				$.post( "dashboard-admin-access-rights-set-block-form-popup.html", {accessRights_idaccess:accessRights_idaccess},
				function(data){
                    /* var data=isJSON(data)?JSON.parse(data):{"respon":data}; */
					$("#progress_load_subpage img").remove();
                    modalInfo(data,"hide-btn","medium","Exception : Block Access");
                    setTimeout(() => { /* dataPenjualan_FilterOptionParamCluster($("#idperumahan_FilterOption_DataPenjualan").val()); */ }, 200);
				}).fail(function(){ $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
			}
		}, 100);		
	}, 100);		
}


function accessRights_delAllowedAccess(accessRights_idkaryawan)
{
    if($("#accessRights_delAllowedAccess"+accessRights_idkaryawan+" img").length===0)
    {
        var accessRights_idaccess = $("#accessRights_idaccess").val();
        $("#accessRights_delAllowedAccess"+accessRights_idkaryawan+"").html( '<img src="ajax-loading.gif" style="">' );
        $.post( "ajax-dashboard-admin-access-rights-set-allowed-access-del.html", { accessRights_idaccess:accessRights_idaccess, accessRights_idkaryawan:accessRights_idkaryawan },
        function(data)
        {   //alert(data);
            $("#accessRights_delAllowedAccess"+accessRights_idkaryawan+" img").html('<i class="fas fa-minus-circle"></i>'); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { 
                //$("#modalAlert").modal("hide"); 
                //loadSubPage("dashboard-admin-access-rights"); 
                $("#allow_access_"+accessRights_idaccess).html(data.count_allow_access);
                accessRights_addAllowedAccessForm(accessRights_idaccess); 
            }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#accessRights_delAllowedAccess"+accessRights_idkaryawan+" img").html('<i class="fas fa-minus-circle"></i>'); alert('Connection Failed'); });
	}
}

function accessRights_addAllowedAccess(accessRights_idkaryawan)
{
    if($("#accessRights_addAllowedAccess img").length===0)
    {
        var elm = "#accessRights_addAllowedAccess, #accessRights_idkaryawan";
        var accessRights_idaccess = $("#accessRights_idaccess").val();
        $(elm).prop("disabled",true);
        $("#accessRights_addAllowedAccess").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-access-rights-set-allowed-access-add.html", { accessRights_idaccess:accessRights_idaccess, accessRights_idkaryawan:accessRights_idkaryawan },
        function(data)
        {   //alert(data);
            $(elm).prop("disabled",false);
            $("#accessRights_addAllowedAccess img").remove(); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { 
                //$("#modalAlert").modal("hide"); 
                //loadSubPage("dashboard-admin-access-rights"); 
                $("#allow_access_"+accessRights_idaccess).html(data.count_allow_access);
                accessRights_addAllowedAccessForm(accessRights_idaccess); 
            }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#accessRights_addAllowedAccess img").remove(); $(elm).prop("disabled",false); alert('Connection Failed'); });
	}
}

function accessRights_addAllowedAccessForm(accessRights_idaccess)
{ // 
	setTimeout(function(){
		modalInfo('Loading please wait... <span id="progress_load_subpage"></span>',"hide-btn","medium","Exception : Allowed Access");
		setTimeout(function(){
			if($("#progress_load_subpage img").length===0)
			{
				$("#progress_load_subpage").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
				$.post( "dashboard-admin-access-rights-set-allow-form-popup.html", {accessRights_idaccess:accessRights_idaccess},
				function(data){
                    /* var data=isJSON(data)?JSON.parse(data):{"respon":data}; */
					$("#progress_load_subpage img").remove();
                    modalInfo(data,"hide-btn","medium","Exception : Allowed Access");
                    setTimeout(() => { /* dataPenjualan_FilterOptionParamCluster($("#idperumahan_FilterOption_DataPenjualan").val()); */ }, 200);
				}).fail(function(){ $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
			}
		}, 100);		
	}, 100);		
}


function Filter_AccessRights()
{
    if($("#Filter_AccessRights img").length===0)
    {

        var elm = "#Filter_AccessRights, #search_filename, #filterPathdir_AccessRights, #filterModul_AccessRights, #filterFitur_AccessRights";
        var filterModul_AccessRights    = $("#filterModul_AccessRights").val();
        var filterFitur_AccessRights    = $("#filterFitur_AccessRights").val();
        var filterPathdir_AccessRights  = $("#filterPathdir_AccessRights").val();
        var search_filename             = $("#search_filename").val();
        $(elm).prop("disabled",true);
        $("#Filter_AccessRights").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-access-rights-filter-search.html", 
        { 
            filterModul_AccessRights:filterModul_AccessRights,
            filterFitur_AccessRights:filterFitur_AccessRights,
            search_filename:search_filename,
            filterPathdir_AccessRights:filterPathdir_AccessRights 
        },
        function(data)
        {   //alert(data);
            $(elm).prop("disabled",false);
            $("#Filter_AccessRights img").remove(); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { loadSubPage("dashboard-admin-access-rights"); }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#Filter_AccessRights img").remove(); $(elm).prop("disabled",false); alert('Connection Failed'); });
        
	}
}

function accessRights_SetDefaultAccess()
{
    var accessRights_DefaultAccess = [];
    $.each($(".list-jabatan input:checkbox"), function(){
        if($(this).prop('checked')) accessRights_DefaultAccess.push($(this).val());
    });  //alert(accessRights_DefaultAccess);
    if(accessRights_DefaultAccess.length==0) accessRights_DefaultAccess="";


    if($("#accessRights_SetDefaultAccess img").length===0)
    {

        var elm = ".list-jabatan input:checkbox";
        var accessRights_idaccess = $("#accessRights_idaccess").val();
        $(elm).prop("disabled",true);
        $("#accessRights_SetDefaultAccess").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-access-rights-set-default-access.html", { accessRights_idaccess:accessRights_idaccess,accessRights_DefaultAccess:accessRights_DefaultAccess },
        function(data)
        {   //alert(data);
            $(elm).prop("disabled",false);
            $("#accessRights_SetDefaultAccess img").remove(); //modalAlert(data);
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            if(data.respon==="success")
            { 
                //$("#modalAlert").modal("hide"); 
                //loadSubPage("dashboard-admin-access-rights"); 
                $("#default_access_"+accessRights_idaccess).html(data.count_default_access);
            }
            else if(data.respon!==undefined){ alert(data.respon); }
        }).fail(function(){ $("#accessRights_SetDefaultAccess img").remove(); $(elm).prop("disabled",false); alert('Connection Failed'); });
        
	}
}

function accessRights_SetDefaultAccessForm(accessRights_idaccess)
{ // 
	setTimeout(function(){
		modalInfo('Loading please wait... <span id="progress_load_subpage"></span>',"hide-btn","medium","Set Default Access");
		setTimeout(function(){
			if($("#progress_load_subpage img").length===0)
			{
				$("#progress_load_subpage").html( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
				$.post( "dashboard-admin-access-rights-set-default-form-popup.html", {accessRights_idaccess:accessRights_idaccess},
				function(data){
                    /* var data=isJSON(data)?JSON.parse(data):{"respon":data}; */
					$("#progress_load_subpage img").remove();
                    modalInfo(data,"hide-btn","medium","Set Default Access");
                    setTimeout(() => { /* dataPenjualan_FilterOptionParamCluster($("#idperumahan_FilterOption_DataPenjualan").val()); */ }, 200);
				}).fail(function(){ $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
			}
		}, 100);		
	}, 100);		
}