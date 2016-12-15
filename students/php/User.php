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
										'".$user["username"]."',
										'".$user["bday"]."',
										'".$user["cellulare"]."',
										'".$user["description"]."',
										'".$user["address"]."',
										'img/avatar/".$user["username"]."/icon.png'
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
		
			//Disconnetto dal database e restituisco il risultato
			$this->connect->disconnetti();
			return json_encode($objJSON);
		
		}
	
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
