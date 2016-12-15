<?

class Group {

	//private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		//$this->connect = new ConnectionDB();
		
		// inizializzo la classe Account che estende
		$this->initialize();
		 
	}


	///////////////////////////////////////////////////////////
	/////////// METODO CHE PERMETTE L'ABBANDONO  //////////////
	///////////////////////////////////////////////////////////
	
	public function generatePage($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		//Costruisco l'operazione prendendo il valore passato come parametro al metodo
		$account = $post["group"]["account"];
		
		// creo la query in sql
		// creo la query in sql
		$query = "SELECT _group.account as account, _group.name as name,  _group.expirationDate as expirationDate FROM _accountpartecipateuser _group _user WHERE _accountpartecipateuser.userId = _user.idUser";
		
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
				$objJSON["results"][$cont]["account"] = $rows["account"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$objJSON["results"][$cont]["expirationdate"] = $rows["expirationDate"];
				$cont++;
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
	
	public function login($post){

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

		// creo la query in sql
		$query = "SELECT _account.username, _user.* FROM _account, _user WHERE _account.username = _user.email AND (username = '$user' AND password ='$pass')";

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
	/////////// FINE METODO LOGIN /////////

}
?>
