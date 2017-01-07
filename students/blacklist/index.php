<?
include($_SERVER['DOCUMENT_ROOT']."/php/cookiescontrol.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UniSharing</title>
	<script src="../../js/jquery.1.12.js"></script>
	<link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../../css/footer.css" rel="stylesheet" media="screen">
	<link href="../../css/navbar.css" rel="stylesheet" media="screen">
	<script src="../../js/bootstrap.min.js"></script>
	<link href="css/ideal_style.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="../../js/jquery-confirm-master/jquery-confirm.min.css"/>
	<script type="text/javascript" src="../../js/jquery-confirm-master/jquery-confirm.min.js"></script>
	<script src="/js/jquery.balloon.js"></script>
	<script src="../../js/functions.js"></script>
	<script src="../../js/jquery.cookie.js"></script>
	<script src="../js/main.js"></script>
	<script src="../../js/bootstrap-waitingfor.js"></script>
	<script>
	$(function(){


		function callBackUser(data){
			waitingDialog.hide();
			console.log(data);

			if(!data.success){
				var tmp = '<center><br>';
				tmp += '<div class="alert alert-danger">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Message").html(tmp);
			}



			if(data.results.length <= 0) {
				var tmp = '<center><br>';
				tmp += '<div class="alert alert-warning">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">La lista nera è vuota</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Message").html(tmp);
			}else{


				var tmp = "<h2>Lista nera</h2>";
				tmp += "<table class=\"table\">";
				tmp += "<thead>";
				tmp += "<tr>";
				tmp += "<th class=\"colownsmall\"></th>";
				tmp += "<th></th>";
				tmp += "<th></th>";
				tmp += "</tr>";
				tmp += "</thead>";
				tmp += "<tbody>";

				for(var i = 0;i < data.results.length;i++){
					tmp += "<tr>";
					tmp += "<td><a href=\"../description/index.php?user="+data.results[i].id+"\"><img class=\"imageStyle\" src=\"../../"+data.results[i].pathImage+"/icon80x80.jpg\" style=\"border-radius:50px\"></a></td>";
					tmp += "<td><h5><a href=\"#\" class=\"user-link\">"+data.results[i].name+" "+data.results[i].surname+"</a></h5></td>";
					tmp += "<td><button class=\"removeUser btn btn-danger btn-xs\" user-subhead=\"\" user=\""+data.results[i].username+"\">";
					tmp += " Rimuovi";
					tmp += "<span class=\"glyphicon glyphicon-minus\"></span></button></td>";
					tmp += "</tr>";
				}

				tmp += "</tbody>";
				tmp += "</table>";

				$("#ris").html(tmp);

			}
		}

		waitingDialog.show('Attendere',{dialogSize: 'sm',  onShow: function () {
			$.unisharing("User", "getBlackList", "private", {}, true, callBackUser);
		}});


		$(".removeUser").on("click", function(){

			var sel_user = $(this).attr("user");
			removeFromBlackList(sel_user);

		});
	});
	</script>

</head>
<body>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/navbar.php"); ?>
	<div class: "container">
		<div class="row">
			<div class= "col-lg-3"></div>
			<div class= "col-lg-6" id="Message"></div>
			<div class= "col-lg-3"></div>
		</div>
		<div class: "row">
			<div class= "col-lg-3"></div>
			<div class= "col-lg-6" id="ris"></div>
			<div class= "col-lg-3"></div>
		</div>
	</div>
	<? include($_SERVER['DOCUMENT_ROOT']."/php/footer.php"); ?>
</body>
</html>
