<?php

include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="uploader/jquery-latest.js" type="text/javascript" language="javascript"></script>
<script src="uploader/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link href="../../Users/estilos1.css" rel="stylesheet" type="text/css">
<title>IMPORTAR CEP</title>
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
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">Atualizar Banco de CEP</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12 style15">&nbsp;&nbsp;Insira o arquivo no formato csv <br />
&nbsp;      (separado por ponto e v&iacute;rgula). </td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="upload1[]" id="Filedata" class="multi" />
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" > 
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
<?php

preg_match('/([DNE_GU_]{1,})[A-Z]{2}[_LOGRADOUROS]{1,}/i', $_FILES['Filedata']["name"], $result);
preg_match('/\.([0-9A-z]{1,})/i', $_FILES['Filedata']["name"], $result2);
$nomeArquivo=$result[1];
$extensao=$result2[1];

if($_FILES)
{

if( ($nomeArquivo=='DNE_GU_') && (strtoupper($extensao)=='TXT') )
{

for ( $tamanho = count($_FILES['upload1']['name']), $indice = 0; $indice < $tamanho; $indice++){
$arquivo = "atualizacoesTemp/" . $_FILES['upload1']['name'][$indice];
move_uploaded_file($_FILES['upload1']['tmp_name'][$indice], $arquivo);
$fp = fopen($arquivo,'r');
//$texto = fread($fp, filesize($arquivo));

$contador=0;
while($linha = fgets($fp))
  {

$uf = substr($linha, 1, 2);
switch ($uf){
	case 'AC': $estado="ACRE"; break;
	case 'AL': $estado="ALAGOAS"; break;
	case 'AM': $estado="AMAZONAS"; break;
	case 'AP': $estado="AMAPA"; break;
	case 'BA': $estado="BAHIA"; break;
	case 'CE': $estado="CEARA"; break;
	case 'DF': $estado="DISTRITO FEDERAL"; break;
	case 'ES': $estado="ESPIRITO SANTO"; break;
	case 'GO': $estado="GOIAS"; break;
	case 'MA': $estado="MARANHAO"; break;
	case 'MG': $estado="MINAS GERAIS"; break;
	case 'MS': $estado="MATO GROSSO DO SUL"; break;
	case 'MT': $estado="MATO GROSSO"; break;
	case 'PA': $estado="PARA"; break;
	case 'PB': $estado="PARAIBA"; break;
	case 'PE': $estado="PERNAMBUCO"; break;
	case 'PI': $estado="PIAUI"; break;
	case 'PR': $estado="PARANA"; break;
	case 'RJ': $estado="RIO DE JANEIRO"; break;
	case 'RN': $estado="RIO GRANDE DO NORTE"; break;
	case 'RO': $estado="RONDANIA"; break;
	case 'RR': $estado="RORAIMA"; break;
	case 'RS': $estado="RIO GRANDE DO SUL"; break;
	case 'SE': $estado="SERGIPE"; break;
	case 'SP': $estado="SAO PAULO"; break;
	case 'TO': $estado="TOCANTINS"; break;
	default: break;
	}
	
$cidade = strtr(substr($linha, 17, 60),array(                       
											 						 "'" => " ",
																	 "`" => " ",
																	 "á" => "a",
                                                                     "à" => "a",
                                                                     "ã" => "a",
                                                                     "â" => "a",
                                                                     "é" => "e",
                                                                     "ê" => "e",
                                                                     "í" => "i",
                                                                     "ó" => "o",
                                                                     "ô" => "o",
                                                                     "õ" => "o",
                                                                     "ú" => "u",
                                                                     "ü" => "u",
                                                                     "*" => "_",
                                                                     "ç" => "c",
                                                                     "Á" => "A",
                                                                     "À" => "A",
                                                                     "Ã" => "A",
                                                                     "Â" => "A",
                                                                     "É" => "E",
                                                                     "Ê" => "E",
                                                                     "Í" => "I",
                                                                     "Ó" => "O",
                                                                     "Ô" => "O",
                                                                     "Õ" => "O",
                                                                     "Ú" => "U",
                                                                     "Ü" => "U",
                                                                     "Ç" => "C"
                                                                   ));
$bairro = strtr(substr($linha, 102, 60),array(                   
											  					      "'" => " ",
																	 "`" => " ",
																	 "á" => "a",
                                                                     "à" => "a",
                                                                     "ã" => "a",
                                                                     "â" => "a",
                                                                     "é" => "e",
                                                                     "ê" => "e",
                                                                     "í" => "i",
                                                                     "ó" => "o",
                                                                     "ô" => "o",
                                                                     "õ" => "o",
                                                                     "ú" => "u",
                                                                     "ü" => "u",
                                                                     "*" => "_",
                                                                     "ç" => "c",
                                                                     "Á" => "A",
                                                                     "À" => "A",
                                                                     "Ã" => "A",
                                                                     "Â" => "A",
                                                                     "É" => "E",
                                                                     "Ê" => "E",
                                                                     "Í" => "I",
                                                                     "Ó" => "O",
                                                                     "Ô" => "O",
                                                                     "Õ" => "O",
                                                                     "Ú" => "U",
                                                                     "Ü" => "U",
                                                                     "Ç" => "C"
                                                                   ));
$abrev = strtr(substr($linha, 259, 20),array(                      
											 						  "'" => " ",
																	 "`" => " ",
																	 "á" => "a",
                                                                     "à" => "a",
                                                                     "ã" => "a",
                                                                     "â" => "a",
                                                                     "é" => "e",
                                                                     "ê" => "e",
                                                                     "í" => "i",
                                                                     "ó" => "o",
                                                                     "ô" => "o",
                                                                     "õ" => "o",
                                                                     "ú" => "u",
                                                                     "ü" => "u",
                                                                     "*" => "_",
                                                                     "ç" => "c",
                                                                     "Á" => "A",
                                                                     "À" => "A",
                                                                     "Ã" => "A",
                                                                     "Â" => "A",
                                                                     "É" => "E",
                                                                     "Ê" => "E",
                                                                     "Í" => "I",
                                                                     "Ó" => "O",
                                                                     "Ô" => "O",
                                                                     "Õ" => "O",
                                                                     "Ú" => "U",
                                                                     "Ü" => "U",
                                                                     "Ç" => "C"
                                                                   ));
$prefixo = strtr(substr($linha, 285, 60),array(                    
											   						  "'" => " ",
																	 "`" => " ",
																	 "á" => "a",
                                                                     "à" => "a",
                                                                     "ã" => "a",
                                                                     "â" => "a",
                                                                     "é" => "e",
                                                                     "ê" => "e",
                                                                     "í" => "i",
                                                                     "ó" => "o",
                                                                     "ô" => "o",
                                                                     "õ" => "o",
                                                                     "ú" => "u",
                                                                     "ü" => "u",
                                                                     "*" => "_",
                                                                     "ç" => "c",
                                                                     "Á" => "A",
                                                                     "À" => "A",
                                                                     "Ã" => "A",
                                                                     "Â" => "A",
                                                                     "É" => "E",
                                                                     "Ê" => "E",
                                                                     "Í" => "I",
                                                                     "Ó" => "O",
                                                                     "Ô" => "O",
                                                                     "Õ" => "O",
                                                                     "Ú" => "U",
                                                                     "Ü" => "U",
                                                                     "Ç" => "C"
                                                                   ));
$endereco = strtr(substr($linha, 374, 60),array(                   
																	  "'" => " ",
																	 "`" => " ",
																	 "á" => "a",
                                                                     "à" => "a",
                                                                     "ã" => "a",
                                                                     "â" => "a",
                                                                     "é" => "e",
                                                                     "ê" => "e",
                                                                     "í" => "i",
                                                                     "ó" => "o",
                                                                     "ô" => "o",
                                                                     "õ" => "o",
                                                                     "ú" => "u",
                                                                     "ü" => "u",
                                                                     "*" => "_",
                                                                     "ç" => "c",
                                                                     "Á" => "A",
                                                                     "À" => "A",
                                                                     "Ã" => "A",
                                                                     "Â" => "A",
                                                                     "É" => "E",
                                                                     "Ê" => "E",
                                                                     "Í" => "I",
                                                                     "Ó" => "O",
                                                                     "Ô" => "O",
                                                                     "Õ" => "O",
                                                                     "Ú" => "U",
                                                                     "Ü" => "U",
                                                                     "Ç" => "C"
                                                                   ));
$cep = substr($linha, 518, 8);

if (trim($cep)!=''){
$sql1 = "REPLACE LOW_PRIORITY INTO CEP2 (numero,abrev,rua,bairro,cidade,estado,uf) 
				VALUES (
				'".trim($cep)."',
				'".strtoupper(trim($abrev))."',
				'".strtoupper(trim($prefixo))." ".strtoupper(trim($endereco))."',
				'".strtoupper(trim($bairro))."',
				'".strtoupper(trim($cidade))."',
				'".strtoupper(trim($estado))."',
				'".trim($uf)."')";
				
				$result2 = @mysql_query($sql1,$db);

}

$contador++;

	if(mysql_affected_rows()==1)
	{
	$contador1++;
	}


$adicionado=$contador1-1;
}
 echo "ARQUIVO IMPORTADO COM SUCESSO!<br/>";
 print_r ($_FILES['upload1']['name'][$indice]);
?>
  <tr>
   <td height="27" colspan="4" bgcolor="#E9E9E9"><div align="right" class="style12"><b>Quantidade de registros adicionados &nbsp;<?php echo $adicionado;?>&nbsp;</b></div></td>
  </tr>
</table>
<?php
	}

$obs="CEPs Atualizados com SUCESSO UFs-> ".$indice;
unlink($arquivo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizarCEPs - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'][$indice];
	move_uploaded_file($_FILES['Filedata']['tmp_name'][$indice], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");
	
	echo "<br /><br /><br /><center><h1>Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.<br>Informe o administrador do sistema.<h1></center>";
	
	$obs="Não foi possível atualizar a tabela pois o arquivo enviado está em formato inválido.";
	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"importar_CEP.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

} // FIM $FILES
?>
</body>
</html>
