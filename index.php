<?php
// 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 
require_once("config.php");

$usuario = new Usuario();

// $usuario->loadById(1);

// $lista = Usuario::getList();

// $busca = Usuario::search("luan_carvalho");

$usuario->login("luan_carvalho");


echo json_encode($usuario);

?>