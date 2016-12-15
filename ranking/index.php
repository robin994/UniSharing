<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
 				<script src="../../js/jquery.1.12.js"></script>
				<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/style.css" rel="stylesheet" media="screen">
  		<script src="../../js/functions.js"></script>
				<link href="css/ranking.css" rel="stylesheet" media="screen">


    	<script src="../js/bootstrap.min.js"></script>



		<script>


		// ONLOAD JQUERY
		$(function(){


				function callBackRanking(data) {
						console.log(data);

						if(!data.success){
							alert("Errore! " + data.errorMessage);
							return;
						}

						var tmp = "";
						for(var i = 0; i < data.results.length;i++){
							console.log(data.results[i]);
							tmp += '<tr>';
							tmp +=  '<td>'+(i+1)+'</td>';
	            tmp +=  '<td>'+data.results[i].name+' '+data.results[i].surname+'</td>';
	            tmp +=  '<td>'+ data.results[i].score+ ' </td>';
							tmp +=	'<td>';

							/*tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
							tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
							tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
							tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
							tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
							tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
							tmp += '</div>';
*/

							console.log(data.results[i].percent);
							if(data.results[i].percent > 0 && data.results[i].percent <= 20){
								tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '</div>';
							}

	/*

							if(data.results[i].percent >20 && data.results[i].score <= 40){
								tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '</div>';
							}

							if(data.results[i].percent >40 && data.results[i].score <= 60){
								tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '</div>';
							}

							if(data.results[i].percent >60 && data.results[i].score <= 80){
								tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
								tmp += '</div>';
							}

							if(data.results[i].percent >80 && data.results[i].score <= 100){
								tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
								tmp += '</div>';
							}
*/
							tmp += '</td>';
						  tmp += '</tr>';

				}

				$("#idRanking").append(tmp);
		}
		$.unisharing("Ranking" , "getRanking" , "private" , {}, false, callBackRanking);

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
					<h7> Clicca i nomi per visualizzare i profili sulla destra </h7><br><br>
					<tbody id="idRanking">

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
