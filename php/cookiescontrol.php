<?

	$cookie = json_decode($_COOKIE['user']);
	
	//accedo al nome del cookie
	var_dump($cookie->{"name"});
		
	if(isset($cookie)) {
		header("location: http://www.gazzetta.it");
	}
	
?>