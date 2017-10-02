<?
include "../../adm/conecta.php";
include "../verifica.php";
include "../verifica_roteirizador.php";
header('Content-type: application/msexcel');
header('Content-Disposition: attachment; filename="arquivo.xls"');
?>
<link href="../../estilos1.css" rel="stylesheet" type="text/css">
<?

	$data_inicial = $_POST[DATA_INICIAL]{6}.$_POST[DATA_INICIAL]{7}.$_POST[DATA_INICIAL]{8}.$_POST[DATA_INICIAL]{9}.$_POST[DATA_INICIAL]{3}.$_POST[DATA_INICIAL]{4}.$_POST[DATA_INICIAL]{0}.$_POST[DATA_INICIAL]{1};

	$data_final = $_POST[DATA_FINAL]{6}.$_POST[DATA_FINAL]{7}.$_POST[DATA_FINAL]{8}.$_POST[DATA_FINAL]{9}.$_POST[DATA_FINAL]{3}.$_POST[DATA_FINAL]{4}.$_POST[DATA_FINAL]{0}.$_POST[DATA_FINAL]{1};
		
		$controle_prest = split(",", $_POST[controle_filial]);
		$contador=0;

while($contador<=sizeof($controle_prest)){
		
	$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND controle_prest = ".$controle_prest[$contador]." order by SEGURADORA";
	$result_vistoria = mysql_query($sql_vistoria,$db);
	if (@mysql_num_rows($result_vistoria)>0)
	 	{	
		$mensagem.="
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td height='27' class='fora4'><b>Seguradora</b></td>
<td height='27' class='fora4'><b>N&uacute;mero da vistoria</b></td>
<td height='27' class='fora4'><b>N&uacute;mero da placa</b></td>
<td height='27' class='fora4'><b>Numero do chassi</b></td>
<td height='27' class='fora4'><b>Nome do proponente</b></td>
<td height='27' class='fora4'><b>Cidade</b></td>
<td height='27' class='fora4'><b>Data da vistoria</b></td>
<td height='27' class='fora4'><b>Vistoriador</b></td>
</tr>";

	while($reg = mysql_fetch_array($result_vistoria))
	{
	
	$sql_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$reg[NUMEROSOLICITACAO];
	$result_solicitacao = mysql_query($sql_solicitacao,$db);
	$solicitacao = mysql_fetch_array($result_solicitacao);
	
	$data_vistoria = $reg[DTVISTORIA]{6}.$reg[DTVISTORIA]{7}."/".$reg[DTVISTORIA]{4}.$reg[DTVISTORIA]{5}."/".$reg[DTVISTORIA]{0}.$reg[DTVISTORIA]{1}.$reg[DTVISTORIA]{2}.$reg[DTVISTORIA]{3};
	
		$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = $reg[controle_prest]";
		$result_user = mysql_query($sql_user,$db);
		$user = mysql_fetch_array($result_user);
		switch($reg[SEGURADORA])
		{
		   case "40": $filtro='ALFA SEGUROS';break;            
		   case "73": $filtro='ALLIANZ';break;
		   case "41": $filtro='AXA SEGUROS';break;
		   case "42": $filtro='BANETES SEGUROS';break;  
		   case "0":  $filtro='Bradesco Seguros';break;       
		   case "99": $filtro='Bradesco Seguros1';break;       
		   case "43": $filtro='BRASIL VEIC.CIA SEG.';break;       
		   case "44": $filtro='CAIXA SEGURADORA';break;  
		   case "45": $filtro='CARDIF DO BRASIL SEG.';break;   
		   case "46": $filtro='CHUBB';break;     
		   case "47": $filtro='MINAS BRASIL';break;       
		   case "48": $filtro='CIA DE SEG. A BAHIA';break;   
		   case "49": $filtro='CIA MUTUAL DE SEGUROS';break; 
		   case "50": $filtro='CONAPP';break;      
		   case "74": $filtro='APROVSUL';break;        
		   case "75": $filtro='APTRANS';break;         
		   case "76": $filtro='CREDIPE';break;      
		   case "51": $filtro='CONFIANCA';break;
		   case "53": $filtro='GENERALI';break; 
		   case "54": $filtro='GENTE SEGURADORA';break;
		   case "55": $filtro='HDI';break;
		   case "56": $filtro='HSBC SEGUROS';break;
		   case "57": $filtro='INDIANA SEGUROS';break; 
		   case "85": $filtro='ITAU SEGUROS';break;       
		   case "59": $filtro='LIBERTY';break;          
		   case "60": $filtro='MAPFRE SEGUROS';break;
		   case "61": $filtro='MARITIMA';break;
		   case "83": $filtro='MITSUI';break; 
		   case "62": $filtro='PORTO SEGURO';break;
		   case "63": $filtro='REAL SEGUROS';break; 
		   case "64": $filtro='ROYAL & SUNALLIANCE';break;
		   case "65": $filtro='SAFRA VIDA E PREV.';break;
		   case "67": $filtro='SUL AMERICA';break;
		   case "69": $filtro='TOKIO MARINE';break;
		   case "70": $filtro='UNIBANCO AIG SEG.';break;
		   case "71": $filtro='VERA CRUZ';break;
		   case "72": $filtro='YASUDA SEGUROS';break;
		   case "86": $filtro='ASCARPE';break;
	   	}
	$mensagem.="<tr><td>".strtoupper($filtro)."</td><td>".$reg[NRVISTORIA]."</td><td>".strtoupper($reg[NRPLACA])."</td><td>".strtoupper($reg[NRCHASSI])."</td><td>".strtoupper($reg[NMPROPONENTE])."</td><td>".strtoupper($solicitacao[cidade])."</td><td>".$data_vistoria."</td><td>".strtoupper($user[nome])."</td></tr>";
	}
	
$mensagem.="<tr><td colspan='8'><b>Quantidade total de vistorias : ".(mysql_num_rows($result_vistoria))."</b></td></tr>";  
$mensagem.="<tr><td colspan='8'></td></tr>";  
echo $mensagem;
		}
		
$mensagem = '';
$contador++;

}

?>
