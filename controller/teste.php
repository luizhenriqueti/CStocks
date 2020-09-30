<?php
require_once("../config.php");

$usuario = new Usuario();

$arr = [
    "id"=> 2,
    "login" => "teste update",
    "senha" => "", 
    "email" => "novomail@mail.com"
];

$usuario->update($arr);





?>