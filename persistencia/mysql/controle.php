<?php
require_once "persistencia/mysql/usuario.php";
require_once "persistencia/mysql/ponto.php";

function criaPersistenciaUsuario() {
    return new PersistenciaUsuario();
}

function criaPersistenciaPonto() {
    return new PersistenciaPonto();
}
?>