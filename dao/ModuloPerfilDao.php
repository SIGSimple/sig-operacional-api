<?php
class ModuloPerfilDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getModulosPerfis($cod_perfil) {
		$sql = "SELECT tmp.*, mdl.nme_modulo, pfl.nme_perfil 
				FROM tb_modulo_perfil as tmp
				INNER JOIN tb_modulo as mdl on mdl.cod_modulo = tmp.cod_modulo
				INNER JOIN tb_perfil as pfl on pfl.cod_perfil = tmp.cod_perfil
				WHERE tmp.cod_perfil = $cod_perfil
				ORDER BY cod_perfil ASC, cod_modulo ASC";

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

	public function saveModuloPerfil(ModuloPerfilTO $moduloPerfilTO) {
		$sql = "INSERT INTO tb_modulo_perfil (cod_modulo, cod_perfil) 
				VALUES (:cod_modulo, :cod_perfil);";

		$insert = $this->conn->prepare($sql);
		
		$insert->bindValue(':cod_modulo', $moduloPerfilTO->cod_modulo, PDO::PARAM_INT);
		$insert->bindValue(':cod_perfil', $moduloPerfilTO->cod_perfil, PDO::PARAM_INT);

		return $insert->execute();
	}

	public function deleteAllModulosPerfil($cod_perfil) {
		$sql = "DELETE FROM tb_modulo_perfil WHERE cod_perfil = :cod_perfil;";
		$insert = $this->conn->prepare($sql);
		$insert->bindValue(':cod_perfil', $moduloPerfilTO->cod_perfil, PDO::PARAM_INT);
		return $insert->execute();
	}

	public function deleteModuloPerfil($cod_modulo, $cod_perfil) {
		$sql = "DELETE FROM tb_modulo_perfil WHERE cod_modulo = :cod_modulo AND cod_perfil = :cod_perfil;";
		$insert = $this->conn->prepare($sql);
		$insert->bindValue(':cod_modulo', $cod_modulo, PDO::PARAM_INT);
		$insert->bindValue(':cod_perfil', $cod_perfil, PDO::PARAM_INT);
		return $insert->execute();
	}
}
?>