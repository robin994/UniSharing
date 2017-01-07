// Javascript document

function sendReport(){
  console.log("AAAA");

  if($.cookie("user")){
    var user = JSON.parse($.cookie("user"));
    var param = {
      'account': user.username,
      'object': document.getElementById("object").value,
      'message': document.getElementById("message").value
    }
    console.log(param);
  }

  function callBackSendReport(data){
    console.log(data);
  }

  $.unisharing("User", "sendReport", "private", param, false, callBackSendReport);
}

function sendClear() {
  $('#object').val("");
  $('#message').val("");
}
