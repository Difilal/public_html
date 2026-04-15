$(function(){  
	$(document).off("click","a").on('click','a',function()
	{ 
		var attr = $(this).attr('href');
		var target = $(this).attr('target');
		if (typeof attr !== typeof undefined && attr !== false && (target===undefined/*  || target!=="_blank" */))
		{
			var href = $(this).attr("href");			
			if(href.slice(-5)==".html")
			{
				event.preventDefault();
				loadSubPage(href);
			}
		}

		if ($(this).hasClass("menu-header-mobile"))
		{
			$(".menu-header-mobile").removeClass("text-warning");
			$(this).addClass("text-warning");
			setTimeout(()=>{ $(".button-menu-header-mobile").trigger("click"); }, 200);
		}
    });
	
	$(document).off("click",".button-menu-header-mobile").on('click','.button-menu-header-mobile',function()
	{
		$("#main-nav").toggle(300);
	});
    
});

function loadSubPage(filename)
{	
	filename=filename=="reload"?window.location.pathname:filename;
	filename=filename.substr(0,1)=="/"?filename.substr(1):filename;
	filename=filename.replace(".html","");
	filename=filename.replace("../","");
	filename=filename.replace("./","");
	var urlpage=filename!=""?(filename+".async"):"dashboard-operator-penjualan-data.async";
	var urldestination = filename+".html";
	var fullurldestination = window.location.origin+"/"+filename+".html";
	var elmProgBar ='<div class="elmProgBar d-block u-ph-small u-text-center" style="width:100%;position: fixed;top: 0;z-index:10000;border-bottom:1px solid lightgray;background-color:#fffd7d;">';
		elmProgBar+='Loading...'+' <img src="img-loading.gif">';
		elmProgBar+='</div>';
		$("body").append(elmProgBar);

	var loadsubpage = $("body").attr('loadsubpage');
	if (typeof loadsubpage == typeof undefined || loadsubpage == false)
	{
		$("body").attr('loadsubpage',1);
		$('.c-sidebar__link[href="'+filename+'.html"]').append( '<img src="ajax-loading.gif" style="margin-left:5px;">' );
		$.post(urlpage, { loadAsync:"1" }, function(data)
		{
			$(".elmProgBar").remove();
			$("body").removeAttr('loadsubpage');
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.not_found!=undefined) modalAlert(data.not_found);
			else
			{ 
				var d = new Date();
				var tgl = d.getFullYear()+""+d.getMonth()+""+d.getDate()+""+d.getHours();/* var tgl = d.getFullYear()+""+d.getMonth()+""+d.getDate()+""+d.getHours()+""+d.getMinutes(); */

				var jsVersion = $("body").attr('jsversion')+""+Math.floor((Math.random() * 999) + 111);
				if (typeof jsVersion == typeof undefined || jsVersion == false) jsVersion=tgl;

				var cssVersion = $("body").attr('cssversion')+""+Math.floor((Math.random() * 999) + 111);
				if (typeof cssVersion == typeof undefined || cssVersion == false) cssVersion=tgl;

				var subdomain = $("body").attr('subdomain');
				if (typeof subdomain == typeof undefined || subdomain == false)
				{
					var matches = urldestination.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
					var subdomain = matches && matches[1];  // domain will be null if no match is found
				}

				
				$('.c-sidebar__link[href="'+filename+'.html"] img').remove();







				window.history.pushState(fullurldestination, '', urldestination);
				setTimeout(() => {
					// remove fragment as much as it can go without adding an entry in browser history:
					window.location.replace("#");
					// slice off the remaining '#' in HTML5:    
					if (typeof window.history.replaceState == 'function'){ history.replaceState({}, '', window.location.href.slice(0, -1)); }
				}, 200);
				
				/* $("#contentPage").html(data.respon); */
				$('#contentPage').fadeOut(200, function() {
					$(this).empty().html(data.respon).show();

					if(filename=="dashboard-operator-booking-kavling") $.getScript("/node_modules/@panzoom/panzoom/dist/panzoom.min.js");
					if(filename=="dashboard-operator-booking-kavling2") $.getScript("/node_modules/@panzoom/panzoom/dist/panzoom.min.js");
					var scrjs=jsVersion+"-main-script-"+filename+".js";
					$.getScript(scrjs);
					$('<link/>',{rel: 'stylesheet', type: 'text/css', href: cssVersion+"--"+subdomain+"--style--"+filename+".css"}).appendTo('head');

					sidebarActive(filename);
				});
			}
			
		}).fail(function(){ $("body").removeAttr('loadsubpage'); $(".elmProgBar").remove(); alert('Connection Failed'); });
	}

}

function sidebarActive(filename)
{
	if($('.c-sidebar__link[href="'+filename+'.html"]').length)
	{
		$('.c-sidebar__link').removeClass("is-active");
		$('.c-sidebar__link[href="'+filename+'.html"]').addClass("is-active");
	}
}