<?
include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");


$tiraAcentos=array('%E1' => 'a','%E0' => 'a','%E3' => 'a','%E2' => 'a','%E9' => 'e','%EA' => 'e','%ED' => 'i','%F3' => 'o','%F4' => 'o',
'%F5' => 'o','%FA' => 'u','%E7' => 'c','%C1' => 'A','%C0' => 'A','%C3' => 'A','%C2' => 'A','%C9' => 'E','%CA' => 'E','%CD' => 'I','%D3' => 'O','%F4' => 'O','%D5' => 'O','%DA' => 'U','%C7' => 'C','%21' => '!','%2A' => '*','%28' => '(','%29' => ')','%3B' => ';','%3A' => ':',																	 '%40' => '@','%26' => '&','%3D' => '=','%2B' => '+','%24' => '$','%2C' => ',','%2F' => '/','%3F' => '?','%25' => '%','%23' => '#','%5B' => '[','%5D' => ']','&' => 'e','u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>"", "`"=>"");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Ve&iacute;culo ALFA</title>
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

<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Ve&iacute;culo Alfa</td>
  </tr>
  <tr>
    <td height="27" colspan="2"><span class="style12">&nbsp;&nbsp;</span></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#DBDBDB'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato XLSX<span style="color:#F00">(Se estiver no formato XLS abra e salve no formato XLSX primeiro)</span></td>
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

$conteudoRecebido=substr($array[0],0,19);

if( ($fileType=='Excel2007') && ($conteudoRecebido=='Cd_veiculo;FMModelo') )
{
	
$sqlAtualiza="CREATE TABLE IF NOT EXISTS veiculo_alfa_atualizacao (
  `codigo` varchar(20) NOT NULL,
  `fabricante` varchar(100) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `idxfabricante` (`fabricante`),
  KEY `idxmodelo` (`modelo`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;";
$resultAtualiza = mysql_query($sqlAtualiza,$db);	
	



//print_r($array);
?>
<table width="98%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="4" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Dados da Atualiza&ccedil;&atilde;o</td>
  </tr>
 <? 
 $cont=0;
 $contador=1;
   while($contador<=sizeof($array))
   {
   $dados = explode(";",$array[$contador]);
if(strlen($dados[0])>2)
{
$linha=trim($dados[1]);
//arrumando os dados
$fabricante1 = str_replace(" ","@",trim(strtoupper($linha))); 
$achou=0;
$fabricante="";
$modelo="";
if(sizeof(explode("ACURA@",$fabricante1))==2&&$achou==0){$fabricante="ACURA";$achou=1;}
if(sizeof(explode("ADLY@",$fabricante1))==2&&$achou==0){$fabricante="ADLY";$achou=1;}
if(sizeof(explode("AGRALE@",$fabricante1))==2&&$achou==0){$fabricante="AGRALE";$achou=1;}
if(sizeof(explode("ALFA@ROMEO@",$fabricante1))==2&&$achou==0){$fabricante="ALFA ROMEO";$achou=1;}
if(sizeof(explode("ASTON@MARTIN@",$fabricante1))==2&&$achou==0){$fabricante="ASTON MARTIN";$achou=1;} 
if(sizeof(explode("AM@GENERAL@",$fabricante1))==2&&$achou==0){$fabricante="AM GENERAL";$achou=1;}
if(sizeof(explode("AMAZONAS@",$fabricante1))==2&&$achou==0){$fabricante="AMAZONAS";$achou=1;}
if(sizeof(explode("AMERICAN@",$fabricante1))==2&&$achou==0){$fabricante="AMERICAN";$achou=1;}
if(sizeof(explode("ANGOLA@",$fabricante1))==2&&$achou==0){$fabricante="ANGOLA";$achou=1;}
if(sizeof(explode("ANTONINI@",$fabricante1))==2&&$achou==0){$fabricante="ANTONINI";$achou=1;}
if(sizeof(explode("AOKI@",$fabricante1))==2&&$achou==0){$fabricante="AOKI";$achou=1;}
if(sizeof(explode("APRILIA@",$fabricante1))==2&&$achou==0){$fabricante="APRILIA";$achou=1;}
if(sizeof(explode("ARTESANAL@",$fabricante1))==2&&$achou==0){$fabricante="ARTESANAL";$achou=1;}
if(sizeof(explode("ASIA@MOTORS@",$fabricante1))==2&&$achou==0){$fabricante="ASIA MOTORS";$achou=1;}
if(sizeof(explode("ATALA@",$fabricante1))==2&&$achou==0){$fabricante="ATALA";$achou=1;}
if(sizeof(explode("AUDI@",$fabricante1))==2&&$achou==0){$fabricante="AUDI";$achou=1;}
if(sizeof(explode("BAJAJ@",$fabricante1))==2&&$achou==0){$fabricante="BAJAJ";$achou=1;}
if(sizeof(explode("BETA@",$fabricante1))==2&&$achou==0){$fabricante="BETA";$achou=1;}
if(sizeof(explode("BIMOTA@",$fabricante1))==2&&$achou==0){$fabricante="BIMOTA";$achou=1;}
if(sizeof(explode("BITREM@",$fabricante1))==2&&$achou==0){$fabricante="BITREM";$achou=1;}
if(sizeof(explode("BERTOLINI@",$fabricante1))==2&&$achou==0){$fabricante="BERTOLINI";$achou=1;}
if(sizeof(explode("BENELLI@",$fabricante1))==2&&$achou==0){$fabricante="BENELLI";$achou=1;}
if(sizeof(explode("BENTLEY@",$fabricante1))==2&&$achou==0){$fabricante="BENTLEY";$achou=1;}
if(sizeof(explode("BISELLI@",$fabricante1))==2&&$achou==0){$fabricante="BISELLI";$achou=1;}
if(sizeof(explode("BLAYA@",$fabricante1))==2&&$achou==0){$fabricante="BLAYA";$achou=1;}
if(sizeof(explode("BMW@",$fabricante1))==2&&$achou==0){$fabricante="BMW";$achou=1;}
if(sizeof(explode("BOMBEIRO@",$fabricante1))==2&&$achou==0){$fabricante="BOMBEIRO";$achou=1;}
if(sizeof(explode("BONANO@",$fabricante1))==2&&$achou==0){$fabricante="BONANO";$achou=1;}
if(sizeof(explode("BRANDY@",$fabricante1))==2&&$achou==0){$fabricante="BRANDY";$achou=1;}
if(sizeof(explode("BRAVA@",$fabricante1))==2&&$achou==0){$fabricante="BRAVA";$achou=1;}
if(sizeof(explode("BRM@",$fabricante1))==2&&$achou==0){$fabricante="BRM";$achou=1;}
if(sizeof(explode("BRP@",$fabricante1))==2&&$achou==0){$fabricante="BRP";$achou=1;}
if(sizeof(explode("BUELL@",$fabricante1))==2&&$achou==0){$fabricante="BUELL";$achou=1;}
if(sizeof(explode("BUENO@",$fabricante1))==2&&$achou==0){$fabricante="BUENO";$achou=1;}
if(sizeof(explode("BUGGY@",$fabricante1))==2&&$achou==0){$fabricante="BUGGY";$achou=1;}
if(sizeof(explode("BYCRISTO@",$fabricante1))==2&&$achou==0){$fabricante="BYCRISTO";$achou=1;}
if(sizeof(explode("CABRINI@",$fabricante1))==2&&$achou==0){$fabricante="CABRINI";$achou=1;}
if(sizeof(explode("CADILLAC@",$fabricante1))==2&&$achou==0){$fabricante="CADILLAC";$achou=1;}
if(sizeof(explode("CAGIVA@",$fabricante1))==2&&$achou==0){$fabricante="CAGIVA";$achou=1;}
if(sizeof(explode("CALOI@",$fabricante1))==2&&$achou==0){$fabricante="CALOI";$achou=1;}
if(sizeof(explode("CARBUS@",$fabricante1))==2&&$achou==0){$fabricante="CARBUS";$achou=1;}
if(sizeof(explode("CATERPILAR@",$fabricante1))==2&&$achou==0){$fabricante="CATERPILAR";$achou=1;}
if(sizeof(explode("CHAMONIX@",$fabricante1))==2&&$achou==0){$fabricante="CHAMONIX";$achou=1;}
if(sizeof(explode("CHANA@",$fabricante1))==2&&$achou==0){$fabricante="CHANA";$achou=1;}
if(sizeof(explode("CHANGAN@",$fabricante1))==2&&$achou==0){$fabricante="CHANGAN";$achou=1;}
if(sizeof(explode("CHEVROLET@",$fabricante1))==2&&$achou==0){$fabricante="CHEVROLET";$achou=1;}
if(sizeof(explode("CHERY@",$fabricante1))==2&&$achou==0){$fabricante="CHERY";$achou=1;}
if(sizeof(explode("CHRYSLER@",$fabricante1))==2&&$achou==0){$fabricante="CHRYSLER";$achou=1;}
if(sizeof(explode("CICCOBUS@",$fabricante1))==2&&$achou==0){$fabricante="CICCOBUS";$achou=1;}
if(sizeof(explode("CIFERAL@",$fabricante1))==2&&$achou==0){$fabricante="CIFERAL";$achou=1;}
if(sizeof(explode("CIOATO@",$fabricante1))==2&&$achou==0){$fabricante="CIOATO";$achou=1;}
if(sizeof(explode("CITROEN@",$fabricante1))==2&&$achou==0){$fabricante="CITROEN";$achou=1;}
if(sizeof(explode("CLARK@",$fabricante1))==2&&$achou==0){$fabricante="CLARK";$achou=1;}
if(sizeof(explode("COBRASMA@",$fabricante1))==2&&$achou==0){$fabricante="COBRASMA";$achou=1;}
if(sizeof(explode("COLON@",$fabricante1))==2&&$achou==0){$fabricante="COLON";$achou=1;}
if(sizeof(explode("COMIL@",$fabricante1))==2&&$achou==0){$fabricante="COMIL";$achou=1;}
if(sizeof(explode("COMMER@",$fabricante1))==2&&$achou==0){$fabricante="COMMER";$achou=1;}
if(sizeof(explode("CONDOTTIERE@",$fabricante1))==2&&$achou==0){$fabricante="CONDOTTIERE";$achou=1;}
if(sizeof(explode("CONTIN@",$fabricante1))==2&&$achou==0){$fabricante="CONTIN";$achou=1;}
if(sizeof(explode("CRIOGEM@",$fabricante1))==2&&$achou==0){$fabricante="CRIOGEM";$achou=1;}
if(sizeof(explode("CROSS@LANDER@",$fabricante1))==2&&$achou==0){$fabricante="CROSS LANDER";$achou=1;}
if(sizeof(explode("CUMMINS@",$fabricante1))==2&&$achou==0){$fabricante="CUMMINS";$achou=1;}
if(sizeof(explode("CTB@",$fabricante1))==2&&$achou==0){$fabricante="CTB";$achou=1;}
if(sizeof(explode("D.BENGUELLA@",$fabricante1))==2&&$achou==0){$fabricante="D.BENGUELLA";$achou=1;}
if(sizeof(explode("DAELIM@",$fabricante1))==2&&$achou==0){$fabricante="DAELIM";$achou=1;}
if(sizeof(explode("DAEWOO@",$fabricante1))==2&&$achou==0){$fabricante="DAEWOO";$achou=1;}
if(sizeof(explode("DAF@",$fabricante1))==2&&$achou==0){$fabricante="DAF";$achou=1;}
if(sizeof(explode("DAFRA@",$fabricante1))==2&&$achou==0){$fabricante="DAFRA";$achou=1;}
if(sizeof(explode("DAYANG@",$fabricante1))==2&&$achou==0){$fabricante="DAYANG";$achou=1;}
if(sizeof(explode("DAYUN@",$fabricante1))==2&&$achou==0){$fabricante="DAYUN";$achou=1;}
if(sizeof(explode("DAIHATSU@",$fabricante1))==2&&$achou==0){$fabricante="DAIHATSU";$achou=1;}
if(sizeof(explode("DAMBROZ@",$fabricante1))==2&&$achou==0){$fabricante="DAMBROZ";$achou=1;}
if(sizeof(explode("DERBI@",$fabricante1))==2&&$achou==0){$fabricante="DERBI";$achou=1;}
if(sizeof(explode("DELKA@",$fabricante1))==2&&$achou==0){$fabricante="DELKA";$achou=1;}
if(sizeof(explode("DKW@",$fabricante1))==2&&$achou==0){$fabricante="DKW";$achou=1;}
if(sizeof(explode("DODGE@",$fabricante1))==2&&$achou==0){$fabricante="DODGE";$achou=1;}
if(sizeof(explode("DUCATI@",$fabricante1))==2&&$achou==0){$fabricante="DUCATI";$achou=1;}
if(sizeof(explode("EDRA@",$fabricante1))==2&&$achou==0){$fabricante="EDRA";$achou=1;}
if(sizeof(explode("EFFA@",$fabricante1))==2&&$achou==0){$fabricante="EFFA";$achou=1;}
if(sizeof(explode("ELLFEN@",$fabricante1))==2&&$achou==0){$fabricante="ELLFEN";$achou=1;}
if(sizeof(explode("EMME@",$fabricante1))==2&&$achou==0){$fabricante="EMME";$achou=1;}
if(sizeof(explode("ENGATCAR@",$fabricante1))==2&&$achou==0){$fabricante="ENGATCAR";$achou=1;}
if(sizeof(explode("ENGERAUTO@",$fabricante1))==2&&$achou==0){$fabricante="ENGERAUTO";$achou=1;}
if(sizeof(explode("ENGESA@",$fabricante1))>=2&&$achou==0){$fabricante="ENGESA";$achou=1;}
if(sizeof(explode("ENVEMO@",$fabricante1))==2&&$achou==0){$fabricante="ENVEMO";$achou=1;}
if(sizeof(explode("EQUIPAL@",$fabricante1))==2&&$achou==0){$fabricante="EQUIPAL";$achou=1;}
if(sizeof(explode("ERL@",$fabricante1))==2&&$achou==0){$fabricante="ERL";$achou=1;}
if(sizeof(explode("FABRIC@PROPRIA@",$fabricante1))==2&&$achou==0){$fabricante="FABRIC PROPRIA";$achou=1;}
if(sizeof(explode("FACCHINI@",$fabricante1))==2&&$achou==0){$fabricante="FACCHINI";$achou=1;}
if(sizeof(explode("FERRARI@",$fabricante1))==2&&$achou==0){$fabricante="FERRARI";$achou=1;}
if(sizeof(explode("FIAT@",$fabricante1))==2&&$achou==0){$fabricante="FIAT";$achou=1;}
if(sizeof(explode("FNM@",$fabricante1))==2&&$achou==0){$fabricante="FNM";$achou=1;}
if(sizeof(explode("FORD@",$fabricante1))==2&&$achou==0){$fabricante="FORD";$achou=1;}
if(sizeof(explode("FOTON@",$fabricante1))==2&&$achou==0){$fabricante="FOTON";$achou=1;}
if(sizeof(explode("FRUEHAUF@",$fabricante1))==2&&$achou==0){$fabricante="FRUEHAUF";$achou=1;}
if(sizeof(explode("FURCARE@",$fabricante1))==2&&$achou==0){$fabricante="FURCARE";$achou=1;}
if(sizeof(explode("FYM@",$fabricante1))==2&&$achou==0){$fabricante="FYM";$achou=1;}
if(sizeof(explode("GALEGO@",$fabricante1))==2&&$achou==0){$fabricante="GALEGO";$achou=1;}
if(sizeof(explode("GANDOLFO@",$fabricante1))==2&&$achou==0){$fabricante="GANDOLFO";$achou=1;}
if(sizeof(explode("GARINI@",$fabricante1))==2&&$achou==0){$fabricante="GARINI";$achou=1;}
if(sizeof(explode("GARINNI@",$fabricante1))==2&&$achou==0){$fabricante="GARINNI";$achou=1;}
if(sizeof(explode("GAS@GAS@",$fabricante1))==2&&$achou==0){$fabricante="GAS GAS";$achou=1;}
if(sizeof(explode("GEELY@",$fabricante1))==2&&$achou==0){$fabricante="GEELY";$achou=1;}
if(sizeof(explode("GMC@",$fabricante1))==2&&$achou==0){$fabricante="GMC";$achou=1;}
if(sizeof(explode("GOCEANO@",$fabricante1))==2&&$achou==0){$fabricante="GOCEANO";$achou=1;}
if(sizeof(explode("GOTTI@",$fabricante1))==2&&$achou==0){$fabricante="GOTTI";$achou=1;}
if(sizeof(explode("GOYDO@",$fabricante1))==2&&$achou==0){$fabricante="GOYDO";$achou=1;}
if(sizeof(explode("GRAHL@",$fabricante1))==2&&$achou==0){$fabricante="GRAHL";$achou=1;}
if(sizeof(explode("GREAT@WALL@",$fabricante1))==2&&$achou==0){$fabricante="GREAT WALL";$achou=1;}
if(sizeof(explode("GREEN@",$fabricante1))==2&&$achou==0){$fabricante="GREEN";$achou=1;}
if(sizeof(explode("GROVE@",$fabricante1))==2&&$achou==0){$fabricante="GROVE";$achou=1;}
if(sizeof(explode("GUERRA@",$fabricante1))==2&&$achou==0){$fabricante="GUERRA";$achou=1;}
if(sizeof(explode("GURGEL@",$fabricante1))==2&&$achou==0){$fabricante="GURGEL";$achou=1;}
if(sizeof(explode("GUZZI@",$fabricante1))==2&&$achou==0){$fabricante="GUZZI";$achou=1;}
if(sizeof(explode("HAFEI@",$fabricante1))==2&&$achou==0){$fabricante="HAFEI";$achou=1;}
if(sizeof(explode("HALLEY@HOUSE@",$fabricante1))==2&&$achou==0){$fabricante="HALLEY HOUSE";$achou=1;}
if(sizeof(explode("HAOBAO@",$fabricante1))==2&&$achou==0){$fabricante="HAOBAO";$achou=1;}
if(sizeof(explode("HARLEY@DAVIDSON@",$fabricante1))==2&&$achou==0){$fabricante="HARLEY DAVIDSON";$achou=1;}
if(sizeof(explode("HERO@",$fabricante1))==2&&$achou==0){$fabricante="HERO";$achou=1;}
if(sizeof(explode("HILLO@",$fabricante1))==2&&$achou==0){$fabricante="HILLO";$achou=1;}
if(sizeof(explode("HONDA@",$fabricante1))==2&&$achou==0){$fabricante="HONDA";$achou=1;}
if(sizeof(explode("HUBER@",$fabricante1))==2&&$achou==0){$fabricante="HUBER";$achou=1;}
if(sizeof(explode("HUSABERG@",$fabricante1))==2&&$achou==0){$fabricante="HUSABERG";$achou=1;}
if(sizeof(explode("HUSQVARNA@",$fabricante1))==2&&$achou==0){$fabricante="HUSQVARNA";$achou=1;}
if(sizeof(explode("HYOSUNG@",$fabricante1))==2&&$achou==0){$fabricante="HYOSUNG";$achou=1;}
if(sizeof(explode("HYUNDAI@",$fabricante1))==2&&$achou==0){$fabricante="HYUNDAI";$achou=1;}
if(sizeof(explode("IBIPORA@",$fabricante1))==2&&$achou==0){$fabricante="IBIPORA";$achou=1;}
if(sizeof(explode("IDEROL@",$fabricante1))==2&&$achou==0){$fabricante="IDEROL";$achou=1;}
if(sizeof(explode("IMPERIAL@",$fabricante1))==2&&$achou==0){$fabricante="IMPERIAL";$achou=1;}
if(sizeof(explode("INCREAL@",$fabricante1))==2&&$achou==0){$fabricante="INCREAL";$achou=1;}
if(sizeof(explode("INDIAN@",$fabricante1))==2&&$achou==0){$fabricante="INDIAN";$achou=1;}
if(sizeof(explode("INFINITI@",$fabricante1))==2&&$achou==0){$fabricante="INFINITI";$achou=1;}
if(sizeof(explode("IRGA@",$fabricante1))==2&&$achou==0){$fabricante="IRGA";$achou=1;}
if(sizeof(explode("IROS@",$fabricante1))==2&&$achou==0){$fabricante="IROS";$achou=1;}
if(sizeof(explode("ISUZU@",$fabricante1))==2&&$achou==0){$fabricante="ISUZU";$achou=1;}
if(sizeof(explode("ITAPEMIRIM@",$fabricante1))==2&&$achou==0){$fabricante="ITAPEMIRIM";$achou=1;}
if(sizeof(explode("IVECO@",$fabricante1))==2&&$achou==0){$fabricante="IVECO";$achou=1;}
if(sizeof(explode("IVECO@/@FIAT@",$fabricante1))==2&&$achou==0){$fabricante="IVECO / FIAT";$achou=1;}
if(sizeof(explode("JAC@",$fabricante1))==2&&$achou==0){$fabricante="JAC";$achou=1;}
if(sizeof(explode("JAGUAR@",$fabricante1))==2&&$achou==0){$fabricante="JAGUAR";$achou=1;}
if(sizeof(explode("JAPERSIL@",$fabricante1))==2&&$achou==0){$fabricante="JAPERSIL";$achou=1;}
if(sizeof(explode("JARDINOX@",$fabricante1))==2&&$achou==0){$fabricante="JARDINOX";$achou=1;}
if(sizeof(explode("JEEP@",$fabricante1))==2&&$achou==0){$fabricante="JEEP";$achou=1;}
if(sizeof(explode("JIALING@",$fabricante1))==2&&$achou==0){$fabricante="JIALING";$achou=1;}
if(sizeof(explode("JIAPENG@VOLCANO@",$fabricante1))==2&&$achou==0){$fabricante="JIAPENG VOLCANO";$achou=1;}
if(sizeof(explode("JINBEI@",$fabricante1))==2&&$achou==0){$fabricante="JINBEI";$achou=1;}
if(sizeof(explode("JPX@",$fabricante1))==2&&$achou==0){$fabricante="JPX";$achou=1;}
if(sizeof(explode("JULIETA@",$fabricante1))==2&&$achou==0){$fabricante="JULIETA";$achou=1;}
if(sizeof(explode("JOHNNYPAG@",$fabricante1))==2&&$achou==0){$fabricante="JOHNNYPAG";$achou=1;}
if(sizeof(explode("JONNY@",$fabricante1))==2&&$achou==0){$fabricante="JONNY";$achou=1;}
if(sizeof(explode("KAHENA@",$fabricante1))==2&&$achou==0){$fabricante="KAHENA";$achou=1;}
if(sizeof(explode("KARMAN-GUIA@",$fabricante1))==2&&$achou==0){$fabricante="KARMAN-GUIA";$achou=1;}
if(sizeof(explode("KASINSKI@",$fabricante1))==2&&$achou==0){$fabricante="KASINSKI";$achou=1;}
if(sizeof(explode("KAWASAKI@",$fabricante1))==2&&$achou==0){$fabricante="KAWASAKI";$achou=1;}
if(sizeof(explode("KIA@MOTORS@",$fabricante1))==2&&$achou==0){$fabricante="KIA MOTORS";$achou=1;}
if(sizeof(explode("KIMCO@",$fabricante1))==2&&$achou==0){$fabricante="KIMCO";$achou=1;}
if(sizeof(explode("KORG@",$fabricante1))==2&&$achou==0){$fabricante="KORG";$achou=1;}
if(sizeof(explode("KRONE@",$fabricante1))==2&&$achou==0){$fabricante="KRONE";$achou=1;}
if(sizeof(explode("KRONORTE@",$fabricante1))==2&&$achou==0){$fabricante="KRONORTE";$achou=1;}
if(sizeof(explode("KTM@",$fabricante1))==2&&$achou==0){$fabricante="KTM";$achou=1;}
if(sizeof(explode("KUME@",$fabricante1))==2&&$achou==0){$fabricante="KUME";$achou=1;}
if(sizeof(explode("L@AQUILA@",$fabricante1))==2&&$achou==0){$fabricante="L AQUILA";$achou=1;}
if(sizeof(explode("LABOR@",$fabricante1))==2&&$achou==0){$fabricante="LABOR";$achou=1;}
if(sizeof(explode("LADA@",$fabricante1))==2&&$achou==0){$fabricante="LADA";$achou=1;}
if(sizeof(explode("LAND@ROVER@",$fabricante1))==2&&$achou==0){$fabricante="LAND ROVER";$achou=1;}
if(sizeof(explode("LANDUM@",$fabricante1))==2&&$achou==0){$fabricante="LANDUM";$achou=1;}
if(sizeof(explode("LAMBORGHINI@",$fabricante1))==2&&$achou==0){$fabricante="LAMBORGHINI";$achou=1;}
if(sizeof(explode("LANGERDORF@",$fabricante1))==2&&$achou==0){$fabricante="LANGERDORF";$achou=1;}
if(sizeof(explode("LAVRALE@",$fabricante1))==2&&$achou==0){$fabricante="LAVRALE";$achou=1;}
if(sizeof(explode("LENCOIS@",$fabricante1))==2&&$achou==0){$fabricante="LENCOIS";$achou=1;}
if(sizeof(explode("LERIVO@",$fabricante1))==2&&$achou==0){$fabricante="LERIVO";$achou=1;}
if(sizeof(explode("LEXUS@",$fabricante1))==2&&$achou==0){$fabricante="LEXUS";$achou=1;}
if(sizeof(explode("LIBRELATO@",$fabricante1))==2&&$achou==0){$fabricante="LIBRELATO";$achou=1;}
if(sizeof(explode("LIDER@",$fabricante1))==2&&$achou==0){$fabricante="LIDER";$achou=1;}
if(sizeof(explode("LIESS@",$fabricante1))==2&&$achou==0){$fabricante="LIESS";$achou=1;}
if(sizeof(explode("LIFAN@",$fabricante1))==2&&$achou==0){$fabricante="LIFAN";$achou=1;}
if(sizeof(explode("LINCOLN@",$fabricante1))==2&&$achou==0){$fabricante="LINCOLN";$achou=1;}
if(sizeof(explode("LINSHALM@",$fabricante1))==2&&$achou==0){$fabricante="LINSHALM";$achou=1;}
if(sizeof(explode("LOTUS@",$fabricante1))==2&&$achou==0){$fabricante="LOTUS";$achou=1;}
if(sizeof(explode("LOBINI@",$fabricante1))==2&&$achou==0){$fabricante="LOBINI";$achou=1;}
if(sizeof(explode("LON-V@",$fabricante1))==2&&$achou==0){$fabricante="LON-V";$achou=1;}
if(sizeof(explode("M.@AMARAL@",$fabricante1))==2&&$achou==0){$fabricante="M. AMARAL";$achou=1;}
if(sizeof(explode("M.A.@",$fabricante1))==2&&$achou==0){$fabricante="M.A.";$achou=1;}
if(sizeof(explode("M.REGIS.TRANSCS@",$fabricante1))==2&&$achou==0){$fabricante="M.REGIS.TRANSCS";$achou=1;}
if(sizeof(explode("MAFERSA@",$fabricante1))==2&&$achou==0){$fabricante="MAFERSA";$achou=1;}
if(sizeof(explode("MAHINDRA@",$fabricante1))==2&&$achou==0){$fabricante="MAHINDRA";$achou=1;}
if(sizeof(explode("MALAGUTI@",$fabricante1))==2&&$achou==0){$fabricante="MALAGUTI";$achou=1;}
if(sizeof(explode("MAGR�O@",$fabricante1))==2&&$achou==0){$fabricante="MAGR�O";$achou=1;}   
if(sizeof(explode("MARCOPOLO@",$fabricante1))==2&&$achou==0){$fabricante="MARCOPOLO";$achou=1;}
if(sizeof(explode("MASA@",$fabricante1))==2&&$achou==0){$fabricante="MASA";$achou=1;}
if(sizeof(explode("MASCARELLO@",$fabricante1))==2&&$achou==0){$fabricante="MASCARELLO";$achou=1;}
if(sizeof(explode("MASERATI@",$fabricante1))==2&&$achou==0){$fabricante="MASERATI";$achou=1;}
if(sizeof(explode("MASSARI@",$fabricante1))==2&&$achou==0){$fabricante="MASSARI";$achou=1;}
if(sizeof(explode("MASSEY@",$fabricante1))==2&&$achou==0){$fabricante="MASSEY";$achou=1;}
if(sizeof(explode("MATRA@",$fabricante1))==2&&$achou==0){$fabricante="MATRA";$achou=1;}
if(sizeof(explode("MAXIBUS@",$fabricante1))==2&&$achou==0){$fabricante="MAXIBUS";$achou=1;}
if(sizeof(explode("MAZDA@",$fabricante1))==2&&$achou==0){$fabricante="MAZDA";$achou=1;}
if(sizeof(explode("MCC@",$fabricante1))==2&&$achou==0){$fabricante="MCC";$achou=1;}
if(sizeof(explode("MERCEDES@BENZ@",$fabricante1))==2&&$achou==0){$fabricante="MERCEDES BENZ";$achou=1;}
if(sizeof(explode("MERCURY@",$fabricante1))==2&&$achou==0){$fabricante="MERCURY";$achou=1;}
if(sizeof(explode("METALESP@",$fabricante1))==2&&$achou==0){$fabricante="METALESP";$achou=1;}
if(sizeof(explode("METALPI@",$fabricante1))==2&&$achou==0){$fabricante="METALPI";$achou=1;}    
if(sizeof(explode("MG@",$fabricante1))==2&&$achou==0){$fabricante="MG";$achou=1;}
if(sizeof(explode("MICHIGAN@",$fabricante1))==2&&$achou==0){$fabricante="MICHIGAN";$achou=1;}
if(sizeof(explode("MIRA@",$fabricante1))==2&&$achou==0){$fabricante="MIRA";$achou=1;}
if(sizeof(explode("MITSUBISHI@",$fabricante1))==2&&$achou==0){$fabricante="MITSUBISHI";$achou=1;}
if(sizeof(explode("MIURA@",$fabricante1))==2&&$achou==0){$fabricante="MIURA";$achou=1;}
if(sizeof(explode("MIZA@",$fabricante1))==2&&$achou==0){$fabricante="MIZA";$achou=1;}
if(sizeof(explode("MINI@",$fabricante1))==2&&$achou==0){$fabricante="MINI";$achou=1;}  
if(sizeof(explode("MMC@",$fabricante1))==2&&$achou==0){$fabricante="MMC";$achou=1;}
if(sizeof(explode("MVK@",$fabricante1))==2&&$achou==0){$fabricante="MVK";$achou=1;}
if(sizeof(explode("MRX@",$fabricante1))==2&&$achou==0){$fabricante="MRX";$achou=1;}
if(sizeof(explode("MV@AGUSTA@",$fabricante1))==2&&$achou==0){$fabricante="MV AGUSTA";$achou=1;}
if(sizeof(explode("MON@PROTOTIPO@",$fabricante1))==2&&$achou==0){$fabricante="MON PROTOTIPO";$achou=1;}
if(sizeof(explode("MORINI@",$fabricante1))==2&&$achou==0){$fabricante="MORINI";$achou=1;}
if(sizeof(explode("MON@",$fabricante1))==2&&$achou==0){$fabricante="MON";$achou=1;}
if(sizeof(explode("MOTORINO@",$fabricante1))==2&&$achou==0){$fabricante="MOTORINO";$achou=1;}
if(sizeof(explode("MOTOR@HOME@",$fabricante1))==2&&$achou==0){$fabricante="MOTOR HOME";$achou=1;} 
if(sizeof(explode("MUTIRAO@",$fabricante1))==2&&$achou==0){$fabricante="MUTIRAO";$achou=1;}
if(sizeof(explode("NAVISTAR@INTERNATIONAL@",$fabricante1))==2&&$achou==0){$fabricante="NAVISTAR INTERNACIONAL";$achou=1;}
if(sizeof(explode("NAVISTAR@INTERNACIONAL@",$fabricante1))==2&&$achou==0){$fabricante="NAVISTAR INTERNACIONAL";$achou=1;}
if(sizeof(explode("NAVISTAR@DURASTAR@",$fabricante1))==2&&$achou==0){$fabricante="NAVISTAR DURASTAR";$achou=1;}
if(sizeof(explode("NELCYR@NARDELLE@",$fabricante1))==2&&$achou==0){$fabricante="NELCYR NARDELLE";$achou=1;}
if(sizeof(explode("NEOBUS@",$fabricante1))==2&&$achou==0){$fabricante="NEOBUS";$achou=1;}
if(sizeof(explode("NIJU@",$fabricante1))==2&&$achou==0){$fabricante="NIJU";$achou=1;}
if(sizeof(explode("NISSAN@",$fabricante1))==2&&$achou==0){$fabricante="NISSAN";$achou=1;}
if(sizeof(explode("NOMA@",$fabricante1))==2&&$achou==0){$fabricante="NOMA";$achou=1;}
if(sizeof(explode("NORMAM@KOROVAN@",$fabricante1))==2&&$achou==0){$fabricante="NORMAM KOROVAN";$achou=1;}
if(sizeof(explode("OPEL@",$fabricante1))==2&&$achou==0){$fabricante="OPEL";$achou=1;}
if(sizeof(explode("ORCA@",$fabricante1))==2&&$achou==0){$fabricante="ORCA";$achou=1;}
if(sizeof(explode("OUTROS@",$fabricante1))==2&&$achou==0){$fabricante="OUTROS";$achou=1;}
if(sizeof(explode("PASTRE@",$fabricante1))==2&&$achou==0){$fabricante="PASTRE";$achou=1;}
if(sizeof(explode("PEUGEOT@",$fabricante1))==2&&$achou==0){$fabricante="PEUGEOT";$achou=1;}
if(sizeof(explode("PIAGGIO@",$fabricante1))==2&&$achou==0){$fabricante="PIAGGIO";$achou=1;}
if(sizeof(explode("PEGASSI@",$fabricante1))==2&&$achou==0){$fabricante="PEGASSI";$achou=1;}
if(sizeof(explode("PIT@SPORT@",$fabricante1))==2&&$achou==0){$fabricante="PIT SPORT";$achou=1;}
if(sizeof(explode("PLYMOUTH@",$fabricante1))==2&&$achou==0){$fabricante="PLYMOUTH";$achou=1;}
if(sizeof(explode("PONTIAC@",$fabricante1))==2&&$achou==0){$fabricante="PONTIAC";$achou=1;}
if(sizeof(explode("PORSCHE@",$fabricante1))==2&&$achou==0){$fabricante="PORSCHE";$achou=1;}
if(sizeof(explode("PUMA@",$fabricante1))==2&&$achou==0){$fabricante="PUMA";$achou=1;}
if(sizeof(explode("PUYUAN@",$fabricante1))==2&&$achou==0){$fabricante="PUYUAN";$achou=1;}
if(sizeof(explode("R-JOPASON@",$fabricante1))==2&&$achou==0){$fabricante="R-JOPASON";$achou=1;}
if(sizeof(explode("R/TEXAS@",$fabricante1))==2&&$achou==0){$fabricante="R/TEXAS";$achou=1;}
if(sizeof(explode("RANDON@",$fabricante1))==2&&$achou==0){$fabricante="RANDON";$achou=1;}
if(sizeof(explode("REBOX@",$fabricante1))==2&&$achou==0){$fabricante="REBOX";$achou=1;}
if(sizeof(explode("RECRUSUL@",$fabricante1))==2&&$achou==0){$fabricante="RECRUSUL";$achou=1;} 
if(sizeof(explode("REGAL@RAPTOR@",$fabricante1))==2&&$achou==0){$fabricante="REGAL RAPTOR";$achou=1;}
if(sizeof(explode("REK@",$fabricante1))==2&&$achou==0){$fabricante="REK";$achou=1;}
if(sizeof(explode("RELY@",$fabricante1))==2&&$achou==0){$fabricante="RELY";$achou=1;}
if(sizeof(explode("RENAULT@",$fabricante1))==2&&$achou==0){$fabricante="RENAULT";$achou=1;}
if(sizeof(explode("RIVAL@",$fabricante1))==2&&$achou==0){$fabricante="RIVAL";$achou=1;} 
if(sizeof(explode("RIGUETE@",$fabricante1))==2&&$achou==0){$fabricante="RIGUETE";$achou=1;}   
if(sizeof(explode("RODOFORT@",$fabricante1))==2&&$achou==0){$fabricante="RODOFORT";$achou=1;}
if(sizeof(explode("RODOLINEA@",$fabricante1))==2&&$achou==0){$fabricante="RODOLINEA";$achou=1;}
if(sizeof(explode("RODOTECNICA@",$fabricante1))==2&&$achou==0){$fabricante="RODOTECNICA";$achou=1;}
if(sizeof(explode("RODOTIC@",$fabricante1))==2&&$achou==0){$fabricante="RODOTIC";$achou=1;}
if(sizeof(explode("RODOTREM@",$fabricante1))==2&&$achou==0){$fabricante="RODOTREM";$achou=1;}
if(sizeof(explode("RODOVIARIA@",$fabricante1))==2&&$achou==0){$fabricante="RODOVIARIA";$achou=1;}
if(sizeof(explode("ROLLS@ROYCE@",$fabricante1))==2&&$achou==0){$fabricante="ROLLS ROYCE";$achou=1;}
if(sizeof(explode("ROLLS-ROYCE@",$fabricante1))==2&&$achou==0){$fabricante="ROLLS ROYCE";$achou=1;}
if(sizeof(explode("ROSIN@CARAVAN@",$fabricante1))==2&&$achou==0){$fabricante="ROSIN CARAVAN";$achou=1;}
if(sizeof(explode("ROSSETTI@",$fabricante1))==2&&$achou==0){$fabricante="ROSSETTI";$achou=1;}
if(sizeof(explode("ROVER@",$fabricante1))==2&&$achou==0){$fabricante="ROVER";$achou=1;}
if(sizeof(explode("RUSSO@",$fabricante1))==2&&$achou==0){$fabricante="RUSSO";$achou=1;}
if(sizeof(explode("SAAB@",$fabricante1))==2&&$achou==0){$fabricante="SAAB";$achou=1;}
if(sizeof(explode("SAIDECAR@",$fabricante1))==2&&$achou==0){$fabricante="SAIDECAR";$achou=1;}
if(sizeof(explode("SAN@MARINO@",$fabricante1))==2&&$achou==0){$fabricante="SAN MARINO";$achou=1;}
if(sizeof(explode("SANTIAGO@",$fabricante1))==2&&$achou==0){$fabricante="SANTIAGO";$achou=1;}
if(sizeof(explode("SANYANG@",$fabricante1))==2&&$achou==0){$fabricante="SANYANG";$achou=1;}
if(sizeof(explode("S�O@PEDRO@",$fabricante1))==2&&$achou==0){$fabricante="S�O PEDRO";$achou=1;}
if(sizeof(explode("SATURN@",$fabricante1))==2&&$achou==0){$fabricante="SATURN";$achou=1;}
if(sizeof(explode("SCANIA@",$fabricante1))==2&&$achou==0){$fabricante="SCANIA";$achou=1;}
if(sizeof(explode("SCHIFFER@",$fabricante1))==2&&$achou==0){$fabricante="SCHIFFER";$achou=1;}
if(sizeof(explode("SEAT@",$fabricante1))==2&&$achou==0){$fabricante="SEAT";$achou=1;}
if(sizeof(explode("SEMI@REBOQUE@",$fabricante1))==2&&$achou==0){$fabricante="SEMI REBOQUE";$achou=1;}
if(sizeof(explode("REBOQUE@",$fabricante1))==2&&$achou==0){$fabricante="REBOQUE";$achou=1;}
if(sizeof(explode("SERCOMEL@",$fabricante1))==2&&$achou==0){$fabricante="SERCOMEL";$achou=1;}
if(sizeof(explode("SIAMOTO@",$fabricante1))==2&&$achou==0){$fabricante="SIAMOTO";$achou=1;}
if(sizeof(explode("SINOTRUK@",$fabricante1))==2&&$achou==0){$fabricante="SINOTRUK";$achou=1;}
if(sizeof(explode("SMART@",$fabricante1))==2&&$achou==0){$fabricante="SMART";$achou=1;}
if(sizeof(explode("SHINERAY@",$fabricante1))==2&&$achou==0){$fabricante="SHINERAY";$achou=1;}
if(sizeof(explode("SSANG@",$fabricante1))==2&&$achou==0){$fabricante="SSANG";$achou=1;}
if(sizeof(explode("SSANGYONG@",$fabricante1))==2&&$achou==0){$fabricante="SSANGYONG";$achou=1;}
if(sizeof(explode("STUDEBAKER@",$fabricante1))==2&&$achou==0){$fabricante="STUDEBAKER";$achou=1;}
if(sizeof(explode("SUBARU@",$fabricante1))==2&&$achou==0){$fabricante="SUBARU";$achou=1;}
if(sizeof(explode("SUNDOWN@",$fabricante1))==2&&$achou==0){$fabricante="SUNDOWN";$achou=1;}
if(sizeof(explode("SUZUKI@",$fabricante1))==2&&$achou==0){$fabricante="SUZUKI";$achou=1;}
if(sizeof(explode("TAC@",$fabricante1))==2&&$achou==0){$fabricante="TAC";$achou=1;}
if(sizeof(explode("TARGOS@",$fabricante1))==2&&$achou==0){$fabricante="TARGOS";$achou=1;}
if(sizeof(explode("TECTRAN@",$fabricante1))==2&&$achou==0){$fabricante="TECTRAN";$achou=1;}
if(sizeof(explode("TEMA@TERRA@",$fabricante1))==2&&$achou==0){$fabricante="TEMA TERRA";$achou=1;}
if(sizeof(explode("TIGER@",$fabricante1))==2&&$achou==0){$fabricante="TIGER";$achou=1;}
if(sizeof(explode("THERMOSARA@",$fabricante1))==2&&$achou==0){$fabricante="THERMOSARA";$achou=1;}
if(sizeof(explode("TOYOTA@",$fabricante1))==2&&$achou==0){$fabricante="TOYOTA";$achou=1;}
if(sizeof(explode("TRAXX@",$fabricante1))==2&&$achou==0){$fabricante="TRAXX";$achou=1;}
if(sizeof(explode("TRAMONTINI@",$fabricante1))==2&&$achou==0){$fabricante="TRAMONTINI";$achou=1;}
if(sizeof(explode("TRIUMPH@",$fabricante1))==2&&$achou==0){$fabricante="TRIUMPH";$achou=1;}
if(sizeof(explode("TRIVELLATO@",$fabricante1))==2&&$achou==0){$fabricante="TRIVELLATO";$achou=1;}
if(sizeof(explode("TROLLER@",$fabricante1))==2&&$achou==0){$fabricante="TROLLER";$achou=1;}
if(sizeof(explode("TROMAR@",$fabricante1))==2&&$achou==0){$fabricante="TROMAR";$achou=1;}
if(sizeof(explode("TRUCK@MARINGA@",$fabricante1))==2&&$achou==0){$fabricante="TRUCK MARINGA";$achou=1;}
if(sizeof(explode("TURISCAR@",$fabricante1))==2&&$achou==0){$fabricante="TURISCAR";$achou=1;}
if(sizeof(explode("TUTTO@",$fabricante1))==2&&$achou==0){$fabricante="TUTTO";$achou=1;}
if(sizeof(explode("UNICAR@",$fabricante1))==2&&$achou==0){$fabricante="UNICAR";$achou=1;}
if(sizeof(explode("URAL@",$fabricante1))==2&&$achou==0){$fabricante="URAL";$achou=1;}
if(sizeof(explode("USICAMP@",$fabricante1))==2&&$achou==0){$fabricante="USICAMP";$achou=1;}
if(sizeof(explode("VALMET@",$fabricante1))==2&&$achou==0){$fabricante="VALMET";$achou=1;}
if(sizeof(explode("VENTO@",$fabricante1))==2&&$achou==0){$fabricante="VENTO";$achou=1;}
if(sizeof(explode("VILLARES@",$fabricante1))==2&&$achou==0){$fabricante="VILLARES";$achou=1;}
if(sizeof(explode("VOLARE@",$fabricante1))==2&&$achou==0){$fabricante="VOLARE";$achou=1;}
if(sizeof(explode("VOLKSWAGEN@",$fabricante1))==2&&$achou==0){$fabricante="VOLKSWAGEN";$achou=1;}
if(sizeof(explode("VOLVO@",$fabricante1))==2&&$achou==0){$fabricante="VOLVO";$achou=1;}
if(sizeof(explode("WALKBUS@",$fabricante1))==2&&$achou==0){$fabricante="WALKBUS";$achou=1;}
if(sizeof(explode("WAKE@WAY@",$fabricante1))==2&&$achou==0){$fabricante="WAKE WAY";$achou=1;}
if(sizeof(explode("WUYANG@WY@",$fabricante1))==2&&$achou==0){$fabricante="WUYANG WY";$achou=1;}
if(sizeof(explode("WILLIS@",$fabricante1))==2&&$achou==0){$fabricante="WILLIS";$achou=1;}
if(sizeof(explode("YAMAHA@",$fabricante1))==2&&$achou==0){$fabricante="YAMAHA";$achou=1;}
if(sizeof(explode("YAMAR@",$fabricante1))==2&&$achou==0){$fabricante="YAMAR";$achou=1;}
if(sizeof(explode("FOX@",$fabricante1))==2&&$achou==0){$fabricante="FOX";$achou=1;}
if(sizeof(explode("MAN@",$fabricante1))==2&&$achou==0){$fabricante="MAN";$achou=1;}   
$modelo = str_replace($fabricante,"",strtoupper($dados[1]));

  
				if(strlen($fabricante)>=2)
				{
					$sql1 = "INSERT INTO veiculo_alfa_atualizacao (codigo,fabricante,modelo) 
					VALUES (
					'".trim($dados[0])."',
					'".strtoupper(trim($fabricante))."',
					'".strtoupper(trim(strtr($modelo,$tiraAcentos)))."')";   
					$result2 = mysql_query($sql1,$db);  
					if ($result2)
					{
					$mensagem="<span class='style3'>Adicionado</span>";
					$cont++;
					}
				}
				else
				{
				$nao_add.=$dados[1]."#";  
				}
		
		if(strlen($fabricante)>=2)
		{

		}
}
$contador++;
}


?>
  <tr>
    <td height="50" colspan="4"><? echo "<center><h3>Quantidades total de Veiculos: $cont</h3></center>"; ?></td>
  </tr>
</table>
<br />

  <table width="98%" border="00" cellpadding="0" cellspacing="0">
      <tr>
      <td height="50" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Ve&iacute;culos com Fabricantes Desconhecidos</td>
    </tr>
    <tr>
      <td height="27" class="style12 style13">&nbsp;&nbsp;Informa&ccedil;&atilde;o do Ve&iacute;culo &nbsp;OBS: Este ve&iacute;culo n&atilde;o pode ser inserido por falta de informa&ccedil;&atilde;o de sua fabricante em nosso sistema</td>
    </tr>
    <?
	$inicio_nao_add=0;
	$dados_nao_add=explode("#",$nao_add);
    while($inicio_nao_add<=sizeof($dados_nao_add))
	{
		if(strlen($dados_nao_add[$inicio_nao_add])>=2)
		{
	?>
    <tr onmouseover="this.style.backgroundColor='#DBDBDB'" onmouseout="javascript:this.style.backgroundColor=''" >
      <td height="30" class="style14">&nbsp;&nbsp;<? echo $dados_nao_add[$inicio_nao_add];?></td>
    </tr>
  <?
  		}
	$inicio_nao_add++;
	}
	if($inicio_nao_add==0)
	{
	?>
    <tr onmouseover="this.style.backgroundColor='#DBDBDB'" onmouseout="javascript:this.style.backgroundColor=''" >
      <td height="30" class="style14">&nbsp;&nbsp;Todos fabricantes encontrados</td>
    </tr>
    <?
    }
	?>
    <tr>
      <td height="27" bgcolor="#E9E9E9">&nbsp;</td>
    </tr>
  </table>
<?

$obs="Quantidades de Registros Adicionados: ".$cont;
unlink($arquivo);
unlink($arquivoNovo);


####################### AJUSTANDO TABELA NOVA ####################### 
$sqlAtualiza1="ALTER TABLE webvist.veiculo_alfa_atualizacao ENGINE = InnoDB";
$resultAtualiza1 = mysql_query($sqlAtualiza1,$db); 

############################# RENOMEIA TABELA ATUAL ###################################

if(!(mysql_query("SELECT * FROM webvist.veiculo_alfa_".date('Ymd').""))) { 
	$sqlAtualiza4="RENAME TABLE webvist.veiculo_alfa TO webvist.veiculo_alfa_".date('Ymd');
	$resultAtualiza4 = mysql_query($sqlAtualiza4,$db); 
	}else{ 
		$sqlAtualiza2="DROP TABLE webvist.veiculo_alfa";
		$resultAtualiza2 = mysql_query($sqlAtualiza2,$db); 
		}


$sqlS3="SHOW TABLES FROM webvist WHERE tables_in_webvist LIKE 'veiculo_alfa_%'";
$resultS3 = mysql_query($sqlS3,$db);
   
if(mysql_num_rows($resultS3)>=5){
		// envia e-mail para avisar que tem mais de dois BAKCUPS da tabela
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "TABELAS DE BACKUP - veiculo_alfa_";
        $headers = "From: < aviso@viston-line.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Verificar tabelas de backup veiculo_alfa_<br>pois possui cinco ou mais tabelas de backup";
        mail( $to, $subject, $message, $headers );
	}

$sqlAtualiza3="RENAME TABLE webvist.veiculo_alfa_atualizacao TO webvist.veiculo_alfa ;";
$resultAtualiza3 = mysql_query($sqlAtualiza3,$db); 

##############################################################################################


} // FIM SE VALIDOU NOME 
else{
	
	$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".vistonline";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);

	if($fileType!='Excel2007'){
		$problemaIdentificado.='Tipo de arquivo Inválido<br>';
		}   
	if($conteudoRecebido!='Cd_veiculo;FMModelo'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}

		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}
	
##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","/atualizar_veiculo_alfa.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
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
