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
	<link href="../../css/footer.css" rel="stylesheet" media="screen">
	<link href="../../css/navbar.css" rel="stylesheet" media="screen">
	<script src="../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<link href="../../css/style.css" rel="stylesheet" media="screen">
	<link rel="stylesheet"	type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
	<script type="text/javascript" src="../../js/functions.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script src="../../js/bootstrap-waitingfor.js"></script>
	<script>

	var mask_feedback = "";

	// ONLOAD JQUERY
	$(function(){


		// carico Mark_feedback
		$.get("htmls/index.html", function(html){

			mask_feedback = html;

			var idGruppo = "<?php echo $_GET["g"]; ?>";
			var userLoggato = JSON.parse($.cookie("user"));


			//var idGruppo = "1";
			//var userLoggato = "info@lorenzovitale.it"; //tester1

			// verifico se esistono dei feedback da inserire
			checkFeedback(idGruppo, userLoggato.username);

		});

	});

	</script>
</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div class="container">
       	<div class="row">
        	<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/research/home/index.php">Home</a></li>
        		<li class="breadcrumb-item active">Inserisci feedback</li>
        	</ol>
		</div>
		<div class= "row">
			<div class= "col-lg-2"></div>
			<div class= "col-lg-8" id="Mask_feedback"></div>
			<div class= "col-lg-2"></div>
		</div>
	</div>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
</body>
</html>
