function valida_cep_vistoria(){
if((document.form1.cep_proponente.value=='' || document.form1.cep_proponente.value=='00000000' || document.form1.cep_proponente.value=='11111111' || document.form1.cep_proponente.value=='22222222' || document.form1.cep_proponente.value=='33333333' || document.form1.cep_proponente.value=='44444444' || document.form1.cep_proponente.value=='55555555' || document.form1.cep_proponente.value=='66666666' || document.form1.cep_proponente.value=='77777777' || document.form1.cep_proponente.value=='88888888' || document.form1.cep_proponente.value=='99999999' || document.form1.cep_proponente.value.length <= 7)){
document.form1.cep_proponente.focus();
document.getElementById('cep_proponente').value="";
window.alert('CEP da vistoria Inválido\nFavor Informar um CEP válido ou a vistoria não será gravada!'); 
return false;
}
}
function validar_cpf(theCPF) 
{ 
  
  if (theCPF.value == "") 
  { 
    alert("Campo inválido. É necessário informar o CPF ou CNPJ"); 
    theCPF.focus(); 
	theCPF.value="";
    return false; 
  } 
  if (((theCPF.value.length == 11) && (theCPF.value == 11111111111) || (theCPF.value == 22222222222) || (theCPF.value == 33333333333) || (theCPF.value == 44444444444) || (theCPF.value == 55555555555) || (theCPF.value == 66666666666) || (theCPF.value == 77777777777) || (theCPF.value == 88888888888) || (theCPF.value == 99999999999) || (theCPF.value == 00000000000))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return false; 
  } 


  if (!((theCPF.value.length == 11) || (theCPF.value.length == 14))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return false;
  } 

  var checkOK = "0123456789"; 
  var checkStr = theCPF.value; 
  var allValid = true; 
  var allNum = ""; 
  for (i = 0;  i < checkStr.length;  i++) 
  { 
    ch = checkStr.charAt(i); 
    for (j = 0;  j < checkOK.length;  j++) 
      if (ch == checkOK.charAt(j)) 
        break; 
    if (j == checkOK.length) 
    { 
      allValid = false; 
      break; 
    } 
    allNum += ch; 
  } 
  if (!allValid) 
  { 
    alert("Favor preencher somente com dígitos o campo CPF/CNPJ."); 
    theCPF.focus(); 
	theCPF.value="";
    return false;
  } 

  var chkVal = allNum; 
  var prsVal = parseFloat(allNum); 
  if (chkVal != "" && !(prsVal > "0")) 
  { 
    alert("CPF zerado !"); 
    theCPF.focus(); 
	theCPF.value="";
    return false;
  } 

if (theCPF.value.length == 11) 
{ 
  var tot = 0; 

  for (i = 2;  i <= 10;  i++) 
    tot += i * parseInt(checkStr.charAt(10 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(9))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return false;
  } 
  
  tot = 0; 
  
  for (i = 2;  i <= 11;  i++) 
    tot += i * parseInt(checkStr.charAt(11 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(10))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return false; 
  } 
} 
else 
{ 
  var tot  = 0; 
  var peso = 2; 
  
  for (i = 0;  i <= 11;  i++) 
  { 
    tot += peso * parseInt(checkStr.charAt(11 - i)); 
    peso++; 
    if (peso == 10) 
    { 
        peso = 2; 
    } 
  } 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(12))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus();
	theCPF.value="";
    return false; 
  } 
  
  tot  = 0; 
  peso = 2; 
  
  for (i = 0;  i <= 12;  i++) 
  { 
    tot += peso * parseInt(checkStr.charAt(12 - i)); 
    peso++; 
    if (peso == 10) 
    { 
        peso = 2; 
    } 
  } 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(13))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return false;
  } 
} 
} 
 
function desabilita_numero_cambio_e_motor()
{
	if(document.form1.situacao_cambio.value!=='13')
		{
			document.getElementById('numero_cambio').setAttribute('disabled','disable');
		} 
		else 
		{
			document.getElementById('numero_cambio').removeAttribute('disabled');
		}
	
	if(document.form1.condicao_numero_motor.value!=='12')
		{
			document.getElementById('NRMOTOR').setAttribute('disabled','disable');
		} 
		else 
		{
			document.getElementById('NRMOTOR').removeAttribute('disabled');
		}
	
 if(document.getElementById('codigo_condicao_carroceria')!=null){
	if(document.form1.codigo_condicao_carroceria.value!=='6')
		{
			document.getElementById('NRCARROC').setAttribute('disabled','disable');
		} 
		else 
		{
			document.getElementById('NRCARROC').removeAttribute('disabled');
		}
	}
}

function valida()
{
if(document.form1.SEGURADORA.value=='')
{
document.form1.SEGURADORA.focus();
window.alert('Preencha o campo:\nSeguradora');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.KM_rodado.value=='')
{
document.form1.KM_rodado.focus();
window.alert('Preencha o campo:\nQuilometragem Rodada para realizacao da VP');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.TPVISTORIA.value=='Nenhum')
{
document.form1.TPVISTORIA.focus();
window.alert('Preencha o campo:\nTipo da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.TPVISTORIA.value=='P' && document.form1.endereco_posto.value=='')
{
document.form1.endereco_posto.focus();
window.alert('Preencha o campo:\nPosto de Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.controle_prest.value=='')
{
document.form1.controle_prest.focus();
window.alert('Preencha o campo:\nVistoriador');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='3'||document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='10'){

var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);
if(document.form1.DTVISTORIA.value==''){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Previa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(data3<parseInt(document.form1.controle_data.value)){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\nData da Vistoria Previa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(data3>parseInt(document.form1.DTPROC.value)){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Previa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)<2016){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Prévia corretamente. Não é aceito ano inferior a 2016.');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

}
if(document.form1.HRVISTORIA.value==''){
document.form1.HRVISTORIA.focus();
window.alert('Preencha o campo:\nHora inicial da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.HRVISTORIA1.value==''){
document.form1.HRVISTORIA1.focus();
window.alert('Preencha o campo:\nHora Final da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.CDFINALIDADE.value==''){
document.form1.CDFINALIDADE.focus();
window.alert('Selecione a finalidade da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.CDcorretor.value==''){
document.form1.CDcorretor.focus();
window.alert('Preencha o campo:\nCodigo do Corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.corretor2.value==''){
document.form1.corretor2.focus();
window.alert('Preencha o campo:\nCorretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NMPROPONENTE.value==''){
document.form1.NMPROPONENTE.focus();
window.alert('Preencha o campo:\nNome do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.sexo_proponente.value==''){
document.form1.sexo_proponente.focus();
window.alert('Preencha o campo:\nSexo do Proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.tipo_pessoa.value==''){
document.form1.tipo_pessoa.focus();
window.alert('Preencha o campo:\nTipo de pessoa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if((document.form1.cep_proponente.value=='' || document.form1.cep_proponente.value=='00000000' || document.form1.cep_proponente.value=='11111111' || document.form1.cep_proponente.value=='22222222' || document.form1.cep_proponente.value=='33333333' || document.form1.cep_proponente.value=='44444444' || document.form1.cep_proponente.value=='55555555' || document.form1.cep_proponente.value=='66666666' || document.form1.cep_proponente.value=='77777777' || document.form1.cep_proponente.value=='88888888' || document.form1.cep_proponente.value=='99999999' || document.form1.cep_proponente.value.length <= 7)){
document.form1.cep_proponente.focus();
document.getElementById('cep_proponente').value="";
window.alert('Preencha o campo:\nCEP do proponente vazio ou invalido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.estado_proponente.value==''){
document.form1.estado_proponente.focus();
window.alert('Preencha o campo:\nEstado do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cidade_proponente.value==''){
document.form1.cidade_proponente.focus();
window.alert('Preencha o campo:\nCidade do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.bairro_proponente.value==''){
document.form1.bairro_proponente.focus();
window.alert('Preencha o campo:\nBairro do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.endereco_proponente.value==''){
document.form1.endereco_proponente.focus();
window.alert('Preencha o campo:\nEndereco do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.numero_proponente.value==''){
document.form1.numero_proponente.focus();
window.alert('Preencha o campo:\nNumero Proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.complemento_proponente.value==''){
document.form1.complemento_proponente.focus();
window.alert('Preencha o campo:\nComplemento Proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.telefone_proponente.value==''){
document.form1.telefone_proponente.focus();
window.alert('Preencha o campo:\nTelefone do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cpf_cnpj.value==''){
document.form1.cpf_cnpj.focus();
window.alert('Preencha o campo:\nCPF / CNPJ Proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.nome_s.value==''){
document.form1.nome_s.focus();
window.alert('Preencha o campo:\nNome do Solicitante');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.segurado_responsavel.value==''){
document.form1.segurado_responsavel.focus();
window.alert('Preencha o campo:\nSegurado e o Responsavel pelo Veiculo?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.segurado_responsavel.value=='N')
{
	if (document.form1.tipo_responsavel.value=='')
		{
			document.form1.tipo_responsavel.focus();
			window.alert('Preencha o campo:\nTipo do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.nome_responsavel.value=='')
		{
			document.form1.nome_responsavel.focus();
			window.alert('Preencha o campo:\nNome do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.rg_responsavel.value=='')
		{
			document.form1.rg_responsavel.focus();
			window.alert('Preencha o campo:\nRG do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.cpf_cnpj_responsavel.value=='')
		{
			document.form1.cpf_cnpj_responsavel.focus();
			window.alert('Preencha o campo:\nCPF / CNPJ do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.ddd_responsavel.value=='')
		{
			document.form1.ddd_responsavel.focus();
			window.alert('Preencha o campo:\nDDD do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.fone_responsavel.value=='')
		{
			document.form1.fone_responsavel.focus();
			window.alert('Preencha o campo:\nTelefone do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}

}

if(document.form1.principal_condutor.value==''){
document.form1.principal_condutor.focus();
window.alert('Preencha o campo:\nSegurado e o Principal Condutor?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


	
if(document.form1.principal_condutor.value=='N')
{


	if (document.form1.vinculo_segurado.value=='')
		{
			document.form1.vinculo_segurado.focus();
			window.alert('Preencha o campo:\nVinculo com o Segurado');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
	if (document.form1.nome_condutor.value=='')
		{
			document.form1.nome_condutor.focus();
			window.alert('Preencha o campo:\nNome do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.sexo_condutor.value=='')
		{
			document.form1.sexo_condutor.focus();
			window.alert('Preencha o campo:\nSexo do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.cpf_condutor.value=='')
		{
			document.form1.cpf_condutor.focus();
			window.alert('Preencha o campo:\nCPF / CNPJ do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.rg_condutor.value=='')
		{
			document.form1.rg_condutor.focus();
			window.alert('Preencha o campo:\nRG do Responsavel');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.estado_civil_condutor.value=='')
		{
			document.form1.estado_civil_condutor.focus();
			window.alert('Preencha o campo:\nEstado Civil do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.ano_posse.value=='')
		{
			document.form1.ano_posse.focus();
			window.alert('Preencha o campo:\nAnos de posse do veiculo');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.mes_posse.value=='' || document.form1.mes_posse.value >= 13)
		{
			document.form1.mes_posse.focus();
			window.alert('Preencha o campo:\nMeses de posse do veiculo\nVazio ou Invalido');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.dia_posse.value=='' || document.form1.dia_posse.value >= 32)
		{
			document.form1.dia_posse.focus();
			window.alert('Preencha o campo:\nDias de posse do veiculo\nVazio ou Invalido');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
	if (document.form1.numero_cnh_condutor.value=='')
		{
			document.form1.numero_cnh_condutor.focus();
			window.alert('Preencha o campo:\nNumero CNH do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
	if (document.form1.categoria_cnh_condutor.value=='')
		{
			document.form1.categoria_cnh_condutor.focus();
			window.alert('Preencha o campo:\nCategoria da CNH do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
	if (document.form1.data_exame_medico.value=='')
		{
			document.form1.data_exame_medico.focus();
			window.alert('Preencha o campo:\nData do Exame Medico');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
	if (document.form1.nascimento_condutor.value=='')
		{
			document.form1.nascimento_condutor.focus();
			window.alert('Preencha o campo:\nData de Nascimento do Condutor');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.in_sinistro.value=='')
		{
			document.form1.in_sinistro.focus();
			window.alert('Preencha o campo:\nHouve Sinistro Anteriormente?');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	if (document.form1.idade_condutor_1.value=='')
		{
			document.form1.idade_condutor_1.focus();
			window.alert('Preencha o campo:\nInforme ao menos a idade do Condutor 1');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}	

}

if (document.form1.utilizacao_veiculo.value=='')
		{
			document.form1.utilizacao_veiculo.focus();
			window.alert('Preencha o campo:\nInforme a utilizacao do veiculo');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
		
if(document.form1.fabricante.value=='0'){
document.form1.fabricante.focus();
window.alert('Selecione o\n Fabricante do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.modelo.value=='0' || document.form1.modelo.value==''){
document.form1.modelo.focus();
window.alert('Preencha o campo:\n Modelo do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.versao.value=='0' || document.form1.versao.value==''){
document.form1.versao.focus();
window.alert('Preencha o campo:\n Versao do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}



if(document.form1.NRPLACA.value==''){
document.form1.NRPLACA.focus();
window.alert('Preencha o campo:\nNº da Placa (Se veiculo 0KM digite na placa AVI0000)');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPLACA1.value==''){
document.form1.NRPLACA1.focus();
window.alert('Preencha o campo:\nNº da Placa novamente (Se veiculo 0KM digite na placa AVI0000)');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPLACA.value!=''){
var placa=document.form1.NRPLACA.value;
var PlacaValida=new RegExp("([A-z0-9]{7})");
erro=false;
	if (placa.search(PlacaValida)==-1){
		erro = true;
		}
	if (erro) {
		alert("\"" + placa + "\" não é uma PLACA válida!!!");
		document.form1.NRPLACA.value = "";
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
	}
}

if(document.form1.NRPLACA1.value!=''){
var placa=document.form1.NRPLACA1.value;
var PlacaValida=new RegExp("([A-z0-9]{7})");
erro=false;
	if (placa.search(PlacaValida)==-1){
		erro = true;
		}
	if (erro) {
		alert("\"" + placa + "\" não é uma PLACA válida!!!");
		document.form1.NRPLACA1.value = "";
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
	}
}


var placa_i = document.form1.NRPLACA.value;
var placa_p = document.form1.NRPLACA1.value;
if(placa_i!==placa_p){
document.form1.NRPLACA1.focus();
window.alert('Placa não confere Redigite o campo:\nNº da Placa ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.getElementById('placaRecebida')!=null){
	
		var placaRecebida=document.getElementById('placaRecebida').value.toUpperCase();
		var placaDigitada=document.form1.NRPLACA.value.toUpperCase();
	
	if((document.getElementById('placaRecebida').value!='') && (placaRecebida!=placaDigitada) ){
	resposta = confirm('A placa recebida no agendamento ('+placaRecebida+') é diferente da placa digitada ('+placaDigitada+').\n\nPara CONFIRMAR que a placa digitada está correta e a vistoria é realmente deste agendamento clique em "OK".\n\nPara verificar se este laudo é realmente deste agendamento clique em "CANCELAR".');
		if(resposta == true){
			
			}else{
				document.form1.NRPLACA.focus();
				document.getElementById('buttonGravar1').removeAttribute('hidden');
				document.getElementById('buttonGravar2').removeAttribute('hidden');
				return false;
				}
	}
}

if(document.form1.DSMUNICIPIOPLACA.value==''){
document.form1.DSMUNICIPIOPLACA.focus();
window.alert('Preencha o campo:\n Municipio da placa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.UFPLACA.value==''){
document.form1.UFPLACA.focus();
window.alert('Preencha o campo:\n UF da placa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.classe_localizacao.value==''){
document.form1.classe_localizacao.focus();
window.alert('Preencha o campo:\n Classe de Localizacao');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_placa.value==''){
document.form1.condicao_placa.focus();
window.alert('Preencha o campo:\nCondicao da placa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRANOFABRICACAO.value==''){
document.form1.NRANOFABRICACAO.focus();
window.alert('Preencha o campo:\nAno de Fabricação do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRANOMODELO.value==''){
document.form1.NRANOMODELO.focus();
window.alert('Preencha o campo:\nAno do Modelo do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.tracao.value==''){
document.form1.tracao.focus();
window.alert('Preencha o campo:\nTracao do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tracao1.value==''){
document.form1.tracao1.focus();
window.alert('Preencha o campo:\nTracao do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.potencia.value==''){
document.form1.potencia.focus();
window.alert('Preencha o campo:\nPotencia');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


/*
if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Selecione o uso do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/

if(document.form1.possui_carroceria.value==''){
document.form1.possui_carroceria.focus();
window.alert('Preencha o campo:\nVeiculo possui carroceria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.possui_carroceria.value=='S'){
	
	if(document.form1.codigo_condicao_carroceria.value==''){
document.form1.codigo_condicao_carroceria.focus();
window.alert('Selecione o campo:\nCondicao da Carroceria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');	

return false;
	}
	
	
	if(document.form1.DSMARCACARROC.value=='')
		{
			document.form1.DSMARCACARROC.focus();
			window.alert('Preencha o campo:\nMarca da Carroceria');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			
			return false;
		}
	
	if(document.form1.TPCARROC.value=='')
		{
			document.form1.TPCARROC.focus();
			window.alert('Preencha o campo:\nTipo da Carroceria');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			
			return false;
		}
	if(document.form1.NRCARROC.value=='' && document.form1.codigo_condicao_carroceria.value=='6')
		{
			document.form1.NRCARROC.focus();
			window.alert('Preencha o campo:\nNumero da Carroceria ou troque a Condicao da Carroceria');
			document.getElementById('buttonGravar1').removeAttribute('hidden');
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			
			return false;
		}
	
}


if(document.form1.NRPORTAS.value==''){
document.form1.NRPORTAS.focus();
window.alert('Preencha o campo:\nNúmero de portas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cor.value==''){
document.form1.cor.focus();
window.alert('Preencha o campo:\nCor do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPPINTURA.value==''){
document.form1.TPPINTURA.focus();
window.alert('Preencha o campo:\nTipo de Pintura do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.tonalidade_pintura.value==''){
document.form1.tonalidade_pintura.focus();
window.alert('Preencha o campo:\nTonalidade da Pintura');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}




if(document.form1.TPCOMBUSTIVEL.value==''){
document.form1.TPCOMBUSTIVEL.focus();
window.alert('Preencha o campo:\nTipo de Combustível do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.KMVEICULO.value==''){
document.form1.KMVEICULO.focus();
window.alert('Preencha o campo:\nQuilometragem do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.INALIENADO.value==''){
document.form1.INALIENADO.focus();
window.alert('Preencha o campo:\nVeiculo alienado?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.INALIENADO.value=='S')
{
	if(document.form1.NMALIENADOR.value=='')
	{
	document.form1.NMALIENADOR.focus();
	window.alert('Preencha o campo:\nEmpresa alienadora');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
}

if(document.form1.NRCHASSI.value==''){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.CHASSI.value==''){
document.form1.CHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi novamente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
var chassi_i = document.form1.NRCHASSI.value;
var chassi_p = document.form1.CHASSI.value;
if(chassi_i!==chassi_p){
document.form1.NRCHASSI.focus();
window.alert('Redigite o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRANOFABRICACAO.value>='1989'&&document.form1.NRCHASSI.value.length<=16){
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length<=7||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==10||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==11||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==12||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==13||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==14||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==15||
document.form1.NRANOFABRICACAO.value<='1988'&&document.form1.NRCHASSI.value.length==16)
{
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_chassi.value==''){
document.form1.condicao_chassi.focus();
window.alert('Preencha o campo:\nCondicao do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRMOTOR.value=='' && document.form1.condicao_numero_motor.value =='12'){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNumero do Motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_numero_motor.value==''){
document.form1.condicao_numero_motor.focus();
window.alert('Preencha o campo:\nCondicao do Numero do motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.marchas.value==''){
document.form1.marchas.focus();
window.alert('Preencha o campo:\nNumero de Marchas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

      
if(document.form1.situacao_cambio.value==''){
document.form1.situacao_cambio.focus();
window.alert('Preencha o campo:\nCondicao do Cambio');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.data_cinto.value=='' && document.form1.condicao_cinto.value !=='1'){
document.form1.data_cinto.focus();
window.alert('Preencha o campo:\nData do cinto');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_cinto.value==''){
document.form1.condicao_cinto.focus();
window.alert('Selecione a Condicao do Cinto');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.cilindros.value=='' || document.form1.cilindros.value.length < 4){
document.form1.cilindros.focus();
window.alert('Preencha o campo:\nCilindradas\nCampo Vazio ou Menor que 4 digitos');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.valvulas.value==''){
document.form1.valvulas.focus();
window.alert('Preencha o campo:\nQtde. Valvulas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.tipo_freio.value==''){
document.form1.tipo_freio.focus();
window.alert('Preencha o campo:\nTipo de Freio');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.INTRANSF.value==''){
document.form1.INTRANSF.focus();
window.alert('Preencha o campo:\nVeiculo Transformado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.blindado.value==''){
document.form1.blindado.focus();
window.alert('Preencha o campo:\nVeiculo Blindado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.rebaixado.value==''){
document.form1.rebaixado.focus();
window.alert('Preencha o campo:\nVeiculo Rebaixado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.longarina.value==''){
document.form1.longarina.focus();
window.alert('Preencha o campo:\nLongarina');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.painel_corta_fogo.value==''){
document.form1.painel_corta_fogo.focus();
window.alert('Preencha o campo:\nPainel Corta Fogo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.paralama_interno.value==''){
document.form1.paralama_interno.focus();
window.alert('Preencha o campo:\nParalama Interno');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.torre_amortecedores.value==''){
document.form1.torre_amortecedores.focus();
window.alert('Preencha o campo:\nTorre dos Amortecedores');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.assoalho.value==''){
document.form1.assoalho.focus();
window.alert('Preencha o campo:\nAssoalho');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_motor.value==''){
document.form1.condicao_motor.focus();
window.alert('Preencha o campo:\nCondicao do Motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.possui_avarias.value==''){
document.form1.possui_avarias.focus();
window.alert('Preencha o campo:\nPossui Avarias');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.recuperado_colisao.value==''){
document.form1.recuperado_colisao.focus();
window.alert('Preencha o campo:\nRecuperado de Colisao');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.condicao_veiculo.value==''){
document.form1.condicao_veiculo.focus();
window.alert('Preencha o campo:\nCondicao do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.veiculo_emendado.value==''){
document.form1.veiculo_emendado.focus();
window.alert('Preencha o campo:\nVeiculo Emendado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.decalque_chassi.value==''){
document.form1.decalque_chassi.focus();
window.alert('Preencha o campo:\nDecalque do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.fotos_veiculo.value==''){
document.form1.fotos_veiculo.focus();
window.alert('Preencha o campo:\nFotos do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.plaqueta_fotos.value==''){
document.form1.plaqueta_fotos.focus();
window.alert('Preencha o campo:\nPlaqueta de Fotos');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.opcoes.value=='1' && document.form1.acessorioBase.value=='undefined'){
document.form1.acessorioBase.focus();
window.alert('Preencha o campo:\nEscolha um acessorio valido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.opcoes.value=='1' && document.form1.acessorioBase.value!='undefined' && (document.form1.qtdeAcessorioBase.value =='' || document.form1.qtdeAcessorioBase.value ==' ' || document.form1.qtdeAcessorioBase.value =='  ' || document.form1.qtdeAcessorioBase.value =='   ' || document.form1.qtdeAcessorioBase.value =='0' || document.form1.qtdeAcessorioBase.value =='00')){
document.form1.qtdeAcessorioBase.focus();
window.alert('Preencha o campo:\nPreencha a Quantidade do Acessorio\nEsta vazia ou com Espaços em Branco');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.opcoes.value=='2' && document.form1.dispositivoBase.value=='undefined'){
document.form1.dispositivoBase.focus();
window.alert('Preencha o campo:\nEscolha um Dispositivo valido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.opcoes.value=='3' && document.form1.equipamentoBase.value=='undefined'){
document.form1.equipamentoBase.focus();
window.alert('Preencha o campo:\nEscolha um Equipamento valido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.opcoes.value=='3' && document.form1.equipamentoBase.value!='undefined' && (document.form1.equipamentoBase.value =='' || document.form1.equipamentoBase.value ==' ' || document.form1.equipamentoBase.value =='  ' || document.form1.equipamentoBase.value =='   ' || document.form1.equipamentoBase.value =='0' || document.form1.equipamentoBase.value =='00')){
document.form1.equipamentoBase.focus();
window.alert('Preencha o campo:\nPreencha a Quantidade do Equipamento');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.grav_vidros.value==''){
document.form1.grav_vidros.focus();
window.alert('Informe o campo:\nGravacao de Vidro');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.grav_vidros.value=='S')
{
if(document.form1.quantidade_vidros.value=='')
	{
	document.form1.quantidade_vidros.focus();
	window.alert('Preencha o campo:\nQuantidade de vidros');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
}

if(document.form1.pneus.value==''){
document.form1.pneus.focus();
window.alert('Preencha o campo:\nAro pneus');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.pneus_ruins.value==''){
document.form1.pneus_ruins.focus();
window.alert('Preencha o campo:\nQuantidade de Pneus Ruins');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.avaliacao.value==''){
document.form1.avaliacao.focus();
window.alert('Informe o campo:\nRisco Aceitavao');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.parecer.value==''){
document.form1.parecer.focus();
window.alert('Informe o campo:\nParecer');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.getElementById('documento6').checked==''){

if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Preencha o campo:\nN de Renavam do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.NRRENAVAM.value.length<9||document.form1.NRRENAVAM.value.length==10||document.form1.NRRENAVAM.value.length>11){
document.form1.NRRENAVAM.focus();  
window.alert('Renavam INVÁLIDO (aceita apenas com 9 ou 11 dígitos)');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');	
return false;
	}
	
if(document.form1.NRRENAVAM.value.length==9){
var char1 = document.form1.NRRENAVAM.value.charAt(0)*2;
var char2 = document.form1.NRRENAVAM.value.charAt(1)*3;
var char3 = document.form1.NRRENAVAM.value.charAt(2)*4;
var char4 = document.form1.NRRENAVAM.value.charAt(3)*5;
var char5 = document.form1.NRRENAVAM.value.charAt(4)*6;
var char6 = document.form1.NRRENAVAM.value.charAt(5)*7;
var char7 = document.form1.NRRENAVAM.value.charAt(6)*8;
var char8 = document.form1.NRRENAVAM.value.charAt(7)*9;
var char9 = document.form1.NRRENAVAM.value.charAt(8);
var soma = char1+char2+char3+char4+char5+char6+char7+char8;
var divide = (soma%11);
var res = divide+'';
var res1 = char9+'';
if(res=='10'){res='0';}
if(res1==''){res1='0';}
if (res!==res1) 
{
document.form1.NRRENAVAM.focus();
window.alert("Preencha o campo \n Número de RENAVAM do Veículo.");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
}

if(document.form1.NRRENAVAM.value.length==11){
var valor=document.form1.NRRENAVAM.value;

var char0 = valor.charAt(0)*3;
var char1 = valor.charAt(1)*2;
var char2 = valor.charAt(2)*9;
var char3 = valor.charAt(3)*8;
var char4 = valor.charAt(4)*7;
var char5 = valor.charAt(5)*6;
var char6 = valor.charAt(6)*5;
var char7 = valor.charAt(7)*4;
var char8 = valor.charAt(8)*3;
var char9 = valor.charAt(9)*2;
var char10 = valor.charAt(10);
var soma = char0+char1+char2+char3+char4+char5+char6+char7+char8+char9;
var total= soma*10;
var divide = (total%11);
var res = divide+'';
var res1 = char10+'';
if(res=='10'){res='0';}
if(res1==''){res1='0';}
if (res!==res1) 
{
document.form1.NRRENAVAM.focus();
window.alert("Preencha o campo \n Número de RENAVAM do Veículo.");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}
}


if(document.form1.NRDUT.value==''){
document.form1.NRDUT.focus();
window.alert('Preencha o campo:\nNumero do DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.exercicio_dut.value==''){
document.form1.exercicio_dut.focus();
window.alert('Preencha o campo:\nAno Exercicio Dut');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NMDUT.value==''){
document.form1.NMDUT.focus();
window.alert('Preencha o campo:\nNome que consta no DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.cidade_dut.value==''){
document.form1.cidade_dut.focus();
window.alert('Preencha o campo:\nCidade de Expedicao no DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NMORGAODUT.value==''){
document.form1.NMORGAODUT.focus();
window.alert('Preencha o campo:\nUF de Expedicao no DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

}




}
