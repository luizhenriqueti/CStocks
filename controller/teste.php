<?php
require_once("../config.php");

$usuario = new Usuario();
// $usuario = new Usuario("Luiz","123456","mail@mail.com");
// $usuario->insert();
$usuario->loadbyid(2);

echo $usuario;



?>