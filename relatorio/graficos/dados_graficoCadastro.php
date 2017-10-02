<? 
session_start();


include "../../../adm/conecta.php";

$dtInicio=substr($_GET['dtInicio'],6,4).substr($_GET['dtInicio'],3,2).substr($_GET['dtInicio'],0,2);
$dtFim=substr($_GET['dtFim'],6,4).substr($_GET['dtFim'],3,2).substr($_GET['dtFim'],0,2);

if($_GET['seguradora']=='GERAL (todas seguradoras)'){
	$buscaSeg="";
	}else{
		$buscaSeg="SEGURADORA= '".$_GET['seguradora']."' AND ";
		}
		
	$cont=0;
	$seguradora=$D0=$D1aD3=$D4aD5=$D6aD10=$D11aD15=$AcimaD15=array();
	
	$_SESSION["nome_seguradora"]=$_GET['seguradora'];
		
	include "../../seguradora_nome.php";
	if($cliente_seguradora==''){
		$cliente_seguradora="GERAL (todas seguradoras)";
		}

	$seguradora[]=$cliente_seguradora;

if($_GET['controle_prest']=='GERAL (todos vistoriadores)'){
	$sql2 = "SELECT DTPROC, DTVISTORIA FROM ".$bancoDados.".vistoria_previa1 WHERE ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND DTPROC >=".$dtInicio." AND DTPROC <=".$dtFim;
	}else{
		$sql2 = "SELECT DTPROC, DTVISTORIA FROM ".$bancoDados.".vistoria_previa1 WHERE ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND DTPROC >=".$dtInicio." AND DTPROC <=".$dtFim." AND controle_prest='".$_GET['controle_prest']."' OR ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND DTPROC >=".$dtInicio." AND DTPROC <=".$dtFim." AND controle_prest_filho='".$_GET['controle_prest']."'";
		}
	$result2 = @mysql_query($sql2,$db);
	$contD0=0;
	$contD1=0;
	$contD2=0;
	$contD3=0;
	$contD4=0;
	$contAcimaD5=0;
	while($resultado2 = @mysql_fetch_assoc($result2))
		{

//DEFINO DATA VISTORIA
$diaVist=substr($resultado2['DTVISTORIA'],6,2);
$mesVist=substr($resultado2['DTVISTORIA'],4,2);
$anoVist=substr($resultado2['DTVISTORIA'],0,4);

//DEFINO DATA TRANSMISSAO
$diaProc=substr($resultado2['DTPROC'],6,2);
$mesProc=substr($resultado2['DTPROC'],4,2);
$anoProc=substr($resultado2['DTPROC'],0,4);

//calculo timestam das duas datas 
$timestamp1 = mktime(0,0,0,$mesVist,$diaVist,$anoVist); 
$timestamp2 = mktime(0,0,0,$mesProc,$diaProc,$anoProc); 

//diminuo a uma data a outra    
$segundos_diferenca = $timestamp2 - $timestamp1;   
//echo $segundos_diferenca; 

//converto segundos em dias 
$dias_diferenca = $segundos_diferenca / (60 * 60 * 24); 

//obtenho o valor absoulto dos dias (tiro o possível sinal negativo) 
$dias_diferenca = abs($dias_diferenca); 

//tiro os decimais aos dias de diferença 
$prazoCadastro = floor($dias_diferenca); 

//echo $dias_diferenca; 

//$prazoTransmissao=((int)$resultado2['DTTRANS']-(int)$resultado2['DTVISTORIA']);
	
		if( $prazoCadastro==0 ){
			$contD0++;
			}elseif( $prazoCadastro==1 ){
				$contD1++;
				}elseif( $prazoCadastro==2 ){
					$contD2++;
					}elseif( $prazoCadastro==3 ){
						$contD3++;
						}elseif( $prazoCadastro==4 ){
							$contD4++;
							}else{
								$contAcimaD5++;
								}
		
		}
	
	$D0[]=(int)$contD0;
	$D1[]=(int)$contD1;
	$D2[]=(int)$contD2;
	$D3[]=(int)$contD3;
	$D4[]=(int)$contD4;
	$AcimaD5[]=(int)$contAcimaD5;


$resultado=array();
$resultado['seguradora']=$seguradora;
$resultado['contD0']=$D0;
$resultado['contD1']=$D1;
$resultado['contD2']=$D2;
$resultado['contD3']=$D3;
$resultado['contD4']=$D4;
$resultado['contAcimaD5']=$AcimaD5;


echo json_encode($resultado); 
/*
				// envia e-mail para acompanhamento
				$mime_boundary = "----".$_POST[nome]."----".md5(time());
				$to = "robson.cassiano@vtnet.com.br";
				$subject = "WEBVIST GERACAO DE GRAFICO - TRANSMISSAO  ";
				$headers = "From: < viston-line@vtnet.com.br >\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
				$headers .= "--$mime_boundary\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "Content-Transfer-Encoding: 8bit\n\n";
				$message = "Roteirizador: ".$_SESSION['roteirizador']."<br>ID: ".$_SESSION['id']."<br>Usuario: ".utf8_decode($_SESSION['nome'])."";
				mail( $to, $subject, $message, $headers );*/
?>
