

// função que desabilita ou habilita campos para vistoria light e normal
function valida_cep_vistoria(){
if((document.form1.tipo_endereco.value=='2') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
document.form1.cep.focus();
document.getElementById('cep').value="";
window.alert('CEP da vistoria Inválido\nFavor Informar um CEP válido ou a vistoria não será gravada!'); 
return false;
}
}

function desabilita_campos1()
{
	switch(document.getElementById('CDFINALIDADE').value)
	  {//Casos que  desabilitam o campo Voucher
		case "04":
		case "06":
		case "07":
        case "08":
        case "09":
		  document.getElementById('proposta').setAttribute('disable', 'disabled');
		break;
		default:
		  document.getElementById('proposta').removeAttribute('disable');
	  
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
    alert("CPF/CNPJ invÃ¡lido."); 
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
  }//inserir pessoa física
  //document.form1.tipo_pessoa[2].selected = true;
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
function valida(){


if(document.form1.SEGURADORA.value=='')
{
document.form1.SEGURADORA.focus();
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
window.alert('Preencha o campo:\nSeguradora');

return false;
}

if(document.form1.NRVISTORIA.value==''){
	document.form1.NRVISTORIA.focus();
	window.alert('Preencha o campo:\nNº da Vistoria ');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
if(document.form1.CDFINALIDADE.value==''){
document.form1.CDFINALIDADE.focus(); 
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
window.alert('Preencha o campo:\nFinalidade da realizacao da vistoria');

return false;
} 
if(document.form1.roteirizador_validacao.value != 627)
	{
		if(document.form1.proposta.value=='' || document.form1.proposta.value.length <= 4)
			{
				document.form1.proposta.focus();
				window.alert('Selecione o campo:\nNumero do Voucher Invalido ou Incompleto');
				
document.getElementById('buttonGravar1').removeAttribute('hidden');
				
document.getElementById('buttonGravar2').removeAttribute('hidden');

				return false;
			}
	} else {};
//04, 08,09,07,06
switch(document.form1.CDFINALIDADE.value)
	  {
		case '04':
		case '06':
		case '07':
		case '08':
		case '09': break;
		default: if (document.form1.proposta.value=='')
						{
						   document.form1.proposta.focus();
						   window.alert('Preencha o campo:\nNumero do Voucher');
						   document.getElementById('buttonGravar1').removeAttribute('hidden');
						   document.getElementById('buttonGravar2').removeAttribute('hidden');

						   return false;
						}
	  }


if(document.form1.tipo_endereco.value==''){
document.form1.tipo_endereco.focus();
window.alert('Selecione o campo:\nLocal onde foi feito a Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.tipo_endereco.value=='1'&&document.form1.endereco_posto.value==''){
document.form1.endereco_posto.focus();
window.alert('Preencha o campo:\nEndereco do Posto');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2' && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999')){
document.getElementById('cep').value="";
document.form1.cep.focus();

window.alert('Preencha o campo:\nCEP do Local da Vistoria invalido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.cep.value.length <='7'){
window.alert('Preencha o campo:\nCEP do Local da Vistoria invalido menos que 8 digitos');
document.form1.cep.focus();
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.endereco.value==''){
document.form1.endereco.focus();
window.alert('Preencha o campo:\nEndereco do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.UF.value==''){
document.form1.UF.focus();	
window.alert('Preencha o campo:\nUF do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.bairro.value==''){
document.form1.bairro.focus();	
window.alert('Preencha o campo:\nBairro do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.cidade.value==''){
document.form1.cidade.focus();
window.alert('Preencha o campo:\nCidade do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.tipo_endereco.value=='2'&& document.form1.numero.value==''){
document.form1.numero.focus();
window.alert('Preencha o campo:\nNúmero do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.CPF_CNPJ_Proponente.value.length > '11' && document.form1.tipo_pessoa.value=='PF'){
	document.form1.tipo_pessoa.focus(); 
	window.alert('O tipo de pessoa deve ser JURÍDICA, pois foi informado CNPJ no campo CPF/CNPJ');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
    document.getElementById('buttonGravar2').removeAttribute('hidden');

	return false;
}

if(document.form1.CPF_CNPJ_Proponente.value.length <= '11' && document.form1.tipo_pessoa.value=='PJ'){
	document.form1.tipo_pessoa.focus(); 
	window.alert('O tipo de pessoa deve ser FÍSICA, pois foi informado CPF no campo CPF/CNPJ');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
    document.getElementById('buttonGravar2').removeAttribute('hidden');

	return false;
}

if(document.form1.CPF_CNPJ_Proponente.value==''){
document.form1.CPF_CNPJ_Proponente.focus();
window.alert('Preencha o campo:\nCPF/CNPJ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.controle_prest.value==''){
document.form1.controle_prest.focus();
window.alert('Selecione o campo:\nVistoriador que realizou a Vistoria');
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
window.alert('Preencha o campo:\nHora da realizacao da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.TPVISTORIA.value==''){
document.form1.TPVISTORIA.focus();
window.alert('Preencha o campo:\nTipo Da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NMPROPONENTE.value==''){
document.form1.NMPROPONENTE.focus();
window.alert('Preencha o campo:\nNome do Proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

// o nome do campo foi mudado de "telefone" para "tel2"
if(document.form1.tel2.value==''){
document.form1.tel2.focus();
window.alert('Preencha o campo:\nTelefone');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.tipo_pessoa.value==''){
document.form1.tipo_pessoa.focus();
window.alert('Preencha o campo:\nTipo de Pessoa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}/* funções adaptadas para reconhecer o atributo disabled */
if((document.form1.estado_proponente.value=='') && (!document.form1.estado_proponente.disabled)){
document.form1.estado_proponente.focus();
window.alert('Preencha o campo:\nEstado do Proponente ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}/* funções adaptadas para reconhecer o atributo disabled */
if((document.form1.endereco_proponente.value=='') && (!document.form1.endereco_proponente.disabled)){
document.form1.endereco_proponente.focus();
window.alert('Preencha o campo:\nEndereco do Proponente ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}/* funções adaptadas para reconhecer o atributo disabled */
if((document.form1.cidade_proponente.value=='') && (!document.form1.cidade_proponente.disabled)){
document.form1.cidade_proponente.focus();
window.alert('Preencha o campo:\nCidade do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false; 
}
if(document.form1.CDCORRETOR.value==''){
document.form1.CDCORRETOR.focus();
window.alert('Preencha o campo:\nCodigo do Corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NMCORRETOR.value==''){
document.form1.NMCORRETOR.focus();
window.alert('Preencha o campo:\nNome do Corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.CDSUCURSAL.value==''){
document.form1.CDSUCURSAL.focus();
window.alert('Preencha o campo:\nCodigo da Sucursal');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.nome_sucursal.value==''){
document.form1.nome_sucursal.focus();
window.alert('Preencha o campo:\nNome da Sucursal');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.fabricante.value==''){
document.form1.fabricante.focus();
window.alert('Preencha o campo:\nFabricante');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.modelo.value==''){
document.form1.modelo.focus();
window.alert('Preencha o campo:\nModelo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.procedencia.value==''){
document.form1.procedencia.focus();
window.alert('Preencha o campo:\nProcedencia');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPLACA1.value==''){
document.form1.NRPLACA1.focus();
window.alert('Preencha o campo:\nNº da Placa ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRPLACA.value==''){
document.form1.NRPLACA.focus();
window.alert('Preencha o campo:\nNº da Placa ');
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

var placa_i = document.form1.NRPLACA1.value;
var placa_p = document.form1.NRPLACA.value;
if(placa_i!==placa_p){
document.form1.NRPLACA1.focus();
window.alert('Preencha o campo:\nNº da Placa ');
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

if(document.form1.Placa_Vermelha.value==''){
document.form1.Placa_Vermelha.focus();
window.alert('Preencha o campo:\nPlaca Vermelha');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if((document.form1.situacao_placa.value=='')&&(!document.form1.situacao_placa.disabled)){
document.form1.situacao_placa.focus();
window.alert('Preencha o campo:\nCategoria da Placa');
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
window.alert('Preencha o campo:\nAno do Modelo do vículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPORTAS.value==''){
document.form1.NRPORTAS.focus();
window.alert('Preencha o campo:\nNº de Portas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.capacidade_lotacao.value==''){
document.form1.capacidade_lotacao.focus();
window.alert('Preencha o campo:\nCapacidade lotação');
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
if((document.form1.TPPINTURA.value=='') && (!document.form1.TPPINTURA.disabled)){
document.form1.TPPINTURA.focus();
window.alert('Preencha o campo:\nTipo de Pintura do Veículo');
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
window.alert('Preencha o campo:\nVeículo Alienado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.INALIENADO.value=='S'&&document.form1.NMALIENADOR.value==''){
document.form1.NMALIENADOR.focus();
window.alert('Preencha o campo:\nEmpresa Alienadora');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
var chassi = document.form1.NRCHASSI.value.charAt(0)+""+document.form1.NRCHASSI.value.charAt(2)+""+document.form1.NRCHASSI.value.charAt(4)+""+document.form1.NRCHASSI.value.charAt(6)+""+document.form1.NRCHASSI.value.charAt(8)+""+document.form1.NRCHASSI.value.charAt(10)+""+document.form1.NRCHASSI.value.charAt(12)+""+document.form1.NRCHASSI.value.charAt(14)+""+document.form1.NRCHASSI.value.charAt(16)+""+document.form1.NRCHASSI.value.charAt(18)+""+document.form1.NRCHASSI.value.charAt(20)+""+document.form1.NRCHASSI.value.charAt(22)+""+document.form1.NRCHASSI.value.charAt(24)+""+document.form1.NRCHASSI.value.charAt(26)+""+document.form1.NRCHASSI.value.charAt(28)+""+document.form1.NRCHASSI.value.charAt(30)+""+document.form1.NRCHASSI.value.charAt(32);
var confere_chassi1 = chassi.length;

if(document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==7&&confere_chassi1!==8&&confere_chassi1!==9&&confere_chassi1!==11&&confere_chassi1!==12&&confere_chassi1!==13&&confere_chassi1!==14&&confere_chassi1!==17){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRANOFABRICACAO.value>=1989&&confere_chassi1!==17){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRCHASSI.value==''){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.Codigo_Condicao_Chassi.value==''){
document.form1.Codigo_Condicao_Chassi.focus();
window.alert('Preencha o campo:\nCondição Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

//função modificada para reconhecer a vp light
if(document.getElementById('CDFINALIDADE').value=='02'||document.getElementById('CDFINALIDADE').value=='05'||document.getElementById('CDFINALIDADE').value=='06'||document.getElementById('CDFINALIDADE').value=='07'||document.getElementById('CDFINALIDADE').value=='08'||document.getElementById('CDFINALIDADE').value=='09'){
//document.form1.NRMOTOR.setAttribute('disabled', 'disabled');
}

//função modificada para reconhecer a vp light
//if((document.form1.NRMOTOR.value=='') && (!document.form1.NRMOTOR.disabled)){
if(document.form1.NRMOTOR.value==''){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNº de Motor do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.CDMATERIALCARROC.value==''){
document.form1.CDMATERIALCARROC.focus();
window.alert('Preencha o campo:\nCarroceria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Preencha o campo:\nNÂº de Renavam do veículo');
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
window.alert('Preencha o campo:\nNº do DUT do veículo');
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
if(document.form1.INTRANSF.value==''){
document.form1.INTRANSF.focus();
window.alert('Preencha o campo:\nVeiculo Transformado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Preencha o campo:\nUso do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.conversivel.value==''){
document.form1.conversivel.focus();
window.alert('Preencha o campo:\nConversível');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.GRAVA_VIDROS.value==''){
document.form1.GRAVA_VIDROS.focus();
window.alert('Preencha o campo:\nGravação de Vidros');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.GRAVA_VIDROS.value=='S'&&document.form1.quantidade_vidros.value<1){
document.form1.quantidade_vidros.focus();
window.alert('Preencha o campo:\nGravação de Vidros Quantidade');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.marca_medidas.value==''){
document.form1.marca_medidas.focus();
window.alert('Preencha o campo:\nMarca/Medidas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.avaliacao.value==''){
document.form1.avaliacao.focus();
window.alert('Preencha o campo:\nAvaliação Final');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

}