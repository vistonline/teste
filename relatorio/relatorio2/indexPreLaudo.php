<?
@session_start();

include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
include "/var/www/html/sistema/verifica_roteirizador.php";
?>

       
          
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: VistOn-Line ::.</title>
<script src="funcoes.js" type="text/javascript"></script>
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
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="relatorio/relatorio2/relatorioPreLaudo.php">
  
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr style="background-color: #000; color:#FFF">
    <td height="50" colspan="2"><div align="center" style="color:#FFF">Relat&oacute;rio de cadastro de Pr&eacute; Laudo</div></td>
  </tr>
    <TR height="50" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
      <td height="50" colspan="2" class="style18">&nbsp; </td>
    </tr>   
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
      <td width="25%" height="50" class="style18">&nbsp;&nbsp;Usu&aacute;rio : </td>
      <td height="50" class="style18">
      <select name="usuario" id="usuario">
		<option value="">Todos vistoriadores</option>
  
           <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 and ativo = 0 ORDER BY nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	
		echo '<option value="'.$da_digitador['id'].'">'.strtoupper($da_digitador['nome']).'</option>';
	
		 } ?>
   
   
    </select>     </td>
    </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
  <td height="50" class="style18"><div align="left" id="checar_relatorio">&nbsp;&nbsp;<span class="style18">Data :</span></div></td>
  <td height="50" class="style18"> <div align="left" class="style12" >
    <input name="DATA_INICIAL" id="data1" type="text" class="style12" value=""  size="15" maxlength="10" onkeypress="mascara(this,data)" <? echo $focus;?> style="text-align:center" /><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('data1'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a>&nbsp;&nbsp;&agrave;&nbsp;&nbsp;
    <input name="DATA_FINAL" id="data2"  type="text" class="style12" value=""  size="15" maxlength="10" onkeypress="mascara(this,data)" <? echo $focus;?> style="text-align:center" /><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('data2'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a>
  </div></td>
</tr>
 <tr>
    <td height="50" colspan="2" class="style18">
    <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="./imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
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