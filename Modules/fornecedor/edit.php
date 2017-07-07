<h3>
	Editar <?=$module?>
	<?php
	$sql = "SELECT * FROM Fornecedor WHERE CNPJ = '$cnpj'";
	$array = $DbProvider->Query($sql);
	$registro = $array[0];
	?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="update">

	<div class="form-group has-feedback">
		<label for="cnpj" class="control-label">CNPJ</label>
		<input type="hidden" name="cnpj" value="<?=$registro["CNPJ"]?>">
		<?=$registro["CNPJ"]?>
	</div>

	<div class="form-group has-feedback">
		<label for="nome" class="control-label">Nome</label>
		<input type="text" value="<?=$registro["nome"]?>" class="form-control" name="nome" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="email" class="control-label">E-mail</label>
		<input type="text" value="<?=$registro["email"]?>" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="telCelular" class="control-label">Telefone Celular</label>
		<input type="text" value="<?=$registro["telefoneCelular"]?>" class="form-control" name="telCelular" pattern="[0-9]{11}" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Somente Numeros)</span>
	</div>

	<div class="form-group has-feedback">
		<label for="telComercial" class="control-label">Telefone Comercial</label>
		<input type="text" value="<?=$registro["telefoneComercial"]?>" class="form-control" name="telComercial" pattern="[0-9]{10}" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors">(Somente Numeros)</span>
	</div>

	<div class="form-group has-feedback">
		<label for="rua" class="control-label">Rua</label>
		<input type="text" value="<?=$registro["rua"]?>" class="form-control" name="rua" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="numero" class="control-label">Número</label>
		<input type="text" value="<?=$registro["numero"]?>" class="form-control" name="numero" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="bairro" class="control-label">Bairro</label>
		<input type="text" value="<?=$registro["bairro"]?>" class="form-control" name="bairro" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="cidade" class="control-label">Cidade</label>
		<input type="text" value="<?=$registro["cidade"]?>" class="form-control" name="cidade" required="true" data-error="Campo Obrigatório">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="uf" class="control-label">UF</label>
		<select name="uf" class="form-control" required="true" data-error="Campo Obrigatório">
			<option value="">Selecione...</option>
			<?php
			foreach ($_ArrayUF as $value) {
				$selected = ($value==$registro["UF"] ? "selected" : "");
			 	echo "<option value='$value' $selected>$value</option>";
			 } 
			?>
		</select>
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
