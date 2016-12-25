<link href="css/navbar.css" rel="stylesheet" media="screen">
<?
	$cookie = json_decode($_COOKIE['user']);
?>
<header>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">UniSharing</a>
				<button class="navbar-toggle" data-toggle="collapse" data-target="#navHeaderCollapse" >
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="navHeaderCollapse">
				<ul class= "nav navbar-nav navbar-right">
					<li><a href="students/blacklist/index.php">Lista nera</a></li>
					<li><a href="students/ideallist/index.php">Lista compagni di studi</a></li>
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown">Gruppi <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="group\g_a\index.php">Gruppi che amministro</a></li>
                            <li class="divider"></li>
							<li><a href="group\g\index.php">Gruppi a cui partecipo</a></li>
						</ul>
					</li>
                    <li><a href="ranking\index.php">Classifica</a></li>
					<li><a href="contact\index.php">Contatti</a></li>
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
                                                	<img class="icon-size" src="<? echo($cookie->{"pathImage"}) ?>/icon80x80.jpg" ></img>
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
                                            	<a href="students\description\index.php" class="btn btn-primary btn-block btn-sm">Profilo</a>
                                        	</p>
                                    	</div>
                                	</div>
                            	</div>
                        	</li>
                        	<li class="divider navbar-login-session-bg"></li>
                         	<li><a href="students\modprofile\index.php">Impostazioni account<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
							<li class="divider"></li>
                            <li><a href="">Esci<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    	</ul>
                	</li>
				</ul>
			</div>
		</div>
	</nav>
</header>