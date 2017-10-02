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
<title>Atualizar Ve&iacute;culo MARITIMA</title>
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

<form action="atualizar_veiculo_maritima.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culo MARITIMA</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
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

$conteudoRecebido=substr(utf8_decode($array[0]),0,182);   
//$conteudoRecebido=substr(utf8_decode($array[0]),0,31);  
  
if( ($fileType=='Excel2007') && ($conteudoRecebido=='Cod_Veic;Cod_Marca;Cod_Modelo;Cod_Versao;Marca;Versão;Capacidade;Lotação;Ano início fabricação;Ano término fabricação;Código Veículo FIPE;Código Veículo MARÍTIMA;Código Fipe Completo') )
//if( ($fileType=='Excel2007') && ($conteudoRecebido=='x;x;x;x;x;x;x;x;x;x;x;x;x;x;x;x') )
{
	
############################# Cópia de segurança da tabela ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculo_maritima_".date('Ymd').""))) { 
$copiarDados='sim'; 
} else { 
$copiarDados='nao'; 
}

if($copiarDados=='sim'){
$sqlS1="CREATE TABLE webvist.veiculo_maritima_".date('Ymd')." (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `codMarca` int(6) NOT NULL,
  `codModelo` int(6) NOT NULL,
  `marca` varchar(60) NOT NULL,
  `modelo` varchar(60) NOT NULL,
  `ano_ini` int(6) NOT NULL,
  `ano_fim` int(6) NOT NULL,
  `codFipe` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_marcaTipo` (`codMarca`,`codModelo`,`ano_ini`,`ano_fim`)
) ENGINE = MYISAM DEFAULT CHARSET = latin1";
$resultS1 = mysql_query($sqlS1,$db);

$sqlS2="INSERT INTO webvist.veiculo_maritima_".date('Ymd')." 
SELECT * 
FROM webvist.veiculo_maritima";
$resultS2 = mysql_query($sqlS2,$db);
}

if(!(mysql_query("SELECT * FROM webvist.veiculo_maritima_".date('Ymd').""))) { 
$copiarDados='sim'; 
} else { 
$copiarDados='nao'; 
}

$sqlS10="TRUNCATE TABLE veiculo_maritima";
$resultS10 = mysql_query($sqlS10,$db);


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculo_maritima_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculo_maritima_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_maritima_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

##############################################################################################	
	
?>
<table width="98%" border="00" cellpadding="0" cellspacing="0">
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

if(strlen(trim($dados[0]))>2)
{
 
 $codVeiculo=str_pad(trim($dados[11]), 6, "0", STR_PAD_LEFT); 
 
 $COD_MARCA_VEIC=substr($codVeiculo,0,3);
 $COD_MODEL_VEIC=substr($codVeiculo,3,3);
 
  
				$sql1 = "INSERT INTO veiculo_maritima (codMarca,codModelo,marca,modelo,ano_ini,ano_fim,codFipe) 
				VALUES (
				'".$COD_MARCA_VEIC."',
				'".$COD_MODEL_VEIC."',
				'".trim($dados[4])."',
				'".trim($dados[5])."',
				'".trim($dados[8])."',
				'".trim($dados[9])."',
				'".trim($dados[12])."')";
				$result2 = mysql_query($sql1,$db);
				
				//echo mysql_affected_rows()."<br>";
				
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
   <td height="50" colspan="4"><center><h3>Quantidade Total de ve&iacute;culos &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade de veículos adicionados ".$cont;
//unlink($arquivo);
//unlink($arquivoNovo);
}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='Cod_Veic;Cod_Marca;Cod_Modelo;Cod_Versao;Marca;Versão;Capacidade;Lotação;Ano início fabricação;Ano término fabricação;Código Veículo FIPE;Código Veículo MARÍTIMA;Código Fipe Completo')
	//if($conteudoRecebido!='x;x;x;x;x;x;x;x;x;x;x;x;x;x;x;x')
	{
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_maritima.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
