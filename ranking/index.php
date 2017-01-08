<?
include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unisharing</title>
	<script src="../js/jquery.1.12.js"></script>
	<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../../css/footer.css" rel="stylesheet" media="screen">
	<link href="../../css/navbar.css" rel="stylesheet" media="screen">
	<script src="../js/functions.js"></script>
	<script src="../js/jquery.cookie.js"></script>
	<link href="css/ranking.css" rel="stylesheet" media="screen">
	<script src="../js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>


	<script>
	// ONLOAD JQUERY
	$(function(){
		// funzione che riceve la classifica generale
		init();

	});

	</script>

</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/research/home/index.php">Home</a></li>
   		<li class="breadcrumb-item active">Classifica</li>
	</ol>
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
			</div>
			<div class="col-lg-8">
				<div class="bootstrap-demo">
					<h1> Ranking </h1>
					<hr>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									<Label>#</Label>
								</th>
								<th id="Utente">
									<Label><a class="mya" onclick="orderByUser()">Utente</a></Label>
									<span id="SpanU"  class="glyphicon glyphicon-triangle-bottom"style="display:none" aria-hidden="true"></span>
								</th>
								<th id="Punteggio">
									<Label><a class="mya" onclick="orderByScore()">Punteggio</a></Label>
									<span id="SpanP" class="glyphicon glyphicon-triangle-bottom" style="display:none" aria-hidden="true"></span>
								</th>
								<th id="Feedback">
									<Label><a class="mya" onclick="orderByFeedback()">Feedback</a></Label>
									<span id="SpanF" class="glyphicon glyphicon-triangle-bottom" style="display:none" aria-hidden="true"></span>
								</th>
							</tr>
						</thead>
						<tbody id="idRanking">
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
</body>
</html>
