<?php
require_once "persistencia/postgres/usuario.php";
require_once "persistencia/postgres/mensagem.php";

function criaPersistenciaUsuario() {
    return new PersistenciaUsuario();
}

function criaPersistenciaMensagem() {
    return new PersistenciaMensagem();
}
?>