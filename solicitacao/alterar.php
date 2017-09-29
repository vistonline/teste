<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head><style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
-->
</style>
<body bgcolor="#5C5C5C">
<?
include "../../adm/conecta.php";
include "../verifica.php";
//busca data da realização



$tiraAcentos=array('%E1' => 'a','%E0' => 'a','%E3' => 'a','%E2' => 'a','%E9' => 'e','%EA' => 'e','%ED' => 'i','%F3' => 'o','%F4' => 'o',
'%F5' => 'o','%FA' => 'u','%E7' => 'c','%C1' => 'A','%C0' => 'A','%C3' => 'A','%C2' => 'A','%C9' => 'E','%CA' => 'E','%CD' => 'I','%D3' => 'O','%F4' => 'O','%D5' => 'O','%DA' => 'U','%C7' => 'C','%21' => '!','%2A' => '*','%28' => '(','%29' => ')','%3B' => ';','%3A' => ':',																	 '%40' => '@','%26' => '&','%3D' => '=','%2B' => '+','%24' => '$','%2C' => ',','%2F' => '/','%3F' => '?','%25' => '%','%23' => '#','%5B' => '[','%5D' => ']','&' => 'e','u00e1'=>'a','u00e0'=>'a','u00e2'=>'a','u00e3'=>'a','u00e4'=>'a','u00c1'=>'A','u00c0'=>'A','u00c2'=>'A','u00c3'=>'A','u00c4'=>'A','u00e9'=>'e','u00e8'=>'e','u00ea'=>'e','u00ea'=>'e','u00c9'=>'E','u00c8'=>'E','u00ca'=>'E','u00cb'=>'E','u00ed'=>'i','u00ec'=>'i','u00ee'=>'i','u00ef'=>'i','u00cd'=>'I','u00cc'=>'I','u00ce'=>'I','u00cf'=>'I','u00f3'=>'o','u00f2'=>'o','u00f4'=>'o','u00f5'=>'o','u00f6'=>'o','u00d3'=>'O','u00d2'=>'O','u00d4'=>'O','u00d5'=>'O','u00d6'=>'O','u00fa'=>'u','u00f9'=>'u','u00fb'=>'u','u00fc'=>'u','u00da'=>'U','u00d9'=>'U','u00db'=>'U','u00e7'=>'c','u00c7'=>'C','u00f1'=>'n','u00d1'=>'N','u0026'=>'&','u0027'=>'','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a','Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','é'=>'e','è'=>'e','ê'=>'e','ê'=>'e','É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i','Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','Ú'=>'U','Ù'=>'U','Û'=>'U','ç'=>'c','Ç'=>'C','ñ'=>'n','Ñ'=>'N','&'=>'&',"'"=>"", "`"=>"");

$data_realiza = $_POST['dia'];
$data_realiza2 = $data_realiza{6}.$data_realiza{7}.$data_realiza{8}.$data_realiza{9}.$data_realiza{3}.$data_realiza{4}.$data_realiza{0}.$data_realiza{1};

$sql_alterar_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = '".$_POST['id']."'";
$result_alterar_solicitacao = @mysql_query($sql_alterar_solicitacao,$db);
$solicitacao = @mysql_fetch_array($result_alterar_solicitacao);


if($solicitacao['cliente']=='PORTO SEGURO'){
	$CDCIA=$solicitacao['CDCIA'];
	}else{
		$CDCIA=$_POST['CDCIA'];
		}


// se alterou uma solicitação que já foi baixada pelo MOBILE, muda o status para 9 para quando sincronizar alterar os dados no MOBILE
if($solicitacao['status']==2){
	$mudaStatusMobile="status=9,";
	}else{
		$mudaStatusMobile="";
		}




if($solicitacao['roteirizador']==230){ // mantem vistoriador se data diferente
$controle_prest_arrumado = $solicitacao['controle_prest'];
	}else{
		
		if($solicitacao['dia']!==$data_realiza2)
		{
			$controle_prest_arrumado = 0;
		}
		else
		{
			$controle_prest_arrumado = $solicitacao['controle_prest'];
		}
		
	}
	


//se o valor do caractere 4 e 5 da data da realização for =! entaum pegar o ultimo dia do mes($lastday)
//$data_r = $reg[relizacao];
$data_r = $data_realiza2;
$mes_realizacao = $data_r{4}.$data_r{5};
$dia_realizacao = $data_r{6}.$data_r{7};
$mes_atual = date("m");
$dia_hj = date("d");
if ($mes_realizacao !== $mes_atual)
{
$mes = date("m")+1;
$ano = date("Y");                                                                                              
$lastday = mktime (0,0,0,$mes,0,$ano);
$ultimo_dia = strftime ( "%d", $lastday);
$dia_hj = date("d");
$qnt_falta = $ultimo_dia - $dia_hj;
}
//caractere 6 e 7 da data da realização + $qnt_falta = $qnt_falta_t
if ($mes_realizacao !== $mes_atual)
{
$qnt_falta_t = $dia_realizacao + $qnt_falta;
}
else {
$qnt_falta_t =  $dia_realizacao - $dia_hj;
}
//enquanto o $e(=1) for <= $d
$e = 0;
$dia_semana = date("w");
while ($e<=$qnt_falta_t){
//domingo começa pelo valor 0
//se o $dia_semana for = 7 
if ($dia_semana == 7)
{
$dia_semana = 0;
}
$dia_semana = $dia_semana+1;
$teste = $dia_semana - 1;
switch($teste){
case "0": $teste = "domingo"; break;
case "1": $teste = "segunda"; break;
case "2": $teste = "terca"; break;
case "3": $teste = "quarta"; break;
case "4": $teste = "quinta"; break;
case "5": $teste = "sexta"; break;
case "6": $teste = "sabado"; break;
}
$e++;
}

$cep = $_POST['cep'];
  $cep1_0 = $cep{0}.$cep{1}.$cep{2}.$cep{3}.$cep{4};
  $cep2_0 = $cep{5}.$cep{6}.$cep{7};
  $sql55 = "SELECT * FROM ".$bancoDados.".regiao_atuacao WHERE ".$teste." LIKE '%".$_POST['bairro']."%'";	
 $resultado55 = @mysql_query($sql55,$db);
 $reg55 = @mysql_fetch_array($resultado55);
 

$editado = "controle_alteracao = '".$_SESSION['id']."',
data_alteracao = '".date("Ymd")."',
hora_alteracao = '".intval(date("Hi"))."',";   


// Atualizar Status Tokio Marine
$trocarStatus_Tokio="";
if( $solicitacao['cliente']=='TOKIO MARINE' && $solicitacao['tipo_solicitante']!='P' ){
	
		if($_SESSION['roteirizador']=='1786' && ($controle_prest_arrumado=='4095' || $controle_prest_arrumado=='4096' || $controle_prest_arrumado=='3341' || $controle_prest_arrumado=='3555' || $controle_prest_arrumado=='3358' || $controle_prest_arrumado=='3369')){  
		
		// NÃO MUDA STATUS DESTES VISTORIADORES
			
	###################### E-MAIL PARA MONITORAMENTO #################################
		if($trocarStatus_Tokio!=''){
		// envia e-mail
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "VISTONLINE MONITORMENTO TOKIO MARINE (RGD)  ";
        $headers = "From: < monitoramento.tokio@vtnet.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Solicitacao: ".$_POST['id']."<br />troca -> ".$trocarStatus_Tokio;
        mail( $to, $subject, $message, $headers );
		}
##################################################################################
	}else{
	
	if($solicitacao['protocolo']=='VFR'){
		$trocarStatus_Tokio="protocolo ='RGD',
						   situacao ='',";
		$logStatus="Status alterado para RGD em: ".date('d/m/Y')." hora: ".date('H:i:s')."@";
		}
		elseif($solicitacao['dia']<$data_realiza2)
			{
			$trocarStatus_Tokio="protocolo ='RGD',
						   situacao ='',";
			$logStatus="Status alterado para RGD em: ".date('d/m/Y')." hora: ".date('H:i:s')."@";
			}
			elseif($solicitacao['dia']>$data_realiza2)
				{
				$trocarStatus_Tokio="protocolo ='RGD',
							   situacao ='',";
				$logStatus="Status alterado para RGD em: ".date('d/m/Y')." hora: ".date('H:i:s')."@";
				}else{
					$trocarStatus_Tokio="";
					}
###################### E-MAIL PARA MONITORAMENTO #################################
		/*if($trocarStatus_Tokio!=''){
		// envia e-mail
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "VISTONLINE MONITORMENTO TOKIO MARINE (RGD)  ";
        $headers = "From: < monitoramento.tokio@vtnet.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Solicitacao: ".$_POST['id']."<br />".$trocarStatus_Tokio;
        mail( $to, $subject, $message, $headers );
		}*/
##################################################################################
			
		} // trocar Status_Tokio
	}

// Atualizar Status LIBERTY
$trocarStatus_Liberty="";
if( $solicitacao['cliente']=='LIBERTY' ){
	
		if($solicitacao['dia']<$data_realiza2)
			{
			$trocarStatus_Liberty="protocolo ='12',
						   situacao ='',";
			}
			elseif($solicitacao['dia']>$data_realiza2)
				{
				$trocarStatus_Liberty="protocolo ='12',
							   situacao ='',";
				}else{
					$trocarStatus_Liberty="";
					}
					
###################### E-MAIL PARA MONITORAMENTO #################################
		/*if($trocarStatus_Liberty!=''){
		// envia e-mail
		$mime_boundary = "----".$_POST[nome]."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "VISTONLINE MONITORMENTO LIBERTY (12)  ";
        $headers = "From: < monitoramento.tokio@vtnet.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = "Solicitacao: ".$_POST['id']."<br />".$trocarStatus_Liberty;
        mail( $to, $subject, $message, $headers );
		}*/
##################################################################################

	}	
#################################### AJUSTANDO SUSEP ####################################################
if($_POST['cliente']=='ZURICH' || $_POST['cliente']=='SUL AMERICA'){
	if($_POST['susep']==''){
		$_POST['susep']=$_POST["CDCORRETOR"];
		}
	}
#########################################################################################################


if($_POST['cliente']=='ZURICH GARANTIA'){
	$_POST['observacao']=$_POST['reclamacao'];
	}

if($_POST['cliente']=='MAPFRE SEGUROS'){
	$SUCURSAL=$_POST['CDSUCURSAL'];
	}else{
		$SUCURSAL=$_POST['sucursal'];
		}

// NÃO ALTERAR DADOS DA SUCURSAL E VEICULO
if($solicitacao['cliente']=='ALLIANZ'){ 
$SUCURSAL=$solicitacao['sucursal'];
//$_POST['codigo']=$solicitacao['cod_veiculo'];
//$_POST['fabricante']=$solicitacao['marca'];
//$_POST['modelo']=$solicitacao['modelo'];
}

if($_POST['TelefonesPadrao']=='sim'){
	$alteraTelefones="telefone1 ='".$_POST['telefone1']."',
					  operadora = '".$_POST['operadora']."', 
					  ramal='".$_POST['ramal']."',
					  telefone2 ='".$_POST['telefone2']."',
					  operadora1 = '".$_POST['operadora1']."', 
					  ramal1='".$_POST['ramal1']."',
					  tel1 ='".$_POST['tel1']."',
					  operadora2 = '".$_POST['operadora2']."', 
					  ramal2='".$_POST['ramal2']."',
					  tel2 ='".$_POST['tel2']."',
					  operadora3 = '".$_POST['operadora3']."', 
					  ramal3='".$_POST['ramal3']."',
					  tel_corretor ='".$_POST['telefone_solicitante']."',
					  operadora4 = '".$_POST['operadora4']."', 
					  ramal4='".$_POST['ramal4']."',";
	}else{
		$alteraTelefones="tel1 ='".$_POST['telefone2']."',
						  tel2 ='".$_POST['telefone']."',
						  ramal='".$_POST['ramal']."',
						  telefone2='".$_POST['telefone_solicitante']."', 
						  operadora = '".$_POST['operadora']."',      
						  operadora1 = '".$_POST['operadora1']."',";
		}

if($_POST['cliente']=='PORTO SEGURO'){
	$VERSAO_VEICULO = "marca_modelo = '".$_POST['versao']."',";
	}else{
		$VERSAO_VEICULO='';
		}
		
if($_POST['cliente']=='HAWK' || $_POST['cliente']=='ENGER' || $_POST['cliente']=='NORDESTE' || $_POST['cliente']=='SINTESE SEGUROS'){
	$VERSAO_VEICULO = "marca_modelo = '".$_POST['produto']."',";
	$alteraProtocolo="protocolo = '".$_POST['protocolo']."',"; 
	}else{
		$VERSAO_VEICULO='';
		$alteraProtocolo="";
		}

if($_POST['cliente']=='Bradesco Seguros' && $solicitacao['audatex']==1 ){
	$FINALIDADE="";
	}elseif($_POST['cliente']=='ZURICH'||$_POST['cliente']=='MAPFRE SEGUROS'||$_POST['cliente']=='BB SEGUROS'){
		$FINALIDADE="motivo = '".utf8_decode($_POST['motivo'])."',";    
		}else{
			$FINALIDADE="motivo = '".$_POST['motivo']."',";
				}
			
$nomeSegurado=strtr($_POST['nome_c'],$tiraAcentos);

if($_POST['cod_corretor']!=''){
	$codInternoCorretor=$_POST['cod_corretor'];
	}else{
		$codInternoCorretor=$_POST['CDCORRETOR'];
		}



$sql1 = "UPDATE ".$bancoDados.".solicitacao SET 
nome_agencia = '".str_replace('"',' ',str_replace("'"," ",$_POST['nome_agencia']))."',
numero_mapfre='".$_POST['numero_mapfre']."', 
cliente='".$_POST['cliente']."', 
CDCIA='".$CDCIA."', 
".$editado."
".$trocarStatus_Tokio."
".$trocarStatus_Liberty."
".$alteraTelefones."
".$FINALIDADE."
".$mudaStatusMobile."
dia='".$data_realiza2."',
hora ='".$_POST['hora']."',
voucher = '".$_POST['voucher']."',
hora_marcada ='".$_POST['hora_marcada']."',
sucursal ='".$SUCURSAL."',
agencia ='".$_POST['agencia']."',
numero_susep ='".$_POST['susep']."',
corretor ='".strtr($_POST['corretor'],$tiraAcentos)."',
contato ='".strtr($_POST['contato'],$tiraAcentos)."',
cd_corretor ='".$codInternoCorretor."',
cep1 ='".$cep1_0."', 
avisado = '0',
controle_prest ='".$controle_prest_arrumado."',
cep2 ='$cep2_0', 
estado ='".$_POST['uf']."',
bairro ='".strtr($_POST['bairro'],$tiraAcentos)."',
cidade ='".strtr($_POST['cidade'],$tiraAcentos)."',
endereco ='".strtr($_POST['endereco'],$tiraAcentos)."',
numero ='".$_POST['numero']."',
complemento='".strtr($_POST['complemento'],$tiraAcentos)."', 
nome_c ='".strtr($nomeSegurado,array(","=>"","'"=>"","("=>"", ")"=>"","="=>"", "-"=>"",";"=>""))."',
cpf_cnpj ='".$_POST['cpf_cnpj']."',
cod_veiculo='".$_POST['codigo']."',
marca='".$_POST['fabricante']."',
modelo ='".$_POST['modelo']."',
".$VERSAO_VEICULO."
placa='".$_POST['placa']."', 
chassi ='".$_POST['chassi']."',
ano_fabricacao ='".$_POST['ano_fabricacao']."',
ano_modelo ='".$_POST['ano_modelo']."',
nome_s ='".strtr($_POST['nome_s'],$tiraAcentos)."',
email='".$_POST['email1'].",".$_POST['email2']."',  
proposta = '".$_POST['proposta']."',
".$alteraProtocolo." 
dia_semana='$teste',
cliente_bone='".$_POST['nomePrestadora']."',
numero_cliente_bone='".$_POST['empresaProdutora']."',
possuiValorKM='".$_POST['possuiValorKM']."',
valorKM='".strtr($_POST['valorKM'],",",".")."',
justificativaValorKM='".$_POST['justificativaValorKM']."',
instrucoes='".$_POST['instrucoes']."', 
regional='".$_POST['uf_session']."',
LOG  = '".$solicitacao["LOG"]." Solicitacao Alterada em: ".date("d/m/Y")." hora: ".date("H:i:s")." por: ".$_SESSION["nome"]."@".$logStatus."',
digito_controle_cdc='".$_POST['gold']."',
obs='".strtr($_POST['observacao'],$tiraAcentos)."' WHERE id = '".$_POST['id']."'";    


$result1 = @mysql_query($sql1,$db);
	if ($result1)
	{
	//completo o processo de alteração de laudo
	?>
	<table width="100%" border="00" cellspacing="0" cellpadding="0">
      <tr>
        <td height="140" colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="31">&nbsp;</td>
        <td width="200" bgcolor="#0066CC"><div align="center" class="style1">Altera&ccedil;&atilde;o realizada com sucesso!</div></td>
        <td>&nbsp;</td>
      </tr>
    </table>
	    <script language=javascript>
function fechar(){
if(document.all){
window.opener = window
window.close("#")
}else{
self.close();
}
}

setTimeout("fechar()",1500); 
</script> 

	<?
	}
	if (!$result1)
{
	
//Se nao funcionou
echo ("<font color='red'>Erro: ".mysql_error()."</font><br>");

		// envia e-mail em caso se falha SQL
		$mime_boundary = "----".$_POST['nome']."----".md5(time());
        $to = "robson.cassiano@vtnet.com.br";
        $subject = "VISTONLINE ALTERAR SOLICITAÇÃO - FALHA SQL  ";
        $headers = "From: < viston-line@vtnet.com.br >\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "--$mime_boundary\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n\n";
        $message = $sql1."<br>".mysql_error()."<hr>Placa => ".$_POST['placa']."<hr>";
        mail( $to, $subject, $message, $headers );

}


//voltando para a pagina de laudos não transmitidos
?>
	</body>
    </html>