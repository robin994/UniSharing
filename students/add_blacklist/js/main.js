// Javascript document

function blockUser(idUser){
  $(function() {
    console.log("AAAA");

  	if($.cookie("user")){
  		var user = JSON.parse($.cookie("user"));
  		var param = {
  			'account': user.username,
        'blockedUser': idUser
  		}
      console.log(param);
  	}

  	function callBackSendReport(data){
      console.log(data);
  	}

  	$.unisharing("User", "addUserToBlackList", "private", param, false, callBackSendReport);
  });
}
