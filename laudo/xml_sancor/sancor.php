<?php


ini_set('display_errors',0); 
ini_set('display_startup_erros',0); 
error_reporting(E_ALL);

ignore_user_abort(1);
include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";
include "/var/www/html/sistema/verifica_roteirizador.php";   

$start = array_sum(explode(' ', microtime()));

ini_set("memory_limit","90M");


############## FUNÇÃO PARA SUBSTITUIR O file_get_contents() ##########################
function file_get_contents_curl($url) {

$caminho = caminho.$url;

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);    

// configura o curl para retornar o conteudo em vez
// de fazer o envio directamente para o browser.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_URL, $caminho);

$data = curl_exec($ch);
curl_close($ch);

return $data;     

}
#####################################################################################################

$sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE NUMEROSOLICITACAO = ".$_GET['id']; 
$result_vistoria = mysql_query($sql_vistoria,$db);
$vistoria = mysql_fetch_array($result_vistoria);

$sql_extra = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$_GET['id'];
$result_extra = mysql_query($sql_extra,$db);
$extra = mysql_fetch_array($result_extra);

$datas_transmissoes  = $vistoria['datas_transmissoes'].''.date("Ymd").',';

$sql_rot_solicitacao="SELECT * FROM ".$bancoDados.".solicitacao WHERE id = " . $_GET["id"];
$result_rot_solicitacao = mysql_query($sql_rot_solicitacao,$db);
$solicitacao = mysql_fetch_array($result_rot_solicitacao);


if(strlen($vistoria["NRDUT"])>5)
{
	$data_dut = $vistoria["DTDUT"];
	$nome_dut = utf8_encode($vistoria["NMDUT"]);
	$orgao_dut = $vistoria["NMORGAODUT"];
	$numero_dut = $vistoria["NRDUT"];
	$numero_renavam = $vistoria["NRRENAVAM"];
}

if(strlen($vistoria["NRDUT"])<5)
{
	$data_dut = $vistoria["DTVISTORIA"];
	$nome_dut = 'NOTA FISCAL';
	$orgao_dut = $vistoria["UFVISTORIA"];
	$numero_dut = '1111111111';
	$numero_renavam = '123456789';
}

$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = ".$vistoria['roteirizador']." AND nome_seguradora = '329'";
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$idUsuarioWS = $seguradora['idusuario'];
$idUsuarioSFTP = $seguradora['usuario_url_transmissao'];
$senhaWS = $seguradora['pswusuario'];
$senhaSFTP = $seguradora['senha_url_transmissao'];
$nomeVistoriadora = $seguradora['nomeVistoriadora'];
$enderecoSFTP= $seguradora['url'];
$cnpjEmpresa= $seguradora['codigo_prestadora'];
$codigoEmpresa= $cnpjEmpresa;   



//OBS COLOCA-LO QUANDO ESTIVER PRONTO A TRANSMISSÃO NO CONTROLE VP $CDCIA	=	$vistoria["CDCIA"];
//Variavel para controle de cep, para que o CEP não seja transmitido zerado para Seguradora
$CEPVISTORIA = $vistoria["CEPVISTORIA"];
if($CEPVISTORIA<=0)
{
	$CEPVISTORIA = "11111111";
}

$sql_posto = "SELECT * FROM ".$bancoDados.".contro_vp_posto WHERE cep = '".$CEPVISTORIA."' ";
$result_posto = mysql_query($sql_posto,$db);
$posto = mysql_fetch_array($result_posto);

//selecionando o prestador
$sql_prestador = "SELECT filial,cpf,nome FROM ".$bancoDados.".user WHERE id = ".$vistoria['controle_prest'];
$result_prestador = mysql_query($sql_prestador,$db);
$prestador = mysql_fetch_array($result_prestador);

//selecionando a filial para pegar a regiao correta'
$sql_filial = "SELECT cidade,id FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prestador['filial']."' AND roteirizador = '".$vistoria['roteirizador']."'";
$result_filial = mysql_query($sql_filial,$db);
$prestador_filial = mysql_fetch_array($result_filial);

$sql_preco = "SELECT preco_vistoria FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial['id']." AND seguradora = '329' AND roteirizador = ".$vistoria['roteirizador'];
$result_preco = @mysql_query($sql_preco,$db);
$preco = @mysql_fetch_array($result_preco);


		 if ($vistoria["cor"]=="01") { $cor = "Amarelo";}
		 if ($vistoria["cor"]=="02") { $cor = "Azul";}
		 if ($vistoria["cor"]=="03") { $cor = "Bege";}
		 if ($vistoria["cor"]=="04") { $cor = "Branco";}
		 if ($vistoria["cor"]=="05") { $cor = "Cinza";}
		 if ($vistoria["cor"]=="06") { $cor = "Dourado";}
		 if ($vistoria["cor"]=="07") { $cor = "Laranja";}
		 if ($vistoria["cor"]=="08") { $cor = "Marrom";}
		 if ($vistoria["cor"]=="09") { $cor = "Prata";}
		 if ($vistoria["cor"]=="10") { $cor = "Preto";}
		 if ($vistoria["cor"]=="11") { $cor = "Verde";}
		 if ($vistoria["cor"]=="12") { $cor = "Vermelho";}
		 if ($vistoria["cor"]=="13") { $cor = "Vinho";}
		 if ($vistoria["cor"]=="14") { $cor = "Fantasia";}
		 if ($vistoria["cor"]=="15") { $cor = "Roxo";}

$etiquetas=$vistoria['etiquetas'];

      if($etiquetas{0}==1){
		  //Compartimento Motor
		  $motor = 'true';
		  }
		  else{
			 $motor = 'false';
			  }

		     if($etiquetas{2}==2||$etiquetas{0}==2){
		  //Assoalho
		  $assoalho = 'true';
		  }
		  else{
			 $assoalho = 'false';
			  }

			     if($etiquetas{4}==3||$etiquetas{2}==3||$etiquetas{0}==3){
		  //Coluna Porta
		  $porta = 'true';
		  }
		  else{
			 $porta = 'false';
			  }


if($solicitacao['proposta']!=''){
	 $proposta = $solicitacao['proposta'];
	 }else{
			$proposta = $solicitacao['id'];
		 }

// PROTOCOLO É O NÚMERO DA NOSSA SOLICITAÇÃO QUE ENVIAMOS NO RECEBIMENTO;
$protocolo=$solicitacao['id'];

 if($vistoria['INALIENADO']=='S'){
	 $alienado = 'true';
 		}else{
	 		$alienado = 'false';
 				}
 if($vistoria['INREMARCADO']=='S'){
	 $remarcado =  'true';
 		}else{
	 		$remarcado = 'false';
 				}

 if($vistoria['INTRANSF']=='S'){
	 $transformado = 'true';
 		}else{
	 		$transformado = 'false';
 				}

if($vistoria['pneus']=='1'){
	$pneus = "novos";
	}elseif($vistoria['pneus']=='2'){
		$pneus = "bons";
		}else{
			$pneus =  "ruins";
				}

if($vistoria['extintor']==4){$extintor = "N";}else{$extintor = "S";}


 if(strlen($solicitacao['tel2'])>9){ $ddd = $solicitacao['tel2']{0}.$solicitacao['tel2']{1};}
			   else{$ddd = "11";}

  if(strlen($solicitacao['tel2'])>9){
	  $tel = str_replace(" ","1" ,str_replace("-","1", $solicitacao['tel2']{3}.$solicitacao['tel2']{4}.$solicitacao['tel2']{5}.$solicitacao['tel2']{6}.$solicitacao['tel2']{7}.$solicitacao['tel2']{8}.$solicitacao['tel2']{9}.$solicitacao['tel2']{10}));
}
			   else {$tel = substr(str_replace(" ","1" ,str_replace("-","1",$solicitacao['tel2'])),0,8);}
			   if(strlen($solicitacao['tel2'])<8){$tel =  "11111111";}


			  			  $ddd1 = str_replace(" ,#*", "1138", $ddd);

			  $tel1 = str_replace(" ,#*", "1138", $tel);





if(strlen($vistoria['DSOUTRASPECAS'])>0||strlen($vistoria['CDPECA'])>0)
{$contem_ava1 = '1';
$contem_ava = 1;}
else{$contem_ava1 = '0';}


if(strlen($vistoria['DSOUTROSOPCIONAIS'])>0||strlen($vistoria['CDOPCIONAIS'])>0){$contem_op1 = '1'; $contem_op = 1;}else{$contem_op1 = '0';}

if(strlen($vistoria['DSOUTROSACESSORIOS'])>0||strlen($vistoria['CDACESSORIOS'])>0){$contem_ac1 =  '1'; $contem_ac = 1;}else{$contem_ac1 =  '0';}
if(strlen($vistoria['CDEQUIPAMENTO'])>0)
{$contem_eq1 = '1';
$contem_eq = 1;}
else{$contem_eq1 = '0';}
	

$tiraAcentos=array(
                                                                     'á' => 'a',
                                                                     'à' => 'a',
                                                                     'ã' => 'a',
                                                                     'â' => 'a',
                                                                     'é' => 'e',
                                                                     'ê' => 'e',
                                                                     'í' => 'i',
                                                                     'ó' => 'o',
                                                                     'ô' => 'o',
                                                                     'õ' => 'o',
                                                                     'ú' => 'u',
                                                                     'ü' => 'u',
                                                                     '*' => 'x',
                                                                     'ç' => 'c',
                                                                     'Á' => 'A',
                                                                     'À' => 'A',
                                                                     'Ã' => 'A',
                                                                     'Â' => 'A',
                                                                     'É' => 'E',
                                                                     'Ê' => 'E',
                                                                     'Í' => 'I',
                                                                     'Ó' => 'O',
                                                                     'Ô' => 'O',
                                                                     'Õ' => 'O',
                                                                     'Ú' => 'U',
                                                                     'Ü' => 'U',
                                                                     'Ç' => 'C',
                                                                     '&' => 'e',
                                                                     'tilde;' => '',
																	 '-' => '',
                                                                     '.' => '',
                                                                     ')' => '',
                                                                     '(' => '',
																	 'Trava Elétrica Portas' => 'Trava Eletrica Ptas',
                                                                     'Trava Eletrica Portas' => 'Trava Eletrica Ptas',
                                                                     'Trava Elétrica Porta malas' => 'Trava Elet Pta Malas',
                                                                     'Trava Eletrica Porta malas' => 'Trava Elet Pta Malas',
                                                                     'Sensor de Estacionamento' => 'Sensor de Estaciona',
                                                                     'Retrovisores Eletricos' => 'Retrovisor Eletrico',
                                                                     'Retrovisores Elétricos' => 'Retrovisor Eletrico',
                                                                     'Adap. mec. def. Fisico' => 'Adap. Def. Fisico'
                                                                   );
	
if(strlen($solicitacao['endereco'])>4&&strlen($solicitacao['numero'])>0){
$endereco = strtr(utf8_encode($solicitacao[endereco]), $tiraAcentos).','.$solicitacao[numero];
}
else{
	$endereco = strtr(utf8_encode($posto['endereco']), $tiraAcentos).','.$posto['numero'];
}

																   
########################################################################################################
################################              ARRAY DE ACESSORIOS       ################################
########################################################################################################
              if($contem_ac==1){$AcessoriosArray.= "                     <acessorios>\n";}



			  $contem_acessorio=0;
			  $inicio =0;
			  $contem_item = 0;
			  $array_acessorios = explode(",",$vistoria['CDACESSORIOS']);
			  $array_acessorios_marca = explode(",",$vistoria['DSMARCA']);
			  while($inicio<=30)
			  {
			  	if(intval($array_acessorios[$inicio])>=1)
				{
if($array_acessorios[$inicio]=="1"){$nome_acessorio="Rádio";}
if($array_acessorios[$inicio]=="2"){$nome_acessorio="Rádio-toca-fitas";}
if($array_acessorios[$inicio]=="3"){$nome_acessorio="Amplificador";}
if($array_acessorios[$inicio]=="4"){$nome_acessorio="CD Player";}
if($array_acessorios[$inicio]=="5"){$nome_acessorio="Televisão";}
if($array_acessorios[$inicio]=="6"){$nome_acessorio="CD de mala";}
if($array_acessorios[$inicio]=="7"){$nome_acessorio="Equalizador";}
if($array_acessorios[$inicio]=="9"){$nome_acessorio="Autofalante";}
if($array_acessorios[$inicio]=="10"){$nome_acessorio="Aerofolios";}
if($array_acessorios[$inicio]=="11"){$nome_acessorio="Estribos";}
if($array_acessorios[$inicio]=="12"){$nome_acessorio="Quebra Mato";}
if($array_acessorios[$inicio]=="13"){$nome_acessorio="Mata Cachorro";}
if($array_acessorios[$inicio]=="14"){$nome_acessorio="Santo Antonio";}
if($array_acessorios[$inicio]=="15"){$nome_acessorio="Protetor de Carter";}
if($array_acessorios[$inicio]=="16"){$nome_acessorio="Capota Marítima";}
if($array_acessorios[$inicio]=="17"){$nome_acessorio="Capota Elétrica";}
if($array_acessorios[$inicio]=="18"){$nome_acessorio="Faróis Auxiliares";}
if($array_acessorios[$inicio]=="19"){$nome_acessorio="Break Light";}
if($array_acessorios[$inicio]=="20"){$nome_acessorio="Protetor de Caçamba";}
if($array_acessorios[$inicio]=="21"){$nome_acessorio="Insulfilm";}
if($array_acessorios[$inicio]=="22"){$nome_acessorio="Tacógrafo";}
if($array_acessorios[$inicio]=="23"){$nome_acessorio="DVD";}
if($array_acessorios[$inicio]=="24"){$nome_acessorio="Spoiler Dianteiro";}
if($array_acessorios[$inicio]=="25"){$nome_acessorio="Spoiler Lateral";}
if($array_acessorios[$inicio]=="26"){$nome_acessorio="Spoiler Traseiro";}
if($array_acessorios[$inicio]=="27"){$nome_acessorio="Volante Regulável";}
if($array_acessorios[$inicio]=="28"){$nome_acessorio="Retrovisores Elétricos";}
if($array_acessorios[$inicio]=="29"){$nome_acessorio="Bagageiro";}
if($array_acessorios[$inicio]=="30"){$nome_acessorio="Faróis de Xenon";}
if($array_acessorios[$inicio]=="31"){$nome_acessorio="Snorkel";}
if($array_acessorios[$inicio]=="32"){$nome_acessorio="Engate";}
if($array_acessorios[$inicio]=="33"){$nome_acessorio="Mala de Teto";}

				$contem_acessorio++;
				$AcessoriosArray.= "                        <acessorio>\n";
				$AcessoriosArray.= "                           <codigo>" . $array_acessorios[$inicio] . "</codigo>\n";
      			$AcessoriosArray.= "                           <tipo/>\n";
				$AcessoriosArray.= "                           <marca>" . strtr($array_acessorios_marca[$inicio],array('´'=>'')) . "</marca>\n";
				$AcessoriosArray.= "                           <quantidade>0</quantidade>\n";
				$AcessoriosArray.= "                           <nome>" .$nome_acessorio. "</nome>\n";
				$AcessoriosArray.= "                        </acessorio>\n";
$contem_item++;
				}
			  $inicio++;
			  }



 			  $inicio =0;
			  $contem_item = 0;
			  $array_outro_acessorios = explode(",",$vistoria['DSOUTROSACESSORIOS']);
			  $array_outro_acessorios_marca = explode(",",$vistoria['DSMARCAACESSORIOS']);
			  while($inicio<=30)
			  {
			  	if(strlen($array_outro_acessorios[$inicio])>=1)
				{
				$contem_acessorio++;
				$AcessoriosArray.= "                        <acessorio>\n";
				$AcessoriosArray.= "                           <codigo>9".$inicio."</codigo>\n";
      			$AcessoriosArray.= "                           <tipo/>\n";
				$AcessoriosArray.= "                           <marca>" . strtr($array_outro_acessorios_marca[$inicio],array('´'=>'')) . "</marca>\n";
				$AcessoriosArray.= "                           <quantidade>0</quantidade>\n";
				$AcessoriosArray.= "                           <nome>" . $array_outro_acessorios[$inicio] . "</nome>\n";
				$AcessoriosArray.= "                        </acessorio>\n";
				$contem_item++;
				}
			  $inicio++;

	}

              $inicio =0;
			  $contem_opcionais=0;
			  $contem_item = 0;
			  $array_opcionais = explode(",",$vistoria['CDOPCIONAIS']);
			  while($inicio<=30)
			  {
			  	if(intval($array_opcionais[$inicio])>=1)
				{
if($array_opcionais[$inicio]=="1") {$nome_opcionais="Air-bag modelo simples";}
if($array_opcionais[$inicio]=="2") {$nome_opcionais="Air-bag modelo duplo";}
if($array_opcionais[$inicio]=="3") {$nome_opcionais="Ar Condicionado";}
if($array_opcionais[$inicio]=="4") {$nome_opcionais="Aros de liga leve";}
if($array_opcionais[$inicio]=="5") {$nome_opcionais="Bancos de couro";}
if($array_opcionais[$inicio]=="6") {$nome_opcionais="Banco c/ regulagem elétrica";}
if($array_opcionais[$inicio]=="7") {$nome_opcionais="---";}
if($array_opcionais[$inicio]=="8") {$nome_opcionais="Check-control";}
if($array_opcionais[$inicio]=="9") {$nome_opcionais="Computador de bordo";}
if($array_opcionais[$inicio]=="10") {$nome_opcionais="Desembaçador vidro traseiro";}
if($array_opcionais[$inicio]=="11") {$nome_opcionais="Direção hidráulica";}
if($array_opcionais[$inicio]=="12") {$nome_opcionais="Trio elétrico";}
if($array_opcionais[$inicio]=="13") {$nome_opcionais="Freios ABS";}
if($array_opcionais[$inicio]=="14") {$nome_opcionais="Intercooler";}
if($array_opcionais[$inicio]=="15") {$nome_opcionais="Limpador traseiro";}
if($array_opcionais[$inicio]=="16") {$nome_opcionais="Motor com turbina";}
if($array_opcionais[$inicio]=="17") {$nome_opcionais="Piloto automático";}
if($array_opcionais[$inicio]=="18") {$nome_opcionais="Suporte externo pneu";}
if($array_opcionais[$inicio]=="19") {$nome_opcionais="Teto solar";}
if($array_opcionais[$inicio]=="20") {$nome_opcionais="Câmbio automático";}
if($array_opcionais[$inicio]=="21") {$nome_opcionais="Alarme";}
if($array_opcionais[$inicio]=="22") {$nome_opcionais="Trava anti-furto";}
if($array_opcionais[$inicio]=="23") {$nome_opcionais="Tração 4x2";}
if($array_opcionais[$inicio]=="24") {$nome_opcionais="Tração 4x4";}
if($array_opcionais[$inicio]=="25") {$nome_opcionais="Tração 6x4";}
if($array_opcionais[$inicio]=="26") {$nome_opcionais="Câmbio Semi-Automático";}
if($array_opcionais[$inicio]=="27") {$nome_opcionais="Direção Elétrica";}
				$contem_opcionais++;
				$contem_item++;

				$AcessoriosArray.= "                        <acessorio>\n";
                $AcessoriosArray.= "                           <codigo>" . $array_opcionais[$inicio] . "</codigo>\n";
				$AcessoriosArray.= "                           <tipo/>\n";
				$AcessoriosArray.= "                           <marca/>\n";
				$AcessoriosArray.= "                           <quantidade>0</quantidade>\n";
                $AcessoriosArray.= "                           <nome>" .$nome_opcionais. "</nome>\n";
				$AcessoriosArray.= "                        </acessorio>\n";

				}
			  $inicio++;
			  }

			   $inicio =0;
			  $contem_item = 0;
			  $array_outro_opcionais = explode(",",$vistoria['DSOUTROSOPCIONAIS']);
			  $array_outro_opcionais_marca = explode(",",$vistoria['DSOUTROSOPCIONAIS']);
			  while($inicio<=30)
			  {
			  	if(strlen($array_outro_opcionais[$inicio])>=1)
				{

				$contem_acessorio++;
//#######################################################################################################################################//
//if na linha abaixo inserido ##############  Código para corrigir o número de opcionais em acessórios#################
                $contador_acessorio = count($array_outro_acessorios);
                $contador_acessorio--; //corrige a quantidade para começar na última posição vazia.
				if($inicio <= 9)
				  {	//Instruções originais
      				$AcessoriosArray.= "                        <acessorio>\n";
                    $AcessoriosArray.= "                           <codigo>9".$inicio."</codigo>\n";
				    $AcessoriosArray.= "                           <tipo/>\n";
				    $AcessoriosArray.= "                           <marca/>\n";
					$AcessoriosArray.= "                           <quantidade>0</quantidade>\n";
                    $AcessoriosArray.= "                           <nome>" . strtr($array_outro_opcionais[$inicio], $tiraAcentos). "</nome>\n";
				    $AcessoriosArray.= "                        </acessorio>\n";
				  }
				else
				  {//Intruções adionais para jogar em acessórios os opcionais excedentes
				     $xmlLaudo0 = strstr($xmlLaudo,"</acessorios>",true); //Pega o lado esquerdo da string exclusivamente
				     $xmlLaudo1 = strstr($xmlLaudo,"</acessorios>");//Pega o lado direito da string inclusive
				     $acessorios = "                        <acessorio>\n";
				     $acessorios.= "                           <codigo>9" . $contador_acessorio . "</codigo>\n";
                     $acessorios.= "                           <tipo>0</tipo>\n";
                     $acessorios.= "                           <marca>0</marca>\n";
					 $acessorios.= "                           <quantidade>0</quantidade>\n";
				     $acessorios.= "                           <nome>" . strtr($array_outro_opcionais[$inicio], $tiraAcentos) . "</nome>\n";
                     $acessorios.= "                           <quantidade>0</quantidade>\n";
                     $acessorios.= "                        </acessorio>\n";
					 
                     $xmlLaudo = $xmlLaudo0 . $acessorios . $xmlLaudo1; //põe os acessórios entre as partes separadas da string e as junta novamente.
				     $contador_acessorio++;
				  }
//#########################################################################################################################################//
				$contem_item++;
				}
			  $inicio++;
			  }

	              if($contem_ac==1){$AcessoriosArray.= "                     </acessorios>\n";}
##############################################################################################################

##############################################################################################################
###############################                 ARRAY DE AVARIAS               ###############################
##############################################################################################################
			  		              if($contem_ava==1){$AvariasArray.= "                     <avarias>\n";}

					//ARRUMANDO AS AVARIAS
$inicio=0;
$array_peca = explode(",",$vistoria['CDPECA']);
$array_peca_avaria = explode(",",$vistoria['CDAVARIA']);
$array_peca_cm = explode(",",$vistoria['CMPECA']);
while($inicio<=19)
{
	if(strlen($array_peca[$inicio])>=1)
	{

//padrão
$hr_Total='00';
$hr_eletrica='00';
$hr_funilaria='00';
$hr_pintura='00';
$hr_tapecaria='00';
$cmAvaria_eletrica='00';
$cmAvaria_funilaria='00';
$cmAvaria_pintura='00';
$cmAvaria_tapecaria='00';

//Amassado
if (intval($array_peca_avaria[$inicio])==1)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='02';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='02';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='03';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='04';$hr_pintura='05';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='05';$hr_pintura='06';}
}
//Arranhado
if (intval($array_peca_avaria[$inicio])==2)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Com bolha
if (intval($array_peca_avaria[$inicio])==3)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Com corrosão //TROCA
if (intval($array_peca_avaria[$inicio])==4){
	$hr_funilaria='99';$hr_pintura='99';}
//Com ferrugem
if (intval($array_peca_avaria[$inicio])==5)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='02';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='02';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='03';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='04';$hr_pintura='05';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='05';$hr_pintura='06';}
}
//Com mossa(s)
if (intval($array_peca_avaria[$inicio])==6)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Com ondulação
if (intval($array_peca_avaria[$inicio])==7)
{   
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Com Vazamento //TROCA
if (intval($array_peca_avaria[$inicio])==8)
{
	$hr_funilaria='99';$hr_pintura='99';
}
//Falta //TROCA
if (intval($array_peca_avaria[$inicio])==9){
	$hr_funilaria='99';$hr_pintura='99';}
//Mal reparado  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==10)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Rachado //TROCA
if (intval($array_peca_avaria[$inicio])==11){
	$hr_funilaria='99';$hr_pintura='99';}
//Rasgado //TROCA
if (intval($array_peca_avaria[$inicio])==12){
	$hr_funilaria='99';$hr_pintura='99';}
//Riscado
if (intval($array_peca_avaria[$inicio])==13)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Quebrado //TROCA
if (intval($array_peca_avaria[$inicio])==14){
	$hr_funilaria='99';$hr_pintura='99';}
//Queimado  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==15)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Descolorido  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==16)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Desalinhado
if (intval($array_peca_avaria[$inicio])==17)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Empenado
if (intval($array_peca_avaria[$inicio])==18)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}

if($hr_funilaria=='00' && $hr_pintura=='00'){
	$cmAvaria_funilaria=$array_peca_cm[$inicio];
	$cmAvaria_pintura=$array_peca_cm[$inicio];
	}
if($hr_funilaria!='00'){
	$cmAvaria_funilaria=$array_peca_cm[$inicio];
	}
if($hr_pintura!='00'){
	$cmAvaria_pintura=$array_peca_cm[$inicio];
	}
		
$hr_Total=$hr_funilaria+$hr_pintura;

if($array_peca_avaria[$inicio]=="1")  {$nome_avaria="Amassado";}
if($array_peca_avaria[$inicio]=="2")  {$nome_avaria="Arranhado";}
if($array_peca_avaria[$inicio]=="3")  {$nome_avaria="Com bolha";}
if($array_peca_avaria[$inicio]=="4")  {$nome_avaria="Com corrosão";}
if($array_peca_avaria[$inicio]=="5")  {$nome_avaria="Com ferrugem";}
if($array_peca_avaria[$inicio]=="6")  {$nome_avaria="Com mossas";}
if($array_peca_avaria[$inicio]=="7")  {$nome_avaria="Com ondulação";}
if($array_peca_avaria[$inicio]=="8")  {$nome_avaria="Com vazamento";}
if($array_peca_avaria[$inicio]=="9")  {$nome_avaria="Falta";}
if($array_peca_avaria[$inicio]=="10") {$nome_avaria="Mal reparado";}
if($array_peca_avaria[$inicio]=="11") {$nome_avaria="Rachado";}
if($array_peca_avaria[$inicio]=="12") {$nome_avaria="Rasagado";}
if($array_peca_avaria[$inicio]=="13") {$nome_avaria="Riscado";}
if($array_peca_avaria[$inicio]=="14") {$nome_avaria="Quebrado";}
if($array_peca_avaria[$inicio]=="15") {$nome_avaria="Queimado";}
if($array_peca_avaria[$inicio]=="16") {$nome_avaria="Descolorido";}
if($array_peca_avaria[$inicio]=="17") {$nome_avaria="Desalinhado";}
if($array_peca_avaria[$inicio]=="18") {$nome_avaria="Empenado";}

if($array_peca[$inicio]=="01") {$nome_peca="Aro de roda";}
if($array_peca[$inicio]=="02") {$nome_peca="Assoalho direito";}
if($array_peca[$inicio]=="03") {$nome_peca="Assoalho esquerdo";}
if($array_peca[$inicio]=="04") {$nome_peca="Assoalho de mala";}
if($array_peca[$inicio]=="05") {$nome_peca="Berço do estepe";}
if($array_peca[$inicio]=="06") {$nome_peca="Caixa de ar direita";}
if($array_peca[$inicio]=="07") {$nome_peca="Caixa de ar esquerda";}
if($array_peca[$inicio]=="08") {$nome_peca="Canto traseiro direito";}
if($array_peca[$inicio]=="09") {$nome_peca="Canto traseiro esquerdo";}
if($array_peca[$inicio]=="10") {$nome_peca="Capô dianteiro";}
if($array_peca[$inicio]=="11") {$nome_peca="Capô/Tampa traseira";}
if($array_peca[$inicio]=="12") {$nome_peca="Carroceria";}
if($array_peca[$inicio]=="13") {$nome_peca="Coluna dianteira direita";}
if($array_peca[$inicio]=="14") {$nome_peca="Coluna dianteira esquerda";}
if($array_peca[$inicio]=="15") {$nome_peca="Coluna traseira direita";}
if($array_peca[$inicio]=="16") {$nome_peca="Coluna traseira esquerda";}
if($array_peca[$inicio]=="17") {$nome_peca="Farol direito";}
if($array_peca[$inicio]=="18") {$nome_peca="Farol esquerdo";}
if($array_peca[$inicio]=="19") {$nome_peca="Grade";}
if($array_peca[$inicio]=="20") {$nome_peca="Lanterna dianteira direita";}
if($array_peca[$inicio]=="21") {$nome_peca="Lanterna dianteira esquerda";}
if($array_peca[$inicio]=="22") {$nome_peca="Lanterna traseira direita";}
if($array_peca[$inicio]=="23") {$nome_peca="Lanterna Traseira esquerda";}
if($array_peca[$inicio]=="24") {$nome_peca="Lateral dianteira direita";}
if($array_peca[$inicio]=="25") {$nome_peca="Lateral dianteira esquerda";}
if($array_peca[$inicio]=="26") {$nome_peca="Lateral traseira direita";}
if($array_peca[$inicio]=="27") {$nome_peca="Lateral traseira esquerda";}
if($array_peca[$inicio]=="28") {$nome_peca="Painel dianteiro inferior";}
if($array_peca[$inicio]=="29") {$nome_peca="Painel dianteiro superior";}
if($array_peca[$inicio]=="30") {$nome_peca="Painel traseiro inferior";}
if($array_peca[$inicio]=="31") {$nome_peca="Painel traseiro superior";}
if($array_peca[$inicio]=="32") {$nome_peca="Para-choque dianteiro";}
if($array_peca[$inicio]=="33") {$nome_peca="Para-choque traseiro";}
if($array_peca[$inicio]=="34") {$nome_peca="Paralama dianteiro dir.";}
if($array_peca[$inicio]=="35") {$nome_peca="Paralama dianteiro esq.";}
if($array_peca[$inicio]=="36") {$nome_peca="Paralama traseiro dir.";}
if($array_peca[$inicio]=="37") {$nome_peca="Paralama traseiro esq.";}
if($array_peca[$inicio]=="38") {$nome_peca="Porta dianteira direita";}
if($array_peca[$inicio]=="39") {$nome_peca="Porta dianteira esquerda";}
if($array_peca[$inicio]=="40") {$nome_peca="Porta traseira direita";}
if($array_peca[$inicio]=="41") {$nome_peca="Porta traseira esquerda";}
if($array_peca[$inicio]=="42") {$nome_peca="Pintura geral";}
if($array_peca[$inicio]=="43") {$nome_peca="Silencioso";}
if($array_peca[$inicio]=="44") {$nome_peca="Teto";}
if($array_peca[$inicio]=="45") {$nome_peca="Suspensão dianteira";}
if($array_peca[$inicio]=="46") {$nome_peca="Suspensão traseira";}
if($array_peca[$inicio]=="47") {$nome_peca="Vidros";}
if($array_peca[$inicio]=="48") {$nome_peca="Retrovisor direito";}
if($array_peca[$inicio]=="49") {$nome_peca="Retrovisor esquerdo";}
if($array_peca[$inicio]=="50") {$nome_peca="Teto Solar";}

				$contem_avaria++;
				$contem_item++;


				$AvariasArray.= "                        <avaria>\n";
			    $AvariasArray.= "                           <id>" . $array_peca[$inicio]. "</id>\n";
                $AvariasArray.= "                           <descPecaAvariada>". utf8_encode($nome_peca). "</descPecaAvariada>\n";
                $AvariasArray.= "                           <tipo>" .$array_peca_avaria[$inicio]. "</tipo>\n";
				$AvariasArray.= "                           <tamanho>".$array_peca_cm[$inicio]."</tamanho>\n";
      			$AvariasArray.= "                           <horasReparo>" .$hr_Total. "</horasReparo>\n";
   				$AvariasArray.= "                        </avaria>\n";
	}
$inicio++;
}


		   					//ARRUMANDO AS AVARIAS
$inicio=0;
$array_peca = explode(",",$vistoria['DSOUTRASPECAS']);
$array_peca_avaria = explode(",",$vistoria['CDOUTRASAVARIAS']);
$array_peca_cm = explode(",",$vistoria['CMPECAOUTRAS']);
while($inicio<=19)
{
	if(strlen($array_peca[$inicio])>=1)
	{
		$CDPECA.=str_pad($array_peca[$inicio], 2 , "0", STR_PAD_LEFT);

		$CDAVARIA.=str_pad($array_peca_avaria[$inicio], 2 , " ", STR_PAD_RIGHT);
		$CMPECA.=str_pad($array_peca_cm[$inicio], 3, "0", STR_PAD_LEFT);

//padrão
$hr_Total='00';
$hr_eletrica='00';
$hr_funilaria='00';
$hr_pintura='00';
$hr_tapecaria='00';
$cmAvaria_eletrica='00';
$cmAvaria_funilaria='00';
$cmAvaria_pintura='00';
$cmAvaria_tapecaria='00';

//Amassado
if (intval($array_peca_avaria[$inicio])==1)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='02';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='02';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='03';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='04';$hr_pintura='05';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='05';$hr_pintura='06';}
}
//Arranhado
if (intval($array_peca_avaria[$inicio])==2)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Com bolha
if (intval($array_peca_avaria[$inicio])==3)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Com corrosão //TROCA
if (intval($array_peca_avaria[$inicio])==4){
	$hr_funilaria='99';$hr_pintura='99';}
//Com ferrugem
if (intval($array_peca_avaria[$inicio])==5)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='02';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='02';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='03';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='04';$hr_pintura='05';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='05';$hr_pintura='06';}
}
//Com mossa(s)
if (intval($array_peca_avaria[$inicio])==6)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Com ondulação
if (intval($array_peca_avaria[$inicio])==7)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Com Vazamento //TROCA
if (intval($array_peca_avaria[$inicio])==8)
{
	$hr_funilaria='99';$hr_pintura='99';
}
//Falta //TROCA
if (intval($array_peca_avaria[$inicio])==9){
	$hr_funilaria='99';$hr_pintura='99';}
//Mal reparado  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==10)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Rachado //TROCA
if (intval($array_peca_avaria[$inicio])==11){
	$hr_funilaria='99';$hr_pintura='99';}
//Rasgado //TROCA
if (intval($array_peca_avaria[$inicio])==12){
	$hr_funilaria='99';$hr_pintura='99';}
//Riscado
if (intval($array_peca_avaria[$inicio])==13)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Quebrado //TROCA
if (intval($array_peca_avaria[$inicio])==14){
	$hr_funilaria='99';$hr_pintura='99';}
//Queimado  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==15)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Descolorido  UTILIZANDO COMO IRREGULAR
if (intval($array_peca_avaria[$inicio])==16)
{
	if($array_peca_cm[$inicio]<=10){$hr_funilaria='00';$hr_pintura='01';}
	if($array_peca_cm[$inicio]>=11&&$array_peca_cm[$inicio]<=20){$hr_funilaria='00';$hr_pintura='02';}
	if($array_peca_cm[$inicio]>=21&&$array_peca_cm[$inicio]<=40){$hr_funilaria='00';$hr_pintura='03';}
	if($array_peca_cm[$inicio]>=41&&$array_peca_cm[$inicio]<=80){$hr_funilaria='00';$hr_pintura='04';}
	if($array_peca_cm[$inicio]>=81){$hr_funilaria='00';$hr_pintura='06';}
}
//Desalinhado
if (intval($array_peca_avaria[$inicio])==17)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}
//Empenado
if (intval($array_peca_avaria[$inicio])==18)
{
	if($array_peca_cm[$inicio]<=5){$hr_funilaria='00';$hr_pintura='00';}
}

if($hr_funilaria=='00' && $hr_pintura=='00'){
	$cmAvaria_funilaria=$array_peca_cm[$inicio];
	$cmAvaria_pintura=$array_peca_cm[$inicio];
	}
if($hr_funilaria!='00'){
	$cmAvaria_funilaria=$array_peca_cm[$inicio];
	}
if($hr_pintura!='00'){
	$cmAvaria_pintura=$array_peca_cm[$inicio];
	}


if($array_peca_avaria[$inicio]=="1")  {$nome_avaria="Amassado";}
if($array_peca_avaria[$inicio]=="2")  {$nome_avaria="Arranhado";}
if($array_peca_avaria[$inicio]=="3")  {$nome_avaria="Com bolha";}
if($array_peca_avaria[$inicio]=="4")  {$nome_avaria="Com corrosão";}
if($array_peca_avaria[$inicio]=="5")  {$nome_avaria="Com ferrugem";}
if($array_peca_avaria[$inicio]=="6")  {$nome_avaria="Com mossas";}
if($array_peca_avaria[$inicio]=="7")  {$nome_avaria="Com ondulação";}
if($array_peca_avaria[$inicio]=="8")  {$nome_avaria="Com vazamento";}
if($array_peca_avaria[$inicio]=="9")  {$nome_avaria="Falta";}
if($array_peca_avaria[$inicio]=="10") {$nome_avaria="Mal reparado";}
if($array_peca_avaria[$inicio]=="11") {$nome_avaria="Rachado";}
if($array_peca_avaria[$inicio]=="12") {$nome_avaria="Rasagado";}
if($array_peca_avaria[$inicio]=="13") {$nome_avaria="Riscado";}
if($array_peca_avaria[$inicio]=="14") {$nome_avaria="Quebrado";}
if($array_peca_avaria[$inicio]=="15") {$nome_avaria="Queimado";}
if($array_peca_avaria[$inicio]=="16") {$nome_avaria="Descolorido";}
if($array_peca_avaria[$inicio]=="17") {$nome_avaria="Desalinhado";}
if($array_peca_avaria[$inicio]=="18") {$nome_avaria="Empenado";}

				$contem_avaria++;
				$contem_item++;

		
		$AvariasArray.= "                        <avaria>\n";
			    $AvariasArray.= "                           <id>9" . $inicio. "</id>\n";
                $AvariasArray.= "                           <descPecaAvariada>". utf8_encode($nome_peca). "</descPecaAvariada>\n";
                $AvariasArray.= "                           <tipo>" .$array_peca_avaria[$inicio]. "</tipo>\n";
				$AvariasArray.= "                           <tamanho>".$array_peca_cm[$inicio]."</tamanho>\n";
      			$AvariasArray.= "                           <horasReparo>" .$hr_Total. "</horasReparo>\n";
   				$AvariasArray.= "                        </avaria>\n";  

	}
$inicio++;
}
					  		              if($contem_ava==1){$AvariasArray.= "                     </avarias>\n";}

		
##############################################################################################################

##############################################################################################################
##########################                 ARRAY DE EQUIPAMRNTOS               ###############################
##############################################################################################################

		              if($contem_eq==1){$EquipamentosArray.= "                        <equipamentos>\n";}

	$inicio =0;
			  $contem_equipamento=0;
			  $contem_item = 0;
			  $array_equipamento = explode(",",$vistoria['CDEQUIPAMENTO']);
			  while($inicio<=30)
			  {
			  	if(intval($array_equipamento[$inicio])>=1)
				{
if($array_equipamento[$inicio]=="1"){$nome_equipamento="Guincho";}
if($array_equipamento[$inicio]=="2"){$nome_equipamento="Unidade frigorífica (termoking)";}
if($array_equipamento[$inicio]=="3"){$nome_equipamento="Plataforma elevatório";}
if($array_equipamento[$inicio]=="4"){$nome_equipamento="Escavadeira";}
if($array_equipamento[$inicio]=="5"){$nome_equipamento="Perfuradeira";}
if($array_equipamento[$inicio]=="6"){$nome_equipamento="Betoneira";}
if($array_equipamento[$inicio]=="7"){$nome_equipamento="Munch";}
if($array_equipamento[$inicio]=="8"){$nome_equipamento="Capota de Fibra";}

				$contem_equipamento++;
				$contem_item++;

				$EquipamentosArray.= "                        <equipamento>\n";
				$EquipamentosArray.= "                           <codigo>" . $array_equipamento[$inicio] . "</codigo>\n";
				$EquipamentosArray.= "                           <tipo/>\n";
				$EquipamentosArray.= "                           <marca/>\n";
				$EquipamentosArray.= "                           <quantidade>0</quantidade>\n";
				$EquipamentosArray.= "                        </equipamento>\n";
				}
			  $inicio++;
			  }
								if($contem_eq==1){$EquipamentosArray.= "                        </equipamentos>\n";}

##############################################################################################################


########################################################################################################
#############################           ARRAY DE FOTOS                  ################################
########################################################################################################

       $FotosArray.= "                     <arquivos>\n";


		$sql_fotos = "SELECT DISTINCT fotos, data FROM ".$bancoDados.".fotos WHERE id = " . $_GET['id'] . " order by contagem asc";
		$resultado_fotos = mysql_query($sql_fotos,$db);

         
		if(mysql_num_rows($resultado_fotos))        
		  {
		    $count = 1;
			//joga resultado da consulta em $fotos
			while ($fotos = mysql_fetch_assoc($resultado_fotos))
			  {
				  
				  $fotosEnviar.=$fotos['fotos'].",";

		        	$FotosArray.= "                        <arquivo>\n";
                    $FotosArray.= "                           <id>" . $count . "</id>\n";
                    $FotosArray.= "                           <nome>" . $fotos['fotos'] . "</nome>\n";
				  	$FotosArray.= "                           <tipo>I</tipo>\n";
				    $FotosArray.= "                        </arquivo>\n";
         
                    //if($_GET["debug"]==true)echo $fotoAtual . "\n\n<br>";
				  
				  $count++;
                  
              }//fim while das fotos


         }

		  $FotosArray .=  "                     </arquivos>\n";
	 //final fotos


$VISTORIADOR=utf8_encode($prestador['nome']);

$codigoCorretor=$solicitacao['cd_corretor'];

    
if($extra['centro_custo']=='S'){
	
$dataKitGas=substr($extra['nome_centro_custo'],0,4).'-'.substr($extra['nome_centro_custo'],4,2).'-'.substr($extra['nome_centro_custo'],6,2).'T00:00:00';		

	$kitGas='<kitGas>
                  <validade>'.$dataKitGas.'</validade>
               </kitGas>';
	}else{
		$kitGas='';
		}

if($extra['veiculo_blindado']=='S'){
	$blindagem='<blindagem>
                  <tipo>'.$extra['outra_restricao'].'</tipo>
               </blindagem>';
	}else{
		$blindagem='';
		}

switch($vistoria['TPPINTURA']){   
	case '1': $tipoPintura='S'; break;
	case '2': $tipoPintura='M'; break;
	case '3': $tipoPintura='P'; break;
	default: break;
}

if($vistoria['TPCARROC']==''){
	$carroceria=999;
	}else{
		$carroceria=$vistoria['TPCARROC'];
		}  

if($reg['CDDESTVEIC']=='10' || $reg['CDDESTVEIC']=='11' || $reg['CDDESTVEIC']=='14' || $reg['CDDESTVEIC']=='17'){
	$dadosCaminhao='<caminhao>
               <tipoCabine>'.$extra['tipo_cabine'].'</tipoCabine>
               <tipoCarga>'.$extra['tipo_carga'].'</tipoCarga>
               <numeroCarroceria>'.$vistoria['NRCARROC'].'</numeroCarroceria>
            </caminhao>';
	}else{
		$dadosCaminhao='';
			}


$horaCriacao=str_pad($solicitacao['hora_criacao'], 4, "0", STR_PAD_LEFT); 

$dataAgendamento=substr($solicitacao['dia'],0,4).'-'.substr($solicitacao['dia'],4,2).'-'.substr($solicitacao['dia'],6,2).'T'.substr($horaCriacao,0,2).':'.substr($horaCriacao,2,2).':00Z';

$dataRealizacao=substr($vistoria['DTVISTORIA'],0,4).'-'.substr($vistoria['DTVISTORIA'],4,2).'-'.substr($vistoria['DTVISTORIA'],6,2).'T'.substr($vistoria['HRVISTORIA'],0,2).':'.substr($vistoria['HRVISTORIA'],2,2).':00Z';




$dia=date('d');
$mes=date('m');
$ano=date('Y');
$prazo=365;          


if($vistoria['extintor']=='A'){
$dataCalc= date('Y-m-d', mktime(0,0,0, $mes, $dia + $prazo, $ano)); 	
$dataExtintor=$dataCalc.'T00:00:00Z';
}else{
	$dataCalc= date('Y-m-d', mktime(0,0,0, $mes, $dia - $prazo, $ano)); 	
	$dataExtintor=$dataCalc.'T00:00:00Z';
	
	}


############################### ENVIO DE FOTOS - SFTP ######################################

global $host;
global $username;
global $password;
global $port;
global $dir;
global $debug;
	
$host = $enderecoSFTP;
$username = $idUsuarioSFTP;
$password = $senhaSFTP;
$port = "115";
$dir  = "/";
$debug = "";


	if($_GET["debug"]) print_r($db);
    if($_GET["debug"]) print_r($array_nomes_fotos);

    // Create connection the the remote host
	$conn = ssh2_connect($host, $port);
	ssh2_auth_password($conn, $username, $password);

	// Create SFTP session
	$sftp = ssh2_sftp($conn);

	$array_nomes_fotos = explode(",",$fotosEnviar);
	for( $i=0, reset($array_nomes_fotos); current($array_nomes_fotos); $i++, next($array_nomes_fotos) )
      { //print_r($db);
        $sqlFoto = "SELECT * FROM ".$bancoDados.".fotos WHERE id = " . $_GET["id"] . " AND fotos = '" . current($array_nomes_fotos) . "'";
        $resultadoFotos = @mysql_query($sqlFoto, $db);
        $vetorFotos = @mysql_fetch_assoc($resultadoFotos);
		if($_GET["debug"]) echo "<br><br>\n\n";
        if($_GET["debug"]) var_dump($vetorFotos);

		//../../PHOTOS/rot_123/MITSUI/2012/03/13/15800591/15800591_1.jpg 
        $arquivoFoto = "/var/www/html/sistema/PHOTOS/rot_" . $_SESSION["roteirizador"] . "/SANCOR/" . substr($vetorFotos["data"], 0, 4) . "/" . substr($vetorFotos["data"], 4, 2) . "/" . substr($vetorFotos["data"], 6, 2) . "/" . $vetorFotos["id"] . "/" . $vetorFotos["fotos"];
		
		if(!file_exists($arquivoFoto)){
		// DIRETORIO CLOUD
			$arquivoFoto = "/var/www/html/sistema/cloud/PHOTOS/rot_" . $_SESSION["roteirizador"] . "/SANCOR/" . substr($vetorFotos["data"], 0, 4) . "/" . substr($vetorFotos["data"], 4, 2) . "/" . substr($vetorFotos["data"], 6, 2) . "/" . $vetorFotos["id"] . "/" . $vetorFotos["fotos"];					
			}
		
		$url=strtr($arquivoFoto,array("/var/www/html"=>""));
            // echo $url . "\n<br>";
      
		if($_GET["debug"]) echo "\n\n<br>Arquivo: " . $arquivo . "\n<br>";
	    //nome que o arquivo aparecerá no ftp deles, se quizer jogar em uma pasta basta concatenar
	    $nome_arquivo= strtoupper($array_nomes_fotos[$i]);
	    // Envia o arquivo pelo FTP em modo FTP_ASCII , FTP_BINARY
	   // $envio = @ftp_put($ftp, $nome_arquivo, $arquivo, FTP_BINARY); // Retorno: true / false
				

		$srcFile = $arquivoFoto;
		$dstFile = '/incoming/'.$vetorFotos["fotos"];


		$sftpStream = fopen('ssh2.sftp://'.$sftp.$dstFile, 'w');
		  
		try {
			if (!$sftpStream) {
				throw new Exception("Could not open remote file: $dstFile");
			}
			
			$data_to_send = file_get_contents_curl($url); 
		
			if ($data_to_send === false) {
				throw new Exception("Could not open local file: $srcFile.");
			}

			if (fwrite($sftpStream, $data_to_send) === false) {
				throw new Exception("Could not send data from file: $srcFile.");
			}

			fclose($sftpStream);

		} catch (Exception $e) {
			error_log('Exception: ' . $e->getMessage());
			fclose($sftpStream);
		}

		  

		  
		
		####################################################################################


	  }


############################################################################################


########################################### GET TOKEN ########################################

$xml_getToken='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:req="http://gruposancorseguros.com/ents/SOI/SecuritySvc/GetToken/request">
   <soapenv:Header></soapenv:Header>
   <soapenv:Body>
      <req:getToken>
         <Credentials>
            <User>'.$idUsuarioWS.'</User>
            <Password>'.$senhaWS.'</Password>
            <System>SancorBrasilInsuranceCore</System>
            <Connection>SancorBrasilExternalProviders</Connection>
         </Credentials>
      </req:getToken>
   </soapenv:Body>
</soapenv:Envelope>';

$homologacaoWSDL="https://external-pre-ws.gruposancorseguros.com/Gss/Channel/SecuritySvc";
$producaoWSDL="";

$ponteiroToken = curl_init();
  
  curl_setopt($ponteiroToken, CURLOPT_URL, $homologacaoWSDL );
  curl_setopt($ponteiroToken, CURLOPT_USERAGENT,        'Modulo WSSancor vtnet.com.br');
  curl_setopt($ponteiroToken, CURLOPT_HEADER,           false);
  curl_setopt($ponteiroToken, CURLOPT_CONNECTTIMEOUT,   60);
  curl_setopt($ponteiroToken, CURLOPT_TIMEOUT,          60);
  curl_setopt($ponteiroToken, CURLOPT_RETURNTRANSFER,   true );
  curl_setopt($ponteiroToken, CURLOPT_SSL_VERIFYPEER,   false);
  curl_setopt($ponteiroToken, CURLOPT_SSL_VERIFYHOST,   false);
  curl_setopt($ponteiroToken, CURLOPT_POST,             true );
  curl_setopt($ponteiroToken, CURLOPT_POSTFIELDS,       $xml_getToken);
  curl_setopt($ponteiroToken, CURLOPT_HTTPHEADER,       array("SOAPAction: \"\""));
  
  if(!($respostaToken = curl_exec($ponteiroToken)))
    {
      print("ERROR: curl_exec - (" . curl_errno($ponteiroToken) . ") " . curl_error($ponteiroToken));
    }
	
	echo '<div style:background="#FFF">';
	echo "<center><h1>Resposta do GetToken</h1></center><br>";
	curl_close($ponteiroToken);


preg_match('/<IdToken>([^|]{1,})<\/IdToken>/i', $respostaToken, $resultado);
$tokenID=$resultado[1]; 

/*
if($_SESSION['id']==1 || $_SESSION['roteirizador']==123){   
echo "<textarea cols=\"100\" rows=\"50\">" . $tokenID . "</textarea> ";
	exit();
}
  */

########################################################################################################

$xmlLaudo='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:init="http://gruposancorseguros.com/Ssb/Policy/Services/Operations/InitialInspectionExternalService">
   <soapenv:Header>
      <init:requestHeader>
         <userId>
            <userName>'.$idUsuarioWS.'</userName>
            <userToken>'.$tokenID.'</userToken>
         </userId>
		 <provider>
            <id>'.$cnpjEmpresa.'</id>
         </provider>
      </init:requestHeader>
   </soapenv:Header>
   <soapenv:Body>
      <init:AtualizaVistoria>
         <fornecedor>
            <codigo>'.$codigoEmpresa.'</codigo>
         </fornecedor>
         <proposta>
            <numero>'.$proposta.'</numero>
            <protocolo>'.$protocolo.'</protocolo>
         </proposta>
         <vistoria>
            <parecer>
               <divergencia>false</divergencia>
               <status>'.$vistoria['CDRESSALVA'].'</status>
            </parecer>
            <vistoriador>
               <cpf>'.$prestador['cpf'].'</cpf>
               <nome>'.$prestador['nome'].'</nome>
            </vistoriador>
            <veiculo>
               <fipe>'.$vistoria['CDVEICULO'].'</fipe>
               <placa>'.$vistoria['NRPLACA'].'</placa>
               <anoFabricacao>'.$vistoria['NRANOFABRICACAO'].'</anoFabricacao>
               <anoModelo>'.$vistoria['NRANOMOD'].'</anoModelo>
               <marca>'.$vistoria['NMFABRICANTE'].'</marca>
               <modelo>'.$vistoria['NMVEICULO'].'</modelo>
               <renavam>'.$vistoria['NRRENAVAM'].'</renavam>
               <tipo>'.str_pad($vistoria['CDDESTVEIC'], 2, "0", STR_PAD_LEFT).'</tipo>
               <categoriaTarifaria>'.$vistoria['CDUSOVEICULO'].'</categoriaTarifaria>
               <categoria>'.$extra['situacao_placa'].'</categoria>
               <kmRodados>'.$vistoria['KMVEICULO'].'</kmRodados>
               <chassi>
                  <condicao>'.$extra['Codigo_Condicao_Chassi'].'</condicao>
                  <numero>'.$vistoria['NRCHASSI'].'</numero>
               </chassi>
               <motor>
                  <condicao>'.$extra['condicao_numero_motor'].'</condicao>
                  <cilindradas>'.$extra['cilindros'].'</cilindradas>
                  <numero>'.$vistoria['NRMOTOR'].'</numero>
                  <numeroBombaInjetora>0</numeroBombaInjetora>
               </motor>
               <combustivel>'.$vistoria['TPCOMBUSTIVEL'].'</combustivel>
               '.$kitGas.'
               '.$blindagem.'
               <carroceria>'.$carroceria.'</carroceria>
               <tipoCambio>'.$extra['Cambio'].'</tipoCambio>
               <pneus>
                  <condicao>'.$vistoria['pneus'].'</condicao>
               </pneus>
               <extintor>
                  <condicao>'.$vistoria['extintor'].'</condicao>
                  <validade>'.$dataExtintor.'</validade>
               </extintor>
               <etiquetas>
                  <etiquetaChassi>'.$assoalho.'</etiquetaChassi>
                  <etiquetaMotor>'.$motor.'</etiquetaMotor>
                  <etiquetaPlaqueta>'.$porta.'</etiquetaPlaqueta>
               </etiquetas>
               <alienado>'.$alienado.'</alienado>
               <transformado>'.$transformado.'</transformado>
               <pintura>
                  <tipo>'.$tipoPintura.'</tipo>
                  <corPredominante>'.$cor.'</corPredominante>
               </pintura>
               <dut>'.$numero_dut.'</dut>
               <marchas>'.$extra['marchas'].'</marchas>
               <portas>'.$vistoria['NRPORTAS'].'</portas>
            </veiculo>
            '.$AcessoriosArray.'
            '.$EquipamentosArray.'
            '.$dadosCaminhao.'
			'.$AvariasArray.'
            '.$FotosArray.'
         </vistoria>
         <agendamento>
            <status>R</status>
            <dataHoraAgendada>'.$dataAgendamento.'</dataHoraAgendada>
            <dataHoraRealizada>'.$dataRealizacao.'</dataHoraRealizada>
         </agendamento>
      </init:AtualizaVistoria>
   </soapenv:Body>
</soapenv:Envelope>';


if($_GET['debug']==true){
echo "<textarea cols=\"100\" rows=\"50\">" . utf8_decode($xmlLaudo) . "</textarea> ";
exit();
}

if($_GET['baixar']==true){
header('Content-type: application/xml');

header('Content-Disposition: attachment; filename="'.$solicitacao["id"].'-'.$proposta_audatex.'.xml"');

echo utf8_decode($xmlLaudo);

exit(0);
	}

/*
if($_SESSION['id']==1 || $_SESSION['roteirizador']==123){   
echo "<textarea cols=\"100\" rows=\"50\">" . $xmlLaudo . "</textarea> ";
	exit();
}
  */

$homologacaoWSDL="https://external-pre-ws.gruposancorseguros.com/Ssb/Policy/Services/Operations/InitialInspectionExternalService";   
$producaoWSDL="";


//FAZ A CONEXÃO COM O WEBSERVICE


  $ponteiro = curl_init();
  curl_setopt($ponteiro, CURLOPT_URL, $homologacaoWSDL);
  curl_setopt($ponteiro, CURLOPT_USERAGENT,        'Modulo WSSancor vtnet.com.br');
  curl_setopt($ponteiro, CURLOPT_HEADER,           false);
  curl_setopt($ponteiro, CURLOPT_CONNECTTIMEOUT,   60);
  curl_setopt($ponteiro, CURLOPT_TIMEOUT,          60);
  curl_setopt($ponteiro, CURLOPT_RETURNTRANSFER,   true );
  curl_setopt($ponteiro, CURLOPT_SSL_VERIFYPEER,   false);
  curl_setopt($ponteiro, CURLOPT_SSL_VERIFYHOST,   false);
  curl_setopt($ponteiro, CURLOPT_POST,             true );
  curl_setopt($ponteiro, CURLOPT_POSTFIELDS,       $xmlLaudo);
  curl_setopt($ponteiro, CURLOPT_HTTPHEADER,       array("SOAPAction: \"\""));


	
  if(!($resposta = curl_exec($ponteiro)))
    {
      print("ERROR: curl_exec - (" . curl_errno($ponteiro) . ") " . curl_error($ponteiro));
    }
  else
    {
	  curl_close($ponteiro);
	}


@mkdir($vistoria['roteirizador'],0777);
@mkdir($vistoria['roteirizador'].'/retornoSancor',0777);
@mkdir($vistoria['roteirizador'].'/retornoSancor/'.date('Y'),0777);
@mkdir($vistoria['roteirizador'].'/retornoSancor/'.date('Y').'/'.date('m'),0777);
@mkdir($vistoria['roteirizador'].'/retornoSancor/'.date('Y').'/'.date('m').'/'.date('d'),0777);

$nomeArquivoXML=date('Hisu').'_'.$vistoria['NUMEROSOLICITACAO'].'.xml';		
$arquivo = $vistoria['roteirizador'].'/retornoSancor/'.date('Y').'/'.date('m').'/'.date('d').'/'.$nomeArquivoXML;
$arquivoDB = 'laudo/xml_sancor/'.$vistoria['roteirizador'].'/retornoSancor/'.date('Y').'/'.date('m').'/'.date('d').'/'.$nomeArquivoXML;

if (!$abrir = fopen($arquivo, "a")) {
			echo  "Erro abrindo arquivo ($arquivo)";
			exit;
}
if (!fwrite($abrir, $resposta)) 
			{
		        print "Erro escrevendo no arquivo ($arquivo)";
		        exit;
		    }
fclose($abrir);


$xml_parser = xml_parser_create();
if (!($fp2 = fopen($arquivo, "r"))) {}
$data = fread($fp2, filesize($arquivo));
fclose($fp2);


preg_match('/\<errorCode\>([^|]{1,})\<\/errorCode\>/i', $data, $result);
$errorCode=$result[1];

preg_match('/\<errorType\>([^|]{1,})\<\/errorType\>/i', $data, $result);
$errorType=$result[1];

preg_match('/\<errorDesc\>([^|]{1,})\<\/errorDesc\>/i', $data, $result);
$errorDesc=$result[1];


//echo $errorCode."<br>";
//echo $errorType."<br>";
//echo $errorDesc."<br>";

/*
if($_SESSION['id']==1 || $_SESSION['roteirizador']==123){   
echo "<textarea cols=\"100\" rows=\"50\">" . $resposta . "</textarea> ";
	exit();
}
*/

/*
if($_SESSION['id']==1 || $_SESSION['roteirizador']==123 ){
echo "<textarea cols=\"100\" rows=\"50\">" . $resposta . "</textarea> ";
exit();
}
*/

	//quantidade de vezes que a vistoria foi enviada a seguradora
	$quantidade_vezes_envio = intval($vistoria[checado])+1;

	//atualizando data das transmissões
	$datas_transmissoes  = $vistoria[datas_transmissoes].''.date("Ymd").',';


	//se a vistoria esta sendo enviada pela primeira vez modifica a data de transmissão
	if( ($vistoria[checado]=='') && ($vistoria[DTTRANS]==0) )
	{
	$transmissao = "
	datas_transmissoes = '".$datas_transmissoes."',
	hora_trans = '".date("Hi")."',
	DTTRANS = '".date("Ymd")."'";
}
else
{
	$transmissao = "
	datas_transmissoes = '".$datas_transmissoes."',
	hora_retrans = '".date("Hi")."'";
}

	//atualizando vistoria para indicar que ela foi enviada a seguradora
	$sql_atualiza_vistoria = "UPDATE ".$bancoDados.".vistoria_previa1 SET
	checado = '".$quantidade_vezes_envio."',
	status = '2',
	".$transmissao." WHERE NUMEROSOLICITACAO = ".$vistoria[NUMEROSOLICITACAO]."";
	$result_atualiza_vistoria = mysql_query($sql_atualiza_vistoria,$db);


$stop = array_sum(explode(' ', microtime()));
$totalTime = $stop - $start;


if($errorCode==''){
		$cor='green';
		$imagem="sucesso";
		$tipo_resposta="VISTORIA RECEPCIONADA COM SUCESSO!";
	

		$sql_atualiza_status = "UPDATE ".$bancoDados.".vistoria_previa1 SET
		status_trans = '4####' WHERE NUMEROSOLICITACAO = ".$_GET['id']."";
		$result_atualiza_status = mysql_query($sql_atualiza_status,$db);

		$sql_feedback = "SELECT nome_arquivo FROM ".$bancoDados.".controle_vp_transmissao WHERE numero_solicitacao = ".$_GET['id']."";
		$result_feedback = @mysql_query($sql_feedback,$db);
	 	if (@mysql_num_rows($result_feedback)>0)
	 	{
		$resultado10 = mysql_fetch_array($result_feedback);		
		$sql_feed = "UPDATE ".$bancoDados.".controle_vp_transmissao SET
		feedback = '".$tipo_resposta."',nome_arquivo='".$resultado10['nome_arquivo'].$arquivoDB.",' WHERE numero_solicitacao = ".$_GET['id']."";
		$result_feed = mysql_query($sql_feed,$db);
		}
		else
		{
		$sql_feed = "INSERT INTO ".$bancoDados.".controle_vp_transmissao (feedback,roteirizador,nome_arquivo,numero_solicitacao)
		VALUES (
		'".$tipo_resposta."',
		'".$vistoria['roteirizador']."',
		'".$arquivoDB.",',
		".$_GET['id'].")";
		$result_feed = mysql_query($sql_feed,$db);
		}

	}
else{
		
		
		
		$cor = 'red';
		$imagem="erro";
		$tipo_resposta='Codigo erro-> '.$errorCode.'<br/>Tipo erro -> '.$errorType.'<br/>Descrição erro -> '.$errorDesc;
			
		$sql_atualiza_status = "UPDATE ".$bancoDados.".vistoria_previa1 SET	status_trans = '5####' WHERE NUMEROSOLICITACAO = ".$_GET['id']."";
		$result_atualiza_status = mysql_query($sql_atualiza_status,$db);

		$sql_feedback = "SELECT nome_arquivo FROM ".$bancoDados.".controle_vp_transmissao WHERE numero_solicitacao = ".$_GET['id']."";
		$result_feedback = @mysql_query($sql_feedback,$db);
	 	if (@mysql_num_rows($result_feedback)>0)
	 	{ //echo "if";
		$resultado10 = mysql_fetch_array($result_feedback);	
		$sql_feed = "UPDATE ".$bancoDados.".controle_vp_transmissao SET
		feedback = '".$tipo_resposta."',nome_arquivo='".$resultado10['nome_arquivo'].$arquivoDB.",' WHERE numero_solicitacao = ".$_GET['id']."";
		//echo "<br>$sql_feed<br>";
		$result_feed = mysql_query($sql_feed,$db);
		}
		else
		{ //echo "else";
		$sql_feed = "INSERT INTO ".$bancoDados.".controle_vp_transmissao (feedback,roteirizador,nome_arquivo,numero_solicitacao)
		VALUES (
		'".$tipo_resposta."',
		'".$vistoria['roteirizador']."',
		'".$arquivoDB.",',
		".$_GET['id'].")";
		//echo "<br>$sql_feed<br>";
		$result_feed = mysql_query($sql_feed,$db);
		}

	}



//echo $errorCode."<br>";
//echo $errorType."<br>";
//echo $errorDesc."<br>";

echo '<div style:background="#FFF">';
echo '<br/><br/><br/><br/><br/>
<table width="100%"  bgcolor="'.$cor.'" border="0">
	<tr>
		<td width="312">&nbsp;</td>
		<td width="62"><span class="letra"><strong>PLACA:</strong></span></td>
		<td width="257"><p class="letra"><strong>'.strtoupper($vistoria['NRPLACA']).'</strong></p></td>
		<td width="66"><span class="letra"><strong>CHASSI:</strong></span></td>
		<td width="413"><span class="letra"><strong>'.strtoupper($vistoria['NRCHASSI']).'</strong></span></td>
	</tr>
</table>';
echo '<table width="100%" border="0">
		<tr>
			<td><center><img src="../../imagens/'.$imagem.'.png"  /></center></td>
		</tr>
		<tr>
			<td><center><span>RESULTADO: '.$tipo_resposta.'</span></center></td>
		</tr>
		<tr>
			<td><center>Tempo total da requisi&ccedil;&atilde;o: '.substr($totalTime,0,6).' Segundos</center></td>
		</tr>
	   </table>	';
echo '</div>';

if(base64_decode($_GET['mobile'])=='sim')
	{
	return 0;
	}else
		{

			$nrSolicitacao=$_GET['id'];
			include "/var/www/html/sistema/laudo/realizada_email2.php";
	
			/*$emailRealizada=caminho."sistema/laudo/realizada_email.php?id=".$_GET['id']."&requisitor=php&db=".base64_encode($bancoDados);
			$ch12 = curl_init();
			define('EMAIL_REALIZADA', $emailRealizada);
			curl_setopt($ch12, CURLOPT_URL, EMAIL_REALIZADA);
			curl_setopt($ch12, CURLOPT_RETURNTRANSFER, true);
			$result12 = curl_exec($ch12);*/
			
	
		}

	
	 ?>
	 
<?
mysql_close();
?>

