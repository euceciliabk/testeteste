<?php
chdir("../../");
require_once "controle.php";
$controlePonto = new criaControlePonto();
$controlePonto->inserePonto($_POST['texto']);

header("Location: /tripou/");

?>