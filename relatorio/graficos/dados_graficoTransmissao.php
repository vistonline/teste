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
	
	$seguradora=$D0=$D1aD3=$D4aD5=$D6aD10=$D11aD15=$AcimaD15=$D1=$D2=$D3=$D4=$D5=$D6=$D7=$Dacima7=array();
	
	$_SESSION["nome_seguradora"]=$_GET['seguradora'];
		
	include "../../seguradora_nome.php";
	if($cliente_seguradora==''){
		$cliente_seguradora="GERAL (todas seguradoras)";
		}
	
	$seguradora[]=$cliente_seguradora;
	
	$sql2 = "SELECT DTTRANS, ".$_GET['tipoData']." AS dataCalculo FROM ".$bancoDados.".vistoria_previa1 WHERE ".$buscaSeg." `roteirizador`=".$_SESSION['roteirizador']." AND ".$_GET['tipoData']." >=".$dtInicio." AND ".$_GET['tipoData']." <=".$dtFim;
	$result2 = @mysql_query($sql2,$db);
	$contD0=0;
	$contD1aD3=0;
	$contD4aD5=0;
	$contD6aD10=0;
	$contD11aD15=0;
	$contAcimaD15=0;
	$contD1=0;
	$contD2=0;
	$contD3=0;
	$contD4=0;
	$contD5=0;
	$contD6=0;
	$contD7=0;
	$contDacima7=0;
	while($resultado2 = @mysql_fetch_assoc($result2))
		{

//DEFINO DATA VISTORIA
$diaVist=substr($resultado2['dataCalculo'],6,2);
$mesVist=substr($resultado2['dataCalculo'],4,2);
$anoVist=substr($resultado2['dataCalculo'],0,4);

//DEFINO DATA TRANSMISSAO
$diaTrans=substr($resultado2['DTTRANS'],6,2);
$mesTrans=substr($resultado2['DTTRANS'],4,2);
$anoTrans=substr($resultado2['DTTRANS'],0,4);

//calculo timestam das duas datas 
$timestamp1 = mktime(0,0,0,$mesVist,$diaVist,$anoVist); 
$timestamp2 = mktime(0,0,0,$mesTrans,$diaTrans,$anoTrans); 

//diminuo a uma data a outra 
$segundos_diferenca = $timestamp1 - $timestamp2;          
//echo $segundos_diferenca; 

//converto segundos em dias 
$dias_diferenca = $segundos_diferenca / (60 * 60 * 24); 

//obtenho o valor absoulto dos dias (tiro o possível sinal negativo) 
$dias_diferenca = abs($dias_diferenca); 

//tiro os decimais aos dias de diferença 
$prazoTransmissao = floor($dias_diferenca); 

//echo $dias_diferenca; 

//$prazoTransmissao=((int)$resultado2['DTTRANS']-(int)$resultado2['DTVISTORIA']);
	
		
	if($_GET['seguradora']=='0' && $_SESSION['roteirizador']==1786){
		if( $prazoTransmissao==0 ){
			$contD0++;
			}elseif( $prazoTransmissao==1 ){
				$contD1++;
				}elseif( $prazoTransmissao==2 ){
					$contD2++;
					}elseif( $prazoTransmissao==3 ){
						$contD3++;
						}elseif( $prazoTransmissao==4 ){
							$contD4++;
							}elseif( $prazoTransmissao==5 ){
								$contD5++;
								}elseif( $prazoTransmissao==6 ){
									$contD6++;
									}elseif( $prazoTransmissao==7 ){
										$contD7++;
										}else{
											$contDacima7++;
											}
	}// FIM se for BRADESCO - EXCLUSIVO PARA BRADESCO - STYLLUS
	else{ // SE FOR diferente de BRADESCO
		if( $prazoTransmissao==0 ){
			$contD0++;
			}elseif( $prazoTransmissao>=1 && $prazoTransmissao<=3 ){
				$contD1aD3++;
				}elseif( $prazoTransmissao>=4 && $prazoTransmissao<=5 ){
					$contD4aD5++;
					}elseif( $prazoTransmissao>=6 && $prazoTransmissao<=10 ){
						$contD6aD10++;
						}elseif( $prazoTransmissao>=11 && $prazoTransmissao<=15 ){
							$contD11aD15++;
							}else{
								$contAcimaD15++;
								}									
		}
		
		} // fim while
	
	$D0[]=(int)$contD0;
	$D1aD3[]=(int)$contD1aD3;
	$D4aD5[]=(int)$contD4aD5;
	$D6aD10[]=(int)$contD6aD10;
	$D11aD15[]=(int)$contD11aD15;
	$AcimaD15[]=(int)$contAcimaD15;
	$D1[]=(int)$contD1;
	$D2[]=(int)$contD2;
	$D3[]=(int)$contD3;
	$D4[]=(int)$contD4;
	$D5[]=(int)$contD5;
	$D6[]=(int)$contD6;
	$D7[]=(int)$contD7;
	$Dacima7[]=(int)$contDacima7;


$resultado=array();
$resultado['seguradora']=$seguradora;
$resultado['contD0']=$D0;
$resultado['contD1aD3']=$D1aD3;
$resultado['contD4aD5']=$D4aD5;
$resultado['contD6aD10']=$D6aD10;
$resultado['contD11aD15']=$D11aD15;
$resultado['contAcimaD15']=$AcimaD15;
$resultado['contD1']=$D1;
$resultado['contD2']=$D2;
$resultado['contD3']=$D3;
$resultado['contD4']=$D4;
$resultado['contD5']=$D5;
$resultado['contD6']=$D6;
$resultado['contD7']=$D7;
$resultado['contDacima7']=$Dacima7;


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
