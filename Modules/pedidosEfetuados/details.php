<?php
	$sql = "SELECT p.CodPedido, DATE_FORMAT(p.DataPedido, '%d/%m/%Y às %h:%i:%s hs') AS DataPedido, p.valorTotalPedido, u.Nome 
		FROM pedido p
			INNER JOIN usuario u ON p.CPFCliente = u.CPF 
		WHERE p.CodPedido = $codPedido";
	$dados = $DbProvider->Query($sql)[0];
?>

<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Detalhes do Pedido</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label">Código do pedido: </label>&nbsp;
			<?=$dados['CodPedido']?>
		</div>
		<div class="form-group">
			<label class="control-label">Nome Cliente: </label>&nbsp;
			<?=$dados['Nome']?>
		</div>
		<div class="form-group">
			<label class="control-label">Data do pedido: </label>&nbsp;
			<?=$dados['DataPedido']?>
		</div>
		<div class="form-group">
			<label class="control-label">Valor Total: </label>&nbsp;
			R$ <?=$dados['valorTotalPedido']?>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome Produto</th>
				<th>Quantidade</th>
				<th>Valor na data da compra</th>
				<th>Valor Total do produto</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$acum = 0;
			$sql="SELECT p.nomeProduto, pi.valorFinal, pi.quantidade, (pi.valorFinal * pi.quantidade) AS vlrTotProd  
			FROM pedidoItens pi
			INNER JOIN produto p ON pi.CodProduto = p.codProduto
			WHERE pi.CodPedido = $codPedido;";
			$array = $DbProvider->Query($sql);
			foreach ($array as $key => $value) {
				$acum += $value["vlrTotProd"];
				echo "<tr>
				<td>" . ($key + 1) . "</td>
				<td>" . $value["nomeProduto"]. "</td>
				<td>" . $value["quantidade"]. "</td>
				<td>R$ " . number_format($value["valorFinal"], 2, ',', '.'). "</td>
				<td>" . number_format($value["vlrTotProd"], 2, ',', '.'). "</td>
			</tr>";
		}?>
	</tbody>
	<tfoot>
		<tr class="warning">
			<th colspan="4" class="text-right">
				Valor Total do Pedido: &nbsp;
			</th>
			<th>
				R$ <?=number_format($acum, 2, ',', '.')?>
			</th>
		</tr>
	</tfoot>
</table>
</div>
<div class="form-group">
	<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
</div>
