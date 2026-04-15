$(document).ready(function(){ 
    
    $("#formTambahEmailSender").off("click").on('click',function(){ formTambahEmailSender(); });
    $(document).on('click','#tesKoneksiAkunEmailSender',function(){ tambahAkunEmailSender("tesKoneksi"); });
    $(document).on('click','#tambahAkunEmailSender',function(){ tambahAkunEmailSender(); });
    $(document).on('click','.status-smtp-toggle',function(){ statusSmtpToggle($(this).attr("idsmtp")); });
    $('.form-edit-smtp').on('click',function(){ formEditAkunEmailSender($(this).attr("idsmtp")); });
    $(document).on('click',"#tesKoneksiEditEmailSender",function(){ editAkunEmailSender("tesKoneksi"); });
    $("#modalAlert").off("click").on('click','#editAkunEmailSender',function(){ editAkunEmailSender(); });
    
});


function editAkunEmailSender(mode="editKoneksi")
{
    if($("#tesKoneksiAkunEmailSender img").length===0 && $("#tambahAkunEmailSender img").length===0)
    {
        var idsmtp=$("#idsmtp").val().trim();
        var smtp_name=$("#smtp_name").val().trim();
        var smtp_host=$("#smtp_host").val().trim();
        var smtp_user=$("#smtp_user").val().trim();
        var smtp_pswd=$("#smtp_pswd").val();
        var smtp_port=FilterNumber($("#smtp_port").val());
        if(smtp_port=="") smtp_port=0;
        var smtp_secure=$("#smtp_secure").val();
        var smtp_auth=$("#smtp_auth").val();
        var smtp_status=$("#smtp_status").val();
        var cek=0;

        if(smtp_name==""){ cek=1; formAlert("#smtp_name","Nama kontak wajib diisi"); }else formAlert("#smtp_name");
        if(smtp_host==""){ cek=1; formAlert("#smtp_host","Hostname wajib diisi"); }else formAlert("#smtp_host");
        if(smtp_user==""){ cek=1; formAlert("#smtp_user","Username wajib diisi"); }else formAlert("#smtp_user");
        if(smtp_pswd==""){ cek=1; formAlert("#smtp_pswd","Password wajib diisi"); }else formAlert("#smtp_pswd");
        if(smtp_port==0){  cek=1; formAlert("#smtp_port","Port wajib diisi"); $("#smtp_port").val(smtp_port); } else formAlert("#smtp_port");

        if(cek==0)
        {
            if(mode=="tesKoneksi") var elmProgress="tesKoneksiEditEmailSender";
            else                   var elmProgress="editAkunEmailSender";

            $("#tesKoneksiEditEmailSender, #editAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",true);
            $("#"+elmProgress).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
            $.post( "ajax-dashboard-admin-edit-email-sender.html", {mode:mode,idsmtp:idsmtp,smtp_name:smtp_name,smtp_host:smtp_host,smtp_user:smtp_user,smtp_pswd:smtp_pswd,smtp_port:smtp_port,smtp_secure:smtp_secure,smtp_auth:smtp_auth,smtp_status:smtp_status},
            function(data)
            { 
                $("#tesKoneksiEditEmailSender, #editAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",false);
                $("#"+elmProgress+" img").remove();
                var data=isJSON(data)?JSON.parse(data):{"respon":data};
                //modalInfo(data.respon,"hide-btn","medium","Tambah Akun Email Sender");
                
                if(mode=="tesKoneksi" && data.respon=="success")
                {
                    $("#smtp_status").val("connected");
                    alert("Autentikasi email berhasil");
                }
                else if(mode=="tesKoneksi" && data.respon!="success")
                {
                    $("#smtp_status").val("disconnected");

                    /* if(data.errorInfo!==undefined) var errorInfo=data.errorInfo;
                    if(data.errorInfo=="SMTP Error: Could not authenticate.")      var alertText="Autentikasi gagal, periksa ulang email atau password.";
                    else if(errorInfo.substring(0,22)=="SMTP connect() failed.")   var alertText="Gagal koneksi ke SMTP server, periksa ulang smtp server & port.";
                    else if(data.errorInfo!==undefined)                            var alertText=errorInfo;
                    else                                                           var alertText=data.respon;
                    alert(alertText); */
                }
                else if(mode=="editKoneksi" && data.respon=="success")
                {
                    $("#smtp_name_col"+idsmtp).html(smtp_name);
                    $("#smtp_user_col"+idsmtp).html(smtp_user);
                    $("#smtp_host_col"+idsmtp).html(smtp_host);
                    $("#smtp_port_col"+idsmtp).html(smtp_port);
                    $("#smtp_secure_col"+idsmtp).html(smtp_secure);
                    $("#smtp_auth_col"+idsmtp).html(smtp_auth);
                    
                    if(smtp_status=="disconnected") $("#StatusEmailSender"+idsmtp).html('<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Disconnected');
                    if(smtp_status=="connected")    $("#StatusEmailSender"+idsmtp).html('<i class="fa fa-check u-color-success u-mr-xsmall"></i>Connected');

                    alert("Akun email sender berhasil diedit");
                }
                else {}
            }
            )
            .fail(function()
            {
                $("#tesKoneksiEditEmailSender, #editAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",false);
                $("#"+elmProgress+" img").remove();
                modalAlert(data);
            });
        }
    }

}


function formEditAkunEmailSender(idsmtp)
{
    $("#actbtn_smtp"+idsmtp+" img").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
    $.post( "dashboard-admin-edit-email-sender-form-popup.html", {idsmtp:idsmtp},
    function(data)
    { 
        $("#actbtn_smtp"+idsmtp+" img").remove();
        var data=isJSON(data)?JSON.parse(data):{"respon":data};
        modalInfo(data.respon,"hide-btn","medium","Edit Akun Email Sender");
        setTimeout(() => {
            elmfocus("#smtp_name");
        }, 500);
    }
    )
    .fail(function()
    {
        $("#actbtn_smtp"+idsmtp+" img").remove();
        modalAlert(data);
    });
}


function HapusEmailSender(idsmtp)
{
    if($("#actbtn_smtp"+idsmtp+" img").length===0)
    {
        /* setTimeout(() => {
            modalInfo('Please wait... <img src="ajax-loading.gif" style="margin-right:5px;">',"hide-btn","small","Hapus Email Sender");    
        }, 200); */
        
        $("#actbtn_smtp"+idsmtp).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-hapus-email-sender.html", {idsmtp:idsmtp},
        function(data)
        { 
            $("#actbtn_smtp"+idsmtp+" img").remove();
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            
            if(data.respon=="success")
            {
                $("#smtp"+idsmtp).css("background-color","#ff8f8f").hide('slow', function(){ $("#smtp"+idsmtp).remove(); });
                /* modalInfo("Akun email sender berhasil dihapus","show-btn","small"); */
            }
            else 
            {
                modalAlert(data.respon);
            }
        }
        )
        .fail(function()
        {
            $("#actbtn_smtp"+idsmtp+" img").remove();
            modalAlert(data);
        });  
    }
}


function statusSmtpToggle(idsmtp)
{
    if($("#actbtn_smtp"+idsmtp+" img").length===0)
    {
        modalInfo('Please wait... <img src="ajax-loading.gif" style="margin-right:5px;">',"hide-btn","small","Email Sender");
        $("#actbtn_smtp"+idsmtp).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
        $.post( "ajax-dashboard-admin-toggle-status-email-sender.html", {idsmtp:idsmtp},
        function(data)
        { 
            $("#actbtn_smtp"+idsmtp+" img").remove();
            var data=isJSON(data)?JSON.parse(data):{"respon":data};
            
            if(data.respon=="success connected")
            {
                $("#StatusEmailSender"+idsmtp).html('<i class="fa fa-check u-color-success u-mr-xsmall"></i>Connected');
                $("#linktogglestatussmtp"+idsmtp).html('<i class="fas fa-unlink"></i> Disconnect Email Sender').attr("statuslayanan","connected");
                modalInfo("Akun email sender berhasil diaktifkan");
            }
            else if(data.respon=="success disconnected")
            {
                $("#StatusEmailSender"+idsmtp).html('<i class="fa fa-exclamation-triangle u-color-danger u-mr-xsmall"></i>Disconnected');
                $("#linktogglestatussmtp"+idsmtp).html('<i class="fas fa-link"></i> Connect Email Sender').attr("statuslayanan","disconnected");
                modalInfo("Akun email sender berhasil dinonaktifkan");
            }
            else 
            {
                modalAlert(data.respon,"hide-btn");
            }
        }
        )
        .fail(function()
        {
            $("#actbtn_smtp"+idsmtp+" img").remove();
            modalAlert(data);
        });  
    }
}


function tambahAkunEmailSender(mode="tambahKoneksi")
{
    if($("#tesKoneksiAkunEmailSender img").length===0 && $("#tambahAkunEmailSender img").length===0)
    {
        var smtp_name=$("#smtp_name").val().trim();
        var smtp_host=$("#smtp_host").val().trim();
        var smtp_user=$("#smtp_user").val().trim();
        var smtp_pswd=$("#smtp_pswd").val();
        var smtp_port=FilterNumber($("#smtp_port").val());
        if(smtp_port=="") smtp_port=0;
        var smtp_secure=$("#smtp_secure").val();
        var smtp_auth=$("#smtp_auth").val();
        var smtp_status=$("#smtp_status").val();
        var cek=0;

        if(smtp_name==""){ cek=1; formAlert("#smtp_name","Nama kontak wajib diisi"); }else formAlert("#smtp_name");
        if(smtp_host==""){ cek=1; formAlert("#smtp_host","Hostname wajib diisi"); }else formAlert("#smtp_host");
        if(smtp_user==""){ cek=1; formAlert("#smtp_user","Username wajib diisi"); }else formAlert("#smtp_user");
        if(smtp_pswd==""){ cek=1; formAlert("#smtp_pswd","Password wajib diisi"); }else formAlert("#smtp_pswd");
        if(smtp_port==0){  cek=1; formAlert("#smtp_port","Port wajib diisi"); $("#smtp_port").val(smtp_port); } else formAlert("#smtp_port");

        if(cek==0)
        {
            if(mode=="tesKoneksi") var elmProgress="tesKoneksiAkunEmailSender";
            else                   var elmProgress="tambahAkunEmailSender";

            $("#tesKoneksiAkunEmailSender, #tambahAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",true);
            $("#"+elmProgress).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
            $.post( "ajax-dashboard-admin-tambah-email-sender.html", {mode:mode,smtp_name:smtp_name,smtp_host:smtp_host,smtp_user:smtp_user,smtp_pswd:smtp_pswd,smtp_port:smtp_port,smtp_secure:smtp_secure,smtp_auth:smtp_auth,smtp_status:smtp_status},
            function(data)
            { 
                $("#tesKoneksiAkunEmailSender, #tambahAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",false);
                $("#"+elmProgress+" img").remove();
                var data=isJSON(data)?JSON.parse(data):{"respon":data};
                //modalInfo(data.respon,"hide-btn","medium","Tambah Akun Email Sender");
                
                if(mode=="tesKoneksi" && data.respon=="success")
                {
                    $("#smtp_status").val("connected");
                    alert("Autentikasi email berhasil");
                }
                else if(mode=="tesKoneksi" && data.respon!="success")
                {
                    $("#smtp_status").val("disconnected");

                    /* if(data.errorInfo!==undefined) var errorInfo=data.errorInfo;
                    if(data.errorInfo=="SMTP Error: Could not authenticate.")      var alertText="Autentikasi gagal, periksa ulang email atau password.";
                    else if(errorInfo.substring(0,22)=="SMTP connect() failed.")   var alertText="Gagal koneksi ke SMTP server, periksa ulang smtp server & port.";
                    else if(data.errorInfo!==undefined)                            var alertText=errorInfo;
                    else                                                           var alertText=data.respon;
                    alert(alertText); */

                    alert(data.respon);
                }
                else if(mode=="tambahKoneksi" && data.respon=="success")
                {
                    $("#smtp_name").val("");
                    $("#smtp_host").val("");
                    $("#smtp_user").val("");
                    $("#smtp_pswd").val("");
                    $("#smtp_port").val("");
                    $("#smtp_status").val("disconnected");

                    alert("Akun email sender berhasil ditambahkan");
                }
                else
                {
                    alert(data.respon);
                }
            }
            )
            .fail(function()
            {
                $("#tesKoneksiAkunEmailSender, #tambahAkunEmailSender, #smtp_name, #smtp_host, #smtp_user, #smtp_pswd, #smtp_port, #smtp_secure, #smtp_auth").prop("disabled",false);
                $("#"+elmProgress+" img").remove();
                modalAlert(data);
            });
        }
    }

}


function formTambahEmailSender()
{
    $("#tambahEmailSender").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
    $.post( "dashboard-admin-tambah-email-sender-form-popup.html", {},
    function(data)
    { 
        $("#tambahEmailSender img").remove();
        var data=isJSON(data)?JSON.parse(data):{"respon":data};
        modalInfo(data.respon,"hide-btn","medium","Tambah Akun Email Sender");
        setTimeout(() => {
            elmfocus("#smtp_name");
        }, 500);
    }
    )
    .fail(function()
    {
        $("#tambahEmailSender img").remove();
        modalAlert(data);
    });
}