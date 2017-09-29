function valida_cep_vistoria(){
if((document.form1.tipo_endereco.value=='2') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
document.form1.cep.focus();
document.getElementById('cep').value="";
window.alert('CEP da vistoria Inválido\nFavor Informar um CEP válido ou a vistoria não será gravada!'); 
return false;
}
}

function valida(){
	
// REMOVE ÚTIMO ITEM NÃO ADICIONADO: ACESSÓRIOS E AVARIAS
try{

var buttons = document.getElementsByClassName('botao');
if(buttons.length > 1){
var botaoADD = buttons[buttons.length-1];

if(botaoADD.attributes.length === 8) botaoADD.parentElement.remove(this);
else throw 'Sem botao para remover';

}else if(buttons.length==1 && buttons[0].attributes.length === 8){

buttons[0].parentElement.remove(this);

}

}catch(err){

}
// FIM - REMOVE ÚTIMO ITEM NÃO ADICIONADO: ACESSÓRIOS E AVARIAS		
	
if(document.getElementById('tipoVistoria')!=null && document.getElementById('tipoVistoria').selectedIndex<1){
	document.form1.tipoVistoria.focus();
	window.alert('Selecione o campo:\nTipo de Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	
	
	
if(document.form1.SEGURADORA.value==''){
	document.form1.SEGURADORA.focus();
	window.alert('Preencha o campo:\nSeguradora');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}


if(document.form1.NRVISTORIA.value==''){
	document.form1.NRVISTORIA.focus();
	window.alert('Preencha o campo:\nNº da Vistoria ');
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
	
if(document.form1.TPVISTORIA.value=='' || document.form1.TPVISTORIA.value=='Nenhum'){
	document.form1.TPVISTORIA.focus();
	window.alert('Selecione o campo:\nLocal onde foi feito a Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='P'&&document.form1.endereco_posto.value==''){
	window.alert('Preencha o campo:\nEndereço do Posto');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if((document.form1.TPVISTORIA.value=='V') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
	document.form1.cep.focus();
	window.alert('Preencha o campo:\n CEP - Inválido ou menos que 8 digitos');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.UF.value==''){
	window.alert('Preencha o campo:\nUF do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.cidade.value==''){
	window.alert('Preencha o campo:\nCidade do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V'&&document.form1.bairro.value==''){
	window.alert('Preencha o campo:\nBairro do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V'&&document.form1.endereco.value==''){
	window.alert('Preencha o campo:\nEndereço do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V' && document.form1.numero.value==''){
	window.alert('Preencha o campo:\nNúmero do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.getElementById('controle_prest').value==''){
	document.getElementById('controle_prest').focus();
	window.alert('Selecione o campo:\nVistoriador que realizou a Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='3'||document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='10'){
var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);
	if(document.form1.DTVISTORIA.value==''){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
		
	if(data3<parseInt(document.form1.controle_data.value)&&document.form1.SEGURADORA.value!=="61"){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\nData da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
		
	if(data3>parseInt(document.form1.DTPROC.value)){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
}

if(document.form1.HRVISTORIA.value==''){
	document.form1.HRVISTORIA.focus();
	window.alert('Preencha o campo:\nHora da realização da vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDFINALIDADE.value==''){
	document.form1.CDFINALIDADE.focus();
	window.alert('Preencha o campo:\nFinalidade da realização da vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NMPROPONENTE.value==''){
	document.form1.NMPROPONENTE.focus();
	window.alert('Preencha o campo:\nNome do Proponente');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.cpf_cnpj.value==''){
	document.form1.cpf_cnpj.focus();
	window.alert('Preencha o campo:\nCPF / CNPJ');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}


if(document.getElementById('telefone')!=null && document.form1.telefone.value==''){
	document.form1.telefone.focus();
	window.alert('Preencha o campo:\nTelefone');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.getElementById('tel1')!=null && document.form1.tel1.value==''){
	document.form1.tel1.focus();
	window.alert('Preencha o campo:\nTelefone');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.tipo_pessoa.value==''){
	document.form1.tipo_pessoa.focus();
	window.alert('Preencha o campo:\nTipo de Pessoa');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.getElementById('corretor').value==''){
	document.getElementById('corretor').focus();
	window.alert('Preencha o campo:\nNome do Corretor');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.getElementById('susep').value==''){
	document.getElementById('susep').focus();
	window.alert('Preencha o campo:\nSusep do Corretor');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.codigo.value==''){
	document.form1.codigo.focus();
	window.alert('Preencha o campo:\n Código do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.fabricante.value==''){
	document.form1.fabricante.focus();
	window.alert('Preencha o campo:\n Fabricante do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.modelo.value==''){
	document.form1.modelo.focus();
	window.alert('Preencha o campo:\n Modelo do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}



if(document.form1.descricao_veiculo!=null && document.form1.descricao_veiculo.value==''){
	document.form1.descricao_veiculo.focus();
	window.alert('Selecione o campo:\n Veículo zero Km?');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.numero_inspecao!=null && document.form1.numero_inspecao.value==''){
	document.form1.numero_inspecao.focus();
	window.alert('Selecione o campo:\n Inspeção tributária?');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	

if(document.form1.NRPLACA.value==''){
	document.form1.NRPLACA.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.NRPLACA1.value==''){
	document.form1.NRPLACA1.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
			if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
			if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
			if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
			if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
			return false;
		}
}

var placa_i = document.form1.NRPLACA1.value;
var placa_p = document.form1.NRPLACA.value;

if(placa_i!==placa_p){
	document.form1.NRPLACA1.focus();
	window.alert('As placas digitadas não confere');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
				if(document.getElementById('buttonGravar1')!=null){
					document.getElementById('buttonGravar1').removeAttribute('hidden');
					}
				if(document.getElementById('buttonGravar2')!=null){
					document.getElementById('buttonGravar2').removeAttribute('hidden');
					}
				return false;
				}
	}
}

if(document.form1.situacao_placa!=null && document.form1.situacao_placa.value==''){
	document.form1.situacao_placa.focus();
	window.alert('Preencha o campo:\nCategoria da Placa');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	
  
if(document.form1.DSMUNICIPIOPLACA.value==''){
	document.form1.DSMUNICIPIOPLACA.focus();
	window.alert('Preencha o campo:\nMunicípio da Placa');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.UFPLACA.value==''){
	document.form1.UFPLACA.focus();
	window.alert('Preencha o campo:\n da Placa');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRANOFABRICACAO.value=='' || document.form1.NRANOFABRICACAO.value.length<4){
	document.form1.NRANOFABRICACAO.focus();
	window.alert('Preencha o campo:\nAno de Fabricação do veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRANOMODELO.value=='' || document.form1.NRANOMODELO.value.length<4){
	document.form1.NRANOMODELO.focus();
	window.alert('Preencha o campo:\nAno do Modelo do veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRPORTAS.value==''){
	document.form1.NRPORTAS.focus();
	window.alert('Preencha o campo:\nNº de Portas');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.cor.value==''){
	document.form1.cor.focus();
	window.alert('Preencha o campo:\nCor do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPPINTURA.value==''){
	document.form1.TPPINTURA.focus();
	window.alert('Preencha o campo:\nTipo de Pintura do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPCOMBUSTIVEL.value==''){
	document.form1.TPCOMBUSTIVEL.focus();
	window.alert('Preencha o campo:\nTipo de Combustível do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.KMVEICULO.value==''){
	document.form1.KMVEICULO.focus();
	window.alert('Preencha o campo:\nQuilometragem do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.INALIENADO.value==''){
	document.form1.INALIENADO.focus();
	window.alert('Preencha o campo:\nVeículo Alienado');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.INALIENADO.value=='S'&&document.form1.NMALIENADOR.value==''){
	document.form1.NMALIENADOR.focus();
	window.alert('Preencha o campo:\nEmpresa Alienadora');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
var chassi = document.form1.NRCHASSI.value.charAt(0)+""+document.form1.NRCHASSI.value.charAt(2)+""+document.form1.NRCHASSI.value.charAt(4)+""+document.form1.NRCHASSI.value.charAt(6)+""+document.form1.NRCHASSI.value.charAt(8)+""+document.form1.NRCHASSI.value.charAt(10)+""+document.form1.NRCHASSI.value.charAt(12)+""+document.form1.NRCHASSI.value.charAt(14)+""+document.form1.NRCHASSI.value.charAt(16)+""+document.form1.NRCHASSI.value.charAt(18)+""+document.form1.NRCHASSI.value.charAt(20)+""+document.form1.NRCHASSI.value.charAt(22)+""+document.form1.NRCHASSI.value.charAt(24)+""+document.form1.NRCHASSI.value.charAt(26)+""+document.form1.NRCHASSI.value.charAt(28)+""+document.form1.NRCHASSI.value.charAt(30)+""+document.form1.NRCHASSI.value.charAt(32);
var confere_chassi1 = chassi.length;

if(document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==8&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==9&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==12&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==14&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==17){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRANOFABRICACAO.value>=1989&&confere_chassi1!==17){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRCHASSI.value==''){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.CHASSI.value==''){
	document.form1.CHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRCHASSI.value==''){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.Codigo_Condicao_Chassi!=null && document.form1.Codigo_Condicao_Chassi.value==''){
	document.form1.Codigo_Condicao_Chassi.focus();
	window.alert('Informe o campo:\nCondição Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
	
	
if(document.form1.NRMOTOR.value==''){
	document.form1.NRMOTOR.focus();
	window.alert('Preencha o campo:\nNº de Motor do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.condicao_numero_motor!=null && document.form1.condicao_numero_motor.value==''){
	document.form1.condicao_numero_motor.focus();
	window.alert('Informe o campo:\nCondição do Número do Motor');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}		
	
if(document.form1.cilindros!=null && document.form1.cilindros.value==''){
	document.form1.cilindros.focus();
	window.alert('Preencha o campo:\nNúmero de Cilindros');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	

if(document.form1.contem_nota.value==''){
	document.form1.contem_nota.focus();
	window.alert('Preencha o campo:\nVeículo contém nota fiscal');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.contem_nota.value=='S'){
	if(document.form1.numero_nota.value==''){
		document.form1.numero_nota.focus();
		window.alert('Preencha o campo:\nNumero da nota Fiscal');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	if(document.form1.data_nota_fiscal.value==''){
		document.form1.data_nota_fiscal.focus();
		window.alert('Preencha o campo:\nData da nota Fiscal');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	if(document.form1.concessionaria.value==''){
		document.form1.concessionaria.focus();
		window.alert('Preencha o campo:\nConcessionaria');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
}

if(document.form1.contem_nota.value=='N')
	{
	if(document.form1.NRRENAVAM.value==''){
		document.form1.NRRENAVAM.focus();
		window.alert('Preencha o campo:\nNº de Renavam do veículo');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	
	if(document.form1.NRRENAVAM.value.length<9||document.form1.NRRENAVAM.value.length==10||document.form1.NRRENAVAM.value.length>11){
		document.form1.NRRENAVAM.focus();  
		window.alert('Renavam INVÁLIDO (aceita apenas com 9 ou 11 dígitos)');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}	
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
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	}
	
	if(document.form1.NRDUT.value==''){
		document.form1.NRDUT.focus();
		window.alert('Preencha o campo:\nNº do DUT do veículo');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	if(document.form1.DTDUT.value==''){
		document.form1.DTDUT.focus();
		window.alert('Preencha o campo:\nData de Expedição DUT do veículo');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	if(document.form1.DTDUT.value.length<=9){
		document.form1.DTDUT.focus();
		window.alert('Preencha o campo:\nData de Expedição DUT do veículo');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	
	var dataVistoria = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
			var dataVistoriaInt = parseInt(dataVistoria);
			
			var dataDut = document.form1.DTDUT.value.charAt(6)+''+document.form1.DTDUT.value.charAt(7)+''+document.form1.DTDUT.value.charAt(8)+''+document.form1.DTDUT.value.charAt(9)+''+document.form1.DTDUT.value.charAt(3)+''+document.form1.DTDUT.value.charAt(4)+''+document.form1.DTDUT.value.charAt(0)+''+document.form1.DTDUT.value.charAt(1);
			var dataDutInt = parseInt(dataDut);
			
			if(dataDutInt > dataVistoriaInt){
			document.form1.DTDUT.focus();
			window.alert('Preencha o campo:\nData de Expedicao DUT maior que a data da vistoria');
			if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	
	return false;
			}
	
	if(document.form1.NMORGAODUT.value==''){
		document.form1.NMORGAODUT.focus();
		window.alert('Preencha o campo:\nOrgão Expeditor do DUT');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
	if(document.form1.NMDUT.value==''){
		document.form1.NMDUT.focus();
		window.alert('Preencha o campo:\nNome que consta no DUT');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
}


if(document.form1.INTRANSF.value==''){
	document.form1.INTRANSF.focus();
	window.alert('Preencha o campo:\nIndicador de veículo Transformado');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.INTRANSF.value=='S'&&document.form1.DSTRANSF.value==''){
	document.form1.DSTRANSF.focus();
	window.alert('Preencha o campo:\nDescrição de Transformação do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDDESTVEIC.value==''){
	document.form1.CDDESTVEIC.focus();
	window.alert('Preencha o campo:\nDestinação do veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDDESTVEIC.value=='4'&&document.form1.DSMARCACARROC.value==''){
	window.alert('Preencha o campo:\nMarca da Carroceria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDDESTVEIC.value=='4'&&document.form1.NRCARROC.value==''){
	window.alert('Preencha o campo:\nNúmero da Carroceria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDDESTVEIC.value=='4'&&document.form1.TPCARROC.value==''){
	window.alert('Preencha o campo:\nTipo de Carroceria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDDESTVEIC.value=='4'&&document.form1.CDMATERIALCARROC.value==''){
	window.alert('Preencha o campo:\nMaterial da Carroceria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.INTERCEIROEIXO.value==''){
	document.form1.INTERCEIROEIXO.focus();
	window.alert('Preencha o campo:\nTerceiro Eixo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.getElementById('RESSALVA')!=null && document.form1.CDRESSALVA.value==''){
	document.form1.CDRESSALVA.focus();
	window.alert('Preencha o campo:\nCódigo da Ressalva');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	

if(document.form1.CDUSOVEICULO.value==''){
	document.form1.CDUSOVEICULO.focus();
	window.alert('Preencha o campo:\nUso do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.GRAVA_VIDROS.value==''){
	document.form1.GRAVA_VIDROS.focus();
	window.alert('Preencha o campo:\nGravação de Vidros');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.GRAVA_VIDROS.value=='S'&&document.form1.quantidade_vidros.value<1){
	document.form1.quantidade_vidros.focus();
	window.alert('Preencha o campo:\nGravação de Vidros Quantidade');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.marca_medidas.value==''){
	document.form1.marca_medidas.focus();
	window.alert('Preencha o campo:\nMarca/Medida');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
	
if(document.form1.Reparos_Identificados_nas_Estruturas!=null && document.form1.Reparos_Identificados_nas_Estruturas.value==''){
	document.form1.Reparos_Identificados_nas_Estruturas.focus();
	window.alert('Informe o campo :\nVeículo com indícios de recuperado de colisão de grande monta?');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	
		
if(document.form1.avaliacao.value!=null && document.form1.avaliacao.value==''){
	document.form1.avaliacao.focus();
	window.alert('Informe o campo :\nAvaliação Final');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}	

}

function validaVistoriadorQuintao(){
	if(document.form1.SEGURADORA.value==''){
	document.form1.SEGURADORA.focus();
	window.alert('Preencha o campo:\nSeguradora');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}


if(document.form1.NRVISTORIA.value==''){
	document.form1.NRVISTORIA.focus();
	window.alert('Preencha o campo:\nNº da Vistoria ');
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
	
if(document.form1.TPVISTORIA.value=='' || document.form1.TPVISTORIA.value=='Nenhum'){
	document.form1.TPVISTORIA.focus();
	window.alert('Selecione o campo:\nLocal onde foi feito a Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='P'&&document.form1.endereco_posto.value==''){
	window.alert('Preencha o campo:\nEndereço do Posto');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if((document.form1.TPVISTORIA.value=='V') && (document.form1.cep.value=='' || document.form1.cep.value=='00000000' || document.form1.cep.value=='11111111' || document.form1.cep.value=='22222222' || document.form1.cep.value=='33333333' || document.form1.cep.value=='44444444' || document.form1.cep.value=='55555555' || document.form1.cep.value=='66666666' || document.form1.cep.value=='77777777' || document.form1.cep.value=='88888888' || document.form1.cep.value=='99999999' || document.form1.cep.value.length <= 7)){
	document.form1.cep.focus();
	window.alert('Preencha o campo:\n CEP - Inválido ou menos que 8 digitos');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.UF.value==''){
	window.alert('Preencha o campo:\nUF do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
}

if(document.form1.TPVISTORIA.value=='V'&&document.form1.cidade.value==''){
	window.alert('Preencha o campo:\nCidade do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V'&&document.form1.bairro.value==''){
	window.alert('Preencha o campo:\nBairro do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V'&&document.form1.endereco.value==''){
	window.alert('Preencha o campo:\nEndereço do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.TPVISTORIA.value=='V' && document.form1.numero.value==''){
	window.alert('Preencha o campo:\nNúmero do Local da Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.getElementById('controle_prest').value==''){
	document.getElementById('controle_prest').focus();
	window.alert('Selecione o campo:\nVistoriador que realizou a Vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='3'||document.form1.acao.value!=='editar'&&document.form1.permissao.value!=='10'){
var data = document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)+''+document.form1.DTVISTORIA.value.charAt(3)+''+document.form1.DTVISTORIA.value.charAt(4)+''+document.form1.DTVISTORIA.value.charAt(0)+''+document.form1.DTVISTORIA.value.charAt(1);
var data3 = parseInt(data);
	if(document.form1.DTVISTORIA.value==''){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
		
	if(data3<parseInt(document.form1.controle_data.value)&&document.form1.SEGURADORA.value!=="61"){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\nData da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
		
	if(data3>parseInt(document.form1.DTPROC.value)){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia');
		if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
		if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
		return false;
		}
}

if(document.form1.HRVISTORIA.value==''){
	document.form1.HRVISTORIA.focus();
	window.alert('Preencha o campo:\nHora da realização da vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.CDFINALIDADE.value==''){
	document.form1.CDFINALIDADE.focus();
	window.alert('Preencha o campo:\nFinalidade da realização da vistoria');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NMPROPONENTE.value==''){
	document.form1.NMPROPONENTE.focus();
	window.alert('Preencha o campo:\nNome do Proponente');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}


if(document.form1.codigo.value==''){
	document.form1.codigo.focus();
	window.alert('Preencha o campo:\n Código do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.fabricante.value==''){
	document.form1.fabricante.focus();
	window.alert('Preencha o campo:\n Fabricante do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.modelo.value==''){
	document.form1.modelo.focus();
	window.alert('Preencha o campo:\n Modelo do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.NRPLACA.value==''){
	document.form1.NRPLACA.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.NRPLACA1.value==''){
	document.form1.NRPLACA1.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
			if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
			if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
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
			if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
			if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
			return false;
		}
}

var placa_i = document.form1.NRPLACA1.value;
var placa_p = document.form1.NRPLACA.value;

if(placa_i!==placa_p){
	document.form1.NRPLACA1.focus();
	window.alert('As placas digitadas não confere');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.NRANOFABRICACAO.value=='' || document.form1.NRANOFABRICACAO.value.length<4){
	document.form1.NRANOFABRICACAO.focus();
	window.alert('Preencha o campo:\nAno de Fabricação do veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRANOMODELO.value=='' || document.form1.NRANOMODELO.value.length<4){
	document.form1.NRANOMODELO.focus();
	window.alert('Preencha o campo:\nAno do Modelo do veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
var chassi = document.form1.NRCHASSI.value.charAt(0)+""+document.form1.NRCHASSI.value.charAt(2)+""+document.form1.NRCHASSI.value.charAt(4)+""+document.form1.NRCHASSI.value.charAt(6)+""+document.form1.NRCHASSI.value.charAt(8)+""+document.form1.NRCHASSI.value.charAt(10)+""+document.form1.NRCHASSI.value.charAt(12)+""+document.form1.NRCHASSI.value.charAt(14)+""+document.form1.NRCHASSI.value.charAt(16)+""+document.form1.NRCHASSI.value.charAt(18)+""+document.form1.NRCHASSI.value.charAt(20)+""+document.form1.NRCHASSI.value.charAt(22)+""+document.form1.NRCHASSI.value.charAt(24)+""+document.form1.NRCHASSI.value.charAt(26)+""+document.form1.NRCHASSI.value.charAt(28)+""+document.form1.NRCHASSI.value.charAt(30)+""+document.form1.NRCHASSI.value.charAt(32);
var confere_chassi1 = chassi.length;

if(document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==8&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==9&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==12&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==14&&document.form1.NRANOFABRICACAO.value<=1988&&confere_chassi1!==17){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRANOFABRICACAO.value>=1989&&confere_chassi1!==17){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRCHASSI.value==''){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}

if(document.form1.CHASSI.value==''){
	document.form1.CHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRCHASSI.value==''){
	document.form1.NRCHASSI.focus();
	window.alert('Preencha o campo:\nNúmero do Chassi');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}
	
if(document.form1.NRMOTOR.value==''){     
	document.form1.NRMOTOR.focus();
	window.alert('Preencha o campo:\nNº de Motor do Veículo');
	if(document.getElementById('buttonGravar1')!=null){
	document.getElementById('buttonGravar1').removeAttribute('hidden');
	}
	if(document.getElementById('buttonGravar2')!=null){
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	}
	return false;
	}		
	
} // fim valida Vistoridor Quintao