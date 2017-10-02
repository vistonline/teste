<?php

include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="uploader/jquery-latest.js" type="text/javascript" language="javascript"></script>
<script src="uploader/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html";>
<link href="../../Users/estilos1.css" rel="stylesheet" type="text/css">
<title>IMPORTAR CEP</title>
<style type="text/css">
<!--
.style1 {
	color: #000;
	text-align: center;
}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style13 {
	font-size: 9px
}
.style14 {color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; }
-->
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style15 {color: #000066}
</style>
<!-- Copyright 2000, 2001, 2002, 2003, 2004, 2005 Macromedia, Inc. All rights reserved. -->
</head>

<body>

<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">Atualizar Banco de CEP - cepCid</td>  
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato TXT <br />
&nbsp;      (separado por ponto e v&iacute;rgula). </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />  
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" > 
 <tr> 
    <td height="50" colspan="2">
       <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="window.top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/atualizar.png" name="Submit" id="button" title="Atualizar" />
	</div>
      
      </td>
  </tr>
</table>
</form>
<?php


if($_FILES)
{
	
	
$arquivo = "atualizacoesTemp/".date('Ymd')."cepcid-".$_SESSION['roteirizador']."-".$_SESSION['id'].".TXT";    
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);	

if( $_FILES['Filedata']["name"]=='cepCidGeo.txt')
{
   
$fp = fopen($arquivo,'r');
//lemos o arquivo
$texto = fread($fp, filesize($arquivo));
$array = explode("\n",$texto);   
	

$contador=0;	

$cont=0; 
 $contador=1;
 $contador1=1;
  for($i=0;next($array);$i++)
   {
	   $dados = explode(";",$array[$contador]);  


if (trim($dados[0])!=''){
$sql1 = "REPLACE INTO Cepcid  
				VALUES (
				'".strtoupper(trim($dados[0]))."',
				'".strtoupper(trim($dados[2]))."',
				'".strtoupper(trim($dados[3]))."',
				'".strtoupper(trim($dados[4]))."',
				'".strtoupper(trim($dados[6]))."',
				'".strtoupper(trim($dados[7]))."',
				'".strtoupper(trim($dados[8]))."',
				'".strtoupper(trim($dados[9]))."',
				'".strtoupper(trim($dados[10]))."',
				'".strtoupper(trim($dados[11]))."',
				'".strtoupper(trim($dados[12]))."',
				'".strtoupper(trim($dados[13]))."',
				'".strtoupper(trim($dados[14]))."')";    
	
			
				$result2 = @mysql_query($sql1,$db);

}

$contador++;

	if(mysql_affected_rows()==1)
	{
	$contador1++;
	}


$adicionado=$contador1-1;
}
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['upload1']['name']);
?>
  <tr>
   <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12"><b>Quantidade de registros adicionados &nbsp;<?php echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>
<?php
	

//unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizarCEPs - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'][$indice];
	move_uploaded_file($_FILES['Filedata']['tmp_name'][$indice], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"importar_CEP.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} // FIM $FILES
?>
</body>
</html>
