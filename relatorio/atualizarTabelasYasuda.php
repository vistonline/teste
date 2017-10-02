<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../../adm/conecta_yasuda.php";
include "../verifica.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8">
<title>Atualizar tabelas Yasuda</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Importar Arquivos - Atualiza&ccedil;&atilde;o de Tabelas Yasuda</td>
  </tr>
  <tr>
    <td height="50" colspan="2" class="style12 style15">&nbsp;&nbsp;Selecione a Tabela que ser&aacute; atualizada
    <select id="tabela" name="tabela">
    	<option value="">Escolha</option>
        <option value="acessorios">Acessorios</option>
        <option value="avarias">Avarias</option>
        <option value="categoriaEmplacamento">Categoria Emplacamento</option>
        <option value="cilindrada">Cilindrada</option>
        <option value="combustivelAdaptado">Combust&iacute;vel Adaptado</option>
        <option value="codigoRessalva">C&oacute;digo Ressalva</option>
        <option value="condicaoBlindagem">Condi&ccedil;&atilde;o Blindagem</option>
        <option value="condicaoCarroceria">Condicao Carroceria</option>
        <option value="condicaoChassi">Condi&ccedil;&atilde;o do Chassi</option>
        <option value="condicaoMotor">Condi&ccedil;&atilde;o do Motor</option>
        <option value="cores">Cores</option>
        <option value="destinacaoVeiculo">Destina&ccedil;&atilde;o Ve&iacute;culo</option>
        <option value="equipamentos">Equipamentos</option>
        <option value="equipamentosAntifurto">Equipamentos Anti-furto</option>
    	<option value="finalidade">Finalidade</option>
        <option value="marcaCarroceria">Marca Carroceria</option>
        <option value="motivoFrustracao">Motivo Frustra&ccedil;&atilde;o</option>
        <option value="opcionais">Opcionais</option>
        <option value="pecasAvariadas">Pe&ccedil;as Avariadas</option>
        <option value="restricaoDocumento">Restri&ccedil;&atilde;o de Documento</option>
        <option value="status">Status</option>
        <option value="tipoCarroceria">Tipo Carroceria</option>
        <option value="tipoCombustivel">Tipo Combust&iacute;vel</option>
        <option value="usoVeiculo">Uso Ve&iacute;culo</option>
       <!-- <option value="veiculo">Marca-tipo Ve&iacute;culo</option> -->
      </select>
    </td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="50" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato csv <br />
&nbsp;      (separado por ponto e v&iacute;rgula). </td>
    <td> <div align="left" class="style12" >
      &nbsp;
      <input type="file" size="70px" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
  <tr> 
    <td height="27" colspan="2" >
       <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/atualizar.png" name="Submit" id="button" title="Atualizar" />
	</div>
      
      
      </td>
  </tr>
</table>
</form>
<?php

preg_match('/(Yasuda_)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{
	
$arquivo = "atualizacoesTemp/".$_FILES['Filedata']['name'];
move_uploaded_file(strtr($_FILES['Filedata']['tmp_name'],array("�"=>"A","�"=>"A","�"=>"E","�"=>"O","�"=>"U","�"=>"A","�"=>"O","�"=>"A","�"=>"E","�"=>"I","�"=>"O","�"=>"U","�"=>"C","�"=>"U","&"=>"e","�"=>"","'"=>"","("=>"",")"=>"","{"=>"","}"=>"","["=>"","]"=>"","�"=>"","�"=>"","�"=>"","�"=>"A","�"=>"A","�"=>"E","�"=>"O","�"=>"U","�"=>"A","�"=>"O","�"=>"A","�"=>"E","�"=>"I","�"=>"O","�"=>"U","�"=>"C","�"=>"U"," "=>"_")), $arquivo);
$fp = fopen($arquivo,'r');

if( ($nomeArquivo=='Yasuda_') && (strtoupper($extensao)=='CSV') )
{

//lemos o arquivo
addslashes($texto = fread($fp, filesize($arquivo)));
$array = explode("\n",$texto);
$contador=0;


?> 
<table width="100%" border="00" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="25" colspan="3" style="color:#FFF; background:#000; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <?php 
 
 
 //$contador=1;
 $contador1=0;
//  for($i=0;current($array);next($array),$i++)
for($i=1;$i<count($array)-1;$i++)
   {
   $dados = explode(";",$array[$i]);
//print_r($dados);

if($_POST['tabela']=="motivoFrustracao"){
$criarTabela="CREATE TABLE IF NOT EXISTS ".$_POST['tabela']." (`id` int(6) NOT NULL,`descricao` varchar(60) NOT NULL,`codStatus` int(6) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM";
}
else{
	$criarTabela="CREATE TABLE IF NOT EXISTS ".$_POST['tabela']." (`id` int(6) NOT NULL,`descricao` varchar(60) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM";
	}

$result=mysql_query($criarTabela,$db1);


if($_POST['tabela']=="motivoFrustracao"&&$dados[1]!=''){
preg_match('/\d/i', trim($dados[3]), $result);
$codStatus=$result[0];

$sql1 = "INSERT IGNORE INTO ".$_POST['tabela']." (id,descricao,codStatus) VALUES ('".trim($dados[1])."', '".trim(utf8_encode($dados[2]))."', '".$codStatus."')";
if(trim($dados[1])!=''){
$contador1++;
}
}
else{
	
	$sql1 = "INSERT IGNORE INTO ".$_POST['tabela']." (id,descricao) VALUES ('".trim($dados[1])."', '".trim(utf8_encode($dados[2]))."')";
	if(trim($dados[1])!=''){
	$contador1++;
	}
	}

$result=mysql_query($sql1,$db1);

$contador++;

$adicionado=$contador1-1;
}
   
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['Filedata']['name']);
?>
  <tr>
   <td height="50" colspan="4" ><div align="right" class="style12"><b>Quantidade de registros Atualizados &nbsp;<?php echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>

<?
$obs="Quantidade de registros Atualizados ".$adicionado;
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizarTabelasYasuda - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>N�o foi poss�vel atualizar a tabela pois o arquivo enviado est� em formato inv�lido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="N�o foi poss�vel atualizar a tabela pois o arquivo enviado est� em formato inv�lido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizarTabelasYasuda.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
