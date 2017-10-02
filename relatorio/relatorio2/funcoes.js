/* 
	esta função serve tanto para adicionar quanto para excluir
	sendo que os parametros são:
	quantidade -> quantidade para percorrer na array
	tirar -> valor que deve ser da array               (SOMENTE PARA EXCLUIR que deve enviar os dados para o replace)
	acao -> nome da ação que será realizada
*/
function adicionar_dados(quantidade,tirar,acao)
{
//criar uma array de dados contendo todos os dados dentro da div
//sei a quantidade pelo tamanho da array
var quantidade_array=0;
	if(acao=='adicionar')
	{
		if(quantidade==0){quantidade_array=1;}else{quantidade_array=quantidade+1;}
	}
	else
	{
		if(quantidade==0){quantidade_array=1;}else{quantidade_array=quantidade;}
	}
var inicio = 1;
var acessorio = 0;
var acessorio_outro = 0;
var opcional = 0;
var opcional_outro = 0;
var anti_furto = 0;
var equipamento = 0;
var equipamento_outro = 0;
var avaria = 0;
var avaria_outro = 0;
var valor = ''; 
while(inicio<=quantidade_array)
{
//pegando o primeiro array encontrado no caso
//fazendo charAt pois o primeiro dado vem como numero+'#'
var dados = document.getElementById('TP_OPCAO_'+inicio).value.charAt(0);
	switch(dados)
	{
	//campos dos dados dos acessorios
	case '1':  
	acessorio++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_acessorio='';if(document.getElementById('quantidade_acessorio'+acessorio)){quantidade_acessorio=document.getElementById('quantidade_acessorio'+acessorio).value;}
	var tipo_acessorio='';if(document.getElementById('tipo_acessorio'+acessorio)){tipo_acessorio=document.getElementById('tipo_acessorio'+acessorio).value;}
	
	valor = valor+'1#'+document.getElementById('ACESSORIO_'+acessorio).value+'#'+document.getElementById('MARCA_ACESSORIO_'+acessorio).value+'#'+quantidade_acessorio+'#'+tipo_acessorio+'#acessorio@';
	break;
	//campos dos dados dos anti-furtos
	case '2':  
	anti_furto++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_anti_furto='';
	if(document.getElementById('quantidade_anti_furto'+anti_furto)){quantidade_anti_furto=document.getElementById('quantidade_anti_furto'+anti_furto).value;}
	var tipo_anti_furto='';if(document.getElementById('tipo_anti_furto'+anti_furto)){tipo_anti_furto=document.getElementById('tipo_anti_furto'+anti_furto).value;}
	
	//esses IFs são do caso se o laudo for da MITSUI que entra os seguintes campos
	var antifurto_ok = 'antifurto';
	var numero_serie='';if(document.getElementById('numero_serie'+anti_furto)){numero_serie=document.getElementById('numero_serie'+anti_furto).value;antifurto_ok = '';}
	var nota_fiscal_anti_furto='';if(document.getElementById('nota_fiscal_anti_furto'+anti_furto)){nota_fiscal_anti_furto=document.getElementById('nota_fiscal_anti_furto'+anti_furto).value;antifurto_ok = '';}
	var nome_anti_furto='';if(document.getElementById('nome_anti_furto'+anti_furto)){nome_anti_furto=document.getElementById('nome_anti_furto'+anti_furto).value;antifurto_ok = '';}
	var marca_anti_furto='';if(document.getElementById('marca_anti_furto'+anti_furto)){marca_anti_furto=document.getElementById('marca_anti_furto'+anti_furto).value;antifurto_ok = '';}
	
	valor = valor+'2#'+document.getElementById('anti_furto'+anti_furto).value+'#'+quantidade_anti_furto+''+numero_serie+'#'+tipo_anti_furto+''+nota_fiscal_anti_furto+'#'+nome_anti_furto+'#'+marca_anti_furto+''+antifurto_ok+'@';
	break;
	//campos dos dados dos equipamentos
	case '3':  
	equipamento++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_equipamento='';if(document.getElementById('quantidade_equipamento'+equipamento)){quantidade_equipamento=document.getElementById('quantidade_equipamento'+equipamento).value;}
	var tipo_equipamento='';if(document.getElementById('tipo_equipamento'+equipamento)){tipo_equipamento=document.getElementById('tipo_equipamento'+equipamento).value;}
	var marca_equipamento = '';if(document.getElementById('marca_equipamento'+equipamento)){marca_equipamento=document.getElementById('marca_equipamento'+equipamento).value;}
	var marca_seguranca='';if(document.getElementById('marca_seguranca'+equipamento)){marca_seguranca=document.getElementById('marca_seguranca'+equipamento).value;}
	valor = valor+'3#'+document.getElementById('EQUIPAMENTO'+equipamento).value+'#'+quantidade_equipamento+''+marca_seguranca+'#'+tipo_equipamento+'#'+marca_equipamento+'#equipamento@';   
	break;
	//campos dos dados dos opcionais
	case '4':  
	opcional++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_opcional='';if(document.getElementById('quantidade_opcional'+opcional)){quantidade_opcional=document.getElementById('quantidade_opcional'+opcional).value;}
	var tipo_opcional='';if(document.getElementById('tipo_opcional'+opcional)){tipo_opcional=document.getElementById('tipo_opcional'+opcional).value;}
	var marca_opcional ='';if(document.getElementById('marca_opcional'+opcional)){marca_opcional=document.getElementById('marca_opcional'+opcional).value;}
    valor = valor+'4#'+document.getElementById('opcional'+opcional).value+'#'+quantidade_opcional+'#'+tipo_opcional+'#'+marca_opcional+'#opcional@';
	break;
	//campos dos dados das avarias
	case '5':  
	avaria++;
	var reais='';
	if(document.getElementById('reais'+avaria))
	{
	reais+=document.getElementById('reais'+avaria).value;
	}
	if(document.getElementById('centavos'+avaria))
	{
	reais+=document.getElementById('centavos'+avaria).value;
	}
	var avaria_ok = "avaria";
	var avaria_exclusao="";if(document.getElementById('avaria_exclusao'+avaria)){avaria_exclusao=document.getElementById('avaria_exclusao'+avaria).value;avaria_ok = "";}
	
	
	var cm_avaria='';
	if(document.getElementById('CM_AVARIA'+avaria))
	{
	cm_avaria+=document.getElementById('CM_AVARIA'+avaria).value;
	}
	var hr_pintura='';
	if(document.getElementById('hora_pintura'+avaria))
	{
	hr_pintura+=document.getElementById('hora_pintura'+avaria).value;
	}
	var hr_funilaria='';
	if(document.getElementById('hora_funilaria'+avaria))
	{
	hr_funilaria+=document.getElementById('hora_funilaria'+avaria).value;
	}
	var exclusao='';
	if(document.getElementById('exclusao'+avaria))
	{
		if(document.getElementById('exclusao'+avaria).checked==true)
		{
		exclusao+='1';
		}
	}
	
	
    valor = valor+'5#'+document.getElementById('PECA_AVARIADA'+avaria).value+'#'+document.getElementById('AVARIA'+avaria).value+'#'+cm_avaria+''+hr_pintura+'#'+reais+''+hr_funilaria+'#'+avaria_exclusao+''+exclusao+''+avaria_ok+'@';
	break;
	//campos dos dados dos outros acessorios
	case '6':  
	acessorio_outro++;
	valor = valor+'6#'+document.getElementById('ACESSORIO_OUTRO'+acessorio_outro).value+'#'+document.getElementById('MARCA_ACESSORIO_OUTRO'+acessorio_outro).value+'##acessorio_outro@';
	break;
	//campos dos dados dos outros equipamentos
	case '7':  
	equipamento_outro++;
	valor = valor+'7#'+document.getElementById('EQUIPAMENTO_OUTRO'+equipamento_outro).value+'####equipamento_outro@';
	break;
	//campos dos dados das outras avarias
	case '8':  
	avaria_outro++;
	
	
	var cm_avaria_outro='';
	if(document.getElementById('CM_AVARIA_OUTRO'+avaria_outro))
	{
	cm_avaria_outro+=document.getElementById('CM_AVARIA_OUTRO'+avaria_outro).value;
	}
	var hr_pintura_outro='';
	if(document.getElementById('hora_pintura_outra'+avaria_outro))
	{
	hr_pintura_outro+=document.getElementById('hora_pintura_outra'+avaria_outro).value;
	}
	var hr_funilaria_outro='';
	if(document.getElementById('hora_funilaria_outra'+avaria_outro))
	{
	hr_funilaria_outro+=document.getElementById('hora_funilaria_outra'+avaria_outro).value;
	}
	var exclusao_outro='';
	if(document.getElementById('exclusao_outro'+avaria_outro))
	{
		if(document.getElementById('exclusao_outro'+avaria_outro).checked==true)
		{
		exclusao_outro+='1';
		}
	}
	
	valor = valor+'8#'+document.getElementById('PECA_AVARIADA_OUTRO'+avaria_outro).value+'#'+document.getElementById('AVARIA_OUTRO'+avaria_outro).value+'#'+cm_avaria_outro+''+hr_pintura_outro+'#'+hr_funilaria_outro+'#'+exclusao_outro+'avaria_outro@';
	break;
	//campos dos dados dos outros opcionais
	case '9':  
	opcional_outro++;
    valor = valor+'9#'+document.getElementById('opcional_outro'+opcional_outro).value+'####opcional_outro@';
	break;
	}
inicio++;
}	

	if(tirar=='')
	{
		document.getElementById('controle_valor_opcao').value = valor;
	}
	else
	{
		var valor1 = valor.replace(tirar,"");
		document.getElementById('controle_valor_opcao').value = valor1;
	}
}



/* 
	esta função serve tanto para adicionar quanto para excluir
	sendo que os parametros são:
	quantidade -> quantidade para percorrer na array
	tirar -> valor que deve ser da array               (SOMENTE PARA EXCLUIR que deve enviar os dados para o replace)
	acao -> nome da ação que será realizada
*/
function adicionar_dados1(quantidade,tirar,acao)
{
//criar uma array de dados contendo todos os dados dentro da div
//sei a quantidade pelo tamanho da array
var quantidade_array=0;
	if(acao=='adicionar')
	{
		if(quantidade==0){quantidade_array=1;}else{quantidade_array=quantidade+1;}
	}
	else
	{
		if(quantidade==0){quantidade_array=1;}else{quantidade_array=quantidade;}
	}
var inicio = 1;
var acessorio = 0;
var acessorio_outro = 0;
var opcional = 0;
var opcional_outro = 0;
var anti_furto = 0;
var equipamento = 0;
var equipamento_outro = 0;
var avaria = 0;
var avaria_outro = 0;
var valor = ''; 
while(inicio<=quantidade_array)
{
//pegando o primeiro array encontrado no caso
//fazendo charAt pois o primeiro dado vem como numero+'<'
var dados = document.getElementById('TP_OPCAO_'+inicio).value.charAt(0);
	switch(dados)
	{
	//campos dos dados dos acessorios
	case '1':  
	acessorio++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_acessorio='';if(document.getElementById('quantidade_acessorio'+acessorio)){quantidade_acessorio=document.getElementById('quantidade_acessorio'+acessorio).value;}
	var tipo_acessorio='';if(document.getElementById('tipo_acessorio'+acessorio)){tipo_acessorio=document.getElementById('tipo_acessorio'+acessorio).value;}
	
	valor = valor+'1<'+document.getElementById('ACESSORIO_'+acessorio).value+'<'+document.getElementById('MARCA_ACESSORIO_'+acessorio).value+'<'+quantidade_acessorio+'<'+tipo_acessorio+'<acessorio@';
	break;
	//campos dos dados dos anti-furtos
	case '2':  
	anti_furto++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_anti_furto='';
	if(document.getElementById('quantidade_anti_furto'+anti_furto)){quantidade_anti_furto=document.getElementById('quantidade_anti_furto'+anti_furto).value;}
	var tipo_anti_furto='';if(document.getElementById('tipo_anti_furto'+anti_furto)){tipo_anti_furto=document.getElementById('tipo_anti_furto'+anti_furto).value;}
	
	//esses IFs são do caso se o laudo for da MITSUI que entra os seguintes campos
	var antifurto_ok = 'antifurto';
	var numero_serie='';if(document.getElementById('numero_serie'+anti_furto)){numero_serie=document.getElementById('numero_serie'+anti_furto).value;antifurto_ok = '';}
	var nota_fiscal_anti_furto='';if(document.getElementById('nota_fiscal_anti_furto'+anti_furto)){nota_fiscal_anti_furto=document.getElementById('nota_fiscal_anti_furto'+anti_furto).value;antifurto_ok = '';}
	var nome_anti_furto='';if(document.getElementById('nome_anti_furto'+anti_furto)){nome_anti_furto=document.getElementById('nome_anti_furto'+anti_furto).value;antifurto_ok = '';}
	var marca_anti_furto='';if(document.getElementById('marca_anti_furto'+anti_furto)){marca_anti_furto=document.getElementById('marca_anti_furto'+anti_furto).value;antifurto_ok = '';}
	
	valor = valor+'2<'+document.getElementById('anti_furto'+anti_furto).value+'<'+quantidade_anti_furto+''+numero_serie+'<'+tipo_anti_furto+''+nota_fiscal_anti_furto+'<'+nome_anti_furto+'<'+marca_anti_furto+''+antifurto_ok+'@';
	break;
	//campos dos dados dos equipamentos
	case '3':  
	equipamento++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_equipamento='';if(document.getElementById('quantidade_equipamento'+equipamento)){quantidade_equipamento=document.getElementById('quantidade_equipamento'+equipamento).value;}
	var tipo_equipamento='';if(document.getElementById('tipo_equipamento'+equipamento)){tipo_equipamento=document.getElementById('tipo_equipamento'+equipamento).value;}
	var marca_equipamento = '';if(document.getElementById('marca_equipamento'+equipamento)){marca_equipamento=document.getElementById('marca_equipamento'+equipamento).value;}
	var marca_seguranca='';if(document.getElementById('marca_seguranca'+equipamento)){marca_seguranca=document.getElementById('marca_seguranca'+equipamento).value;}
	valor = valor+'3<'+document.getElementById('EQUIPAMENTO'+equipamento).value+'<'+quantidade_equipamento+''+marca_seguranca+'<'+tipo_equipamento+'<'+marca_equipamento+'<equipamento@';   
	break;
	//campos dos dados dos opcionais
	case '4':  
	opcional++;
	//campos extras que devem ser inseridos no layout da ALFA SEGUROS
	var quantidade_opcional='';if(document.getElementById('quantidade_opcional'+opcional)){quantidade_opcional=document.getElementById('quantidade_opcional'+opcional).value;}
	var tipo_opcional='';if(document.getElementById('tipo_opcional'+opcional)){tipo_opcional=document.getElementById('tipo_opcional'+opcional).value;}
	var marca_opcional ='';if(document.getElementById('marca_opcional'+opcional)){marca_opcional=document.getElementById('marca_opcional'+opcional).value;}
    valor = valor+'4<'+document.getElementById('opcional'+opcional).value+'<'+quantidade_opcional+'<'+tipo_opcional+'<'+marca_opcional+'<opcional@';
	break;
	//campos dos dados das avarias
	case '5':  
	avaria++;
	var reais='';
	if(document.getElementById('reais'+avaria))
	{
	reais+=document.getElementById('reais'+avaria).value;
	}
	if(document.getElementById('centavos'+avaria))
	{
	reais+=document.getElementById('centavos'+avaria).value;
	}
	var avaria_ok = "avaria";
	var avaria_exclusao="";if(document.getElementById('avaria_exclusao'+avaria)){avaria_exclusao=document.getElementById('avaria_exclusao'+avaria).value;avaria_ok = "";}
	
	
	var cm_avaria='';
	if(document.getElementById('CM_AVARIA'+avaria))
	{
	cm_avaria+=document.getElementById('CM_AVARIA'+avaria).value;
	}
	var hr_pintura='';
	if(document.getElementById('hora_pintura'+avaria))
	{
	hr_pintura+=document.getElementById('hora_pintura'+avaria).value;
	}
	var hr_funilaria='';
	if(document.getElementById('hora_funilaria'+avaria))
	{
	hr_funilaria+=document.getElementById('hora_funilaria'+avaria).value;
	}
	var exclusao='';
	if(document.getElementById('exclusao'+avaria))
	{
		if(document.getElementById('exclusao'+avaria).checked==true)
		{
		exclusao+='1';
		}
	}
	
	
    valor = valor+'5<'+document.getElementById('PECA_AVARIADA'+avaria).value+'<'+document.getElementById('AVARIA'+avaria).value+'<'+cm_avaria+''+hr_pintura+'<'+reais+''+hr_funilaria+'<'+avaria_exclusao+''+exclusao+''+avaria_ok+'@';
	break;
	//campos dos dados dos outros acessorios
	case '6':  
	acessorio_outro++;
	valor = valor+'6<'+document.getElementById('ACESSORIO_OUTRO'+acessorio_outro).value+'<'+document.getElementById('MARCA_ACESSORIO_OUTRO'+acessorio_outro).value+'<<acessorio_outro@';
	break;
	//campos dos dados dos outros equipamentos
	case '7':  
	equipamento_outro++;
	valor = valor+'7<'+document.getElementById('EQUIPAMENTO_OUTRO'+equipamento_outro).value+'<<<<equipamento_outro@';
	break;
	//campos dos dados das outras avarias
	case '8':  
	avaria_outro++;
	
	
	var cm_avaria_outro='';
	if(document.getElementById('CM_AVARIA_OUTRO'+avaria_outro))
	{
	cm_avaria_outro+=document.getElementById('CM_AVARIA_OUTRO'+avaria_outro).value;
	}
	var hr_pintura_outro='';
	if(document.getElementById('hora_pintura_outra'+avaria_outro))
	{
	hr_pintura_outro+=document.getElementById('hora_pintura_outra'+avaria_outro).value;
	}
	var hr_funilaria_outro='';
	if(document.getElementById('hora_funilaria_outra'+avaria_outro))
	{
	hr_funilaria_outro+=document.getElementById('hora_funilaria_outra'+avaria_outro).value;
	}
	var exclusao_outro='';
	if(document.getElementById('exclusao_outro'+avaria_outro))
	{
		if(document.getElementById('exclusao_outro'+avaria_outro).checked==true)
		{
		exclusao_outro+='1';
		}
	}
	
	valor = valor+'8<'+document.getElementById('PECA_AVARIADA_OUTRO'+avaria_outro).value+'<'+document.getElementById('AVARIA_OUTRO'+avaria_outro).value+'<'+cm_avaria_outro+''+hr_pintura_outro+'<'+hr_funilaria_outro+'<'+exclusao_outro+'avaria_outro@';
	break;
	//campos dos dados dos outros opcionais
	case '9':  
	opcional_outro++;
    valor = valor+'9<'+document.getElementById('opcional_outro'+opcional_outro).value+'<<<<opcional_outro@';
	break;
	}
inicio++;
}	

	if(tirar=='')
	{
		document.getElementById('controle_valor_opcao').value = valor;
	}
	else
	{
		var valor1 = valor.replace(tirar,"");
		document.getElementById('controle_valor_opcao').value = valor1;
	}
}

function sonumero()
{
	tecla = event.keyCode;
	if (tecla >= 48 && tecla <= 57)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function data(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1/$2")             //Coloca ponto entre o segundo e o terceiro dígitos
	v=v.replace(/(\d{2})(\d)/,"$1/$2")
    return v
}
function hora(v){
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/,"$1:$2")             
    return v
}
function chassi(v)
	{
    v=v.replace(/\s/g,"")  
    v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2")
	v=v.replace(/(\w{1})(\w)/,"$1|$2") 
    return v
	}
function telefone(v)
{
    v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
    v=v.replace(/^(\d{3})(\d)/,"$1-$2")             
    return v
}
function placa(v){ 
return v.replace(/^(\D\D\D)(\d\d\d\d)/g,'$1$2')
} 
function moeda(v){ 
v=v.replace(/\D/g,"")                             
v=v.replace(/(\d{2})$/,",$1")                 
v=v.replace(/(\d+)(\d{3},\d{2})$/g,"$1.$2")   
return v 
} 
function semacento(campo)
{
  //pegando a palavra digitada
  palavra = String.fromCharCode(event.keyCode);
  processa_palavra(campo,palavra);
}
function maiuscula(campo)
{
  //pegando a palavra digitada e colocando em maiuscula
  palavra = String.fromCharCode(event.keyCode).toUpperCase();
  window.event.keyCode = 0;
  campo.value = campo.value + palavra;
}
function minuscula(campo)
{
  //pegando a palavra digitada e colocando em minuscula
  palavra = String.fromCharCode(event.keyCode).toLowerCase();
  window.event.keyCode = 0;
  campo.value = campo.value + palavra;
}
function semacento_minuscula(campo)
{
  //pegando a palavra digitada e colocando em minuscula
  palavra = String.fromCharCode(event.keyCode).toLowerCase();
    processa_palavra(campo,palavra);
}
function semacento_maiuscula(campo)
{
  //pegando a palavra digitada e convertedo em maiuscula
  palavra = String.fromCharCode(event.keyCode).toUpperCase();
  processa_palavra(campo,palavra);
}
function processa_palavra(campo,palavra)
{
  var caracteresInvalidos = "´`^¨~'&àèìòùâêîôûäëïöüáéíóúãõÀÈÌÒÙÂÊÎÔÛÄËÏÖÜÁÉÍÓÚÃÕ";
  var caracteresValidos =   "      EaeiouaeiouaeiouaeiouaoAEIOUAEIOUAEIOUAEIOUAO";
 //se não digitar nenhum campo dos caracteres invalidos
 if (caracteresInvalidos.indexOf(palavra) == -1) 
  {		
  	   //se digitar algum caractere que esteja nos caracteres validos
       if (caracteresValidos.indexOf(palavra) != -1) {
         window.event.keyCode = 0;
         campo.value = campo.value + palavra;
       }
	   //se não digitar nenhum caractere que contenha no invalido ou valido
	   else
	   {
		 window.event.keyCode = 0;
         campo.value = campo.value + palavra;
	   }
  } 
  //se digitar um caractere com acento
  else 
  {
           window.event.keyCode = 0;
           nova = caracteresValidos.charAt(caracteresInvalidos.indexOf(palavra));
		   
		   //se o index que foi pego da letra com acento ou caractere invalido for igual que 0 
		   //que significa que a letra digitada é & ou igual a 8 que é a letra à deve-se colocar o novo valor valido
		   if(caracteresInvalidos.indexOf(palavra)==6){
           campo.value =  campo.value + nova;
		   }
		   //se não o campo permanece com o mesmo valor
		   else
		   {
		   campo.value =  campo.value;
		   }
  }
}

function consulta_somente(mantem_campo)
{
//mantem_campo equivale aos campos que não podem ficar vazios
//exemplo: nome,data,
var array = mantem_campo.split(",");
var total_array = array.length;
var inicio = 0;

var total = document.forms[0].elements.length;
//para pegar somente os campos -1 pq o ultimo index equivale ao botao
var final = total-1;
//conta igual a 0 prque o primeiro campo equivale ao campo
var conta = 0;

//variavel que controla se a name ja foi encontrada, se ela foi encontrada ela mantem o valor do campo
var contem = 0;
	while(conta<final)
	{
		//inicia o contador toda vez que entra em um novo element
		inicio=0;
		while(inicio<total_array)
		{
			if(document.forms[0].elements[conta].name==array[inicio])
			{
			 contem=1;
			}
		inicio++;
		}
		if(contem==1)
		{
		//mantem o campo em branco
		contem=0;
		}
		else
		{
			if(document.forms[0].elements[conta].type=='button'||document.forms[0].elements[conta].type=='submit')
			{
			//não faça nada
			}
			else
			{		
			document.forms[0].elements[conta].value='';
			}
		}
	conta++;
	}
}



function confere_usuarios()
{
//conferindo campos dos dados digitados pelo kit na criação e edição de usuários
var total = document.forms[0].elements.length;
var final = total-2;
var conta = 1;
	while(conta<final)
	{
		//entra na array do elemnto que contem a quantidade de caractere menor que 1 e se ele não for o campo de rg nem cnpj
		//cpf é necessário para a transmissão de vistoria
		if(document.forms[0].elements[conta].value.length<1&&conta!==7&&conta!==8)
		{
		//Alerta o campo que falta, mostrando o nome do campo como o nome do ID
		alert("Preencha o campo: "+document.forms[0].elements[conta].id);
		document.forms[0].elements[conta].focus();
		return false;
		}
	conta++;
	}
	//Se a senha for diferente da senha repetida
	if(document.forms[0].elements[4].value!==document.forms[0].elements[5].value)
	{
	alert("Preencha o campo: "+document.forms[0].elements[4].id);
	document.forms[0].elements[4].focus();
	return false;
	}
}

function cpfcnpj(theCPF) 
{ 
  
  if (theCPF.value == "") 
  { 
    alert("Campo inválido. É necessário informar o CPF ou CNPJ"); 
    theCPF.focus(); 
	theCPF.value="";
    return (false); 
  } 
  if (((theCPF.value.length == 11) && (theCPF.value == 11111111111) || (theCPF.value == 22222222222) || (theCPF.value == 33333333333) || (theCPF.value == 44444444444) || (theCPF.value == 55555555555) || (theCPF.value == 66666666666) || (theCPF.value == 77777777777) || (theCPF.value == 88888888888) || (theCPF.value == 99999999999) || (theCPF.value == 00000000000))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return (false); 
  } 


  if (!((theCPF.value.length == 11) || (theCPF.value.length == 14))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return (false); 
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
    return (false); 
  } 

  var chkVal = allNum; 
  var prsVal = parseFloat(allNum); 
  if (chkVal != "" && !(prsVal > "0")) 
  { 
    alert("CPF zerado !"); 
    theCPF.focus(); 
	theCPF.value="";
    return (false); 
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
    return (false); 
  } 
  
  tot = 0; 
  
  for (i = 2;  i <= 11;  i++) 
    tot += i * parseInt(checkStr.charAt(11 - i)); 

  if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(10))) 
  { 
    alert("CPF/CNPJ inválido."); 
    theCPF.focus(); 
	theCPF.value="";
    return (false); 
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
    return (false); 
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
    return (false); 
  } 
} 
  return(true); 
} 







var retorno;
var div_retorno;
function CarregaArquivo(url,valor,div)
{
    retorno = null;
	div_retorno = ""+div;
	//CRIA O OBJETO HttpRequest PARA O RESPECTIVO NAVEGADOR
	//Mozilla Fire Fox / Safari ...
	//
    if (window.XMLHttpRequest) {
        retorno = new XMLHttpRequest();
		//SETA A FUNÇÃO QUE SERÁ CHAMADA QUANDO O AJAX DER UM RETORNO
        retorno.onreadystatechange = processReqChange;
		 //ABRE A REQUISIÇÃO AJAX, PASSANDO O MÉTODO DE ACESSO, URL E O PARÂMETRO
        retorno.open("GET", url+'&dados='+valor, true);
		//INICIA O TRANSPORTA DOS OBJETOS NA REQUISIÇÃO
        retorno.send(null);
    } else if (window.ActiveXObject) {
		//
		//IE
		//
        retorno = new ActiveXObject("Microsoft.XMLHTTP");
        if (retorno) {
			//SETA A FUNÇÃO QUE SERÁ CHAMADA QUANDO O AJAX DER  UM RETORNO
            retorno.onreadystatechange = processReqChange;
		    //ABRE A REQUISIÇÃO AJAX, PASSANDO O MÉTODO DE ACESSO, URL E O PARÂMETRO
            retorno.open("GET", url+'&dados='+valor, true);
			//INICIA O TRANSPORTA DOS OBJETOS NA REQUISIÇÃO
            retorno.send();
        }
    }
}
//FUNÇÃO QUE TRATA O RETORNO DO AJAX
function processReqChange()
{
	//CASO O STATUS DO AJAX SEJA OK, CHAMA A FUNÇÃO mudar()
	//A LISTA COMPLETA DOS VALORES readyState É A SEGUINTE:
	//0 (uninitialized) 
	//1 (a carregar) 
	//2 (carregado) 
	//3 (interactivo) 
	//4 (completo) 
    if (retorno.readyState == 4)
	{
		if(retorno.status == 200) 
			{
				//PROCURA PELA DIV MOSTRACOMBO E INSERE O OBJETO
					document.getElementById(div_retorno).innerHTML = retorno.responseText;
				    if(document.getElementById('carrega1'))
					{
						document.getElementById('carrega1').style.visibility='hidden';
					}
			}
   }
}

//FUNÇÃO MUDAR, QUE CHAMA AS INFORMAÇÕES PASSADAS NO PARÂMETRO E CARREGA O ARQUIVO EXTERNO
//valor que deve ser enviado por get para a atualização do AJAX, URL do endereço do ajax e DIV a ser atualzada
function x(valor,url,div)
{
	
				    if(document.getElementById('carrega1'))
					{
						document.getElementById('carrega1').style.visibility='visible';
					}
	//CARREGA O ARQUIVO EXTERNO DO AJAX, E CHECA O NÚMERO DO LAUDO
    CarregaArquivo(url+".php?div="+div,valor,div);
	
}

 function mostra_aba(nome_aba,pos_x,pos_y,visibilidade)
  {
    //visibilidade = 1 aparece a aba desejada
	//visibilidade = 0 desaparece a aba desejada
	//visibilidade = 3 desaparece todas as abas
	if(visibilidade==1)
	{
		//internet explorer 33 137 ~ 140 (doidera do IE)
		//mozilla 32 138   
	    x_final = pos_x+4;   
		y_final = pos_y+22;
		document.getElementById(''+nome_aba).style.left=""+x_final+"px";
	document.getElementById(''+nome_aba).style.top=""+y_final+"px";
	document.getElementById(''+nome_aba).style.visibility="visible";
	document.getElementById(''+nome_aba).style.position="absolute";
	document.getElementById(''+nome_aba).style.zIndex="40"; 
	
		if(document.getElementById('menu_aba').style.visibility=="visible"&&nome_aba!=='menu_aba')
		{
			document.getElementById('menu_aba').style.visibility="hidden";
		}
	}
	if(visibilidade==0)
	{
	document.getElementById(''+nome_aba).style.left="0px";
	document.getElementById(''+nome_aba).style.top="0px";
	document.getElementById(''+nome_aba).style.visibility="hidden";
	document.getElementById(''+nome_aba).style.position="absolute";
	document.getElementById(''+nome_aba).style.zIndex="40"; 
	}
	if(visibilidade==3)
	{
	document.getElementById('menu_aba').style.visibility="hidden";
	}
  }
  function posicao_x(obj)
  {
    var curleft = 0;
    if(obj.offsetParent)
        while(1) 
        {
          curleft += obj.offsetLeft;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.x)
        curleft += obj.x;
    return curleft;
  }
  function posicao_y(obj)
  {
    var curtop = 0;
    if(obj.offsetParent)
        while(1)
        {
          curtop += obj.offsetTop;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.y)
        curtop += obj.y;
    return curtop;
  }