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

<title>Atualizar Postos - Prestadora/Sulam&eacute;rica</title>
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
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Postos SulAm&eacute;rica</td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato csv</td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" size="70px" name="Filedata" id="Filedata" />
      </div></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;<span class="style12">C&oacute;digo prestadora</span></td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="cod_prest" class="style12" id="cod_prest">
        <option value=""></option>
        <?
		$sql_user_sul = "SELECT empresa,id FROM ".$bancoDados.".user WHERE id = roiterizador order by empresa";
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
<?

preg_match('/(posto_sul)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{

$arquivo = "atualizacoesTemp/csv_posto_sul - ".date(Ymd)." - ".date('H:i').".csv";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');


if( ($nomeArquivo=='posto_sul') && (strtoupper($extensao)=='CSV') )
{
//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

//transformamos as quebras de linha em etiquetas <br>
$texto = nl2br($texto);
$texto = strtr($texto,'"&',"  ");
$array = split("\n",strtr($texto,"'`","  "));

?>
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
  <tr>
    <td height="50" colspan="4" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td height="50" class="style12">&nbsp;&nbsp;Endereço</td>
    <td class="style12">&nbsp;&nbsp;Nome Posto</td>
    <td height="50" class="style12">&nbsp;&nbsp;C&oacute;digo</span></td>
    <td class="style12">&nbsp;&nbsp;Status</td>
  </tr>
 <? 
 $contador=1;
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
		$dados_atualizacao[3] = DATA INCLUSÃO
		$dados_atualizacao[4] = CODIGO WEBVIST
		*/
		if ($dados_atualizacao[0]!='' && $dados_atualizacao[0]!='INCLUSÃO / EXCLUSÃO' && $dados_atualizacao[1]!='' ){
					$sql1 = "REPLACE INTO ".$bancoDados.".contro_vp_posto (filial,cep,uf,cidade,endereco,numero,complemento,roteirizador,bairro,nome_posto,cod_sas) 
					VALUES ('001',
					'".strtr($dados_atualizacao[9], array("."=>"", "-"=>""))."',
					'".$dados_atualizacao[7]."',
					'".$dados_atualizacao[1]."',
					'".$dados_atualizacao[3]."',
					'".$dados_atualizacao[4]."',
					'".$dados_atualizacao[5]."',
					'".$_POST['cod_prest']."',
					'".$dados_atualizacao[6]."',
					'".$dados_atualizacao[2]."',
					'".$dados_atualizacao[8]."')";
					
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
				
				
				
 ?>
	<tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
   	<td height="30" class="style12">&nbsp;&nbsp;<? echo trim($dados_atualizacao[3]).", ".trim($dados_atualizacao[4])." ,".trim($dados_atualizacao[5]).", ".trim($dados_atualizacao[6]).", ".trim($dados_atualizacao[1]);?></td>
    <td height="30" class="style12">&nbsp;&nbsp;<? echo trim($dados_atualizacao[2]);?></td>
    <td height="30" class="style12">&nbsp;&nbsp;<? echo trim($dados_atualizacao[8]);?></td>
    <td height="30" >&nbsp;&nbsp;<? echo $mensagem;?></td>
</tr>
<? 
	   }
	$contador++;
	}

$obs="quantidade de novos cadastros ".$contador_novos;
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_posto_sulamerica - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}

##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_posto_sulamerica.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################


} // $_FILES

?>
  <tr>
    <td height="27" colspan="4"><div align="right" class="style12">quantidade de novos cadastros &nbsp;<? echo $contador_novos;?></div></td>
  </tr>
</table>

</body>
</html>
