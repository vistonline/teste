<?
set_time_limit(false);

include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
include "/var/www/html/sistema/verifica_roteirizador.php";


/*$sqlConfig=" SET OPTION SQL_BIG_SELECTS = 1 ";
$resultConfig = mysql_query($sqlConfig,$db);*/

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../js/calendar.js"></script>
<title>.:: VistOn-Line ::.</title>
<script src="../js/funcoes.js" type="text/javascript"></script>
<style type="text/css">
<!--
.style13 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style16 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
#Layer1 {
	position:absolute;
	left:14px;
	top:132px;
	width:424px;
	height:33px;
	z-index:1;
}
#Layer2 {
	position:absolute;
	left:569px;
	top:32px;
	width:100px;
	height:24px;
	z-index:2;
}
#Layer3 {
	position:absolute;
	left:422px;
	top:132px;
	width:381px;
	height:25px;
	z-index:3;
}
#Layer4 {
	position:absolute;
	left:363px;
	top:132px;
	width:389px;
	height:25px;
	z-index:3;
}
.style17 {color: #000000}
.style18 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	font-weight: bold;
}
#apDiv1 {
	position:absolute;
	left:572px;
	top:32px;
	width:100;
	height:34px;
	z-index:1;
}
.style19 {color: #FF0000}
-->
</style>
</head>

<body>
<?

if($_GET[visualiza]=="")

{
$contem='0';
//conferindo os dados que o select conter�
$sql_posto = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION['roteirizador']."'"; 
$result_posto = @mysql_query($sql_posto,$db);

while ($seguradora = @mysql_fetch_array($result_posto))
{
	// S� MOSTRA AS QUE TEM CONTRATO DIRETO     //CONTRATO ATIVO
	if($seguradora['somenteSolicitacao']==0 && $seguradora['bloqueiaSeguradora']==0)
	{
		   switch($seguradora['nome_seguradora'])
		   {
		   case "0":  $option.= '<option value="0<>Bradesco Seguros" >BRADESCO SEGUROS</option>';break;
		   case "20": $option.= '<option value="20<>BONE">BONE</option>';break;
		   case "21": $option.= '<option value="21<>MULTCAR">MULTCAR</option>';break;
		   case "22": $option.= '<option value="22<>RODOTRUCK">RODOTRUCK</option>';break;
		   case "23": $option.= '<option value="23<>ACE">ACE</option>';break;
		   case "24": $option.= '<option value="24<>VERTICE">VERTICE</option>';break;
		   case "25": $option.= '<option value="25<>TRUST">TRUST</option>';break;
		   case "26": $option.= '<option value="26<>ZURICH GARANTIA">ZURICH GARANTIA</option>';break;
		   case "30": $option.= '<option value="30<>ASSETRAC">ASSETRAC</option>';break;
		   case "31": $option.= '<option value="31<>BUREAU DE BENEFICIOS">BUREAU DE BENEFICIOS</option>';break;
		   case "32": $option.= '<option value="32<>ASSUTRAN">ASSUTRAN</option>';break;
		   case "33": $option.= '<option value="33<>AVANT">AVANT</option>';break;
		   case "34": $option.= '<option value="34<>ACAN">ACAN</option>';break;
		   case "35": $option.= '<option value="35<>ASSIST">ASSIST</option>';break;
		   case "36": $option.= '<option value="36<>APROCAM BRASIL">APROCAM BRASIL</option>';break;
		   case "37": $option.= '<option value="37<>MAPFRE WARRANTY">MAPFRE WARRANTY</option>';break;
		   case "38": $option.= '<option value="38<>BB SEGUROS">BB SEGUROS</option>';break;
		   case "39": $option.= '<option value="39<>ZURICH">ZURICH</option>';break;
		   case "40": $option.= '<option value="40<>ALFA SEGUROS">ALFA SEGUROS</option>';break;
		   case "41": $option.= '<option value="41<>AXA SEGUROS">AXA SEGUROS</option>';break;
		   case "42": $option.= '<option value="42<>BANETES SEGUROS">BANETES SEGUROS</option>';break;
		   case "43": $option.= '<option value="43<>BRASIL VEIC.CIA SEG.">BRASIL VEIC.CIA SEG.</option>';break;
		   case "44": $option.= '<option value="44<>CAIXA SEGURADORA">CAIXA SEGURADORA</option>';break;
		   case "45": $option.= '<option value="45<>CARDIF DO BRASIL SEG.">CARDIF DO BRASIL SEG.</option>';break;
		   case "46": $option.= '<option value="46<>CHUBB">CHUBB</option>';break;
		   case "47": $option.= '<option value="47<>MINAS BRASIL">MINAS BRASIL</option>';break;
		   case "48": $option.= '<option value="48<>CIA DE SEG. A BAHIA">CIA DE SEG. A BAHIA</option>';break;
		   case "49": $option.= '<option value="49<>CIA MUTUAL DE SEGUROS">CIA MUTUAL DE SEGUROS</option>';break;
		   case "50": $option.= '<option value="50<>CONAPP">CONAPP</option>';break;
		   case "51": $option.= '<option value="51<>CONFIANCA">CONFIANCA</option>';break;
		   case "53": $option.= '<option value="53<>GENERALI">GENERALI</option>';break;
		   case "54": $option.= '<option value="54<>GENTE SEGURADORA">GENTE SEGURADORA</option>';break;
		   case "55": $option.= '<option value="55<>HDI">HDI</option>';break;
		   case "56": $option.= '<option value="56<>HSBC SEGUROS">HSBC SEGUROS</option>';break;
		   case "57": $option.= '<option value="57<>INDIANA SEGUROS">INDIANA SEGUROS</option>';break;
		   case "59": $option.= '<option value="59<>LIBERTY">LIBERTY</option>';break;
		   case "60": $option.= '<option value="60<>MAPFRE SEGUROS">MAPFRE</option>';break;
		   case "61": $option.= '<option value="61<>MARITIMA">MARITIMA</option>';break;
		   case "62": $option.= '<option value="62<>PORTO SEGURO">PORTO SEGURO</option>';break;
		   case "63": $option.= '<option value="63<>REAL SEGUROS">REAL SEGUROS</option>';break;
		   case "64": $option.= '<option value="64<>ROYAL & SUNALLIANCE">ROYAL & SUNALLIANCE</option>';break;
		   case "65": $option.= '<option value="65<>SAFRA VIDA E PREV.">SAFRA VIDA E PREV.</option>';break;
		   case "67": $option.= '<option value="67<>SUL AMERICA">SUL AMERICA</option>';break;
		   case "69": $option.= '<option value="69<>TOKIO MARINE">TOKIO MARINE</option>';break;
		   case "70": $option.= '<option value="70<>UNIBANCO AIG SEG.">UNIBANCO AIG SEG.</option>';break;
		   case "71": $option.= '<option value="71<>VERA CRUZ">VERA CRUZ</option>';break;
		   case "72": $option.= '<option value="72<>YASUDA SEGUROS">SOMPO SEGUROS</option>';break;
		   case "73": $option.= '<option value="73<>ALLIANZ SEGUROS">ALLIANZ SEGUROS</option>';break;
		   case "74": $option.= '<option value="74<>APROVSUL">APROVSUL</option>';break;
		   case "75": $option.= '<option value="75<>APTRANS">APTRANS</option>';break;
		   case "76": $option.= '<option value="76<>CREDIPE">CREDIPE</option>';break;
		   case "77": $option.= '<option value="77<>APROVSUL VEICULOS">APROVSUL VEICULOS</option>';break;
		   case "78": $option.= '<option value="78<>APROVSUL CARGA">APROVSUL CARGA</option>';break;
		   case "83": $option.= '<option value="83<>MITSUI">MITSUI</option>';break;
		   case "85": $option.= '<option value="85<>ITAU SEGUROS">ITAU SEGUROS</option>';break;
		   case "86": $option.= '<option value="86<>ASCARPE">ASCARPE</option>';break;
		   case "87": $option.= '<option value="87<>NOBRE">NOBRE</option>';break;
		   case "88": $option.= '<option value="88<>COMCARGA">COMCARGA</option>';break;
		   case "89": $option.= '<option value="89<>APROCAM">APROCAM</option>';break;
		   case "95": $option.= '<option value="95<>ASSOFINSP">ASSOFINSP</option>';break;
		   case "96": $option.= '<option value="96<>APPA">APPA</option>';break;
		   case "100": $option.= '<option value="100<>USEBENS">USEBENS</option>';break;
		   case "101": $option.= '<option value="101<>QBE">QBE</option>';break;
		   case "102": $option.= '<option value="102<>POINTER">POINTER</option>';break;
		   case "103": $option.= '<option value="103<>CIELO">CIELO</option>';break;
		   case "200": $option.= '<option value="200<>HAWK">HAWK</option>';break;
		   case "201": $option.= '<option value="201<>ENGER">ENGER</option>';break;
		   case "202": $option.= '<option value="202<>NORDESTE">NORDESTE</option>';break;
		   case "203": $option.= '<option value="203<>GETEK">GETEK</option>';break;
		   case "204": $option.= '<option value="204<>TUV VISTORIAS">TUV VISTORIAS</option>';break;
		   case "205": $option.= '<option value="205<>SINTESE SEGUROS">SINTESE SEGUROS</option>';break;
		   case "314": $option.= '<option value="314<>UNIPROPAS">UNIPROPAS</option>';break;
		   case "319": $option.= '<option value="319<>CAR SOLUCOES">CAR SOLUCOES</option>';break;
		   case "320": $option.= '<option value="320<>ASPEM">ASPEM</option>';break;
		   case "321": $option.= '<option value="321<>ASPROL">ASPROL</option>';break;
		   case "322": $option.= '<option value="322<>G&G SOLUCOES">G&G SOLUCOES</option>';break;
		   case "323": $option.= '<option value="323<>CONSORCIO">CONSORCIO</option>';break;
		   case "324": $option.= '<option value="324<>AUTO TRUCK">AUTO TRUCK</option>';break;
		   case "325": $option.= '<option value="325<>ABV">ABV</option>';break;
		   case "326": $option.= '<option value="326<>QV SERVICOS">QV SERVICOS</option>';break;
		   case "327": $option.= '<option value="327<>PROTECT 24HS">PROTECT 24HS</option>';break;
		   case "328": $option.= '<option value="328<>FINANCEIRA">FINANCEIRA</option>';break;
		   case "329": $option.= '<option value="329<>SANCOR">SANCOR</option>';break;
		   case "330": $option.= '<option value="330<>ASTRO">ASTRO</option>';break;
		   case "331": $option.= '<option value="331<>ASTRAMAR">ASTRAMAR</option>';break;
		   case "332": $option.= '<option value="332<>APROVESC">APROVESC</option>';break;
		   case "333": $option.= '<option value="333<>UNIBEM">UNIBEM</option>';break;
		   case "334": $option.= '<option value="334<>COOPERTRUCK">COOPERTRUCK</option>';break;
		   case "335": $option.= '<option value="335<>PROAUTO">PROAUTO</option>';break;
		   case "336": $option.= '<option value="336<>PERFECT">PERFECT</option>';break;
		   case "337": $option.= '<option value="337<>MELHOR">MELHOR</option>';break;
		   case "338": $option.= '<option value="338<>AMV BRASIL">AMV BRASIL</option>';break;   
		   case "339": $option.= '<option value="339<>MELHOR PESADOS">MELHOR PESADOS</option>';break;
		   case "340": $option.= '<option value="340<>ALICERCE">ALICERCE</option>';break;
		   case "341": $option.= '<option value="341<>AVANTI">AVANTI</option>';break;
		   case "342": $option.= '<option value="342<>TOPPREV">TOPPREV</option>';break;
		   case "343": $option.= '<option value="343<>AGUARDA">AGUARDA</option>';break;
		   case "344": $option.= '<option value="344<>NACIONAL TRUCK">NACIONAL TRUCK</option>';break;
			case "345": $option.= '<option value="345<>EXPRESSO TRUCK">EXPRESSO TRUCK</option>';break;
			case "346": $option.= '<option value="346<>BRASMIG">BRASMIG</option>';break;
			case "347": $option.= '<option value="347<>ASTRANS">ASTRANS</option>';break;
			case "348": $option.= '<option value="348<>APVS">APVS</option>';break;
			case "349": $option.= '<option value="349<>ASCAMP">ASCAMP</option>';break;
			case "350": $option.= '<option value="350<>CLUBE FONFON">CLUBE FONFON</option>';break;
			case "351": $option.= '<option value="351<>BR TRUCK">BR TRUCK</option>';break;
			case "353": $option.= '<option value="353<>UNIVERSO ASSISTENCIA">UNIVERSO ASSISTENCIA</option>';break;
			case "354": $option.= '<option value="354<>MAXIMA">MAXIMA</option>';break;
			case "355": $option.= '<option value="355<>FOCUS">FOCUS</option>';break;
			case "356": $option.= '<option value="356<>LOTUS">LOTUS</option>';break;
			case "357": $option.= '<option value="357<>ALLIANCE APV">ALLIANCE APV</option>';break;
			case "358": $option.= '<option value="358<>VISTRIM">VISTRIM</option>';break;
			case "359": $option.= '<option value="359<>AGV BRASIL">AGV BRASIL</option>';break;
			case "360": $option.= '<option value="360<>ALIAN�A TRUCK CAR">ALIAN&Ccedil;A TRUCK CAR</option>';break;
			case "361": $option.= '<option value="361<>EUROCAR">EUROCAR</option>';break;
			case "362": $option.= '<option value="362<>AMPLA">AMPLA</option>';break;
			case "363": $option.= '<option value="363<>ASCOBOM">ASCOBOM</option>';break;
			case "364": $option.= '<option value="364<>ASPROAUTO">ASPROAUTO</option>';break;
			case "365": $option.= '<option value="365<>CAMBRALIA">CAMBRALIA</option>';break;
			case "366": $option.= '<option value="366<>COPOM">COPOM</option>';break;
			case "367": $option.= '<option value="367<>ASSOCIACAO DE AJUDA MUTUA A3">ASSOCIACAO DE AJUDA MUTUA A3</option>';break;
			case "368": $option.= '<option value="368<>MEGA BENEFICIOS">MEGA BENEFICIOS</option>';break;
			case "369": $option.= '<option value="369<>UNIAUTO PROTECAO">UNIAUTO PROTECAO</option>';break;
			case "370": $option.= '<option value="370<>AUTO CARROS">AUTO CARROS</option>';break;
			case "371": $option.= '<option value="371<>AUTOMINAS">AUTOMINAS</option>';break;
			case "372": $option.= '<option value="372<>AVAP">AVAP</option>';break;
			case "373": $option.= '<option value="373<>BRASIL COOPERATIVA">BRASIL COOPERATIVA</option>';break;
			case "374": $option.= '<option value="374<>CARVISA">CARVISA</option>';break;
			case "375": $option.= '<option value="375<>CENTRO SOCIAL CABOS SOLDADOS">CENTRO SOCIAL CABOS SOLDADOS</option>';break;
			case "376": $option.= '<option value="376<>APVS ESPIRITO SANTO">APVS ESPIRITO SANTO</option>';break;
case "377": $option.= '<option value="377<>COOPEV">COOPEV</option>';break;
case "378": $option.= '<option value="378<>COPA 190">COPA 190</option>';break;
case "379": $option.= '<option value="379<>EFICAZ">EFICAZ</option>';break;
case "380": $option.= '<option value="380<>FACIL CLUBE DE BENEFICIOS">FACIL CLUBE DE BENEFICIOS</option>';break;
case "381": $option.= '<option value="381<>GARANT CLUBE DE BENEFICIOS MUTUOS">GARANT CLUBE DE BENEFICIOS MUTUOS</option>';break;
case "382": $option.= '<option value="382<>GENESIS BENEFICIOS">GENESIS BENEFICIOS</option>';break;
case "383": $option.= '<option value="383<>LIDERANCA CLUBE DE ASSISTENCIA">LIDERANCA CLUBE DE ASSISTENCIA</option>';break;
case "384": $option.= '<option value="384<>UNIPROV - ESPIRITO SANTO">UNIPROV - ESPIRITO SANTO</option>';break;
case "385": $option.= '<option value="385<>UNIPROV - RONDONIA">UNIPROV - RONDONIA</option>';break;
case "386": $option.= '<option value="386<>MASTER CLUBE DE ASSISTENCIA VEICULAR">MASTER CLUBE DE ASSISTENCIA VEICULAR</option>';break;
case "387": $option.= '<option value="387<>MASTER TRUCK">MASTER TRUCK</option>';break;
case "388": $option.= '<option value="388<>PLANCAR PRIME PROTECAO VEICULAR">PLANCAR PRIME PROTECAO VEICULAR</option>';break;
case "389": $option.= '<option value="389<>PRIME PROTECAO VEICULAR">PRIME PROTECAO VEICULAR</option>';break;
case "390": $option.= '<option value="390<>PROTEMINAS">PROTEMINAS</option>';break;
case "391": $option.= '<option value="391<>REDE CARS CLUBE DE BENEFICIOS">REDE CARS CLUBE DE BENEFICIOS</option>';break;
case "392": $option.= '<option value="392<>SAVE-CAR">SAVE-CAR</option>';break;
case "393": $option.= '<option value="393<>UNIBRAS ASSOCIACAO DE AUTO PROTECAO">UNIBRAS ASSOCIACAO DE AUTO PROTECAO</option>';break;
case "394": $option.= '<option value="394<>UNIVERSO CLUBE DE ASSISTENCIA">UNIVERSO CLUBE DE ASSISTENCIA</option>';break;
case "395": $option.= '<option value="395<>VISTOP SERVICOS TECNICOS">VISTOP SERVICOS TECNICOS</option>';break;
case "396": $option.= '<option value="396<>EMBRACON">EMBRACON</option>';break;
case "397": $option.= '<option value="397<>NET CAR CLUBE">NET CAR CLUBE</option>';break;
case "398": $option.= '<option value="398<>MOTOCAR CLUBE">MOTOCAR CLUBE</option>';break;
case "399": $option.= '<option value="399<>EXCELENCIA">EXCELENCIA</option>';break;
case "400": $option.= '<option value="400<>APVS VISTA ALEGRE">APVS VISTA ALEGRE</option>';break;
case "401": $option.= '<option value="401<>CAUTELAR">CAUTELAR</option>';break;
case "402": $option.= '<option value="402<>EXCLUSIVE">EXCLUSIVE</option>';break;
case "403": $option.= '<option value="403<>TRADICAO">TRADICAO</option>';break;
case "404": $option.= '<option value="404<>DIAMOND MOTORS">DIAMOND MOTORS</option>';break;
case "405": $option.= '<option value="405<>CHERY MOTORS">CHERY MOTORS</option>';break;
case "406": $option.= '<option value="406<>AVEP">AVEP</option>';break;
case "407": $option.= '<option value="407<>VIVA CONSORCIOS">VIVA CONSORCIOS</option>';break;
case "408": $option.= '<option value="408<>AUTOVALORE">AUTOVALORE</option>';break;
case "409": $option.= '<option value="409<>GFCAR">GFCAR</option>';break;
case "410": $option.= '<option value="410<>PREVINE">PREVINE</option>';break;
case "411": $option.= '<option value="411<>CLUBE SERVICE">CLUBE SERVICE</option>';break;
case "412": $option.= '<option value="412<>UNIBRA">UNIBRA</option>';break;
case "413": $option.= '<option value="413<>SOMA TRACK">SOMA TRACK</option>';break;
case "414": $option.= '<option value="414<>TIRADENTES">TIRADENTES</option>';break;
case "415": $option.= '<option value="415<>PARTICULAR">PARTICULAR</option>';break;
case "416": $option.= '<option value="416<>SOLTEL">SOLTEL</option>';break;
case "417": $option.= '<option value="417<>TOP CAR">TOP CAR</option>';break;
case "418": $option.= '<option value="418<>PROTEGIDO">PROTEGIDO</option>';break;
case "419": $option.= '<option value="419<>ULTRA BRASIL">ULTRA BRASIL</option>';break;
case "420": $option.= '<option value="420<>UNION SOLUTIONS">UNION SOLUTIONS</option>';break;
case "421": $option.= '<option value="421<>MASTER CLUBE UBERLANDIA">MASTER CLUBE UBERLANDIA</option>';break;
case "422": $option.= '<option value="422<>MUNDIAL">MUNDIAL</option>';break;
case "423": $option.= '<option value="423<>SIMPLIFICAR">SIMPLIFICAR</option>';break;
case "424": $option.= '<option value="424<>CLEAN">CLEAN</option>';break;
case "425": $option.= '<option value="425<>ALLIDER">ALLIDER</option>';break;
case "426": $option.= '<option value="426<>APROTEVE">APROTEVE</option>';break;
case "427": $option.= '<option value="427<>E-NOVATE">E-NOVATE</option>';break;
case "428": $option.= '<option value="428<>ASTRACO">ASTRACO</option>';break;
case "429": $option.= '<option value="429<>ROTA">ROTA</option>';break;
case "430": $option.= '<option value="430<>ULTRA">ULTRA</option>';break;
case "431": $option.= '<option value="431<>UNICOON PARANA">UNICOON PARANA</option>';break;
case "432": $option.= '<option value="432<>PROTEAUTO">PROTEAUTO</option>';break;
case "433": $option.= '<option value="433<>APVS SUDESTE">APVS SUDESTE</option>';break;
case "434": $option.= '<option value="434<>CLUBE UNIR">CLUBE UNIR</option>';break;
case "435": $option.= '<option value="435<>APM">APM</option>';break;
case "436": $option.= '<option value="436<>MASTER-CONSULTOR">MASTER-CONSULTOR</option>';break;
case "437": $option.= '<option value="437<>HM PROTECAO">HM PROTECAO</option>';break;
case "438": $option.= '<option value="438<>CLUBCAR">CLUBCAR</option>';break;
case "439": $option.= '<option value="439<>AZUL CLUBE">AZUL CLUBE</option>';break;
case "440": $option.= '<option value="440<>GOL PLUS BRASIL">GOL PLUS BRASIL</option>';break;
case "441": $option.= '<option value="441<>ESTILO PROTECAO">ESTILO PROTECAO</option>';break;
case "442": $option.= '<option value="442<>PHP PROTECAO">PHP PROTECAO</option>';break;
case "443": $option.= '<option value="443<>ACERTT">ACERTT</option>';break;
case "444": $option.= '<option value="444<>APVA">APVA</option>';break;
case "445": $option.= '<option value="445<>ASTRAC">ASTRAC</option>';break;
case "446": $option.= '<option value="446<>SEGURYCAR">SEGURYCAR</option>';break;
case "447": $option.= '<option value="447<>VITALLYS BRASIL">VITALLYS BRASIL</option>';break;
case "448": $option.= '<option value="448<>BRASIL CAR">BRASIL CAR</option>';break;  
case "449": $option.= '<option value="449<>UNIDAS">UNIDAS</option>';break;
case "450": $option.= '<option value="450<>ELLO">ELLO</option>';break;  
case "451": $option.= '<option value="451<>UNICOON CONTAGEM">UNICOON CONTAGEM</option>';break;  
case "452": $option.= '<option value="452<>FOCAR BRASIL">FOCAR BRASIL</option>';break;
case "453": $option.= '<option value="453<>PLACAR VEICULAR">PLACAR VEICULAR</option>';break;  
case "454": $option.= '<option value="454<>PROTECAR">PROTECAR</option>';break;  
case "455": $option.= '<option value="455<>UCA MELHOR">UCA MELHOR</option>';break;   
case "456": $option.= '<option value="456<>PROTEAUTO MARINGA">PROTEAUTO MARINGA</option>';break;  
case "457": $option.= '<option value="457<>AUTO VIP">AUTO VIP</option>';break; 
case "458": $option.= '<option value="458<>PRONTOCAR">PRONTOCAR</option>';break; 
case "459": $option.= '<option value="459<>PENSAR CLUBE">PENSAR CLUBE</option>';break;
case "460": $option.= '<option value="460<>AUTO BAHIA">AUTO BAHIA</option>';break;
case "461": $option.= '<option value="461<>MAXIMUS BRASIL">MAXIMUS BRASIL</option>';break;
case "462": $option.= '<option value="462<>PROTECT">PROTECT</option>';break;
			}
	}
}
//se a prestadora n�o conter a determinada Seguradora ent�o redirecionar para uma p�gina que a prestadora contenha alguma seguradora
?>

<form name="form1" method="post" action="relatorio.php?visualiza=ok">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr width="100%">
    <td height="35" colspan="2" style="background-color:#000; color:#FFF"><div align="center" class="style16">Relat&oacute;rios de Faturamento</div></td>
  </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
      <td width="25%" height="35"class="style18">&nbsp;&nbsp;Contratante</td>
      <td height="35" class="style18"> <div align="left" class="style12" >
      <select name="cliente" class="fora4" id="cliente" <? echo $focus;?> onChange="x(this.value,'dados_relatorio','modifica_relatorio');">
      <option value=""></option>
 	  <? echo $option;?>
      </select>&nbsp;</div></td>
    </tr>   
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
      <td height="35" class="style18">&nbsp;&nbsp;Relat&oacute;rio</td>
      <td height="35" class="style18">
      <div id="modifica_relatorio" class="style12">
      <select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
        <option value=""></option>
        <option value="DTVISTORIA">EXCEL - data de vistoria</option>
        <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
      </select>
      </div>      </td>
    </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
      <td height="35" class="style18">&nbsp;&nbsp;Ordenar por</td>
      <td height="35" class="style18"> <div align="left" class="style12">
        <select name="ordernar" class="style18" id="ordernar">
          <option value=""></option>
          <option value="NUMEROSOLICITACAO">n&uacute;mero da solicita&ccedil;&atilde;o</option>
          <option value="NRVISTORIA">n&uacute;mero da vistoria</option>
          <option value="NMPROPONENTE">segurado</option>
          <option value="DTVISTORIA">data da vistoria</option>
          <option value="DTTRANS">data de transmiss&atilde;o</option>
          <option value="controle_prest">vistoriador</option>
        </select>
        <input name="por" type="radio" id="radio" value="asc" checked>
        crescente
        <input type="radio" name="por" id="radio2" value="desc">
      decrescente</div></td>
    </tr>
<TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
	<td height="35" class="style18"><div align="left" id="checar_relatorio">&nbsp;&nbsp;<span class="style19">Escolha um tipo de relat&oacute;rio</span></div></td>
    <td height="35" class="style18"> <div align="left" class="style12" ><input name="DATA_INICIAL" type="text" class="fora4" id="DATA_INICIAL" size="15" maxlength="10" style="text-align:center" onKeyPress="mascara(this,data)" ><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('DATA_INICIAL'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="../imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a> 
      &nbsp;a&nbsp; 
      <input name="DATA_FINAL" type="text" class="fora4" id="DATA_FINAL" size="15" maxlength="10" style="text-align:center" onKeyPress="mascara(this,data)" ><a href="#" onClick="cal = new CalendarPopup(); cal.select(document.getElementById('DATA_FINAL'),'anchor1','dd/MM/yyyy'); return false;"NAME="anchor1" ID="anchor1"><img src="../imagens/cal.png" border="0px" style=" vertical-align:bottom;" /></a></div></td>
    </tr>
 <tr>
    <td height="35" colspan="2" class="style18">
    <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onClick="window.top.novo('financeiro','financeiro','checar_body');window.top.document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/excel_img.png" name="Submit" id="button" title="Gerar Relat&oacute;rio" />
	</div>
    </td>
  </tr>
</table>
</form>
<? }?>

<!-- BRADESCO SEGUROS -->
<? 
if($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='TXT_bradesco'&&$_POST[cliente]=='0<>Bradesco Seguros')
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};


$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '0'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);
/*
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 0 AND checado !='' AND DTTRANS  >=".$data_inicial." AND DTTRANS <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
*/
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 0 AND DTTRANS  >=".$data_inicial." AND DTTRANS <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." AND CDFINALIDADE NOT IN ('08','09') order by ".$_POST[ordernar]." desc";
	
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
	if (mysql_num_rows($result_fatcom)>0)
	{
		
		$volante=0;
		$fixo=0;
		while ($reg= mysql_fetch_array($result_fatcom))
		{
		// verifica SE N�O TEM parceiro
		$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
			id = ".$reg['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador'];
		$result_sqlSol = mysql_query($sqlSol,$db);
		$Sol = @mysql_fetch_array($result_sqlSol);
		
		
		if($Sol['clienteOrigem']==''){


	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$reg[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	$CDFILIAL = str_pad($prestador_filial[codigo_filial], 4, "0", STR_PAD_LEFT);
	
	if($reg['UFVISTORIA']!=''){
		$UF = trim($reg['UFVISTORIA']);
		}else{
			$UF = trim($prestador_filial['uf']);
			}
	
	//selecionando a filial para pegar a regiao correta
$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial[id]." AND seguradora = '0' AND roteirizador = ".$reg[roteirizador]."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	$preco_volante = str_pad(str_replace(".",",",$resultadoPreco[preco_vistoria]), 8 , " ", STR_PAD_LEFT);
	$preco_posto = str_pad(str_replace(".",",",$resultadoPreco[preco_vistoria_posto]), 8 , " ", STR_PAD_LEFT);
	if ($reg["TPVISTORIA"]=='V'){
		
		if($reg['roteirizador']=='1786'){
			if($UF=='SP'){
				$PRECOVISTORIA='37.00';
				}else{
					$PRECOVISTORIA='39.00';
					}
			}else{
				$PRECOVISTORIA=$preco_volante;
				}
		$volante++;
		
		$totalVolante+=($PRECOVISTORIA);
		
		}else{
			
			if($reg['roteirizador']=='1786'){
				if($UF=='SP'){
					$PRECOVISTORIA='31.00';
					}else{
						$PRECOVISTORIA='30.00';
						}
			}else{
				$PRECOVISTORIA=$preco_posto;
				}
			
			$fixo++;
			
			$totalPosto+=$PRECOVISTORIA;
			}
	$MES = str_pad($data_final1{2}.$data_final1{3}, 2, "0", STR_PAD_LEFT);
	$NRVISTORIA = str_pad($reg["NRVISTORIA"], 10, "000000", STR_PAD_LEFT);
	$DVVISTORIA =  "0000";	
	preg_match("/([0-9]{3})/",$reg["CDSUCURSAL"],$sucursal1);
	$sucursal=$sucursal1[1];
	if($sucursal==""){$CDSUCURSAL="002";}else{$CDSUCURSAL=$sucursal; }
	$NMCORRETOR = str_pad(utf8_encode($reg["NMCORRETOR"]), 40, " ", STR_PAD_LEFT);
	$DTVISTORIA = $reg["DTVISTORIA"]{6}.$reg["DTVISTORIA"]{7}.$reg["DTVISTORIA"]{4}.$reg["DTVISTORIA"]{5}.$reg["DTVISTORIA"]{0}.$reg["DTVISTORIA"]{1}.$reg["DTVISTORIA"]{2}.$reg["DTVISTORIA"]{3};
	$DTPROC = $reg["DTPROC"]{6}.$reg["DTPROC"]{7}.$reg["DTPROC"]{4}.$reg["DTPROC"]{5}.$reg["DTPROC"]{0}.$reg["DTPROC"]{1}.$reg["DTPROC"]{2}.$reg["DTPROC"]{3};
	$DTTRANS = $reg["DTTRANS"]{6}.$reg["DTTRANS"]{7}.$reg["DTTRANS"]{4}.$reg["DTTRANS"]{5}.$reg["DTTRANS"]{0}.$reg["DTTRANS"]{1}.$reg["DTTRANS"]{2}.$reg["DTTRANS"]{3};
	$TPVISTORIA = $reg["TPVISTORIA"];
	 if ($reg["CDFINALIDADE"]=='01'){ $CDFINALIDADE = "         Novo (previa)";}
     if ($reg["CDFINALIDADE"]=='02'){ $CDFINALIDADE = "      Reducao franquia";}
     if ($reg["CDFINALIDADE"]=='03'){ $CDFINALIDADE = "     Parcela em atraso";}
     if ($reg["CDFINALIDADE"]=='04'){ $CDFINALIDADE = "          Substituicao";}
     if ($reg["CDFINALIDADE"]=='05'){ $CDFINALIDADE = "             Renovacao";}
     if ($reg["CDFINALIDADE"]=='06'){ $CDFINALIDADE = "   Inclusao acessorios";}
     if ($reg["CDFINALIDADE"]=='07'){ $CDFINALIDADE = "   Exclusao de avarias";}
     if ($reg["CDFINALIDADE"]=='08'){ $CDFINALIDADE = "Consorcio - Subst Gara";}
     if ($reg["CDFINALIDADE"]=='09'){ $CDFINALIDADE = " Consorcio - Aval. bem";}
     if ($reg["CDFINALIDADE"]=='10'){ $CDFINALIDADE = "     Vistoria Especial";}
     if ($reg["CDFINALIDADE"]=='11'){ $CDFINALIDADE = "Incl. de Cla. de Vidro";}
     if ($reg["CDFINALIDADE"]=='99'){ $CDFINALIDADE = "                Outros";}
	$NMPROPONENTE = str_pad(substr($reg["NMPROPONENTE"], 0, 40), 40, " ", STR_PAD_LEFT);
	$NRPLACA = str_pad($reg["NRPLACA"], 7, "0", STR_PAD_LEFT);
	$chassi1 = str_replace(".","",$reg["NRCHASSI"]);
	$chassi = str_replace("|","",$chassi1);
	$NRCHASSI =  str_pad($chassi, 22, " ", STR_PAD_LEFT );
	$DSMUNICIPIOVISTORIA = str_pad(substr($reg["DSMUNICIPIOVISTORIA"], 0, 20), 20, " ", STR_PAD_LEFT );
	$CEPVISTORIA = str_pad($reg["CEPVISTORIA"], 8 );
	$CDCORRETORSUSEP = str_pad($reg["CDCORRETORSUSEP"], 14, "0", STR_PAD_LEFT );
	
	//PREPARA O CONTE�DO A SER GRAVADO  
	$conteudo	= "$MES$VISTORIADORA$CDFILIAL$NRVISTORIA$DVVISTORIA$CDSUCURSAL$NMCORRETOR$DTVISTORIA$DTPROC$DTTRANS$TPVISTORIA$CDFINALIDADE$NMPROPONENTE$NRPLACA$NRCHASSI$DSMUNICIPIOVISTORIA$CEPVISTORIA$CDCORRETORSUSEP$PRECOVISTORIA$UF\n";
	//ARQUIVO TXT
	
	@mkdir ("fatcom_bradesco/".$_SESSION[roteirizador], 0777);
	$arquivo = "fatcom_bradesco/".$_SESSION[roteirizador]."/FATCOM_BRADESCO_".date("Ymd")."_".date("Hi").".txt";
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $conteudo)) {}
	
		}// fim verifica parceiro
	
	
		}
	}
	
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="45" style="background-color:#000; color:#FFF" ><div align="center">Fatcom Bradesco</div></td>
  </tr>
  <TR height="45" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="45" class="style18"><b>&nbsp;Informa&ccedil;&atilde;o:</b><br> Quantidade de Vistorias Volante => <? echo $volante;?> - Valor R$ <? echo $totalVolante; ?>,00 <br>Quantidade de Vistorias Posto Fixo => <? echo $fixo;?> - Valor R$ <? echo $totalPosto;?>,00<br>Quantidade Total de Vistorias => <? echo ($volante+$fixo);?> - Valor R$ <? echo ($totalVolante+$totalPosto); ?>,00</td>
  </tr>
  <TR height="45" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><div align="center">Clique com o bot&atilde;o direito sobre o link => <a href="<? echo $arquivo;?>">Baixar FATCOM Bradesco Seguros</a></div></td>
  </tr>
  <tr>
    <td height="45"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
	
	//FECHA O ARQUIVO 
	fclose($abrir);
?>
<?
}
?>

<!-- FIM RELAT�RIO - BRADESCO SEGUROS -->

<!-- BRADESCO CONS�RCIO -->
<? 
if($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='TXT_bradesco_consorcio'&&$_POST[cliente]=='0<>Bradesco Seguros')
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};


$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '0'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);
/*
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 0 AND checado !='' AND DTTRANS  >=".$data_inicial." AND DTTRANS <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
*/
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 0 AND DTTRANS  >=".$data_inicial." AND DTTRANS <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." AND CDFINALIDADE IN ('08','09')  order by ".$_POST[ordernar]." desc";

	$result_fatcom = mysql_query($sql_fatcom,$db);
	
	if (mysql_num_rows($result_fatcom)>0)
	{
		
		$volante=0;
		$fixo=0;
		while ($reg= mysql_fetch_array($result_fatcom))
		{
			
			
		// BUSCA SOLICITA��O
		$sql_solicitacao = "SELECT proposta,clienteOrigem,digito_controle_cdc FROM ".$bancoDados.".solicitacao WHERE id = ".$reg['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador']." order by DTVISTORIA ASC";
		$result_solicitacao = @mysql_query($sql_solicitacao,$db);
		$solicitacao = @mysql_fetch_array($result_solicitacao);	
			
			if($solicitacao['clienteOrigem']==''){



	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$reg[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	$CDFILIAL = str_pad($prestador_filial[codigo_filial], 4, "0", STR_PAD_LEFT);
	
	if($reg['UFVISTORIA']!=''){
		$UF = trim($reg['UFVISTORIA']);
		}else{
			$UF = trim($prestador_filial['uf']);
			}
	
	//selecionando a filial para pegar a regiao correta
$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial[id]." AND seguradora = '0' AND roteirizador = ".$reg[roteirizador]."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	$preco_volante = str_pad(str_replace(".",",",$resultadoPreco[preco_vistoria]), 8 , "0", STR_PAD_LEFT);
	$preco_posto = str_pad(str_replace(".",",",$resultadoPreco[preco_vistoria_posto]), 8 , "0", STR_PAD_LEFT);
	if ($reg["TPVISTORIA"]=='V'){
		
		if($reg['roteirizador']=='1786'){
			if($UF=='SP'){
				$PRECOVISTORIA='37.00';
				}else{
					$PRECOVISTORIA='39.00';
					}
		}else{
			$PRECOVISTORIA=$preco_volante;
			}
		
		
		$volante++;
		$totalVolante+=($PRECOVISTORIA);
		
		}else{
			
			if($reg['roteirizador']=='1786'){
				if($UF=='SP'){
					$PRECOVISTORIA='31.00';
					}else{
						$PRECOVISTORIA='30.00';
						}	
			}else{
				$PRECOVISTORIA=$preco_posto;
				}
			
			
			$fixo++;
			$totalPosto+=$PRECOVISTORIA;
			
			}
			
	$MES = str_pad($data_final1{2}.$data_final1{3}, 2, "0", STR_PAD_LEFT);
	$NRVISTORIA = str_pad($reg["NRVISTORIA"], 10, "000000", STR_PAD_LEFT);
	$DVVISTORIA =  "0000";	
	preg_match("/([0-9]{3})/",$reg["CDSUCURSAL"],$sucursal1);
	$sucursal=$sucursal1[1];
	if($sucursal==""){$CDSUCURSAL="002";}else{$CDSUCURSAL=$sucursal; }
	$NMCORRETOR = str_pad(strtoupper(utf8_encode($reg["NMCORRETOR"])), 40);
	$DTVISTORIA = $reg["DTVISTORIA"]{6}.$reg["DTVISTORIA"]{7}.$reg["DTVISTORIA"]{4}.$reg["DTVISTORIA"]{5}.$reg["DTVISTORIA"]{0}.$reg["DTVISTORIA"]{1}.$reg["DTVISTORIA"]{2}.$reg["DTVISTORIA"]{3};
	$DTPROC = $reg["DTPROC"]{6}.$reg["DTPROC"]{7}.$reg["DTPROC"]{4}.$reg["DTPROC"]{5}.$reg["DTPROC"]{0}.$reg["DTPROC"]{1}.$reg["DTPROC"]{2}.$reg["DTPROC"]{3};
	$DTTRANS = $reg["DTTRANS"]{6}.$reg["DTTRANS"]{7}.$reg["DTTRANS"]{4}.$reg["DTTRANS"]{5}.$reg["DTTRANS"]{0}.$reg["DTTRANS"]{1}.$reg["DTTRANS"]{2}.$reg["DTTRANS"]{3};
	$TPVISTORIA = $reg["TPVISTORIA"];
     if ($reg["CDFINALIDADE"]=='08'){ $CDFINALIDADE1 = "Substitui��o de Garan.";}
     if ($reg["CDFINALIDADE"]=='09'){ $CDFINALIDADE1 = "Avalalia��o de Bem";}
    
	$CDFINALIDADE=str_pad($CDFINALIDADE1, 22, " ", STR_PAD_RIGHT);
	$NMPROPONENTE = str_pad(substr(strtoupper($reg["NMPROPONENTE"]), 0, 40), 40);
	$NRPLACA = str_pad(strtoupper($reg["NRPLACA"]), 7, "0", STR_PAD_LEFT);
	$chassi1 = str_replace(".","",$reg["NRCHASSI"]);
	$chassi = str_replace("|","",$chassi1);
	$NRCHASSI =  str_pad(strtoupper($chassi), 22 );
	$DSMUNICIPIOVISTORIA = str_pad(substr(strtoupper($reg["DSMUNICIPIOVISTORIA"]), 0, 20), 20 );
	$CEPVISTORIA = str_pad($reg["CEPVISTORIA"], 8 );
	$CDCORRETORSUSEP = str_pad($reg["CDCORRETORSUSEP"], 14 );
	
	
		
	$SOLICITACAO = str_pad($solicitacao['proposta'], 40, " ", STR_PAD_RIGHT);
	//PREPARA O CONTE�DO A SER GRAVADO  
	
	$conteudo	= "$MES$VISTORIADORA$SOLICITACAO$CDFILIAL$NRVISTORIA$DVVISTORIA$CDSUCURSAL$NMCORRETOR$DTVISTORIA$DTPROC$DTTRANS$TPVISTORIA$CDFINALIDADE$NMPROPONENTE$NRPLACA$NRCHASSI$DSMUNICIPIOVISTORIA$CEPVISTORIA$CDCORRETORSUSEP$PRECOVISTORIA$UF\n";
	//ARQUIVO TXT
	
	@mkdir ("fatcom_bradesco/".$_SESSION[roteirizador], 0777);
	$arquivo = "fatcom_bradesco/".$_SESSION[roteirizador]."/FATCOM_BRADESCO_CONSORCIO".date("Ymd")."_".date("Hi").".txt";
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $conteudo)) {}
	
		}// fim verifica parceiro
	
		}
	}
	
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" >Fatcom Bradesco Consorcio</div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><b>&nbsp;Informa&ccedil;&atilde;o:</b><br> Quantidade de Vistorias Volante => <? echo $volante;?> - Valor R$ <? echo $totalVolante;?>,00 <br>Quantidade de Vistorias Posto Fixo => <? echo $fixo;?> - Valor R$ <? echo $totalPosto;?>,00<br>Quantidade Total de Vistorias => <? echo ($volante+$fixo);?> - Valor R$ <? echo ($totalVolante+$totalPosto); ?>,00</td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#F9F9F9" class="style18"><div align="center">Clique com o bot&atilde;o direito sobre o link =>  <a href="<? echo $arquivo;?>">Baixar FATCOM Bradesco Consorcio</a></div></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
	
	//FECHA O ARQUIVO 
	fclose($abrir);
?>
<?
}
?>

<!-- FIM RELAT�RIO - BRADESCO CONS�RCIO -->

<!-- SULAMERICA - SULAMERIA (TXT) -->
<? 

if($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='TXT_sas'&&$_POST[cliente]=='67<>SUL AMERICA')
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};


$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '67'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);

/*
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 67 AND DTVISTORIA >=".$data_inicial." AND DTVISTORIA <=".$data_final." AND status_trans='4####' AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." asc";
*/
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 67 AND DTTRANS >=".$data_inicial." AND DTTRANS <=".$data_final." AND status_trans='4####' AND roteirizador = ".$_SESSION[roteirizador]." ORDER BY ".$_POST[ordernar]." asc";
	
	

	$result_fatcom = mysql_query($sql_fatcom,$db);
	
	if (mysql_num_rows($result_fatcom)>0)
	{
		
		while ($reg= mysql_fetch_array($result_fatcom))
		{
			
		// verifica SE N�O TEM parceiro
		$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
			id = ".$reg['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador'];
		$result_sqlSol = mysql_query($sqlSol,$db);
		$Sol = @mysql_fetch_array($result_sqlSol);
		
		
		if($Sol['clienteOrigem']==''){

	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$reg[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	//endereco
	$sql_endereco = "SELECT endereco,numero FROM ".$bancoDados.".solicitacao WHERE id = '".$reg["NUMEROSOLICITACAO"]."'";
	$result_endereco= mysql_query($sql_endereco,$db);
	$endereco = mysql_fetch_array($result_endereco);
	
	//ID VISTORIADOR SAS
	$sql_vist_sul = "SELECT id_vist FROM ".$bancoDados.".controle_vp_sul_vist WHERE controle_prest = ".$reg['controle_prest']." AND ativo=0";
	$result_vist_sul = mysql_query($sql_vist_sul,$db);
	$user_prest = mysql_fetch_array($result_vist_sul);
	
	//cidade_atende
	$sql_cidade = "SELECT cidade_atende, sucursal FROM ".$bancoDados.".cidade_atende_sas WHERE id = '".$reg["cidade_atende"]."' AND roteirizador=".$_SESSION[roteirizador]."";
	$result_cidade= mysql_query($sql_cidade,$db);
	$cidade = mysql_fetch_array($result_cidade);

	
	//numero vistoria sas
	$sql_nrsas = "SELECT laudo_sas FROM ".$bancoDados.".laudo_sas WHERE solicitacao = '".$reg["NUMEROSOLICITACAO"]."'";
	$result_nrsas= mysql_query($sql_nrsas,$db);
	$nrsas = mysql_fetch_array($result_nrsas);
	
// PEGANDO A SUCURSAL STYLLUS
if ($reg[roteirizador]==1786){
$UF = trim($reg['UFVISTORIA']);
switch($reg[CDCIA]){
	case '7110': if($cidade['sucursal']=='221')
					{
					$cod_firma="3954";
					$prefixo_arquivo="STCA";
					$unidade_op2="221";
						}
				 if($cidade['sucursal']=='337')
					{
					$cod_firma="3955";
					$prefixo_arquivo="STRP";
					$unidade_op2="337";
						}
				 if($cidade['sucursal']=='060')
					{
					$cod_firma="3958";
					$prefixo_arquivo="STSP";
					$unidade_op2="060";
						}
				 if($cidade['sucursal']=='035')
					{
						
						switch($reg['UFVISTORIA']){
							case 'PB': $prefixo_arquivo='STPB'; break;
							case 'PE': $prefixo_arquivo='STPE'; break;
							case 'RN': $prefixo_arquivo='STRN'; break;
							case 'AL': $prefixo_arquivo='STAL'; break;
							default: break;
							}
							
					$cod_firma="3976";
					$unidade_op2="035";
						}
				 if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='STGO'; $cod_firma="3977"; break;
							case 'DF': $prefixo_arquivo='STDF'; $cod_firma="3983"; break;
							default: break;
							}
							
					$cod_firma="3977";
					$unidade_op2="124";
						}
				 if($cidade['sucursal']=='019')
					{
						
						switch($reg['UFVISTORIA']){
							case 'PA': $prefixo_arquivo='STPA'; break;
							case 'AM': $prefixo_arquivo='STAM'; break;
							case 'AP': $prefixo_arquivo='STAP'; break;
							case 'RR': $prefixo_arquivo='STRR'; break;
							default: break;
							}
						
					$cod_firma="3978";
					$unidade_op2="019";
						}
				if($cidade['sucursal']=='027')
					{
						
						switch($reg['UFVISTORIA']){
							case 'CE': $prefixo_arquivo='STCE'; break;
							case 'PI': $prefixo_arquivo='STPI'; break;
							case 'MA': $prefixo_arquivo='STMA'; break;
							default: break;
							}
						
					$cod_firma="3984";
					$unidade_op2="027";
						}
				if($cidade['sucursal']=='310')
					{
						
						switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='STMT'; break;
							case 'MS': $prefixo_arquivo='STMS'; break;
							case 'RO': $prefixo_arquivo='STRO'; break;
							default: break;
							}
						
					$cod_firma="3982";
					$unidade_op2="310";
						}
				if($cidade['sucursal']=='043')
					{
						
						switch($reg['UFVISTORIA']){
							case 'BA': $prefixo_arquivo='STBA'; break;
							case 'SE': $prefixo_arquivo='STSE'; break;
							default: break;
							}
						
					$cod_firma="3989";
					$unidade_op2="043";
						}	
						;break;
	case '6181': if($cidade['sucursal']=='221')
					{
					$cod_firma="3954";
					$prefixo_arquivo="STCA";
					//$unidade_op2="930";
					$unidade_op2="221";
						}
				 if($cidade['sucursal']=='337')
					{
					$cod_firma="3955";
					$prefixo_arquivo="STRP";
					//$unidade_op2="930";
					$unidade_op2="337";
						}
				 if($cidade['sucursal']=='060')
					{
					$cod_firma="3958";
					$prefixo_arquivo="STSP";
					//$unidade_op2="930";
					$unidade_op2="060";
						}
				 if($cidade['sucursal']=='035')
					{
						switch($reg['UFVISTORIA']){
							case 'PB': $prefixo_arquivo='STPB'; break;
							case 'PE': $prefixo_arquivo='STPE'; break;
							case 'RN': $prefixo_arquivo='STRN'; break;
							case 'AL': $prefixo_arquivo='STAL'; break;
							default: break;
							}
							
					$cod_firma="3976";
					$unidade_op2="035";
						}
				 if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='STGO'; $cod_firma="3977"; break;
							case 'DF': $prefixo_arquivo='STDF'; $cod_firma="3983"; break;
							default: break;
							}
					$unidade_op2="124";
						}
				 if($cidade['sucursal']=='019')
					{
						
						switch($reg['UFVISTORIA']){
							case 'PA': $prefixo_arquivo='STPA'; break;
							case 'AM': $prefixo_arquivo='STAM'; break;
							case 'AP': $prefixo_arquivo='STAP'; break;
							case 'RR': $prefixo_arquivo='STRR'; break;
							default: break;
							}
							
					$cod_firma="3978";
					$unidade_op2="019";
						}
				 if($cidade['sucursal']=='027')
					{
						
						switch($reg['UFVISTORIA']){
							case 'CE': $prefixo_arquivo='STCE'; break;
							case 'PI': $prefixo_arquivo='STPI'; break;
							case 'MA': $prefixo_arquivo='STMA'; break;
							default: break;
							}
							
					$cod_firma="3984";
					$unidade_op2="027";
						}
				if($cidade['sucursal']=='310')
					{
						
						switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='STMT'; break;
							case 'MS': $prefixo_arquivo='STMS'; break;
							case 'RO': $prefixo_arquivo='STRO'; break;
							default: break;
							}
							
					$cod_firma="3982";
					$unidade_op2="310";
						}
				if($cidade['sucursal']=='043')
					{
						
						switch($reg['UFVISTORIA']){
							case 'BA': $prefixo_arquivo='STBA'; break;
							case 'SE': $prefixo_arquivo='STSE'; break;
							default: break;
							}
							
					$cod_firma="3989";
					$unidade_op2="043";
						}		
						;break;
	case '2631': if($cidade['sucursal']=='221')
					{
					$cod_firma="3954";
					$prefixo_arquivo="STCA";
					//$unidade_op2="620";
					$unidade_op2="221";
						}
				 if($cidade['sucursal']=='337')
					{
					$cod_firma="3955";
					$prefixo_arquivo="STRP";
					//$unidade_op2="620";
					$unidade_op2="337";
						}
				 if($cidade['sucursal']=='060')
					{
					$cod_firma="3958";
					$prefixo_arquivo="STSP";
					//$unidade_op2="620";
					$unidade_op2="060";
						}
				 if($cidade['sucursal']=='035')
					{
						
						switch($reg['UFVISTORIA']){
							case 'PB': $prefixo_arquivo='STPB'; break;
							case 'PE': $prefixo_arquivo='STPE'; break;
							case 'RN': $prefixo_arquivo='STRN'; break;
							case 'AL': $prefixo_arquivo='STAL'; break;
							default: break;
							}
							
					$cod_firma="3976";
					//$unidade_op2="620";
					$unidade_op2="035";
						}
				 if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='STGO'; $cod_firma="3977"; break;
							case 'DF': $prefixo_arquivo='STDF'; $cod_firma="3983"; break;
							default: break;
							}
					$unidade_op2="124";
						}
				 if($cidade['sucursal']=='019')
					{
						
						switch($reg['UFVISTORIA']){
							case 'PA': $prefixo_arquivo='STPA'; break;
							case 'AM': $prefixo_arquivo='STAM'; break;
							case 'AP': $prefixo_arquivo='STAP'; break;
							case 'RR': $prefixo_arquivo='STRR'; break;
							default: break;
							}
							
					$cod_firma="3978";
					//$unidade_op2="620";
					$unidade_op2="019";
						}
				if($cidade['sucursal']=='027')
					{
						
						switch($reg['UFVISTORIA']){
							case 'CE': $prefixo_arquivo='STCE'; break;
							case 'PI': $prefixo_arquivo='STPI'; break;
							case 'MA': $prefixo_arquivo='STMA'; break;
							default: break;
							}
							
					$cod_firma="3984";
					$unidade_op2="027";
						}
				if($cidade['sucursal']=='310')
					{
						
						switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='STMT'; break;
							case 'MS': $prefixo_arquivo='STMS'; break;
							case 'RO': $prefixo_arquivo='STRO'; break;
							default: break;
							}
							
					$cod_firma="3982";
					$unidade_op2="310";
						}
				if($cidade['sucursal']=='043')
					{
						
						switch($reg['UFVISTORIA']){
							case 'BA': $prefixo_arquivo='STBA'; break;
							case 'SE': $prefixo_arquivo='STSE'; break;
							default: break;
							}
							
					$cod_firma="3989";
					$unidade_op2="043";
						}		
						;break;
	default:break;
	} // FIM SWITCH
} // FIM IF

// PEGANDO A SUCURSAL ACONFERIR
if ($reg[roteirizador]==20){
$UF = trim($prestador_filial['uf']);
switch($reg[CDCIA]){
	case '7110': if($cidade['sucursal']=='108')
					{
					$cod_firma="3956";
					$prefixo_arquivo="IMMG";
					$unidade_op2="108";
						};break;
	case '6181': if($cidade['sucursal']=='108')
					{
					$cod_firma="3956";
					$prefixo_arquivo="IMMG";
					//$unidade_op2="930";
					$unidade_op2="108";
						};break;
	case '2631': if($cidade['sucursal']=='108')
					{
					$cod_firma="3956";
					$prefixo_arquivo="IMMG";
					//$unidade_op2="620";
					$unidade_op2="108";
						};break;
	default:break;
	} // FIM SWITCH
} // FIM IF

// PEGANDO A SUCURSAL REALIZA
if ($reg['roteirizador']==90){
$UF = trim($prestador_filial['uf']);	
	
switch($reg['CDCIA']){
	case '7110': if($cidade['sucursal']=='108')
					{
					$cod_firma="3971";
					$prefixo_arquivo="RZMG";
					$unidade_op2="108";
						};break;
	case '6181': if($cidade['sucursal']=='108')
					{
					$cod_firma="3971";
					$prefixo_arquivo="RZMG";
					//$unidade_op2="930";
					$unidade_op2="108";
						};break;
	case '2631': if($cidade['sucursal']=='108')
					{
					$cod_firma="3971";
					$prefixo_arquivo="RZMG";
					//$unidade_op2="620";
					$unidade_op2="108";
						};break;
	default:break;
	} // FIM SWITCH
} // FIM IF

// PEGANDO A SUCURSAL ATTLAS
if ($reg['roteirizador']==190){
$UF = trim($prestador_filial['uf']);	
	
switch($reg['CDCIA']){
	case '7110': if($cidade['sucursal']=='310')
					{
					switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='ATMT'; break;
							case 'MS': $prefixo_arquivo='ATMS'; break;
							case 'RO': $prefixo_arquivo='ATRO'; break;
							case 'AC': $prefixo_arquivo='ATAC'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="310";
						}
				if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='ATGO'; break;
							case 'DF': $prefixo_arquivo='ATDF'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="124";
						}
					;break;
	case '6181': if($cidade['sucursal']=='310')
					{
					switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='ATMT'; break;
							case 'MS': $prefixo_arquivo='ATMS'; break;
							case 'RO': $prefixo_arquivo='ATRO'; break;
							case 'AC': $prefixo_arquivo='ATAC'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="310";
						}
				if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='ATGO'; break;
							case 'DF': $prefixo_arquivo='ATDF'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="124";
						}
						;break;
	case '2631': if($cidade['sucursal']=='310')
					{
					switch($reg['UFVISTORIA']){
							case 'MT': $prefixo_arquivo='ATMT'; break;
							case 'MS': $prefixo_arquivo='ATMS'; break;
							case 'RO': $prefixo_arquivo='ATRO'; break;
							case 'AC': $prefixo_arquivo='ATAC'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="310";
						}
						
					
				if($cidade['sucursal']=='124')
					{
						switch($reg['UFVISTORIA']){
							case 'GO': $prefixo_arquivo='ATGO'; break;
							case 'DF': $prefixo_arquivo='ATDF'; break;
							default: break;
							}
							
					$cod_firma="3931";
					$unidade_op2="124";
						}
						;break;
	default:break;
	} // FIM SWITCH
} // FIM IF

// PEGANDO A SUCURSAL VISTRIM
if ($reg['roteirizador']==230){
$UF = trim($prestador_filial['uf']);	
	
switch($reg['CDCIA']){
	case '7110': if($cidade['sucursal']=='108')
					{
					$cod_firma="3972";
					$prefixo_arquivo="VIMG";
					$unidade_op2="108";
						};break;
	case '6181': if($cidade['sucursal']=='108')
					{
					$cod_firma="3972";
					$prefixo_arquivo="VIMG";
					//$unidade_op2="930";
					$unidade_op2="108";
						};break;
	case '2631': if($cidade['sucursal']=='108')
					{
					$cod_firma="3972";
					$prefixo_arquivo="VIMG";
					//$unidade_op2="620";
					$unidade_op2="108";
						};break;
	default:break;
	} // FIM SWITCH
} // FIM IF


	$SUCURSAL=$unidade_op2;
	$MES = str_pad($data_inicial1{2}.$data_inicial1{3}, 2, "0", STR_PAD_LEFT);


switch($MES){
	case "01": $MES_REF1 = "JAN/"; break;
	case "02": $MES_REF1 = "FEV/"; break;
	case "03": $MES_REF1 = "MAR/"; break;
	case "04": $MES_REF1 = "ABR/"; break;
	case "05": $MES_REF1 = "MAI/"; break;
	case "06": $MES_REF1 = "JUN/"; break;
	case "07": $MES_REF1 = "JUL/"; break;
	case "08": $MES_REF1 = "AGO/"; break;
	case "09": $MES_REF1 = "SET/"; break;
	case "10": $MES_REF1 = "OUT/"; break;
	case "11": $MES_REF1 = "NOV/"; break;
	case "12": $MES_REF1 = "DEZ/"; break;
	default:break;
	}
	
	$MES_REF=$MES_REF1.date('y');
	$COD_EMPRESA=$cod_firma;
	$DTVISTORIA = $reg["DTVISTORIA"]{6}.$reg["DTVISTORIA"]{7}."/".$reg["DTVISTORIA"]{4}.$reg["DTVISTORIA"]{5}."/".$reg["DTVISTORIA"]{0}.$reg["DTVISTORIA"]{1}.$reg["DTVISTORIA"]{2}.$reg["DTVISTORIA"]{3};
	$NMPROPONENTE = strtoupper(str_pad(substr($reg["NMPROPONENTE"], 0, 40), 40));
	$endereco1 = substr(strtoupper(trim($endereco["endereco"])),0,30);
	$numero = $endereco["numero"];
	$ENDERECO = str_pad($endereco1." ,".$numero, 40, " ", STR_PAD_RIGHT);
	$CIDADE = str_pad($cidade["cidade_atende"], 30);
	$NRVISTORIA = str_pad($nrsas["laudo_sas"], 9);
	$TPVISTORIA = $reg["CDFINALIDADE"];
	if($reg["TPVISTORIA"]=='P'){
		$LOCAL="01";
		}else{
			$LOCAL="02";
			}
	$NMFABRICANTE=str_pad($reg["NMFABRICANTE"], 25, " ", STR_PAD_RIGHT);
	$ANOMODELO = $reg["NRANOMOD"];
	$PLACA = strtoupper($reg["NRPLACA"]);
	$chassi1 = str_replace(".","",$reg["NRCHASSI"]);
	$chassi = str_replace("|","",$chassi1);
	$NRCHASSI = str_pad(strtoupper($chassi), 17 );

	if(strlen($reg["PRECOVISTORIA"])==5){
	$PRECO = str_pad($reg["PRECOVISTORIA"]{0}.$reg["PRECOVISTORIA"]{1}.$reg["PRECOVISTORIA"]{2}.",".$reg["PRECOVISTORIA"]{3}.$reg["PRECOVISTORIA"]{4},6,"0",STR_PAD_LEFT);
	}else{
		$PRECO = str_pad($reg["PRECOVISTORIA"]{0}.$reg["PRECOVISTORIA"]{1}.",".$reg["PRECOVISTORIA"]{2}.$reg["PRECOVISTORIA"]{3},6,"0",STR_PAD_LEFT);
		}
	$CIA = $reg["CDCIA"];
	
	// ARRUMANDO PRE�O SE FOR POSTO DA SYLLUS VISTORIAS
	if($LOCAL=="01" && $reg['roteirizador']=='1786'){
		$PRECO="028,00";
		}
		
	// ARRUMANDO PRE�O SE FOR POSTO DA SYLLUS VISTORIAS
	if($LOCAL=="02" && $reg['roteirizador']=='1786'){
		$PRECO="030,70";
		}

		
	// ARRUMANDO PRE�O SE FOR POSTO DA REALIZA VISTORIAS
	if($reg['roteirizador']=='90'){
		$PRECO="032,70";
		}
		
	// ARRUMANDO PRE�O SE FOR POSTO DA REALIZA VISTORIAS
	if($reg['roteirizador']=='190'){
		$PRECO="038,90";
		}
	
	//PREPARA O CONTE�DO A SER GRAVADO  
	$conteudo	= "$SUCURSAL$MES_REF$COD_EMPRESA$DTVISTORIA$NMPROPONENTE$ENDERECO$CIDADE$UF$NRVISTORIA$TPVISTORIA$LOCAL$NMFABRICANTE$ANOMODELO$PLACA$NRCHASSI$PRECO$CIA\r\n";
	//ARQUIVO TXT
	
	@mkdir ("fatcom_sas/".$_SESSION['roteirizador'], 0777);
	$arquivo = "fatcom_sas/".$_SESSION['roteirizador']."/FATCOM_SAS_".date("Ymd")."_".date("Hi").".txt";
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $conteudo)) {}
	
	$preco+=$reg["PRECOVISTORIA"];   
	
		}// fim verifica parceiro
	
		}
	}
	
	$quantidade=mysql_num_rows($result_fatcom);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">Fatcom SAS</div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><b>&nbsp;Informa&ccedil;&atilde;o:</b><br> Quantidade de Vistorias <? echo $quantidade;?> - Valor R$ <? echo $preco;?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#F9F9F9" class="style18"><div align="center">Clique com o bot&atilde;o direito sobre o link =>  <a href="<? echo $arquivo;?>">Baixar FATCOM SAS</a></div></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
	
	//FECHA O ARQUIVO 
	fclose($abrir);
?>
<?
}
?>

<!-- FIM RELAT�RIO - SULAMERIA (TXT) -->

<!-- MAPFRE -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_frustradas'&&$_POST[cliente]=='60<>MAPFRE SEGUROS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_frustradas'&&$_POST[cliente]=='60<>MAPFRE SEGUROS'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 60 AND  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	while($result_fatcom1 = mysql_query($sql_fatcom1,$db)){
	
	// verifica SE N�O TEM parceiro
	$sqlSol = "SELECT clienteOrigem FROM ".$bancoDados.".solicitacao WHERE 
		id = ".$result_fatcom1['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador'];
	$result_sqlSol = mysql_query($sqlSol,$db);
	$Sol = @mysql_fetch_array($result_sqlSol);
	
	if($Sol['clienteOrigem']==''){	
	
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$result_fatcom1." AND avaliacao = '04' ";
$result_fatcom = mysql_query($sql_fatcom,$db);


	}// FIM VERIFICA PARCEIRO


	}

?>

<!-- RELAT�RIO FRUSTRADA MAPFRE -->


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Mapfre <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km_frustrada.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=60&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km_frustrada.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=60&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
} 


?>
<!-- FIM RELAT�RIO FRUSTRADA MAPFRE -->





<? 
if(
($_GET['visualiza']=="ok" && $_POST['tipo_relatorio']=='DTVISTORIA'&&$_POST['cliente']=='60<>MAPFRE SEGUROS')||
($_GET['visualiza']=="ok" && $_POST['tipo_relatorio']=='DTTRANS'&&$_POST['cliente']=='60<>MAPFRE SEGUROS')
)
{/*
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 60 AND ".$array_dados_filtro[0]." >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION['roteirizador']." ORDER BY ".$_POST['ordernar']." DESC";
$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Mapfre <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=60&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=60&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
*/}
?>

<!-- FIM RELAT�RIO - MAPFRE -->

<!-- MAPFRE WARRANTY -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_frustradas'&&$_POST[cliente]=='37<>MAPFRE WARRANTY'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_frustradas'&&$_POST[cliente]=='37<>MAPFRE WARRANTY'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom1 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 37 AND  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	while($result_fatcom1 = mysql_query($sql_fatcom1,$db)){
	
$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$result_fatcom1." AND avaliacao = '04' ";
$result_fatcom = mysql_query($sql_fatcom,$db);





	}

?>

<!-- RELAT�RIO FRUSTRADA MAPFRE WARRANTY-->


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Mapfre Warranty <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km_frustrada.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=37&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km_frustrada.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=37&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
} 


?>
<!-- FIM RELAT�RIO FRUSTRADA MAPFRE -->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_mapfre'&&$_POST[cliente]=='37<>MAPFRE WARRANTY'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_mapfre'&&$_POST[cliente]=='37<>MAPFRE WARRANTY'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 37 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Mapfre Warranty <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=37&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=37&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - MAPFRE WARRANTY-->

<!-- RELAT�RIO - MARITIMA -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_maritima'&&$_POST[cliente]=='61<>MARITIMA'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_maritima'&&$_POST[cliente]=='61<>MARITIMA'
)
{
$_POST['data1']=$_POST[DATA_INICIAL];	
$_POST['data2']=$_POST[DATA_FINAL];



$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 61 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias MARITIMA <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=61&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=61&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - MARITIMA -->

<!-- RELAT�RIO - TRUST -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_trust'&&$_POST[cliente]=='25<>TRUST'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_trust'&&$_POST[cliente]=='25<>TRUST'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 25 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias TRUST <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29"class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=25&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=25&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - TRUST -->

<!-- RELAT�RIO - ALLIANZ -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_allianz'&&$_POST[cliente]=='73<>ALLIANZ SEGUROS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_allianz'&&$_POST[cliente]=='73<>ALLIANZ SEGUROS'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 73 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Allianz <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=73&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=73&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - ALLIANZ -->

<!-- RELAT�RIO - SUL AMERICA -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_sulamerica'&&$_POST[cliente]=='67<>SUL AMERICA'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_sulamerica'&&$_POST[cliente]=='67<>SUL AMERICA'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 67 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Allianz <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=67&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=67&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - SUL AMERICA -->

<!-- RELAT�RIO - BONE -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_bone'&&$_POST[cliente]=='20<>BONE'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_bone'&&$_POST[cliente]=='20<>BONE'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 20 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias BONE <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=20&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=20&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - BONE -->

<!-- RELAT�RIO - MULTCAR -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_multcar'&&$_POST[cliente]=='21<>MULTCAR'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_multcar'&&$_POST[cliente]=='21<>MULTCAR'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 21 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias MULTCAR <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=21&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=21&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - MULTCAR -->

<!-- RELAT�RIO - RODOTRUCK -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_rodotruck'&&$_POST[cliente]=='22<>RODOTRUCK'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_rodotruck'&&$_POST[cliente]=='22<>RODOTRUCK'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 22 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias RODOTRUCK <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=22&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=22&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - RODOTRUCK-->

<!-- RELAT�RIO - VERTICE -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_vertice'&&$_POST[cliente]=='24<>VERTICE'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_vertice'&&$_POST[cliente]=='24<>VERTICE'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 24 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias VERTICE <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=24&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=24&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - VERTICE-->

<!-- RELAT�RIO - ACE SEGURADORA -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_ace'&&$_POST[cliente]=='23<>ACE'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_ace'&&$_POST[cliente]=='23<>ACE'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 23 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ACE SEGURADORA <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=23&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=23&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!-- FIM RELAT�RIO - ACE SEGURADORA-->

<!--FENACAMMMMMMMMMMMMMMMMMMMMMMMMMM-->


<? 
if(
($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_fenacam'&&$_POST[cliente]=='86<>FENACAM')||
($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_fenacam'&&$_POST[cliente]=='86<>FENACAM')
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 86 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias FENACAM <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=86&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=86&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!-- FIM FENACAM-->


<!--ZURICH-->


<? 
if(
($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_zurich'&&$_POST[cliente]=='39<>ZURICH')||
($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_zurich'&&$_POST[cliente]=='39<>ZURICH')
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 39 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ZURICH <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=39&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=39&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--FIM ZURICH-->


<!--ASSOFINSP-->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_assofinsp'&&$_POST[cliente]=='95<>ASSOFINSP'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_assofinsp'&&$_POST[cliente]=='95<>ASSOFINSP'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 95 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ASSOFINSP <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=95&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=95&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--ASSOFINSP-->

<!--APAS-->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_apas'&&$_POST[cliente]=='96<>APAS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_apas'&&$_POST[cliente]=='96<>APAS'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 96 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias APAS <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=96&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=96&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--APAS-->

<!--AVANT-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_avant'&&$_POST[cliente]=='33<>AVANT'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_avant'&&$_POST[cliente]=='33<>AVANT'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 33 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias AVANT <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=33&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=33&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--AVANT-->

<!--ACAN-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_avant'&&$_POST[cliente]=='34<>ACAN'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_avant'&&$_POST[cliente]=='34<>ACAN'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 34 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ACAN <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=34&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=34&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--ACAN-->

<!--UNIF-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_unif'&&$_POST[cliente]=='35<>UNIF'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_unif'&&$_POST[cliente]=='35<>UNIF'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 35 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias UNIF <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=35&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=35&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--UNIF-->

<!--MASTTERCAR-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_masttercar'&&$_POST[cliente]=='310<>MASTTERCAR'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_masttercar'&&$_POST[cliente]=='310<>MASTTERCAR'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 310 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias MASTTERCAR <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=310&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=310&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--MASTTERCAR-->

<!--MEGA-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_mega'&&$_POST[cliente]=='311<>MEGA'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_mega'&&$_POST[cliente]=='311<>MEGA'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 311 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias MEGA <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=311&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=311&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--MEGA-->

<!--FACILITY-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_facility'&&$_POST[cliente]=='312<>FACILITY'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_facility'&&$_POST[cliente]=='312<>FACILITY'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 312 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias FACILITY <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=312&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=312&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--FACILITY-->

<!--PREVICARRIO-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_previcarrio'&&$_POST[cliente]=='313<>PREVICARRIO'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_previcarrio'&&$_POST[cliente]=='313<>PREVICARRIO'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 313 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias PREVICARRIO <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=313&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=313&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--PREVICARRIO-->

<!--UNIPROPAS-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_unipropas'&&$_POST[cliente]=='314<>UNIPROPAS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_unipropas'&&$_POST[cliente]=='314<>UNIPROPAS'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 314 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias UNIPROPAS <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=314&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=314&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--UNIPROPAS-->

<!--APROCAM-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_aprocam_brasil'&&$_POST[cliente]=='36<>APROCAM BRASIL'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_aprocam_brasil'&&$_POST[cliente]=='36<>APROCAM BRASIL'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 36 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias APROCAM BRASIL <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=36&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=36&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--APROCAM BRASIL-->


<!--ASPEM-->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_aspem'&&$_POST[cliente]=='30<>ASPEM'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_aspem'&&$_POST[cliente]=='30<>ASPEM'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 30 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ASPEM <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=30&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=30&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--ASPEM-->



<!--ASSUTRAN-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_assutran'&&$_POST[cliente]=='32<>ASSUTRAN'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_assutran'&&$_POST[cliente]=='32<>ASSUTRAN'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 32 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias ASSUTRAN <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=32&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=32&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--ASSUTRAN-->

<!--BUREAU DE BENEFICIOS-->


<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_bureau'&&$_POST[cliente]=='31<>BUREAU DE BENEFICIOS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_bureau'&&$_POST[cliente]=='31<>BUREAU DE BENEFICIOS'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 31 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias BUREAU DE BENEFICIOS <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=31&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=31&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--BUREAU DE BENEFICIOS-->



<!--NOBRE-->



<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_nobre'&&$_POST[cliente]=='87<>NOBRE'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_nobre'&&$_POST[cliente]=='87<>NOBRE'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 87 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias NOBRE <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=87&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=87&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--NOBRE-->


<!--COMCARGA-->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_comcarga'&&$_POST[cliente]=='88<>COMCARGA'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_comcarga'&&$_POST[cliente]=='88<>COMCARGA'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 88 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias COMCARGA <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=88&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=88&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--COMCARGA-->





<!--APROCAM-->





<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_aprocam'&&$_POST[cliente]=='89<>APROCAM'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_aprocam'&&$_POST[cliente]=='89<>APROCAM'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 89 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias APROCAM <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=89&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=89&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>


<!--APROCAM-->




<!--CAIXA SEGURADORA-->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA_caixa'&&$_POST[cliente]=='44<>CAIXA SEGURADORA'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS_caixa'&&$_POST[cliente]=='44<>CAIXA SEGURADORA'
)
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 44 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias Caixa <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=44&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=44&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
}
?>

<!--FIM RELAT�RIO - CAIXA SEGURADORA -->

<!-- BB SEGUROS -->

<? 
if(
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTVISTORIA'&&$_POST[cliente]=='38<>BB SEGUROS'||
$_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='DTTRANS'&&$_POST[cliente]=='38<>BB SEGUROS'
)
{/*
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

//pegando se � data de transmiss�o ou vistoria
$array_dados_filtro = split("_",$_POST['tipo_relatorio']);


$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
	SEGURADORA = 38 AND ".$array_dados_filtro[0]."  >=".$data_inicial." AND ".$array_dados_filtro[0]." <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">KM rodado + vistorias realizadas por 
	<? 
	if($array_dados_filtro[0]=="DTVISTORIA")
	{
	echo "Data de Vistoria";
	}
	else
	{
	echo "Data de Transmiss�o";
	}?>
    </div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Quantidade de vistorias BB Seguros <? echo mysql_num_rows($result_fatcom);?></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><table width="50%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=38&&sel=km&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Rateio de KM</a></td>
        <td class="style18"><a href="relatorio_rateio_km.php?rot=<? echo $_SESSION[roteirizador]."&&filtro=".$array_dados_filtro[0]."&&seg=38&&sel=vr&&data_inicial=".$data_inicial."&&data_final=".$data_final."&&ordem=".$_POST[por]."&&ordernar=".$_POST[ordernar]."";?>" target="_blank" >&nbsp;Baixar arquivo de Vistorias realizadas</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'"></td>
  </tr>
</table>
<?
*/}
?>

<!--FIM RELAT�RIO - BB SEGUROS -->

<!-- HDI -->


<? 
if($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='TXT_hdi'&&$_POST[cliente]=='55<>HDI')
{
$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};

$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '55'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);

$sql_fatcom = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE SEGURADORA = 55 AND DTTRANS >=".$data_inicial." AND DTTRANS <=".$data_final." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." desc";
$result_fatcom = mysql_query($sql_fatcom,$db);
	if (mysql_num_rows($result_fatcom)>0)
	{
		while ($reg= mysql_fetch_array($result_fatcom))
		{
			
	// verifica SE N�O TEM parceiro
	$sqlSol = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$reg['NUMEROSOLICITACAO']." AND roteirizador = ".$_SESSION['roteirizador'];
	$result_sqlSol = @mysql_query($sqlSol,$db);
	$solicitacao = @mysql_fetch_array($result_sqlSol);
	
	/*if($_SESSION['id']==1){
		echo $sql_fatcom ;     
		echo "<br>".$sqlSol;
		exit();
		}*/
	
	if($solicitacao['clienteOrigem']==''){			
		
	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	$sql_extra = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$reg[NUMEROSOLICITACAO].""; 
	$result_extra = mysql_query($sql_extra,$db);
	$extra = mysql_fetch_array($result_extra);

	$sql_COR = "SELECT corretor FROM corretor_hdi WHERE susep = ".$reg['CDCORRETORSUSEP'].""; 
	$result_COR = mysql_query($sql_COR,$db);
	$cor = mysql_fetch_array($result_COR);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$reg[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	$CDFILIAL = str_pad($prestador_filial[codigo_filial], 4, "0", STR_PAD_LEFT);
	$UF = trim($prestador_filial[uf]);
	
	//selecionando a filial para pegar a regiao correta
$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial[id]." AND seguradora = '55' AND roteirizador = ".$reg[roteirizador]."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	$PRECOVISTORIA = str_replace(".",",",$resultadoPreco[preco_vistoria]);
	$MES = str_pad($data_inicial1{2}.$data_inicial1{3}, 2, "0", STR_PAD_LEFT);
	$NRVISTORIA = str_pad($reg["NRVISTORIA"], 10, "000000", STR_PAD_LEFT);
	$DTVISTORIA = $reg["DTVISTORIA"]{6}.$reg["DTVISTORIA"]{7}.$reg["DTVISTORIA"]{4}.$reg["DTVISTORIA"]{5}.$reg["DTVISTORIA"]{0}.$reg["DTVISTORIA"]{1}.$reg["DTVISTORIA"]{2}.$reg["DTVISTORIA"]{3};
	$DTPROC = $reg["DTPROC"]{6}.$reg["DTPROC"]{7}.$reg["DTPROC"]{4}.$reg["DTPROC"]{5}.$reg["DTPROC"]{0}.$reg["DTPROC"]{1}.$reg["DTPROC"]{2}.$reg["DTPROC"]{3};
	$DTTRANS = $reg["DTTRANS"]{6}.$reg["DTTRANS"]{7}.$reg["DTTRANS"]{4}.$reg["DTTRANS"]{5}.$reg["DTTRANS"]{0}.$reg["DTTRANS"]{1}.$reg["DTTRANS"]{2}.$reg["DTTRANS"]{3};

	$NMPROPONENTE = str_pad(substr($reg["NMPROPONENTE"], 0, 40), 40);
	$chassi1 = str_replace(".","",$reg["NRCHASSI"]);
	$chassi = str_replace("|","",$chassi1);
	$NRCHASSI =  str_pad($chassi, 22 );
	$DSMUNICIPIOVISTORIA = str_pad(substr($reg["DSMUNICIPIOVISTORIA"], 0, 20), 20 );
	$CEPVISTORIA = str_pad($reg["CEPVISTORIA"], 8 );
	$CDCORRETORSUSEP = str_pad($reg["CDCORRETORSUSEP"], 14 );
	$NRPLACA = str_pad($reg["NRPLACA"], 7, "0", STR_PAD_LEFT);
	$NMCORRETOR = strtr($cor['corretor'], "���������������������������������������������������������������������", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
	//PREPARA O CONTE�DO A SER GRAVADO  
	$conteudo.= "".strtoupper($NRPLACA).";".$chassi.";".$reg['NRVISTORIA'].";".str_replace("-","",trim($extra['proposta'])).";".trim($NMCORRETOR).";".trim($NMPROPONENTE).";".$DTVISTORIA.";".$PRECOVISTORIA."\r\n";
	//ARQUIVO TXT
	
	$valor = intval(str_replace(",","",$PRECOVISTORIA));
	$valor_soma = $valor_soma+$valor;
	
		}// FIM VERIFICA PARCEIRO
		
		}
	
	@mkdir ("fatcom_hdi/".$reg['roteirizador'], 0777);
	$arquivo = "fatcom_hdi/".$reg['roteirizador']."/FATCOM_HDI_".date("Ymd")."_".date("Hi").".txt";
	
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $conteudo)) {}
	
	}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" style="background-color:#000; color:#FFF"><div align="center" class="style16">Fatcom HDI</div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18">&nbsp;Informa&ccedil;&atilde;o</td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" class="style18"><div align="center"><a href="<? echo $arquivo;?>">Baixar FATCOM HDI</a></div></td>
  </tr>
  <tr>
    <td height="24"  class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio.php'">
    &nbsp;Valor total = <? echo intval($valor_soma);?></td>
  </tr>
</table>
<?
	
	//FECHA O ARQUIVO 
	fclose($abrir);
?>
<?
}
?>


<!--FIM RELAT�RIO - HDI -->

<!-- MONTANDO O ARQUIVO (XLS) DOS RELAT�RIO -->



<?
if( ( ($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTVISTORIA') ) || (($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTTRANS') ) || ( ($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTVISTORIA_CONSORCIOBRADESCO') )  || ( ($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTTRANS_CONSORCIOBRADESCO') ) || ( ($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTVISTORIA_SEGUROS') ) || ( ($_GET[visualiza] == "ok") && ($_POST[tipo_relatorio] == 'DTTRANS_SEGUROS') ))
{
	//header('Content-type: application/msexcel');
	header('Content-type: application/vnd.ms-excel');
	if($_POST[tipo_relatorio]=='DTTRANS')
	{
	//$nome_relatorio = "trans_";
	$nome_relatorio = "DATA_TRANSMISSAO";
	$cabecalho = "Data de Transmiss�o ".$_POST[DATA_INICIAL]." a ".$_POST[DATA_FINAL];
	}
	else
	{
	//$nome_relatorio = "vist_";
	$nome_relatorio = "DATA_VISTORIA";
	$cabecalho = "Data da Vistoria ".$_POST[DATA_INICIAL]." a ".$_POST[DATA_FINAL];
	}
	$data_inicial = $_POST[DATA_INICIAL]{6}.$_POST[DATA_INICIAL]{7}.$_POST[DATA_INICIAL]{8}.$_POST[DATA_INICIAL]{9}.$_POST[DATA_INICIAL]{3}.$_POST[DATA_INICIAL]{4}.$_POST[DATA_INICIAL]{0}.$_POST[DATA_INICIAL]{1};

	$data_final = $_POST[DATA_FINAL]{6}.$_POST[DATA_FINAL]{7}.$_POST[DATA_FINAL]{8}.$_POST[DATA_FINAL]{9}.$_POST[DATA_FINAL]{3}.$_POST[DATA_FINAL]{4}.$_POST[DATA_FINAL]{0}.$_POST[DATA_FINAL]{1};

  $cliente = explode("<>",$_POST[cliente]);
  
  switch ($cliente[0]){
	  case 0 : $seguradora_cliente = "Bradesco Seguros"; break;
	  case 310 : $seguradora_cliente = "MASTTERCAR"; break;
	  case 311 : $seguradora_cliente = "MEGA"; break;
	  case 312 : $seguradora_cliente = "FACILITY"; break;
	  case 313 : $seguradora_cliente = "PREVICARRIO"; break;
	  case 314 : $seguradora_cliente = "UNIPROPAS"; break;
	  case 20 : $seguradora_cliente = "BONE"; break;
	  case 21 : $seguradora_cliente = "MULTCAR"; break;
	  case 22 : $seguradora_cliente = "RODOTRUCK"; break;
	  case 23 : $seguradora_cliente = "ACE SEGURADORA"; break;
	  case 24 : $seguradora_cliente = "VERTICE"; break;
	  case 25 : $seguradora_cliente = "TRUST"; break;
	  case 320 : $seguradora_cliente = "ASPEM"; break;
	  case 31 : $seguradora_cliente = "Associa&ccedil;&atilde;o Bureau de Benef&iacute;cios"; break;
	  case 32 : $seguradora_cliente = "ASSUTRAN"; break;
	  case 33 : $seguradora_cliente = "AVANT"; break;
	  case 35 : $seguradora_cliente = "ASSIST"; break;
	  case 37 : $seguradora_cliente = "MAPFRE WARRANTY"; break;
	  case 38 : $seguradora_cliente = "BB SEGUROS"; break;
	  case 39 : $seguradora_cliente = "ZURICH"; break;
	  case 44 : $seguradora_cliente = "Caixa Seguradora"; break;
	  case 53 : $seguradora_cliente = "Generali Seguros"; break;
	  case 55 : $seguradora_cliente = "HDI Seguros"; break;
	  case 59 : $seguradora_cliente = "LIBERTY"; break;
	  case 60 : $seguradora_cliente = "Mapfre Seguros"; break;
	  case 61 : $seguradora_cliente = "MARITIMA"; break;
	  case 67 : $seguradora_cliente = "SulAmerica Seguros"; break;
	  case 69 : $seguradora_cliente = "Tokio Marine"; break;
	  case 72 : $seguradora_cliente = "YASUDA SEGUROS"; break;
	  case 73 : $seguradora_cliente = "Allianz Seguros"; break;
	  case 83 : $seguradora_cliente = "Mitsui Seguros"; break;
	  case 87 : $seguradora_cliente = "Nobre Seguros"; break;
	  case 200 : $seguradora_cliente = "HAWK"; break;
	  case 201 : $seguradora_cliente = "ENGER"; break;
	  case 202 : $seguradora_cliente = "NORDESTE"; break;
	  case 203 : $seguradora_cliente = "GETEK"; break;
	  case 204 : $seguradora_cliente = "TUV VISTORIAS"; break;
	  case 205 : $seguradora_cliente = "SINTESE SEGUROS"; break;
	  case 321 : $seguradora_cliente = "ASPROL"; break;
	  case 322 : $seguradora_cliente = "G&G SOLUCOES"; break;
	  case 323 : $seguradora_cliente = "CONSORCIO"; break;
	  case 324 : $seguradora_cliente = "AUTO TRUCK"; break;
	  case 325 : $seguradora_cliente = "ABV"; break;
	  case 326 : $seguradora_cliente = "QV SERVICOS"; break;
	  case 327 : $seguradora_cliente = "PROTECT 24HS"; break;
	  case 328 : $seguradora_cliente = "FINANCEIRA"; break;
	  case 329 : $seguradora_cliente = "SANCOR"; break;
	  case 330 : $seguradora_cliente = "ASTRO"; break;
	  case 331 : $seguradora_cliente = "ASTRAMAR"; break;
	  case 332 : $seguradora_cliente = "APROVESC"; break;
	  case 333 : $seguradora_cliente = "UNIBEM"; break;
	  case 334 : $seguradora_cliente = "COOPERTRUCK"; break;
	  case 335 : $seguradora_cliente = "PROAUTO"; break;
	  case 336 : $seguradora_cliente = "PERFECT"; break;
	  case 337 : $seguradora_cliente = "MELHOR"; break;
	  case 338 : $seguradora_cliente = "AMV BRASIL"; break;   
	  case 339 : $seguradora_cliente = "MELHOR PESADOS"; break;
	  case 340 : $seguradora_cliente = "ALICERCE"; break;
	  case 341 : $seguradora_cliente = "AVANTI"; break;
	  case 342 : $seguradora_cliente = "TOPPREV"; break;
	  case 343 : $seguradora_cliente = "AGUARDA"; break;
	  case 344 : $seguradora_cliente = "NACIONAL TRUCK"; break;
		case 345 : $seguradora_cliente = "EXPRESSO TRUCK"; break;
		case 346 : $seguradora_cliente = "BRASMIG"; break;
		case 347 : $seguradora_cliente = "ASTRANS"; break;
		case 348 : $seguradora_cliente = "APVS"; break;
		case 349 : $seguradora_cliente = "ASCAMP"; break;
		case 350 : $seguradora_cliente = "CLUBE FONFON"; break;
		case 351 : $seguradora_cliente = "BR TRUCK"; break;
		case 353 : $seguradora_cliente = "UNIVERSO ASSISTENCIA"; break;
		case 354 : $seguradora_cliente = "MAXIMA"; break;
		case 355 : $seguradora_cliente = "FOCUS"; break;
		case 356 : $seguradora_cliente = "LOTUS"; break;
		case 357 : $seguradora_cliente = "ALLIANCE APV"; break;
		case 358 : $seguradora_cliente = "VISTRIM"; break;
		case 359 : $seguradora_cliente = "AGV BRASIL"; break;
		case 360 : $seguradora_cliente = "ALIAN�A TRUCK CAR"; break;
		case 361 : $seguradora_cliente = "EUROCAR"; break;
		case 362 : $seguradora_cliente = "AMPLA"; break;
		case 363 : $seguradora_cliente = "ASCOBOM"; break;
		case 364 : $seguradora_cliente = "ASPROAUTO"; break;
		case 365 : $seguradora_cliente = "CAMBRALIA"; break;
		case 366 : $seguradora_cliente = "COPOM"; break;
		case 367 : $seguradora_cliente = "ASSOCIACAO DE AJUDA MUTUA A3"; break;
		case 368 : $seguradora_cliente = "MEGA BENEFICIOS"; break;
		case 369 : $seguradora_cliente = "UNIAUTO PROTECAO"; break;
		case 370 : $seguradora_cliente = "AUTO CARROS"; break;
		case 371 : $seguradora_cliente = "AUTOMINAS"; break;
		case 372 : $seguradora_cliente = "AVAP"; break;
		case 373 : $seguradora_cliente = "BRASIL COOPERATIVA"; break;
		case 374 : $seguradora_cliente = "CARVISA"; break;
		case 375 : $seguradora_cliente = "CENTRO SOCIAL CABOS SOLDADOS"; break;
		case 376 : $seguradora_cliente = "APVS ESPIRITO SANTO"; break;
		case 377 : $seguradora_cliente = "COOPEV"; break;
		case 378 : $seguradora_cliente = "COPA 190"; break;
		case 379 : $seguradora_cliente = "EFICAZ"; break;
		case 380 : $seguradora_cliente = "FACIL CLUBE DE BENEFICIOS"; break;
		case 381 : $seguradora_cliente = "GARANT CLUBE DE BENEFICIOS MUTUOS"; break;
		case 382 : $seguradora_cliente = "GENESIS BENEFICIOS"; break;
		case 383 : $seguradora_cliente = "LIDERANCA CLUBE DE ASSISTENCIA"; break;
		case 384 : $seguradora_cliente = "UNIPROV - ESPIRITO SANTO"; break;
		case 385 : $seguradora_cliente = "UNIPROV - RONDONIA"; break;
		case 386 : $seguradora_cliente = "MASTER CLUBE DE ASSISTENCIA VEICULAR"; break;
		case 387 : $seguradora_cliente = "MASTER TRUCK"; break;
		case 388 : $seguradora_cliente = "PLANCAR PRIME PROTECAO VEICULAR"; break;
		case 389 : $seguradora_cliente = "PRIME PROTECAO VEICULAR"; break;
		case 390 : $seguradora_cliente = "PROTEMINAS"; break;
		case 391 : $seguradora_cliente = "REDE CARS CLUBE DE BENEFICIOS"; break;
		case 392 : $seguradora_cliente = "SAVE-CAR"; break;
		case 393 : $seguradora_cliente = "UNIBRAS ASSOCIACAO DE AUTO PROTECAO"; break;
		case 394 : $seguradora_cliente = "UNIVERSO CLUBE DE ASSISTENCIA"; break;
		case 395 : $seguradora_cliente = "VISTOP SERVICOS TECNICOS"; break;
		case 396 : $seguradora_cliente = "EMBRACON"; break;
		case 397 : $seguradora_cliente = "NET CAR CLUBE"; break;
		case 398 : $seguradora_cliente = "MOTOCAR CLUBE"; break;
		case 399 : $seguradora_cliente = "EXCELENCIA"; break;
		case 400 : $seguradora_cliente = "APVS VISTA ALEGRE"; break;
		case 401 : $seguradora_cliente = "CAUTELAR"; break;
		case 402 : $seguradora_cliente = "EXCLUSIVE"; break;
		case 403 : $seguradora_cliente = "TRADICAO"; break;
		case 404 : $seguradora_cliente = "DIAMOND MOTORS"; break;
		case 405 : $seguradora_cliente = "CHERY MOTORS"; break;
		case 406 : $seguradora_cliente = "AVEP"; break;
		case 407 : $seguradora_cliente = "VIVA CONSORCIOS"; break;
		case 408 : $seguradora_cliente = "AUTOVALORE"; break;
		case 409 : $seguradora_cliente = "GFCAR"; break;
		case 410 : $seguradora_cliente = "PREVINE"; break;
		case 411 : $seguradora_cliente = "CLUBE SERVICE"; break;
		case 412 : $seguradora_cliente = "UNIBRA"; break;
		case 413 : $seguradora_cliente = "SOMA TRACK"; break;
		case 100 : $seguradora_cliente = "USEBENS"; break;
		case 101 : $seguradora_cliente = "QBE"; break;
		case 102 : $seguradora_cliente = "POINTER"; break;
		case 103 : $seguradora_cliente = "CIELO"; break;
		case 414 : $seguradora_cliente = "TIRADENTES"; break;
		case 415 : $seguradora_cliente = "PARTICULAR"; break;
		case 416 : $seguradora_cliente = "SOLTEL"; break;
		case 417 : $seguradora_cliente = "TOP CAR"; break;
		case 418 : $seguradora_cliente = "PROTEGIDO"; break;
		case 419 : $seguradora_cliente = "ULTRA BRASIL"; break;
		case 420 : $seguradora_cliente = "UNION SOLUTIONS"; break;
		case 421 : $seguradora_cliente = "MASTER CLUBE UBERLANDIA"; break;
		case 422 : $seguradora_cliente = "MUNDIAL"; break;
		case 423 : $seguradora_cliente = "SIMPLIFICAR"; break;
		case 424 : $seguradora_cliente = "CLEAN"; break;
		case 425 : $seguradora_cliente = "ALLIDER"; break;
		case 426 : $seguradora_cliente = "APROTEVE"; break;
		case 427 : $seguradora_cliente = "E-NOVATE"; break;
		case 428 : $seguradora_cliente = "ASTRACO"; break;
		case 429 : $seguradora_cliente = "ROTA"; break;
		case 430 : $seguradora_cliente = "ULTRA"; break;
		case 431 : $seguradora_cliente = "UNICOON PARANA"; break;
		case 432 : $seguradora_cliente = "PROTEAUTO"; break;
		case 433 : $seguradora_cliente = "APVS SUDESTE"; break;
		case 434 : $seguradora_cliente = "CLUBE UNIR"; break;
		case 435 : $seguradora_cliente = "APM"; break;
		case 436 : $seguradora_cliente = "MASTER-CONSULTOR"; break;
		case 437 : $seguradora_cliente = "HM PROTECAO"; break;
		case 438 : $seguradora_cliente = "CLUBCAR"; break;
		case 439 : $seguradora_cliente = "AZUL CLUBE"; break;
		case 440 : $seguradora_cliente = "GOL PLUS BRASIL"; break;
		case 441 : $seguradora_cliente = "ESTILO PROTECAO"; break;
		case 442 : $seguradora_cliente = "PHP PROTECAO"; break;
		case 443 : $seguradora_cliente = "ACERTT"; break;
		case 444 : $seguradora_cliente = "APVA"; break;
		case 445 : $seguradora_cliente = "ASTRAC"; break;
		case 446 : $seguradora_cliente = "SEGURYCAR"; break;  
		case 447 : $seguradora_cliente = "VITALLYS BRASIL"; break;
		case 448 : $seguradora_cliente = "BRASIL CAR"; break; 
		case 449 : $seguradora_cliente = "UNIDAS"; break;
		case 450 : $seguradora_cliente = "ELLO"; break; 
		case 451 : $seguradora_cliente = "UNICOON CONTAGEM"; break;
		case 452 : $seguradora_cliente = "FOCAR BRASIL"; break;
		case 453 : $seguradora_cliente = "PLACAR VEICULAR"; break; 
		case 454 : $seguradora_cliente = "PROTECAR"; break;
		case 455 : $seguradora_cliente = "UCA MELHOR"; break;
		case 456 : $seguradora_cliente = "PROTEAUTO MARINGA"; break;
		case 457 : $seguradora_cliente = "AUTO VIP"; break;
		case 458 : $seguradora_cliente = "PRONTOCAR"; break;
		case 459 : $seguradora_cliente = "PENSAR CLUBE"; break;
		case 460 : $seguradora_cliente = "AUTO BAHIA"; break;
		case 461 : $seguradora_cliente = "MAXIMUS BRASIL"; break;
		case 462 : $seguradora_cliente = "PROTECT"; break;
	  default: break;
	  }
  
  if($cliente[0]==60||$cliente[0]==44||$cliente[0]==38)
{
		
	  $mapfre_frustrada = "";
	  if($cliente[0]==60){
		$mapfre_frustrada = " AND ve.avaliacao != '04' ";  
	  }

	$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 vp , ".$bancoDados.".vistoria_extra ve WHERE  vp.NUMEROSOLICITACAO = ve.solicitacao AND 
    vp.".$_POST[tipo_relatorio].">= ".$data_inicial." AND vp.".$_POST[tipo_relatorio]."<= ".$data_final." AND vp.SEGURADORA = ".$cliente[0]." AND vp.roteirizador = ".$_SESSION[roteirizador]."".$mapfre_frustrada."
    order by ".$_POST[ordernar]." ".$_POST[por]."";
  }
  else if($cliente[0]==67)
  {
	  $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_POST[tipo_relatorio].">= ".$data_inicial." AND ".$_POST[tipo_relatorio]."<= ".$data_final." AND SEGURADORA = ".$cliente[0]." AND roteirizador = ".$_SESSION[roteirizador]." AND status_trans='4####' order by ".$_POST[ordernar]." ".$_POST[por]."";
	  }
	  else if($cliente[0]==0)
  		{
			
			if ( $_POST[tipo_relatorio]=='DTVISTORIA_SEGUROS'|| $_POST[tipo_relatorio]=='DTTRANS_SEGUROS' ){
				$tipo_relatorio=split("_",$_POST[tipo_relatorio]);
	 $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$tipo_relatorio[0].">= ".$data_inicial." AND ".$tipo_relatorio[0]."<= ".$data_final." AND SEGURADORA = ".$cliente[0]." AND roteirizador = ".$_SESSION[roteirizador]." AND CDFINALIDADE NOT IN ('08', '09') order by ".$_POST[ordernar]." ".$_POST[por]."";
			     }else{//CONSORCIO BRADESCO
					 $tipo_relatorio=split("_",$_POST[tipo_relatorio]);
					  $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$tipo_relatorio[0].">= ".$data_inicial." AND ".$tipo_relatorio[0]."<= ".$data_final." AND SEGURADORA = ".$cliente[0]." AND roteirizador = ".$_SESSION[roteirizador]." AND CDFINALIDADE IN ('08', '09') order by ".$_POST[ordernar]." ".$_POST[por]."";
					 }
	  		}elseif($cliente[0]==62){
				if($_POST['empresaAgredada']!=''){
					
					if($_POST['empresaAgredada']=='1'){
						$sql_vistoria = "SELECT vp.* FROM ".$bancoDados.".vistoria_previa1 vp,".$bancoDados.".solicitacao s WHERE s.id=vp.NUMEROSOLICITACAO AND s.CDCIA NOT IN ('35','40','84') AND
    vp.".$_POST['tipo_relatorio'].">= ".$data_inicial." AND vp.".$_POST['tipo_relatorio']."<= ".$data_final." AND vp.SEGURADORA = ".$cliente[0]." AND vp.roteirizador = ".$_SESSION['roteirizador']." ORDER BY vp.".$_POST['ordernar']." ".$_POST['por']."";
						}else{// DEMAIS
							$sql_vistoria = "SELECT vp.* FROM ".$bancoDados.".vistoria_previa1 vp,".$bancoDados.".solicitacao s WHERE s.id=vp.NUMEROSOLICITACAO AND s.CDCIA='".$_POST['empresaAgredada']."' AND
    vp.".$_POST['tipo_relatorio'].">= ".$data_inicial." AND vp.".$_POST['tipo_relatorio']."<= ".$data_final." AND vp.SEGURADORA = ".$cliente[0]." AND vp.roteirizador = ".$_SESSION['roteirizador']." ORDER BY vp.".$_POST['ordernar']." ".$_POST['por']."";
							}

					}else{
						$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_POST[tipo_relatorio].">= ".$data_inicial." AND ".$_POST[tipo_relatorio]."<= ".$data_final." AND SEGURADORA = ".$cliente[0]." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." ".$_POST[por]."";
						}

				}
				else{
				$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
		".$_POST[tipo_relatorio].">= ".$data_inicial." AND ".$_POST[tipo_relatorio]."<= ".$data_final." AND SEGURADORA = ".$cliente[0]." AND roteirizador = ".$_SESSION[roteirizador]." order by ".$_POST[ordernar]." ".$_POST[por]."";
	  
	  }  
    
    $result_vistoria = mysql_query($sql_vistoria,$db);
	
	switch ($_SESSION[roteirizador]){
	case 0 : $prestadora = "BS2 CONSULTORIA"; break;
	case 20 : $prestadora = "ACONFERIR"; break;
	case 60 : $prestadora = "EXCEL VISTORIAS"; break;
	case 70 : $prestadora = "JEF VISTORIAS"; break;
	case 75 : $prestadora = "VISION VISTORIAS"; break;
	case 80 : $prestadora = "OK VISTORIAS"; break;
	case 90 : $prestadora = "REALIZA VISTORIAS"; break;
	case 100 : $prestadora = "VISTSERVICE VISTORIAS"; break;
	case 110 : $prestadora = "PREVICAR VISTORIAS"; break;
	case 140 : $prestadora = "ETH VISTORIAS"; break;
	case 150 : $prestadora = "CENTRAL VISTORIAS"; break;
	case 160 : $prestadora = "MINAS ROTA VISTORIAS"; break;
	case 170 : $prestadora = "BRAGA VISTORIAS"; break;
	case 180 : $prestadora = "VIP VISTORIAS"; break;
	case 190 : $prestadora = "BR ATTLAS VISTORIAS"; break;
	case 200 : $prestadora = "QUINT�O VISTORIAS"; break;
	case 210 : $prestadora = "ALPHA VISTORIAS"; break;
	case 220 : $prestadora = "BBC VISTORIAS"; break;
	case 230 : $prestadora = "VISTRIM VISTORIAS"; break;
	case 240 : $prestadora = "VISTPREV VISTORIAS"; break;
	case 250 : $prestadora = "GWB VISTORIAS"; break;
	case 260 : $prestadora = "JORNADA VISTORIAS"; break;
	case 270 : $prestadora = "POINTER DO BRASIL"; break;
	case 280 : $prestadora = "VISTOVERDE VISTORIAS"; break;
	case 290 : $prestadora = "BETA VISTORIAS"; break;
	case 300 : $prestadora = "AGILLE VISTORIAS"; break;
	case 627 : $prestadora = "3� VIA WEB"; break;
	case 1786 : $prestadora = "STYLLUS VISTORIAS"; break;
	case 123 : $prestadora = "AMBIENTE DE TESTE"; break;
	default: break;
	}
	
					switch($_POST['empresaAgredada']){
						case '1': $nomeAgredada='PORTO SEGURO'; break;
						case '35': $nomeAgredada='AZUL SEGUROS'; break;
						case '40': $nomeAgredada='PORTO FINANCIAMENTOS'; break;
						case '84': $nomeAgredada='ITAU SEGUROS'; break;
						default: $nomeAgredada='GERAL'; break;
						}
	
	if($cliente[0]==62){
		$seguradora_cliente= "PORTO SEGURO -> ".$nomeAgredada;
		}
	
	
$dtNomeIni=substr($data_inicial,6,2)."-".substr($data_inicial,4,2)."-".substr($data_inicial,0,4);	
$dtNomeFim=substr($data_final,6,2)."-".substr($data_final,4,2)."-".substr($data_final,0,4);
	//header('Content-Disposition: attachment; filename="relatorio_'.$_SESSION[roteirizador].'_'.$nome_relatorio.'_'.$data_inicial.'_'.$data_final.'_proc'.date(Ymd).'.xls"');
	header('Content-Disposition: attachment; filename="'.strtoupper($seguradora_cliente).'['.$prestadora.']'.$nome_relatorio.'('.$dtNomeIni.'_a_'.$dtNomeFim.')_gerado'.date('d').'-'.date('m').'-'.date('Y').'.xls"');
	
	

// DADOS DO EXCEL
if($cliente[0]=='0'||$cliente[0]=='61'||$cliente[0]=='25'){ // bradesco e maritima e trust
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
  	<td height='23' colspan='20' align='middle' valign='center'><font style='font-size: 16px; color:#00C; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>" .$prestadora. "</td>
  </tr>
  <tr>
  	<td height='23' colspan='20' align='middle' valign='center'><font style='font-size: 14px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>". $seguradora_cliente ."</td>
  </tr>
  <tr> 
    <td height='23' colspan='20' bgcolor='#D2D2D2' align='middle' valign='center'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>ITEM</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� VISTORIA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� SOLICITA��O</font></td>
	 <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FINALIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VE�CULO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CHASSI</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PLACA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA DIGITA��O</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA TRANSMISS�O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PRAZO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PROPONENTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FILIAL</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>UF</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VISTORIADOR</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CORRETOR</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>LOCAL VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR VISTORIA</font></td>
  	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>KM</font></td>
  </tr>
  ";
}  // fim bradesco e maritima e trust
elseif($cliente[0]=='83'){ // MITSUI 
	 // outras seguradoras
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
  	<td height='23' colspan='23' align='middle' valign='center'><font style='font-size: 16px; color:#00C; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>" .$prestadora. "</td>
  </tr>
  <tr>
  	<td height='23' colspan='23' align='middle' valign='center'><font style='font-size: 14px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>". $seguradora_cliente ."</td>
  </tr>         
  <tr>
    <td height='23' colspan='23' bgcolor='#D2D2D2' align='middle' valign='center'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>ITEM</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� VISTORIA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� SOLICITA��O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VE�CULO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CHASSI</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PLACA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>SOLICITANTE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>E-MAIL DO SOLICITANTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA DIGITA��O</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA TRANSMISS�O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PRAZO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PROPONENTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FILIAL</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>UF</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VISTORIADOR</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CORRETOR</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>LOCAL VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR VISTORIA</font></td>
  	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>KM</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PARECER</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>MOTIVO DA RECUSA</font></td>
  </tr>
  ";
	
	}
	elseif($_SESSION['roteirizador']==200){ // QUINT�O VISTORIAS
	 // outras seguradoras
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
  	<td height='23' colspan='21' align='middle' valign='center'><font style='font-size: 16px; color:#00C; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>" .$prestadora. "</td>
  </tr>
  <tr>
  	<td height='23' colspan='21' align='middle' valign='center'><font style='font-size: 14px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>". $seguradora_cliente ."</td>
  </tr>
  <tr>
    <td height='23' colspan='21' bgcolor='#D2D2D2' align='middle' valign='center'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>ITEM</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� VISTORIA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� SOLICITA��O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VE�CULO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CHASSI</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PLACA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>SOLICITANTE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>E-MAIL DO SOLICITANTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA DIGITA��O</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA TRANSMISS�O</font></td>   
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PRAZO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PROPONENTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FILIAL</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>UF</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VISTORIADOR</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>TIPO VISTORIADOR</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>LOCAL VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR VISTORIA</font></td>
  	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR KM</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PARECER</font></td>
  </tr>
  ";
	}
	elseif($cliente[0]=='202'){// NORDESTE (INPE��ES RISCO) 
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
  	<td height='23' colspan='19' align='middle' valign='center'><font style='font-size: 16px; color:#00C; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>" .$prestadora. "</td>
  </tr>
  <tr>
  	<td height='23' colspan='19' align='middle' valign='center'><font style='font-size: 14px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>". $seguradora_cliente ."</td>
  </tr>
  <tr>
    <td height='23' colspan='19' bgcolor='#D2D2D2' align='middle' valign='center'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>ITEM</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� VISTORIA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� SOLICITA��O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VE�CULO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>SEGURADORA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PLACA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA AGENDAMENTO</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA DIGITA��O</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA TRANSMISS�O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PRAZO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PROPONENTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FILIAL</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>UF</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VISTORIADOR</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CORRETOR</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>LOCAL VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR VISTORIA</font></td>
  	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>KM</font></td>
  </tr>
  ";
	
		}
else{ // outras seguradoras

	if( ($_SESSION['roteirizador']==123||$_SESSION['roteirizador']==70) && ($cliente[0]=='60' || $cliente[0]=='38')){
		$colunaGold="<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>GOLD</font></td>";
		}else{
			$colunaGold="";
			}

	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
  	<td height='23' colspan='22' align='middle' valign='center'><font style='font-size: 16px; color:#00C; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>" .$prestadora. "</td>
  </tr>
  <tr>
  	<td height='23' colspan='22' align='middle' valign='center'><font style='font-size: 14px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>". $seguradora_cliente ."</td>
  </tr>
  <tr>
    <td height='23' colspan='22' bgcolor='#D2D2D2' align='middle' valign='center'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>                    
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>ITEM</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� VISTORIA</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N� SOLICITA��O</font></td>
	".$colunaGold."
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VE�CULO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CHASSI</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PLACA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>SOLICITANTE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>E-MAIL DO SOLICITANTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA DIGITA��O</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>DATA TRANSMISS�O</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PRAZO</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>PROPONENTE</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>FILIAL</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CIDADE</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>UF</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VISTORIADOR</font></td>
    <td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CORRETOR</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>LOCAL VISTORIA</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>POSTO FIXO</font></td>
	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>VALOR VISTORIA</font></td>
  	<td align='center' bgcolor='#FFFF00'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>KM</font></td>
  </tr>
  ";
	}
   
	if (mysql_num_rows($result_vistoria)>0)
	{ 
	 //while ($vistoria = mysql_fetch_array($result_vistoria))
	 $contador=1;
for($i = 1; $vistoria = mysql_fetch_array($result_vistoria); $i++)
	{
		
	
	$solicitacao_result = mysql_query("SELECT corretor, proposta, cidade, roteirizador, agendamento, numero_inspecao, motivo, apolice, estado, nome_agencia, data_auto,clienteOrigem,possuiValorKM,valorKM,justificativaValorKM,numero_laudo_informado,nome_s,email,digito_controle_cdc FROM ".$bancoDados.".solicitacao WHERE id = " . $vistoria['NUMEROSOLICITACAO'], $db);
    $solicitacao = mysql_fetch_assoc($solicitacao_result);
	

	// verifica SE N�O TEM parceiro
	if($solicitacao['clienteOrigem']==''){
	
	
	$extra_result = mysql_query("SELECT proposta, voucher, KM_rodado,avaliacao FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = " . $vistoria['NUMEROSOLICITACAO'], $db);
    $extra = mysql_fetch_assoc($extra_result);
	
	if($cliente[0]=='83'){
		switch($extra['avaliacao']){
			case 1: $PARECER='ACEITAVEL'; $MOTIVO_RECUSA=''; break;
			case 2: $PARECER='RECUSAVEL'; $MOTIVO_RECUSA=$vistoria['OBSERVACOES']; break;
			default:break;
			}
		
	}
	
	if($_SESSION['roteirizador']=='200'){
		switch($extra['avaliacao']){
			case '01': $PARECER='ACEITAVEL'; break;
			case '02': $PARECER='SUJEITO A ANALISE'; break;
			case '03': $PARECER='REJEITADO'; break;
			default:break;
			}
		
	}
	
	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$vistoria[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$vistoria[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	

	if($cliente[0]=='0' || $cliente[0]=='39' || $cliente[0]=='83'){
		
		if($prestador_filial['id']==''){
			$prestador_filial['id']='1';
			}
	$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial['id']." AND seguradora = '".$cliente[0]."' AND roteirizador = ".$vistoria['roteirizador']."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	$preco_volante = $resultadoPreco[preco_vistoria];
	$preco_posto = $resultadoPreco[preco_vistoria_posto];
	
		}else{
		$preco_result = mysql_query("SELECT DISTINCT preco_vistoria FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE seguradora = ".$cliente[0]." AND roteirizador = ".$vistoria['roteirizador'], $db);
    	$resultadoPreco = mysql_fetch_assoc($preco_result);
		$preco=$resultadoPreco['preco_vistoria'];
			}    
			
$modelo=explode("<",$vistoria['NMVEICULO']);

$POSTOFIXO="";
if($vistoria["TPVISTORIA"]=='P'||$vistoria["TPVISTORIA"]=='F'){
	$TPVISTORIA = "POSTO";
	
	$sql_posto = "SELECT nome_posto FROM ".$bancoDados.".contro_vp_posto WHERE cep='".$vistoria['CEPVISTORIA']."'"; 
	$result_posto = mysql_query($sql_posto,$db);
	$posto = mysql_fetch_array($result_posto);
	$POSTOFIXO=strtoupper($posto['nome_posto']);

	}else{
		$TPVISTORIA = "VOLANTE";
		}

if($cliente[0]=='67'){
	$preco=substr($vistoria['PRECOVISTORIA'],0,2).",".substr($vistoria['PRECOVISTORIA'],2,2);
	$veiculo=$modelo[0];
	
	// ARRUMANDO PRE�O SE FOR POSTO
	if($reg["TPVISTORIA"]=='P'){            
		$PRECO="28,00";            
		}
	
	
	} 
	elseif($cliente[0]=='0'){
		if ($vistoria['TPVISTORIA']=='V'){
			$preco=$resultadoPreco['preco_vistoria'];
			}else{
				$preco=$resultadoPreco['preco_vistoria_posto'];
				}
				$veiculo=$vistoria['NMVEICULO'];
				}else{
					$preco=$resultadoPreco['preco_vistoria'];
					$veiculo=$vistoria['NMVEICULO'];
						}

	 switch ($cliente[0]){
	  case 0 : if($solicitacao['proposta']==''){$solicita = $vistoria['NUMEROSOLICITACAO'];}else{$solicita = $solicitacao['proposta'];} break; 
	  case 20 : $solicita = $vistoria['proposta']; break;
	  case 44 : $solicita = $extra['proposta']; break;
	  case 38 : $solicita = $extra['proposta']; break;
	  case 53 : $solicita = $vistoria['NUMEROSOLICITACAO']; break;
	  case 39 : $solicita = $vistoria['proposta']; break;
	  case 55 : $solicita = $extra['proposta']; break;
	  case 59 : $solicita = $solicitacao['agendamento']; break;
	  case 60 : $solicita = $extra['proposta']; break;
	  case 37 : $solicita = $extra['proposta']; break;
	  case 73 : if($solicitacao['apolice']!=''){$solicita = substr($solicitacao['apolice'],0,9);}else{$solicita = $extra['voucher'];} break;
	  case 67 : $solicita = $extra['voucher']; break;
	  case 69 : $solicita = $solicitacao['proposta']; break;
	  case 83 : $solicita = $solicitacao['numero_inspecao']; break;
	  case 61 : $solicita = $solicitacao['numero_inspecao']; break;
	  case 62 : $solicita = $solicitacao['numero_laudo_informado']; break;
	  case 87 : $solicita = $vistoria['NUMEROSOLICITACAO']; break;
	  case 201 : $solicita = $solicitacao['proposta']; break;
	  case 202 : $solicita = $solicitacao['proposta']; break;
	  case 415 : $solicita = $vistoria['quant_equipamentos_outros']; break;
	  default: break;
	  }
	  
	if($_SESSION['roteirizador']==200){
		$solicita = $vistoria['NUMEROSOLICITACAO'];
		}  
	
	if ($vistoria["SEGURADORA"]=='0'){
	
	 if ($vistoria["CDFINALIDADE"]=='01'){ $CDFINALIDADE = "Novo (previa)";}
     if ($vistoria["CDFINALIDADE"]=='02'){ $CDFINALIDADE = "Reducao franquia";}
     if ($vistoria["CDFINALIDADE"]=='03'){ $CDFINALIDADE = "Parcela em atraso";}
     if ($vistoria["CDFINALIDADE"]=='04'){ $CDFINALIDADE = "Substituicao";}
     if ($vistoria["CDFINALIDADE"]=='05'){ $CDFINALIDADE = "Renovacao";}
     if ($vistoria["CDFINALIDADE"]=='06'){ $CDFINALIDADE = "Inclusao acessorios";}
     if ($vistoria["CDFINALIDADE"]=='07'){ $CDFINALIDADE = "Exclusao de avarias";}
     if ($vistoria["CDFINALIDADE"]=='08'){ $CDFINALIDADE = "Consorcio - Substituicao de  Garantia";}
     if ($vistoria["CDFINALIDADE"]=='09'){ $CDFINALIDADE = "Consorcio - Avaliacao de Bem";}
     if ($vistoria["CDFINALIDADE"]=='10'){ $CDFINALIDADE = "Vistoria Especial";}
     if ($vistoria["CDFINALIDADE"]=='11'){ $CDFINALIDADE = "Incl. de Cla. de Vidro";}
     if ($vistoria["CDFINALIDADE"]=='99'){ $CDFINALIDADE = "Outros";}
	 if ($vistoria["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; }
	 if ($vistoria["TPVISTORIA"]=='V'){$TPVISTORIA = "VOLANTE"; }
	}
	
	if ($vistoria["SEGURADORA"]=='61'){ // BUSCA MOTIVO DA SOLICITA��O
	
	 $CDFINALIDADE=$solicitacao["motivo"];  
	 if ($vistoria["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; }
	 if ($vistoria["TPVISTORIA"]=='V'){$TPVISTORIA = "VOLANTE"; }
	 
	}
	
	if ($cliente[0]=='69'){
	
			
	//selecionando a filial para pegar a regiao correta
	$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial['id']." AND seguradora = '69' AND roteirizador = ".$vistoria['roteirizador']."";
	$result_preco = @mysql_query($sql_preco,$db);
	$resultadoPreco = @mysql_fetch_array($result_preco);
	
	$preco_vistoria_volante = $resultadoPreco['preco_vistoria'];
	$preco_vistoria_posto = $resultadoPreco['preco_vistoria_posto'];	

	 if ($vistoria["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; $preco=$preco_vistoria_posto; }
	 if ($vistoria["TPVISTORIA"]=='V'||$vistoria["TPVISTORIA"]=='D'){$TPVISTORIA = "VOLANTE"; $preco=$preco_vistoria_volante; }
		 
		 
	}
	
	if($vistoria["SEGURADORA"]=='39'){
		if ($vistoria["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; $preco=$preco_posto; }
	 	if ($vistoria["TPVISTORIA"]=='V'||$vistoria["TPVISTORIA"]=='D'){$TPVISTORIA = "VOLANTE"; $preco=$preco_volante; }
		}
		
	if($vistoria["SEGURADORA"]=='83' && $_SESSION['roteirizador']==1786){
		if ($vistoria["TPVISTORIA"]=='P'){$TPVISTORIA = "POSTO"; $preco="23.59"; }
	 	if ($vistoria["TPVISTORIA"]=='V'||$vistoria["TPVISTORIA"]=='D'){$TPVISTORIA = "VOLANTE"; $preco="29.44"; }
		}	
	
	

$data_vistoria1 = intval($vistoria['DTVISTORIA']);
$data_trans1 = intval($vistoria['DTTRANS']);
	if($data_trans1!=="//0")
			{
				//data da realiza��o da vistoria
				
				if($cliente[0]=='202'){
					$data_realiza = substr($solicitacao['data_auto'],6,4).substr($solicitacao['data_auto'],3,2).substr($solicitacao['data_auto'],0,2);
					}else{
						$data_realiza = $vistoria['DTVISTORIA'];
							}
				//data da transmiss�o da vistoria
				$data_trans = $vistoria['DTTRANS'];
				
				$mes_realizacao = $data_realiza{4}.$data_realiza{5};
				$dia_realizacao = $data_realiza{6}.$data_realiza{7};
				
				$mes_trans = $data_trans{4}.$data_trans{5};
				$dia_trans = $data_trans{6}.$data_trans{7};
				$ano_trans = $data_trans{0}.$data_trans{1}.$data_trans{2}.$data_trans{3}; 
				
				if ($mes_realizacao!==$mes_trans)    
				{                                                                         
				$lastday = mktime (0,0,0,$mes_trans,0,$ano_trans);
				$ultimo_dia = strftime ( "%d", $lastday);
				$quantidade_dia = ($ultimo_dia - intval($dia_realizacao));
				$quantidade_falta = $dia_trans + $quantidade_dia;
				}
				else 
				{
				$quantidade_falta = $dia_trans-$dia_realizacao;
				}
			}
			else
			{
			$data_transmissao="";
			$quantidade_falta="";
			}	


if($extra['KM_rodado']!=''){
	$kmRealizacao=$extra['KM_rodado'];
	}else{
		$kmRealizacao=$vistoria['km_percorrido'];
		}
		

if($solicitacao['possuiValorKM']=='S'){
$valorKM=$solicitacao['valorKM'];
}else{
	$valorKM='';
	}


if ($cliente[0]=='0'||$cliente[0]=='61'||$cliente[0]=='25'){ // bradesco e maritima e trust
   echo "

  <tr>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>$contador</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria['NRVISTORIA']."</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>". strtoupper($solicita)."</font></td>
	    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>". $CDFINALIDADE."</font></td>
	<td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".$veiculo."</font></td>
    <td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria['NRCHASSI'])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NRPLACA])."</font></td>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTVISTORIA]{6}.$vistoria[DTVISTORIA]{7}.'/'.$vistoria[DTVISTORIA]{4}.$vistoria[DTVISTORIA]{5}.'/'.$vistoria[DTVISTORIA]{0}.$vistoria[DTVISTORIA]{1}.$vistoria[DTVISTORIA]{2}.$vistoria[DTVISTORIA]{3}."</font></td>
	<td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTPROC]{6}.$vistoria[DTPROC]{7}.'/'.$vistoria[DTPROC]{4}.$vistoria[DTPROC]{5}.'/'.$vistoria[DTPROC]{0}.$vistoria[DTPROC]{1}.$vistoria[DTPROC]{2}.$vistoria[DTPROC]{3}."</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTTRANS]{6}.$vistoria[DTTRANS]{7}.'/'.$vistoria[DTTRANS]{4}.$vistoria[DTTRANS]{5}.'/'.$vistoria[DTTRANS]{0}.$vistoria[DTTRANS]{1}.$vistoria[DTTRANS]{2}.$vistoria[DTTRANS]{3}."</font></td>
	<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$quantidade_falta."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NMPROPONENTE])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>";
} // fim BRADESCO e maritima e trust

elseif($_SESSION['roteirizador']==200){	 // QUINT�O VISTORIAS

   echo "

  <tr>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>$contador</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria['NRVISTORIA']."</font></td>
 		    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>". strtoupper($solicita)."</font></td>
			".$colunaGoldValue."
	<td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($veiculo)."</font></td>
    <td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria['NRCHASSI'])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NRPLACA])."</font></td>
	<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($solicitacao['nome_s'])."</font></td>
	<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtolower($solicitacao['email'])."</font></td>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTVISTORIA]{6}.$vistoria[DTVISTORIA]{7}.'/'.$vistoria[DTVISTORIA]{4}.$vistoria[DTVISTORIA]{5}.'/'.$vistoria[DTVISTORIA]{0}.$vistoria[DTVISTORIA]{1}.$vistoria[DTVISTORIA]{2}.$vistoria[DTVISTORIA]{3}."</font></td>
	<td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTPROC]{6}.$vistoria[DTPROC]{7}.'/'.$vistoria[DTPROC]{4}.$vistoria[DTPROC]{5}.'/'.$vistoria[DTPROC]{0}.$vistoria[DTPROC]{1}.$vistoria[DTPROC]{2}.$vistoria[DTPROC]{3}."</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTTRANS]{6}.$vistoria[DTTRANS]{7}.'/'.$vistoria[DTTRANS]{4}.$vistoria[DTTRANS]{5}.'/'.$vistoria[DTTRANS]{0}.$vistoria[DTTRANS]{1}.$vistoria[DTTRANS]{2}.$vistoria[DTTRANS]{3}."</font></td>
	<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$quantidade_falta."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NMPROPONENTE])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>";
	
	
}
elseif($cliente[0]=='202'){ // nordeste (inpe��es de risco)
	
	   echo "

  <tr>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>$contador</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria['NRVISTORIA']."</font></td>
 		    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>". strtoupper($solicita)."</font></td>
	<td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($veiculo)."</font></td>
    <td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($solicitacao['nome_agencia'])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NRPLACA])."</font></td>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $solicitacao['data_auto']."</font></td>
	<td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTPROC]{6}.$vistoria[DTPROC]{7}.'/'.$vistoria[DTPROC]{4}.$vistoria[DTPROC]{5}.'/'.$vistoria[DTPROC]{0}.$vistoria[DTPROC]{1}.$vistoria[DTPROC]{2}.$vistoria[DTPROC]{3}."</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTTRANS]{6}.$vistoria[DTTRANS]{7}.'/'.$vistoria[DTTRANS]{4}.$vistoria[DTTRANS]{5}.'/'.$vistoria[DTTRANS]{0}.$vistoria[DTTRANS]{1}.$vistoria[DTTRANS]{2}.$vistoria[DTTRANS]{3}."</font></td>
	<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$quantidade_falta."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NMPROPONENTE])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>";
	
	} // FIM nordeste (inpe��es de risco)
else{ // outras seguradoras

if( ($_SESSION['roteirizador']==123||$_SESSION['roteirizador']==70) && ($cliente[0]=='60' || $cliente[0]=='38') ){
		
		if($solicitacao['digito_controle_cdc']==''){
			$gold='N�O';
			}else{
				$gold=strtoupper($solicitacao['digito_controle_cdc']);
				}
		
		$colunaGoldValue="<td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".$gold."</font></td>";
		}

	   echo "

  <tr>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>$contador</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria['NRVISTORIA']."</font></td>
 		    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>". strtoupper($solicita)."</font></td>
			".$colunaGoldValue."
	<td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($veiculo)."</font></td>
    <td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria['NRCHASSI'])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NRPLACA])."</font></td>
	<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($solicitacao['nome_s'])."</font></td>
	<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtolower($solicitacao['email'])."</font></td>
    <td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTVISTORIA]{6}.$vistoria[DTVISTORIA]{7}.'/'.$vistoria[DTVISTORIA]{4}.$vistoria[DTVISTORIA]{5}.'/'.$vistoria[DTVISTORIA]{0}.$vistoria[DTVISTORIA]{1}.$vistoria[DTVISTORIA]{2}.$vistoria[DTVISTORIA]{3}."</font></td>
	<td height='27' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTPROC]{6}.$vistoria[DTPROC]{7}.'/'.$vistoria[DTPROC]{4}.$vistoria[DTPROC]{5}.'/'.$vistoria[DTPROC]{0}.$vistoria[DTPROC]{1}.$vistoria[DTPROC]{2}.$vistoria[DTPROC]{3}."</font></td>
    <td height='23' align='center'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>" . $vistoria[DTTRANS]{6}.$vistoria[DTTRANS]{7}.'/'.$vistoria[DTTRANS]{4}.$vistoria[DTTRANS]{5}.'/'.$vistoria[DTTRANS]{0}.$vistoria[DTTRANS]{1}.$vistoria[DTTRANS]{2}.$vistoria[DTTRANS]{3}."</font></td>
	<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$quantidade_falta."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($vistoria[NMPROPONENTE])."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>";
	} // fim outras seguradoras 
    
	$sql_prestador = "SELECT * FROM ".$bancoDados.".user WHERE id = $vistoria[controle_prest]";
	$result_prestador = mysql_query($sql_prestador,$db);
	if (mysql_num_rows($result_prestador)>0)
	{
	$prestador= mysql_fetch_array($result_prestador);
		$sql_posto = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE roteirizador = ".$prestador[roiterizador]." AND codigo_filial like '".$prestador[filial]."'";
		$result_posto = mysql_query($sql_posto,$db);
        $posto = mysql_fetch_array($result_posto);
		if (mysql_num_rows($result_posto)>0)
		{
        echo $posto[nome_filial];
		//echo $posto[uf];
        }
    }
	echo "</font></td>
	<td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".$solicitacao['cidade']."</font></td>
	<td height='23'><font style='font-size: 12px; color:#000000;  font-family: Arial, Helvetica, sans-serif;'>".$solicitacao['estado']."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>";
	
		$sql_prestador = "SELECT * FROM ".$bancoDados.".user WHERE id = $vistoria[controle_prest]";
	$result_prestador = mysql_query($sql_prestador,$db);
	if (mysql_num_rows($result_prestador)>0)
	{
	$prestador= mysql_fetch_array($result_prestador);
	echo strtoupper($prestador[nome]);
    }
    
	if($cliente[0]=='83'){ 
		echo "</font></td>
		<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($solicitacao['corretor'])."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$TPVISTORIA."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$preco."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$kmRealizacao."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$PARECER."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($MOTIVO_RECUSA)."</font></td>
	  </tr>
	  ";
		}elseif($_SESSION['roteirizador']=='200'){ 
		
		if($vistoria['CDCIA']!=''){
			
			$tipoVistoriador='CONSULTOR - ASSOCIA��O';  
			}else{
				$tipoVistoriador='VISTORIADOR - QUINT�O';
				}
		echo "
		</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$tipoVistoriador."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$TPVISTORIA."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$preco."</font></td>
		<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$valorKM."</font></td>
	  	<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$PARECER."</font></td>
	  </tr>
	  ";
		}else{
			echo "</font></td>
			<td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".strtoupper($solicitacao['corretor'])."</font></td>
			<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$TPVISTORIA."</font></td>
			<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$POSTOFIXO."</font></td>
			<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$preco."</font></td>
			<td align='center'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$kmRealizacao."</font></td>
		  </tr>
		  ";
			}
 
 $contador++;
	}// FIM VERIFICA PARCEIRO
  	
	}
  }
  echo "
</table>
";
// FIM RELAT�RIO MAPFRE 
}
?>



<?
/*	
	
if($_GET[visualiza]=="ok"&&$_POST[tipo_relatorio]=='excel_alfa')
{
	//header('Content-type: application/msexcel');
	header('Content-type: application/vnd.ms-excel');
	if($_POST[tipo_relatorio]=='excel_alfa')
	{
	$nome_relatorio = "trans_";
	$cabecalho = "Data de Vistoria ".$_POST[DATA_INICIAL]." a ".$_POST[DATA_FINAL];
	}
	$data_inicial = $_POST[DATA_INICIAL]{6}.$_POST[DATA_INICIAL]{7}.$_POST[DATA_INICIAL]{8}.$_POST[DATA_INICIAL]{9}.$_POST[DATA_INICIAL]{3}.$_POST[DATA_INICIAL]{4}.$_POST[DATA_INICIAL]{0}.$_POST[DATA_INICIAL]{1};

	$data_final = $_POST[DATA_FINAL]{6}.$_POST[DATA_FINAL]{7}.$_POST[DATA_FINAL]{8}.$_POST[DATA_FINAL]{9}.$_POST[DATA_FINAL]{3}.$_POST[DATA_FINAL]{4}.$_POST[DATA_FINAL]{0}.$_POST[DATA_FINAL]{1};

  $cliente = split("<>",$_POST[cliente]);
  if($_SESSION[roteirizador]=='0')
  {
	$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND SEGURADORA = '40' AND roteirizador = 0 OR
    DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND SEGURADORA = '40' AND roteirizador = 627
    order by ".$_POST[ordernar]." ".$_POST[por]."";
  }
  else
  {
    $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." AND SEGURADORA = '40' AND roteirizador = ".$_SESSION[roteirizador]."
    order by ".$_POST[ordernar]." ".$_POST[por]."";
  
  }  
    $result_vistoria = mysql_query($sql_vistoria,$db);
	header('Content-Disposition: attachment; filename="relatorio_'.$_SESSION[roteirizador].'_'.$nome_relatorio.'_'.$data_inicial.'_'.$data_final.'_proc'.date(Ymd).'.xls"');
	
		
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td height='23' colspan='16' bgcolor='#D2D2D2'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Relat�rio ".$cabecalho." </font></td>
  </tr>
  <tr>
    <td height='23' bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>N�mero da Vistoria</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Data Vistoria</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Nome Corretor</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Cidade</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Segurado</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>CPF</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Descri��o/Ve�culo</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Chassi</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Placa</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Ano/Modelo</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Fidelidade</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Posto/Domicilio</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>KM real rodado</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Excedente de KM</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Valor KM cobrado</font></td>
    <td bgcolor='#EFEFEF'><font style='font-size: 12px; color:#000000; font-weight: bold; font-family: Arial, Helvetica, sans-serif;'>Valor VP</font></td>
  </tr>
  ";
	if (mysql_num_rows($result_vistoria)>0)
	{ 
	 while ($vistoria = mysql_fetch_array($result_vistoria))
	{
	
	$sql_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$vistoria[NUMEROSOLICITACAO];
    $result_solicitacao = mysql_query($sql_solicitacao,$db);
    $solicitacao = mysql_fetch_array($result_solicitacao);
	
	if($solicitacao['clienteOrigem']==''){	
	
	$finalidade = "";
	
		if ($vistoria["CDFINALIDADE"] =='9')  {$finalidade = "ALTERACAO DE FRANQUIA";}
        if ($vistoria["CDFINALIDADE"] =='10') {$finalidade = "ALTERACAO DE PERIMETRO";}
        if ($vistoria["CDFINALIDADE"] =='7')  {$finalidade = "AUMENTO DA IS";}
        if ($vistoria["CDFINALIDADE"] =='8')  {$finalidade = "CONSTATACAO DE DANOS";}
        if ($vistoria["CDFINALIDADE"] =='19') {$finalidade = "CONTROLE DE QUALIDADE";}
        if ($vistoria["CDFINALIDADE"] =='4')  {$finalidade = "EXCLUSAO AVARIA";}
        if ($vistoria["CDFINALIDADE"] =='11') {$finalidade = "FRUSTRADA";}
        if ($vistoria["CDFINALIDADE"] =='5')  {$finalidade = "INCLUSAO ACESS�RIO";}
        if ($vistoria["CDFINALIDADE"] =='17') {$finalidade = "INCLUSAO DE COBERTURA";}
        if ($vistoria["CDFINALIDADE"] =='16') {$finalidade = "INCLUSAO DE ITEMS";}
        if ($vistoria["CDFINALIDADE"] =='2')  {$finalidade = "PAGAMENTO DE CARNE";}
        if ($vistoria["CDFINALIDADE"] =='6')  {$finalidade = "RENOVACAO";}
        if ($vistoria["CDFINALIDADE"] =='18') {$finalidade = "RENOVACAO ALFA SEGUROS";}
        if ($vistoria["CDFINALIDADE"] =='15') {$finalidade = "RENOVACAO CONGENERE";}
        if ($vistoria["CDFINALIDADE"] =='13') {$finalidade = "RENOVACAO CORRETOR COM SINISTRO";}
        if ($vistoria["CDFINALIDADE"] =='14') {$finalidade = "RENOVACAO CORRETOR SEM SINISTRO";}
        if ($vistoria["CDFINALIDADE"] =='1')  {$finalidade = "SEGURO NOVO";}
        if ($vistoria["CDFINALIDADE"] =='3')  {$finalidade = "SUBSTITUICAO VEICULO";}
		
		$tpvistoria = '';
		if($vistoria['TPVISTORIA']=='F'){ $tpvistoria = 'P'; }
		if($vistoria['TPVISTORIA']=='V'){ $tpvistoria = 'D'; }
        
   echo "
    <tr>
    <td height='23'><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NRVISTORIA]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".
$vistoria[DTTRANS]{6}.$vistoria[DTTRANS]{7}.'/'.$vistoria[DTTRANS]{4}.$vistoria[DTTRANS]{5}.'/'.$vistoria[DTTRANS]{0}.$vistoria[DTTRANS]{1}.$vistoria[DTTRANS]{2}.$vistoria[DTTRANS]{3}."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NMCORRETOR]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$solicitacao['cidade']."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NMPROPONENTE]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$solicitacao['cpf_cnpj']."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NMVEICULO]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NRCHASSI]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NRPLACA]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria[NRANOFABRICACAO]."/".$vistoria[NRANOMOD]."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$finalidade."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$tpvistoria."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'>".$vistoria['KMVEICULO']."</font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'></font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'></font></td>
    <td><font style='font-size: 12px; color:#000000; font-family: Arial, Helvetica, sans-serif;'></font></td>
  </tr>
  ";
  	
	}// fim verifica parceiro
	
	}
  }
  echo "
</table>
";

}
	*/
?>
</body>
</html>
