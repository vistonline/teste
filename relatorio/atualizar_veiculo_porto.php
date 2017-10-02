<?php
include "../../adm/conecta.php";
include "../verifica.php";


$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" ");

?>

<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Importar  Tabelas de Veiculos Porto Seguro</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo XML </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
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

</form>

<?php

preg_match('/(VP_VEIC_)[^|]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{
	
$arquivo = "atualizacoesTemp/".$_FILES['Filedata']['name'];
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

if( ($nomeArquivo=='VP_VEIC_') && (strtoupper($extensao)=='XML') )
{
	
//$arquivo = "VP_DOM_201114.XML";
$xml_parser = xml_parser_create();
//if (!($fp = fopen($arquivo, "r"))) {}
$data = fread($fp, filesize($arquivo));
fclose($fp);
$cont=0;
$xml = new SimpleXMLElement(strtr($data, array("&"=>"e")));


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `veiculos_porto_atualizacao` (
  `codveiculo` int(11) NOT NULL,
  `codmarca` int(11) NOT NULL,
  `nommarca` varchar(30) NOT NULL,
  `nommodelo` varchar(80) NOT NULL,
  `tipveiculo` varchar(30) NOT NULL,
  `anomodelo` int(4) NOT NULL,
  `codcombustivel` int(2) NOT NULL,
  `descombustivel` varchar(30) NOT NULL,
  `qtdportas` int(2) NOT NULL,
  UNIQUE KEY `idx_veiculo` (`codveiculo`,`codmarca`,`tipveiculo`,`anomodelo`,`codcombustivel`,`qtdportas`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);


	foreach ($xml->dados as $xml_elem){

				
		foreach ($xml_elem->campo as $colunas){
		
		$sql_inserir = "INSERT INTO veiculos_porto_atualizacao (`codveiculo`, `codmarca`, `nommarca`, `nommodelo`, `tipveiculo`, `anomodelo`, `codcombustivel`, `descombustivel`, `qtdportas`) VALUES ('".$colunas->codveiculo."','".$colunas->codmarca."','".$colunas->nommarca."','".$colunas->nommodelo."','".strtr($colunas->tipveiculo,'+','')."','".$colunas->anomodelo."','".$colunas->codcombustivel."','".$colunas->descombustivel."','".$colunas->qtdportas."')";
		
		$result_inserir = mysql_query($sql_inserir,$db);
			if ($result_inserir)
				{
					$cont++;

				}
			}
		
		//print_r($sql_inserir);
	
	}


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculos_porto_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculos_porto_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.veiculos_porto TO webvist.veiculos_porto_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculos_porto";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}

$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculos_porto_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculos_porto_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculos_porto_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculos_porto_atualizacao TO webvist.veiculos_porto ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
#####################################################################


?>
  <tr>
    <td height="27" colspan="4"><center><h3>Quantidade de ve&iacute;culos Atualizados&nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade de ve&iacute;culos Atualizados ".$cont;
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_veiculo_porto - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_porto.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} // FIM $_FILES

exit(0);
?>