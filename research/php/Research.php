<?

// interfaccia della classe
interface IResearch{

	//metodo che effettua la ricerca degli utenti
	public function researchUsers($param);

}


// definizione della classe
class Research implements IResearch{

	private $connect;

	private $cookie;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

		// prelevo l'eventuale cookie dell'utente connesso
		$this->cookie = json_decode($_COOKIE["user"], false);
	}

	public function researchUsers($post){


		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		//Costruisco la select prelevando tutte le caratteristiche
		$features = $post["features"];

		if(count($features) <= 0 && !$post["parola_chiave"]){
			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = "Nessun filtro di ricerca fornito";

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);
		}

		if($post["parolachiave"]){
			$search_parolachiave = "AND (_user.name LIKE '%".$post["parolachiave"]."%'".
									" OR _user.surname LIKE '%".$post["parolachiave"]."%')";
		}

		//QUERY GEOLOCALIZZATA
 /*		$queryDistance = 	"SELECT *,
		( 6371 * acos( cos( radians(".$this->cookie->{"latitude"}.") ) * cos( radians( _user.latitude ) )
		* cos( radians( _user.longitude ) - radians(".$this->cookie->{"longitude"}.") ) + sin( radians(".$this->cookie->{"latitude"}.") )
		 * sin( radians( _user.latitude ) ) ) )
			AS distance from _user
			where _user.email <> '".$this->cookie->{"username"}."' having distance < ".$post['distance']." ORDER BY distance";
		//var_dump($queryDistance);*/
		//var_dump($this->cookie->{"distance"});
		if ($post['distance'] == null) {

			/////////////////////////////////////////////////////////////////
			/////////////// QUERY RICERCA NON GEOLOCALIZZATA ////////////////
			/////////////////////////////////////////////////////////////////

			//costruisco la query di select
			$query = " SELECT *
						FROM _user
						WHERE _user.email != '".$this->cookie->{"username"}."' ".$search_parolachiave." AND _user.idUser IN (
								SELECT 	_userhasfeatures.idUser as user
								FROM 	_features,
										_userhasfeatures
								WHERE  _features.idFeature = _userhasfeatures.idFeature ";

			if(count($features) > 0){
				$query .= "AND (";
				for($i = 0; $i < count($features);$i++){
					$query.= " _features.label = '".$features[$i]["features"]."' OR";
				}
				$query = substr($query,0,strlen($query)-2).")";
				$query .= " GROUP BY _userhasfeatures.idUser HAVING COUNT(*) = ".count($features);
			}
			$query .= ")";
			//var_dump($query);
		} else {

			/////////////////////////////////////////////////////////////////
			/////////////// QUERY RICERCA GEOLOCALIZZATA ////////////////////
			/////////////////////////////////////////////////////////////////

			//costruisco la query di select
			$query = " SELECT *, ( 6371 * acos( cos( radians(".$this->cookie->{"latitude"}.") ) * cos( radians( _user.latitude ) )
					* cos( radians( _user.longitude ) - radians(".$this->cookie->{"longitude"}.") ) + sin( radians(".$this->cookie->{"latitude"}.") )
					 * sin( radians( _user.latitude ) ) ) )
						AS distance
						FROM _user
						WHERE _user.email != '".$this->cookie->{"username"}."' ".$search_parolachiave." AND _user.idUser IN (
								SELECT 	_userhasfeatures.idUser as user
								FROM 	_features,
										_userhasfeatures
								WHERE  _features.idFeature = _userhasfeatures.idFeature ";

			if(count($features) > 0){
				$query .= "AND (";
				for($i = 0; $i < count($features);$i++){
					$query.= " _features.label = '".$features[$i]["features"]."' OR";
				}
				$query = substr($query,0,strlen($query)-2).")";
				$query .= " GROUP BY _userhasfeatures.idUser HAVING COUNT(*) = ".count($features);
			}
			$query .= ") having distance < ".$post['distance'];
			//var_dump($query);
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
				$objJSON["results"][$cont]["username"] = $rowValori["email"];
				$objJSON["results"][$cont]["pathImage"] = $rowValori["pathImage"];
				$objJSON["results"][$cont]["address"] = $rowValori["address"];
				if ($rowValori["distance"]) {
					$objJSON["results"][$cont]["distance"] = $rowValori["distance"];
				} else {
					$objJSON["results"][$cont]["distance"] = null;
				}
				$cont++;
			}
		}

		//Disconnetto dal database
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
}

?>
