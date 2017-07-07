<?php
	switch ($method) {
		case 'update':{
			$sql="UPDATE estoque SET precoVenda = '$precoVenda' WHERE codProduto = $codProduto";
		} break;
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