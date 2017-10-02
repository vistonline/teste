<?
include "../../adm/conecta.php";
include "../verifica.php";
include "../verifica_roteirizador.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relatório</title>
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
/*
rot=<? echo $_SESSION[roteirizador]."&&
filtro=".$array_dados_filtro[0]."&&
seg=44&&
sel=km&&
data_inicial=".$data_inicial."&&
data_final=".$data_final."&&
ordem=".$_POST[por]."&&
ordernar=".$_POST[ordernar]."";
*/
if($_GET[sel]=='km')
{

	$cabecalho = "PLANILHA PARA RATEIO DE VALORES";
	header('Content-type: application/msexcel');
	if($_GET[filtro]=='DTTRANS')
	{
	$nome_relatorio = "km_trans_";
	}
	else
	{
	$nome_relatorio = "km_vist_";
	}
	$km1 = 0;
	$valor_total1 =0;
    $sql_vistoria = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_GET[filtro].">= ".$_GET[data_inicial]." AND ".$_GET[filtro]."<= ".$_GET[data_final]." AND SEGURADORA = ".$_GET[seg]." AND roteirizador = ".$_GET[rot]."
    order by ".$_GET[ordernar]." ".$_GET[por]."";
    $result_vistoria1 = mysql_query($sql_vistoria,$db);
	if (mysql_num_rows($result_vistoria1)>0)
	{ 
		while ($vistoria1 = mysql_fetch_array($result_vistoria1))
		{
		
if($vistoria1['SEGURADORA']=='0'||$vistoria1['SEGURADORA']=='87'||$vistoria1['SEGURADORA']=='88'||$vistoria1['SEGURADORA']=='89'){
	$sql_extra = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$vistoria1[NUMEROSOLICITACAO]."";
}
else{
$sql_extra = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$vistoria1[NUMEROSOLICITACAO]." AND avaliacao != '04' ";
}
			$result_extra1 = mysql_query($sql_extra,$db);
			if (mysql_num_rows($result_extra1)>0)
			{ 
			$extra1 = mysql_fetch_array($result_extra1);
			if($vistoria1['SEGURADORA']=='0'||$vistoria1['SEGURADORA']=='87'||$vistoria1['SEGURADORA']=='88'||$vistoria1['SEGURADORA']=='89'){
			$km1 = $km1+intval($extra1['km_percorrido']);
			}		
			else{
			$km1 = $km1+intval($extra1['KM_rodado']);
			}

			
			}
		}
	}
	$valor_total1 = strval($km1*61);
	$valor_final1 = number_format(substr($valor_total1,0,(strlen($valor_total1)-2)).".".$valor_total1{(strlen($valor_total1)-2)}.$valor_total1{strlen($valor_total1)-1}, 2, ',', '.');
	
	header('Content-Disposition: attachment; filename="relatorio_'.$_GET[rot].'_'.$nome_relatorio.'_'.$_GET[data_inicial].'_'.$_GET[data_final].'_proc'.date(Ymd).'_'.date("His").'.xls"');
	
echo "<table width='100%' cellpadding='0' cellspacing='0'>
  <tr valign='bottom'>
    <th align='middle'>&nbsp;</th>
    <td colspan='15'><strong>PLANILHA PARA RATEIO DE   VALORES</strong></td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td colspan='2' nowrap><strong>C.N.P.J (CGC)&nbsp;</strong> </td>
    <td width='86' nowrap><strong>NR. DOCUMENTO&nbsp;</strong></td>
    <td width='115' align='right' nowrap><strong>VALOR TOTAL&nbsp;</strong></td>
    <td colspan='11'>           </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td colspan='2'>36.041.465/0001-38</td>
    <td width='86'>973182</td>
    <td align='right' width='115' bgcolor='#c0c0c0'>R$ ".$valor_final1."&nbsp;</td>
    <td colspan='11'>           </td>
  </tr>
  <tr valign='bottom'>
    <th colspan='16' align='middle'>               </th>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td width='52' nowrap><strong>CONCEITO&nbsp; </strong></td>
    <td width='112' nowrap><strong>ATIVIDADE&nbsp;</strong></td>
    <td colspan='13'>             </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td width='52'>94512</td>
    <td width='112'>18</td>
    <td colspan='13'>             </td>
  </tr>
  <tr valign='bottom'>
    <th colspan='16' align='middle'>               </th>
  </tr>
  <tr valign='bottom'>
    <th colspan='16' align='middle'>               </th>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td align='middle' colspan='5'>Rateio km</td>
    <td colspan='10'>          </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td width='52' nowrap bgcolor='#c0c0c0'>Sucursal </td>
    <td width='112' nowrap bgcolor='#c0c0c0'>Quant. De km excedente </td>
    <td width='86' nowrap bgcolor='#c0c0c0'>Valor de km  </td>
    <td width='115' nowrap bgcolor='#c0c0c0'><strong>PROJETO</strong></td>
    <td width='88' nowrap bgcolor='#c0c0c0'><strong>RAMO_PRODUTO</strong></td>
    <td colspan='10'>          </td>
  </tr>";
  $sql_vistoria2 = "SELECT DISTINCT CDSUCURSAL FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_GET[filtro].">= ".$_GET[data_inicial]." AND ".$_GET[filtro]."<= ".$_GET[data_final]." AND SEGURADORA = ".$_GET[seg]." AND roteirizador = ".$_GET[rot]."
    order by ".$_GET[ordernar]." ".$_GET[por]."";
    $result_vistoria2 = mysql_query($sql_vistoria2,$db);
	if (mysql_num_rows($result_vistoria2)>0)
	{ 
		while ($vistoria2 = mysql_fetch_array($result_vistoria2))
		{
 	    $km3=0;
	    $valor_total3 = 0;
        $sql_vistoria3 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_GET[filtro].">= ".$_GET[data_inicial]." AND ".$_GET[filtro]."<= ".$_GET[data_final]." AND SEGURADORA = ".$_GET[seg]." AND roteirizador = ".$_GET[rot]." AND CDSUCURSAL = '".$vistoria2[CDSUCURSAL]."' order by ".$_GET[ordernar]." ".$_GET[por]."";
    $result_vistoria3 = mysql_query($sql_vistoria3,$db);
	if (mysql_num_rows($result_vistoria3)>0)
	{ 
		while ($vistoria3 = mysql_fetch_array($result_vistoria3))
		{
		
		
		
			if($vistoria3['SEGURADORA']=='0'||$vistoria3['SEGURADORA']=='87'||$vistoria3['SEGURADORA']=='88'||$vistoria3['SEGURADORA']=='89'){
			$sql_extra3 = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$vistoria3[NUMEROSOLICITACAO]."";
			}
			else{
			$sql_extra3 = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$vistoria3[NUMEROSOLICITACAO]." AND avaliacao != '04' ";
			}
		    $result_extra3 = mysql_query($sql_extra3,$db);
			if (mysql_num_rows($result_extra3)>0)
			{ 
			$extra3 = mysql_fetch_array($result_extra3);

			if($vistoria3['SEGURADORA']=='0'||$vistoria3['SEGURADORA']=='87'||$vistoria3['SEGURADORA']=='88'||$vistoria3['SEGURADORA']=='89'){
			$km3 = $km3+intval($extra3['km_percorrido']);
			}		
			else{
			$km3 = $km3+intval($extra3['KM_rodado']);
			}
			
			}
		}
	}
	$valor_total3 = ($km3*61);
	$km4=$km4+$km3;
	$valor_final3 = number_format(substr($valor_total3,0,(strlen($valor_total3)-2)).".".$valor_total3{(strlen($valor_total3)-2)}.$valor_total3{strlen($valor_total3)-1}, 2, ',', '.');
	
  echo "<tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td align='middle' width='52' bgcolor='#ffff00'>".$vistoria2[CDSUCURSAL]."</td>
    <td align='middle' width='112' bgcolor='#ff99cc'>".$km3."</td>
    <td align='right' width='86' bgcolor='#cc99ff'>R$ ".$valor_final3."</td>
    <td align='right' width='115'>7920009</td>
    <td width='88'>31215</td>
    <td colspan='10'>          </td>
  </tr>";
  		}
    }
  echo "<tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td width='52' bgcolor='#c0c0c0'><strong>Total </strong></td>
    <td align='right' width='112' bgcolor='#c0c0c0'>".$km4."</td>
    <td align='right' width='86' bgcolor='#c0c0c0'>R$ ".$valor_final1."</td>
    <td width='115'> </td>
    <td width='88'> </td>
    <td colspan='10'>          </td>
  </tr>
  <tr valign='bottom'>
    <th colspan='16' align='middle'>               </th>
  </tr>
  <tr valign='bottom'>
    <th colspan='16' align='middle'>               </th>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td colspan='15' bgcolor='#ffff00'>Nº da Sucursal. (Verificar   no relatório enviado no mês referente, coluna K &quot;Sucursal&quot;).              </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td bgcolor='#ff99cc' colspan='15'>Km excedente. (É   necessário distribuir km de acordo com a sucursal que foi transmitida a   vistoria).</td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='18'>&nbsp;</th>
    <td bgcolor='#cc99ff' colspan='15'>Valor total de km por   sucursal. (formula: =quantidade de km &quot;coluna D mesma linha&quot; x valor cobrado por   km).</td>
  </tr>
</table>

";

}
if($_GET[sel]=='vr')
{
	header('Content-type: application/msexcel');
	if($_GET[filtro]=='DTTRANS')
	{
	$nome_relatorio = "vr_trans_";
	}
	else
	{
	$nome_relatorio = "vr_vist_";
	}
	header('Content-Disposition: attachment; filename="relatorio_'.$_GET[rot].'_'.$nome_relatorio.'_'.$_GET[data_inicial].'_'.$_GET[data_final].'_proc'.date(Ymd).'_'.date("His").'.xls"');
	$ano = $_GET['data_inicial']{0}.$_GET['data_inicial']{1}.$_GET['data_inicial']{2}.$_GET['data_inicial']{3};
	$mes1 = $_GET['data_inicial']{4}.$_GET['data_inicial']{5};
	switch($mes1)
	{
	case "01": $mes = "JANEIRO";break;
	case "02": $mes = "FEVEREIRO";break;
	case "03": $mes = "MARÇO";break;
	case "04": $mes = "ABRIL";break;
	case "05": $mes = "MAIO";break;
	case "06": $mes = "JUNHO";break;
	case "07": $mes = "JULHO";break;
	case "08": $mes = "AGOSTO";break;
	case "09": $mes = "SETEMBRO";break;
	case "10": $mes = "OUTRUBRO";break;
	case "11": $mes = "NOVEMBRO";break;
	case "12": $mes = "DEZEMBRO";break;
	}
	
	
	if($_GET[seg]=='86')
	{
	$seguradora_nome = "ASCARPE";
	}
	if($_GET[seg]=='60')
	{
	$seguradora_nome = "MAPFRE SEGURADORA";
	}
	if($_GET[seg]=='44')
	{
	$seguradora_nome = "CAIXA SEGURO";
	}
	echo "<table cellspacing='0' cellpadding='0'>
  <tr valign='bottom'>
    <th align='middle' width='22' >&nbsp;</th>
    <td align='middle' colspan='14'><strong>RELATÓRIO DE   VISTORIAS REALIZADAS</strong></td>
    <td width='58'> </td>
    <td width='85'> </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='22' >&nbsp;</th>
    <td align='middle' colspan='14'><strong>".$seguradora_nome."</strong></td>
    <td width='58'> </td>
    <td width='85'> </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='22' >&nbsp;</th>
    <td align='middle' colspan='14'><strong>AUTOMÓVEL</strong></td>
    <td width='58'> </td>
    <td width='85'> </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='22' >&nbsp;</th>
    <td align='middle' colspan='14'><strong>".$mes."/".$ano."</strong></td>
    <td width='58'> </td>
    <td width='85'> </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='22'>&nbsp;</th>
    <td width='85'> </td>
    <td width='198'> </td>
    <td width='125'> </td>
    <td width='178'> </td>
    <td width='190'> </td>
    <td width='190'> </td>
    <td width='81'> </td>
    <td width='118'> </td>
    <td width='68'> </td>
    <td width='92'> </td>
    <td width='96'> </td>
    <td width='116'> </td>
    <td width='192'> </td>
    <td width='185'> </td>
    <td width='58'> </td>
    <td width='85'> </td>
  </tr>
  <tr valign='bottom'>
    <th align='middle' width='22'>&nbsp;</th>
    <td width='85' align='middle' valign='center' nowrap><strong>Nº</strong></td>
    <td width='198' align='middle' valign='center' nowrap><strong>SOLICITAÇÃO&nbsp;</strong></td>
    <td width='125' align='middle' valign='center' nowrap><strong>LAUDO&nbsp;</strong></td>
    <td width='178' align='middle' valign='center' nowrap><strong>PLACA&nbsp;</strong></td>
    <td width='190' align='middle' valign='center' nowrap><strong>NOME&nbsp;</strong></td>
    <td width='190' align='middle' valign='center' nowrap><strong>CHASSI&nbsp;</strong></td>
    <td width='81' align='middle' valign='center' nowrap><strong>DATA DA VISTORIA&nbsp;</strong></td>
    <td width='118' align='middle' valign='center' nowrap><strong>DATA DE TRANSMISSÃO&nbsp;</strong></td>
    <td width='68' align='middle' valign='center' nowrap><strong>PRAZO&nbsp;</strong></td>
    <td width='92' align='middle' valign='center' nowrap><strong>CÓDIGO&nbsp;</strong></td>
    <td width='96' align='middle' valign='center' nowrap><strong>CORRETOR&nbsp;</strong></td>
    <td width='116' align='middle' valign='center' nowrap><strong>SUCURSAL&nbsp;</strong></td>
    <td width='192' align='middle' valign='center' nowrap><strong>NOME VISTORIADOR&nbsp;</strong></td>
    <td width='185' align='middle' valign='center' nowrap><strong>LOCAL DA VISTORIA&nbsp;</strong></td>
    <td width='58' align='middle' valign='center' nowrap><strong>KM&nbsp;</strong></td>
    <td width='85' align='middle' valign='center' nowrap><strong>MOTIVO&nbsp;</strong></td>
  </tr>
  ";
  $contador=1;
    $sql_vistoria3 = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE 
    ".$_GET[filtro].">= ".$_GET[data_inicial]." AND ".$_GET[filtro]."<= ".$_GET[data_final]." AND SEGURADORA = ".$_GET[seg]." AND roteirizador = ".$_GET[rot]." order by ".$_GET[ordernar]." ".$_GET[por]."";
    $result_vistoria3 = mysql_query($sql_vistoria3,$db);
	if (mysql_num_rows($result_vistoria3)>0)
	{ 
		while ($vistoria3 = mysql_fetch_array($result_vistoria3))
		{
		
			$sql_extra3 = "SELECT * FROM ".$bancoDados.".vistoria_extra WHERE solicitacao = ".$vistoria3[NUMEROSOLICITACAO]." AND avaliacao = '04' ";
		    $result_extra3 = mysql_query($sql_extra3,$db);
			if (mysql_num_rows($result_extra3)>0)
			{ 
			$extra3 = mysql_fetch_array($result_extra3);
			
			$sql_solicitacao = "SELECT * FROM ".$bancoDados.".solicitacao WHERE id = ".$vistoria3[NUMEROSOLICITACAO]."";
		    $result_solicitacao = mysql_query($sql_solicitacao,$db);
			$solicitacao = mysql_fetch_array($result_solicitacao);
			
			$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = ".$solicitacao[controle_prest]."";
		    $result_user = mysql_query($sql_user,$db);
			$user = mysql_fetch_array($result_user);
			
			
			$data_vistoria1 = $vistoria3['DTVISTORIA'];
			$data_vistoria = $data_vistoria1{6}.$data_vistoria1{7}.'/'.$data_vistoria1{4}.$data_vistoria1{5}.'/'.$data_vistoria1{0}.$data_vistoria1{1}.$data_vistoria1{2}.$data_vistoria1{3};
			
			$data_transmissao1 = $vistoria3['DTTRANS'];
			$data_transmissao = $data_transmissao1{6}.$data_transmissao1{7}.'/'.$data_transmissao1{4}.$data_transmissao1{5}.'/'.$data_transmissao1{0}.$data_transmissao1{1}.$data_transmissao1{2}.$data_transmissao1{3};
			if($data_transmissao!=="//0")
			{
				//data da realização da vistoria
				$data_realiza = $vistoria3['DTVISTORIA'];
				//data da transmissão da vistoria
				$data_trans = $vistoria3['DTTRANS'];
				
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
	if($_GET[seg]=='60')
	{  
	$codigo_corretor = $vistoria3[CDCORRETOR];
	}
	else
	{
	$codigo_corretor = "9999999";
	}
	
  echo "
  <tr valign='bottom'  height='20'>
    <th align='middle' width='22'>&nbsp;</th>
    <td width='85'>".$contador."</td>
    <td width='198'>".$extra3[proposta]."</td>
    <td width='125'>".$vistoria3[NRVISTORIA]."</td>
    <td width='178'>".$vistoria3[NRPLACA]."</td>
    <td width='190'>".$vistoria3[NMPROPONENTE]."</td>
    <td width='190'>".$vistoria3[NRCHASSI]."</td>
    <td width='81'>".$data_vistoria."</td>
    <td width='118'>".$data_transmissao."</td>
    <td align='middle' width='68'>".$quantidade_falta."</td>
    <td width='92'>".$codigo_corretor."</td>
    <td width='96'>".$vistoria3[NMCORRETOR]."</td>
    <td width='116'>".$vistoria3[CDSUCURSAL]."</td>
    <td width='192'>".$user[nome]."</td>
    <td width='185'>".$solicitacao[cidade]."</td>
    <td width='58'>".$extra3[KM_rodado]."</td>
    <td width='85'>".$solicitacao[motivo]."</td>
  </tr>";
  $contador++;
  			}
		}
	}
  echo "
</table>";

}
?>
</body>
</html>