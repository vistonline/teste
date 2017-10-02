<?php

include "../../adm/conecta.php";
include "../verifica.php";
ini_set("memory_limit","90M");


$sql_cliente = "SELECT * FROM webvist.controle_vp_ferramentas WHERE roteirizador =".$_POST['cod_prest'];
$result_cliente = mysql_query($sql_cliente,$db);
$cliente = mysql_fetch_array($result_cliente);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="JavaScript" type="text/javascript" src="../../Users/ROBSON/Desktop/richtext.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>.:: VistOn-Line ::.</title>
<style type="text/css">
<!--
.style1 {
	color: #000;
	text-align: center;
}
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style13 {
	font-size: 9px
}
.style14 {color: #333333; font-family: Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; }
-->
.style12 {	color: #333333;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style15 {color: #000066}
</style>
<!-- Copyright 2000, 2001, 2002, 2003, 2004, 2005 Macromedia, Inc. All rights reserved. -->
</head>

<body>

	
<form action="AlterarListaConfiguracoes.php" method="post" name="form1" id="form1">
<table width="100%" border="00" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" style="color:#FFF; background:#000; text-align:center; font-weight:bold">&nbsp;&nbsp;Configurando Cliente: <? echo "<b>".$cliente['nomeVistoriadora']."</b>"?></td>
  </tr>
  <input name="rot" id="rot" type="hidden" value="<? echo $_POST['cod_prest'];?>" />
  <!--
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;SMS?:</td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="contem_sms" class="style12" id="contem_sms">
        <option value="0" <? if($cliente['contem_sms']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['contem_sms']==1) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp; utiliza ferramente de envio de SMS.
    </div></td>
  </tr>
  -->
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;E-mail Obrigat&oacute;rio?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="email_obrigatorio" class="style12" id="email_obrigatorio">
        <option value="0" <? if($cliente['email_obrigatorio']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['email_obrigatorio']==1) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;&eacute; obrigat&oacute;rio e-mail na solicita&ccedil;&atilde;o.
    </div></td>
  </tr>
    <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Vistoriador confirma Pagamento?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="prestador_confirma_pagamento" class="style12" id="prestador_confirma_pagamento">
        <option value="0" <? if($cliente['prestador_confirma_pagamento']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['prestador_confirma_pagamento']==1) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;aparece bot&atilde;o para o vistoriador confirmar o pagamento.
    </div></td>
  </tr>
      <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Operadora de Celular na Solicita&ccedil;&atilde;o?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="operadora_solicitacao" class="style12" id="operadora_solicitacao">
        <option value="0" <? if($cliente['operadora_solicitacao']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['operadora_solicitacao']==1) echo "selected=selected";?>>SIM</option>
        </select>
       ,&nbsp;aparece campo para selecionar a operadora de celular.
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Utiliza VistMobile?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="appmobile" class="style12" id="appmobile">
        <option value="NAO" <? if($cliente['appmobile']==''||$cliente['appmobile']=='NAO') echo "selected=selected";?>>NÃO</option>
        <option value="SIM" <? if($cliente['appmobile']=='SIM') echo "selected=selected";?>>SIM</option>
        </select>
       ,&nbsp;fechou contrato do VistMobile.
    </div></td>
  </tr>
   <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Tamanho das fotos para envio?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="appmobilePadraoFotos" class="style12" id="appmobilePadraoFotos">
        <option value="1" <? if($cliente['appmobilePadraoFotos']==1) echo "selected=selected";?>>NÃO</option>
        <option value="0" <? if($cliente['appmobilePadraoFotos']==0) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;usar padr&atilde;o de fotos no Mobile (640x480) antes do envio.
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Cliente Estipula fotos?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="appmobileTipoFotos" class="style12" id="appmobileTipoFotos">
        <option value="0" <? if($cliente['appmobileTipoFotos']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['appmobileTipoFotos']==1) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;é estipulado quais fotos o vistoriador deve fotografar.
    </div></td>
  </tr>  
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Roteiriza&ccedil;&atilde;o por CEP?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="distSolicitacaoCEP" class="style12" id="distSolicitacaoCEP">
        <option value="NAO" <? if($cliente['distSolicitacaoCEP']==''||$cliente['distSolicitacaoCEP']=='NAO') echo "selected=selected";?>>NÃO</option>
        <option value="SIM" <? if($cliente['distSolicitacaoCEP']=='SIM') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;distribui solicita&ccedil;&otilde;es de acordo com o CEP.
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Desconta erros do vistoriador?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="desconta_prestador" class="style12" id="desconta_prestador">
        <option value="0" <? if($cliente['desconta_prestador']==0) echo "selected=selected";?>>NÃO</option>
        <option value="1" <? if($cliente['desconta_prestador']==1) echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;aplica desconto em casos de erros do vistoriador.
    </div></td>
  </tr>
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Libera apenas UFs das Filiais?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="ufFiliais" class="style12" id="ufFiliais">
        <option value="nao" <? if($cliente['ufFiliais']=='nao'||$cliente['ufFiliais']=='') echo "selected=selected";?>>NÃO</option>
        <option value="sim" <? if($cliente['ufFiliais']=='sim') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;aparece apenas as UFs das filiais.
    </div></td>
  </tr>
   <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Limita qtde. de an&aacute;lise simult&acirc;nea do analista?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="limitadorDeAnalise" class="style12" id="limitadorDeAnalise">
        <option value="nao" <? if($cliente['limitadorDeAnalise']=='nao'||$cliente['limitadorDeAnalise']=='') echo "selected=selected";?>>NÃO</option>
        <option value="sim" <? if($cliente['limitadorDeAnalise']=='sim') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;o analista possui um limite de an&aacute;lises simult&acirc;neas.
    </div></td>
  </tr> 
   <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Ferramenta de controle de laudos f&iacute;sicos?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="contoleLaudoFisico" class="style12" id="contoleLaudoFisico">
        <option value="nao" <? if($cliente['contoleLaudoFisico']=='nao'||$cliente['contoleLaudoFisico']=='') echo "selected=selected";?>>NÃO</option>
        <option value="sim" <? if($cliente['contoleLaudoFisico']=='sim') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;utizada a ferramenta de controle de laudos (distribui&ccedil;&atilde;o, utiliza&ccedil;&atilde;o e cancelamento).
    </div></td>
  </tr> 
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Controle de Frustradas?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="controlaFrustradas" class="style12" id="controlaFrustradas">
        <option value="nao" <? if($cliente['controlaFrustradas']=='nao'||$cliente['controlaFrustradas']=='') echo "selected=selected";?>>NÃO</option>
        <option value="sim" <? if($cliente['controlaFrustradas']=='sim') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;analista as frustradas antes do envio para as seguradoras.
    </div></td>
  </tr> 
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Controle de Rean&aacute;lise?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="controlaReanalise" class="style12" id="controlaReanalise">
        <option value="nao" <? if($cliente['controlaReanalise']=='nao'||$cliente['controlaReanalise']=='') echo "selected=selected";?>>NÃO</option>
        <option value="sim" <? if($cliente['controlaReanalise']=='sim') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;<? if($cliente['controlaReanalise']=='sim'){
			echo "somente o analista que analisou ou um administrador pode reanalizar a vistoria.";
			}else{
				echo "Qualquer analista ou administrador pode reanlisar vistoria, mesmo que analistada por outra pessoa.";
				}?>
    </div></td>
  </tr>   
  <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Ferramenta de pr&eacute;-cadastro?: </td>
    <td> <div align="left" class="style12">&nbsp;
        <select name="preCadastro" class="style12" id="preCadastro">
        <option value="NAO" <? if($cliente['preCadastro']=='NAO'||$cliente['preCadastro']=='') echo "selected=selected";?>>NÃO</option>
        <option value="SIM" <? if($cliente['preCadastro']=='SIM') echo "selected=selected";?>>SIM</option>
        </select>
        ,&nbsp;utiliza ferramente de pr&eacute;-cadastro, para envio das fotos para digita&ccedil;&atilde;o posterior.			
    </div></td>
  </tr>
   <TR onMouseOver="this.style.backgroundColor='#0099cc'" onMouseOut="javascript:this.style.backgroundColor=''" >
    <td width="25%" height="30" class="style12">&nbsp;Roteirizadores integrados: </td>
    <td> <div align="left" class="style12">&nbsp;<input type="text" disabled="disabled" value="<? echo $cliente['empresasIntegradas'];?>" />

    &nbsp;empresa baixa as seguradoras destes reteirizadores tamb&eacute;m no Mobile.</div></td>
  </tr>

  <tr> 
    <td height="27" colspan="2">
      <input name="button" type="submit" class="botao2" id="button" value="Salvar" /></td>
  </tr>
  
</table>


</form>



<?



?>
</body>
</html>
