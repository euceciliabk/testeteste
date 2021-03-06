<?php

require_once "ponto/modelo.php";
require_once "persistencia/mysql/conexao.php";

class PersistenciaPonto implements PersistePonto { //
	private $persistencia;
	
	function __construct() {
		$this->persistencia = getConexao();
	}
	
	
	private function getUsuarioId($login){ //igual
		$query = "SELECT idusuario FROM usuario WHERE login='$login' LIMIT 1";
		$result = $this->persistencia->query($query);
		$usuid = NULL;
		if ($result && $result->num_rows > 0) {
			$usuid = $result->fetch_array(MYSQLI_ASSOC)['idusuario'];
		}
		return $usuid;
	}

	function removePonto($ponto) { //remove ponto ***
		$usuid = $this->getUsuarioId($ponto['quem']);
		$tempo = $ponto['quando'];
		$query = "DELETE FROM pontoturistico WHERE criador_idusuario='$usuid' AND 
		tempo='$tempo'";
		$this->persistencia->query($query);
	}
	
	function salvaPonto($ponto) { // salva ponto
		$usuid = $this->getUsuarioId($ponto['quem']); 
		$result = NULL;
		if ($usuid) {
			$descricao = $ponto['texto'] 
			$nome = $ponto['nome']; 
			$avaliacao = $ponto['avaliacao']
			$localizacao = $ponto['local'] 
			$preco = $ponto['quanto'] 
			$tempo = $ponto['quando']; 

			$query = "INSERT INTO pontoturistico (criador_idusuario, descricao, nome, avaliacao, localizacao, preco, tempo) 
			VALUES ('$usuid', '$descricao','$nome', '$avaliacao', '$localizacao', '$preco','$tempo')"; // atributos da tabela ponto turistico
			$result = $this->persistencia->query($query);
		}
		return $result;
	}
	
	private function getLoginUsuario($usuid) { //igual
		$query = "SELECT login FROM usuarios WHERE id='$usuid' LIMIT 1";
		$result = $this->persistencia->query($query);
		$login = NULL;
		if ($result && $result->num_rows > 0) {
			$login = $result->fetch_array(MYSQLI_ASSOC)['login'];
		}
		return $login;
	}
	
	function carregaPontos(){ //carrega pontos
		$query = "SELECT * FROM pontoturistico";
		$result = $this->persistencia->query($query);
		$pontos = array();
		if ($result && $result->num_rows > 0){ //importante
			while ($row = $result->fetch_array(MYSQLI_ASSOC)){
				$login = $this->getLoginUsuario($row['usuid']);
				$ponto = criaPonto($row['nome'], $login, $row['descricao'], $row['localizacao'], $row['tempo'], $row['preco'], $row['avaliacao']);
				array_push($pontos, $ponto);
			}
		}
		return $pontos;
	}
	
}

?>