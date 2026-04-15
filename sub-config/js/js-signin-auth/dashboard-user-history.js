
	
	function changeHistoryDate()
	{
		HistoryDate=$("#HistoryDate").val();
		//if(HistoryDate!=""){
			$.post("ajax-dashboard-user-history.html", {HistoryDate:HistoryDate}, function(data,status){ 
				//alert(data);
                //window.location.href = './dashboard-user-history.html'; 
                loadSubPage("dashboard-user-history.html");
			});
		//}
	}