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
			getRanking();
			
		});
		
        </script>

    </head>
	<body>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <div class="container">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                        <div class="bootstrap-demo">
                        <h1> Ranking </h1>
                        <h7> Clicca i nomi per visualizzare i profili sulla destra </h7>
        <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Utente</th>
                    <th>Punteggio</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="idRanking"></tbody>
            </table>
                </div>
            </div>
            <div class="col-lg-2"></div>
          	</div>
        </div>
        <? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
