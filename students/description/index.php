<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/login.css" rel="stylesheet" media="screen">
				<script src="../../js/jquery.1.12.js"></script>
    		<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
				<style>
					@import(/css/description.css);
				</style>
				<script>
			$(function() {
					//data è il json restituito dal metodo chiamato nella funzione unisharing
					function callBackDescription(data){


						console.log(data);

						$("#description").html(data.description);
						$("#telephone").html(data.telephone);
						$("#nomeCompleto").html(data.name +  " " +data.surname);
						$("#address").html(data.address);
						$("#universita").html(data.universita);
						$("#facolta").html(data.facolta);
						$("#email").html(data.email);
						$("#birthday").html(data.birthOfDay);
						$("#imagePath").html("<img src=\"../../"+data.pathImage+"\">");
						console.log(data.imagePath);


					}

					$.unisharing("User", "getProfile", "public", {"idUser":  '13'}, false, callBackDescription);
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
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="">Profilo</a></li>
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
				<center><h3>Profilo Utente</h3></center><br>
    <div id="conteiner" class="container">
			<div class="row">
				<div class="col-lg-3" id="colonna_laterale"> <!-- style="width:50%; height:50%;"-->
					<center id="imagePath"><img src="http://simpleicon.com/wp-content/uploads/account.png" style="width:50%; height:50%"> </center>
					<center><label id="nomeCompleto">Nome Cognome</label></center>
					<center><label id="universita">Università</label></center>
					<center><label id="facolta">Facoltà</label></center>
					<div class="row" id="colonna_centrale">
						<div class="col-lg-12">
							<label>Email</label>
							<p id="email">email</p>
						</div>
						<div class="col-lg-12">
							<label>Indirizzo</label>
							<p id="address">Indirizzo</p>
						</div>
						<div class="col-lg-12">
							<label>Telefono</label>
							<p id="telephone">Telefono</p>
						</div>
						<div class="col-lg-12" >
							<label>Data di nascita</label>
							<p id="birthday">Data di nascita</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6" style='text-align:justify'>
					<div class="row">
						<center><label>Descrizione</label></center>
						<p id="description"> <!--DESCRIZIONE UTENTE -->
						</p>
					</div>
					<div class="row" id="feedbacks"> <!-- FEEDBACK utenti -->
						<br>
						<label>Feedbacks</label>
						<div class="panel panel-default">
						  <div class="panel-heading">Nome Cognome</div>
						  <div class="panel-body">
						    Sei uno stronzo
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <footer>

    </footer>

	</body>
</html>
