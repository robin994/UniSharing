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
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../css/style.css" rel="stylesheet" media="screen">
    <link href="../css/group_style.css" rel="stylesheet" media="screen">
   	<link href="../../css/footer.css" rel="stylesheet" media="screen">
    <link href="../../css/navbar.css" rel="stylesheet" media="screen">
    <script src="../../js/jquery.1.12.js"></script>
    <script src="../../js/jquery.cookie.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/functions.js"></script>
    <script src="../js/main.js"></script>
		<script src="../../js/bootstrap-waitingfor.js"></script>
	</head>
	<body>
	  <script>
	  	$(function(){
				// carico Mark_feedback
				$.get("../../presentation/group_a.html", function(html){
					mask_group = html;
					// preleveo i gruppi di cui sono amministratore
					getGroupByAdmin(mask_group);
				});
			});
	  </script>
  	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
  	<div class="container">
  		<div class="row" id="Message"></div>
 			<div class= "row">
				<div class= "col-lg-2"></div>
				<div class= "col-lg-8" id="Mask_group"></div>
				<div class= "col-lg-2"></div>
			</div>
		</div>
  	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
