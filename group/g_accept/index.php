<?
include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html><head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Unisharing</title>
	<script src="../../js/jquery.1.12.js"></script>
	<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/functions.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<script src="/js/jquery.balloon.js"></script>
	<script src="../js/main.js"></script>
	<link href="../../css/style.css" rel="stylesheet" media="screen">
	<link href="../css/group_style.css" rel="stylesheet" media="screen">
	<link href="../../css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
	<script>

	var mask_refusal;

	$(function(){


		// carico Mark_feedback
		$.get("../../presentation/group_accept.html", function(html){

			mask_accept = html;

			var idGruppo = "<? echo $_GET["g"]; ?>";

			// verifico se l'invito è valido
			var data = isInviteValid(idGruppo);

			if(data.success){

				$("#Mask_accept_group").html(mask_accept);
				$("#avatar").html("<img style='border-radius:40px;' src='../../"+data.results[0].pathImage_admin+"/icon80x80.jpg' />");
				$("#utente").html(data.results[0].name_admin+" "+data.results[0].surname_admin);
				$("#nome_gruppo").html(data.results[0].namegroup);
				$("#btn-conferma").attr("idGroup", data.results[0].idGroup);
				$("#btn-conferma").attr("admin", data.results[0].username_admin);

				//inizializzo i tasti
				initButtons();

			}else{

				var tmp = '<center><br>';
				tmp += '<div class="alert alert-danger">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Message").html(tmp);
			}
		});
	});
	</script>
</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8" id="Message"></div>
			<div class="col-lg-2"></div>
		</div>
		<div class= "row">
			<div class= "col-lg-2"></div>
			<div class= "col-lg-8" id="Mask_accept_group">
			</div>
			<div class= "col-lg-2"></div>
		</div>
	</div>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
</body>
</html>
