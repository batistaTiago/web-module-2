<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function validaSessao() {
		AuthController::validaSessao();
	}

	public function timeline() {
		$this->validaSessao();
		$this->getUserParameters();

		$tweet = Container::getModel('Tweet');
		$tweet->__set('id_usuario', $_SESSION['id']);
		$tweets = $tweet->getAll();

		$this->view->tweets = $tweets;

		$this->render('timeline');

	}

	public function getUserParameters() {
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->userInfo = $usuario->getUsuarioPorId()['nome_usuario'];
		$this->view->totalTweets = $usuario->getTotalTweets()['total_tweets'];
		$this->view->totalSeguindo = $usuario->getTotalSeguindo()['total_seguindo'];
		$this->view->totalSeguidores = $usuario->getTotalSeguidores()['total_seguidores'];
	}

	public function tweet() {
		$this->validaSessao();

		$tweet = Container::getModel('Tweet');
		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		header('Location: /timeline');
	}

	public function quemseguir() {
		$this->validaSessao();
		$this->getUserParameters();

		$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';

		$usuarios = [];

		if ($pesquisa != '') {
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisa);
			$usuario->__set('id', $_SESSION['id']);
			$usuarios = $usuario->getAll();

			$this->view->usuarios = $usuarios;
		}

		$this->render('quemSeguir');
	}

	public function acao() {
		$this->validaSessao();


		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_usuario_alvo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		if ($acao == 'seguir') {
			$usuario->seguirUsuario($id_usuario_alvo);
		} else if ($acao == 'deixar_de_seguir') {
			$usuario->deixarDeSeguirUsuario($id_usuario_alvo);
		}

		header('Location: /quemseguir');
	}

}