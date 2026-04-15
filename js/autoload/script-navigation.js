$(function(){

    $(document).off("change",".nav-page-number")
                .on("change",".nav-page-number",function()
                {
                    var elmList     = [".nav-page-start",".nav-page-prev",".nav-page-number",".nav-page-next",".nav-page-end"];
                    var elmInputan  = []; $.each(elmList, function(index,value){ if($(value).prop('disabled')==false) elmInputan.push(value); });
                    var elmInput    = elmInputan.join(", ");
                        
                    $(elmInput).prop("disabled",true);

                    var num = $(this).val();
                    var url = $(this).attr("url");
                        url = replaceAll(url,"{{pgnum}}",num);

                    loadSubPage(url);
                });
    $(document).off("click",".nav-page-start")
                .on("click",".nav-page-start",function()
                {
                    $(".nav-page-number").val("1").trigger("change");
                });
    $(document).off("click",".nav-page-prev")
                .on("click",".nav-page-prev",function()
                {
                    var val=parseInt($(".nav-page-number").val())-1;
                    $(".nav-page-number").val(val).trigger("change");
                });
    $(document).off("click",".nav-page-next")
                .on("click",".nav-page-next",function()
                {
                    var val=parseInt($(".nav-page-number").val())+1;
                    $(".nav-page-number").val(val).trigger("change");
                });
    $(document).off("click",".nav-page-end")
                .on("click",".nav-page-end",function()
                {
                    var val = $('.nav-page-number option:last-child').val();
                    $(".nav-page-number").val(val).trigger("change");
                });

	
    $(document).off("click",".menuUtama")
                .on("click",".menuUtama",function()
                {
                    $(".menuUtama, .subMenu").not(this).removeClass("is-active");
                    $(this).find('.tMenu i').remove();
                    $(".menuDropdown").not($(this).next(".menuDropdown")).slideUp();
                    

                    var dropdown = $(this).next(".menuDropdown");
                    dropdown.slideToggle();
                });
    $(document).off("click",".subMenu").on("click",".subMenu",function()
                { 
                    $(".menuUtama").removeClass("is-active"); $(this).addClass("is-active"); 
                    $(".subMenu").removeClass("sub-is-active"); $(this).addClass("sub-is-active"); 
                    
                    $(".subMenu").removeClass("text-warning");
                    $(this).addClass("text-warning");
                });

    $(document).off("click",".menu-header-mobile").on("click",".menu-header-mobile",function(e){ e.stopPropagation(); });
    $(document).on("click",function(){ $("#main-nav").collapse("hide"); });

});