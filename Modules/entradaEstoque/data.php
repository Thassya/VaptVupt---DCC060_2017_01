<?php
	switch ($method) {
		case 'create':{
			$dados = explode("|", $CNPJ_CodProd);
			$sql="INSERT INTO historicoEntradaEstoque(CNPJ, CodProduto, qtd, custo, dataEntrada)
				SELECT fp.CNPJ, fp.CodProduto, '$qtd', fp.valorFornecimento, NOW() 
				FROM fornecimentoProduto fp 
				WHERE fp.CNPJ = '".$dados[0]."' AND fp.CodProduto='	".$dados[1]."'";
		}break;
		default:{
			die("Nenhuma ação foi tomada");
		}break;
	}

	if(!$DbProvider->Query($sql)){
		die(mysql_error());
	} else{
		header("Location: index.php?module=$module");
	}
?>