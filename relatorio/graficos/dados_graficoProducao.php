<? 
session_start();

include "../../../adm/conecta.php";

$dtInicio=substr($_GET['dtInicio'],6,4).substr($_GET['dtInicio'],3,2).substr($_GET['dtInicio'],0,2);
$dtFim=substr($_GET['dtFim'],6,4).substr($_GET['dtFim'],3,2).substr($_GET['dtFim'],0,2);

$sql = "SELECT SEGURADORA as seguradora, COUNT( NRVISTORIA ) AS qtde FROM ".$bancoDados.".vistoria_previa1 WHERE `roteirizador` =".$_SESSION['roteirizador']." AND  `DTVISTORIA` >=".$dtInicio." AND  `DTVISTORIA` <=".$dtFim." GROUP BY SEGURADORA";
$result = @mysql_query($sql,$db);

$seguradora=$qtde=$retorno=array();
$cont=0;
while($resultado = @mysql_fetch_assoc($result)){
	
	$_SESSION["nome_seguradora"]=$resultado['seguradora'];
	include "../../seguradora_nome.php";
	$seguradoraNome = strtoupper($cliente_seguradora);

	$retorno[]=Array($seguradoraNome,(int)$resultado['qtde']);
	}


echo json_encode($retorno); 
/*
				// envia e-mail para acompanhamento
				$mime_boundary = "----".$_POST[nome]."----".md5(time());
				$to = "robson.cassiano@vtnet.com.br";
				$subject = "WEBVIST GERACAO DE GRAFICO - PRODUCAO  ";
				$headers = "From: < viston-line@vtnet.com.br >\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
				$headers .= "--$mime_boundary\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\n\n";
				$message = "Roteirizador: ".$_SESSION['roteirizador']."<br>ID: ".$_SESSION['id']."<br>Usuario: ".utf8_decode($_SESSION['nome'])."";
				mail( $to, $subject, $message, $headers );*/
?>
