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
        <link href="../css/research.css" rel="stylesheet" media="screen">
        <link href="../../css/footer.css" rel="stylesheet" media="screen">
        <link href="../../css/navbar.css" rel="stylesheet" media="screen">
        <script src="../../js/jquery.1.12.js"></script>
    	<script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/functions.js"></script>
        <script src="../../js/jquery.cookie.js"></script>
        <script>
			$(function() {
				$("#btn-start-research").on("click", function() {
					
					$("#Message").html("");
					
					console.log("HO CLICCATO SUL TASTO DELLA RICERCA");
					
					var arr_features = [];
					var parolachiave = $("#parolachiave").val();
					var boo = false;
					
					
					$(".features").each(function(){
						if($(this).is(":checked")){
							arr_features.push({"features": $(this).val()});
							boo = true;
						}
					});
					console.log(arr_features);
					if(!boo){
							var tmp = '<center><br>';
							tmp += '<div class="alert alert-warning">';
							tmp += '<i class="glyphicon glyphicon-delete"/> ';
							tmp += '<span style="font-size:18px;">Non hai selezionato nessuna caratteristica</span>';
							tmp += '</div>';
							tmp += '</center>';
							$("#Message").html(tmp);
							$("#ris").html("");
							return;
					}
					function callBackUsers(data){
						
						if(!data.success){
							var tmp = '<center><br>';
							tmp += '<div class="alert alert-danger">';
							tmp += '<i class="glyphicon glyphicon-delete"/> ';
							tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
							tmp += '</div>';
							tmp += '</center>';							
							$("#Message").html(tmp);
							$("#ris").html("");
							return;
						}
						
						if(data.results.length <= 0){
							var tmp = '<center><br>';
							tmp += '<div class="alert alert-warning">';
							tmp += '<i class="glyphicon glyphicon-delete"/> ';
							tmp += '<span style="font-size:18px;">Nessun utente trovato con le caratteristiche indicate</span>';
							tmp += '</div>';
							tmp += '</center>';							
							$("#Message").html(tmp);
							$("#ris").html("");
							return;
						}
	
						var tmp = "";
						for(var i = 0; i < data.results.length;i++){
							console.log(data.results[i]);
							tmp += '<div class="col-lg-4">';
							tmp += '<table class="table user-list">';
							tmp += 	'<tbody>';
							tmp += 		'<tr>';
							tmp += '			<td>';
							tmp += '				<img src="../../'+data.results[i]["pathImage"]+'/icon80x80.jpg" style="border-radius: 50px; float:left; margin-right: 3%; width: 80px; height: 80px" alt="">';
							tmp += '				<h5><a href="" class="user-link">'+data.results[i]["name"]+' '+data.results[i]["surname"]+'</a></h5>';
							tmp += '				<button class="addUser btn btn-success btn-xs" user-subhead" name="'+data.results[i]["name"]+'" surname="'+data.results[i]["surname"]+'" pathImage="'+data.results[i]["pathImage"]+'" username="'+data.results[i]["username"]+'">Aggiungi        <span class="glyphicon glyphicon-plus"></span></button>';
							tmp += '			</td>';
							tmp += '		</tr>';
							tmp += '	</tbody>';
							tmp += '</table>';
							tmp += '</div>';
						}
						$("#ris").html("");
						$("#ris").html(tmp);
						
						//creo un cookie listaUtenti dove salvo le informazioni degli utenti che aggiungo alla lista dei compagni di studio ideali
						$(".addUser").on("click", function() {	
							
							$("#Message").html("");
							
							if($.cookie("listaUtenti")){							
								var cookie_lista = JSON.parse($.cookie("listaUtenti"));
							
								if(cookie_lista.length < 10) {
									var nome = $(this).attr("name");
									var cognome = $(this).attr("surname");
									var pathImmagine = $(this).attr("pathImage");
									var usernome = $(this).attr("username");
									var boopresente = false;
									
									for (var i=0; i<cookie_lista.length; i++) {
										if(usernome == cookie_lista[i]["username"]) {
											boopresente = true;
										}
									}
									if (boopresente == true) {
										var tmp = '<center><br>';
											tmp += '<div class="alert alert-warning">';
											tmp += '<i class="glyphicon glyphicon-delete"/> ';
											tmp += '<span style="font-size:18px;">Hai già inserito questo utente nella lista dei compagni ideali</span>';
											tmp += '</div>';
											tmp += '</center>';
										$("#Message").html(tmp);
										return;
									} else {
										cookie_lista.push({
											"name": nome,
											"surname": cognome,
											"pathImage": pathImmagine,
											"username": usernome										
										});
									$.cookie('listaUtenti', JSON.stringify(cookie_lista), { path: '/', domain: 'localhost', expires: 60 });
									$.aggiornaBadge();
									}									
								} else {
									var tmp = '<center><br>';
										tmp += '<div class="alert alert-warning">';
										tmp += '<i class="glyphicon glyphicon-delete"/> ';
										tmp += '<span style="font-size:18px;">Hai inserito più di 10 utenti nella lista dei compagni ideali</span>';
										tmp += '</div>';
										tmp += '</center>';
									$("#Message").html(tmp);
									return;
								}									
							}else{
								var cookie_lista = [];
								var name = $(this).attr("name");
								var surname = $(this).attr("surname");
								var pathImage = $(this).attr("pathImage");
								var username = $(this).attr("username");
								var cookie = {
									"name": name,
									"surname": surname, 
									"pathImage": pathImage,
									"username": username
								}
								cookie_lista.push(cookie);
								$.cookie('listaUtenti', JSON.stringify(cookie_lista), { path: '/', domain: 'localhost', expires: 60 });	
								
								$.aggiornaBadge();
							
							}
						})				
					}
					$.unisharing("Research", "researchUsers", "private", {"features":  arr_features, "parolachiave": parolachiave}, false, callBackUsers);

				});
			});
		</script>
	</head>
	<body>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
        <div id="container">
        	<div class="row">
            	<div class="col-lg-4"></div>
                <div class="col-lg-4" id="Message"></div>
                <div class="col-lg-4"></div>
           	</div>
            <div class="row">
            	<div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                	<center><img src="../../img/logo.jpg" class="img-responsive" alt="logo"></center>
                    <div class="input-group">
                  	<input type="text" class="form-control" placeholder="Search" id="parolachiave">
                  	<span class="input-group-btn">
                    	<button class="btn btn-default" id="btn-start-research" type="button">Avvia</button>
                  	</span>
                	</div>
                    <h5 style="text-align:right"><a href="#advancedsearch" data-toggle="collapse">ricerca avanzata</a></h5>
                    <div id="advancedsearch" class="collapse filter-panel">
                    <div class="panel with-nav-tabs panel-default">
                    	<div class="panel-heading">
                    		<ul class="nav nav-tabs">
                     			<li class="active"><a href="#personality" data-toggle="tab">Personalità</a></li>
                                <li><a href="#knowledge" data-toggle="tab">Conoscenze</a></li>
                               	<li><a href="#geolocalizzazione" data-toggle="tab">Geolocalizzazione</a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                        	<div class="tab-content">
                        		<div class="tab-pane fade in active" id="personality">
                               	<div class="col-lg-6">
                                    	<div class="checkbox">
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Simpatico" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Simpatico
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Cordiale" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Cordiale
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Diligente" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Diligente
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="checkbox">
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Socievole" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Socievole
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Timido" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Timido
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="" class="features">
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
                                                    <input type="checkbox" value="Timido" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Informatica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Matematica" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Matematica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox"  value="Fisica" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Fisica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Scienza" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Scienze
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="Biologia" class="features">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Biologia
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chimica
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Architettura
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Diritto ed Economia
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                	<div class="col-lg-6">
                                    	<div class="checkbox">
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Geografia
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Storia e Filosofia
                                                </label>
                                            </div>
                                        	<div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lettere
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Latino e Greco
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Inglese
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Francesce
                                                </label>
                                            </div>
                                            <div class="row" style="margin-bottom: 2px">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Spagnolo
                                                </label>
                                            </div>
                                        </div>
                                	</div>
                                </div>
                            	<div class="tab-pane fade" id="geolocalizzazione">
                                	<div class="col-lg-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Attiva
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    	<div class="input-group">
                                        	<input type="number" class="form-control" placeholder="Chilometri di distanza" disabled>
                                        </div>
                                    </div>
                                </div>
                           	</div>
                    	</div>
                	</div>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
            <!-- RISULTATI DELLA RICERCA -->
            <div class="row">
            		<div class="col-lg-2"></div>
                    <div class="col-lg-8" id="ris"></div>
                    <div class="col-lg-2"></div>
            </div>
        </div>
		<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
	</body>
</html>
