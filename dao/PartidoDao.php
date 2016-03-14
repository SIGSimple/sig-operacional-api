<?php

class PartidoDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function get($busca=null) {
		$sql = "SELECT *
				FROM tb_partido";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$sql .= " ORDER BY nme_partido";

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