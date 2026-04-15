"use strict";


$(function(){   

	if(iniFrame()){ goToUrl("https://www.google.com/"); }else $("body.d-none").removeClass("d-none");
	
	if($(".focus-onload").length && $("body").attr("device")=="desktop"){ var val_elm=$(".focus-onload:eq(0)").val(); $(".focus-onload:eq(0)").val("").focus().val(val_elm); }
	if($(".cursor-pointer").length){ $(".cursor-pointer").css("cursor","pointer"); }
	$(document).on('click','.clear-value',function(){ clearValue($(this).attr("elmtype"),$(this).attr("elm")); });
	var clipboard=new ClipboardJS('.copy-btn');	
	$(window).on('resize', function(){ toggleMainNav(); }); toggleMainNav();
	//$('.textarea-autogrow').css('overflow', 'hidden').autogrow({vertical: true, horizontal: false});
	//$(document).on('click change keyup mouseup','.textarea-autogrow',function(){ $(this).css('overflow', 'hidden').autogrow({vertical: true, horizontal: false}); });
	$(document).on('keyup','.filter-number',(function()
	{ 
		var angka = $(this).val();
		if ($(this).attr("min")!==undefined) var min=$(this).attr("min"); else var min=0;
		if ($(this).attr("max")!==undefined) var min=$(this).attr("max"); else var max=9223372036854775807;

		var a=FilterNumber(angka,min,max);
		$(this).val(a); 
	}));
	$(document).on('keyup','.number-format',(function(e)
	{ 
		var angka = $(this);
		if ($(this).attr("min")!==undefined) var min=$(this).attr("min"); else var min=0;
		if ($(this).attr("max")!==undefined) var min=$(this).attr("max"); else var max=9223372036854775807;
		NumberFormat(angka,min,max,e.keyCode);
	}));
	$(document).on('keyup','.filter-alphanumeric',(function(){ var a=FilterAlphaNumeric($(this).val()); $(this).val(a); }));
	$(document).on('keyup','input.filter-number, input.number-format, input.filter-alphanumeric',(function(e){ if(e.keyCode==46) $(this).val(""); }));
	$("#modalAlert").draggable({ handle: "#modal-header" });	
	$("#open_sidebar").click(function(){ openSidebar(); });
	
	$(".modal-confirm").on('click',function()
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
	$(document).on('click','.insertAtCaret',function(){ var targetid=$(this).attr("targetid"),textinsert=$(this).attr("textinsert"); insertAtCaret(targetid,textinsert); });
	$(document).on('click','.toggle-show-password',function(){ toggleShowPassword($(this).attr("targetid")); });
	$(document).on('click','.toggle-text-password',function()
	{ 
		var idelm=$(this).attr("targetid");
		if 		($("#"+idelm).hasClass("pswd")){ 	$("#"+idelm).removeClass("pswd"); 	$(this).removeClass("fa-eye-slash").addClass("fa-eye"); }
		else{ 										$("#"+idelm).addClass("pswd"); 		$(this).removeClass("fa-eye").addClass("fa-eye-slash"); }
	});
	$(document).on('keypress','.next-input',(function(e){ var nextElm=$(this).attr("nextinput"),prevElm=$(this).attr("previnput"); 
	if(nextElm!="" && e.which===13){ elmfocus("#"+nextElm); }
	else if(prevElm!="" && e.which===10){ elmfocus("#"+prevElm); }
	//else alert(e.which); 
	}));
	$(document).on('click','.btn-print-area',function()
	{
		var printarea = $(this).attr("printarea");
		var konten = $(printarea).html();
		$("#printAreaContainer").html(konten);
		setTimeout(() => { $("#printAreaContainer").html(""); }, 200);
		window.print();
	});


});


function clearValue(elmtype="",elm="")
{
	if(elmtype!="" && elm!="")
	{
		$(elm).val("");
	}
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
			$(idpre+"_kelurahan-label img").remove(); modalAlert('Requested Page : Error');
		});
	}
}

function pilihKelurahan(idpre="#")
{
	if($(idpre+"_kelurahan-label img").length===0)
	{   
		$(idpre+"_kelurahan-label").append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post( "ajax-update-kelurahan.html", { idpre:idpre, provinsi:$(idpre+"_provinsi").val(), kota:$(idpre+"_kota").val(), kecamatan:$(idpre+"_kecamatan").val() },
		function(data){
			$(idpre+"_kelurahan-label img").remove();
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.respon=="success")
			{
				$(idpre+"_kelurahan").html(data.option);
				//modalAlert(data.option);
			}
			else
			{ 
				$(idpre+"_kelurahan").html(data.option);
				//modalAlert(data.respon);
			}
		}).fail(function(){ $(idpre+"_kelurahan-label img").remove(); modalAlert('Requested Page : Error'); });
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
			if(data.respon=="success")
			{
				$(idpre+"_kecamatan").html(data.option);
				setTimeout(function(){ pilihKelurahan(idpre); }, 200);
				//modalAlert(data.option);
			}
			else
			{ 
				$(idpre+"_kecamatan").html(data.option);
				setTimeout(function(){ pilihKelurahan(idpre); }, 200);
				//modalAlert(data.respon);
			}
		}).fail(function(){ $(idpre+"_kecamatan-label img").remove(); modalAlert('Requested Page : Error'); });
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
			if(data.respon=="success")
			{
				$(idpre+"_kota").html(data.option);
				setTimeout(function(){ pilihKecamatan(idpre); }, 200);
			}
			else
			{ 
				$(idpre+"_kota").html(data.option);
				setTimeout(function(){ pilihKecamatan(idpre); }, 200);
				//modalAlert(data.respon); 
			}
		}).fail(function(){ $(idpre+"_kota-label img").remove(); modalAlert('Requested Page : Error'); });
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

function formInfo(elm,data=""){ 
	$(elm+"-wrapper small").remove();
	$(elm).removeClass("border").removeClass("border-primary");
	var smalltag='<small class="text-primary"><i class="fas fa-info-circle"></i> '+data+'</small>';
	if(data!==""){
		$(elm).addClass("border").addClass("border-primary");
		$(elm+"-wrapper").append(smalltag);
	}
}
function formAlert(elm,data=""){ 
	$(elm+"-wrapper small").remove();
	$(elm).removeClass("border").removeClass("border-danger");
	var smalltag='<small class="text-danger"><i class="fa fa-times-circle"></i> '+data+'</small>';
	if(data!==""){
		$(elm).addClass("border").addClass("border-danger");
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
function SetNumberFormat(angka)
{ 
	var rev=parseInt(angka, 10).toString().split('').reverse().join('');
	for(var i=0,rev2=''; i<rev.length; i++){ rev2+=rev[i]; if((i+1)%3===0 && i!==(rev.length-1)){ rev2+='.'; }}
	return rev2.split('').reverse().join(''); 
}
function NumberFormat(angka,min=0,max=9223372036854775807,e)
{
	if(typeof(angka)=="object")
	{ 
		var objElm=angka; 
		if(e==46) angka=0; 
		else 	  angka=objElm.val(); 
	}
	else var objElm=""; //angka=angka.toString().replace("-","00").replace("+","000").replace("=","000");
	
	var n=FilterNumber(angka,min,max);
	if(n=="") n=0; n=parseInt(n);
	if(n<min) n=min; else if(n>max) n=max;	

	if(n>0) var a=SetNumberFormat(n); else var a=0; 
	if(objElm!=""){ objElm.val(a); } else return a; 
}
function FilterAlphaNumeric(x){ var z = x.replace(/[\W_]+/g,''); return z; }
/* function nextInput(elm){  } */



function modalAlert(data="",modalSize="small"){
	
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

function modalConfirm(confirmtext="",confirmyes="",confirmno="",modalSize="small",addclassbtn="",idkey="",idval=""){

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

function modalInfo(data="",infoBtn="btn-show",modalSize="auto",modalTitle="informasi"){

	var dataText = data.replace(/(<([^>]+)>)/ig,"");

	/* if(modalSize=="large"){ 		$("#modal-body").removeClass("modal-sm").addClass("modal-lg"); 	$("#btn-modal-info").css("width","75px"); }
	else if(modalSize=="medium" ||  (modalSize!="small" && dataText.length>32)){ 	
									$("#modal-body").removeClass("modal-lg modal-sm"); 				$("#btn-modal-info").css("width","75px"); }
	else{							$("#modal-body").removeClass("modal-lg").addClass("modal-sm"); 	$("#btn-modal-info").addClass("btn-block"); } */
	modalInfoSize(modalSize,dataText="sampletext");
	
	$("#modal-header,#modal-content").removeClass("bg-secondary border-secondary").addClass("u-bg-info border-info"); 
	$("#modal-title-info").show();
	if(infoBtn=="btn-show" || infoBtn=="show-btn") $("#modal-info-btn-wrapper").show(); else  $("#modal-info-btn-wrapper").hide();
	$("#modal-title-alert,#modal-alert-btn-wrapper,#modal-title-confirm,#modal-confirm-btn-wrapper").hide();
	$("#modalAlertText").html(data);
	$("#modalAlert").modal("show");
	$("#modal-title-info-text").text(modalTitle);
}
function modalInfoSize(modalSize,dataText="sampletext")
{
	if(		modalSize=="xlarge"){ 	$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-xl"); 	$("#btn-modal-info").css("width","75px"); }
	else if(modalSize=="large"){ 	$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-lg"); 	$("#btn-modal-info").css("width","75px"); }
	else if(modalSize=="medium" ||  (modalSize!="small" && dataText.length>32)){ 	
									$("#modal-body").removeClass("modal-sm modal-lg modal-xl"); 						$("#btn-modal-info").css("width","75px"); }
	else{							$("#modal-body").removeClass("modal-sm modal-lg modal-xl").addClass("modal-sm"); 	$("#btn-modal-info").addClass("btn-block"); }
}

function goToUrl(url){ window.location.href=url; }

function iniFrame(){ 
	if ( window.location !== window.parent.location ) 	return true;  /* The page is in an iFrames  */
	else 												return false; /* The page is not in an iFrame  */
}