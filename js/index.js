$(function(){  


    $(document).off("click");

    /* Re-initiation click handler .dropdown-toggle */
    setTimeout(() => { $('.dropdown-toggle, .dropdown').dropdown(); }, 500);
    $(document).on("click",function(e)
    { 
        $('.dropdown-toggle').dropdown("hide"); 
        setTimeout(() => { $('.dropdown-toggle, .dropdown').dropdown(); }, 500);

        // .toogle-block-none
        var tbnlist={},i=0;
        // $('.toggle-block-none').each(function(){ g=$(this).attr("tbnclass"); if (!Object.values(tbnlist).includes(g)){ tbnlist[i]=g; i++; }}); 
        for (var i in tbnlist){ if( $(e.target).closest("."+tbnlist[i]).length==0 ) $("."+tbnlist[i]).removeClass("d-block").addClass("d-none"); }
    });

    /* Re-initiation click handler .c-nav-toggle */
    $(document).on("click",".c-nav-toggle, .c-nav",function(){
        var elmTarget=$(this).attr("data-target");
        if($(elmTarget).hasClass("collapse")){ $(elmTarget).slideDown( "slow", function() { $(elmTarget).removeClass("collapse"); }); }
        else $( elmTarget ).slideUp( "slow", function() { $(elmTarget).addClass("collapse"); });
    });
   
 
});