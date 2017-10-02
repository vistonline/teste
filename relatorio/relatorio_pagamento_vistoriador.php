<?
include "../../adm/conecta.php";
include "../verifica.php";
include "../verifica_roteirizador.php";
?>
<script src="../js/funcoes.js" type="text/javascript"></script>
<form name="form1" method="post" action="gerar_relatorio_xls.php">
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
  <p>Vistoriador : 
    <label>
      <select name="controle_prest" class="style12" id="controle_prest">
    <option value="">Nenhum Vistoriador</option>
    <option value="TODOS">Todos</option>
        <? 
		$sql_prestador = $select_user_prestadores_homologadas_prestadoras;
		$result_prestador = mysql_query($sql_prestador,$db);
		if (mysql_num_rows($result_prestador)>0)
		{
			while ($prestador= mysql_fetch_array($result_prestador))
			{
	  ?>
        <option value="<? echo $prestador[id];?>"<?
		 if($prestador[id]==$solicitacao[controle_prest]&&$_GET[acao]=='criar'){echo "selected";}
		 if($prestador[id]==$reg[controle_prest]&&$_GET[acao]=='editar'||$prestador[id]==$reg[controle_prest]&&$_GET[acao]=='visualizar'){echo "selected";}
		 
		 ?>><? echo $prestador[nome];?></option>
        <?
	  		 }
	 	 }
	  ?>
      </select>
    </label>
  </p>

  <p>
    <label>
      <input type="submit" name="button" id="button" value="Submit">
    </label>
  </p>
</form>


