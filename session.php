<?php
include_once("DAO/UsuarioDAO.php");
$usuarioDAO = new UsuarioDAO();

$login = $_REQUEST["login"];
$senha = $_REQUEST["senha"];
$tipoLogin = $_REQUEST["tipoLogin"];

if($tipoLogin == 1){
	$usuario = $usuarioDAO->BuscaClientePorLogin($login);
} else{
	$usuario = $usuarioDAO->BuscaFuncionarioPorLogin($login);
}

if($usuario != null){
	if($usuario->VerificaSenha($senha)){
		session_start();
		$_SESSION["login"] = $usuario->Login; 
		$_SESSION["CPF"] = $usuario->CPF; 
		$_SESSION["nome"] = $usuario->Nome; 
		$_SESSION["isFuncionario"] = $usuario->IsFuncionario; 
		$_SESSION["isGerente"] = $usuario->IsGerente; 
		$_SESSION["isCliente"] = $usuario->IsCliente; 
		header("Location: index.php");
		exit();
	}
	else{
		$message = "Senha incorreta para o usuário informado";
		header("Location: index.php?message=$message");
	}
} else{
	$message = "Usuário Inexistente";
	header("Location: index.php?message=$message");
}
?>