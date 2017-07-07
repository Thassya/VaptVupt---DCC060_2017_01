<?php
$sql = "SELECT COUNT(*) FROM carrinho WHERE CPF = '".$_SESSION['CPF']."'";
$num = $DbProvider->Query($sql);
$disabledButtonClass = ($num[0][0] == 0 ? "disabled" : "");
?>

<h3>
	Carrinho de Compras
</h3>
<hr />
<form class="form form-horizontal" action="" data-toggle="validator">
	<input type="hidden" name="module" value="<?=$module?>">
	<input type="hidden" name="action" value="data">
	<input type="hidden" name="cpf" value="<?=$_SESSION['CPF']?>">

	<div class="col-md-12 text-right">
		<button type="submit" name="method" value="dropCarrinho" <?=$disabledButtonClass?> class="btn btn-default">
			<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
		</button>
		<button type="submit" name="method" value="addCarrinho" class="btn btn-default">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
		</button>
		
		<button type="submit" name="method" value="addVenda" <?=$disabledButtonClass?> class="btn btn-success ">
			<span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
			<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
		</button>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nome Produto</th>
				<th>Preço</th>
				<th>Qtd em Estoque</th>
				<th>Qtd em Carrinho</th>
				<th>Valor Total deste ítem</th>
				<th>Adicionar</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$vlrTotalCarrinho = 0;
				$sql="SELECT e.codProduto, e.precoVenda, e.qtdeTotal, p.nomeProduto, COALESCE(c.qtde, 0) AS qtdCarrinho,	
						COALESCE(c.qtde, 0) * e.precoVenda AS 'vlrTotalCarrinho'
					FROM estoque e INNER JOIN produto p ON e.codProduto = p.codProduto 
					    LEFT JOIN (SELECT * FROM carrinho WHERE CPF = '".$_SESSION['CPF']."') c ON e.codProduto = c.codProduto
					WHERE (e.qtdeTotal > 0 OR c.qtde > 0)
					ORDER BY p.nomeProduto";	
				$itensList = $DbProvider->Query($sql);
				foreach ($itensList as $key => $value) {
					$strLinha = "<tr>
								<td>".$value["nomeProduto"]."</td>
								<td>R$ ".number_format($value["precoVenda"], 2, ',', '.')."</td>
								<td>".$value["qtdeTotal"]." Unid.</td>
								<td>".$value["qtdCarrinho"]." Unid.</td>
								<td>R$ ".number_format($value["vlrTotalCarrinho"], 2, ',', '.') ."</td>
								<td>
									<div class='form-group col-md-7' style='margin: 0; padding: 0'>
										<input type='number' pattern='[0-9]{5}' data-error='Campo numérico' required='true' value='0' class='form-control' min='0' max='".$value["qtdeTotal"]."' name='codProduto[".$value["codProduto"]."] '>
									</div>
								</td>
								<td>";
					if($value["qtdCarrinho"] > 0){
						$strLinha.= "<a href='index.php?module=$module&action=data&method=dropItem&codProduto=".$value["codProduto"]."' class='btn btn-danger'>
									<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
								</a>";
					}

					$strLinha.="    </td>
							</tr>";
					echo $strLinha;
				}
			?>
		</tbody>
		<tfoot>
			<tr class="warning">
				<th colspan="4" class="text-right">
					Valor Total do Carrinho:&nbsp;&nbsp;
				</th>
				<td>
					R$ <?=number_format($vlrTotalCarrinho, 2, ',', '.')?>
				</td>
				<td colspan="2">
					
				</td>
			</tr>
		</tfoot>
	</table>
</form>