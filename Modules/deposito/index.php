<p>
	<a href="index.php?module=<?=$module?>&action=create" class="btn btn-default">
		Incluir <?=$module?>
	</a>
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Nome</th>
			<th>UF</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT * FROM deposito ORDER BY UF ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nome"]. "</td>
					<td>" . $value["UF"]. "</td>
					<td><a href='index.php?module=$module&action=edit&idDeposito=".$value["idDeposito"]."'>Editar</a></td>
				</tr>";
		}?>
	</tbody>
</table>