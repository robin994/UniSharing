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
      waitingDialog.hide();
      console.log(data);
      if(!data.success){
        console.log("utente gia' bloccato");
        $("#result_message").html('<center><br><div class="alert alert-danger"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><br><br><h4>Utente gia\' bloccato<h4><h5>Verrai reindirizzato sulla home fra qualche istante...<h5><h5>Se non vuoi attendere <a href="http://"+window.location.hostname+"/research/home/index.php">clicca qui.</a></h5></div></center>');

        // Ridireziona alla home dopo 5 secondi
        setTimeout (function() {
          window.location.href = "http://"+window.location.hostname+"/research/home/index.php";
        }, 5000);
      } else {
        console.log("utente NON bloccato");
        //operazione completata con successo
        $("#result_message").html('<center><br><div class="alert alert-success"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><br><br><h4>Utente bloccato correttamente<h4><h5>Verrai reindirizzato sulla home fra qualche istante...<h5><h5>Se non vuoi attendere <a href="http://"+window.location.hostname+"/research/home/index.php">clicca qui.</a></h5></div></center>');

        // Ridireziona alla home dopo 5 secondi
        setTimeout (function() {
          window.location.href = "http://"+window.location.hostname+"/research/home/index.php";
        }, 5000);

      }
    }

    waitingDialog.show('Contattando il server, attendere...',{dialogSize: 'sm',  onShow: function () {
      $.unisharing("User", "addUserToBlackList", "private", param, true, callBackSendReport);
    }
  });
});
}

function getUser(idUser){
  $(function() {
    console.log("Ricevo dati utente");
    function callBackPrintUserInfo(data){
      waitingDialog.hide();
      console.log(data);

      $("#nomeUtente").html(data.name +  " " +data.surname);
      $("#imagePath").attr('src',"../../"+data.pathImage+"/icon80x80.jpg");
    }

    waitingDialog.show('Contattando il server, attendere...',{dialogSize: 'sm',  onShow: function () {
      $.unisharing("User", "getProfile", "private", {"idUser":  idUser}, true, callBackPrintUserInfo);
      },
      onHide: function () {
        $("#modal").modal();
      }
    });
  });
}
