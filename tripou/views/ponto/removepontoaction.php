<?php
chdir("../../");
require_once "controle.php";
$controlePonto = criaControlePonto();
$controlePonto->removePonto($_POST['quem'], $_POST
['quando']);


header("Location: /tripou/");
?>