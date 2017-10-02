<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","9000M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','·'=>'a','‡'=>'a','‚'=>'a','„'=>'a','‰'=>'a','¡'=>'A','¿'=>'A','¬'=>'A','√'=>'A','ƒ'=>'A','È'=>'e','Ë'=>'e','Í'=>'e','Í'=>'e','…'=>'E','»'=>'E',' '=>'E','À'=>'E','Ì'=>'i','Ï'=>'i','Ó'=>'i','Ô'=>'i','Õ'=>'I','Ã'=>'I','Œ'=>'I','œ'=>'I','Û'=>'o','Ú'=>'o','Ù'=>'o','ı'=>'o','ˆ'=>'o','”'=>'O','“'=>'O','‘'=>'O','’'=>'O','÷'=>'O','˙'=>'u','˘'=>'u','˚'=>'u','¸'=>'u','⁄'=>'U','Ÿ'=>'U','€'=>'U','Á'=>'c','«'=>'C','Ò'=>'n','—'=>'N','&'=>'&',"'"=>" ","`"=>" " ,"+"=>"");  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Ve&iacute;culo SANCOR SEGUROS</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
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

<form action="atualizar_veiculo_sancor.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culo SANCOR SEGUROS</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato XLSX<span style="color:#F00">(Se estiver no formato XLS abra e salve no formato XLSX primeiro)</span></td>
    <td width="75%" height="30"> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" size="100px" />
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

if($_FILES)
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

$conteudoRecebido=substr($array[0],0,39);



if( ($fileType=='Excel2007') && ($conteudoRecebido=='marca;modelo;cod_fipe;Combus;num_passag') )
{  


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `veiculoFipe_sancor_atualizacao` (
  `nm_marca` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `nm_modelo` varchar(200) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `nr_fipe` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `tp_combustivel` varchar(3) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `nm_cat_tarifaria` varchar(5) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `id_versao` varchar(10) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `num_passag` varchar(10) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  UNIQUE KEY `nr_fipe` (`nr_fipe`,`tp_combustivel`)
) ENGINE=MYISAM DEFAULT CHARSET=ascii;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);
	
	



   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculoFipe_sancor_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_hdi_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );   
	}

##############################################################################################

	

?>
<table width="100%" border="00" cellpadding="0" cellspacing="0">
   <tr>
    <td height="50" colspan="3" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 
  <? 
 $cont=0;
 $contador=1;
 $contador1=1;
   for($i=0;next($array);$i++)
   {
   $dados = explode(";",$array[$contador]);
 
/*
nm_marca					0
nm_modelo					1
nr_fipe						2
tp_combustivel				3
nm_cat_tarifaria			4
id_versao					5
*/	

if(strlen(trim($dados[0]))>2)
{

	
      
				$sql1 = "INSERT INTO veiculoFipe_sancor_atualizacao (nm_marca,nm_modelo,nr_fipe,tp_combustivel,nm_cat_tarifaria,id_versao,num_passag) 
				VALUES (
				'".trim(strtr(utf8_decode($dados[0]),$tiraAcentos))."',
				'".trim(strtr(utf8_decode($dados[1]),$tiraAcentos))."',
				'".trim($dados[2])."',   
				'".trim($dados[3])."',
				'',
				'',
				'".trim($dados[4])."')";
				$result2 = mysql_query($sql1,$db);
				if (mysql_affected_rows()==1)
				{
					$cont++;
				$mensagem="<span class='style3'>Adicionado</span>";
				}elseif (mysql_affected_rows()==0){$mensagem="<span class='style3'>Erro</span>";}


}
$contador++;
	if(mysql_affected_rows()==1)
	{
	$contador1++;
	}
$adicionado=$contador1-1;
	
}?>
  <tr>
     <td height="50" colspan="4"><center><h3>Quantidade total de ve&iacute;culos: &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade de ve&iacute;culos adicionados ".$cont;

unlink($arquivo);
unlink($arquivoNovo);
	
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculoFipe_sancor_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 
	
############################# RENOMEIA TABELA ATUAL ###################################
                                                                                              
if(!(mysql_query("SELECT * FROM webvist.veiculoFipe_sancor_".date('Ymd').""))) {              
    $sqlAtualiza4="RENAME TABLE webvist.veiculoFipe_sancor TO webvist.veiculoFipe_sancor_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db);
	}else{                                                                                      
		$sqlAtualiza2="DROP TABLE webvist.veiculoFipe_sancor";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}                                                                                             
                                                                                              
                                                                                        
$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculoFipe_sancor_%'";
$resultS3 = mysql_query($sqlS3,$db);  
	
	
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculoFipe_sancor_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculoFipe_sancor_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculoFipe_sancor_atualizacao TO webvist.veiculoFipe_sancor ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 	
	

}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inv√°lido<br>';
		}   
	if($conteudoRecebido!='marca;modelo;cod_fipe;Combus;num_passag'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_sancor.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
######################################################################################################################################################
	
}


?>
</body>
</html>
