"use strict";

$(function(){

	$("#btn_clear").click(function(){ ClearSearchSiswaElm(); });
	$("#btn_paste").click(function(){ PasteSearchSiswaElm(); });
	$("#open_sidebar").click(function(){ openSidebar(); });

    $("#provinsi").on('change',function(){ updateKota(); });
	$("#kota").on('change',function(){ updateKecamatan(); });
	$("#kecamatan").on('change',function(){ updateKelurahan(); });
	
});



function ClearSearchSiswaElm()
{
    $("#search_siswa").val("").focus();
    $("#btn_paste").removeClass("u-hidden-visually");
    $("#btn_clear").addClass("u-hidden-visually");
}

async function pasteSearchSiswa()
{
    const text = await navigator.clipboard.readText();
    $("#search_siswa").val(text.trim());
}


function openSidebar()
{
    if($("#sidebar_left").hasClass("is-visible")){ $("#sidebar_left").removeClass("is-visible") }
    else{ $("#sidebar_left").addClass("is-visible") }
}


function updateKelurahan()
{
	if($("#kelurahan-label img").length===0)
	{   
		$("#kelurahan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kelurahan.html", { provinsi:$("#provinsi").val(), kota:$("#kota").val(), kecamatan:$("#kecamatan").val() },
		function(data)
		{
			$("#kelurahan-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon=="success")
			{
				$("#kelurahan").html(data.option);
			}
			else
			{ 
				$("#kelurahan").html(data.option);
			}

			data=undefined;
		})
		.fail(function(){ $("#kelurahan-label img").remove(); alert('Connection Failed'); });
	}
}


function updateKecamatan()
{
	if($("#kecamatan-label img").length===0)
	{   
		$("#kecamatan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kecamatan.html", { provinsi:$("#provinsi").val(), kota:$("#kota").val() },
		function(data)
		{
			$("#kecamatan-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon=="success")
			{
				$("#kecamatan").html(data.option);
				setTimeout(function(){ updateKelurahan(); }, 200);
				//modalAlert(data.option);
			}
			else
			{ 
				$("#kecamatan").html(data.option);
				setTimeout(function(){ updateKelurahan(); }, 200);
				//modalAlert(data.respon);
			}

			data=undefined;
		})
		.fail(function(){ $("#kecamatan-label img").remove(); alert('Connection Failed'); });
	}
}


function updateKota()
{
	if($("#kota-label img").length===0)
	{
		$("#kota-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kota.html", { provinsi:$("#provinsi").val() },
		function(data)
		{
			$("#kota-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon=="success")
			{
				$("#kota").html(data.option);
				setTimeout(function(){ updateKecamatan(); }, 200);
			}
			else
			{ 
				$("#kota").html(data.option);
				setTimeout(function(){ updateKecamatan(); }, 200);
				//modalAlert(data.respon); 
			}

			data=undefined;
		})
		.fail(function(){ $("#kota-label img").remove(); alert('Connection Failed'); });
	}
}