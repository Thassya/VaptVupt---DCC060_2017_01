<p>
	<a href="index.php?module=<?=$module?>&action=create" class="btn btn-default">
		Incluir <?=$module?>
	</a>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Fornecedor</th>
			<th>CNPJ</th>
			<th>E-Mail</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT * FROM Fornecedor ORDER BY nome ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nome"]. "</td>
					<td>" . $value["CNPJ"]. "</td>
					<td>" . $value["email"]. "</td>
					<td><a href='index.php?module=$module&action=edit&cnpj=".$value["CNPJ"]."'>Editar</a></td>
				</tr>";
		}?>
	</tbody>
</table>