<?php
	require_once "controle.php";
	$controlePonto = criaControlePonto();
	$pontos = $controlePonto->getPontos();
	
	foreach($pontos as $ponto) {
		echo "<br><div>";
		echo $ponto['quem'] . "(". $ponto['quando'] . ")<br>";
		echo $ponto['texto'];
		require 'views/ponto/removepontoform.php';
		echo "</div>";
	}
?>