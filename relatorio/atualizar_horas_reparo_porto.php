<?
include "../../adm/conecta_porto.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Atualizar Tabela de Horas de Reparo (PORTO SEGURO)</title>
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
<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
  <tr>
    <td height="25" colspan="2" background="../../barra2.jpg" class="fora3 style1">&nbsp;&nbsp;Atualizar Tabela de Horas de Reparo (PORTO SEGURO)</td>
  </tr>

<TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Insira o CSV </td>
    <td> <div align="left" class="style12" style="background-color:#F9F9F9">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
  <tr> 
    <td height="27" colspan="2" bgcolor="#E9E9E9">
      <input name="button" type="submit" class="botao2" id="button" value="Atualizar" /></td>
  </tr>
</table>
</form>
<?

preg_match('/(horas_de_reparo_)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{

$arquivo = "atualizacoesTemp/horas_de_reparo_".date(Ymd)."".date('H:i').".csv";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

if( ($nomeArquivo=='horas_de_reparo_') && (strtoupper($extensao)=='CSV') )
{
//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

$array = split("\n",$texto);

//print_r($array);

 /*
 	trim($array_csv[0]) -> codigo peca
	trim($array_csv[1]) -> mecanica
	trim($array_csv[2]) -> funilaria
	trim($array_csv[3]) -> pintura
	trim($array_csv[4]) -> eletrica
	trim($array_csv[5]) -> tapecaria
	
 */
 $contador=1;
 $contador_novos=0;
 $final = sizeof($array);
   while($contador<$final)
   {
	   
	   $array_csv = split(";",$array[$contador]);
			
			if($array_csv[0]==''){
				$cod=0;
				}else{
					$cod=$array_csv[0];
					}
			if($array_csv[1]==''){
				$mec=0;
				}else{
					$mec=$array_csv[1];
					}
			if($array_csv[2]==''){
				$fun=0;
				}else{
					$fun=$array_csv[2];
					}
			if($array_csv[3]==''){
				$pint=0;
				}else{
					$pint=$array_csv[3];
					}
			if($array_csv[4]==''){
				$elet=0;
				}else{
					$elet=$array_csv[4];
					}
			if($array_csv[5]==''){
				$tap=0;
				}else{
					$tap=$array_csv[5];
					}		
			
			$sql1 = "INSERT INTO horas_reparo (codPeca,mec,fun,pint,elet,tap) 
			VALUES (
			'".trim($cod)."',
			'".trim($mec)."',
			'".trim($fun)."',
			'".trim($pint)."',
			'".trim($elet)."',
			'".trim($tap)."')";
			$result2 = mysql_query($sql1,$db1);
			if ($result2)
			{
				$mensagem="<span class='style3'>Adicionado</span>";
				$contador_novos++;
			}
				
	$array_csv ='';
	$contador++;
	}
?>
  <tr>
    <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12">Adicionados &nbsp;<? echo $contador_novos;?>&nbsp;</div></td>
  </tr>
</table>
<?
$obs="Adicionados ".$contador_novos;
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_horas_reparo_porto - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_horas_reparo_porto.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} // FIM $_FILES
?>
</body>
</html>
