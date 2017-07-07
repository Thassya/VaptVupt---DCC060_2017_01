<?php
	switch ($method) {
		case 'create':{
			$sql="INSERT INTO Produto(nomeProduto, descricao)
				VALUES('".addslashes($nomeProduto)."', '".addslashes($descricao)."')";
		}break;
		case 'update':{
			$sql="UPDATE Produto 
			SET nomeProduto = '".addslashes($nomeProduto)."', 
				descricao = '".addslashes($descricao)."'
			WHERE CodProduto = '$codProduto'";
		} break;
		default:{
			die("Nenhuma ação foi tomada");
		}break;
	}

	if(!$DbProvider->Query($sql)){
		$sql."<br />";
		die(mysql_error());
	} else{
		header("Location: index.php?module=$module");
	}
?>