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
$objPHPExcel = $objReader->load("template/rel_prod_corretor".$_SESSION[roteirizador].".xlsx");


$objPHPExcel->getProperties()->setCreator("Robson Souza Cassiano")
    						 ->setLastModifiedBy("Robson Souza Cassiano")
							 ->setTitle("Relatorio")
							 ->setSubject("Relatorio de producao por corretor")
							 ->setDescription("Documento gerado pelo sistema VistOn-Line")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("relatorios VistOn-Line");


//Recebendo valores
$data_inicio = $_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9}.$_POST['data1']{3}.$_POST['data1']{4}.$_POST['data1']{0}.$_POST['data1']{1};
$data_fim = $_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9}.$_POST['data2']{3}.$_POST['data2']{4}.$_POST['data2']{0}.$_POST['data2']{1};


$data1 = $_POST['data1']{0}.$_POST['data1']{1}."-".$_POST['data1']{3}.$_POST['data1']{4}."-".$_POST['data1']{6}.$_POST['data1']{7}.$_POST['data1']{8}.$_POST['data1']{9};
$data2 = $_POST['data2']{0}.$_POST['data2']{1}."-".$_POST['data2']{3}.$_POST['data2']{4}."-".$_POST['data2']{6}.$_POST['data2']{7}.$_POST['data2']{8}.$_POST['data2']{9};

$periodo = $_POST['data1'] . ' - ' . $_POST['data2'];

$todas=substr ($_POST['todas'],0,-1);


if($_POST['seguradora']=='todas'){
	$seg_sql="";
	}else{
		$seg_sql="AND cliente ='".$_POST['seguradora']."' ";
		}


//Estrutura da tabela TEMPORARIA 'solicitacao'
$sql_temp = "CREATE TABLE IF NOT EXISTS ".$bancoDados.".solicitacao_tempRel (
  cliente varchar(22) NOT NULL,
  corretor varchar(60) NOT NULL,
  numero_susep varchar(22) NOT NULL,
  dia int(8) NOT NULL,
  roteirizador int(6) NOT NULL,
  cd_corretor varchar(18) NOT NULL
 ) ENGINE=MEMORY  DEFAULT CHARSET=latin1;";	
$result_temp = mysql_query($sql_temp,$db);

$sql_busca="SELECT cliente,corretor,dia,roteirizador,numero_susep, IF( cd_corretor ='',  numero_susep , cd_corretor ) AS cd_corretor FROM ".$bancoDados.".solicitacao WHERE dia>=".$data_inicio." AND dia<=".$data_fim." AND roteirizador=".$_SESSION['roteirizador']."";
$result=$bancoPDO -> prepare($sql_busca);
$result -> execute();
$resultado = $result -> fetchAll(PDO::FETCH_ASSOC);	

for($i=0,$C=count($resultado); $i<$C; $i++){	
$buscaDados=$resultado[$i];

$sql_inserir = "INSERT IGNORE INTO ".$bancoDados.".solicitacao_tempRel (cliente,corretor,dia,roteirizador,numero_susep,cd_corretor) VALUES ('".$buscaDados['cliente']."','".$buscaDados['corretor']."','".$buscaDados['dia']."','".$buscaDados['roteirizador']."','".$buscaDados['numero_susep']."','".$buscaDados['cd_corretor']."')"; 
$result_inserir = mysql_query($sql_inserir,$db);
}


$sql2 = "SELECT COUNT(*) as total FROM ".$bancoDados.".solicitacao_tempRel WHERE roteirizador=".$_SESSION['roteirizador']." AND dia>=".$data_inicio." AND dia <=".$data_fim." ".$seg_sql."";
$result_sql2 = mysql_query($sql2,$db);
$resultado2 = mysql_fetch_assoc($result_sql2);


$base = 14;
$cont = 0;

########################################### CABEÇALHO ############################################
		$objPHPExcel->setActiveSheetIndex(0); 
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N10', $resultado2['total']);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J10', $data1."  a  ".$data2);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E10', strtoupper($seguradora));
##################################################################################################

$sql1="SELECT corretor, cd_corretor, COUNT(cd_corretor) as quantidade FROM ".$bancoDados.".solicitacao_tempRel WHERE dia>=".$data_inicio." AND dia<=".$data_fim." ".$seg_sql." GROUP BY cd_corretor HAVING COUNT(cd_corretor)>0 order by quantidade desc";    
$result_sql1 = mysql_query($sql1,$db);

       
while ($resultado = mysql_fetch_assoc($result_sql1))
  {
/*	if($resultado['numero_susep']==''){
		$resultado['numero_susep']=$resultado['cd_corretor'];
		}*/  	
		
		
				$vetor[] = Array($cont => Array(
                                  "B" => strtoupper(utf8_encode($resultado['corretor'])),
                                  "H" => $resultado['cd_corretor'], 
								  "K" => ($resultado['quantidade']),
                                  "N" => (($resultado['quantidade'])/$resultado2['total'])
                                  ));

        		$cont++;
		
	  }
	  
$objPHPExcel->setActiveSheetIndex(0)->insertNewRowBefore($base , $cont-1);	

		reset($vetor);
		while(list($key, $value) = each($vetor)){
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. ($base + $key), $value[$key]['B']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. ($base + $key), $value[$key]['H']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. ($base + $key), $value[$key]['K']);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. ($base + $key), $value[$key]['N']);
		  }  

$objPHPExcel->setActiveSheetIndex(0)->removeRow($base - 1,1);
//$objPHPExcel->setActiveSheetIndex(0)->removeRow($base + ($cont-1),1);

// SAÍDA PARA ARQUIVO EXCEL
if(!isset($_GET['disabled']))
  {
	  
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/RELATORIO_PROD_CORRETOR_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/RELATORIO_PROD_CORRETOR_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/RELATORIO_PROD_CORRETOR_".$periodo1.".xlsx");
  }
  
$sql_apaga2 = "DROP TABLE ".$bancoDados.".solicitacao_tempRel";	
$result_apaga2 = mysql_query($sql_apaga2,$db);  
  
exit(0);
// FIM -----> SAÍDA PARA ARQUIVO EXCEL
?>
