<?php
require_once("DAO/UsuarioDAO.php");
require_once("DbProvider/MySqlProvider.php");
$DbProvider = new MySqlProvider();
$DbProvider->Connect();
$DbProvider->SelectDb();

require_once("lib.inc.php"); 
include_once("menu.php");
include_once("body.php");
?>
