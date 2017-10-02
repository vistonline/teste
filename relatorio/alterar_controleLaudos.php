<?php

if($_POST['botao']=='rel_laudosPendentes'){
	
	include "rel_laudosPendentes.php";
	
	}elseif($_POST['botao']=='rel_laudosCancelados'){
	
	include "rel_laudosCancelados.php";
	
	}else{

if(sizeof($_POST)<1){
	echo '<center><br /><br /><br /><h1 style="background-color:#F00; color:#FFF">Desculpe nenhum dado foi recebido, isso pode ter ocorrido devido sua sess&atilde;o ter expirado!</h1></center>';
	exit();
	}

session_start();
include "../../adm/conecta.php";
include "../verifica.php";

	if($_POST['vistoriador']==''){
		echo '<center><br /><br /><br /><h1 style="background-color:#F00; color:#FFF">&Eacute; OBRIGATORIO INFORMAR O VISTORIADOR!</h1></center>';
		exit();
		}
	if($_POST['nr_inicio']==''){
		echo '<center><br /><br /><br /><h1 style="background-color:#F00; color:#FFF">&Eacute; OBRIGATORIO INFORMAR O PRIMEIRO LAUDO!</h1></center>';
		exit();
		}
	if( $_POST['nr_fim']==''){
		echo '<center><br /><br /><br /><h1 style="background-color:#F00; color:#FFF">&Eacute; OBRIGATORIO INFORMAR O &Uacute;LTIMO LAUDO!</h1></center>';
		exit();
		}

$qtdeAlterada=((int)$_POST['nr_fim']-((int)$_POST['nr_inicio'])+1);


############################################# verificando de a faixa de LAUDOS já foi atribuida #############################################################
###################################################### VERIFICANDO FAIXA INICIAL #########################################################################		
$sql_faixa = "SELECT * FROM ".$bancoDados.".controleLaudos WHERE nr_inicio<=".$_POST['nr_inicio']." AND nr_fim>=".($_POST['nr_inicio']+1); 
$result_faixa = mysql_query($sql_faixa,$db);
$faixa = @mysql_fetch_assoc($result_faixa);
if($faixa['controle_prest']==''){
###################################################### VERIFICANDO FAIXA FINAL ###########################################################################	
		$sql_faixa2 = "SELECT * FROM ".$bancoDados.".controleLaudos WHERE nr_inicio<=".$_POST['nr_fim']." AND nr_fim>=".($_POST['nr_inicio']+1); 
		$result_faixa2 = mysql_query($sql_faixa2,$db);
		$faixa2 = @mysql_fetch_assoc($result_faixa2);
			if(mysql_num_rows($result_faixa2)>=1){
			$sql_nomeVist = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$faixa2['controle_prest']."" ; 
			$result_nomeVist = mysql_query($sql_nomeVist,$db);
			$nomeVist = @mysql_fetch_assoc($result_nomeVist);
			echo "<h3><center>O N&Uacute;MERO DE LAUDO final informado est&aacute; invadindo a faixa de LAUDOS destinada &agrave; outro vistoriador conforme abaixo:<br>Vistoriador: <b>".$nomeVist['nome']."</b><br>LAUDO inicial: ".$faixa2['nr_inicio']."<br>LAUDO final: ".$faixa2['nr_fim']."</center></h3>";
			exit();
		}else{// não invade nenhuma faixa de LAUDO existente
	
	#################################### insere no banco #############################################################################################	
	$sql2 = "UPDATE ".$bancoDados.".controleLaudos SET 
			controle_prest=".$_POST['vistoriador'].",
			nr_inicio=".$_POST['nr_inicio'].",
			nr_fim=".$_POST['nr_fim'].",
			qtde=".$qtdeAlterada.",
			controle_alteracao=".$_SESSION['id'].",
			data_alteracao=".date('Ymd')."
	 		WHERE id=".$_POST['registroId'];
	$result2 = mysql_query($sql2,$db);
				if (!$result2)
				{
					//Se nao funcionou
					echo ("<font color='red'>".mysql_error()."</font><br>");
				}else{
					echo '<br /><br /><br /><br /><br /><br /><br /><center><font color="#0000FF" face="Arial, Helvetica, sans-serif"><h1>DISTRIBUI&Ccedil;&Atilde;O ALTERADA COM SUCESSO!</h1></font></center>';
					}

			##################################################################################################################################################
			
			}
	}else{
		

		if($faixa['id']!=$_POST['registroId']){
			
		$sql_nomeVist = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$faixa['controle_prest']."" ; 
		$result_nomeVist = mysql_query($sql_nomeVist,$db);
		$nomeVist = @mysql_fetch_assoc($result_nomeVist);
		echo "<h3><center>O N&Uacute;MERO DE LAUDO inicial informado est&aacute; invadindo a faixa de LAUDOS destinada &agrave; outro vistoriador, conforme abaixo:<br>Vistoriador: <b>".$nomeVist['nome']."</b><br>LAUDO inicial: ".$faixa['nr_inicio']."<br>LAUDO final: ".$faixa['nr_fim']."</center></h3>";
		exit();
		
		}else{
			
###################################################### VERIFICANDO FAIXA FINAL ###########################################################################	
		$sql_faixa2 = "SELECT * FROM ".$bancoDados.".controleLaudos WHERE id!=".$faixa['id']." AND  nr_inicio<=".$_POST['nr_fim']." AND nr_fim>=".($_POST['nr_inicio']+1); 
		$result_faixa2 = mysql_query($sql_faixa2,$db);
		$faixa2 = @mysql_fetch_assoc($result_faixa2);
			if(mysql_num_rows($result_faixa2)>=1){
			$sql_nomeVist = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$faixa2['controle_prest']."" ; 
			$result_nomeVist = mysql_query($sql_nomeVist,$db);
			$nomeVist = @mysql_fetch_assoc($result_nomeVist);
			echo "<h3><center>O N&Uacute;MERO DE LAUDO final informado est&aacute; invadindo a faixa de LAUDOS destinada &agrave; outro vistoriador conforme abaixo:<br>Vistoriador: <b>".$nomeVist['nome']."</b><br>LAUDO inicial: ".$faixa2['nr_inicio']."<br>LAUDO final: ".$faixa2['nr_fim']."</center></h3>";
			exit();
		}else{// não invade nenhuma faixa de LAUDO existente
	
	#################################### insere no banco #############################################################################################	
	$sql2 = "UPDATE ".$bancoDados.".controleLaudos SET 
			controle_prest=".$_POST['vistoriador'].",
			nr_inicio=".$_POST['nr_inicio'].",
			nr_fim=".$_POST['nr_fim'].",
			qtde=".$qtdeAlterada.",
			controle_alteracao=".$_SESSION['id'].",
			data_alteracao=".date('Ymd')."
	 		WHERE id=".$_POST['registroId'];
	$result2 = mysql_query($sql2,$db);
				if (!$result2)
				{
					//Se nao funcionou
					echo ("<font color='red'>".mysql_error()."</font><br>");
				}else{
					echo '<br /><br /><br /><br /><br /><br /><br /><center><font color="#0000FF" face="Arial, Helvetica, sans-serif"><h1>DISTRIBUI&Ccedil;&Atilde;O ALTERADA COM SUCESSO!</h1></font></center>';
					}

			##################################################################################################################################################
			
			}
	
			}
		}

mysql_close();	

?>

<script>setTimeout("window.location='controleLaudos.php'",2000);</script>

<? } ?>