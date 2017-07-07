<p>
	<a href="index.php?module=<?=$module?>&action=create" class="btn btn-default">
		Inserir Entrada de Produto
	</a>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome Produto</th>
			<th>Fornecedor</th>
			<th>Custo</th>
			<th>Quantidade</th>
			<th>Data de entrada</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT hee.CNPJ, hee.CodProduto, f.nome, p.nomeProduto, hee.qtd, hee.custo, hee.dataEntrada 
				FROM historicoEntradaEstoque hee
					INNER JOIN Fornecedor f ON hee.CNPJ = f.CNPJ
					INNER JOIN Produto p ON hee.CodProduto = p.codProduto
				ORDER BY p.nomeProduto, hee.custo ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			$classLinha = ($value["qtd"] <= 5 ? "danger" : "");
			echo "<tr class='$classLinha'>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nomeProduto"]. "</td>
					<td>" . $value["nome"]. "</td>
					<td>R$ " . $value["custo"]. "</td>
					<td>" . $value["qtd"]. "</td>
					<td>" . $value["dataEntrada"]. "</td>
				</tr>";
		}?>
	</tbody>
</table>