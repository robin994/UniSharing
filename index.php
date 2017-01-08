<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UniSharing</title>
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="students/css/login.css" rel="stylesheet" media="screen">
	<link href="css/footer.css" rel="stylesheet" media="screen">
	<link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
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

			var boo = true;
			var msg_err = "";
			var username = $("#username").val();
			var password = $("#password").val();



			if(!username){
				msg_err += "Non hai inserito l'username<br>";
				boo = false;
			}

			if(!password){
				msg_err += "Non hai inserito la password<br>";
				boo = false;
			}

			if(!boo){
				var tmp = '<center>';
				tmp += '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle" style="font-size:22px;"/><br>';
				tmp += '<span style="font-size:18px;">'+msg_err+'</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Message").html(tmp);
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
					var tmp = '<center>';
					tmp += '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle" style="font-size:22px;"/><br>';
					tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
					tmp += '</div>';
					tmp += '</center>';
					$("#Message").html(tmp);
					return;
				}

				if(data.results.length <= 0){
					var tmp = '<center>';
					tmp += '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle" style="font-size:22px;"/><br>';
					tmp += '<span style="font-size:18px;">I dati inseriti non sono corretti</span>';
					tmp += '</div>';
					tmp += '</center>';
					$("#Message").html(tmp);
					return;
				}else{
					var cook = {
						"idUser":data.results[0].idUser,
						"username":data.results[0].username,
						"name":data.results[0].name,
						"surname":data.results[0].surname,
						"pathImage":data.results[0].pathImage,
						"latitude":data.results[0].latitude,
						"longitude":data.results[0].longitude
					}

					var cook_options = {
						path: "/",
						domain: window.location.hostname
					}

					if($(".connesso").is(":checked")){
						cook_options.expires = 60;
					}

					// creo il cookie
					$.cookie('user', JSON.stringify(cook), cook_options);
					if ($.cookie('urlRequest') != null) {
						var urlRequest = $.cookie("urlRequest");
						document.location.href = urlRequest;
					} else {
						document.location.href = "/research/home/";
					}
				}
			}

			$.unisharing("User", "login", "private", {"user":  param}, false, callBackLogin);

		});
	});
	</script>
</head>
<body style="background: url(img/bg.png);">
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
						<center>
							<img src="../../img/logo_login.png" class="img-responsive" alt=""></center>
							<input id="username" type="email" name="email" placeholder="Username" required class="form-control input-lg">
							<input id="password" type="password" class="form-control input-lg" id="password" placeholder="Password" required=""><ul class="error-list"></ul>

							<input type="checkbox" value="si" class="connesso" /> Mantieni una sessione su questo computer
							<button name="go" class="btn btn-lg btn-primary btn-block" id="btn-login">Accedi</button>
							<span id="Message"></span>
							<div>
								<br>
								<center>Non fai ancora parte della community?<br><a href="<? echo "http://".$_SERVER["HTTP_HOST"]."/students/signin/" ?>">Iscriviti gratuitamente</a><!-- o <a href="#">ripristina password</a>--></center>
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
