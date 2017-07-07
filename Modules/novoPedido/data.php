<?php
	switch ($method) {
		case 'addCarrinho':{
			foreach ($codProduto as $key => $value) {
				if($value != null && $value > 0){
					$sql="INSERT INTO carrinho (CPF, CodProduto, qtde)
						VALUES ('$cpf', $key, $value) ON DUPLICATE KEY UPDATE qtde = qtde + $value";
					$DbProvider->Query($sql);
				}
			}
			header("Location: index.php?module=$module");
		}break;
		case 'dropCarrinho':{
			$sql="DELETE FROM carrinho WHERE CPF = '$cpf'";
			$DbProvider->Query($sql);
			header("Location: index.php?module=$module");
		} break;
		case 'dropItem':{
			$sql="DELETE FROM carrinho WHERE CPF = '". $_SESSION["CPF"]."' AND codProduto = '$codProduto'";
			$DbProvider->Query($sql);
			header("Location: index.php?module=$module");
		}break;
		case 'addVenda':{

			$sql="INSERT INTO pedido (dataPedido, valorTotalPedido, CPFCliente)
				VALUES (NOW(), 0, '$cpf')";
			$DbProvider->Query($sql);
			$idPedido = mysql_insert_id();
			
			$sql="SELECT $idPedido AS codPedido, c.codProduto, e.precoVenda, c.qtde 
				FROM carrinho c 
					INNER JOIN estoque e ON c.CodProduto = e.CodProduto
				WHERE c.CPF = '$cpf'";
			$listaItens = $DbProvider->Query($sql);

			$sql = "DELETE FROM carrinho WHERE CPF = '$cpf'";
			$DbProvider->Query($sql);

			foreach ($listaItens as $key => $value) {
				$sql="INSERT INTO pedidoItens (CodPedido,CodProduto, ValorFinal, quantidade)
					VALUES(".$value['codPedido'].", ".$value['codProduto'].", '".$value['precoVenda']."', ".$value['qtde'].");";
				$DbProvider->Query($sql);
			}

			$sql = "UPDATE pedido p
					INNER JOIN (SELECT SUM(pi.ValorFinal * pi.quantidade) AS vlrTotal, codPedido 
								FROM pedidoItens pi 
								GROUP BY codPedido) vt ON p.CodPedido = vt.CodPedido
				SET valorTotalPedido = vt.VlrTotal
				WHERE p.CodPedido = $idPedido";
			$DbProvider->Query($sql);

			header("Location: index.php?module=pedidosEfetuados");
		}break;
		default:{
			die("Nenhuma ação foi tomada");
		}break;
	}
?>