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
$objPHPExcel = $objReader->load("template/modelo_ace.xlsx");

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
	$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A2', "Vistorias realizadas no período de: ".$periodo);
	$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A1', $nome_empresa);
	$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A2', "Vistorias realizadas no período de: ".$periodo);

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 6;
$cont0 = 0; // FILIAL CAMPINAS 001
$cont1 = 0; // FILIAL RIBEIRÃO PRETO 003 E 005
$cont2 = 0; // FILIAL SÃO JOSE DO RIO PRETO 004
$cont3 = 0;

$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 23 AND DTVISTORIA >=".$data_inicio." AND DTVISTORIA <=".$data_fim." AND roteirizador = ".$_SESSION[roteirizador]." order by DTVISTORIA ASC";
$result_sql1 = mysql_query($sql1,$db);
	
while ($array = @mysql_fetch_array($result_sql1)){

// verifica SE NÃO TEM parceiro
$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
	id = ".$array['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
$result_sqlSol = mysql_query($sqlSol,$db);
$Sol = @mysql_fetch_array($result_sqlSol);
if($Sol['clienteOrigem']==''){

$data = $array['DTVISTORIA']{6}.$array['DTVISTORIA']{7}."/".$array['DTVISTORIA']{4}.$array['DTVISTORIA']{5}."/".$array['DTVISTORIA']{0}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{3};	

$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array[controle_prest].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);

//selecionando a filial para pegar a regiao correta
$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$array[roteirizador]."";
$result_filial = mysql_query($sql_filial,$db);
$prestador_filial = mysql_fetch_array($result_filial);

$solicitacao_result = mysql_query("SELECT corretor, proposta, cidade, roteirizador, numero_inspecao, motivo FROM ".$bancoDados.".solicitacao WHERE id = " . $array['NUMEROSOLICITACAO'], $db);
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
	 if ($array["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; }
	 if ($array["TPVISTORIA"]=='V'){$TPVISTORIA = "VOLANTE"; }



 if ($prestador_filial['codigo_filial']== '001')//FILIAL CAMPINAS
      {

		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
                                  "D" => strtoupper($array['NMVEICULO']),
                                  "E" => strtoupper($array['NRCHASSI']),
                                  "F" => strtoupper($array['NRPLACA']),
								  "G" => $data,
								  "H" => $data,
								  "I" => strtoupper($array['NMPROPONENTE']),
								  "J" => $prestador_filial['codigo_filial'],
								  "K" => strtoupper(utf8_encode($solicitacao['cidade'])),
								  "L" => strtoupper(utf8_encode($prest['nome'])),
								  "M" => strtoupper($solicitacao['corretor']),
								  "N" => "",
								  "O" => strtoupper($array['km_percorrido'])
                               ));

        $cont0++;

	  } //FIM (IF) FILIAL CAMPINAS
	  
	 elseif ($prestador_filial['codigo_filial']== '003'||$prestador_filial['codigo_filial']== '005')//FILIAL RIBEIRÃO PRETO (MATRIZ)
      {

		$vetor1[] = Array($cont1 => Array(
                                  "A" => $cont1+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
                                  "D" => strtoupper($array['NMVEICULO']),
                                  "E" => strtoupper($array['NRCHASSI']),
                                  "F" => strtoupper($array['NRPLACA']),
								  "G" => $data,
								  "H" => $data,
								  "I" => strtoupper($array['NMPROPONENTE']),
								  "J" => $prestador_filial['codigo_filial'],
								  "K" => strtoupper(utf8_encode($solicitacao['cidade'])),
								  "L" => strtoupper(utf8_encode($prest['nome'])),
								  "M" => strtoupper($solicitacao['corretor']),
								  "N" => "",
								  "O" => strtoupper($array['km_percorrido'])
                               ));

        $cont1++;

	  } //FIM (IF) FILIAL RIBEIRÃO PRETO (MATRIZ)
	  
	   elseif ($prestador_filial['codigo_filial']== '004')//FILIAL SÃO JOSÉ DO RIO PRETO
      {

		$vetor2[] = Array($cont2 => Array(
                                 "A" => $cont2+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
                                  "D" => strtoupper($array['NMVEICULO']),
                                  "E" => strtoupper($array['NRCHASSI']),
                                  "F" => strtoupper($array['NRPLACA']),
								  "G" => $data,
								  "H" => $data,
								  "I" => strtoupper($array['NMPROPONENTE']),
								  "J" => $prestador_filial['codigo_filial'],
								  "K" => strtoupper(utf8_encode($solicitacao['cidade'])),
								  "L" => strtoupper(utf8_encode($prest['nome'])),
								  "M" => strtoupper($solicitacao['corretor']),
								  "N" => "",
								  "O" => strtoupper($array['km_percorrido'])
                               ));

        $cont2++;

	  } //FIM (IF) FILIAL SÃO JOSÉ DO RIO PRETO
	  
	 
	  
	   else{

		$vetor3[] = Array($cont3 => Array(
                                  "A" => $cont3+1,
                                  "B" => $array['NRVISTORIA'], 
								  "C" => $array['NUMEROSOLICITACAO'],
                                  "D" => strtoupper($array['NMVEICULO']),
                                  "E" => strtoupper($array['NRCHASSI']),
                                  "F" => strtoupper($array['NRPLACA']),
								  "G" => $data,
								  "H" => $data,
								  "I" => strtoupper($array['NMPROPONENTE']),
								  "J" => $prestador_filial['codigo_filial'],
								  "K" => strtoupper(utf8_encode($solicitacao['cidade'])),
								  "L" => strtoupper(utf8_encode($prest['nome'])),
								  "M" => strtoupper($solicitacao['corretor']),
								  "N" => "",
								  "O" => strtoupper($array['km_percorrido'])
                               ));

        $cont3++;

	  } //FIM (ELSE)

}// fim verifica parceiro

	}
	
  $objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont0-1);
  $objPHPExcel->setActiveSheetIndex(1)->insertNewRowBefore($base , $cont1-1);
  $objPHPExcel->setActiveSheetIndex(2)->insertNewRowBefore($base , $cont2-1);
  $objPHPExcel->setActiveSheetIndex(3)->insertNewRowBefore($base , $cont3-1);
 
  
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

		  }

foreach ($vetor2 as $key => $value){ 
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I'. ($base + $key), $value[$key]['I']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('O'. ($base + $key), $value[$key]['O']);

		  }

foreach ($vetor3 as $key => $value){ 
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I'. ($base + $key), $value[$key]['I']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('O'. ($base + $key), $value[$key]['O']);

		  }
		  
		  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
$objPHPExcel->setActiveSheetIndex(1)->removeRow($base - 1,1);
$objPHPExcel->setActiveSheetIndex(2)->removeRow($base - 1,1);
$objPHPExcel->setActiveSheetIndex(3)->removeRow($base - 1,1);

 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("txt_ace/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");

downloadFile( "txt_ace/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx" );

unlink("txt_ace/".$_SESSION['roteirizador']."/FATURAMENTO_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>