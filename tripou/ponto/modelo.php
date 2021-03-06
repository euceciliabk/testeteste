<?php

interface PersistePonto {
	function carregaPontos();
	function salvaPonto($ponto);
	function removePonto($ponto);
}

function criaPonto($nome, $quem, $quando) { //*** 
	$ponto = array();
	$ponto ['nome'] = $nome;
	$ponto ['quem'] = $quem;
	$ponto ['quando'] = $quando;
	return $ponto;
}

?>