<?

include "Account.php";

interface IUser{
	
	// metodo che permette l'iscrizione dell'utente
	public function signin($param);
	
	// metodo che effettua la login dell'utente
	public function login($param);
	
	// metodo che modifica lo score dell'utente
	public function setScore($param);
	
	// metodo che restituisce lo score dell'utente
	public function getScore($param);
	
}


class User extends Account implements IUser{

	//private $connect;
	private $notify;
	
	// costruttore della classe
	public function __construct(){}

	public function init(){
		
		// inizializzo la classe Account che estende
		$this->initialize();
		
		//inizializza l'oggetto Notification
		$this->notify = new Notification();
		 
	}


	///////////////////////////////////////////////////////////
	/////////// METODO CHE EFFETTUA L'ISCRIZIONE //////////////
	///////////////////////////////////////////////////////////
	
	public function signin($post){
		
		$account = $post["account"];
		$user = $post["user"];
		
		// invoco il metodo esteso da Account per inserire l'account
		$objJSON = $this->saveAccount($account);
		
		//controllo se il metodo di Account ha restituito errore, in questo caso lo restituisco al client ed esco
		if(!$objJSON["success"]){
			return json_encode($objJSON);	
		}
		
		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();	
			
		//formulo la query di inserimento
		$query = "INSERT INTO _user (	name, 
										surname, 
										email, 
										birthOfDay, 
										telephone, 
										description, 
										address, 
										typeStudent,
										pathImage
										) VALUES (
										'".$user["name"]."',
										'".$user["surname"]."',
										'".$account["username"]."',
										'".$user["bday"]."',
										'".$user["cellulare"]."',
										'".$user["description"]."',
										'".$user["tipo_studente"]."',
										'".$user["address"]."',
										'img/avatar/".$user["email"]."/'
										)";	
		
			
		//la passo la motore MySql
		$result = $this->connect->myQuery($query);
		$idUser = $this->connect->insert_id();
		
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
		
			
			// inserisco le features dell'utente
			$post["user"]["idUser"] = $idUser;
			$this->setUserHasFeatures($post);
			
			// creo l'avatar dell'utente
			if($post["image"]["caricata"] == "true"){
			
				
				//se non esiste la cartella avatar la creo
				if(!is_dir("../img/avatar")){
					mkdir("../img/avatar");	
				}
				
				//se non esiste la cartella dell'utente la creo
				if(!is_dir("../img/avatar/".$user["email"])){
					mkdir("../img/avatar/".$user["email"]);	
				}
			
			
				$pathImage = base64_decode($post["image"]["image"]);
				$jpeg_quality = 90;
				$img_r = imagecreatefromstring($pathImage);
				$dst_r = imagecreatetruecolor(250,250);
				imagecopyresampled($dst_r,$img_r,0,0,$post["image"]['cx'],$post["image"]['cy'],250,250, $post["image"]['cw'],$post["image"]['ch']);
				imagejpeg($dst_r,"../img/avatar/".$user["email"]."/icon250x250.jpg",$jpeg_quality);
				
				$dst_r2 = imagecreatetruecolor(80, 80);
				imagecopyresampled($dst_r2,$img_r,0,0,$post["image"]['cx'],$post["image"]['cy'],80,80, $post["image"]['cw'],$post["image"]['ch']);
				imagejpeg($dst_r2,"../img/avatar/".$user["email"]."/icon80x80.jpg",$jpeg_quality);
			
				$dst_r3 = imagecreatetruecolor(40, 40);
				imagecopyresampled($dst_r3,$img_r,0,0,$post["image"]['cx'],$post["image"]['cy'],40,40, $post["image"]['cw'], $post["image"]['ch']);
				imagejpeg($dst_r3,"../img/avatar/".$user["email"]."/icon40x40.jpg",$jpeg_quality);
			
			}
			
		}
			
		
		
		//////////////////////////////////////////////////
		/////////// INVIO L'EMAIL DI BENVENUTO ///////////
		//////////////////////////////////////////////////
			
		
		$from = "l.vitale@live.it";
		$to = $user["email"];
		$object = "Benvenuto in unisharing!";	
		$message = "<html><body style='font-family:courier;font-size:16px;'>Benvenuto in unisharing,<br>Di seguito le credenziali per l'accesso<br><br>:::::::::::::::::::::::::::::<br>user: ".$to."<br>pass: ".$account["password"]."<br>:::::::::::::::::::::::::::::<br></body></html>";
			
		//creo il messaggio di benvenuto all'utente iscritto
		$this->notify->send($from, $to, $object, $message);	
			
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
		
	} 
	/////////// FINE METODO CHE EFFETTUA L'ISCRIZIONE /////////
	
	
	///////////////////////////////////////////////////////////
	/////////// METODO CHE EFFETTUA LA LOGIN //////////////////
	///////////////////////////////////////////////////////////
	
	public function login($post){
		
		return $this->access($post);
		
	}
	/////////// FINE METODO LOGIN /////////


	//////////////////////////////////////////////////////////////////////////////
	/////////// METODO CHE EFFETTUA L'AGGIORNAMENTO DELLO SCORE //////////////////
	/////////////////////////////////////////////////////////////////////////////
	
	public function setScore($post){
		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
			
	
		if(count($post["feedbacks"]) > 0){
			
			//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
			$this->connect->connetti();
			
			$query = "";
			for($j = 0; $j < count($post["feedbacks"]);$j++){
				$query .= "UPDATE _user SET score = score + ".$post["feedbacks"][$j]["score"].", numberOfFeedback = numberOfFeedback + 1 WHERE email = '".$post["feedbacks"][$j]["user"]."';";
			}
	
	
			//la passo la motore MySql
			$result = $this->connect->myMultiQuery($query);
	
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
		}
		
		return json_encode($objJSON);
	}
	/////////// FINE METODO LOGIN /////////



	/////////////////////////////////////////////////////////
	///////////// INSERIMENTO DEI FEATURES PER L'USER ///////
	/////////////////////////////////////////////////////////

	private function setUserHasFeatures($post){
		
		$objJSON["success"] = true;
		$objJSON["results"] = array();
		
		
		if(count($post["user"]["features"]) > 0){
			
			//re-inizializzo il json da restituire come risultato del metodo
			$objJSON = array();
			
			//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
			$this->connect->connetti();	
			
			//formulo la query di inserimento delle features
			$values = "";
			for($i = 0; $i < count($post["user"]["features"]);$i++){
				$values .= "(";
				$values .= "'".$post["user"]["features"][$i]."','".$post["user"]["idUser"]."'";
				$values .= "),";
			}
			
			$values = substr($values, 0, strlen($values)-1);
			$query = "INSERT INTO _userhasfeatures (idFeature, idUser) VALUES ".$values;
			var_dump($query);
			
			
			// eseguo la query nel motore mysql
			$this->connect->myQuery($query);
			
			//Righe che gestiscono casi di errore di chiamata al database
			if($this->connect->errno()){
	
				//la chiamata non ha avuto successo
				$objJSON["success"] = false;
				$objJSON["messageError"] = "Errore:";
				$objJSON["error"] = $this->connect->error();
	
			}else{
	
				//la chiamata ha avuto successo
				$objJSON["success"] = true;
				$objJSON["results"] = array();
			}
			
			//Disconnetto dal database e restituisco il risultato
			$this->connect->disconnetti();
		}
				
		return $objJSON;
	}
	
	
	//////////////////////////////////////////////////////
	///////// METODO CHE RICEVE LO SCORE DELL'UTENTE /////
	//////////////////////////////////////////////////////
	
	public function getScore($param){
		

		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();	
			
		//formulo la query di inserimento
		$query = "SELECT score FROM _user WHERE email = '".$post["user"]."'";	
			
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
			
			$row = mysqli_fetch_array($result);
			$objJSON["score"] = $row["score"];
		
		}
		
		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);
		
	}
}
?>
