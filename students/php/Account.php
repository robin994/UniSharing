<?

class Account{
	
	protected $connect;
	
	protected function initialize(){
		
		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();
		
		//definisco la chiave di cript
		define("SALT","unisharing2016");	
		
	}
	
	
	protected function login($post){
		
	}
	
	protected function saveAccount($post){
		
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		//cripto la password
		$password_criptata = md5(SALT.$post["password"]);
		
		//formulo la query di inserimento
		$query = "INSERT INTO _account (username, password) VALUES ('".$post["username"]."', '".$password_criptata."')";
		
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
			
			$objJSON["success"] = true;
				
		}
		
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
		
	}
	

}


?>