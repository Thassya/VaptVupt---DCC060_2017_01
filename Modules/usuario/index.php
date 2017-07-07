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
			<th>E-Mail</th>
			<th>Login</th>
			<th>Tel. Residencial</th>
			<th>Cliente</th>
			<th>Funcionario</th>
			<th>Gerente</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql="SELECT u.CPF, u.nome, u.email,  u.login, u.telResidencial, 
				IF(f.CPFFuncionario IS NULL, 'NÃO', 'SIM') AS isFuncionario,
				IF(c.CPFCliente IS NULL, 'NÃO', 'SIM') AS isCliente,
				IF(COALESCE(f.isCargoGerente, '') = '', 'NÃO', 'SIM') AS isGerente
			FROM Usuario u 
				LEFT JOIN Funcionario f on u.CPF = f.CPFFuncionario
				LEFT JOIN Cliente c ON u.CPF = c.CPFCliente
			ORDER BY Nome ASC";
		$array = $DbProvider->Query($sql);
		foreach ($array as $key => $value) {
			echo "<tr>
					<td>" . ($key + 1) . "</td>
					<td>" . $value["nome"]. "</td>
					<td>" . $value["email"]. "</td>
					<td>" . $value["login"]. "</td>
					<td>" . $value["telResidencial"]. "</td>
					<td>" . $value["isCliente"]. "</td>
					<td>" . $value["isFuncionario"]. "</td>
					<td>" . $value["isGerente"]. "</td>
					<td><a href='index.php?module=$module&action=edit&cpf=".$value["CPF"]."'>Editar</a></td>
				</tr>";
		}?>
	</tbody>
</table>