<?php
class usuario {
	private $deslogin;
	private $dessenha;

	public function setDeslogin($param){ $this->deslogin = $param; }
	public function setDessenha($param){ $this->dessenha = $param; }
	public function getDeslogin(){ return $this->deslogin;}
	public function getDessenha(){ return $this->dessenha; }

	public function loadByLogin($login){
		$sql = new Sql();
		$result=$sql->select("SELECT * FROM tab_usuario WHERE deslogin=:LOGIN", array (":LOGIN"=>$login));

		if (count($result) > 0) {
			$this->setData($result[0]);
			//$row = $result[0];
			//$this->setDeslogin($row['deslogin']);
			//$this->setDessenha($row['desenha']);
			//$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

	// ------------------------------------------------
	// nao precisa ser instanciado
	// static ---> nao possui (this**) dentro do metodo
	// ------------------------------------------------
	public static function getList(){
		$sql = new Sql();
		return $sql->select ("SELECT * FROM tab_usuario");
	}

	// ------------------------------------------------
	// nao precisa ser instanciado
	// static ---> nao possui (this**) dentro do metodo
	// ------------------------------------------------
	public static function search($login){
		$sql = new Sql();
		return $sql->select ("SELECT * FROM tab_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%". $login . "%"
			));	
	}


	public function login($login, $pwd){
		$sql = new Sql();
		$result=$sql->select("SELECT * FROM tab_usuario WHERE deslogin=:LOGIN AND desenha=:PASSWORD", array (
				":LOGIN"=>$login,
				":PASSWORD"=>$pwd
			));

		if (count($result) > 0) {
				$this->setData($result[0]);
		}
		else {
			throw new Exception("Login invalido!", 1);
		}
	}


	public function setData($row){
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['desenha']);
			//$this->setDtCadastro(new DateTime($row['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$result=$sql->select("SELECT sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN"=>$this->deslogin,
			":PASSWORD"=>$this->dessenha
			));
			if (count($result) > 0) {
				echo "\nSucesso na inclusao";
			//	$this->setData($result[0]);
			}
	}


	public function update($login, $senha) {
		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();
		$result=$sql->query("UPDATE tab_usuario SET deslogin=:LOGIN WHERE desenha=:PASSWORD", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
			));
			if (count($result) > 0) {
				echo "\nSucesso na alteracao";
			//	$this->setData($result[0]);
			}


	}


	public function delete() {
		$sql = new Sql();
		$result=$sql->query("DELETE FROM tab_usuario WHERE deslogin=:LOGIN", array(
			":LOGIN"=>$this->getDeslogin()
			));
			if (count($result) > 0) {
				echo "\nSucesso na remocao";
			//	$this->setData($result[0]);
			}
			$this->setDeslogin("");			
			$this->setDessenha("");
	}

	public function __construct($login = "", $senha = ""){
			$this->setDeslogin($login);			
			$this->setDessenha($senha);
	}

	public function __toString() {
		return json_encode(array(
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha()
				//"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
	}
}

?>