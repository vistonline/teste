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
$objPHPExcel = $objReader->load("template/modelo_frustrada".$_SESSION['roteirizador'].".xlsx");  


$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Plan1"); 
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("Plan2");    
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setTitle("Plan3"); 
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setTitle("Plan4"); 
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setTitle("Plan5"); 
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setTitle("Plan6"); 
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->setTitle("Plan7"); 
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->setTitle("Plan8"); 
$objPHPExcel->setActiveSheetIndex(9);
$objPHPExcel->getActiveSheet()->setTitle("Plan9"); 
$objPHPExcel->setActiveSheetIndex(10);
$objPHPExcel->getActiveSheet()->setTitle("Plan10");  
$objPHPExcel->setActiveSheetIndex(11);
$objPHPExcel->getActiveSheet()->setTitle("Plan11"); 
$objPHPExcel->setActiveSheetIndex(12);
$objPHPExcel->getActiveSheet()->setTitle("Plan12"); 
$objPHPExcel->setActiveSheetIndex(13);
$objPHPExcel->getActiveSheet()->setTitle("Plan13"); 
$objPHPExcel->setActiveSheetIndex(14);
$objPHPExcel->getActiveSheet()->setTitle("Plan14"); 


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/modelo_frustradaNovo".$_SESSION['roteirizador'].".xlsx");

downloadFile( "relatoriosTemporarios/modelo_frustradaNovo".$_SESSION['roteirizador'].".xlsx" );

//unlink("relatoriosTemporarios/RELATORIO_FRUSTRADAS_".$empresa."_".$periodo1.".xlsx");


?>