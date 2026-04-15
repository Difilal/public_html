"use strict";
$(function(){ $(document).off("click",".logout-btn").on("click",".logout-btn",function(){ logout(); }); });
function logout()
{
	if($(".logout-btn img").length===0){
		$(".logout-btn").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-logout.html",
		function(data){ 
			if(data==="1"){ window.location='./login.html'; }
			else{ $(".logout-btn img").remove();modalAlert(data); }
		}).fail(function(){ $(".logout-btn img").remove(); alert('Connection Failed'); });
	}
}