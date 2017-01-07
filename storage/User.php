<?

class User{

	private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

	}

	public function echoQualcosa(){

	}

	public function researchUsers($post){


		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		//var_dump($post);
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		//Costruisco la select prelevando tutte le caratteristiche
		$caratteristiche = $post["caratteristiche"];

		if(count($caratteristiche) <= 0){
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
		if(count($caratteristiche) > 0){
			$query .= " SELECT * FROM users WHERE users.id IN (SELECT caratteristiche.user as user FROM caratteristiche WHERE ";
			for($i = 0; $i < count($caratteristiche);$i++){
				$query.= " caratteristiche.label = '".$caratteristiche[$i]["caratteristica"]."' OR";
			}
			$query = substr($query,0,strlen($query)-2);
			$query .= " GROUP BY caratteristiche.user HAVING COUNT(*) = ".count($caratteristiche).")";
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
				$objJSON["results"][$cont]["id"] = $rowValori["id"];
				$objJSON["results"][$cont]["nome"] = $rowValori["nome"];
				$objJSON["results"][$cont]["cognome"] = $rowValori["cognome"];
				$objJSON["results"][$cont]["email"] = $rowValori["email"];
				$objJSON["results"][$cont]["indirizzo"] = $rowValori["indirizzo"];
				$cont++;
			}
		}


		//Disconnetto dal database
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}


}






?>
