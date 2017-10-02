<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" ");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html">
<title>Atualizar Corretor Bradesco</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Corretor Bradesco</td>
  </tr>
  <tr>
    <td height="50" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato TXT</td>
    <td> <div align="left" class="style12" >
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
	
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".TXT";    
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

// IDENTIFICA O FORMADO DO ARQUIVO
$fileType=$_FILES['Filedata']['type'];

$fp = fopen($arquivo,'r');

//lemos o arquivo
addslashes($texto = fread($fp, filesize($arquivo)));
$array = explode("\n",$texto);

$conteudoRecebido=substr($array[0],0,32);

if( ($fileType=='text/plain') && ($conteudoRecebido=='*HEADERIDENTIFICACAO CORRETOR BS') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS `corretor_bradesco_atualizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corretor` varchar(60) CHARACTER SET latin1 NOT NULL,
  `susep` varchar(14) NOT NULL,
  `sucursal` varchar(3) NOT NULL,
  `cod_cpd` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_susep` ( `susep` , `sucursal` , `cod_cpd` ),
  KEY `idx_corretor` (`corretor`)
) ENGINE=MYISAM  DEFAULT CHARSET=ascii AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);	
	
$cont1=0;

for($i=1;$i<count($array)-1;$i++)
   {

//if($i==5)break;
/*
corretor        		0 - 59 ok
susep                   60 - 75 ok 
sucursal		        76 - 78; ok
cpd 					79 - 83; ok 
*/	

$corretor=trim(substr($array[$i],0,60));
$susep=substr($array[$i],60,14);
$sucursal=substr($array[$i],74,3);
$cod_cpd=substr($array[$i],77,6);

if ($susep{0}.$susep{1}.$susep{2}.$susep{3}.$susep{4}=='00000'){
	$susep=$susep{5}.$susep{6}.$susep{7}.$susep{8}.$susep{9}.$susep{10}.$susep{11}.$susep{12}.$susep{13};
	}else{
		$susep=$susep;
		}
		
$sql1 = "INSERT IGNORE INTO corretor_bradesco_atualizacao (corretor,susep,sucursal,cod_cpd) 
				VALUES (
				'".strtr($corretor,$tiraAcentos)."',
				'".$susep."',
				'".$sucursal."',
				'".$cod_cpd."')";
				$result2 = mysql_query($sql1,$db);

				if (mysql_affected_rows()==1)
				{
				$mensagem="<span class='style3'>Adicionado</span>";
				}elseif (mysql_affected_rows()==0){$mensagem="<span class='style3'>Erro</span>";}


$sql_corretores_bd1 = "SELECT registro FROM corretores_bd1 WHERE registro = '".$susep."'"; 
$resultado_sol = mysql_query($sql_corretores_bd1,$db);

// SE NÃƒO TEM NA TABELA CORRETORES_BD1 ADICIONA;
if(mysql_num_rows($resultado_sol)<1){
	
	$sql2 = "INSERT IGNORE INTO corretores_bd1 (registro,nome) 
				VALUES (
				'".$susep."',
				'".strtr($corretor,$tiraAcentos)."')";
				$result3 = mysql_query($sql2,$db);
				if (mysql_affected_rows()==1)
				{
				$cont++;
				}
	}


   }
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['Filedata']['name']);
 
 
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.corretor_bradesco_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.corretor_bradesco_".date('Ymd').""))) { 
 	$sqlAtualiza4="RENAME TABLE webvist.corretor_bradesco TO webvist.corretor_bradesco_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db);  
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.corretor_bradesco";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}

$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'corretor_bradesco_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - corretor_bradesco_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup corretor_bradesco_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}
	
$sqlAtualiza3="RENAME TABLE webvist.corretor_bradesco_atualizacao TO webvist.corretor_bradesco ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 	

##############################################################################################
 
?>
  <tr>
   <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12"><b>Quantidade de registros adicionados &nbsp;<?php echo ($i-1);?>&nbsp;</b></div></td>
  </tr>
  <tr>
  <td height="50" colspan="4"><div align="right" class="style12"><b>Quantidade de registros adicionados na Tabela Fenacor &nbsp;<?php echo $cont1;?>&nbsp;</b></div></td>
  </tr>
</table>
<?php
$obs="Quantidade de registros adicionados ".($i-1)."\nQuantidade de registros adicionados na Tabela Fenacor ".$cont1;
unlink($arquivo);
}else{$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='text/plain'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='*HEADERIDENTIFICACAO CORRETOR BS'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;}
	
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_corretor_bradesco.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
