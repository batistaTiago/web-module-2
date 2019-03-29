<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

	public function autenticar() {

		$usuario = Container::getModel('Usuario');
		$usuario->email = $_POST['email'];
		$usuario->senha = md5($_POST['senha']);

		if ($usuario->autenticar()) {
			session_start();
			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['nome'] = $usuario->__get('nome');
			header('Location: /timeline');
		} else {
			header('Location: /?login=erro');
		}
	}

	public function sair() {
		session_start();
		session_destroy();
		header('Location: /');
	}

	public static function validaSessao() {
		session_start();
		if ((!isset($_SESSION['id'])) || (!isset($_SESSION['nome'])) || ($_SESSION['id'] == '') || ($_SESSION['nome'] == '')) {
			header('Location: /?login=erro');
		}
	}

}



?>