<?php
set_time_limit(false);

//echo "TRAVADO, RETIRAR A TRAVA";
//exit();
$ufImporta=$_GET['uf'];                                                                                                    

include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","900M");  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="uploader/jquery-latest.js" type="text/javascript" language="javascript"></script>
<script src="uploader/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>atualiza CEP do sistema</title>

<!-- Copyright 2000, 2001, 2002, 2003, 2004, 2005 Macromedia, Inc. All rights reserved. -->
</head>

<body>

<?php

  $sqlAtualiza="CREATE TABLE IF NOT EXISTS `CEP_atualizacao` (
  `numero` varchar(8) NOT NULL,
  `delt` int(50) NOT NULL,
  `delt1` int(50) NOT NULL,
  `abrev` varchar(30) NOT NULL,
  `rua` varchar(60) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cidade` varchar(60) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `Latitude` varchar(20) NOT NULL,
  `Longitude` varchar(20) NOT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);
	
$sql_3='SET SQL_BIG_SELECTS=1';
$resultado_3 = @mysql_query($sql_3,$db);
	
$sql_baseCorreio = "SELECT log.CEP8,cid.Chave, log.Tipo_Oficial,log.Nome_Oficial,log.Bairro1_Oficial,cid.Cidade_Oficial,cid.Uf,log.Latitude,log.Longitude FROM webvist.Cepcid cid, webvist.CepLog log WHERE cid.Chave=log.CHAVE AND cid.Uf=log.UF AND cid.Uf='".$ufImporta."' ORDER BY log.CEP8"; 
$resultado_baseCorreio = @mysql_query($sql_baseCorreio,$db);

$contador=0;
		
  while($dados = @mysql_fetch_array($resultado_baseCorreio))
   {
	   

if (trim($dados['CEP8'])!=''){
$sql1 = "INSERT INTO CEP_atualizacao  
				VALUES (
				'".strtoupper(trim($dados['CEP8']))."',
				'0',
				'0',
				'".strtoupper(trim($dados['Tipo_Oficial']))."',
				'".strtoupper(trim($dados['Nome_Oficial']))."',
				'".strtoupper(trim($dados['Bairro1_Oficial']))."',
				'".strtoupper(trim($dados['Cidade_Oficial']))."',
				'".strtoupper(trim($dados['Uf']))."',
				'".strtoupper(trim($dados['Cidade_Oficial']))."',
				'".strtoupper(trim($dados['Latitude']))."',
				'".strtoupper(trim($dados['Longitude']))."')";  
				
				$result1 = @mysql_query($sql1,$db);

}

	if(mysql_affected_rows()==1)
	{
	$contador++;
	}


}
	
$sql_baseCorreio2 = "SELECT log.CEP8,cid.Chave, log.Tipo_Oficial,log.Nome_Oficial,log.Bairro1_Oficial,cid.Cidade_Oficial,cid.Uf,log.Latitude,log.Longitude FROM webvist.Cepcid cid, webvist.CepLog log WHERE CONCAT(log.CHAVE,'000')=cid.Cepmin AND cid.Uf=log.UF AND cid.Uf='".$ufImporta."' AND log.Flag=6 ORDER BY log.CEP8"; 
$resultado_baseCorreio2 = @mysql_query($sql_baseCorreio2,$db);

$contador2=0;
		
  while($dados2 = @mysql_fetch_array($resultado_baseCorreio2))
   {
	   

if (trim($dados2['CEP8'])!=''){
$sql2 = "INSERT INTO CEP_atualizacao  
				VALUES (
				'".strtoupper(trim($dados2['CEP8']))."',
				'0',
				'0',
				'".strtoupper(trim($dados2['Tipo_Oficial']))."',
				'".strtoupper(trim($dados2['Nome_Oficial']))."',
				'".strtoupper(trim($dados2['Bairro1_Oficial']))."',
				'".strtoupper(trim($dados2['Cidade_Oficial']))."',
				'".strtoupper(trim($dados2['Uf']))."',
				'".strtoupper(trim($dados2['Cidade_Oficial']))."',
				'".strtoupper(trim($dados2['Latitude']))."',
				'".strtoupper(trim($dados2['Longitude']))."')";  
				
				$result2 = @mysql_query($sql2,$db);

}

	if(mysql_affected_rows()==1)
	{
	$contador2++;
	}


}
	
$sql_baseCorreio3 = "SELECT Cepmin,Cidade_Oficial,Uf,Latitude,Longitude FROM webvist.Cepcid WHERE Uf='".$ufImporta."' AND Chave!='L' ORDER BY Cepmin"; 
$resultado_baseCorreio3 = @mysql_query($sql_baseCorreio3,$db);

$contador3=0;   
		
  while($dados3 = @mysql_fetch_array($resultado_baseCorreio3))
  {

if (trim($dados3['Cepmin'])!=''){
$sql3 = "INSERT INTO CEP_atualizacao  
				VALUES (
				'".strtoupper(trim($dados3['Cepmin']))."',
				'0',
				'0',
				'',
				'',
				'',
				'".strtoupper(trim($dados3['Cidade_Oficial']))."',
				'".strtoupper(trim($dados3['Uf']))."',
				'".strtoupper(trim($dados3['Cidade_Oficial']))."',
				'".strtoupper(trim($dados3['Latitude']))."',
				'".strtoupper(trim($dados3['Longitude']))."')";  
				
				$result3 = @mysql_query($sql3,$db);

}

	if(mysql_affected_rows()==1)
	{
	$contador3++;
	}
	  
  }

?>
  <tr>
   <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12"><b>UF: &nbsp;<?php echo $_GET['uf'];?>&nbsp;<br><b>Quantidade de registros adicionados &nbsp;<?php echo $contador;?>&nbsp;<br>CEP ESPECIAL: Quantidade de registros adicionados &nbsp;<?php echo $contador2;?>&nbsp;<br>CEP UNICO: Quantidade de registros adicionados &nbsp;<?php echo $contador3;?>&nbsp;<br>TOTAL GERAL: Quantidade de registros adicionados &nbsp;<?php echo $contador+$contador2+$contador3;?>&nbsp;</b></div></td>
  </tr>
</table>
</body>
</html>
