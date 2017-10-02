<?
include "../../adm/conecta.php";
include "../verifica.php";
include "../verifica_roteirizador.php";
if ($_POST[tipo]=='txt'){
?><?

$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};
//print_r ($_POST[controle_bac]);

if($_POST[controle_bac]!=='TODOS')
	{
		$controle_bac = "AND CEPVISTORIA = $_POST[controle_bac]";
	}
	else
	{
		$controle_bac = '';
	}
		//selecionando nome do BAC
	$sql_bacnome = "SELECT nome_posto FROM ".$bancoDados.".contro_vp_posto WHERE cep = ".$_POST[controle_bac];
	$result_bacnome = mysql_query($sql_bacnome,$db);
	$bacnome= mysql_fetch_array($result_bacnome);
	//print_r ($sql_bacnome);
	//print_r ($bacnome['nome_posto']);	

$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '0'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);

$sql_fatcom ="SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." ".$controle_bac." AND DTTRANS >1 AND TPVISTORIA='P'";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	if (mysql_num_rows($result_fatcom)>0)
	{
		while ($reg= mysql_fetch_array($result_fatcom))
		{
		
	$sql_prest = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$reg[controle_prest].""; 
	$result_prest = mysql_query($sql_prest,$db);
	$prest = mysql_fetch_array($result_prest);
	
	//selecionando a filial para pegar a regiao correta
	$sql_filial = "SELECT * FROM ".$bancoDados.".controle_vp_filial WHERE codigo_filial = '".$prest[filial]."' AND roteirizador = ".$reg[roteirizador]."";
	$result_filial = mysql_query($sql_filial,$db);
	$prestador_filial = mysql_fetch_array($result_filial);
	
	$CDFILIAL = str_pad($prestador_filial[codigo_filial], 4, "0", STR_PAD_LEFT);
	$UF = trim($prestador_filial[uf]);
	
	//selecionando a filial para pegar a regiao correta
$sql_preco = "SELECT * FROM ".$bancoDados.".controle_vp_preco_seguradora WHERE filial_id = ".$prestador_filial[id]." AND seguradora = '0' AND roteirizador = ".$reg[roteirizador]."";
	$result_preco = @mysql_query($sql_preco,$db);
	$preco = @mysql_fetch_array($result_preco);
	
	$PRECOVISTORIA = str_pad(str_replace(".",",",$preco[preco_vistoria]), 8 , "0", STR_PAD_LEFT);
	$MES = str_pad($data_inicial1{2}.$data_inicial1{3}, 2, "0", STR_PAD_LEFT);
	$NRVISTORIA = str_pad($reg["NRVISTORIA"], 10, "000000", STR_PAD_LEFT);
	$DVVISTORIA =  "0000";	
    if($reg["CDSUCURSAL"]==""){$CDSUCURSAL="002";}else{$CDSUCURSAL=str_pad($reg["CDSUCURSAL"], 3); }
	$NMCORRETOR = str_pad($reg["NMCORRETOR"], 40);
	$DTVISTORIA = $reg["DTVISTORIA"]{6}.$reg["DTVISTORIA"]{7}.$reg["DTVISTORIA"]{4}.$reg["DTVISTORIA"]{5}.$reg["DTVISTORIA"]{0}.$reg["DTVISTORIA"]{1}.$reg["DTVISTORIA"]{2}.$reg["DTVISTORIA"]{3};
	$DTPROC = $reg["DTPROC"]{6}.$reg["DTPROC"]{7}.$reg["DTPROC"]{4}.$reg["DTPROC"]{5}.$reg["DTPROC"]{0}.$reg["DTPROC"]{1}.$reg["DTPROC"]{2}.$reg["DTPROC"]{3};
	$DTTRANS = $reg["DTTRANS"]{6}.$reg["DTTRANS"]{7}.$reg["DTTRANS"]{4}.$reg["DTTRANS"]{5}.$reg["DTTRANS"]{0}.$reg["DTTRANS"]{1}.$reg["DTTRANS"]{2}.$reg["DTTRANS"]{3};
	$TPVISTORIA = $reg["TPVISTORIA"];
	 if ($reg["CDFINALIDADE"]=='01'){ $CDFINALIDADE = "Novo (previa)         ";}
     if ($reg["CDFINALIDADE"]=='02'){ $CDFINALIDADE = "Reducao franquia      ";}
     if ($reg["CDFINALIDADE"]=='03'){ $CDFINALIDADE = "Parcela em atraso     ";}
     if ($reg["CDFINALIDADE"]=='04'){ $CDFINALIDADE = "Substituicao          ";}
     if ($reg["CDFINALIDADE"]=='05'){ $CDFINALIDADE = "Renovacao             ";}
     if ($reg["CDFINALIDADE"]=='06'){ $CDFINALIDADE = "Inclusao acessorios   ";}
     if ($reg["CDFINALIDADE"]=='07'){ $CDFINALIDADE = "Exclusao de avarias   ";}
     if ($reg["CDFINALIDADE"]=='08'){ $CDFINALIDADE = "Autoseg               ";}
     if ($reg["CDFINALIDADE"]=='09'){ $CDFINALIDADE = "Consorcio             ";}
     if ($reg["CDFINALIDADE"]=='10'){ $CDFINALIDADE = "Vistoria Especial     ";}
     if ($reg["CDFINALIDADE"]=='11'){ $CDFINALIDADE = "Incl. de Cla. de Vidro";}
     if ($reg["CDFINALIDADE"]=='99'){ $CDFINALIDADE = "Outros                ";}
	$NMPROPONENTE = str_pad(substr($reg["NMPROPONENTE"], 0, 40), 40);
	$NRPLACA = str_pad($reg["NRPLACA"], 7, "0", STR_PAD_LEFT);
	$chassi1 = str_replace(".","",$reg["NRCHASSI"]);
	$chassi = str_replace("|","",$chassi1);
	$NRCHASSI =  str_pad($chassi, 22 );
	$DSMUNICIPIOVISTORIA = str_pad(substr($reg["DSMUNICIPIOVISTORIA"], 0, 20), 20 );
	$CEPVISTORIA = str_pad($reg["CEPVISTORIA"], 8 );
	$CDCORRETORSUSEP = str_pad($reg["CDCORRETORSUSEP"], 14 );
	
	//PREPARA O CONTEÚDO A SER GRAVADO  
	$conteudo	= "$MES$VISTORIADORA$CDFILIAL$NRVISTORIA$DVVISTORIA$CDSUCURSAL$NMCORRETOR$DTVISTORIA$DTPROC$DTTRANS$TPVISTORIA$CDFINALIDADE$NMPROPONENTE$NRPLACA$NRCHASSI$DSMUNICIPIOVISTORIA$CEPVISTORIA$CDCORRETORSUSEP$PRECOVISTORIA$UF\n";
	//ARQUIVO TXT

	@mkdir ("fatcom_bradesco/".$_SESSION[roteirizador], 0777);
	$arquivo = "fatcom_bradesco/".$_SESSION[roteirizador]."/FATCOM_BRADESCO_".date("Ymd")."_".date("Hi")."_".$bacnome['nome_posto'].".txt";
	
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $conteudo)) {}
	

		}
	}
	

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" background="../../barra2.jpg" class="style16"><div align="center" class="style16">Fatcom Bradesco</div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#E9E9E9" class="style18">&nbsp;Informa&ccedil;&atilde;o</td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#E9E9E9" class="style18">&nbsp;Total de <? echo mysql_num_rows($result_fatcom); ?> Vistoria(s) no <? echo $bacnome['nome_posto']; ?>  </td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#F9F9F9" class="style18"><div align="center"><a href="<? echo $arquivo;?>">Baixar FATCOM Bradesco Seguros</a></div></td>
    </tr>
  <tr>
    <td height="24" background="../../barra.jpg" class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio_pagamento_vistoriador_bac.php'"></td>
  </tr>
</table>
<?
	
	//FECHA O ARQUIVO 
	fclose($abrir);
} else{
header('Content-type: application/msexcel');
header('Content-Disposition: attachment; filename="arquivo.xls"');
// EXCEL GARANTIA

$data_inicial1 = str_replace("/","",$_POST[DATA_INICIAL]);
$data_inicial = $data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}.$data_inicial1{2}.$data_inicial1{3}.$data_inicial1{0}.$data_inicial1{1};
$data_final1 = str_replace("/","",$_POST[DATA_FINAL]);
$data_final = $data_final1{4}.$data_final1{5}.$data_final1{6}.$data_final1{7}.$data_final1{2}.$data_final1{3}.$data_final1{0}.$data_final1{1};
//print_r ($_POST[controle_bac]);

if($_POST[controle_bac]!=='TODOS')
	{
		$controle_bac = "AND CEPVISTORIA = $_POST[controle_bac]";
	}
	else
	{
		$controle_bac = '';
	}
		//selecionando nome do BAC
	$sql_bacnome = "SELECT nome_posto FROM ".$bancoDados.".contro_vp_posto WHERE cep = ".$_POST[controle_bac];
	$result_bacnome = mysql_query($sql_bacnome,$db);
	$bacnome= mysql_fetch_array($result_bacnome);
	//print_r ($sql_bacnome);
	//print_r ($bacnome['nome_posto']);	

$sql5 = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION[roteirizador]."' AND nome_seguradora = '0'"; 
$resultado5 = mysql_query($sql5,$db);
$seguradora = mysql_fetch_array($resultado5);

$VISTORIADORA = str_pad($seguradora[codigo_prestadora], 3, "0", STR_PAD_LEFT);

$sql_fatcom ="SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTVISTORIA >= ".$data_inicial." AND DTVISTORIA <= ".$data_final." ".$controle_bac." AND DTTRANS >1 AND TPVISTORIA='P'";
	$result_fatcom = mysql_query($sql_fatcom,$db);
	if (mysql_num_rows($result_fatcom)>0)
	{

if($_SESSION['roteirizador']==20){
	$seguradora['nomeVistoriadora']='CONFERIR Central de Vistorias';
	}
		
		$mensagem.="
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr bgcolor='#999999'>
<td height='27' class='fora4' colspan='3'><b>".$seguradora['nomeVistoriadora']."</b></td>
<td height='27' class='fora4' colspan='3'><b>LOCAL: ".$bacnome['nome_posto']."</b></td>
</tr>
<tr bgcolor='#999999'>
<td height='27' class='fora4' colspan='3'><b>RELA&Ccedil;&Atilde;O VISTORIAS REALIZADAS EM BACs e/ou GARANTIAS</b></td>
<td height='27' align='left' class='fora4' colspan='3'><b>".$data_inicial1{2}.$data_inicial1{3}."/".$data_inicial1{4}.$data_inicial1{5}.$data_inicial1{6}.$data_inicial1{7}."</b></td>
</tr>
</table>
<table width='100%'>
<tr>
<td height='27' class='fora4' width='5%'><b>FILIAL</b></td>
<td height='27' class='fora4' width='10%'><b>N&Uacute;MERO LAUDO</b></td>
<td height='27' class='fora4' width='5%'><b>DV</b></td>
<td height='27' class='fora4' width='10%'><b>PLACA</b></td>
<td height='27' class='fora4' width='20%'><b>N&Uacute;MERO DO CHASSI</b></td>
<td height='27' class='fora4' width='50%'><b>SEGURADO</b></td>
</tr>";

		while ($reg= mysql_fetch_array($result_fatcom))
		{
			
	//PREPARA O CONTEÚDO A SER GRAVADO  
	$mensagem.="<tr><td>".strtoupper($reg[CDFILIAL])."</td><td>".strtoupper($reg[NRVISTORIA])."</td><td> </td><td>".strtoupper($reg[NRPLACA])."</td><td>".strtoupper($reg[NRCHASSI])."</td><td>".strtoupper($reg[NMPROPONENTE])."</td></tr>";
	//ARQUIVO TXT

	@mkdir ("fatcom_bradesco/".$_SESSION[roteirizador], 0777);
	$arquivo = "fatcom_bradesco/".$_SESSION[roteirizador]."/EXCEL-BAC_BRADESCO_".date("Ymd")."_".date("Hi")."_".$bacnome['nome_posto'].".xls";
	
	
	if (!$abrir = fopen($arquivo, "a")) {}
	if (!fwrite($abrir, $mensagem)) {}
	

		}
	}
$mensagem.="</table>";	
echo $mensagem;
/*
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr  width="100%">
    <td height="25" background="../../barra2.jpg" class="style16"><div align="center" class="style16">Fatcom Bradesco</div></td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#E9E9E9" class="style18">&nbsp;Informa&ccedil;&atilde;o</td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#E9E9E9" class="style18">&nbsp;Total de <? echo mysql_num_rows($result_fatcom); ?> Vistoria(s) no <? echo $bacnome['nome_posto']; ?>  </td>
  </tr>
  <TR height="20" onMouseOver="this.className='sobre2'"  onMouseOut="this.className='fora2'">
    <td height="29" bgcolor="#F9F9F9" class="style18"><div align="center"><a href="<? echo $arquivo;?>">Baixar EXCEL-BAC Bradesco Seguros</a></div></td>
    </tr>
  <tr>
    <td height="24" background="../../barra.jpg" class="style18"><input name="button" type="submit" class="botao" id="button" value="voltar" onClick="window.location='relatorio_pagamento_vistoriador_bac.php'"></td>
  </tr>
</table>
<? */
	
	//FECHA O ARQUIVO 
	fclose($abrir);	
	
	}
?>
