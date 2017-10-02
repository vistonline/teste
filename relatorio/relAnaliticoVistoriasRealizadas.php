<?
set_time_limit(false);
@session_start();
include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
include "Classes/PHPExcel.php";
include "Classes/PHPExcel/Reader/Excel2007.php";
include "Classes/PHPExcel/Writer/Excel2007.php";

$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};


if($_SESSION['id']==1){
	//echo "pediu para parar, parou!";
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
$objPHPExcel = $objReader->load("template/relAnaliticoVistoriasRealizadas.xlsx");    

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Solicitaoes Frustradas")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");
							 


//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 3;
$cont0 = 0;   


$sql1 = "SELECT s.cliente,s.nome_s,s.email,s.tel_corretor,s.fone_preferencial,s.corretor,s.cidade,s.estado,u.filial,vp.NRVISTORIA,vp.DTVISTORIA, vp.NRPLACA,vp.controle_prest,u.nome FROM ".$bancoDados.".solicitacao s, ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".user u WHERE s.id=vp.NUMEROSOLICITACAO AND s.controle_prest=u.id AND s.roteirizador=".$_SESSION['roteirizador']." AND vp.DTVISTORIA>=".$data_inicio." AND vp.DTVISTORIA<=".$data_fim." ORDER BY vp.DTVISTORIA,s.estado,s.cidade,s.corretor ASC";  
$result_sql1 = mysql_query($sql1,$db);

while ($array = @mysql_fetch_array($result_sql1)){

//verifica filial
$sql_filial = "SELECT nome_filial FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial=".$array['filial']." ";
$result_sql_filial = mysql_query($sql_filial ,$db);
$result_filial = @mysql_fetch_array($result_sql_filial);

$data = $array['DTVISTORIA']{6}.$array['DTVISTORIA']{7}."/".$array['DTVISTORIA']{4}.$array['DTVISTORIA']{5}."/".$array['DTVISTORIA']{0}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{2}.$array['DTVISTORIA']{3};	

$telefones='';
if($array['tel_corretor']!=''){
	$telefones=$array['tel_corretor'];
	if($array['fone_preferencial']!=''){
		$telefones.=' / '.$array['fone_preferencial'];
		}
	}else{
		if($array['fone_preferencial']!=''){
			$telefones=$array['fone_preferencial'];
			}
		}

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $data,
                                  "B" => $result_filial['nome_filial'], 
								  "C" => strtoupper($array['corretor']),
								  "D" => strtoupper($array['nome_s']),
                                  "E" => strtolower($array['email']),
                                  "F" => " ".$telefones,
                                  "G" => strtoupper($array['cliente']),
								  "H" => $array['NRVISTORIA'],
								  "I" => $array['estado'],
								  "J" => strtoupper($array['cidade']),
								  "K" => strtoupper($array['NRPLACA']),
								  "L" => strtoupper($array['nome'])
                               ));

        $cont0++;

	}

include "nomePrestadoraRel.php";
 

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Plan1"); 

if(sizeof($vetor0)>0){
		

// VAMOS ESCREVER NO EXCEL
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
		  }

$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);

}	


$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/ANALITICO_VISTORIAS_REALIZADAS_".$empresa."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/ANALITICO_VISTORIAS_REALIZADAS_".$empresa."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/ANALITICO_VISTORIAS_REALIZADAS_".$empresa."_".$periodo1.".xlsx");

exit(0);
?>