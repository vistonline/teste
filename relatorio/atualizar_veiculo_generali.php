<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","9000M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Ve&iacute;culo GENERALI</title>
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

<form action="atualizar_veiculo_generali.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culo GENERALI</td>
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
$array = split("\n",$texto);
$contador=0;

if($array[0]==';;;;;;;;;'){
	$titulo=$array[1];
	}else{
		$titulo=$array[0];
		}


$conteudoRecebido=substr($titulo,0,121);



if( ($fileType=='Excel2007') && ($conteudoRecebido=='MARCA;CODIGO_GENERALI;MODELO_GENERALI;CODIGO_FIPE;MODELO_FIPE;PORTAS;COMBUSTIVEL;ANOS_FABRICACAO;ANOS_MODELO;POSSIVEL_0KM') )
{

$sqlAtualiza="CREATE TABLE IF NOT EXISTS veiculo_generali_atualizacao (
  `codigo` varchar(10) NOT NULL,
  `marca` varchar(80) CHARACTER SET latin1 NOT NULL,
  `modelo` varchar(120) CHARACTER SET latin1 NOT NULL,
  `porta` int(1) NOT NULL,
  `combustivel` varchar(2) CHARACTER SET latin1 NOT NULL,
  `fipe` varchar(10) NOT NULL,
  `modelo_fipe` varchar(120) CHARACTER SET latin1 NOT NULL,
  `procedencia` varchar(1) NOT NULL,
  `passageiros` int(11) NOT NULL,
  `inicial` int(4) NOT NULL,
  `final` int(4) NOT NULL,
  `possivel_0km` varchar(1) NOT NULL,
  UNIQUE KEY `IDXVEICULOPORTA` (`modelo`,`porta`,`codigo`,`combustivel`),
  KEY `idxfabricante` (`marca`),
  KEY `idxmodelo` (`modelo`)
) ENGINE=MYISAM DEFAULT CHARSET=ascii;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);
	
	


	

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
   $dados = split(";",$array[$contador]);
//select 
/*

marca					0
codigo_generali			1
modelo_generali			2
codigo_fipe				3
modelo_fipe				4
portas					5
combustivel				6
ano inicial				7
ano final				8
possivel 0KM			9

******n�o importando o aceitavel******
*/	
     
if(strlen(trim($dados[0]))>2 && $dados[0]!='MARCA')
{

$dados7=explode("A",$dados[7]);
$anoInicio=trim($dados7[0]);
$dados8=explode("A",$dados[8]);
$anoFim=trim($dados8[1]);


				$sql1 = "INSERT INTO veiculo_generali_atualizacao (codigo,marca,modelo,porta,combustivel,fipe,modelo_fipe,inicial,final,possivel_0km) 
				VALUES (
				'".trim($dados[1])."',
				'".trim(utf8_decode($dados[0]))."',
				'".trim(utf8_decode($dados[2]))."',
				'".trim($dados[5])."',
				'".trim($dados[6])."',
				'".trim($dados[3])."',
				'".trim(utf8_decode($dados[4]))."',   
				'".$anoInicio."',
				'".$anoFim."',
				'".trim($dados[9])."')";
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
     <td height="50" colspan="4"><center><h3>Quantidade total de ve&iacute;culos &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade de ve&iacute;culos adicionados ".$cont;

unlink($arquivo);
unlink($arquivoNovo);
	
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculo_generali_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 
	
############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculo_generali_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.veiculo_generali TO webvist.veiculo_generali_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculo_generali";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculo_generali_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculo_generali_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_hdi_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );   
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculo_generali_atualizacao TO webvist.veiculo_generali ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 
##############################################################################################

}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inv�lido<br>';
		}   
	if($conteudoRecebido!='MARCA;CODIGO_GENERALI;MODELO_GENERALI;CODIGO_FIPE;MODELO_FIPE;PORTAS;COMBUSTIVEL;ANOS_FABRICACAO;ANOS_MODELO;POSSIVEL_0KM'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_generali.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
