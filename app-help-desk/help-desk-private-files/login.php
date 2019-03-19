<?php 
	//deve estar antes da impressão de dados no navegador (normalmente no topo)
	session_start(); 

	$loginInformationIsValid = false;
	$userId = null;
	$accountType = null;

	$users = [
		['id' => 0, 'email' => "root@system.com", 'password' => "admin", 'accountType' => 1], 
		['id' => 1, 'email' => "user1@gmail.com", 'password' => "1234", 'accountType' => 2], 
		['id' => 2, 'email' => "user2@gmail.com", 'password' => "1234", 'accountType' => 2],
		['id' => 3, 'email' => "user3@gmail.com", 'password' => "1234", 'accountType' => 2]
	];

	$profileTypes = [1 => 'root', 2 => 'regular'];


	$receivedEmail = $_POST['email'];
	$receivedPassword = $_POST['password'];

	foreach ($users as $providedLoginInformation) {
		if (($providedLoginInformation['email'] == $receivedEmail) && 
			($providedLoginInformation['password'] == $receivedPassword)) {
			$loginInformationIsValid = true;
			$userId = $providedLoginInformation['id'];
			$accountType = $providedLoginInformation['accountType'];
		}
	}

	if ($loginInformationIsValid) {
		$_SESSION['userIsLoggedIn'] = true;
		$_SESSION['userId'] = $userId;
		$_SESSION['accountType'] = $accountType;
		header('Location: home.php');
	} else {
		$_SESSION['userIsLoggedIn'] = false;
		header('Location: index.php?login=error');
	}
?>