<?
	include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/style.css" rel="stylesheet" media="screen">
        <link href="../css/footer.css" rel="stylesheet" media="screen">
        <link href="../css/navbar.css" rel="stylesheet" media="screen">
		<script src="../js/jquery.1.12.js"></script>
		<script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.cookie.js"></script>
        <script src="../js/functions.js"></script>
				<script src="js/main.js"></script>
	</head>
	<body>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <div class="contaniner">
           <div class="col-lg-2">
           </div>
           <div class="col-lg-8">
                <h1>Segnalazione</h1>
				<label>Titolo</label>
				<div class ="input-group" style="width:100%;">
          <input id="object" type="text" class ="form-control" placeholder="">
        </div>
        <br>
        <label>Testo</label><br>
        <div class ="input-group" style="width:100%;">
        	<textarea id="message" class="form-control" rows="10"></textarea>
        </div>
        <br>
        <center>
        	<div class ="input-group">
         		<button  type="button" class="btn btn-default btn-lg" onclick="sendClear()">Pulisci</button>&nbsp;
        		<button  type="button" class="btn btn-default btn-lg" onclick="sendReport()">Invia</button>
          </div>
        </center>
       	</div>
        <div class="col-lg-2">
        </div>
    </div>
    <? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
