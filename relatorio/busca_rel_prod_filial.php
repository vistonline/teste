<?php
set_time_limit(false);
session_start();
include "../../adm/conecta.php";
include "../verifica.php";
include "Classes/PHPExcel.php";
include "Classes/PHPExcel/Reader/Excel2007.php";
include "Classes/PHPExcel/Writer/Excel2007.php";

function downloadFile( $fullPath ){ 

  // Must be fresh start 
  if( headers_sent() ) 
    die('Headers Sent'); 

  // Required for some browsers 
  if(ini_get('zlib.output_compression')) 
    ini_set('zlib.output_compression', 'Off'); 

  // File Exists? 
  if( file_exists($fullPath) ){ 
    
    // Parse Info / Get Extension 
    $fsize = filesize($fullPath); 
    $path_parts = pathinfo($fullPath); 
    $ext = strtolower($path_parts["extension"]); 
    
    // Determine Content Type 
    switch ($ext) { 
      case "pdf": $ctype="application/pdf"; break; 
      case "exe": $ctype="application/octet-stream"; break; 
      case "zip": $ctype="application/zip"; break; 
      case "doc": $ctype="application/msword"; break; 
      case "xls": $ctype="application/vnd.ms-excel"; break; 
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
      case "gif": $ctype="image/gif"; break; 
      case "png": $ctype="image/png"; break; 
      case "jpeg": 
      case "jpg": $ctype="image/jpg"; break; 
      default: $ctype="application/force-download"; 
    } 

    header("Pragma: public"); // required 
    header("Expires: 0"); 
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
    header("Cache-Control: private",false); // required for certain browsers 
    header("Content-Type: $ctype"); 
    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" ); 
    header("Content-Transfer-Encoding: binary"); 
    header("Content-Length: ".$fsize); 
    ob_clean(); 
    flush(); 
    readfile( $fullPath ); 

  } else 
    die('File Not Found'); 

} 

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("template/rel_prod_filial".$_SESSION[roteirizador].".xlsx");


$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de producao por Filial")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("relatorios VistOn-Line");


//Recebendo valores
$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};


$data1 = $_POST['data1']{0}.$_POST['data1']{1}."-".$_POST['data1']{3}.$_POST['data1']{4}."-".$_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9};
$data2 = $_POST['data2']{0}.$_POST['data2']{1}."-".$_POST['data2']{3}.$_POST['data2']{4}."-".$_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];


$FILIAL=explode("@",$_POST['filial']);

if($FILIAL[0]==''){$NOME_FILIAL="TODAS";}else{$NOME_FILIAL=$FILIAL[0];}


$sql2 = "SELECT COUNT(*) as total FROM ".$bancoDados.".vistoria_previa1 WHERE roteirizador=".$_SESSION['roteirizador']." AND DTVISTORIA>=".$data_inicio." AND DTVISTORIA <=".$data_fim." ".$FILIAL[1]."";
$result_sql2 = mysql_query($sql2,$db);
$resultado2 = mysql_fetch_assoc($result_sql2);


$base = 14;
$cont = 0;

########################################### CABEÇALHO ############################################
		$objPHPExcel->setActiveSheetIndex(0); 
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N10', $resultado2['total']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J10', $data1."  a  ".$data2);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E10', strtoupper(utf8_encode($NOME_FILIAL)));
##################################################################################################

$sql1 = "SELECT SEGURADORA, COUNT(SEGURADORA) as quantidade FROM ".$bancoDados.".vistoria_previa1 WHERE roteirizador=".$_SESSION[roteirizador]." AND DTVISTORIA>=".$data_inicio." AND DTVISTORIA <=".$data_fim." ".$FILIAL[1]." group by SEGURADORA order by quantidade desc";
$result_sql1 = mysql_query($sql1,$db);

while ($resultado = mysql_fetch_assoc($result_sql1))
  {
	
	switch($resultado["SEGURADORA"])
{
case "0":  $cliente_seguradora = "Bradesco Seguros"; break;
case "26":  $cliente_seguradora = "ZURICH GARANTIA"; break;
case "30": $cliente_seguradora = "ASSETRAC"; break;
case "31": $cliente_seguradora = "BUREAU DE BENEFICIOS"; break;
case "32": $cliente_seguradora = "ASSUTRAN"; break;
case "33": $cliente_seguradora = "AVANT"; break;
case "34": $cliente_seguradora = "ACAN"; break;
case "35": $cliente_seguradora = "ASSIST"; break;
case "36": $cliente_seguradora = "APROCAM BRASIL"; break;
case "37": $cliente_seguradora = "MAPFRE WARRANTY"; break;
case "38": $cliente_seguradora = "BB SEGUROS"; break;
case "39": $cliente_seguradora = "ZURICH SEGUROS"; break;
case "40": $cliente_seguradora = "ALFA SEGUROS"; break;
case "41": $cliente_seguradora = "AXA SEGUROS"; break;
case "42": $cliente_seguradora = "BANETES SEGUROS"; break;
case "43": $cliente_seguradora = "BRASIL VEIC.CIA SEG."; break;
case "44": $cliente_seguradora = "CAIXA SEGURADORA"; break;
case "45": $cliente_seguradora = "CARDIF DO BRASIL SEG."; break;
case "46": $cliente_seguradora = "CHUBB SEGURADORA"; break;
case "47": $cliente_seguradora = "MINAS BRASIL"; break;
case "48": $cliente_seguradora = "CIA DE SEG. A BAHIA"; break;
case "49": $cliente_seguradora = "CIA MUTUAL DE SEGUROS"; break;
case "50": $cliente_seguradora = "CONAPP"; break;
case "51": $cliente_seguradora = "CONFIANCA"; break;
case "53": $cliente_seguradora = "GENERALI SEGUROS"; break;
case "54": $cliente_seguradora = "GENTE SEGURADORA"; break;
case "55": $cliente_seguradora = "HDI SEGUROS"; break; 
case "56": $cliente_seguradora = "HSBC SEGUROS"; break;
case "57": $cliente_seguradora = "INDIANA SEGUROS"; break;
case "59": $cliente_seguradora = "LIBERTY SEGUROS"; break;
case "60": $cliente_seguradora = "MAPFRE SEGUROS"; break; 
case "61": $cliente_seguradora = "MARITIMA SEGUROS"; break;
case "62": $cliente_seguradora = "PORTO SEGURO"; break;
case "63": $cliente_seguradora = "REAL SEGUROS"; break;
case "64": $cliente_seguradora = "ROYAL & SUNALLIANCE"; break;
case "65": $cliente_seguradora = "SAFRA VIDA E PREV."; break;
case "67": $cliente_seguradora = "SUL AMERICA SEGUROS"; break;
case "69": $cliente_seguradora = "TOKIO MARINE"; break;
case "70": $cliente_seguradora = "UNIBANCO AIG SEG."; break;
case "71": $cliente_seguradora = "VERA CRUZ SEGUROS"; break;
case "72": $cliente_seguradora = "YASUDA SEGUROS"; break;
case "73": $cliente_seguradora = "ALLIANZ SEGUROS"; break;
case "74": $cliente_seguradora = "APROVSUL"; break;
case "75": $cliente_seguradora = "APTRANS"; break;
case "76": $cliente_seguradora = "CREDIPE"; break;
case "77": $cliente_seguradora = "APROVSUL VEICULOS"; break;
case "78": $cliente_seguradora = "APROVSUL CARGA"; break;
case "83": $cliente_seguradora = "MITSUI SEGUROS"; break;
case "85": $cliente_seguradora = "ITAU SEGUROS"; break;
case "86": $cliente_seguradora = "ASCARPE"; break;
case "87": $cliente_seguradora = "NOBRE SEGURADORA"; break;
case "88": $cliente_seguradora = "COMCARGA"; break;
case "89": $cliente_seguradora = "APROCAM"; break; 
case "95": $cliente_seguradora = "ASSOFINSP"; break;  
case "96": $cliente_seguradora = "APPA"; break;  
case "200": $cliente_seguradora = "HAWK"; break;
case "201": $cliente_seguradora = "ENGER"; break;
case "202": $cliente_seguradora = "NORDESTE"; break;
case "203": $cliente_seguradora = "GETEK"; break;
case "204": $cliente_seguradora = "TUV VISTORIAS"; break;
case "205": $cliente_seguradora = "SINTESE SEGUROS"; break;
case "314": $cliente_seguradora = "UNIPROPAS"; break;
case "319": $cliente_seguradora = "CAR SOLUCOES"; break;
case "320": $cliente_seguradora = "ASPEM"; break;
case "321": $cliente_seguradora = "ASPROL"; break;
case "322": $cliente_seguradora = "G&G SOLUCOES"; break;
case "323": $cliente_seguradora = "CONSORCIO PONTA"; break;
case "324": $cliente_seguradora = "AUTO TRUCK"; break;
case "325": $cliente_seguradora = "ABV"; break;
case "326": $cliente_seguradora = "QV SERVICOS"; break;
case "327": $cliente_seguradora = "PROTECT 24HS"; break;
case "328": $cliente_seguradora = "FINANCEIRA"; break;
case "329": $cliente_seguradora = "SANCOR"; break;
case "330": $cliente_seguradora = "ASTRO"; break;
case "331": $cliente_seguradora = "ASTRAMAR"; break;
case "332": $cliente_seguradora = "APROVESC"; break;
case "333": $cliente_seguradora = "UNIBEM"; break;
case "334": $cliente_seguradora = "COOPERTRUCK"; break;
case "335": $cliente_seguradora = "PROAUTO"; break;
case "336": $cliente_seguradora = "PERFECT"; break;
case "337": $cliente_seguradora = "MELHOR"; break;
case "338": $cliente_seguradora = "AMV BRASIL"; break;     
case "339": $cliente_seguradora = "MELHOR PESADOS"; break;
case "340": $cliente_seguradora = "ALICERCE"; break;
case "341": $cliente_seguradora = "AVANTI"; break;
case "342": $cliente_seguradora = "TOPPREV"; break;
case "343": $cliente_seguradora = "AGUARDA"; break;
case "344": $cliente_seguradora = "NACIONAL TRUCK"; break;
case "345": $cliente_seguradora = "EXPRESSO TRUCK"; break;
case "346": $cliente_seguradora = "BRASMIG"; break;
case "347": $cliente_seguradora = "ASTRANS"; break;
case "348": $cliente_seguradora = "APVS"; break;
case "349": $cliente_seguradora = "ASCAMP"; break;
case "350": $cliente_seguradora = "CLUBE FONFON"; break;
case "351": $cliente_seguradora = "BR TRUCK"; break;
case "353": $cliente_seguradora = "UNIVERSO ASSISTENCIA"; break;
case "354": $cliente_seguradora = "MAXIMA"; break;
case "355": $cliente_seguradora = "FOCUS"; break;
case "356": $cliente_seguradora = "LOTUS"; break;
case "357": $cliente_seguradora = "ALLIANCE APV"; break;
case "358": $cliente_seguradora = "VISTRIM"; break;
case "359": $cliente_seguradora = "AGV BRASIL"; break;
case "360": $cliente_seguradora = "ALIANÇA TRUCK CAR"; break;
case "361": $cliente_seguradora = "EUROCAR"; break;
case "362": $cliente_seguradora = "AMPLA"; break;
case "363": $cliente_seguradora = "ASCOBOM"; break;
case "364": $cliente_seguradora = "ASPROAUTO"; break;
case "365": $cliente_seguradora = "CAMBRALIA"; break;
case "366": $cliente_seguradora = "COPOM"; break;
case "367": $cliente_seguradora = "ASSOCIACAO DE AJUDA MUTUA A3"; break;
case "368": $cliente_seguradora = "MEGA BENEFICIOS"; break;
case "369": $cliente_seguradora = "UNIAUTO PROTECAO"; break;
case "370": $cliente_seguradora = "AUTO CARROS"; break;
case "371": $cliente_seguradora = "AUTOMINAS"; break;
case "372": $cliente_seguradora = "AVAP"; break;
case "373": $cliente_seguradora = "BRASIL COOPERATIVA"; break;
case "374": $cliente_seguradora = "CARVISA"; break;
case "375": $cliente_seguradora = "CENTRO SOCIAL CABOS SOLDADOS"; break;
case "376": $cliente_seguradora = "APVS ESPIRITO SANTO"; break;
case "377": $cliente_seguradora = "COOPEV"; break;
case "378": $cliente_seguradora = "COPA 190"; break;
case "379": $cliente_seguradora = "EFICAZ"; break;
case "380": $cliente_seguradora = "FACIL CLUBE DE BENEFICIOS"; break;
case "381": $cliente_seguradora = "GARANT CLUBE DE BENEFICIOS MUTUOS"; break;
case "382": $cliente_seguradora = "GENESIS BENEFICIOS"; break;
case "383": $cliente_seguradora = "LIDERANCA CLUBE DE ASSISTENCIA"; break;
case "384": $cliente_seguradora = "UNIPROV - ESPIRITO SANTO"; break;
case "385": $cliente_seguradora = "UNIPROV - RONDONIA"; break;
case "386": $cliente_seguradora = "MASTER CLUBE DE ASSISTENCIA VEICULAR"; break;
case "387": $cliente_seguradora = "MASTER TRUCK"; break;
case "388": $cliente_seguradora = "PLANCAR PRIME PROTECAO VEICULAR"; break;
case "389": $cliente_seguradora = "PRIME PROTECAO VEICULAR"; break;
case "390": $cliente_seguradora = "PROTEMINAS"; break;
case "391": $cliente_seguradora = "REDE CARS CLUBE DE BENEFICIOS"; break;
case "392": $cliente_seguradora = "SAVE-CAR"; break;
case "393": $cliente_seguradora = "UNIBRAS ASSOCIACAO DE AUTO PROTECAO"; break;
case "394": $cliente_seguradora = "UNIVERSO CLUBE DE ASSISTENCIA"; break;
case "395": $cliente_seguradora = "VISTOP SERVICOS TECNICOS"; break;
case "396": $cliente_seguradora = "EMBRACON"; break;
case "397": $cliente_seguradora = "NET CAR CLUBE"; break;
case "398": $cliente_seguradora = "MOTOCAR CLUBE"; break;
case "399": $cliente_seguradora = "EXCELENCIA"; break;
case "400": $cliente_seguradora = "APVS VISTA ALEGRE"; break;
case "401": $cliente_seguradora = "CAUTELAR"; break;
case "402": $cliente_seguradora = "EXCLUSIVE"; break;
case "403": $cliente_seguradora = "TRADICAO"; break;
case "404": $cliente_seguradora = "DIAMOND MOTORS"; break;
case "405": $cliente_seguradora = "CHERY MOTORS"; break;
case "406": $cliente_seguradora = "AVEP"; break;
case "407": $cliente_seguradora = "VIVA CONSORCIOS"; break;
case "408": $cliente_seguradora = "AUTOVALORE"; break;
case "409": $cliente_seguradora = "GFCAR"; break;
case "410": $cliente_seguradora = "PREVINE"; break;
case "411": $cliente_seguradora = "CLUBE SERVICE"; break;
case "412": $cliente_seguradora = "UNIBRA"; break;
case "413": $cliente_seguradora = "SOMA TRACK"; break;
case "100": $cliente_seguradora = "USEBENS"; break;
case "101": $cliente_seguradora = "QBE"; break;
case "102": $cliente_seguradora = "POINTER"; break;
case "103": $cliente_seguradora = "CIELO"; break;
case "414": $cliente_seguradora = "TIRADENTES"; break;
case "415": $cliente_seguradora = "PARTICULAR"; break;
case "416": $cliente_seguradora = "SOLTEL"; break;
case "417": $cliente_seguradora = "TOP CAR"; break;
case "418": $cliente_seguradora = "PROTEGIDO"; break;
case "419": $cliente_seguradora = "ULTRA BRASIL"; break;
case "420": $cliente_seguradora = "UNION SOLUTIONS"; break;
case "421": $cliente_seguradora = "MASTER CLUBE UBERLANDIA"; break;
case "422": $cliente_seguradora = "MUNDIAL"; break;
case "423": $cliente_seguradora = "SIMPLIFICAR"; break;
case "424": $cliente_seguradora = "CLEAN"; break;
case "425": $cliente_seguradora = "ALLLIDER"; break;
case "426": $cliente_seguradora = "APROTEVE"; break;
case "427": $cliente_seguradora = "E-NOVATE"; break;
case "428": $cliente_seguradora = "ASTRACO"; break;
case "429": $cliente_seguradora = "ROTA"; break;
case "430": $cliente_seguradora = "ULTRA"; break;
case "431": $cliente_seguradora = "UNICOON PARANA"; break;
case "432": $cliente_seguradora = "PROTEAUTO"; break;
case "433": $cliente_seguradora = "APVS SUDESTE"; break;
case "434": $cliente_seguradora = "CLUBE UNIR"; break;
case "435": $cliente_seguradora = "APM"; break;
case "436": $cliente_seguradora = "MASTER-CONSULTOR"; break;    
case "437": $cliente_seguradora = "HM PROTECAO"; break;
case "438": $cliente_seguradora = "CLUBCAR"; break;
case "439": $cliente_seguradora = "AZUL CLUBE"; break;
case "440": $cliente_seguradora = "GOL PLUS BRASIL"; break;
case "441": $cliente_seguradora = "ESTILO PROTECAO"; break;
case "442": $cliente_seguradora = "PHP PROTECAO"; break;
case "443": $cliente_seguradora = "ACERTT"; break;
case "444": $cliente_seguradora = "APVA"; break;
case "445": $cliente_seguradora = "ASTRAC"; break;
case "446": $cliente_seguradora = "SEGURYCAR"; break;  
case "447": $cliente_seguradora = "VITALLYS BRASIL"; break;
case "448": $cliente_seguradora = "BRASIL CAR"; break; 
case "449": $cliente_seguradora = "UNIDAS"; break;
case "450": $cliente_seguradora = "ELLO"; break; 
case "451": $cliente_seguradora = "UNICOON CONTAGEM"; break; 
case "452": $cliente_seguradora = "FOCAR BRASIL"; break;
case "453": $cliente_seguradora = "PLACAR VEICULAR"; break; 
case "454": $cliente_seguradora = "PROTECAR"; break; 
case "455": $cliente_seguradora = "UCA MELHOR"; break; 
case "456": $cliente_seguradora = "PROTEAUTO MARINGA"; break;
case "457": $cliente_seguradora = "AUTO VIP"; break;
case "458": $cliente_seguradora = "PRONTOCAR"; break;
case "459": $cliente_seguradora = "PENSAR CLUBE"; break;
case "460": $cliente_seguradora = "AUTO BAHIA"; break;
case "461": $cliente_seguradora = "MAXIMUS BRASIL"; break;
case "462": $cliente_seguradora = "PROTECT"; break;
default: $cliente_seguradora = $resultado["SEGURADORA"]; break;
}
	
		$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base + $cont, 1);
		$objPHPExcel->getActiveSheet(0)->mergeCells('B'. ($base + $cont).':'.'I'. ($base + $cont));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. ($base + $cont), strtoupper(utf8_encode($cliente_seguradora)));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. ($base + $cont), $resultado['quantidade']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. ($base + $cont), ($resultado['quantidade']/$resultado2['total']));
  
  $cont++;
	  
	  }

$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base + ($cont-1),1);


$nome=strtr($resultado3[nome_filial], array(" " => "-"));
// SAÍDA PARA ARQUIVO EXCEL
if(!isset($_GET['disabled']))
  {
	  
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/RELATORIO_PROD_FILIAL_".strtoupper($nome)."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/RELATORIO_PROD_FILIAL_".strtoupper($nome)."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/RELATORIO_PROD_FILIAL_".strtoupper($nome)."_".$periodo1.".xlsx");
  }
exit(0);
// FIM -----> SAÍDA PARA ARQUIVO EXCEL
?>
