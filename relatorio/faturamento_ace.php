<?
//include "../../adm/conecta.php";
include "../verifica.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Faturamento Exclusivo ACE Seguros</title>
<script src="../js/funcoes.js" type="text/javascript"></script>
<script type="text/javascript" src="../../js/calendar.js"></script>

<style type="text/css">
<!--
.style13 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style16 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
#Layer1 {
	position:absolute;
	left:14px;
	top:132px;
	width:424px;
	height:33px;
	z-index:1;
}
#Layer2 {
	position:absolute;
	left:569px;
	top:32px;
	width:100px;
	height:24px;
	z-index:2;
}
#Layer3 {
	position:absolute;
	left:422px;
	top:132px;
	width:381px;
	height:25px;
	z-index:3;
}
#Layer4 {
	position:absolute;
	left:363px;
	top:132px;
	width:389px;
	height:25px;
	z-index:3;
}
.style17 {color: #000000}
.style18 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	font-weight: bold;
}
#apDiv1 {
	position:absolute;
	left:572px;
	top:32px;
	width:100;
	height:34px;
	z-index:1;
}
.style19 {color: #FF0000}
.style13 div {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
</head>

<body>

<form name="form1" method="post" action="rel_faturamento_ace.php">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
  <tr  width="100%">
    <td height="25" colspan="2" background="../../barra2.jpg" style="color:#FFF; font-weight:bold"><div align="center">Faturamento Exclusivo ACE Seguros</div></td>
  </tr>

<TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >

                <tr>
                    <td><i>Data Inicial: </i>&nbsp; <input TYPE="text" NAME="data1" VALUE="" SIZE=25 onkeypress="mascara(this,data)" maxlength="10" size="10" /><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.forms['form1'].data1,'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="images/cal.png" border="0px" style=" vertical-align:bottom;" /></a></td>

                    <td><i>Data Final: </i>&nbsp; <input TYPE="text" NAME="data2" VALUE="" SIZE=25 onkeypress="mascara(this,data)" maxlength="10" size="10"/><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.forms['form1'].data2,'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="images/cal.png" border="0px" style=" vertical-align:bottom;" /></a>
 
 <tr>
    <td height="24" colspan="2" background="../../barra.jpg" class="style18"><input name="button2" type="submit" class="botao" id="button2" value="Gerar relat&oacute;rio"></td>
  </tr>
</table>
</form>
