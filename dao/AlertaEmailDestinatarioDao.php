<?php

class AlertaEmailDestinatarioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function saveAlertaEmailDestinatario(AlertaEmailDestinatarioTO $tObj) {
		$sql = "INSERT INTO tb_alerta_email_destinatario (cod_alerta_email, cod_destinatario) 
				VALUES (". $tObj->cod_alerta_email .", ". $tObj->cod_destinatario .");";
				
		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}

	public function getDestinatariosAlertEmail($busca=null) {
		$sql = "SELECT * 
				FROM tb_alerta_email_destinatario 	AS aed
				INNER JOIN tb_responsavel 			AS rsp ON rsp.cod_fiscal = aed.cod_destinatario";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$sql .= " ORDER BY rsp.nme_responsavel";
		
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0)
				return $select->fetchALL(PDO::FETCH_ASSOC);
			else
				return false;
		}
		else
			return false;
	}
}

?>