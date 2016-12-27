// JavaScript Document


function removeFromBlackList(user){
	
	
	function callBackRemoveBlackList(data){
		
		if(!data.success){
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-danger">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Message").html(tmp);
			return;
		}
		
		location.reload();
		
	}
	
	$.unisharing("User", "removeFromBlackList", "private", {"user": user}, false, callBackRemoveBlackList);
}