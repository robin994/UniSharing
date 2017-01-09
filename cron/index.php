<?

include "../storage/ConnectionDB.php";
include "../group/php/Group.php";
include "../notification/php/Notification.php";

$conn = new ConnectionDB();
$conn->connetti();

//istanzio un istanza della classe gruppo
$exipiratedGroup = new Group();
$exipiratedGroup->init();

//Creo un istanza della classe Notification che permette di inviare notifiche riguardante la conclusione di un gruppo
$sendNotification = new Notification();

//chiamo il metodo che effettua il controllo dei gruppi scaduti
//$results = $exipiratedGroup -> deleteExpiratedGroup();

//Creiamo l'oggetto della mail
$object = "Gruppo eliminato";

for ($i=0; $i< 2; $i++){

	//Creiamo il messaggio che l'utente ricevente deve visualizzare
	$message = "<html>
	<body>
	<h1>Unisharing</h1>
	<label>Siamo spiacenti. Il gruppo e' stato eliminato dal nostro database.</label>
	<p>Non abbatterti, prima o poi te la danno, nel mentre vieni su unisharing.it</p>
	</body>
	</html>";
//".$results[$i]["namegroup"]."   $exipiratedResults[$i]["admin"] count($results)

	$sendNotification -> send ("Unisharing", "robin994@hotmail.it", $object, $message);

}
$conn->disconnetti();

?>
