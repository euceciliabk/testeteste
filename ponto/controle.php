<?php

	require_once "ponto/modelo.php";
	require_once "usuario/sessao.php";

	class ControlePonto {
		private $persistencia;
		
		function __construct(PersistePonto $persistencia) {
			$this->persistencia = $persistencia;
		}
		
		function getPontos(){
			return array_reverse ($this->persistencia->carregaPontos());
		}
		
		function inserePonto($nome) { //***
			$sessao = new Sessao();
			$quem = $sessao->getLogin();
			$quando = date("Y-m-d H:i:s");
			$ponto = criaPonto($nome, $quem, $quando);
			$this->persistencia->salvaPonto($ponto);
		}

		function removePonto($quem, $quando) {
			$sessao = new Sessao();
			$login = $sessao->getLogin();
			if ($login == $quem) {
				$ponto = criaPonto("", $quem, $quando);
				$this->persistencia->removePonto($ponto);
			}
		}
	}
	
?>