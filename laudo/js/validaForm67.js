function valida_cep_vistoria(){
if((document.form1.TPVISTORIA.value=='V') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
document.form1.cep.focus();
document.getElementById('cep').value="";
window.alert('CEP da vistoria Inválido\nFavor Informar um CEP válido ou a vistoria não será gravada!'); 
return false;
}
}

function valida(){

// COMEÇA AQUI A VALIDAÇÃO DO LAUDO
if(document.form1.SEGURADORA.value=='')
{
document.form1.SEGURADORA.focus();
window.alert('Preencha o campo:\nSeguradora');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

// CODIGO DA CIA - SULAMÉRICA
if (document.getElementById('SEGURADORA').value==67&&document.getElementById('CDCIA').value=="")
{
window.alert("Favor informe o CODIGO DA CIA: SULAMERICA, BRASIL VEICULOS ou CAIXA SEGUROS");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 

// PROPOSTA OU ENDOSSO - SULAMÉRICA
if (document.getElementById('SEGURADORA').value==67&&document.getElementById('proposta').value=="")
{
window.alert("Favor informe o número da PROPOSTA ou ENDOSSO");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 

// CIDADE DE ATENDIMENTO CALCULA KM e PREÇO 
if (document.getElementById('cidade_atende').value=="")
{
window.alert("Favor informe se a CIDADE DE ATENDIMENTO");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if (document.getElementById('TPVISTORIA').value==''){
	document.form1.TPVISTORIA.focus();
	window.alert("Escolha o Local de Realização da Vistoria");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
	
if (document.getElementById('TPVISTORIA').value=='P' && document.form1.endereco_posto.value == ''){
	document.form1.endereco_posto.focus();
	window.alert("Escolha o Posto de Realização da Vistoria");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if ( (document.getElementById('TPVISTORIA').value=='V') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000'|| document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
document.form1.cep.focus();
document.getElementById('cep').value="";	
window.alert("Preencha o Campo:\nCEP da vistoria vazio ou inválido");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.getElementById('TPVISTORIA').value=='V' && document.form1.UF.value==''){
	document.form1.UF.focus()	
	window.alert("Preencha o Campo:\nUF");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.getElementById('TPVISTORIA').value=='V' && document.form1.cidade.value==''){
	document.form1.cidade.focus()	
	window.alert("Preencha o Campo:\nCidade");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.getElementById('TPVISTORIA').value=='V' && document.form1.bairro.value==''){
	document.form1.bairro.focus()	
	window.alert("Preencha o Campo:\nBairro");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.getElementById('TPVISTORIA').value=='V' && document.form1.endereco.value==''){
	document.form1.endereco.focus()	
	window.alert("Preencha o Campo:\nEndereço");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.getElementById('TPVISTORIA').value=='V' && document.form1.numero.value==''){
	document.form1.numero.focus()	
	window.alert("Preencha o Campo:\nNumero");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

//conferir CPF CNPJ 
if (document.form1.cpf_cnpj.value == '') 
  { 
    alert("Campo inválido, necessário informar o CPF ou CNPJ"); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false; 
  } 
  if (((document.form1.cpf_cnpj.value.length == 11) && (document.form1.cpf_cnpj.value == 11111111111) || (document.form1.cpf_cnpj.value == 22222222222) || (document.form1.cpf_cnpj.value == 33333333333) || (document.form1.cpf_cnpj.value == 44444444444) || (document.form1.cpf_cnpj.value == 55555555555) || (document.form1.cpf_cnpj.value == 66666666666) || (document.form1.cpf_cnpj.value == 77777777777) || (document.form1.cpf_cnpj.value == 88888888888) || (document.form1.cpf_cnpj.value == 99999999999) || (document.form1.cpf_cnpj.value == 00000000000))) 
  { 
    alert("CPF/CNPJ inválido."); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false; 
  } 


  if (!((document.form1.cpf_cnpj.value.length == 11) || (document.form1.cpf_cnpj.value.length == 14))) 
  { 
    alert("CPF/CNPJ inválido."); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

  var checkOK = "0123456789"; 
  var checkStr = document.form1.cpf_cnpj.value; 
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
    alert("Favor preencher somente com digitos o campo CPF/CNPJ."); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

  var chkVal = allNum; 
  var prsVal = parseFloat(allNum); 
  if (chkVal != "" && !(prsVal > "0")) 
  { 
    alert("CPF zerado !"); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

if (document.form1.cpf_cnpj.value.length == 11) 
{ 
  var tot = 0; 

  for (i = 2;  i <= 10;  i++) 
    tot += i * parseInt(checkStr.charAt(10 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(9))) 
  { 
    alert("CPF/CNPJ inválido."); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 
  
  tot = 0; 
  
  for (i = 2;  i <= 11;  i++) 
    tot += i * parseInt(checkStr.charAt(11 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(10))) 
  { 
    alert("CPF/CNPJ inválido."); 
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

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
    document.form1.cpf_cnpj.focus();
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

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
    document.form1.cpf_cnpj.focus(); 
	document.form1.cpf_cnpj.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 
}
//telefone2	
if (document.form1.telefone2.value==''){
	document.form1.telefone2.focus()	
	window.alert("Preencha o Campo:\nTelefone");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}	
if (document.form1.controle_prest.value==''){
	document.form1.controle_prest.focus()	
	window.alert("Preencha o Campo:\nVistoriador que realizou a vistoria");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//DTVISTORIA
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

//HRVISTORIA
if (document.form1.HRVISTORIA.value==''){
	document.form1.HRVISTORIA.focus()	
	window.alert("Preencha o Campo:\nHora da vistoria prévia");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//CDFINALIDADE
if (document.form1.CDFINALIDADE.value=='' || document.form1.CDFINALIDADE.value=='Nenhum'){
	document.form1.CDFINALIDADE.focus()	
	window.alert("Preencha o Campo:\nFinalidade da vistoria");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if (document.form1.NMPROPONENTE.value==''){
	document.form1.NMPROPONENTE.focus()	
	window.alert("Preencha o Campo:\nNome do Proponente");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//corretor
if (document.form1.corretor.value==''){
	document.form1.corretor.focus()	
	window.alert("Preencha o Campo:\nNome Corretor");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

//susep
if (document.getElementById('SEGURADORA').value!=67&&document.form1.susep.value==''){
	document.form1.susep.focus()	
	window.alert("Preencha o Campo:\nNumero Susep");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

// NOME CORRETOR
if (document.getElementById('SEGURADORA').value==67&&document.getElementById('CDCORRETOR').value=="")
{
window.alert("Favor informe o codigo EV do corretor");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 

//fabricante
if (document.form1.fabricante.value==''){
	document.form1.fabricante.focus()	
	window.alert("Preencha o Campo:\nFabricante");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//modelo
if (document.form1.modelo.value==''){
	document.form1.modelo.focus()	
	window.alert("Preencha o Campo:\nModelo do Veículo");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//NRANOFABRICACAO
if (document.form1.NRANOFABRICACAO.value==''){
	document.form1.NRANOFABRICACAO.focus()	
	window.alert("Preencha o Campo:\nAno de Fabricação");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//NRANOMODELO
if (document.form1.NRANOMODELO.value==''){
	document.form1.NRANOMODELO.focus()	
	window.alert("Preencha o Campo:\nAno de Modelo");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//ANO MODELO MENOR QUE ANO FABRICAÇÃO
if (document.form1.NRANOMODELO.value < document.form1.NRANOFABRICACAO.value){
	document.form1.NRANOMODELO.focus()	
	window.alert("Preencha o Campo:\nAno Modelo Menor que ano de Fabricação do Veiculo");
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//NRPLACA
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

if(document.form1.DSMUNICIPIOPLACA.value==''){
document.form1.DSMUNICIPIOPLACA.focus();
window.alert('Preencha o campo:\nMunicípio da Placa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.UFPLACA.value==''){
document.form1.UFPLACA.focus();
window.alert('Preencha o campo:\nUF da Placa');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//Lacre_Obrigatorio_Emplacamento  restricao
if(document.form1.Lacre_Obrigatorio_Emplacamento.value==''){
document.form1.Lacre_Obrigatorio_Emplacamento.focus();
window.alert('Preencha o campo:\nLacre da Placa Rompido');
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
window.alert('Preencha o campo:\nTipo de Combustível do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//itens_seguranca
if(document.form1.itens_seguranca.value==''){
document.form1.itens_seguranca.focus();
window.alert('Preencha o campo:\nDOC Atualizado para KIT Gás');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.KMVEICULO.value==''){
document.form1.KMVEICULO.focus();
window.alert('Preencha o campo:\nQuilometragem do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.getElementById('INALIENADO').value==''){
document.getElementById('INALIENADO').focus();
window.alert('Preencha o campo:\nVeiculo Alienado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.getElementById('INALIENADO').value=='S' && document.form1.NMALIENADOR.value==''){
document.form1.NMALIENADOR.focus();
window.alert('Preencha o campo:\nEmpresa Alienadora');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
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
window.alert('Preencha o campo:\nNúmero do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


//Codigo_Condicao_Chassi
if(document.form1.Codigo_Condicao_Chassi.value==''){
document.form1.Codigo_Condicao_Chassi.focus();
window.alert('Preencha o campo:\nCondição do Chassi');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//INREMARCADO
if(document.form1.INREMARCADO.value==''){
document.form1.INREMARCADO.focus();
window.alert('Preencha o campo:\nChassi Remarcado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//NRMOTOR
if(document.form1.NRMOTOR.value==''){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNumeração do Motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//condicao_motor1
if(document.form1.condicao_motor1.value==''){
document.form1.condicao_motor1.focus();
window.alert('Preencha o campo:\nMotor Funcionando Corretamente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//Irregularidade do motor
if(document.form1.condicao_motor1.value=='N' && document.form1.condicao_motor.value==''){
document.form1.condicao_motor.focus();
window.alert('Preencha o campo:\nIrregularidade no Motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//Codigo_Condicao_Motor
if(document.form1.Codigo_Condicao_Motor.value==''){
document.form1.Codigo_Condicao_Motor.focus();
window.alert('Preencha o campo:\nSituação do Motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//contem_nota
if(document.form1.contem_nota.value==''){
document.form1.contem_nota.focus();
window.alert('Preencha o campo:\nContem Nota Fiscal');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.contem_nota.value=='S')
{
if(document.form1.numero_nota.value==''){
document.form1.numero_nota.focus();
window.alert('Preencha o campo:\nNumero da nota Fiscal');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
if(document.form1.data_nota_fiscal.value==''){
document.form1.data_nota_fiscal.focus();
window.alert('Preencha o campo:\nData da nota Fiscal');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
if(document.form1.concessionaria.value==''){
document.form1.concessionaria.focus();
window.alert('Preencha o campo:\nConcessionaria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
}

if(document.form1.contem_nota.value=='N')
{
if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Preencha o campo:\nNº de Renavam do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.NRRENAVAM.value=='000000000'
||document.form1.NRRENAVAM.value=='111111111'
||document.form1.NRRENAVAM.value=='222222222'
||document.form1.NRRENAVAM.value=='333333333'
||document.form1.NRRENAVAM.value=='444444444'
||document.form1.NRRENAVAM.value=='555555555'
||document.form1.NRRENAVAM.value=='666666666'
||document.form1.NRRENAVAM.value=='777777777'
||document.form1.NRRENAVAM.value=='888888888'
||document.form1.NRRENAVAM.value=='999999999'
||document.form1.NRRENAVAM.value=='0000000000'
||document.form1.NRRENAVAM.value=='1111111111'
||document.form1.NRRENAVAM.value=='2222222222'
||document.form1.NRRENAVAM.value=='3333333333'
||document.form1.NRRENAVAM.value=='4444444444'
||document.form1.NRRENAVAM.value=='5555555555'
||document.form1.NRRENAVAM.value=='6666666666'
||document.form1.NRRENAVAM.value=='7777777777'
||document.form1.NRRENAVAM.value=='8888888888'
||document.form1.NRRENAVAM.value=='9999999999'
||document.form1.NRRENAVAM.value=='00000000000'
||document.form1.NRRENAVAM.value=='11111111111'
||document.form1.NRRENAVAM.value=='22222222222'
||document.form1.NRRENAVAM.value=='33333333333'
||document.form1.NRRENAVAM.value=='44444444444'
||document.form1.NRRENAVAM.value=='55555555555'
||document.form1.NRRENAVAM.value=='66666666666'
||document.form1.NRRENAVAM.value=='77777777777'
||document.form1.NRRENAVAM.value=='88888888888'
||document.form1.NRRENAVAM.value=='99999999999'){
document.form1.NRRENAVAM.focus();
window.alert('Nº de Renavam do veículo inválido');
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
if(document.form1.DTDUT.value==''){
document.form1.DTDUT.focus();
window.alert('Preencha o campo:\nData de Expedição DUT do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.DTDUT.value.length<=9){
document.form1.DTDUT.focus();
window.alert('Preencha o campo:\nData de Expedição DUT do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

var dataVistoria = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
		var dataVistoriaInt = parseInt(dataVistoria);
		
		var dataDut = document.form1.DTDUT.value.charAt(6)+''+document.form1.DTDUT.value.charAt(7)+''+document.form1.DTDUT.value.charAt(8)+''+document.form1.DTDUT.value.charAt(9)+''+document.form1.DTDUT.value.charAt(3)+''+document.form1.DTDUT.value.charAt(4)+''+document.form1.DTDUT.value.charAt(0)+''+document.form1.DTDUT.value.charAt(1);
		var dataDutInt = parseInt(dataDut);
		
		if(dataDutInt > dataVistoriaInt){
		document.form1.DTDUT.focus();
		window.alert('Preencha o campo:\nData de Expedicao DUT maior que a data da vistoria');
		document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
		}

if(document.form1.NMORGAODUT.value==''){
document.form1.NMORGAODUT.focus();
window.alert('Preencha o campo:\nOrgão Expeditor do DUT');
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

//conferir CPF_CNPJ_Renavam 
/*
if (document.form1.CPF_CNPJ_Renavam.value == '') 
  { 
    alert("Campo inválido, necessário informar o CPF ou CNPJ do Renavam"); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false; 
  } 
  if (((document.form1.CPF_CNPJ_Renavam.value.length == 11) && (document.form1.CPF_CNPJ_Renavam.value == 11111111111) || (document.form1.CPF_CNPJ_Renavam.value == 22222222222) || (document.form1.CPF_CNPJ_Renavam.value == 33333333333) || (document.form1.CPF_CNPJ_Renavam.value == 44444444444) || (document.form1.CPF_CNPJ_Renavam.value == 55555555555) || (document.form1.CPF_CNPJ_Renavam.value == 66666666666) || (document.form1.CPF_CNPJ_Renavam.value == 77777777777) || (document.form1.CPF_CNPJ_Renavam.value == 88888888888) || (document.form1.CPF_CNPJ_Renavam.value == 99999999999) || (document.form1.CPF_CNPJ_Renavam.value == 00000000000))) 
  { 
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false; 
  } 


  if (!((document.form1.CPF_CNPJ_Renavam.value.length == 11) || (document.form1.CPF_CNPJ_Renavam.value.length == 14))) 
  { 
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

  var checkOK = "0123456789"; 
  var checkStr = document.form1.CPF_CNPJ_Renavam.value; 
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
    alert("Favor preencher somente com digitos o campo CPF/CNPJ do Renavam."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

  var chkVal = allNum; 
  var prsVal = parseFloat(allNum); 
  if (chkVal != "" && !(prsVal > "0")) 
  { 
    alert("CPF zerado !"); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 

if (document.form1.CPF_CNPJ_Renavam.value.length == 11) 
{ 
  var tot = 0; 

  for (i = 2;  i <= 10;  i++) 
    tot += i * parseInt(checkStr.charAt(10 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(9))) 
  { 
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 
  
  tot = 0; 
  
  for (i = 2;  i <= 11;  i++) 
    tot += i * parseInt(checkStr.charAt(11 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(10))) 
  { 
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

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
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus();
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

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
    alert("CPF/CNPJ do Renavam inválido."); 
    document.form1.CPF_CNPJ_Renavam.focus(); 
	document.form1.CPF_CNPJ_Renavam.value="";
    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
  } 
}*/
}
if(document.form1.tipo_cabine.value==''){
document.form1.tipo_cabine.focus();
window.alert('Preencha o campo:\nAdaptação para Deficiente Fisico');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//veiculo_blindado
if(document.form1.veiculo_blindado.value==''){
document.form1.veiculo_blindado.focus();
window.alert('Preencha o campo:\nVeiculo Blindado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//INTRANSF
if(document.form1.INTRANSF.value==''){
document.form1.INTRANSF.focus();
window.alert('Preencha o campo:\nVeiculo Transformado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//veiculo_rebaixado
if(document.form1.veiculo_rebaixado.value==''){
document.form1.veiculo_rebaixado.focus();
window.alert('Preencha o campo:\nVeiculo Rebaixado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//veiculo_turbinado
if(document.form1.veiculo_turbinado.value==''){
document.form1.veiculo_turbinado.focus();
window.alert('Preencha o campo:\nVeiculo Turbinado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//CDUSOVEICULO
if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Preencha o campo:\nUso do Veiculo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//TPCARROC

if (document.getElementById('CDDESTVEIC1').value!="6" && document.getElementById('TPCARROC').value=="")
{
window.alert("Favor informe o TIPO DE CARROCERIA");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

//INTERCEIROEIXO
if(document.form1.INTERCEIROEIXO.value==''){
document.form1.INTERCEIROEIXO.focus();
window.alert('Preencha o campo:\nTerceiro Eixo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//plaqueta_existente
if(document.form1.plaqueta_existente.value==''){
document.form1.plaqueta_existente.focus();
window.alert('Preencha o campo:\nExiste Plaqueta');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//situacao_plaqueta
if(document.form1.plaqueta_existente.value=='N' && document.form1.situacao_plaqueta.value==''){
document.form1.situacao_plaqueta.focus();
window.alert('Preencha o campo:\nPlaqueta de Identificação Inexistente');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//etiqueta eta ok
if(document.form1.marca_anti_furto1.value==''){
document.form1.marca_anti_furto1.focus();
window.alert('Preencha o campo:\nEtiqueta ETA ok');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//marca_anti_furto
if(document.form1.marca_anti_furto1.value=='N' && document.form1.marca_anti_furto.value == ''){
document.form1.marca_anti_furto.focus();
window.alert('Preencha o campo:\nIrregularidade da Etiqueta');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//parte inferior ok
if(document.form1.marca_seguranca1.value==''){
document.form1.marca_seguranca1.focus();
window.alert('Preencha o campo:\nParte Inferior ok');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
		
//marca_seguranca
if(document.form1.marca_seguranca1.value =='N' && document.form1.marca_seguranca.value ==''){
document.form1.marca_seguranca.focus();
window.alert('Preencha o campo:\nIrregularidade na Parte Inferior');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

//marca_seguranca
if(document.form1.marca_seguranca1.value =='N' && document.getElementById('PECA_AVARIADA1')==null){
document.form1.marca_seguranca.focus();
window.alert('Foi informado Irregularidade na PARTE INFERIOR, é obrigatório informa a avaria da PARTE INFERIOR');   
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');      

return false;
}	
	
	
	
	
//numero_serie1
if(document.form1.numero_serie1.value ==''){
document.form1.numero_serie1.focus();
window.alert('Preencha o campo:\nPercebido algum vazamento');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//numero_serie
if(document.form1.numero_serie1.value =='S' && document.form1.numero_serie.value ==''){
document.form1.numero_serie.focus();
window.alert('Preencha o campo:\nVazamento Percebido'); 
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if (document.form1.parecer_prest.value=="")
{
document.form1.parecer_prest.focus();
window.alert("Favor defina o PARECER da vistoria");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;    
}  
//grav_vidros
if(document.form1.grav_vidros.value ==''){
document.form1.grav_vidros.focus();
window.alert('Preencha o campo:\nGravações dos Vidros');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//grav_vidros
if( (document.form1.grav_vidros.value == 1 || document.form1.grav_vidros.value == 2) && (document.form1.quantidade_vidros.value == '') ){
document.form1.quantidade_vidros.focus();
window.alert('Preencha o campo:\nQuantidade de Gravações dos Vidros');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//in_logotipo	
if(document.form1.in_logotipo.value ==''){
document.form1.in_logotipo.focus();
window.alert('Preencha o campo:\nVeiculo Logotipado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//aro_pneus
if(document.form1.aro_pneus.value ==''){
document.form1.aro_pneus.focus();
window.alert('Preencha o campo:\nEstepe');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
//marca_medidas
if(document.form1.marca_medidas.value ==''){
document.form1.marca_medidas.focus();
window.alert('Preencha o campo:\nMarca Medida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


// CODIGO DA CIA - SULAMÉRICA
if (document.getElementById('SEGURADORA').value==67&&document.form1.CDCIA.value=="")
{
window.alert("Favor informe o CODIGO DA CIA: SULAMERICA, BRASIL VEICULOS ou CAIXA SEGUROS");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 



// NOME CORRETOR
if (document.getElementById('SEGURADORA').value==67&&document.getElementById('corretor').value=="")
{
window.alert("Favor informe o CORRETOR");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 

// NOME CORRETOR
if (document.getElementById('SEGURADORA').value==67&&document.getElementById('CDCORRETOR').value=="")
{
window.alert("Favor informe o codigo EV do corretor");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
} 



// PARECER DA PRESTADORA
if (document.getElementById('parecer_prest').value=="")
{
window.alert("Favor defina o PARECER da vistoria");
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

	cont=0;
	vetor='';
	vetor_char='';
	var versao = 0;
	if(navigator.appVersion.indexOf("MSIE")!= -1)
	{
		var temp = navigator.appVersion.split("MSIE");
		versao = parseFloat(temp[1]);
	}
	while(cont<document.forms[0].elements.length) //laço para ver todos os campos da form
	{ 
		if(document.forms[0].elements[cont].alt) //ver se tem o atributo alt(se for obrigatorio) na campo
		{
	    	vetor = document.forms[0].elements[cont].alt.split(',');//divide o o campo obrigatorio em 3(0:que tipo de operação vai fazer com os caracteres variando entrei 1 e 2 e 3 , 1:tamanho de character e se for 3(no vetor[0]) pega o id do acessorio opcional, etc, 2:escrever o erro    
	    	if(document.forms[0].elements[cont].value==''&&vetor[0]!=='3')//verifica se valor do campo está vazio, tendo o atributo alt e diferente de de 3 no vetor[0]
	        {
				document.forms[0].elements[cont].focus();
	        	alert(vetor[2]);//mostra que o campo está vazio
	            document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	        }
			if(vetor[0]==2&&versao>0)//verifica se no primeiro parametro for 2(se ele é só obrigatorio)
			{
				if(document.forms[0].elements[cont].value.length<1)//verifica se valor do campo está vazio, tendo o atributo alt
				{
				 	document.forms[0].elements[cont].focus();
					alert(vetor[2]);//mostra que o campo está vazio
                    document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;	
				}
			}
			if(vetor[0]==1)//verifica se no primeiro parametro for 1(tem mais que um valor maximo)
			{
	        	cont_char=0;
				vetor_char=vetor[1].split('-');//o tamanho do char pode ter mais de um valor e nesse split ele divide
	            controle=0;
	    		while(cont_char<vetor_char.length)//enquanto o contador for menor que o tamanho minimo do vetor
	    		{
	    			if(document.forms[0].elements[cont].value.length+' '!==vetor_char[cont_char]+' ')//se o tamanho do valor do campo for diferente do tamanho minimo
	        		{
	        			controle++;//controle para não ficar mostrando varias vezes o erro
	        		}
	        		cont_char++;//anda com o contador
	   			 }	
	             if(controle==cont_char)//está no campo que vai dar o erro
	             {
					document.forms[0].elements[cont].focus();//deixa o focus na campo com erro
	             	alert(vetor[2]);//imprime o erro
	                document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;	
	             }            
	        }
		    if(vetor[0]==3)//verifica se no primeiro parametro for 3(for os acessorios e opcionais, etc.)
			{
				if(document.forms[0].elements[cont].value==''&&document.getElementById(vetor[1]).value!=='')//se o proprio campo estiver vazio e o id do acessorio opcinais,etc está vazio
				{
					document.forms[0].elements[cont].focus();//deixa o focus na campo com erro
	             	alert(vetor[2]);//imprime o erro
	                document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;	
				}
			}		
			if(vetor[0]==4)//verifica se o campo o valor é maior que 0 
			{
				if(parseInt(document.forms[0].elemente[cont].value<=(parseInt(vetor[1])))||document.forms[0].elemente[cont].value=="")//se o valor for menor que estipulado ou estiver vazio
				{
					document.forms[0].elements[cont].focus();//deixa o focus na campo com erro
					alert(vetor[2]);//imprime o erro
					document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;	
				}
			}
		}
		if(versao==0)
		{
	    	if(document.forms[0].elements[cont].type=='select-one'&&document.forms[0].elements[cont].value.length<1||
			document.forms[0].elements[cont].type=='select-one'&&document.forms[0].elements[cont].value==document.forms[0].elements[cont].options[0].text)
			{
				var nome_campo = document.forms[0].elements[cont].name;
				var corpo = document.body.innerHTML.split('name="'+nome_campo+'"');
				var corpo1 = corpo[1].split('>');
				var corpo2 = (corpo1[0]+"alt=").split('alt=');
				var texto = corpo2[1]+"";
				if(texto.length>3)
				{
					var vetor = ((texto.replace(/"/gi,'')).replace(/'/gi,"")).split(',');
					if(vetor[0]==2)//verifica se no primeiro parametro for 2(se ele é só obrigatorio)
					{
						document.forms[0].elements[cont].focus();
						var vetor1 = vetor[2].split('=');
						var vetor2 = vetor1[0].split(' ');
						var index_vetor = "";
						contador = 0;
						while(contador<(vetor2.length))
						{
							index_vetor+=vetor2[contador]+" ";
							contador++
						}
						alert(index_vetor);//mostra que o campo está vazio
		            	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
					}
				}  
				
			}   
		}
		cont++;//conta o while da form para precorrer cada campo   
	}	
	
	
	
}//fim valida