<?

include "Account.php";

class User extends Account{

	//private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		//$this->connect = new ConnectionDB();
		
		// inizializzo la classe Account che estende
		$this->initialize();
		 
	}


	///////////////////////////////////////////////////////////
	/////////// METODO CHE EFFETTUA L'ISCRIZIONE //////////////
	///////////////////////////////////////////////////////////
	
	public function signin($post){
		
		$account = $post["account"];
		$user = $post["user"];
		
		// invoco il metodo esteso da Account per inserire l'account
		$objJSON = $this->saveAccount($account);
		
		//controllo se il metodo di Account ha restituito errore, in questo caso lo restituisco al client ed esco
		if(!$objJSON["success"]){
			return json_encode($objJSON);	
		}
		
		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();	
			
		//formulo la query di inserimento
		$query = "INSERT INTO _user (	name, 
										surname, 
										email, 
										birthOfDay, 
										telephone, 
										description, 
										address, 
										pathImage
										) VALUES (
										'".$user["name"]."',
										'".$user["surname"]."',
										'".$account["username"]."',
										'".$user["bday"]."',
										'".$user["cellulare"]."',
										'".$user["description"]."',
										'".$user["address"]."',
										'img/avatar/".$user["username"]."/'
										)";	
		
			
		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

		//Righe che gestiscono casi di errore di chiamata al database
		if($this->connect->errno()){

			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = $this->connect->error();

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);

		}else{

			//la chiamata ha avuto successo
			$objJSON["success"] = true;
			$objJSON["results"] = array();
		
			
			
			// creo l'avatar dell'utente
			if($post["imageLoaded"]["caricata"] == "true"){
			
				
				//se non esiste la cartella avatar la creo
				if(!is_dir("../img/avatar")){
					mkdir("../img/avatar");	
				}
				
				//se non esiste la cartella dell'utente la creo
				if(!is_dir("../img/avatar/".$account["username"])){
					mkdir("../img/avatar/".$account["username"]);	
				}
			
			
				$pathImage = base64_decode($post["imageLoaded"]["image"]);
				$jpeg_quality = 90;
				$img_r = imagecreatefromstring($pathImage);
				$dst_r = imagecreatetruecolor(250,250);
				imagecopyresampled($dst_r,$img_r,0,0,$post["imageLoaded"]['cx'],$post["imageLoaded"]['cy'],250,250, $post["imageLoaded"]['cw'],$post["imageLoaded"]['ch']);
				
				$dst_r2 = imagecreatetruecolor(80, 80);
				imagecopyresampled($dst_r2,$img_r,0,0,$post["imageLoaded"]['cx'],$post["imageLoaded"]['cy'],80,80, $post["imageLoaded"]['cw'],$post["imageLoaded"]['ch']);
				imagejpeg($dst_r2,"../img/avatar/".$account['username']."/icon80x80.jpg",$jpeg_quality);
			
				$dst_r3 = imagecreatetruecolor(40, 40);
				imagecopyresampled($dst_r3,$img_r,0,0,$post["imageLoaded"]['cx'],$post["imageLoaded"]['cy'],40,40, $post["imageLoaded"]['cw'], $post["imageLoaded"]['ch']);
				imagejpeg($dst_r3,"../img/avatar/".$account['username']."/icon40x40.jpg",$jpeg_quality);
			
			
				$objJSON =  array();	
				if(error_get_last()){
					$objJSON["success"] = false;
					$objJSON["messageError"] = error_get_last();
					return json_encode($objJSON);
				}
			}
			
		
		}
			
			
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	} 
	/////////// FINE METODO CHE EFFETTUA L'ISCRIZIONE /////////
	
	
	///////////////////////////////////////////////////////////
	/////////// METODO CHE EFFETTUA LA LOGIN //////////////////
	///////////////////////////////////////////////////////////
	
	/*public function login($post){

		
	}
	*/
	/////////// FINE METODO LOGIN /////////

}
?>
