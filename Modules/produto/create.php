<h3>
	Inserir <?=$module?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="create">

	<div class="form-group has-feedback">
		<label for="nomeProduto" class="control-label">Nome Produto</label>
		<input type="text" class="form-control" name="nomeProduto" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="descricao" class="control-label">Descricao</label>
		<input type="text" class="form-control" name="descricao" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success">
			Enviar
		</button>
		<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
	</div>
</form>
