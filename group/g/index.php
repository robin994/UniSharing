<!doctype html>
<html><head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        
        <script src="../../js/jquery.1.12.js"></script>
        
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/footer.css" rel="stylesheet" media="screen">
        <link href="../../css/navbar.css" rel="stylesheet" media="screen">
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
        
        <script src="/js/jquery.balloon.js"></script>
        <script src="../js/main.js"></script>
        
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../css/group_style.css" rel="stylesheet" media="screen">
        <link href="../../css/font-awesome.min.css" rel="stylesheet" media="screen">
	
 
       	<link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
     	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>

		
        <script>
		
		var mask_group;
		
		$(function(){
			
			// carico Mark_feedback
			$.get("../../presentation/group_p.html", function(html){
					
				mask_group = html;
				
				// prelevo tutti i gruppi in cui partecipo
				getGroup(mask_group);
				
			});
			
		});
		
		
		</script>  
          
          
    </head>
	<body>
       <? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <!-- <div>
			<ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gruppi partecipanti</li>
			</ol>
        </div> --> 
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
