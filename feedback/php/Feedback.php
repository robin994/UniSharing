<?

class Feedback{

	//private $connect;
	private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

	}


	public function checkFeedback($post){


		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();


		$user = $post["user"];
		$gruppo = $post["gruppo"];

		//formulo la query
		$query = " SELECT * FROM _feedback WHERE groups ='".$gruppo."' AND author != '".$user."'";


		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

		for ($i = 0; $i < mssql_num_rows($result); ++$i) {
        echo mssql_result($result, $i, 'idUser'), PHP_EOL;
    }

		echo var_dump($result);

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

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
}

?>
