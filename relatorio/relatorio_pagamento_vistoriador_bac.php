<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../js/calendar.js"></script>
<script src="../js/funcoes.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.:: VistOn-Line ::.</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style3 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	}
.style2 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #003399;
}
</style>
</head>

<body>

<form name="form1" method="post" action="gerar_relatorio_fatcom_bac.php">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Faturamento Exclusivo BAC</td>
  </tr>
  <tr onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
  		<td width="25%" height="50"class="style18">&nbsp;&nbsp;Informe o Per&iacute;odo:</td>
        <td height="50" class="style18"> <div align="left" class="style12" ><input name="DATA_INICIAL" type="text" class="fora4" id="DATA_INICIAL" size="15" maxlength="10" style="text-align:center" onKeyPress="mascara(this,data)" ><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('DATA_INICIAL'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="../imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a> 
      &nbsp;a&nbsp; 
      <input name="DATA_FINAL" type="text" class="fora4" id="DATA_FINAL" size="15" maxlength="10" style="text-align:center" onKeyPress="mascara(this,data)" ><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('DATA_FINAL'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="../imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a></div></td>
  </tr>
        <tr onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="50"class="style18">&nbsp;&nbsp;Escolha um BAC:</td>
    <td height="50" colspan="2" >
    <label>
      <select name="controle_bac" class="style12" id="controle_bac">
    <option value="">Nenhum BAC</option>
    <option value="TODOS">Todos</option>
        <? 
		$sql_bac = "SELECT * FROM ".$bancoDados.".contro_vp_posto WHERE bac=1 AND ativo=0 AND roteirizador=".$_SESSION[roteirizador]." ORDER BY nome_posto";
		$result_bac = mysql_query($sql_bac,$db);
		if (mysql_num_rows($result_bac)>0)
		{
			while ($bac= mysql_fetch_array($result_bac))
			{
	  ?>
        <option value="<? echo $bac[cep];?>"<?
		 if($bac[cep]==$contro_vp_posto[CEPVISTORIA]&&$_GET[acao]=='criar'){echo "selected";}
		 if($bac[cep]==$reg[CEPVISTORIA]&&$_GET[acao]=='editar'||$bac[cep]==$reg[CEPVISTORIA]&&$_GET[acao]=='visualizar'){echo "selected";}
		 
		 ?>><? echo strtoupper($bac[nome_posto]);?></option>
        <?
	  		 }
	 	 }
	  ?>
      </select>
    </label></td>
  </tr> 
  <tr onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
  	<td width="25%" height="50"class="style18">&nbsp;&nbsp;Escolha o Tipo de Relat&oacute;rio:</td>
    <td height="50" colspan="2" > <label>
      <input type="radio" name="tipo" value="txt" id="tipo_0" />
      FATCOM (TXT)</label>
    <br />
    <label>
      <input type="radio" name="tipo" value="xls" id="tipo_1" />
      EXCEL</label></td>
  </tr>
   <tr> 
    <td height="50" colspan="2">
      <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onClick="window.top.novo('financeiro','financeiro','checar_body');window.top.document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/atualizar.png" name="Submit" id="button" title="Gerar Relat&oacute;rio" />
	</div>
      </td>
  </tr>
</table>
</form>
</body>
</html>
