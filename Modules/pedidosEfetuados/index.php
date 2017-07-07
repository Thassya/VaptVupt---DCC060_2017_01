<p>
	<a href="index.php?module=novoPedido" class="btn btn-default">
		Incluir Itens no carrinho
	</a>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Código</th>
			<th>Cliente</th>
			<th>Data do pedido</th>
			<th>Valor total</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT p.codPedido, p.dataPedido, p.valorTotalPedido, u.Nome
				FROM pedido p
					INNER JOIN Usuario u ON p.CPFCliente = u.CPF";
		if(!$_SESSION["isGerente"]){
			$sql.=" WHERE p.CPFCliente = '".$_SESSION["CPF"]."'";
		}
		$sql.=" ORDER BY p.dataPedido DESC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["codPedido"]. "</td>
					<td>" . $value["Nome"]. "</td>
					<td>" . $value["dataPedido"]. "</td>
					<td>" . $value["valorTotalPedido"]. "</td>
					<td><a href='index.php?module=$module&action=details&codPedido=".$value["codPedido"]."'>Detalhes</a></td>
				</tr>";
		}?>
	</tbody>
</table>