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
$objPHPExcel = $objReader->load("template/rel_producaoUF.xlsx");


$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de producao por corretor")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("relatorios VistOn-Line");


//Recebendo valores

$data_inicio = substr($_POST['data1'],6,4).substr($_POST['data1'],3,2).substr($_POST['data1'],0,2);
$data_fim = substr($_POST['data2'],6,4).substr($_POST['data2'],3,2).substr($_POST['data2'],0,2);

$periodo=$_POST['data1']." - ".$_POST['data2'];

$base = 3;    
$cont = 1;       


$sql1 = "SELECT vp.UFVISTORIA, s.estado, s.id, vp.NMPROPONENTE,vp.NMFABRICANTE,vp.NMVEICULO,vp.NRPLACA,s.cidade,vp.DTVISTORIA,vp.pda FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".solicitacao s WHERE s.id = vp.NUMEROSOLICITACAO AND vp.roteirizador =".$_SESSION['roteirizador']." AND vp.UFVISTORIA='".$_POST['uf']."' AND vp.DTVISTORIA >=".$data_inicio." AND  vp.DTVISTORIA <=".$data_fim." OR s.id = vp.NUMEROSOLICITACAO AND vp.roteirizador =".$_SESSION['roteirizador']." AND vp.UFVISTORIA='' AND s.estado='".$_POST['uf']."' AND vp.DTVISTORIA >=".$data_inicio." AND  vp.DTVISTORIA <=".$data_fim." ORDER BY vp.DTVISTORIA";
$result_sql1 = mysql_query($sql1,$db);

while ($resultado = mysql_fetch_assoc($result_sql1))
  {

$dataVistoria=substr($resultado['DTVISTORIA'],6,2)."/".substr($resultado['DTVISTORIA'],4,2)."/".substr($resultado['DTVISTORIA'],0,4);

if($resultado['pda']==1){
	$vistMovile='SIM';
	}else{
		$vistMovile='NAO';
		}

if($resultado['UFVISTORIA']!=''){
	$uf=$resultado['UFVISTORIA'];
	}else{
		$uf=$resultado['estado'];
		}
			
		//$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore(($base + $cont) , 1);					  
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. ($base + $cont), $cont);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. ($base + $cont), $resultado['id']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. ($base + $cont), strtoupper(utf8_encode($resultado['NMPROPONENTE'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. ($base + $cont), strtoupper(utf8_encode($resultado['NMFABRICANTE']." - ".$resultado['NMVEICULO'])));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. ($base + $cont), strtoupper($resultado['NRPLACA']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. ($base + $cont), strtoupper(utf8_encode($resultado['cidade'])));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. ($base + $cont), $uf);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. ($base + $cont), $dataVistoria);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. ($base + $cont), $vistMovile);

        $cont++;
		
	  }
	
//$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
//$objPHPExcel->setActiveSheetIndex(0)->removeRow($base + ($cont-1),1);

// SAÍDA PARA ARQUIVO EXCEL
if(!isset($_GET['disabled']))
  {              
	  
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/RELATORIO_PROD_UF_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/RELATORIO_PROD_UF_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/RELATORIO_PROD_UF_".$periodo1.".xlsx");
  }
       
  
exit(0);
// FIM -----> SAÍDA PARA ARQUIVO EXCEL
?>
