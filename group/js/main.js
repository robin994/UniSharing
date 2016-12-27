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
	
	
	$("#btn-conferma").unbind("click");
	$("#btn-conferma").bind("click", function(){
			
			
		var scelta = $(".accept:checked").val();
		
		// prelevo le informazioni
		var idGroup = $(this).attr("idGroup");
		var ratio = $("#ratio").val();
		var admin = $(this).attr("admin");
		
		switch(scelta){
			case 'accetto': acceptInvite(idGroup);break;
			case 'rifiuto': refusalInvite(idGroup, ratio);break;	
			case 'blacklist': addUserToBlackList(idGroup, admin);break;
		}
		
	});
	
	$(".accept").unbind("click");
	$(".accept").bind("click", function(){
			

		if($(this).val() == "rifiuto"){
			$("#ratio").css({display: "block"});
		}else
			$("#ratio").css({display: "none"});
			
	});
	
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
function isInviteValid(idGruppo, mask_refusal){
	
	var results = {
		success: false	
	}
	function callBackInviteValid(data){
		
		results = data;
	}
	
	$.unisharing("Group", "isInviteValid", "private", {"gruppo": idGruppo}, false, callBackInviteValid);

	return results;
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
			$("#Mask_accept_group").html(tmp);
		}
		
	}
	
	$.unisharing("Group", "refusalInvite", "private", {"gruppo": idGruppo, "ratio":message}, false, callBackRefusalInvite);

}



//// Metodo che rifiuta l'invito
function acceptInvite(idGruppo){
		
	var risultati = [];	
		
	function callBackAcceptInvite(data){
		
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
			tmp += '<span style="font-size:18px;">Hai accettato la partecipazione al gruppo correttamente</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Mask_accept_group").html(tmp);
		}
		
	}
	
	$.unisharing("Group", "acceptInvite", "private", {"gruppo": idGruppo}, false, callBackAcceptInvite);

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
					tmp +=		'<td><a href="../g_v/?g='+data.results[i].idGroup+'"><i class="glyphicon glyphicon-info-sign size_icon"></i></a></td>';
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


//// Metodo che aggiunge un utente alla propria blacklist
function addUserToBlackList(idGruppo, user){
		
	var risultati = [];	
		
	function callBlackAddBlacklist(data){
		
		console.log(data);
		
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
			tmp += '<span style="font-size:18px;">Hai inserito l\'utente nella tua blacklist correttamente</span>';
			tmp += '</div>';
			tmp += '</center>';
			$("#Mask_accept_group").html(tmp);
		}
		
	}
	
	$.unisharing("User", "addUserToBlackList", "private", {"gruppo": idGruppo, "user": user}, false, callBlackAddBlacklist);

}




