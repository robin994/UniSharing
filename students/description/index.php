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
    <link href="../../css/footer.css" rel="stylesheet" media="screen">
    <link href="../../css/navbar.css" rel="stylesheet" media="screen">
		<script src="../../js/jquery.1.12.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="../../js/jquery.cookie.js"></script>
		<link href="css/description.css" rel="stylesheet" media="screen">
		<script src="../../js/bootstrap-waitingfor.js"></script>
		<script>
			$( function() {
					//data è il json restituito dal metodo chiamato nella funzione unisharing
					function callBackDescription(data){
						waitingDialog.hide();
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
						$("#imagePath").attr('src',"../../"+data.pathImage+"/icon250x250.jpg");
						$("#typeStudent").html(data.typeStudent);
						//console.log(data.pathImage);


						var tmp = "";
						console.log(data.features);
						//Stampa features
						for (var i = 0;i < data.features.length; i++) {
							tmp += "<div class=\"col-lg-6\">";
							tmp += "	<div class=\"row\" style=\"margin-bottom: 2px\">";
							tmp += "		<p>";
						//tmp += "		<input type=\"checkbox\" value=\'"+data.features[i].idFeature+"\' class=\"features\">";
						tmp += 		  data.features[i].label;
						tmp += "		</p>";
						tmp += "	</div>";
						tmp += "</div>";
						if (data.features[i].idFeature > 6) {
							$("#knowledge").append(tmp);
						} else {
							$("#personality").append(tmp);
						}
						tmp = "";
					}
					/*
					*<div class="rating">
					<span class="glyphicon glyphicon-star"><span class="glyphicon glyphicon-star-empty"></span>
					</div>
					*/

					tmp = "";
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

				waitingDialog.show('Attendere',{dialogSize: 'sm',  onShow: function () {
					$.unisharing("User", "getProfile", "public", {"idUser":  idUser}, true, callBackDescription);
				}});
			});
			</script>
		</head>
		<body>
			<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
			<div id="conteiner" class="container">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<h1>Profilo utente</h1>
					<hr>
					<div class="row">
						<div class="col-lg-4" id="colonna_laterale">
							<center ><img id="imagePath" style="width:50%; height:50%"> </center>
							<center><label id="nomeCompleto"></label></center>
							<center><label id="universita"></label></center>
							<center><label id="facolta"></label></center>
							<br>
							<div class="row">
								<div class="col-lg-12">
									<label>Email</label>
									<p id="email"></p>
								</div>
								<div class="col-lg-12">
									<label>Indirizzo</label>
									<p id="address"></p>
								</div>
								<div class="col-lg-12">
									<label>Tipo di Studente</label>
									<p id="typeStudent"></p>
								</div>
								<div class="col-lg-12">
									<label>Telefono</label>
									<p id="telephone">T</p>
								</div>
								<div class="col-lg-12" >
									<label>Data di nascita</label>
									<p id="birthday"></p>
								</div>
							</div>
						</div>
						<div class="col-lg-6"id="colonna_centrale">
							<div class="row">
								<label>Descrizione</label>
								<p id="description"> <!--DESCRIZIONE UTENTE -->
								</p>
							</div>
							<br>
							<!-- FEATURES utente -->
							<div class="row" >
								<Label>Caratteristiche</Label>
								<div class="filter-panel collapse in" aria-expanded="true" >
									<div class="panel with-nav-tabs panel-default">
										<div class="panel-heading">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#personality" data-toggle="tab">Personalità</a></li>
												<li><a href="#knowledge" data-toggle="tab">Conoscenze</a></li>
											</ul>
										</div>
										<div class="panel-body">
											<div class="tab-content">
												<div class="tab-pane fade in active" id="personality">
													<!-- qui le personalita'-->
												</div>
												<div class="tab-pane fade" id="knowledge">
													<!-- qui le conoscenze'-->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- FINE FEATURES utente -->
							<div class="row"> <!-- FEEDBACK utenti -->
								<br>
								<label>Feedbacks</label>
								<div id="feedbacks">
									<!--Spazio dedicato ai feedbacks -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-2">
			</div>
			<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>

		</body>
		</html>
