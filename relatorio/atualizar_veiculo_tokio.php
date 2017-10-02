<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Ve&iacute;culos Tokio Marine</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style3 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	}
.style2 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #003399;
}
</style>
</head>

<body>

<form action="atualizar_veiculo_tokio.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culos Tokio Marine</td>
  </tr>
  <tr>
    <td height="27" colspan="2" ><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Insira o txt</td>
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

if($_FILES){

@mkdir("atualizacoesTemp",0755);
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

//transformamos as quebras de linha em etiquetas <br>
$texto = nl2br($texto);
$array = split("\n",$texto);
//print_r($array);

$tipoArquivo=$_FILES['Filedata']['type'];
$fimLinha=substr($array[0],108,1);
$meioLinha=substr($array[0],59,4);   

if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='P' || $fimLinha=='C') && ($meioLinha=='0000') )
{


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `veiculos_tokio_atualiza` (
  `codigo_veiculo` int(9) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `codigo_fabricante` int(9) NOT NULL,
  `fabricante` varchar(30) NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_codigo` (`codigo_veiculo`,`codigo_fabricante`),
  KEY `idxfabricante` (`fabricante`),
  KEY `idxmodelo` (`modelo`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);


?>
<table width="98%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="4" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 <? 
 $cont=0;
 $contador=1;
 $contador_novos=0;
 $final = sizeof($array)-2;
						
   while($contador<$final)
   {

				$sql1 = "INSERT INTO veiculos_tokio_atualiza (codigo_veiculo,modelo,codigo_fabricante,tipo,fabricante) 
				VALUES (
				'".trim(substr($array[$contador],0,9))."',
				'".trim(substr($array[$contador],9,50))."',
				'".trim(substr($array[$contador],59,9))."',
				'".trim(substr($array[$contador],108,1))."',
				'".trim(substr($array[$contador],68,40))."')";
				$result2 = mysql_query($sql1,$db);
				if ($result2)
				{
					$cont++;
				//$mensagem="<span class='style3'>Adicionado</span>";
				$contador_novos++;
				}
		
 
$contador++;
}


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculos_tokio_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculos_tokio_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.veiculos_tokio TO webvist.veiculos_tokio_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculos_tokio";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}

$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculos_tokio_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculos_tokio_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculos_tokio_<br>pois possui duas ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculos_tokio_atualiza TO webvist.veiculos_tokio ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 

##############################################################################################

?>
  <tr>
    <td height="27" colspan="4"><center><h3>Quantidade total de ve&iacute;culos &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?
$obs="Quantidade total de ve&iacute;culos ".$cont;
unlink($arquivo);
}else{
	   
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);



	$problemaIdentificado='';
	if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($fimLinha!='P' && $fimLinha!='C' && $meioLinha!='0000'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_tokio.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
