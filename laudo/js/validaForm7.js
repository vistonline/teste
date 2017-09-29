
function valida_cep_vistoria(){
	if((document.getElementById('TPVISTORIA').selectedIndex==2) && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
	document.form1.cep.focus();
	document.getElementById('cep').value="";
	window.alert('CEP da vistoria Inválido\nFavor Informar um CEP válido ou a vistoria não será gravada!'); 
	return false;
	}
}
	
function valida(){
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
window.alert('Preencha o campo:\nNumero da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.NRVISTORIA.value.length < 5){
document.form1.NRVISTORIA.focus();
window.alert('Preencha o campo:\nNumero da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}


if(document.getElementById('voucher')!=null){
	if(document.form1.voucher.value==''){
	document.form1.voucher.focus();
	window.alert('Preencha o campo:\nVoucher');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

	if(document.form1.voucher.value.length>12){
	document.form1.voucher.focus();
	window.alert('Voucher inválido. Preencha o campo:\nVoucher com até 12 dígitos');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

	/*var digito = document.form1.voucher.value.charAt(14)+''+document.form1.voucher.value.charAt(15);
	if ((digito!='17')&&(digito!='25')&&(digito!='33')&&(digito!='41')&&(digito!='58')&&(digito!='66')&&(digito!='74')&&(digito!='82')&&(digito!='99')){
	document.form1.voucher.focus();
	window.alert('Dígito do Voucher Inválido');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}*/
}

if(document.getElementById('nrAplice')!=null){
	if(document.form1.nrAplice.value==''){
	document.form1.voucher.focus();
	window.alert('Preencha o campo:\nNúmero da Apólice');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}	
}

if(document.getElementById('sucursal')!=null){
	if(document.form1.sucursal.value==''){
	document.form1.sucursal.focus();
	window.alert('Preencha o campo:\nFilial');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
}

if(document.getElementById('UFVISTORIA')!=null){
	if(document.form1.UFVISTORIA.value==''){
	document.form1.UFVISTORIA.focus();
	window.alert('Selecione a UF da Vistoria');
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
}

if(document.form1.TPVISTORIA.value==''){
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

if( (document.form1.TPVISTORIA.value=='V') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7) ){
document.form1.cep.focus();
document.getElementById('cep').value="";
window.alert('Preencha o campo:\nCEP do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.UF.value==''){
window.alert('Preencha o campo:\nUF do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.cidade.value==''){
window.alert('Preencha o campo:\nCidade do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPVISTORIA.value=='V'&&document.form1.bairro.value==''){
window.alert('Preencha o campo:\nBairro do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPVISTORIA.value=='V'&&document.form1.endereco.value==''){
window.alert('Preencha o campo:\nEndereço do Local da Vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPVISTORIA.value=='V'&&document.form1.numero.value==''){
window.alert('Preencha o campo:\nNúmero do Local da Vistoria');
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

var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);

if(document.form1.DTVISTORIA.value==''){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\n Data da Vistoria Prévia');
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
	if(data3<parseInt(document.form1.controle_data.value)){
document.form1.DTVISTORIA.focus();
window.alert('Preencha o campo:\nData da Vistoria Prévia');
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
window.alert('Preencha o campo:\nHora da realização da vistoria');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.CDFINALIDADE.value=='' || document.form1.CDFINALIDADE.value=='Nenhum'){
document.form1.CDFINALIDADE.focus();
window.alert('Preencha o campo:\nFinalidade da realização da vistoria');
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

if(document.form1.susep.value==''){
document.form1.susep.focus();
window.alert('Preencha o campo:\nCodigo do Corretor Allianz');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.corretor.value==''){
document.form1.corretor.focus();
window.alert('Preencha o campo:\nNome do Corretor');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.cd_veiculo.value==''){
document.form1.cd_veiculo.focus();
window.alert('Preencha o campo:\n Código do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.fabricante.value==''){
document.form1.fabricante.focus();
window.alert('Preencha o campo:\n Fabricante do Veículo');
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

if(document.form1.UFPLACA.value==''){
document.form1.UFPLACA.focus();
window.alert('Preencha o campo:\n UF da Placa');
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

if(document.form1.NRANOFABRICACAO.value.length<4){
document.form1.NRANOFABRICACAO.focus();
window.alert('Preencha o campo:\nPreencha o Ano de Fabricação do veículo com 4 dígitos');
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

if(document.form1.NRANOMODELO.value.length<4){
document.form1.NRANOMODELO.focus();
window.alert('Preencha o campo:\nPreencha o Ano de Modelo do veículo com 4 dígitos');
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

if(document.form1.descricao_veiculo.value==''){
document.form1.descricao_veiculo.focus();
window.alert('Preencha o campo:\nClasse Vistoria');
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

if(document.form1.INREMARCADO.value==''){
document.form1.INREMARCADO.focus();
window.alert('Preencha o campo:\nVeiculo Remarcado');
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
//alert(confere_chassi1);

if(document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==8&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==9&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==12&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==17){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi incorreto ('+chassi.length+' dígitos)');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');
return false;
}

if(document.form1.NRANOFABRICACAO.value>=1989&&confere_chassi1!==17){
document.form1.NRCHASSI.focus();
window.alert('Preencha o campo:\nNúmero do Chassi incorreto ('+chassi.length+' dígitos)');
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


if(document.form1.NRMOTOR.value==''){
document.form1.NRMOTOR.focus();
window.alert('Preencha o campo:\nNº de Motor do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.cilindros.value==''){
document.form1.cilindros.focus();
window.alert('Preencha o campo:\nCilindradas');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.NRRENAVAM.value==''){
document.form1.NRRENAVAM.focus();
window.alert('Preencha o campo:\nNº de Renavam do veículo');
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
if(document.form1.CPF_CNPJ_CRLV.value==''){
document.form1.CPF_CNPJ_CRLV.focus();
window.alert('Preencha o campo:\nCPF/CNPJ que consta no DUT');
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
if(document.form1.CDUSOVEICULO.value==''){
document.form1.CDUSOVEICULO.focus();
window.alert('Preencha o campo:\nUso do Veículo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

if(document.form1.INTERCEIROEIXO.value==''){
document.form1.INTERCEIROEIXO.focus();
window.alert('Preencha o campo:\nTerceiro Eixo');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.TPCARROC.value==''){
document.form1.TPCARROC.focus();
window.alert('Preencha o campo:\nTipo da Carroceria');
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
if(document.form1.avaliacao.value==''){
document.form1.avaliacao.focus();
window.alert('Preencha o campo:\nAvaliação');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(document.form1.recomendacao1.value==''){
document.form1.recomendacao1.focus();
window.alert('Obrigatório selecionar ao menos uma Recomendação');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(typeof(cpf_cnpj) !== 'undefined'  && document.form1.cpf_cnpj.value==''){
document.form1.cpf_cnpj.focus();
window.alert('Preencha o campo:\nCPF/CNPJ');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;

}
if(typeof(tel1) !== 'undefined' && document.form1.tel1.value==''){
document.form1.tel1.focus();
window.alert('Preencha o campo:\nTelefone');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}
if(typeof(tel2) !== 'undefined' && document.form1.tel2.value==''){
document.form1.tel2.focus();
window.confirm('Preencha o campo:\nTelefone');
document.getElementById('buttonGravar1').removeAttribute('hidden');
document.getElementById('buttonGravar2').removeAttribute('hidden');

return false;
}

}