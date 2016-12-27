<?
	include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Unisharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../../css/group_style.css" rel="stylesheet" media="screen">
        <link href="../../css/footer.css" rel="stylesheet" media="screen">
        <link href="../../css/navbar.css" rel="stylesheet" media="screen">
        <script src="../../js/jquery.1.12.js"></script>
    	<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../js/main.js"></script>
        
        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
    	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
        
        <script>
			$(function(){
				
				// carico Mark_feedback
				$.get("../../presentation/group_v.html", function(html){
						
					mask_group = html;
					
					var idGroup = "<?php echo $_GET["g"]; ?>";
					
					// preleveo i dettagli del gruppo
					getDetailGroup(idGroup, mask_group);
					
				});
				
			});
			
		</script>
	</head>
	<body>
        <? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <div class="container">   
       		<div class="row" id="Message"></div>
            <div class="row" id="Mask_view_group"></div>
      	</div>  
      
        <? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>

	</body>
</html>