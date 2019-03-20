<?php

	if (!empty($_POST['userName']) && !empty($_POST['password']) ) {

		$formUserName = $_POST['userName'];
		$formPassword = $_POST['password'];

		$dataSourceName = 'mysql:host=localhost;dbname=php_com_pdo';
		$userName = 'root';
		$password = '';

		try {
			$dataBase = new PDO($dataSourceName, $userName, $password);

			// $textQuery = 'SELECT * FROM tb_usuarios where email = \'' . $formUserName . '\'  AND senha = \'' . $formPassword . '\'';

			$textQuery = "SELECT * FROM tb_usuarios where email = :userName AND senha = :userPassword";

			echo $textQuery;

			$pdoStatement = $dataBase->prepare($textQuery);
			$pdoStatement->bindValue(':userName', $formUserName);
			$pdoStatement->bindValue(':userPassword', $formPassword);
			$pdoStatement->execute();

			$databaseEntry = $pdoStatement->fetch(PDO::FETCH_OBJ);
			echo '<pre>';
			print_r($databaseEntry);
			echo '</pre>';

		} catch (PDOException $error) {
			echo 'code - ' . $error->getCode() . '<br>error - ' . $error->getMessage();
		}

	}

?>

<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="login.php" method="post">
		<input type="text" name="userName" placeholder="your-email@example.com">
		<br>
		<input type="password" name="password" placeholder="password">
		<br>
		<button type="submit"> Entrar</button>
		<br>
	</form>
</body>
</html>
	