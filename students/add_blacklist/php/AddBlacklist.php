<?

interface IAddBlacklist{

	// metodo che permette di registrare un nuovo utente
	public function blockUser($post);

}

class AddBlacklist implements IAddBlacklist{

  public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

		//inizializza l'oggetto Notification
		$this->notify = new Notification();

		// prelevo l'eventuale cookie dell'utente connesso
		$this->cookie = json_decode($_COOKIE["user"], false);

	}

  public function blockUser($post) {
		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();

		$query = "SELECT email FROM _user where _user.idUser = ".$post["blockedUser"];

		//la passo la motore MySql
		$result = $this->connect->myQuery($query);
	
		$query ="INSERT INTO _blacklist (user, blockedUser ) VALUES ('$post[account]','".$result[email]."')";

		$result = $this->connect->myQuery($query);

		// inserisco le features dell'utente
		$this->connect->myQuery($query);

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
		$this->connect->disconnetti();
		return $objJSON;


  }
}
?>
