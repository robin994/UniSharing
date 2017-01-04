<?
	include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../../css/navbar.css" rel="stylesheet" media="screen">
        <link href="../../css/jquery.Jcrop.css" rel="stylesheet" media="screen">
        <link href="../css/students_style.css" rel="stylesheet" media="screen">
        <link href="../../css/footer.css" rel="stylesheet" media="screen">
        <script src="../../js/jquery.1.12.js"></script>
    	  <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
        <script src="../../js/jquery.Jcrop.min.js"></script>
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQwsDk4rP0FCWZ3OcbykddSb1wdYAvyLQ&libraries=places"></script>


        <link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
     	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>

		<script>

				var imageLoaded = {};
				var aspectRatio = 500/500;
				var dimW = 500;
				var dimH = 500;
				var boxWidth=500;
				var boxHeight=500;
				var emailOld = "";

				$(function() {





					$("#clickHere").on("click", function(){
						$("#file").trigger("change");
					});

					$("#file").on("change", function (e){

					  if(this.files && this.files[0]) {
						  	hideCoordinate();
							handleFiles(this.files);
							$("#drop-zone").css({"background":"none"});
						}
					 });


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

					////////////////////////////////////////////////////////////////
					/////////// RICERCA POSIZIONE UTENTE ///////////////////////////
					////////////////////////////////////////////////////////////////


					//CODICE DI ROBERTO
					/*
					var input = document.getElementById('indirizzo');
					var options = {
					  types: ['address'],
					  componentRestrictions: {country: 'it'}
					};

					var autocomplete = new google.maps.places.Autocomplete(input, options);
					var places = autocomplete.getplace();
					var latitude = places.geometry.location.lat();
					var longitude = places.geometry.location.lng();
					console.log(latitude);
					console.log(logitude);
					*/
					
					//CODICE DI GIUSEPPE
					google.maps.event.addDomListener(window, 'load', intilize);
						function intilize() {
							var autocomplete = new google.maps.places.Autocomplete(document.getElementById("indirizzo"));
							google.maps.event.addListener(autocomplete, 'place_changed', function () {
							var place = autocomplete.getPlace();
							//Istruzioni da fare solo se il campo indirizzo non è vuoto
							if (!$indirizzo.val()) {
								var lat = place.geometry.location.lat();
								var lng = place.geometry.location.lng();
								console.log(lat);
								console.log(lng);
							}
						});					
					};

					/////////////////////////////////////////////////////////////////
					/////////////// PRELEVO L'ELENCO DELLE UNIVERITA'////////////////
					/////////////////////////////////////////////////////////////////

					var callBackUni = function(data){
						console.log(data);

						if(!data.success){
							alert("Errore! " + data.messageError + " " + data.error);
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


						$.unisharing("Istitutes", "getFaculties", "private", {"university": uni}, false, callBackFaculties);

					});

					//////////////////////////////////////////////////////////////////////
					/////////// RECUPERO I DATI DEL VECCHIO PROFILO //////////////////////
					//////////////////////////////////////////////////////////////////////

					function callBackProfile(data){

						console.log(data);

						if (!data.success) {
							alert("Errore! " + data.messageError);
							return;
						}

						/* 		var universita = document.getElementById("universita");
								universita.value = data.idUniversity;
								var facolta = document.getElementById("facolta");
								facolta.value = data.idFaculty; */

						$("#description").html(data.description);
						$("#telephone").attr('value',data.telephone);
						$("#name").attr('value',data.name);
						$("#surname").attr('value',data.surname);
						$("#indirizzo").attr('value',data.address);
						document.getElementById("universita").selectedIndex = data.idUniversity;

						$.unisharing("Istitutes", "getFaculties", "private", {"university": data.idUniversity}, false, callBackFaculties);

						document.getElementById("facolta").selectedIndex = data.idFaculty;
						document.getElementById("tipo_studente").value = data.typeStudent;

						//$("#universita").append("<option value='"+data.idUniversity+"'>"+data.universita+"</option>");
						//$("#facolta").append("<option value='"+data.idFaculty+"'>"+data.facolta+"</option>");
						$("#email").attr('value',data.email);
						emailOld = data.email;
						$("#birthday").attr('value',data.birthOfDay);
						//$("#imagePath")attr('value',"<img src=\"../../"+data.pathImage+"\">");
						$('#cellulare').attr('value',data.telephone);
					}

						if($.cookie("user")){
							var cookie = JSON.parse($.cookie('user'));
							console.log(cookie.idUser);
							var idUser = cookie.idUser;
						}

						$.unisharing("User", "getProfile", "public", {"idUser":  idUser}, false, callBackProfile);


					////////////////////////////////////////////////////////////////
					/////////// DEFINISCO IL SUBMIT DELLA FORM /////////////////////
					////////////////////////////////////////////////////////////////

					$("#btn-modifica").on("click", function() {

						console.log("HO CLICCATO SUL TASTO ISCRIVITI");

						var name = $("#name").val();
						var surname = $("#surname").val();
						var email = $("#email").val();
						var password = $("#password").val();
						var confpassword = $("#confpassword").val();
						var bday = $("#bday").val();
						var address = $("#indirizzo").val();
						var cellulare = $("#cellulare").val();
						var universita = $("#universita").val();
						var facolta = $("#facolta").val();
						var description = $("#description").val();
						var tipo_studente = $("#tipo_studente").val();

						var features = [];

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

						if(!surname){
							message_err += "Non è stato inserito il cognome<br>";
							boo_err = true;
						}

						if(!email){
							message_err += "Non è stato inserita l'email<br>";
							boo_err = true;
						}

						if(!password){
							message_err += "Non è stato inserita la password<br>";
							boo_err = true;
						}


						if(password.length < 8 && password.length > 16) {
							message_err += "La lunghezza della password deve essere almeno di 8 caratteri e al più di 16<br>";
							boo_err = true;
						}

						if(password != confpassword){
							message_err += "Le password inserite non coincidono<br>";
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



						var callBackSignin = function(data){

							if(!data.success){
								alert("Errore! " + data.messageError);
								return;
							}


							$("#result_message").html('<center><br><div class="alert alert-success" style="font-size:34px;"><i class="glyphicon glyphicon-ok" style="font-size:22px;"/><br><br>Utente modificato correttamente</div></center>');

						}

						var param = {
							"user": {
								"name": name,
								"surname":surname,
								"univerista":universita,
								"facolta":facolta,
								"bday":bday,
								"email":email,
								"address": address,
								"cellulare":cellulare,
								"description": description,
								"tipo_studente": tipo_studente,
								"usernameOld":emailOld,
								"features": features
							},

							"account":{
								"username":email,
								"usernameOld":emailOld,
								"password":password
							},


							"image": imageLoaded
							}





						console.log("AAAA");
						console.log(param);

						$.unisharing("User", "modifyProfile", "private", param, false, callBackSignin);

					});
				});
			</script>

	</head>
	<body>
        <? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div class="container">
		<div class="row-fluid">
        	<div class="col-lg-2"></div>
			<div class="col-lg-8" id="result_message">
				<h1>Modifica del profilo</h1>
					<div class="row-fluid">
						<div class="form-group col-lg-6">
							<Label>Nome</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" id="name" class="form-control" placeholder="Nome" id="name" aria-describedby="basic-addon1" required>
							</div>
						</div>
						<div class="form-group col-lg-6">
							<Label>Cognome</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" id="surname" class="form-control" placeholder="Cognome" id="surname" aria-describedby="basic-addon1" required>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="form-group col-lg-12">
							<Label>Email</Label>
							<div class="input-group" style="width:100%;">
								<input type="text" id="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" required>
							</div>
						</div>
					</div>
                    <div class="row-fluid">
						<div class="form-group col-lg-12">
							<Label>Tipo di studente</Label>
							<div class="input-group" style="width:100%;">
								<select id="tipo_studente" class="form-control" required>
                                	<option value="corsista-fuorisede">Corsista fuori sede</option>
                                    <option value="corsista-pendolare">Corsista pendolare</option>
                                    <<option value="studente-lavoratore">Studente lavoratore</option>
                                </select>
							</div>
						</div>
					</div>
					<!-- DA FARE
										<div class="row-fluid">
                    	<div class="form-group col-lg-12">
                        	<div style="float:left;width:100%;" class="imageDropZone">
                                <div id="ritaglio">Carica l'immagine dell'avatar:</div>
                                <div id="drop-zone" style="width: 100%;">
                                 <input type="file" name="file" id="file" style="opacity: 1;filter: alpha(opacity=100);" accept="image/jpeg">
                                <div id="clickHere" class="button_input_form">carica l'immagine


                                </div>
                                </div>
                                </div>
                        </div>
                    </div> -->
						<div class="row-fluid">
								<div class="form-group col-lg-6">
								<Label>Password</Label>
									<div class="input-group" style="width:100%;">
										<input type="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" required>
									</div>
								</div>
								<div class="form-group col-lg-6">
								<Label>Conferma Password</Label>
									<div class="input-group" style="width:100%;">
										<input type="password" id="confpassword" class="form-control" placeholder="Conferma Password" aria-describedby="basic-addon1" required>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class='col-lg-8'>
									<label>Data di nascita</label>
										<input type="date" class="form-control" id="bday" placeholder="" aria-describedby="basic-addon1">
									</div>

						</div>
						<div class="row-fluid">
							<div class="form-group col-lg-6">
								<Label>Indirizzo</Label>
								<div class="input-group" style="width:100%;">
									<input type="text" id="indirizzo" class="form-control" placeholder="Indirizzo" aria-describedby="basic-addon1">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<Label>Cellulare</Label>
							<div class="input-group" style="width:100%;">
									<input type="text" id="cellulare" class="form-control" placeholder="Cellulare" aria-describedby="basic-addon1">
							</div>
						</div>
					</div>
                    <div class="row-fluid">
                    	<div class="col-md-12">
								<label>Descrizione</label>
								<textarea id="description" class="form-control" style="resize:vertical;height:250px;"></textarea>
						</div>
                    </div>
					<div class="row-fluid">
						<div class="col-md-12">
								<label>Università</label>
								<select id="universita" name="selectbasic" class="form-control">
								</select>
						</div>
						<div class="col-md-12">
								<label>Facoltà</label>
								<select id="facolta" name="selectbasic" class="form-control">

								</select>

						</div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-12">






                            <!-- FEATURES -->


                            <div id="advancedsearch" class="filter-panel collapse in" aria-expanded="true">
                    <div class="panel with-nav-tabs panel-default">
                    	<div class="panel-heading">
                    		<ul class="nav nav-tabs">
                     			<li class="active"><a href="#personality" data-toggle="tab">Personalità</a></li>
                                <li><a href="#knowledge" data-toggle="tab">Conoscenze</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                        	<div class="tab-content">
                        		<div class="tab-pane fade in active" id="personality">
                               	<div class="col-lg-6">
                                    	<div class="checkbox">
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="1" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Simpatico
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="2" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cordiale
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="4" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Diligente
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="checkbox">
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="3" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Socievole
                                                </label>
                                            </div>

                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="5" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Timido
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="6" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Estroverso
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                            	<div class="tab-pane fade" id="knowledge">
                               	<div class="col-lg-6">
                                    	<div class="checkbox">
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="7"  class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Informatica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="8"  class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Matematica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="9" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Fisica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="10" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Scienze
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="11" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Biologia
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="12" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chimica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="13" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Architettura
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="14" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Diritto ed Economia
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="checkbox">
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="15" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Geografia
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="16" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Storia e Filosofia
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="17" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lettere
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="18" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Latino e Greco
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="19" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inglese
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="20" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Francesce
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="21" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Spagnolo
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                </div>

                           	</div>
                    	</div>
                	</div>
                    </div>





                            <!-- fine FEATURES -->


                        </div>


                        <div class="col-md-12">
                        	<br>
								<button class="btn btn-lg btn-primary btn-block" id="btn-modifica">Conferma modifica</button>
                           	<br>
                        </div>
					</div>
				</div>
			</div>
            <div class="col-log-2"></div>
			<!--<div class="col-md-6">
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
			</div>-->
		</div>
	</div>

		<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>

	</body>
</html>


<script>


var dragAndDrop = function(){

		try{

			var dropbox;

			dropbox = document.getElementById("drop-zone");
			dropbox.addEventListener("dragenter", dragenter, false);
			dropbox.addEventListener("dragover", dragover, false);
			dropbox.addEventListener("drop", drop, false);

			function dragenter(e) {
			  e.stopPropagation();
			  e.preventDefault();
			}

			function dragover(e) {
			  e.stopPropagation();
			  e.preventDefault();
			}

			function drop(e) {
			  e.stopPropagation();
			  e.preventDefault();

			  var dt = e.dataTransfer;
			  var files = dt.files;

			  handleFiles(files);
			}
		}catch(e){

		}
	}

	var handleFiles = function(files) {
		 for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;


			var size = Number(file.size);
			if(size > 2097152 || size > 2097152){
				alert("L'immagine selezionata ha una dimensione che supera il massimo consentito di 2Mb");
				return;
			}

			if (!file.type.match(imageType)) {
			  continue;
			}


			var img = document.createElement("img");
			//img.setAttribute("style", "max-width:200px;");
			img.setAttribute("id", "_image");
			img.classList.add("obj");
			img.file = file;


			$("#drop-zone").html(img); // Assuming that "preview" is a the div output where the content will be displayed.
			$("#drop-zone").animate({"width":boxWidth, "height":boxHeight});
			$("#drop-zone").append("<div style='width:50px;height:50px;position:absolute;top:0px;right:0px;cursor:pointer;z-index:99999;' class='rimuovi_immagine'><i class=\"fa fa-close\" style=\"font-size:22px;position:absolute;top:10px;right:10px;\"></i></div>");

			var reader = new FileReader();
			reader.onload = (function(aImg) {
				return function(e) {
					aImg.src = e.target.result;

					$("#ritaglio").html("Ritaglia l'immagine");
					//$("#_image").Jcrop({aspectRatio: _this.aspectRatio, boxWidth:_this.boxWidth,boxHeight:_this.boxHeight, onSelect: _this.showCordinate});
					$("#_image").Jcrop(
						{
							boxWidth: boxWidth,
							boxHeight: boxHeight,
							onSelect:  showCordinate,
							onRelease:  hideCoordinate,
							aspectRatio: aspectRatio,
							bgColor: ""
						});

				};
			})(img);
			reader.readAsDataURL(file);


		  }
		}


	var showCordinate = function(c){

		imageLoaded.ritagliata = true;
		imageLoaded.cancellata = false;
		imageLoaded.caricata = true;

		if($(".obj").attr("src"))
			imageLoaded.image = $(".obj").attr("src").split(",")[1];

		imageLoaded.cx = c.x;
		imageLoaded.cy = c.y;
		imageLoaded.c2x = c.x2;
		imageLoaded.c2y = c.y2;
		imageLoaded.cw = c.w;
		imageLoaded.ch = c.h;

		////console.log(_this.imageLoaded);

	   $("#drop-zone").css({border:"1px solid #ccc"});
			try{
				//$("#drop-zone").hideBalloon();
			}catch(error){

			}


		$("#cx").val(c.x);
		$("#cy").val(c.y);
		$("#c2x").val(c.x2);
		$("#c2y").val(c.y2);
		$("#cw").val(c.w);
		$("#ch").val(c.h);
	}

	var hideCoordinate = function(){
		$("#cx").val("");
		$("#cy").val("");
		$("#c2x").val("");
		$("#c2y").val("");
		$("#cw").val("");
		$("#ch").val("");

		imageLoaded.ritagliata = false;
		imageLoaded.cancellata = false;
		imageLoaded.caricata = true;

		if($(".obj").attr("src"))
			imageLoaded.image = $(".obj").attr("src").split(",")[1];

		imageLoaded.cx = 0;
		imageLoaded.cy = 0;
		imageLoaded.c2x = 0;
		imageLoaded.c2y = 0;
		imageLoaded.cw = 0;
		imageLoaded.ch = 0;
		////console.log(_this.imageLoaded);

	}




</script>
