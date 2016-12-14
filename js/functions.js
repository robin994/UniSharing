/*
* Company: UNISHARING
* Author: Lorenzo Vitale
* date: Novembre 2016
*
*/

$(function(){
	
	// function send post request to server
	$.unisharing = function(classe, metodo, isPublic, dataJS, as, callback){
		"use strict";

		var url = "../../storage/proxy.php";
		
		dataJS.classe = classe;
		dataJS.metodo = metodo;
		
		
		console.log("QUI IL CONTENUTO DELLA CHIAMATA AD AJAX");
		console.log(dataJS);
		
		 return jQuery.ajax({
			 url: url,
			 type: 'POST',
			 async: as,
			 data: dataJS,
			 timeout: 150000,
			 dataType: 'json',
			 success: function(data){
				callback(data);
		 	},
			error: function(data){
				console.log("Errore: ");
				console.log(data.responseText);
			}
		});
	}

}); //fine juery.ready