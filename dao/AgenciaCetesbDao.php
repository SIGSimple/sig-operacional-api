<?php

class AgenciaCetesbDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(AgenciaCetesbTO $tObj) {
		$sql = "INSERT INTO tb_agencia_cetesb (nme_agencia, dsc_endereco, dsc_bairro, cod_municipio, num_cep, num_telefone, num_fax, end_email) 
				VALUES (:nme_agencia, :dsc_endereco, :dsc_bairro, :cod_municipio, :num_cep, :num_telefone, :num_fax, :end_email);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':nme_agencia', 		$tObj->nme_agencia,		PDO::PARAM_STR);
		$insert->bindValue(':dsc_endereco', 	$tObj->dsc_endereco, 	PDO::PARAM_STR);
		$insert->bindValue(':dsc_bairro', 		$tObj->dsc_bairro,		PDO::PARAM_STR);
		$insert->bindValue(':cod_municipio', 	$tObj->cod_municipio,	PDO::PARAM_INT);
		$insert->bindValue(':num_cep', 			$tObj->num_cep,			PDO::PARAM_STR);
		$insert->bindValue(':num_telefone', 	$tObj->num_telefone,	PDO::PARAM_STR);
		$insert->bindValue(':num_fax', 			$tObj->num_fax,			PDO::PARAM_STR);
		$insert->bindValue(':end_email', 		$tObj->end_email, 		PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(AgenciaCetesbTO $tObj) {
		$sql = "UPDATE tb_agencia_cetesb
				SET nme_agencia = :nme_agencia,
					dsc_endereco = :dsc_endereco,
					dsc_bairro = :dsc_bairro,
					cod_municipio = :cod_municipio,
					num_cep = :num_cep,
					num_telefone = :num_telefone,
					num_fax = :num_fax,
					end_email = :end_email
				WHERE id = :id";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':nme_agencia', 		$tObj->nme_agencia,		PDO::PARAM_STR);
		$update->bindValue(':dsc_endereco', 	$tObj->dsc_endereco, 	PDO::PARAM_STR);
		$update->bindValue(':dsc_bairro', 		$tObj->dsc_bairro,		PDO::PARAM_STR);
		$update->bindValue(':cod_municipio', 	$tObj->cod_municipio,	PDO::PARAM_INT);
		$update->bindValue(':num_cep', 			$tObj->num_cep,			PDO::PARAM_STR);
		$update->bindValue(':num_telefone', 	$tObj->num_telefone,	PDO::PARAM_STR);
		$update->bindValue(':num_fax', 			$tObj->num_fax,			PDO::PARAM_STR);
		$update->bindValue(':end_email', 		$tObj->end_email, 		PDO::PARAM_STR);
		$update->bindValue(':id', 				$tObj->id, 				PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_agencia_cetesb) {
		$sql = "DELETE FROM tb_agencia_cetesb WHERE id = ". $cod_agencia_cetesb;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					tac.id,
					tac.nme_agencia,
					tac.dsc_endereco,
					tac.dsc_bairro,
					tac.cod_municipio,
				    mun.nme_municipio,
					tac.num_cep,
					tac.num_telefone,
					tac.num_fax,
					tac.end_email
				FROM tb_agencia_cetesb 	AS tac
				LEFT JOIN tb_predio 	AS mun ON mun.id_predio = tac.cod_municipio";
		
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
				$sql .= " WHERE tac.nme_agencia LIKE '%$search%' OR mun.dsc_bairro LIKE '%$search%' OR tac.nme_municipio LIKE '%$search%";

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