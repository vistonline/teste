<?
session_start();
//include "conecta.php";
include "../../../adm/conecta.php";

header('Content-type: application/msexcel');
header('Content-Disposition: attachment; filename="arquivo.xls"');    

if($_POST['permissao']=='90')
{
	
		$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_vistoria2 = "SELECT DISTINCT(controle_prest) FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND controle_prest IN (".$_POST['usuario'].") AND roteirizador=".$_SESSION['roteirizador'];
$result_vistoria2 = @mysql_query($sql_vistoria2,$db);
while ($resultado_vistoria2 = @mysql_fetch_assoc($result_vistoria2)){
			$temVP.=$resultado_vistoria2['controle_prest'].",";
			}
		
$controle_prest = explode(",", $temVP);
$contador=0;

while($contador<=sizeof($controle_prest)){
		
	$sql_vistoria = "SELECT vp.*,u.nome,s.cidade  FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".user u, ".$bancoDados.".solicitacao s  WHERE vp.controle_prest=u.id AND vp.NUMEROSOLICITACAO=s.id AND vp.DTVISTORIA >= ".$data_inicial." AND vp.DTVISTORIA <= ".$data_final." AND vp.controle_prest = ".$controle_prest[$contador]." AND vp.roteirizador=".$_SESSION['roteirizador']." order by vp.SEGURADORA";
	
	$result_vistoria = @mysql_query($sql_vistoria,$db);
	if (@mysql_num_rows($result_vistoria)>0)
	 	{	
		
		
		$mensagem.="
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td height='27' class='fora4'><b>SEGURADORA</b></td>
<td height='27' class='fora4'><b>N&Uacute;MERO DA VISTORIA</b></td>
<td height='27' class='fora4'><center><b>LOCAL VISTORIA</b></center></td>
<td height='27' class='fora4'><b>PLACA</b></td>
<td height='27' class='fora4'><b>CHASSI</b></td>
<td height='27' class='fora4'><b>NOME PROPONENTE</b></td>
<td height='27' class='fora4'><b>CIDADE</b></td>
<td height='27' class='fora4'><b>DATA VISTORIA</b></td>
<td height='27' class='fora4'><center><b>DATA CADASTRO</b></center></td>
<td height='27' class='fora4'><center><b>DATA TRANSMISS&Atilde;O</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO CADASTRO</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO TRANSMISS&Atilde;O</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO FOTOS</b></center></td>
<td height='27' class='fora4'><center><b>VISTMOBILE</b></center></td>
<td height='27' class='fora4'><b>VISTORIADOR</b></td>
</tr>";

	while($reg = @mysql_fetch_array($result_vistoria))
	{
	
	/*$sql_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$reg['NUMEROSOLICITACAO'];
	$result_solicitacao = @mysql_query($sql_solicitacao,$db);
	$solicitacao = @mysql_fetch_array($result_solicitacao);*/
	
	$data_vistoria = $reg['DTVISTORIA']{6}.$reg['DTVISTORIA']{7}."/".$reg['DTVISTORIA']{4}.$reg['DTVISTORIA']{5}."/".$reg['DTVISTORIA']{0}.$reg['DTVISTORIA']{1}.$reg['DTVISTORIA']{2}.$reg['DTVISTORIA']{3};
	$data_cadastro = $reg['DTPROC']{6}.$reg['DTPROC']{7}."/".$reg['DTPROC']{4}.$reg['DTPROC']{5}."/".$reg['DTPROC']{0}.$reg['DTPROC']{1}.$reg['DTPROC']{2}.$reg['DTPROC']{3};
	
	if($reg['DTTRANS']>0){
	$data_transmissao = substr($reg['DTTRANS'],6,2)."/".substr($reg['DTTRANS'],4,2)."/".substr($reg['DTTRANS'],0,4);
	}else{
		$data_transmissao = "N/T";
		}
	
		/*$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg['controle_prest'];
		$result_user = @mysql_query($sql_user,$db);
		$user = @mysql_fetch_array($result_user);*/
		switch($reg['SEGURADORA'])
		{
		   case "0":  $filtro='Bradesco Seguros';break;
		   case "20": $filtro='BONE';break; 
		   case "21": $filtro='MULTCAR';break; 
		   case "22": $filtro='RODOTRUCK';break; 
		   case "23": $filtro='ACE';break;
		   case "24": $filtro='VERTICE';break;
		   case "25": $filtro='TRUST';break;
		   case "26": $filtro='ZURICH GARANTIA';break;
		   case "30": $filtro='ASSETRAC';break;       
		   case "31": $filtro='BUREAU DE BENEFICIOS';break;
		   case "32": $filtro='ASSUTRAN';break;
		   case "33": $filtro='AVANT';break;
		   case "34": $filtro='ACAN';break;
		   case "35": $filtro='ASSIST';break;
		   case "36": $filtro='APROCAM BRASIL';break;
		   case "37": $filtro='MAPFRE WARRANTY';break;
		   case "38": $filtro='BB SEGUROS';break;
		   case "39": $filtro='ZURICH';break;
		   case "40": $filtro='ALFA SEGUROS';break;            
		   case "41": $filtro='AXA SEGUROS';break;
		   case "42": $filtro='BANETES SEGUROS';break;  
		   case "43": $filtro='BRASIL VEIC.CIA SEG.';break;       
		   case "44": $filtro='CAIXA SEGURADORA';break;  
		   case "45": $filtro='CARDIF DO BRASIL SEG.';break;   
		   case "46": $filtro='CHUBB';break;     
		   case "47": $filtro='MINAS BRASIL';break;       
		   case "48": $filtro='CIA DE SEG. A BAHIA';break;   
		   case "49": $filtro='CIA MUTUAL DE SEGUROS';break; 
		   case "50": $filtro='CONAPP';break; 
		   case "51": $filtro='CONFIANCA';break;
		   case "53": $filtro='GENERALI';break; 
		   case "54": $filtro='GENTE SEGURADORA';break;
		   case "55": $filtro='HDI';break;
		   case "56": $filtro='HSBC SEGUROS';break;
		   case "57": $filtro='INDIANA SEGUROS';break;
		   case "59": $filtro='LIBERTY';break;
		   case "60": $filtro='MAPFRE SEGUROS';break;
		   case "61": $filtro='MARITIMA';break;
		   case "62": $filtro='PORTO SEGURO';break;
		   case "63": $filtro='REAL SEGUROS';break; 
		   case "64": $filtro='ROYAL & SUNALLIANCE';break;
		   case "65": $filtro='SAFRA VIDA E PREV.';break;
		   case "67": $filtro='SUL AMERICA';break;
		   case "69": $filtro='TOKIO MARINE';break;
		   case "70": $filtro='UNIBANCO AIG SEG.';break;
		   case "71": $filtro='VERA CRUZ';break;
		   case "72": $filtro='YASUDA SEGUROS';break;
		   case "73": $filtro='ALLIANZ';break;
		   case "74": $filtro='APROVSUL';break;        
		   case "75": $filtro='APTRANS';break;         
		   case "76": $filtro='CREDIPE';break;
		   case "83": $filtro='MITSUI';break;
		   case "85": $filtro='ITAU SEGUROS';break;
		   case "86": $filtro='ASCARPE';break;
		   case "87": $filtro='NOBRE SEGUROS';break;
		   case "200": $filtro='HAWK';break;
		   case "201": $filtro='ENGER';break;
		   case "202": $filtro='NORDESTE';break;
		   case "203": $filtro='GETEK';break;
		   case "204": $filtro='TUV VISTORIAS';break;
		   case "205": $filtro='SINTESE SEGUROS';break;
		   case "314": $filtro='UNIPROPAS';break;
		   case "319": $filtro='CAR SOLUCOES';break;
		   case "320": $filtro='ASPEM';break;
		   case "321": $filtro='ASPROL';break;
		   case "322": $filtro='G&G SOLUCOES';break;
		   case "323": $filtro='CONSORCIO';break;
		   case "324": $filtro='AUTO TRUCK';break;
		   case "325": $filtro='ABV';break;
		   case "326": $filtro='QV SERVICOS';break;
		   case "327": $filtro='PROTECT 24HS';break;
		   case "328": $filtro='FINANCEIRA';break;
		   case "329": $filtro='SANCOR';break;
		   case "330": $filtro='ASTRO';break;
		   case "331": $filtro='ASTRAMAR';break;
		   case "332": $filtro='APROVESC';break;
		   case "333": $filtro='UNIBEM';break;
		   case "334": $filtro='COOPERTRUCK';break;
		   case "335": $filtro='PROAUTO';break;
		   case "336": $filtro='PERFECT';break;
		   case "337": $filtro='MELHOR';break;
		   case "338": $filtro='AMV BRASIL';break;     
		   case "339": $filtro='MELHOR PESADOS';break;
		   case "340": $filtro='ALICERCE';break;
		   case "341": $filtro='AVANTI';break;
		   case "342": $filtro='TOPPREV';break;
		   case "343": $filtro='AGUARDA';break;
		   case "344": $filtro='NACIONAL TRUCK';break;
			case "345": $filtro='EXPRESSO TRUCK';break;
			case "346": $filtro='BRASMIG';break;
			case "347": $filtro='ASTRANS';break;
			case "348": $filtro='APVS';break;
			case "349": $filtro='ASCAMP';break;
			case "350": $filtro='CLUBE FONFON';break;
			case "351": $filtro='BR TRUCK';break;
			case "353": $filtro='UNIVERSO ASSISTENCIA';break;
			case "354": $filtro='MAXIMA';break;
			case "355": $filtro='FOCUS';break;
			case "356": $filtro='LOTUS';break;
			case "357": $filtro='ALLIANCE APV';break;
			case "358": $filtro='VISTRIM';break;
			case "359": $filtro='AGV BRASIL';break;
			case "360": $filtro='ALIANÇA TRUCK CAR';break;
			case "361": $filtro='EUROCAR';break;
			case "362": $filtro='AMPLA';break;
			case "363": $filtro='ASCOBOM';break;
			case "364": $filtro='ASPROAUTO';break;
			case "365": $filtro='CAMBRALIA';break;
			case "366": $filtro='COPOM';break;
			case "367": $filtro='ASSOCIACAO DE AJUDA MUTUA A3';break;
			case "368": $filtro='MEGA BENEFICIOS';break;
			case "369": $filtro='UNIAUTO PROTECAO';break;
			case "370": $filtro='AUTO CARROS';break;
			case "371": $filtro='AUTOMINAS';break;
			case "372": $filtro='AVAP';break;
			case "373": $filtro='BRASIL COOPERATIVA';break;
			case "374": $filtro='CARVISA';break;
			case "375": $filtro='CENTRO SOCIAL CABOS SOLDADOS';break;
			case "376": $filtro='APVS ESPIRITO SANTO';break;
			case "377": $filtro='COOPEV';break;
			case "378": $filtro='COPA 190';break;
			case "379": $filtro='EFICAZ';break;
			case "380": $filtro='FACIL CLUBE DE BENEFICIOS';break;
			case "381": $filtro='GARANT CLUBE DE BENEFICIOS MUTUOS';break;
			case "382": $filtro='GENESIS BENEFICIOS';break;
			case "383": $filtro='LIDERANCA CLUBE DE ASSISTENCIA';break;
			case "384": $filtro='UNIPROV - ESPIRITO SANTO';break;
			case "385": $filtro='UNIPROV - RONDONIA';break;
			case "386": $filtro='MASTER CLUBE DE ASSISTENCIA VEICULAR';break;
			case "387": $filtro='MASTER TRUCK';break;
			case "388": $filtro='PLANCAR PRIME PROTECAO VEICULAR';break;
			case "389": $filtro='PRIME PROTECAO VEICULAR';break;
			case "390": $filtro='PROTEMINAS';break;
			case "391": $filtro='REDE CARS CLUBE DE BENEFICIOS';break;
			case "392": $filtro='SAVE-CAR';break;
			case "393": $filtro='UNIBRAS ASSOCIACAO DE AUTO PROTECAO';break;
			case "394": $filtro='UNIVERSO CLUBE DE ASSISTENCIA';break;
			case "395": $filtro='VISTOP SERVICOS TECNICOS';break;
			case "396": $filtro='EMBRACON';break;
			case "397": $filtro='NET CAR CLUBE';break;
			case "398": $filtro='MOTOCAR CLUBE';break;
			case "399": $filtro='EXCELENCIA';break;
			case "400": $filtro='APVS VISTA ALEGRE';break;
			case "401": $filtro='CAUTELAR';break;
			case "402": $filtro='EXCLUSIVE';break;
			case "403": $filtro='TRADICAO';break;
			case "404": $filtro='DIAMOND MOTORS';break;
			case "405": $filtro='CHERY MOTORS';break;
			case "406": $filtro='AVEP';break;
			case "407": $filtro='VIVA CONSORCIOS';break;
			case "408": $filtro='AUTOVALORE';break;
			case "409": $filtro='GFCAR';break;
			case "410": $filtro='PREVINE';break;
			case "411": $filtro='CLUBE SERVICE';break;
			case "412": $filtro='UNIBRA';break;
			case "413": $filtro='SOMA TRACK';break;
			case "100": $filtro='USEBENS';break;
			case "101": $filtro='QBE';break;
			case "102": $filtro='POINTER';break;
			case "103": $filtro='CIELO';break;
			case "414": $filtro='TIRADENTES';break;
			case "415": $filtro='PARTICULAR';break;
			case "416": $filtro='SOLTEL';break;
			case "417": $filtro='TOP CAR';break;
			case "418": $filtro='PROTEGIDO';break;
			case "419": $filtro='ULTRA BRASIL';break;
			case "420": $filtro='UNION SOLUTIONS';break;
			case "421": $filtro='MASTER CLUBE UBERLANDIA';break;
			case "422": $filtro='MUNDIAL';break;
			case "423": $filtro='SIMPLIFICAR';break;
			case "424": $filtro='CLEAN';break;
			case "425": $filtro='ALLIDER';break;
			case "426": $filtro='APROTEVE';break;
			case "427": $filtro='E-NOVATE';break;
			case "428": $filtro='ASTRACO';break;
			case "429": $filtro='ROTA';break;
			case "430": $filtro='ULTRA';break;
			case "431": $filtro='UNICOON PARANA';break;
			case "432": $filtro='PROTEAUTO';break;
			case "433": $filtro='APVS SUDESTE';break;
			case "434": $filtro='CLUBE UNIR';break;
			case "435": $filtro='APM';break;
			case "436": $filtro='MASTER-CONSULTOR';break;
			case "437": $filtro='HM PROTECAO';break;
			case "438": $filtro='CLUBCAR';break;
		    case "439": $filtro='AZUL CLUBE';break;
			case "440": $filtro='GOL PLUS BRASIL';break;
			case "441": $filtro='ESTILO PROTECAO';break;
			case "442": $filtro='PHP PROTECAO';break;
			case "443": $filtro='ACERTT';break;
			case "444": $filtro='APVA';break;
			case "445": $filtro='ASTRAC';break;
			case "446": $filtro='SEGURYCAR';break;
			case "447": $filtro='VITALLYS BRASIL';break;
			case "448": $filtro='BRASIL CAR';break;
			case "449": $filtro='UNIDAS';break;
			case "450": $filtro='ELLO';break;
			case "451": $filtro='UNICOON CONTAGEM';break;
			case "452": $filtro='FOCAR BRASIL';break;
			case "453": $filtro='PLACAR VEICULAR';break;
			case "454": $filtro='PROTECAR';break;
			case "455": $filtro='UCA MELHOR';break;
			case "456": $filtro='PROTEAUTO MARINGA';break;
			case "457": $filtro='AUTO VIP';break;
			case "458": $filtro='PRONTOCAR';break;
			case "459": $filtro='PENSAR CLUBE';break;
			case "460": $filtro='AUTO BAHIA';break;
			case "461": $filtro='MAXIMUS BRASIL';break;
			case "462": $filtro='PROTECT';break;
	   	}
	
			switch ($reg['TPVISTORIA']){
			case 'V': $local = "VOLANTE"; break;
			case 'P': $local = "POSTO"; break;
			case 'D': $local = "VOLANTE"; break;
			case 'F': $local = "POSTO"; break;
			default: break;
			}	

if($reg['pda']==1){
		$vistMobile='SIM';
		}else{
			$vistMobile='NAO';
			}
		
if($reg['DTTRANS']==$reg['DTVISTORIA']){
	$prazo_trans=0;
	}
	elseif($reg['DTTRANS']==0){
	$prazo_trans='';
		}else{
			$prazo_trans=date('d', mktime(0,0,0, substr($reg['DTTRANS'],4,2)-substr($reg['DTVISTORIA'],4,2) , substr($reg['DTTRANS'],6,2)-substr($reg['DTVISTORIA'],6,2)  , substr($reg['DTTRANS'],0,4)-substr($reg['DTVISTORIA'],0,4)));
			}
			
if($reg['DTPROC']==$reg['DTVISTORIA']){
	$prazo_cadastro=0;
	}
	else{
			$prazo_cadastro=date('d', mktime(0,0,0, substr($reg['DTPROC'],4,2)-substr($reg['DTVISTORIA'],4,2) , substr($reg['DTPROC'],6,2)-substr($reg['DTVISTORIA'],6,2)  , substr($reg['DTPROC'],0,4)-substr($reg['DTVISTORIA'],0,4)));
			}	
		
$sql_fotosDT = "SELECT data FROM ".$bancoDados.".fotos WHERE id = ".$reg['NUMEROSOLICITACAO']." ORDER BY contagem DESC LIMIT 0 , 1";
	$result_fotosDT = @mysql_query($sql_fotosDT,$db);
	$dataFoto = @mysql_fetch_assoc($result_fotosDT);
	$dtFoto=$dataFoto['data'];
		
	if($dtFoto=='' || $dtFoto=='null' || $dtFoto=='NULL'){
		$dtFoto=date('Ymd');
		}
		
		
	if($dtFoto==$reg['DTPROC']){
	$prazo_foto=0;
	}
	else{
		
		$mkRealizacao=mktime(0,0,0, substr($reg['DTPROC'],4,2), substr($reg['DTPROC'],6,2) , substr($reg['DTPROC'],0,4));
		$mkDiaFoto=mktime(0,0,0, substr($dtFoto,4,2), substr($dtFoto,6,2) , substr($dtFoto,0,4));
		$dias=mktime(0,0,0, $mkRealizacao-$mkDiaFoto+1); 
		
		$prazo_foto=($mkDiaFoto-$mkRealizacao)/86400;  
		
			}
		
		
	$mensagem.="<tr><td>".strtoupper($filtro)."</td><td>".$reg['NRVISTORIA']."</td><td><center>".strtoupper($local)."</center></td><td>".strtoupper($reg['NRPLACA'])."</td><td>".strtoupper($reg['NRCHASSI'])."</td><td>".strtoupper($reg['NMPROPONENTE'])."</td><td>".strtoupper($reg['cidade'])."</td><td><center>".$data_vistoria."</center></td><td><center>".$data_cadastro."</center></td><td><center>".$data_transmissao."</center></td><td><center>".$prazo_cadastro."</center></td><td><center>".$prazo_trans."</center></td><td><center>".$prazo_foto."</center></td><td><center>".$vistMobile."</center></td><td>".strtoupper($reg['nome'])."</td></tr>";    
	}
	
$mensagem.="<tr><td colspan='8'><b>Quantidade total de vistorias : ".(@mysql_num_rows($result_vistoria))."</b></td></tr>";  
$mensagem.="<tr><td colspan='8'></td></tr>";  
echo $mensagem;
		}
		
$mensagem = '';
$contador++;

}

}

if($_POST['permissao']=='1' || $_POST['permissao']=='1@1')
{
//header('Content-type: application/msexcel');
header('Content-type: application/vnd.ms-excel');

/*	// verifica se empresa está integrada
	$sql_integrado = "SELECT integrado,cod_filho,empresa FROM ".$bancoDados.".user WHERE id = ".$_SESSION['roteirizador'];
	$result_integrado = @mysql_query($sql_integrado,$db);
	$integrado = mysql_fetch_assoc($result_integrado);
	
	$sql_integrado2 = "SELECT cod_pai FROM webvist_".$integrado['cod_filho'].".user WHERE cod_filho = ".$_SESSION['roteirizador'];
	$result_integrado2 = @mysql_query($sql_integrado2,$db);
	$integrado2 = mysql_fetch_assoc($result_integrado2);*/
	

	$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};

	if($_POST['usuario']!=='TODOS')
	{
		
		 if( $_POST['permissao']=='1@1' ){
			 
			 $controle_prest = "AND controle_prest = ".$_SESSION['id']." AND controle_prest_filho = ".$_POST['usuario']." "; 
			

			 }else{
				$controle_prest = "AND controle_prest = ".$_POST['usuario']."";
				 }
		//$controle_prest_filho = "AND controle_prest_filho = ".$_POST['usuario']."";
	}
	else
	{
		
		if( $_POST['permissao']=='1@1' ){
			$controle_prest = "AND controle_prest = ".$_SESSION['id'];
			}else{
				$controle_prest = '';
				}
		
		
		//$controle_prest_filho = "AND controle_prest_filho !=''";
	}


/*	if($integrado['integrado']=='sim'){
		$sql_vistoria = "
		SELECT roteirizador,NUMEROSOLICITACAO,DTVISTORIA,HRVISTORIA,DTTRANS,controle_prest_filho,controle_prest,SEGURADORA,TPVISTORIA,NRVISTORIA,NRPLACA,NRCHASSI,NMPROPONENTE,valorb,pda,hora_criacao,DTPROC FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." ".$controle_prest." AND roteirizador= ".$_SESSION['roteirizador']." UNION
		SELECT roteirizador,NUMEROSOLICITACAO,DTVISTORIA,HRVISTORIA,DTTRANS,controle_prest_filho,controle_prest,SEGURADORA,TPVISTORIA,NRVISTORIA,NRPLACA,NRCHASSI,NMPROPONENTE,valorb,pda,hora_criacao,DTPROC FROM webvist_".$integrado['cod_filho'].".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND controle_prest = ".$integrado2['cod_pai']." AND roteirizador= ".$integrado['cod_filho']." ".$controle_prest_filho." ";
		}else{	
			$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." ".$controle_prest." AND roteirizador= ".$_SESSION['roteirizador']." ";
		}*/


	 $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." ".$controle_prest." AND roteirizador= ".$_SESSION['roteirizador']." ";

	$result_vistoria = @mysql_query($sql_vistoria,$db);

	$mensagem.="
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td height='27' class='fora4'><center><b>SEGURADORA</b></center></td>
<td height='27' class='fora4'><center><b>CORRETORA</b></center></td>
<td height='27' class='fora4'><center><b>N&Uacute;MERO VISTORIA</b></center></td>
<td height='27' class='fora4'><center><b>N&Uacute;MERO SOLICITACAO</b></center></td>
<td height='27' class='fora4'><center><b>LOCAL VISTORIA</b></center></td>
<td height='27' class='fora4'><center><b>PLACA</b></center></td>
<td height='27' class='fora4'><center><b>CHASSI</b></center></td>
<td height='27' class='fora4'><center><b>NOME PROPONENTE</b></center></td>
<td height='27' class='fora4'><center><b>NOME DO VISTORIADOR</b></center></td>
<td height='27' class='fora4'><center><b>CIDADE</b></center></td>
<td height='27' class='fora4'><center><b>CIDADE RECEBIDA</b></center></td>
<td height='27' class='fora4'><center><b>DATA AGENDAMENTO</b></center></td>
<td height='27' class='fora4'><center><b>DATA VISTORIA</b></center></td>
<td height='27' class='fora4'><center><b>HORA VISTORIA</b></center></td>
<td height='27' class='fora4'><center><b>DATA CADASTRO</b></center></td>
<td height='27' class='fora4'><center><b>HORA CADASTRO</b></center></td>
<td height='27' class='fora4'><center><b>DATA TRANSMISS&Atilde;O</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO REALIZACAO</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO CADASTRO</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO TRANSMISS&Atilde;O</b></center></td>
<td height='27' class='fora4'><center><b>PRAZO FOTOS</b></center></td>
<td height='27' class='fora4'><center><b>VISTMOBILE</b></center></td>
<td height='27' class='fora4'><center><b>VALOR R$</b></center></td>
</tr>";   
	$linha=1;
	while($reg = @mysql_fetch_array($result_vistoria))
	{
		   

	$sql_sol = "SELECT corretor,numero_susep,cd_corretor,dia,proposta,agendamento,apolice,voucher,numero_inspecao,numero_laudo_informado FROM ".$bancoDados.".solicitacao WHERE id=".$reg['NUMEROSOLICITACAO']." AND roteirizador= ".$_SESSION['roteirizador']." ";
	$result_sol = @mysql_query($sql_sol,$db);
	$sol = @mysql_fetch_array($result_sol);
	
	$dataAgenda=substr($sol['dia'],6,2)."/".substr($sol['dia'],4,2)."/".substr($sol['dia'],0,4);
	
	
	switch ($reg['SEGURADORA']){
	  case 0 : if($solicitacao['proposta']==''){$solicita = $vistoria['NUMEROSOLICITACAO'];}else{$solicita = $solicitacao['proposta'];} break; 
	  case 20 : $solicita = $reg['proposta']; break;
	  case 44 : $solicita = $sol['proposta']; break;
	  case 38 : $solicita = $sol['proposta']; break;
	  case 53 : $solicita = $reg['NUMEROSOLICITACAO']; break;
	  case 39 : $solicita = $reg['proposta']; break;
	  case 55 : $solicita = $sol['proposta']; break;
	  case 59 : $solicita = $sol['agendamento']; break;
	  case 60 : $solicita = $sol['proposta']; break;
	  case 37 : $solicita = $sol['proposta']; break;
	  case 72 : $solicita = $sol['proposta']; break;
	  case 73 : if($sol['apolice']!=''){$solicita = substr($sol['apolice'],0,9);}else{$solicita = $sol['voucher'];} break;
	  case 67 : $solicita = $sol['proposta']; break;
	  case 69 : $solicita = $sol['proposta']; break;
	  case 83 : $solicita = $sol['numero_inspecao']; break;
	  case 61 : $solicita = $sol['numero_inspecao']; break;
	  case 62 : $solicita = $sol['numero_laudo_informado']; break;
	  case 87 : $solicita = $reg['NUMEROSOLICITACAO']; break;
	  case 201 : $solicita = $sol['proposta']; break;
	  case 202 : $solicita = $sol['proposta']; break;
	  default: $solicita = $reg['NUMEROSOLICITACAO']; break;
	  }
	
	
	if($solicita==''){
		$solicita = $reg['NUMEROSOLICITACAO'];
		}
		
	if($reg['NMCORRETOR']==''){
	$corretor=$sol['corretor'];
	}else{
		$corretor=$reg['NMCORRETOR'];
		}	
		
		
		
		
		if($reg['roteirizador']==$integrado['cod_filho']){
			$destaca=";font-weight:bold; font-style:italic";
			}else{
				$destaca="";
				}
		if ($linha>0){
			$corLinha="style='background-color:#FFF ".$destaca."'";
			}else{
				$corLinha="style='background-color:#E6E8FA ".$destaca."'";
				}
	
	if($reg['roteirizador']==$integrado['cod_filho']){
		$sql_solicitacao = "SELECT * FROM webvist_".$integrado['cod_filho'].".solicitacao WHERE id = ".$reg['NUMEROSOLICITACAO'];
		}else{
			$sql_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$reg['NUMEROSOLICITACAO'];
			}
	
	$result_solicitacao = @mysql_query($sql_solicitacao,$db);
	$solicitacao = @mysql_fetch_array($result_solicitacao);
	
	if($reg['NUMEROSOLICITACAO'])
	
	$data_vistoria = $reg['DTVISTORIA']{6}.$reg['DTVISTORIA']{7}."/".$reg['DTVISTORIA']{4}.$reg['DTVISTORIA']{5}."/".$reg['DTVISTORIA']{0}.$reg['DTVISTORIA']{1}.$reg['DTVISTORIA']{2}.$reg['DTVISTORIA']{3};
	$data_cadastro = $reg['DTPROC']{6}.$reg['DTPROC']{7}."/".$reg['DTPROC']{4}.$reg['DTPROC']{5}."/".$reg['DTPROC']{0}.$reg['DTPROC']{1}.$reg['DTPROC']{2}.$reg['DTPROC']{3};
	$hora_cadastro =substr($reg['hora_criacao'],0,2).":".substr($reg['hora_criacao'],2,2);
	$hora_vistoria =substr($reg['HRVISTORIA'],0,2).":".substr($reg['HRVISTORIA'],2,2);
	
	if($reg['pda']==1){
		$vistMobile='SIM';
		}else{
			$vistMobile='NAO';
			}
	
	$data_trans1 = $reg['DTTRANS']{6}.$reg['DTTRANS']{7}."/".$reg['DTTRANS']{4}.$reg['DTTRANS']{5}."/".$reg['DTTRANS']{0}.$reg['DTTRANS']{1}.$reg['DTTRANS']{2}.$reg['DTTRANS']{3};
	if(strlen($data_trans1)<8){
	$data_trans='<span style="color:#F00">NAO TRANSMITIDA</span>';
	}else{
		$data_trans=$data_trans1;
		}
	
		if($reg['roteirizador']==$integrado['cod_filho'] || $_POST['permissao']=='1@1'){
			$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg['controle_prest_filho'];
			}else{
				$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg['controle_prest'];
				}
		
		$result_user = @mysql_query($sql_user,$db);
		$user = @mysql_fetch_array($result_user);
		
		switch($reg['SEGURADORA'])
		{
		   case 0 : $filtro='Bradesco Seguros';break;
		   case 20: $filtro='BONE';break; 
		   case 21: $filtro='MULTCAR';break; 
		   case 22: $filtro='RODOTRUCK';break; 
		   case 23: $filtro='ACE';break;
		   case 24: $filtro='VERTICE';break;
		   case 25: $filtro='TRUST';break;
		   case 26: $filtro='ZURICH GARANTIA';break;
		   case 30: $filtro='ASSETRAC';break;       
		   case 31: $filtro='BUREAU DE BENEFICIOS';break;
		   case 32: $filtro='ASSUTRAN';break;
		   case 33: $filtro='AVANT';break;
		   case 34: $filtro='ACAN';break;
		   case 35: $filtro='ASSIST';break;
		   case 36: $filtro='APROCAM BRASIL';break;
		   case 37: $filtro='MAPFRE WARRANTY';break;
		   case 38: $filtro='BB SEGUROS';break;
		   case 39: $filtro='ZURICH';break;
		   case 40: $filtro='ALFA SEGUROS';break;            
		   case 41: $filtro='AXA SEGUROS';break;
		   case 42: $filtro='BANETES SEGUROS';break;  
		   case 43: $filtro='BRASIL VEIC.CIA SEG.';break;       
		   case 44: $filtro='CAIXA SEGURADORA';break;  
		   case 45: $filtro='CARDIF DO BRASIL SEG.';break;   
		   case 46: $filtro='CHUBB';break;     
		   case 47: $filtro='MINAS BRASIL';break;       
		   case 48: $filtro='CIA DE SEG. A BAHIA';break;   
		   case 49: $filtro='CIA MUTUAL DE SEGUROS';break; 
		   case 50: $filtro='CONAPP';break; 
		   case 51: $filtro='CONFIANCA';break;
		   case 53: $filtro='GENERALI';break; 
		   case 54: $filtro='GENTE SEGURADORA';break;
		   case 55: $filtro='HDI';break;
		   case 56: $filtro='HSBC SEGUROS';break;
		   case 57: $filtro='INDIANA SEGUROS';break;
		   case 59: $filtro='LIBERTY';break;
		   case 60: $filtro='MAPFRE SEGUROS';break;
		   case 61: $filtro='MARITIMA';break;
		   case 62: $filtro='PORTO SEGURO';break;
		   case 63: $filtro='REAL SEGUROS';break; 
		   case 64: $filtro='ROYAL & SUNALLIANCE';break;
		   case 65: $filtro='SAFRA VIDA E PREV.';break;
		   case 67: $filtro='SUL AMERICA';break;
		   case 69: $filtro='TOKIO MARINE';break;
		   case 70: $filtro='UNIBANCO AIG SEG.';break;
		   case 71: $filtro='VERA CRUZ';break;
		   case 72: $filtro='YASUDA SEGUROS';break;
		   case 73: $filtro='ALLIANZ';break;
		   case 74: $filtro='APROVSUL';break;        
		   case 75: $filtro='APTRANS';break;         
		   case 76: $filtro='CREDIPE';break;
		   case 83: $filtro='MITSUI';break;
		   case 85: $filtro='ITAU SEGUROS';break;
		   case 86: $filtro='ASCARPE';break;
		   case 87: $filtro='NOBRE SEGUROS';break;
		   case 88: $filtro='COMCARGA';break;
		   case 89: $filtro='APROCAM';break;
		   case 95: $filtro='ASSOFINSP';break;
		   case 96: $filtro='APPA';break;
		   case 200: $filtro='HAWK';break;
		   case 201: $filtro='ENGER';break;
		   case 202: $filtro='NORDESTE';break;
		   case 203: $filtro='GETEK';break;
		   case 204: $filtro='TUV VISTORIAS';break;
		   case 205: $filtro='SINTESE SEGUROS';break;
		   case 314: $filtro='UNIPROPAS';break;
		   case 319: $filtro='CAR SOLUCOES';break;
		   case 320: $filtro='ASPEM';break;
		   case 321: $filtro='ASPROL';break;
		   case 322: $filtro='G&G SOLUCOES';break;
		   case 323: $filtro='CONSORCIO';break;
		   case 324: $filtro='AUTO TRUCK';break;
		   case 325: $filtro='ABV';break;
		   case 326: $filtro='QV SERVICOS';break;
		   case 327: $filtro='PROTECT 24HS';break;
		   case 328: $filtro='FINANCEIRA';break;
		   case 329: $filtro='SANCOR';break;
		   case 330: $filtro='ASTRO';break;
		   case 331: $filtro='ASTRAMAR';break;
		   case 332: $filtro='APROVESC';break;
		   case 333: $filtro='UNIBEM';break;
		   case 334: $filtro='COOPERTRUCK';break;
		   case 335: $filtro='PROAUTO';break;
		   case 336: $filtro='PERFECT';break;
		   case 337: $filtro='MELHOR';break;
		   case 338: $filtro='AMV BRASIL';break;     
		   case 339: $filtro='MELHOR PESADOS';break;
		   case 340: $filtro='ALICERCE';break;
		   case 341: $filtro='AVANTI';break;
		   case 342: $filtro='TOPPREV';break;
		   case 343: $filtro='AGUARDA';break;
		   case 344: $filtro='NACIONAL TRUCK';break;
			case 345: $filtro='EXPRESSO TRUCK';break;
			case 346: $filtro='BRASMIG';break;
			case 347: $filtro='ASTRANS';break;
			case 348: $filtro='APVS';break;
			case 349: $filtro='ASCAMP';break;
			case 350: $filtro='CLUBE FONFON';break;
			case 351: $filtro='BR TRUCK';break;
			case 353: $filtro='UNIVERSO ASSISTENCIA';break;
			case 354: $filtro='MAXIMA';break;
			case 355: $filtro='FOCUS';break;
			case 356: $filtro='LOTUS';break;
			case 357: $filtro='ALLIANCE APV';break;
			case 358: $filtro='VISTRIM';break;
			case 359: $filtro='AGV BRASIL';break;
			case 360: $filtro='ALIANÇA TRUCK CAR';break;
			case 361: $filtro='EUROCAR';break;
			case 362: $filtro='AMPLA';break;
			case 363: $filtro='ASCOBOM';break;
			case 364: $filtro='ASPROAUTO';break;
			case 365: $filtro='CAMBRALIA';break;
			case 366: $filtro='COPOM';break;
			case 367: $filtro='ASSOCIACAO DE AJUDA MUTUA A3';break;
			case 368: $filtro='MEGA BENEFICIOS';break;
			case 369: $filtro='UNIAUTO PROTECAO';break;
			case 370: $filtro='AUTO CARROS';break;
			case 371: $filtro='AUTOMINAS';break;
			case 372: $filtro='AVAP';break;
			case 373: $filtro='BRASIL COOPERATIVA';break;
			case 374: $filtro='CARVISA';break;
			case 375: $filtro='CENTRO SOCIAL CABOS SOLDADOS';break;
			case 376: $filtro='APVS ESPIRITO SANTO';break;
			case 377: $filtro='COOPEV';break;
			case 378: $filtro='COPA 190';break;
			case 379: $filtro='EFICAZ';break;
			case 380: $filtro='FACIL CLUBE DE BENEFICIOS';break;
			case 381: $filtro='GARANT CLUBE DE BENEFICIOS MUTUOS';break;
			case 382: $filtro='GENESIS BENEFICIOS';break;
			case 383: $filtro='LIDERANCA CLUBE DE ASSISTENCIA';break;
			case 384: $filtro='UNIPROV - ESPIRITO SANTO';break;
			case 385: $filtro='UNIPROV - RONDONIA';break;
			case 386: $filtro='MASTER CLUBE DE ASSISTENCIA VEICULAR';break;
			case 387: $filtro='MASTER TRUCK';break;
			case 388: $filtro='PLANCAR PRIME PROTECAO VEICULAR';break;
			case 389: $filtro='PRIME PROTECAO VEICULAR';break;
			case 390: $filtro='PROTEMINAS';break;
			case 391: $filtro='REDE CARS CLUBE DE BENEFICIOS';break;
			case 392: $filtro='SAVE-CAR';break;
			case 393: $filtro='UNIBRAS ASSOCIACAO DE AUTO PROTECAO';break;
			case 394: $filtro='UNIVERSO CLUBE DE ASSISTENCIA';break;
			case 395: $filtro='VISTOP SERVICOS TECNICOS';break;
			case 396: $filtro='EMBRACON';break;
			case 397: $filtro='NET CAR CLUBE';break;
			case 398: $filtro='MOTOCAR CLUBE';break;
			case 399: $filtro='EXCELENCIA';break;
			case 400: $filtro='APVS VISTA ALEGRE';break;
			case 401: $filtro='CAUTELAR';break;
			case 402: $filtro='EXCLUSIVE';break;
			case 403: $filtro='TRADICAO';break;
			case 404: $filtro='DIAMOND MOTORS';break;
			case 405: $filtro='CHERY MOTORS';break;
			case 406: $filtro='AVEP';break;
			case 407: $filtro='VIVA CONSORCIOS';break;
			case 408: $filtro='AUTOVALORE';break;
			case 409: $filtro='GFCAR';break;
			case 410: $filtro='PREVINE';break;
			case 411: $filtro='CLUBE SERVICE';break;
			case 412: $filtro='UNIBRA';break;
			case 413: $filtro='SOMA TRACK';break;
			case 100: $filtro='USEBENS';break;
			case 101: $filtro='QBE';break;
			case 102: $filtro='POINTER';break;
			case 103: $filtro='CIELO';break;
			case 414: $filtro='TIRADENTES';break;
			case 415: $filtro='PARTICULAR';break;
			case 416: $filtro='SOLTEL';break;
			case 417: $filtro='TOP CAR';break;
			case 418: $filtro='PROTEGIDO';break;
			case 419: $filtro='ULTRA BRASIL';break;
			case 420: $filtro='UNION SOLUTIONS';break;
			case 421: $filtro='MASTER CLUBE UBERLANDIA';break;
			case 422: $filtro='MUNDIAL';break;
			case 423: $filtro='SIMPLIFICAR';break;
			case 424: $filtro='CLEAN';break;
			case 425: $filtro='ALLIDER';break;
			case 426: $filtro='APROTEVE';break;
			case 427: $filtro='E-NOVATE';break;
			case 428: $filtro='ASTRACO';break;
			case 429: $filtro='ROTA';break;
			case 430: $filtro='ULTRA';break;
			case 431: $filtro='UNICOON PARANA';break;
			case 432: $filtro='PROTEAUTO';break;
			case 433: $filtro='APVS SUDESTE';break;
			case 434: $filtro='CLUBE UNIR';break;
			case 435: $filtro='APM';break;
			case 436: $filtro='MASTER-CONSULTOR';break;
			case 437: $filtro='HM PROTECAO';break;
			case 438: $filtro='CLUBCAR';break;
			case 439: $filtro='AZUL CLUBE';break;
			case 440: $filtro='GOL PLUS BRASIL';break;
			case 441: $filtro='ESTILO PROTECAO';break;
			case 442: $filtro='PHP PROTECAO';break;
			case 443: $filtro='ACERTT';break;
			case 444: $filtro='APVA';break;  
			case 445: $filtro='ASTRAC';break;
			case 446: $filtro='SEGURYCAR';break;
			case 447: $filtro='VITALLYS BRASIL';break;
			case 448: $filtro='BRASIL CAR';break;
			case 449: $filtro='UNIDAS';break;
			case 450: $filtro='ELLO';break;
			case 451: $filtro='UNICOON CONTAGEM';break;
			case 452: $filtro='FOCAR BRASIL';break;
			case 453: $filtro='PLACAR VEICULAR';break;
			case 454: $filtro='PROTECAR';break;
			case 455: $filtro='UCA MELHOR';break;
			case 456: $filtro='PROTEAUTO MARINGA';break;
			case 457: $filtro='AUTO VIP';break;
			case 458: $filtro='PRONTOCAR';break;
			case 459: $filtro='PENSAR CLUBE';break;
			case 460: $filtro='AUTO BAHIA';break;
			case 461: $filtro='MAXIMUS BRASIL';break;
			case 462: $filtro='PROTECT';break;
			default: $filtro='NAO CADASTRADO';break;    
	   	}
		
		switch ($reg['TPVISTORIA']){
			case 'V': $local = "VOLANTE"; break;
			case 'P': $local = "POSTO"; break;
			case 'D': $local = "VOLANTE"; break;
			case 'F': $local = "POSTO"; break;
			default: break;
			}
	
if($_POST['usuario']=='TODOS'){
	$nomeVist="TODOS";
	}else{
		$nomeVist=strtr(strtoupper($user['nome']),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));
		}
	
		if($reg['valorb']!=''){
			$vp_precoVistoriador=$reg['valorb'];
			}else{
		     
		$sql_vp_preco = "SELECT preco_vistoria FROM ".$bancoDados.".controle_vp_preco_prestador WHERE prestador_id = ".$reg['controle_prest']." AND seguradora = '".$reg['SEGURADORA']."' AND roteirizador = ".$reg['roteirizador'].""; 
		$result_vp_preco = @mysql_query($sql_vp_preco,$db);
		$vp_preco = @mysql_fetch_array($result_vp_preco);
			$vp_precoVistoriador=strtr($vp_preco['preco_vistoria'],array("."=>","));
			}

//$dtTrans=date('Ymd', mktime(0,0,0, substr($reg['DTTRANS'],4,2) , substr($reg['DTTRANS'],6,2)  , substr($reg['DTTRANS'],0,4)));
//$dtVist=date('Ymd', mktime(0,0,0, substr($reg['DTVISTORIA'],4,2) , substr($reg['DTVISTORIA'],6,2)  , substr($reg['DTVISTORIA'],0,4)));

if($reg['DTTRANS']==$reg['DTVISTORIA']){
	$prazo_trans=0;
	}
	elseif($reg['DTTRANS']==0){
	$prazo_trans='';
		}else{
			$prazo_trans=date('d', mktime(0,0,0, substr($reg['DTTRANS'],4,2)-substr($reg['DTVISTORIA'],4,2) , substr($reg['DTTRANS'],6,2)-substr($reg['DTVISTORIA'],6,2)  , substr($reg['DTTRANS'],0,4)-substr($reg['DTVISTORIA'],0,4)));
			}
			
if($reg['DTPROC']==$reg['DTVISTORIA']){
	$prazo_cadastro=0;
	}
	else{
			$prazo_cadastro=date('d', mktime(0,0,0, substr($reg['DTPROC'],4,2)-substr($reg['DTVISTORIA'],4,2) , substr($reg['DTPROC'],6,2)-substr($reg['DTVISTORIA'],6,2)  , substr($reg['DTPROC'],0,4)-substr($reg['DTVISTORIA'],0,4)));
			}
		
if($sol['dia']==$reg['DTVISTORIA']){
	$prazo_realizacao=0;
	}
	else{
		
		$mkRealizacao=mktime(0,0,0, substr($reg['DTVISTORIA'],4,2), substr($reg['DTVISTORIA'],6,2) , substr($reg['DTVISTORIA'],0,4));
		$mkDia=mktime(0,0,0, substr($sol['dia'],4,2), substr($sol['dia'],6,2) , substr($sol['dia'],0,4));
		$dias=mktime(0,0,0, $mkRealizacao-$mkDia+1); 
		
		$prazo_realizacao=($mkRealizacao-$mkDia)/86400;  
		
			}
		
	$sql_fotosDT = "SELECT data FROM ".$bancoDados.".fotos WHERE id = ".$reg['NUMEROSOLICITACAO']." ORDER BY contagem DESC LIMIT 0 , 1";
	$result_fotosDT = @mysql_query($sql_fotosDT,$db);
	$dataFoto = @mysql_fetch_assoc($result_fotosDT);
	$dtFoto=$dataFoto['data'];
		
	if($dtFoto=='' || $dtFoto=='null' || $dtFoto=='NULL'){
		$dtFoto=date('Ymd');
		}
		
		
	if($dtFoto==$reg['DTPROC']){
	$prazo_foto=0;
	}
	else{
		
		$mkRealizacao=mktime(0,0,0, substr($reg['DTPROC'],4,2), substr($reg['DTPROC'],6,2) , substr($reg['DTPROC'],0,4));
		$mkDiaFoto=mktime(0,0,0, substr($dtFoto,4,2), substr($dtFoto,6,2) , substr($dtFoto,0,4));
		$dias=mktime(0,0,0, $mkRealizacao-$mkDiaFoto+1); 
		
		$prazo_foto=($mkDiaFoto-$mkRealizacao)/86400;  
		
			}

	$mensagem.="<tr ".$corLinha."><td><center>".strtoupper($filtro)."</center></td><td><center>".strtoupper($corretor)."</center></td><td><center>".$reg['NRVISTORIA']."</center></td><td><center>".$solicita."</center></td><td><center>".strtoupper($local)."</center></td><td>".strtoupper($reg['NRPLACA'])."</td><td>".strtoupper($reg['NRCHASSI'])."</td><td>".strtoupper($reg['NMPROPONENTE'])."</td><td>".$user['nome']."</td><td>".strtoupper($solicitacao['cidade'])."</td><td>".strtoupper($solicitacao['cidadeRecebida'])."</td><td>".$dataAgenda."</td><td><center>".$data_vistoria."</center></td><td><center>".$hora_vistoria."</center></td><td><center>".$data_cadastro."</center></td><td><center>".$hora_cadastro."</center></td><td><center>".$data_trans."</center></td><td><center>".$prazo_realizacao."</center></td></td><td><center>".$prazo_cadastro."</center></td><td><center>".$prazo_trans."</center></td><td><center>".$prazo_foto."</center></td><td><center>".$vistMobile."</center></td><td>   <center>".$vp_precoVistoriador."</center></td></tr>";   
	
	$linha=$linha*-1;
	}
$mensagem.="<tr><td colspan='7'>Quantidade total de vistorias : ".(@mysql_num_rows($result_vistoria))."</td></tr>";  


$nomeRelatorio=strtoupper($integrado['empresa'])."[PRODUCAO_VISTORIADOR_".$nomeVist."]".strtr($_POST['DATA_INICIAL'],array("/"=>"_"))."_a_".strtr($_POST['DATA_FINAL'],array("/"=>"_"));	

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');

echo $mensagem;


} // fim permissão 1

// ANALISTA E ADMINISTRADOR (ANALISTA)
if($_POST['permissao']=='10'){

$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$_POST['usuario'];
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);

header('Content-type: application/vnd.ms-excel');

$mensagem.='<table width="736" height="52" border="1">
  				<tr>
    				<td colspan="4">Nome Analista: <b><i>'.strtoupper($user['nome']).'</i></b></td>
  				</tr>
  				<tr> 
					<td width="150"><center><b>Cliente</b></center></td>
					<td width="150"><center><b>Numero da vistoria</b></center></td>
					<td width="150"><center><b>Placa</center></b></td>    
					<td width="150"><center><b>Data</center></b></td>   
					<td width="150"><center><b>Hora</center></b></td> 
	  			</tr>';

$nomeVist=strtr(strtoupper($user['nome']),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));	
$nomeRelatorio="Rel_Prod[".$nomeVist."]";	


$sql = "SELECT vp.DTANALISE,vp.NRVISTORIA,vp.NRPLACA,vp.hora_analise,s.cliente FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".solicitacao s WHERE vp.NUMEROSOLICITACAO=s.id AND vp.DTANALISE >= $data_inicial AND vp.DTANALISE <= $data_final AND vp.controle_analista = $_POST[usuario] AND vp.roteirizador=".$_SESSION['roteirizador']." ORDER BY vp.DTANALISE, vp.hora_analise";
$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		
		$linha=1;			
		while ($relatorio= @mysql_fetch_array($result))
		{
			
			if ($linha>0){
			$corLinha="style='background-color:#FFF'";
			}else{
				$corLinha="style='background-color:#E6E8FA'";
				}
				
		$dataAnalise= substr($relatorio['DTANALISE'],6,2)."/".substr($relatorio['DTANALISE'],4,2)."/".substr($relatorio['DTANALISE'],0,4);
		$horaAnalise= str_pad($relatorio['hora_analise'], 4, "0", STR_PAD_LEFT);
		$horaAnalise= substr($horaAnalise,0,2).":".substr($horaAnalise,2,2);
		$mensagem.= "  <tr>
					<td ".$corLinha."><center>".strtoupper($relatorio['cliente'])."</center></td>
					<td ".$corLinha."><center>".$relatorio['NRVISTORIA']."</center></td>
					<td ".$corLinha."><center>".strtoupper($relatorio['NRPLACA'])."</center></td>
					<td ".$corLinha."><center>".$dataAnalise."</center></td>
					<td ".$corLinha."><center>".$horaAnalise."</center></td>  
				</tr>";
		$linha=$linha*-1;	   	
	
			}

	}

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');
$mensagem.='<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

echo $mensagem;

}

// SEGURADORAS
if($_POST['permissao']=='70'){

$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$_SESSION["nome_seguradora"]=$_POST['usuario'];
include '../../seguradora_nome.php';

header('Content-type: application/vnd.ms-excel');

$mensagem.='<table width="736" height="52" border="1">
  				<tr>
    				<td colspan="9" style="font-size:18"><center>Seguradora: <b><i>'.$cliente_seguradora.'</i></b></center></td>
  				</tr>
  				<tr> 
					<td width="50"><center><b>ITEM</b></center></td>   
					<td width="100"><center><b>N&deg; VISTORIA</b></center></td>
					<td width="70"><center><b>PLACA</center></b></td>    
					<td width="100"><center><b>DATA VISTORIA</center></b></td>   
					<td width="140"><center><b>DATA TRANSMISS&Atilde;O</center></b></td> 
					<td width="400"><center><b>PROPONENTE</center></b></td>
					<td width="250"><center><b>CIDADE</center></b></td>  
					<td width="30"><center><b>UF</center></b></td> 
					<td width="400"><center><b>VISTORIADOR</center></b></td>
	  			</tr>';

$nomeVist=strtr(strtoupper($cliente_seguradora),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));	
$nomeRelatorio="Rel_Prod[".$nomeVist."]";	

$sql = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTANALISE >= ".$data_inicial." AND DTANALISE <= ".$data_final." AND SEGURADORA = ".$_POST['usuario']." AND roteirizador=".$_SESSION['roteirizador']." ORDER BY DTVISTORIA";
$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		$linha=1;
		$cont=1;			
		while ($relatorio= @mysql_fetch_array($result))
		{
			
$sql_user = "SELECT nome FROM ".$bancoDados.".user WHERE id = ".$relatorio['controle_prest'];
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);	

$sql_sol = "SELECT cidade,estado FROM ".$bancoDados.".solicitacao WHERE id = ".$relatorio['NUMEROSOLICITACAO'];
$result_sol = @mysql_query($sql_sol,$db);
$sol = @mysql_fetch_array($result_sol);		
			
			if ($linha>0){
			$corLinha="style='background-color:#FFF'";
			}else{
				$corLinha="style='background-color:#E6E8FA'";
				}
				
		$dataVistoria= substr($relatorio['DTVISTORIA'],6,2)."/".substr($relatorio['DTVISTORIA'],4,2)."/".substr($relatorio['DTVISTORIA'],0,4);
		$dataTrans= substr($relatorio['DTTRANS'],6,2)."/".substr($relatorio['DTTRANS'],4,2)."/".substr($relatorio['DTTRANS'],0,4);
		$mensagem.= "  <tr>
					<td ".$corLinha."><center>".$cont."</center></td>
					<td ".$corLinha."><center>".$relatorio['NRVISTORIA']."</center></td>
					<td ".$corLinha."><center>".strtoupper($relatorio['NRPLACA'])."</center></td>
					<td ".$corLinha."><center>".$dataVistoria."</center></td>
					<td ".$corLinha."><center>".$dataTrans."</center></td>  
					<td ".$corLinha."><center>".strtoupper($relatorio['NMPROPONENTE'])."</center></td>
					<td ".$corLinha."><center>".strtoupper($sol['cidade'])."</center></td>
					<td ".$corLinha."><center>".strtoupper($sol['estado'])."</center></td>
					<td ".$corLinha."><center>".strtoupper($user['nome'])."</center></td>
				</tr>";
		$linha=$linha*-1;
		$cont++;		
	
			}

	}

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');
$mensagem.='<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

echo $mensagem;

}

// ATENDENTE E ADMINISTRADOR (ATENDENTE)
if($_POST['permissao']=='7'){

$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_user = "SELECT nome FROM ".$bancoDados.".user WHERE id = ".$_POST['usuario'];
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);

header('Content-type: application/vnd.ms-excel');

$mensagem.='<table width="736" height="52" border="1">
  				<tr>
    				<td colspan="4">Nome Atendente: <b><i>'.strtoupper($user['nome']).'</i></b></td>
  				</tr>
  				<tr>
					<td width="150"><center><b>Cliente</b></center></td>
					<td width="150"><center><b>Numero da vistoria</b></center></td>
					<td width="150"><center><b>Placa</center></b></td>    
					<td width="150"><center><b>Data</center></b></td>   
					<td width="150"><center><b>Hora</center></b></td> 
					<td width="150"><center><b>Solicitante</center></b></td> 
					<td width="150"><center><b>Status</center></b></td> 
					<td width="150"><center><b>Obs. Restrita</center></b></td> 
	  			</tr>';

$nomeVist=strtr(strtoupper($user['nome']),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));	
$nomeRelatorio="Rel_Prod[".$nomeVist."]";	

$sql = "SELECT id,placa,data_auto,hora_criacao,cliente,nome_s FROM ".$bancoDados.".solicitacao WHERE dia >= ".$data_inicial." AND dia <= ".$data_final." AND controle_digitador = ".$_POST['usuario']." AND roteirizador=".$_SESSION['roteirizador']." ORDER BY data_auto, hora_criacao";

$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		
		$linha=1;			
		while ($relatorio= @mysql_fetch_array($result))
		{
			$status='';
			$obsRestrita='';
			
			$sql2 = "SELECT status,mensagem FROM ".$bancoDados.".observacaoRestrita WHERE solicitacao=".$relatorio['id'];
			$result2 = @mysql_query($sql2,$db) or die(mysql_error());
			$relatorio2= @mysql_fetch_array($result2);
			
			if(@mysql_num_rows($result2)>0){
				switch($relatorio2['status']){
					case '0': $status='SEM OBS. RESTRITA'; break;
					case '1': $status='PENDENTE'; break;
					case '2': $status='VISTORIA REALIZADA'; break;
					case '3': $status='COBRADO'; break;
					case '4': $status='AGENDADA'; break;
					default: $status=''; break;
				}
				
			$obsRestrita=strtr(trim($relatorio2['mensagem']),array("</b><br/>"=>"</b>: ", "@"=>""));  
			}
				
			
			
			
			if ($linha>0){
			$corLinha="style='background-color:#FFF'";
			}else{
				$corLinha="style='background-color:#E6E8FA'";
				}
				
		$horaCriacao= str_pad($relatorio['hora_criacao'], 4, "0", STR_PAD_LEFT);
		$horaCriacao= substr($horaCriacao,0,2).":".substr($horaCriacao,2,2);
		$mensagem.= "  <tr>
					<td ".$corLinha."><center>".$relatorio['cliente']."</center></td>
					<td ".$corLinha."><center>".$relatorio['id']."</center></td>
					<td ".$corLinha."><center>".strtoupper($relatorio['placa'])."</center></td>
					<td ".$corLinha."><center>".$relatorio['data_auto']."</center></td>
					<td ".$corLinha."><center>".$horaCriacao."</center></td>
					<td ".$corLinha."><center>".$relatorio['nome_s']."</center></td>
					<td ".$corLinha."><center>".$status."</center></td>
					<td ".$corLinha."><center>".$obsRestrita."</center></td>
				</tr>";
		$linha=$linha*-1;		
	
			}

	}

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');
$mensagem.='<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

echo $mensagem;

}

// DIGITADOR E ADMINISTRADOR (DIGITADOR)
if($_POST['permissao']=='2'){

$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$_POST['usuario'];
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);

header('Content-type: application/vnd.ms-excel');

$mensagem.='<table width="736" height="52" border="1">
  				<tr>
    				<td colspan="4">Nome Digitador: <b><i>'.strtoupper($user['nome']).'</i></b></td>
  				</tr>
  				<tr>    
					<td width="150"><center><b>Numero da vistoria</b></center></td>
					<td width="150"><center><b>Placa</center></b></td>    
					<td width="150"><center><b>Data</center></b></td>   
					<td width="150"><center><b>Hora</center></b></td> 
	  			</tr>';

$nomeVist=strtr(strtoupper($user['nome']),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));	
$nomeRelatorio="Rel_Prod[".$nomeVist."]";	

$sql = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTPROC >= $data_inicial AND DTPROC <= $data_final AND controle_digitador = $_POST[usuario] AND roteirizador=".$_SESSION['roteirizador']."";

$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		
		$linha=1;			
		while ($relatorio= @mysql_fetch_array($result))
		{
			
			if ($linha>0){
			$corLinha="style='background-color:#FFF'";
			}else{
				$corLinha="style='background-color:#E6E8FA'";
				}
		
		$dataDigitacao= substr($relatorio['DTPROC'],6,2)."/".substr($relatorio['DTPROC'],4,2)."/".substr($relatorio['DTPROC'],0,4);		
		$horaCriacao= str_pad($relatorio['hora_criacao'], 4, "0", STR_PAD_LEFT);
		$horaCriacao= substr($horaCriacao,0,2).":".substr($horaCriacao,2,2);
		$mensagem.= "  <tr>
					<td ".$corLinha."><center>".$relatorio['NRVISTORIA']."</center></td>
					<td ".$corLinha."><center>".strtoupper($relatorio['NRPLACA'])."</center></td>
					<td ".$corLinha."><center>".$dataDigitacao."</center></td>
					<td ".$corLinha."><center>".$horaCriacao."</center></td> 
				</tr>";
		$linha=$linha*-1;		
	
			}

	}

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');
$mensagem.='<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

echo $mensagem;

}

// VISTORIADOR - DIGITADOR
if($_POST['permissao']=='100'){

$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$_POST['usuario'];
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);
	
if($user['tipoVistoriador']==1){
	$sql_user2 = "SELECT id FROM ".$bancoDados.".user WHERE vistoriadorPrincipal = ".$_POST['usuario'];
	$result_user2 = @mysql_query($sql_user2,$db);
	if(@mysql_num_rows($result_user2)>0){// MONTA LISTA DE VISTORIADORES ATRELADO
		
		while($user2 = @mysql_fetch_array($result_user2)){
			$vistoAtrelado.=$user2['id'].",";
			}
		$vistoAtrelado=substr($vistoAtrelado,0,strlen($vistoAtrelado)-1);
		
		$buscaVistoriador=" controle_digitador in (".$_POST['usuario'].",".$vistoAtrelado.") ";
		}else{// NÃO TEM NENHUM VISTORIADOR ATRELADO
			$buscaVistoriador="controle_digitador = ".$_POST['usuario'];
			}
	
	}else{
		$buscaVistoriador="controle_digitador = ".$_POST['usuario'];
		}

header('Content-type: application/vnd.ms-excel');

$mensagem.='<table width="736" height="52" border="1">
  				<tr>
    				<td colspan="4">Nome Vistoriador(Digitador): <b><i>'.strtoupper($user['nome']).'</i></b></td>
  				</tr>
  				<tr>    
					<td width="150"><center><b>Numero da vistoria</b></center></td>
					<td width="150"><center><b>Placa</center></b></td>    
					<td width="150"><center><b>Data</center></b></td>   
					<td width="150"><center><b>Hora</center></b></td> 
					<td width="150"><center><b>VistMobile</center></b></td> 
	  			</tr>';

$nomeVist=strtr(strtoupper($user['nome']),array("."=>"", " "=>"_", "&"=>"e", "/"=>"", "-"=>""));	
$nomeRelatorio="Rel_Prod[".$nomeVist."]";	

$sql = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTPROC >= ".$data_inicial." AND DTPROC <= ".$data_final." AND ".$buscaVistoriador." AND roteirizador=".$_SESSION['roteirizador'];
	
$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		
		$linha=1;			
		while ($relatorio= @mysql_fetch_array($result))
		{
			
			if ($linha>0){
			$corLinha="style='background-color:#FFF'";
			}else{
				$corLinha="style='background-color:#E6E8FA'";
				}
		$mobile='';
		if($relatorio['pda']==1){
			$mobile='SIM';
			}else{
				$mobile='NAO';
				}	
			
		$dataDigitacao= substr($relatorio['DTPROC'],6,2)."/".substr($relatorio['DTPROC'],4,2)."/".substr($relatorio['DTPROC'],0,4);		
		$horaCriacao= str_pad($relatorio['hora_criacao'], 4, "0", STR_PAD_LEFT);
		$horaCriacao= substr($horaCriacao,0,2).":".substr($horaCriacao,2,2);
		$mensagem.= "  <tr>
					<td ".$corLinha."><center>".$relatorio['NRVISTORIA']."</center></td>
					<td ".$corLinha."><center>".strtoupper($relatorio['NRPLACA'])."</center></td>
					<td ".$corLinha."><center>".$dataDigitacao."</center></td>
					<td ".$corLinha."><center>".$horaCriacao."</center></td> 
					<td ".$corLinha."><center>".$mobile."</center></td> 
				</tr>";
		$linha=$linha*-1;		
	
			}

	}

header('Content-Disposition: attachment; filename="'.$nomeRelatorio.'.xls"');
$mensagem.='<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

echo $mensagem;

}

// Administrador - Analista
if($_POST['permissao']=='3'){
	
$data_inicial = $_POST['DATA_INICIAL']{6}.$_POST['DATA_INICIAL']{7}.$_POST['DATA_INICIAL']{8}.$_POST['DATA_INICIAL']{9}.$_POST['DATA_INICIAL']{3}.$_POST['DATA_INICIAL']{4}.$_POST['DATA_INICIAL']{0}.$_POST['DATA_INICIAL']{1};

	$data_final = $_POST['DATA_FINAL']{6}.$_POST['DATA_FINAL']{7}.$_POST['DATA_FINAL']{8}.$_POST['DATA_FINAL']{9}.$_POST['DATA_FINAL']{3}.$_POST['DATA_FINAL']{4}.$_POST['DATA_FINAL']{0}.$_POST['DATA_FINAL']{1};


$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = $_POST[usuario]";
$result_user = @mysql_query($sql_user,$db);
$user = @mysql_fetch_array($result_user);

echo '<table width="736" height="52" border="1">
  <tr>
    <td colspan="4">Nome usuario: <b><i>'.strtoupper($user['nome']).'</i></b></td>
  </tr>';

echo ' <tr>    
			<td width="150"><center><b>Numero da vistoria</b></center></td>
			<td width="150"><center><b>Placa</center></b></td>    
			<td width="150"><center><b>Data</center></b></td>   
			<td width="150"><center><b>Hora</center></b></td> 
	   </tr>';





$result = @mysql_query($sql,$db) or die(mysql_error());
	if (@mysql_num_rows($result)>0)
	{
		
			
while ($relatorio= @mysql_fetch_array($result))
{


	echo "  <tr>
				<td>".$relatorio['id']."</td>
			    <td>".$relatorio['placa']."</td>
				<td>".$relatorio['data_auto']."</td>
				<td>".$relatorio['hora_criacao']."</td>
			</tr>";



		
}
echo'<tr>    <td colspan="2"><b>Quantidade total: </b>'.@mysql_num_rows($result).'</td>  </tr></table>';	

	}

}
?>
</body>
</html>