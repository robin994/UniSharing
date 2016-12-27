<?

// interfaccia della classe
interface IIstitute{
	
	// metodo che resituisce le università di Italia
	public function getUniversities($param);
	
	// metodo che restituisce le Facoltà
	public function getFaculties($param);
	
	// metodo che restituisce gli esami
	public function getExams($param);
	
	// metodo che restituisce un esame a partire dal nome, università e facoltà
	public function getExamByName($param);
		
	// metodo che inserisce un nuovoesame
	public function insertExam($param);
	
}

class Istitutes implements IIstitute{

	private $connect;
	
	// costruttore della classe
	public function __costructor(){}
	
	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

	}


	////////////////////////////////////////////////////////////////////
	/////////// METODO CHE MI RESTITUISCE LE UNI ITALIANE //////////////
	///////////////////////////////////////////////////////////////////

	public function getUniversities($post){

		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "SELECT * FROM _university";

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
				$objJSON["results"][$cont]["id"] = $rows["idUniversity"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$cont++;
			}
		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
	/////////// FINE METODO CHE EFFETTUA L'ISCRIZIONE /////////



	////////////////////////////////////////////////////////////////////
	/////////// METODO CHE MI RESTITUISCE LE FACOLTA' DI UNA UNI ///////
	///////////////////////////////////////////////////////////////////

	public function getFaculties($post){

		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "SELECT * FROM _faculty WHERE idUniversity = '".$post["university"]."'";

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
				$objJSON["results"][$cont]["id"] = $rows["idUniversity"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$cont++;
			}
		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
	/////////// FINE METODO CHE RESTITUICE LE FACOLTA' /////////

	////////////////////////////////////////////////////////////////////////////////////
	/////////// METODO CHE MI RESTITUISCE GLI ESAMI DI UNA FACOLTA' SELEZIONATA ////////
	////////////////////////////////////////////////////////////////////////////////////

	public function getExams($post){

		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "SELECT * FROM _exam WHERE idFaculty = '".$post["idFaculty"]."'";


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
				$objJSON["results"][$cont]["idExam"] = $rows["idExam"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$cont++;
			}

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
	/////////// FINE METODO CHE RESTITUICE GLI ESAMI DELLA FACOLTA' SELEZIONATA /////////


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


	///////////////////////////////////////////////////////////////////////////////////////////
	/////////// METODO CHE MI RESTITUISCE UN ESAME A PARTIRE DAL NOME E DALLA FACOLTA' ////////
	//////////////////////////////////////////////////////////////////////////////////////////

	public function getExamByName($post){

		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "SELECT * FROM _exam WHERE idFaculty = '".$post["facolta"]."' AND name = '".$post["esame"]."' LIMIT 1";

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
				$objJSON["results"][$cont]["idExam"] = $rows["idExam"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$cont++;
			}

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
	/////////// FINE METODO CHE RESTITUICE UN ESAME A PARTIRE DAL NOME E DALLA FACOLTA' /////////



	public function insertExam($post){
	
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "INSERT INTO _exam (name, idFaculty) VALUES ('".$post["esame"]."', '".$post["facolta"]."')";

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
			$objJSON["idExam"] = $this->connect->insert_id();

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	
	}	

}
?>
