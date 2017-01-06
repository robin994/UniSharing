<?

interface IContact{

	// metodo che permette di registrare un nuovo utente
	public function sendReport($post);

}

class Contact implements IContact{

  public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

		//inizializza l'oggetto Notification
		$this->notify = new Notification();

		// prelevo l'eventuale cookie dell'utente connesso
		$this->cookie = json_decode($_COOKIE["user"], false);

	}

  public function sendReport($post) {
    //////////////////////////////////////////////////
    /////////// INVIO L'EMAIL DI BENVENUTO ///////////
    //////////////////////////////////////////////////

    $from = $post['account'];
    $object = $post['object'];

    //creo il messaggio di benvenuto all'utente iscritto
    $message = $post['message'];
    
    $this->notify->send($from, "robin994@hotmail.it", $object, $message);
  }
}
?>
