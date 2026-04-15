"use strict";

$(document).ready(function(){
	
	$("#TambahNohpWhatsapp").click(function(){ TambahNohpWhatsapp(); });
	$("#SimpanNohpWhatsapp").click(function(){ SimpanNohpWhatsapp(); });
	$(".status-wa-toggle").click(function(){ ToggleStatusWa($(this).attr("idwa")); });
    
});

//

function ToggleStatusWa(idwa)
{
    var statuslayanan=$("#linktogglestatuswa"+idwa).attr("statuslayanan");
	if($("#actbtn_nohpwa"+idwa+" img").length===0)
	{
		$("#actbtn_nohpwa"+idwa).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-toggle-status-wa.html", { idwa:idwa, statuslayanan:statuslayanan },
		function(data){ 
			$("#actbtn_nohpwa"+idwa+" img").remove();
			if(data==="1"){ //alert(statuslayanan);
				if(statuslayanan==='nonaktif')
				{
					$("#idwa"+idwa).removeClass("c-table__row--danger");
					$("#linktogglestatuswa"+idwa).html('<i class="fas fa-bell-slash"></i> Nonaktifkan Notifikasi').attr("statuslayanan","aktif");
					$("#StatusLayananWa"+idwa).html('<i class="fa fa-check u-color-success u-mr-xsmall"></i>Aktif');
				}
				else if(statuslayanan==='aktif')
				{
					$("#idwa"+idwa).addClass("c-table__row--danger");
					$("#linktogglestatuswa"+idwa).html('<i class="fas fa-bell"></i> Aktifkan Notifikasi').attr("statuslayanan","nonaktif");
					$("#StatusLayananWa"+idwa).html('<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Nonaktif');
				}
			}
			else{ modalAlert(data); }
		}).fail(function(){ $("#actbtn"+idwa+" img").remove(); alert('Connection Failed'); });
	}
}

function HapusNohpWhatsapp(idwa)
{
	if($("#actbtn_nohpwa"+idwa+" img").length===0)
	{
		$("#actbtn_nohpwa"+idwa).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$("#idwa"+idwa).css("background-color","#fffd85");
		$.post( "ajax-dashboard-admin-hapus-nohp-whatsapp.html", { idwa:idwa },
		function(data){ 
			$("#actbtn_nohpwa"+idwa+" img").remove();
			if(data==="1")
			{ 
				$("#idwa"+idwa).css("background-color","#ff8f8f").hide('slow', function(){ $("#idwa"+idwa).remove(); });
			}
			else{ modalAlert(data); }
		}).fail(function(){ $("#actbtn_nohpwa"+idwa+" img").remove(); alert('Connection Failed'); });
	}		
}

function SimpanNohpWhatsapp()
{
	var idwa = $("#idwa").val();
	var nohp_wa = $("#nohp_wa").val();
	var api_key = $("#api_key").val();
	var vendor_wa = $("#vendor_wa").val();
	
	if($("#SimpanNohpWhatsapp img").length===0){
		$("#SimpanNohpWhatsapp").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-edit-nohp-whatsapp.html", { idwa:idwa, nohp_wa:nohp_wa, api_key:api_key, vendor_wa:vendor_wa },
		function(data){ 
			$("#SimpanNohpWhatsapp img").remove(); //modalAlert(data);
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon==="success"){ modalInfo("Data berhasil disimpan"); }
			else{ 
				if(data.nohp_wa!==undefined){ 		formAlert("#nohp_wa",data.nohp_wa);} else{ formAlert("#nohp_wa");}
				if(data.api_key!==undefined){ 		formAlert("#api_key",data.api_key);} else{ formAlert("#api_key");}
				if(data.vendor_wa!==undefined){ 	formAlert("#vendor_wa",data.vendor_wa);} else{ formAlert("#vendor_wa");}
			}
		}).fail(function(){ $("#SimpanNohpWhatsapp img").remove(); alert('Connection Failed'); });
	}
}

function TambahNohpWhatsapp()
{
	var nohp_wa 	= $("#nohp_wa").val();
	var api_key 	= $("#api_key").val();
	var vendor_wa 	= $("#vendor_wa").val();
	
	if($("#TambahNohpWhatsapp img").length===0){
		$("#TambahNohpWhatsapp").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-tambah-nohp-whatsapp.html", { nohp_wa:nohp_wa, api_key:api_key, vendor_wa:vendor_wa },
		function(data){ 
			$("#TambahNohpWhatsapp img").remove(); //modalAlert(data);
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon=="success")
			{ 
				//window.location='./dashboard-admin-konfig-sekolah-'+idsekolah+'.html';
				modalInfo("Data berhasil ditambahkan");
				$("#nohp_wa").val(""); formAlert("#nohp_wa");
				$("#api_key").val(""); formAlert("#api_key");
				$("#vendor_wa").val(""); formAlert("#vendor_wa");
			}
			else{ 
				if(data.nohp_wa!==undefined){ 		formAlert("#nohp_wa",data.nohp_wa);} else{ formAlert("#nohp_wa");}
				if(data.api_key!==undefined){ 		formAlert("#api_key",data.api_key);} else{ formAlert("#api_key");}
				if(data.vendor_wa!==undefined){ 	formAlert("#vendor_wa",data.vendor_wa);} else{ formAlert("#vendor_wa");}
			}
		}).fail(function(){ $("#TambahNohpWhatsapp img").remove(); alert('Connection Failed'); });
	}
}