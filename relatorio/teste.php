<?

$_SERVER['REMOTE_ADDR'];
	echo "<h2>Seu ip foi identificado ".$_SERVER['REMOTE_ADDR']."</h2>";
	
	
	mail ('robson.cassiano@vtnet.com.br','INVAS�O via p�gina teste.php','Tentaram acessar a lista de ADMINISTRADORES
		  IP '.$_SERVER['REMOTE_ADDR']);

exit();
?>



