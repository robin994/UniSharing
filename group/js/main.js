// JavaScript Document

var idGroup;

function getGroup(mask_group){
	
	if($.cookie("user")){
		var user = JSON.parse($.cookie("user"));
		var param = {
			"account": user.username
		}
	}
		
	function callBackViewGroup(data){

		console.log(data);
		if(!data.success){
			alert("Errore: " + data.messageError);
			return;
		}
									  
		if(data.results.length <= 0){
			
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-warning">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">Non ci sono gruppi nei quali partecipi</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Mask_group").html(tmp);
			
		}else{
			
			$("#Mask_group").html(mask_group);
			
			var tmp= "";		
			for (var i=0; i<data.results.length; i++){
				console.log (data.results[i]);
				tmp += '<tr class="active">';
				tmp += 	'<td>'+data.results[i].name + " " +data.results[i].surname+'</td>'; 
				tmp +=  '<td>'+data.results[i].namegroup+'</td>';
				tmp += 	'<td>'+data.results[i].expirationDate+'</td>';
				tmp += 	'<td><a href="#"><i class="glyphicon glyphicon-info-sign size_icon"></i></a> ';
				tmp += 		'<a class="btn_leave_g" nome_gruppo="'+data.results[i].namegroup+'" idGroup="'+data.results[i].idGroup+'"><i class="glyphicon glyphicon-remove-sign size_iconremove"></i></a>';
				tmp += 	'</td>';
				tmp += '</tr>';
			}
			  
			$("#ris").html("");
			$("#ris").html(tmp);
			
			initButtons();
			
		}
	}
	
	$.unisharing("Group", "getPartecipateGroup", "private", param, false, callBackViewGroup);
			
			
}


function initButtons(){
	
	// Azione sul tasto "abbandona gruppo"
	$(".btn_leave_g").unbind("click");
	$(".btn_leave_g").bind("click", function(e){
	
		
		idGroup = $(this).attr("idGroup");
		
		var user = JSON.parse($.cookie("user"));
		
		var param = {
			"account": user.username
		}
		
		var nome_gruppo = $(this).attr("nome_gruppo");
		
		var content = '<select id="ratio" style="width:300px;">';	
			content += '<option>Mi dispiace! Non c\'è feeling con i membri del gruppo</option>';
			content += '<option>Ho deciso di interrompere gli studi per lavorare</option>';
			content += '<option>Ho fatto richiesta di trasferimento</option>';
			content += '<option>Non voglio più sostenere la prova d\'esame</option>';
			content += '</select>';
		
	   $.confirm({
			title: 'Stai per abbandonare il gruppo <br>'+nome_gruppo,
			content: 'Puoi comunicarci i motivi della scelta?<br>'+content,
			buttons: {
				confirm: function(e){
					
					var tmp = $.parseHTML($(this)[0].content);
					var idGroup = idGroup;
					var message = $("#ratio").val();
					leaveGroup(idGroup, message);	
					
				},
				cancel: function(){}
			}
	   });
	});
	
	
	$("#btn-rifiuta").unbind("click");
	$("#btn-rifiuta").bind("click", function(){
			
		// function che rifiuta l'invito
		var idGroup = $(this).attr("idGroup");
		var ratio = $("#ratio").val();
		
		refusalInvite(idGroup, ratio);
	});
	

}


function leaveGroup(idGruppo, message){
		
	function callBackLeaveGroup(data){
		
		if(!data.success){
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-danger">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Message").html(tmp);
			return;
		}
		
		location.reload();
	}
	
	$.unisharing("Group", "leaveGroup", "private", {"gruppo": idGroup, "ratio": message}, false, callBackLeaveGroup);
	
}


// metodo che vreifica la validità dell'invito
function isInviteValid(idGruppo, message){
		
	var risultati = [];	
		
	function callBackInviteValid(data){
		
		if(!data.success){
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-danger">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Message").html(tmp);
			boo = false;
		}
		
		risultati = data.results;
	
	}
	
	$.unisharing("Group", "isInviteValid", "private", {"gruppo": 1}, false, callBackInviteValid);
	
	return risultati;
}




//// Metodo che rifiuta l'invito
function refusalInvite(idGruppo, message){
		
	var risultati = [];	
		
	function callBackRefusalInvite(data){
		
		if(!data.success){
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-danger">';
			tmp += '<i class="glyphicon glyphicon-delete"/> ';
			tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Message").html(tmp);
		}else{
			var tmp = '<center><br>';
			tmp += '<div class="alert alert-success">';
			tmp += '<i class="glyphicon glyphicon-success"/> ';
			tmp += '<span style="font-size:18px;">Hai rifiutato la partecipazione al gruppo correttamente</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Mask_refusal_group").html(tmp);
		}
		
	}
	
	$.unisharing("Group", "refusalInvite", "private", {"gruppo": 1}, false, callBackRefusalInvite);

}




function getGroupByAdmin(){

	if($.cookie("user")){
		var user = JSON.parse($.cookie("user"));
		var param = {
			"account": user.username
		}
	}

	function callBackViewAdminGroup(data){

		if(data.results.length <= 0){
				
				var tmp = '<center><br>';
				tmp += '<div class="alert alert-warning">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">Non ci sono gruppi di cui sei amministratore</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Mask_group").html(tmp);
				
			}else{
				
				$("#Mask_group").html(mask_group);
				
				var tmp= "";
				for (var i=0; i<data.results.length; i++){
					console.log (data.results[i]);
					tmp +=	'<tr class= "active">';
					tmp +=		'<td>'+data.results[i].name+'</td>';
					tmp +=		'<td>'+data.results[i].creationDate+'</td>';
					tmp +=		'<td>'+data.results[i].expirationDate+'</td>';
					tmp +=		'<td>'+data.results[i].expirationInvite+'</td>';
					tmp +=		'<td><a href="INSERIRE LINK QUI"><i class="glyphicon glyphicon-info-sign size_icon"></i></a></td>';
					tmp +=	'</tr>';
				}
	
				$("#ris").html(tmp);
		}
	}

	
	 $.unisharing("Group", "getAdminGroup", "private", param, false, callBackViewAdminGroup);	
	
	
}



function getDetailGroup(idGroup, mask_group){
	

	var param = {
		"gruppo":idGroup
	}
				
	   function callBackDetailGroup(data){
		  
		  if(!data.success){
				var tmp = '<center><br>';
				tmp += '<div class="alert alert-danger">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">'+data.messageError+' '+data.error+'</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Message").html(tmp);
				return;
			}
		  
		  if(data.results.length <= 0){
				
				var tmp = '<center><br>';
				tmp += '<div class="alert alert-warning">';
				tmp += '<i class="glyphicon glyphicon-delete"/> ';
				tmp += '<span style="font-size:18px;">Nessun gruppo trovato</span>';
				tmp += '</div>';
				tmp += '</center>';
				$("#Mask_view_group").html(tmp);
				
			}else{
				
				$("#Mask_view_group").html(mask_group);
				
				$("#nome_gruppo").html(data.results[0].nameGroup);
				$("#nome_gruppo").html(data.results[0].nameGroup);
				$("#uni_gruppo").html(data.results[0].name_university);
				$("#facolta_gruppo").html(data.results[0].name_faculty);
				$("#esame_gruppo").html(data.results[0].name_exam);
				$("#admin_gruppo").html(data.results[0].admin_name + " "+ data.results[0].admin_surname);
				$("#description_gruppo").html(data.results[0].description);
				
				
				var tmp = "";
				for(var i = 0;i < data.results[0].partecipate.length;i++){
					tmp += "<tr>";
					tmp += "<td>"+data.results[0].partecipate[i].name+"</td>";
             		tmp += "<td>"+data.results[0].partecipate[i].surname+"</td>";
					
					if(Number(data.results[0].partecipate[i].accepted) > 0)
             			tmp += "<td><span class='label label-success'>Accettato</span></td>";
						else
						tmp += "<td><span class='label label-danger'>Attesa</span></td>";
						
        			tmp += "</tr>";
				}	
				
				$("#ris_partecipate").html(tmp);
				
			}
	  }
	  
	   $.unisharing("Group", "getDetailsGroup", "private", param, false, callBackDetailGroup);
	  
}



