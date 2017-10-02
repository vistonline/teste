<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","9000M");


$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','·'=>'a','‡'=>'a','‚'=>'a','„'=>'a','‰'=>'a','¡'=>'A','¿'=>'A','¬'=>'A','√'=>'A','ƒ'=>'A','È'=>'e','Ë'=>'e','Í'=>'e','Í'=>'e','…'=>'E','»'=>'E',' '=>'E','À'=>'E','Ì'=>'i','Ï'=>'i','Ó'=>'i','Ô'=>'i','Õ'=>'I','Ã'=>'I','Œ'=>'I','œ'=>'I','Û'=>'o','Ú'=>'o','Ù'=>'o','ı'=>'o','ˆ'=>'o','”'=>'O','“'=>'O','‘'=>'O','’'=>'O','÷'=>'O','˙'=>'u','˘'=>'u','˚'=>'u','¸'=>'u','⁄'=>'U','Ÿ'=>'U','€'=>'U','Á'=>'c','«'=>'C','Ò'=>'n','—'=>'N','&'=>'&',"'"=>" ","`"=>" "); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html">
<title>Atualizar Corretor HDI</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Corretor HDI</td>
  </tr>
  <tr>
    <td height="27" colspan="2" ><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato XLSX<span style="color:#F00">(Se estiver no formato XLS abra e salve no formato XLSX primeiro)</span></td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
   <tr> 
    <td height="27" colspan="2">
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
<?php

if($_FILES)
{



$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".xlsx";    
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$arquivoNovo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".csv";

require_once 'Classes/PHPExcel/IOFactory.php';
// IDENTIFICA O FORMADO DO ARQUIVO
$fileType=PHPExcel_IOFactory::identify($arquivo);
//print_r($_FILES);	

$excel = PHPExcel_IOFactory::load($arquivo);
$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer->setDelimiter(";");
$writer->setEnclosure("");
$writer->setLineEnding("\n");
$writer->save($arquivoNovo);

$fp = fopen($arquivoNovo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivoNovo));
$array = explode("\n",$texto);
$contador=0;


$conteudoRecebido=substr($array[0],0,48);


if( ($fileType=='Excel2007') && ($conteudoRecebido=='Tipo;SUSEP;Cod. Interno;Produtor;Sucursal;E-mail') )
{


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `corretor_hdi_atualizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corretor` varchar(100) CHARACTER SET latin1 NOT NULL,
  `susep` varchar(14) CHARACTER SET latin1 NOT NULL,
  `cod_interno` varchar(14) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_corretor` (`susep`),
  KEY `idx_nome` (`corretor`)
) ENGINE=MYISAM DEFAULT CHARSET=ascii AUTO_INCREMENT=1 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);


	
for($i=1;$i<count($array)-1;$i++)
   {

	$dados = explode(";",$array[$i]);


//if($i==5)break;

/*
corretor        		$dados[3] ok
susep                   $dados[1] ok 
cod_interno 			$dados[2] ok 
*/	

$susep=trim($dados[1]);
$cod_interno=trim($dados[2]);
$corretor=trim($dados[3]);
$email=trim($dados[5]);
/*
if(isset($dados[6])){
$email=trim($dados[5].",".$dados[6]);
}else{
		$email=trim($dados[3]);
		}
*/

$sql1 = "REPLACE INTO corretor_hdi_atualizacao (susep,cod_interno,email,corretor) 
				VALUES (
				'".$susep."',
				'".$cod_interno."',
				'".$email."',
				'".strtr($corretor,$tiraAcentos)."')";
				$result2 = mysql_query($sql1,$db);


				if (mysql_affected_rows()==1)
				{
				$mensagem="<span class='style3'>Adicionado/Atualizado</span>";
				}elseif (mysql_affected_rows()==0){$mensagem="<span class='style3'>Erro</span>";}

$sql_corretores_bd1 = "SELECT registro FROM corretores_bd1 WHERE registro = '".$susep."'"; 
$resultado_sol = mysql_query($sql_corretores_bd1,$db);

// SE N√ÉO TEM NA TABELA CORRETORES_BD1 ADICIONA;
if(mysql_num_rows($resultado_sol)<1){
	
	$sql2 = "INSERT IGNORE INTO corretores_bd1 (registro,email,nome) 
				VALUES (
				'".$susep."',
				'".$email."',
				'".strtr($corretor,$tiraAcentos)."')";
				$result3 = mysql_query($sql2,$db);
				if (mysql_affected_rows()==1)
				{
				$cont++;
				}
	}

   }
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";

####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.corretor_hdi_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 


############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.corretor_hdi_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.corretor_hdi TO webvist.corretor_hdi_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db);    
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.corretor_hdi";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'corretor_hdi_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculo_hdi_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_hdi_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.corretor_hdi_atualizacao TO webvist.corretor_hdi ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
#####################################################################


// print_r ($_FILES['Filedata']['name']);
?>
  <tr>
   <td height="27" colspan="4" ><div align="right" class="style12"><b>Quantidade Atual Corretores HDI &nbsp;<?php echo ($i-1);?>&nbsp;</b></div></td>
  </tr>
    <tr>
   <td height="27" colspan="4" ><div align="right" class="style12"><b>Quantidade Adicionado na Tabela Fenacor(corretores_bd1) &nbsp;<?php echo $cont;?>&nbsp;</b></div></td>
  </tr>
</table>
<?php
$obs="Quantidade Atual Corretores HDI ".($i-1)."\nQuantidade Adicionado na Tabela Fenacor(corretores_bd1) ".$cont;
unlink($arquivo);
unlink($arquivoNovo);
}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inv√°lido<br>';
		}   
	if($conteudoRecebido!='Tipo;SUSEP;Cod. Interno;Produtor;Sucursal;E-mail'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;
	}
	
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_corretor_hdi.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################	

}


?>
</body>
</html>
