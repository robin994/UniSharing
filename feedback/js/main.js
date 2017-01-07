// Funzioni FEEDBACK

////////////////////////////////////////////////
//////// Funzione che inserisce i feedback /////
////////////////////////////////////////////////

function checkFeedback(idGruppo, userLoggato){


	// controllo lato client che venga fornito l'id del gruppo
	if(idGruppo == ""){
		var tmp = '<center><br>';
		tmp += '<div class="alert alert-danger">';
		tmp += '<i class="glyphicon glyphicon-delete"/> ';
		tmp += '<span style="font-size:18px;">Errore: Gruppo non trovato</span>';
		tmp += '</div>';
		tmp += '</center>';
		$("#Mask_feedback").html(tmp);
		return;
	}

	// controllo lato client che i dati siano stati passati
	if(userLoggato == ""){
		var tmp = '<center><br>';
		tmp += '<div class="alert alert-danger">';
		tmp += '<i class="glyphicon glyphicon-delete"/> ';
		tmp += '<span style="font-size:18px;">Utente non riconosciuto</span>';
		tmp += '</div>';
		tmp += '</center>';
		$("#Mask_feedback").html(tmp);
		return;
	}


	// funzione di callback
	function callBackCheckFeedback(data){

		console.log("Ricevo dati dei feedback");
		console.log(data);

		if(!data.success){
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-danger">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">'+data.messageError+'</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Mask_feedback").html(tmp);
			return;
		}

		// verifico se ci sono feedback da inserire
		if(data.results.length > 0){

			var title = '<center>';
			title += '<i class="glyphicon glyphicon-warning" style="font-size:22px;"/><br>';
			title += '<h3>Complimenti</h3>hai completato un rapporto di studi';
			title += '</center>';

			// Visualizzo il messaggio di conferma per l'inserimento dei feedback
			$.confirm({
				title: title,
				content: 'Desideri lasciare un feedback per gli utenti che hanno partecipato al gruppo?',
				buttons: {
					confirm: function () {

						var tmp = '<div class="alert alert-success">';
						//tmp += '<i class="glyphicon glyphicon-ok" style="font-size:22px;"/>';
						//tmp += '<h2>Congratulazioni</h2>';
						tmp += 'Hai portato a termine una esperienza di studio di gruppo, vuoi raccontarci com\'è andata?';
						tmp += '</div>';

						$("#Mask_feedback").append(tmp);

						for(var i = 0;i < data.results.length;i++){
							var mask_feed = $.parseHTML(mask_feedback);
							$(mask_feed).attr("groupId", data.results[i].group);
							$(mask_feed).attr("account", data.results[i].account);
							$(mask_feed).find(".optradio_1").attr("name", "_"+i+"optradio_1");
							$(mask_feed).find(".optradio_2").attr("name", "_"+i+"optradio_2");
							$(mask_feed).find(".optradio_3").attr("name", "_"+i+"optradio_3");
							$(mask_feed).find(".optradio_4").attr("name", "_"+i+"optradio_4");
							$("#Mask_feedback").append("<h3>Come si è comportato "+ data.results[i].name + " " + data.results[i].surname+"?");
							$("#Mask_feedback").append(mask_feed);
						}

						var tmpBtn = '<center>';
						tmpBtn += '<a class="bottoneInvioFeedback">';
						tmpBtn += '<button type="button" class="btn btn-primary btn-lg">Salva Feedback</button>';
						tmpBtn += '</a>';
						tmpBtn += '</center>';
						tmpBtn += '<br><br>';

						$("#Mask_feedback").append(tmpBtn);

						////////////////////////////////////////////////////////////////////////
						/////////////// FUNZIONE DI CLICK CHE AVVIA IL SALVATAGGIO /////////////
						////////////////////////////////////////////////////////////////////////
						$(".bottoneInvioFeedback").on("click", function(){

							var param = {
								"feedbacks": [],
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


							// metodo che implementa l'inserimento dei feedback
							insertFeedback(param);

						});

					},

					cancel: function(){}
				}
			});


		}else{

			// I feedback per questo gruppo sono stati già inseriti
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-success">';
			tmp += '<i class="glyphicon glyphicon-ok"/> ';
			tmp += '<span style="font-size:18px;">Ha già inserito i feedback per questo gruppo</span>';
			tmp += '</div>';
			tmp += '</center>';

			$("#Mask_feedback").html(tmp);

		}
	}

	$.unisharing("Feedback", "checkFeedback", "private", {"gruppo": idGruppo, "user": userLoggato}, false, callBackCheckFeedback);
}


///////////////////////////////////////////////////////////////////////////////
/////////////// METODO DELLA CLASSE FEEDBACK CHE SALVA I FEEDBACK /////////////
///////////////////////////////////////////////////////////////////////////////

function insertFeedback(feed){

	function callBackFeedback(data){
		console.log(data);

		if(!data.success){
			alert("Errore! " + data.errorMessage);
			return;
		}

		var tmpFeed = '<center>';
		tmpFeed += '<br>';
		tmpFeed += '<div class="alert alert-success">';
		tmpFeed += '<i class="glyphicon glyphicon-ok" style="font-size:34px;"/><br><br>';
		tmpFeed += '<span style="font-size:18px;">Feedback inseriti correttamente</span>';
		tmpFeed += '</div>';
		tmpFeed += '</center>';

		$("#Mask_feedback").html(tmpFeed);

	}

	// invoco il metodo di insertFeedback
	$.unisharing("Feedback", "insertFeedback", "private", feed, false, callBackFeedback);

}
