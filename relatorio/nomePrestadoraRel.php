<?php
@session_start();

if(isset($_POST['cod_prest']) && $_POST['cod_prest']!=''){
	$codEmpresa=trim($_POST['cod_prest']);
	}else{
		$codEmpresa=$_SESSION['roteirizador'];
		}

switch($codEmpresa){
	case 0: $empresa='BS2'; $nome_empresa='BS2 Consultoria '; break;
	case 20: $empresa='ACONFERIR'; $nome_empresa='ACONFERIR'; break;
	case 60: $empresa='EXCEL'; $nome_empresa='EXCEL'; break;
	case 70: $empresa='JEF'; $nome_empresa='JEF VISTORIAS'; break;
	case 75: $empresa='VISION'; $nome_empresa='VISION VISTORIAS'; break;
	case 80: $empresa='OK'; $nome_empresa='OK VISTORIAS'; break;
	case 90: $empresa='REALIZA'; $nome_empresa='REALIZA VISTORIAS'; break;
	case 100: $empresa='VS'; $nome_empresa='VS VISTORIAS'; break;
	case 110: $empresa='PREVICAR'; $nome_empresa='PREVICAR VISTORIAS'; break;
	case 140: $empresa='ETH'; $nome_empresa='ETH VISTORIAS'; break;
	case 150: $empresa='CENTRAL'; $nome_empresa='CENTRAL VISTORIAS'; break;
	case 160: $empresa='MINASROTA'; $nome_empresa='MINAS ROTA VISTORIAS'; break;
	case 170: $empresa='BRAGA'; $nome_empresa='BRAGA VISTORIAS'; break;
	case 180: $empresa='VIP'; $nome_empresa='VIP VISTORIAS'; break;
	case 190: $empresa='ATTLAS'; $nome_empresa='BR ATTLAS VISTORIAS'; break;
	case 200: $empresa='QUINTÃO'; $nome_empresa='QUINTÃO VISTORIAS'; break;
	case 210: $empresa='ALPHA'; $nome_empresa='ALPHA VISTORIAS'; break;
	case 220: $empresa='BBC'; $nome_empresa='BBC VISTORIAS'; break;
	case 230: $empresa='VISTRIM'; $nome_empresa='VISTRIM VISTORIAS'; break;
	case 240: $empresa='VISTPREV'; $nome_empresa='VISTPREV VISTORIAS'; break;
	case 250: $empresa='GWB'; $nome_empresa='GWB VISTORIAS'; break;
	case 260: $empresa='JORNADA'; $nome_empresa='JORNADA VISTORIAS'; break;
	case 270: $empresa='POINTER'; $nome_empresa='POINTER DO BRASIL'; break;
	case 280: $empresa='VISTOVERDE'; $nome_empresa='VISTOVERDE VISTORIAS'; break;
	case 290: $empresa='BETA'; $nome_empresa='BETA VISTORIAS'; break;
	case 300: $empresa='AGILLE'; $nome_empresa='AGILLE VISTORIAS'; break;
	case 627: $empresa='3VIA'; $nome_empresa='3ª Via'; break;
	case 1786: $empresa='STYLLUS'; $nome_empresa='Styllus Vistorias';break;
	default: $empresa='AREA-TI'; break;
	}
	
?>