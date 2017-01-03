// JavaScript Document


function getRanking(){


	function callBackRanking(data) {
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

				/*
				var k=0;
				while (k < data.results[i].percent/20-1) {
					console.log(k);
					console.log(data.results[i].percent/20);
					tmp += '<span class="star on"></span>';
					k++;
				}
				if (data.results[i].percent/20 > Math.trunc(data.results[i].percent/20)) {
					tmp += '<span class="star half"></span>';
				} else {
					tmp += '<span class="star on"></span>';
				}
				k++;
				for (var j = 0; j<5-k;j++) {
						tmp += '<span class="star"></span>';
				}
				*/

				// OTTIMIZZATO BY ROB
				if(data.results[i].percent > 0 && data.results[i].percent <= 10){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >10 && data.results[i].percent <= 20){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >20 && data.results[i].percent <= 30){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >30 && data.results[i].percent <= 40){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >40 && data.results[i].percent <= 50){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >50 && data.results[i].percent <= 60){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >60 && data.results[i].percent <= 70){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >70 && data.results[i].percent <= 80){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >80 && data.results[i].percent <= 90){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				if(data.results[i].percent >90 && data.results[i].percent <= 100){
					tmp += '<div id="stars-existing" class="starrr coloreStelle" data-rating="5">';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '<i class="fa fa-star" aria-hidden="true"></i>';
					tmp += '</div>';
				}

				tmp += '</td>';
				tmp += '</tr>';
		}

		$("#idRanking").append(tmp);
	}

	$.unisharing("Ranking" , "getRanking" , "private" , {}, false, callBackRanking);


}
