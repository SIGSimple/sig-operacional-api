<?php

class EmpreendimentoContratoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(EmpreendimentoContratoTO $tObj) {
		$sql = "INSERT INTO tb_pi_contrato (cod_empreendimento, cod_contrato) VALUES (:cod_empreendimento, :cod_contrato);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_empreendimento', 	$tObj->cod_empreendimento, 	PDO::PARAM_INT);
		$insert->bindValue(':cod_contrato',			$tObj->cod_contrato, 		PDO::PARAM_INT);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function deleteByIdContrato($cod_contrato) {
		$sql = "DELETE FROM tb_pi_contrato WHERE cod_contrato = ". $cod_contrato;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}
}