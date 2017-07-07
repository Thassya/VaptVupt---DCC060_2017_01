<?php
	switch ($method) {
		case 'create':{
			$sql="INSERT INTO fornecimentoProduto(CNPJ, CodProduto, valorFornecimento)
				VALUES('$cnpj', '$codProduto', '$valorFornecimento')";
		}break;
		case 'update':{
			$sql="UPDATE fornecimentoProduto 
			SET valorFornecimento = '$valorFornecimento'
			WHERE cnpj = '$cnpj' AND CodProduto = '$codProduto'";
		} break;
		case 'delete':{
			$sql = "DELETE FROM fornecimentoProduto
			WHERE cnpj = '$cnpj' AND CodProduto = '$codProduto'";
		}break;
		default:{
			die("Nenhuma ação foi tomada");
		}break;
	}

	if(!$DbProvider->Query($sql)){
		die(mysql_error());
	} else{
		header("Location: index.php?module=$module");
	}
?>