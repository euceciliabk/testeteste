<?php
require_once "usuario/credencial.php";
require_once "persistencia/postgres/conexao.php";

class PersistenciaUsuario implements PersisteCredencial {
	private $persistencia;
	
	function __construct() {
		$this->persistencia = getConexao();
	}
	
	function criaTabelaUsuarios() {
		$query = "CREATE TABLE IF NOT EXISTS usuario (
			login VARCHAR(16) NOT NULL UNIQUE,
			senha VARCHAR(128) NOT NULL,
			idusuario serial PRIMARY KEY
		)";
		return pg_query($this->persistencia, $query);
	}

	function insereUsuario($login, $senha) {
		$query = "INSERT INTO usuario (login, senha) VALUES ('$login', '$senha')";
		return pg_query($this->persistencia, $query);
	}

	function getSenha($login){
		$query = "SELECT senha FROM usuarios WHERE
		login='$login'";
		$result = pg_query($this->persistencia, $query);
		$senha = NULL;

		if ($result && pg_num_rows($result) > 0) {
			$senha = pg_fetch_assoc($result, NULL)['senha'];
		}
		return $senha;
	}
	
	function carregaUsuarios() {
		global $query;
		$query = "SELECT * FROM usuario";
		$result = pg_query($this->persistencia, $query);
		$usuarios = array();

		if ($result && $result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
			//while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$usuarios[$row['login']] = $row['senha'];
			}
		}
		else{
			print_r("erro na consulta ao banco de dados");
		}
		return $usuarios;
	}
	
}

?>