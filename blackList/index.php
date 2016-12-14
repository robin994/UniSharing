<!doctype html>
<html>  
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        
        
        
        <script src="http://code.jquery.com/jquery-1.12.2.min.js"></script>
        
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        
    	<script src="../../js/bootstrap.min.js"></script>
        
        <link href="../css/style.css" rel="stylesheet" media="screen">
        <link href="css/ideal_style.css" rel="stylesheet" media="screen">
        
        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
    	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
        <script src="/js/jquery.balloon.js"></script>
        
        <script>        
			$(function(){
				$(".creationgroup").on("click", function(e){
					$.confirm({
						title: 'Attenzione!',
						content: 'Sei sicuro di voler creare il gruppo con i dati utenti?',
						button: {
							confirm: function(){
								alert ("Congratulazioni hai crato un nuovo gruppo :) !");
							},
							cancel: function(){
							}
						}
					});
				});
			});
		</script>
        
        <script>
        	$(function() {
  				$('.creationgroup').balloon(options);
			}); 
        </script>
        
        <script>
			$(function(){
				$(".creationgroup").animate({
					"borderWidth" : "4px", //bordo a 4 pixel
					"width" : "+20px" //aumenta la larghezza di 200 pixel
				});
			});
			
		</script>
        
        <script>        
			$(function(){
				$(".btn_leave_g").on("click", function(e){
					$.confirm({
						title: 'Attenzione!',
						content: 'Sei sicuro di eliminare lo studente dalla tua lista ideale',
						button: {
							confirm: function(){
								alert ("Studente eliminato");
							},
							cancel: function(){
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
        	<div class= "row">
            	<div class= "col-lg-2"></div>
                <div class= "col-lg-8">
                	<h2>Lista nera</h2>
          			<table class="table">
    					<thead>
      						<tr>
        						<th class= "colownsmall"></th>
        						<th>Nome</th>
                                <th>Data scadenza</th>
                                <th></th>
      						</tr>
    					</thead>
    				<tbody>
      					<tr>
       						 <td><a href="#"><img class= "imageStyle" src="http://image.webmasterpoint.org/news/original/mercato-it-le-opportunit-per-programmatori-e-sviluppatori.jpg" style="border-radius:50px"></a></td>
       						 <td>Antonio Fasulo</td>
                             <td> 28/10/2018</td>
                             <td><a class="btn_leave_g"><i class="glyphicon glyphicon-remove-sign size_iconremove"></i></a></td>
      					</tr>   
                        <tr>
       						 <td><a href="#"><img class= "imageStyle" src="http://image.webmasterpoint.org/news/original/mercato-it-le-opportunit-per-programmatori-e-sviluppatori.jpg" style="border-radius:50px"></a></td>
       						 <td>Lorenzo Vitale</td>
                             <td> 29/02/2017</td>
                             <td><a class="btn_leave_g"><i class="glyphicon glyphicon-remove-sign size_iconremove"></i></a></td>
      					</tr>
                        <tr>
       						 <td><a href="#"><img class= "imageStyle" src="http://image.webmasterpoint.org/news/original/mercato-it-le-opportunit-per-programmatori-e-sviluppatori.jpg" style="border-radius:50px"></a></td>
       						 <td>Giuseppe Altobelli</td>
                             <td>18/02/2018</td>
                             <td><a class="btn_leave_g"><i class="glyphicon glyphicon-remove-sign size_iconremove"></i></a></td>
      					</tr>     
    			 </tbody>
 				 </table>
                </div>
                <div class= "col-lg-2"></div>  
      	</div> 
        <br><br><br><br>
        <div class: "container">
        	<div class: "row">
            	<div class= "col-lg-4"></div>
                <div class= "col-lg-4">
                	<center><div class="col-lg-8"><button type="button" class="btn btn-primary creationgroup">Crea gruppo</button></div></center>
                </div>
                <div class= "col-lg-4"></div>
            </div>
        </div>
      
        <footer>
        </footer>

	</body>
</html>