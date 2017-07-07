<?php
class Usuario
{
	public $CPF;
	public $Nome;
	public $Email;
	public $TelResidencial;
	public $TelCelular;
	public $Rua;
	public $Numero;
	public $Bairro;
	public $Cidade;
	public $UF;
	public $Login;
	public $Senha;
	public $IsFuncionario;
	public $IsGerente;
	public $IsCliente;

	function __construct(){
		$this->IsGerente = false;
		$this->IsFuncionario = false;
		$this->IsCliente = false;
	}

	public function SenhaDB(){
		if(strlen(trim($this->Senha)) > 0){
			return $this->SenhaCript($this->Senha);
		}
		else{
			return "";
		}
	}

	public function SenhaCript($senha){
		return md5($senha);
	}

	public function VerificaSenha($senhaSemHash){
		return ($this->SenhaCript($senhaSemHash) === $this->Senha) ? true : false;
	}
}
?>