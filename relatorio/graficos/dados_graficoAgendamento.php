<? 
session_start();


include "../../../adm/conecta.php";

$dtInicio=substr($_GET['dtInicio'],6,4).substr($_GET['dtInicio'],3,2).substr($_GET['dtInicio'],0,2);
$dtFim=substr($_GET['dtFim'],6,4).substr($_GET['dtFim'],3,2).substr($_GET['dtFim'],0,2);

if($_GET['seguradora']=='GERAL (todos os agendamentos)'){
	$buscaSeg="";
	}else{
		
		$_SESSION["nome_seguradora"]=$_GET['seguradora'];
		
		include "../../seguradora_nome.php";
		
		$buscaSeg="cliente= '".$cliente_seguradora."' AND ";
		}
	$cont=0;
	$seguradora=$pendente=$frustrada=$qtde=$realizada=array();
		
		if($cliente_seguradora==''){
		$cliente_seguradora="GERAL (todos os agendamentos)";
		}
	
	$seguradora[]=$cliente_seguradora;
	
	$sql2 = "SELECT checado, status_laudo FROM ".$bancoDados.".solicitacao WHERE ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND `dia` >=".$dtInicio." AND `dia` <=".$dtFim."";
	$result2 = @mysql_query($sql2,$db);
	$contPendente=0;
	$contFrustrada=0;
	$contRealizada=0;
	$contQtde=0;
	while($resultado2 = @mysql_fetch_assoc($result2))
		{
		
		
		if($resultado2['checado']=='' && $resultado2['status_laudo']==1){
			$contRealizada++;
			}elseif($resultado2['checado']==2 && $resultado2['status_laudo']==0 ){
				$contFrustrada++;
				}else{
					$contPendente++;
					}
			$contQtde++;
		}
	
	$pendente[]=(int)$contPendente;
	$frustrada[]=(int)$contFrustrada;
	$realizada[]=(int)$contRealizada;
	$qtde[]=(int)$contQtde;

	/*$mediaFrustrada1=($contFrustrada*100)/$contQtde;
	$mediaRealizada1=($contRealizada*100)/$contQtde;
	$mediaPendente1=($contPendente*100)/$contQtde;
	$mediaFrustrada0=number_format($mediaFrustrada1, 2, '.', '');
	$mediaRealizada0=number_format($mediaRealizada1, 2, '.', '');
	$mediaPendente0=number_format($mediaPendente1, 2, '.', '');*/

	$mediaFrustrada[]=(int)($contFrustrada*100)/$contQtde;
	$mediaRealizada[]=(int)($contRealizada*100)/$contQtde;
	$mediaPendente[]=(int)($contPendente*100)/$contQtde;
	$cont++;

//	if($cont==1){ break;}


$resultado=array();
$resultado['seguradora']=$seguradora;
$resultado['qtde']=$qtde;
$resultado['pendente']=$pendente;
$resultado['frustrada']=$frustrada;
$resultado['realizada']=$realizada;
$resultado['mediaFrustrada']=$mediaFrustrada;
$resultado['mediaRealizada']=$mediaRealizada;
$resultado['mediaPendente']=$mediaPendente;

echo json_encode($resultado); 

/*
				// envia e-mail para acompanhamento
				$mime_boundary = "----".$_POST[nome]."----".md5(time());
				$to = "robson.cassiano@vtnet.com.br";
				$subject = "WEBVIST GERACAO DE GRAFICO - AGENDAMENTO  ";
				$headers = "From: < viston-line@vtnet.com.br >\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
				$headers .= "--$mime_boundary\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\n\n";
				$message = "Roteirizador: ".$_SESSION['roteirizador']."<br>ID: ".$_SESSION['id']."<br>Usuario: ".utf8_decode($_SESSION['nome'])."";
				mail( $to, $subject, $message, $headers );
				
*/
?>
