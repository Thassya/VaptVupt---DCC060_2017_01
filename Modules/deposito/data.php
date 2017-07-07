<?php
	switch ($method) {
		case 'create':{
			$sql="INSERT INTO deposito(nome, UF)
				VALUES('$nome', '$uf')";
		}break;
		case 'update':{
			$sql="UPDATE deposito 
			SET  nome = '$nome', 
				uf = '$uf'
			WHERE idDeposito = '$idDeposito'";
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