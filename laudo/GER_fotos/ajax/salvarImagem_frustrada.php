<?php

// Recuperando imagem em base64
// Exemplo: data:image/png;base64,AAAFBfj42Pj4
$imagem = $_POST['imagem'];
$seguradora = $_POST['seguradora'];
$solicitacao = $_POST['solicitacao'];   
$indice = $_POST['gsfguidig']; // indice da última foto recebida


// Separando tipo dos dados da imagem
// $tipo: data:image/png
// $dados: base64,AAAFBfj42Pj4
list($tipo, $dados) = explode(';', $imagem);

// Isolando apenas o tipo da imagem
// $tipo: image/png
list(, $tipo) = explode(':', $tipo);

// Isolando apenas os dados da imagem
// $dados: AAAFBfj42Pj4
list(, $dados) = explode(',', $dados);

// Convertendo base64 para imagem
$dados = base64_decode($dados);

/*
// Gerando nome aleatório para a imagem
$nome = md5(uniqid(time()));

// Salvando imagem em disco
file_put_contents("../img/{$nome}.jpg", $dados);
*/

ignore_user_abort();

include "/var/www/html/adm/conecta.php";


$sql = "SELECT clienteOrigem, solicitacaoOrigem FROM ".$bancoDados.".solicitacao WHERE id = " . $solicitacao ;
$resultado = @mysql_query($sql, $db);
$vetorResultado = @mysql_fetch_assoc($resultado);

$clienteOrigem=$vetorResultado['clienteOrigem'];
$solicitacaoOrigem=$vetorResultado['solicitacaoOrigem'];

$nome_seg=strtr($seguradora, array(" "=>"_", " & "=>"_", "."=>"", ));

// NOVO DIRETORIO ONDE SERÃO SALVO AS FOTOS
$novo_diretorio='/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$solicitacao.'/';

if($clienteOrigem!='' || $solicitacaoOrigem!=''){
$diretorioOrigem='/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$solicitacaoOrigem.'/';
}


// CRIANDO ARVORE DE PASTAS
@mkdir('/var/www/html/sistema/PHOTOS/', 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg.'/'.date('Y'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$codigoEmpresa.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$solicitacao, 0777);

if($clienteOrigem!='' || $solicitacaoOrigem!=''){
// CRIANDO ARVORE DE PASTAS AMBIENTE DE ORIGEM
@mkdir('/var/www/html/sistema/PHOTOS/', 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg, 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg.'/'.date('Y'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
@mkdir('/var/www/html/sistema/PHOTOS/PHOTOS/rot_'.$clienteOrigem.'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$solicitacaoOrigem, 0777);
}

//MOVENDO FOTOS PARA AS PASTAS CERTA

        if(trim($nome_seg == 'HDI')){ 
			$nomeFoto = str_pad($solicitacao.'_'.($indice+1).'.jpg', 20, "0", STR_PAD_LEFT);
			}else{ 
				$nomeFoto = $solicitacao.'_'.($indice+1).'.jpg';
				}
		
		if(file_put_contents($novo_diretorio.$nomeFoto, $dados)){
        $sql_fotos = "INSERT INTO ".$bancoDados.".fotos (fotos,id,seqFotoMobile,data,hora) VALUES ('" . $nomeFoto . "', '" . $solicitacao . "', '" . ($indice+1). "', '" . date('Ymd') . "','" . date('Hi') . "')";
        //echo $sql_fotos."<br>";
        $result_fotos = mysql_query($sql_fotos,$db);
		}
		
		if($clienteOrigem!='' || $solicitacaoOrigem!=''){
			
			if(trim($nome_seg == 'HDI')){ 
			$nomeFotoOrigem = str_pad($solicitacaoOrigem.'_'.($indice+1).'.jpg', 20, "0", STR_PAD_LEFT);
			}else{ 
				$nomeFotoOrigem = $solicitacaoOrigem.'_'.($indice+1).'.jpg';
				}
			

			if(copy($novo_diretorio.$nomeFoto, $diretorioOrigem.$nomeFotoOrigem)){
			$sql_fotos = "INSERT INTO webvist_".$clienteOrigem.".fotos (fotos,id,seqFotoMobile,data,hora) VALUES ('" . $nomeFotoOrigem . "', '" . $solicitacaoOrigem . "', '" . ($indice+1) . "', '" . date('Ymd') . "','" . date('Hi') . "')";
			//echo $sql_fotos."<br>";
			$result_fotos = mysql_query($sql_fotos,$db);    
			}
			
			}
			
      
  
