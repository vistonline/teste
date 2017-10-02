<?php

include "../../adm/conecta.php";
include "../verifica.php";

$sql_update_configuracoes = "UPDATE webvist.controle_vp_ferramentas SET
	email_obrigatorio = '".$_POST['email_obrigatorio']."',
	prestador_confirma_pagamento = '".$_POST['prestador_confirma_pagamento']."',
	operadora_solicitacao = '".$_POST['operadora_solicitacao']."',
	appmobile = '".$_POST['appmobile']."',
	appmobilePadraoFotos = '".$_POST['appmobilePadraoFotos']."',
	appmobileTipoFotos = '".$_POST['appmobileTipoFotos']."',
	distSolicitacaoCEP = '".$_POST['distSolicitacaoCEP']."',
	desconta_prestador = '".$_POST['desconta_prestador']."',
	ufFiliais = '".$_POST['ufFiliais']."',
	limitadorDeAnalise = '".$_POST['limitadorDeAnalise']."',
	contoleLaudoFisico = '".$_POST['contoleLaudoFisico']."',
	controlaFrustradas = '".$_POST['controlaFrustradas']."',
	controlaReanalise = '".$_POST['controlaReanalise']."',
	preCadastro = '".$_POST['preCadastro']."'
	WHERE roteirizador = ".$_POST['rot'].""; 
	$resultado_update_configuracoes = mysql_query($sql_update_configuracoes,$db);
	
	if($resultado_update_configuracoes){
		echo "<h1>Altera&ccedil;&atilde;o realizada com SUCESSO!</h1>";
		}else{
			echo "<h1>Ocorreu um erro: ".mysql_error()."</h1>";
			}

?>