<?
include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unisharing</title>

	<script src="../../js/jquery.1.12.js"></script>
	<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../../css/style.css" rel="stylesheet" media="screen">
	<link href="../../css/jquery.ui.css" rel="stylesheet" media="screen">
	<link href="../../css/jquery.Jcrop.css" rel="stylesheet" media="screen">
	<link href="../../css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="../../css/footer.css" rel="stylesheet" media="screen">
	<link href="../../css/navbar.css" rel="stylesheet" media="screen">
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/functions.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<script src="../../js/jquery.Jcrop.min.js"></script>
	<script src="../../js/jquery.ui.js"></script>

	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->


	<link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
	<script>

	$(function() {


		/*
		var listaUtenti = [
		{
		"username": "lorenzo.dev@gmail.com",
		"name": "Antonio",
		"surname": "Fasulo",
		"pathImage": "img/avatar/tester1@unisharing.it/"
	}
]

$.cookie("listaUtenti", JSON.stringify(listaUtenti), {path: "/", domain: "localhost", expire: 60});
*/
var elencoEsami = [];

///// verifico se la lista dei compagni di studio ideale è non vuota
if(!$.cookie("listaUtenti")){
	var tmp = '<center><br>';
	tmp += '<div class="alert alert-warning">';
	tmp += '<i class="glyphicon glyphicon-delete"/> ';
	tmp += '<span style="font-size:18px;">La lista dei compagni di studio ideali è vuota</span>';
	tmp += '</div>';
	tmp += '</center>';
	$("#Message").html(tmp);
	return;
}


/// Mostro l'elenco del gruppo ideale
var listaUtenti = JSON.parse($.cookie("listaUtenti"));
var tmp = "";
for(var i = 0;i < listaUtenti.length;i++){
	tmp += '<div class="col-md-4" style="padding-left:0px !important">'
	tmp += '<div class="alert alert-info" role="alert" style="padding: 5px;">';
	tmp += '<img style="border-radius:30px;" src="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/'+listaUtenti[i].pathImage+'/icon40x40.jpg">';
	tmp += ' <strong>'+listaUtenti[i].name+' '+listaUtenti[i].surname+'</strong>';
	tmp += '</div>';
	tmp += '</div>';
}

$("#lista_utenti").html(tmp);

/////////////////////////////////////////////////////////////////
/////////////// PRELEVO L'ELENCO DELLE UNIVERITA'////////////////
/////////////////////////////////////////////////////////////////

var callBackUni = function(data){

	console.log(data);

	if(!data.success){
		alert("Errore! " + data.messageError + " " + data.error);
		return;
	}

	$("#universita").append("<option value=''>Seleziona l'università</option>");
	for(var i = 0;i < data.results.length;i++)
	$("#universita").append("<option value='"+data.results[i].id+"'>"+data.results[i].name+"</option>");

}

$.unisharing("Istitutes", "getUniversities", "private", {}, false, callBackUni);


/////////////////////////////////////////////////////////////////////////
/////////////// DEFINISCO L'AZIONE SULLA SCELTA DELL'UNI ////////////////
////////////////////////////////////////////////////////////////////////
$("#universita").on("change", function(){

	var uni = $(this).val();
	var callBackFaculties = function(data){

		if(!data.success){
			alert("Errore! " + data.errorMessage);
			return;
		}

		$("#facolta").html("");
		$("#facolta").append("<option value=''>Seleziona la facoltà</option>");
		for(var i = 0;i < data.results.length;i++)
		$("#facolta").append("<option value='"+data.results[i].id+"'>"+data.results[i].name+"</option>");

	}

	$.unisharing("Istitutes", "getFaculties", "private", {"university": uni}, false, callBackFaculties);

});

/////////////////////////////////////////////////////////////////////////
/////////////// DEFINISCO L'AZIONE SULLA SCELTA DELL'ESAME ////////////////
////////////////////////////////////////////////////////////////////////
$("#facolta").on("change", function(){

	var facolta = $(this).val();
	var availableTags = [];
	var callBackExams = function(data){

		console.log("Esami");
		console.log(data);

		if(!data.success){
			alert("Errore! " + data.errorMessage);
			return;
		}

		for (var i=0; i< data.results.length;i++) {
			elencoEsami[i] = data.results[i].name;
		}

		$("#exam").autocomplete({
			source: elencoEsami
		});

	}

	$.unisharing("Istitutes", "getExams", "private", {"idFaculty": facolta}, false, callBackExams);

});

////////////////////////////////////////////////////////////////
/////////// DEFINISCO IL SUBMIT DELLA FORM /////////////////////
////////////////////////////////////////////////////////////////

$("#btn-create-group").on("click", function() {


	var name = $("#name").val();
	var universita = $("#universita").val();
	var facolta = $("#facolta").val();
	var esame = $("#exam").val();
	var description = $("#description").val();
	var expirationDate = $("#expirationDate").val();
	var expirationInvite = $("#expirationInvite").val();
	var utenti = [];


	var listaUtenti = JSON.parse($.cookie("listaUtenti"));
	$.each(listaUtenti, function(i, item) {
		utenti.push(item.username);
	});


	// CONTROLLO SE SONO STATI INSERITI CORRETTAMENTE I CAMPI RICHIESTI
	var message_err = "";
	var boo_err = false;

	if(!name){
		message_err += "Non è stato inserito il nome<br>";
		boo_err = true;
	}

	if(!universita){
		message_err += "Non è stata selezionata l'università<br>";
		boo_err = true;
	}

	if(!facolta){
		message_err += "Non è stata selezionata la facoltà<br>";
		boo_err = true;
	}

	if(!esame){
		message_err += "Non hai inserito l'esame<br>";
		boo_err = true;
	}

	var eDateAr = expirationDate.split("-");
	var eDate = new Date(eDateAr[2], eDateAr[1] - 1, eDateAr[0]).getTime();

	var eInviteAr = expirationInvite.split("-");
	var eInvite = new Date(eInviteAr[2], eInviteAr[1] - 1, eInviteAr[0]).getTime();


	if(isNaN(eDate)){
		message_err += "La data di scadenza del gruppo non è valida<br>";
		boo_err = true;
	}

	if(isNaN(eInvite)){
		message_err += "La data di scadenza degli inviti non è valida<br>";
		boo_err = true;
	}

	if(eDateAr[2] < eInviteAr[2]){
		if(eDateAr[1] < eInviteAr[1]){
			if(eDateAr[0] < eInviteAr[0]){
				message_err += "La data di scadenza degli inviti non può essere successiva o pari a quella di scadenza del gruppo<br>";
				boo_err = true;
			}
		}
	}

	if(boo_err){
		var tmp = '<center>';
		tmp += '<div class="alert alert-warning">';
		tmp += '<i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size:26px;" /><br>'
		tmp += '<i class="glyphicon glyphicon-delete"/> ';
		tmp += '<span style="font-size:18px;">'+message_err+'</span>';
		tmp += '</div>';
		tmp += '</center>';
		$("#FormError").html(tmp);
		return;
	}

	$("#FormError").html("");

	var callBackGroupCreation = function(data){

		if(!data.success){
			alert("Errore! " + data.messageError + " " + data.error);
			return;
		}

		$("#result_message").html('<center><br><div class="alert alert-success"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><br><br><h4>Gruppo di studio creato correttamente<h4><h5>Verrai reindirizzato sulla home fra qualche istante...<h5><h5>Se non vuoi attendere <a href="http://<? echo $_SERVER["HTTP_HOST"]; ?>/research/home/index.php">clicca qui.</a></h5></div></center>');

		// Ridireziona alla home dopo 5 secondi
		setTimeout (function() {
			window.location.href = document.location.href = "http://<? echo $_SERVER["HTTP_HOST"]; ?>/research/home/index.php";
		}, 5000);

	}

	var param = {
		"name": name,
		"universita":universita,
		"facolta":facolta,
		"description": description,
		"expirationDate": expirationDate,
		"expirationInvite": expirationInvite,
		"esame": esame,
		"partecipanti": utenti
	}

	console.log("AAAA");
	console.log(param);


	$.unisharing("Group", "createGroup", "public", param, false, callBackGroupCreation);

	//Elimino il cookie lista utenti quando creo il gruppo
	$.removeCookie("listaUtenti", {path: "/", domain: window.location.hostname});
});


});

</script>

</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6" id="Message"></div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8" id="result_message">
				<h1>Creazione gruppo di studio</h1>
				<hr>
				<div class="row-fluid">
					<div class="form-group col-lg-12">
						<label>Il tuo team</label><br>
						<span id="lista_utenti">
						</span>
					</div>
				</div><br>
				<div class="row-fluid">
					<div class="form-group col-lg-12">
						<label>Nome del gruppo</label>
						<input type="text" id="name" class="form-control" placeholder="Nome del gruppo" aria-describedby="basic-addon1" required>
					</div><br>
					<div class="form-group col-md-6">
						<label>Università</label>
						<select id="universita" name="selectbasic" class="form-control">
						</select>
					</div>
					<div class="form-group col-md-6">
						<label>Facoltà</label>
						<select id="facolta" name="selectbasic" class="form-control">
						</select>
					</div><br>
					<div class="form-group col-lg-12">
						<label>Nome esame</label>
						<input id="exam" class="form-control" placeholder="Nome dell'esame" aria-describedby="basic-addon1" required>
					</div><br>
					<div class="form-group col-lg-12">
						<div class='col-lg-6' style="padding-left:0px !important;">
							<label>Scadenza gruppo</label>
							<input type="date" class="form-control" id="expirationDate" placeholder="" aria-describedby="basic-addon1" min="<? echo date("Y-m-d");?>">
						</div>
						<div class='col-lg-6' style="padding-right:0px !important;">
							<label>Scadenza inviti</label>
							<input type="date" class="form-control" id="expirationInvite" placeholder="" aria-describedby="basic-addon1" min="<? echo date("Y-m-d");?>">
						</div>
					</div><br>
					<div class="form-group col-lg-12">
						<label>Descrizione</label>
						<textarea placeholder="Insirisci una breve descrizione del gruppo" id="description" class="form-control" style="resize:vertical;height:100px;"></textarea>
					</div>
				</div>
				<div class="col-md-4">
					<br>
					<input type="button" class="btn btn-default" id="btn-annulla" value="Annulla">
					<input type="button" class="btn btn-primary" id="btn-create-group" value="Conferma">
				</div>
			</div>
			<div class="col-log-2"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6" id="FormError"></div>
			<div class="col-lg-3"></div>
		</div>
	</div>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>

</body>
</html>
