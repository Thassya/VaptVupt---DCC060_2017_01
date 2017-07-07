<?php
include_once("DbProvider/MySqlProvider.php");
include_once("Class/Usuario.php");

class UsuarioDAO{
	private $sqlProvider;

	function __construct($SqlProvider = null){
		if($SqlProvider == null){
			$this->sqlProvider = new MySQLProvider();
		} else{
			$this->sqlProvider = $SqlProvider;
		}
	}

	public function Inserir($usuario){

		if($this->BuscarPorLogin($usuario->Login) == null && $this->BuscarPorCPF($usuario->CPF) == null){

			$sql = "INSERT INTO usuario (CPF, Nome, Email, telResidencial, telCelular, Rua, Numero, Bairro, Cidade, UF, login, senha)
					VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->sqlProvider->Prepare($sql);
			$stmt->bind_param('sssssss', 
				$usuario->CPF, 
				$usuario->Nome, 
				$usuario->Email, 
				$usuario->TelResidencial, 
				$usuario->TelCelular, 
				$usuario->Rua,
				$usuario->Numero,
				$usuario->Bairro,
				$usuario->Cidade,
				$usuario->UF,
				$usuario->Login, 
				$usuario->SenhaDB()
			);

			$returnMessage = $this->sqlProvider->Execute($stmt);
			if($usuario->IsCliente){
				$sql="INSERT INTO cliente (CPFCliente) VALUES('".$usuario->CPF."')";
				$this->sqlProvider->Query($sql);
			} else if($usuario->IsGerente){
				$sql="INSERT INTO Funcionario (CPFFuncionario, isCargoGerente) VALUES('".$usuario->CPF."', 1)";
				$this->sqlProvider->Query($sql);
			}

			return $returnMessage;
		} else{
			return "Este CPF ou este Login já existem na base de dados.";
		}
	}

	public function BuscaFuncionarioPorLogin($login){
		$usuario = null;
		$sql = "SELECT u.cpf, u.nome, u.email, u.telResidencial, u.telCelular, u.login, u.senha, f.isCargoGerente
			FROM usuario u 
				INNER JOIN funcionario f ON u.CPF = f.CPFFuncionario
			WHERE login = ?";
		$stmt = $this->sqlProvider->Prepare($sql);
		$stmt->bind_param('s', $login);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows >= 1){
			$stmt->bind_result($cpf, $nome, $email, $telRes, $telCel, $login, $senha, $isGerente);
			$stmt->fetch();
			$usuario = new Usuario();
			$usuario->CPF = $cpf;
			$usuario->Nome = $nome;
			$usuario->Email = $email;
			$usuario->TelResidencial = $telRes;
			$usuario->TelCelular = $telCel;
			$usuario->Login = $login;
			$usuario->Senha = $senha;
			$usuario->IsFuncionario = true;
			$usuario->IsGerente = $isGerente;
		}
		return $usuario;
	}

	public function BuscaClientePorLogin($login){
		$usuario = null;
		$sql = "SELECT u.cpf, u.nome, u.email, u.telResidencial, u.telCelular, u.Rua, u.Numero, u.Bairro, u.Cidade, u.UF, u.login, u.senha
			FROM usuario u 
				INNER JOIN Cliente c ON u.CPF = c.CPFCliente
			WHERE login = ?";
		$stmt = $this->sqlProvider->Prepare($sql);
		$stmt->bind_param('s', $login);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows >= 1){
			$stmt->bind_result($cpf, $nome, $email, $telRes, $telCel, $rua, $numero, $bairro, $cidade, $UF, $login, $senha);
			$stmt->fetch();
			$usuario = new Usuario();
			$usuario->CPF = $cpf;
			$usuario->Nome = $nome;
			$usuario->Email = $email;
			$usuario->TelResidencial = $telRes;
			$usuario->TelCelular = $telCel;
			$usuario->Rua = $rua;
			$usuario->Numero = $numero;
			$usuario->Bairro = $bairro;
			$usuario->Cidade = $cidade;
			$usuario->UF = $UF;
			$usuario->Login = $login;
			$usuario->Senha = $senha;
			$usuario->IsCliente = true;
		}
		return $usuario;
	}

	public function BuscarPorLogin($login){
		$usuario = null;
		$sql = "SELECT * FROM usuario WHERE login = ? LIMIT 1";
		$stmt = $this->sqlProvider->Prepare($sql);
		$stmt->bind_param('s', $login);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows >= 1){
			$stmt->bind_result($cpf, $nome, $email, $telRes, $telCel, $login, $senha);
			$stmt->fetch();
			$usuario = new Usuario();
			$usuario->CPF = $cpf;
			$usuario->Nome = $nome;
			$usuario->Email = $email;
			$usuario->TelResidencial = $telRes;
			$usuario->TelCelular = $telCel;
			$usuario->Login = $login;
			$usuario->Senha = $senha;
		}

		return $usuario;
	}	

	public function BuscarPorCPF($CPF){
		$usuario = null;
		$sql = "SELECT * FROM usuario WHERE CPF = ? LIMIT 1";
		$stmt = $this->sqlProvider->Prepare($sql);
		$stmt->bind_param('s', $CPF);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows >= 1){
			$stmt->bind_result($cpf, $nome, $email, $telRes, $telCel, $login, $senha);
			$stmt->fetch();
			$usuario = new Usuario();
			$usuario->CPF = $cpf;
			$usuario->Nome = $nome;
			$usuario->Email = $email;
			$usuario->TelResidencial = $telRes;
			$usuario->TelCelular = $telCel;
			$usuario->Login = $login;
			$usuario->Senha = $senha;
		}

		return $usuario;
	}
}
?>