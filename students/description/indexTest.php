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
  <link href="../../css/footer.css" rel="stylesheet" media="screen">
  <link href="../../css/navbar.css" rel="stylesheet" media="screen">
  <script src="../../js/jquery.1.12.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/functions.js"></script>
  <script src="../../js/jquery.cookie.js"></script>
  <link href="css/descriptionTest.css" rel="stylesheet" media="screen">
  <script src="../../js/bootstrap-waitingfor.js"></script>
  <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">
  <script>

  $(document).ready(function() {
    var $btnSets = $('#responsive'),
    $btnLinks = $btnSets.find('a');

    $btnLinks.click(function(e) {
      e.preventDefault();
      $(this).siblings('a.active').removeClass("active");
      $(this).addClass("active");
      var index = $(this).index();
      $("div.user-menu>div.user-menu-content").removeClass("active");
      $("div.user-menu>div.user-menu-content").eq(index).addClass("active");
    });
  });

  $( document ).ready(function() {
    $("[rel='tooltip']").tooltip();

    $('.view').hover(
      function(){
        $(this).find('.caption').slideDown(250); //.fadeIn(250)
      },
      function(){
        $(this).find('.caption').slideUp(250); //.fadeOut(205)
      }
    );
  });

  $( function() {
    //data è il json restituito dal metodo chiamato nella funzione unisharing
    function callBackDescription(data){
      waitingDialog.hide();
      console.log("DATI");
      console.log(data);

      $("#description").html(data.description);
      $("#telephone").html(data.telephone);
      $("#nomeCompleto").html(data.name +  " " +data.surname);
      $("#address").html(data.address);
      $("#universita").html(data.universita);
      $("#facolta").html(data.facolta);
      $("#email").html(data.email);
      $("#birthday").html(data.birthOfDay);
      $("#imagePath").attr('src',"../../"+data.pathImage+"/icon250x250.jpg");
      $("#typeStudent").html(data.typeStudent);
      $("#score").html(data.score);
      $("#numberOfFeedback").html(data.numberOfFeedback);
      $('#avarage').html(data.percent + "%");
      //console.log(data.pathImage);


      var tmp = "";
      console.log(data.features);

      //STAMPA FEATURES

      for (var i = 0;i < data.features.length; i++) {
        tmp += "<div class=\"col-lg-6\">";
        tmp += "	<div class=\"row\" style=\"margin-bottom: 2px\">";
        tmp += "		<p>";
        //tmp += "		<input type=\"checkbox\" value=\'"+data.features[i].idFeature+"\' class=\"features\">";
        tmp += 		  data.features[i].label;
        tmp += "		</p>";
        tmp += "	</div>";
        tmp += "</div>";
        if (data.features[i].idFeature > 6) {
          $("#knowledge").append(tmp);
        } else {
          $("#personality").append(tmp);
        }
        tmp = "";
      }

      // STAMPA FEEDBACK

      tmp = "";

      for (var i = 0;i < data.results.length; i++) {
        var ratingAverage = (parseFloat(data.results[i]["f1"])
        + parseFloat(data.results[i]["f2"])
        + parseFloat(data.results[i]["f3"])
        + parseFloat(data.results[i]["f4"]))  / 4;
        tmp += '<div class="panel panel-default">';
        tmp += '	<div class="panel-heading">'+data.results[i]["author"];
        tmp += '	<span class="view-stars pull-right">';
        for (var j = 0 ; j < ratingAverage -1 ; j++) {
          tmp += 		'<span class="glyphicon glyphicon-star"></span>';
        }
        if (ratingAverage > parseInt(ratingAverage)) {
          tmp += '<span class="glyphicon glyphicon-star half"></span>';  //mezza stella se superiore alla media
        } else {
          tmp += '<span class="glyphicon glyphicon-star"></span>';
        }
        tmp += '</span>';
        tmp += '</div>';
        tmp += '		<div class="panel-body">';
        tmp += 			data.results[i]["comment"];
        tmp += '	</div>';
        tmp += '</div>';
      }
      console.log(data.results.length);
      console.log(data.results);
      if (data.results.length == 0) {
        tmp += '  <div class="panel panel-default">';
        tmp += '	<div class="panel-heading">Ancora nessun feedback disponibile';
        tmp += '	<span class="view-stars pull-right">';
      }

      //console.log(tmp);
      $("#feedbacks").html(tmp);
    }

    var idUser = 0;
    var cookie = JSON.parse($.cookie('user'));
    console.log(cookie.idUser);
    var idUser = cookie.idUser;
    var url = new URL(window.location.href );
    var params = url.searchParams;

    // Access to a variable
    console.log(params.get("user"));
    var idUser = params.get("user");

    waitingDialog.show('Attendere',{dialogSize: 'sm',  onShow: function () {
      $.unisharing("User", "getProfile", "public", {"idUser":  idUser}, true, callBackDescription);
    }});
  });
  </script>
</head>
<body>
  <? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<? echo "http://".$_SERVER["HTTP_HOST"]; ?>/research/home/index.php">Home</a></li>
    <li class="breadcrumb-item active">Profilo utente</li>
  </ol>

  <!-- CODICE DI PROVA -->

  <div class="container">
    <div class="row user-menu-container square">
      <div class="col-md-7 user-details">
        <div class="row coralbg white">
          <div class="col-md-6 no-pad">
            <div class="user-pad">
              <h3 id="nomeCompleto">Welcome back, Jessica</h3>
              <h4 id="universita" class="white"></h4>
              <h4 id="facolta" class="white"></h4>
            </div>
          </div>
          <div class="col-md-6 no-pad">
            <div class="user-image">
              <img id ="imagePath" src="" class="img-responsive thumbnail">
            </div>
          </div>
        </div>
        <div class="row overview">
          <div class="col-md-4 user-pad text-center">
            <h3>SCORE</h3>
            <h4 id="score"></h4>
          </div>
          <div class="col-md-4 user-pad text-center">
            <h3>AVARAGE</h3>
            <h4 id="avarage"></h4>
          </div>
          <div class="col-md-4 user-pad text-center">
            <h3>REVIEW</h3>
            <h4 id="numberOfFeedback"></h4>
          </div>
        </div>
      </div>
      <div class="col-md-1 user-menu-btns">
        <div class="btn-group-vertical square" id="responsive">
          <a href="#" class="btn btn-block btn-default active">
            <i class="fa fa-bell-o fa-3x"></i>
          </a>
          <a href="#sharing" class="btn btn-default">
            <i class="fa fa-envelope-o fa-3x"></i>
          </a>
          <a href="#" class="btn btn-default">
            <i class="fa fa-laptop fa-3x"></i>
          </a>
          <a href="#" class="btn btn-default">
            <i class="fa fa-cloud-upload fa-3x"></i>
          </a>
        </div>
      </div>
      <div class="col-md-4 user-menu user-pad">
        <div class="user-menu-content active">
          <h3>
            Info utente
          </h3>
          <div class="row">
            <div class="col-lg-12">
              <label>Email</label>
              <p id="email"></p>
            </div>
            <div class="col-lg-12">
              <label>Indirizzo</label>
              <p id="address"></p>
            </div>
            <div class="col-lg-6">
              <label>Tipo di Studente</label>
              <p id="typeStudent"></p>
            </div>
            <div class="col-lg-6">
              <label>Telefono</label>
              <p id="telephone">T</p>
            </div>
            <div class="col-lg-12" >
              <label>Data di nascita</label>
              <p id="birthday"></p>
            </div>
          </div>
        </div>
        <div class="user-menu-content">
          <h3>
            Descrizione
          </h3>
          <p id="description"> <!--DESCRIZIONE UTENTE -->
          </p>
        </div>
        <div class="user-menu-content">
          <h3>
            Personalità
          </h3>
          <div class="tab-pane fade in active" id="personality">
            <!-- qui le personalita'-->
          </div>
        </div>
        <div id="sharing" class="user-menu-content">
          <h3>
            Conoscenze
          </h3>
          <div class="tab-pane fade in active" id="knowledge">
            <!-- qui le conoscenze'-->
          </div>
        </div>
      </div>

      <div class="row"> <!-- FEEDBACK utenti -->
        <div class="col-lg-12">
          <br>
          <label>Feedbacks</label>
          <div id="feedbacks">
            <!--Spazio dedicato ai feedbacks -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CODICE VECCHIO -->


  <? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>

</body>
</html>
