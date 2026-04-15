$(()=>{  

    $(".nav-dropdown-button");
    $(".nav-dropdown-wrapper");
    $(".nav-dropdown-list");
    $(".nav-dropdown-checkbox");

    
    $(document).off("click",".list-dropdown-wrapper .row").on("click",".list-dropdown-wrapper .row", function()
    { 
        var asd=[];
        $("input.nav-dropdown-checkbox:checked").each(function(){ asd.push($(this).val()); });
        $(".list-dropdown-button").html(asd.length+" Selected");
    });

});