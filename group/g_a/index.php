<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>UniSharing</title>
        <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../../css/style.css" rel="stylesheet" media="screen">
        <link href="../css/group_style.css" rel="stylesheet" media="screen">
	</head>
	<body>
        <script src="../../js/jquery.1.12.js"></script>
    	<script src="js/bootstrap.min.js"></script>
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
          			<h2>Gruppi che amministro</h2>
          			<table class="table">
    					<thead>
      						<tr>
        						<th>Nome</th>
       					 		<th>Data scadenza</th>
                                <th>Attività</th>
      						</tr>
    					</thead>
    				<tbody>
      					<tr>
       						 <td>I magnifici 4</td>
       						 <td>16/05/2017</td>
                             <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                             </td>
      					</tr>      
                         <tr class="success">
                            <td>I disperati</td>
                            <td>20/10/2018</td>
                            <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                            </td>
                        </tr>
                        <tr class="danger">
                            <td>Il mio team</td>
                            <td>25/01/2018</td>
                            <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                            </td>
                        </tr>
                        <tr class="info">
                            <td>Help me</td>
                            <td>26/05/2017</td>
                            <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                            </td>
                        </tr>
                        <tr class="warning">
                            <td>Gli bestiammatori</td>
                            <td>28/03/2018</td>
                            <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Gli infelici</td>
                            <td>10/06/2018</td>
                            <td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a>
                            </td>
                        </tr>
    			 </tbody>
 				 </table>
       			</div>
        		<div class="col-lg-2"></div>
      		</div>
            
      </div>      
      
        <footer>
        </footer>

	</body>
</html>
