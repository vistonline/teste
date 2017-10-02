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
$objPHPExcel = $objReader->load("template/seguradorasLaudoStatus.xlsx");

$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de Vistorias Realizadas")
							 ->setDescription("Documento gerado pelo sistema VistOnLine")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("import logs call");

include "nomePrestadoraRel.php";


//////////////////////////////////////////////// C A B E Ç A L H O  ////////////////////////////////////////////////////////

$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];



/////////////////////////////////////////////// F I M     C A B E Ç A L H O  ////////////////////////////////////////////////////////

$base = 5;   
$cont0 = 0; 


$status="";
if($_POST['status']=='analisadas'){
	$status=" AND editado=1";
	
	}elseif($_POST['status']=='nao_analisadas'){
		$status=" AND editado=0";
		
		}elseif($_POST['status']=='transmitidas'){
			$status=" AND editado=1 AND DTTRANS>2015";
			
			}elseif($_POST['status']=='nao_transmitidas'){
				$status=" AND editado=1 AND DTTRANS=0";
				}
  
	
$sql1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = '".$_SESSION['nome_seguradora']."' AND DTVISTORIA>=".$data_inicio." AND DTVISTORIA<=".$data_fim." AND roteirizador = ".$_SESSION['roteirizador']." ".$status." ORDER BY DTVISTORIA ASC";
$result_sql1 = mysql_query($sql1,$db);

$parecer="";
$nomeStatus="";
while ($array = @mysql_fetch_array($result_sql1)){


$sql23 = "SELECT avaliacao FROM ".$bancoDados.".vistoria_extra WHERE solicitacao=".$array['NUMEROSOLICITACAO'];
$result_sql23 = mysql_query($sql23,$db);
$extra = @mysql_fetch_array($result_sql23);


// DADOS DA SOLICITACAO
$sql_Sol = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$array['NUMEROSOLICITACAO'];
$result_sql_Sol = mysql_query($sql_Sol,$db);
$sol = @mysql_fetch_array($result_sql_Sol);


if($array['SEGURADORA']==337 || $array['SEGURADORA']==339){
	if($extra['avaliacao']=='01'){
			$parecer="ACEITÁVEL";
			
			}elseif($extra['avaliacao']=='02'){
				$parecer="SUJEITO À ANÁLISE";
				
				}elseif($extra['avaliacao']=='03'){
					$parecer="REJEITADO";
					
					}else{
							$parecer="";     
							}

	if($extra['avaliacao']==''){
		if($array['CDRESSALVA']=='1' || $array['CDRESSALVA']=='2'){
			$parecer="ACEITÁVEL";
			
			}elseif($array['CDRESSALVA']=='3'){
					$parecer="SUJEITO À ANÁLISE";
					
					}elseif($array['CDRESSALVA']=='4'){
						$parecer="REJEITADO";
						}else{
							$parecer="";
							}
		}

	}else{

		if($array['CDRESSALVA']=='1'){
			$parecer="ACEITÁVEL - SEM AVARIAS";
			
			}elseif($array['CDRESSALVA']=='2'){
				$parecer="ACEITÁVEL - COM AVARIAS";
				
				}elseif($array['CDRESSALVA']=='3'){
					$parecer="SUJEITO À ANÁLISE";
					
					}elseif($array['CDRESSALVA']=='4'){
						$parecer="SUGERIDA À RECUSA";
						}else{
							$parecer="";
							}
					
	}

if($array['editado']==0){
	$nomeStatus="NÃO ANALISADA";
	}elseif($array['editado']==1 && $array['DTTRANS']>2015){
		$nomeStatus="TRANSMITIDA";
		}elseif($array['editado']==1 && $array['DTTRANS']==0){
			$nomeStatus="ANALISADA/NÃO TRANSMITIDA";
			}
			
$dataVistoria = substr($array['DTVISTORIA'],6,2)."/".substr($array['DTVISTORIA'],4,2)."/".substr($array['DTVISTORIA'],0,4);
$dataAgendamento = $sol['data_auto'];

if($array['DTTRANS']!='' && $array['DTTRANS']!='0'){
$dataTransmissao = substr($array['DTTRANS'],6,2)."/".substr($array['DTTRANS'],4,2)."/".substr($array['DTTRANS'],0,4);
}else{
	$dataTransmissao="";
	}

/*$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$array[controle_prest].""; 
$result_prest = mysql_query($sql_prest,$db);
$prest = mysql_fetch_array($result_prest);*/
    
		$vetor0[] = Array($cont0 => Array(
								  "A" => $cont0+1,
      							  "B" => strtoupper($array['UFVISTORIA']),
								  "C" => $array['NRVISTORIA'],
								  "D" => $sol['proposta'],
                                  "E" => strtoupper(utf8_encode($array['NMPROPONENTE'])), 
								  "F" => $sol['cpf_cnpj'],
								  "G" => strtoupper(utf8_encode($array['CDVEICULO'])),
								  "H" => strtoupper(utf8_encode($array['NMFABRICANTE'])),
								  "I" => strtoupper(utf8_encode($array['NMVEICULO'])),
								  "J" => strtoupper($array['NRCHASSI']),
								  "K" => strtoupper($array['NRPLACA']),
								  "L" => $array['NRANOFABRICACAO'],
								  "M" => $array['NRANOMOD'],
								  "N" => $dataAgendamento,
								  "O" => $dataVistoria,
								  "P" => $dataTransmissao,
								  "Q" => $nomeStatus,
								  "R" => $parecer
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
$objPHPExcel->getActiveSheet()->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->getActiveSheet()->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->getActiveSheet()->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->getActiveSheet()->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->getActiveSheet()->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->getActiveSheet()->setCellValue('O'. ($base + $key), $value[$key]['O']);
$objPHPExcel->getActiveSheet()->setCellValue('P'. ($base + $key), $value[$key]['P']);
$objPHPExcel->getActiveSheet()->setCellValue('Q'. ($base + $key), $value[$key]['Q']);
$objPHPExcel->getActiveSheet()->setCellValue('R'. ($base + $key), $value[$key]['R']);
      
		  }

 	  
$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
              
 
mkdir('atualizacoesTemp/', 0777);
chmod('atualizacoesTemp/', 0777);
mkdir('atualizacoesTemp/'.$_SESSION['roteirizador'], 0777);
chmod('atualizacoesTemp/'.$_SESSION['roteirizador'], 0777); 
 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("atualizacoesTemp/".$_SESSION['roteirizador']."/laudoStatus_".$empresa."_".$periodo1.".xlsx");

downloadFile( "atualizacoesTemp/".$_SESSION['roteirizador']."/laudoStatus_".$empresa."_".$periodo1.".xlsx" );

unlink("atualizacoesTemp/".$_SESSION['roteirizador']."/laudoStatus_".$empresa."_".$periodo1.".xlsx");
mysql_close();
exit(0);
?>