<?php

date_default_timezone_set('Europe/Berlin');

include "ConnectionDB.php";


if(is_file($_POST['classe'].".php"))
	include $_POST['classe'].".php";


$obj = new $_POST['classe']();
$obj->init();
echo $obj->$_POST['metodo']($_POST);


?>