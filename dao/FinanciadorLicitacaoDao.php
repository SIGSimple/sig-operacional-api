<?php

class FinanciadorLicitacaoDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function get($busca=null) {
		$sql = "SELECT *
				FROM tb_financiador_licitacao";

		if(is_array($busca) && count($busca) > 0) {
			$where = prepareWhere($busca);
			$sql .= " WHERE " . $where;
		}

		$sql .= " ORDER BY dsc_financiador";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0)
				return parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');
			else
				return false;
		}
		else
			return false;
	}
}

?>