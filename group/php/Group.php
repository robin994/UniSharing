<?

class Group {

	//private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();
	
	}


	///////////////////////////////////////////////////////////
	/////////// METODO CHE PERMETTE L'ABBANDONO  //////////////
	///////////////////////////////////////////////////////////
	
	public function leftGroup($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		//Costruisco l'operazione prendendo il valore passato come parametro al metodo
		$account = $post["group"]["account"];
		
		// creo la query in sql
		$query = "SELECT 	u.name as name,
							u.surname as surname,
							_group.name as namegroup,  
							_group.expirationDate as expirationDate 
				  FROM _accountpartecipateuser as p JOIN _group as g on p.groupId = g.idGroup, _user as u";
				  
				  
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
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$objJSON["results"][$cont]["surname"] = $rows["surname"];
				$objJSON["results"][$cont]["namegroup"] = $rows["namegroup"];
				$objJSON["results"][$cont]["expirationdate"] = $rows["expirationDate"];
				$cont++;
			}
		}
		
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	} 
	/////////// FINE METODO CHE EFFETTUA L'ABBANDONO DEL GRUPPO /////////
}
?>
