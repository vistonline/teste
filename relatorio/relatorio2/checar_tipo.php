<?

//include "conecta.php";
include "../../../adm/conecta.php";
include "../../verifica.php";
include "../../verifica_roteirizador.php";?>

<? 
if($_GET['div']=="checar_permissao")
{
if($_GET['dados']=='7'){
?>
<select name="usuario" id="atendente">
<option>Escolha um atendente</option>
          <? 
	
	if($_SESSION["permissao"]=="7"){
		$atendente=" AND id=".$_SESSION["id"]." ";
		}else{
			$atendente="";
			}
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao in (7,3) and roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 ".$atendente." order by nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
			
			switch($da_digitador['permissao']){
				case 3: $permissao='Permiss&atilde;o: Administrador'; break;
				case 7: $permissao='Permiss&atilde;o: Atendente'; break;
				default: break;
				}
	?>
        <option value="<?=$da_digitador["id"]?>" title="<? echo $permissao; ?>">
          <?=strtoupper($da_digitador["nome"]); ?>
          </option>
        <? }
			  } ?>
   
   
    </select>
<? 


}?>
<? 
if($_GET['dados']=='2')
{
?>

<select name="usuario" id="digitador">
   <option>Escolha um digitador</option>
  
        <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao in (2,3) and roiterizador = '".$_SESSION['roteirizador']."'  and ativo = 0 order by nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	?>
        <option value="<?=$da_digitador["id"]?>">
          <?=$da_digitador["nome"] ?>
          </option>
        <? }
			  } ?>
   
   
   
    </select>   
<?

}?>
<? 
if($_GET['dados']=='10')
{
?>


<select  name="usuario" id="analista">
   <option>Escolha um analista</option>
  
           <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 AND permissao in (10,3) ORDER BY nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	?>
        <option value="<?=$da_digitador["id"]?>">
          <?=$da_digitador["nome"] ?>
          </option>
        <? }
			  } ?>
   
   
    </select>
   
<? 
}

if($_GET['dados']=='70')
{
?>
<select name="usuario" id="analista">
   <option>Escolha uma Seguradora/Cliente</option>
  
           <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".controle_vp_seguradoras WHERE codigo_companhia = '".$_SESSION['roteirizador']."' AND  somenteSolicitacao=0 ORDER BY nome_seguradora";
	
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		
		while ($seguradora= @mysql_fetch_array($result_digitador))
		{
		include '../../seguradora_nome.php';
         }
		echo $option; 
	} ?>
   
   
    </select>
   
<? 
}

if($_GET['dados']=='3') // administrador que analisa
{/*
?>


<select  name="usuario" id="admAnalista">
   <option>Escolha um analista</option>
  
           <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 AND permissao = 3 AND id>1 ORDER BY nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	?>
        <option value="<?=$da_digitador["id"]?>">
          <?=$da_digitador["nome"] ?>
          </option>
        <? }
			  } ?>
   
   
    </select>
   
<? 
*/}



if($_GET['dados']=='1' || $_GET['dados']=='1@1')
{
?>


<select name="usuario" id="vistoriador">
   
  
           <? 
	
	if($_GET['dados']=='1@1'){
		?>
		<option value="TODOS">Todos vistoriadores</option>
		<?
		$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 AND vistoriadorPrincipal='".$_SESSION['id']."' AND roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 
		UNION 
		SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 AND id='".$_SESSION['id']."' AND roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 ORDER BY nome";
		}else{
			?>
			<option value="TODOS">Escolha um vistoriador</option>
			<?
			$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 AND vistoriadorPrincipal='' AND roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 UNION
			SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 AND vistoriadorPrincipal=id  AND roiterizador = '".$_SESSION['roteirizador']."' AND ativo = 0 ORDER BY nome";
			}
	
	
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	?>
        <option value="<? echo $da_digitador["id"]; ?>"><? echo $da_digitador["nome"]; ?></option>
        <? }
			  } ?>
   
   
    </select>
   
<? 
}


// VISTORIADOR QUE DIGITA
if($_GET['dados']=='100')
{
?>


<select  name="usuario" id="vistoriador">
   <option>Escolha um vistoriador-digitador</option>
  
           <? 
	
	$sql_digitador = "SELECT * FROM ".$bancoDados.".user WHERE permissao = 1 and roiterizador = '".$_SESSION['roteirizador']."' and ativo = 0 order by nome";
	$result_digitador = @mysql_query($sql_digitador,$db);
	if (@mysql_num_rows($result_digitador)>0)
	{
		while ($da_digitador= @mysql_fetch_array($result_digitador))
		{
	?>
        <option value="<?=$da_digitador["id"]?>">
          <?=$da_digitador["nome"] ?>
          </option>
        <? }
			  } ?>      
   
   
    </select>
   
<? 
}

if($_GET['dados']=='90')
{
?>


      <select name="usuario"  id="filial">
      
         <option>Escolha uma Filial</option>

        <? 
		$sql_posto = "SELECT uf,nome_filial,codigo_filial FROM ".$bancoDados.".controle_vp_filial WHERE roteirizador = ".$_SESSION["roteirizador"]." order by codigo_filial";
		$result_posto = @mysql_query($sql_posto,$db);
		if (@mysql_num_rows($result_posto)>0)
		{ 
		 	while ($filial = @mysql_fetch_array($result_posto))
			{
	$sql_filial32= "SELECT id FROM ".$bancoDados.".user WHERE roiterizador='".$_SESSION['roteirizador']."' AND filial=".$filial["codigo_filial"]." AND permissao=1 AND ativo=0 AND tipoVistoriador!=2";
			$result_sql_filial32=@mysql_query($sql_filial32,$db);
			while ($rows32 = @mysql_fetch_array($result_sql_filial32,MYSQL_ASSOC)){
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
   
<? 
}

}?>