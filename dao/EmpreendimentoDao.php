<?php

class EmpreendimentoDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function save(EmpreendimentoTO $tObj) {
		$sql = "INSERT INTO tb_pi (
					cod_predio,
					nome_empreendimento,
					PI,
					dsc_objeto_obra,
					cod_tipo_empreendimento,
					cod_programa,
					dsc_resultado_obtido,
					cep,
					endereco,
					latitude_longitude,
					telefone,
					email,
					cod_bacia_hidrografica,
					cod_manancial_lancamento,
					qtd_metragem_coletor_tronco,
					qtd_metragem_interceptor,
					qtd_metragem_linha_recalque,
					qtd_metragem_emissario_fluente_bruto,
					qtd_eee,
					cod_tipo_ete,
					dsc_estacao_tratamento,
					qtd_metragem_emissario_efluente_tratado,
					num_vazao_sistema,
					flg_estudo_elaborado_daee
				) 
				VALUES (
					:cod_predio,
					:nome_empreendimento,
					:PI,
					:dsc_objeto_obra,
					:cod_tipo_empreendimento,
					:cod_programa,
					:dsc_resultado_obtido,
					:cep,
					:endereco,
					:latitude_longitude,
					:telefone,
					:email,
					:cod_bacia_hidrografica,
					:cod_manancial_lancamento,
					:qtd_metragem_coletor_tronco,
					:qtd_metragem_interceptor,
					:qtd_metragem_linha_recalque,
					:qtd_metragem_emissario_fluente_bruto,
					:qtd_eee,
					:cod_tipo_ete,
					:dsc_estacao_tratamento,
					:qtd_metragem_emissario_efluente_tratado,
					:num_vazao_sistema,
					:flg_estudo_elaborado_daee
				);";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':cod_predio', $tObj->cod_predio, PDO::PARAM_INT);
		$insert->bindValue(':nome_empreendimento', $tObj->nome_empreendimento, PDO::PARAM_STR);
		$insert->bindValue(':PI', $tObj->PI, PDO::PARAM_STR);
		$insert->bindValue(':dsc_objeto_obra', $tObj->dsc_objeto_obra, PDO::PARAM_STR);
		$insert->bindValue(':cod_tipo_empreendimento', $tObj->cod_tipo_empreendimento, PDO::PARAM_INT);
		$insert->bindValue(':cod_programa', $tObj->cod_programa, PDO::PARAM_INT);
		$insert->bindValue(':dsc_resultado_obtido', $tObj->dsc_resultado_obtido, PDO::PARAM_STR);
		$insert->bindValue(':cep', $tObj->cep, PDO::PARAM_STR);
		$insert->bindValue(':endereco', $tObj->endereco, PDO::PARAM_STR);
		$insert->bindValue(':latitude_longitude', $tObj->latitude_longitude, PDO::PARAM_STR);
		$insert->bindValue(':telefone', $tObj->telefone, PDO::PARAM_STR);
		$insert->bindValue(':email', $tObj->email, PDO::PARAM_STR);
		$insert->bindValue(':cod_bacia_hidrografica', $tObj->cod_bacia_hidrografica, PDO::PARAM_INT);
		$insert->bindValue(':cod_manancial_lancamento', $tObj->cod_manancial_lancamento, PDO::PARAM_INT);
		$insert->bindValue(':qtd_metragem_coletor_tronco', $tObj->qtd_metragem_coletor_tronco, PDO::PARAM_INT);
		$insert->bindValue(':qtd_metragem_interceptor', $tObj->qtd_metragem_interceptor, PDO::PARAM_INT);
		$insert->bindValue(':qtd_metragem_linha_recalque', $tObj->qtd_metragem_linha_recalque, PDO::PARAM_INT);
		$insert->bindValue(':qtd_metragem_emissario_fluente_bruto', $tObj->qtd_metragem_emissario_fluente_bruto, PDO::PARAM_INT);
		$insert->bindValue(':qtd_eee', $tObj->qtd_eee, PDO::PARAM_INT);
		$insert->bindValue(':cod_tipo_ete', $tObj->cod_tipo_ete, PDO::PARAM_INT);
		$insert->bindValue(':dsc_estacao_tratamento', $tObj->dsc_estacao_tratamento, PDO::PARAM_STR);
		$insert->bindValue(':qtd_metragem_emissario_efluente_tratado', $tObj->qtd_metragem_emissario_efluente_tratado, PDO::PARAM_INT);
		$insert->bindValue(':num_vazao_sistema', $tObj->num_vazao_sistema, PDO::PARAM_STR);
		$insert->bindValue(':flg_estudo_elaborado_daee', $tObj->flg_estudo_elaborado_daee, PDO::PARAM_STR);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function update(EmpreendimentoTO $tObj) {
		$sql = "UPDATE tb_pi
				SET cod_predio = :cod_predio,
					nome_empreendimento = :nome_empreendimento,
					PI = :PI,
					dsc_objeto_obra = :dsc_objeto_obra,
					cod_tipo_empreendimento = :cod_tipo_empreendimento,
					cod_programa = :cod_programa,
					dsc_resultado_obtido = :dsc_resultado_obtido,
					cep = :cep,
					endereco = :endereco,
					latitude_longitude = :latitude_longitude,
					telefone = :telefone,
					email = :email,
					cod_bacia_hidrografica = :cod_bacia_hidrografica,
					cod_manancial_lancamento = :cod_manancial_lancamento,
					qtd_metragem_coletor_tronco = :qtd_metragem_coletor_tronco,
					qtd_metragem_interceptor = :qtd_metragem_interceptor,
					qtd_metragem_linha_recalque = :qtd_metragem_linha_recalque,
					qtd_metragem_emissario_fluente_bruto = :qtd_metragem_emissario_fluente_bruto,
					qtd_eee = :qtd_eee,
					cod_tipo_ete = :cod_tipo_ete,
					dsc_estacao_tratamento = :dsc_estacao_tratamento,
					qtd_metragem_emissario_efluente_tratado = :qtd_metragem_emissario_efluente_tratado,
					num_vazao_sistema = :num_vazao_sistema,
					flg_estudo_elaborado_daee = :flg_estudo_elaborado_daee
				WHERE `Código` = :cod_empreendimento";
		$update = $this->conn->prepare($sql);

		$update->bindValue(':cod_predio', $tObj->cod_predio, PDO::PARAM_INT);
		$update->bindValue(':nome_empreendimento', $tObj->nome_empreendimento, PDO::PARAM_STR);
		$update->bindValue(':PI', $tObj->PI, PDO::PARAM_STR);
		$update->bindValue(':dsc_objeto_obra', $tObj->dsc_objeto_obra, PDO::PARAM_STR);
		$update->bindValue(':cod_tipo_empreendimento', $tObj->cod_tipo_empreendimento, PDO::PARAM_INT);
		$update->bindValue(':cod_programa', $tObj->cod_programa, PDO::PARAM_INT);
		$update->bindValue(':dsc_resultado_obtido', $tObj->dsc_resultado_obtido, PDO::PARAM_STR);
		$update->bindValue(':cep', $tObj->cep, PDO::PARAM_STR);
		$update->bindValue(':endereco', $tObj->endereco, PDO::PARAM_STR);
		$update->bindValue(':latitude_longitude', $tObj->latitude_longitude, PDO::PARAM_STR);
		$update->bindValue(':telefone', $tObj->telefone, PDO::PARAM_STR);
		$update->bindValue(':email', $tObj->email, PDO::PARAM_STR);
		$update->bindValue(':cod_bacia_hidrografica', $tObj->cod_bacia_hidrografica, PDO::PARAM_INT);
		$update->bindValue(':cod_manancial_lancamento', $tObj->cod_manancial_lancamento, PDO::PARAM_INT);
		$update->bindValue(':qtd_metragem_coletor_tronco', $tObj->qtd_metragem_coletor_tronco, PDO::PARAM_INT);
		$update->bindValue(':qtd_metragem_interceptor', $tObj->qtd_metragem_interceptor, PDO::PARAM_INT);
		$update->bindValue(':qtd_metragem_linha_recalque', $tObj->qtd_metragem_linha_recalque, PDO::PARAM_INT);
		$update->bindValue(':qtd_metragem_emissario_fluente_bruto', $tObj->qtd_metragem_emissario_fluente_bruto, PDO::PARAM_INT);
		$update->bindValue(':qtd_eee', $tObj->qtd_eee, PDO::PARAM_INT);
		$update->bindValue(':cod_tipo_ete', $tObj->cod_tipo_ete, PDO::PARAM_INT);
		$update->bindValue(':dsc_estacao_tratamento', $tObj->dsc_estacao_tratamento, PDO::PARAM_STR);
		$update->bindValue(':qtd_metragem_emissario_efluente_tratado', $tObj->qtd_metragem_emissario_efluente_tratado, PDO::PARAM_INT);
		$update->bindValue(':num_vazao_sistema', $tObj->num_vazao_sistema, PDO::PARAM_STR);
		$update->bindValue(':flg_estudo_elaborado_daee', $tObj->flg_estudo_elaborado_daee, PDO::PARAM_STR);

		$update->bindValue(':cod_empreendimento', $tObj->cod_empreendimento, PDO::PARAM_INT);

		return $update->execute();
	}

	public function delete($cod_empreendimento) {
		$sql = "DELETE FROM tb_pi WHERE `Código` = ". $cod_empreendimento;
		$delete = $this->conn->prepare($sql);
		return $delete->execute();
	}

	public function get($busca=null){
		$sql = "SELECT
					tpi.`Código` as cod_empreendimento,
					tpi.cod_predio,
					mun.Municipios AS nme_municipio,
					tpi.nome_empreendimento,
					tpi.PI,
					tpi.dsc_objeto_obra,
					tpi.cod_tipo_empreendimento,
					tpe.desc_tipo AS dsc_tipo_empreendimento,
					tpi.cod_programa,
					pgr.sigla AS sgl_programa,
					pgr.desc_depto AS dsc_programa,
					tpi.dsc_resultado_obtido,
					tpi.endereco,
					tpi.cep,
					tpi.latitude_longitude,
					tpi.email,
					tpi.telefone,
					tpi.cod_bacia_hidrografica,
					tbh.nme_bacia_hidrografica,
					tpi.cod_manancial_lancamento,
					tml.nme_manancial AS nme_manancial_lancamento,
					tpi.qtd_metragem_coletor_tronco,
					tpi.qtd_metragem_interceptor,
					tpi.qtd_metragem_emissario_fluente_bruto,
					tpi.qtd_eee,
					tpi.qtd_metragem_linha_recalque,
					tpi.cod_tipo_ete,
					tte.nme_tipo_ete,
					tpi.dsc_estacao_tratamento,
					tpi.qtd_metragem_emissario_efluente_tratado,
					tpi.num_vazao_sistema,
					tpi.flg_estudo_elaborado_daee
				FROM tb_pi 							AS tpi
				LEFT JOIN tb_predio 				AS tpr ON tpr.id_predio = tpi.id_predio
				LEFT JOIN tb_Municipios				AS mun ON mun.cod_mun = tpr.cod_municipio
				LEFT JOIN tb_tipo_empreendimento 	AS tpe ON tpe.id = tpi.cod_tipo_empreendimento
				LEFT JOIN tb_depto 					AS pgr ON pgr.cod_depto = tpi.cod_programa
				LEFT JOIN tb_bacia_hidrografica		AS tbh ON tbh.id = tpi.cod_bacia_hidrografica
				LEFT JOIN tb_manancial_lancamento 	AS tml ON tml.id = tpi.cod_manancial_lancamento
				LEFT JOIN tb_tipo_ete 				AS tte ON tte.id = tpi.cod_tipo_ete";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$sort = "";
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

			if(isset($busca['sort'])) {
				$sort = $busca['sort'];
				unset($busca['sort']);
			}

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);

				if($order == "asc")
					$order = SORT_ASC;
				else if($order == "desc")
					$order = SORT_DESC;
			}	

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE nome_empreendimento LIKE '%$search%' OR nme_municipio LIKE '%$search%'";

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

		$sql .= " ORDER BY nme_municipio ASC, nome_empreendimento ASC, PI ASC";
		
		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				if($sort != "")
					$result = parse_arr_values(array_orderby($select->fetchALL(PDO::FETCH_ASSOC), $sort, $order),"all");
				else
					$result = parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC),"all");

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