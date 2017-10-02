<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head><body>

<?
include "../../adm/conecta.php";
include "../verifica.php";

$sql = "SELECT numerosolicitacao, nrvistoria, seguradora, roteirizador\n"
 . "FROM vistoria_previa1\n"
 . "WHERE DTTRANS >20100915\n"
 . "AND status_trans =\'\'\n"
 . "AND seguradora\n"
 . "IN ( 0, 55) \n"
 . "";
$result_sql = mysql_query($sql,$db);
$sql = mysql_fetch_array($result_sql);
if (@mysql_num_rows($result_sql)>0){print_r($sql);} else {echo "Nenhum bug de transmissao encontrado!"; }

$sql2 =  "SELECT vp.numerosolicitacao, vp.nrvistoria, vp.seguradora, vp.roteirizador, ct.feedback\n"
    . "FROM ".$bancoDados.".vistoria_previa1 vp, ".$bancoDados.".controle_vp_transmissao ct\n"
    . "WHERE vp.DTTRANS >20101201\n"
    . "AND vp.numerosolicitacao=ct.numero_solicitacao\n"
    . "AND ct.feedback=\'\'\n"
    . "AND vp.seguradora IN ( 0, 55)";
$result_sql2 = mysql_query($sql2,$db);
$sql2 = mysql_fetch_array($result_sql2);
if (@mysql_num_rows($result_sql2)>0){print_r($sql2);} else {echo "<br><br>Nenhuma vistoria sem protocolo de transmiss&atilde;o!"; }

$sql3 = "SELECT numerosolicitacao, nrvistoria, seguradora, roteirizador\n"
 . "FROM vistoria_previa1\n"
 . "WHERE DTTRANS >20110101\n"
 . "AND checado =\'\'";
$result_sql = mysql_query($sql3,$db);
$sql3 = mysql_fetch_array($result_sql3);
if (@mysql_num_rows($result_sql3)>0){print_r($sql3);} else {echo "<br><br>Nenhuma vistoria transmitida com checado vazio!"; }


 ?>
</body>
</html>