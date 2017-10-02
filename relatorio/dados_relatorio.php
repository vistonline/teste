<?

@session_start();

if($_GET[div]=='checar_relatorio')
{
	if($_GET[dados]=='DTVISTORIA')
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";
	}
	if($_GET[dados]=="DTTRANS")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";
	}
	if($_GET[dados]=="TXT_bradesco")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";
	}
	if($_GET[dados]=="TXT_bradesco_consorcio")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";
	}
	if($_GET[dados]=="TXT_sas")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";
	}
	if($_GET[dados]=="TXT_hdi")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";    
	}
	if($_GET[dados]=='')
	{
	echo "&nbsp;&nbsp;<span class='style19'>Escolha um tipo de relat&oacute;rio</span>";
	}
	if($_GET[dados]=="DTVISTORIA_mapfre")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";    
	}
	if($_GET[dados]=="DTTRANS_mapfre")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";    
	}
	if($_GET[dados]=="DTVISTORIA_caixa")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";    
	}
	if($_GET[dados]=="DTTRANS_caixa")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";    
	}
	if($_GET[dados]=="DTVISTORIA_bb")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";    
	}
	if($_GET[dados]=="DTTRANS_bb")
	{
	echo "&nbsp;&nbsp;Insira a Data de Transmiss&atilde;o";    
	}
	/*
	if($_GET[dados]=="excel_alfa")
	{
	echo "&nbsp;&nbsp;Insira a Data da Vistoria";   
	}
	*/
}
$controle=0;
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='0<>Bradesco Seguros')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="TXT_bradesco">TXT - FATCOM BRADESCO</option>
  <option value="DTVISTORIA_SEGUROS">EXCEL BRADESCO SEGUROS - data de vistoria</option>
  <option value="DTTRANS_SEGUROS">EXCEL BRADESCO SEGUROS - data de transmiss&atilde;o</option>
  <option value="TXT_bradesco_consorcio">TXT - FATCOM BRADESCO CONSORCIO</option>
  <option value="DTVISTORIA_CONSORCIOBRADESCO">EXCEL CONSORCIO - data de vistoria</option>
  <option value="DTTRANS_CONSORCIOBRADESCO">EXCEL CONSORCIO - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
?>

<? 
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='61<>MARITIMA')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="DTVISTORIA_maritima">EXCEL - KM rodado + vistorias realizadas - data de vistoria</option>
  <option value="DTTRANS_maritima">EXCEL - KM rodado + vistorias realizadas - data de transmiss&atilde;o</option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
?>

<? 
$controle=0;
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='67<>SUL AMERICA')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="TXT_sas">TXT - FATCOM SAS</option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
?>

<? 
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='23<>ACE')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="DTVISTORIA_ace">EXCEL - KM rodado + vistorias realizadas - data de vistoria</option>
  <option value="DTTRANS_ace">EXCEL - KM rodado + vistorias realizadas - data de transmiss&atilde;o</option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
?>

<? 
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='44<>CAIXA SEGURADORA')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="DTVISTORIA_caixa">EXCEL - KM rodado + vistorias realizadas - data de vistoria</option>
  <option value="DTTRANS_caixa">EXCEL - KM rodado + vistorias realizadas - data de transmiss&atilde;o</option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
?>

<? 
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='55<>HDI')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="TXT_hdi">TXT - FATCOM HDI</option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<? 
$controle=1;
}
if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='40<>ALFA SEGUROS')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
 <!-- <option value="excel_alfa">EXCEL - ALFA</option> -->
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>  
</select>
<? 
$controle=1;
}

if($_GET[div]=='modifica_relatorio'&&$_GET[dados]=='62<>PORTO SEGURO')
{
?>

<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>

&nbsp;Por empresa: <select name="empresaAgredada" class="style18" id="empresaAgredada" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value="">GERAL</option>
  <option value="1">PORTO SEGURO</option>
  <option value="35">AZUL SEGUROS</option>
  <option value="40">PORTO FINANCIAMENTOS</option>
  <option value="84">ITAU SEGUROS</option>
</select>


<?
}

// EXCETO BRADESCO E MARITIMA E TRUST
if($controle==0&&$_GET[div]=='modifica_relatorio'&&$_GET[dados]!='0<>Bradesco Seguros'&&$_GET[dados]!='61<>MARITIMA'&&$_GET[dados]!='25<>TRUST'&&$_GET[dados]!='62<>PORTO SEGURO')
{
?>
<select name="tipo_relatorio" class="style18" id="tipo_relatorio" onChange="x(this.value,'dados_relatorio','checar_relatorio');">
  <option value=""></option>
  <option value="DTVISTORIA">EXCEL - data de vistoria</option>
  <option value="DTTRANS">EXCEL - data de transmiss&atilde;o</option>
</select>
<?
}
?>
