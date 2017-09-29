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
	window.alert('Preencha o campo:\nNº da Vistoria ');
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

if(document.form1.CDFINALIDADE.value=='03'){
	if(document.form1.apolice.value==''){
		document.form1.apolice.focus();
		window.alert("Obrigat"+"\u00f3"+"rio informar o n"+"\u00fa"+"mero da AP"+"\u00d3"+"LICE\npara vistorias de PAGAMENTO EM ATRASO");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
	if(document.form1.apolice.value.length<11 || document.form1.apolice.value.length>12){
		document.form1.apolice.focus();
		window.alert("N"+"\u00fa"+"mero da AP"+"\u00d3"+"LICE inv"+"\u00e1"+"lido!, deve possuir 11 ou 12 d"+"\u00ed"+"gitos");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
	if(document.form1.apolice.value=='11111111111' || document.form1.apolice.value=='22222222222' || document.form1.apolice.value=='33333333333' || document.form1.apolice.value=='44444444444' || document.form1.apolice.value=='55555555555' || document.form1.apolice.value=='66666666666' || document.form1.apolice.value=='77777777777' || document.form1.apolice.value=='88888888888' || document.form1.apolice.value=='99999999999' || document.form1.apolice.value=='00000000000' || document.form1.apolice.value=='01234567890'){
		document.form1.apolice.focus();
		window.alert("N"+"\u00fa"+"mero da AP"+"\u00d3"+"LICE inv"+"\u00e1"+"lido!");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
}

if(document.form1.CDFINALIDADE.value!='03'){
	
	var iniProposta=document.form1.proposta.value.charAt(0)+''+document.form1.proposta.value.charAt(1);
	
	if(document.form1.proposta.value==''){
		document.form1.proposta.focus();
		window.alert("Obrigat"+"\u00f3"+"rio informar o n"+"\u00fa"+"mero da PROPOSTA");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
	if(document.form1.proposta.value.length<11 || document.form1.proposta.value.length>12){
		document.form1.proposta.focus();
		window.alert("N"+"\u00fa"+"mero da PROPOSTA inv"+"\u00e1"+"lido!, deve possuir 11 ou 12 d"+"\u00ed"+"gitos");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
	if(iniProposta!="25" && iniProposta!="27"  && iniProposta!="28"  && iniProposta!="31"  && iniProposta!="33"  && iniProposta!="35"  && iniProposta!="37"  && iniProposta!="38"  && iniProposta!="41"  && iniProposta!="42"  && iniProposta!="43"  && iniProposta!="45"  && iniProposta!="46"  && iniProposta!="48"  && iniProposta!="52"  && iniProposta!="53"  && iniProposta!="55"  && iniProposta!="56"  && iniProposta!="57"){
		document.form1.proposta.focus();
		window.alert("N"+"\u00fa"+"mero da PROPOSTA inv"+"\u00e1"+"lido!");
		document.getElementById('buttonGravar1').removeAttribute('hidden');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
}


if(document.form1.TPVISTORIA.value=='')
{
document.form1.TPVISTORIA.focus();
window.alert('Selecione o campo:\nLocal onde foi feito a Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.TPVISTORIA.value=='P'&&document.form1.endereco_posto.value==''){
window.alert('Preencha o campo:\nEndereço do Posto');
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
if(document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='3'||document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='10'){

var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);
if(document.form1.DTVISTORIA.value==''){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Prévia');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(data3<parseInt(document.form1.controle_data.value)){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\nData da Vistoria Prévia');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(data3>parseInt(document.form1.DTPROC.value)){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Prévia');
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

if(document.form1.HRVISTORIA.value.length<5){
document.form1.HRVISTORIA.focus();
window.alert('Hora inicial da vistoria Inválida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;     
}   
if(document.form1.HRVISTORIA.value.charAt(0)+""+document.form1.HRVISTORIA.value.charAt(1)>23){
document.form1.HRVISTORIA.focus();
window.alert('Hora inicial da vistoria Inválida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.HRVISTORIA.value.charAt(3)+""+document.form1.HRVISTORIA.value.charAt(4)>59){
document.form1.HRVISTORIA.focus();
window.alert('Hora inicial da vistoria Inválida');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.getElementById('corretor').value==''){
document.getElementById('corretor').focus();
window.alert('Preencha o campo:\nNome do corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.getElementById('susep').value==''){
document.getElementById('susep').focus();
window.alert('Preencha o campo:\nCódigo do corretor na Susep');
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


if(document.form1.cep_proponente.value=='' || document.form1.cep_proponente.value == '00000000'){
document.form1.cep_proponente.focus();
window.alert('Preencha o campo:\nCEP do proponente vazio ou inválido');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.cep_proponente.value.length <= 7 ){
document.form1.cep_proponente.focus();
window.alert('Preencha o campo:\nCEP do proponente vazio ou inválido');
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
if(document.form1.numero_proponente.value==''){
document.form1.numero_proponente.focus();
window.alert('Preencha o campo:\nNumero do Endereço do proponente');
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
window.alert('Preencha o campo:\nCPF/CNPJ do proponente');
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

if(document.form1.fabricante.value==''){
document.form1.fabricante.focus();
window.alert('Selecione o\n Fabricante do Veículo');
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
window.alert('Preencha o campo:\nNº da Placa ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPLACA1.value==''){
document.form1.NRPLACA1.focus();
window.alert('Preencha o campo:\nNº da Placa novamente');
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

if(document.form1.NRANOFABRICACAO.value=='' || document.form1.NRANOFABRICACAO.value.length<4){
document.form1.NRANOFABRICACAO.focus();
window.alert('Preencha o campo:\nAno de Fabricação do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRANOMODELO.value=='' || document.form1.NRANOMODELO.value.length<4){
document.form1.NRANOMODELO.focus();
window.alert('Preencha o campo:\nAno do Modelo do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Selecione o uso do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.possui_carroceria.value==''){
document.form1.possui_carroceria.focus();
window.alert('Preencha o campo:\nVeículo possui carroceria?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.capacidade_veiculo.value=='' || document.form1.capacidade_veiculo.value==0){
document.form1.capacidade_veiculo.focus();
window.alert('Preencha o campo:\nCapacidade do veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRPORTAS.value==''){
document.form1.NRPORTAS.focus();
window.alert('Preencha o campo:\nNúmero de portas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.possui_carroceria.value=='S')
{
	if(document.form1.DSMARCACARROC.value=='')
	{
	document.form1.DSMARCACARROC.focus();
	window.alert('Preencha o campo:\nMarca da carroceria');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
	if(document.form1.NRCARROC.value=='')
	{
	document.form1.NRCARROC.focus();
	window.alert('Preencha o campo:\nNúmero da carroceria');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
	if(document.form1.TPCARROC.value=='')
	{
	document.form1.TPCARROC.focus();
	window.alert('Selecione o tipo da carroceria');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
	}
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


if(document.form1.KMVEICULO.value==''){
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

if(document.form1.NRMOTOR.value==''){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNúmero do motor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}


if(document.form1.cilindros.value==''){
document.form1.cilindros.focus();
window.alert('Preencha o campo:\nNúmero de cilindros');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Preencha o campo:\nRenavam');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.NRDUT.value==''){
document.form1.NRDUT.focus();
window.alert('Preencha o campo:\nNúmero do DUT');
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
		
if(document.form1.NMDUT.value==''){
document.form1.NMDUT.focus();
window.alert('Preencha o campo:\nNome que consta no DUT');
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
if(document.form1.cidade_dut.value==''){
document.form1.cidade_dut.focus();
window.alert('Preencha o campo:\nCidade que consta no DUT');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.NMORGAODUT.value==''){
document.form1.NMORGAODUT.focus();
window.alert('Selecione o campo:\nUF do DUT');
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

if(document.form1.INTRANSF.value==''){
document.form1.INTRANSF.focus();
window.alert('Informe o campo:\nVeículo transformado');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.conversivel.value==''){
document.form1.conversivel.focus();
window.alert('Informe o campo:\nPossui Conversível?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.possui_rodoar.value==''){
document.form1.possui_rodoar.focus();
window.alert('Informe o campo:\nPossui rodoar?');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.grav_vidros.value==''){
document.form1.grav_vidros.focus();
window.alert('Informe o campo:\nGravação de Vidro');
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
if(document.form1.ano_tarjeta.value==''){
document.form1.ano_tarjeta.focus();
window.alert('Preencha o campo:\nAno da tarjeta');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.pneus.value==''){
document.form1.pneus.focus();
window.alert('Preencha o campo:\nAro pneus');
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
}







