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
			<th>Descrição</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT * FROM Produto ORDER BY nomeProduto ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nomeProduto"]. "</td>
					<td>" . $value["descricao"]. "</td>
					<td><a href='index.php?module=$module&action=edit&codProduto=".$value["CodProduto"]."'>Editar</a></td>
				</tr>";
		}?>
	</tbody>
</table>