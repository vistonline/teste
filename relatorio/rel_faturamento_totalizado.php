<?
set_time_limit(false);
@session_start();
include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
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
$objPHPExcel = $objReader->load("template/modelo_totalizado.xlsx");     

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Faturamento")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");


switch ($_SESSION['roteirizador']){
	case 0 : $prestadora = "BS2 CONSULTORIA"; break;
	case 20 : $prestadora = "ACONFERIR"; break;
	case 60 : $prestadora = "EXCEL VISTORIAS"; break;
	case 70 : $prestadora = "JEF VISTORIAS"; break;
	case 75 : $prestadora = "VISION VISTORIAS"; break;
	case 80 : $prestadora = "OK VISTORIAS"; break;
	case 90 : $prestadora = "REALIZA VISTORIAS"; break;
	case 100 : $prestadora = "VS VISTORIAS"; break;
	case 110 : $prestadora = "PREVICAR VISTORIAS"; break;
	case 140 : $prestadora = "ETH VISTORIAS"; break;
	case 150 : $prestadora = "CENTRAL VISTORIAS"; break;
	case 160 : $prestadora = "MINAS ROTA VISTORIAS"; break;
	case 170 : $prestadora = "BRAGA VISTORIAS"; break;
	case 180 : $prestadora = "VIP VISTORIAS"; break;
	case 190 : $prestadora = "BR ATTLAS VISTORIAS"; break;
	case 200 : $prestadora = "QUINTAO VISTORIAS"; break;
	case 210 : $prestadora = "ALPHA VISTORIAS"; break;
	case 220 : $prestadora = "BBC VISTORIAS"; break;
	case 627 : $prestadora = "3ª VIA WEB"; break;
	case 1786 : $prestadora = "STYLLUS VISTORIAS"; break;
	case 123 : $prestadora = "AMBIENTE DE TESTE"; break;
	default: break;
	}

$base = 1;
$cont = 0;


$sql = "SELECT nome_seguradora FROM ".$bancoDados.".controle_vp_seguradoras";
$result_sql = @mysql_query($sql,$db);
while ($seguradora = @mysql_fetch_array($result_sql)){

$_SESSION["nome_seguradora"]=$seguradora['nome_seguradora'];
include "/var/www/html/sistema/seguradora_nome.php";

//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];

/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE SEGURADORA = ".$seguradora['nome_seguradora']." AND DTVISTORIA >=".$data_inicio." AND DTVISTORIA <=".$data_fim." AND roteirizador = ".$_SESSION['roteirizador']." ORDER BY DTVISTORIA ASC";
$result_sql1 = @mysql_query($sql1,$db);
$contSeg = 0;	
while ($array = @mysql_fetch_array($result_sql1)){

// verifica SE NÃO TEM parceiro
$sqlSol = "SELECT clienteOrigem,corretor,proposta,cidade,roteirizador,numero_inspecao,motivo FROM ".$bancoDados.".solicitacao WHERE	id = ".$array['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador'];
$result_sqlSol = @mysql_query($sqlSol,$db);
$solicitacao = @mysql_fetch_array($result_sqlSol);

if($solicitacao['clienteOrigem']==''){

$data = $array['DTVISTORIA']{6}.$array['DTVISTORIA']{7}."/".$array['DTVISTORIA']{4}.$array['DTVISTORIA']{5}."/".$array['DTVISTORIA']{0}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{1}.$array['DTVISTORIA']{3};	

$sql_prest = "SELECT nome FROM ".$bancoDados.".user WHERE id = ".$array['controle_prest']; 
$result_prest = @mysql_query($sql_prest,$db);
$prest = @mysql_fetch_array($result_prest);

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


		if($contSeg==0){
			$vetor[] = Array($cont => Array(
                                  "A" =>  $cliente_seguradora." - Vistorias realizadas no período de: ".$periodo
								  ));
								  $cont++;
								  $contSeg++;
								  
			$vetor[] = Array($cont => Array(
										  "A" => $contSeg,
										  "B" => $array['NRVISTORIA'], 
										  "C" => $array['NUMEROSOLICITACAO'],
										  "D" => strtoupper($array['NMVEICULO']),
										  "E" => " ".strtoupper($array['NRCHASSI']),
										  "F" => strtoupper($array['NRPLACA']),
										  "G" => $data,
										  "H" => strtoupper($array['NMPROPONENTE']),
										  "I" => $prestador_filial['codigo_filial'],
										  "J" => strtoupper(utf8_encode($solicitacao['cidade'])),
										  "K" => strtoupper(utf8_encode($prest['nome'])),
										  "L" => strtoupper($solicitacao['corretor']),
										  "M" => "",
										  "N" => strtoupper($array['km_percorrido'])
									   ));					  
							  
			}else{
		
				$vetor[] = Array($cont => Array(
										  "A" => $contSeg,
										  "B" => $array['NRVISTORIA'], 
										  "C" => $array['NUMEROSOLICITACAO'],
										  "D" => strtoupper($array['NMVEICULO']),
										  "E" => " ".strtoupper($array['NRCHASSI']),
										  "F" => strtoupper($array['NRPLACA']),
										  "G" => $data,
										  "H" => strtoupper($array['NMPROPONENTE']),
										  "I" => $prestador_filial['codigo_filial'],
										  "J" => strtoupper(utf8_encode($solicitacao['cidade'])),
										  "K" => strtoupper(utf8_encode($prest['nome'])),
										  "L" => strtoupper($solicitacao['corretor']),
										  "M" => "",
										  "N" => strtoupper($array['km_percorrido'])
									   ));
			}

        $cont++;
		$contSeg++;
}// fim verifica parceiro

	}
	
} // fim laço SEGURADORAS

$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont-1);
 
foreach ($vetor as $key => $value){


if(count($value[$key])==1){
$base++;
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.($base + $key).':O'.($base + $key))->applyFromArray(array('font' => array('bold' => true,"color" => array("rgb" => "0000ff"))));
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.($base + $key).':O'.($base + $key));	
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$base++;
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.($base + $key).':O'.($base + $key))->applyFromArray(array('font' => array('bold' => true)));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. ($base + $key), "ITEM");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. ($base + $key), "LAUDO");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. ($base + $key), "SOLICITACAO");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. ($base + $key), "VEICULO");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. ($base + $key), "CHASSI");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. ($base + $key), "PLACA");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. ($base + $key), "DATA VISTORIA");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. ($base + $key), "PROPONENTE");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. ($base + $key), "FILIAL");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'. ($base + $key), "CIDADE");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. ($base + $key), "VISTORIADOR");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'. ($base + $key), "CORRETOR");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'. ($base + $key), "VALOR VISTORIA");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. ($base + $key), "KM");
}else{ 

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

}

		  }



	  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);


 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save('php://output');
$objWriter->save("/var/www/html/sistema/relatorio/relatoriosTemporarios/FATURAMENTO_".$prestadora."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/FATURAMENTO_".$prestadora."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/FATURAMENTO_".$prestadora."_".$periodo1.".xlsx");
mysql_close();
exit();
?>