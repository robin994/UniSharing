<?

class Research{

	private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

	}
	
	public function researchUsers($post){


		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		//Costruisco la select prelevando tutte le caratteristiche
		$features = $post["features"];

		if(count($features) <= 0){
			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = "Nessun filtro di ricerca fornito";

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);
		}

		//costruisco la query di select
		$query = "";
		if(count($features) > 0){
			$query .= " SELECT * FROM _user WHERE _user.idUser IN (SELECT _userhasfeatures.idUser as user FROM _features, _userhasfeatures WHERE  _features.idFeature = _userhasfeatures.idFeature AND (";
			for($i = 0; $i < count($features);$i++){
				$query.= " _features.label = '".$features[$i]["features"]."' OR";
			}
			$query = substr($query,0,strlen($query)-2).")";
			$query .= " GROUP BY _userhasfeatures.idUser HAVING COUNT(*) = ".count($features).")";
		}



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
				$cont++;
			}
		}


		//Disconnetto dal database
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}

}






?>
