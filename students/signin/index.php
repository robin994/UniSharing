<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <script src="../../js/jquery.1.12.js"></script>
    		<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
				<script>
				$(function() {

					$("#btn-iscriviti").on("click", function() {

						console.log("HO CLICCATO SUL TASTO ISCRIVITI");

						var name = $("#name").val();
						var surname = $("#surname").val();
						var email = $("#email").val();
						var password = $("#password").val();
						var confpassword = $("#confpassword").val();
						var bday = $("#bday").val();
						var sesso = $("#sesso").val();
						var indirizzo = $("#indirizzo").val();
						var cellulare = $("#cellulare").val();
						var universita = $("#universita").val();
						var facolta = $("#facolta").val();



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
                            <li><a href="">Segnalazione</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
	<div class="container">
		<div class="row-fluid">
			<div class="col-md-6">
				<h1>Registrazione</h1>
					<div class="row-fluid">
						<div class="form-group col-lg-6">
							<Label>Nome</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" class="form-control" placeholder="Nome" id="name" aria-describedby="basic-addon1" required="true">
							</div>
						</div>
						<div class="form-group col-lg-6">
							<Label>Cognome</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" class="form-control" placeholder="Cognome" id="surname" aria-describedby="basic-addon1" required>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="form-group col-lg-12">
							<Label>Email</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon1" required>
							</div>
						</div>
					</div>
						<div class="row-fluid">
								<div class="form-group col-lg-6">
								<Label>Password</Label>
									<div class="input-group" style="width:100%;">
										<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
									</div>
								</div>
								<div class="form-group col-lg-6">
								<Label>Conferma Password</Label>
									<div class="input-group" style="width:100%;">
										<input type="password" class="form-control" placeholder="Conferma Password" aria-describedby="basic-addon1" required>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class='col-lg-8'>
									<label>Data di nascita</label>
										<input type="date" class="form-control" id="bday" placeholder="" aria-describedby="basic-addon1">
									</div>
								<div class="col-md-4">
										<label>Sesso</label>
										<select id="selectbasic" name="selectbasic" class="form-control">
											<option value="1">Maschio</option>
											<option value="2">Femmina</option>
										</select>
								</div>
						</div>
						<div class="row-fluid">
							<div class="form-group col-lg-6">
								<Label>Indirizzo</Label>
								<div class="input-group" style="width:100%;">
									<input type="text" class="form-control" placeholder="Indirizzo" aria-describedby="basic-addon1">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<Label>Cellulare</Label>
							<div class="input-group" style="width:100%;">
									<input type="text" class="form-control" placeholder="Cellulare" aria-describedby="basic-addon1">
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="col-md-12">
								<label>Università</label>
								<select id="selectbasic" name="selectbasic" class="form-control" required>
								</select>
						</div>
						<div class="col-md-12">
								<label>Facoltà</label>
								<select id="selectbasic" name="selectbasic" class="form-control" required>

								</select>
								<br>
								<button type="submit" class="btn btn-lg btn-primary btn-block" id="btn-iscriviti">Iscriviti</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<label>Prova</label>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
				sed do eiusmod tempor incididunt ut labore et dolore magna
				aliqua. Ut enim ad minim veniam, quis nostrud exercitation
				ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
				aute irure dolor in reprehenderit in voluptate velit esse cillum
				dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
				non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="row-fluid">
				<div class="col-md-12" style="width:100%;">
				</br>

				</div>
			</div>
		</div>
	</div>

    <footer>

    </footer>

	</body>
</html>
