<?

// interfaccia della classe
interface IRanking{

	// metodo che resistuisce la classifica
	public function getRanking($post);

}


//definizione della classe
class Ranking implements IRanking{

	private $connect;

	public function init(){
		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();
	}


	public function getRanking($post){

		//var_dump($post);
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		//costruisco la query di select
	  $query = " SELECT *, (5 * (_user.score / _user.numberOfFeedback)) AS perc FROM _user WHERE score > 0 ORDER BY ".$post['orderBy'];

		if ($post['cresc'] == "true") {
			$query .= " ASC";
		} else {
			$query .= " DESC";
		}

		//var_dump($query);
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
			while($rowValori = mysqli_fetch_array($result)){
				$objJSON["results"][$cont]["id"] = $rowValori["idUser"];
				$objJSON["results"][$cont]["name"] = $rowValori["name"];
				$objJSON["results"][$cont]["surname"] = $rowValori["surname"];
				$objJSON["results"][$cont]["pathImage"] = $rowValori["pathImage"];
				$objJSON["results"][$cont]["address"] = $rowValori["address"];
				$objJSON["results"][$cont]["score"] = $rowValori["score"];
				$objJSON["results"][$cont]["percent"] = $rowValori["perc"];
				$cont++;
			}
		}
		//Disconnetto dal database
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
}
?>
