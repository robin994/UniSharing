<?

include "../storage/ConnectionDB.php";
include "../group/php/Group.php";
include "../notification/Notification.php";

$conn = new ConnectionDB();
$conn->connetti();

//istanzio un istanza della classe gruppo
$exipiratedGroup = new Group;
$expiratedGroup->init();

//chiamo il metodo che effettua il controllo dei gruppi scaduti
$exipiratedGroup -> getExpiratedGroup();

//chiamo il metodo che preleva i gruppi scaduti con partecipanti
$expiretedResults= $exipiratedGroup -> getExpiratedGroupWithUser();

//Creo un istanza della classe Notification che permette di inviare notifiche riguardante la conclusione di un gruppo
$sendNotification = new Notification;
$sendNotification -> init();

//Creiamo l'oggetto della mail
$object = "Congratulazioni!!";

for ($i=0; $i<$expiretedResults.length; $i++){
	
	//Creiamo il messaggio che l'utente ricevente deve visualizzare
	$message = "<html>
					<body>
						<h1>Complimenti hai portato a termine il lavoro con il gruppo: $expiretedResults[$i]->{'name'} </h1>
						<a href='http://".$_SERVER["HTTP_HOST"]."/feedback/?g=".$expiretedGroup[$i]->{"idGroup"}."''>					                        inserisci i feedback</a>
					</body>
				</html>";
				
	
	$sendNotification -> send ("Unisharing", $exipiratedResults[$i]->{'account'}, $object, $message);
	
	}

$conn->disconnetti();

?>