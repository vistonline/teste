<?
include "../../adm/conecta.php";
include "../verifica.php";
   $focus1="onfocus=@this.style.borderStyle='solid';this.style.borderColor='#6B90C5';@ onblur=@this.style.borderStyle='';this.style.borderColor='';@";
   $focus = str_replace("@",'"',$focus1);
   $num_por_pagina = 50; 
	    $pagina = $_GET[pagina];
	    if(strlen($pagina)<=0)
	    {
	    $pagina = 1;
	    }   
	    $primeiro_registro=($pagina*$num_por_pagina)-$num_por_pagina;
if($_GET[dados]=='incluir_corretor')
{
?>
<form id="form2" name="form2" method="post" action="#">
<table width="100%" border="00" cellspacing="0" cellpadding="0">
  <tr >
    <td height="50" colspan="6" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Inserir Corretor na Tabela de corretores nas Solicita&ccedil;&otilde;es
    <span style="float:right">
  <input name="button8" type="button" class="botao1" id="button8" onclick="window.top.novo('ferramentas','body','checar_body');document.getElementById('atualiza').value='';" value="fechar"/>
  &nbsp;</span></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" width="25%" height="50" class="style12">&nbsp;&nbsp;Nome do Corretor</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
            <label>
            <input name="nome" type="text" class="style12" id="nome" onkeypress="semacento_maiuscula(this);" size="60" <? echo $focus;?> />
            </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" width="25%" height="50" class="style12">&nbsp;&nbsp;SUSEP</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
            <label>
            <input name="registro" type="text" class="style12" id="registro" size="17" <? echo $focus;?> onkeypress="return sonumero(this);" />
            </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td  colspan="1" height="50" class="style12">&nbsp;&nbsp;E-mail</td>
    <td  colspan="5" height="50" class="style12"><div align="left" >&nbsp;
          <label>
          <input name="email" type="text" class="style12" id="email" size="60" <? echo $focus;?> />
          </label>
    </div></td>
  </tr>
  <tr onmouseover="this.style.backgroundColor='#0099cc'" onmouseout="javascript:this.style.backgroundColor=''" >
    <td height="27"  colspan="6"  class="style12"><div id="consulta_por">
      <table width="100%" border="00" cellspacing="0" cellpadding="0">
        <tr>
          <td nowrap="nowrap">&nbsp;
            <input name="button2" type="submit" class="botao" id="button2" value="Salvar" onclick="if(document.getElementById('nome').value==''||document.getElementById('registro').value==''){alert('Preencha os campos corretamente');}"/></td>
          </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
<? }?>
<?
if($_POST[nome])
{
$sql_insert_corretor = "REPLACE INTO corretores_bd1 (nome,email,categoria,registro) VALUES (
					'".$_POST[nome]."',
					'".$_POST[email]."',
					'ferramenta',
					'".$_POST[registro]."')";
				
$result_insert_corretor = mysql_query($sql_insert_corretor,$db);
	if($result_insert_corretor)
	{
	echo "<center><h3>".$_POST[nome]."&nbsp;cadastrado com Sucesso!</h3></center>";
	}
}
?>