<?php 
	//deve estar antes da impressão de dados no navegador (normalmente no topo)
	session_start(); 

	$loginInformationIsValid = false;

	$users = [
		['email' => "admin@system.com", 'password' => "rootPass"], 
		['email' => "user@system.com", 'password' => "regularPass"]
	];


	$receivedEmail = $_POST['email'];
	$receivedPassword = $_POST['password'];

	foreach ($users as $loginInformation) {
		if (($loginInformation['email'] == $receivedEmail) && 
			($loginInformation['password'] == $receivedPassword)) {
			$loginInformationIsValid = true;
		}
	}

	if ($loginInformationIsValid) {
		$_SESSION['userIsLoggedIn'] = true;
		header('Location: home.php');
	} else {
		$_SESSION['userIsLoggedIn'] = false;
		header('Location: index.php?login=error');
	}
?>