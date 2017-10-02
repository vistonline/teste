<? 
session_start();

$mesAtual=(int)date('m');
if((int)$mesAtual>=4){
	$mesInicio=(int)($mesAtual-3);
	$mesFim=(int)($mesAtual);
	$mesAnterior=(int)($mesAtual-1);
	$anoInicio=date('Y');
	$anoFim=date('Y');
	$eMes01=0;
	}else if((int)$mesAtual==3){
		$mesInicio=12;
		$mesFim=03;
		$mesAnterior=02;
		$anoInicio=(date('Y')-1);
		$anoFim=date('Y');
		$eMes01=0;
		}else if((int)$mesAtual==2){
			$mesInicio=11;
			$mesFim=02;
			$mesAnterior=01;
			$anoInicio=(date('Y')-1);
			$anoFim=date('Y');
			$eMes01=0;
			}else if((int)$mesAtual==1){
				$mesInicio=10;
				$mesFim=01;
				$mesAnterior=12;
				$anoInicio=(date('Y')-1);
				$anoFim=date('Y');
				$eMes01=1;
				}

include "../../../adm/conecta.php";

$cont=0;
	
/*	if($codigoEmpresa=='160'){
		$sql2 = "SELECT id AS NRVISTORIA, data_auto AS DTPROC, roteirizador
FROM ".$bancoDados.".solicitacao
WHERE CONCAT( SUBSTR( data_auto, 7, 4 ) , SUBSTR( data_auto, 4, 2 ) , SUBSTR( data_auto, 1, 2 ) ) >=".$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT)."01
AND CONCAT( SUBSTR( data_auto, 7, 4 ) , SUBSTR( data_auto, 4, 2 ) , SUBSTR( data_auto, 1, 2 ) ) <=".$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT)."31
ORDER BY DTPROC ASC";
		}else{
			$sql2 = "SELECT NRVISTORIA,DTPROC,roteirizador FROM ".$bancoDados.".vistoria_previa1 WHERE DTPROC >=".$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT)."01 AND DTPROC <=".$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT)."31 ORDER BY DTPROC ASC";
				}*/
				
$sql2 = "SELECT NRVISTORIA,DTPROC,roteirizador FROM ".$bancoDados.".vistoria_previa1 WHERE pda=1 AND DTPROC >=".$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT)."01 AND DTPROC <=".$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT)."31 ORDER BY DTPROC ASC";	
	
$result2 = @mysql_query($sql2,$db);

	$contExcluida1=0;
	$contRealizada1=0;
	$contQtde1=0;
	
	$contExcluida2=0;
	$contRealizada2=0;
	$contQtde2=0;

	$contExcluida3=0;
	$contRealizada3=0;
	$contQtde3=0;
	
	$contExcluida4=0;
	$contRealizada4=0;
	$contQtde4=0;
	
	while($resultado2 = @mysql_fetch_assoc($result2))
		{
		
/*		if($codigoEmpresa=='160'){
			$resultado2['DTPROC']=substr($resultado2['DTPROC'],6,4).substr($resultado2['DTPROC'],3,2).substr($resultado2['DTPROC'],0,2);
			}*/
		
		switch (substr($resultado2['DTPROC'],4,2)){
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
		
		
		
		if(substr($resultado2['DTPROC'],0,6)==$anoInicio.str_pad($mesInicio,2,"0",STR_PAD_LEFT))
			{

			$mes1=$nome_mes."/".substr($resultado2['DTPROC'],2,2);
			
			if($resultado2['roteirizador']==1){
				$contExcluida1++;
				}else{
					$contRealizada1++;
						}
				$contQtde1++;
			}else if(substr($resultado2['DTPROC'],0,6)==$anoFim.str_pad($mesFim,2,"0",STR_PAD_LEFT))
				{
					
				$mes4=$nome_mes."/".substr($resultado2['DTPROC'],2,2);
				
				if($resultado2['roteirizador']==1){
				$contExcluida4++;
				}else{
					$contRealizada4++;
						}
				$contQtde4++;
				}else if( substr($resultado2['DTPROC'],0,6)==(($anoFim-$eMes01).str_pad($mesAnterior,2,"0",STR_PAD_LEFT)) )
					{
					
					$mes3=$nome_mes."/".substr($resultado2['DTPROC'],2,2);
					
					if($resultado2['roteirizador']==1){
					$contExcluida3++;
					}else{
						$contRealizada3++;
							}
					$contQtde3++;
					}
					else{
						
						$mes2=$nome_mes."/".substr($resultado2['DTPROC'],2,2);
						
						if($resultado2['roteirizador']==1){
						$contExcluida2++;
						}else{
							$contRealizada2++;
								}
						$contQtde2++;
						
						}
			
		}

	
	$excluida1=(int)$contExcluida1;
	$realizada1=(int)$contRealizada1;
	$qtde1=(int)$contQtde1;

	$excluida2=(int)$contExcluida2;
	$realizada2=(int)$contRealizada2;
	$qtde2=(int)$contQtde2;

	$excluida3=(int)$contExcluida3;
	$realizada3=(int)$contRealizada3;
	$qtde3=(int)$contQtde3;
	
	$excluida4=(int)$contExcluida4;
	$realizada4=(int)$contRealizada4;
	$qtde4=(int)$contQtde4;


	$mediaExcluida1=(int)($contExcluida1*100)/$contQtde1;
	$mediaRealizada1=(int)($contRealizada1*100)/$contQtde1;

	$mediaExcluida2=(int)($contExcluida1*100)/$contQtde2;
	$mediaRealizada2=(int)($contRealizada2*100)/$contQtde2;

	$mediaExcluida3=(int)($contExcluida3*100)/$contQtde3;
	$mediaRealizada3=(int)($contRealizada3*100)/$contQtde3;

	
	$cont++;

$resultado=array();

$mExcluida=($excluida1+$excluida2+$excluida3)/3;
$mRealizada=($realizada1+$realizada2+$realizada3)/3;

$resultado['mes']=Array($mes1,$mes2,$mes3,$mes4);
$resultado['qtde']=Array($qtde1,$qtde2,$qtde3,$qtde4);

$resultado['excluida']=Array($excluida1,$excluida2,$excluida3,$excluida4);
$resultado['realizada']=Array($realizada1,$realizada2,$realizada3,$realizada4);
$resultado['mediaExcluida']=Array($mExcluida,$mExcluida,$mExcluida);
$resultado['mediaRealizada']=Array($mRealizada,$mRealizada,$mRealizada);


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
