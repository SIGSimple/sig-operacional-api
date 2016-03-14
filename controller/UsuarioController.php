<?php
class UsuarioController{
	public static function desbloquearSenhaUsuario() {
		$usuarioTO = new UsuarioTO();
		$usuarioTO->cod_usuario = $_POST['cod_usuario'];
		$usuarioTO->nme_senha 	= md5($_POST['nme_senha']);

		$usuarioDao  = new UsuarioDao();
		if($usuarioDao->desbloquearSenhaUsuario($usuarioTO))
			Flight::halt(200, 'Senha desbloqueada com sucesso!');
		else
			Flight::halt(500, 'Erro ao desbloquear a senha.');
	}

	public static function getUsuarios() {
		$usuarioDao  = new UsuarioDao();
		$usuarios = $usuarioDao->getUsuarios($_GET);
		if($usuarios)
			Flight::json($usuarios);
		else
			Flight::halt(404, 'Nenhum usuário encontrado.');
	}
}
?>