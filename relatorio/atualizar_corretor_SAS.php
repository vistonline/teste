<?php

include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
ini_set("memory_limit","900M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" "); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Corretor Sul America</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Corretor Sul America</td>
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



if($_FILES['Filedata']['tmp_name']!='')
{


$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".xlsx";    
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$arquivoNovo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".csv";

require_once 'Classes/PHPExcel/IOFactory.php';
// IDENTIFICA O FORMADO DO ARQUIVO
$fileType=PHPExcel_IOFactory::identify($arquivo);


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


$conteudoRecebido=substr($array[0],0,7);       


if( ($fileType=='Excel2007') && ($conteudoRecebido=='EV;NOME') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS `corretores_sulamerica_atualizacao` (
  `ev` varchar(20) NOT NULL,
  `susep` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ev` (`ev`),
  KEY `idx_nome` (`nome`)
) ENGINE=MYISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);


	
for($i=1;$i<count($array)-1;$i++)
   {

	$dados = explode(";",$array[$i]);


//if($i==5)break;

/*
EV        		$dados[0] ok
NOME                   $dados[1] ok 

*/	

$EV=trim($dados[0]);
$corretor=trim($dados[1]);



$sql1 = "INSERT INTO corretores_sulamerica_atualizacao (ev,nome) 
				VALUES (
				'".$EV."',
				'".strtr(trim($corretor),$tiraAcentos)."')";
				$result2 = mysql_query($sql1,$db);   

				if (mysql_affected_rows()==1)
				{
				$mensagem="<span class='style3'>Adicionado/Atualizado</span>";
				}elseif (mysql_affected_rows()==0){$mensagem="<span class='style3'>Erro</span>";}

/*$sql_corretores_bd1 = "SELECT registro FROM corretores_bd1 WHERE registro = '".$susep."'"; 
$resultado_sol = mysql_query($sql_corretores_bd1,$db);

// SE NÃO TEM NA TABELA CORRETORES_BD1 ADICIONA;
if(mysql_num_rows($resultado_sol)<1){
	
	$sql2 = "INSERT IGNORE INTO corretores_bd1 (registro,email,nome) 
				VALUES (
				'".$susep."',
				'".$email."',
				'".addslashes($corretor)."')";
				$result3 = mysql_query($sql2,$db);
				if (mysql_affected_rows()==1)
				{
				$cont++;
				}
	}*/

   }
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
// print_r ($_FILES['Filedata']['name']);
?>
  <tr>
   <td height="27" colspan="4" ><div align="right" class="style12"><b>Quantidade Atual Corretores Sul America &nbsp;<?php echo ($i-1);?>&nbsp;</b></div></td>
  </tr>
  <!--  <tr>
   <td height="27" colspan="4" ><div align="right" class="style12"><b>Quantidade Adicionado na Tabela Fenacor(corretores_bd1) &nbsp;<?php echo $cont;?>&nbsp;</b></div></td>
  </tr> -->
</table>
<?php
$obs="Quantidade Atual Corretores Sul America ".($i-1);
unlink($arquivo);
unlink($arquivoNovo);
	
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.corretores_sulamerica_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 	
	
############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.corretores_sulamerica_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.corretores_sulamerica TO webvist.corretores_sulamerica_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db);
	}else { 
		$sqlAtualiza2="DROP TABLE webvist.corretores_sulamerica";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}

$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'corretores_sulamerica_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - corretores_sulamerica_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup corretor_sas_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.corretores_sulamerica_atualizacao TO webvist.corretores_sulamerica ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
##############################################################################################	
	
}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='EV;NOME'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;
	}
	
##################################################### REGISTRA UPLOAD ##################################################################################
include "/var/www/html/sistema/class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_corretor_SAS.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
