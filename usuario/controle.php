<?php

require_once "usuario/credencial.php";
require_once "usuario/sessao.php";

class ControleUsuario {
	
	private $sessao;
	private $credencial;
	
	function __construct(PersisteCredencial $persistencia) {
		$this->sessao = new Sessao();
		$this->credencial = new Credencial($persistencia);
	}

	function getLogin() {
		$login = $this->sessao->getLogin();
		return $login;
	}

	function login($login, $senha){
		if ($this->credencial->confereLoginSenha($login, $senha)) {
			$this->sessao->login($login);
		}
		//$this->sessao->login($login);
	}

	function logout() {
		$this->sessao->logout();
	}

	function insereLoginSenha($login, $senha) {
		$this->credencial->insereLoginSenha($login, $senha);
	}
}

?>