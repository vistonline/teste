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

<form name="form3" method="post" action="./relatorio/rel_seguradorasLaudoStatus.php">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Relat&oacute;rio de Vistorias Realizadas</td>
  </tr>
  <tr onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
  		
        <td width="25%" height="50" class="style18">&nbsp;&nbsp;Status da Vistoria: </td>
      <td height="50" class="style18">
      <div id="" class="style12">
        <select name="status" id="status">
          <option value="todas">TODAS</option>
          <option value="analisadas">ANALISADAS</option>
          <option value="nao_analisadas">N&Atilde;O ANALISADAS</option>
          <option value="transmitidas">TRANSMITIDAS</option>
        </select>
      </div>      </td>
    </tr>
 <?php /*?>   
    <tr onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
  		
        <td width="25%" height="50" class="style18">&nbsp;&nbsp;Parecer da Vistoria: </td>
      <td height="50" class="style18">
      <div id="" class="style12">
        <select name="parecer" id="parecer">
          <option value="">TODAS</option>
          <option value="1">ACEITÁVEL</option>
          <option value="2">ACEITÁVEL - COM AVARIAS</option>
          <option value="3">SUJEIRO À ANÁLISE</option>
          <option value="4">SUGERIA A RECUSA</option>
        </select>
      </div>      </td>
    </tr>
        <?php */?>
        <td width="25%" height="50"class="style18">&nbsp;&nbsp;Informe o Per&iacute;odo:</td>
        <td height="50" class="style18"> <div align="left" class="style12" ><input TYPE="text" NAME="data1" VALUE="" style="text-align:center" onKeyPress="mascara(this,data)" maxlength="10" size="15" /><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.forms['form3'].data1,'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="./imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a> 
      &nbsp;a&nbsp; 
      <input TYPE="text" NAME="data2" VALUE="" style="text-align:center" onKeyPress="mascara(this,data)" maxlength="10" size="15"/><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.forms['form3'].data2,'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="./imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a></div></td>
  </tr>
   <tr> 
    <td height="50" colspan="2">
      <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="./imagens/voltar.png" style="cursor:pointer" title="voltar" onClick="window.top.novo('visualiza_relatorio','./relatorio/seguradorasAgendamentos','visualizar_relatorio');window.top.document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
        <input type="image" src="./imagens/excel_img.png" name="Submit" id="button" title="Gerar Relat&oacute;rio" />
	</div>
      </td>
  </tr>
</table>
</form>
</body>
</html>
