<?php 
	session_start();
	if (!isset($_SESSION['userIsLoggedIn'])) {
		header('Location: index.php?login=noUserFound');
	} else if ($_SESSION['userIsLoggedIn'] == false) {
		header('Location: index.php?login=error');
	}
?>