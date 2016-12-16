<?


class Account{
	
	protected $connect;
	
	// costruttore della classe
	protected function __construct(){}
	
	// metodo di inizializzazione
	protected function initialize(){
		
		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();
		
		//definisco la chiave di cript
		define("SALT","unisharing2016");	
		
	}
	
	
	///////////////////////////////////////////////////////////
	/////// METODO CHE VERIFICA L'ESISTENZA DI UN ACCOUNT /////
	///////////////////////////////////////////////////////////
	
	private function accountExist($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		// creo la query in sql
		$query = "SELECT username FROM _account WHERE username = '".$post["username"]."' LIMIT 1";

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
			
			$cont = 0;
			
			//itero i risultati ottenuti dal metodo
			while($rows = mysqli_fetch_array($result)){
				$objJSON["results"][$cont]["idUser"] = $rows["idUser"];
				$objJSON["results"][$cont]["username"] = $rows["username"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$objJSON["results"][$cont]["surname"] = $rows["surname"];
				$objJSON["results"][$cont]["pathImage"] = $rows["pathImage"];
				$cont++;
			}

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return $objJSON;
		
	}
	
	
	///////////////////////////////////////////////////////////
	/////// METODO CHE PERMETTE L'ACCESSO /////////////////////
	///////////////////////////////////////////////////////////
	
	protected function access($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		//Costruisco la select prelevando tutte l'username e la password
		$user = $post["user"]["username"];
		$pass = $post["user"]["password"];

		// controllo se username e password sono state inserite
		if(!$user || !$pass){
			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = "errore di inserimento dei dati";

			// disconnetto
			$this->connect->disconnetti();
			return json_encode($objJSON);
		}

		
		//cripto la password inserita da confrontare nel db
		$password_criptata = md5(SALT.$pass);

		// creo la query in sql
		$query = "SELECT _account.username, _user.* FROM _account, _user WHERE _account.username = _user.email AND (username = '".$user."' AND password ='".$password_criptata."')";

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

			$cont = 0;

			//itero i risultati ottenuti dal metodo
			while($rows = mysqli_fetch_array($result)){
				$objJSON["results"][$cont]["idUser"] = $rows["idUser"];
				$objJSON["results"][$cont]["username"] = $rows["username"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$objJSON["results"][$cont]["surname"] = $rows["surname"];
				$objJSON["results"][$cont]["pathImage"] = $rows["pathImage"];
				$cont++;
			}
		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
		
	}
	
	///////////////////////////////////////////////////////////
	/////// METODO CHE SALVA L'ACCOUNT ////////////////////////
	///////////////////////////////////////////////////////////
	
	protected function saveAccount($post){
		
		//verifico se l'utente esiste già
		$objJSON = $this->accountExist($post);
		if($objJSON["success"]){
			if(count($objJSON["results"]) > 0){
				$objJSON_NEW["success"] = false;
				$objJSON_NEW["messageError"] = "Utente già presente nel database";
				return $objJSON_NEW;
			}
		}
		
		
		
		
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