<?
session_start();
//include "conecta.php";
include "../../../adm/conecta.php";
header('Content-type: application/msexcel');
header('Content-Disposition: attachment; filename="arquivo.xls"');

switch ($_SESSION['roteirizador']){
	case 1786: $empresa='STYLLUS VISTORIAS';break;
	case 20: $empresa='ACONFERIR';break;
	case 60 : $empresa = "EXCEL"; break;
	case 70 : $empresa = "JEF"; break;
	case 75 : $empresa = "VISION"; break;
	case 80 : $empresa = "OK VISTORIAS"; break;
	case 90 : $empresa = "REALIZA VISTORIAS"; break;
	case 100 : $empresa = "VS VISTORIAS"; break;
	case 110 : $empresa = "PREVICAR VISTORIAS"; break;
	case 140 : $empresa = "ETH VISTORIAS"; break;
	case 150 : $empresa = "CENTRAL VISTORIAS"; break;
	case 160 : $empresa = "MINAS ROTA VISTORIAS"; break;
	case 170 : $empresa = "BRAGA VISTORIAS"; break;
	case 180 : $empresa = "VIP VISTORIAS"; break;
	case 190 : $empresa = "BR ATTLAS VISTORIAS"; break;
	case 200 : $empresa = "QUINTÃO VISTORIAS"; break;
	case 210 : $empresa = "ALPHA VISTORIAS"; break;
	case 220 : $empresa = "BBC VISTORIAS"; break;
	case 230 : $empresa = "VISTRIM VISTORIAS"; break;
	case 240 : $empresa = "VISTPREV VISTORIAS"; break;
	case 250 : $empresa = "GWB VISTORIAS"; break;
	case 260 : $empresa = "JORNADA VISTORIAS"; break;
	case 270 : $empresa = "POINTER DO BRASIL"; break;
	case 280 : $empresa = "VISTOVERDE VISTORIAS"; break;
	case 290 : $empresa = "BETA VISTORIAS"; break;
	case 300 : $empresa = "AGILLE VISTORIAS"; break;
	case 627: $empresa='3ª VIA';break;
	default:break;
	}

$contador=1;

	$sql_vistoria = "SELECT vp.NRVISTORIA,vp.CDCORRETOR,vp.NRPLACA,vp.NRCHASSI,vp.CDFINALIDADE, c.feedback FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".controle_vp_transmissao c WHERE vp.NUMEROSOLICITACAO=c.numero_solicitacao AND vp.roteirizador=".$_SESSION['roteirizador']." AND vp.SEGURADORA=60 AND vp.status_trans='5####'";
	$result_vistoria = @mysql_query($sql_vistoria,$db);
	

	if (@mysql_num_rows($result_vistoria)>0)
	 	{			
$mensagem.="<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan='8'><h2><center>".$empresa."</center></h2></td>
</tr>
<tr>
	<td colspan='8'><center><b>C&Oacute;DIGOS DE LIBERA&Ccedil;&Atilde;O</b></center></td>
</tr>
</table>";
$mensagem.="
<table width='100%' border='1' cellpadding='0' cellspacing='0'>
<tr>
<td height='27' class='fora4'><b><center>ITEM</center></b></td>
<td height='27' class='fora4'><b><center>LAUDO</center></b></td>
<td height='27' class='fora4'><b><center>COD. CORRETOR</center></b></td>
<td height='27' class='fora4'><b><center>PLACA</center></b></td>
<td height='27' class='fora4'><b><center>CHASSI</center></b></td>
<td height='27' class='fora4'><b><center>MOTIVO</center></b></td>
<td height='27' class='fora4'><b><center>COD. CORRETO</center></b></td>
<td height='27' class='fora4'><b><center>CR&Iacute;TICA</center></b></td>
</tr>";

	while($reg =@mysql_fetch_array($result_vistoria))
	{

$mensagem.="<tr><td><center>".$contador."</center></td><td><center>".$reg[NRVISTORIA]."</center></td><td><center>".strtoupper($reg[CDCORRETOR])."</center></td><td>".strtoupper($reg[NRPLACA])."</td><td>".strtoupper($reg[NRCHASSI])."</td><td><center>".$reg[CDFINALIDADE]."</center></td><td>&nbsp;</td><td>".strtoupper($reg[feedback])."</td></tr>";
	$contador++;
	}
$mensagem.="</table>";	
echo $mensagem;
		}

?>

</body>
</html>