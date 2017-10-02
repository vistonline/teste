<?
include "../../adm/conecta.php";
include "../verifica.php";
include "../verifica_roteirizador.php";
?>
<script src="../js/funcoes.js" type="text/javascript"></script>
<form name="form1" method="post" action="gerar_relatorio_filial_xls.php">
  <p>
    <label>
      Data Inicial :
    <input name="DATA_INICIAL" type="text" class="style12" value=""  size="10" maxlength="10" onkeypress="mascara(this,data)" <? echo $focus;?>>   
    </label>
  </p>
  <p>
    <label>
      Data final :
    <input name="DATA_FINAL" type="text" class="style12" value=""  size="10" maxlength="10" onkeypress="mascara(this,data)" <? echo $focus;?>>   
    </label>
  </p>
    <p>Filial : 
    <label>
      <select name="controle_filial" class="style12" id="controle_filial">
        <? 
		$sql_posto = "SELECT uf,nome_filial,codigo_filial FROM ".$bancoDados.".controle_vp_filial WHERE roteirizador = ".$_SESSION["roteirizador"]." order by codigo_filial";
		$result_posto = mysql_query($sql_posto,$db);
		if (mysql_num_rows($result_posto)>0)
		{ 
		 	while ($filial = mysql_fetch_array($result_posto))
			{
	$sql_filial32= "SELECT id FROM ".$bancoDados.".user WHERE roiterizador=$_SESSION[roteirizador] AND filial=".$filial["codigo_filial"]." AND permissao=1";
			$result_sql_filial32=mysql_query($sql_filial32,$db);
			while ($rows32 = mysql_fetch_array($result_sql_filial32,MYSQL_ASSOC)){
			$todas32.=$rows32["id"].",";
			}
							
		    $todas32[strlen($todas32)-1]=' ';
			$filial_correta=" AND controle_prest in ($todas32)";
			

				
	  ?>
      <option value="<? echo $todas32;?>"><? echo $filial["nome_filial"];?></option>
        <?
	 		$todas32 ="";
 		 }
	 	 }
	  ?>
</select>
      </select>
    </label>
  </p>
  

  <p>
    <label>
      <input type="submit" name="button" id="button" value="Submit">
    </label>
  </p>
</form>


