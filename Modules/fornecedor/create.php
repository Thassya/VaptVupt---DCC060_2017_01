<h3>
	Inserir <?=$module?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="create">

	<div class="form-group has-feedback">
		<label for="cnpj" class="control-label">CNPJ</label>
		<input type="text" class="form-control" name="cnpj" pattern="^[0-9]{14}$" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(somente numeros)</span>
	</div>

	<div class="form-group has-feedback">
		<label for="nome" class="control-label">Nome</label>
		<input type="text" class="form-control" name="nome" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="email" class="control-label">E-mail</label>
		<input type="text" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="telCelular" class="control-label">Telefone Celular</label>
		<input type="text" class="form-control" name="telCelular" pattern="[0-9]{11}" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Somente Numeros)</span>
	</div>

	<div class="form-group has-feedback">
		<label for="telComercial" class="control-label">Telefone Comercial</label>
		<input type="text" class="form-control" name="telComercial" pattern="[0-9]{10}" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Somente Numeros)</span>
	</div>

	<div class="form-group has-feedback">
		<label for="rua" class="control-label">Rua</label>
		<input type="text" class="form-control" name="rua" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="numero" class="control-label">Número</label>
		<input type="text" class="form-control" name="numero" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="bairro" class="control-label">Bairro</label>
		<input type="text" class="form-control" name="bairro" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="cidade" class="control-label">Cidade</label>
		<input type="text" class="form-control" name="cidade" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="uf" class="control-label">UF</label>
		<select name="uf" class="form-control" required="true" data-error="Campo Obrigatório">
			<option value="">Selecione...</option>
			<?php
			foreach ($_ArrayUF as $value) {
			 	echo "<option value='$value'>$value</option>";
			 } 
			?>
		</select>
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>
	
	<div class="form-group">
		<button type="submit" name="method" value="create" class="btn btn-success">
			Enviar
		</button>
		<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
	</div>
</form>
