<?

	$cookie = $_COOKIE['user'];
	
	header("location: http://www.gazzettadellosport.it");
	
	if(isset($cookie)) {
		header("location: http://www.gazzettadellosport.it");
		exit;
	}
	
?>