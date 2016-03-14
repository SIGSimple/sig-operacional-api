<?php

class UsuarioDao {
	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	}

	public function desbloquearSenhaUsuario(UsuarioTO $usuarioTO) {
		$sql = "UPDATE tb_usuario
				SET nme_senha 				= :nme_senha,
					flg_senha_bloqueada 	= 0,
					dta_ultima_alteracao 	= now()
				WHERE cod_usuario = :cod_usuario;";

		$insert = $this->conn->prepare($sql);

		$insert->bindValue(':nme_senha', 	$usuarioTO->nme_senha,	 PDO::PARAM_STR);
		$insert->bindValue(':cod_usuario', 	$usuarioTO->cod_usuario, PDO::PARAM_STR);

		return $insert->execute();
	}

	public function getUsuarios($busca=null){
		$sql = "SELECT DISTINCT 
					usu.cod_usuario, 
					usu.nme_usuario, 
					usu.nme_login, 
					CAST(usu.flg_senha_bloqueada AS UNSIGNED) AS flg_senha_bloqueada, 
					per.cod_perfil, 
					per.nme_perfil, 
					emp.cod_empreendimento, 
					emp.nme_empreendimento,
					usu.pth_arquivo_foto
				FROM tb_usuario 						AS usu
				INNER JOIN tb_usuario_empreendimento 	AS tue ON tue.cod_usuario = usu.cod_usuario
				INNER JOIN tb_empreendimento 			AS emp ON emp.cod_empreendimento = tue.cod_empreendimento
				INNER JOIN tb_usuario_perfil 			AS tup ON tup.cod_usuario = usu.cod_usuario
				INNER JOIN tb_perfil 					AS per ON per.cod_perfil = tup.cod_perfil";
		
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
				$sql .= " WHERE nme_usuario LIKE '%$search%' OR nme_login LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				if(isset($busca['nme_senha']))
					$busca['nme_senha'] = md5($busca['nme_senha']);

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