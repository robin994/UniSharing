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
				alert($.cookie('user'));
					//data è il json restituito dal metodo chiamato nella funzione unisharing
					function callBackLogin(data){


						console.log(data);

						if(!data.success){
							alert("Errore! " + data.errorMessage);
							return;
						}

						if(data.results.length <= 0){
							alert("Utente non riconosciuto!");
						}else{

					}


					}

					$.unisharing("User", "getProfilo", "public", {"idUser":  '13'}, false, callBackLogin);
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
				<center><label>Profilo Utente</label></center><br>
    <div id="conteiner" class="container">
			<div class="row">
				<div class="col-lg-3" id="colonna_laterale">
					<center><img src="http://simpleicon.com/wp-content/uploads/account.png" style="width:50%; height:50%"></center>
					<center><label>Nome Cognome</label></center>
					<center><label>Università</label></center>
					<center><label>Facoltà</label></center>
					<div class="row" id="colonna_centrale">
						<div class="col-lg-12">
							<label>Email</label>
							<p>email</p>
						</div>
						<div class="col-lg-12">
							<label>Indirizzo</label>
							<p>Indirizzo</p>
						</div>
						<div class="col-lg-12">
							<label>Telefono</label>
							<p>Telefono</p>
						</div>
						<div class="col-lg-12" >
							<label>Data di nascita</label>
							<p>Data di nascita</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6" style='text-align:justify'>
					<div class="row" id="descrizione">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
						sed do eiusmod tempor incididunt ut labore et dolore magna
						aliqua. Ut enim ad minim veniam, quis nostrud exercitation
						ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
						aute irure dolor in reprehenderit in voluptate velit esse cillum
						dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
						non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
