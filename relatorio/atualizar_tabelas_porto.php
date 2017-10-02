<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../../adm/conecta_porto.php";
include "../verifica.php";
?>

<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Tabelas Porto Seguro</td>
  </tr>
  <tr>
    <td height="50" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="50" class="style12 style15">&nbsp;&nbsp;Insira o arquivo XML </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
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

preg_match('/(VP_DOM_)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];


if($_FILES)
{
	
$arquivo = "atualizacoesTemp/".$_FILES['Filedata']['name'];
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

if( ($nomeArquivo=='VP_DOM_') && (strtoupper($extensao)=='XML') )
{

//$arquivo = "VP_DOM_201114.XML";
$xml_parser = xml_parser_create();
//if (!($fp = fopen($arquivo, "r"))) {}
$data = fread($fp, filesize($arquivo));
fclose($fp);

$xml = new SimpleXMLElement($data);
$nome_tabela=null;
echo "Tabelas Atualizadas:<br>";
	foreach ($xml->dados as $xml_elem){
	//print_r($xml_elem);
	$nome_tabela=$xml_elem->desdominio;
	//print_r($nome_tabela);
	
		// limpa a tabela
		$sql_limpar = "TRUNCATE TABLE ".strtolower($nome_tabela)."";
		$result_limpar = mysql_query($sql_limpar,$db1);
		$cont=0;
				
		foreach ($xml_elem->campo as $colunas){
		
		if (strtolower($nome_tabela)=='status'){
		$sql_inserir = "INSERT INTO ".strtolower($nome_tabela)." (`codigo`, `descricao`, `grupo`, `maisusado`, `usopermitido`, `situacaouso`) VALUES ('".$colunas->codigo."','".$colunas->descricao."','".$colunas->grupo."','".$colunas->maisusado."','".$colunas->usopermitido."','".$colunas->situacaouso."')";
		}else{
		$sql_inserir = "INSERT INTO ".strtolower($nome_tabela)." (`codigo`, `descricao`) VALUES ('".$colunas->codigo."','".$colunas->descricao."')";
		}
		$result_inserir = mysql_query($sql_inserir,$db1);
		$cont++;
		
			}
		echo $nome_tabela." : Total de registros =>".$cont."<br>";
		//echo $sql_inserir."<br>";
		
$obs.=$nome_tabela." : Total de registros =>".$cont."<br>";		
	
	}


unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_tabelas_porto - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_tabelas_porto.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} // FIM $_FILES

exit(0);
?>