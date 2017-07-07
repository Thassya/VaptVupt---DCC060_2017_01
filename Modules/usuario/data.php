<?php
	switch ($method) {
		case 'create':{
			$UsuarioDAO = new UsuarioDAO($DbProvider);
			$usuario = new Usuario();
			$usuario -> CPF = $cpf;
			$usuario -> Nome = $nome;
			$usuario -> Email = $email;
			$usuario -> TelResidencial = $telResidencial;
			$usuario -> TelCelular = $telCelular;
			$usuario -> Login = $login;
			$usuario -> Senha = $senha;

			if($tpUsuario == 1){
				$usuario->IsGerente = true;
			}else{
				$usuario->IsCliente = true;
			}
			
			$UsuarioDAO->Inserir($usuario);
		}break;
		default:{
			die("Nenhuma ação foi tomada");
		}break;
	}

	header("Location: index.php?module=$module");
	
?>