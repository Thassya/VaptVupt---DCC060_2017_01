<?php
$sql="SELECT e.CodProduto, p.nomeProduto, e.qtdeTotal, e.valorSugerido, e.precoVenda
			FROM estoque e
				INNER JOIN produto p ON e.CodProduto = p.codProduto
	WHERE e.CodProduto = $codProduto";
$registro = $DbProvider->Query($sql)[0];
?>
<h3>
	Editar Preço de Venda
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="update">
	<input type="hidden" name="codProduto" value="<?=$codProduto?>">

	<div class="form-group has-feedback">
		<label for="nomeProduto" class="control-label">Nome do Produto:</label>&nbsp;
		<?=$registro["nomeProduto"]?>
	</div>

	<div class="form-group has-feedback">
		<label for="precoSugerido" class="control-label">Preço Sugerido:</label>&nbsp;
		R$ <?=number_format($registro["valorSugerido"], 2, ',', '.')?>
	</div>

	<div class="form-group has-feedback">
		<label for="precoVenda" class="control-label">Preço de venda</label>
		<div class="input-group">
			<span class="input-group-addon">R$</span>
			<input type="text" value="<?=$registro['precoVenda']?>" class="form-control" name="precoVenda" pattern="[0-9]+\.[0-9]{2}" required="true" data-error="Campo Obrigatório">
		</div>
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Informe valor com duas casas decimais separadas por ponto - xxx.xx)</span>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success">
			Enviar
		</button>
		<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
	</div>
</form>
