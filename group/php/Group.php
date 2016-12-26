<?


// interfaccia della classe
interface IGroup{
	
	// metodo che implementa l'abbandono dell'utente dal gruppo
	public function leaveGroup($param);
	
	// metodo che restituisce i gruppi di cui l'utente è amministratore
	public function getAdminGroup($param);
	
	// metodo che restituisce i gruppi in cui l'utente partecipa
	public function getPartecipateGroup($param);
		
	// metodo che crea un gruppo (di cui l'utente sarà amministratore)
	public function createGroup($param);	
	
	// metodo che verifica se il gruppo esiste e l'utente ha privilegi di accesso
	public function existGroup($param);	
	
	// metodo che permette all'utente di rifiutare un invito
	public function refusalInvite($param);	
}


// definizione della classe
class Group implements IGroup{

	// oggetto di tipo ConnectionDB
	private $connect;
	
	// cookie
	private $cookie;
	
	//oggetto notify
	private $notify;

	// costruttore della classe
	public function __costructor(){}

	public function init(){
		
		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();
		
		//inizializza l'oggetto Notification
		$this->notify = new Notification();
		
		// prelevo l'eventuale cookie dell'utente connesso
		$this->cookie = json_decode($_COOKIE["user"], false);
		
	}

	///////////////////////////////////////////////////////////
	/////////// METODO CHE PERMETTE L'ABBANDONO  //////////////
	///////////////////////////////////////////////////////////

	public function leaveGroup($post){


		// verifico se esiste un gruppo a cui partecipo oppure sono partecipante
		$objJSONCheck = $this->existGroup($post);
		$admin;
		$result = json_decode($objJSONCheck, false);
		if(!$result->{"success"}){
			return $objJSONCheck;
		}

		// prelevo i dati del gruppo
		$admin = $result->{"results"}[0]->{"admin"};
		$gruppo = $result->{"results"}[0]->{"namegroup"};

		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "DELETE FROM _accountpartecipategroup WHERE groupId = '".$post["gruppo"]."' AND account = '".$this->cookie->{"username"}."'";

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
			
			//////////////////////////////////////////////////
			/////////// INVIO L'EMAIL DI BENVENUTO ///////////
			//////////////////////////////////////////////////
			
			$from = "l.vitale@live.it";
			$to = $admin;
			$object = $this->coookie->{"name"}."ha abbandonato il gruppo!";
			$message = "<html><body style='font-family:courier;font-size:16px;'>L'utente <b>".$this->coookie->{"name"}." ".$this->coookie->{"surname"}."</b> ha abbandonato il gruppo <b>".$gruppo."</b> per la seguente ragione:<br><b>".$post["ratio"]."</b></body></html>";

			//creo il messaggio di benvenuto all'utente iscritto
			$this->notify->send($from, $to, $object, $message);


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
							apg.accepted = 1 AND
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

	public function createGroup($post) {
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "INSERT INTO _group (	name,
										description,
										exam,
										expirationDate,
										creationDate,
										account
										) VALUES (
										'".$post["user"]["name"]."',
										'".$post["user"]["description"]."',
										'".$post["user"]["exam"]."',
										'".$post["user"]["expirationDate"]."',
										(SELECT curdate()),
										'".$post["user"]["account"]."'
										)";

		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

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
		}

		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
	
	
	
	
	public function existGroup($post) {
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "SELECT 	idGroup as idGroup,
							APG.groupId as idGroupP,
							_group.account as admin,
							_group.name as namegroup
							FROM _group 
								LEFT JOIN (
									SELECT groupId as groupid
									FROM _accountpartecipategroup
									WHERE account = '".$this->cookie->{"username"}."'
								) as APG ON APG.groupid = _group.idGroup
							
							WHERE 	idGroup = '".$post["gruppo"]."' AND  	
									(_group.account = '".$this->cookie->{"username"}."' OR APG.groupid = '".$post["gruppo"]."')
							LIMIT 1";


		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

		if($this->connect->errno()){

			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = $this->connect->error();

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);

		}else{

			$objJSON = array();
			$ce = 0;
			$admin;
			$cont = 0;
			while($row = mysqli_fetch_array($result)){
				$ce = 1;
				$objJSON["results"][$cont]["admin"] = $row["admin"];
				$objJSON["results"][$cont]["namegroup"] = $row["namegroup"];
				$cont++;
			}
			
			if($ce){
				$objJSON["success"] = true;
			}else{
				$objJSON["success"] = false;
				$objJSON["messageError"] = "Errore: Gruppo non trovato";
			}
		}

		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
	
	
	public function isInviteValid($post) {
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();


		// creo la query in sql
		$query = "SELECT 	_group.expirationDate as expirationDate,
							_group.idGroup as idGroup,
							_group.name as namegroup,
							ADMIN.name as name_admin,
							ADMIN.surname as surname_admin,
							ADMIN.pathImage as pathImage_admin
							FROM _accountpartecipategroup, _group
							
							LEFT JOIN (
								SELECT 	_user.name as name,
										_user.surname as surname,
										_user.pathImage as pathImage,
										_user.email as email
								FROM	_user
							) as ADMIN ON ADMIN.email = _group.account
							
							WHERE 	_group.idGroup = _accountpartecipategroup.groupId AND
									idGroup = '".$post["gruppo"]."' AND 
									expirationInvite > '".date("Y:m:d")."' AND 
									_accountpartecipategroup.accepted = 0
							LIMIT 1";

		//var_dump($query);

		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

		if($this->connect->errno()){

			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = $this->connect->error();

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);

		}else{

			$objJSON = array();
			$ce = 0;
			$admin;
			$cont = 0;
			while($row = mysqli_fetch_array($result)){
				$ce = 1;
				$objJSON["results"][$cont]["expirationDate"] = $row["expirationDate"];
				$objJSON["results"][$cont]["idGroup"] = $row["idGroup"];
				$objJSON["results"][$cont]["namegroup"] = $row["namegroup"];
				$objJSON["results"][$cont]["name_admin"] = $row["name_admin"];
				$objJSON["results"][$cont]["surname_admin"] = $row["surname_admin"];
				$objJSON["results"][$cont]["pathImage_admin"] = $row["pathImage_admin"];
				$cont++;
			}
			
			if($ce){
				$objJSON["success"] = true;
			}else{
				$objJSON["success"] = false;
				$objJSON["messageError"] = "Errore:";
				$objJSON["error"] = " Invito scaduto";
			}
		}

		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
	
	
	public function refusalInvite($post) {
		
		// verifico se esiste un gruppo a cui partecipo oppure sono partecipante
		$objJSONCheck = $this->existGroup($post);
		$admin;
		$result = json_decode($objJSONCheck, false);
		if(!$result->{"success"}){
			return $objJSONCheck;
		}
		
		
		//inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php
		$this->connect->connetti();

		// creo la query in sql
		$query = "UPDATE _accountpartecipategroup SET accepted = '1', dateAccepted = '".date("Y:m:d")."' WHERE groupId = '".$post["gruppo"]."' AND account = '".$this->cookie->{"username"}."'";

		//la passo la motore MySql
		$result = $this->connect->myQuery($query);

		if($this->connect->errno()){

			//la chiamata non ha avuto successo
			$objJSON["success"] = false;
			$objJSON["messageError"] = "Errore:";
			$objJSON["error"] = $this->connect->error();

			//Disconnetto dal database
			$this->connect->disconnetti();
			return json_encode($objJSON);

		}else{

			$objJSON = array();
			$objJSON["success"] = true;
			
		}

		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
	}
	
}

?>
