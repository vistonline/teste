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
$objPHPExcel = $objReader->load("template/modelo_nobre.xlsx");

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
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "Vistorias realizadas no período de: ".$periodo);
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', "Vistorias realizadas no período de: ".$periodo);

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 6;
$cont0 = 0; // TODAS FINALIDADES EXCETO REVISTORIA POR INADIMPLÊNCIA
$cont1 = 0; // REVISTORIA POR INADIMPLÊNCIA


$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 87 AND DTVISTORIA >=".$data_inicio." AND DTVISTORIA <=".$data_fim." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
$result_sql1 = mysql_query($sql1,$db);
	
while ($array = @mysql_fetch_array($result_sql1)){

// verifica SE NÃO TEM parceiro
$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
	id = ".$array['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
$result_sqlSol = mysql_query($sqlSol,$db);
$Sol = @mysql_fetch_array($result_sqlSol);
if($Sol['clienteOrigem']==''){

$dataVistoria = substr($array['DTVISTORIA'],6,2)."/".substr($array['DTVISTORIA'],4,2)."/".substr($array['DTVISTORIA'],0,4);	
$dataDigitacao = substr($array['DTPROC'],6,2)."/".substr($array['DTPROC'],4,2)."/".substr($array['DTPROC'],0,4);	
$dataTransmissao = substr($array['DTTRANS'],6,2)."/".substr($array['DTTRANS'],4,2)."/".substr($array['DTTRANS'],0,4);;	

$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array['controle_prest'].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);

//selecionando a filial para pegar a regiao correta
$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest['filial']."' AND roteirizador = ".$array['roteirizador']."";
$result_filial = mysql_query($sql_filial,$db);
$prestador_filial = mysql_fetch_array($result_filial);

$solicitacao_result = mysql_query("SELECT corretor, proposta, cidade, estado, roteirizador, numero_inspecao, motivo FROM ".$bancoDados.".solicitacao WHERE id = " . $array['NUMEROSOLICITACAO'], $db);
$solicitacao = mysql_fetch_assoc($solicitacao_result);

$preco_result = mysql_query("SELECT preco_vistoria, preco_vistoria_posto FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE seguradora = 87", $db);
$preco = mysql_fetch_assoc($preco_result);

	
	 if ($array["CDFINALIDADE"]=='01'){ $CDFINALIDADE = "Novo (previa)";}
     if ($array["CDFINALIDADE"]=='02'){ $CDFINALIDADE = "Reducao franquia";}
     if ($array["CDFINALIDADE"]=='03'){ $CDFINALIDADE = "Parcela em atraso";}
     if ($array["CDFINALIDADE"]=='04'){ $CDFINALIDADE = "Substituicao";}
     if ($array["CDFINALIDADE"]=='05'){ $CDFINALIDADE = "Renovacao";}
     if ($array["CDFINALIDADE"]=='06'){ $CDFINALIDADE = "Inclusao acessorios";}
     if ($array["CDFINALIDADE"]=='07'){ $CDFINALIDADE = "Exclusao de avarias";}
     if ($array["CDFINALIDADE"]=='11'){ $CDFINALIDADE = "Incl. de Cla. de Vidro";}
	 if ($array["CDFINALIDADE"]=='12'){ $CDFINALIDADE = "Revistoria";}
	 if ($array["CDFINALIDADE"]=='13'){ $CDFINALIDADE = "Revistoria por inadimplência";}
	 if ($array["CDFINALIDADE"]=='14'){ $CDFINALIDADE = "SEGURO COM RASTREADOR";}
     if ($array["CDFINALIDADE"]=='99'){ $CDFINALIDADE = "Outros";}
	 if ($array["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; }
	 if ($array["TPVISTORIA"]=='V'){$TPVISTORIA = "VOLANTE"; }
	
switch($array["TPVISTORIA"]){
	case 'P': $PRECO=$preco['preco_vistoria']; break;
	case 'V': $PRECO=$preco['preco_vistoria_posto']; break;
	default:break;
	}	
	
	 
	 switch($array['CDRESSALVA']){
		 case 1: $RESSALVA='Aceitável - Sem Avarias'; break;
		 case 2: $RESSALVA='Aceitável - Com Avarias'; break;
		 case 3: $RESSALVA='Sujeito à Análise'; break;
		 case 4: $RESSALVA='Sugerida a Recusa'; break;
		 default:break;
		 }

// calculando prazo transmissão
if($array['DTTRANS']>0){
	$PRAZO=(int)$array['DTTRANS']-(int)$array['DTVISTORIA'];
	}else{
		$PRAZO='';
		}


 if ($array["CDFINALIDADE"]!= '13')//TODAS FINALIDADES EXCETO (Revistoria por inadimplência)
      {

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
								  "D" => $CDFINALIDADE,
								  "E" => $RESSALVA,
                                  "F" => strtoupper($array['NMVEICULO']),
                                  "G" => strtoupper($array['NRCHASSI']),
                                  "H" => strtoupper($array['NRPLACA']),
								  "I" => $dataVistoria,
								  "J" => $dataDigitacao,
								  "K" => $dataTransmissao,
								  "L" => $PRAZO,
								  "M" => strtoupper(utf8_encode($array['NMPROPONENTE'])),
								  "N" => utf8_encode($solicitacao['cidade']),
								  "O" => utf8_encode($solicitacao['estado']),
								  "P" => strtoupper(utf8_encode($prest['nome'])),
								  "Q" => strtoupper($array['NMCORRETOR']),
								  "R" => $TPVISTORIA,
								  "S" => $PRECO,
								  "T" => strtoupper($array['km_percorrido'])
                               ));

        $cont0++;

	  } //FIM (IF) FILIAL CAMPINAS

	   else{

		$vetor1[] = Array($cont1 => Array(
                                  "A" => $cont1+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
								  "D" => $CDFINALIDADE,
								  "E" => $RESSALVA,
                                  "F" => strtoupper($array['NMVEICULO']),
                                  "G" => strtoupper($array['NRCHASSI']),
                                  "H" => strtoupper($array['NRPLACA']),
								  "I" => $dataVistoria,
								  "J" => $dataDigitacao,
								  "K" => $dataTransmissao,
								  "L" => $PRAZO,
								  "M" => strtoupper(utf8_encode($array['NMPROPONENTE'])),
								  "N" => utf8_encode($solicitacao['cidade']),
								  "O" => utf8_encode($solicitacao['estado']),
								  "P" => strtoupper(utf8_encode($prest['nome'])),
								  "Q" => strtoupper($array['NMCORRETOR']),
								  "R" => $TPVISTORIA,
								  "S" => $PRECO,
								  "T" => strtoupper($array['km_percorrido'])
                               ));

        $cont1++;

	  } //FIM (ELSE)

}// fim verifica parceiro
	}

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Total de Vistorias: '.$cont0);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'Total de Vistorias: '.$cont1);
	
$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont0-1);
$objPHPExcel->setActiveSheetIndex(1)->insertNewRowBefore($base , $cont1-1);

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
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'. ($base + $key), $value[$key]['S']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'. ($base + $key), $value[$key]['T']);

		  }

foreach ($vetor1 as $key => $value){ 
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'. ($base + $key), $value[$key]['I']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('O'. ($base + $key), $value[$key]['O']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P'. ($base + $key), $value[$key]['P']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q'. ($base + $key), $value[$key]['Q']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R'. ($base + $key), $value[$key]['R']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S'. ($base + $key), $value[$key]['S']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T'. ($base + $key), $value[$key]['T']);

		  }
  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
$objPHPExcel->setActiveSheetIndex(1)->removeRow($base - 1,1);


 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/FATURAMENTO_".$empresa."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>