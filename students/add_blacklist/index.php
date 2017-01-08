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
	<link href="../../css/style.css" rel="stylesheet" media="screen">
	<link href="../../css/footer.css" rel="stylesheet" media="screen">
	<link href="../../css/navbar.css" rel="stylesheet" media="screen">
	<link href="css/blacklist.css" rel="stylesheet" media="screen"></link>
	<script src="../../js/jquery.1.12.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<script src="../../js/functions.js"></script>
	<script src="js/main.js"></script>
	<script src="../../js/bootstrap-waitingfor.js"></script>
	<script>
	var url = new URL(window.location.href );
	var params = url.searchParams;
	console.log(params.get("user"));

	var idUser = params.get("user");
	$( function() {
		getUser(idUser);
		//$("#modal").modal();
		$("#btnBlocca").on('click', function() {
			blockUser(idUser);
		});
		$("#btnAnnulla").on('click', function() {
			location.href = "http://<? echo $_SERVER["HTTP_HOST"]; ?>/research/home/index.php";
		});
	});
	// blocco utente
	//blockUser(idUser);
	</script>
</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div id="container">
		<div id="row'fluid">
			<div class= "col-lg-3"></div>
			<div class= "col-lg-6" id="result_message"></div>
			<div class= "col-lg-3"></div>
		</div>
	</div>
	<div id="modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Blocca Utente</h4>
				</div>
				<div class="modal-body">
					<center><h2 id="nomeUtente"></h4></center>
						<center><img id="imagePath" ></center>
						<center><p>Se decidi di proseguire bloccando l'utente, non sara' possibile interagire con l'utente bloccato</p></center>
					</div>
					<div class="modal-footer">
						<button id="btnAnnulla" type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
						<button id="btnBlocca" type="button" class="btn btn-danger" data-dismiss="modal">Blocca</button>
					</div>
				</div>

			</div>
		</div>

		<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
	</html>
