<?
include "../../adm/conecta.php";
include "../verifica.php";
session_start();

function retirar_acentos($string){
      $a = '��������������������������������������������������������������Rr';
      $b = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYBSAAAAAAACEEEEIIIIDNOOOOOOUUUYYBYRR';
      //$string = utf8_decode($string);
      $string = strtr($string, $a, $b); // Retira os Acentos das Letras.
      return $string; // Retorna a String transformada
}

ini_set("memory_limit","900M");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Atualizar Postos Tokio Marine</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style3 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FF0000;
	}
.style2 {font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #003399;
}
</style>
</head>

<body>
<form action="#" method="post" enctype="multipart/form-data" name="RTEDemo">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Atualizar Postos Tokio Marine</td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;Insira o arquivo no formato XLSX</td>
    <td> <div align="left" class="style12">
      &nbsp;
      <input type="file" name="Filedata" id="Filedata" />
      </div></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;&nbsp;<span class="style12">C&oacute;digo prestadora</span></td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="cod_prest" class="style12" id="cod_prest">
        
        <?
		if($_SESSION['roteirizador']=='123' && $_SESSION['id']=='123' ){
			echo '<option value="">Selecione a prestadora</option>';
			$sql_clientes = "SELECT roteirizador FROM webvist.controle_vp_ferramentas WHERE id>0 order by nomeVistoriadora";
			$result_clientes = mysql_query($sql_clientes,$db);
			while($clientes = mysql_fetch_array($result_clientes))
			{
			$sql_user_sul = "SELECT u.empresa,u.id FROM webvist_".$clientes['roteirizador'].".user u, webvist_".$clientes['roteirizador'].".controle_vp_seguradoras c WHERE u.roiterizador=c.codigo_companhia AND u.id = u.roiterizador AND c.nome_seguradora=69";
			$result_user_sul = mysql_query($sql_user_sul,$db);
			while($user = mysql_fetch_array($result_user_sul))
			{
			?>
            
			<option value="<? echo $user['id'];?>"><? echo $user['empresa'];?></option>
			<?
			}
			}
				}else{
					$sql_user_sul = "SELECT empresa,id FROM ".$bancoDados.".user WHERE id = roiterizador";
					$result_user_sul = mysql_query($sql_user_sul,$db);
					while($user = mysql_fetch_array($result_user_sul))
					{
					?>
					<option value="<? echo $user['id'];?>" selected="selected"><? echo $user['empresa'];?></option>
					<?
					}
				}
		?>
        </select>
    </div></td>
  </tr>
  <tr> 
    <td height="50" colspan="2">
     <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="window.top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/atualizar.png" name="Submit" id="button" title="Atualizar" />
	</div>
     </td>
  </tr>
</table>
</form><?
if($_FILES)
{

$arquivo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".xlsx";
move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
$arquivoNovo = "atualizacoesTemp/".date('Ymd')."-".$_SESSION['roteirizador']."-".$_SESSION['id'].".csv";

require_once 'Classes/PHPExcel/IOFactory.php';

// IDENTIFICA O FORMADO DO ARQUIVO
$fileType=PHPExcel_IOFactory::identify($arquivo);

$excel = PHPExcel_IOFactory::load($arquivo);
$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer->setDelimiter(";");
$writer->setEnclosure("");
$writer->setLineEnding("\n");
$writer->save($arquivoNovo);



// L� O ARQUIVO
$objPHPExcelReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcelReader->load($arquivo);
// IDENTIFICA O CRIADOR DO ARQUIVO
$criador = $objPHPExcel->getProperties()->getCreator();


//lemos o arquivo
$fp = fopen($arquivoNovo,'r');
$texto = fread($fp, filesize($arquivoNovo));

//transformamos as quebras de linha em etiquetas <br>
$texto = nl2br($texto);
$array = split("\n",$texto);

$criadorRecebido=$criador;
$fileTypeRecebido=$fileType;
$conteudoRecebido=substr($array[0],0,190);

$criadorEsperado='Robson';
$fileTypeEsperado='Excel2007';
$conteudoEsperado='telefone2;uf;indicadorAtendeCaminhao;horario1 (limite 40 );telefone1;referencia (limite 20 );codigo;indicadorPostoAtivo;bairro;cidade;cep;email;horario2(limite 40 );nome(limite 40 );endereco';
 
if( ($criadorRecebido==$criadorEsperado) && ($fileTypeRecebido==$fileTypeEsperado) && ($conteudoRecebido==$conteudoEsperado) ){

$sql5 = "SELECT * FROM webvist_".$_POST['cod_prest'].".controle_vp_seguradoras WHERE codigo_companhia = ".$_POST['cod_prest']." AND nome_seguradora = '69'";
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$codPestadora = $seguradora[idusuario];
$senha = $seguradora[pswusuario];
 
 $contador=1;
 $contador1=1;
 for($i=0;next($array);$i++)
   {
	   $array_csv = split(";",$array[$contador]);

	   if(strlen(trim($array_csv[0]))>=5)
	   {

   
	$xmlPosto.='        <ns1:postos>
                    <ns1:telefone2>'.strtr(trim($array_csv[0]),array("("=>"", ")"=>"", "-"=>"", "<br />"=>"", "\n"=>"", "\r\n"=>"")).'</ns1:telefone2>
                    <ns1:uf>'.trim($array_csv[1]).'</ns1:uf>
                    <ns1:indicadorAtendeCaminhao>'.trim($array_csv[2]).'</ns1:indicadorAtendeCaminhao>
                    <ns1:horario1>'.strtr(trim($array_csv[3]),array("-"=>"/" ,"SEXTA"=>"SEX", "07"=>"7", "08"=>"8", "09"=>"9", "AS"=>"-", "AO"=>"-")).'</ns1:horario1>
                    <ns1:telefone1>'.strtr(trim($array_csv[4]),array("("=>"", ")"=>"", "-"=>"")).'</ns1:telefone1>
                    <ns1:referencia>'.substr(retirar_acentos(trim($array_csv[5])),0,20).'</ns1:referencia>
                    <ns1:codigo>'.trim($array_csv[6]).'</ns1:codigo>
                    <ns1:indicadorPostoAtivo>'.strtr(trim($array_csv[7]),array("O"=>"0", "o"=>"0")).'</ns1:indicadorPostoAtivo>
                    <ns1:bairro>'.substr(strtr(retirar_acentos(trim($array_csv[8])),array("VILA"=>"VL", "JARDIM"=>"JD", "BAIRRO "=>"")),0,20).'</ns1:bairro>
                    <ns1:cidade>'.substr(retirar_acentos(trim($array_csv[9])),0,30).'</ns1:cidade>
                    <ns1:cep>'.strtr(trim($array_csv[10]),array("."=>"", "-"=>"")).'</ns1:cep>
                    <ns1:email>'.trim($array_csv[11]).'</ns1:email>
                    <ns1:horario2>'.strtr(trim($array_csv[12]),array("-"=>"/" ,"SABADO"=>"SAB", "07"=>"7", "08"=>"8", "09"=>"9", "AS"=>"-", "AO"=>"-")).'</ns1:horario2>
                    <ns1:nome>'.retirar_acentos(trim($array_csv[13])).'</ns1:nome>
                    <ns1:endereco>'.substr( strtr(retirar_acentos(trim($array_csv[14])),array('\n'=>'', '<bR />'=>'', '\r\n'=>'', '<br />'=>'')),0,55 ).'</ns1:endereco>
                </ns1:postos>
				';	   
  
	
		}
$contador++;
	if(mysql_affected_rows()==1)
	{
	$contador1++;
	}
$adicionado=$contador1-1;	
}
	
/*		
if($_SESSION['id']==1){		   
echo '<textarea rows="5" cols="150">'.$xmlPosto.'</textarea>';
exit();
}
*/

$atualzarPosto='<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body xmlns:ns1="http://www.tokiomarine.com.br">
        <ns1:enviarListaPostos>
            <ns1:parametroEnvioListaPostos>
                <ns1:codigoAgrupamentoPrestadora>'.$codPestadora.'</ns1:codigoAgrupamentoPrestadora>
				'.$xmlPosto.'
                <ns1:senha>'.$senha.'</ns1:senha>
            </ns1:parametroEnvioListaPostos>
        </ns1:enviarListaPostos>
    </soap:Body>
</soap:Envelope>';

	/*
if($_SESSION['id']==1){		   
echo '<textarea rows="5" cols="150">'.$atualzarPosto.'</textarea>';
exit();
}
*/

// faz conex�o via CURL
$urlHomologacao='https://aceite.tokiomarine.com.br/VistoriaPreviaWS/br.com.tokiomarine.seguradora.ssv.vistoriaprevia.ws.RecepcaoVistoriaPreviaService';
$urlProducao='https://ssvweb.tokiomarine.com.br/VistoriaPreviaWS/br.com.tokiomarine.seguradora.ssv.vistoriaprevia.ws.RecepcaoVistoriaPreviaService';

    define('XML_POST_URL', $urlProducao.'?invoke=');
    $ch3 = curl_init();
    curl_setopt($ch3, CURLOPT_URL, XML_POST_URL );
    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch3, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/xml'));
    curl_setopt($ch3, CURLOPT_POSTFIELDS, "contentType=text/xml&messageText=".$atualzarPosto."&mode=xml&operationName=enviarListaPostos&portName=br.com.tokiomarine.seguradora.ssv.vistoriaprevia.ws.RecepcaoVistoriaPreviaService&reliability=true&security=true&serviceName=RecepcaoVistoriaPreviaService&serviceNamespace=http://www.tokiomarine.com.br&soapAction=enviarListaPostos&soapAction_cb=on&stress_delay=1000&stress_loopCount=5&stress_threadCount=10");

    $result3 = curl_exec($ch3);

//echo '<textarea rows="5" cols="150">'.$result3.'</textarea>';
//exit();
	
@mkdir('../laudo/xml_tokioMarine',0777);
@mkdir('../laudo/xml_tokioMarine/atualizaPostos',0777);
@mkdir('../laudo/xml_tokioMarine/atualizaPostos/'.$seguradora['codigo_companhia'],0777);
@mkdir('../laudo/xml_tokioMarine/atualizaPostos/'.$seguradora['codigo_companhia'].'/'.date('Y'),0777);
@mkdir('../laudo/xml_tokioMarine/atualizaPostos/'.$seguradora['codigo_companhia'].'/'.date('Y').'/'.date('m'),0777);
@mkdir('../laudo/xml_tokioMarine/atualizaPostos/'.$seguradora['codigo_companhia'].'/'.date('Y').'/'.date('m').'/'.date('d'),0777);

$arquivo2 = '../laudo/xml_tokioMarine/atualizaPostos/'.$seguradora['codigo_companhia'].'/'.date('Y').'/'.date('m').'/'.date('d').'/'.date('Hisu').$seguradora['codigo_companhia'].'.xml';

preg_match('/(<ns0:enviarListaPostosResponse[^|]{1,}enviarListaPostosResponse>)/i',  $result3, $resultSaida2);
   
$xmlTratado2=strtr($resultSaida2[1], array('<\/'=>'</', 'ns0:'=>'', ' xsi:nil="1"'=>'', '&'=>'&amp;'));

if (!$abrir2 = fopen($arquivo2, "a")) {
			echo  "Erro abrindo arquivo ($arquivo)";
			exit();
}
if (!fwrite($abrir2, trim($xmlTratado2))) 
			{
		        print "Erro escrevendo no arquivo ($arquivo)";
		        exit();
		    }
fclose($abrir2);

//echo "<br /><br /><center>".$xmlTratado2."</center>";
//exit();

if (!($fp2 = fopen($arquivo2, "r"))) {}
$data2 = fread($fp2, filesize($arquivo2));
fclose($fp2);

$xml2 = new SimpleXMLElement($data2);

foreach($xml2->retornoAtualizaListaPostos as $xml_elem2)  
						{
						if($xml_elem2->statusRetorno==0){
							
							echo '<br><h1>Mensagem => '.$xml_elem2->mensagem.'</h1>';
							
							}else{
								
								echo '<br><h1>Mensagem => ERRO - Postos n&atilde;o atualizados!<br/>'.$xml_elem2->mensagem.'</h1>';
								
								}
							
							
							}
$obs="Arquivo atualizado com SUCESSO! ";
unlink($arquivo);
unlink($arquivoNovo);
}else{
	
	$arquivo = "atualizacoesTemp/atualizar_posto_tokio - ".$_SESSION['roteirizador'] . " - hora - ".date('H:i')." - " . $_FILES['Filedata']['name'];
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $arquivo);
	$ponteiroArquivo = fopen($arquivo, "r");

	$problemaIdentificado='';
	if($criadorRecebido!='Robson'){
		$problemaIdentificado.='Arquivo n&atilde;o &eacute; o arquivo original<br>';
		}   
	if($conteudoRecebido!='telefone2;uf;indicadorAtendeCaminhao;horario1 (limite 40 );telefone1;referencia (limite 20 );codigo;indicadorPostoAtivo;bairro;cidade;cep;email;horario2(limite 40 );nome(limite 40 );endereco'){
		$problemaIdentificado.='Conte&uacute;do do arquivo inv&aacute;lido<br>';
		}
		if($fileTypeRecebido!='Excel2007'){
		$problemaIdentificado='Arquivo com formato inv&aacute;lido<br>';
		}
		
	echo "<center><h1>O arquivo enviado n&atilde;o foi aceito. Motivo(s):</h1><h3><br> ".$problemaIdentificado."<br>Informe o administrador do sistema.<h3></center>";
	
	
	$obs=$problemaIdentificado;

	}

##################################################### REGISTRA UPLOAD ##################################################################################
include "../class.log.php";
try{
$registra = new registraLog();
$registra->upload($_SERVER['REMOTE_ADDR'],"relatorio/","atualizar_posto_tokio.php",$_FILES['Filedata']["name"],$_SESSION['id'],$_SESSION['permissao'],$obs );
}
catch(Exception $erro)
  {
    echo $erro;
  }
#######################################################################################################################################################

}


?>
</body>
</html>
