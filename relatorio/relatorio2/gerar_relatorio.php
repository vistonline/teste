<?
//include "conecta.php";
include "../../../adm/conecta.php";

$data_inicial = $_POST[DATA_INICIAL]{6}.$_POST[DATA_INICIAL]{7}.$_POST[DATA_INICIAL]{8}.$_POST[DATA_INICIAL]{9}.$_POST[DATA_INICIAL]{3}.$_POST[DATA_INICIAL]{4}.$_POST[DATA_INICIAL]{0}.$_POST[DATA_INICIAL]{1};

	$data_final = $_POST[DATA_FINAL]{6}.$_POST[DATA_FINAL]{7}.$_POST[DATA_FINAL]{8}.$_POST[DATA_FINAL]{9}.$_POST[DATA_FINAL]{3}.$_POST[DATA_FINAL]{4}.$_POST[DATA_FINAL]{0}.$_POST[DATA_FINAL]{1};


$sql_user = "SELECT * FROM ".$bancoDados.".user WHERE id = $_POST[usuario]";
$result_user = mysql_query($sql_user,$db);
$user = mysql_fetch_array($result_user);

echo '<table width="736" height="52" border="1">
  <tr>
    <td colspan="2">Nome usuario:'.$user[nome].'</td>
  </tr>';

echo ' <tr>    <td width="257">Numero da vistoria</td>    <td width="463">Placa </td>  </tr>';

if($_POST['permissao']=='10'){

$sql = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTANALISE >= $data_inicial AND DTANALISE <= $data_final AND controle_analista = $_POST[usuario]";

}

if($_POST['permissao']=='2'){

$sql = "SELECT * FROM ".$bancoDados.".vistoria_previa1 WHERE DTPROC >= $data_inicial AND DTPROC <= $data_final AND controle_digitador = $_POST[usuario]";

}


if($_POST['permissao']=='7'){

$sql = "SELECT * FROM ".$bancoDados.".solicitacao WHERE data_auto >= $data_inicial AND data_auto <= $data_final AND controle_digitador = $_POST[usuario]";

}
echo $sql;


$result = mysql_query($sql,$db) or die(mysql_error());
	if (mysql_num_rows($result)>0)
	{

$realtorio = mysql_fetch_array($result) or die("Exibi o erro: " . mysql_error());



	}
?>