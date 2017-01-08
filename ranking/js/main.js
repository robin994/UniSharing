// JavaScript Document

function init() {
	$("#idRanking").html("");
	$("#SpanF").attr('style', 'display:none');
	$("#SpanU").attr('style', 'display:none');
	$("#SpanP").attr('style', '');
	$("#SpanP").attr('class', 'glyphicon glyphicon-triangle-bottom');
	var cresc = false;

	getRanking("score", cresc);
}


function orderByUser() {
	$("#idRanking").html("");
	$("#SpanF").attr('style', 'display:none');
	$("#SpanU").attr('style', '');
	$("#SpanP").attr('style', 'display:none');
	if (document.getElementById('SpanU').className  != "glyphicon glyphicon-triangle-top") {
		$("#SpanU").attr('class', 'glyphicon glyphicon-triangle-top');
		var cresc = "true";
	} else {
		$("#SpanU").attr('class', 'glyphicon glyphicon-triangle-bottom');
		var cresc = false;
	}
	getRanking("name", cresc);
}

function orderByScore() {
	$("#idRanking").html("");
	$("#SpanF").attr('style', 'display:none');
	$("#SpanU").attr('style', 'display:none');
	$("#SpanP").attr('style', '');

	if (document.getElementById('SpanP').className  != "glyphicon glyphicon-triangle-top") {
		$("#SpanP").attr('class', 'glyphicon glyphicon-triangle-top');
		var cresc = "true";
	} else {
		$("#SpanP").attr('class', 'glyphicon glyphicon-triangle-bottom');
		var cresc = false;
	}

	getRanking("score", cresc);
}


function orderByFeedback() {
	$("#idRanking").html("");
	$("#SpanF").attr('style', '');
	$("#SpanU").attr('style', 'display:none');
	$("#SpanP").attr('style', 'display:none');

	if (document.getElementById('SpanF').className  != "glyphicon glyphicon-triangle-top") {
		$("#SpanF").attr('class', 'glyphicon glyphicon-triangle-top');
		var cresc = "true";
	} else {
		$("#SpanF").attr('class', 'glyphicon glyphicon-triangle-bottom');
		var cresc = false;
	}

	getRanking("perc", cresc);
}


function getRanking(order, cresc){

	var param = {
		'orderBy': order,
		'cresc': cresc
	}
	console.log('AAAA');
	console.log(param);

	function callBackRanking(data) {
		waitingDialog.hide();
		console.log(data);
		if(!data.success){
			alert("Errore! " + data.errorMessage);
			return;
		}
		var tmp = "";
		for(var i = 0; i < data.results.length;i++){

			tmp += '<tr>';
			tmp +=  '<td>'+(i+1)+'</td>';
			tmp +=  '<td><a href="../../students/description/index.php?user='+data.results[i].id+'">'+data.results[i].name+' '+data.results[i].surname+'</a></td>';
			tmp +=  '<td>'+ data.results[i].score+ ' </td>';
			tmp +=	'<td>';
			tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5" style="float: right;">';

			// CREAZIONE STELLE PER IL RANKING
			var k=0;
			tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
			while (k < data.results[i].percent/20-1) {
				console.log(data.results[i].percent);
				tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
				k++;
			}
			if (data.results[i].percent/20 > Math.trunc(data.results[i].percent/20)) {
				tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
			} else {
				tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
			}
			k++;
			for (var j = 0; j<5-k;j++) {
				tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
			}
			tmp += '</div>';

		}

		$("#idRanking").append(tmp);
	}

	waitingDialog.show('Attendere',{dialogSize: 'sm',  onShow: function () {
		$.unisharing("Ranking" , "getRanking" , "private" , param, true, callBackRanking);
	}});
}
