<?php

require_once("config.php");

$usuario = new Usuario();

// $usuario->loadById(1);

$usuario->getList();

echo json_encode($usuario);

?>