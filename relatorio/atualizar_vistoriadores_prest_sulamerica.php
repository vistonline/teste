<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Atualizar Vistoriadores - Prestadora/Sulam�rica</title>
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

<form action="atualizar_vistoriadores_prest_sulamerica.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F3F3F3">
  <tr>
    <td height="25" colspan="2" background="../../barra2.jpg" class="fora3 style1">&nbsp;&nbsp;Atualizar Prestadores Sulamerica</td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato csv</td>
    <td> <div align="left" class="style12" style="background-color:#F9F9F9">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
      </div></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;<span class="style12" style="background-color:#F9F9F9">C&oacute;digo prestadora</span></td>
    <td> <div align="left" class="style12" style="background-color:#F9F9F9">&nbsp;
        <select name="cod_prest" class="style12" id="cod_prest">
        <option value=""></option>
        <?
		$sql_user_sul = "SELECT empresa,id FROM ".$bancoDados.".user WHERE id = ".$_SESSION['roteirizador']." order by empresa";
		$result_user_sul = mysql_query($sql_user_sul,$db);
		while($user = mysql_fetch_array($result_user_sul))
		{
		?>
        <option value="<? echo $user['id'];?>"><? echo $user['empresa'];?></option>
        <?
		}
		?>
        </select>
    </div></td>
  </tr>
  <tr> 
    <td height="27" colspan="2" bgcolor="#E9E9E9">
      <input name="button" type="submit" class="botao2" id="button" value="Atualizar" /></td>
  </tr>
</table>
</form>
<?
if($_FILES)
{
@mkdir("csv_prest_sul",0755);
$arquivo = "csv_prest_sul/csv_prest_sul_".date(Ymd)."".date('H:i').".csv";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

//transformamos as quebras de linha em etiquetas <br>
$texto = nl2br($texto);
$texto = strtr($texto,'"&',"  ");
$array = split("\n",strtr($texto,"'`","  "));

?>
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
  <tr>
    <td height="25" colspan="4" class="fora3 style1">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td height="27" bgcolor="#E9E9E9" class="style12">&nbsp;&nbsp;Nome</td>
    <td bgcolor="#E9E9E9" class="style12">&nbsp;&nbsp;C&oacute;digo</span> Sulamerica</td>
    <td height="27" bgcolor="#E9E9E9" class="style12">&nbsp;&nbsp;CPF</span></td>
    <td bgcolor="#E9E9E9" class="style12">&nbsp;&nbsp;Status</td>
  </tr>
 <? 
 $contador=2;
 $contador_novos=0;
 $contador_nao_encontrado=0;
 $final = sizeof($array)-2;
	#while($contador<$final)
	for($i=1,$j=1;$i<count($array)-1;$i++,$j++)
	{
		
		$dados_atualizacao = split(';',$array[$i]);
				
		/*
		$dados_atualizacao[0] = COD SULAMERICA
		$dados_atualizacao[1] = NOME
		$dados_atualizacao[2] = CPF
		$dados_atualizacao[3] = DATA INCLUS�O
		$dados_atualizacao[4] = CODIGO WEBVIST
		*/
		if($dados_atualizacao[0]!=''){
					$sql1 = "REPLACE INTO ".$bancoDados.".controle_vp_sul_vist (controle_prest,roteirizador,id_vist,nome,cpf,dt_inclusao) 
					VALUES (
					'".$dados_atualizacao[4]."',
					'".$_POST['cod_prest']."',
					'".$dados_atualizacao[0]."',
					'".strtr($dados_atualizacao[1], array(
														    "�" => " ", 
														    "'" => " ", 
														    "`" => " "
														    ))."',
					'".strtr($dados_atualizacao[2], array("." => "", "-"=>""))."',
					'".strtr($dados_atualizacao[3], array("-" => "/"))."')";
					
					$result2 = mysql_query($sql1,$db);

					if ($result2)
					{
						$mensagem="<span class='style3'>Adicionado/Atualizado</span>";
						$contador_novos++;
					}
					else
					{
						echo mysql_error();
					}
		}// diferente de vazio
				
				
				
 ?>
	<tr onmouseover="this.style.backgroundColor='#DBDBDB'" onmouseout="javascript:this.style.backgroundColor=''" >
   	<td height="30" class="style12">&nbsp;&nbsp;<? echo trim($dados_atualizacao[1]);?></td>
    <td height="30" class="style12">&nbsp;&nbsp;<? echo trim($dados_atualizacao[0]);?></td>
    <td height="30" class="style12">&nbsp;&nbsp;<? echo substr(trim(str_replace('.','',str_replace('-','',$dados_atualizacao[2]))),0,11);?></td>
    <td height="30" >&nbsp;&nbsp;<? echo $mensagem;?></td>
</tr>
<? 
	   }
	$contador++;
}?>
  <tr>
    <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12">quantidade de novos cadastros &nbsp;<? echo $contador_novos;?></div></td>
  </tr>
</table>

</body>
</html>
