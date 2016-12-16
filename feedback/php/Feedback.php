<?


class Feedback{

	//private $connect;
	private $connect;

	public function init(){

		//istanzio l'oggetto ConnectionDB
		$this->connect = new ConnectionDB();

	}



	////////////////////////////////////////////////////////////////////////////////////////
	////////// METODO CHE CONTROLLA SE ESISTONO FEEDBACK DA INSERIRE PER UTENTI DI UN GRUPPO
	////////////////////////////////////////////////////////////////////////////////////////
	
	public function checkFeedback($post){


		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();

		//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
		$this->connect->connetti();

		//formulo la query
		// seleziono tutti gli utenti appartenenti al gruppo per cui non ho inserito un feedback
		$query = "SELECT	USER.idUser as idUser,
							USER.name as name,
							USER.surname as surname,
							USER.pathImage as pathImage,
							USER.email as email,
							_accountpartecipategroup.groupId as groupId
							
							FROM _accountpartecipategroup
							
							
							LEFT JOIN(
								SELECT  _user.idUser as idUser,
										_user.name as name,
										_user.surname as surname,
										_user.pathImage as pathImage,
										_user.email as email
										FROM _user
							 ) as USER ON USER.email = _accountpartecipategroup.account
						 
					
							WHERE 	groupId ='".$post["gruppo"]."' AND 
									account != '".$post["user"]."' AND 
									account NOT IN (
										SELECT account FROM _feedback 
											WHERE 	
													_feedback.author = '".$post["user"]."' AND 
													_feedback.account != '".$post["user"]."' AND
													_feedback.groups = '".$post["gruppo"]."'
									)";


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
				$objJSON["results"][$cont]["idUser"] = $rows["idUser"];
				$objJSON["results"][$cont]["username"] = $rows["username"];
				$objJSON["results"][$cont]["name"] = $rows["name"];
				$objJSON["results"][$cont]["surname"] = $rows["surname"];
				$objJSON["results"][$cont]["account"] = $rows["email"];
				$objJSON["results"][$cont]["pathImage"] = $rows["pathImage"];
				$objJSON["results"][$cont]["group"] = $rows["groupId"];
				$cont++;
			}

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////
	////////// METODO CHE CONTROLLA SE ESISTONO FEEDBACK DA INSERIRE PER UTENTI DI UN GRUPPO
	////////////////////////////////////////////////////////////////////////////////////////
	
	public function insertFeedback($post){


		//re-inizializzo il json da restituire come risultato del metodo
		$objJSON = array();
		
		
		if(count($post["feedbacks"]) > 0){
		
			//eseguo la connessione al database definita in ConnectionDB.php sfruttando l'oggetto connect creato nella classe Account che estende
			$this->connect->connetti();
	
	
			// itero i feedback inseriti dall'utente
			
			$values = "";
			for($i = 0;$i < count($post["feedbacks"]);$i++){
				$values .= "(";
				$values .= "'".$post["feedbacks"][$i]["user"]."',";
				$values .= "'".$post["author"]."',";
				$values .= "'".$post["group"]."',";
				$values .= "'".$post["feedbacks"][$i]["feed1"]."',"; 
				$values .= "'".$post["feedbacks"][$i]["feed2"]."',"; 
				$values .= "'".$post["feedbacks"][$i]["feed3"]."',"; 
				$values .= "'".$post["feedbacks"][$i]["feed4"]."',"; 
				$values .= "'".addslashes($post["feedbacks"][$i]["comment"])."'"; 
				$values .= "),";	
			}
			
			$values = substr($values, 0, strlen($values)-1);
			
			//formulo la query
			// seleziono tutti gli utenti appartenenti al gruppo per cui non ho inserito un feedback
			$query = "INSERT INTO _feedback (account, author, groups, simpatia, puntualita, correttezza, capacita, comment) VALUES ".$values;
			
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
					
					
				// creo l'oggetto User e aggiorno lo score
				$user = new User();
				$user->init();
				$user->setScore($post);
				
				
				// invio a tutti gli utenti a cui ho inserito un feedback la notifica
				$notify = new Notification();
				$from = "l.vitale@live.it";
				$object = "L'utente ".$_COOKIE["name"]." ".$_COOKIE["surname"]." ha inserito un feedback per te";	
				$message = "<html><body style='font-family:courier;font-size:16px;'>L'utente ".$_COOKIE["name"]." ".$_COOKIE["surname"]." ha inserito un feedback per te<br></body></html>";
				
				for($j = 0;$j < count($post["feedbacks"]);$j++){
					$to = $post["feedbacks"][$j]["user"];
					$notify->send($from, $to, $object, $message);
				}
	
			}
	
	
			//Disconnetto dal database e restituisco il risultato
			$this->connect->disconnetti();
			
		}
		return json_encode($objJSON);

	}
	
	
}

?>
