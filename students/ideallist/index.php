<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        
        
        
        <script src="../../js/jquery.1.12.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
        
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        
    	<script src="../../js/bootstrap.min.js"></script>
        
        <link href="../css/style.css" rel="stylesheet" media="screen">
        <link href="../blackList/css/ideal_style.css" rel="stylesheet" media="screen">
        
        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
    	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
        <script src="/js/jquery.balloon.js"></script>
        
        <script>        
			$(function(){
				
				
				var boo = false;
				
				if($.cookie("listaUtenti")){
					
					boo = true;
					var utenti = JSON.parse($.cookie("listaUtenti"));
					
					if(utenti.length <= 0) { 
						boo = false; 
					}else{
					
					
					
						var tmp = "<h2>Lista ideale</h2>";
							tmp += "<table class=\"table\">";
							tmp += "<thead>";
							tmp += "<tr>";
							tmp += "<th class=\"colownsmall\"></th>";
							tmp += "<th></th>";
							tmp += "<th></th>";
							tmp += "</tr>";
							tmp += "</thead>";
							tmp += "<tbody>";
							
						for(var i = 0;i < utenti.length;i++){
							tmp += "<tr>";
							tmp += "<td><a href=\"#\"><img class=\"imageStyle\" src=\"../../"+utenti[i].pathImage+"/icon80x80.jpg\" style=\"border-radius:50px\"></a></td>";
							tmp += "<td><h5><a href=\"#\" class=\"user-link\">"+utenti[i].name+" "+utenti[i].surname+"</a></h5></td>";
							tmp += "<td><button class=\"removeUser btn btn-danger btn-xs\" user-subhead=\"\" user=\""+utenti[i].username+"\">";
							tmp += " Rimuovi";
							tmp += "<span class=\"glyphicon glyphicon-minus\"></span></button></td>";
							tmp += "</tr>";
						}
						
						tmp += "</tbody>";
						tmp += "</table>";
						
						$("#ris").html(tmp);
						if(utenti.length > 0){
							$("#ris").append("<center><button type=\"button\" class=\"btn btn-primary\" title=\"crea un nuovo gruppo\">Crea gruppo</button></center>");
						}
					}
				}
				
				
				if(!boo){
					var tmp = '<center><br>';
						tmp += '<div class="alert alert-warning">';
						tmp += '<i class="glyphicon glyphicon-delete"/> ';
						tmp += '<span style="font-size:18px;">La lista dei compagni di studio ideali è vuota</span>';
						tmp += '</div>';
						tmp += '</center>';
						$("#Message").html(tmp);
				}
				
				$(".removeUser").on("click", function(){
					
					var sel_user = $(this).attr("user");

					if($.cookie("listaUtenti")){
							
						var utenti = JSON.parse($.cookie("listaUtenti"));
						for(var i = utenti.length-1;i >= 0;i--){
							if(utenti[i].username == sel_user){
								utenti.splice(i,1);
								break;	
							}
						}
						
						$.cookie("listaUtenti", JSON.stringify(utenti), 60);
						location.reload();
					}
					
				});
			});
			
		</script>
	</head>
	<body>
        <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index.html" class="navbar-brand">UniSharing</a>
                        <button class="navbar-toggle" data-toggle="collapse" data-target="#navHeaderCollapse" >
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>   
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navHeaderCollapse">                   
                        <ul class= "nav navbar-nav navbar-right">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="">Profilo</a></li>
                            <li><a href="">Lista nera</a></li>
                            <li class="dropdown">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">Gruppi <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="">A cui partcipo</a></li>
                                    <li><a href="">Di cui sono amministratore</a></li>
                                </ul> 
                             </li>
                            <li><a href=""> Segnalazione</a></li>
                        </ul>                  
                    </div>
                </div>
            </nav> 
        </header>    
        <div class: "container">
        	<div class: "row">
            	<div class="col-lg-3"></div>
                <div class="col-lg-6" id="Message"></div>
                <div class="col-lg-3"></div>
            </div>
            <div class: "row">
            	<div class= "col-lg-3"></div>
                <div class= "col-lg-6" id="ris"></div>
                <div class= "col-lg-3"></div>
            </div>
        </div>
      
        <footer>
        </footer>

	</body>
</html>