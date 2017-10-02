<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","9000M");

$tiraAcentos=array('u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>" ","`"=>" ");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html;">
<title>Atualizar Ve&iacute;culos Allianz Seguros</title>
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
<form action="atualizar_veiculo_allianz.php" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="98%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culos Allianz</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato XLSX</td>
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
$array = explode("\n",$texto);
$contador=0;

$conteudoRecebido=substr($array[0],0,56);   

												 
if( ($fileType=='Excel2007') && ($conteudoRecebido=='COD_MARCA;COD_MODELO;DS_MODELO;VERSAO;ANO_INICIO;ANO_FIN') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS veiculos_allianz_atualizacao (
  `cd_marca_veiculo` int(1) NOT NULL,
  `cd_modelo_veiculo` int(7) NOT NULL,
  `ds_descricao` varchar(120) NOT NULL,
  `nr_ano_ini` int(4) NOT NULL,
  `nr_ano_fim` int(4) NOT NULL,
  `cd_marca_fipe` int(4) NOT NULL,
  `cd_modelo_fipe` int(4) NOT NULL,
  `fabricante` varchar(120) NOT NULL,
  PRIMARY KEY (`cd_marca_veiculo`,`cd_modelo_veiculo`),
  KEY `idxfabricante` (`fabricante`),
  KEY `idxmodelo` (`ds_descricao`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);	
	


?>
<table width="100%" border="00" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
  <tr>
    <td height="25" colspan="4" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 <? 
 $contador=1;
 $cont=0;
 $contador1=1;
 for($i=0;next($array);$i++)
   {
   	   $array_csv = explode(";",$array[$contador]);
	   if(strlen(trim($array_csv[2]))>=2)
	   {
	
		   switch(trim($array_csv[0]))
	   {
case "1": $fabricante="AGRALE										";break;  
case "2": $fabricante="ALFA ROMEO               ";break;  
case "3": $fabricante="ASIA MOTORS              ";break;  
case "4": $fabricante="AUDI                     ";break;  
case "6": $fabricante="BMW                      ";break;  
case "7": $fabricante="BRANDY                   ";break;  
case "8": $fabricante="KTM                      ";break;  
case "9": $fabricante="CHRYSLER                 ";break;  
case "10": $fabricante="CITROEN                  ";break; 
case "11": $fabricante="DAEWOO                   ";break; 
case "12": $fabricante="DAIHATSU                 ";break; 
case "13": $fabricante="DODGE                    ";break; 
case "14": $fabricante="FERRARI                  ";break; 
case "15": $fabricante="FIAT                     ";break; 
case "16": $fabricante="FORD                     ";break; 
case "17": $fabricante="CHEVROLET                ";break; 
case "18": $fabricante="HARLEY DAVIDSON          ";break; 
case "19": $fabricante="HONDA                    ";break; 
case "20": $fabricante="HYOSUNG                  ";break; 
case "21": $fabricante="HYUNDAI                  ";break; 
case "22": $fabricante="ISUZU                    ";break; 
case "23": $fabricante="JAGUAR                   ";break; 
case "25": $fabricante="KAHENA                   ";break; 
case "26": $fabricante="KAWASAKI                 ";break; 
case "27": $fabricante="KIA                      ";break; 
case "29": $fabricante="LADA                     ";break; 
case "30": $fabricante="LAMBORGHINI              ";break; 
case "31": $fabricante="LAND ROVER               ";break; 
case "32": $fabricante="LOTUS                    ";break; 
case "33": $fabricante="MASERATI                 ";break; 
case "34": $fabricante="MAZDA                    ";break; 
case "35": $fabricante="MERCEDES BENZ            ";break; 
case "36": $fabricante="MITSUBISHI               ";break; 
case "37": $fabricante="NISSAN                   ";break; 
case "38": $fabricante="PEUGEOT                  ";break; 
case "39": $fabricante="PORSCHE                  ";break; 
case "40": $fabricante="RENAULT                  ";break; 
case "41": $fabricante="SUZUKI                   ";break; 
case "42": $fabricante="ROVER                    ";break; 
case "43": $fabricante="SAAB                     ";break; 
case "44": $fabricante="SCANIA                   ";break; 
case "45": $fabricante="SEAT                     ";break; 
case "46": $fabricante="SUBARU                   ";break; 
case "47": $fabricante="SUZUKI                   ";break; 
case "48": $fabricante="TOYOTA                   ";break; 
case "49": $fabricante="TRIUMPH                  ";break; 
case "50": $fabricante="PIAGGIO                  ";break; 
case "51": $fabricante="VOLKSWAGEN               ";break; 
case "52": $fabricante="VOLVO                    ";break; 
case "53": $fabricante="YAMAHA                   ";break; 
case "55": $fabricante="SSANGYONG                ";break; 
case "56": $fabricante="JPX                      ";break; 
case "57": $fabricante="GURGEL                   ";break; 
case "58": $fabricante="CBT                      ";break; 
case "59": $fabricante="ENGESA                   ";break; 
case "60": $fabricante="DAELIM                   ";break; 
case "61": $fabricante="GMC                      ";break; 
case "64": $fabricante="PUMA                     ";break; 
case "66": $fabricante="SUNDOWN                  ";break; 
case "68": $fabricante="CALOI                    ";break; 
case "69": $fabricante="EMME                     ";break; 
case "70": $fabricante="ACURA                    ";break; 
case "71": $fabricante="CAGIVA                   ";break; 
case "72": $fabricante="DUCATI                   ";break; 
case "73": $fabricante="CADILLAC                 ";break; 
case "74": $fabricante="ENVEMO                   ";break; 
case "76": $fabricante="HUSQVARNA                ";break; 
case "77": $fabricante="IVECO                    ";break; 
case "77": $fabricante="IVECO-FIAT               ";break; 
case "78": $fabricante="JEEP                     ";break; 
case "79": $fabricante="LEXUS                    ";break; 
case "80": $fabricante="MERCURY                  ";break; 
case "81": $fabricante="MIURA                    ";break; 
case "82": $fabricante="PLYMOUTH                 ";break; 
case "83": $fabricante="PONTIAC                  ";break; 
case "84": $fabricante="SATURN                   ";break; 
case "85": $fabricante="SAAB-SCANIA              ";break; 
case "86": $fabricante="SCANIA-VABIS             ";break; 
case "87": $fabricante="BRM                      ";break; 
case "88": $fabricante="TROLLER                  ";break; 
case "89": $fabricante="ORCA                     ";break; 
case "90": $fabricante="MARCOPOLO                ";break; 
case "91": $fabricante="AM GENERAL               ";break; 
case "92": $fabricante="NAVISTAR                 ";break; 
case "93": $fabricante="APRILIA                  ";break; 
case "94": $fabricante="L AQUILA                 ";break; 
case "95": $fabricante="KASINSKI                 ";break; 
case "96": $fabricante="INTERNATIONAL            ";break; 
case "98": $fabricante="ATALA                    ";break; 
case "99": $fabricante="MOTOGUZZI                ";break; 
case "101": $fabricante="SMART                    ";break;
case "104": $fabricante="MV AGUSTA                ";break;
case "106": $fabricante="MATRA                    ";break;
case "123": $fabricante="MINI                     ";break;
case "124": $fabricante="MVK                      ";break;
case "125": $fabricante="TRAXX                    ";break;
case "126": $fabricante="NEOBUS                   ";break;
case "128": $fabricante="BY CRISTO                ";break;
case "130": $fabricante="BUELL                    ";break;
case "131": $fabricante="GARINNI                  ";break;
case "132": $fabricante="VENTO                    ";break;
case "133": $fabricante="HUSABERG                 ";break;
case "134": $fabricante="MIZA                     ";break;
case "135": $fabricante="SHINERAY                 ";break;
case "136": $fabricante="WUYANG                   ";break;
case "137": $fabricante="FYM                      ";break;
case "138": $fabricante="CHANA                    ";break;
case "139": $fabricante="LOBINI                   ";break;
case "141": $fabricante="JONNY                    ";break;
case "143": $fabricante="LIFAN                    ";break;
case "144": $fabricante="GAS GAS                  ";break;
case "145": $fabricante="HAOBAO                   ";break;
case "146": $fabricante="AMAZONAS                 ";break;
case "147": $fabricante="DAYANG                   ";break;
case "149": $fabricante="WALK                     ";break;
case "150": $fabricante="BABYBUGGY                ";break;
case "151": $fabricante="BRAVA                    ";break;
case "155": $fabricante="ASTON MARTIN             ";break;
case "157": $fabricante="DERBI                    ";break;
case "158": $fabricante="FOX                      ";break;
case "160": $fabricante="BUGRE                    ";break;
case "161": $fabricante="CICCOBUS                 ";break;
case "166": $fabricante="BIMOTA                   ";break;
case "167": $fabricante="GREEN MOTOS              ";break;
case "168": $fabricante="MAHINDRA                 ";break;
case "170": $fabricante="VOLCANO                  ";break;
case "171": $fabricante="GARINNI                  ";break;
case "174": $fabricante="LON-V                    ";break;
case "176": $fabricante="DAFRA                    ";break;
case "177": $fabricante="DAYUN                    ";break;
case "178": $fabricante="WALKBUS                  ";break;
case "180": $fabricante="HAFEI/EFFA               ";break;
case "183": $fabricante="MALAGUTI                 ";break;
case "185": $fabricante="FIBRAVAN                 ";break;
case "190": $fabricante="BRP                      ";break;
case "196": $fabricante="HAFEI/EFFA               ";break;
case "196": $fabricante="HAFEI                    ";break;
case "197": $fabricante="GREAT WALL               ";break;
case "198": $fabricante="SHANDONG LANDUN          ";break;
case "199": $fabricante="JINBEI                   ";break;
case "203": $fabricante="IROS                     ";break;
case "205": $fabricante="BUENO                    ";break;
case "206": $fabricante="BENELLI                  ";break;
case "208": $fabricante="MRX                      ";break;
case "209": $fabricante="TAC                      ";break;
case "211": $fabricante="CHERY                    ";break;
case "212": $fabricante="WAKE                     ";break;
case "213": $fabricante="PEGASSI                  ";break;
case "216": $fabricante="SINOTRUK                 ";break;
case "219": $fabricante="MORRIS GARAGE            ";break;
case "220": $fabricante="TECMOTO                  ";break;
case "225": $fabricante="JOHNNYPAG                ";break;
case "226": $fabricante="FYBER                    ";break;
case "229": $fabricante="MAGRAO TRICICLOS         ";break;
case "231": $fabricante="JAC MOTORS               ";break;
case "236": $fabricante="EFFA                     ";break;
case "237": $fabricante="MAN                      ";break;
case "240": $fabricante="TIGER                    ";break;
case "246": $fabricante="LERIVO                   ";break;
case "247": $fabricante="RELY                     ";break;
case "248": $fabricante="FOTON                    ";break;
case "249": $fabricante="ROYAL ENFIELD            ";break;
case "250": $fabricante="SHACMAN                  ";break;
case "251": $fabricante="RIGUETE                  ";break;
case "252": $fabricante="GEELY                    ";break;
case "253": $fabricante="DAFRA                    ";break;
case "253": $fabricante="Motorino                 ";break;
case "254": $fabricante="MAHINDRA BRAMONT         ";break;
case "256": $fabricante="KASINSKI                 ";break;
case "257": $fabricante="MOTOCAR                  ";break;
case "258": $fabricante="INDIAN                   ";break;
case "259": $fabricante="FYBER                    ";break;
case "991": $fabricante="BUGGY                    ";break;
case "999": $fabricante="MODELOS ESPECIAIS        ";break;
	   }
	   
				$sql1 = "INSERT INTO veiculos_allianz_atualizacao  (cd_marca_veiculo,fabricante,cd_modelo_veiculo,ds_descricao,nr_ano_ini,nr_ano_fim,cd_marca_fipe,cd_modelo_fipe) 
				VALUES (
				'".trim($array_csv[0])."',
				'".trim($fabricante)."',
				'".trim($array_csv[1])."',
				'".trim(strtr($array_csv[2],$tiraAcentos))." ".trim(strtr($array_csv[3],$tiraAcentos))."',
				'".trim($array_csv[4])."',
				'".trim($array_csv[5])."',
				'', 
				'')";  
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
}


?>
  <tr>
   <td height="50" colspan="4"><center><h3>Quantidade total de ve&iacute;culos adicionados &nbsp;<? echo $cont;?>&nbsp;</h3></center></td>
  </tr>
</table>
<?

$obs="Quantidade total de ve&iacute;culos ".$cont;
unlink($arquivo);
unlink($arquivoNovo);


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculos_allianz_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculos_allianz_".date('Ymd').""))) {
	$sqlAtualiza4="RENAME TABLE webvist.veiculos_allianz TO webvist.veiculos_allianz_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculos_allianz";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db);
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculos_allianz_%'";
$resultS3 = mysql_query($sqlS3,$db);

if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculos_allianz_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculos_allianz_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculos_allianz_atualizacao TO webvist.veiculos_allianz ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 

##############################################################################################

}else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='COD_MARCA;COD_MODELO;DS_MODELO;VERSAO;ANO_INICIO;ANO_FIN'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}


##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_veiculo_allianz.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
