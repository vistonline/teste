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
$objPHPExcel = $objReader->load("template/modelo_frustrada".$_SESSION['roteirizador'].".xlsx");    

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

$base = 8;
$cont0 = 0;
$cont1 = 0;
$cont2 = 0;
$cont3 = 0;
$cont4 = 0;
$cont5 = 0;
$cont6 = 0;
$cont7 = 0;
$cont8 = 0;
$cont9 = 0;
$cont10 = 0;
$cont11 = 0;
$cont12 = 0;
$cont13 = 0;
$cont14 = 0;
$cont15 = 0;
$cont16 = 0;
$cont17 = 0;
$cont18 = 0;
$cont50 = 0;



if($_POST['seguradora']=='todas'){
	$seguradora="";
	}else{
		$seguradora=" AND s.cliente='".$_POST['seguradora']."' ";
		}
		
if($_POST['filial']==''){
	$filial="";
	}else{
		$filial=" AND u.filial='".$_POST['filial']."' ";
		}		

$sql1 = "SELECT s.cliente,s.dia,s.id,s.proposta,s.voucher,s.protocolo,s.agendamento,s.numero_inspecao ,s.numero_mapfre,s.numero_laudo_informado,s.nome_c,s.cidade,s.estado,s.modelo,s.marca_modelo,s.placa,s.chassi,s.numero_susep,s.cd_corretor,s.corretor, u.nome, u.filial, f.data, f.hora, f.mensagem FROM ".$bancoDados.".solicitacao s, ".$bancoDados.".frustada f, ".$bancoDados.".user u WHERE s.id=RIGHT(f.id,8) AND s.controle_prest=u.id AND s.roteirizador=".$_SESSION['roteirizador']." AND s.checado=2 AND s.dia>=".$data_inicio." AND s.dia<=".$data_fim." ".$seguradora." ".$filial." AND f.motivo NOT IN ('80','00')
UNION 
SELECT s.cliente, s.dia, f.id, s.proposta,s.voucher,s.protocolo,s.agendamento, s.numero_inspecao, s.numero_mapfre, s.numero_laudo_informado, s.nome_c, s.cidade, s.estado, s.modelo, s.marca_modelo, s.placa, s.chassi, s.numero_susep, s.cd_corretor, s.corretor, u.nome, u.filial, f.data, f.hora, f.mensagem
FROM ".$bancoDados.".solicitacao s, ".$bancoDados.".frustada f, ".$bancoDados.".user u
WHERE s.id = RIGHT( f.id, 8 ) 
AND s.controle_prest = u.id
AND s.roteirizador =".$_SESSION['roteirizador']."
AND LEFT( f.id, 2 ) =  '#_'
AND s.dia>=".$data_inicio." AND s.dia<=".$data_fim." ".$seguradora." ".$filial."
AND f.motivo NOT IN ('80','00')";  
$result_sql1 = mysql_query($sql1,$db);

if(mysql_num_rows($result_sql1)==0){   
  echo "<h1><center>Nenhum agendamento FRUSTRADO para este cliente no período solicitado!</center></h1>";
?>
<center><input type="button" value="Fechar" onclick="window.history.back(-1);"></center>
<?
	exit();
	}


while ($array = @mysql_fetch_array($result_sql1)){

/*
//verifica se tem foto
$sql_foto = "SELECT id FROM ".$bancoDados.".fotos_temp WHERE id=".$array['id']." ";
$result_sql_foto = mysql_query($sql_foto ,$db);
$result_foto = @mysql_fetch_array($result_sql_foto);
*/

//verifica se tem foto
$sql_foto = "SELECT id FROM ".$bancoDados.".fotos WHERE id=".$array['id']." ";
$result_sql_foto = mysql_query($sql_foto ,$db);
$result_foto = @mysql_fetch_array($result_sql_foto);

//verifica filial
$sql_filial = "SELECT nome_filial FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial=".$array['filial']." ";
$result_sql_filial = mysql_query($sql_filial ,$db);
$result_filial = @mysql_fetch_array($result_sql_filial);

if($result_foto['id']!=''){
	$foto="SIM";
	}else{
		$foto="NÃO";
		}
		
$data = $array['dia']{6}.$array['dia']{7}."/".$array['dia']{4}.$array['dia']{5}."/".$array['dia']{0}.$array['dia']{1}.$array['dia']{2}.$array['dia']{3};	
$data_frustrada = $array['data']{6}.$array['data']{7}."/".$array['data']{4}.$array['data']{5}."/".$array['data']{0}.$array['data']{1}.$array['data']{2}.$array['data']{3};


 if (  $array['cliente']== 'ALFA SEGUROS')//SEGURADORA ALFA SEGUROS   utf8_encode()
      {
		$vetor0[] = Array($cont0 => Array(
                                  "A" => $cont0+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['voucher']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper($array['nome_c']),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont0++;

	  } //FIM (IF) SEGURADORA ALFA SEGUROS
	  
	 elseif ($array['cliente']=='ALLIANZ')//SEGURADORA ALLIANZ
      {
		$vetor1[] = Array($cont1 => Array(
                                  "A" => $cont1+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['protocolo']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont1++;

	  } //FIM (IF) SEGURADORA ALLIANZ
	  
	   elseif ($array['cliente']=='BB SEGUROS')//SEGURADORA BB SEGUROS
      {
		$vetor2[] = Array($cont2 => Array(
                                  "A" => $cont2+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont2++;

	  } //FIM (IF) BB SEGUROS
	  
	  elseif ($array['cliente']=='CAIXA SEGURADORA')//SEGURADORA CAIXA SEGURADORA
      {
		$vetor3[] = Array($cont3 => Array(
                                  "A" => $cont3+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_mapfre']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont3++;

	  } //FIM (IF) CAIXA SEGURADORA
	  
	  elseif ($array['cliente']=='HDI')//SEGURADORA HDI
      {
		$vetor4[] = Array($cont4 => Array(
                                  "A" => $cont4+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont4++;

	  } //FIM (IF) HDI
	  
	  elseif ($array['cliente']=='MAPFRE SEGUROS')//SEGURADORA MAPFRE SEGUROS
      {
		$vetor5[] = Array($cont5 => Array(
                                  "A" => $cont5+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_mapfre']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont5++;

	  } //FIM (IF) MAPFRE SEGUROS
	  
	  elseif ($array['cliente']=='WARRANTY')//SEGURADORA  WARRANTY
      {
		$vetor6[] = Array($cont6 => Array(
                                  "A" => $cont6+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_mapfre']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont6++;

	  } //FIM (IF) MAPFRE  WARRANTY
	  
	  elseif ($array['cliente']=='MITSUI')//SEGURADORA MITSUI
      {
		$vetor7[] = Array($cont7 => Array(
                                  "A" => $cont7+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_inspecao']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['cd_corretor'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['marca_modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont7++;

	  } //FIM (IF) MITSUI
	  
	  elseif ($array['cliente']=='NOBRE')//SEGURADORA NOBRE
      {
		$vetor8[] = Array($cont8 => Array(
                                  "A" => $cont8+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont8++;

	  } //FIM (IF) NOBRE
	  
	  elseif ($array['cliente']=='ZURICH')//SEGURADORA ZURICH
      {
		$vetor9[] = Array($cont9 => Array(
                                  "A" => $cont9+1,
                                  "B" => $array['id'], 
								  "C" =>" ". strtoupper($array['numero_laudo_informado']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['cd_corretor'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont9++;

	  } //FIM (IF) ZURICH
	  
	  elseif ($array['cliente']=='Bradesco Seguros')//SEGURADORA Bradesco Seguros
      {
		$vetor10[] = Array($cont10 => Array(
                                  "A" => $cont10+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont10++;

	  } //FIM (IF) Bradesco Seguros
	  
	  elseif ($array['cliente']=='MARITIMA')//SEGURADORA MARITIMA
      {
		$vetor12[] = Array($cont12 => Array(
                                  "A" => $cont12+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_inspecao']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont12++;

	  } //FIM (IF) MARITIMA  
	  
	   elseif ($array['cliente']=='SUL AMERICA')//SEGURADORA SUL AMERICA
      {
		$vetor13[] = Array($cont13 => Array(
                                  "A" => $cont13+1,
                                  "B" => $array['id'], 
								  "C" =>" ". strtoupper(''.$array['proposta'].''),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['cd_corretor'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont13++;

	  } //FIM (IF) SUL AMERICA
	  
	  elseif ($array['cliente']=='LIBERTY')//SEGURADORA LIBERTY
      {
		$vetor14[] = Array($cont14 => Array(
                                  "A" => $cont14+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['agendamento']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont14++;

	  } //FIM (IF) LIBERTY
	  
	  elseif ($array['cliente']=='TOKIO MARINE')//TOKIO MARINE
      {
		$vetor15[] = Array($cont15 => Array(
                                  "A" => $cont15+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont15++;

	  } //FIM (IF) TOKIO MARINE
	  
	  elseif ($array['cliente']=='PORTO SEGURO')// PORTO SEGURO
      {
		$vetor16[] = Array($cont16 => Array(
                                  "A" => $cont16+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['numero_laudo_informado']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont16++;

	  } //FIM (IF) PORTO SEGURO
	  
	    elseif ($array['cliente']=='GENERALI')// GENERALI
      {
		$vetor17[] = Array($cont17 => Array(
                                  "A" => $cont17+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont17++;

	  } //FIM (IF) GENERALI
	  
	  elseif ($array['cliente']=='YASUDA SEGUROS')// YASUDA MARÍTIMA
      {    
		$vetor18[] = Array($cont18 => Array(
                                  "A" => $cont18+1,
                                  "B" => $array['id'], 
								  "C" => " ".strtoupper($array['proposta']),
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont18++;

	  } //FIM (IF) YASUDA MARÍTIMA
	  
	   else{
		$vetor11[] = Array($cont11 => Array(
                                  "A" => $cont11+1,
                                  "B" => $array['id'], 
								  "C" => $array['cliente'],
								  "D" => utf8_encode($foto),
                                  "E" => strtoupper(utf8_encode($array['nome_c'])),
                                  "F" => $data,
                                  "G" => $array['numero_susep'],
								  "H" => strtoupper(utf8_encode($array['corretor'])),
								  "I" => utf8_encode($array['modelo']),
								  "J" => strtoupper($array['placa']),
								  "K" => strtoupper($array['chassi']),
								  "L" => strtoupper(utf8_encode($array['nome'])),
								  "M" => strtoupper(utf8_encode($array['cidade'])),
								  "N" => strtoupper(utf8_encode($result_filial['nome_filial'])),
								  "O" => strtoupper($array['estado']),
								  "P" => $data_frustrada,
								  "Q" => strtoupper($array['hora']),
								  "R" => strtoupper(utf8_encode(urldecode($array['mensagem'])))
                               ));

        $cont11++;

	  } //FIM (ELSE)

$cont50++;

	}

include "nomePrestadoraRel.php";
 
$numberABA=0;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Plan1"); 
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle("Plan2");    
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setTitle("Plan3"); 
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->setTitle("Plan4"); 
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->setTitle("Plan5"); 
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->setTitle("Plan6"); 
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->setTitle("Plan7"); 
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->setTitle("Plan8"); 
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->setTitle("Plan9"); 
$objPHPExcel->setActiveSheetIndex(9);
$objPHPExcel->getActiveSheet()->setTitle("Plan10");  
$objPHPExcel->setActiveSheetIndex(10);
$objPHPExcel->getActiveSheet()->setTitle("Plan11"); 
$objPHPExcel->setActiveSheetIndex(11);
$objPHPExcel->getActiveSheet()->setTitle("Plan12"); 
$objPHPExcel->setActiveSheetIndex(12);
$objPHPExcel->getActiveSheet()->setTitle("Plan13"); 
$objPHPExcel->setActiveSheetIndex(13);
$objPHPExcel->getActiveSheet()->setTitle("Plan14"); 
$objPHPExcel->setActiveSheetIndex(13);
$objPHPExcel->getActiveSheet()->setTitle("Plan15");

if(sizeof($vetor0)>0){
		
// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('ALFA SEGUROS'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);
 
// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont0-1); 


  foreach ($vetor0 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('ALFA SEGUROS');		  
}	


if(sizeof($vetor1)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('ALLIANZ'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont1-1); 
  foreach ($vetor1 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;		  
$objPHPExcel->getActiveSheet($numberABA)->setTitle('ALLIANZ');
}	

if(sizeof($vetor2)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('BB SEGUROS'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont2-1); 
  foreach ($vetor2 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('BB SEGUROS');		  
}	

if(sizeof($vetor3)>0){
	
// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('CAIXA SEGURADORA'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont3-1); 
  foreach ($vetor3 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('CAIXA SEGURADORA');	  
}	

if(sizeof($vetor4)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('HDI'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont4-1); 
  foreach ($vetor4 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('HDI');		     
}	


if(sizeof($vetor5)>0){
	
// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('MAPFRE SEGUROS'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont5-1); 
  foreach ($vetor5 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('MAPFRE SEGUROS');		  
}	

if(sizeof($vetor6)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('WARRANTY'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont6-1); 
  foreach ($vetor6 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('WARRANTY');
}	

if(sizeof($vetor7)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('MITSUI'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont7-1); 
  foreach ($vetor7 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('MITSUI');	  
}	

if(sizeof($vetor8)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('NOBRE'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont8-1); 
  foreach ($vetor8 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('NOBRE');	  
}	

if(sizeof($vetor9)>0){
		
// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('ZURICH'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont9-1); 
  foreach ($vetor9 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('ZURICH');	  
}	

if(sizeof($vetor10)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('Bradesco Seguros'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont10-1); 
  foreach ($vetor10 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('Bradesco Seguros');		  
}	

if(sizeof($vetor12)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('MARITIMA'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont12-1); 
  foreach ($vetor12 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('MARITIMA');		  
}	

if(sizeof($vetor13)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('SUL AMERICA'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont13-1); 
  foreach ($vetor13 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('SUL AMERICA');		  
}	

if(sizeof($vetor14)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('LIBERTY'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont14-1);
  foreach ($vetor14 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('LIBERTY');	  
}	

if(sizeof($vetor15)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('TOKIO MARINE'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont15-1);
  foreach ($vetor15 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('TOKIO MARINE');	  
}	

if(sizeof($vetor16)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('PORTO SEGURO'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont16-1);
  foreach ($vetor16 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('PORTO SEGURO');	  
}	

if(sizeof($vetor17)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('GENERALI'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont17-1);
  foreach ($vetor17 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('GENERALI');	  
}	

if(sizeof($vetor18)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('YASUDA MARITIMA'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont18-1);
  foreach ($vetor18 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;	
$objPHPExcel->getActiveSheet($numberABA)->setTitle('YASUDA MARITIMA');	  
}


if(sizeof($vetor11)>0){

// Define o título da planilha 
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F2', utf8_encode('OUTRAS'));
$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F4', $periodo);

// VAMOS ESCREVER NO EXCEL
$objPHPExcel->setActiveSheetIndex($numberABA)->insertNewRowBefore($base , $cont11-1); 
  foreach ($vetor11 as $key => $value){

if(substr($value[$key]['B'],0,2)=='#_'){	   
$objPHPExcel->setActiveSheetIndex($numberABA)->getStyle( 'A'.($base + $key).':R'.($base + $key) )->applyFromArray(array('font' => array('bold' => true)));
}
	  
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

$objPHPExcel->setActiveSheetIndex($numberABA)->setCellValue('F5', utf8_encode(strtoupper($nome_empresa)));
$objPHPExcel->setActiveSheetIndex($numberABA)->removeRow($base - 1,1);
$numberABA++;
$objPHPExcel->getActiveSheet($numberABA)->setTitle('OUTRAS');		  
}	


$ultimaAba=$numberABA;    
    
####################################### REMOVENDO ABAS NÃO UTILIZADAS ######################################
for($i=$ultimaAba; $i<=14; $i++){
$objPHPExcel->setActiveSheetIndex($i)->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
}
############################################################################################################

 
$periodo1 = strtr($periodo, array("/"=>"-"));
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
#$objWriter->save('php://output');
$objWriter->save("relatoriosTemporarios/RELATORIO_FRUSTRADAS_".$empresa."_".$periodo1.".xlsx");

downloadFile( "relatoriosTemporarios/RELATORIO_FRUSTRADAS_".$empresa."_".$periodo1.".xlsx" );

unlink("relatoriosTemporarios/RELATORIO_FRUSTRADAS_".$empresa."_".$periodo1.".xlsx");


################ APAGANDO TABELAS TEMPORÁRIAS CASO EXISTAM ####################

/*$sql_apaga2 = "DROP TABLE ".$bancoDados.".solicitacao_temp";	
$result_apaga2 = mysql_query($sql_apaga2,$db);

$sql_apaga3 = "DROP TABLE ".$bancoDados.".frustada_temp";	
$result_apaga3 = mysql_query($sql_apaga3,$db);

$sql_apaga4 = "DROP TABLE ".$bancoDados.".fotos_temp";	
$result_apaga4 = mysql_query($sql_apaga4,$db);
*/
###############################################################################

exit(0);
?>