<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.:: VistOn-Line ::.</title>
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

	
	<form action="listaConfiguracoes.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Configurações dos Clientes</td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Selecione o Cliente</td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="cod_prest" class="style12" id="cod_prest">
        <option value="">Selecione</option>
        <?
		$sql_user_sul = "SELECT nomeVistoriadora,roteirizador FROM webvist.controle_vp_ferramentas WHERE ativo = 0 ORDER BY nomeVistoriadora";
		$result_user_sul = mysql_query($sql_user_sul,$db);
		while($user = mysql_fetch_array($result_user_sul))
		{
		?>
        <option value="<? echo $user['roteirizador'];?>"><? echo strtoupper($user['nomeVistoriadora']);?></option>
        <?
		}
		?>
        </select>
    </div></td>
  </tr>
    <tr> 
    <td height="27" colspan="2">
      <input name="button" type="submit" class="botao2" id="button" value="Proseguir" /></td>
  </tr>
  
</table>


</form>



<?



?>
</body>
</html>
