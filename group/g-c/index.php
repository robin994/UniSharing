<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../../css/jquery.Jcrop.css" rel="stylesheet" media="screen">
      <!--  <link href="../css/students_style.css" rel="stylesheet" media="screen"> -->
        <script src="../../js/jquery.1.12.js"></script>
    		<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
        <script src="../../js/jquery.Jcrop.min.js"></script>


        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
     	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
			<script>

					$(function() {


						/////////////////////////////////////////////////////////////////
						/////////////// PRELEVO L'ELENCO DELLE UNIVERITA'////////////////
						/////////////////////////////////////////////////////////////////

						var callBackUni = function(data){

							console.log(data);

							if(!data.success){
								alert("Errore! " + data.errorMessage);
								return;
							}

							$("#universita").append("<option value=''>Seleziona l'università</option>");
							for(var i = 0;i < data.results.length;i++)
								$("#universita").append("<option value='"+data.results[i].id+"'>"+data.results[i].name+"</option>");

						}

						$.unisharing("Istitutes", "getUniversities", "private", {}, false, callBackUni);


						/////////////////////////////////////////////////////////////////////////
						/////////////// DEFINISCO L'AZIONE SULLA SCELTA DELL'UNI ////////////////
						////////////////////////////////////////////////////////////////////////
						$("#universita").on("change", function(){

							var uni = $(this).val();

							var callBackFaculties = function(data){

								if(!data.success){
									alert("Errore! " + data.errorMessage);
									return;
								}

								$("#facolta").html("");
								$("#facolta").append("<option value=''>Seleziona la facoltà</option>");
								for(var i = 0;i < data.results.length;i++)
									$("#facolta").append("<option value='"+data.results[i].id+"'>"+data.results[i].name+"</option>");

								}

							$.unisharing("Istitutes", "getFaculties", "private", {"university": uni}, false, callBackFaculties);

						});


						////////////////////////////////////////////////////////////////
						/////////// DEFINISCO IL SUBMIT DELLA FORM /////////////////////
						////////////////////////////////////////////////////////////////

						$("#btn-create-group").on("click", function() {

							console.log("HO CLICCATO SUL TASTO crea gruppo");

							var name = $("#name").val();
							var universita = $("#universita").val();
							var facolta = $("#facolta").val();
							var exam = $("#exam").val();
							var description = $("#description").val();
							var expirationDate = $("#expirationDate").val();
							var account = null; //INSERIRE COOKIE
							expirationDate

							$(".features").each(function(){
								if($(this).is(":checked"))
									features.push($(this).val());
							});

							/*
							// DATI DA INSERIRE PER IL TESTING
							name = "Lorenzo";
							surname = "Vitale"
							email = "l.vitale@live.it";
							password = "provapassword";
							confpassword = "provapassword";
							address = "via Repubblica, 2 ";
							universita = "1";
							bday = "2016-12-16";
							facolta = "1";
							description = "Mi piace IS";
							*/


							// CONTROLLO SE SONO STATI INSERITI CORRETTAMENTE I CAMPI RICHIESTI
							var message_err = "";
							var boo_err = false;

							if(!name){
								message_err += "Non è stato inserito il nome<br>";
								boo_err = true;
							}

							if(!universita){
								message_err += "Non è stata selezionata l'università<br>";
								boo_err = true;
							}

							if(!facolta){
								message_err += "Non è stata selezionata la facoltà<br>";
								boo_err = true;
							}

							if(boo_err){

								$.alert({
									title: 'Attenzione!',
									content: message_err
								});

								return;
							}



							var callBackGroupCreation = function(data){

								if(!data.success){
									alert("Errore! " + data.messageError);
									return;
								}


								$("#result_message").html('<center><br><div class="alert alert-success" style="font-size:34px;"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><br><br>Utente iscritto correttamente</div></center>');

							}

							var param = {
								"user": {
									"name": name,
									"universita":universita,
									"facolta":facolta,
									"description": description,
									"expirationDate": expirationDate,
									"account": account,
									"exam": exam,
									}
								}

							console.log("AAAA");
							console.log(param);

							$.unisharing("Group", "createGroup", "public", param, false, callBackGroupCreation);

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
      <div class="col-lg-2"></div>
			<div class="col-lg-8" id="result_message">
				<h1>Creazione Gruppo</h1>
				<div class="row-fluid">
					<div class="col-lg-12">
						<label>Nome gruppo</label>
						<input type="text" id="name" class="form-control" placeholder="Nome Gruppo" aria-describedby="basic-addon1" required>
					</div>
					<div class="col-md-6">
						<label>Università</label>
						<select id="universita" name="selectbasic" class="form-control">
						</select>
					</div>
					<div class="col-md-6">
						<label>Facoltà</label>
						<select id="facolta" name="selectbasic" class="form-control">
						</select>
					</div>
					<div class="col-lg-12">
						<label>Nome esame</label>
						<input type="text" id="exam" class="form-control" placeholder="Nome esame" aria-describedby="basic-addon1" required>
					</div>
					<div class="col-lg-12">
						<label>Descrizione</label>
						<textarea id="description" class="form-control" style="resize:vertical;height:250px;"></textarea>
					</div>
					<div class='col-lg-4'>
						<label>Scadenza gruppo</label>
						<input type="date" class="form-control" id="expirationDate" placeholder="" aria-describedby="basic-addon1">
					</div>
					<div class='col-lg-4'></div>
					<div class='col-lg-4'>
						<button class="btn btn-lg btn-primary btn-block" id="btn-create-group" style="margin-top:5%;">Crea Gruppo</button>
					</div>
				</div>


			</div>
      <div class="col-log-2"></div>
		</div>
	</div>
  <footer>

  </footer>

	</body>
</html>
