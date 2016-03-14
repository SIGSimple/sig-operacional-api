<?php

class InteressadoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(InteressadoTO $tObj) {
		$sql = "INSERT INTO tb_responsavel (
					nme_responsavel,
					cargo,
					email,
					telefone,
					cod_empresa,
					numero_crea,
					cod_usuario
				) VALUES (
					:nme_responsavel,
					:cargo,
					:email,
					:telefone,
					:cod_empresa,
					:numero_crea,
					:cod_usuario
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':nme_responsavel', 	$tObj->nme_responsavel, PDO::PARAM_STR);
		$insert->bindValue(':cargo', 			$tObj->cargo, 			PDO::PARAM_STR);
		$insert->bindValue(':email', 			$tObj->email, 			PDO::PARAM_STR);
		$insert->bindValue(':telefone', 		$tObj->telefone, 		PDO::PARAM_STR);
		$insert->bindValue(':cod_empresa', 		$tObj->cod_empresa, 	PDO::PARAM_INT);
		$insert->bindValue(':numero_crea', 		$tObj->numero_crea, 	PDO::PARAM_STR);
		$insert->bindValue(':cod_usuario',		$tObj->cod_usuario, 	PDO::PARAM_INT);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(InteressadoTO $tObj) {
		$sql = "UPDATE tb_responsavel
				SET
					nme_responsavel = :nme_responsavel,
					cargo = :cargo,
					email = :email,
					telefone = :telefone,
					cod_empresa = :cod_empresa,
					numero_crea = :numero_crea,
					cod_usuario = :cod_usuario
				WHERE cod_fiscal = :cod_fiscal";
				
		$update = $this->conn->prepare($sql);

		$update->bindValue(':nme_responsavel', 	$tObj->nme_responsavel, PDO::PARAM_STR);
		$update->bindValue(':cargo', 			$tObj->cargo, 			PDO::PARAM_STR);
		$update->bindValue(':email', 			$tObj->email, 			PDO::PARAM_STR);
		$update->bindValue(':telefone', 		$tObj->telefone, 		PDO::PARAM_STR);
		$update->bindValue(':cod_empresa', 		$tObj->cod_empresa, 	PDO::PARAM_INT);
		$update->bindValue(':numero_crea', 		$tObj->numero_crea, 	PDO::PARAM_STR);
		$update->bindValue(':cod_usuario',		$tObj->cod_usuario, 	PDO::PARAM_INT);
		$update->bindValue(':cod_fiscal', 		$tObj->cod_fiscal, 		PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_fiscal) {
		$sql = "DELETE FROM tb_responsavel WHERE cod_fiscal = ". $cod_fiscal;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					itr.cod_fiscal,
				    itr.nme_responsavel,
				    itr.cargo,
				    itr.email,
				    itr.telefone,
				    itr.cod_empresa,
				    emp.Construtora AS nme_empresa,
				    itr.numero_crea,
				    itr.cod_usuario,
				    usu.nme_usuario
				FROM tb_responsavel 		AS itr
				LEFT JOIN tb_Construtora 	AS emp ON emp.cod_construtora = itr.cod_empresa
				LEFT JOIN tb_usuario 		AS usu ON usu.cod_usuario = itr.cod_usuario";
		
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
				$sql .= " WHERE itr.nme_responsavel LIKE '%$search%' OR itr.email LIKE '%$search%'";

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
				$result = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');

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