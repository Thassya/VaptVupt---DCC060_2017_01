DROP DATABASE IF EXISTS vaptvupt;
CREATE DATABASE IF NOT EXISTS vaptvupt;

USE vaptvupt;

CREATE TABLE Usuario(
	CPF VARCHAR(11) NOT NULL PRIMARY KEY, 
    Nome VARCHAR(100) NOT NULL, 
    Email VARCHAR(50) NOT NULL, 	
    telResidencial VARCHAR(10) NULL, 
	telCelular VARCHAR(11) NOT NULL, 
    login VARCHAR(20) NOT NULL, 
    senha VARCHAR(100) NOT NULL, 
    
    CONSTRAINT UQ_LOGIN UNIQUE(login)
);

CREATE TABLE Cliente(
	CPFCliente VARCHAR(11) NOT NULL PRIMARY KEY, 
    CONSTRAINT fk_usuario_cpf__cliente_cpf FOREIGN KEY(CPFCliente) REFERENCES Usuario(CPF)
);

CREATE TABLE Funcionario(
	CPFFuncionario VARCHAR(11) NOT NULL PRIMARY KEY, 
    isCargoGerente BOOLEAN DEFAULT 0, 
    
    CONSTRAINT fk_usuario_cpf__funcionario_cpf FOREIGN KEY(CPFFuncionario) REFERENCES Usuario(CPF)
);

CREATE TABLE Pedido(
	CodPedido INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    dataPedido DATETIME NOT NULL DEFAULT NOW(), 
    valorTotalPedido DOUBLE(18, 2) NOT NULL CHECK (valorTotalPedido > 0), 
    CPFCliente VARCHAR(11) NOT NULL, 
    CONSTRAINT FK_Usuario_CPF__Pedido_CPFCliente FOREIGN KEY(CPFCliente) REFERENCES Cliente(CPFCliente)
);

CREATE TABLE Produto(
	CodProduto INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    nomeProduto VARCHAR(40) NOT NULL, 
    descricao VARCHAR(4000) NULL
);

CREATE TABLE PedidoItens(
	CodPedido INT NOT NULL, 
    CodProduto INT NOT NULL, 
    ValorFinal DOUBLE(18, 2) NOT NULL, 
    quantidade INT NOT NULL CHECK(quantidade > 0), 
    PRIMARY KEY(codPedido, codProduto),
    CONSTRAINT FK_pedidoItens_codPedido__pedido_codPedido FOREIGN KEY(codPedido) REFERENCES Pedido(codPedido),
    CONSTRAINT FK_pedidoItens_codProduto__produto_codProduto FOREIGN KEY(codProduto) REFERENCES Produto(codProduto)
);

CREATE TABLE Estoque(
	codProduto INT NOT NULL, 
    custoFinal DOUBLE(18, 2) NOT NULL CHECK(custoFinal > 0), 
    precoVenda DOUBLE(18, 2) NOT NULL CHECK(precoVenda > 0), 
    valorSugerido DOUBLE(18, 2) NOT NULL CHECK(valorSugerido > 0), 
    qtdeTotal INT NOT NULL CHECK(qtdeTotal > 0), 
    PRIMARY KEY(codProduto),
    CONSTRAINT FK_estoque_codProduto__produto_codProduto FOREIGN KEY(codProduto) REFERENCES Produto(codProduto)
);

CREATE TABLE Fornecedor(
	CNPJ VARCHAR(14) PRIMARY KEY NOT NULL, 
    nome VARCHAR(100) NOT NULL, 
    email VARCHAR(50) NOT NULL, 	
    telefoneCelular VARCHAR(11),
    telefoneComercial VARCHAR(10) NOT NULL, 
    bairro VARCHAR(100) NOT NULL, 
    rua VARCHAR(100) NOT NULL, 
    numero VARCHAR(10) NOT NULL, 
    cidade VARCHAR(100) NOT NULL, 
    UF VARCHAR(2) NOT NULL
);

CREATE TABLE FornecimentoProduto(
	CNPJ VARCHAR(14) NOT NULL, 
    codProduto INT NOT NULL, 
    valorFornecimento DOUBLE(18, 2) NOT NULL,
    PRIMARY KEY(CNPJ, codProduto), 
    CONSTRAINT FK_FornecimentoProduto_codProduto__produto_codProduto FOREIGN KEY(codProduto) REFERENCES Produto(codProduto), 
    CONSTRAINT FK_FornecimentoProduto_CNPJ__Fornecedor_CNPJ FOREIGN KEY(CNPJ) REFERENCES Fornecedor(CNPJ)
);

CREATE TABLE HistoricoEntradaEstoque(
	idEntrada INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    CNPJ VARCHAR(14) NOT NULL, 
    codProduto INT NOT NULL, 
    qtd INT NOT NULL CHECK(qtd > 0), 
    custo DOUBLE(18, 2) CHECK (custo > 0), 
    dataEntrada DATETIME NULL DEFAULT NOW(),
    CONSTRAINT FK_HistEntradaEstoque_codProduto__FornecimentoProduto_codProduto FOREIGN KEY(codProduto) REFERENCES FornecimentoProduto(codProduto), 
    CONSTRAINT FK_HistEntradaEstoque_CNPJ__FornecimentoProduto_CNPJ FOREIGN KEY(CNPJ) REFERENCES FornecimentoProduto(CNPJ)
);

CREATE TABLE Carrinho(
	CPF VARCHAR(11) NOT NULL, 
    CodProduto int not null,
    qtde INT NOT NULL CHECK(qtde > 0), 
    observacao VARCHAR(200),
    
    PRIMARY KEY(CPF, CodProduto), 
    CONSTRAINT FK_Carrinho_CPF__Usuario_CPF FOREIGN KEY(CPF) REFERENCES Usuario(CPF), 
    CONSTRAINT FK_Carrinho_CodProduto__Produto_CodProduto FOREIGN KEY(CodProduto) REFERENCES Produto(CodProduto)
);

DROP TRIGGER IF EXISTS TRG_InCarrinho_OutEstoque_INSERT;
DELIMITER <delimiter>
CREATE TRIGGER TRG_InCarrinho_OutEstoque_INSERT
BEFORE INSERT
ON Carrinho FOR EACH ROW BEGIN
	IF (NOT EXISTS(SELECT * FROM carrinho WHERE CPF = NEW.CPF AND CodProduto = NEW.CodProduto)) THEN
		SET NEW.observacao = IF(NEW.qtde >(SELECT e.qtdeTotal FROM estoque e WHERE e.CodProduto = NEW.CodProduto), 'Quantidade diminuida por limitação em estoque', '');
			SET NEW.qtde = IF(NEW.qtde > (SELECT e.qtdeTotal FROM estoque e WHERE e.CodProduto = NEW.CodProduto), (SELECT e.qtdeTotal FROM estoque e WHERE e.CodProduto = NEW.CodProduto), NEW.qtde);
			
			UPDATE estoque e
			SET qtdeTotal = qtdeTotal - NEW.qtde
			WHERE codProduto = NEW.codProduto;
	END IF;
END
<delimiter>

DROP TRIGGER IF EXISTS TRG_InCarrinho_OutEstoque_UPDATE;
DELIMITER <delimiter>
CREATE TRIGGER TRG_InCarrinho_OutEstoque_UPDATE
BEFORE UPDATE
ON Carrinho FOR EACH ROW BEGIN

    SET @diff = (NEW.qtde - OLD.qtde);
    SET @estoque = (SELECT e.qtdeTotal FROM estoque e WHERE e.codProduto = NEW.codProduto LIMIT 1);
    SET @operando = IF(@diff > @estoque, @estoque, @diff);
    
    SET NEW.observacao = IF(@diff > @estoque, 'Quantidade diminuida por limitação em estoque', '');
    SET NEW.qtde = OLD.qtde + @operando;
	
    UPDATE estoque e SET e.qtdeTotal = qtdeTotal - @operando
    WHERE e.CodProduto = NEW.codProduto;
END
<delimiter>

DROP TRIGGER IF EXISTS TRG_OutCarrinho_InEstoque;
DELIMITER <delimiter>
CREATE TRIGGER TRG_OutCarrinho_InEstoque
BEFORE DELETE 
ON Carrinho FOR EACH ROW BEGIN
	UPDATE estoque e
	SET qtdeTotal = qtdeTotal + OLD.qtde
    WHERE codProduto = OLD.codProduto;
END
<delimiter>

DROP TRIGGER IF EXISTS TRG_InsereEstoque;
DELIMITER <delimiter>
CREATE TRIGGER TRG_InsereEstoque
AFTER INSERT 
ON historicoentradaestoque FOR EACH ROW BEGIN
	UPDATE estoque e
	INNER JOIN (SELECT hee.codProduto AS codProduto, SUM(hee.custo * hee.qtd) AS somaCusto, AVG(hee.custo) * 1.2 AS valorSugerido
				FROM historicoEntradaEstoque hee
				GROUP BY hee.codProduto) groupHist ON e.codProduto = groupHist.codProduto
	SET e.qtdeTotal = e.qtdeTotal + NEW.qtd, 
		e.custoFinal = groupHist.somaCusto, 
		e.precoVenda = groupHist.valorSugerido,
		e.valorSugerido = groupHist.valorSugerido
	WHERE e.codProduto = NEW.codProduto;
END
<delimiter>

DROP TRIGGER IF EXISTS TRG_RemoveEstoque;
DELIMITER <delimiter>
CREATE TRIGGER TRG_RemoveEstoque
AFTER INSERT
ON pedidoItens FOR EACH ROW BEGIN
	UPDATE estoque
    SET qtdeTotal = qtdeTotal - NEW.quantidade
    WHERE codProduto = NEW.CodProduto;
END
<delimiter>

DROP TRIGGER TRG_criaRegistroEstoque;
DELIMITER <delimiter>
CREATE TRIGGER TRG_criaRegistroEstoque
AFTER INSERT 
ON produto FOR EACH ROW BEGIN
	INSERT INTO estoque(codProduto, custoFinal, precoVenda, valorSugerido, qtdeTotal)
    VALUES(NEW.CodProduto, 0.00, 0.00, 0.00, 0);
END;
<delimiter>