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
        
        <script src="../../js/jquery.1.12.js"></script>
    	<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
	</head>
	<body>
            
        <script>
        	$(function(){
				
				var param = {
					"account": "tester1@unisharing.it" 
				}
				
				function callBackViewAdminGroup(data){
					
					console.log(data);
					
					if(!data.success){
							alert("Errore! " + data.errorMessage);
							return;
					}
					
					var tmp= "";
						
					for (var i=0; i<data.results.length; i++){
						console.log (data.results[i]);
							
							//tmp='<tbody>';
      						tmp=	'<tr class= "active">';
       						tmp=		'<td>'+data.results[i].name+'</td>';
       						tmp=		'<td>'+data.results[i].creationDate+'</td>';
							tmp=		'<td>'+data.results[i].expirationDate+'</td>';
                            tmp=		'<td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a></td>';
      						tmp=	'</tr>';      
    			 			//tmp='</tbody>';
					}
						
						$("#ris").html("");
						$("#ris").html(tmp);
					}
					
					$.unisharing("Group", "getAdminGroup", "private", param, false, callBackViewAdminGroup);
				
			});
        </script>
        
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
        <div class="container">   
       		<div class="row">
        		<div class="col-lg-2"></div>
        		<div class="col-lg-8">
          			<h2>Gruppi che amministro</h2>
          			<table class="table">
    					<thead>
      						<tr>
        						<th>Nome</th>
                                <th>Data creazione</th>
       					 		<th>Data scadenza</th>
                                <th>Attività</th>
      						</tr>
                            <tbody id="ris">
                            </tbody>
                        </thead>
 				 	</table>
       			</div>
        		<div class="col-lg-2"></div>
      		</div>
            
      </div>      
      
        <footer>
        </footer>

	</body>
</html>
