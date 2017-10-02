<?
set_time_limit(false);
@session_start();
include "../../adm/conecta.php";
include "../verifica.php";
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
$objPHPExcel = $objReader->load("template/modelo_prodParceiro.xlsx");    

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

$base = 6;
$cont0 = 0;   

$sql1="SELECT s.cliente,s.solicitacaoOrigem,s.estado,s.cidade,vp.pda,vp.DTVISTORIA,vp.NMPROPONENTE,vp.NRVISTORIA,vp.NMFABRICANTE,vp.NMVEICULO,vp.NRPLACA,vp.NRCHASSI,vp.DTTRANS,vp.status_trans,vp.controle_prest FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".solicitacao s WHERE s.id=vp.NUMEROSOLICITACAO AND vp.roteirizador=".$_SESSION['roteirizador']." AND vp.DTVISTORIA>=".$data_inicio." AND vp.DTVISTORIA<=".$data_fim." AND s.clienteOrigem='".$_POST['parceiraDestino']."'";
$result_sql1 = mysql_query($sql1,$db);

while ($array = @mysql_fetch_array($result_sql1)){


$sql_prest = "SELECT nome,filial FROM ".$bancoDados.".user WHERE id = ".$array['controle_prest'].""; 
$result_prest = @mysql_query($sql_prest,$db);
$prest = @mysql_fetch_array($result_prest);
	
//selecionando a filial para pegar a regiao correta
$sql_filial = "SELECT nome_filial FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest['filial']."'";
$result_filial = @mysql_query($sql_filial,$db);
$prestador_filial = @mysql_fetch_array($result_filial);


$DTVISTORIA=substr($array['DTVISTORIA'],6,2)."/".substr($array['DTVISTORIA'],4,2)."/".substr($array['DTVISTORIA'],0,4);
$DTTRANS=substr($array['DTTRANS'],6,2)."/".substr($array['DTTRANS'],4,2)."/".substr($array['DTTRANS'],0,4);
if($array['pda']==1){
	$VISTMOBILE='SIM';	
	}else{
		$VISTMOBILE='NÃO';
		}
if($array['solicitacaoOrigem']!=''){
	$AGENDAMENTO_DO_PARCEIRO='SIM';	
	}else{
		$AGENDAMENTO_DO_PARCEIRO='NÃO';
		}
if($array['status_trans']=='4####'){
	$SITUACAO='RECEPCIONADO PELO PARCEIRO';	
	}else{
		$SITUACAO='REJEITADA';
		}

if($array['DTTRANS']==0){
	$DTTRANS='';
	$SITUACAO='NÃO TRANSMITIDA';	
	}

if($DTTRANS!='')
			{
			
				$mes_realizacao = $array['DTVISTORIA']{4}.$array['DTVISTORIA']{5};
				$dia_realizacao = $array['DTVISTORIA']{6}.$array['DTVISTORIA']{7};
				
				$mes_trans = $array['DTTRANS']{4}.$array['DTTRANS']{5};
				$dia_trans = $array['DTTRANS']{6}.$array['DTTRANS']{7};
				$ano_trans = $array['DTTRANS']{0}.$array['DTTRANS']{1}.$array['DTTRANS']{2}.$array['DTTRANS']{3}; 
				
				if ($mes_realizacao!==$mes_trans)    
				{                                                                         
				$lastday = mktime (0,0,0,$mes_trans,0,$ano_trans);
				$ultimo_dia = strftime ( "%d", $lastday);
				$quantidade_dia = ($ultimo_dia - intval($dia_realizacao));
				$PRAZO = $dia_trans + $quantidade_dia;
				}
				else 
				{
				$PRAZO = $dia_trans-$dia_realizacao;
				}
			}
			else
			{
			$PRAZO="";
			}	





		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
								  "B" => $array['NRVISTORIA'], 
                                  "C" => $array['cliente'], 
								  "D" => strtoupper(utf8_encode($array['NMPROPONENTE'])),
								  "E" => strtoupper(utf8_encode($array['NMFABRICANTE'])),
                                  "F" => strtoupper(utf8_encode($array['NMVEICULO'])),
                                  "G" => strtoupper($array['NRPLACA']),
                                  "H" => strtoupper($array['NRCHASSI']),
								  "I" => strtoupper(utf8_encode($prest['nome'])),
								  "J" => strtoupper(utf8_encode($prestador_filial['nome_filial'])),
								  "K" => $DTVISTORIA,
								  "L" => $DTTRANS,
								  "M" => $PRAZO,
								  "N" => $VISTMOBILE,
								  "O" => $AGENDAMENTO_DO_PARCEIRO,
								  "P" => strtoupper(utf8_encode($array['cidade'])),
								  "Q" => strtoupper(utf8_encode($array['estado'])),
								  "R" => $SITUACAO
                               ));

        $cont0++;

	}

switch($_POST['parceiraDestino']){
	case 0: $empresa='BS2'; $nome_empresa='BS2 Consultoria '; break;
	case 20: $empresa='ACONFERIR'; $nome_empresa='ACONFERIR'; break;
	case 60: $empresa='EXCEL'; $nome_empresa='EXCEL'; break;
	case 70: $empresa='JEF'; $nome_empresa='JEF VISTORIAS'; break;
	case 75: $empresa='VISION'; $nome_empresa='VISION VISTORIAS'; break;
	case 80: $empresa='OK'; $nome_empresa='OK VISTORIAS'; break;
	case 90: $empresa='REALIZA'; $nome_empresa='REALIZA VISTORIAS'; break;
	case 100: $empresa='VS'; $nome_empresa='VS VISTORIAS'; break;
	case 110: $empresa='PREVICAR'; $nome_empresa='PREVICAR VISTORIAS'; break;
	case 140: $empresa='ETH'; $nome_empresa='ETH VISTORIAS'; break;
	case 150: $empresa='CENTRAL'; $nome_empresa='CENTRAL VISTORIAS'; break;
	case 160: $empresa='MINASROTA'; $nome_empresa='MINAS ROTA VISTORIAS'; break;
	case 170: $empresa='BRAGA'; $nome_empresa='BRAGA VISTORIAS'; break;
	case 180: $empresa='VIP'; $nome_empresa='VIP VISTORIAS'; break;
	case 190: $empresa='ATTLAS'; $nome_empresa='BR ATTLAS VISTORIAS'; break;
	case 200: $empresa='QUINTÃO'; $nome_empresa='QUINTÃO VISTORIAS'; break;
	case 627: $empresa='3VIA'; $nome_empresa='3ª Via'; break;
	case 1786: $empresa='STYLLUS'; $nome_empresa='Styllus Vistorias';break;
	default: $empresa='AREA-TI'; break;
	}
 
$numberABA=0;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Plan1"); 

if(sizeof($vetor0)>0){
		
// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', $periodo);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F3', utf8_encode($nome_empresa));

 
// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont0-1); 


  foreach ($vetor0 as $key => $value){

  
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('A'. ($base + $key), $value[$key]['A']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('B'. ($base + $key), $value[$key]['B']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('C'. ($base + $key), $value[$key]['C']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('D'. ($base + $key), $value[$key]['D']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('E'. ($base + $key), $value[$key]['E']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F'. ($base + $key), $value[$key]['F']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('G'. ($base + $key), $value[$key]['G']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('H'. ($base + $key), $value[$key]['H']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('I'. ($base + $key), $value[$key]['I']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('J'. ($base + $key), $value[$key]['J']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('K'. ($base + $key), $value[$key]['K']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('L'. ($base + $key), $value[$key]['L']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('M'. ($base + $key), $value[$key]['M']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('N'. ($base + $key), $value[$key]['N']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('O'. ($base + $key), $value[$key]['O']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('P'. ($base + $key), $value[$key]['P']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('Q'. ($base + $key), $value[$key]['Q']);
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('R'. ($base + $key), $value[$key]['R']);
		  }

$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle($empresa);		  
}	


$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/RELATORIO_PRODPARCEIRO_".$empresa."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/RELATORIO_PRODPARCEIRO_".$empresa."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/RELATORIO_PRODPARCEIRO_".$empresa."_".$periodo1.".xlsx");


exit(0);
?>