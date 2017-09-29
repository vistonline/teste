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

if(document.form1.NRVISTORIA.value==''){
document.form1.NRVISTORIA.focus();
window.alert('Preencha o campo:\nNumero do Laudo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.KM_rodado.value==''){
document.form1.KM_rodado.focus();
window.alert('Preencha o campo:\nQuilometragem rodado para realizacao da VP');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPVISTORIA.value=='')
{
document.form1.TPVISTORIA.focus();
window.alert('Selecione o campo:\nLocal onde foi feito a Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPVISTORIA.value=='P'){
if(document.form1.endereco_posto.value==''){
document.form1.endereco_posto.focus();
window.alert('Selecione um Posto');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
}
if(document.form1.TPVISTORIA.value=='D'){
if(document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='999999999' || document.form1.cep.value.length <= 7 ){
document.form1.cep.focus();
window.alert('Preencha o campo CEP');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.UF.value==''){
document.form1.UF.focus();
window.alert('Preencha o campo Estado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cidade.value==''){
document.form1.cidade.focus();
window.alert('Preencha o campo cidade');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.bairro.value==''){
document.form1.bairro.focus();
window.alert('Preencha o campo bairro');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.endereco.value==''){
document.form1.endereco.focus();
window.alert('Preencha o campo Endereço');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.numero.value==''){
document.form1.numero.focus();
window.alert('Preencha o campo Numero');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
}
if(document.form1.cpf_cnpj.value=='' && document.form1.acao.value!='editar'){
document.form1.cpf_cnpj.focus();
window.alert('Preencha o campo CPF ou CNPJ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.controle_prest.value==''){
document.form1.controle_prest.focus();
window.alert('Preencha o campo Vistoriador');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.controle_prest.value=='')
{
document.form1.controle_prest.focus();
window.alert('Selecione o vistoriador:\nQue realizou a vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.DTVISTORIA.value==''){
window.alert('Preencha o campo:\n Data de realizacao da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	
if(document.form1.DTVISTORIA.value.length<10){
window.alert('Data de realizacao da Vistoria Inválida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
	}	

if(document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='3'||document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='10'){

var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);
if(document.form1.DTVISTORIA.value==''){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data de realizacao da Vistoria');
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

if(document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)<2017){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Prévia corretamente. Não é aceito ano inferior a 2017.');
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
if(document.form1.CDFINALIDADE.value=='' || document.form1.CDFINALIDADE.value=='Nenhum'){
document.form1.CDFINALIDADE.focus();
window.alert('Selecione a finalidade da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
/*
if(document.form1.nome_recebe_perito.value==''){
document.form1.nome_recebe_perito.focus();
window.alert('Selecione a finalidade da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/
if(document.form1.NMPROPONENTE.value==''){
document.form1.NMPROPONENTE.focus();
window.alert('Preencha o campo:\nNome do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
/*
if(document.form1.sexo_proponente.value==''){
document.form1.sexo_proponente.focus();
window.alert('Selecione o sexo do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/
if(document.form1.tipo_pessoa.value==''){
document.form1.tipo_pessoa.focus();
window.alert('Preencha o campo:\nTipo de pessoa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cep_proponente.value==''){
document.form1.cep_proponente.focus();
window.alert('Preencha o campo:\nCEP do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.estado_proponente.value==''){
document.form1.estado_proponente.focus();
window.alert('Preencha o campo:\Estado do proponente');
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
window.alert('Preencha o campo:\nEndereço do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
/*
if(document.form1.telefone_proponente.value==''){
document.form1.telefone_proponente.focus();
window.alert('Preencha o campo:\nTelefone do proponente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/

if(document.form1.corretor.value==''){
document.form1.corretor.focus();
window.alert('Preencha o campo:\n Nome Corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

//if((document.form1.susep.value=='')||(document.form1.susep.value.length!==14&&document.form1.susep.value.length!==8&&document.form1.susep.value.length!==9||document.form1.susep.value.length!==10)){
if(document.form1.susep.value==''){
document.form1.susep.focus();
window.alert('Preencha o campo:\n Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==00000000000000){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}	
if(document.form1.susep.value==11111111111111){
	document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==22222222222222){	
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==33333333333333){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==44444444444444){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==55555555555555){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==66666666666666){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==77777777777777){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==88888888888888){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.susep.value==99999999999999){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.CDCORRETOR.value==''){
document.form1.CDCORRETOR.focus();
window.alert('Preencha o campo:\n Codigo Interno Tokio Marine');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.fabricante.value==''){
document.form1.fabricante.focus();
window.alert('Preencha o\n Fabricante do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.modelo.value==''){
document.form1.modelo.focus();
window.alert('Preencha o campo:\n Modelo do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRPLACA.value==''){
document.form1.NRPLACA.focus();
window.alert('Preencha o campo:\nNumero da Placa ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPLACA1.value==''){
document.form1.NRPLACA1.focus();
window.alert('Preencha o campo:\nNumero da Placa novamente');
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
window.alert('Placa não confere Redigite o campo:\nNumero da Placa ');
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
window.alert('Preencha o campo:\n Município da placa');
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
if(document.form1.NRANOFABRICACAO.value==''||document.form1.NRANOFABRICACAO.value=='0'){
document.form1.NRANOFABRICACAO.focus();
window.alert('Preencha o campo:\nAno de Fabricacao do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRANOMODELO.value=='' || document.form1.NRANOMODELO.value=='0'){
document.form1.NRANOMODELO.focus();
window.alert('Preencha o campo:\nAno do Modelo do veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRPORTAS.value==''){
document.form1.NRPORTAS.focus();
window.alert('Preencha o campo:\n Numero de portas ');
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
if(document.form1.TPCOMBUSTIVEL.value==''){
document.form1.TPCOMBUSTIVEL.focus();
window.alert('Selecione o campo:/n Combustivel');
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

if(document.form1.cilindros.value==''){
document.form1.cilindros.focus();
window.alert('Preencha o campo:\nNumero de cilindros');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.situacao_cambio.value==''){
document.form1.situacao_cambio.focus();
window.alert('Selecione o campo:/n Tipo de Cambio');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
/*
if(document.form1.tipo_cabine.value==''||document.form1.tipo_cabine.value<=0){
document.form1.tipo_cabine.focus();
window.alert('Preencha o campo:\nTipo de Cabine');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/

if(document.form1.tipoVeiculo.value=='C')
	{ 
		if(document.form1.tipo_carga.value=='')
			{
				document.form1.tipo_carga.focus();
				window.alert('Preencha o campo:\nTipo de Carga');
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
		if(document.form1.NRCARROC.value=='')
			{
				document.form1.NRCARROC.focus();
				window.alert('Preencha o campo:\nNumero da Carroceria');
				document.getElementById('buttonGravar1').removeAttribute('hidden');
				document.getElementById('buttonGravar2').removeAttribute('hidden');
				return false;
			}
		if(document.form1.TPCARROC.value==0)
			{
				document.form1.TPCARROC.focus();
				window.alert('Preencha o campo:\nTipo da Carroceria');
				document.getElementById('buttonGravar1').removeAttribute('hidden');
				document.getElementById('buttonGravar2').removeAttribute('hidden');
				return false;
			}
		if(document.form1.CDMATERIALCARROC.value==0)
			{
				document.form1.CDMATERIALCARROC.focus();
				window.alert('Preencha o campo:\nMaterial da Carroceria');
				document.getElementById('buttonGravar1').removeAttribute('hidden');
				document.getElementById('buttonGravar2').removeAttribute('hidden');
				return false;
			}
		if(document.form1.num_terceiro_eixo.value=='')
			{
				document.form1.num_terceiro_eixo.focus();
				window.alert('Preencha o campo:\nQuantidade de Eixos');
				document.getElementById('buttonGravar1').removeAttribute('hidden');
				document.getElementById('buttonGravar2').removeAttribute('hidden');
				return false;
			}
}



if(document.form1.KMVEICULO.value==''||document.form1.KMVEICULO.value<=0){
document.form1.KMVEICULO.focus();
window.alert('Preencha o campo:\nQuilometragem do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.INALIENADO.value==''){
document.form1.INALIENADO.focus();
window.alert('Preencha o campo:\nVeículo alienado?');
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
	
var chassi = document.form1.NRCHASSI.value.charAt(0)+""+document.form1.NRCHASSI.value.charAt(2)+""+document.form1.NRCHASSI.value.charAt(4)+""+document.form1.NRCHASSI.value.charAt(6)+""+document.form1.NRCHASSI.value.charAt(8)+""+document.form1.NRCHASSI.value.charAt(10)+""+document.form1.NRCHASSI.value.charAt(12)+""+document.form1.NRCHASSI.value.charAt(14)+""+document.form1.NRCHASSI.value.charAt(16)+""+document.form1.NRCHASSI.value.charAt(18)+""+document.form1.NRCHASSI.value.charAt(20)+""+document.form1.NRCHASSI.value.charAt(22)+""+document.form1.NRCHASSI.value.charAt(24)+""+document.form1.NRCHASSI.value.charAt(26)+""+document.form1.NRCHASSI.value.charAt(28)+""+document.form1.NRCHASSI.value.charAt(30)+""+document.form1.NRCHASSI.value.charAt(32);
var confere_chassi1 = chassi.length;

if(document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==8&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==9&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==12&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==14&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==17){
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
if(document.form1.INREMARCADO.value==''){
document.form1.INREMARCADO.focus();
window.alert('Informe o campo:\nChassi remarcado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRMOTOR.value==''){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNúmero do motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Selecione o campo:\nRenavam');
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
window.alert('Preencha o campo:\nNúmero do DUT');
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
window.alert('Preencha o campo:\nCidade de expedição do CRLV');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.DTDUT.value==''){
document.form1.DTDUT.focus();
window.alert('Selecione o campo:\n Data de expedição do DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.DTDUT.value.length<10){
document.form1.DTDUT.focus();
window.alert('Data de expedição do DUT inválida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NMORGAODUT.value==''){
document.form1.NMORGAODUT.focus();
window.alert('Selecione o campo:\n Órgão expedidor do DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.cpf_cnpj_crlv.value==''){
document.form1.cpf_cnpj_crlv.focus();
window.alert('Preencha o campo:\nCPF ou CNPJ que consta no DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.INTRANSF.value==''){
document.form1.INTRANSF.focus();
window.alert('Informe o campo:\nVeículo transformado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.INTRANSF.value=='S')
{
	if(document.form1.DSTRANSF.value=='')
	{
	document.form1.DSTRANSF.focus();
	window.alert('Preencha o campo:\nDescrição da Transformação');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
}
if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Selecione o uso do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.possui_rodoar.value==''){
document.form1.possui_rodoar.focus();
window.alert('Preencha o campo:\nPossui Rodoar');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

/*
if(document.form1.bomba_injetora.value==''){
document.form1.bomba_injetora.focus();
window.alert('Preencha o campo:\nBomba Injetora');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/


if(document.form1.GRAVA_VIDROS.value==''){
document.form1.GRAVA_VIDROS.focus();
window.alert('Informe o campo:\nGravação de Vidro');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.GRAVA_VIDROS.value=='S')
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
/*
if(document.form1.in_logotipo.value==''){
document.form1.in_logotipo.focus();
window.alert('Informe o campo:\nIndicador de veículo logotipado/ adesivado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
*/
if(document.form1.marca_medidas.value==''){
document.form1.marca_medidas.focus();
window.alert('Informe o campo:\nMarca/Medida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.avaliacao.value==''){
document.form1.avaliacao.focus();
window.alert('Informe o campo:\nAvaliação');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if( typeof(document.form1.restricao1)!='object' || document.form1.restricao1.value==''){
window.alert('\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma restri'+'\u00e7'+''+'\u00e3'+'o:\nSe ve'+'\u00ed'+'culo aprovado inserir restri'+'\u00e7'+''+'\u00e3'+'o 116');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;	
}

	inicioPecas=1;
    valorPecas = '';
    while(inicioPecas<=20)
    {
    if(document.getElementById('LOCAL_AVARIA_'+inicioPecas))
    {
    valorPecas+=document.getElementById('LOCAL_AVARIA_'+inicioPecas).value+',';
    }
    inicioPecas++;
    }

	inicioAcessorio=1;
    valorAcessorio = '';
    while(inicioAcessorio<=50)
    {
    if(document.getElementById('ACESSORIO_'+inicioAcessorio))
    {
    valorAcessorio+=document.getElementById('ACESSORIO_'+inicioAcessorio).value+',';
    }
    inicioAcessorio++;
    }

 	inicioRestricao=1;
    valorRestricao = '';
    while(inicioRestricao<=15)
    {
    if(document.getElementById('restricao'+inicioRestricao))
    {
    valorRestricao+=document.getElementById('restricao'+inicioRestricao).value+',';
    }
    inicioRestricao++;
    }
	
 <!-- ########### RESTRIÇÕES TOKIO MARINE (RESTRIÇÕES QUE EXIGEM AVARIAS / ACESSORIOS) ########### -->
	
	 var restricao=valorRestricao.split(",");
	 for (i=0; i< restricao.length; i++)
	  {

	   if(restricao[i]=='102'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='129')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 102\n(MOTOR TURBO NAO ORIGINAL. PICK-UP PESADA / CAMINH'+'\u00c3'+'O)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o Acessorio: 129 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
	  
	  if(restricao[i]=='301'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='172')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 301\n(Ve'+'\u00ed'+'culo Blindado)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o Acessorio: 172 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		 if(restricao[i]=='308'){
			  var valorObs=document.getElementById('OBSERVACOES').value;
			  var obsEncontrada=0;
			  
				  if(valorObs!='')
				  	  {
					  obsEncontrada++; 
					  }
			  
			  if(obsEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 308\n(VEICULO SOBRE ANALISE DA CIA. (DEVIDO APONTAMENTOS NA VISTORIA))\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio preencher o campo de OBSERVA'+'\u00c7'+''+'\u00c3'+'O ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
	  
	  if(restricao[i]=='310'){
			  var pecaEncontrada=0;
			  var peca= valorPecas.split(",");
			  for (j=0; j< peca.length; j++)
			  {
				  if(peca[j]=='15'||peca[j]=='16'||peca[j]=='17'||peca[j]=='18')
				  	  {
					  pecaEncontrada++; 
					  }
			  }
			  if(pecaEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 310\n(Ve'+'\u00ed'+'culo com avaria na lanterna)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 15, 16, 17, 18 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
		  
		  if(restricao[i]=='311'){
				  var pecaEncontrada=0;
				  var peca= valorPecas.split(",");
				  for (j=0; j< peca.length; j++)
				  {
					  if(peca[j]=='12'||peca[j]=='13'||peca[j]=='71'||peca[j]=='72'||peca[j]=='73')
						  {
						  pecaEncontrada++; 
						  }
				  }
				  if(pecaEncontrada==0){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 311\n(Ve'+'\u00ed'+'culo com avaria no farol)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 12, 13, 71, 72, 73 ');
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
		  				}
			
			if(restricao[i]=='312'){
				  var pecaEncontrada=0;
				  var peca= valorPecas.split(",");
				  for (j=0; j< peca.length; j++)
				  {
					  if(peca[j]=='10'||peca[j]=='11')
						  {
						  pecaEncontrada++; 
						  }
				  }
				  if(pecaEncontrada==0){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 312\n(Ve'+'\u00ed'+'culo com avaria no retrovisor)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 10, 11');
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
		  				}
			
			if(restricao[i]=='313'){
				  var pecaEncontrada=0;
				  var peca= valorPecas.split(",");
				  for (j=0; j< peca.length; j++)
				  {
					  if(peca[j]=='36'||peca[j]=='37'||peca[j]=='38'||peca[j]=='39'||peca[j]=='40'||peca[j]=='41'||peca[j]=='76'||peca[j]=='77'||peca[j]=='78'||peca[j]=='79')
						  {
						  pecaEncontrada++; 
						  }
				  }
				  if(pecaEncontrada==0){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 313\n(Ve'+'\u00ed'+'culo com avaria nos vidros)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 36, 37, 38, 39, 40, 41, 76, 77, 78, 79');
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
		  				}
			
			if(restricao[i]=='314'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='171')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 314\n(Ve'+'\u00ed'+'culocom equipamento de kit g'+'\u00e1'+'s regularizado no CRLV)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o Acessorio: 171 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
						
			if(restricao[i]=='518'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='171')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==0){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 518\n(kit g'+'\u00e1'+'s irregular no CRLV (n'+'\u00e3'+'o consta GNV no documento))\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o Acessorio: 171 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
			if(restricao[i]=='534'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='151')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==1){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 534\n(veiculo sem etiqueta ETA)\nN'+'\u00e3'+'o pode ser informado o Acessorio: 151 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
			if(restricao[i]=='535'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='151')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==1){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 535\n(ve'+'\u00ed'+'culo com todas as etiquetas ETA danificadas)\nN'+'\u00e3'+'o pode ser informado o Acessorio: 151 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
			
			if(restricao[i]=='527'){
			  var acessorioEncontrada=0;
			  var acessorio= valorAcessorio.split(",");
			  for (j=0; j< acessorio.length; j++)
			  {
				  if(acessorio[j]=='152')
				  	  {
					  acessorioEncontrada++; 
					  }
			  }
			  if(acessorioEncontrada==1){
				  	  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 527\n(aus'+'\u00ea'+'ncia da grava'+'\u00e7'+''+'\u00e3'+'o do chassi em todos os vidros)\nN'+'\u00e3'+'o pode ser informado o Acessorio: 152 ');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
			
			if(restricao[i]=='528'){
				  var pecaEncontrada=0;
				  var peca= valorPecas.split(",");
				  for (j=0; j< peca.length; j++)
				  {
					  if(peca[j]=='83'||peca[j]=='84'||peca[j]=='85'||peca[j]=='86')
						  {
						  pecaEncontrada++; 
						  }
				  }
				  if(pecaEncontrada==0){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 528\n(Ve'+'\u00ed'+'culo com Pneu irregular)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 83, 84, 85, 86');
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
		  				}
						
			if(restricao[i]=='545'){
				  var pecaEncontrada=0;
				  var peca= valorPecas.split(",");
				  for (j=0; j< peca.length; j++)
				  {
					  if(peca[j]=='36'||peca[j]=='37'||peca[j]=='38'||peca[j]=='39'||peca[j]=='40'||peca[j]=='41'||peca[j]=='76'||peca[j]=='77'||peca[j]=='78'||peca[j]=='79')
						  {
						  pecaEncontrada++; 
						  }
				  }
				  if(pecaEncontrada==0){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 545\n(Ve'+'\u00ed'+'culo blindado com delamina'+'\u00e7'+''+'\u00f5'+'es nos vridros)\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio pelo menos uma avaria das seguintes pe'+'\u00e7'+'as: 36, 37, 38, 39, 40, 41, 76, 77, 78, 79');
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
		  				}
		 		
				
			if(restricao[i]=='521'){
					
					 inicioHrAvaria=1;
//padrão
totalHoras=0;
hr_funilaria=0;
hr_pintura=0;
hr_tapecaria=0;
hr_eletrica=0;
    while(inicioHrAvaria<=20)
    {
    if(document.getElementById('LOCAL_AVARIA_'+inicioHrAvaria))
    {
	peca=document.getElementById('LOCAL_AVARIA_'+inicioHrAvaria).value;
	tipo=document.getElementById('TIPO_AVARIA_'+inicioHrAvaria).value;
	tamanho=document.getElementById('CM_AVARIA_'+inicioHrAvaria).value;
   
   		//Amassado
if (tipo=="A")
{
	if(tamanho<=10){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=2;hr_pintura+=3;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=3;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=4;hr_pintura+=6;}
}
//Arranhado
if (tipo=="RR")
{
	if(tamanho<=10){hr_funilaria+=0;hr_pintura+=1;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=0;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=0;hr_pintura+=6;}
}

	
//Com ferrugem
if (tipo=="FE")
{
	if(tamanho<=10){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=2;hr_pintura+=3;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=3;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=4;hr_pintura+=6;}
}

//Com mossa(s)
if (tipo=="LA" || tipo=="LD" || tipo=="NC")
{
	hr_funilaria+=3;hr_pintura+=0;
}

//Rasgado //TROCA
if (tipo=="E"){
	hr_funilaria+=4;hr_pintura+=0;
	}


//Falta //TROCA
if (tipo=="PA" || tipo=="QB" || tipo=="F"){
	
	if(	peca=='10'||  
		peca=='11'||
		peca=='12'||
		peca=='13'||
		peca=='14'||
		peca=='15'||
		peca=='16'||
		peca=='17'||
		peca=='18'||
		peca=='19'||
		peca=='20'||
		peca=='21'||
		peca=='22'||
		peca=='33'||
		peca=='34'||
		peca=='71'||
		peca=='72'||
		peca=='73'||
		peca=='83'||
		peca=='84'||
		peca=='85'||
		peca=='86'||
		peca=='89'||
		peca=='90'){
			hr_funilaria+=1;hr_pintura+=0;
			}else{
				hr_funilaria+=4;hr_pintura+=0;
				}
	
	}
	
//Mal reparado  UTILIZANDO COMO IRREGULAR
if (tipo=="RI" || tipo=="B")
{
	if(tamanho<=10){hr_funilaria+=0;hr_pintura+=1;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=0;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=0;hr_pintura+=6;}
}

//vazamento
if (tipo=="VZ" || tipo=="PI")
{
	hr_funilaria+=1;hr_pintura+=0;

}


// OUTROS  
if (tipo=="OT")
{
	hr_funilaria+=1;hr_pintura+=1;
	
}
   

    }
    inicioHrAvaria++;
  
  
  
    }
totalHoras+=hr_funilaria+hr_pintura+hr_tapecaria+hr_eletrica;
	
					
				  if(totalHoras<=35){
						  alert('Foi informado a restri'+'\u00e7'+''+'\u00e3'+'o: 521\n(VEICULO COM MAIS DE 35 HORAS DE AVARIAS)\nA soma das horas das avarias n'+'\u00e3'+'o '+'\u00da'+'ltrapassou 35 horas\n de reparo\n Total de horas de avarias: '+totalHoras);
						  document.getElementById('buttonGravar1').removeAttribute('hidden');
						  document.getElementById('buttonGravar2').removeAttribute('hidden');
						  return false;
						  }
				}				
			

} // fim for

<!-- #### FIM ##### RESTRIÇÕES TOKIO MARINE (RESTRIÇÕES QUE EXIGEM AVARIAS) -->

 <!-- RESTRIÇÕES TOKIO MARINE (AVARIAS QUE EXIGEM RESTRIÇÕES) -->
	
	 var avaria= valorPecas.split(",");
	 for (i=0; i< avaria.length; i++)
	  {

	  if(avaria[i]=='15'||avaria[i]=='16'||avaria[i]=='17'||avaria[i]=='18'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='310')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado avaria em uma das pe'+'\u00e7'+'as: 15, 16, 17, 18\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 310\n(Ve'+'\u00ed'+'culo com avaria na lanterna)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(avaria[i]=='12'||avaria[i]=='13'||avaria[i]=='71'||avaria[i]=='72'||avaria[i]=='73'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='311')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado avaria em uma das pe'+'\u00e7'+'as: 12, 13, 71, 72, 73\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 311\n(Ve'+'\u00ed'+'culo com avaria no Farol)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(avaria[i]=='10'||avaria[i]=='11'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='312')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado avaria em uma das pe'+'\u00e7'+'as: 10, 11\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 312\n(Ve'+'\u00ed'+'culo com avaria no Retrovisor)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(avaria[i]=='36'||avaria[i]=='37'||avaria[i]=='38'||avaria[i]=='39'||avaria[i]=='40'||avaria[i]=='41'||avaria[i]=='76'||avaria[i]=='77'||avaria[i]=='78'||avaria[i]=='79'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='313' || restricao[j]=='545')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado avaria em uma das pe'+'\u00e7'+'as: 36, 37, 38, 39, 40, 41, 76, 77, 78, 79\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir uma das restri'+'\u00e7'+''+'\u00f5'+'es: 313\n(Ve'+'\u00ed'+'culo com avaria nos Vidros)\n545\n(Ve'+'\u00ed'+'culo blindado com delamina'+'\u00e7'+''+'\u00f5'+'es nos vridros)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(avaria[i]=='83'||avaria[i]=='84'||avaria[i]=='85'||avaria[i]=='86'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='528')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado avaria em uma das pe'+'\u00e7'+'as: 83, 84, 85, 86\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 528\n(Ve'+'\u00ed'+'culo com Pneu irregular)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}


} // fim for

 <!-- #### FIM ##### RESTRIÇÕES TOKIO MARINE (AVARIAS QUE EXIGEM RESTRIÇÕES) -->

 <!-- RESTRIÇÕES TOKIO MARINE (ACESSORIOS QUE EXIGEM RESTRIÇÕES) -->
	
	 var acessorio= valorAcessorio.split(",");
	 for (i=0; i< acessorio.length; i++)
	  {

	  if(acessorio[i]=='172'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='301')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado o Acessorio: 172\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 301\n(Ve'+'\u00ed'+'culo Blindado)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
			
			 if(acessorio[i]=='171'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='314' || restricao[j]=='518')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){
				  	  alert('Foi cadastrado o Acessorio: 171\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 314\n(Ve'+'\u00ed'+'culo com equipamento de kit g'+'\u00e1'+'s regularizado no CRLV)\n ou a restri'+'\u00e7'+''+'\u00e3'+'o: 518\n(kit g'+'\u00e1'+'s irregular no CRLV (n'+'\u00e3'+'o consta GNV no documento))');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(acessorio[i]=='151'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='534' || restricao[j]=='535')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==1){
				  	  alert('Foi cadastrado o Acessorio: 151\nNão pode ser informado as restri'+'\u00e7'+''+'\u00e3'+'o: 534\n(veiculo sem etiqueta ETA)\n ou a restri'+'\u00e7'+''+'\u00e3'+'o: 535\n(ve'+'\u00ed'+'culo com todas as etiquetas ETA danificadas)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
		if(acessorio[i]=='152'){
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='527')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==1){
				  	  alert('Foi cadastrado o Acessorio: 152\nN'+'\u00e3'+'o pode ser informado as restri'+'\u00e7'+''+'\u00e3'+'o: 527\n(aus'+'\u00ea'+'ncia da grava'+'\u00e7'+''+'\u00e3'+'o do chassi em todos os vidros)\n');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
					  }
	  			}
				
			

} // fim for

 <!-- #### FIM ##### RESTRIÇÕES TOKIO MARINE (ACESSORIOS QUE EXIGEM RESTRIÇÕES) -->

inicioHrAvaria=1;
//padrão
totalHoras=0;
hr_funilaria=0;
hr_pintura=0;
hr_tapecaria=0;
hr_eletrica=0;
    while(inicioHrAvaria<=20)
    {
    if(document.getElementById('LOCAL_AVARIA_'+inicioHrAvaria))
    {
		peca=document.getElementById('LOCAL_AVARIA_'+inicioHrAvaria).value;
	tipo=document.getElementById('TIPO_AVARIA_'+inicioHrAvaria).value;
	tamanho=document.getElementById('CM_AVARIA_'+inicioHrAvaria).value;
   
   		//Amassado
if (tipo=="A")
{
	if(tamanho<=10){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=2;hr_pintura+=3;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=3;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=4;hr_pintura+=6;}
}
//Arranhado
if (tipo=="RR")
{
	if(tamanho<=10){hr_funilaria+=0;hr_pintura+=1;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=0;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=0;hr_pintura+=6;}
}

	
//Com ferrugem
if (tipo=="FE")
{
	if(tamanho<=10){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=2;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=2;hr_pintura+=3;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=3;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=4;hr_pintura+=6;}
}

//Com mossa(s)
if (tipo=="LA" || tipo=="LD" || tipo=="NC")
{
	hr_funilaria+=3;hr_pintura+=0;
}

//Rasgado //TROCA
if (tipo=="E"){
	hr_funilaria+=4;hr_pintura+=0;
	}


//Falta //TROCA
if (tipo=="PA" || tipo=="QB" || tipo=="F"){
	
	if(	peca=='10'||  
		peca=='11'||
		peca=='12'||
		peca=='13'||
		peca=='14'||
		peca=='15'||
		peca=='16'||
		peca=='17'||
		peca=='18'||
		peca=='19'||
		peca=='20'||
		peca=='21'||
		peca=='22'||
		peca=='33'||
		peca=='34'||
		peca=='71'||
		peca=='72'||
		peca=='73'||
		peca=='83'||
		peca=='84'||
		peca=='85'||
		peca=='86'||
		peca=='89'||
		peca=='90'){
			hr_funilaria+=1;hr_pintura+=0;
			}else{
				hr_funilaria+=4;hr_pintura+=0;
				}
	
	}
	
//Mal reparado  UTILIZANDO COMO IRREGULAR
if (tipo=="RI" || tipo=="B")
{
	if(tamanho<=10){hr_funilaria+=0;hr_pintura+=1;}
	if(tamanho>=11&&tamanho<=20){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=21&&tamanho<=40){hr_funilaria+=0;hr_pintura+=2;}
	if(tamanho>=41&&tamanho<=80){hr_funilaria+=0;hr_pintura+=4;}
	if(tamanho>=81){hr_funilaria+=0;hr_pintura+=6;}
}

//vazamento
if (tipo=="VZ" || tipo=="PI")
{
	hr_funilaria+=1;hr_pintura+=0;

}


// OUTROS  
if (tipo=="OT")
{
	hr_funilaria+=1;hr_pintura+=1;
	
}
   

    }
    inicioHrAvaria++;
    }
totalHoras+=hr_funilaria+hr_pintura+hr_tapecaria+hr_eletrica;

	if(totalHoras>35){
		
			  var retricaoEncontrada=0;
			  var restricao= valorRestricao.split(",");
			  for (j=0; j< restricao.length; j++)
			  {
				  if(restricao[j]=='521')
				  	  {
					  retricaoEncontrada++; 
					  }
			  }
			  if(retricaoEncontrada==0){   
		alert('Somando as horas de todas as avaria '+'\u00c9'+'ltrapassou 35 horas de reparo\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio inserir a restri'+'\u00e7'+''+'\u00e3'+'o: 521\n(VEICULO COM MAIS DE 35 HORAS DE AVARIAS)');
					  document.getElementById('buttonGravar1').removeAttribute('hidden');
					  document.getElementById('buttonGravar2').removeAttribute('hidden');
					  return false;
				}

	}

	pesoParecerFinal=1;
	inicioParecerFinal=1;
    valorParecerFinal = '';
	
	while(inicioParecerFinal<=10)
    {
    if(document.getElementById('restricao'+inicioParecerFinal))
    {
    valorParecerFinal+=document.getElementById('restricao'+inicioParecerFinal).value+',';
    }
    inicioParecerFinal++;
    }
	
	 var ParecerFinal= valorParecerFinal.split(",");
	 var pesoParecerFinal= new Array();
	 for (i=0; i< ParecerFinal.length; i++)
	  {
	   				
				   if( (parseInt(ParecerFinal[i])<=299)){
					  pesoParecerFinal[i]=1;
					  }
			  
				   if( (parseInt(ParecerFinal[i])>=301) && (parseInt(ParecerFinal[i])<=499)){
					  pesoParecerFinal[i]=2;
					  }
					  
				   if( (parseInt(ParecerFinal[i])>=501)){
					  pesoParecerFinal[i]=3;
					  }
	
	  }
	  pesoParecerFinal.sort();
	  pesoParecerFinal.reverse();
	  
	  switch(pesoParecerFinal[0]){
		  case 1: ressalvaMaiorParecerFinal='A'; break;
		  case 2: ressalvaMaiorParecerFinal='S'; break;
		  case 3: ressalvaMaiorParecerFinal='R'; break;
		  default:break;
		  }
	 
	  switch(ressalvaMaiorParecerFinal){
		  case 'A': textRessalva="Aceit"+"\u00e1"+"vel"; break;
		  case 'S': textRessalva="Sujeito a An"+"\u00e1"+"lise"; break;
		  case 'R': textRessalva="Recusada"; break;
		  default:break;
		  }
		  
		switch(document.getElementById('avaliacao').value){
		  case 'A': textRessalvaI="Aceit"+"\u00e1"+"vel"; break;
		  case 'S': textRessalvaI="Sujeito a An"+"\u00e1"+"lise"; break;
		  case 'R': textRessalvaI="Recusada"; break;
		  default:break;
		  }
	  
	  if(document.getElementById('avaliacao').value!=ressalvaMaiorParecerFinal){
		  alert('Avalia'+'\u00e7'+''+'\u00e3'+'o Final IRREGULAR, Foi informado: '+textRessalvaI+', por'+'\u00e9'+'m o corretor '+'\u00e9'+': '+textRessalva+' ');
		  document.getElementById('buttonGravar1').removeAttribute('hidden');
		  document.getElementById('buttonGravar2').removeAttribute('hidden');
		  return false;
		  }

	if(document.form1.quantidade_vidros.value>=1){
		 $qtdeVidros=document.form1.quantidade_vidros.value;
		 var acessorio= valorAcessorio.split(",");
		 $gravaVidro=0;
		 for (i=0; i< acessorio.length; i++)
		  {
			  if(acessorio[i]=='152'){
			  	var $gravaVidro=1;
			 		}
			  
			  }
			if($gravaVidro==0){
				  alert('Foi informado que o ve'+'\u00ed'+'culo possui '+$qtdeVidros+' Vidros gravados\n'+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o acess'+'\u00f3'+'rio: 152 (GRAVACAO NOS VIDROS)\n');
				  document.getElementById('buttonGravar1').removeAttribute('hidden');
				  document.getElementById('buttonGravar2').removeAttribute('hidden');
				  return false;
				}
		}

	if( document.getElementById('etiquetas1').checked || document.getElementById('etiquetas2').checked || document.getElementById('etiquetas3').checked ){

		 var acessorio= valorAcessorio.split(",");
		 $temEtas=0;
		 for (i=0; i< acessorio.length; i++)
		  {
			  if(acessorio[i]=='151'){
			  	var $temEtas=1;
			 		}
			  
			  }
			if($temEtas==0){
				  alert('Foi informado que o ve'+'\u00ed'+'culo possui pelo menos \n1 etiqueta (ETA) '+'\u00c9'+' obrigat'+'\u00f3'+'rio informar o \nacess'+'\u00f3'+'rio: 151 (ETIQUETA ETA)\n');
				  document.getElementById('buttonGravar1').removeAttribute('hidden');
				  document.getElementById('buttonGravar2').removeAttribute('hidden');
				  return false;
				}
		
		}




}// fim valida