<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" ");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html">
<title>Atualizar Corretor Tokio Marine</title>
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
.style16 {color: #000000}
</style>
<!-- Copyright 2000, 2001, 2002, 2003, 2004, 2005 Macromedia, Inc. All rights reserved. -->
</head>

<body>

<form action="atualizar_corretor_tokio.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
     <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar corretor TOKIO MARINE</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
    
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style16">&nbsp;&nbsp;Insira o arquivo no formato txt </td>
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
<?


if($_FILES){

@mkdir("atualizacoesTemp",0755);
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

//$texto=strtr($texto,array("<br />"=>"","<br>"=>""));

//transformamos as quebras de linha em etiquetas <br>
//$texto = nl2br($texto);
$array = split("\n",$texto);
//print_r($array);

$tipoArquivo=$_FILES['Filedata']['type'];
$fimLinha1=substr($array[0],103,2);
$fimLinha=strtr($fimLinha1,array(" "=>"#"));
$meioLinha=substr($array[0],93,1);

if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='##') && ($meioLinha=='.') )
{
	
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS `corretores_tokio_atualizacao` (
  `nome` varchar(40) NOT NULL,
  `registro` varchar(20) NOT NULL,
  `codio_interno_tokio` varchar(6) NOT NULL,
  `nome_corretora` varchar(40) NOT NULL,
  `codigo_interno_susep_tokio` varchar(5) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `idx_susep` (`registro`),
  KEY `idx_nome` (`nome`),
  KEY `idx_codInterno` (`codio_interno_tokio`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);

$contador=0;
$cont=0;
$cont1=0;
//print_r($array);

 $contador=0;
 $contador1=1;
   while($contador1<=1)
   {
   $codio_interno_tokio = substr($array[$contador],0,6);
   $nome = substr($array[$contador],6,40);
   $nome_corretora = substr($array[$contador],46,40);
   $codigo_interno_susep_tokio = substr($array[$contador],86,5);
   $registro1 = substr($array[$contador],91,14);
   $registro=strtr($registro1,array("."=>""));
   
if(strlen(trim($codio_interno_tokio))>2)
{
	
	   
		$sql1 = "INSERT INTO corretores_tokio_atualizacao (nome,registro,codio_interno_tokio,nome_corretora,codigo_interno_susep_tokio) 
				VALUES (
				'".trim(strtr($nome,$tiraAcentos))."',
				'".trim($registro)."',
				'".trim($codio_interno_tokio)."',
				'".trim(strtr($nome_corretora,$tiraAcentos))."',
				'".trim($codigo_interno_susep_tokio)."')";
				$result2 = mysql_query($sql1,$db);
				if ($result2)
				{
				$cont++;
				}
				
$sql_corretores_bd1 = "SELECT registro FROM corretores_bd1 WHERE registro = '".trim($registro)."'"; 
$resultado_sol = mysql_query($sql_corretores_bd1,$db);

// SE NÃƒO TEM NA TABELA CORRETORES_BD1 ADICIONA;
if(mysql_num_rows($resultado_sol)<1){   
	   // atualizada tabela corretores_bd1
		   $sql10 = "INSERT IGNORE INTO corretores_bd1 (nome,registro) 
				VALUES (
				'".trim(strtr($nome,$tiraAcentos))."',
				'".trim($registro)."')";
			$result20 = mysql_query($sql10,$db);
		   	if (mysql_affected_rows()==1){
					$cont1++;
					}
}	
		

}

$contador++;
	if(strlen(trim($codio_interno_tokio))<=0)
	{
	$contador1++;
	}
}


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.corretores_tokio_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEANDO TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.corretores_tokio_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.corretores_tokio TO webvist.corretores_tokio_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
	 	$sqlAtualiza2="DROP TABLE webvist.corretores_tokio";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'corretores_tokio_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - corretores_tokio_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup corretores_tokio_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

##############################################################################################

$sqlAtualiza3="RENAME TABLE webvist.corretores_tokio_atualizacao TO webvist.corretores_tokio ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
#####################################################################

?>
  <tr>
   <td height="50" colspan="4"><div align="right" class="style12"><b>Quantidade de registros adicionados &nbsp;<?php echo $cont;?>&nbsp;</b></div></td>
  </tr>
    <tr>
   <td height="50" colspan="4"><div align="right" class="style12"><b>Quantidade de registros adicionados na Tabela Fenacor &nbsp;<?php echo $cont1;?>&nbsp;</b></div></td>
  </tr>
</table>
<?
$obs="Quantidade de registros adicionados ".$cont."\nQuantidade de registros adicionados na Tabela Fenacor ".$cont1;
unlink($arquivo);
}else{
	   
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);



	$problemaIdentificado='';
	if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($fimLinha!='##'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}
	if($meioLinha!='.'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_corretor_tokio.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
