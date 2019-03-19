<?php

	// remover indices do array de sessão ou destruir a variavel de sessão 'altogether'

	// remove um dos elementos do array de sessão(se ele existir)
	// unset($_SESSION['userIsLoggedIn']);


	// destroi a sessão como um todo
	// session_destroy();


	// forçar um redirect para atualizar a variavel de sessão no browser
	// header('Location: index.php');


	
	session_start();
	session_destroy();
	header('Location: index.php');

?>