<?php
set_time_limit(false);
include "../../adm/conecta.php";
include "../../adm/conecta_tokio.php";
include "../verifica.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8">
<title>Atualizar tabelas Tokio Marine</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Importar Arquivos - Atualiza&ccedil;&atilde;o de Tabelas Tokio Marine</td>
  </tr>
  <tr>
    <td height="50" colspan="2" class="style12 style15">&nbsp;&nbsp;Selecione a Tabela que ser&aacute; atualizada
    <select id="tabela" name="tabela">
    	<option value="">Escolha</option>
        <option value="acessorio">Acessorios</option>
        <option value="avarias">Avarias</option>
        <option value="parecerTecnico">Parecer T&eacute;cnico</option>
        <option value="pecas">Pe&ccedil;as</option>
        <option value="periodoVeiculo">Per&iacute;odo Ve&iacute;culo</option>
      </select>
    </td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="50" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato TXT</td>
    <td> <div align="left" class="style12" >
      &nbsp;
      <input type="file" size="70px" name="Filedata" id="Filedata" />
    </div></td>
  </tr>
  <tr> 
    <td height="27" colspan="2" >
       <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
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

@mkdir("atualizacoesTemp",0777);
$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$fp = fopen($arquivo,'r');

//lemos o arquivo
$texto = fread($fp, filesize($arquivo));

//transformamos as quebras de linha em etiquetas <br>
$texto = nl2br($texto);
$array = split("\n",$texto);
//print_r($array);
$contador=0;

$tipoArquivo=$_FILES['Filedata']['type'];


?> 
<table width="100%" border="00" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="25" colspan="3" style="color:#FFF; background:#000; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
  <?php 
  
if($_POST['tabela']=="acessorio")
		{
			$fimLinha=substr($array[0],63,1);
			
			if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='A' || $fimLinha=='S' || $fimLinha=='E') ){
				$validouArquivo='SIM';
				
				
$sqlAtualiza="CREATE TABLE IF NOT EXISTS `acessorio_atualiza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descricao` varchar(64) NOT NULL,
  `tipoAcessorio` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_cod` (`codigo`)
) ENGINE=MYISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db1);				
				

				}else{
					$validouArquivo='NAO';
					$problemaIdentificado='';
					
					if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
						$problemaIdentificado.='Tipo de arquivo Inv&aacute;lido<br>';
						}   
					if($fimLinha!='A' && $fimLinha!='S' && $fimLinha!='E'){
						$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
						}
				
						
					echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
		
	$obs=$problemaIdentificado;
	
					exit();
					}
		}
		elseif($_POST['tabela']=="avarias"){
			$fimLinha=substr($array[0],30,32);
			$inicioLinha=substr($array[0],0,2);
			
			if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='                                ') && ($inicioLinha=='A ' || $inicioLinha=='B ' || $inicioLinha=='E ' || $inicioLinha=='F ' || $inicioLinha=='FE' || $inicioLinha=='LA' || $inicioLinha=='LD' || $inicioLinha=='NC' || $inicioLinha=='OT' || $inicioLinha=='PA' || $inicioLinha=='PI' || $inicioLinha=='QB' || $inicioLinha=='RI' || $inicioLinha=='RR' || $inicioLinha=='VZ') ){
				$validouArquivo='SIM';
				
				
$sqlAtualiza="CREATE TABLE IF NOT EXISTS `avarias_atualiza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `descricao` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_cod` (`codigo`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db1);			
				
	
				}else{
					$validouArquivo='NAO';
					if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
						$problemaIdentificado.='Tipo de arquivo Inv&aacute;lido<br>';
						}   
					if($inicioLinha!='A ' && $inicioLinha!='B ' && $inicioLinha!='E ' && $inicioLinha!='F ' && $inicioLinha!='FE' && $inicioLinha!='LA' && $inicioLinha!='LD' && $inicioLinha!='NC' && $inicioLinha!='OT' && $inicioLinha!='PA' && $inicioLinha!='PI' && $inicioLinha!='QB' && $inicioLinha!='RI' && $inicioLinha!='RR' && $inicioLinha!='VZ'){
						$problemaIdentificado.='In&iacute;cio conte&uacute;do do arquivo inv&aacute;lido<br>';
						}
					if($fimLinha!='                                '){
						$problemaIdentificado.='Fim conte&uacute;do do arquivo inv&aacute;lido<br>';
						}
						
					echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
					
	$obs=$problemaIdentificado;
					exit();
					}
			}
			elseif($_POST['tabela']=="parecerTecnico")
				{
				$fimLinha=substr($array[0],105,1);
				$inicioLinha=substr($array[0],0,1);
					if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='A' || $fimLinha=='S' || $fimLinha=='R') && ($inicioLinha=='1' || $inicioLinha=='3' || $inicioLinha=='5') ){
						$validouArquivo='SIM';


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `parecerTecnico_atualiza` (
  `codigo` varchar(3) NOT NULL,
  `descricao` varchar(102) NOT NULL,
  `ressalva` varchar(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db1);	


						}else{
							$validouArquivo='NAO';
							if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
								$problemaIdentificado.='Tipo de arquivo Inv&aacute;lido<br>';
								}   
							if($inicioLinha!='1' && $inicioLinha!='3' && $inicioLinha!='5'){
								$problemaIdentificado.='In&iacute;cio conte&uacute;do do arquivo inv&aacute;lido<br>';
								}
							if($fimLinha!='A' && $fimLinha!='S' && $fimLinha!='R'){
								$problemaIdentificado.='Fim conte&uacute;do do arquivo inv&aacute;lido<br>';
								}
					echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	$obs=$problemaIdentificado;
							exit();
							}
				}
				elseif($_POST['tabela']=="pecas")
					{
					$fimLinha=substr($array[0],41,1);
					$inicioLinha=substr($array[0],0,2);
						if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha==' ') && ($inicioLinha<=99) ){
							$validouArquivo='SIM';
							

$sqlAtualiza="CREATE TABLE IF NOT EXISTS `pecas_atualiza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_cod` (`codigo`)
) ENGINE=MYISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db1);	
							

							}else{
								$validouArquivo='NAO';
								if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
									$problemaIdentificado.='Tipo de arquivo Inv&aacute;lido<br>';
									}   
								if($inicioLinha>99){
									$problemaIdentificado.='In&iacute;cio conte&uacute;do do arquivo inv&aacute;lido<br>';
									}
								if($fimLinha!=' '){
									$problemaIdentificado.='Fim conte&uacute;do do arquivo inv&aacute;lido<br>';
									}
									echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
					
					$obs=$problemaIdentificado;
								exit();
								}
					}
					elseif($_POST['tabela']=="periodoVeiculo")
						{
						$fimLinha=substr($array[0],18,32);
						$inicioLinha=substr($array[0],0,4);

							if( ($tipoArquivo=='text/plain' || $tipoArquivo=='application/octet-stream' ) && ($fimLinha=='                                ') && ($inicioLinha=='0000') ){
								$validouArquivo='SIM';


$sqlAtualiza="CREATE TABLE IF NOT EXISTS `periodoVeiculo_atualiza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `tipo` varchar(1) NOT NULL,
  `anoInicio` int(4) NOT NULL,
  `anoFim` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_cod` (`codigo`,`tipo`,`anoInicio`,`anoFim`)
) ENGINE=MYISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
$resultAtualiza = mysql_query($sqlAtualiza,$db1);


								}else{
									$validouArquivo='NAO';
									if($tipoArquivo!='text/plain' && $tipoArquivo!='application/octet-stream'){
										$problemaIdentificado.='Tipo de arquivo Inv&aacute;lido<br>';
										}   
									if($inicioLinha!='0000'){
										$problemaIdentificado.='In&iacute;cio conte&uacute;do do arquivo inv&aacute;lido<br>';
										}
									if($fimLinha!='                                '){
										$problemaIdentificado.='Fim conte&uacute;do do arquivo inv&aacute;lido<br>';
										}
										echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";

					
						$obs=$problemaIdentificado;
									exit();
									}
						}else{
							$validouArquivo='NAO';
							echo "<br /><br /><br /><center><h1>N&atilde;o foi poss&iacute;vel identificar a tabela que pretende atualizar. Avise o administrador do sistema!<h1></center>";
							
	$arquivo = "atualizacoesTemp/".date('Ymd').date('His')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	
	$obs="Não foi possível identificar a tabela que pretende atualizar.";
							exit();
							}
 
if($validouArquivo=='SIM'){ 

for($i=0;$i<count($array)-1;$i++)
   {
		if($_POST['tabela']=="acessorio")
		{
		$codigo=substr($array[$i],0,3);
		$descricao=substr($array[$i],3,60);
		$tipo=substr($array[$i],63,1);
		
				/*switch($tipo)
					{
					case 'A': $tabela="acessorio"; break;
					case 'E': $tabela="acessorio"; break;
					case 'S': $tabela="acessorio"; break;
					//case 'E': $tabela="equipamento"; break;
					//case 'S': $tabela="seguranca"; break;
					default:break;
					}*/
					
			if($array[$i]!=''){
			$sql1 = "INSERT INTO tokiomarine.acessorio_atualiza (codigo,descricao,tipoAcessorio) VALUES ('".trim($codigo)."', '".trim($descricao)."', '".trim($tipo)."')";
			$result=mysql_query($sql1,$db1);
			}	
					
		}
		elseif( $_POST['tabela']=="avarias" ){
			$codigo=substr($array[$i],0,2);
			$descricao=substr($array[$i],2,60);
			
				if($array[$i]!=''){
				$sql1 = "INSERT INTO tokiomarine.avarias_atualiza (codigo,descricao) VALUES ('".trim($codigo)."', '".trim(utf8_encode($descricao))."')";
				$result=mysql_query($sql1,$db1);
				}
				
			}
			elseif($_POST['tabela']=="parecerTecnico")
				{
				$codigo=substr($array[$i],0,3);
				$descricao=substr($array[$i],3,102);
				$tipo=substr($array[$i],105,1);
				
					if($array[$i]!=''){
					$sql1 = "INSERT INTO tokiomarine.parecerTecnico_atualiza (codigo,descricao,ressalva) VALUES ('".trim($codigo)."', '".trim(utf8_encode($descricao))."','".trim($tipo)."')";
					$result=mysql_query($sql1,$db1);
					}

				}
				elseif($_POST['tabela']=="pecas")
					{
					$codigo=substr($array[$i],0,2);
					$descricao=strtr(substr($array[$i],2,60),array("<br />"=>"", "<br>"=>""));
					
						if($array[$i]!=''){
						$sql1 = "INSERT INTO tokiomarine.pecas_atualiza (codigo,descricao) VALUES ('".trim($codigo)."', '".trim(utf8_encode($descricao))."')";
						$result=mysql_query($sql1,$db1);
						}

					}
					elseif($_POST['tabela']=="periodoVeiculo")
						{
						$codigo=substr($array[$i],0,9);
						$tipo=substr($array[$i],9,1);
						$anoInicio=substr($array[$i],10,4);
						$anoFim=substr($array[$i],14,4);
						
							if($array[$i]!=''){
							$sql1 = "INSERT INTO tokiomarine.periodoVeiculo_atualiza (codigo,tipo,anoInicio,anoFim) VALUES ('".trim($codigo)."', '".trim($tipo)."','".trim($anoInicio)."','".trim($anoFim)."')";
							$result=mysql_query($sql1,$db1);
							}

						}else{}


$adicionado=$i-1;
} // fim FOR
 
 
 
if($_POST['tabela']=="periodoVeiculo"){
	 
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE tokiomarine.periodoVeiculo_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db1); 

############################# RENOMEIA A TABELA ###################################

if(!(mysql_query("SELECT * FROM tokiomarine.periodoVeiculo_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE tokiomarine.periodoVeiculo TO tokiomarine.periodoVeiculo_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db1); 	
	}else { 
		$sqlAtualiza2="DROP TABLE tokiomarine.periodoVeiculo";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db1);
		}

$sqlS3="SHOW TABLES FROM tokiomarine WHERE tables_in_tokiomarine LIKE 'periodoVeiculo_%'";
$resultS3 = mysql_query($sqlS3,$db1);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - tokiomarine(periodoVeiculo)";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup tokiomarine(periodoVeiculo)<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE tokiomarine.periodoVeiculo_atualiza TO tokiomarine.periodoVeiculo;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db1); 

##############################################################################################

	 }elseif($_POST['tabela']=="acessorio"){
		 
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE tokiomarine.acessorio_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db1);

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM tokiomarine.acessorio_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE tokiomarine.acessorio TO tokiomarine.acessorio_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db1); 
	}else{ 
		$sqlAtualiza2="DROP TABLE tokiomarine.acessorio";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db1);
		}

$sqlS3="SHOW TABLES FROM tokiomarine WHERE tables_in_tokiomarine LIKE 'acessorio_%'";
$resultS3 = mysql_query($sqlS3,$db1);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - tokiomarine(acessorio)";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup tokiomarine(acessorio)<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE tokiomarine.acessorio_atualiza TO tokiomarine.acessorio;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db1); 

##############################################################################################
		 
		 }elseif( $_POST['tabela']=="avarias" ){  

####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE tokiomarine.avarias_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db1);

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM tokiomarine.avarias_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE tokiomarine.avarias TO tokiomarine.avarias_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db1); 
	}else{ 
		$sqlAtualiza2="DROP TABLE tokiomarine.avarias";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db1);
		}

$sqlS3="SHOW TABLES FROM tokiomarine WHERE tables_in_tokiomarine LIKE 'avarias_%'";
$resultS3 = mysql_query($sqlS3,$db1);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - tokiomarine(avarias)";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup tokiomarine(avarias)<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE tokiomarine.avarias_atualiza TO tokiomarine.avarias;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db1);

##############################################################################################

			 }elseif($_POST['tabela']=="pecas"){

####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE tokiomarine.pecas_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db1);

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM tokiomarine.pecas_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE tokiomarine.pecas TO tokiomarine.pecas_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db1); 
	}else{ 
		$sqlAtualiza2="DROP TABLE tokiomarine.pecas";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db1);
		}

$sqlS3="SHOW TABLES FROM tokiomarine WHERE tables_in_tokiomarine LIKE 'pecas_%'";
$resultS3 = mysql_query($sqlS3,$db1);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - tokiomarine(pecas)";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup tokiomarine(pecas)<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE tokiomarine.pecas_atualiza TO tokiomarine.pecas;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db1);

##############################################################################################
				 }elseif($_POST['tabela']=="parecerTecnico"){
####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE tokiomarine.parecerTecnico_atualiza ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db1);

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM tokiomarine.parecerTecnico_".date('Ymd').""))) { 
 	$sqlAtualiza4="RENAME TABLE tokiomarine.parecerTecnico TO tokiomarine.parecerTecnico_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db1); 
	}else{ 
		$sqlAtualiza2="DROP TABLE tokiomarine.parecerTecnico";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db1);
		}

$sqlS3="SHOW TABLES FROM tokiomarine WHERE tables_in_tokiomarine LIKE 'parecerTecnico_%'";
$resultS3 = mysql_query($sqlS3,$db1);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - tokiomarine(parecerTecnico)";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup tokiomarine(parecerTecnico)<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE tokiomarine.parecerTecnico_atualiza TO tokiomarine.parecerTecnico;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db1);


##############################################################################################

					 }
 
 
}// validou -> salva banco de dados
 
 $obs="ARQUIVO IMPORTADO COM SUCESSO! -> ".$_FILES['Filedata']['name']."\nQuantidade de registros Atualizados".$adicionado;  
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['Filedata']['name']);
 
 unlink($arquivo);
 
?>
  <tr>
   <td height="50" colspan="4" ><div align="right" class="style12"><b>Quantidade de registros Atualizados &nbsp;<?php echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>

<? 

##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizarTabelasTokio.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} ?>
</body>
</html>
