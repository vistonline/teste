// JavaScript Document


function chk_opcional()
{
	
  var quantidade = document.getElementById('checar_opcao2').innerHTML.split('checar_opcional_').length;
  var valor_a_procurar = document.getElementById('opcional' + (quantidade -1)).value;
  
    j = quantidade -1 ;
	for (i = 1, vetor = Array(); i < j; i++)
    {
      	  
	  	  if(document.getElementById('opcional' + i ).value==valor_a_procurar){
		  		window.alert('Opcional já informado');
				return false;
		  }
		  
	}
  return true;
}

function chk_acessorio()
{
  var quantidade = document.getElementById('checar_opcao2').innerHTML.split('checar_acessorios_').length;
  var valor_a_procurar = document.getElementById('ACESSORIO_' + (quantidade - 1) ).value;
  
    j = quantidade - 1;
	for (i = 1, vetor = Array(); i < j; i++)
    {
      	  
	  	  if(document.getElementById('ACESSORIO_' + i ).value==valor_a_procurar){
		  		window.alert('Acessório já informado');
				return false;
		  }
		  
	}
  return true;
}

function chk_equipamento()
{
  var quantidade = document.getElementById('checar_opcao2').innerHTML.split('checar_equipamento_').length;
  var valor_a_procurar = document.getElementById('EQUIPAMENTO' + (quantidade -1) ).value;
  
    j = quantidade - 1;
	for (i = 1, vetor = Array(); i < j; i++)
    {
      	  
	  	  if(document.getElementById('EQUIPAMENTO' + i ).value==valor_a_procurar){
		  		window.alert('Equipamento já informado');
				return false;
		  }
		  
	}
  return true;
}

function chk_avaria()
{
  var quantidade = document.getElementById('checar_opcao2').innerHTML.split('checar_avaria_').length;
  var valor_a_procurar = document.getElementById('PECA_AVARIADA' + (quantidade -1) ).value;
  
    j = quantidade - 1;
	for (i = 1, vetor = Array(); i < j; i++)
    {
      	  
	  	  if(document.getElementById('PECA_AVARIADA' + i ).value==valor_a_procurar){
		  		window.alert('Avaria já informada');
				return false;
		  }
		  
	}
  return true;
}