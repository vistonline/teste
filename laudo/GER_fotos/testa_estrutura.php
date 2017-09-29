<?php
highlight_file(__FILE__);
//$nome_seg = strtr($cliente_seguradora, array(" "=>"_", " & "=>"_", "."=>"", ));
$rot["roteirizador"] = "testeEstrutura";
$nome_seg = "seguradoraTeste";
$_GET["id"] = "nrsolicitacaoTeste";

// NOVO DIRETORIO ONDE SERÃO SALVO AS FOTOS
//$novo_diretorio='../../fotos/'.date('Y').'/'.date('m').'/'.date('d').'/'.'rot_'.$rot[roteirizador].'/'.$nome_seg.'/'.$_GET[id].'/';
$novo_diretorio='../../PHOTOS/rot_'.$rot["roteirizador"].'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_GET["id"].'/';
// CRIANDO ARVORE DE PASTAS

mkdir('../../PHOTOS/', 0777);
//chmod('../../PHOTOS/', 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'], 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador], 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'].'/'.$nome_seg, 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador].'/'.$nome_seg, 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'].'/'.$nome_seg.'/'.date('Y'), 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador].'/'.$nome_seg.'/'.date('Y'), 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'].'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador].'/'.$nome_seg.'/'.date('Y').'/'.date('m'), 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'].'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador].'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d'), 0777);
mkdir('../../PHOTOS/rot_'.$rot['roteirizador'].'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_GET["id"], 0777);
//chmod('../../PHOTOS/rot_'.$rot[roteirizador].'/'.$nome_seg.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$_GET[id], 0777);
//MOVENDO FOTOS PARA AS PASTAS CERTAS

echo $novo_diretorio;
copy("fotoTeste.jpg", $novo_diretorio.$_GET["id"].'_'.'foto_movida_com_sucesso'.'.jpg');
