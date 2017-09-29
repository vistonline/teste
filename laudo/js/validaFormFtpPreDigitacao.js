function valida(){
	if(document.form1.SEGURADORA.value=='')
	{
	document.form1.SEGURADORA.focus();
	window.alert('Preencha o campo:\nSeguradora');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
	if(document.form1.NRVISTORIA.value==''){
	document.form1.NRVISTORIA.focus();
	window.alert('Preencha o campo:\nNº da Vistoria ');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

	if(document.form1.NRPLACA.value==''){
	document.form1.NRPLACA.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

	if(document.form1.NRPLACA1.value==''){
	document.form1.NRPLACA1.focus();
	window.alert('Preencha o campo:\nNº da Placa ');
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
			document.getElementById('buttonGravar2').removeAttribute('hidden');
			return false;
		}
	}


var placa_i = document.form1.NRPLACA1.value;
var placa_p = document.form1.NRPLACA.value;

	if(placa_i!==placa_p){
	document.form1.NRPLACA1.focus();
	window.alert('As placas digitadas não confere');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

	if(document.form1.cidade.value=='')
	{
	document.form1.cidade.focus();
	window.alert('Preencha o campo:\nCidade da Realização da VP');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
	if(document.form1.DTVISTORIA.value==''){
	document.form1.DTVISTORIA.focus();
	window.alert('Preencha o campo:\n Data da Vistoria Prévia');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
	if(document.form1.DTVISTORIA.value==''){
	document.form1.DTVISTORIA.focus();
	window.alert('Preencha o campo:\n Data da Vistoria Prévia');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
	if(document.form1.DTVISTORIA.value.length<10){
	document.form1.DTVISTORIA.focus();
	window.alert('Preencha o campo:\n Data da Vistoria Prévia Corretamente');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}
	
	
	
	if(document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)<2016){
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia corretamente. Não é aceito ano inferior a 2016.');
		document.getElementById('buttonGravar2').removeAttribute('hidden');
		return false;
		}
		
	if(document.form1.DTVISTORIA.value.charAt(6)+''+document.form1.DTVISTORIA.value.charAt(7)+''+document.form1.DTVISTORIA.value.charAt(8)+''+document.form1.DTVISTORIA.value.charAt(9)>2017){   
		document.form1.DTVISTORIA.focus();
		window.alert('Preencha o campo:\n Data da Vistoria Prévia corretamente. Não é aceito ano superior a 2017.');
		document.getElementById('buttonGravar2').removeAttribute('hidden');       
		return false;
		}
	

	
	if(document.getElementById('fileinput').value==''){
	document.getElementById('fileinput').focus();
	window.alert('Você não selecionaou nenhum arquivo\n para ser enviado');
	document.getElementById('buttonGravar2').removeAttribute('hidden');
	return false;
	}

document.getElementById('progress').removeAttribute('hidden');

}