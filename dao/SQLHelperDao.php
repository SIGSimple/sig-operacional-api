<?php

class SQLHelperDao {

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function executeQuery($sqlQuery) {
		$select = $this->conn->prepare($sqlQuery);
		if($select->execute()){
			if($select->rowCount() > 0)
				return parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');
			else
				return false;
		}
		else
			return false;
	}

}

?>