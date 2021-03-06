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
$objPHPExcel = $objReader->load("template/modelo_maritima.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Faturamento")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");

include "nomePrestadoraRel.php";

	
//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];

	//$objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D9', "Vistorias realizadas no período de: ".$periodo);
	

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 13;
$cont0 = 0; 

/*$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 61 AND DTVISTORIA >=".$data_inicio." AND DTVISTORIA <=".$data_fim." AND roteirizador = ".$_SESSION[roteirizador]." order by DTVISTORIA ASC";*/
$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 61 AND DTTRANS >=".$data_inicio." AND DTTRANS <=".$data_fim." AND roteirizador = ".$_SESSION[roteirizador]." order by DTVISTORIA ASC";
$result_sql1 = mysql_query($sql1,$db);
     	
while ($array = @mysql_fetch_array($result_sql1)){
    
// verifica SE NÃO TEM parceiro
$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
	id = ".$array['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
$result_sqlSol = mysql_query($sqlSol,$db);
$Sol = @mysql_fetch_array($result_sqlSol);
if($Sol['clienteOrigem']==''){	
	  
$data = $array['DTVISTORIA']{6}.$array['DTVISTORIA']{7}."/".$array['DTVISTORIA']{4}.$array['DTVISTORIA']{5}."/".$array['DTVISTORIA']{0}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{2}.$array['DTVISTORIA']{3};

$data_trans = $array['DTTRANS']{6}.$array['DTTRANS']{7}."/".$array['DTTRANS']{4}.$array['DTTRANS']{5}."/".$array['DTTRANS']{0}.$array['DTTRANS']{1}.$array['DTTRANS']{2}.$array['DTTRANS']{3};

$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array[controle_prest].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);

//selecionando a filial para pegar a regiao correta
$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$array[roteirizador]."";
$result_filial = mysql_query($sql_filial,$db);
$prestador_filial = mysql_fetch_array($result_filial);

$solicitacao_result = mysql_query("SELECT corretor, proposta, cidade, roteirizador, numero_inspecao, estado, motivo, numero_laudo_informado FROM ".$bancoDados.".solicitacao WHERE id = " . $array['NUMEROSOLICITACAO'], $db);
$solicitacao = mysql_fetch_assoc($solicitacao_result);
	
	 if ($array["CDFINALIDADE"]=='01'){ $CDFINALIDADE = "Novo (previa)";}
     if ($array["CDFINALIDADE"]=='02'){ $CDFINALIDADE = "Reducao franquia";}
     if ($array["CDFINALIDADE"]=='03'){ $CDFINALIDADE = "Parcela em atraso";}
     if ($array["CDFINALIDADE"]=='04'){ $CDFINALIDADE = "Substituicao";}
     if ($array["CDFINALIDADE"]=='05'){ $CDFINALIDADE = "Renovacao";}
     if ($array["CDFINALIDADE"]=='06'){ $CDFINALIDADE = "Inclusao acessorios";}
     if ($array["CDFINALIDADE"]=='07'){ $CDFINALIDADE = "Exclusao de avarias";}
     if ($array["CDFINALIDADE"]=='08'){ $CDFINALIDADE = "Consorcio - Substituicao de  Garantia";}
     if ($array["CDFINALIDADE"]=='09'){ $CDFINALIDADE = "Consorcio - Avaliacao de Bem";}
     if ($array["CDFINALIDADE"]=='10'){ $CDFINALIDADE = "Vistoria Especial";}
     if ($array["CDFINALIDADE"]=='11'){ $CDFINALIDADE = "Incl. de Cla. de Vidro";}
     if ($array["CDFINALIDADE"]=='99'){ $CDFINALIDADE = "Outros";}



if($solicitacao['numero_laudo_informado']!=''){
	$nrSolicitacao=$solicitacao['numero_laudo_informado'];
	}else{
		if( ($array['DTTRANS']>=20140423) || ($array['DTTRANS']==0 && date('Ymd')>=20140423) ){
			$nrSolicitacao=$array['NRVISTORIA'];
			}else{
				$nrSolicitacao=$array['NUMEROSOLICITACAO'];
				}
		}


	//selecionando a filial para pegar a regiao correta
$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial['id']." AND seguradora = '61' AND roteirizador = ".$array['roteirizador']."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	//$preco_volante = str_replace(".",",",$resultadoPreco['preco_vistoria']);
	//$preco_posto = str_replace(".",",",$resultadoPreco['preco_vistoria_posto']);
	$preco_volante = $resultadoPreco['preco_vistoria'];
	$preco_posto = $resultadoPreco['preco_vistoria_posto'];
	if ($array["TPVISTORIA"]=='V'){
		$TPVISTORIA = "VOLANTE";
		$PRECO_VOLANTE=$preco_volante;
		$PRECO_FIXO = "";
		}else{
			$TPVISTORIA = "POSTO";
			$PRECO_FIXO=$preco_posto;
			$PRECO_VOLANTE = "";
			}

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
								  "B" => $data,
								  "C" => $data_trans,
                                  "D" => $nrSolicitacao, 
								  "E" => strtoupper($array['NMPROPONENTE']),
								  "F" => strtoupper($array['NMVEICULO']),
								  "G" => strtoupper($array['NRPLACA']),
								  "H" => strtoupper($solicitacao['corretor']),
								  "J" => $CDFINALIDADE,
								  "K" => strtoupper(utf8_encode($prestador_filial['cidade'])),
								  "L" => strtoupper(utf8_encode($solicitacao['cidade'])),
								  "M" => strtoupper($array['km_percorrido']),
								  "N" => $PRECO_VOLANTE,
								  "O" => $PRECO_FIXO,
								  "Q" => ($PRECO_VOLANTE+$PRECO_FIXO)+($array['km_percorrido']*0),
								  "R" => strtoupper($solicitacao['estado'])
                                ));

        $cont0++;

}// fim verifica parceiro

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
$objPHPExcel->getActiveSheet()->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->getActiveSheet()->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->getActiveSheet()->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->getActiveSheet()->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->getActiveSheet()->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->getActiveSheet()->setCellValue('O'. ($base + $key), $value[$key]['O']);
$objPHPExcel->getActiveSheet()->setCellValue('Q'. ($base + $key), $value[$key]['Q']);
$objPHPExcel->getActiveSheet()->setCellValue('R'. ($base + $key), $value[$key]['R']);

		  }

 	  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);



 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
// CRIANDO ARVORE DE PASTAS
@mkdir('faturamento_maritima/', 0777);
@chmod('faturamento_maritima/', 0777);
@mkdir('faturamento_maritima/'.$_SESSION['roteirizador'], 0777);
@chmod('faturamento_maritima/'.$_SESSION['roteirizador'], 0777);
$objWriter->save("faturamento_maritima/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");

downloadFile( "faturamento_maritima/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx" );

//unlink("faturamento_maritima/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>