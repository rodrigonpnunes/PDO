<?php
class Sql extends PDO {
	private $conn;

	// -------------------------------------------------------
	// quando ocorrer um new ja conecta
	// -------------------------------------------------------
	public function __construct(){
		$this->conn = new PDO("pgsql:host=localhost dbname=teste user=postgres password=");
	}

	// -------------------------------------------------------
	// -------------------------------------------------------
	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}

	// -------------------------------------------------------
	// -------------------------------------------------------
	private function setParams($statment, $params = array()){
		foreach ($params as $key => $value){
			$this->setParam($statment, $key, $value);
		}
	}

	
	// -------------------------------------------------------
	// $rawQuery - query bruta, vai ser tratada depois 
	// -------------------------------------------------------
	public function query ($rawQuery, $params = array()){
		// stmt ==> variavel local
		$stmt =$this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	// -------------------------------------------------------
	// -------------------------------------------------------
	public function select ($rawQuery, $params = array()){
		$stmt =$this->query($rawQuery, $params);
		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}
}
?>