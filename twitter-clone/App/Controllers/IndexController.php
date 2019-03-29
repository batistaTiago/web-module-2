<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		$this->render('index');
	}

	public function inscreverse() {
		$this->render('inscreverse');
	}

	public function registrar() {
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		$emailDisponivel = ($usuario->getUsuarioPorEmail() == null);
		$formularioValido = $usuario->formularioValido();
		if ($emailDisponivel && $formularioValido) {
			if ($usuario->salvar() != null) {
				echo 'cadastrou!';
				$this->render('cadastro');
			} else {
				echo 'deu ruim2';
			}
		} else {
			$this->view->erroCadastro = true;
			$this->render('inscreverse');
		}
	}
}


?>