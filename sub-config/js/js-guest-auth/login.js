$(document).ready(function(){
		
    $("#form-login #email,#form-login #password").on('keypress',function(e){ if(e.key==="Enter"){ login(); }});
    $("#login").click(function(){ login(); });

}); 

function login()
{
    var email=$("#email").val();
    var password=$("#password").val();
    //var grecaptcha=$("#g-recaptcha-response").val();
    var formvalid=1;
    
    if($("#login img").length>0){ formvalid=0; }
    if(email.length===0){ formvalid=0;formAlert("#email","Email harus diisi");}else{ formAlert("#email");}
    if(password.length===0){ formvalid=0;formAlert("#password","Password harus diisi");}else{ formAlert("#password");}
    
    if(formvalid===1)
    {
        $("#email,#password").attr('disabled',true);
        $("#login").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-login.html", { email:email,password:password},//,grecaptcha:grecaptcha},
        function(data){ 
			/* var data=isJSON(data)?JSON.parse(data):{"respon":data}; */
            if(data=="1")
            {   //alert(data.respon);
                if(data.REQUEST_URI!==undefined) var uri="."+data.REQUEST_URI;
                else var uri="./";
                window.location=uri; 
            }
            else{ $("#email,#password").attr('disabled',false); $("#login img").remove(); modalInfo(data); }
        }).fail(function(){ $("#login img").remove(); alert('Connection Failed'); });
    }
}