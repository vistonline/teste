<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" ","+"=>"");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html">
<title>Atualizar Ve&iacute;culos Bradesco Seguros</title>
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

<form action="atualizar_veiculo_bradesco.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
   <td height="25" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culos Bradesco Seguros</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Insira o da Bradesco (VISAR026)</td>
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
	
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".TXT";    
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

$fileType=$_FILES['Filedata']["type"];

$fp = fopen($arquivo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivo));
$array = split("\n",$texto);
$contador=0;

$conteudoRecebido=substr($array[0],0,7);   

if( ($fileType=='text/plain') && ($conteudoRecebido=='0HEADER') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS veiculos_atualizacao (
  `anoInicio` varchar(4) NOT NULL,
  `anoFim` varchar(4) NOT NULL,
  `codFabricante` varchar(3) NOT NULL,
  `FABRICANTE` varchar(40) NOT NULL,
  `MODELO` varchar(100) NOT NULL,
  `CODIGO` varchar(10) NOT NULL,
  PRIMARY KEY (`CODIGO`),
  KEY `idxfabricante` (`FABRICANTE`),
  KEY `idxmodelo` (`MODELO`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);	



?>
<table width="100%" border="00" cellpadding="0" cellspacing="0">
 <tr>
    <td height="25" colspan="4" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 
 <? 
 $contador=1;  
 $cont=0;
 $contador_novos=0;
 $final = sizeof($array)-2;
 
   while($contador<$final)
   {

$CODIGO=trim(substr($array[$contador],1,10));
$MODELO=trim(substr(strtr($array[$contador],array("&"=>"e")),11,70));
$CODFAB=trim(substr($array[$contador],81,3));
$FABRICANTE=trim(substr($array[$contador],84,70));
$ANOINI=trim(substr($array[$contador],154,4));
$ANOFIM=trim(substr($array[$contador],158,4));

// SÓ INSERE SE TIVER FABRICANTE
if(strlen($FABRICANTE)>=2){
	
				$sql1 = "INSERT INTO veiculos_atualizacao (CODIGO,MODELO,codFabricante,FABRICANTE,anoInicio,anoFim) 
				VALUES (
				'".$CODIGO."',
				'".strtr($MODELO,$tiraAcentos)."',
				'".$CODFAB."',
				'".strtr($FABRICANTE,$tiraAcentos)."',
				'".$ANOINI."',
				'".$ANOFIM."')"; 
				$result2 = mysql_query($sql1,$db);
				if ($result2)
				{
				$cont++;
				//$mensagem="<span class='style3'>Adicionado</span>";
				//$contador_novos++;
				}
	} // SE TEM FABRICANTE		

	$contador++;

}?>
  <tr>
    <td height="50" colspan="4"><center><h3>Total de ve&iacute;culos &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
  </tr>
</table>
<?
$obs="Quantidade de novos ve&iacute;culos ".$cont;
unlink($arquivo);


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculos_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db);

############################# RENOMEIA TABELA ATUAL  ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculos_".date('Ymd').""))){ 
	$sqlAtualiza4="RENAME TABLE webvist.veiculos TO webvist.veiculos_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
 		$sqlAtualiza2="DROP TABLE webvist.veiculos";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculos_20%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculos_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculos_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}
	
$sqlAtualiza3="RENAME TABLE webvist.veiculos_atualizacao TO webvist.veiculos ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 	

##############################################################################################



}else{
	
	$arquivo = "atualizacoesTemp/atualizar_veiculo_bradesco - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";

	}

##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_bradesco.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
