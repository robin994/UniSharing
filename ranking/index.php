<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/style.css" rel="stylesheet" media="screen">
        <link href="css/group_style.css" rel="stylesheet" media="screen">
				<link href="css/ranking.css" rel="stylesheet" media="screen">

   	 	<script src="http://code.jquery.com/jquery-1.12.2.min.js"></script>
    	<script src="../js/bootstrap.min.js"></script>
       	<link rel="stylesheet"
          	type="text/css"
          	href="../js/jquery-confirm-master/dist/css/jquery-confirm.min.css"/>
    	<script type="text/javascript" src="../js/jquery-confirm-master/dist/jquery-confirm.min.js"></script>


		<script>


		// ONLOAD JQUERY
		$(function(){



			$(".btn_leave_g").on("click", function(e){

				    $.alert({
						title: 'Alert!',
						content: 'Simple alert!',
					});

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

        <div class="container">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
					<div class="bootstrap-demo">
	<table class="table table-striped">
	        <thead>
					<h1> Ranking </h1>

	        </thead>
	        <tbody>
						<h7> Clicca i nomi per visualizzare i profili sulla destra </h7><br><br>
	            <tr>
	                <td><i class="glyphicon glyphicon-chevron-up" style="color: green"></i></td>
									<td> 1 </td>
	                <td>Antonio Fasulo</td>
	                <td>91</td>
									<td><div id="stars-existing" class="starrr coloreStelle" data-rating="4"><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span></div></td>

CIAO
<br/></td>
	            </tr>
	            <tr>
								<td><i class="glyphicon glyphicon-chevron-down" style="color: red"></i></td>
	                <td>2</td>
	                <td>Anna Tomeo</td>
	                <td>20</td>
									<td><div id="stars-existing" class="starrr coloreStelle" data-rating="4"><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span></div></td>

<br/></td>
	            </tr>
	            <tr>
									<td><i class="glyphicon glyphicon-chevron-up" style="color: green"></i></td>
	                <td>3</td>
	                <td>Giuseppe Altobelli</td>
	                <td>40</td>
<td><div id="stars-existing" class="starrr coloreStelle" data-rating="4"><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span><span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span></div></td>
	            </tr>
	        </tbody>
	    </table>
			</div>
		</div>
		<div class="col-lg-2"></div>
      </div>

        <footer>
        </footer>

	</body>
</html>
