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
	<script src="../../js/jquery.1.12.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<script src="../../js/functions.js"></script>
	<script src="js/main.js"></script>
	<script>
	var url = new URL(window.location.href );
	var params = url.searchParams;
	console.log(params.get("user"));

	var idUser = params.get("user");

	// blocco utente
	blockUser(idUser);
	</script>
</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>



	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
</body>
</html>
