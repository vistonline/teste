<?

require_once "caminhoPastas.php";

$db = mysql_connect("13.0.0.12", "webvist", "22h*sAW12@@vu!&") or print (mysql_error()); 
mysql_select_db("webvist", $db) or print(mysql_error());
mysql_set_charset('latin1',$db);

$db_sp = mysqli_connect("13.0.0.12", "webvist", "22h*sAW12@@vu!&") or die ("error"); 
mysqli_select_db($db_sp,"webvist") or die("ERRO");

if (!mysqli_set_charset($db_sp, "latin1")) {
} else {
}


// COMEÇOU A UTILIZAR PDO EM 14/04/2016
$bancoPDO = new PDO("mysql:host=13.0.0.12;dbname=webvist","webvist","22h*sAW12@@vu!&");

//header("Content-Type: text/html; charset=ISO-8859-1",true);

// SE CONECTOU CONTINUA, SENÃO PARA A EXECUÇÃO
if($db){}
	else
		{
			echo '<h1>DANCO DE DADOS TEMPORARIAMENTE INDISPON&Iacute;VEL!</h1>';
			exit();
		}
?> 