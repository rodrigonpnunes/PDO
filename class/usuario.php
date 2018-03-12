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
			$row = $result[0];
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['desenha']);
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
			if (count($result) > 0) {
			$row = $result[0];
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['desenha']);
			//$this->setDtCadastro(new DateTime($row['dtcadastro']));
			}
		}
		else {
			throw new Exception("Login invalido!", 1);
		}
	}


	public function __toString(){
		return json_encode(array(
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha()
				//"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));
	}
}

?>