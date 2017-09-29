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
@session_start();

include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php"; 


if(isset($_POST['acertoSeguradora']) && $_POST['acertoSeguradora']!=''){
	$seguradoraAtual=$_POST['SEGURADORA'];
	$_POST['SEGURADORA']=$_POST['acertoSeguradora'];
	
	
########################################## MIGRANDO AS FOTOS PARA ASSOCIAÇÃO CORRETA ###############################################

$_SESSION["nome_seguradora"]=$seguradoraAtual;
include "../seguradora_nome.php";   
$nome_segAtual=strtr($cliente_seguradora, array(" "=>"_", " & "=>"_", "."=>"", ));
		
$_SESSION["nome_seguradora"]=$_POST['acertoSeguradora'];
include "../seguradora_nome.php";   
$nome_seg=strtr($cliente_seguradora, array(" "=>"_", " & "=>"_", "."=>"", ));
	
	
// MIGRAÇÃO DAS FOTOS
$sql_fotos = "SELECT DISTINCT fotos, data FROM ".$bancoDados.".fotos WHERE id = " . $_POST['NUMEROSOLICITACAO']. " order by contagem asc";
$result=$bancoPDO -> prepare($sql_fotos);
$result -> execute();
$buscaDados = $result -> fetchAll(PDO::FETCH_ASSOC);

for($i=0,$C=count($buscaDados); $i<$C; $i++){	
$fotos=$buscaDados[$i];
$seq=explode("_",$fotos['fotos']);

$ano=substr($fotos['data'],0,4);
$mes=substr($fotos['data'],4,2);
$dia=substr($fotos['data'],6,2);     

$nomeFoto=$_POST['NUMEROSOLICITACAO']."_".$seq[1];    

$diretorioOrigem='/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_segAtual.'/'.$ano.'/'.$mes.'/'.$dia.'/'.$_POST['NUMEROSOLICITACAO'].'/';

if(!file_exists($diretorioOrigem.$fotos['fotos'])){
	// DIRETORIO CLOUD
	$diretorioOrigem='/var/www/html/sistema/cloud/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_segAtual.'/'.$ano.'/'.$mes.'/'.$dia.'/'.$_POST['NUMEROSOLICITACAO'].'/';
}

// NOVO DIRETORIO ONDE SERÃO SALVAS AS FOTOS		
$diretorioDestino='/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg.'/'.$ano.'/'.$mes.'/'.$dia.'/'.$_POST['NUMEROSOLICITACAO'].'/';

// CRIANDO ARVORE DE PASTAS PARA ASSOCIAÇÃO NOVA
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'], 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg.'/'.$ano, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg.'/'.$ano.'/'.$mes, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg.'/'.$ano.'/'.$mes.'/'.$dia, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$_SESSION['roteirizador'].'/'.$nome_seg.'/'.$ano.'/'.$mes.'/'.$dia.'/'.$_POST['NUMEROSOLICITACAO'], 0777);		

/*if($_SESSION['id']==1){
	echo $diretorioOrigem.$fotos['fotos']."<br>";
	echo $diretorioDestino.$fotos['fotos']."<br>";
	}*/


if(copy($diretorioOrigem.$fotos['fotos'], $diretorioDestino.$fotos['fotos'])){
unlink($diretorioOrigem.$fotos['fotos']);
	}		
}

###########################################################################################################################################
	

	}
	
$susepAcerta='';
$corretorAcerta='';

switch($_POST['SEGURADORA']){
	case 35: $associacao='sim'; break;
	case 200: $associacao='sim'; break;
	case 201: $associacao='sim'; break;
	case 202: $associacao='sim'; break;
	case 203: $associacao='sim'; break;
	case 204: $associacao='sim'; break;
	case 205: $associacao='sim'; break;
	case 320: $associacao='sim'; break;   
	case 321: $associacao='sim'; break;
	case 322: $associacao='sim'; break;
	case 323: $associacao='sim'; break;
	case 324: $associacao='sim'; $susepAcerta='324324324324';$corretorAcerta='AUTO TRUCK'; break;
	case 325: $associacao='sim'; $susepAcerta='325325325325';$corretorAcerta='ABV'; break;break;
	case 326: $associacao='sim'; $susepAcerta='326326326326';$corretorAcerta='QV SERVICOS'; break;
	case 327: $associacao='sim'; break;
	case 328: $associacao='sim'; break;
	case 329: $associacao=''; break;
	case 330: $associacao='sim'; break;
	case 331: $associacao='sim'; break;
	case 332: $associacao='sim'; break;	
	case 333: $associacao='sim'; $susepAcerta='333333333333';$corretorAcerta='UNIBEM'; break;	
	case 334: $associacao='sim'; $susepAcerta='334334334334';$corretorAcerta='COOPERTRUCK'; break;	
	case 335: $associacao='sim'; break;	
	case 336: $associacao='sim'; break;
	case 337: $associacao='sim'; break;
	case 338: $associacao='sim'; break;
	case 339: $associacao='sim'; break;
	case 340: $associacao='sim'; $susepAcerta='340340340340';$corretorAcerta='ALICERCE'; break;
	case 341: $associacao='sim'; break;
	case 342: $associacao='sim'; break;
	case 343: $associacao='sim'; $susepAcerta='343343343343';$corretorAcerta='AGUARDA'; break;     
	case 344: $associacao='sim'; $susepAcerta='344344344344';$corretorAcerta='NACIONAL TRUCK'; break;
	case 345: $associacao='sim'; $susepAcerta='345345345345';$corretorAcerta='EXPRESSO TRUCK'; break;
	case 346: $associacao='sim'; $susepAcerta='346346346346';$corretorAcerta='BRASMIG'; break;
	case 347: $associacao='sim'; $susepAcerta='347347347347';$corretorAcerta='ASTRANS'; break;
	case 348: $associacao='sim'; $susepAcerta='348348348348';$corretorAcerta='APVS'; break;
	case 349: $associacao='sim'; $susepAcerta='349349349349';$corretorAcerta='ASCAMP'; break;
	case 350: $associacao='sim'; $susepAcerta='350350350350';$corretorAcerta='CLUBE FONFON'; break;
	case 351: $associacao='sim'; $susepAcerta='351351351351';$corretorAcerta='BR TRUCK'; break;
	case 353: $associacao='sim'; $susepAcerta='353353353353';$corretorAcerta='UNIVERSO ASSISTENCIA';break;
	case 354: $associacao='sim'; $susepAcerta='354354354354';$corretorAcerta='MAXIMA';break;
	case 355: $associacao='sim'; $susepAcerta='355355355355';$corretorAcerta='FOCUS';break;
	case 356: $associacao='sim'; $susepAcerta='356356356356';$corretorAcerta='LOTUS';break;
	case 357: $associacao='sim'; $susepAcerta='357357357357';$corretorAcerta='ALLIANCE APV';break;
	case 358: $associacao='sim'; $susepAcerta='358358358358';$corretorAcerta='VISTRIM';break;
	case 359: $associacao='sim'; $susepAcerta='359359359359';$corretorAcerta='AGV BRASIL';break;
	case 360: $associacao='sim'; $susepAcerta='360360360360';$corretorAcerta='ALIANÇA TRUCK CAR';break;
	case 361: $associacao='sim'; $susepAcerta='361361361361';$corretorAcerta='EUROCAR';break;
	case 362: $associacao='sim'; $susepAcerta='362362362362';$corretorAcerta='AMPLA';break;
	case 363: $associacao='sim'; $susepAcerta='363363363363';$corretorAcerta='ASCOBOM';break;
	case 364: $associacao='sim'; $susepAcerta='364364364364';$corretorAcerta='ASPROAUTO';break;
	case 365: $associacao='sim'; $susepAcerta='365365365365';$corretorAcerta='CAMBRALIA';break;
	case 366: $associacao='sim'; $susepAcerta='366366366366';$corretorAcerta='COPOM';break;
	case 367: $associacao='sim'; $susepAcerta='367367367367';$corretorAcerta='ASSOCIACAO DE AJUDA MUTUA A3';break;
	case 368: $associacao='sim'; $susepAcerta='368368368368';$corretorAcerta='MEGA BENEFICIOS';break;
	case 369: $associacao='sim'; $susepAcerta='369369369369';$corretorAcerta='UNIAUTO PROTECAO';break;
	case 370: $associacao='sim'; $susepAcerta='370370370370';$corretorAcerta='AUTO CARROS';break;
	case 371: $associacao='sim'; $susepAcerta='371371371371';$corretorAcerta='AUTOMINAS';break;
	case 372: $associacao='sim'; $susepAcerta='372372372372';$corretorAcerta='AVAP';break;
	case 373: $associacao='sim'; $susepAcerta='373373373373';$corretorAcerta='BRASIL COOPERATIVA';break;
	case 374: $associacao='sim'; $susepAcerta='374374374374';$corretorAcerta='CARVISA';break;
	case 375: $associacao='sim'; $susepAcerta='375375375375';$corretorAcerta='CENTRO SOCIAL CABOS SOLDADOS';break;
	case 376: $associacao='sim'; $susepAcerta='376376376376';$corretorAcerta='APVS ESPIRITO SANTO';break;
	case 377: $associacao='sim'; $susepAcerta='377377377377';$corretorAcerta='COOPEV';break;
	case 378: $associacao='sim'; $susepAcerta='378378378378';$corretorAcerta='COPA 190';break;
	case 379: $associacao='sim'; $susepAcerta='379379379379';$corretorAcerta='EFICAZ';break;
	case 380: $associacao='sim'; $susepAcerta='380380380380';$corretorAcerta='FACIL CLUBE DE BENEFICIOS';break;
	case 381: $associacao='sim'; $susepAcerta='381381381381';$corretorAcerta='GARANT CLUBE DE BENEFICIOS MUTUOS';break;
	case 382: $associacao='sim'; $susepAcerta='382382382382';$corretorAcerta='GENESIS BENEFICIOS';break;
	case 383: $associacao='sim'; $susepAcerta='383383383383';$corretorAcerta='LIDERANCA CLUBE DE ASSISTENCIA';break;
	case 384: $associacao='sim'; $susepAcerta='384384384384';$corretorAcerta='UNIPROV - ESPIRITO SANTO';break;
	case 385: $associacao='sim'; $susepAcerta='385385385385';$corretorAcerta='UNIPROV - RONDONIA';break;
	case 386: $associacao='sim'; $susepAcerta='386386386386';$corretorAcerta='MASTER CLUBE DE ASSISTENCIA VEICULAR';break;
	case 387: $associacao='sim'; $susepAcerta='387387387387';$corretorAcerta='MASTER TRUCK';break;
	case 388: $associacao='sim'; $susepAcerta='388388388388';$corretorAcerta='PLANCAR PRIME PROTECAO VEICULAR';break;
	case 389: $associacao='sim'; $susepAcerta='389389389389';$corretorAcerta='PRIME PROTECAO VEICULAR';break;
	case 390: $associacao='sim'; $susepAcerta='390390390390';$corretorAcerta='PROTEMINAS';break;
	case 391: $associacao='sim'; $susepAcerta='391391391391';$corretorAcerta='REDE CARS CLUBE DE BENEFICIOS';break;
	case 392: $associacao='sim'; $susepAcerta='392392392392';$corretorAcerta='SAVE-CAR';break;
	case 393: $associacao='sim'; $susepAcerta='393393393393';$corretorAcerta='UNIBRAS ASSOCIACAO DE AUTO PROTECAO';break;
	case 394: $associacao='sim'; $susepAcerta='394394394394';$corretorAcerta='UNIVERSO CLUBE DE ASSISTENCIA';break;
	case 395: $associacao='sim'; $susepAcerta='395395395395';$corretorAcerta='VISTOP SERVICOS TECNICOS';break;
	case 396: $associacao='sim'; break;
	case 397: $associacao='sim'; $susepAcerta='397397397397';$corretorAcerta='NET CAR CLUBE';break;
	case 398: $associacao='sim'; $susepAcerta='398398398398';$corretorAcerta='MOTOCAR CLUBE';break;
	case 399: $associacao='sim'; $susepAcerta='399399399399';$corretorAcerta='EXCELENCIA';break;
	case 400: $associacao='sim'; $susepAcerta='400400400400';$corretorAcerta='APVS VISTA ALEGRE';break;
	case 401: $associacao='sim'; $susepAcerta='401401401401';$corretorAcerta='CAUTELAR';break;
	case 402: $associacao='sim'; $susepAcerta='402402402402';$corretorAcerta='EXCLUSIVE';break;
	case 403: $associacao='sim'; $susepAcerta='403403403403';$corretorAcerta='TRADICAO';break;
	case 404: $associacao='sim'; $susepAcerta='404404404404';$corretorAcerta='DIAMOND MOTORS';break;
	case 405: $associacao='sim'; $susepAcerta='405405405405';$corretorAcerta='CHERY MOTORS';break;
	case 406: $associacao='sim'; $susepAcerta='406406406406';$corretorAcerta='AVEP';break;
	case 407: $associacao='sim'; $susepAcerta='407407407407';$corretorAcerta='VIVA CONSORCIOS';break;
	case 408: $associacao='sim'; $susepAcerta='408408408408';$corretorAcerta='AUTOVALORE';break;
	case 409: $associacao='sim'; $susepAcerta='409409409409';$corretorAcerta='GFCAR';break;
	case 410: $associacao='sim'; $susepAcerta='410410410410';$corretorAcerta='PREVINE';break;
	case 411: $associacao='sim'; $susepAcerta='411411411411';$corretorAcerta='CLUBE SERVICE';break;
	case 412: $associacao='sim'; $susepAcerta='412412412412';$corretorAcerta='UNIBRA';break;
	case 413: $associacao='sim'; $susepAcerta='413413413413';$corretorAcerta='SOMA TRACK';break;
	case 414: $associacao='sim'; $susepAcerta='414414414414';$corretorAcerta='TIRADENTES';break;
	case 415: $associacao='sim'; $susepAcerta='415415415415';$corretorAcerta='PARTICULAR';break;
	case 416: $associacao='sim'; $susepAcerta='416416416416';$corretorAcerta='SOLTEL';break;
	case 417: $associacao='sim'; $susepAcerta='417417417417';$corretorAcerta='TOP CAR';break;
	case 418: $associacao='sim'; $susepAcerta='418418418418';$corretorAcerta='PROTEGIDO';break;
	case 419: $associacao='sim'; $susepAcerta='419419419419';$corretorAcerta='ULTRA BRASIL';break;
	case 420: $associacao='sim'; $susepAcerta='420420420420';$corretorAcerta='UNION SOLUTIONS';break;
	case 421: $associacao='sim'; $susepAcerta='421421421421';$corretorAcerta='MASTER CLUBE UBERLANDIA';break;
	case 422: $associacao='sim'; $susepAcerta='422422422422';$corretorAcerta='MUNDIAL';break;
	case 423: $associacao='sim'; $susepAcerta='423423423423';$corretorAcerta='SIMPLIFICAR';break;
	case 424: $associacao='sim'; $susepAcerta='424424424424';$corretorAcerta='CLEAN';break;
	case 425: $associacao='sim'; $susepAcerta='425425425425';$corretorAcerta='ALLIDER';break;
	case 426: $associacao='sim'; $susepAcerta='426426426426';$corretorAcerta='APROTEVE';break;
	case 427: $associacao='sim'; $susepAcerta='427427427427';$corretorAcerta='E-NOVATE';break;
	case 428: $associacao='sim'; $susepAcerta='428428428428';$corretorAcerta='ASTRACO';break;
	case 429: $associacao='sim'; $susepAcerta='429429429429';$corretorAcerta='ROTA';break;
	case 430: $associacao='sim'; $susepAcerta='430430430430';$corretorAcerta='ULTRA';break;
	case 431: $associacao='sim'; $susepAcerta='431431431431';$corretorAcerta='UNICOON PARANA';break;
	case 432: $associacao='sim'; $susepAcerta='432432432432';$corretorAcerta='PROTEAUTO';break;
	case 433: $associacao='sim'; $susepAcerta='433433433433';$corretorAcerta='APVS SUDESTE';break;
	case 434: $associacao='sim'; $susepAcerta='434434434434';$corretorAcerta='CLUBE UNIR';break;
	case 435: $associacao='sim'; $susepAcerta='435435435435';$corretorAcerta='APM';break;
	case 436: $associacao='sim'; $susepAcerta='436436436436';$corretorAcerta='MASTER-CONSULTOR';break;
	case 437: $associacao='sim'; $susepAcerta='437437437437';$corretorAcerta='HM PROTECAO';break;
	case 438: $associacao='sim'; $susepAcerta='438438438438';$corretorAcerta='CLUBCAR';break;
	case 439: $associacao='sim'; $susepAcerta='439439439439';$corretorAcerta='AZUL CLUBE';break;
	case 440: $associacao='sim'; $susepAcerta='440440440440';$corretorAcerta='GOL PLUS BRASIL';break;
	case 441: $associacao='sim'; $susepAcerta='441441441441';$corretorAcerta='ESTILO PROTECAO';break;
	case 442: $associacao='sim'; $susepAcerta='442442442442';$corretorAcerta='PHP PROTECAO';break;
	case 443: $associacao='sim'; $susepAcerta='443443443443';$corretorAcerta='ACERTT';break;
	case 444: $associacao='sim'; $susepAcerta='444444444444';$corretorAcerta='APVA';break;
	case 445: $associacao='sim'; $susepAcerta='445445445445';$corretorAcerta='ASTRAC';break;
	case 446: $associacao='sim'; $susepAcerta='446446446446';$corretorAcerta='SEGURYCAR';break;
	case 447: $associacao='sim'; $susepAcerta='447447447447';$corretorAcerta='VITALLYS BRASIL';break;
	case 448: $associacao='sim'; $susepAcerta='448448448448';$corretorAcerta='BRASIL CAR';break;
	case 449: $associacao='sim'; $susepAcerta='449449449449';$corretorAcerta='UNIDAS';break;
	case 450: $associacao='sim'; $susepAcerta='450450450450';$corretorAcerta='ELLO';break;
	case 451: $associacao='sim'; $susepAcerta='451451451451';$corretorAcerta='UNICOON CONTAGEM';break;
	case 452: $associacao='sim'; $susepAcerta='452452452452';$corretorAcerta='FOCAR BRASIL';break;
	case 453: $associacao='sim'; $susepAcerta='453453453453';$corretorAcerta='PLACAR VEICULAR';break;
	case 454: $associacao='sim'; $susepAcerta='454454454454';$corretorAcerta='PROTECAR';break;
	case 455: $associacao='sim'; $susepAcerta='455455455455';$corretorAcerta='UCA MELHOR';break;
	case 456: $associacao='sim'; $susepAcerta='456456456456';$corretorAcerta='PROTEAUTO MARINGA';break;
	case 457: $associacao='sim'; $susepAcerta='457457457457';$corretorAcerta='AUTO VIP';break;
	case 458: $associacao='sim'; $susepAcerta='458458458458';$corretorAcerta='PRONTOCAR';break;
	case 459: $associacao='sim'; $susepAcerta='459459459459';$corretorAcerta='PENSAR CLUBE';break;
	case 460: $associacao='sim'; $susepAcerta='460460460460';$corretorAcerta='AUTO BAHIA';break;
	case 461: $associacao='sim'; $susepAcerta='461461461461';$corretorAcerta='MAXIMUS BRASIL';break;
	case 462: $associacao='sim'; $susepAcerta='462462462462';$corretorAcerta='PROTECT';break;
	default: break;      
	}


if(isset($_POST['acertoSeguradora']) && $_POST['acertoSeguradora']!=''){
	$acertaAssosiacao="cliente ='".$corretorAcerta."',";
	$acertaAssosiacaoLaudo="SEGURADORA ='".$_POST['acertoSeguradora']."',";
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

$dados_cidade=explode("<>",$_POST['cidade_atende']);
$cidade_atende=$dados_cidade[0];
$km_atende=$dados_cidade[1];
$preco_atende=$dados_cidade[2];

if ($_POST['cidade_atende']!=''){
	$preco=$preco_atende;
	$km_percorrido=$km_atende;
	$cidade_atende=$cidade_atende;
	}else{
	$preco=$_POST['PRECOVISTORIA'];
	$km_percorrido=$_POST['km_percorrido'];
	$cidade_atende="";
	}

//PODE FINALIZAR ANALISE
$sql_finalizaAnalise = "SELECT finalizarAutomatico FROM ".$bancoDados.".user WHERE id = ".$_SESSION['id'];
$result_finalizaAnalise = @mysql_query($sql_finalizaAnalise,$db);
$finalizaAnalise = @mysql_fetch_array($result_finalizaAnalise);

//selecionando o prestador
$sql_prestador = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$controle_prest."";
$result_prestador = @mysql_query($sql_prestador,$db);
$prestador = @mysql_fetch_array($result_prestador);

//verificando e pegando dados da solicitação do parceiro
$sql_Mobile = "SELECT audatex,clienteOrigem,solicitacaoOrigem,vistoriadorOrigem FROM ".$bancoDados.".solicitacao WHERE id = ".$_POST['NUMEROSOLICITACAO']; 
$result_Mobile = @mysql_query($sql_Mobile,$db);
$mobile = @mysql_fetch_array($result_Mobile);
//if($_SESSION['id']=1)echo "Audatex=> ".$audatex['audatex'];
$clienteOrigem=$mobile['clienteOrigem'];
$solicitacaoOrigem=$mobile['solicitacaoOrigem'];
$vistoriadorOrigem=$mobile['vistoriadorOrigem'];


//selecionando a filial para pegar a regiao correta
#$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prestador[filial]."' AND roteirizador=".$controle_roteirizador;
$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prestador['filial']."'AND roteirizador='".$prestador['roiterizador']."'";
$result_filial = @mysql_query($sql_filial,$db);
$prestador_filial = @mysql_fetch_array($result_filial);

if(strlen($_POST["cidade"])>1){
$municipio_vistoria = $_POST["cidade"];
}
else
{
$municipio_vistoria = $prestador_filial['cidade'];
}

/*if(strlen($_POST["UF"])>1){
$uf_vistoria = $_POST["UF"];
}
else
{
$uf_vistoria = $prestador_filial['uf'];
}*/


//Hora de Realização da Vistoria
$hora_realiza2 = $_POST['HRVISTORIA'];
$hora_realiza = $hora_realiza2{0}.$hora_realiza2{1}.$hora_realiza2{3}.$hora_realiza2{4};

//data da Vistoria
$data_vistoria = $_POST['DTVISTORIA']{6}.$_POST['DTVISTORIA']{7}.$_POST['DTVISTORIA']{8}.$_POST['DTVISTORIA']{9}.$_POST['DTVISTORIA']{3}.$_POST['DTVISTORIA']{4}.$_POST['DTVISTORIA']{0}.$_POST['DTVISTORIA']{1};

//data do DUT
$data_dut = $_POST['DTDUT']{6}.$_POST['DTDUT']{7}.$_POST['DTDUT']{8}.$_POST['DTDUT']{9}.$_POST['DTDUT']{3}.$_POST['DTDUT']{4}.$_POST['DTDUT']{0}.$_POST['DTDUT']{1};


//arrumando os dados no caso de vistoria com nota fiscal
if(strlen($_POST['numero_nota'])>=1)
{
$contem_nota = "#NOTA FISCAL NUMERO:".$_POST['numero_nota'].",DATA DA NOTA FISCAL:".$_POST['data_nota_fiscal'].",CONCESSIONARIA:".$_POST['concessionaria']."#";
$contem_obs_nota="99,";
} 


$inicio=1;
$ultimaPeca='';
$ultimaPecaOutras='';
while($inicio<=30)
{
	//se ele for um opcional contem tamanho 1 ou 2
	if(strlen($_POST['opcional'.$inicio])>=1&&strlen($_POST['opcional'.$inicio])<=3)
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
		if(($_POST['SEGURADORA']=='61'||$_POST['SEGURADORA']=='72')){
			// só adiciona se tiver marca, senão ignora
			if($_POST['MARCA_ACESSORIO_'.$inicio]!=''){
				$CDACESSORIOS.=$_POST['ACESSORIO_'.$inicio].',';
				$DSMARCA.=$_POST['MARCA_ACESSORIO_'.$inicio].',';
				}else{
					
					}
			
			}else{
				$CDACESSORIOS.=$_POST['ACESSORIO_'.$inicio].',';
				$DSMARCA.=$_POST['MARCA_ACESSORIO_'.$inicio].',';
					}
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
		$MARCA_SEGURANCA.=trim($_POST['marca_seguranca'.$inicio]).','; // ZURICH
	}
	if(strlen($_POST['EQUIPAMENTO_OUTRO'.$inicio])>=1)
	{
		$DSOUTROSEQUIPAMENTOS.=$_POST['EQUIPAMENTO_OUTRO'.$inicio].',';
	}
	
	
	if( (strlen($_POST['PECA_AVARIADA'.$inicio])>=1) && (strlen($_POST['PECA_AVARIADA'.$inicio])<=3) )
	{
		if($ultimaPeca!==$_POST['PECA_AVARIADA'.$inicio]){
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
		// SALAVA A ULTIMA PEÇA INCLUIDA NO ARRAY
		$ultimaPeca=$_POST['PECA_AVARIADA'.$inicio];
	}
	if(strlen($_POST['PECA_AVARIADA_OUTRO'.$inicio])>=1 || strlen($_POST['PECA_AVARIADA'.$inicio])>=4 )
	{
		if($ultimaPeca!==$_POST['PECA_AVARIADA_OUTRO'.$inicio]){
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
		// SALAVA A ULTIMA PEÇA INCLUIDA NO ARRAY
		$ultimaPeca=$_POST['PECA_AVARIADA_OUTRO'.$inicio];	
	}
	$CDMOTIVOSRESSALVA.=$_POST['m_ressalva'.$inicio];
	$inicio++;
}


if($_SESSION['permissao']=='10'||$_SESSION['permissao']=='3')
{

$sql_vistoria = "SELECT DTANALISE,controle_analista,editado FROM ".$bancoDados.".vistoria_previa1 WHERE NUMEROSOLICITACAO = ".$_POST['NUMEROSOLICITACAO'];
$result_vistoria = @mysql_query($sql_vistoria,$db);
$vistoria = @mysql_fetch_array($result_vistoria);

	$editado="";
	if ($_POST['concluirAnalise']=='S'){
		if ($vistoria['DTANALISE']=='' && $vistoria['editado']==0){
		$editado = "checado = '',
		DTANALISE = '".date("Ymd")."',
		hora_analise = '".date("Hi")."',
		controle_analista = '".$_SESSION['id']."',";   
		$liberar = "editado = '1',"; 
		} else {
		$editado = "checado = '',
		DTREANALISE = '".date("Ymd")."',
		hora_reanalise = '".date("Hi")."',
		controle_reanalize = '".$_SESSION['id']."',"; 
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



	$sql2 = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$_POST['NUMEROSOLICITACAO']."";
	$result2 = @mysql_query($sql2,$db);
	$sol = @mysql_fetch_array($result2);

// Variável que irá receber o código do posto fixo
$codigoPostoFixo='';

	if($_POST['TPVISTORIA']=="P")
	{
		
		//		0					1				2					3				4					5
		// echo $posto[cep].",".$posto[uf].",".$posto[cidade].",".$posto[bairro].",".$posto[endereco].",".$posto[numero];
		//$array_arrumado_posto = split ('[,]', $_POST['endereco_posto']);
		$array_arrumado_posto = explode(',', $_POST['endereco_posto']);
		$dados_tp_vistoria = "		sucursal='".$_POST['sucursal']."',   		estado='".$array_arrumado_posto[1]."',   	cidade='".$array_arrumado_posto[2]."', bairro='".$array_arrumado_posto[3]."',  numero='".$array_arrumado_posto[5]."', 	endereco='".$array_arrumado_posto[4]."',  	complemento='POSTO FIXO',	";
		
		$codigoPostoFixo=$array_arrumado_posto[6];

$cidade=$array_arrumado_posto[2];

//CEP da Vistoria
$cep = $array_arrumado_posto[0];

$cep1 = $cep{0}.$cep{1}.$cep{2}.$cep{3}.$cep{4};
$cep2 = $cep{5}.$cep{6}.$cep{7};

$uf_vistoria = $array_arrumado_posto[1];

if( $_POST['SEGURADORA']==0 && $_POST['TPVISTORIA']=="P" &&
  ( substr($_POST['proposta1'],0,4)!='BRAD' && substr($_POST['proposta1'],0,4)!='SAVP')  ){
	$_POST['proposta1']="";
	}


		
	}
	if($_POST['TPVISTORIA']=="V"||$_POST['TPVISTORIA']=="A"||$_POST['TPVISTORIA']=="B"||$_POST['TPVISTORIA']=="C")
	{

			//CEP da Vistoria
$cep = $_POST['cep'];
$cep1 = $cep{0}.$cep{1}.$cep{2}.$cep{3}.$cep{4};
$cep2 = $cep{5}.$cep{6}.$cep{7};

if (  ($_POST['SEGURADORA']=="39")&&
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

$uf_vistoria = $_POST['UF'];

	$dados_tp_vistoria = "
		sucursal='".$_POST['sucursal']."',
		estado='".$uf_vistoria."',
		cep1='".$cep1."',
		cep2='".$cep2."',
		cidade='".$municipio_vistoria."',   
		bairro='".$_POST['bairro']."',   
		numero='".$_POST['numero']."',   
		endereco='".$_POST['endereco']."',   
		complemento='".$_POST['complemento']."',     
		";

$cidade=$municipio_vistoria;		
		



	}

$mudaAudatex="";

/*if( $_POST['SEGURADORA']==0 &&
  ( substr($_POST['proposta1'],0,4)!='BRAD' && substr($_POST['proposta1'],0,4)!='SAVP')  ){
	$mudaAudatex="audatex=1,";
	}else{
		$mudaAudatex="";
		}	*/


#################### VERIFICA SE LAUDO É DO PARCEIRO #################################################

if($solicitacaoOrigem=='' && $_POST['parceiraDestino']!=''){
	
$sql_seguradora = "SELECT somenteSolicitacao FROM ".$bancoDados.".controle_vp_seguradoras WHERE nome_seguradora = ".$_POST['SEGURADORA'];
$result_seguradora = @mysql_query($sql_seguradora,$db);
$seguradora = @mysql_fetch_array($result_seguradora);
	
	if($seguradora['somenteSolicitacao']!='0'){ // NÃO TEM CONTRATO DIRETO
	// NESTA CASO ATUALIZA OS DADOS DO PARCEIRO NA SOLICITACAO
	
		$sql_vist = "SELECT id FROM webvist_".$_POST['parceiraDestino'].".user WHERE clienteDestino = ".$_SESSION['roteirizador'];
   		$result_vist = @mysql_query($sql_vist,$db);
    	$vistoriadorOrigem = @mysql_fetch_array($result_vist);
	
			$parceiro_sql = "UPDATE ".$bancoDados.".solicitacao SET
			clienteOrigem='".$_POST['parceiraDestino']."',
			vistoriadorOrigem='".$vistoriadorOrigem['id']."'
			WHERE id = ".$_POST['NUMEROSOLICITACAO'].""; 
			$result_parceiro = @mysql_query($parceiro_sql,$db);

	}
	
	}// fim if

#####################################################################################################################



if($susepAcerta!=''){
	$susep=$susepAcerta;
	}else{
		$susep=$_POST['susep'];
		}
if($corretorAcerta!=''){
	$corretor=$corretorAcerta;
	}else{
		$corretor=addslashes($_POST['corretor']);
		}
	
	
if($_POST['cod_corretor']!=''){
	$codInternoCorretor=$_POST['cod_corretor'];
	}else{
		$codInternoCorretor=$_POST['CDCORRETOR'];
		}	
	
		
if($_POST['SEGURADORA']=="72")
		{	
			$log_sql = "UPDATE ".$bancoDados.".solicitacao SET
			".$dados_tp_vistoria."
			numero_susep='".$_POST['susep']."',
			numero_inspecao='".$_POST['nrmaritima']."',
			nome_c='".$_POST['NMPROPONENTE']."',
			corretor='".addslashes($_POST['corretor'])."',
			placa='".$_POST['NRPLACA']."',
			cidade='".$cidade."',
			controle_prest = '".$controle_prest."',
			controle_prest_filho = '".$controle_prest_filho."',
			chassi='".str_replace('|','',$_POST['NRCHASSI'])."',
			status_laudo = 1 WHERE id = ".$sol["id"].""; 
			$result_log = @mysql_query($log_sql,$db);
			if (!$result_log)
			{
				//Se nao funcionou
				echo ("<font color='red'>".mysql_error()."</font><br>erro no log");
			}
		}else{	
						$log_sql = "UPDATE ".$bancoDados.".solicitacao SET
						".$dados_tp_vistoria."
						".$mudaAudatex."
						".$acertaAssosiacao."
						numero_susep='".$susep."',
						cd_corretor='".$codInternoCorretor."',
						numero_inspecao='".$_POST['nrmaritima']."',
						proposta='".$_POST['proposta1']."',
						nome_c='".$_POST['NMPROPONENTE']."',
						corretor='".$corretor."',
						placa='".$_POST['NRPLACA']."',
						cidade='".$cidade."',
						controle_prest = '".$controle_prest."',
						controle_prest_filho = '".$controle_prest_filho."',
						chassi='".str_replace('|','',$_POST['NRCHASSI'])."',
						numero_cliente_bone='".$_POST['empresaProdutora']."',
						status_laudo = 1 WHERE id = ".$sol["id"].""; 
						$result_log = @mysql_query($log_sql,$db);
						if (!$result_log)
						{
							//Se nao funcionou
							echo ("<font color='red'>".mysql_error()."</font><br>erro no log");
						}
				}
if(strlen($_POST['in_revistoria'])>0)
{
$cd_filial_arrumado = $_POST['in_revistoria'];

}
else{

$cd_filial_arrumado = $prestador['filial'];

}
if(strlen($_POST['INREMARCADO'])>0){
$chassi_remarcado = $_POST['INREMARCADO'];
}
else {
$chassi_remarcado = 'N';
}

if($_POST['totalHorasAvarias']!=''){
	$totalHorasAvarias=$_POST['totalHorasAvarias'];
	}else{
		$totalHorasAvarias='';
		}


if($_POST['SEGURADORA']=="100" || $_POST['SEGURADORA']=="101" || $_POST['SEGURADORA']=="102" || $_POST['SEGURADORA']=="103"){
	$CDEQUIPAMENTO=trim($_POST['serialEquip']);
	$DSOUTROSOPCIONAIS=trim($_POST['localInstalacao']);
	}
	
	
if($_POST['SEGURADORA']==102){	  
##################################### POINTER CIELO ###############################################	
$CDACESSORIOS='';
$DSMARCA='';
$CDOPCIONAIS='';
$DSOUTRASPECAS='';
$CMPECAOUTRAS='';
for($i=1; $i<=33; $i++){
	if($_POST[$i.'_NP']=='NP'){
		$CDACESSORIOS.=$_POST[$i.'_NP'].',';
		$DSMARCA.=$_POST[$i.'_NP'].',';
		}else{
			if($_POST[$i.'_INI']=='' && $_POST[$i.'_FIM']=='' && $_POST[$i.'_NP']==''){
				$CDACESSORIOS.='NP,';
				$DSMARCA.='NP,';
				}else{
					$CDACESSORIOS.=$_POST[$i.'_INI'].',';
					$DSMARCA.=$_POST[$i.'_FIM'].',';
					}
			}
	
	}
$CDOPCIONAIS=strtr(trim($_POST['CDOPCIONAIS']),array("'"=>"", "`"=>""));
$DSOUTRASPECAS=strtr(trim($_POST['DSOUTRASPECAS']),array("'"=>"", "`"=>""));
$CMPECAOUTRAS=strtr(trim($_POST['CMPECAOUTRAS']),array("'"=>"", "`"=>""));
$CDPECA=strtr(trim($_POST['CDPECA']),array("'"=>"", "`"=>""));
$CDAVARIA=strtr(trim($_POST['CDAVARIA']),array("'"=>"", "`"=>""));
$HRREPAROAVARIAS=strtr(trim($_POST['HRREPAROAVARIAS']),array("'"=>"", "`"=>""));
###################################################################################################	
}	


$sql = "UPDATE ".$bancoDados.".vistoria_previa1 SET
				status = '3', 
				".$editado."
				".$analisando."
				".$liberar."
				".$acertaAssosiacaoLaudo."
				km_percorrido = '".$km_percorrido."',
				PRECOVISTORIA = '".$preco."',
				cidade_atende = '".$cidade_atende."',
				NRVISTORIA = '".$_POST['NRVISTORIA']."',
				CDFILIAL = '".$cd_filial_arrumado."',
				CDSUCURSAL='".$_POST['sucursal']."',
				NMCORRETOR = '".$corretor."',
				TPVISTORIA = '".$_POST['TPVISTORIA']."',
				UFVISTORIA = '".$uf_vistoria."',
				DTVISTORIA = '".$data_vistoria."',
				HRVISTORIA = '".$hora_realiza."',
				CDFINALIDADE = '".$_POST['CDFINALIDADE']."',
				NMPROPONENTE = '".$_POST['NMPROPONENTE']."',
				CDVEICULO = '".$_POST['codigo']."',
				controle_prest = '".$controle_prest."',
				controle_prest_filho = '".$controle_prest_filho."',
				NMVEICULO = '".$_POST['modelo']."',
				NMFABRICANTE = '".$_POST['fabricante']."',
				NRPLACA = '".$_POST['NRPLACA']."',
				DSMUNICIPIOPLACA = '".$_POST['DSMUNICIPIOPLACA']."',
				UFPLACA = '".$_POST['UFPLACA']."',
				NRANOFABRICACAO = '".$_POST['NRANOFABRICACAO']."',
				NRANOMOD = '".$_POST['NRANOMODELO']."',
				NRPORTAS = '".$_POST['NRPORTAS']."',
				TPPINTURA = '".$_POST['TPPINTURA']."',
				TPCOMBUSTIVEL = '".$_POST['TPCOMBUSTIVEL']."',
				KMVEICULO = '".$_POST['KMVEICULO']."',
				INALIENADO = '".$_POST['INALIENADO']."',
				NMALIENADOR = '".$_POST['NMALIENADOR']."',
				NRCHASSI = '".str_replace('|','',$_POST['NRCHASSI'])."',
				INREMARCADO = '".$chassi_remarcado."',
				NRMOTOR = '".$_POST['NRMOTOR']."',
				NRDUT = '".$_POST['NRDUT']."',
				NMDUT = '".$_POST['NMDUT']."',
				DTDUT = '".$data_dut."',
				NMORGAODUT = '".$_POST['NMORGAODUT']."',
				NRRENAVAM = '".$_POST['NRRENAVAM']."',
				INTRANSF = '".$_POST['INTRANSF']."',
				DSTRANSF = '".$_POST['DSTRANSF']."',
				CDDESTVEIC = '".$_POST['CDDESTVEIC']."',
				DSMARCACARROC = '".$_POST['DSMARCACARROC']."',
				NRCARROC = '".$_POST['NRCARROC']."',
				TPCARROC = '".$tipo_carroceria."',
				CDMATERIALCARROC = '".$_POST['CDMATERIALCARROC']."',
				INTERCEIROEIXO = '".$in_terceiro_eixo."',
				CDRESSALVA = '".$_POST['CDRESSALVA']."',
				CDMOTIVOSRESSALVA = '".$CDMOTIVOSRESSALVA.$contem_obs_nota."',
				OBSERVACOES = '".$contem_nota.strtr($_POST['OBSERVACOES'],array("º"=>".", "ª"=>"."))."',
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
				quant_equipamentos = '".$MARCA_SEGURANCA."',
				DSOUTROSEQUIPAMENTOS = '".$DSOUTROSEQUIPAMENTOS."',
				DSMUNICIPIOVISTORIA = '".$municipio_vistoria."',
				CEPVISTORIA = '".$cep."',
				CDCORRETORSUSEP = '".$susep."',
				CDCORRETOR = '".$codInternoCorretor."',
				cor = '".$_POST['cor']."',
				CDUSOVEICULO = '".$_POST['CDUSOVEICULO']."',
				grav_vidros = '".$_POST['GRAVA_VIDROS']."',
				grav_vidros_quant = '".$_POST['quantidade_vidros']."',
				etiquetas = '".$_POST['etiquetas1'].",".$_POST['etiquetas2'].",".$_POST['etiquetas3'].",',
				extintor = '".$_POST['extintor']."',
				pneus = '".$_POST['pneus']."',
				marca_medidas = '".$_POST['marca_medidas']."',
				CDANTIFURTO = '".$CDANTIFURTO."',
				in_logotipo = '".$_POST['in_logotipo']."',
				tipoVistoria = '".$_POST['tipoVistoria']."',
				VISTCALLCENTER = '".$_POST['VISTCALLCENTER']."',
				proposta = '".$_POST['proposta1']."',
				CPFDOVISTORIADOR = '".$prestador['cpf']."',
				totalHorasAvarias= '".$totalHorasAvarias."',
				quant_equipamentos_outros= '".$_POST['associacaoAvulsaIndex415']."',
				grava4='".$codigoPostoFixo."',
				valor_veiculo = '".$_POST['valor_veiculo']."' WHERE NUMEROSOLICITACAO = '".$_POST['NUMEROSOLICITACAO']."'";      

	$result = @mysql_query($sql,$db);
	if ($result)
	{
		//Somente se for SOMPO SEGUROS e ASSOCIAÇÕES
		if( $_POST['SEGURADORA']=="72" || $associacao=='sim')
		{
		
		$sql = "UPDATE ".$bancoDados.".vistoria_previa1 SET
				HRREPAROAVARIAS = '".$hora_funilaria."',
				HRREPARO = '".$hora_funilaria_outra."' WHERE NUMEROSOLICITACAO = '".$_POST['NUMEROSOLICITACAO']."'"; 
				
	$result = @mysql_query($sql,$db); 
	
if($_POST['audatex']=="1"){
	
//data da Cinto
$data_cinto = $_POST['dataCinto']{6}.$_POST['dataCinto']{7}.$_POST['dataCinto']{8}.$_POST['dataCinto']{9}.$_POST['dataCinto']{3}.$_POST['dataCinto']{4}.$_POST['dataCinto']{0}.$_POST['dataCinto']{1};	
	
$sql_extra_update_maritima = "UPDATE ".$bancoDados.".vistoria_extra SET
nome_condutor = '".$_POST['nome_condutor']."',
data_cinto = '".$data_cinto."',
hora_avaria = '".$hora_pintura."',
avaria_exclusao = '".$exclusao."',
peca_avaria_hora = '".$hora_funilaria_outra."',
valor_exclusao = '".$exclusao_outro."',	
combustivelAdaptado = '".$_POST['combustivelAdaptado']."',	    		
tipo_pessoa = '".$_POST['tipo_pessoa']."',
descricao_veiculo = '".$_POST['descricao_veiculo']."',
numero_inspecao = '".$_POST['numero_inspecao']."',
cilindros = '".$_POST['cilindros']."',
situacao_placa = '".$_POST['situacao_placa']."',
condicao_numero_motor = '".$_POST['condicao_numero_motor']."',
veiculo_blindado = '".$_POST['veiculo_blindado']."',
Codigo_Condicao_Chassi = '".$_POST['Codigo_Condicao_Chassi']."',
Reparos_Identificados_nas_Estruturas = '".$_POST['Reparos_Identificados_nas_Estruturas']."',
forma_carroc = '".$_POST['condicao_carroc']."',
documentacao = '".$_POST['restricao_crlv']."',
aro_pneus = '".$_POST['aro_pneus']."',
procedencia = '".$_POST['procedencia']."',
motor_regularizado='".$_POST['motor_regularizado']."',
qtde_cilindros='".$_POST['qtde_cilindros']."',
avaliacao = '".$_POST['avaliacao']."' 
WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'";
	}else{	
		$sql_extra_update_maritima = "UPDATE ".$bancoDados.".vistoria_extra SET
			nome_condutor = '".$_POST['nome_condutor']."',
			hora_avaria = '".$hora_pintura."',
			avaria_exclusao = '".$exclusao."',
			peca_avaria_hora = '".$hora_funilaria_outra."',
			valor_exclusao = '".$exclusao_outro."',		    		
			tipo_pessoa = '".$_POST['tipo_pessoa']."',
			descricao_veiculo = '".$_POST['descricao_veiculo']."',
			numero_inspecao = '".$_POST['numero_inspecao']."',
			cilindros = '".$_POST['cilindros']."',
			situacao_placa = '".$_POST['situacao_placa']."',
			condicao_numero_motor = '".$_POST['condicao_numero_motor']."',
			Codigo_Condicao_Chassi = '".$_POST['Codigo_Condicao_Chassi']."',
			Reparos_Identificados_nas_Estruturas = '".$_POST['Reparos_Identificados_nas_Estruturas']."',
			aro_pneus = '".$_POST['aro_pneus']."',
			avaliacao = '".$_POST['avaliacao']."' 
			WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'"; 
	}
	
$result_extra_update_maritima = @mysql_query($sql_extra_update_maritima,$db);
		}
		
//UPDATE EXTRA SANCOR
if($_POST['SEGURADORA']=="329")
		{
			
//data do Kit Gás   
$data_kitGas = $_POST['validadeKitGas']{6}.$_POST['validadeKitGas']{7}.$_POST['validadeKitGas']{8}.$_POST['validadeKitGas']{9}.$_POST['validadeKitGas']{3}.$_POST['validadeKitGas']{4}.$_POST['validadeKitGas']{0}.$_POST['validadeKitGas']{1};	   
			
$sql_extra_update = "UPDATE ".$bancoDados.".vistoria_extra SET
centro_custo = '".$_POST['kitGas']."',
nome_centro_custo = '".$data_kitGas."',
tipo_pessoa = '".$_POST['tipo_pessoa']."',
tipo_veiculo = '".$_POST['CDDESTVEIC']."',
situacao_placa = '".$_POST['condicao_placa']."',
descricao_veiculo = '".$_POST['	descricao_veiculo']."',
numero_inspecao = '".$_POST['numero_inspecao']."',
cilindros = '".$_POST['cilindros']."',
Cambio = '".$_POST['Cambio']."',
marchas = '".$_POST['marchas']."',
tipo_cabine = '".$_POST['tipo_cabina']."',
tipo_carga = '".$_POST['tipo_carga']."',
condicao_numero_motor = '".$_POST['condicao_numero_motor']."',
veiculo_blindado = '".$_POST['veiculo_blindado']."',
outra_restricao = '".$_POST['tipoBlindagem']."',
Codigo_Condicao_Chassi = '".$_POST['Codigo_Condicao_Chassi']."',
forma_carroc = '".$_POST['condicao_carroc']."',
documentacao = '".$_POST['restricao_crlv']."',
qtde_cilindros='".$_POST['qtde_cilindros']."',
Reparos_Identificados_nas_Estruturas = '".$_POST['Reparos_Identificados_nas_Estruturas']."',
aro_pneus = '".$_POST['aro_pneus']."',
avaliacao = '".$_POST['avaliacao']."' 
WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'";
$result_extra_update = @mysql_query($sql_extra_update,$db);
		}

//Somente se for ZURICH
if($_POST['SEGURADORA']=="39")
{
	
if($_POST['equip1']!=''){$eqp1=$_POST['equip1'].",";}else{$eqp1='';}
if($_POST['equip2']!=''){$eqp2=$_POST['equip2'].",";}else{$eqp2='';}
if($_POST['equip3']!=''){$eqp3=$_POST['equip3'].",";}else{$eqp3='';}
if($_POST['equip4']!=''){$eqp4=$_POST['equip4'].",";}else{$eqp4='';}
if($_POST['equip5']!=''){$eqp5=$_POST['equip5'].",";}else{$eqp5='';}

$equipamentos_prot=$eqp1.$eqp2.$eqp3.$eqp4.$eqp5;
	
$sql_extra_update_zurich = "UPDATE ".$bancoDados.".vistoria_extra SET
Cambio = '".$_POST['Cambio']."',
Plaquetas_Existentes = '".$_POST['Plaquetas_Existentes']."',
itens_seguranca = '".$equipamentos_prot."',
veiculo_rebaixado = '".$_POST['veiculo_rebaixado']."',
CPF_CNPJ_Renavam = '".$_POST['CPF_CNPJ_Renavam']."',		    		
avaliacao = '".$_POST['avaliacao']."',
capacidade_lotacao = '".$_POST['capacidade_lotacao']."',
marchas = '".$_POST['marchas']."',
bomba_injetora = '".$_POST['injecao_eletronica']."',
capacidade_veiculo = '".$_POST['capacidade_veiculo']."',
veiculo_turbinado = '".$_POST['veiculo_turbinado']."',
turbo_original = '".$_POST['turbo_original']."',
possui_rodoar = '".$_POST['possui_rodoar']."',
tipo_cabine = '".$_POST['tipo_cabine']."',
potencia = '".$_POST['potencia']."',
tp_vidros = '".$_POST['tp_vidros']."' WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'";

$result_extra_update_zurich = @mysql_query($sql_extra_update_zurich,$db);
}

	?>
<table width="100%" border="00" cellspacing="0" cellpadding="0">
      <tr>
        <td height="140" colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="31">&nbsp;</td>
        <td width="200" bgcolor="#0066CC"><div align="center" class="style1">Laudo <? echo $_POST['NRVISTORIA'];?>&nbsp;alterado</div></td>
        <td></td>
      </tr>
    </table>
    
  <? 
 ###################### VERIFICANFO COMENTÁRIOS DO LAUDO #############################################
// A VISTORIA ESTÁ SENDO LIBERADA PARA TRANSMISSÃO - ANÁLISE ENCERRADA
if($_POST['concluirAnalise']=='S')
	{
	// VERIFICA SE TEM COMENTÁRIOS
	$sql_mensagem = "SELECT * FROM ".$bancoDados.".comentarios WHERE solicitacao =".$_POST['NUMEROSOLICITACAO'];
	$result_mensagem = @mysql_query($sql_mensagem,$db);
	$mensagem = @mysql_fetch_array($result_mensagem);
	// SE TIVER COMENTÁRIOS
	if(@mysql_num_rows($result_mensagem)>0)
		{
	
			
		// SE COMENTÁRIO FOR DIFERENTE DE RESOLVISO, GRAVA COMENTÁRIO DE RESOLVIDO (POIS A VISTORIA FOI ENCERRADA)	
		if($mensagem['status']!='2' && ($_SESSION['permissao']==3 || $_SESSION['permissao']==10))
			{
			$iniciarMensagem="<b>Inserido em ".date('d/m/Y')." - ".date('H:i:s')." por: ".$_SESSION['nome']."</b><br/>";
			$sql = "UPDATE ".$bancoDados.".comentarios SET 
			status='2',
			mensagem='".strtoupper($mensagem['mensagem'])."".$iniciarMensagem."STATUS MODIFICADO AUTOMATICAMENTE PARA RESOLVIDO, POIS A VISTORIA FOI FINALIZADA E LIBERADA PARA TRANSMISSAO@'
			WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'";
			$result = @mysql_query($sql,$db);
			}
		}
		
	// VERIFICA SE TEM OBSERVAÇÃO RESTRITA
	$sql_obsRestrita = "SELECT * FROM ".$bancoDados.".observacaoRestrita WHERE solicitacao =".$_POST['NUMEROSOLICITACAO'];
	$result_obsRestrita = @mysql_query($sql_obsRestrita,$db);
	$obsRestrita = @mysql_fetch_array($result_obsRestrita);
	// SE TIVER COMENTÁRIOS
	if(@mysql_num_rows($result_obsRestrita)>0)
		{
	
			
	// SE OBSERVAÇÃO RESTRITA FOR DIFERENTE DE RESOLVISO, GRAVA OBSERVAÇÃO RESTRITA DE RESOLVIDO (POIS A VISTORIA FOI ENCERRADA)	
		if($obsRestrita['status']!='2' && ($_SESSION['permissao']==3 || $_SESSION['permissao']==10))
			{
			$iniciarMensagem_obsRestrita="<b>Inserido em ".date('d/m/Y')." - ".date('H:i:s')." por: ".$_SESSION['nome']."</b><br/>";
			$sql_2 = "UPDATE ".$bancoDados.".observacaoRestrita SET 
			status='2',
			mensagem='".strtoupper($obsRestrita['mensagem'])."".$iniciarMensagem_obsRestrita."STATUS MODIFICADO AUTOMATICAMENTE PARA RESOLVIDO, POIS A VISTORIA DESTE AGENDAMENTO FOI FINALIZADA E LIBERADA PARA TRANSMISSAO@'
			WHERE solicitacao = '".$_POST['NUMEROSOLICITACAO']."'";
			$result_2 = @mysql_query($sql_2,$db);
			}
		}
	}

##################################################################################################### 
  
  
############################ ENVIAR PARA O LOTE AUTOMATICAMENTE ####################################
 

// pertence a outro ambiente, então não envia para a seguradora e sim para o outro ambiente		
if($clienteOrigem!='' || $solicitacaoOrigem!=''){  
	$url_transmissao = "window.open('./finalizarOutroAmbiente.php?id=".$_POST['NUMEROSOLICITACAO']."&z=".base64_encode($clienteOrigem."|@@|".$solicitacaoOrigem."|@@|".$vistoriadorOrigem)."')";	
	}else{ 
 
 
 
 if( $finalizaAnalise['finalizarAutomatico']=='sim' && $_POST['concluirAnalise']=='S' ) 
 	{
		$finalizaAutomatico='nao';
		 if($_POST['SEGURADORA']=='0')
			{
			if($sol['audatex']==1){
					$autoFinalizar="./xml_bradesco/bradesco.php?id=".$_POST['NUMEROSOLICITACAO'];	
					}else{
						$autoFinalizar="./xml_bradesco/finalizarBare.php?id=".$_POST['NUMEROSOLICITACAO'];      
						}	
			$finalizaAutomatico='sim';
			}
			
			
		if($_POST['SEGURADORA']=='72')
			{
			$autoFinalizar="./xml_yasuda/yasuda.php?id=".$_POST['NUMEROSOLICITACAO'];	
			/*if($sol['audatex']==1){
					$autoFinalizar="./xml_maritima/maritima.php?id=".$_POST['NUMEROSOLICITACAO'];	
					}else{
						$autoFinalizar="./finalizar13.php?id=".$_POST['NUMEROSOLICITACAO'];
						}*/
			$finalizaAutomatico='sim';
			}
			
		if($_POST['SEGURADORA']=='87')
			{
			$autoFinalizar="./finalizar87.php?id=".$_POST['NUMEROSOLICITACAO'];	
			$finalizaAutomatico='sim';
			}
			
			
			
			
			
		// ASSOCIAÇÕES exceto HAWK(200) e ENGER(201)
		if($associacao=='sim' && ($_POST['SEGURADORA']<200||$_POST['SEGURADORA']>301)){
				$autoFinalizar="./finalizarPorEmail.php?id=".$_POST['NUMEROSOLICITACAO'];	
				$finalizaAutomatico='sim';
				}
				

				

		?> 
        <iframe style="width:1px; height:1px; top:-10px; left:-10px" src="<? echo $autoFinalizar;?>"> </iframe>
        <?
		if($finalizaAutomatico=='sim'){
	echo "<center><h2>Est&aacute; vistoria est&aacute; sendo transmitida automaticamente!</h2></center>";
		}
		
	 }

		
 if( $_POST['concluirAnalise']=='S' && $_SESSION['roteirizador']=='230' && $_POST['SEGURADORA']=='416') 
 	{
			
		$autoFinalizar="./finalizarControle.php?id=".$_POST['NUMEROSOLICITACAO'];	
		$finalizaAutomatico='sim';
				
		
		?> 
        <iframe style="width:1px; height:1px; top:-10px; left:-10px" src="<? echo $autoFinalizar;?>"> </iframe>
        <?
		if($finalizaAutomatico=='sim'){
	echo "<center><h2>Vistoria liberada para Seguradora/Cliente!</h2></center>";
		}
		
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