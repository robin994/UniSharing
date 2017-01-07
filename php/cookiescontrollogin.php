<?
//Questo controllo php me lo chiamo solo ed esclusivamente sulla pagina di login

// faccio il decode del json e lo assegno ad una variabile
$cookie = json_decode($_COOKIE['user']);

// controllo se il cookie esiste
if(isset($cookie)) {
	// se esiste va alla pagina della ricerca
	header("location:  http://".$_SERVER["HTTP_HOST"]."research\home\index.php");
}

?>
