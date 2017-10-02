<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<title>Cidade de Atendimento SAS</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">Importar Relat&oacute;rio de Cidades de Atendimento SAS</td>
  </tr>
  <tr>
    <td height="30" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato csv <br />
&nbsp;      (separado por ponto e v&iacute;rgula). </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" size="70px" name="Filedata" id="Filedata" />
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

preg_match('/(CIDADES_ATENDIMENTO_SAS)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{
	
$arquivo = "atualizacoesTemp/CIDADES_ATENDIMENTO_SAS".date('Ymd')."-".date('His').".csv";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

if( ($nomeArquivo=='CIDADES_ATENDIMENTO_SAS') && (strtoupper($extensao)=='CSV') )
{

//lemos o arquivo
addslashes($texto = fread($fp, filesize($arquivo)));
$array = explode("\n",$texto);
$contador=1;

?> 
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="3" class="fora3 style1">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td height="27" width="5%"><span class="style12 style13">&nbsp;&nbsp;UF</span></td>
    <td height="27" width="15%"><span class="style12 style13">&nbsp;&nbsp;CIDADE ATENDIMENO</span></td>
    <td height="27" width="15%"><span class="style12 style13">&nbsp;&nbsp;CIDADE BASE</span></td>
    <td height="27" width="10%"><span class="style12 style13">&nbsp;&nbsp;PRAZO PARA ATENDIMENTO </span></td>
    <td height="27" width="10%"><span class="style12 style13">&nbsp;&nbsp;PRAZO PARA TRASMISSÃO</span></td>
    <td height="27" width="10%"><span class="style12 style13">&nbsp;&nbsp;PRAZO FOTOS</span></td>
    <td height="27" width="5%"><span class="style12 style13">&nbsp;&nbsp;VALOR</span></td>
    <td height="27" width="10%"><span class="style12 style13">&nbsp;&nbsp;KM</span></td>
    <td height="27" width="10%"><span class="style12 style13">&nbsp;&nbsp;EMPRESA</span></td>
    <td class="style14" width="10%"><span class="style12 style13">&nbsp;&nbsp;STATUS</span></td>
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
cidade_atende           $dados[1]; ok 
cidade_base	            $dados[2]; ok
prazo_atende 		    $dados[3]; ok
prazo_transmitir	    $dados[4]; ok
prazo_foto			    $dados[5]; ok
valor				    $dados[6]; ok
km		 			    $dados[7]; ok
roteirizador		    $dados[8]; ok

*/	


// pegando apenas registros de ligações o resto despresa.
if ((($dados[0]!='a')&&($dados[0]!=''))&&(($dados[1]!='CIDADES ATENDIMENTO')&&($dados[1]!=''))&&(($dados[2]!='BASE DE ATENDIMENTO')&&($dados[2]!=''))&&(($dados[6]!='VALOR')&&($dados[6]!=''))){ 
$bancoDados="webvist_".$dados[9];

//$sql1 = "REPLACE LOW_PRIORITY INTO itaceu (cliente,telefone,cidade,data,hora,duracao,tronco,tp_ligacao,custo)
$sql1 = "INSERT INTO ".$bancoDados.".cidade_atende_sas (uf,cidade_atende,cidade_base,prazo_atender,prazo_transmitir,prazo_foto,valor,km,sucursal,roteirizador) 
				VALUES (
				'".trim($dados[0])."',
				'".trim(addslashes($dados[1]))."',
				'".trim(addslashes($dados[2]))."',
				'".trim($dados[3])."',
				'".trim($dados[4])."',
				'".trim($dados[5])."',
				'".trim(strtr($dados[6],array("," => "")))."',
				'".trim(strtr($dados[7],array("-" => "")))."',
				'".trim($dados[8])."',
				'".trim($dados[9])."')";
				//print_r($sql1);
				//exit();
				$result2 = mysql_query($sql1,$db);

				if (mysql_affected_rows()==1)
				{
				$mensagem="<span class='style3'>Adicionado</span>";
				}else{
					
					$sql2 = "UPDATE ".$bancoDados.".cidade_atende_sas SET 
							prazo_atender='".trim($dados[3])."',
							prazo_transmitir='".trim($dados[4])."',
							prazo_foto='".trim($dados[5])."',
							valor='".trim(strtr($dados[6],array("," => "")))."',
							km='".trim(strtr($dados[7],array("-" => "")))."',
							sucursal='".trim($dados[8])."'
							WHERE 
							uf='".trim($dados[0])."' AND
							cidade_atende='".trim(addslashes($dados[1]))."' AND
							cidade_base='".trim(addslashes($dados[2]))."' AND
							roteirizador='".trim($dados[9])."'";
							//print_r($sql2);
							//exit();
							$result3 = mysql_query($sql2,$db);

							if (mysql_affected_rows()==1){
					$mensagem="<span class='style3'>Atualizado</span>";
							}else {
								$mensagem="<span class='style3'>Sem Alteração</span>";
								}
					}
					
$_POST['cod_prest']=$dados[9];
include "nomePrestadoraRel.php";

?> 
<tr onmouseover="this.style.backgroundColor='#DBDBDB'" onmouseout="javascript:this.style.backgroundColor=''" >
   	<td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[0]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[1]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[2]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[3]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[4]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[5]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[6]);?>&nbsp;&nbsp;</td>
    <td height="30" class="style14">&nbsp;&nbsp;<? echo trim($dados[7]);?>&nbsp;&nbsp;</td>
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
   <td height="27" colspan="10" bgcolor="#E9E9E9"><div align="center" class="style12"><b>Quantidade de registros Adicionados e/ou Atualizados&nbsp;<? echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>
<?

$obs="ARQUIVO IMPORTADO COM SUCESSO! ".$_FILES['Filedata']['name'];
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/rel_cidade_atendimento_sas - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","rel_cidade_atendimento_sas.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
