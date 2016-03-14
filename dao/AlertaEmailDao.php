<?php

class AlertaEmailDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function saveAlertaEmail(AlertaEmailTO $tObj) {
		$sql = "INSERT INTO tb_alerta_email (nme_alerta, sql_query, txt_html_email, dta_inicio, dta_fim, flg_periodicidade, flg_ativo) 
				VALUES ('". $tObj->nme_alerta ."', '". $tObj->sql_query ."', '". htmlentities($tObj->txt_html_email) ."', '". $tObj->dta_inicio ."', '". $tObj->dta_fim ."', '". $tObj->flg_periodicidade ."', ". $tObj->flg_ativo .");";

		$insert = $this->conn->prepare($sql);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function setDataEnvio($cod_alerta_email) {
		$sql = "UPDATE tb_alerta_email SET dta_ultimo_envio = now() WHERE cod_alerta_email = $cod_alerta_email;";
		$update = $this->conn->prepare($sql);
		return $update->execute();
	}

	public function getAlertasEmail($busca=null){
		$sql = "SELECT 
					tae.cod_alerta_email,
				    tae.nme_alerta,
				    tae.sql_query,
				    tae.txt_html_email,
				    tae.dta_inicio,
				    tae.dta_fim,
				    CAST(tae.flg_ativo AS UNSIGNED) AS flg_ativo,
				    tae.flg_periodicidade,
				    tae.dta_ultimo_envio,
					(SELECT COUNT(1) FROM tb_alerta_email_destinatario WHERE cod_alerta_email = tae.cod_alerta_email) AS qtd_destinatarios
				FROM tb_alerta_email AS tae";
		
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
				$sql .= " WHERE nme_alerta LIKE '%$search%' OR nme_alerta LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
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