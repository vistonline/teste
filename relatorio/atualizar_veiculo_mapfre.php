<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit", "9000M");
//ini_set("max_execution_time", "20*60");
//set_time_limit(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Ve&iacute;culo MAPFRE</title>
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
.style3 {font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-weight: bold;
	color: #FF0000;
	}
.style2 {font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	font-weight: bold;
	color: #003399;
}
</style>
<!-- Copyright 2000, 2001, 2002, 2003, 2004, 2005 Macromedia, Inc. All rights reserved. -->
</head>

<body>

<form action="atualizar_veiculo_mapfre.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culo MAPFRE</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato XLSX<br /><span style="color:#F00">(Se estiver no formato XLS abra e salve no formato XLSX primeiro)</span></td>
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
$array = split("\n",$texto);
$contador=0;


$conteudoRecebido=substr($array[0],0,75);


if( ($fileType=='Excel2007') && ($conteudoRecebido=='COD_MARCA;MARCA_MADRE;FABRICA;DESC_MARCA;VE;TE;DH;AC;CA;BC;TS;ABS;AB;DE;ATE') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS veiculo_mapfre_atualizacao (
  `codigo_marca` varchar(20) NOT NULL,
  `marca_madre` varchar(20) NOT NULL,
  `fabricante` varchar(80) NOT NULL,
  `modelo` varchar(80) NOT NULL,
  `vid` varchar(2) NOT NULL,
  `ve` varchar(2) NOT NULL,
  `te` varchar(2) NOT NULL,
  `dh` varchar(2) NOT NULL,
  `ac` varchar(2) NOT NULL,
  `ca` varchar(2) NOT NULL,
  `bc` varchar(2) NOT NULL,
  `ts` varchar(2) NOT NULL,
  `abs` varchar(2) NOT NULL,
  `ab` varchar(2) NOT NULL,
  `inicio_fabricacao` varchar(4) NOT NULL,
  `final_fabricacao` varchar(4) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxcodigo` (`codigo_marca`),
  KEY `idxfabricante` (`fabricante`),
  KEY `idxmodelo` (`modelo`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);	

	
	

?>
<table width="98%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="6" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 <? 
 $cont=0;
 $contador=1;
 $contador1=1;
 //  while($contador1<=1)
  for($i=0;next($array);$i++)
   {
   $dados = split(";",$array[$contador]);
//select 
/*
COD_MARCA   $dados[0];
MARCA_MADRE $dados[1];
FABRICA     $dados[2];
DESC_MARCA  $dados[3];
VID         $dados[4];
VE			$dados[5];
TE			$dados[6];
DH			$dados[7];
AC			$dados[8];
CA			$dados[9];
BC			$dados[10];
TS			$dados[11];
ABS			$dados[12];
AB			$dados[13];
ano_inicio	$dados[14];
ano_final	$dados[15];
*/	
if(strlen($dados[0])>2)
{
  
				$sql1 = "REPLACE LOW_PRIORITY INTO veiculo_mapfre_atualizacao (codigo_marca,marca_madre,fabricante,modelo,vid,ve,te,dh,ac,ca,bc,ts,abs,ab,inicio_fabricacao,final_fabricacao) 
				VALUES (
				'".$dados[0]."',
				'".$dados[1]."',
				'".$dados[2]."',
				'".$dados[3]."',
				'ND',
				'".$dados[4]."',
				'".$dados[5]."',
				'".$dados[6]."',
				'".$dados[7]."',
				'".$dados[8]."',
				'".$dados[9]."',
				'".$dados[10]."',
				'".$dados[11]."',
				'".$dados[12]."',
				'".$dados[13]."',
				'".$dados[14]."')";
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
   <td height="50" colspan="4"><center><h3>Quantidade de ve&iacute;culos adicionados &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade de ve&iacute;culos adicionados ".$cont;
unlink($arquivo);
unlink($arquivoNovo);
	
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculo_mapfre_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 
	
############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculo_mapfre_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.veiculo_mapfre TO webvist.veiculo_mapfre_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculo_mapfre";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}

$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculo_mapfre_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculo_mapfre_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_mapfre_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculo_mapfre_atualizacao TO webvist.veiculo_mapfre ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
	
#####################################################################
	
	
}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='COD_MARCA;MARCA_MADRE;FABRICA;DESC_MARCA;VE;TE;DH;AC;CA;BC;TS;ABS;AB;DE;ATE'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}

##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_mapfre.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
######################################################################################################################################################

} // FIM $_FILES
?>
</body>
</html>
