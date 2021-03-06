<?php

@session_start();
include "/var/www/html/adm/conecta.php";
include "/var/www/html/sistema/verifica.php";

$foto=$codigoEmpresa.".png";

    $sql = "SELECT SEGURADORA,NUMEROSOLICITACAO FROM ".$bancoDados.".vistoria_previa1 WHERE NUMEROSOLICITACAO = '" . $_GET["id"] . $_GET["solicitacao"] . "'";
    $resultado = @mysql_query($sql, $db);
    $vetorResultado = @mysql_fetch_assoc($resultado);

    $seguradora = $vetorResultado["SEGURADORA"];
	$solicitacao = $vetorResultado["NUMEROSOLICITACAO"];

$sql_foto = "SELECT MAX(seqFotoMobile) AS indice FROM ".$bancoDados.".fotos WHERE id = '" . $solicitacao . "' ";
    $resultado_foto = @mysql_query($sql_foto, $db);
    $vetorFoto = @mysql_fetch_assoc($resultado_foto);

	if(strtoupper($vetorFoto['indice'])=='NULL' || $vetorFoto['indice']==''){
	$indice=0;
	}else{
		$indice=$vetorFoto['indice'];
		}

	$sql_fotoExc = "SELECT MAX(seqFotoMobile) AS indice FROM ".$bancoDados.".fotos_excluidas WHERE id = '" . $solicitacao . "' ";
    $resultado_fotoExc = @mysql_query($sql_fotoExc, $db);
	if(mysql_num_rows($resultado_fotoExc)>0){
		$vetorFotoExc = @mysql_fetch_assoc($resultado_fotoExc);

			if($vetorFotoExc['indice']>$indice){
				$indice=$vetorFotoExc['indice'];
				}
		
		}


?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Upload de Fotos</title>

    <script src="jsNovo/jquery-2.1.3.min.js"></script>
    <script src="jsNovo/bootstrap.min.js"></script>
    <script src="jsNovo/canvas-to-blob.min.js"></script>
    <script src="jsNovo/resize.js"></script>

    <link rel="stylesheet" href="jsNovo/css/bootstrap.min.css">

    <script type="text/javascript">

        // Iniciando biblioteca
        var resize = new window.resize();
        resize.init();

        // Declarando variáveis
        var imagens;
		var seguradora;
		var solicitacao;
        var imagem_atual;
		var valorIndice=<? echo $indice; ?>;
		

        // Quando carregado a página
        $(function ($) {

            // Quando selecionado as imagens
            $('#imagem').on('change', function () {
                enviar();
            });

        });

        /*
         Envia os arquivos selecionados
         */
        function enviar()
        {
            // Verificando se o navegador tem suporte aos recursos para redimensionamento
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                alert('O navegador não suporta os recursos utilizados pelo aplicativo');
                return;
            }

            // Alocando imagens selecionadas
            imagens = $('#imagem')[0].files;

            // Se selecionado pelo menos uma imagem
            if (imagens.length > 0)
            {
                // Definindo progresso de carregamento
                $('#progresso').attr('aria-valuenow', 0).css('width', '0%');

                // Escondendo campo de imagem
                $('#imagem').hide();

                // Iniciando redimensionamento
                imagem_atual = 0;
                redimensionar();
            }
        }

        /*
         Redimensiona uma imagem e passa para a próxima recursivamente
         */
        function redimensionar()
        {
            // Se redimensionado todas as imagens
            if (imagem_atual > imagens.length)
            {
                // Definindo progresso de finalizado
                $('#progresso').html('Imagen(s) enviada(s) com sucesso');
				
				document.getElementById('buttonFechar').removeAttribute('hidden');

                // Limpando imagens
                limpar();

                // Exibindo campo de imagem
                $('#imagem').show();

                // Finalizando
                return;
            }

            // Se não for um arquivo válido
            if ((typeof imagens[imagem_atual] !== 'object') || (imagens[imagem_atual] == null))
            {
                // Passa para a próxima imagem
                imagem_atual++;
                redimensionar();
                return;
            }

            // Redimensionando
            resize.photo(imagens[imagem_atual], 638, 'dataURL', function (imagem) {
				
                // Salvando imagem no servidor  
                $.post('ajax/salvarImagem_laudo.php', {imagem: imagem, seguradora: '<?php echo $seguradora; ?>', solicitacao: '<?php echo $solicitacao; ?>', gsfguidig: valorIndice}, function() {

                    // Definindo porcentagem
                    var porcentagem = (imagem_atual + 1) / imagens.length * 100;

                    // Atualizando barra de progresso
                    $('#progresso').text(Math.round(porcentagem) + '%').attr('aria-valuenow', porcentagem).css('width', porcentagem + '%');
					
                    // Aplica delay de 1 milesegundo, 1000 = 1 segundo
                    // Apenas para evitar sobrecarga de requisições
                    // e ficar visualmente melhor o progresso
                    setTimeout(function () {
                        // Passa para a próxima imagem
                        imagem_atual++;
						valorIndice++; // adiciona 1 no indice
                        redimensionar();
						
                    }, 10);      
					
					
					

                });

            });
        }

        /*
         Limpa os arquivos selecionados
         */
        function limpar()
        {
            var input = $("#imagem");
            input.replaceWith(input.val('').clone(true));
        }
    </script>
</head>

<body>

<div class="container" style="background-color: #000000">

    <div align="left" style="padding-top:15px"><input align="left" name="logo" type="image" src="../../usuario/fotos_empresas/logoVistOnLineFoto.png"></div>
<div align="right" style="padding-top:20px"><input align="right" name="logo2" type="image" src="../../usuario/fotos_empresas/<? echo $foto;?>"></div>
<center><h2 style="color:#FFF;">Sistema de Upload de Fotos</h2></center>

</div>
<div id="master0" align="center" style="width: 100%">
	<div id="masterE" align="left" style="height: 50px"></div>
<div id="master" align="center" style="width: 80%">
    <form method="post" action="#" role="form">
       
        <div class="progress">
            <div id="progresso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                 aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>

        <div class="form-group row">

            <div class="col-xs-12">
                <input id="imagem" type="file" accept="image/*" multiple/>
            </div>
            
            <div class="col-xs-12">
                <br><br><br>
                <input type="image" src="../../imagens/fechar.png" hidden="hidden" name="buttonFechar" id="buttonFechar" onClick="window.open('<? echo caminho; ?>sistema/fotos/index.php?id=<? echo $solicitacao; ?>&qf=<? echo $_GET['qf']; ?>&rot=<? echo $_GET['rot']; ?>&laudo=<? echo $_GET['laudo']; ?>'); window.close();" title="Fechar" />
                
            </div>

        </div>

    </form>

</div>
<div id="masterD" align="right"></div>
	</div>
</body>
</html>

