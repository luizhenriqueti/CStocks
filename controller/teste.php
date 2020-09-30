<?php
require_once("../config.php");

$usuario = new Usuario();
$usuario->loadbyid(0);

echo $usuario;



?>