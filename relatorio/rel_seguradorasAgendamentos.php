<?
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
$objPHPExcel = $objReader->load("template/seguradorasAgendamentos.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Agendamentos")
							 ->setDescription("Documento gerado pelo sistema VistOnLine")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");


switch ($_SESSION[roteirizador]){
	case 0 : $prestadora = "BS2 CONSULTORIA"; break;
	case 20 : $prestadora = "ACONFERIR"; break;
	case 60 : $prestadora = "EXCEL"; break;
	case 70 : $prestadora = "JEF VISTORIAS"; break;
	case 75 : $prestadora = "VISION"; break;
	case 80 : $prestadora = "OK VISTORIAS"; break;
	case 90 : $prestadora = "REALIZA"; break;
	case 100 : $prestadora = "VS VISTORIAS"; break;
	case 110 : $prestadora = "PREVICAR VISTORIAS"; break;
	case 140 : $prestadora = "ETH VISTORIAS"; break;
	case 150 : $prestadora = "CENTRAL VISTORIAS"; break;
	case 160 : $prestadora = "MINAS ROTA VISTORIAS"; break;
	case 170 : $prestadora = "BRAGA VISTORIAS"; break;
	case 180 : $prestadora = "VIP VISTORIAS"; break;
	case 627 : $prestadora = "3ª VIA WEB"; break;
	case 1786 : $prestadora = "STYLLUS VISTORIAS"; break;
	case 123 : $prestadora = "AMBIENTE DE TESTE"; break;
	default: break;
	}
	
//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];



/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 5;   
$cont0 = 0; 

$condicao="";
if($_POST['tipo']=='frustradas'){
	$condicao=" AND checado=2 ";
	
	}elseif($_POST['tipo']=='realizadas'){
		$condicao=" AND status_laudo=1 ";
		
		}elseif($_POST['tipo']=='pendentes'){
			$condicao=" AND status_laudo=0 AND checado=0 ";
			
			}

include '../seguradora_nome.php';   
	
$sql1 = "SELECT * FROM ".$bancoDados.".solicitacao WHERE 
	cliente = '".$cliente_seguradora."' AND dia >=".$data_inicio." AND dia <=".$data_fim." AND roteirizador = ".$_SESSION['roteirizador']." ".$condicao." ORDER BY dia ASC";
$result_sql1 = mysql_query($sql1,$db);

while ($array = @mysql_fetch_array($result_sql1)){


if($array['checado']==2){
	$status="Frustrada";
	}elseif($array['status_laudo']==1){    
		$status="Realizada";
		}else{
			$status="Pendente";
			}

$data = substr($array['dia'],6,2)."/".substr($array['dia'],4,2)."/".substr($array['dia'],0,4);

/*$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array[controle_prest].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);*/

		$vetor0[] = Array($cont0 => Array(
								  "A" => $cont0+1,
                                  "B" => $cliente_seguradora,
								  "C" => strtoupper($array['estado']),
								  "D" => $array['id'],
                                  "E" => strtoupper(utf8_encode($array['nome_c'])), 
								  "F" => strtoupper(utf8_encode($array['cidade'])),
								  "G" => strtoupper($array['placa']),
								  "H" => $data,
								  "I" => $status

		                                ));

        $cont0++;

	}

$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont0-1);
  
foreach ($vetor0 as $key => $value){ 
$objPHPExcel->getActiveSheet()->setCellValue('A'. ($base + $key), $value[$key]['A']); 
$objPHPExcel->getActiveSheet()->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->getActiveSheet()->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->getActiveSheet()->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->getActiveSheet()->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->getActiveSheet()->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->getActiveSheet()->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->getActiveSheet()->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->getActiveSheet()->setCellValue('I'. ($base + $key), $value[$key]['I']);

		  }

 	  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);


switch ($_SESSION[roteirizador]){
	case 0 : $empresa = "BS2Consultoria"; break;
	case 20 : $empresa = "ACONFERIR"; break;
	case 60 : $empresa = "EXCEL"; break;
	case 70 : $empresa = "JEF"; break;
	case 75 : $empresa = "VISION"; break;
	case 80 : $empresa = "OK VISTORIAS"; break;
	case 90 : $empresa = "REALIZA VISTORIAS"; break;
	case 100 : $empresa = "VS VISTORIAS"; break;
	case 110 : $empresa = "PREVICAR VISTORIAS"; break;
	case 140 : $empresa = "ETH VISTORIAS"; break;
	case 150 : $empresa = "CENTRAL VISTORIAS"; break;
	case 160 : $empresa = "MINAS ROTA VISTORIAS"; break;
	case 170 : $empresa = "BRAGA VISTORIAS"; break;
	case 180 : $empresa = "VIP VISTORIAS"; break;
	case 627 : $empresa = "3Viaweb"; break;
	case 1786 : $empresa = "StyllusVistorias"; break;
	case 123 : $empresa = "AmbienteDeTeste"; break;
	default: break;
	}
 
mkdir('atualizacoesTemp/', 0777);
chmod('atualizacoesTemp/', 0777);
mkdir('atualizacoesTemp/'.$_SESSION['roteirizador'], 0777);
chmod('atualizacoesTemp/'.$_SESSION['roteirizador'], 0777); 
 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("atualizacoesTemp/".$_SESSION['roteirizador']."/listaAgenda_".$empresa."_".$periodo1.".xlsx");

downloadFile( "atualizacoesTemp/".$_SESSION['roteirizador']."/listaAgenda_".$empresa."_".$periodo1.".xlsx" );

unlink("atualizacoesTemp/".$_SESSION['roteirizador']."/listaAgenda_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>