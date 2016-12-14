<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../../css/group_style.css" rel="stylesheet" media="screen">
        <script src="../../js/jquery.1.12.js"></script>
    	<script src="js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
    	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
        
        <script>
			$(function(){
				$(".btn-primary").on("click", function(e){
					$.confirm({
						title: 'Attenzione!',
						content: 'Sei sicuro di voler abbandonare il gruppo?',
						buttons: {
							confirm: function () {
								
								
								alert("HAI CLICCATO CONFERMA!");
								
								
							},
							cancel: function () {
								
								
								
							}
						}
					});
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
        <div class="container">   
       		<div class="row">
        		<div class="col-lg-2"></div>
                <div class="col-lg-4">
                	<h1> Nome del gruppo </h1>
                    <h4> Creato da Antonio Fasulo </h4>
                    <br><br><br><br>
                    <h2> Descrizione </h2>
                    <p>Mostra descrizione</p>
                    <br><br><br><br>
                    <p>Data: 18/12/2017</p>
                    <p>Facoltà: informatica</p>
                    <p>Esame: ingegneria del software</p>
                </div>
                <div class="col-lg-4">
                	<h2>Utenti partecipanti</h2>
          			<table class="table">
    					<thead>
      						<tr>
        						<th>Nome</th>
        						<th>Cognome</th>
       					 		<th></th>
      						</tr>
    					</thead>
    				<tbody>
      					<tr>
       						 <td>Antonio</td>
       						 <td>Fasulo</td>
       						 <td><span class="label label-success">Accettato</span></td>
      					</tr>      
                         <tr class="active">
                            <td>Giuseppe</td>
                            <td>Altobelli</td>
                            <td><span class="label label-danger">Attesa</span></td>
                        </tr>
                        <tr>
                            <td>Lorenzo</td>
                            <td>Vitale</td>
                            <td><span class="label label-success">Accettato</span></td>
                        </tr>
                        <tr class="active">
                            <td>Emilia</td>
                            <td>Severino</td>
                            <td><span class="label label-danger">Attesa</span></td>
                        </tr>
    			 </tbody>
 				 </table>
                </div>
                <div class="col-lg-2"></div> 
      		</div>
      </div>  
      <br><br><br><br>  
      <div class="container">
      	<div class="row">
        	<div class="col-lg-2"></div>
            <center><div class="col-lg-8"><button type="button" class="btn btn-primary">Abbandona gruppo</button></div></center>
            <div class="col-lg-2"></div>
        </div>
      </div> 
      
        <footer>
        </footer>

	</body>
</html>