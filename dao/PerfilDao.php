<?php
class PerfilDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function savePerfil(PerfilTO $perfilTO) {
		$sql = "INSERT INTO tb_perfil (nme_perfil, flg_ativo) 
				VALUES (:nme_perfil, :flg_ativo);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':nme_perfil', 	$perfilTO->nme_perfil,	PDO::PARAM_STR);
		$insert->bindValue(':flg_ativo', 	$perfilTO->flg_ativo, 	PDO::PARAM_INT);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function updatePerfil(PerfilTO $perfilTO) {
		$sql = "UPDATE tb_perfil
				SET nme_perfil 		= :nme_perfil,
					flg_ativo 		= :flg_ativo
				WHERE cod_perfil = :cod_perfil;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':nme_perfil', 	$perfilTO->nme_perfil,	PDO::PARAM_INT);
		$insert->bindValue(':flg_ativo', 	$perfilTO->flg_ativo,	PDO::PARAM_STR);
		$insert->bindValue(':cod_perfil', 	$perfilTO->cod_perfil,	PDO::PARAM_INT);

		return $insert->execute();
	}

	public function deletePerfil($cod_perfil) {
		$sql = "DELETE FROM tb_perfil WHERE cod_perfil = :cod_perfil;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_perfil', $cod_perfil, PDO::PARAM_INT);

		return $insert->execute();
	}

	public function getPerfis($busca=null){
		$sql = "SELECT * FROM tb_perfil";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$order = "asc";
		$search = "";


		if(is_array($busca) && count($busca) > 0) {
			if(isset($busca['nolimit'])) {
				$nolimit = true;
				unset($busca['nolimit']);
			}

			if(isset($busca['limit'])) {
				$limit = $busca['limit'];
				unset($busca['limit']);
			}	

			if(isset($busca['offset'])) {
				$offset = $busca['offset'];
				unset($busca['offset']);
			}	

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);
			}	

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE nme_perfil LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				$where = prepareWhere($busca);
				$sql .= " WHERE " . $where;
			}
		}

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = $select->fetchALL(PDO::FETCH_ASSOC);

				if($order != "asc")
					$result = array_reverse($result);

				$sizeOfResult = count($result);

				if(!$nolimit)
					$result = array_slice($result, $offset, $limit);

				$data = array();
				$data['total'] 	= $sizeOfResult;
				$data['rows'] 	= $result;

				return $data;
			}
			else
				return false;
		}
		else
			return false;
	}
}
?>