<h3>
	Inserir <?=$module?>
	<?php
	$sql = "SELECT nome, CNPJ FROM fornecedor ORDER BY nome";
	$fornecedoresList = $DbProvider->Query($sql);
	
	$sql = "SELECT nomeProduto, CodProduto FROM produto ORDER BY nomeProduto";
	$produtosList = $DbProvider->Query($sql);

	$sql = "SELECT nome as nomeDeposito, UF as UFdeposito FROM deposito ORDER BY nome";
	$depositoList = $DbProvider->Query($sql);
	?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="create">

	<div class="form-group has-feedback">
		<label for="codProduto" class="control-label">Produto</label>
		<select class="form-control" name="codProduto" required="true" data-error="Campo Obrigatório">
			<option value="">Selecione...</option>
			<?php foreach ($produtosList as $key => $value) { 
				echo "<option value=".$value["CodProduto"].">".$value["nomeProduto"]."</option>";
			}?>
		</select>
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="cnpj" class="control-label">Fornecedor</label>
		<select class="form-control" name="cnpj" required="true" data-error="Campo Obrigatório">
			<option value="">Selecione...</option>
			<?php foreach ($fornecedoresList as $key => $value) {
				echo "<option value=".$value['CNPJ'].">".$value['nome']."</option>";
			}?>
		</select>
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="valorFornecimento" class="control-label">Valor Fornecimento</label>
		<div class="input-group">
			<span class="input-group-addon">R$</span>
			<input type="text" class="form-control" name="valorFornecimento" pattern="[0-9]+\.[0-9]{2}" required="true" data-error="Campo Obrigatório">
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
