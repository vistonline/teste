<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Pecas Yassuda</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Pe&ccedil;as Yassuda</td>
  </tr>
  <tr>
    <td height="50" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato TXT</td>
    <td> <div align="left" class="style12" >
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
   <tr> 
    <td height="27" colspan="2">
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

preg_match('/(PECAYAS){1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{
	
$arquivo = "atualizacoesTemp/".$_FILES['Filedata']['name'];
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

if( $nomeArquivo=='PECAYAS' && strtoupper($extensao)=='TXT' )
{
	
//lemos o arquivo
addslashes($texto = fread($fp, filesize($arquivo)));
$array = explode("\n",$texto);

$cont1=0;

for($i=0;$i<count($array)-1;$i++)
   {

//if($i==5)break;
/*
corretor        		0 - 59 ok
susep                   60 - 75 ok 
sucursal		        76 - 78; ok
cpd 					79 - 83; ok 
*/	

$CODIGO=trim(substr($array[$i],0,3));
$DESCRICAO=substr($array[$i],3,60);


		   $sql10 = "REPLACE INTO pecasYassuda (codigo,descricao) 
				VALUES (
				'".$CODIGO."',
				'".addslashes($DESCRICAO)."')";
				$result20 = mysql_query($sql10,$db);
		   		if($result20){
					$cont1++;
					}


   }
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['Filedata']['name']);
?>
  <tr>
   <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12"><b>Quantidade de Pe&ccedil;as &nbsp;<?php echo ($i-1);?>&nbsp;</b></div></td>
  </tr>
 </table>
<?php
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_pecasYassuda - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}
	
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_pecasYassuda.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################	
	
}


?>
</body>
</html>
