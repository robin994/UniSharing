<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Unisharing</title>
 		<script src="../js/jquery.1.12.js"></script>
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
       	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
       	<link href="../css/font-awesome.min.css" rel="stylesheet" media="screen">
       	<link href="../css/style.css" rel="stylesheet" media="screen">
  		<script src="../js/functions.js"></script>
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

	<footer></footer>

	</body>
</html>
