<?php
	$sql="SELECT f.CNPJ, p.codProduto, f.Nome, p.nomeProduto, fp.valorFornecimento
		FROM fornecimentoProduto fp
			INNER JOIN fornecedor f ON fp.CNPJ = f.CNPJ
			INNER JOIN produto p ON fp.codProduto = p.codProduto
		ORDER BY p.nomeProduto, f.nome";
	$fornecimentoList = $DbProvider->Query($sql);
?>
<h3>
	Inserir Entrada de Produto
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="create">

	<div class="form-group has-feedback">
		<label for="CNPJ_CodProd" class="control-label">Produto Fornecido</label>
		<select class="form-control" name="CNPJ_CodProd" required="true" data-error="Campo Obrigatório">
			<option value="">Selecione...</option>
			<?php foreach ($fornecimentoList as $key => $value) { 
				$valor = $value["CNPJ"]."|".$value["codProduto"];
				$exibicao = "[".$value["Nome"]."] &nbsp;&nbsp;".$value["nomeProduto"]. " - R$".$value["valorFornecimento"];
				echo "<option value=".$valor.">".$exibicao."</option>";
			}?>
		</select>
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="qtd" class="control-label">Quantidade</label>
		<input type="number" min="1" pattern="[0-9]+" class="form-control" name="qtd" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Somente números)</span>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success">
			Enviar
		</button>
		<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
	</div>
</form>
