<? 
if($_GET[div]=="checar_pessoa")
{
if($_GET[dados]=='f'){
?>
<td><div align="right">CPF:</div></td>
                <td><input name="cpf" type="text" onblur="ValidarCPF(cadastro.cpf);" 
    onkeypress="MascaraCPF(cadastro.cpf);" size="20" maxlength="14" /></td>
<?
}if($_GET[dados]=='j'){
?>
<td><div align="right">CNPJ:</div></td>
                <td><input name="cnpj" type="text" onblur="ValidarCNPJ(cadastro.cnpj);" onkeypress="MascaraCNPJ(cadastro.cnpj);" size="20" 
    maxlength="18" /></td>
    
    <?
    }
    }
    ?>