<h3>
	Editar <?=$module?>
	<?php
	$sql = "SELECT * FROM deposito WHERE idDeposito = '$idDeposito'";
	$array = $DbProvider->Query($sql);
	$registro = $array[0];
	?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="update">
	<input type="hidden" name="idDeposito" value="<?=$idDeposito?>">

	<div class="form-group has-feedback">
		<label for="nome" class="control-label">Nome Deposito</label>
		<input type="text" value="<?=$registro['nome']?>" class="form-control" name="nome" required="true" data-error="Campo Obrigatório">
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
