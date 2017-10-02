<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
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

	
	<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Importar Cidades de atendimento Sancor</td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;C&oacute;digo prestadora</td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="cod_prest" class="style12" id="cod_prest">
        <option value=""></option>
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
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato csv <br />
&nbsp;      (separado por ponto e v&iacute;rgula). </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
  <tr> 
    <td height="27" colspan="2">
      <input name="button" type="submit" class="botao2" id="button" value="Atualizar" /></td>
  </tr>
</table>
</form>
<?


if($_FILES)
{
	
$arquivo = "atualizacoesTemp/".date('Ymd')."-".date('His').".csv";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');


//lemos o arquivo
addslashes($texto = fread($fp, filesize($arquivo)));
$array = explode("\n",$texto);
$contador=1;

?> 
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
  <tr>
    <td height="25" colspan="3" background="../../Users/barra2.jpg" class="fora3 style1">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td height="27" bgcolor="#E9E9E9" width="5%"><span class="style12 style13">&nbsp;&nbsp;UF</span></td>
    <td height="27" bgcolor="#E9E9E9" width="15%"><span class="style12 style13">&nbsp;&nbsp;CIDADE BASE</span></td>
    <td height="27" bgcolor="#E9E9E9" width="15%"><span class="style12 style13">&nbsp;&nbsp;CIDADE ATENDIMENTO</span></td>
    <td height="27" bgcolor="#E9E9E9" width="10%"><span class="style12 style13">&nbsp;&nbsp;KM</span></td>
    <td height="27" bgcolor="#E9E9E9" width="10%"><span class="style12 style13">&nbsp;&nbsp;EMPRESA</span></td>
    <td bgcolor="#E9E9E9" class="style14" width="10%"><span class="style12 style13">&nbsp;&nbsp;STATUS</span></td>
  </tr> 
 <? 
 
 //$contador=1;
 $contador1=1;
//  for($i=0;current($array);next($array),$i++)
for($i=1,$j=1;$i<count($array)-1;$i++,$j++)
   {
   $dados = explode(";",$array[$i]);
//print_r($dados);

//select 
/*

uf           		    $dados[0]; ok
cidade_base	            $dados[1]; ok
cidade_atende           $dados[2]; ok 


*/	
$cidadeBase=strtr(trim($dados[1]), array('á' => 'a','à' => 'a','ã' => 'a','â' => 'a','é' => 'e','ê' => 'e','í' => 'i','ó' => 'o','ô' => 'o','õ' => 'o','ú' => 'u','ü' => 'u','*' => '_','ç' => 'c','Á' => 'A','À' => 'A','Ã' => 'A','Â' => 'A','É' => 'E','Ê' => 'E','Í' => 'I','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ú' => 'U','Ü' => 'U','Ç' => 'C', "'"=>"", "`"=>""));
$cidadeAtende=strtr(trim($dados[2]), array('á' => 'a','à' => 'a','ã' => 'a','â' => 'a','é' => 'e','ê' => 'e','í' => 'i','ó' => 'o','ô' => 'o','õ' => 'o','ú' => 'u','ü' => 'u','*' => '_','ç' => 'c','Á' => 'A','À' => 'A','Ã' => 'A','Â' => 'A','É' => 'E','Ê' => 'E','Í' => 'I','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ú' => 'U','Ü' => 'U','Ç' => 'C', "'"=>"", "`"=>""));


// pegando apenas registros de ligações o resto despresa.
if ((($dados[0]!='UF')&&($dados[0]!=''))&&(($dados[1]!='CIDADE BASE')&&($dados[1]!=''))&&(($dados[2]!='CIDADE REALIZAÇÃO')&&($dados[2]!=''))){ 
$bancoDados="webvist_".$_POST['cod_prest'];

$sql1 = "INSERT INTO ".$bancoDados.".cidades_deslocamento (uf,cidade_base,cidade_atende,km,roteirizador) 
				VALUES (
				'".trim(strtoupper($dados[0]))."',
				'".trim(strtoupper($cidadeBase))."',
				'".trim(strtoupper($cidadeAtende))."',
				'0',
				'".$_POST['cod_prest']."')";

				$result2 = mysql_query($sql1,$db);

				if (mysql_affected_rows()==1)
				{
				$mensagem="<span class='style3'>Adicionado</span>";
				}else{
					$mensagem="<span class='style3' style='color:#FF0000'>Sem Altera&ccedil;&atilde;o</span>";
					}
					


switch(trim($_POST['cod_prest'])){
	case 123: $empresa = "TESTE TI"; break;
	case 0: $empresa = "BS2"; break;
	case 20: $empresa = "ACONFERIR"; break;
	case 60 : $empresa = "EXCEL"; break;
	case 70 : $empresa = "JEF"; break;
	case 75 : $empresa = "VISION"; break;
	case 80 : $empresa = "OK VISTORIAS"; break;
	case 90 : $empresa = "REALIZA VISTORIAS"; break;
	case 100 : $empresa = "VS VISTORIAS"; break;
	case 110 : $empresa = "PREVICAR VISTORIAS"; break;
	case 140 : $empresa = "ETH VISTORIAS"; break;
	case 150 : $empresa = "CENTRAL VISTORIAS"; break;
	case 160 : $empresa = "MINAS ROTA VISTORIAS"; break;
	case 170 : $empresa = "BRAGA VISTORIAS"; break;
	case 180 : $empresa = "VIP VISTORIAS"; break;
	case 1786: $empresa = "STYLLUS"; break;
	case 627: $empresa = "3 VIA"; break;
	default:break;
	}
?> 
<tr onmouseover="this.style.backgroundColor='#DBDBDB'" onmouseout="javascript:this.style.backgroundColor=''" >
   	<td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[0]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($cidadeBase);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($cidadeAtende);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[3]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($empresa);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo $mensagem;?>&nbsp;&nbsp;</td>
  </tr> 
<?


$contador++;
	if(mysql_affected_rows()==1)
	{
	$contador1++;
	}
$adicionado=$contador1-1;
}
   }
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['Filedata']['name']);
?>
  <tr>
   <td height="27" colspan="10" bgcolor="#E9E9E9"><div align="center" class="style12"><b>Quantidade de registros Adicionados&nbsp;<? echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>
<?
}
?>
</body>
</html>
