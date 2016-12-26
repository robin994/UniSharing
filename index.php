<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="students/css/login.css" rel="stylesheet" media="screen">
        <link href="css/footer.css" rel="stylesheet" media="screen">
		<script src="js/jquery.1.12.js"></script>
    	<script src="js/bootstrap.min.js"></script>
        <script src="js/functions.js"></script>
        <script src="js/jquery.cookie.js"></script>
		<script>
			$(function() {
							
				if($.cookie("user")){
					var cookie = JSON.parse($.cookie('user'));
					console.log(cookie.name);
				}
					
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

					// data è il json restituito dal metodo chiamato nella funzione unisharing
					function callBackLogin(data){

						console.log(data);

						if(!data.success){
							alert("Errore! " + data.errorMessage);
							return;
						}

						if(data.results.length <= 0){
							alert("Utente non riconosciuto!");
						}else{
							var cook = {
							"idUser":data.results[0].idUser,
							"username":data.results[0].username, 
							"name":data.results[0].name, 
							"surname":data.results[0].surname, 
							"pathImage":data.results[0].pathImage
							}							
							// creo il cookie
							$.cookie('user', JSON.stringify(cook));
						}
					}

					$.unisharing("User", "login", "private", {"user":  param}, false, callBackLogin);

					});
				});
			</script>
	</head>
	<body>
    	<!-- Includo la pagina php con il controllo sul cookie -->
    	<? 		
			// chiamo il controllo specifico per la pagina di login	
			include("php/cookiescontrollogin.php");
		?>
        <div id="conteiner" class="container">
			<div class="col-md-4">
            </div>
			<div class="row" id="pwd-container">
				<div class="col-md-4">
      				<section class="login-form">
        				<div class="divlogin">
                        	<center><img src="../../img/logo.png" class="img-responsive" alt=""></center><br>
                          	<input id="username" type="email" name="email" placeholder="Username" required class="form-control input-lg">
                          	<input id="password" type="password" class="form-control input-lg" id="password" placeholder="Password" required=""><ul class="error-list"></ul>
                          	<button name="go" class="btn btn-lg btn-primary btn-block" id="btn-login">Log in</button>
							<div>
                        		<br>
            					<center><a href="#">Crea account</a> o <a href="#">ripristina password</a></center>
          					</div>
       					</div>
      				</section>
				</div>
				<div class="col-md-4">
                </div>
			</div>
		</div>
    	<!-- Includo la pagina php che stampa il footer -->
    	<? 		
			include("php/footer.php");
		?>
	</body>
</html>