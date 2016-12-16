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
							USER.email as email
							
							FROM _accountpartecipategroup
							
							
							LEFT JOIN(
								SELECT  _user.idUser as idUser,
										_user.name as name,
										_user.surname as surname,
										_user.pathImage as pathImage,
										_user.email as email
										FROM _user
							 ) as USER ON USER.idUser = _accountpartecipategroup.userId
						 
					
							WHERE 	groupId ='".$post["gruppo"]."' AND 
									userId != '".$post["user"]."' AND 
									userId NOT IN (
										SELECT idUser FROM _feedback 
											WHERE 	
													_feedback.author = '".$post["user"]."' AND 
													_feedback.idUser != '".$post["user"]."' AND
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
				$objJSON["results"][$cont]["email"] = $rows["email"];
				$objJSON["results"][$cont]["pathImage"] = $rows["pathImage"];
				$cont++;
			}

		}


		//Disconnetto dal database e restituisco il risultato
		$this->connect->disconnetti();
		return json_encode($objJSON);

	}
}

?>
