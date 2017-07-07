<?php
	switch ($method) {
		case 'create':{
			$sql="INSERT INTO fornecedor(CNPJ, nome, email, telefoneCelular, telefoneComercial, bairro, rua, numero, cidade, UF)
				VALUES('$cnpj', '$nome', '$email', '$telCelular', '$telComercial', '$bairro', '$rua', '$numero', '$cidade', '$uf')";
		}break;
		case 'update':{
			$sql="UPDATE fornecedor 
			SET  nome = '$nome', 
				email = '$email', 
				telefoneComercial = '$telComercial', 
				telefoneCelular = '$telCelular', 
				bairro = '$bairro', 
				rua = '$rua', 
				numero = '$numero', 
				cidade = '$cidade', 
				uf = '$uf'
			WHERE cnpj = '$cnpj'";
		} break;
		default:{
			die("Nenhuma aчуo foi tomada");
		}break;
	}

	if(!$DbProvider->Query($sql)){
		die(mysql_error());
	} else{
		header("Location: index.php?module=$module");
	}
?>