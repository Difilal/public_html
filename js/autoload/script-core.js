"use strict";

$(function(){   

	if(iniFrame()){ goToUrl("https://www.google.com/"); }else $("body.d-none").removeClass("d-none");
	initElmPswd();
	
	if($(".focus-onload").length && $("body").attr("device")=="desktop"){ focusElm(".focus-onload:eq(0)"); /* var val_elm=$(".focus-onload:eq(0)").val(); $(".focus-onload:eq(0)").val("").focus().val(val_elm); */ }
	// if($(".focus-onload").length && $("body").attr("device")=="desktop"){ var val_elm=$(".focus-onload:eq(0)").val(); $(".focus-onload:eq(0)").val("").focus().val(val_elm); }
	if($(".cursor-pointer").length){ $(".cursor-pointer").css("cursor","pointer"); }
	$(document).off('click','.clear-value').on('click','.clear-value',function(){ clearValue($(this).attr("elm")); });
	var clipboard=new ClipboardJS('.copy-btn');	
	$(window).on('resize', function(){ toggleMainNav(); }); toggleMainNav();
	//$('.textarea-autogrow').css('overflow', 'hidden').autogrow({vertical: true, horizontal: false});
	//$(document).off('click change keyup mouseup','.textarea-autogrow').on('click change keyup mouseup','.textarea-autogrow',function(){ $(this).css('overflow', 'hidden').autogrow({vertical: true, horizontal: false}); });
	$(document).off('click','.copy-text').on('click','.copy-text',(function()
	{
		if($("#copyTextInput").length<1)
		{
			var elminp = '<input id="copyTextInput" class="d-none">';
			$("body").append(elminp);
		}

		var t = $(this).data("copy-text"); $("#copyTextInput").val(t);
		// var copyText = document.getElementById("copyTextInput");/* Get the text field */
		// copyText.select();/* Select the text field */
		// copyText.setSelectionRange(0, 99999); /* For mobile devices */
		// navigator.clipboard.writeText(copyText.value);

		var $temp = $("#copyTextInput");
		// $("body").append($temp);

		$temp.select();
		document.execCommand("copy");
		$temp.remove();
	}));
	$(document).off('keyup','.filter-number').on('keyup','.filter-number',(function()
	{ 
		var angka = $(this).val();
		if ($(this).attr("min")!==undefined) var min=$(this).attr("min"); else var min=0;
		if ($(this).attr("max")!==undefined) var max=$(this).attr("max"); else var max=9223372036854775807;

		var a=FilterNumber(angka,min,max);
		$(this).val(a); 
	}));
	$(document).off('keyup','.decimal-format').on('keyup','.decimal-format',(function(e)
	{
		var decnum	= $(this).attr("decnum")?(parseInt(FilterNumber($(this).attr("decnum")))>0?parseInt(FilterNumber($(this).attr("decnum"))):2):2; // var maxnum	= $(this).attr("maxnum")?DecimalFormatLabel($(this).attr("maxnum")):0;
		var maxnum	= $(this).attr("maxnum")?filterDecimal($(this).attr("maxnum")):"x";
		angka=DecimalFormatLabel($(this).val(),decnum,maxnum);
		$(this).val(angka);
	}));
	$(document).off('keyup','.number-format').on('keyup','.number-format',(function(e)
	{ 
		var angka = $(this);
		if ($(this).attr("min")!==undefined) var min=$(this).attr("min"); else var min=0;
		if ($(this).attr("max")!==undefined) var max=$(this).attr("max"); else var max=9223372036854775807;
		NumberFormat(angka,min,max,e.keyCode);
	}));
	$(document).off('keyup','.filter-alphanumeric').on('keyup','.filter-alphanumeric',(function(){ var a=FilterAlphaNumeric($(this).val()); $(this).val(a); }));
	$(document).off('keyup','.filter-alnumspace').on('keyup','.filter-alnumspace',(function(){ var a=FilterAlNumSpace($(this).val()); $(this).val(a); }));
	$(document).off('keyup','input.filter-number, input.number-format, input.filter-alphanumeric').on('keyup','input.filter-number, input.number-format, input.filter-alphanumeric',(function(e){ if(e.keyCode==46) $(this).val(""); }));
	$("#modalAlert").draggable({ handle: "#modal-header" });
	// $("#open_sidebar").click(function(){ openSidebar(); });
	$(document).off("click","#open_sidebar").on("click","#open_sidebar",function(){ openSidebar(); });
	
	$(document).off('click',".modal-confirm").on('click',".modal-confirm",function()
	{ 
		var confirmtext = $(this).attr('confirmtext');
		var confirmyes 	= $(this).attr('confirmyes');
		var confirmno 	= $(this).attr('confirmno');
		var addclassbtn = $(this).attr('addclassbtn');
		var idkey 		= $(this).attr('idkey');
		var idval 		= $(this).attr('idval');

		if (typeof confirmtext == typeof undefined || confirmtext == false) confirmtext = "";
		if (typeof confirmyes == typeof undefined || confirmyes == false) 	confirmyes 	= "";
		if (typeof confirmno == typeof undefined || confirmno == false) 	confirmno 	= "";
		if (typeof addclassbtn == typeof undefined || addclassbtn == false) addclassbtn = "";
		if (typeof idkey == typeof undefined || idkey == false) 			idkey 		= "";
		if (typeof idval == typeof undefined || idval == false) 			idval 		= "";

		/* modalConfirm(confirmtext,confirmyes); */
		modalConfirm(confirmtext,confirmyes,confirmno,"auto",addclassbtn,idkey,idval);
	});
	$(".tooltip-elm").tooltip();
	$(".select2").select2();
	$("select.select2.remove-search").select2({ minimumResultsForSearch: Infinity });
	$("td.jam_masuk .select2-selection__rendered, td.jam_pulang .select2-selection__rendered, td.jam_masuk .jam_masuk, td.jam_pulang .jam_pulang, div#jam_pulang-wrapper .select2-selection__rendered, div#jam_masuk-wrapper .select2-selection__rendered").css("color","#0003bf");
	$("td.batas_jam_masuk .select2-selection__rendered, td.batas_jam_pulang .select2-selection__rendered, td.batas_jam_masuk .batas_jam_masuk, td.batas_jam_pulang .batas_jam_pulang, div#batas_jam_masuk-wrapper .select2-selection__rendered, div#batas_jam_pulang-wrapper .select2-selection__rendered").css("color","#db0000");
	$(".c-choice__label").css("padding-top",".5rem");
	$(".c-choice.c-choice--checkbox").css("margin","0px");
	$(document).off('click','.insertAtCaret').on('click','.insertAtCaret',function(){ var targetid=$(this).attr("targetid"),textinsert=$(this).attr("textinsert"); insertAtCaret(targetid,textinsert); });
	$(document).off('click','.toggle-hide').on('click','.toggle-hide',function(){ var attr = $(this).attr('elmToggleHide');if((typeof attr !== typeof undefined && attr !== false) && $(this).attr("elmToggleHide")!=""){ elm=$(this).attr("elmToggleHide"); elm=$(elm); }else elm=$(this); elm.toggle(300); });
	$(document).off('click','.toggle-show').on('click','.toggle-show',function(){ var attr = $(this).attr('elmToggleHide');if((typeof attr !== typeof undefined && attr !== false) && $(this).attr("elmToggleHide")!=""){ elm=$(this).attr("elmToggleHide"); elm=$(elm); }else elm=$(this); elm.toggle(300); });
	$(document).off('click','.toggle-subform').on('click','.toggle-subform',function(){ toggleSubform($(this).attr("tsfid"),$(this).attr("tsfclass")); });
	$(document).off('blur','.toggle-subform[tsfblur="1"]')
				.on('blur','.toggle-subform[tsfblur="1"]',function()
				{ 
					$('.toggle-subform[tsfblur="1"]').each(function( index )
					{
						tsfid=$(this).attr("tsfid");
						if($('#'+tsfid).hasClass('d-block')) $('#'+tsfid).removeClass('d-block').addClass('d-none');
					});
				});
	$(document).off('click','.toggle-class').on('click','.toggle-class',function(){ toggleClass($(this).attr("tgcid"),$(this).attr("tgcclass"),$(this).attr("tgcmark"),$(this).attr("tgcdef"),$(this).attr("tgcdef")); });
	$(document).off('click','.toggle-block-none').on('click','.toggle-block-none',function(){ toggleBlockNone($(this).attr("tbnid"),$(this).attr("tbnclass")); });
	$(document).off('click','.toggle-display-none').on('click','.toggle-display-none',function(){ toggleDisplayNone($(this).attr("tdnid"),$(this).attr("tdnclass")); });
	$(document).off('click','.toggle-show-password').on('click','.toggle-show-password',function(){ toggleShowPassword($(this).attr("targetid")); });
	$(document).off('click','.toggle-text-password').on('click','.toggle-text-password',function()
	{ 
		var idelm=$(this).attr("targetid");
		if 		($("#"+idelm).hasClass("pswd")){ 	$("#"+idelm).removeClass("pswd"); 	$(this).removeClass("fa-eye-slash").addClass("fa-eye"); }
		else{ 										$("#"+idelm).addClass("pswd"); 		$(this).removeClass("fa-eye").addClass("fa-eye-slash"); }

		var x=document.getElementById(idelm);
		var s=window.getComputedStyle(x);
		if(s.webkitTextSecurity){}
		else
		{ 
			if 		($("#"+idelm).attr("type")=="password"){ 	$("#"+idelm).attr("type","text"); }
			else{ 												$("#"+idelm).attr("type","password"); }
		}
	});
	$(document).off('keyup','.next-element')
				.on('keyup','.next-element',(function(e)
				{
					var classElm = $(this).attr("next-element");
					var lenElm 	 = $("."+classElm).length;
					var idxElm 	 = $("."+classElm).index(this);

						 if(classElm!="" && e.key==="Enter" && !e.shiftKey){ elmfocus("."+classElm+":eq("+( (idxElm+1)==lenElm?0:(idxElm+1) )+")"); }
					else if(classElm!="" && e.key==='Enter' &&  e.shiftKey){ elmfocus("."+classElm+":eq("+( idxElm==0?(lenElm-1):(idxElm-1) )+")"); }

						
					if($(this).attr("count-value")=="1")
					{
						setTimeout(() => 
						{
							var m=0,n; $("."+classElm).each(function( index ) 
							{
								n = $(this).val()=="" ? 0 : filterDecimal($(this).val());
								m += n;

								$("."+classElm+"-total").val(DecimalFormatReal(m));
							});
						}, 200);
					}
				}));
	$(document).off('keypress','.next-input').on('keypress','.next-input',(function(e)
	{ 
		var nextElm = $(this).attr("nextinput"),
			prevElm = $(this).attr("previnput"); 

			 if(nextElm!="" && e.key==="Enter" && !e.shiftKey){ elmfocus("#"+nextElm); }
		else if(prevElm!="" && e.key==='Enter' &&  e.shiftKey){ elmfocus("#"+prevElm); }
	}));
	$(document).off('click','.btn-print-area').on('click','.btn-print-area',function()
	{
		var printarea = $(this).attr("printarea");
		var clone = $(this).attr("printarea");
		var konten = clone==1?$(printarea).clone():$(printarea).html();
		$("#printAreaContainer").html(konten);
		$("body").css("background-color","#FFFFFF");

		window.print();

		setTimeout(() => 
		{ 
			$("#printAreaContainer").html(""); 
			$("body").css("background-color","#EFF3F6");
		}, 200);
	});

	$(document).off("click",".nav-subform")
				.on("click",".nav-subform",function()
				{ 
					var form=$(this).attr("form");
					navSubform(form);
				});
	$(document).off("click",".navtab-toggle-menu")
				.on("click",".navtab-toggle-menu",function()
				{
					var navtabclass		= $(this).attr("navtabclass");
					var navtabwrapper	= $(this).attr("navtabwrapper");

					$('.navtab-toggle-menu').removeClass("active").addClass("text-muted");
					$('.navtab-toggle-menu'+'[navtabwrapper="'+navtabwrapper+'"]').removeClass("text-muted").addClass("active");

					$('.'+navtabclass).removeClass("d-block").addClass("d-none");
					$('.'+navtabclass+'[navtabwrapper="'+navtabwrapper+'"]').removeClass("d-none").addClass("d-block");
				});


	$(document).off('click', '.remove-parent1').on('click', '.remove-parent1', function() { $(this).parent().remove(); });
	$(document).off('click', '.remove-parent2').on('click', '.remove-parent2', function() { $(this).parent().parent().remove(); });
	$(document).off('click', '.remove-parent3').on('click', '.remove-parent3', function() { $(this).parent().parent().parent().remove(); });
	$(document).off('click', '.remove-parent4').on('click', '.remove-parent4', function() { $(this).parent().parent().parent().parent().remove(); });
	$(document).off('click', '.remove-parent5').on('click', '.remove-parent5', function() { $(this).parent().parent().parent().parent().parent().remove(); });


	$(document).off("click",".btn-check-all").on("click",".btn-check-all",function(){ 		$('input.'+$(this).attr("classchecklist")).prop('checked',true); });
	$(document).off("click",".btn-uncheck-all").on("click",".btn-uncheck-all",function(){ 	$('input.'+$(this).attr("classchecklist")).prop('checked',false); });
	$(document).off("click",".btn-check-invert").on("click",".btn-check-invert",function(){ $('input.'+$(this).attr("classchecklist")).each(function(){ if(this.checked){ $(this).prop('checked',false); }else{ $(this).prop('checked',true); }; }); });	
    $(document).off("click",".btn-check-all, .btn-uncheck-all, .btn-check-invert, .label-check-list, .input-check-list")
				.on("click",".btn-check-all, .btn-uncheck-all, .btn-check-invert, .label-check-list, .input-check-list", function()
	{ 
				var a=$(this).closest('.wrapper-check-list').attr("id"); var b=[];
				$("#"+a+" input.input-check-list:checked").each(function(){ b.push($(this).val()); });
				$("#"+a+" .count-check-list-selected").html(b.length+" Selected");
				$("#"+a+" .count-check-list").html(b.length).attr("ccl",b.length).trigger("data-attribute-changed");

				// class required
				// .wrapper-check-list 	=> root wrapper => wajib attr id
				// .count-check-list	=> count selected label
				// .btn-check-all, .btn-uncheck-all, .btn-check-invert + attr classchecklist
				// .label-check-list, .input-check-list
    });


});



//////


function doubleClick_ById(elm=0)
{
	// $(document).off("click",".row-data").on("click",".row-data",function()
    // { 
    //     if( $(this).hasClass("row-data-selected"))   $(this).removeClass("row-data-selected");
    //     else                                    		$(this).addClass("row-data-selected");

    //     if(doubleClick_ById($(this).attr("id"))) menuFungsi_DataPenjualan($("#"+$(this).attr("id")).attr("idpenjualan"));
    // });

    var idelm       = "#"+elm;
    var clickedid   = $("body").attr('clickedid');
    if(typeof clickedid === typeof undefined || clickedid === false){ $("body").attr('clickedid',idelm); }

    var touchtime   = $("body").attr('touchtime');
    if(typeof touchtime === typeof undefined || touchtime === false){ $("body").attr('touchtime',touchtime); };

    // compare first click to this click and see if they occurred within double click threshold
    var newDate=new Date().getTime();
    var selisih=newDate-touchtime;
    if( clickedid===idelm && selisih < 800){ $("body").attr('touchtime',newDate); return true; }
    else{ $("body").attr('touchtime',newDate).attr('clickedid',idelm); return false; }
}

function initElmPswd()
{
	var x=document.getElementsByClassName("pswd");
	if(x.length>0)
	{
		for(var p=0; p<x.length; p++ )
		{
			var s=window.getComputedStyle(x[p]);
			if(s.webkitTextSecurity){}
			else{ x[p].setAttribute("type","password"); }
		}
	}
}

function navSubform(form="")
{
	$(".wrapper-subform").addClass("d-none").css("display","none");
	$("#"+form).removeClass("d-none").css("display","");

}


function clearValue(elm="")
{
	if(elm!="") $(elm).val("");
}

function pilihKelurahan2(idpre="#")
{
	if($(idpre+"_kelurahan-label img").length===0)
	{
		$(idpre+"_kelurahan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kelurahan2.html",
		{ 	
			idpre	 :idpre, 
			provinsi :$(idpre+"_provinsi").val(), 
			kota	 :$(idpre+"_kota").val(), 
			kecamatan:$(idpre+"_kecamatan").val(), 
			kelurahan:$(idpre+"_kelurahan").val() 
		},
		function(data)
		{
			$(idpre+"_kelurahan-label img").remove();
		})
		.fail(function()
		{ 
			$(idpre+"_kelurahan-label img").remove(); alert('Connection Failed');
		});
	}
}

function pilihKelurahan(idpre="#")
{
	if($(idpre+"_kelurahan-label img").length===0)
	{   
		$(idpre+"_kelurahan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kelurahan.html", { idpre:idpre, provinsi:$(idpre+"_provinsi").val(), kota:$(idpre+"_kota").val(), kecamatan:$(idpre+"_kecamatan").val() },
		function(data)
		{
			$(idpre+"_kelurahan-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			$(idpre+"_kelurahan").html(data.option).trigger("change");

			if($(idpre+"_alamatLengkap").length>0)
			{
				var alamat          = $(idpre+"_alamat").val().trim(),/* .toUpperCase() */
					provinsi        = $(idpre+"_provinsi").val(),
					kota            = $(idpre+"_kota").val(),
					kecamatan       = $(idpre+"_kecamatan").val(),
					kelurahan       = $(idpre+"_kelurahan").val();
				var datawilayah     = ucwords((kelurahan!="" ? (kelurahan + ", ") : "") + (kecamatan!="" ? (kecamatan + ", ") : "") + (kota!="" ? (kota + ", ") : "") + (provinsi!="" ? (provinsi + ".") : ""));
					datawilayah     = replaceAll(datawilayah,"Dki","DKI");
				var alamatLengkap   = alamat + ((alamat!="" && datawilayah!="") ? ", " : "") + datawilayah;

				alamatLengkap = alamatLengkap!="" ? alamatLengkap : "&nbsp;" ;
				$(idpre+"_alamatLengkap").html(alamatLengkap);
			}

			// if(data.respon=="success")
			// {
			// 	$(idpre+"_kelurahan").html(data.option);
			// 	//modalAlert(data.option);
			// }
			// else
			// { 
			// 	$(idpre+"_kelurahan").html(data.option);
			// 	//modalAlert(data.respon);
			// }
		}).fail(function(){ $(idpre+"_kelurahan-label img").remove(); alert('Connection Failed'); });
	}
}


function pilihKecamatan(idpre="#")
{
	if($(idpre+"_kecamatan-label img").length===0)
	{   
		$(idpre+"_kecamatan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kecamatan.html", { idpre:idpre, provinsi:$(idpre+"_provinsi").val(), kota:$(idpre+"_kota").val() },
		function(data){
			$(idpre+"_kecamatan-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			$(idpre+"_kecamatan").html(data.option).trigger("change");
			// if(data.respon=="success")
			// {
			// 	$(idpre+"_kecamatan").html(data.option);
			// 	setTimeout(function(){ pilihKelurahan(idpre); }, 200);
			// 	//modalAlert(data.option);
			// }
			// else
			// { 
			// 	$(idpre+"_kecamatan").html(data.option);
			// 	setTimeout(function(){ pilihKelurahan(idpre); }, 200);
			// 	//modalAlert(data.respon);
			// }
		}).fail(function(){ $(idpre+"_kecamatan-label img").remove(); alert('Connection Failed'); });
	}
}


function pilihKota(idpre="#")
{
	if($(idpre+"_kota-label img").length===0)
	{
		var provinsi=$(idpre+"_provinsi").val();
		$(idpre+"_kota-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kota.html", { idpre:idpre, provinsi:provinsi },
		function(data){
			$(idpre+"_kota-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			$(idpre+"_kota").html(data.option).trigger("change");
			// if(data.respon=="success")
			// {
			// 	$(idpre+"_kota").html(data.option).trigger("change");
			// 	// setTimeout(function(){ pilihKecamatan(idpre); }, 200);
			// }
			// else
			// { 
			// 	$(idpre+"_kota").html(data.option).trigger("change");
			// 	// setTimeout(function(){ pilihKecamatan(idpre); }, 200);
			// 	//modalAlert(data.respon); 
			// }
		}).fail(function(){ $(idpre+"_kota-label img").remove(); alert('Connection Failed'); });
	}
}

function elmfocus(elm,val_elm="")
{
	setTimeout(() => {
		if(val_elm=="") val_elm=$(elm).val();
		$(elm).val("").focus().val(val_elm);
	}, 100);
}

function openSidebar()
{
    //
    if($("#sidebar_left").hasClass("is-visible")){ $("#sidebar_left").removeClass("is-visible") }
    else{ $("#sidebar_left").addClass("is-visible") }
}

function toggleTextPassword(idelm)
{
}

function toggleBlockNone(tbnid,tbnclass)
{
	var lastelm=$('.'+tbnclass+'.d-block').attr("id");
	
	setTimeout(() => {
		
		if(lastelm!=tbnid) 	$('#'+tbnid).removeClass("d-none").addClass("d-block");
		else				$('#'+tbnid).removeClass("d-block").addClass("d-none");
		
		// if(lastelm!=tbnid) 	$('#'+tbnid).toggle();
		// else				$('#'+tbnid).toggle();

	}, 0);
}

function toggleDisplayNone(tdnid,tdnclass,duration=500)
{
	if($('#'+tdnid).css("display")=="block"){ $('#'+tdnid).slideUp(duration);	}
	else 
	{
		var openwrapper=0; $('.'+tdnclass).each(function( index ) { if($(this).css("display")=="block") ++openwrapper; });
		if(openwrapper==0) $('#'+tdnid).slideDown(duration);
		else 
		{
			$('.'+tdnclass).slideUp(duration);
			$('#'+tdnid).slideDown(duration);
		}
	}
}

function toggleClass(tgcid,tgcclass,markclass,defclass="")
{
	var def = (defclass!="" && defclass!==undefined && defclass!==false) ? 1 : 0;
	markclass=markclass.split(";");
	$.each( markclass, function( key, value )
	{
		marxClass=value.trim();
		$("."+tgcclass).removeClass(marxClass);
		$("#"+tgcid).addClass(marxClass);
	});
		
	if(def==1) 
	{
		$("."+tgcclass).addClass(defclass);
		$("#"+tgcid).removeClass(defclass);
	}
}

function toggleSubform(tsfid,tsfclass)
{
	if($("#"+tsfid).hasClass("d-block"))
	{ 		$("#"+tsfid).removeClass("d-block").addClass("d-none"); }
	else{	$("."+tsfclass).removeClass("d-block").addClass("d-none"); 
			$("#"+tsfid).removeClass("d-none").addClass("d-block"); }
}

function toggleShowPassword(idelm)
{
	if(		$("#"+idelm).attr("type")=="password") $("#"+idelm).attr("type","text");
	else if($("#"+idelm).attr("type")=="text") $("#"+idelm).attr("type","password");
}

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


function insertAtCaret(targetid, textinsert) 
{	//modalInfo(targetid+" | "+textinsert);
    var txtarea = document.getElementById(targetid);
    if (!txtarea){ return; }

    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? "ff" : (document.selection ? "ie" : false));
    if (br == "ie") 
    {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.textinsert.length;
    } else if (br == "ff") { strPos = txtarea.selectionStart; }

    var front = (txtarea.value).substring(0, strPos);
    var back = (txtarea.value).substring(strPos, txtarea.value.length);
    txtarea.value = front + textinsert + back;
    strPos = strPos + textinsert.length;
    if (br == "ie")
    {
        txtarea.focus();
        var ieRange = document.selection.createRange();
        ieRange.moveStart('character', -txtarea.value.length);
        ieRange.moveStart('character', strPos);
        ieRange.moveEnd('character', 0);
        ieRange.select();
    } 
    else if (br == "ff") 
    {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }

    txtarea.scrollTop = scrollPos;
}


function str_pad(pad, user_str, pad_pos)
{
	if (typeof user_str === 'undefined') return pad;
	if (pad_pos == 'l'){ return (pad + user_str).slice(-pad.length); }
	else{ return (user_str + pad).substring(0, pad.length); }
}

function ucwords(str)
{
	return str.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); });
}

function formInfo(elm,data="")
{ 
	$(elm+"-wrapper small").remove();
	$(elm).removeClass("border").removeClass("border-primary");
	var smalltag='<small class="text-primary"><i class="fas fa-info-circle"></i> '+data+'</small>';
	if(data!==""){
		$(elm).addClass("border").addClass("border-primary");
		$(elm+"-wrapper").append(smalltag);
	}
}
function formAlert(elm,data="")
{ 
	$(elm+"-wrapper small").remove();
	$(elm).removeClass("border").removeClass("border-danger");
	$(elm+"-wrapper .row-wrapper").removeClass("border").removeClass("border-danger");
	
	var smalltag='<small class="d-block text-danger i-fs-xsmall"><i class="fa fa-times-circle"></i> '+data+'</small>';
	if(data!=="")
	{
		$(elm).addClass("border").addClass("border-danger");
		$(elm+"-wrapper .row-wrapper").addClass("border").addClass("border-danger");
		$(elm+"-wrapper").append(smalltag);
	}
}
function toggleMainNav(){ if($(window).width()>768){ $("#login-btn, #main-nav-desktop").show(); } else{ $("#login-btn, #main-nav-desktop").hide();} }
function showalert(data){ $("#text-alert").html(data); 	if($("#wrapper-info").css("display")==="block"){ $("#wrapper-info").fadeOut();} if($("#wrapper-alert").css("display")==="none"){ $("#wrapper-alert").fadeIn();} }
function showinfo(data){ $("#text-info").html(data); 	if($("#wrapper-info").css("display")==="none"){ $("#wrapper-info").fadeIn();}	if($("#wrapper-alert").css("display")==="block"){ $("#wrapper-alert").fadeOut();} }
function FilterNumber(x=0,min=0,max=9223372036854775807)
{ 
	//x=x.toString().replace("-","00").replace("+","000").replace("=","000");
	x=x.toString();
	var xl=x.length;
	if(xl>1)
	{
		if(x.slice(-1)==="-"){ x=x.substring(0,(xl-1))+"00"; };
		if(x.slice(-1)==="+"){ x=x.substring(0,(xl-1))+"000"; };
		if(x.slice(-1)==="="){ x=x.substring(0,(xl-1))+"000"; };
	}
	else if(xl==1)
	{
		if(x.slice(-1)==="-"){ x="00"; };
		if(x.slice(-1)==="+"){ x="000"; };
		if(x.slice(-1)==="="){ x="000"; };
	}

	x=x.replace(/[^0-9]/g, ''); 
	if(x!=="")
	{
		var n=parseInt(x);
		if(n<min) x=min; else if(n>max) x=max;
	}
	
	return x.toString().substring(0,max.length);
}
function filterDecimal(n=0)
{
	n=n?n+"":"0";											
	n=n.substr(n.length-1)==","?n.substr(0,n.length-1):n;	
	n=n.replaceAll(".","");									
	n=n.replaceAll(",",".");								

	return parseFloat(n);
}
function SetNumberFormat(angka)
{ 
	var rev=parseInt(angka, 10).toString().split('').reverse().join('');
	for(var i=0,rev2=''; i<rev.length; i++){ rev2+=rev[i]; if((i+1)%3===0 && i!==(rev.length-1)){ rev2+='.'; }}
	return rev2.split('').reverse().join(''); 
}
function NumberFormat(angka, min = 0, max = 9223372036854775807, e) 
{
	if (typeof (angka) == "object") {
		var objElm = angka;
		if (e == 46) angka = 0;
		else angka = objElm.val();
	}
	else var objElm = ""; /* angka=angka.toString().replace("-","00").replace("+","000").replace("=","000"); */

	var t = angka.toString().substring(0, 1) == "-" ? "-" : "";
	var n = FilterNumber(angka, min, max);
	if (n == "") n = 0; n = parseInt(n);
	if (n < min) n = min; else if (n > max) n = max;

	if (n > 0) var a = SetNumberFormat(n); else var a = 0;
	if (objElm != "") { objElm.val(t + a); } else return t + a;
}
function FilterAlphaNumeric(x){ var z = x.replace(/[\W_]+/g,''); return z; }
function FilterAlNum(x){ return FilterAlphaNumeric(x); }
function FilterAlNumSpace(x){ var z = x.replace(/[^\w\s-]/gi,''); return z; }
/* function nextInput(elm){  } */



$(function(){ $(document).off("click",".modal-hide").on("click",".modal-hide",function(){ modalHide(); }); });
function modalHide(){ $("#modalAlert").modal("hide"); }

function modalAlert(data="",modalSize="small")
{
	
	if(data=="hide") $("#modalAlert").modal("hide");
	else
	{
		$("#modalAlert").removeClass("d-none");
		var dataText = data.replace(/(<([^>]+)>)/ig,"");
		if(modalSize=="large"){ 		$("#modal-body").removeClass("modal-sm").addClass("modal-lg"); 	$("#btn-modal-alert").css("width","75px"); }
		else if(modalSize=="medium" || 
				dataText.length>32){ 	$("#modal-body").removeClass("modal-lg modal-sm"); 				$("#btn-modal-alert").css("width","75px"); }
		else{							$("#modal-body").removeClass("modal-lg").addClass("modal-sm"); 	$("#btn-modal-alert").addClass("btn-block"); }
		
		$("#modal-header,#modal-content").removeClass("u-bg-info").removeClass("border-info").addClass("bg-secondary").addClass("border-secondary");
		$("#modal-title-alert,#modal-alert-btn-wrapper").show();
		$("#modal-title-confirm,#modal-confirm-btn-wrapper,#modal-title-info,#modal-info-btn-wrapper").hide();
		$("#modalAlertText").html(data);
		$("#modalAlert").modal("show");
	}

}

function modalConfirm(confirmtext="",confirmyes="",confirmno="",modalSize="small",addclassbtn="",idkey="",idval="")
{
	if(confirmtext=="hide") $("#modalAlert").modal("hide");
	else
	{
		$("#modalAlert").removeClass("d-none");

		/* 
			confirmtext = teks konfirmasi yang ditampilkan pada user
			confirmyes	= fungsi yang dieksekusi ketika diklik tombol 'Yes'
			confirmno	= fungsi yang dieksekusi ketika diklik tombol 'No'
			modalSize	= ukuran form popup : large | medium
			addclassbtn	= class yang ditambahkan pada tombol 'Yes'
			idkey		= attribut 'idkey' yang ditambahkan pada tombol 'Yes'
			idval		= attribut 'idval' yang ditambahkan pada tombol 'Yes'
		*/
	
		confirmtext = decodeURIComponent(confirmtext);
		confirmyes = decodeURIComponent(confirmyes);
		confirmno = decodeURIComponent(confirmno);
	
		var dataText = confirmtext.replace(/(<([^>]+)>)/ig,"");
		if(modalSize=="large"){ 		$("#modal-body").removeClass("modal-sm").addClass("modal-lg"); }
		else if(modalSize=="medium" || 
		dataText.length>32){ 			$("#modal-body").removeClass("modal-lg modal-sm"); 				 }
		else{							$("#modal-body").removeClass("modal-lg").addClass("modal-sm"); 	 }
		
		$("#modal-header,#modal-content").removeClass("bg-secondary").removeClass("border-secondary").addClass("u-bg-info").addClass("border-info"); 
		$("#modal-title-confirm,#modal-confirm-btn-wrapper").show();
		$("#modal-title-alert,#modal-alert-btn-wrapper,#modal-title-info,#modal-info-btn-wrapper").hide();
		$("#modal-btn-yes").removeClass().addClass("c-btn c-btn--info").removeAttr("onClick");
		
		if(confirmyes!="") $("#modal-btn-yes").attr("onClick",confirmyes);
		if(confirmno!="") $("#modal-btn-no").removeAttr("data-dismiss").attr("onClick",confirmno); else  $("#modal-btn-no").removeAttr("onClick").attr("data-dismiss","modal");
		if(addclassbtn!=""){ $("#modal-btn-yes").addClass(addclassbtn); }
		if($("#btnYesCustomAttr").val()!=""){ $("#modal-btn-yes").removeAttr($("#btnYesCustomAttr").val()); $("#btnYesCustomAttr").val(""); }
		if(idkey!="" && idval!=""){ $("#modal-btn-yes").attr(idkey,idval); $("#btnYesCustomAttr").val(idkey); }
	
		$("#modalAlertText").html(confirmtext);
		$("#modalAlert").modal("show");
	}
}

function modalInfo(data="",infoBtn="btn-show",modalSize="auto",modalTitle="informasi")
{
	if(data=="hide") $("#modalAlert").modal("hide");
	else
	{
		$("#modalAlert").removeClass("d-none"); /* if($("body").attr("bgclosemodal")!='1'){ $('#modalAlert').fadeIn( 300, function() { $(this).modal({backdrop: 'static', keyboard: false}); }); } */
		if($("body").attr("bgclosemodal")!='1') $('#modalAlert').modal({backdrop: 'static', keyboard: false});

		modalInfoSize(modalSize,dataText="sampletext");
		$("#modal-header,#modal-content").removeClass("bg-secondary border-secondary").addClass("u-bg-info border-info"); 
		$("#modal-title-info").show();
		if(infoBtn=="btn-show" || infoBtn=="show-btn") $("#modal-info-btn-wrapper").show(); else  $("#modal-info-btn-wrapper").hide();
		$("#modal-title-alert,#modal-alert-btn-wrapper,#modal-title-confirm,#modal-confirm-btn-wrapper").hide();
		$("#modalAlertText").html(data);
		$("#modalAlert").modal("show");
		$("#modal-title-info-text").text(modalTitle);
	}
}
$(function()
{
	$(document).off("click",".modal-size-small").on("click",".modal-size-small",function(){ 	modalInfoSize("small"); });
	$(document).off("click",".modal-size-medium").on("click",".modal-size-medium",function(){ modalInfoSize("medium"); });
	$(document).off("click",".modal-size-large").on("click",".modal-size-large",function(){ 	modalInfoSize("large"); });
	$(document).off("click",".modal-size-xlarge").on("click",".modal-size-xlarge",function(){ modalInfoSize("xlarge"); });
});
function modalInfoSize(modalSize,dataText="sampletext")
{
	if(		modalSize=="xlarge"){ 	$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-xl"); 	$("#btn-modal-info").css("width","75px"); }
	else if(modalSize=="large"){ 	$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-lg"); 	$("#btn-modal-info").css("width","75px"); }
	else if(modalSize=="medium" ||  (modalSize!="small" && dataText.length>32)){ 	
									$("#modal-body").removeClass("modal-sm modal-lg modal-xl"); 						$("#btn-modal-info").css("width","75px"); }
	else{							$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-sm"); 	$("#btn-modal-info").addClass("btn-block"); }
}

function goToUrl(url=""){ window.location.href=url; }

function iniFrame(){ 
	if($("body").attr("iframe")=="allow")					return false; /* The page need an iFrame  */
	else if ( window.location !== window.parent.location ) 	return true;  /* The page is in an iFrames  */
	else 													return false; /* The page is not in an iFrame  */
} 

function wa2html(s)
{
	return s.replace(/\*([^\*]*)\*/g, '<strong>$1</strong>').replace(/_([^_]*)_/g, '<em>$1</em>').replace(/~([^~]*)~/g, '<del>$1</del>');
}
  
function html2wa(s)
{
	return s.replace(/<\/?del>/g, '~').replace(/<\/?em>/g, '_').replace(/<\/?strong>/g, '*').replace(/<\/?br>/g, '\n');
}

function FormatTglDB(tgl="x")
{	// 31-12-2021
	var 	tglDB  = 	 tgl.substring(6,10);
			tglDB += "-"+tgl.substring(3,5);
			tglDB += "-"+tgl.substring(0,2);
	return 	tglDB;
}

function doubleClick_ById(elm=0)
{
	// $(document).off("click",".row-data").on("click",".row-data",function()
    // { 
    //     if( $(this).hasClass("row-data-selected"))   $(this).removeClass("row-data-selected");
    //     else                                    		$(this).addClass("row-data-selected");

    //     if(doubleClick_ById($(this).attr("id"))) menuFungsi_DataPenjualan($("#"+$(this).attr("id")).attr("idpenjualan"));
    // });

    var idelm       = "#"+elm;
    var clickedid   = $("body").attr('clickedid');
    if(typeof clickedid === typeof undefined || clickedid === false){ $("body").attr('clickedid',idelm); }

    var touchtime   = $("body").attr('touchtime');
    if(typeof touchtime === typeof undefined || touchtime === false){ $("body").attr('touchtime',touchtime); };

    // compare first click to this click and see if they occurred within double click threshold
    var newDate=new Date().getTime();
    var selisih=newDate-touchtime;
    if( clickedid===idelm && selisih < 800){ $("body").attr('touchtime',newDate); return true; }
    else{ $("body").attr('touchtime',newDate).attr('clickedid',idelm); return false; }
}

function DayByDate(tgl="x")
{
	if(tgl=="x")
	{	
			tgl 	= new Date();
		let dd 		= String(tgl.getDate()).padStart(2, '0');
		let mm 		= String(tgl.getMonth() + 1).padStart(2, '0'); //January is 0!
		let yyyy 	= tgl.getFullYear();
			tgl 	= yyyy + '-' + mm + '-' + dd;
	}

	var hari=["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
	const d = new Date(tgl);
	let day = d.getDay();
	return hari[day]??"";
}
function initInputDate(c,o="") // c => element class, o => object value
{
	// if(value){}
	// will evaluate to true if value is not:
	// null,undefined,NaN,empty string (""),0,false
	if(o && typeof o==='object'){}else var o={};

	if(o.defaultDate 		=== undefined) o.defaultDate 		= 0;
	if(o.changeMonth 		=== undefined) o.changeMonth 		= true;
	if(o.changeYear  		=== undefined) o.changeYear  		= true;
	// if(o.minDate  	 	=== undefined) o.minDate  	  		= 1;
	// if(o.maxDate  	 	=== undefined) o.maxDate  	  		= 6;
	if(o.selectOtherMonths  === undefined) o.selectOtherMonths  = true;
	if(o.showOtherMonths  	=== undefined) o.showOtherMonths  	= true;
	if(o.dateFormat  		=== undefined) o.dateFormat  		= "dd-mm-yy";
	if(o.yearRange  		=== undefined) o.yearRange  		= "-100:+0";

    var a=$(c).map((_,b)=>b.value).get();
    $(c).val("").datepicker(o);
    setTimeout(()=>{var i=0;$(c).each(function(){$(this).val(a[i]);i++;});},300);
}

function strpad(txt="",padstr="",padnum=1,padside="")
{
	var t	= "";
	padstr	= padstr.toString();
	txt		= txt.toString();
	padnum	= parseInt(padnum);
	txtnum	= txt.length;
	if(txtnum>=padnum){ t=txt; }
	else
	{
		for(i=0;i<padnum;i++)
		{
			if(i<txtnum) 				t+=txt.substr(i,1);
			else if(padside=="right")	t+=padstr;
			else						t=padstr+t;
		}
	}

	return t;
}

function filterDataObject(obj,filterKey="",filterValue="", substrStart, substrEnd)
{
	if(typeof(obj)=="object" && filterKey!=""/*  && filterValue!="" */)
	{
		filtered = [];

		if(typeof substrStart == "boolean")
		{
			$.each( obj, function( key, value)
			{
				if(filterValue==true || value[filterKey].toString().toLowerCase().includes(filterValue.toString().toLowerCase())) filtered.push(value);
			});
		}
		else
		{
			$.each( obj, function( key, value)
			{
				if(substrEnd>0){ if(value[filterKey].toString().substr(substrStart,substrEnd).toLowerCase()==filterValue.toString().toLowerCase()) filtered.push(value); }
				else{ if(value[filterKey].toString().toLowerCase()==filterValue.toString().toLowerCase()) filtered.push(value); }
			});
		}
	
		return filtered;
	}
}

function firstDataObject(obj)
{ 	// data pertama multidimensional object
	if(typeof(obj)=="object")
	{
		var v=[],i=0;
		$.each( obj, function( key, value){v[i]=value; });
		
		return v[0]??{};
	}
}


function DecimalFormatLabel(num=0,decnum=2,maxnum=0)
{	
	if(maxnum!="x" && maxnum>=0 && filterDecimal(num)>maxnum){ num=DecimalFormatReal(maxnum); }

	var angka = num.toString();
		angka = angka.substring(angka.length-1)=="."?angka.substring(0,angka.length-1)+",":angka; angxa=angka.split(",");
		angka = NumberFormat(angxa[0])+(angxa[1]?","+FilterNumber(angxa[1]):(angka.substring(angka.length-1)==","?",":""));
		angxa = angka.split(","); if(angxa[1] && FilterNumber(angxa[1])!="") angka=angxa[0]+","+angxa[1].substring(0,decnum);
		return angka??"";
}

function DecimalFormatReal(num=0,decnum=2)
{	// format desimal label, dengan source string real desimal 10.25
	var angka = num.toString();
		angxa = angka.split(".");
		angka = NumberFormat(angxa[0])+(angxa[1]?","+FilterNumber(angxa[1]):"");
		angxa = angka.split(","); if(angxa[1] && FilterNumber(angxa[1])!="") angka=angxa[0]+(decnum>0?",":"")+angxa[1].substring(0,decnum);
		return angka??"";
}


function randStr()
{
	return (Math.random() + 1).toString(36).substring(2);
}


function floatify(number){ return parseFloat((number).toFixed(10)); }
function replaceAll(string, search, replace){ return string.split(search).join(replace); }
function focusElm(elm){ var val_elm=$(elm).val(); $(elm).val("").focus().val(val_elm); }
function urlText(txt="")
{
	var x='';
	txt=txt.trim().toLowerCase();
	
	var ValidChar = ["0","1","2","3","4","5","6","7","8","9",
					 "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
					 "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
	
	for(i=0;i<txt.length;i++){
		t=txt[i];
		if(ValidChar.includes(t)) x+=t;
		else if(t=="+") x+="-plus-";
		else if(t=="&") x+="-dan-";
		else if(t=="-" || 
				t==" " || 
				t=="/" || 
				t=="_" || 
				t=="." || 
				t==",") x+='-';
	}
	x=replaceAll(x,"--","-");
	if(x.substring(x.length-1)=="-") x=x.substring(0,x.length-1);
	if(x.substring(0,1)=="-") x=x.substring(1);
	return x;
}

function labelSubjek(subjek = [], idsubjek = 0){
	if (subjek.length < 1 || idsubjek === 0) return "";

	const subjekData = subjek.find(({ idsubjek: id }) => id === idsubjek);
	if (!subjekData) return "";

	const parentIds = [
		subjekData.parent0_subjek,
		subjekData.parent1_subjek,
		subjekData.parent2_subjek,
		subjekData.parent3_subjek,
		subjekData.parent4_subjek,
	].filter(id => id !== "0");

	const parents = parentIds.map(id => subjek.find(({ idsubjek }) => idsubjek === id));
	const parentNames = parents.map(({ nama_subjek: name }) => name).filter(Boolean);

	return [...parentNames, subjekData.nama_subjek].join(" &bull; ");
}