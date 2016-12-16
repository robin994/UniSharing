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

			var mask_feedback = "";

			$.get("htmls/index.html", function(html){
					
					
						mask_feedback = html;
					
						//var idGruppo = "1";
						//var userLoggato = "tester1@unisharing.it"; //tester1
			
						var idGruppo = "<?php echo $_GET["g"]; ?>";
						var userLoggato = "<?php echo $_GET["u"]; ?>";
			
						function callBackCheckFeedback(data){
				
							console.log("Recevo dati dei feedback");
							console.log(data);
						
							if(!data.success){
								alert("Errore! " + data.errorMessage);
								return;
							}
							
							
							
							
							if(data.results.length > 0){
								
								
								// Visualizzo il messaggio di conferma per l'inserimento dei feedback
								$.confirm({
								title: 'Complimenti, hai completato un rapporto di studi',
								content: 'Desideri lasciare un feedback per gli utenti che hanno partecipato al gruppo?',
								buttons: {
									confirm: function () {
										
									
									$("#Mask_feedback").append('<center><br><div class="alert alert-success" style="font-size:34px;"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><h2>Congratulazioni</h2><h3>Ancora una volta hai portato a termine una nuova esperienza, vuoi raccontarci com\'è andata?</h3></div>');
								
									for(var i = 0;i < data.results.length;i++){
										
										var mask_feed = $.parseHTML(html);
										
										$(mask_feed).attr("groupId", data.results[i].group);
										$(mask_feed).attr("account", data.results[i].account);
										
										$(mask_feed).find(".optradio_1").attr("name", "_"+i+"optradio_1");
										$(mask_feed).find(".optradio_2").attr("name", "_"+i+"optradio_2");
										$(mask_feed).find(".optradio_3").attr("name", "_"+i+"optradio_3");
										$(mask_feed).find(".optradio_4").attr("name", "_"+i+"optradio_4");
										
										$("#Mask_feedback").append("<h3>Come si è comportato "+ data.results[i].name + " " + data.results[i].surname+"?");
										$("#Mask_feedback").append(mask_feed);
									}
									
									$("#Mask_feedback").append('<center><a class="bottoneInvioFeedback"><button type="button" class="btn btn-primary btn-lg">Salva Feedback</button></a></center><br><br>');
									
									
									
									////////////////////////////////////////////////////////////////////////
									/////////////// FUNZIONE DI CLICK CHE AVVIA IL SALVATAGGIO /////////////
									////////////////////////////////////////////////////////////////////////
									
									$(".bottoneInvioFeedback").on("click", function(){
										
										
										var param = {
											"feedbacks": []	,
											"group": "",
											"author": userLoggato
										}
										
										$(".Feedback").each(function(){
											
											var user = $(this).attr("account");
											var gruppo = $(this).attr("groupId");
											
											param.group = gruppo;
											
											var feed1 = $(this).find(".optradio_1:checked").val();
											var feed2 = $(this).find(".optradio_2:checked").val();
											var feed3 = $(this).find(".optradio_3:checked").val();
											var feed4 = $(this).find(".optradio_4:checked").val();
											var comment = $(this).find(".comment").val();
											
											var score = parseInt(feed1) + parseInt(feed2) + parseInt(feed3) + parseInt(feed4);
											
											var tmp_feed = {
												"feed1": feed1,
												"feed2": feed2,
												"feed3": feed3,
												"feed4": feed4,
												"user": user,
												"score": score,
												"comment": comment
											}
											
											param.feedbacks.push(tmp_feed);
										});
										
										
										console.log("ECCO I FEEDBACK");
										console.log(param);
										
										///////////////////////////////////////////////////////////////////////////////
										/////////////// METODO DELLA CLASSE FEEDBACK CHE SALVA I FEEDBACK /////////////
										///////////////////////////////////////////////////////////////////////////////
										
										function callBackFeedback(data){	
											console.log(data);
	
											if(!data.success){
												alert("Errore! " + data.errorMessage);
												return;
											}
											
											
											$("#Mask_feedback").html('<center><br><div class="alert alert-success"><i class="glyphicon glyphicon-ok" style="font-size:34px;"/><br><br><span style="font-size:18px;">Feedback inseriti correttamente</span></div></center>');
											
											
										}
										
										$.unisharing("Feedback", "insertFeedback", "private", param, false, callBackFeedback);
										
									});
								
								},
								
							  cancel: function(){
									 
							  }
						  }
					  });		
													
								
							}else{
								
								var tmp = '<center><br><div class="alert alert-success"><i class="glyphicon glyphicon-ok" style="font-size:34px;"/><br><br><span style="font-size:18px;">Complimenti, hai terminato il rapporto di studi.<br>Hai inserito correttamente i feedback per ogni compagno di studi!</span></div></center>';
								$("#Mask_feedback").html(tmp);
								
							}
						}
			
						$.unisharing("Feedback", "checkFeedback", "private", {"gruppo": idGruppo, "user": userLoggato}, false, callBackCheckFeedback);
			});
		
		});
			
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
						<div class= "col-lg-8" id="Mask_feedback">
							
						</div>
						<div class= "col-lg-2">
						</div>
      </div>


</div>
        <footer>
        </footer>

	</body>
</html>
