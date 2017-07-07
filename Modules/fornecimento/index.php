<p>
	<a href="index.php?module=<?=$module?>&action=create" class="btn btn-default">
		Incluir <?=$module?>
	</a>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome Produto</th>
			<th>Fornecedor</th>
			<th>Valor de Fornecimento</th>
			<th>Deposito</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT p.nomeProduto, f.nome, fp.valorFornecimento, f.cnpj, p.codProduto, d.nome as nomeDeposito
			FROM  FornecimentoProduto fp
				INNER JOIN fornecedor f ON fp.CNPJ = f.CNPJ
				INNER JOIN produto p ON fp.codProduto = p.codProduto
				INNER JOIN deposito d ON d.UF = f.UF
			ORDER BY f.nome, p.nomeProduto ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nomeProduto"]. "</td>
					<td>" . $value["nome"]. "</td>
					<td>" . $value["valorFornecimento"]. "</td>
					<td>" . $value["nomeDeposito"]. "</td>
					<td>
						<a href='index.php?module=$module&action=edit&cnpj=".$value["cnpj"]."&codProduto=".$value["codProduto"]."'>Editar</a> | 
						<a href='index.php?module=$module&action=data&method=delete&cnpj=".$value["cnpj"]."&codProduto=".$value["codProduto"]."'>Deletar</a>
					</td>
				</tr>";
		}?>
	</tbody>
</table>