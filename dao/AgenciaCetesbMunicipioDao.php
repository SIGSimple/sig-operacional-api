<?php

class AgenciaCetesbMunicipioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(AgenciaCetesbMunicipioTO $tObj) {
		$sql = "INSERT INTO tb_agencia_cetesb_municipio (cod_agencia_cetesb, cod_municipio) 
				VALUES (:cod_agencia_cetesb, :cod_municipio);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_agencia_cetesb', 	$tObj->cod_agencia_cetesb,	PDO::PARAM_STR);
		$insert->bindValue(':cod_municipio', 		$tObj->cod_municipio, 		PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function deleteMunicipiosByIdAgenciaCetesb($cod_agencia_cetesb) {
		$sql = "DELETE FROM tb_agencia_cetesb_municipio WHERE cod_agencia_cetesb = ". $cod_agencia_cetesb;;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function getMunicipiosByIdAgenciaCetesb($cod_agencia_cetesb){
		$sql = "SELECT *
				FROM tb_agencia_cetesb_municipio 
				WHERE cod_agencia_cetesb = ". $cod_agencia_cetesb;
		$select = $this->conn->prepare($sql);

		if($select->execute() && $select->rowCount() > 0)
			return $select->fetchAll(PDO::FETCH_ASSOC);
		else
			return false;
	}
}

?>