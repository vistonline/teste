<?php 
if(sizeof($_POST)<1){
	echo '<center><br /><br /><br /><h1 style="background-color:#F00; color:#FFF">Desculpe nenhum dado foi recebido, isso pode ter ocorrido devido sua sess&atilde;o ter expirado!</h1></center>';
	exit();
	}

session_start();
include "../../adm/conecta.php";
include "../verifica.php";

if($_POST['tipo']=='distribuir'){
	if($_POST['contorle_prest']==''){
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
############################################# verificando de a faixa de CEP já foi atribuida #############################################################
###################################################### VERIFICANDO FAIXA INICIAL #########################################################################		
$sql_faixa = "SELECT * FROM ".$bancoDados.".controleLaudos WHERE nr_inicio<=".$_POST['nr_inicio']." AND nr_fim>=".($_POST['nr_inicio']+1); 
$result_faixa = mysql_query($sql_faixa,$db);
$faixa = @mysql_fetch_assoc($result_faixa);
if($faixa['idVistoriador']==''){
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
		}else{// não invade nenhuma faixa se CEP existente
			
			#################################### insere no banco #############################################################################################
			$sql="INSERT INTO ".$bancoDados.".controleLaudos (controle_prest,controle_digitador,data,nr_inicio,nr_fim,qtde,saldo) VALUES (".$_POST['contorle_prest'].",".$_SESSION['id'].",".date('Ymd').",".$_POST['nr_inicio'].",".$_POST['nr_fim'].",".((int)$_POST['nr_fim']-((int)$_POST['nr_inicio'])+1).",".((int)$_POST['nr_fim']-((int)$_POST['nr_inicio'])+1).")";
		$result = mysql_query($sql,$db);
		if (!$result)
			{
				//Se nao funcionou
				echo ("<font color='red'>".mysql_error()."</font><br>");
			}else{
				echo '<br /><br /><br /><br /><br /><br /><br /><center><font color="#0000FF" face="Arial, Helvetica, sans-serif"><h1>Faixa de LAUDOS inserida com SUCESSO!</h1></font></center>';
				}
			##################################################################################################################################################
			
			}
	}else{
		$sql_nomeVist = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$faixa['controle_prest']."" ; 
		$result_nomeVist = mysql_query($sql_nomeVist,$db);
		$nomeVist = @mysql_fetch_assoc($result_nomeVist);
		echo "<h3><center>O N&Uacute;MERO DE LAUDO inicial informado est&aacute; invadindo a faixa de LAUDOS destinada &agrave; outro vistoriador, conforme abaixo:<br>Vistoriador: <b>".$nomeVist['nome']."</b><br>LAUDO inicial: ".$faixa['nr_inicio']."<br>LAUDO final: ".$faixa['nr_fim']."</center></h3>";
		exit();
		}

mysql_close();	
   
##########################################################################################################################################################
} // fim if $_POST['distribuir']

if($_POST['tipo']=='cancelar'){
		$sql_faixa2 = "SELECT * FROM ".$bancoDados.".controleLaudos WHERE nr_inicio<=".$_POST['nr_laudo']." AND nr_fim>=".($_POST['nr_laudo']); 
		$result_faixa2 = mysql_query($sql_faixa2,$db);
		$faixa2 = @mysql_fetch_assoc($result_faixa2);
		if(mysql_num_rows($result_faixa2)>=1){
			$sql_nomeVist = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$faixa2['controle_prest']."" ; 
			$result_nomeVist = mysql_query($sql_nomeVist,$db);
			$nomeVist = @mysql_fetch_assoc($result_nomeVist);
			
			if($faixa2['controle_prest']!=$_POST['contorle_prest']){
				$sql_nomeVist2 = "SELECT nome FROM ".$bancoDados.".user WHERE id=".$_POST['contorle_prest']."" ; 
				$result_nomeVist2 = mysql_query($sql_nomeVist2,$db);
				$nomeVist2 = @mysql_fetch_assoc($result_nomeVist2);
				echo "<h3><center>O N&Uacute;MERO DE LAUDO <b>".$_POST['nr_laudo']."</b> n&atilde;o pode ser cancelado como pertencendo ao vistoriador ".$nomeVist2['nome'].", porque pertence &agrave; outro vistoriador, conforme abaixo:<br>Vistoriador: <b>".$nomeVist['nome']."</b><br>LAUDO inicial: ".$faixa2['nr_inicio']."<br>LAUDO final: ".$faixa2['nr_fim']."</center></h3>";
				exit();
				}else{
			#################################### insere no banco #############################################################################################
			$sql="INSERT INTO ".$bancoDados.".controleLaudosCancelados (controle_prest,controle_digitador,data,nr_laudo,obs) VALUES (".$_POST['contorle_prest'].",".$_SESSION['id'].",".date('Ymd').",".$_POST['nr_laudo'].",'".$_POST['obs']."')";
			$result = mysql_query($sql,$db);
			if (!$result)
				{
					//Se nao funcionou
					echo ("<font color='red'>".mysql_error()."</font><br>");
				}else{
					echo '<br /><br /><br /><br /><br /><br /><br /><center><font color="#0000FF" face="Arial, Helvetica, sans-serif"><h1>LAUDO CANCELADO COM SUCESSO!</h1></font></center>';
					}
			##################################################################################################################################################
					
					}
			
			}else{
				echo "<h3><center>Este N&Uacute;MERO DE LAUDO n&atilde;o pertence a nenhuma faixa de laudo distribuido!</center></h3>";
				exit();
				}
	
	
	} // fim if $_POST['cancelar']
?>
<script>setTimeout("window.location='controleLaudos.php'",2000);</script>