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
	
		
		// creo la query in sql
		$query = "";
				  
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
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////// METODO CHE PERMETTE VISUALIZZAZIONE DEI GRUPPI A CUI SONO AMMINISTRATORE  //////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function getAdminGroup($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		// creo la query in sql
		$query = "SELECT 	_group.name as name, 
							_group.creationDate as creationDate,
							_group.expirationDate as expirationDate  
				  FROM _group
				  WHERE 	_group.account = '".$post["account"]."'";
				  
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
				$objJSON["results"][$cont]["creationDate"] = $rows["creationDate"];
				$objJSON["results"][$cont]["expirationDate"] = $rows["expirationDate"];
				$cont++;
			}
		}
		
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	} 
	/////////// FINE METODO CHE EFFETTUA L'ABBANDONO DEL GRUPPO /////////


	////////////////////////////////////////////////////////////////////////////////
	/////////// METODO CHE PRELEVA I GRUPPI IN CUI L'UTENTE PATECIPA  //////////////
	////////////////////////////////////////////////////////////////////////////////
	
	public function getPartecipateGroup($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		//Costruisco l'operazione prendendo il valore passato come parametro al metodo
		$query = "SELECT 	USER.name as name,
							USER.surname as surname,
							USER.email as email,
							g.idGroup as idGroup,
							g.name as namegroup,  
							g.expirationDate as expirationDate 
					FROM 	_accountpartecipategroup as apg,
							_group as g 
							
							LEFT JOIN(
							 SELECT 
							 	_user.idUser as userId,
								_user.email as email,
								_user.name as name,
								_user.surname as surname
								FROM _user
							) as USER ON USER.email = g.account
							
							
					WHERE 	apg.account = '".$post["account"]."' AND
							g.account != '".$post["account"]."' AND
							apg.groupId = g.idGroup
			";
			
		  
		//la passo la motore MySql
		$result = $this->connect->myQuery($query);
		
		//Righe che gestiscono casi di errore di chiamata al database
		if($this->connect->errno()){

			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = $this->connect->error();

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
				$objJSON["results"][$cont]["email"] = $rows["email"];
				$objJSON["results"][$cont]["expirationDate"] = $rows["expirationDate"];
				$objJSON["results"][$cont]["idGroup"] = $rows["idGroup"];
				$cont++;
			}
		}
		
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	} 
	/////////// FINE METODO CHE PRELEVA I GRUPPI NEI QUALI PARTECIPO /////////
	
	////////////////////////////////////////////////////////////////////
	/////////// METODO CHE PERMETTE LA VISUALIZZAZIONE DEI DETTAGLI ////
	///////////               DI UN GRUPPO            //////////////////
	////////////////////////////////////////////////////////////////////
	
	public function getDetailsGroup($post){
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();
		
		//Costruisco l'operazione prendendo il valore passato come parametro al metodo
		$account = $post["group"]["account"];
		
		// creo la query in sql
		$query = "SELECT _group.name as nameGroup, _user.name as nameUser, _user.surname as surname, _group.description as description, _group.creationDate as creationDate
				  FROM _group JOIN _user on _group.account = _user.email
                  WHERE _group.idGroup=2;";
				  
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
				$objJSON["results"][$cont]["nameGroup"] = $rows["nameGroup"];
				$objJSON["results"][$cont]["nameUser"] = $rows["nameUser"];
				$objJSON["results"][$cont]["surname"] = $rows["surname"];
				$objJSON["results"][$cont]["description"] = $rows["description"];
				$objJSON["results"][$cont]["creationDate"] = $rows["creationDate"];
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