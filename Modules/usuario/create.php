
<h3>
	Inserir <?=$module?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<div class="col-md-6">
		<input type="hidden" name="module" value="<?=$module?>">
		<input type="hidden" name="action" value="data">
		<input type="hidden" name="method" value="create">
		
		<div class="form-group has-feedback">
			<label for="tpUsuario" class="control-label">Tipo de Usuario</label>
			<div class="radio">
			<label><input type="radio" value="1" required="true" name="tpUsuario" data-error="Selecione o tipo de Usuario">Funcionario</label>
			</div>
			<div class="radio">
				<label><input type="radio" value="2" required="true"  name="tpUsuario" data-error="Selecione o tipo de Usuario">Cliente</label>
			</div>
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors"></span>
		</div>
		
		<div class="form-group has-feedback">
			<label for="cpf" class="control-label">CPF</label>
			<input type="text" class="form-control" name="cpf" pattern="^[0-9]{11}$" required="true" data-error="Campo Obrigatório">
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors">(somente numeros - 11 dígitos)</span>
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
			<label for="telResidencial" class="control-label">Telefone Residencial</label>
			<input type="text" class="form-control" name="telResidencial" pattern="[0-9]{10}" required="true" data-error="Campo Obrigatório">
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors">(Somente Numeros)</span>
		</div>

		
	</div>
	<div class="col-md-6">
	<div class="form-group has-feedback">
			<label for="login" class="control-label">Login</label>
			<input type="text" class="form-control" name="login" required="true" data-error="Campo Obrigatório" >
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors"></span>
		</div>

		<div class="form-group has-feedback">
			<label for="senha" class="control-label">Senha</label>
			<input type="password" class="form-control" id="senha" name="senha" data-minlength="6" required="true" data-error="Preencha sua senha (pelo menos 6 caracteres)" placeholder="******">
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors"></span>
		</div>

		<div class="form-group has-feedback">
			<label for="resenha" class="control-label">Repita sua Senha</label>
			<input type="password" class="form-control" id="resenha" data-minlength="6" data-match="#senha" required="true" data-error="Repita a senha(igual à do campo Senha)" placeholder="******">
			<span class="glyphicon form-control-feedback"></span>
			<span class="help-block with-errors"></span>
		</div>
		
		<div class="form-group">
			<label for="Rua" class="control-label">Rua</label>
			<input type="text" class="form-control" name="rua">
			<span class="glyphicon form-control-feedback"></span>
		</div>
		<div class="form-group">
			<label for="numero" class="control-label">Numero</label>
			<input type="text" class="form-control" name="numero">
			<span class="glyphicon form-control-feedback"></span>
		</div>
		<div class="form-group">
			<label for="bairro" class="control-label">Bairro</label>
			<input type="text" class="form-control" name="bairro">
			<span class="glyphicon form-control-feedback"></span>
		</div>
		<div class="form-group">
			<label for="cidade" class="control-label">Cidade</label>
			<input type="text" class="form-control" name="cidade">
			<span class="glyphicon form-control-feedback"></span>
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
	
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<button type="submit" name="method" value="create" class="btn btn-success">
				Enviar
			</button>
			<a href="index.php?module=<?=$module?>" class = "btn btn-default">Voltar</a>
		</div>
	</div>
</form>
