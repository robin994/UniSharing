<?
	$cookie = json_decode($_COOKIE['user']);
?>
<header>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/research/home/index.php" class="navbar-brand" style="margin-top: -12px;"><img src="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/img/logo.png" width="150"></a>
				<button class="navbar-toggle" data-toggle="collapse" data-target="#navHeaderCollapse" >
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navHeaderCollapse">
				<ul class= "nav navbar-nav navbar-right">
					<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/students/blacklist/index.php">Lista nera</a></li>
					<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/students/ideallist/index.php">Lista compagni di studi <span class="badge" id="numIdealList"></span></a></li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Gruppi <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/group/g_a/index.php">Gruppi che amministro</a></li>
                            <li class="divider"></li>
							<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/group/g/index.php">Gruppi a cui partecipo</a></li>
						</ul>
					</li>
                    <li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/ranking/index.php">Classifica</a></li>
					<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/contact/index.php">Contatti</a></li>
                    <li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        	<span class="glyphicon glyphicon-user"></span>
                        	<?
								//cosa molto molto scorretta
								echo($cookie->{"name"});
								echo(" ");
								echo($cookie->{"surname"});
							?>
                        	<b class="caret"></b>
                    	</a>
                    	<ul class="dropdown-menu">
                        	<li>
                            	<div class="navbar-login">
                               	 	<div class="row">
                                    	<div class="col-lg-4">
                                        	<p class="text-center">
                                            	<span>
                                                	<img id="image" class="icon-size" src="<? echo "http://".$_SERVER["HTTP_HOST"]."/".$cookie->{"pathImage"}; ?>/icon80x80.jpg" ></img>
                                                 </span>
                                        	</p>
                                    	</div>
                                    	<div class="col-lg-8">
                                        	<p class="text-left">
                                            	<strong>
													<?
                                                        //cosa molto molto scorretta
                                                        echo($cookie->{"name"});
                                                        echo(" ");
                                                        echo($cookie->{"surname"});
                                                    ?>
                                                </strong>
                                             </p>
                                        	<p class="text-left small">
                                            	<?
                                                 	//cosa molto molto scorretta
                                                	echo($cookie->{"username"});
                                            	?>
                                            </p>
                                        	<p class="text-left">
                                            	<a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/students/description/index.php?user=<? echo($cookie->{"idUser"})?>" class="btn btn-primary btn-block btn-sm">Profilo</a>
                                        	</p>
                                    	</div>
                                	</div>
                            	</div>
                        	</li>
                        	<li class="divider navbar-login-session-bg"></li>
                         	<li><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/students/modprofile/index.php">Impostazioni account<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
							<li class="divider"></li>
                            <li><a href="" id="logout">Esci<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    	</ul>
                	</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
<script>

$(function(){



	$("#logout").on("click", function(){
		$.removeCookie("user", {path: "/", domain: window.location.hostname});
		$.removeCookie("listaUtenti", {path: "/", domain: window.location.hostname});
	});

	//aggiorna i badge
	$.aggiornaBadge();

});

</script>
