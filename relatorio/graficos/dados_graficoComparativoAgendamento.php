<? 
session_start();

$mesAtual=(int)date('m');
if((int)$mesAtual>=4){
	$mesInicio=(int)($mesAtual-3);
	$mesFim=(int)($mesAtual-1);
	$anoInicio=date('Y');
	$anoFim=date('Y');
	}else if((int)$mesAtual==3){
		$mesInicio=12;
		$mesFim=02;
		$anoInicio=(date('Y')-1);
		$anoFim=date('Y');
		}else if((int)$mesAtual==2){
			$mesInicio=11;
			$mesFim=01;
			$anoInicio=(date('Y')-1);
			$anoFim=date('Y');
			}else if((int)$mesAtual==1){
				$mesInicio=10;
				$mesFim=12;
				$anoInicio=(date('Y')-1);
				$anoFim=(date('Y')-1);
				}

include "../../../adm/conecta.php";

if($_GET['seguradora']=='GERAL (todos os agendamentos)'){
	$buscaSeg="";
	}else{
		
		$_SESSION["nome_seguradora"]=$_GET['seguradora'];
		
		include "../../seguradora_nome.php";
		
		$buscaSeg="cliente= '".$cliente_seguradora."' AND ";
		}
	$cont=0;
//	$seguradora=$pendente1=$frustrada1=$qtde1=$realizada1=$pendente2=$frustrada2=$qtde2=$realizada2=$pendente3=$frustrada3=$qtde3=$realizada3=array();
		
		if($cliente_seguradora==''){
		$cliente_seguradora="GERAL (todos os agendamentos)";
		}
	
	$seguradora[]=$cliente_seguradora;
	
	$sql2 = "SELECT checado, status_laudo, dia FROM ".$bancoDados.".solicitacao WHERE ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND `dia` >=".$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT)."01 AND `dia` <=".$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT)."31 order by dia ASC";
	$result2 = @mysql_query($sql2,$db);

	$contPendente1=0;
	$contFrustrada1=0;
	$contRealizada1=0;
	$contQtde1=0;
	$contPendente2=0;
	$contFrustrada2=0;
	$contRealizada2=0;
	$contQtde2=0;
	$contPendente3=0;
	$contFrustrada3=0;
	$contRealizada3=0;
	$contQtde3=0;
	
	while($resultado2 = @mysql_fetch_assoc($result2))
		{
		
		switch (substr($resultado2['dia'],4,2)){
		case '01': $nome_mes="Jan"; break;
		case '02': $nome_mes="Fev"; break;
		case '03': $nome_mes="Mar"; break;
		case '04': $nome_mes="Abr"; break;
		case '05': $nome_mes="Mai"; break;
		case '06': $nome_mes="Jun"; break;
		case '07': $nome_mes="Jul"; break;
		case '08': $nome_mes="Ago"; break;
		case '09': $nome_mes="Set"; break;
		case '10': $nome_mes="Out"; break;
		case '11': $nome_mes="Nov"; break;
		case '12': $nome_mes="Dez"; break;
		default:break;
		}
		
		
		
		if(substr($resultado2['dia'],0,6)==$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT))
			{

			$mes1=$nome_mes."/".substr($resultado2['dia'],2,2);
			
			if($resultado2['checado']=='' && $resultado2['status_laudo']==1){
				$contRealizada1++;
				}elseif($resultado2['checado']==2 && $resultado2['status_laudo']==0 ){
					$contFrustrada1++;
					}else{
						$contPendente1++;
						}
				$contQtde1++;
			}else if(substr($resultado2['dia'],0,6)==$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT))
				{
					
				$mes3=$nome_mes."/".substr($resultado2['dia'],2,2);
				
				if($resultado2['checado']=='' && $resultado2['status_laudo']==1){
				$contRealizada3++;
				}elseif($resultado2['checado']==2 && $resultado2['status_laudo']==0 ){
					$contFrustrada3++;
					}else{
						$contPendente3++;
						}
				$contQtde3++;
				}else{
					
					$mes2=$nome_mes."/".substr($resultado2['dia'],2,2);
					
					if($resultado2['checado']=='' && $resultado2['status_laudo']==1){
					$contRealizada2++;
					}elseif($resultado2['checado']==2 && $resultado2['status_laudo']==0 ){
						$contFrustrada2++;
						}else{
							$contPendente2++;
							}
					$contQtde2++;
					
					}
			
		}

	
	$pendente1=(int)$contPendente1;
	$frustrada1=(int)$contFrustrada1;
	$realizada1=(int)$contRealizada1;
	$qtde1=(int)$contQtde1;
	$pendente2=(int)$contPendente2;
	$frustrada2=(int)$contFrustrada2;
	$realizada2=(int)$contRealizada2;
	$qtde2=(int)$contQtde2;
	$pendente3=(int)$contPendente3;
	$frustrada3=(int)$contFrustrada3;
	$realizada3=(int)$contRealizada3;
	$qtde3=(int)$contQtde3;


	$mediaFrustrada1=(int)($contFrustrada1*100)/$contQtde1;
	$mediaRealizada1=(int)($contRealizada1*100)/$contQtde1;
	$mediaPendente1=(int)($contPendente1*100)/$contQtde1;
	$mediaFrustrada2=(int)($contFrustrada1*100)/$contQtde2;
	$mediaRealizada2=(int)($contRealizada2*100)/$contQtde2;
	$mediaPendente2=(int)($contPendente2*100)/$contQtde2;
	$mediaFrustrada3=(int)($contFrustrada3*100)/$contQtde3;
	$mediaRealizada3=(int)($contRealizada3*100)/$contQtde3;
	$mediaPendente3=(int)($contPendente3*100)/$contQtde3;
	
	$cont++;

//	if($cont==1){ break;}

/*$vetor1=array();
$vetor1[] = 
                  "qtde" = Array($qtde1,$qtde2,$qtde3),
                  "pendente" => $pendente1,$pendente2,$pendente3,
				  "frustrada" => $frustrada1,$frustrada2,$frustrada3,
                  "realizada" => $realizada1,$realizada2,$realizada3,
				  "mediaFrustrada" => $mediaFrustrada1,$mediaFrustrada2,$mediaFrustrada3,
				  "mediaRealizada" => $mediaRealizada1,$mediaRealizada2,$mediaRealizada3,
				  "mediaPendente" => $mediaPendente1,$mediaPendente2,$mediaPendente3,
				  "seguradora" => $cliente_seguradora
                  ;
*/
$resultado=array();
$resultado['seguradora']=$seguradora;
$resultado['mes']=Array($mes1,$mes2,$mes3);
$resultado['qtde']=Array($qtde1,$qtde2,$qtde3);
$resultado['pendente']=Array($pendente1,$pendente2,$pendente3);
$resultado['frustrada']=Array($frustrada1,$frustrada2,$frustrada3);
$resultado['realizada']=Array($realizada1,$realizada2,$realizada3);
$resultado['mediaFrustrada']=Array($mediaFrustrada1,$mediaFrustrada2,$mediaFrustrada3);
$resultado['mediaRealizada']=Array($mediaRealizada1,$mediaRealizada2,$mediaRealizada3);
$resultado['mediaPendente']=Array($mediaPendente1,$mediaPendente2,$mediaPendente3);

echo json_encode($resultado); 
/*
				// envia e-mail para acompanhamento
				$mime_boundary = "----".$_POST[nome]."----".md5(time());
				$to = "robson.cassiano@vtnet.com.br";
				$subject = "WEBVIST GERACAO DE GRAFICO - COMPARATIVO AGENDAMENTO  ";
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
