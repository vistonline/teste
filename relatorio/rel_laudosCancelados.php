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
$objPHPExcel = $objReader->load("template/laudosCancelados.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Laudos Cancelados")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");

include "nomePrestadoraRel.php";


$sql = "SELECT nome FROM ".$bancoDados.".user WHERE id =".$_POST['vistoriador'];
$result_sql = mysql_query($sql,$db);
$resultado = @mysql_fetch_array($result_sql);
$vistoriador = strtoupper($resultado['nome']); 
	
//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $vistoriador);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', date('d/m/Y'));

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 9;
$cont0 = 0; 

$sql1 = "SELECT * FROM ".$bancoDados.".controleLaudosCancelados WHERE controle_prest=".$_POST['vistoriador']." AND nr_laudo>=".$_POST['nr_inicio']." AND nr_laudo<=".$_POST['nr_fim'];
$result_sql1 = mysql_query($sql1,$db);
     	
while ($array = @mysql_fetch_assoc($result_sql1)){
	      
$data=$array['data']{6}.$array['data']{7}."/".$array['data']{4}.$array['data']{5}."/".$array['data']{0}.$array['data']{1}.$array['data']{2}.$array['data']{3};

$sql_prest = "SELECT nome FROM ".$bancoDados.".user WHERE id = ".$array['controle_digitador'].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
								  "B" => $array['nr_laudo'],
								  "C" => $data,
                                  "D" => strtoupper($prest['nome']), 
								  "E" => strtoupper($array['obs'])
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
		  }

 	  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);


 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
// CRIANDO ARVORE DE PASTAS
@mkdir('relatoriosTemporarios/', 0777);
@chmod('relatoriosTemporarios/', 0777);
@mkdir('relatoriosTemporarios/'.$_SESSION['roteirizador'], 0777);
@chmod('relatoriosTemporarios/'.$_SESSION['roteirizador'], 0777);
$objWriter->save("relatoriosTemporarios/".$_SESSION['roteirizador']."/LaudosCancelados_".$vistoriador.".xlsx");

downloadFile( "relatoriosTemporarios/".$_SESSION['roteirizador']."/LaudosCancelados_".$vistoriador.".xlsx" );

unlink("relatoriosTemporarios/".$_SESSION['roteirizador']."/LaudosCancelados_".$vistoriador.".xlsx");

mysql_close();
exit(0);
?>