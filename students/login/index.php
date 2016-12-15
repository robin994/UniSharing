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
				<script>
			$(function() {

				$("#btn-login").on("click", function() {

					console.log("HO CLICCATO SUL TASTO DELLA LOGIN");


					var boo;
					var username = $("#username").val();
					var password = $("#password").val();

					if(!username){
						alert("Non hai inserito l'username");
						return;
					}

					if(!password){
						alert("Non hai inserito la password");
						return;
					}

					var param = {
						"username": username,
						"password": password
					}

					function callBackLogin(data){


						console.log(data);

						if(!data.success){
							alert("Errore! " + data.errorMessage);
							return;
						}

					}

					$.unisharing("User", "login", "private", {"user":  param}, false, callBackLogin);


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
        <div id="conteiner" class="container">
					<div class="col-md-4"></div>
					<div class="row" id="pwd-container">

					<div class="col-md-4">
      <section class="login-form">
        <div class="divlogin">
          <center><img src="../../img/logo.png" class="img-responsive" alt=""></center><br>
          <input id="username" type="email" name="email" placeholder="Username" required="" class="form-control input-lg">

          <input id="password" type="password" class="form-control input-lg" id="password" placeholder="Password" required=""><ul class="error-list"></ul>
<<<<<<< HEAD
=======

<div id="btn-login">prova</div>
>>>>>>> origin/master
          <button name="go" class="btn btn-lg btn-primary btn-block" id="btn-login">Log in</button>

          <div><br>
            <center><a href="#">Crea account</a> o <a href="#">ripristina password</a></center>
          </div>

        </div>

      </section>
		</div>
	<div class="col-md-4"></div>

			</div>
		</div>
	</div>
    <footer>

    </footer>

	</body>
</html>
