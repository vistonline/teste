<?
set_time_limit(false);
session_start();
if(include "../../../adm/conecta.php"){
	}elseif(include "../../adm/conecta.php"){
		}elseif(include "../adm/conecta.php"){
			}elseif(include "adm/conecta.php"){
				}
include "../../verifica.php";
include "../Classes/PHPExcel.php";
include "../Classes/PHPExcel/Reader/Excel2007.php";
include "../Classes/PHPExcel/Writer/Excel2007.php";

$data_inicio = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};
$data_fim = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


if($_SESSION['id']==1){
	// echo $_POST['usuario'];
	
	//echo "<br>pediu para parar, parou!";
	//exit();
	}
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
$objPHPExcel = $objReader->load("../template/rel_preLaudo.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relacao de pre laudo")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");
							 
//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$periodo = "Período (".$_POST['DATA_INICIAL'] . ' - ' . $_POST['DATA_FINAL'].")";

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $periodo);

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 5;
$cont0 = 0;

$usuario="";
if($_POST['usuario']!=''){
	$usuario= " AND u.id=".$_POST['usuario']." ";
	}

if($usuario==''){
$sql1 = "SELECT pre.*,u.nome FROM ".$bancoDados.".preCadastroVistoria pre, ".$bancoDados.".user u WHERE pre.usuario=u.id AND pre.dataCadastro>=".$data_inicio." AND pre.dataCadastro<=".$data_fim.$usuario." UNION
SELECT * , usuario AS nome FROM webvist_70.preCadastroVistoria WHERE usuario=0 AND dataCadastro >=".$data_inicio." AND dataCadastro <=".$data_fim;
}else{
$sql1 = "SELECT pre.*,u.nome FROM ".$bancoDados.".preCadastroVistoria pre, ".$bancoDados.".user u WHERE pre.usuario=u.id AND pre.dataCadastro>=".$data_inicio." AND pre.dataCadastro<=".$data_fim.$usuario; 
}
$result_sql1 = mysql_query($sql1,$db);

while ($array = @mysql_fetch_array($result_sql1)){

//verifica filial
$sql_filial = "SELECT nome_filial FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial=".$array['filial']." ";
$result_sql_filial = mysql_query($sql_filial ,$db);
$result_filial = @mysql_fetch_array($result_sql_filial);

$dataVistoria = substr($array['dataVistoria'],6,2)."/".substr($array['dataVistoria'],4,2)."/".substr($array['dataVistoria'],0,4);	
$dataCadastro = substr($array['dataCadastro'],6,2)."/".substr($array['dataCadastro'],4,2)."/".substr($array['dataCadastro'],0,4);
$horaCadastro = substr($array['horaCadastro'],0,2).":".substr($array['horaCadastro'],2,2).":".substr($array['horaCadastro'],4,2);

switch($array['seguradora'])
		{
		   case "0":  $nomeSeguradora='Bradesco Seguros';break;
		   case "20": $nomeSeguradora='BONE';break; 
		   case "21": $nomeSeguradora='MULTCAR';break; 
		   case "22": $nomeSeguradora='RODOTRUCK';break; 
		   case "23": $nomeSeguradora='ACE';break;
		   case "24": $nomeSeguradora='VERTICE';break;
		   case "25": $nomeSeguradora='TRUST';break;
		   case "26": $nomeSeguradora='ZURICH GARANTIA';break;
		   case "30": $nomeSeguradora='ASSETRAC';break;       
		   case "31": $nomeSeguradora='BUREAU DE BENEFICIOS';break;
		   case "32": $nomeSeguradora='ASSUTRAN';break;
		   case "33": $nomeSeguradora='AVANT';break;
		   case "34": $nomeSeguradora='ACAN';break;
		   case "35": $nomeSeguradora='ASSIST';break;
		   case "36": $nomeSeguradora='APROCAM BRASIL';break;
		   case "37": $nomeSeguradora='MAPFRE WARRANTY';break;
		   case "38": $nomeSeguradora='BB SEGUROS';break;
		   case "39": $nomeSeguradora='ZURICH';break;
		   case "40": $nomeSeguradora='ALFA SEGUROS';break;            
		   case "41": $nomeSeguradora='AXA SEGUROS';break;
		   case "42": $nomeSeguradora='BANETES SEGUROS';break;  
		   case "43": $nomeSeguradora='BRASIL VEIC.CIA SEG.';break;       
		   case "44": $nomeSeguradora='CAIXA SEGURADORA';break;  
		   case "45": $nomeSeguradora='CARDIF DO BRASIL SEG.';break;   
		   case "46": $nomeSeguradora='CHUBB';break;     
		   case "47": $nomeSeguradora='MINAS BRASIL';break;       
		   case "48": $nomeSeguradora='CIA DE SEG. A BAHIA';break;   
		   case "49": $nomeSeguradora='CIA MUTUAL DE SEGUROS';break; 
		   case "50": $nomeSeguradora='CONAPP';break; 
		   case "51": $nomeSeguradora='CONFIANCA';break;
		   case "53": $nomeSeguradora='GENERALI';break; 
		   case "54": $nomeSeguradora='GENTE SEGURADORA';break;
		   case "55": $nomeSeguradora='HDI';break;
		   case "56": $nomeSeguradora='HSBC SEGUROS';break;
		   case "57": $nomeSeguradora='INDIANA SEGUROS';break;
		   case "59": $nomeSeguradora='LIBERTY';break;
		   case "60": $nomeSeguradora='MAPFRE SEGUROS';break;
		   case "61": $nomeSeguradora='MARITIMA';break;
		   case "62": $nomeSeguradora='PORTO SEGURO';break;
		   case "63": $nomeSeguradora='REAL SEGUROS';break; 
		   case "64": $nomeSeguradora='ROYAL & SUNALLIANCE';break;
		   case "65": $nomeSeguradora='SAFRA VIDA E PREV.';break;
		   case "67": $nomeSeguradora='SUL AMERICA';break;
		   case "69": $nomeSeguradora='TOKIO MARINE';break;
		   case "70": $nomeSeguradora='UNIBANCO AIG SEG.';break;
		   case "71": $nomeSeguradora='VERA CRUZ';break;
		   case "72": $nomeSeguradora='YASUDA SEGUROS';break;
		   case "73": $nomeSeguradora='ALLIANZ';break;
		   case "74": $nomeSeguradora='APROVSUL';break;        
		   case "75": $nomeSeguradora='APTRANS';break;         
		   case "76": $nomeSeguradora='CREDIPE';break;
		   case "83": $nomeSeguradora='MITSUI';break;
		   case "85": $nomeSeguradora='ITAU SEGUROS';break;
		   case "86": $nomeSeguradora='ASCARPE';break;
		   case "87": $nomeSeguradora='NOBRE';break;
		   case "200": $nomeSeguradora='HAWK';break;
		   case "201": $nomeSeguradora='ENGER';break;
		   case "202": $nomeSeguradora='NORDESTE';break;
		   case "203": $nomeSeguradora='GETEK';break;
		   case "204": $nomeSeguradora='TUV VISTORIAS';break;
		   case "205": $nomeSeguradora='SINTESE SEGUROS';break;
		   case "314": $nomeSeguradora='UNIPROPAS';break;
		   case "319": $nomeSeguradora='CAR SOLUCOES';break;
		   case "320": $nomeSeguradora='ASPEM';break;
		   case "321": $nomeSeguradora='ASPROL';break;
		   case "322": $nomeSeguradora='G&G SOLUCOES';break;
		   case "323": $nomeSeguradora='CONSORCIO PONTA';break;
		   case "324": $nomeSeguradora='AUTO TRUCK';break;
		   case "325": $nomeSeguradora='ABV';break;
		   case "326": $nomeSeguradora='QV SERVICOS';break;
		   case "327": $nomeSeguradora='PROTECT 24HS';break;
		   case "328": $nomeSeguradora='FINANCEIRA';break;
		   case "329": $nomeSeguradora='SANCOR';break;
		   case "330": $nomeSeguradora='ASTRO';break;
		   case "331": $nomeSeguradora='ASTRAMAR';break;
		   case "332": $nomeSeguradora='APROVESC';break;
		   case "333": $nomeSeguradora='UNIBEM';break;
		   case "334": $nomeSeguradora='COOPERTRUCK';break;
		   case "335": $nomeSeguradora='PROAUTO';break;
		   case "336": $nomeSeguradora='PERFECT';break;
		   case "337": $nomeSeguradora='MELHOR';break;
		   case "338": $nomeSeguradora='AMV BRASIL';break;     
		   case "339": $nomeSeguradora='MELHOR PESADOS';break;
		   case "340": $nomeSeguradora='ALICERCE';break;
		   case "341": $nomeSeguradora='AVANTI';break;
		   case "342": $nomeSeguradora='TOPPREV';break;
		   case "343": $nomeSeguradora='AGUARDA';break;
		   case "344": $nomeSeguradora='NACIONAL TRUCK';break;
			case "345": $nomeSeguradora='EXPRESSO TRUCK';break;
			case "346": $nomeSeguradora='BRASMIG';break;
			case "347": $nomeSeguradora='ASTRANS';break;
			case "348": $nomeSeguradora='APVS';break;
			case "349": $nomeSeguradora='ASCAMP';break;
			case "350": $nomeSeguradora='CLUBE FONFON';break;
			case "351": $nomeSeguradora='BR TRUCK';break;
			case "353": $nomeSeguradora='UNIVERSO ASSISTENCIA';break;
			case "354": $nomeSeguradora='MAXIMA';break;
			case "355": $nomeSeguradora='FOCUS';break;
			case "356": $nomeSeguradora='LOTUS';break;
			case "357": $nomeSeguradora='ALLIANCE APV';break;
			case "358": $nomeSeguradora='VISTRIM';break;
			case "359": $nomeSeguradora='AGV BRASIL';break;
			case "360": $nomeSeguradora='ALIANÇA TRUCK CAR';break;
			case "361": $nomeSeguradora='EUROCAR';break;
			case "362": $nomeSeguradora='AMPLA';break;
			case "363": $nomeSeguradora='ASCOBOM';break;
			case "364": $nomeSeguradora='ASPROAUTO';break;
			case "365": $nomeSeguradora='CAMBRALIA';break;
			case "366": $nomeSeguradora='COPOM';break;
			case "367": $nomeSeguradora='ASSOCIACAO DE AJUDA MUTUA A3';break;
			case "368": $nomeSeguradora='MEGA BENEFICIOS';break;
			case "369": $nomeSeguradora='UNIAUTO PROTECAO';break;
			case "370": $nomeSeguradora='AUTO CARROS';break;
			case "371": $nomeSeguradora='AUTOMINAS';break;
			case "372": $nomeSeguradora='AVAP';break;
			case "373": $nomeSeguradora='BRASIL COOPERATIVA';break;
			case "374": $nomeSeguradora='CARVISA';break;
			case "375": $nomeSeguradora='CENTRO SOCIAL CABOS SOLDADOS';break;
			case "376": $nomeSeguradora='APVS ESPIRITO SANTO';break;
			case "377": $nomeSeguradora='COOPEV';break;
			case "378": $nomeSeguradora='COPA 190';break;
			case "379": $nomeSeguradora='EFICAZ';break;
			case "380": $nomeSeguradora='FACIL CLUBE DE BENEFICIOS';break;
			case "381": $nomeSeguradora='GARANT CLUBE DE BENEFICIOS MUTUOS';break;
			case "382": $nomeSeguradora='GENESIS BENEFICIOS';break;
			case "383": $nomeSeguradora='LIDERANCA CLUBE DE ASSISTENCIA';break;
			case "384": $nomeSeguradora='UNIPROV - ESPIRITO SANTO';break;
			case "385": $nomeSeguradora='UNIPROV - RONDONIA';break;
			case "386": $nomeSeguradora='MASTER CLUBE DE ASSISTENCIA VEICULAR';break;
			case "387": $nomeSeguradora='MASTER TRUCK';break;
			case "388": $nomeSeguradora='PLANCAR PRIME PROTECAO VEICULAR';break;
			case "389": $nomeSeguradora='PRIME PROTECAO VEICULAR';break;
			case "390": $nomeSeguradora='PROTEMINAS';break;
			case "391": $nomeSeguradora='REDE CARS CLUBE DE BENEFICIOS';break;
			case "392": $nomeSeguradora='SAVE-CAR';break;
			case "393": $nomeSeguradora='UNIBRAS ASSOCIACAO DE AUTO PROTECAO';break;
			case "394": $nomeSeguradora='UNIVERSO CLUBE DE ASSISTENCIA';break;
			case "395": $nomeSeguradora='VISTOP SERVICOS TECNICOS';break;
			case "396": $nomeSeguradora='EMBRACON';break;
			case "397": $nomeSeguradora='NET CAR CLUBE';break;
			case "398": $nomeSeguradora='MOTOCAR CLUBE';break;
			case "399": $nomeSeguradora='EXCELENCIA';break;
			case "400": $nomeSeguradora='APVS VISTA ALEGRE';break;
			case "401": $nomeSeguradora='CAUTELAR';break;
			case "402": $nomeSeguradora='EXCLUSIVE';break;
			case "403": $nomeSeguradora='TRADICAO';break;
			case "404": $nomeSeguradora='DIAMOND MOTORS';break;
			case "405": $nomeSeguradora='CHERY MOTORS';break;
			case "406": $nomeSeguradora='AVEP';break;
			case "407": $nomeSeguradora='VIVA CONSORCIOS';break;
			case "408": $nomeSeguradora='AUTOVALORE';break;
			case "409": $nomeSeguradora='GFCAR';break;
			case "410": $nomeSeguradora='PREVINE';break;
			case "411": $nomeSeguradora='CLUBE SERVICE';break;
			case "412": $nomeSeguradora='UNIBRA';break;
			case "413": $nomeSeguradora='SOMA TRACK';break;
			case "100": $nomeSeguradora='USEBENS';break;
			case "101": $nomeSeguradora='QBE';break;
			case "102": $nomeSeguradora='POINTER';break;
			case "103": $nomeSeguradora='CIELO';break;
			case "414": $nomeSeguradora='TIRADENTES';break;
			case "415": $nomeSeguradora='PARTICULAR';break;
			case "416": $nomeSeguradora='SOLTEL';break;
			case "417": $nomeSeguradora='TOP CAR';break;
			case "418": $nomeSeguradora='PROTEGIDO';break;
			case "419": $nomeSeguradora='ULTRA BRASIL';break;
			case "420": $nomeSeguradora='UNION SOLUTIONS';break;
			case "421": $nomeSeguradora='MASTER CLUBE UBERLANDIA';break;
			case "422": $nomeSeguradora='MUNDIAL';break;
			case "423": $nomeSeguradora='SIMPLIFICAR';break;
			case "424": $nomeSeguradora='CLEAN';break;
			case "425": $nomeSeguradora='ALLIDER';break;
			case "426": $nomeSeguradora='APROTEVE';break;
			case "427": $nomeSeguradora='E-NOVATE';break;
			case "428": $nomeSeguradora='ASTRACO';break;
			case "429": $nomeSeguradora='ROTA';break;
			case "430": $nomeSeguradora='ULTRA';break;
			case "431": $nomeSeguradora='UNICOON PARANA';break;
			case "432": $nomeSeguradora='PROTEAUTO';break;
			case "433": $nomeSeguradora='APVS SUDESTE';break;
			case "434": $nomeSeguradora='CLUBE UNIR';break;
			case "435": $nomeSeguradora='APM';break;
			case "436": $nomeSeguradora='MASTER-CONSULTOR';break;
			case "437": $nomeSeguradora='HM PROTECAO';break;
			case "438": $nomeSeguradora='CLUBCAR';break;
		    case "439": $nomeSeguradora='AZUL CLUBE';break;
			case "440": $nomeSeguradora='GOL PLUS BRASIL';break;
			case "441": $nomeSeguradora='ESTILO PROTECAO';break;
			case "442": $nomeSeguradora='PHP PROTECAO';break;
			case "443": $nomeSeguradora='ACERTT';break;
			case "444": $nomeSeguradora='APVA';break;
			case "445": $nomeSeguradora='ASTRAC';break;
			case "446": $nomeSeguradora='SEGURYCAR';break;
			case "447": $nomeSeguradora='VITALLYS BRASIL';break;
			case "448": $nomeSeguradora='BRASIL CAR';break;
			case "449": $nomeSeguradora='UNIDAS';break;
			case "450": $nomeSeguradora='ELLO';break;
			case "451": $nomeSeguradora='UNICOON CONTAGEM';break;
			case "452": $nomeSeguradora='FOCAR BRASIL';break;
			case "453": $nomeSeguradora='PLACAR VEICULAR';break;
			case "454": $nomeSeguradora='PROTECAR';break;
			case "455": $nomeSeguradora='UCA MELHOR';break;
			case "456": $nomeSeguradora='PROTEAUTO MARINGA';break;
			case "457": $nomeSeguradora='AUTO VIP';break;
			case "458": $nomeSeguradora='PRONTOCAR';break;
			case "459": $nomeSeguradora='PENSAR CLUBE';break;
			case "460": $nomeSeguradora='AUTO BAHIA';break;
			case "461": $nomeSeguradora='MAXIMUS BRASIL';break;
			case "462": $nomeSeguradora='PROTECT';break;
				default: $nomeSeguradora=$array['seguradora']; break;
	   	}
		
		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
                                  "B" => strtoupper($nomeSeguradora), 
								  "C" => $array['nrVistoria'],
								  "D" => $array['nrSolicitacao'],
                                  "E" => $dataVistoria,
                                  "F" => strtoupper($array['placa']),
                                  "G" => strtoupper(utf8_encode($array['cidade'])),
								  "H" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "I" => $dataCadastro,
								  "J" => $horaCadastro,
								  "K" => strtoupper($array['nome'])
                               ));

        $cont0++;

	}
	
  $objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont0-1);
 
foreach ($vetor0 as $key => $value){

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. ($base + $key), $value[$key]['I']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'. ($base + $key), $value[$key]['O']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'. ($base + $key), $value[$key]['P']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'. ($base + $key), $value[$key]['Q']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'. ($base + $key), $value[$key]['R']);
		  }

		  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);

switch($_SESSION['roteirizador']){
	case 0: $empresa='BS2'; $nome_empresa='BS2 Consultoria '; break;
	case 20: $empresa='ACONFERIR'; $nome_empresa='ACONFERIR'; break;
	case 60: $empresa='EXCEL'; $nome_empresa='EXCEL'; break;
	case 70: $empresa='JEF'; $nome_empresa='JEF VISTORIAS'; break;
	case 75: $empresa='VISION'; $nome_empresa='VISION VISTORIAS'; break;
	case 80: $empresa='OK'; $nome_empresa='OK VISTORIAS'; break;
	case 90: $empresa='REALIZA'; $nome_empresa='REALIZA VISTORIAS'; break;
	case 100: $empresa='VS'; $nome_empresa='VS VISTORIAS'; break;
	case 110: $empresa='PREVICAR'; $nome_empresa='PREVICAR VISTORIAS'; break;
	case 140: $empresa='ETH'; $nome_empresa='ETH VISTORIAS'; break;
	case 150: $empresa='CENTRAL'; $nome_empresa='CENTRAL VISTORIAS'; break;
	case 160: $empresa='MINASROTA'; $nome_empresa='MINAS ROTA VISTORIAS'; break;
	case 170: $empresa='BRAGA'; $nome_empresa='BRAGA VISTORIAS'; break;
	case 627: $empresa='3VIA'; $nome_empresa='3ª Via'; break;
	case 1786: $empresa='STYLLUS'; $nome_empresa='Styllus Vistorias';break;
	default: $empresa='AREA-TI'; break;
	}

 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("../relatoriosTemporarios/preLaudo_".$empresa."_".$periodo1.".xlsx");

downloadFile( "../relatoriosTemporarios/preLaudo_".$empresa."_".$periodo1.".xlsx" );

unlink("../relatoriosTemporarios/preLaudo_".$empresa."_".$periodo1.".xlsx");

###############################################################################

exit(0);
?>