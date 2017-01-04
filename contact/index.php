<?
	include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
	include "../notification/php/Notification.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen"> 
        <link href="../css/style.css" rel="stylesheet" media="screen"> 
        <link href="../css/footer.css" rel="stylesheet" media="screen"> 
        <link href="../../css/jquery.Jcrop.css" rel="stylesheet" media="screen"> 
        <link href="../css/navbar.css" rel="stylesheet" media="screen">
        <link href="../css/students_style.css" rel="stylesheet" media="screen">
		<script src="../js/jquery.1.12.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.cookie.js"></script>
        <script src="../js/functions.js"></script>
        <script src="../../js/jquery.Jcrop.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
     	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
        
        <script>
		
			$(function (){
				$("#annullabutton").on("click", function(){
					console.log("ciao");
				});
				
				$("#sendButton").on("click", function(){
					var title= $("#titolo").val();
					var description= $("#description").val();
					
					var message_err= "";
					var boo= false;
					
					if (!title){
						message_err += "Non hai inserito nulla nel campo titolo";
						boo= true;
					}
					
					if (!description){
						message_err += "Non hai inserito nulla nella descrizione";
						boo= true;
					}
					
					if(boo){
						console.log(message_err);
						alert({
								title: 'Attenzione!',
								content: message_err
						});
					}else{
						if($.cookie("user")){
              				var cookie = JSON.parse($.cookie('user'));
              				console.log(cookie);
              				var Usermail = cookie.username;
            			}
						
						var param = {
							"titolo": title,
							"descrizione": description,
							"mail": Usermail
						}
						
						$.unisharing("User", "contactSend", "private", param, "CallBackResult");

					}
				});
			});
		</script>
   
	</head>
	<body>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <div class="contaniner">
           <div class="col-lg-2">
           </div>
           <div class="col-lg-8">
                <h1>Segnalazione</h1>
				<label>Titolo</label>
				<div class ="input-group" style="width:100%;">
                	<input type="text" class ="form-control" placeholder="" id="titolo">
                </div>
                <br>
                <label>Testo</label><br>
                <div class ="input-group" style="width:100%;">
                	<textarea class="form-control" rows="10" id="description"></textarea>
                </div>
                <br>
                <center>
                	<div class ="input-group">
                 		<button  type="button" class="btn btn-default btn-lg" id= "annullabutton">Annulla</button>&nbsp;
                		<button  type="button " class="btn btn-default btn-lg" id= "sendButton">Invia</button>
                    </div>
                </center>
           	</div>
            <div class="col-lg-2">
            </div>           
        </div>
        <? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
