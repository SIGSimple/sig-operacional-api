<?php

class EmpresaDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(EmpresaTO $tObj) {
		$sql = "INSERT INTO tb_Construtora (
					Construtora,
					end_construtora,
					cep_empresa,
					cod_municipio_empresa,
					email_empresa,
					site_empresa,
					`Fone da Construtora`,
					cnpj_empresa,
					nme_engenheiro_responsavel,
					num_crea,
					telefone_responsavel,
					email_responsavel
				) VALUES (
					:Construtora,
					:end_construtora,
					:cep_empresa,
					:cod_municipio_empresa,
					:email_empresa,
					:site_empresa,
					:num_telefone,
					:cnpj_empresa,
					:nme_engenheiro_responsavel,
					:num_crea,
					:telefone_responsavel,
					:email_responsavel
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':Construtora', 					$tObj->Construtora, 				PDO::PARAM_STR);
		$insert->bindValue(':end_construtora', 				$tObj->end_construtora, 			PDO::PARAM_STR);
		$insert->bindValue(':cep_empresa', 					$tObj->cep_empresa, 				PDO::PARAM_STR);
		$insert->bindValue(':cod_municipio_empresa', 		$tObj->cod_municipio_empresa, 		PDO::PARAM_INT);
		$insert->bindValue(':email_empresa', 				$tObj->email_empresa, 				PDO::PARAM_STR);
		$insert->bindValue(':site_empresa', 				$tObj->site_empresa, 				PDO::PARAM_STR);
		$insert->bindValue(':num_telefone', 				$tObj->num_telefone, 				PDO::PARAM_STR);
		$insert->bindValue(':cnpj_empresa', 				$tObj->cnpj_empresa, 				PDO::PARAM_STR);
		$insert->bindValue(':nme_engenheiro_responsavel', 	$tObj->nme_engenheiro_responsavel, 	PDO::PARAM_STR);
		$insert->bindValue(':num_crea', 					$tObj->num_crea, 					PDO::PARAM_STR);
		$insert->bindValue(':telefone_responsavel', 		$tObj->telefone_responsavel, 		PDO::PARAM_STR);
		$insert->bindValue(':email_responsavel', 			$tObj->email_responsavel, 			PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(EmpresaTO $tObj) {
		$sql = "UPDATE tb_Construtora
				SET
					Construtora 				= :Construtora,
					end_construtora 			= :end_construtora,
					cep_empresa 				= :cep_empresa,
					cod_municipio_empresa 		= :cod_municipio_empresa,
					email_empresa 				= :email_empresa,
					site_empresa 				= :site_empresa,
					`Fone da Construtora`		= :num_telefone,
					cnpj_empresa 				= :cnpj_empresa,
					nme_engenheiro_responsavel 	= :nme_engenheiro_responsavel,
					num_crea 					= :num_crea,
					telefone_responsavel 		= :telefone_responsavel,
					email_responsavel 			= :email_responsavel
				WHERE cod_construtora = :cod_construtora";
				
		$update = $this->conn->prepare($sql);
		$update->bindValue(':Construtora', 					$tObj->Construtora, 				PDO::PARAM_STR);
		$update->bindValue(':end_construtora', 				$tObj->end_construtora, 			PDO::PARAM_STR);
		$update->bindValue(':cep_empresa', 					$tObj->cep_empresa, 				PDO::PARAM_STR);
		$update->bindValue(':cod_municipio_empresa', 		$tObj->cod_municipio_empresa, 		PDO::PARAM_INT);
		$update->bindValue(':email_empresa', 				$tObj->email_empresa, 				PDO::PARAM_STR);
		$update->bindValue(':site_empresa', 				$tObj->site_empresa, 				PDO::PARAM_STR);
		$update->bindValue(':num_telefone', 				$tObj->num_telefone, 				PDO::PARAM_STR);
		$update->bindValue(':cnpj_empresa', 				$tObj->cnpj_empresa, 				PDO::PARAM_STR);
		$update->bindValue(':nme_engenheiro_responsavel', 	$tObj->nme_engenheiro_responsavel, 	PDO::PARAM_STR);
		$update->bindValue(':num_crea', 					$tObj->num_crea, 					PDO::PARAM_STR);
		$update->bindValue(':telefone_responsavel', 		$tObj->telefone_responsavel, 		PDO::PARAM_STR);
		$update->bindValue(':email_responsavel', 			$tObj->email_responsavel, 			PDO::PARAM_STR);
		$update->bindValue(':cod_construtora', 				$tObj->cod_construtora, 			PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_construtora) {
		$sql = "DELETE FROM tb_Construtora WHERE cod_construtora = ". $cod_construtora;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					emp.cod_construtora,
					emp.Construtora,
					emp.end_construtora,
					emp.cep_empresa,
					emp.cod_municipio_empresa,
					mun.nme_municipio,
					emp.email_empresa,
					emp.site_empresa,
					emp.`Fone da Construtora` as num_telefone,
					emp.cnpj_empresa,
					emp.nme_engenheiro_responsavel,
					emp.num_crea,
					emp.telefone_responsavel,
					emp.email_responsavel
				FROM tb_Construtora 	AS emp
				LEFT JOIN tb_predio 	AS mun ON mun.id_predio = emp.cod_municipio_empresa";
		
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
				$sql .= " WHERE Construtora LIKE '%$search%'";

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