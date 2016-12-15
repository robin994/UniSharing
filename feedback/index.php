<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
		<script src="../../js/jquery.1.12.js"></script>
		<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="../js/bootstrap.min.js"></script>
		<link href="../../css/style.css" rel="stylesheet" media="screen">
		<link rel="stylesheet"	type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
	  <script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
		<script type="text/javascript" src="../../js/functions.js"></script>


<script>

		// ONLOAD JQUERY
		$(function(){

			var idGruppo = "13";
			var user = "tester1@unisharing.it";

			function callBackCheckFeedback(data){

				if(!data.success){
					alert("Errore! " + data.errorMessage);
					return;
				}



			}

			$.unisharing("Feedback", "checkFeedback", "private", {"gruppo": idGruppo, "user": user}, false, callBackCheckFeedback);
});
			/*
			$(".bottoneInvio").on("click", function(e){

					 $.confirm({
						title: 'Attenzione!',
						content: 'Sei sicuro di voler inviare il feedback?',
						buttons: {
							confirm: function () {
								alert("HAI CLICCATO CONFERMA!");
								var param = {
									"scadenza": scadenza,
								}
								function callBackSendFeedback(data){
										console.log(data);

																if(!data.success){
																	alert("Errore! " + data.errorMessage);
																	return;
																}

															}

							$.unisharing("Feedback", "sendFeedback", "private", {"feedback":  param}, false, callBackSendFeedback);,
							cancel: function (){
							}
						}
					});


		});
	});
*/
		</script>

    </head>
	<body>

        <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index.html" class="navbar-brand">UniSharing</a>
                        <button class="navbar-toggle" data-toggle="collapse" data-target="#navHeaderCollapse" >
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navHeaderCollapse">
                        <ul class= "nav navbar-nav navbar-right">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="">Profilo</a></li>
                            <li><a href="">Lista nera</a></li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">Gruppi <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="">A cui partcipo</a></li>
                                    <li><a href="">Di cui sono amministratore</a></li>
                                </ul>
                             </li>
                            <li><a href=""> Segnalazione</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
       		<div class= "row">
						<div class= "col-lg-2">
						</div>
						<div class= "col-lg-8">
							<h4>Dai un voto a Nome Cognome per quanto riguarda la sua simpatia </h4>
								<div class="radio">
									  <label><input type="radio" name="optradio_1">Pessimo</label>
								</div>
								<div class="radio">
	  								<label><input type="radio" name="optradio_1">Insufficiente</label>
								</div>
								<div class="radio">
										<label><input type="radio" name="optradio_1" checked="true">Sufficiente</label>
								</div>
								<div class="radio">
										<label><input type="radio" name="optradio_1">Buono</label>
								</div>
								<div class="radio disabled">
	  								<label><input type="radio" name="optradio_1">Ottimo</label>
								</div>
								<h4>Dai un voto a Nome Cognome per quanto riguarda la sua puntualità </h4>
									<div class="radio">
										  <label><input type="radio" name="optradio_2">Pessimo</label>
									</div>
									<div class="radio">
		  								<label><input type="radio" name="optradio_2">Insufficiente</label>
									</div>
									<div class="radio">
											<label><input type="radio" name="optradio_2" checked="true">Sufficiente</label>
									</div>
									<div class="radio">
											<label><input type="radio" name="optradio_2">Buono</label>
									</div>
									<div class="radio">
		  								<label><input type="radio" name="optradio_2" >Ottimo</label>
									</div>
									<h4>Dai un voto a Nome Cognome per quanto riguarda la sua correttezza </h4>
										<div class="radio">
											  <label><input type="radio" name="optradio_3">Pessimo</label>
										</div>
										<div class="radio">
			  								<label><input type="radio" name="optradio_3">Insufficiente</label>
										</div>
										<div class="radio">
												<label><input type="radio" name="optradio_3" checked="true">Sufficiente</label>
										</div>
										<div class="radio">
												<label><input type="radio" name="optradio_3">Buono</label>
										</div>
										<div class="radio">
			  								<label><input type="radio" name="optradio_3" >Ottimo</label>
										</div>
										<h4>Dai un voto a Nome Cognome per quanto riguarda le sue capacità</h4>
											<div class="radio">
												  <label><input type="radio" name="optradio_4">Pessimo</label>
											</div>
											<div class="radio">
				  								<label><input type="radio" name="optradio_4">Insufficiente</label>
											</div>
											<div class="radio">
													<label><input type="radio" name="optradio_4" checked="true">Sufficiente</label>
											</div>
											<div class="radio">
													<label><input type="radio" name="optradio_4">Buono</label>
											</div>
											<div class="radio">
				  								<label><input type="radio" name="optradio_4">Ottimo</label>
											</div>
											<div>
										<center>	<a class="bottoneInvio"><button type="button" class="btn btn-primary btn-lg">Salva Feedback</button></a> </center>
											</div>
						</div>
						<div class= "col-lg-2">
						</div>
      </div>

        <footer>
        </footer>

	</body>
</html>
