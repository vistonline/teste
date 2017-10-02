<?
include "../../adm/conecta.php";
include "../verifica.php";

?>
<script language="javascript">
function retira(objResp) {  
var varString = new String(objResp.value);  
var stringAcentos = new String("àâêôûãõáéíóúçüÀÂÊÔÛÃÕÁÉÍÓÚÇÜ&´'(){}[]ªº°");  
var stringSemAcento = new String("aaeouaoaeioucuAAEOUAOAEIOUCUe        ***");  
  
var i = new Number();  
var j = new Number();  
var cString = new String();  
var varRes = '';  
  
for (i = 0; i < varString.length; i++) {  
cString = varString.substring(i, i + 1);  
for (j = 0; j < stringAcentos.length; j++) {  
if (stringAcentos.substring(j, j + 1) == cString){  
cString = stringSemAcento.substring(j, j + 1);  
}  
}  
varRes += cString;  
}  
objResp.value = varRes.toUpperCase();  
}
</script>

<form id="form2" name="form2" method="post" action="#">
<table width="100%" border="00" cellspacing="0" cellpadding="0">
  <tr >
    <td height="50" colspan="6" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Inserir Corretor na Tabela da SulAmerica
</td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" width="25%" height="50" class="style12">&nbsp;&nbsp;Nome do Corretor</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
            <label>
            <input name="nome" type="text" class="style12" id="nome" onkeyup="retira(this);" size="60" <? echo $focus;?> />
            </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" width="25%" height="50" class="style12">&nbsp;&nbsp;SUSEP</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
            <label>
            <input name="susep" type="text" class="style12" id="susep" size="17" <? echo $focus;?> onkeypress="return sonumero(this);" />
            </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" height="50" class="style12">&nbsp;&nbsp;EV</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
          <label>
          <input name="ev" type="text" class="style12" id="ev" size="13" <? echo $focus;?> />
          </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td height="50" colspan="2">
     
     <br /><br />
       <div style="width:50%; float:left; text-align:center">
   	    	<img src="../imagens/voltar.png" style="cursor:pointer" title="voltar" onclick="window.top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" />
		</div>
   <div style="width:50%; float:left; text-align:center">
   		<input type="image" src="../imagens/atualizar.png" name="Submit" id="button" title="Gravar" onclick="if(document.getElementById('nome').value==''||document.getElementById('susep').value==''||document.getElementById('ev').value==''){alert('Preencha os campos corretamente');}" />
	</div>
     </td>
  </tr>
</table>
</form>

<?
if($_POST['nome']&&$_POST['susep']&&$_POST['ev'])
{
	
$sql = "SELECT * FROM webvist.corretores_sulamerica WHERE ev=".$_POST['ev']." OR susep=".$_POST['susep']."";
$result = mysql_query($sql,$db);
$resultado = mysql_fetch_assoc($result);	

if(mysql_num_rows($result)==0){	
	$sql_insert_corretor = "INSERT INTO corretores_sulamerica (nome,susep,ev) VALUES ('".strtoupper($_POST['nome'])."','".strtr($_POST['susep'],array("."=>"", "-"=>"", ","=>""))."','".strtr($_POST['ev'],array("."=>"", "-"=>"", ","=>""))."')";
	$result_insert_corretor = mysql_query($sql_insert_corretor,$db);
		if($result_insert_corretor)
		{
		echo "<center><h3>".$_POST['nome']."&nbsp;cadastrado com Sucesso!</h3></center>";
		}
	}else{
		echo "<center><h3>Este corretor j&aacute; est&aacute; cadastrado!</h3></center><br />";
		echo '<center><table width="100%">
	<tr>
    	<td>EV</td>
        <td>NOME</td>
        <td>SUSEP</td>
    </tr>
    <tr>
    	<td>'.$resultado['ev'].'</td>
        <td>'.strtoupper($resultado['nome']).'</td>
        <td>'.$resultado['susep'].'</td>
    </tr>
</table></center>';
		}
	
}
?>