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
$objPHPExcel = $objReader->load("template/MODELO_FATURAMENTO_ALLIANZ.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Faturamento")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");

include "nomePrestadoraRel.php";

	
$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};

$base = 4;  
$cont0 = 0; 

$sql1 = "SELECT DTTRANS, NUMEROSOLICITACAO, roteirizador, controle_prest, UFVISTORIA FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 73 AND DTTRANS >=".$data_inicio." AND DTTRANS <=".$data_fim." AND roteirizador = ".$_SESSION['roteirizador']." order by DTTRANS ASC";
$result_sql1 = mysql_query($sql1,$db);
     	
while ($array = @mysql_fetch_array($result_sql1)){
 
// verifica SE NÃO TEM parceiro
$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
	id = ".$array['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
$result_sqlSol = mysql_query($sqlSol,$db);
$Sol = @mysql_fetch_array($result_sqlSol);
if($Sol['clienteOrigem']==''){
 
	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array['controle_prest']; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest['filial']."' AND roteirizador = ".$array['roteirizador'];
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial['id']." AND seguradora = '73' AND roteirizador = ".$array['roteirizador'];
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);

$PRECO=$resultadoPreco['preco_vistoria'];
      
$data_trans = $array['DTTRANS']{6}.$array['DTTRANS']{7}."/".$array['DTTRANS']{4}.$array['DTTRANS']{5}."/".$array['DTTRANS']{0}.$array['DTTRANS']{1}.$array['DTTRANS']{2}.$array['DTTRANS']{3};

$solicitacao_result = mysql_query("SELECT voucher FROM ".$bancoDados.".solicitacao WHERE id = " . $array['NUMEROSOLICITACAO'], $db);
$solicitacao = mysql_fetch_assoc($solicitacao_result);
   	
$proposta=strtoupper($solicitacao['voucher']);

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $nome_empresa,
								  "B" => $proposta,
								  "C" => $data_trans,
                                  "D" => $array['UFVISTORIA'],
								  "E" => $PRECO		
                                ));
$cont0++;
$PRECO_TOTAL+=$PRECO;

}// verifica parceiro

	}

$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont0-1);
  
foreach ($vetor0 as $key => $value){  
$objPHPExcel->getActiveSheet()->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->getActiveSheet()->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->getActiveSheet()->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->getActiveSheet()->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->getActiveSheet()->setCellValue('E'. ($base + $key), $value[$key]['E']);

		  }

$objPHPExcel->getActiveSheet()->setCellValue('I1', $cont0);
$objPHPExcel->getActiveSheet()->setCellValue('I2', $PRECO_TOTAL);

$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);


$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
// CRIANDO ARVORE DE PASTAS
@mkdir('faturamento_allianz/', 0777);
@chmod('faturamento_allianz/', 0777);
@mkdir('faturamento_allianz/'.$_SESSION['roteirizador'], 0777);
@chmod('faturamento_allianz/'.$_SESSION['roteirizador'], 0777);
$objWriter->save("faturamento_allianz/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");

downloadFile( "faturamento_allianz/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx" );

//unlink("faturamento_allianz/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>