<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">VaptVupt</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<? if($_SESSION["isGerente"]){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Área Gerencial<span class="caret"></span></a>
						<ul class="dropdown-menu">

							<li class="dropdown-header">Produtos e Fornecimento</li>
								<li><a href="index.php?module=deposito">Deposito</a></li>
							<li><a href="index.php?module=produto">Produtos</a></li>
							<li><a href="index.php?module=fornecedor">Fornecedores</a></li>
							<li><a href="index.php?module=fornecimento">Fornecimento</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Estoque</li>
							<li><a href="index.php?module=entradaEstoque">Entrada no estoque</a></li>
							<li><a href="index.php?module=gerPrecos">Gerenciar Preços de venda</a></li>
							<li><a href="index.php?module=gerPrecos&action=gerEstoqueBaixo">Produtos com Baixa no Estoque</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Usuarios</li>
							<li><a href="index.php?module=usuario">Cadastro de Usuarios</a></li>
							<li><a href="index.php?module=usuario&action=listarClientes">Listar Clientes</a></li>
						</ul>
					</li>
				<?}?>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Pedidos<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Pedidos</li>
						<li><a href="index.php?module=pedidosEfetuados">Lista de Pedidos Efetuados</a></li>
						<?if($_SESSION["isCliente"]){ ?>
							<li><a href="index.php?module=novoPedido">Carrinho de Compras</a></li>
						<? } ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<p class="navbar-btn">
						<a href="logout.php" class="btn btn-danger">Logout</a>
					</p>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
