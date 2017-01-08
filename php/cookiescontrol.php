<?
//Questo controllo php me lo chiamo su ogni pagina tranne per la pagina di login

// faccio il decode del json e lo assegno ad una variabile
$cookie = json_decode($_COOKIE['user']);

// controllo se il cookie non esiste
if(!isset($cookie)) {
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	setcookie('urlRequest', $actual_link, time() + (86400 * 30), "/");

	// se non esiste mi riporta alla pagina di login
	header("location: http://".$_SERVER["HTTP_HOST"]."/index.php");
}

?>
