<style type="text/css">
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


switch($_POST['SEGURADORA']){
	case 200: $associacao='sim'; break;
	case 201: $associacao='sim'; break;
	case 202: $associacao='sim'; break;
	case 203: $associacao='sim'; break;
	case 204: $associacao='sim'; break;
	case 205: $associacao='sim'; break;
	
	default: break;
	}

// ARRUMANDO O CONTROLE_PREST E ROTEIRIZADOR
$sql_integra = "SELECT NUMEROSOLICITACAO,roteirizador,controle_prest,controle_prest_filho FROM ".$bancoDados.".vistoria_previa1 WHERE NUMEROSOLICITACAO = ".$_POST['NUMEROSOLICITACAO']."";
$result_integra = mysql_query($sql_integra,$db);
$integracao = mysql_fetch_array($result_integra);

	
	if($integracao['controle_prest_filho']!=''){
		$controle_prest_filho=$integracao['controle_prest_filho'];
		$controle_roteirizador=$integracao['roteirizador'];
		}else{
			$controle_prest_filho='';
			$controle_roteirizador=$_POST['roteirizador_arrumado'];
			}
	
	$controle_prest=$_POST['controle_prest'];

// controle de cidade atendida

$dados_cidade=explode("<>",$_POST[cidade_atende]);
$cidade_atende=$dados_cidade[0];
$km_atende=$dados_cidade[1];
$preco_atende=$dados_cidade[2];

if ($_POST[cidade_atende]!=''){
	$preco=$preco_atende;
	$km_percorrido=$km_atende;
	$cidade_atende=$cidade_atende;
	}else{
	$preco=$_POST[PRECOVISTORIADOR];
	$km_percorrido=$_POST[km_percorrido];
	$cidade_atende="";
	}

//PODE FINALIZAR ANALISE
$sql_finalizaAnalise = "SELECT finalizarAutomatico FROM ".$bancoDados.".user WHERE id = ".$_SESSION['id']."";
$result_finalizaAnalise = mysql_query($sql_finalizaAnalise,$db);
$finalizaAnalise = mysql_fetch_array($result_finalizaAnalise);

//selecionando o prestador
$sql_prestador = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$controle_prest."";
$result_prestador = mysql_query($sql_prestador,$db);
$prestador = mysql_fetch_array($result_prestador);

//selecionando a filial para pegar a regiao correta
#$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prestador[filial]."' AND roteirizador=".$controle_roteirizador;
$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prestador[filial]."'AND roteirizador='".$prestador[roiterizador]."'";
$result_filial = mysql_query($sql_filial,$db);
$prestador_filial = mysql_fetch_array($result_filial);

$_SESSION["nome_seguradora"]=$_POST['SEGURADORA'];

include "../seguradora_nome.php";
$nome_seg=strtr($cliente_seguradora, array(" "=>"_", " & "=>"_", "."=>"", ));

// DIRETORIO PARA GARDAR OS ARQUIVOS
$diretorio='../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_POST['NUMEROSOLICITACAO'].'/';

for($i=0;$i<=30;$i++){ 
	// excluir arquivo
	if($_POST['remover_'.$i.'']!=''){
		$sql_excluir = "DELETE FROM ".$bancoDados.".attached_file WHERE contagem=".$_POST['remover_'.$i.''];
		//echo $sql_excluir."<br>";
		$result_excluir = mysql_query($sql_excluir,$db);
		}
}
   
if($_FILES)   
{
	

	for ($tamanho = count($_FILES['upload1']['name']), $indice = 0; $indice < $tamanho; $indice++){
	
	$type=$_FILES['upload1']['type'][$indice];
	$name=$_FILES['upload1']['name'][$indice];
	$tmp_name=$_FILES['upload1']['tmp_name'][$indice];
	$error=$_FILES['upload1']['error'][$indice];
	$size=$_FILES['upload1']['size'][$indice];
	
		// ARQUIVOS PERMITIDOS
		if($type=='image/jpeg'||$type=='image/png'||$type=='application/msword'||$type=='application/vnd.ms-excel'||$type=='application/pdf'||$type=='application/zip'||$type=='application/x-zip-compressed'){
			
			switch($type){
				case 'image/jpeg'				: $tipo=1; $tipoSaida='jpeg_'; $extSaida='.jpg'; break;
				case 'image/png'				: $tipo=2; $tipoSaida='png_'; $extSaida='.png'; break;
				case 'application/msword'		: $tipo=3; $tipoSaida='doc_'; $extSaida='.doc'; break;
				case 'application/vnd.ms-excel'	: $tipo=4; $tipoSaida='xls_'; $extSaida='.xls'; break;
				case 'application/pdf'			: $tipo=5; $tipoSaida='pdf_'; $extSaida='.pdf'; break;
				case 'application/zip'			: $tipo=6; $tipoSaida='zip_'; $extSaida='.zip'; break;
				case 'application/x-zip-compressed'			: $tipo=6; $tipoSaida='zip_'; $extSaida='.zip'; break;
				default: break;
				}
				
			$saida=$tipoSaida.$indice.$extSaida; 
			// CRIANDO ARVORE DE PASTAS
			@mkdir('../ATTACHED_FILE/', 0777);
			@chmod('../ATTACHED_FILE/', 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador, 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador, 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg, 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg, 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y'), 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y'), 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
			@mkdir('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_POST['NUMEROSOLICITACAO'], 0777);
			@chmod('../ATTACHED_FILE/rot_'.$controle_roteirizador.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_POST['NUMEROSOLICITACAO'], 0777);
			
			move_uploaded_file($tmp_name, $diretorio.$saida);
			
			$sql = "INSERT INTO ".$bancoDados.".attached_file (nome,nome_saida,tipo,id,data,hora) VALUES ('" . $name . "', '" . $saida . "', '" . $tipo . "', '" . $_POST['NUMEROSOLICITACAO'] . "','" . date('Ymd') . "','" . date('Hi') . "')";
			//echo $sql."<br>";
			$result = mysql_query($sql,$db);
			
			} // FIM ARQUIVOS VÁLIDOS
	
	} // FIM FOR

} // FIM $_FILES


    

if(strlen($_POST["cidade"])>1){
$municipio_vistoria = $_POST["cidade"];
}
else
{
$municipio_vistoria = $prestador_filial[cidade];
}

if(strlen($_POST["UF"])>1){
$uf_vistoria = $_POST["UF"];
}
else
{
$uf_vistoria = $prestador_filial[uf];
}


//Hora de Realização da Vistoria
$hora_realiza2 = $_POST[HRVISTORIA];
$hora_realiza = $hora_realiza2{0}.$hora_realiza2{1}.$hora_realiza2{3}.$hora_realiza2{4};

//data da Vistoria
$data_vistoria = $_POST[DTVISTORIA]{6}.$_POST[DTVISTORIA]{7}.$_POST[DTVISTORIA]{8}.$_POST[DTVISTORIA]{9}.$_POST[DTVISTORIA]{3}.$_POST[DTVISTORIA]{4}.$_POST[DTVISTORIA]{0}.$_POST[DTVISTORIA]{1};

//data do DUT
$data_dut = $_POST[DTDUT]{6}.$_POST[DTDUT]{7}.$_POST[DTDUT]{8}.$_POST[DTDUT]{9}.$_POST[DTDUT]{3}.$_POST[DTDUT]{4}.$_POST[DTDUT]{0}.$_POST[DTDUT]{1};


//arrumando os dados no caso de vistoria com nota fiscal
if(strlen($_POST[numero_nota])>=1)
{
$contem_nota = "#NOTA FISCAL NUMERO:".$_POST[numero_nota].",DATA DA NOTA FISCAL:".$_POST[data_nota_fiscal].",CONCESSIONARIA:".$_POST[concessionaria]."#";
$contem_obs_nota="99,";
} 

$inicio=1;
while($inicio<=30)
{
	//se ele for um opcional contem tamanho 1 ou 2
	if(strlen($_POST['opcional'.$inicio])==1||
	   strlen($_POST['opcional'.$inicio])==2)
	{
		$CDOPCIONAIS.=$_POST['opcional'.$inicio].',';
	}
	//se ele for um outro opcional contem tamanho maior que 4
	if(strlen($_POST['opcional'.$inicio])>=5)
	{
		$DSOUTROSOPCIONAIS.=$_POST['opcional'.$inicio].',';
	}
	

	//se ele for um acessório contem tamanho 4
	if(strlen($_POST['opcional'.$inicio])==4)
	{
		$acessorio_arrumado_de_opcional = str_replace("AC","",$_POST['opcional'.$inicio]);
		$CDACESSORIOS.=$acessorio_arrumado_de_opcional.',';
		switch($acessorio_arrumado_de_opcional)
		{
		case "10":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "11":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "12":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "13":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "14":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "15":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "16":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "17":$DSMARCA.="ORIGINAL,";break;
		case "18":$DSMARCA.="ORIGINAIS,";break;
		case "19":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "20":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "21":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "24":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "25":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "26":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "27":$DSMARCA.="ORIGINAL,";break;
		case "28":$DSMARCA.="ORIGINAIS,";break;
		case "29":$DSMARCA.="ORIGINAL,";break;
		case "30":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "31":$DSMARCA.="NAO IDENTIFICADO,";break;
		case "32":$DSMARCA.="NAO IDENTIFICADO,";break;
		}
	}
	if(strlen($_POST['ACESSORIO_'.$inicio])>=1)
	{
		$CDACESSORIOS.=$_POST['ACESSORIO_'.$inicio].',';
		$DSMARCA.=$_POST['MARCA_ACESSORIO_'.$inicio].',';
	}
	if(strlen($_POST['ACESSORIO_OUTRO'.$inicio])>=1)
	{
		$DSOUTROSACESSORIOS.=$_POST['ACESSORIO_OUTRO'.$inicio].',';
		$DSMARCAACESSORIOS.=$_POST['MARCA_ACESSORIO_OUTRO'.$inicio].',';
	}
	if(strlen($_POST['anti_furto'.$inicio])>=1)
	{
		$CDANTIFURTO.=$_POST['anti_furto'.$inicio].',';
	}
	if(strlen($_POST['EQUIPAMENTO'.$inicio])>=1)
	{
		$CDEQUIPAMENTO.=$_POST['EQUIPAMENTO'.$inicio].',';
	}
	if(strlen($_POST['EQUIPAMENTO_OUTRO'.$inicio])>=1)
	{
		$DSOUTROSEQUIPAMENTOS.=$_POST['EQUIPAMENTO_OUTRO'.$inicio].',';
	}
	
	
	if( (strlen($_POST['PECA_AVARIADA'.$inicio])>=1) && (strlen($_POST['PECA_AVARIADA'.$inicio])<=3) )
	{

			$CDPECA.=$_POST['PECA_AVARIADA'.$inicio].',';
			$CDAVARIA.=$_POST['AVARIA'.$inicio].',';
			$CMPECA.=$_POST['CM_AVARIA'.$inicio].',';
			$hora_pintura.=$_POST['hora_pintura'.$inicio].',';
			$hora_funilaria.=$_POST['hora_funilaria'.$inicio].',';
			$exclusao.=$_POST['exclusao'.$inicio].',';
			
		$alguma_hora=0;

//Amassado
if ($_POST['AVARIA'.$inicio]=="01")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='08,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='10,';}
$alguma_hora=1;
}
//Arranhado
if ($_POST['AVARIA'.$inicio]=="02")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Com Bolhas
if ($_POST['AVARIA'.$inicio]=="03")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Com Corrosão
if ($_POST['AVARIA'.$inicio]=="04")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
//Com Ferrugem
if ($_POST['AVARIA'.$inicio]=="05")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='08,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='10,';}
$alguma_hora=1;
}
//Com Mossas
if ($_POST['AVARIA'.$inicio]=="06")
{
if($_POST['CM_AVARIA'.$inicio]<=5){$HRREPAROAVARIAS.='00,';}
$alguma_hora=1;
}
//Com Ondulação
if ($_POST['AVARIA'.$inicio]=="07")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='03,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='06,';}
$alguma_hora=1;
}
//Com Vazamento
if ($_POST['AVARIA'.$inicio]=="08")
{
$HRREPAROAVARIAS.='02,';
$alguma_hora=1;
}
//Falta
if ($_POST['AVARIA'.$inicio]=="09")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
//Mal Reparado
if ($_POST['AVARIA'.$inicio]=="10")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Rachado
if ($_POST['AVARIA'.$inicio]=="11")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
//Rasgado
if ($_POST['AVARIA'.$inicio]=="12")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
//Riscado
if ($_POST['AVARIA'.$inicio]=="13")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Quebrado
if ($_POST['AVARIA'.$inicio]=="14")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
//Queimado
if ($_POST['AVARIA'.$inicio]=="15")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Descolorido
if ($_POST['AVARIA'.$inicio]=="16")
{
if($_POST['CM_AVARIA'.$inicio]<=10){$HRREPAROAVARIAS.='00,';}
if($_POST['CM_AVARIA'.$inicio]>=11&&$_POST['CM_AVARIA'.$inicio]<=20){$HRREPAROAVARIAS.='04,';}
if($_POST['CM_AVARIA'.$inicio]>=21&&$_POST['CM_AVARIA'.$inicio]<=40){$HRREPAROAVARIAS.='05,';}
if($_POST['CM_AVARIA'.$inicio]>=41&&$_POST['CM_AVARIA'.$inicio]<=80){$HRREPAROAVARIAS.='06,';}
if($_POST['CM_AVARIA'.$inicio]>=81){$HRREPAROAVARIAS.='08,';}
$alguma_hora=1;
}
//Desalinhado
if ($_POST['AVARIA'.$inicio]=="17")
{
$HRREPAROAVARIAS.='00,';
$alguma_hora=1;
}
//Empenado
if ($_POST['AVARIA'.$inicio]=="18")
{
$HRREPAROAVARIAS.='99,';
$alguma_hora=1;
}
if($alguma_hora==0)
{
$HRREPAROAVARIAS.='00,';
}
	
	
	}
	if(strlen($_POST['PECA_AVARIADA_OUTRO'.$inicio])>=1 || strlen($_POST['PECA_AVARIADA'.$inicio])>=4 )
	{
		// se outras peças manda para o lugar certo
		if(strlen($_POST['PECA_AVARIADA'.$inicio])>=4){
			$_POST['PECA_AVARIADA_OUTRO'.$inicio]=$_POST['PECA_AVARIADA'.$inicio];
			$_POST['AVARIA_OUTRO'.$inicio]=$_POST['AVARIA'.$inicio];
			$_POST['CM_AVARIA_OUTRO'.$inicio]=$_POST['CM_AVARIA'.$inicio];
			$_POST['hora_pintura_outra'.$inicio]=$_POST['hora_pintura'.$inicio];
			$_POST['hora_funilaria_outra'.$inicio]=$_POST['hora_funilaria'.$inicio];
			$_POST['exclusao_outro'.$inicio]=$_POST['exclusao'.$inicio];
			}
			
		$DSOUTRASPECAS.=$_POST['PECA_AVARIADA_OUTRO'.$inicio].',';
		$CDOUTRASAVARIAS.=$_POST['AVARIA_OUTRO'.$inicio].',';
		$CMPECAOUTRAS.=$_POST['CM_AVARIA_OUTRO'.$inicio].',';
		$hora_pintura_outra.=$_POST['hora_pintura_outra'.$inicio].',';
		$hora_funilaria_outra.=$_POST['hora_funilaria_outra'.$inicio].',';
		$exclusao_outro.=$_POST['exclusao_outro'.$inicio].',';


		$alguma_hora=0;

//Amassado
if ($_POST['AVARIA_OUTRO'.$inicio]=="01")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='08,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='10,';}
$alguma_hora=1;
}
//Arranhado
if ($_POST['AVARIA_OUTRO'.$inicio]=="02")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Com Bolhas
if ($_POST['AVARIA_OUTRO'.$inicio]=="03")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Com Corrosão
if ($_POST['AVARIA_OUTRO'.$inicio]=="04")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
//Com Ferrugem
if ($_POST['AVARIA_OUTRO'.$inicio]=="05")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='08,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='10,';}
$alguma_hora=1;
}
//Com Mossas
if ($_POST['AVARIA_OUTRO'.$inicio]=="06")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=5){$HRREPARO.='00,';}
$alguma_hora=1;
}
//Com Ondulação
if ($_POST['AVARIA_OUTRO'.$inicio]=="07")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='03,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='06,';}
$alguma_hora=1;
}
//Com Vazamento
if ($_POST['AVARIA_OUTRO'.$inicio]=="08")
{
$HRREPARO.='02,';
$alguma_hora=1;
}
//Falta
if ($_POST['AVARIA_OUTRO'.$inicio]=="09")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
//Mal Reparado
if ($_POST['AVARIA_OUTRO'.$inicio]=="10")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Rachado
if ($_POST['AVARIA_OUTRO'.$inicio]=="11")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
//Rasgado
if ($_POST['AVARIA_OUTRO'.$inicio]=="12")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
//Riscado
if ($_POST['AVARIA_OUTRO'.$inicio]=="13")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Quebrado
if ($_POST['AVARIA_OUTRO'.$inicio]=="14")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
//Queimado
if ($_POST['AVARIA_OUTRO'.$inicio]=="15")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Descolorido
if ($_POST['AVARIA_OUTRO'.$inicio]=="16")
{
if($_POST['CM_AVARIA_OUTRO'.$inicio]<=10){$HRREPARO.='00,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=11&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=20){$HRREPARO.='04,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=21&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=40){$HRREPARO.='05,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=41&&$_POST['CM_AVARIA_OUTRO'.$inicio]<=80){$HRREPARO.='06,';}
if($_POST['CM_AVARIA_OUTRO'.$inicio]>=81){$HRREPARO.='08,';}
$alguma_hora=1;
}
//Desalinhado
if ($_POST['AVARIA_OUTRO'.$inicio]=="17")
{
$HRREPARO.='00,';
$alguma_hora=1;
}
//Empenado
if ($_POST['AVARIA_OUTRO'.$inicio]=="18")
{
$HRREPARO.='99,';
$alguma_hora=1;
}
if($alguma_hora==0)
{
$HRREPARO.='00,';
}
		
	}
	$CDMOTIVOSRESSALVA.=$_POST['m_ressalva'.$inicio];
	$inicio++;
}

if($_SESSION['permissao']=='10'||$_SESSION['permissao']=='3')
{

$sql_vistoria = "SELECT DTANALISE,controle_analista,editado FROM ".$bancoDados.".vistoria_previa1 WHERE NUMEROSOLICITACAO = ".$_POST[NUMEROSOLICITACAO];
$result_vistoria = mysql_query($sql_vistoria,$db);
$vistoria = mysql_fetch_array($result_vistoria);

	$editado="";
	if ($_POST['concluirAnalise']=='S'){
		if ($vistoria['DTANALISE']=='' && $vistoria['editado']==0){
		$editado = "checado = '',
		DTANALISE = '".date("Ymd")."',
		hora_analise = '".date("Hi")."',
		controle_analista = '".$_SESSION[id]."',";   
		$liberar = "editado = '1',"; 
		} else {
		$editado = "checado = '',
		DTREANALISE = '".date("Ymd")."',
		hora_reanalise = '".date("Hi")."',
		controle_reanalize = '".$_SESSION[id]."',"; 
		$liberar = "editado = '1',";   
		} 
		// analista está liberando a vistoria para transmissão, então anasisando volta para 0
		$analisando = "analisando = 0,";   
	}else{
		$liberar = "editado = '0',";
		// analista não liberou a vistoria para transmissão, então anasisando continua com o código dele
		$analisando = ""; 
		}
}


if($_POST['INTERCEIROEIXO']==''){
$in_terceiro_eixo = 'N';
}

if($_POST['INTERCEIROEIXO']!==''){
$in_terceiro_eixo = $_POST['INTERCEIROEIXO'];
}

if($_POST['TPCARROC']==''){
$tipo_carroceria = '00';
}
	
if($_POST['TPCARROC']!==''){
$tipo_carroceria = $_POST['TPCARROC'];
}



	$sql2 = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$_POST[NUMEROSOLICITACAO]."";
	$result2 = mysql_query($sql2,$db);
	$sol = mysql_fetch_array($result2);


	if($_POST['TPVISTORIA']=="P")
	{
		
		//		0					1				2					3				4					5
		// echo $posto[cep].",".$posto[uf].",".$posto[cidade].",".$posto[bairro].",".$posto[endereco].",".$posto[numero];
		//$array_arrumado_posto = split ('[,]', $_POST['endereco_posto']);
		$array_arrumado_posto = explode(',', $_POST['endereco_posto']);
		$dados_tp_vistoria = "		sucursal='".$_POST['sucursal']."',   		estado='".$array_arrumado_posto[1]."',   	cidade='".$array_arrumado_posto[2]."', bairro='".$array_arrumado_posto[3]."',  numero='".$array_arrumado_posto[5]."', 	endereco='".$array_arrumado_posto[4]."',  	complemento='POSTO FIXO',	";

$cidade=$array_arrumado_posto[2];

//CEP da Vistoria
$cep = $array_arrumado_posto[0];

//echo $cep;
$cep1 = $cep{0}.$cep{1}.$cep{2}.$cep{3}.$cep{4};
$cep2 = $cep{5}.$cep{6}.$cep{7};


		
	}
	if($_POST[TPVISTORIA]=="V")
	{

			//CEP da Vistoria
$cep = $_POST[cep];
$cep1 = $cep{0}.$cep{1}.$cep{2}.$cep{3}.$cep{4};
$cep2 = $cep{5}.$cep{6}.$cep{7};

if (  ($_POST[SEGURADORA]=="39")&&
      (($cep1 == '00000')||
	   ($cep1 == '11111')||
	   ($cep1 == '22222')||
	   ($cep1 == '33333')||
	   ($cep1 == '44444')||
	   ($cep1 == '55555')||
	   ($cep1 == '66666')||
	   ($cep1 == '77777')||
	   ($cep1 == '88888')||
	   ($cep1 == '99999'))
   )
		{
			$cep1 = "13100";
		}

	$dados_tp_vistoria = "
		sucursal='".$_POST[sucursal]."',
		estado='".$uf_vistoria."',
		cep1='".$cep1."',
		cep2='".$cep2."',
		cidade='".$municipio_vistoria."',   
		bairro='".$_POST[bairro]."',   
		numero='".$_POST[numero]."',   
		endereco='".$_POST[endereco]."',   
		complemento='".$_POST[complemento]."',     
		";

$cidade=$municipio_vistoria;		
		
	}

if( $_POST['SEGURADORA']==0 && ($_POST['proposta1']!='' && substr($_POST['proposta1'],0,4)!='BRAD' && substr($_POST['proposta1'],0,4)!='SAVP')  ){
	$mudaAudatex="audatex=1,";
	}else{
		$mudaAudatex="";
		}	
		

				$log_sql = "UPDATE ".$bancoDados.".solicitacao SET
				".$dados_tp_vistoria."
				".$mudaAudatex."
				numero_susep='".$_POST[susep]."',
				numero_inspecao='".$_POST[nrmaritima]."',
				corretor='".addslashes($_POST[corretor])."',
				placa='".$_POST[NRPLACA]."',
				cidade='".$cidade."',
				proposta='".$_POST[proposta]."',
				controle_prest = '".$controle_prest."',
				controle_prest_filho = '".$controle_prest_filho."',
				chassi='".str_replace('|','',$_POST[NRCHASSI])."',
				status_laudo = 1 WHERE id = ".$sol["id"].""; 
				$result_log = mysql_query($log_sql,$db);
				if (!$result_log)
				{
					//Se nao funcionou
					echo ("<font color='red'>".mysql_error()."</font><br>erro no log");
				}

if(strlen($_POST[in_revistoria])>0)
{
$cd_filial_arrumado = $_POST[in_revistoria];

}
else{

$cd_filial_arrumado = $prestador[filial];

}
if(strlen($_POST['INREMARCADO'])>0){
$chassi_remarcado = $_POST['INREMARCADO'];
}
else {
$chassi_remarcado = 'N';
}



$sql = "UPDATE ".$bancoDados.".vistoria_previa1 SET
				status = '3', 
				".$editado."
				".$analisando."
				".$liberar."
				km_percorrido = '".$km_percorrido."',
				valorb = '".$preco."',
				cidade_atende = '".$cidade_atende."',
				NRVISTORIA = '".$_POST[NRVISTORIA]."',
				CDFILIAL = '".$cd_filial_arrumado."',
				CDSUCURSAL='".$_POST[sucursal]."',
				NMCORRETOR = '".addslashes($_POST[corretor])."',
				TPVISTORIA = '".$_POST[TPVISTORIA]."',
				UFVISTORIA = '".$prestador_filial[uf]."',
				DTVISTORIA = '".$data_vistoria."',
				HRVISTORIA = '".$hora_realiza."',
				CDFINALIDADE = '".$_POST[CDFINALIDADE]."',
				NMPROPONENTE = '".$_POST[NMPROPONENTE]."',
				quant_anti = '".$_POST[produto]."',
				controle_prest = '".$controle_prest."',
				controle_prest_filho = '".$controle_prest_filho."',
				CDVEICULO = '".$_POST[codigo]."',
				NMVEICULO = '".$_POST[modelo]."',
				NMFABRICANTE = '".$_POST[fabricante]."',
				NRPLACA = '".$_POST[NRPLACA]."',
				DSMUNICIPIOPLACA = '".$_POST[DSMUNICIPIOPLACA]."',
				UFPLACA = '".$_POST[UFPLACA]."',
				NRANOFABRICACAO = '".$_POST[NRANOFABRICACAO]."',
				NRANOMOD = '".$_POST[NRANOMODELO]."',
				NRPORTAS = '".$_POST[NRPORTAS]."',
				TPPINTURA = '".$_POST[TPPINTURA]."',
				TPCOMBUSTIVEL = '".$_POST[TPCOMBUSTIVEL]."',
				KMVEICULO = '".$_POST[KMVEICULO]."',
				INALIENADO = '".$_POST[INALIENADO]."',
				NMALIENADOR = '".$_POST[NMALIENADOR]."',
				quant_equipamentos = '".$_POST[nserie]."',
				NRCHASSI = '".str_replace('|','',$_POST[NRCHASSI])."',
				DVCHASSI = '".$_POST[tipoVistoria]."',
				INREMARCADO = '".$chassi_remarcado."',
				NRMOTOR = '".$_POST[NRMOTOR]."',
				NRDUT = '".$_POST[NRDUT]."',
				NMDUT = '".$_POST[NMDUT]."',
				DTDUT = '".$data_dut."',
				NMORGAODUT = '".$_POST[NMORGAODUT]."',
				NRRENAVAM = '".$_POST[NRRENAVAM]."',
				INTRANSF = '".$_POST[INTRANSF]."',
				DSTRANSF = '".$_POST[DSTRANSF]."',
				CDDESTVEIC = '".$_POST[CDDESTVEIC]."',
				DSMARCACARROC = '".$_POST[DSMARCACARROC]."',
				NRCARROC = '".$_POST[NRCARROC]."',
				TPCARROC = '".$tipo_carroceria."',
				CDMATERIALCARROC = '".$_POST[CDMATERIALCARROC]."',
				INTERCEIROEIXO = '".$in_terceiro_eixo."',
				CDRESSALVA = '".$_POST[CDRESSALVA]."',
				CDMOTIVOSRESSALVA = '".$CDMOTIVOSRESSALVA.contem_obs_nota."',
				OBSERVACOES = '".$contem_nota.strtr($_POST[OBSERVACOES],array("º"=>".", "ª"=>"."))."',
				CDPECA = '".$CDPECA."',
				CDAVARIA = '".$CDAVARIA."',
				HRREPAROAVARIAS = '".$HRREPAROAVARIAS."',
				DSOUTRASPECAS = '".$DSOUTRASPECAS."',
				CDOUTRASAVARIAS = '".$CDOUTRASAVARIAS."',
				HRREPARO = '".$HRREPARO."',
				CMPECAOUTRAS = '".$CMPECAOUTRAS."',
				CMPECA = '".$CMPECA."',
				CDOPCIONAIS = '".$CDOPCIONAIS."',
				DSOUTROSOPCIONAIS = '".$DSOUTROSOPCIONAIS."',
				CDACESSORIOS = '".$CDACESSORIOS."',
				DSMARCA = '".$DSMARCA."',
				DSOUTROSACESSORIOS = '".$DSOUTROSACESSORIOS."',
				DSMARCAACESSORIOS = '".$DSMARCAACESSORIOS."',
				CDEQUIPAMENTO = '".$CDEQUIPAMENTO."',
				DSOUTROSEQUIPAMENTOS = '".$DSOUTROSEQUIPAMENTOS."',
				DSMUNICIPIOVISTORIA = '".$municipio_vistoria."',
				CEPVISTORIA = '".$cep."',
				CDCORRETORSUSEP = '".$_POST[susep]."',
				cor = '".$_POST[cor]."',
				CDUSOVEICULO = '".$_POST[CDUSOVEICULO]."',
				grav_vidros = '".$_POST[GRAVA_VIDROS]."',
				grav_vidros_quant = '".$_POST[quantidade_vidros]."',
				etiquetas = '$_POST[etiquetas1],$_POST[etiquetas2],$_POST[etiquetas3],',
				extintor = '".$_POST[extintor]."',
				pneus = '".$_POST[pneus]."',
				marca_medidas = '".$_POST[marca_medidas]."',
				CDANTIFURTO = '".$CDANTIFURTO."',
				in_logotipo = '".$_POST[in_logotipo]."',
				VISTCALLCENTER = '".$_POST[VISTCALLCENTER]."',
				proposta = '".$_POST[proposta1]."',
				CPFDOVISTORIADOR = '".$prestador[cpf]."',
				valor_veiculo = '".$_POST[valor_veiculo]."' WHERE NUMEROSOLICITACAO = '".$_POST[NUMEROSOLICITACAO]."'"; 
				
	$result = mysql_query($sql,$db);
	if ($result)
	{
		//Somente se for Maritima Seguros
		if($_POST[SEGURADORA]=="61" || $_POST[SEGURADORA]=="25" || $associacao=='sim')
		{
		
		$sql = "UPDATE ".$bancoDados.".vistoria_previa1 SET
				HRREPAROAVARIAS = '".$hora_funilaria."',
				HRREPARO = '".$hora_funilaria_outra."' WHERE NUMEROSOLICITACAO = '".$_POST[NUMEROSOLICITACAO]."'"; 
				
	$result = mysql_query($sql,$db); 
	
if($_POST[audatex]=="1"){
	$sql_extra_update_maritima = "UPDATE ".$bancoDados.".vistoria_extra SET
				nome_condutor = '".$_POST[nome_condutor]."',
				data_cinto = '".$data_cinto."',
				hora_avaria = '".$hora_pintura."',
				avaria_exclusao = '".$exclusao."',
				peca_avaria_hora = '".$hora_funilaria_outra."',
				valor_exclusao = '".$exclusao_outro."',	
				combustivelAdaptado = '".$_POST[combustivelAdaptado]."',	    		
tipo_pessoa = '".$_POST[tipo_pessoa]."',
descricao_veiculo = '".$_POST[descricao_veiculo]."',
numero_inspecao = '".$_POST[numero_inspecao]."',
cilindros = '".$_POST[cilindros]."',
situacao_placa = '".$_POST[situacao_placa]."',
condicao_numero_motor = '".$_POST[condicao_numero_motor]."',
veiculo_blindado = '".$_POST[veiculo_blindado]."',
Codigo_Condicao_Chassi = '".$_POST[Codigo_Condicao_Chassi]."',
Reparos_Identificados_nas_Estruturas = '".$_POST[Reparos_Identificados_nas_Estruturas]."',
forma_carroc = '".$_POST[condicao_carroc]."',
documentacao = '".$_POST[restricao_crlv]."',
aro_pneus = '".$_POST[aro_pneus]."',
motor_regularizado='".$_POST[motor_regularizado]."',
qtde_cilindros='".$_POST[qtde_cilindros]."',
avaliacao = '".$_POST[avaliacao]."' WHERE solicitacao = '".$_POST[NUMEROSOLICITACAO]."'";
	}else{	
		$sql_extra_update_maritima = "UPDATE ".$bancoDados.".vistoria_extra SET
				nome_condutor = '".$_POST[nome_condutor]."',
				hora_avaria = '".$hora_pintura."',
				avaria_exclusao = '".$exclusao."',
				peca_avaria_hora = '".$hora_funilaria_outra."',
				valor_exclusao = '".$exclusao_outro."',		    		
tipo_pessoa = '".$_POST[tipo_pessoa]."',
descricao_veiculo = '".$_POST[descricao_veiculo]."',
numero_inspecao = '".$_POST[numero_inspecao]."',
cilindros = '".$_POST[cilindros]."',
situacao_placa = '".$_POST[situacao_placa]."',
condicao_numero_motor = '".$_POST[condicao_numero_motor]."',
Codigo_Condicao_Chassi = '".$_POST[Codigo_Condicao_Chassi]."',
Reparos_Identificados_nas_Estruturas = '".$_POST[Reparos_Identificados_nas_Estruturas]."',
aro_pneus = '".$_POST[aro_pneus]."',
avaliacao = '".$_POST[avaliacao]."' WHERE solicitacao = '".$_POST[NUMEROSOLICITACAO]."'"; 
	}
	
$result_extra_update_maritima = mysql_query($sql_extra_update_maritima,$db);
		}
		
//UPDATE EXTRA YASUDA
		if($_POST[SEGURADORA]=="72")
		{
		$sql_extra_update_yasuda = "UPDATE ".$bancoDados.".vistoria_extra SET
nome_condutor = '".$_POST[nome_condutor]."',
KM_rodado = '".$_POST[KM_rodado]."',
vistoria_realizada_na = '".$_POST[vistoria_realizada_na]."',
procedencia = '".$_POST[procedencia]."',
Placa_Vermelha = '".$_POST[Placa_Vermelha]."',
Lacre_Obrigatorio_Emplacamento = '".$_POST[Lacre_Obrigatorio_Emplacamento]."',
situacao_plaqueta = '".$_POST[situacao_plaqueta]."',
situacao_placa = '".$_POST[situacao_placa]."',
Codigo_Condicao_Chassi = '".$_POST[Codigo_Condicao_Chassi]."',
Codigo_Condicao_Motor = '".$_POST[Codigo_Condicao_Motor]."',
identificador_alarme = '".$_POST[identificador_alarme]."',
veiculo_nome_outra_pessoa = '".$_POST[veiculo_nome_outra_pessoa]."',
vistoria_sem_assinatura = '".$_POST[vistoria_sem_assinatura]."',
Tres_Vidros_Gravacao_Numero_Chassi = '".$_POST[Tres_Vidros_Gravacao_Numero_Chassi]."',
veiculo_rebaixado = '".$_POST[veiculo_rebaixado]."',
veiculo_blindado = '".$_POST[veiculo_blindado]."',
veiculo_turbinado = '".$_POST[veiculo_turbinado]."',
veiculo_recuperado = '".$_POST[veiculo_recuperado]."',
veiculo_leilao = '".$_POST[veiculo_leilao]."',
descricao_veiculo = '".$_POST[descricao_veiculo]."',
veiculo_locacao = '".$_POST[veiculo_locacao]."',
veiculo_cobranca_frete = '".$_POST[veiculo_cobranca_frete]."',
veiculo_mandatato = '".$_POST[veiculo_mandatato]."',
in_revistoria = '".$_POST[in_revistoria]."',
solicitacao = '".$solicitacao."',
falta_fotos = '".$_POST[falta_fotos]."')";
$result_extra_update_yasuda = mysql_query($sql_extra_update_yasuda,$db);
		}		

//Somente se for ZURICH
if($_POST[SEGURADORA]=="39")
{
	
if($_POST[equip1]!=''){$eqp1=$_POST[equip1].",";}else{$eqp1='';}
if($_POST[equip2]!=''){$eqp2=$_POST[equip2].",";}else{$eqp2='';}
if($_POST[equip3]!=''){$eqp3=$_POST[equip3].",";}else{$eqp3='';}
if($_POST[equip4]!=''){$eqp4=$_POST[equip4].",";}else{$eqp4='';}
if($_POST[equip5]!=''){$eqp5=$_POST[equip5].",";}else{$eqp5='';}

$equipamentos_prot=$eqp1.$eqp2.$eqp3.$eqp4.$eqp5;
	
$sql_extra_update_zurich = "UPDATE ".$bancoDados.".vistoria_extra SET
Cambio = '".$_POST[Cambio]."',
Plaquetas_Existentes = '".$_POST[Plaquetas_Existentes]."',
itens_seguranca = '".$equipamentos_prot."',
veiculo_rebaixado = '".$_POST[veiculo_rebaixado]."',
CPF_CNPJ_Renavam = '".$_POST[CPF_CNPJ_Renavam]."',		    		
avaliacao = '".$_POST[avaliacao]."',
capacidade_lotacao = '".$_POST[capacidade_lotacao]."',
marchas = '".$_POST[marchas]."',
bomba_injetora = '".$_POST[injecao_eletronica]."',
capacidade_veiculo = '".$_POST[capacidade_veiculo]."',
veiculo_turbinado = '".$_POST[veiculo_turbinado]."',
turbo_original = '".$_POST[turbo_original]."',
possui_rodoar = '".$_POST[possui_rodoar]."',
tipo_cabine = '".$_POST[tipo_cabine]."',
potencia = '".$_POST[potencia]."',
tp_vidros = '".$_POST[tp_vidros]."' WHERE solicitacao = '".$_POST[NUMEROSOLICITACAO]."'";

$result_extra_update_zurich = mysql_query($sql_extra_update_zurich,$db);
}

	?>
<table width="100%" border="00" cellspacing="0" cellpadding="0">
      <tr>
        <td height="140" colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="31">&nbsp;</td>
        <td width="200" bgcolor="#0066CC"><div align="center" class="style1">Laudo <? echo $_POST[NRVISTORIA];?>&nbsp;alterado</div></td>
        <td></td>
      </tr>
    </table>
    
  <? 
 ############################ ENVIAR PARA O LOTE AUTOMATICAMENTE ####################################
 if( $finalizaAnalise['finalizarAutomatico']=='sim' && $_POST['concluirAnalise']=='S' ) 
 	{
		$finalizaAutomatico='nao';
		 if($_POST['SEGURADORA']=='0')
			{
			if($sol['audatex']==2){
					$autoFinalizar="./xml_bradesco/finalizarBare.php?id=".$_POST['NUMEROSOLICITACAO'];	
					}else{
						$autoFinalizar="./xml_bradesco/bradesco.php?id=".$_POST['NUMEROSOLICITACAO'];
						}	
			$finalizaAutomatico='sim';
			}
			if($_POST['SEGURADORA']=='61')
			{
			$autoFinalizar="./xml_maritima/maritima.php?id=".$_POST['NUMEROSOLICITACAO'];	
			/*if($sol['audatex']==1){
					$autoFinalizar="./xml_maritima/maritima.php?id=".$_POST[NUMEROSOLICITACAO];	
					}else{
						$autoFinalizar="./finalizar13.php?id=".$_POST[NUMEROSOLICITACAO];
						}*/
			$finalizaAutomatico='sim';
			}
			if($_POST['SEGURADORA']=='87')
			{
			$autoFinalizar="./finalizar87.php?id=".$_POST['NUMEROSOLICITACAO'];	
			$finalizaAutomatico='sim';
			}

		?> 
        <iframe style="width:1px; height:1px; top:-10px; left:-10px" src="<? echo $autoFinalizar;?>"> </iframe>
        <?
		if($finalizaAutomatico=='sim'){
	echo "<center><h2>Est&aacute; vistoria est&aacute; sendo transmitida automaticamente!</h2></center>";
		}
		
	 }
 ####################################################################################################
 
 ?>   
 
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
	else
	{
	echo mysql_error();
	?>
	    <font color="#FF0000" face="Arial, Helvetica, sans-serif"><strong>Erro ao Alterar dados</strong></font>	
<?
	}
mysql_close();
?>
</body>
</html>