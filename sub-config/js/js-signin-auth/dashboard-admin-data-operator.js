"use strict";

$(document).ready(function(){
	
	$("#TambahOperator").click(function(){ TambahOperator(); });
	$("#SimpanOperator").click(function(){ SimpanOperator(); });
	
});

//

function HapusOperator(iduser)
{
	if($("#actbtn_iduser"+iduser+" img").length===0)
	{
		$("#actbtn_iduser"+iduser).prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-hapus-operator.html", { iduser:iduser },
		function(data){ 
			$("#actbtn_iduser"+iduser+" img").remove();
			if(data==="1"){ $("#iduser"+iduser).remove(); }
			else{ modalAlert(data); }
		}).fail(function(){ $("#actbtn_iduser"+iduser+" img").remove(); alert('Connection Failed'); });
	}		
}

function SimpanOperator()
{
	var iduser = $("#iduser").val();
	var nama = $("#nama").val();
	var nohp1 = $("#nohp1").val();
	var email1 = $("#email1").val();
	var password = $("#password").val();
	var role = $("#role").val();
	var jabatan = $("#jabatan").val();
	
	if($("#SimpanOperator img").length===0){
		$("#SimpanOperator").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-simpan-operator.html", { iduser:iduser, nama:nama, nohp1:nohp1, email1:email1, password:password, role:role, jabatan:jabatan },
		function(data){ 
			$("#SimpanOperator img").remove(); //modalAlert(data);
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.success==="1"){ $("#password").val(""); modalInfo("Data berhasil disimpan"); }
			else{ 
				if(data.nama!==undefined){ 			formAlert("#nama",data.nama);} else{ formAlert("#nama");}
				if(data.nohp1!==undefined){ 		formAlert("#nohp1",data.nohp1);} else{ formAlert("#nohp1");}
				if(data.email1!==undefined){ 		formAlert("#email1",data.email1);} else{ formAlert("#email1");}
				if(data.password!==undefined){ 		formAlert("#password",data.password);} else{ formAlert("#password");}
				if(data.role!==undefined){ 			formAlert("#role",data.role);} else{ formAlert("#role");}
				if(data.jabatan!==undefined){ 		formAlert("#jabatan",data.jabatan);} else{ formAlert("#jabatan");}
				
				if(data.respon!==undefined){ 	alert(data.respon); }
			}
		}).fail(function(){ $("#SimpanOperator img").remove(); alert('Connection Failed'); });
	}
}

function TambahOperator()
{
	var nama = $("#nama").val();
	var nohp1 = $("#nohp1").val();
	var email1 = $("#email1").val();
	var password = $("#password").val();
	var role = $("#role").val();
	var jabatan = $("#jabatan").val();
	
	if($("#TambahOperator img").length===0){
		$("#TambahOperator").prepend( '<img src="ajax-loading.gif" style="margin-right:5px;">' );
		$.post( "ajax-dashboard-admin-tambah-operator.html", { nama:nama, nohp1:nohp1, email1:email1, password:password, role:role, jabatan:jabatan },
		function(data){ 
			$("#TambahOperator img").remove(); //modalAlert(data);
			var data=isJSON(data)?JSON.parse(data):{"respon":data};
			if(data.success==="1")
			{ 
				$("#nama").val("");
				$("#nohp1").val("");
				$("#email1").val("");
				$("#password").val("");

				formAlert("#nama");
				formAlert("#nohp1");
				formAlert("#email1");
				formAlert("#password");
				formAlert("#role");
				formAlert("#jabatan");

				modalInfo("Data karyawan berhasil ditambahkan");
			}
			else
			{ 
				if(data.nama!==undefined){ 			formAlert("#nama",data.nama);} else{ formAlert("#nama");}
				if(data.nohp1!==undefined){ 		formAlert("#nohp1",data.nohp1);} else{ formAlert("#nohp1");}
				if(data.email1!==undefined){ 		formAlert("#email1",data.email1);} else{ formAlert("#email1");}
				if(data.password!==undefined){ 		formAlert("#password",data.password);} else{ formAlert("#password");}
				if(data.role!==undefined){ 			formAlert("#role",data.role);} else{ formAlert("#role");}
				if(data.jabatan!==undefined){ 		formAlert("#jabatan",data.jabatan);} else{ formAlert("#jabatan");}
				
				if(data.respon!==undefined){ alert(data.respon); }
			}
		}).fail(function(){ $("#TambahOperator img").remove(); alert('Connection Failed'); });
	}
}