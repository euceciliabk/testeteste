<?php

interface PersisteCredencial {
	function insereUsuario($login, $senha);
	function getSenha($login);
}

class Credencial {
	private $persistencia;
	
	function __construct(PersisteCredencial $persistencia){
		$this->persistencia = $persistencia;
	}
	
	function confereLoginSenha($login, $senha) {
		$senhabd = $this->persistencia->getSenha($login);
		if ($senhabd != NULL && $senhabd == $senha){
			return TRUE;
		}
		return FALSE;
	}

	function insereLoginSenha($login, $senha) {
		$this->persistencia->insereUsuario($login, $senha);
	}
}

?>