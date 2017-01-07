<?


// interfaccia della classe
interface IGroup{

	//metodo che preleva i gruppi scaduti con partecipanti
	public function getExpiratedGroupWithUser();

	//metodo che permette di controllare se un gruppo è scaduto o meno
	public function getExpiratedGroup();

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

	// metodo che permette all'utente di accettare un invito
	public function acceptInvite($param);
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
			$query = "UPDATE _accountpartecipategroup SET accepted = -1, dateAccepted = '".date("Y:m:d")."' WHERE groupId = '".$post["gruppo"]."' AND account = '".$this->cookie->{"username"}."'";

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


				///////////////////////////////////////////////////////////////////////
				/////////// INVIO L'EMAIL DI AVVISO DI ABBANDONO DEL GRUPPO ///////////
				///////////////////////////////////////////////////////////////////////

				$from = "l.vitale@live.it";
				$to = $admin;
				$object = $this->cookie->{"name"}." ha abbandonato il gruppo!";
				$message = "<html><body style='font-family:courier;font-size:16px;'>L'utente <b>".$this->cookie->{"name"}." ".$this->cookie->{"surname"}."</b> ha abbandonato il gruppo <b>".$gruppo."</b> per la seguente ragione:<br><b>\"".$post["ratio"]."\"</b></body></html>";

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
			_group.idGroup as idGroup,
			_group.creationDate as creationDate,
			_group.expirationDate as expirationDate,
			_group.expirationInvite as expirationInvite
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
					$objJSON["results"][$cont]["idGroup"] = $rows["idGroup"];
					$objJSON["results"][$cont]["creationDate"] = $rows["creationDate"];
					$objJSON["results"][$cont]["expirationDate"] = $rows["expirationDate"];
					$objJSON["results"][$cont]["expirationInvite"] = $rows["expirationInvite"];
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
			$query = "SELECT 	_group.name as nameGroup,
			ADMIN.admin_name as admin_name,
			ADMIN.admin_surname as admin_surname,
			_group.description as description,
			_group.creationDate as creationDate,
			EXAM.nameExam as name_exam,
			EXAM.nameFaculty as name_faculty,
			EXAM.nameUniversity as name_university
			FROM _group

			LEFT JOIN (
				SELECT 	_user.name as admin_name,
				_user.surname as admin_surname,
				_user.email as admin_email
				FROM _user
			) as ADMIN ON ADMIN.admin_email = _group.account

			LEFT JOIN (
				SELECT 	_exam.idExam as idExam,
				_exam.name as nameExam,
				_faculty.name as nameFaculty,
				_university.name as nameUniversity
				FROM 	_exam, _faculty, _university
				WHERE 	_exam.idFaculty = _faculty.idFaculty AND
				_faculty.idUniversity = _university.idUniversity

			) as EXAM ON EXAM.idExam = _group.exam

			WHERE _group.idGroup='".$post["gruppo"]."'";

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


				// prelevo i partecipanti del gruppo
				$objJSONPartecipate = array();

				// creo la query in sql
				$query = "SELECT
				_user.name as name,
				_user.surname as surname,
				_accountpartecipategroup.accepted as accepted,
				_user.email as email

				FROM _user, _accountpartecipategroup
				WHERE 	_user.email = _accountpartecipategroup.account AND
				_accountpartecipategroup.groupId = '".$post["gruppo"]."' AND _accountpartecipategroup.account <> '".$this->cookie->{"username"}."'";


				//la passo la motore MySql
				$result1 = $this->connect->myQuery($query);

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

					$cont1 = 0;
					while($rows = mysqli_fetch_array($result1)){
						$objJSONPartecipate[$cont1]["name"] = $rows["name"];
						$objJSONPartecipate[$cont1]["surname"] = $rows["surname"];
						$objJSONPartecipate[$cont1]["email"] = $rows["email"];
						$objJSONPartecipate[$cont1]["accepted"] = $rows["accepted"];
						$cont1++;
					}

				}


				//la chiamata ha avuto successo
				$objJSON["success"] = true;
				$objJSON["results"] = array();

				$cont = 0;

				//itero i risultati ottenuti dal metodo
				while($rows = mysqli_fetch_array($result)){
					$objJSON["results"][$cont]["nameGroup"] = $rows["nameGroup"];
					$objJSON["results"][$cont]["admin_name"] = $rows["admin_name"];
					$objJSON["results"][$cont]["admin_surname"] = $rows["admin_surname"];
					$objJSON["results"][$cont]["name_exam"] = $rows["name_exam"];
					$objJSON["results"][$cont]["name_faculty"] = $rows["name_faculty"];
					$objJSON["results"][$cont]["name_university"] = $rows["name_university"];
					$objJSON["results"][$cont]["description"] = $rows["description"];
					$objJSON["results"][$cont]["creationDate"] = $rows["creationDate"];
					$objJSON["results"][$cont]["partecipate"] = $objJSONPartecipate;
					$cont++;
				}
			}

			//Disconnetto dal database e restituisco il risultato
			$this->connect->disconnetti();
			return json_encode($objJSON);
		}

		public function createGroup($post) {


			// verifico che i dati siano stati inseriti correttamente
			$boo = true;
			if(!isset($post["name"])){ $boo = true; }

			if(!isset($post["facolta"])){ $boo = true; }

			if(!isset($post["expirationDate"])){ $boo = true; }

			if(!isset($post["esame"])){ $boo = true; }

			$eDate = $post["expirationDate"];
			$eInvite = $post["expirationInvite"];

			if(count($post["partecipanti"]) <= 0){ $boo = true; }


			if(!$boo){
				//la chiamata non ha avuto successo
				$objJSON["success"] = false;
				$objJSON["messageError"] = "Errore:";
				$objJSON["error"] = "I campi non sono stati inseriti correttamente";

				//Disconnetto dal database
				$this->connect->disconnetti();
				return json_encode($objJSON);
			}


			//verifico che l'esame fornito dall'utente esista già. Diversamente lo creo
			$istitutes = new Istitutes();
			$istitutes->init();
			$objJSONEsame = json_decode($istitutes->getExamByName($post), false);

			$idEsame;
			if(count($objJSONEsame->{"results"}) <= 0){
				$objIdExam = $istitutes->insertExam($post);
				$r = json_decode($objIdExam, false);

				if(!$r->{"success"}){
					return $objIdExam;
				}
				$idEsame = 	$r->{"idExam"};
			}else{
				$idEsame = $objJSONEsame->{"results"}[0]->{"idExam"};
			}

			//inizializzo il json da restituire come risultato del metodo
			$objJSON = array();

			//eseguo la connessione al database definita in ConnectionDB.php
			$this->connect->connetti();

			// creo la query in sql
			$query = "INSERT INTO _group (	name,
				description,
				exam,
				expirationDate,
				expirationInvite,
				creationDate,
				account
			) VALUES (
				'".$post["name"]."',
				'".$post["description"]."',
				'".$idEsame."',
				'".$eDate."',
				'".$eInvite."',
				(SELECT curdate()),
				'".$this->cookie->{"username"}."'
				)";


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

					$idGroup = $this->connect->insert_id();

					//inserisco gli utenti che partecipano al gruppo
					$users = "";
					$values = "";
					for($i = 0;$i < count($post["partecipanti"]);$i++){
						$users .= " _blacklist.user = '".$post["partecipanti"][$i]."' OR";
						$values .= "( '".$post["partecipanti"][$i]."', '".$idGroup."', 0, 0),";
					}
					$values .= "('".$this->cookie->{"username"}."','".$idGroup."', 0, 1)";

					$users = substr($users,0, strlen($users)-2);

					$query_insert = "INSERT INTO _accountpartecipategroup
					(
						account,
						groupId,
						accepted,
						admin
					)VALUES ".$values;

					//var_dump($query_insert);

					//la passo la motore MySql
					$this->connect->myQuery($query_insert);

					if($this->connect->errno()){

						//la chiamata non ha avuto successo
						$objJSON["success"] = false;
						$objJSON["messageError"] = "Errore:";
						$objJSON["error"] = $this->connect->error();

						//Disconnetto dal database
						$this->connect->disconnetti();
						return json_encode($objJSON);

					}

					//la chiamata ha avuto successo
					$objJSON["success"] = true;

					//////////////////////////////////////////////////
					/////////// INVIO L'EMAIL DI BENVENUTO ///////////
					//////////////////////////////////////////////////

					$from = "l.vitale@live.it";
					$object = "Qualcuno ti ha invitato!";

					//creo il messaggio di benvenuto all'utente iscritto
					$message = "<html><body style='font-family:courier;font-size:16px;'>Sei stato invitato ad un gruppo di studio<br><br>:::::::::::::::::::::::::::::<br><a href='http://".$_SERVER["HTTP_HOST"]."/group/g_accept/?g=".$idGroup."'>Accetta</a><br><a href='http://".$_SERVER["HTTP_HOST"]."/group/g_refusal/?g=".$idGroup."'>Rifiuta</a><br>
					<a href='http://".$_SERVER["HTTP_HOST"]."/students/add_blacklist/index.php?user=".$this->cookie->{"idUser"}."'>Aggiungi alla lista nera</a><br>:::::::::::::::::::::::::::::<br></body></html>";


					// verifico se qualche utente ha l'admin nella propria lista nera
					$query_blist = "SELECT _blacklist.user as user FROM _blacklist WHERE blockedUser != '".$this->cookie->{"username"}."' AND (".$users.")";
					//var_dump($query_blist);
					$result_blist = $this->connect->myQuery($query_blist);
					$cont_blist = 0;
					$black_list = array();
					while($rows_blist = mysqli_fetch_array($result_blist)){
						$black_list[$cont_blist] = $rows_blist["user"];
						$cont_blist++;
					}


					for($i = 0;$i < count($post["partecipanti"]);$i++){
						$boo = false;
						for($j = 0;$j < count($black_list);$j++){
							if($post["partecipanti"][$i] == $black_list[$j]){
								$boo = true;
								break;
							}
						}

						if($boo) continue;

						$this->notify->send($from, $post["partecipanti"][$i], $object, $message);
					}

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
							$objJSON["messageError"] = "Errore: ";
							$objJSON["error"] = "Gruppo non trovato";
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
					ADMIN.email as username_admin,
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
					expirationInvite > '".date("Y-m-d")."' AND
					_accountpartecipategroup.account = '".$this->cookie->{"username"}."' AND
					_accountpartecipategroup.accepted = 0
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
							$objJSON["results"][$cont]["expirationDate"] = $row["expirationDate"];
							$objJSON["results"][$cont]["idGroup"] = $row["idGroup"];
							$objJSON["results"][$cont]["namegroup"] = $row["namegroup"];
							$objJSON["results"][$cont]["name_admin"] = $row["name_admin"];
							$objJSON["results"][$cont]["surname_admin"] = $row["surname_admin"];
							$objJSON["results"][$cont]["username_admin"] = $row["username_admin"];
							$objJSON["results"][$cont]["pathImage_admin"] = $row["pathImage_admin"];
							$cont++;
						}

						if($ce){
							$objJSON["success"] = true;
						}else{
							$objJSON["success"] = false;
							$objJSON["messageError"] = "Avviso:";
							$objJSON["error"] = " Invito scaduto o non valido";
						}
					}

					//Disconnetto dal database e restituisco il risultato
					$this->connect->disconnetti();
					return json_encode($objJSON);
				}


				public function refusalInvite($post) {


					// verifico se esiste un gruppo a cui partecipo oppure sono partecipante
					$objJSONCheck = $this->existGroup($post);
					$r = json_decode($objJSONCheck, false);
					$admin = $r->{"results"}[0]->{"admin"};
					$gruppo = $r->{"results"}[0]->{"namegroup"};
					if(!$r->{"success"}){
						return $objJSONCheck;
					}



					//inizializzo il json da restituire come risultato del metodo
					$objJSON = array();

					//eseguo la connessione al database definita in ConnectionDB.php
					$this->connect->connetti();

					// creo la query in sql
					$query = "UPDATE _accountpartecipategroup SET accepted = '-1', dateAccepted = '".date("Y:m:d")."' WHERE groupId = '".$post["gruppo"]."' AND account = '".$this->cookie->{"username"}."'";

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


						///////////////////////////////////////////////////////////////////////
						/////////// INVIO L'EMAIL DI AVVISO DI RIFIUTO DI PARTECIPAZIONE //////
						///////////////////////////////////////////////////////////////////////

						$from = "l.vitale@live.it";
						$to = $admin;
						$object = $this->cookie->{"name"}." ha abbandonato il gruppo!";
						$message = "<html><body style='font-family:courier;font-size:16px;'>L'utente <b>".$this->cookie->{"name"}." ".$this->cookie->{"surname"}."</b> ha rifiutato il tuo invito di partecipazione al gruppo <b>".$gruppo."</b> per la seguente ragione:<br><b>\"".$post["ratio"]."\"</b></body></html>";

						$this->notify->send($from, $to, $object, $message);

					}

					//Disconnetto dal database e restituisco il risultato
					$this->connect->disconnetti();
					return json_encode($objJSON);
				}



				public function acceptInvite($post) {

					// verifico se esiste un gruppo a cui partecipo oppure sono partecipante
					$objJSONCheck = $this->existGroup($post);
					$r = json_decode($objJSONCheck, false);
					$admin = $r->{"results"}[0]->{"admin"};
					$gruppo = $r->{"results"}[0]->{"namegroup"};
					if(!$r->{"success"}){
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


						///////////////////////////////////////////////////////////////////////
						/////////// INVIO L'EMAIL DI AVVISO DI RIFIUTO DI PARTECIPAZIONE //////
						///////////////////////////////////////////////////////////////////////

						$from = "l.vitale@live.it";
						$to = $admin;
						$object = $this->cookie->{"name"}." ha accettato il tuo invito!";
						$message = "<html><body style='font-family:courier;font-size:16px;'>L'utente <b>".$this->cookie->{"name"}." ".$this->cookie->{"surname"}."</b> ha accettato il tuo invito di partecipazione al gruppo <b>".$gruppo."</b></b></body></html>";

						$this->notify->send($from, $to, $object, $message);

					}

					//Disconnetto dal database e restituisco il risultato
					$this->connect->disconnetti();
					return json_encode($objJSON);
				}

				////////////////////////////////////////////////////////////////////////////////////
				/////////// INIZIO DEL METODO CHE CONTROLLA I GRUPPI CHE SONO SCADUTI //////////////
				////////////////////////////////////////////////////////////////////////////////////
				public function getExpiratedGroup(){
					//eseguo la connessione al database definita in ConnectionDB.php
					$this->connect->connetti();

					$query= "DELETE FROM _group WHERE _group.expirationDate < date('Y-m-d') AND _group.idGroup NOT IN (SELECT groupId FROM _accountpartecipategroup)";

					//Disconnetto dal database e restituisco il risultato
					$this->connect->disconnetti();
					return json_encode($objJSON);

				}

				//////////////////////////////////////////////////////////////////////////
				/////////// FINE DEL METODO CHE CONTROLLA I GRUPPI CHE SONO SCADUTI //////
				//////////////////////////////////////////////////////////////////////////


				////////////////////////////////////////////////////////////////////////////////////
				/////////// INIZIO DEL METODO CHE CONTROLLA I GRUPPI CHE SONO SCADUTI //////////////
				/////////////MA POSSIEDONO ANCORA PARTECIPANTI /////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////

				public function getExpiratedGroupWithUser(){
					//eseguo la connessione al database definita in ConnectionDB.php
					$this->connect->connetti();

					$query= "SELECT _group.name, _group.idGroup, _accountpartecipategroup.account
					FROM _group JOIN _accountpartecipategroup on _group.idGroup=_accountpartecipategroup.groupId
					WHERE _group.expirationDate < date('Y-m-d')";

					//inizializzo il json da restituire come risultato del metodo
					$objJSON = array();

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
							$objJSON["results"][$cont]["name"] = $rowValori["name"];
							$objJSON["results"][$cont]["idGroup"] = $rowValori["idGroup"];
							$objJSON["results"][$cont]["account"] = $rowValori["account"];
						}
					}

					//Disconnetto dal database e restituisco il risultato
					$this->connect->disconnetti();
					return json_encode($objJSON);

				}

				///////////////////////////////////////////////////////////////////////////////////////////
				/////////// FINE DEL METODO CHE CONTROLLA I GRUPPI CHE SONO SCADUTI CON PARTECIPANTI //////
				///////////////////////////////////////////////////////////////////////////////////////////

			}

			?>
