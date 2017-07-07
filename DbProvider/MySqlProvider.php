 <?php

include_once("DBProvider_Constants.php");

class MySqlProvider
{
	private $Host;
	private $User;
	private $Pw;
	private $DbName;
	private $MySqli;

	function __construct(){
		$this ->Host = "127.0.0.1";	
		$this ->User = "root";
		$this ->Pw = "mysql";
		$this->DbName = "vaptvupt";
		$this->MySqli = $this->MySqli = new mysqli($this->Host, $this->User, $this->Pw, $this->DbName);
	}

	function __destruct(){
		if($this->MySqli != null){
			$this->MySqli->Close();
		}
		return true;
	}

	public function Connect(){
		return ( 
			mysql_connect($this->Host, $this->User, $this->Pw) ? true : false
		);
	}

	public function SelectDB($dbName = ""){

		if(strlen($dbName) == 0){
			$dbName = $this->DbName;
		}

		if(mysql_select_db($dbName)){
			$this->DbName = $dbName;
			$this->MySqli = new mysqli($this->Host, $this->User, $this->Pw, $this->DbName);

			if($this->MySqli == null){
				die($this->MySqli->connect_error);
			}

			return true;
		} else{
			return false;
		}
	}

	public function Prepare($preparedSql){
		if(strlen(trim($preparedSql)) > 0){
			if(!($stmt = $this->MySqli->prepare($preparedSql))){
				die("Prepare Statement Failed: " . $preparedSql . "<br />Mysqli_error: " . $this->MySqli->error);
			}
			return $stmt;
		} else{
			return false;
		}
	}

	public function Execute($stmt){
		if($stmt->execute()){
			return "O Comando SQL foi executado com sucesso!";
		} else{
			return "O Comando SQL não foi executado com sucesso! (".$stmt->error.")";;
		}
		$stmt->close();
	}

	public function Query($sql, $option = 0){
		if(strlen(trim($sql)) == 0){
			return false;
		} else{
			$return = mysql_query($sql);
			switch ($option) {
				case 0:{
					if($return !== false && $return !== true){
						$arrResult = array();
						while ($fetch = mysql_fetch_array($return)) {
							$arrResult[] = $fetch;
						}
						return ($arrResult);
					} else{
						return $return;
					}
				} break;
				case DBPROVIDER_NUMROWS:{
					return mysql_num_rows($return);
				} break;
				case DBPROVIDER_AFFECTEDROWS:{
					return mysql_affected_rows($return);
				} break;
			}
		}
	}
}
 ?>