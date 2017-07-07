<?php
$sql = "SELECT nome, CNPJ FROM fornecedor ORDER BY nome";
$fornecedoresList = $DbProvider->Query($sql);

$sql = "SELECT nomeProduto, CodProduto FROM produto ORDER BY nomeProduto";
$produtosList = $DbProvider->Query($sql);

$sql = "SELECT idDeposito as codDeposito, nome as nomeDeposito, UF as UFdeposito FROM deposito 
		ORDER BY nome";
$depositoList = $DbProvider->Query($sql);

$sql = "SELECT * FROM fornecimentoProduto WHERE cnpj = '$cnpj' AND codProduto = '$codProduto'";
$array = $DbProvider->Query($sql);
$registro = $array[0];
?>

<h3>
	Editar <?=$module?>
</h3>
<hr />
<form method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="method" value="update">

	<div class="form-group has-feedback">
		<label for="codProduto" class="control-label">Produto&nbsp;</label>
		<?php foreach ($produtosList as $key => $value) { 
			echo ($registro['codProduto'] == $value["CodProduto"] ? $value["nomeProduto"] : "");
		}?>
		<input type="hidden" name="codProduto" value="<?=$registro['codProduto']?>">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="cnpj" class="control-label">Fornecedor&nbsp;</label>
		<?php foreach ($fornecedoresList as $key => $value) {
			echo ($registro['CNPJ'] == $value["CNPJ"] ? $value["nome"] : "");
		}?>
		<input type="hidden" name="cnpj" value="<?=$registro['CNPJ']?>">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

    <div class="form-group has-feedback">
		<label for="codDeposito" class="control-label">Produto&nbsp;</label>
		<?php foreach ($depositoList as $key => $value) { 
			echo ($registro['codDeposito'] == $value["codDeposito"] ? $value["nomeDeposito"] : "");
		}?>
		<input type="hidden" name="codDeposito" value="<?=$registro['codDeposito']?>">
		<span class="glyphicon form-control-feedback"></span>
		<span class="help-block with-errors"></span>
	</div>

	<div class="form-group has-feedback">
		<label for="valorFornecimento" class="control-label">Valor Fornecimento</label>

		<div class="input-group">
			<span class="input-group-addon">R$</span>
			<input type="text" value="<?=$registro['valorFornecimento']?>" class="form-control" name="valorFornecimento" pattern="[0-9]+\.[0-9]{2}" required="true" data-error="Campo Obrigatório">
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
