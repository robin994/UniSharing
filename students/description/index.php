<?
	include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/login.css" rel="stylesheet" media="screen">
        <link href="../../css/footer.css" rel="stylesheet" media="screen">
        <link href="../../css/navbar.css" rel="stylesheet" media="screen">
		<script src="../../js/jquery.1.12.js"></script>
    	<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
				<link href="./css/description.css" rel="stylesheet" media="screen">
				<script>
			$(function() {
					//data è il json restituito dal metodo chiamato nella funzione unisharing
					function callBackDescription(data){

						console.log("DATI");
						console.log(data);

						$("#description").html(data.description);
						$("#telephone").html(data.telephone);
						$("#nomeCompleto").html(data.name +  " " +data.surname);
						$("#address").html(data.address);
						$("#universita").html(data.universita);
						$("#facolta").html(data.facolta);
						$("#email").html(data.email);
						$("#birthday").html(data.birthOfDay);
						$("#imagePath").html("<img src=\"../../"+data.pathImage+"\">");
						$("#typeStudent").html(data.typeStudent);
						//console.log(data.pathImage);

						var tmp = "";
						/*
						 *<div class="rating">
                            <span class="glyphicon glyphicon-star"><span class="glyphicon glyphicon-star-empty"></span>
                        </div>
						 */
						 // STAMPA FEEDBACK
						for (var i = 0;i < data.results.length; i++) {
							var ratingAverage = (parseFloat(data.results[i]["f1"])
																	+ parseFloat(data.results[i]["f2"])
																	+ parseFloat(data.results[i]["f3"])
																	+ parseFloat(data.results[i]["f4"]))  / 4;
							tmp += '<div class="panel panel-default">';
							tmp += '	<div class="panel-heading">'+data.results[i]["author"];
							tmp += '	<span class="view-stars pull-right">';
							for (var j = 0 ; j < ratingAverage -1 ; j++) {
								tmp += 		'<span class="glyphicon glyphicon-star"></span>';
							}
							if (ratingAverage > parseInt(ratingAverage)) {
									tmp += '<span class="glyphicon glyphicon-star half"></span>';  //mezza stella se superiore alla media
							} else {
								tmp += '<span class="glyphicon glyphicon-star"></span>';
							}
							tmp += '</span>';
							tmp += '</div>';
							tmp += '		<div class="panel-body">';
							tmp += 			data.results[i]["comment"];
							tmp += '	</div>';
							tmp += '</div>';
						}
						console.log(data.results.length);
						console.log(data.results);
						if (data.results.length == 0) {
							tmp += '  <div class="panel panel-default">';
							tmp += '	<div class="panel-heading">Ancora nessun feedback disponibile';
							tmp += '	<span class="view-stars pull-right">';
						}

						//console.log(tmp);
						$("#feedbacks").html(tmp);
					}

					var idUser = 0;
					var cookie = JSON.parse($.cookie('user'));
					console.log(cookie.idUser);
					var idUser = cookie.idUser;
					var url = new URL(window.location.href );
					var params = url.searchParams;

					// Access to a variable
					console.log(params.get("user"));
					var idUser = params.get("user");


					$.unisharing("User", "getProfile", "public", {"idUser":  idUser}, false, callBackDescription);
				});
			</script>
	</head>

	<body>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
				<center><h3>Profilo Utente</h3></center><br>
    <div id="conteiner" class="container">
			<div class="row">
				<div class="col-lg-3" id="colonna_laterale"> <!-- style="width:50%; height:50%;"-->
					<center id="imagePath"><img src="http://simpleicon.com/wp-content/uploads/account.png" style="width:50%; height:50%"> </center>
					<center><label id="nomeCompleto">Nome Cognome</label></center>
					<center><label id="universita">Università</label></center>
					<center><label id="facolta">Facoltà</label></center>
				<div class="row">
					<div class="col-lg-12">
						<label>Email</label>
						<p id="email">email</p>
					</div>
						<div class="col-lg-12">
							<label>Indirizzo</label>
							<p id="address">Indirizzo</p>
						</div>
						<div class="col-lg-12">
							<!-- <label></label> -->
							<p id="typeStudent">Indirizzo</p>
						</div>
						<div class="col-lg-12">
							<label>Telefono</label>
							<p id="telephone">Telefono</p>
						</div>
						<div class="col-lg-12" >
							<label>Data di nascita</label>
							<p id="birthday">Data di nascita</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6" style='text-align:justify' id="colonna_centrale">
					<div class="row">
						<center><label>Descrizione</label></center>
						<p id="description"> <!--DESCRIZIONE UTENTE -->
						</p>
					</div>
					<div class="row"> <!-- FEEDBACK utenti -->
						<br>
						<label>Feedbacks</label>
						<div id="feedbacks">
							<!--
							Spazio dedicato ai feedbacks
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
