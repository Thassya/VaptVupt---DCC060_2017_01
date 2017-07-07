<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome Produto</th>
			<th>Quantidade em estoque</th>
			<th>Preço Sugerido</th>
			<th>Preço de Venda</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT e.CodProduto, p.nomeProduto, e.qtdeTotal, e.valorSugerido, e.precoVenda
			FROM estoque e
				INNER JOIN produto p ON e.CodProduto = p.codProduto
			ORDER BY p.nomeProduto;";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nomeProduto"]. "</td>
					<td>" . $value["qtdeTotal"]. " Unid.</td>
					<td>R$ " . number_format($value["valorSugerido"], 2, ',', '.'). "</td>
					<td>R$ " . number_format($value["precoVenda"], 2, ',', '.'). "</td>
					<td><a href='index.php?module=$module&action=edit&codProduto=".$value["CodProduto"]."'>Editar</a></td>
				</tr>";
		}?>
	</tbody>
</table>